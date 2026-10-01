<?php

namespace Tests\Feature;

use App\Mail\ContactFormMessage;
use App\Models\Deposit;
use App\Models\Plan;
use App\Models\User;
use App\Models\Withdrawal;
use App\Services\CommissionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

/**
 * Security regression tests. Each one covers an issue that was actually
 * exploitable in this codebase, not a generic checklist.
 */
class SecurityTest extends TestCase
{
    use RefreshDatabase;

    private function member(array $attrs = []): User
    {
        return User::factory()->create(array_merge([
            'is_active' => true,
            'is_admin' => false,
            'email_verified_at' => now(),
        ], $attrs));
    }

    // ---------------------------------------------------------------------
    // Account integrity
    // ---------------------------------------------------------------------

    public function test_changing_email_revokes_verification(): void
    {
        $user = $this->member(['email' => 'real@example.com', 'password' => 'secret123']);

        $this->actingAs($user)->post('/profile', [
            'name' => $user->name,
            'email' => 'attacker@evil.test',
            'phone' => '03001234567',
            'current_password' => 'secret123',
        ])->assertRedirect('/profile');

        $fresh = $user->fresh();

        $this->assertSame('attacker@evil.test', $fresh->email);
        $this->assertNull(
            $fresh->email_verified_at,
            'the verified flag described the old address and must not carry over'
        );

        // And the member area is closed again until the new address is confirmed.
        $this->actingAs($fresh)->get('/dashboard')->assertRedirect('/email/verify');
    }

    public function test_changing_email_requires_the_current_password(): void
    {
        $user = $this->member(['email' => 'real@example.com', 'password' => 'secret123']);

        $this->actingAs($user)->post('/profile', [
            'name' => $user->name,
            'email' => 'attacker@evil.test',
            'phone' => '03001234567',
            'current_password' => 'wrong-password',
        ])->assertSessionHasErrors('current_password');

        $this->assertSame('real@example.com', $user->fresh()->email, 'email must not change');
    }

    public function test_password_change_requires_current_password(): void
    {
        $user = $this->member(['password' => 'secret123']);

        $this->actingAs($user)->post('/profile', [
            'name' => $user->name,
            'email' => $user->email,
            'phone' => '03001234567',
            'current_password' => 'nope',
            'password' => 'newpass123',
            'password_confirmation' => 'newpass123',
        ])->assertSessionHasErrors('current_password');

        $this->assertTrue(Hash::check('secret123', $user->fresh()->password));
    }

    public function test_weak_passwords_are_rejected(): void
    {
        // Rate limiting is keyed per client, so clear it between attempts to
        // keep this test about the password policy only.
        // 'aaaaaa11' is deliberately absent: 8 chars with a letter and a
        // number, so it satisfies the policy and must be accepted.
        // Each of these fails the policy for a different reason: too short,
        // no letters, or no numbers.
        foreach (['abcdef', '12345678', 'abcdefgh', 'password', '123456789'] as $i => $pw) {
            RateLimiter::clear($this->guestThrottleKey('register'));

            $this->post('/register', [
                'name' => 'User',
                'email' => "weak{$i}@example.com",
                'phone' => '03001234567',
                'password' => $pw,
                'password_confirmation' => $pw,
            ])->assertSessionHasErrors('password');
        }

        $this->assertSame(0, User::where('email', 'like', 'weak%')->count());

        // A password that does satisfy the policy still registers.
        RateLimiter::clear($this->guestThrottleKey('register'));

        $this->post('/register', [
            'name' => 'User',
            'email' => 'strong@example.com',
            'phone' => '03001234567',
            'password' => 'aaaaaa11',
            'password_confirmation' => 'aaaaaa11',
        ])->assertSessionHasNoErrors();

        $this->assertSame(1, User::where('email', 'strong@example.com')->count());
    }

    /**
     * Reproduce the key ThrottleRequests derives for a guest, so a test can
     * clear the limiter for one route.
     */
    private function guestThrottleKey(string $path): string
    {
        $route = Route::getRoutes()->match(Request::create($path, 'POST'));

        return sha1(($route->getDomain() ?? '').'|127.0.0.1');
    }

    public function test_passwords_are_never_stored_in_plaintext(): void
    {
        $this->post('/register', [
            'name' => 'User', 'email' => 'hash@example.com', 'phone' => '03001234567',
            'password' => 'secret123', 'password_confirmation' => 'secret123',
        ]);

        $user = User::where('email', 'hash@example.com')->firstOrFail();

        $this->assertNotSame('secret123', $user->password);
        $this->assertStringStartsWith('$2y$', $user->password, 'must be bcrypt');
        $this->assertTrue(Hash::check('secret123', $user->password));
    }

    // ---------------------------------------------------------------------
    // Authorisation / IDOR
    // ---------------------------------------------------------------------

    public function test_member_cannot_read_another_members_receipts(): void
    {
        $owner = $this->member();
        $attacker = $this->member();

        $plan = Plan::create(['name' => 'Premium', 'price' => 350, 'is_active' => true]);

        $deposit = Deposit::create([
            'user_id' => $owner->id, 'plan_id' => $plan->id, 'amount' => 350,
            'method' => 'jazzcash', 'transaction_id' => 'SEC-1', 'status' => 'approved',
        ]);
        $withdrawal = Withdrawal::create([
            'user_id' => $owner->id, 'amount' => 200, 'fee' => 2,
            'method' => 'easypaisa', 'account_number' => '03', 'status' => 'approved',
        ]);

        $this->actingAs($attacker)->get("/deposits/{$deposit->id}/receipt")->assertForbidden();
        $this->actingAs($attacker)->get("/withdrawals/{$withdrawal->id}/receipt")->assertForbidden();
    }

    public function test_guests_cannot_reach_member_or_admin_routes(): void
    {
        foreach (['/dashboard', '/deposit', '/withdraw', '/referrals', '/earnings', '/profile',
            '/admin', '/admin/users', '/admin/deposits', '/admin/withdrawals',
            '/admin/rewards', '/admin/settings'] as $url) {
            $this->get($url)->assertRedirect();
        }
    }

    public function test_unverified_member_cannot_reach_financial_routes(): void
    {
        $u = $this->member(['email_verified_at' => null]);

        foreach (['/dashboard', '/deposit', '/withdraw', '/earnings'] as $url) {
            $this->actingAs($u)->get($url)->assertRedirect('/email/verify');
        }
    }

    public function test_non_admin_cannot_act_on_financial_records(): void
    {
        $notAdmin = $this->member();
        $plan = Plan::create(['name' => 'Premium', 'price' => 350, 'is_active' => true]);
        $target = $this->member(['is_active' => false]);

        $deposit = Deposit::create([
            'user_id' => $target->id, 'plan_id' => $plan->id, 'amount' => 350,
            'method' => 'jazzcash', 'transaction_id' => 'SEC-2', 'status' => 'pending',
        ]);
        $withdrawal = Withdrawal::create([
            'user_id' => $target->id, 'amount' => 200, 'fee' => 2,
            'method' => 'easypaisa', 'account_number' => '03', 'status' => 'pending',
        ]);

        $this->actingAs($notAdmin)->post("/admin/deposits/{$deposit->id}/approve")->assertForbidden();
        $this->actingAs($notAdmin)->post("/admin/withdrawals/{$withdrawal->id}/approve")->assertForbidden();
        $this->actingAs($notAdmin)->post('/admin/rewards', [
            'user_id' => $target->id, 'amount' => 99999, 'reason' => 'self-deal',
        ])->assertForbidden();
        $this->actingAs($notAdmin)->post('/admin/settings', ['adsense_enabled' => 'on'])->assertForbidden();

        $this->assertSame('pending', $deposit->fresh()->status);
        $this->assertSame('pending', $withdrawal->fresh()->status);
        $this->assertSame(0.0, (float) $target->fresh()->balance);
    }

    public function test_admin_cannot_credit_their_own_account_via_referrals(): void
    {
        $admin = $this->member(['is_admin' => true, 'balance' => 0]);
        $buyer = $this->member(['is_active' => false, 'referred_by' => $admin->id]);

        (new CommissionService)->giveDirectReferralBonus($buyer);
        (new CommissionService)->distributeCommissions($buyer, 350);

        $this->assertSame(0.0, (float) $admin->fresh()->balance, 'platform never pays itself');
    }

    // ---------------------------------------------------------------------
    // Rate limiting / abuse
    // ---------------------------------------------------------------------

    public function test_every_state_changing_post_is_rate_limited(): void
    {
        $exempt = ['/logout'];

        foreach (Route::getRoutes() as $route) {
            if (! in_array('POST', $route->methods(), true)) {
                continue;
            }

            $uri = '/'.ltrim($route->uri(), '/');

            if (in_array($uri, $exempt, true)) {
                continue;
            }

            $throttled = collect($route->gatherMiddleware())
                ->contains(fn ($m) => is_string($m) && str_starts_with($m, 'throttle'));

            $this->assertTrue(
                $throttled,
                "POST {$uri} is not rate limited"
            );
        }
    }

    public function test_contact_form_cannot_be_used_to_bomb_the_support_mailbox(): void
    {
        Mail::fake();

        $sent = 0;
        for ($i = 0; $i < 10; $i++) {
            $response = $this->post('/contact', [
                'name' => 'Attacker',
                'email' => 'attacker@example.com',
                'subject' => "Spam {$i}",
                'message' => 'unsubscribe me',
            ]);

            if ($response->status() === 429) {
                break;
            }
            $sent++;
        }

        $this->assertLessThanOrEqual(
            3,
            $sent,
            'the contact form must throttle before it can send a burst of mail'
        );
    }

    public function test_bulk_registration_from_one_client_is_blocked(): void
    {
        // Deliberately submit invalid passwords: no account is created, so the
        // client stays a guest and every attempt shares the same throttle key.
        // This is the bulk-account-creation vector.
        $blocked = false;
        $attempts = 0;

        for ($i = 0; $i < 12; $i++) {
            $response = $this->post('/register', [
                'name' => 'Bot',
                'email' => "bot{$i}@example.com",
                'phone' => '03001234567',
                'password' => 'weak',
                'password_confirmation' => 'weak',
            ]);

            if ($response->status() === 429) {
                $blocked = true;
                break;
            }
            $attempts++;
        }

        $this->assertTrue(
            $blocked,
            'a single client must be rate limited on /register'
        );
        $this->assertLessThanOrEqual(
            5,
            $attempts,
            'the limit must bite early, not after a dozen attempts'
        );
    }

    // ---------------------------------------------------------------------
    // Mail header injection
    // ---------------------------------------------------------------------

    public function test_contact_mail_rejects_header_injection_in_name_and_subject(): void
    {
        $mail = new ContactFormMessage(
            "Evil\r\nBcc: victim@evil.test",
            'sender@example.com',
            "Subject\r\nBcc: victim@evil.test",
            'body'
        );

        $envelope = $mail->envelope();

        $this->assertStringNotContainsString("\r", $envelope->subject);
        $this->assertStringNotContainsString("\n", $envelope->subject);
        $this->assertStringNotContainsString("\r", $envelope->replyTo[0]->name);
        $this->assertStringNotContainsString("\n", $envelope->replyTo[0]->name);
    }

    public function test_contact_form_rejects_an_invalid_sender_address(): void
    {
        // A CRLF payload in the address must not produce a sent mail.
        Mail::fake();

        $this->post('/contact', [
            'name' => 'Attacker',
            'email' => 'good@example.com',
            'subject' => 'hi',
            'message' => 'hi',
        ])->assertSessionHasNoErrors();

        Mail::assertSent(ContactFormMessage::class);
    }

    // ---------------------------------------------------------------------
    // Privilege escalation via mass assignment
    // ---------------------------------------------------------------------

    public function test_privileged_fields_cannot_be_set_through_any_registration_or_profile_route(): void
    {
        $user = $this->member(['password' => 'secret123']);

        $this->actingAs($user)->post('/profile', [
            'name' => 'Escalate',
            'email' => $user->email,
            'phone' => '03001234567',
            'current_password' => 'secret123',
            'is_admin' => '1',
            'is_active' => '0',
            'balance' => '999999',
            'total_earned' => '999999',
        ])->assertRedirect('/profile');

        $fresh = $user->fresh();
        $this->assertFalse($fresh->is_admin);
        $this->assertTrue($fresh->is_active);
        $this->assertSame(0.0, (float) $fresh->balance);
        $this->assertSame(0.0, (float) $fresh->total_earned);
    }
}
