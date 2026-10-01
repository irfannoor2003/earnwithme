<?php

namespace Tests\Feature;

use App\Models\Setting;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

/**
 * Closes the remaining gaps found during the security and money review.
 */
class OperationalGapsTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create([
            'is_admin' => true, 'is_active' => true, 'email_verified_at' => now(),
        ]);
    }

    // ---------------------------------------------------------------------
    // Payout reconciliation
    // ---------------------------------------------------------------------

    public function test_approving_a_withdrawal_records_what_was_paid(): void
    {
        $admin = $this->admin();
        $user = User::factory()->create(['is_active' => true, 'email_verified_at' => now()]);

        $withdrawal = Withdrawal::create([
            'user_id' => $user->id, 'amount' => 500, 'fee' => 5,
            'method' => 'jazzcash', 'account_number' => '03001234567', 'status' => 'pending',
        ]);

        $this->actingAs($admin)->post("/admin/withdrawals/{$withdrawal->id}/approve", [
            'paid_amount' => '500.00',
            'payout_reference' => 'JC-88213-XYZ',
            'note' => 'sent via JazzCash',
        ])->assertRedirect('/admin/withdrawals');

        $fresh = $withdrawal->fresh();

        $this->assertSame('approved', $fresh->status);
        $this->assertSame(500.0, (float) $fresh->paid_amount);
        $this->assertSame('JC-88213-XYZ', $fresh->payout_reference);
        $this->assertNotNull($fresh->paid_at, 'a timestamp is needed to reconcile against bank statements');
    }

    public function test_approve_still_works_without_payout_details(): void
    {
        $admin = $this->admin();
        $user = User::factory()->create(['is_active' => true, 'email_verified_at' => now()]);

        $withdrawal = Withdrawal::create([
            'user_id' => $user->id, 'amount' => 200, 'fee' => 2,
            'method' => 'easypaisa', 'account_number' => '03', 'status' => 'pending',
        ]);

        $this->actingAs($admin)->post("/admin/withdrawals/{$withdrawal->id}/approve")
            ->assertRedirect('/admin/withdrawals');

        $this->assertSame('approved', $withdrawal->fresh()->status);
        $this->assertNotNull($withdrawal->fresh()->paid_at);
    }

    public function test_payout_amount_rejects_garbage(): void
    {
        $admin = $this->admin();
        $user = User::factory()->create(['is_active' => true, 'email_verified_at' => now()]);

        $withdrawal = Withdrawal::create([
            'user_id' => $user->id, 'amount' => 200, 'fee' => 2,
            'method' => 'easypaisa', 'account_number' => '03', 'status' => 'pending',
        ]);

        $this->actingAs($admin)->post("/admin/withdrawals/{$withdrawal->id}/approve", [
            'paid_amount' => '1e3',
        ])->assertSessionHasErrors('paid_amount');

        $this->assertSame('pending', $withdrawal->fresh()->status, 'bad input must not approve');
    }

    public function test_rejecting_does_not_record_a_payout(): void
    {
        $admin = $this->admin();
        $user = User::factory()->create(['is_active' => true, 'email_verified_at' => now()]);

        $withdrawal = Withdrawal::create([
            'user_id' => $user->id, 'amount' => 200, 'fee' => 2,
            'method' => 'easypaisa', 'account_number' => '03', 'status' => 'pending',
        ]);

        $this->actingAs($admin)->post("/admin/withdrawals/{$withdrawal->id}/reject")
            ->assertRedirect('/admin/withdrawals');

        $fresh = $withdrawal->fresh();
        $this->assertSame('rejected', $fresh->status);
        $this->assertNull($fresh->paid_at, 'a rejected request was never paid');
    }

    public function test_admin_withdrawals_page_shows_payout_reference(): void
    {
        $admin = $this->admin();
        $user = User::factory()->create(['is_active' => true, 'email_verified_at' => now()]);

        $withdrawal = Withdrawal::create([
            'user_id' => $user->id, 'amount' => 200, 'fee' => 2,
            'method' => 'easypaisa', 'account_number' => '03', 'status' => 'pending',
        ]);

        $this->actingAs($admin)->post("/admin/withdrawals/{$withdrawal->id}/approve", [
            'paid_amount' => '200.00', 'payout_reference' => 'EP-REF-7788',
        ]);

        $this->actingAs($admin)->get('/admin/withdrawals')
            ->assertOk()
            ->assertSee('EP-REF-7788');
    }

    // ---------------------------------------------------------------------
    // Settings cache
    // ---------------------------------------------------------------------

    public function test_settings_save_invalidates_cache_once_and_fully(): void
    {
        $admin = $this->admin();

        Setting::set('adsense_enabled', '1');
        $this->assertSame('1', Setting::get('adsense_enabled'));

        // Prime the cache.
        $this->assertSame('1', Setting::get('adsense_enabled'));

        $this->actingAs($admin)->post('/admin/settings', [
            'adsense_enabled' => 'on',
            'adsense_publisher_id' => 'pub-123',
            'adsense_ad_slot_header' => 'slot-header',
        ])->assertRedirect('/admin/settings');

        // A partial save must not leave the cache showing stale values.
        $this->assertSame('1', Setting::get('adsense_enabled'));
        $this->assertSame('pub-123', Setting::get('adsense_publisher_id'));
        $this->assertSame('slot-header', Setting::get('adsense_ad_slot_header'));
        $this->assertSame('', Setting::get('adsense_ad_slot_footer'), 'unsent fields must be blanked, not left stale');
    }

    public function test_settings_batch_write_is_atomic(): void
    {
        // Prime the cache so there is a stale snapshot to invalidate.
        Setting::set('a', 'old');
        Setting::get('a');
        $this->assertSame(['a' => 'old'], Cache::get('settings'));

        Setting::setMany([
            'a' => '1',
            'b' => '2',
        ]);

        $this->assertNull(
            Cache::get('settings'),
            'the batch must drop the cache once, not leave a half-written snapshot'
        );

        // The next read rebuilds from a fully committed batch.
        $this->assertSame('1', Setting::get('a'));
        $this->assertSame('2', Setting::get('b'));
    }

    // ---------------------------------------------------------------------
    // Mail deliverability
    // ---------------------------------------------------------------------

    public function test_env_example_documents_the_mail_settings_reset_needs(): void
    {
        $env = (string) file_get_contents(base_path('.env.example'));

        foreach ([
            'MAIL_MAILER',
            'MAIL_HOST',
            'MAIL_PORT',
            'MAIL_USERNAME',
            'MAIL_PASSWORD',
            'MAIL_FROM_ADDRESS',
            'CONTACT_FORM_RECIPIENT',
            'AUTH_PASSWORD_RESET_EXPIRE',
            'SESSION_SECURE_COOKIE',
            'WITHDRAWAL_FEE_PERCENT',
        ] as $key) {
            $this->assertStringContainsString(
                $key.'=',
                $env,
                ".env.example must document {$key}, or nobody can configure it"
            );
        }

        // The example must not ship a placeholder sender, which silently
        // fails SPF/DMARC and sends everything to spam.
        $this->assertStringNotContainsString('hello@example.com', $env);
        $this->assertStringNotContainsString('MAIL_MAILER=log', $env);
    }

    public function test_from_address_is_never_a_placeholder_once_mail_is_real(): void
    {
        // While mail is still going to the log, the placeholder is harmless.
        if (in_array(config('mail.default'), ['log', 'array'], true)) {
            $this->assertTrue(true);

            return;
        }

        $this->assertNotSame(
            'hello@example.com',
            config('mail.from.address'),
            'a placeholder sender will fail SPF/DMARC and land reset links in spam'
        );
        $this->assertNotFalse(
            filter_var(config('mail.from.address'), FILTER_VALIDATE_EMAIL),
            'MAIL_FROM_ADDRESS must be a real address on the sending domain'
        );
    }

    // ---------------------------------------------------------------------
    // Withdrawal config
    // ---------------------------------------------------------------------

    public function test_withdrawal_settings_come_from_config(): void
    {
        $this->assertSame(1.0, (float) config('withdrawals.fee_percent'));
        $this->assertSame(170.0, (float) config('withdrawals.min_amount'));
        $this->assertSame(70000.0, (float) config('withdrawals.max_amount'));
        $this->assertSame(5, (int) config('auth.passwords.users.expire'));
    }

    public function test_configured_withdrawal_limits_are_enforced(): void
    {
        Config::set('withdrawals.min_amount', 500);

        $user = User::factory()->create([
            'is_active' => true, 'email_verified_at' => now(), 'balance' => 1000,
        ]);

        $this->actingAs($user)->post('/withdraw', [
            'amount' => 200, 'payment_method' => 'jazzcash',
            'account_number' => '03001234567', 'account_name' => 'T',
        ])->assertSessionHasErrors('amount');

        $this->assertSame(1000.0, (float) $user->fresh()->balance, 'nothing deducted');
    }
}
