<?php

namespace Tests\Feature;

use App\Mail\ContactFormMessage;
use App\Models\Commission;
use App\Models\Deposit;
use App\Models\Plan;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class FinancialFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_deposit_amount_must_match_selected_plan_price(): void
    {
        $user = User::factory()->create();
        $plan = Plan::create([
            'name' => 'Premium',
            'price' => 350,
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)
            ->from(route('deposit'))
            ->post(route('deposit.store'), [
                'plan_id' => $plan->id,
                'amount' => 170,
                'payment_method' => 'jazzcash',
                'account_number' => '03001234567',
                'transaction_id' => 'TX-UNDERPAY',
            ]);

        $response->assertSessionHasErrors('amount');
        $this->assertDatabaseCount('deposits', 0);
    }

    public function test_payment_transaction_id_cannot_be_reused_by_another_user(): void
    {
        $firstUser = User::factory()->create();
        $secondUser = User::factory()->create();
        $plan = Plan::create([
            'name' => 'Premium',
            'price' => 350,
            'is_active' => true,
        ]);
        $depositData = [
            'plan_id' => $plan->id,
            'amount' => 350,
            'payment_method' => 'jazzcash',
            'account_number' => '03001234567',
            'transaction_id' => 'TX-REUSED',
        ];

        $this->actingAs($firstUser)
            ->post(route('deposit.store'), $depositData)
            ->assertSessionHasNoErrors();

        $response = $this->actingAs($secondUser)
            ->from(route('deposit'))
            ->post(route('deposit.store'), $depositData);

        $response->assertSessionHasErrors('transaction_id');
        $this->assertDatabaseCount('deposits', 1);
    }

    public function test_rejecting_withdrawal_refunds_fee_once_and_only_while_pending(): void
    {
        $user = User::factory()->create(['balance' => 298]);
        $admin = User::factory()->create(['is_admin' => true]);
        $withdrawal = Withdrawal::create([
            'user_id' => $user->id,
            'amount' => 200,
            'fee' => 2,
            'method' => 'jazzcash',
            'account_number' => '03001234567',
            'status' => 'pending',
        ]);

        $this->actingAs($admin)
            ->post(route('admin.withdrawals.reject', $withdrawal))
            ->assertSessionHasNoErrors();

        $this->assertSame('500.00', $user->fresh()->balance);

        $this->actingAs($admin)
            ->post(route('admin.withdrawals.reject', $withdrawal))
            ->assertSessionHas('error');

        $this->assertSame('500.00', $user->fresh()->balance);
    }

    /**
     * The commission path is the whole business: money only ever moves because
     * an admin approved a deposit. These lock that down.
 */
public function test_commission_is_paid_exactly_once_on_approval(): void
    {
        [$referrer, $buyer, $admin, $deposit] = $this->activationFixture();

        $this->actingAs($admin)
            ->post(route('admin.deposits.approve', $deposit))
            ->assertSessionHasNoErrors();

        $this->assertSame('110.00', $referrer->fresh()->balance, 'level 1 only, no signup bonus on top');
        $this->assertSame(1, Commission::where('from_user_id', $buyer->id)->count());

        // A second approve of the same deposit must not pay again.
        $this->actingAs($admin)
            ->post(route('admin.deposits.approve', $deposit))
            ->assertSessionHas('error');

        $this->assertSame('110.00', $referrer->fresh()->balance);
        $this->assertSame(1, Commission::where('from_user_id', $buyer->id)->count());
    }

    public function test_no_commission_while_the_deposit_is_still_pending(): void
    {
        [$referrer, $buyer, , $deposit] = $this->activationFixture();

        $this->assertSame('pending', $deposit->fresh()->status);
        $this->assertFalse($buyer->fresh()->is_active);

        $this->assertSame(0.0, (float) $referrer->fresh()->balance, 'nothing is paid before approval');
        $this->assertSame(0.0, (float) $referrer->fresh()->total_earned);
        $this->assertSame(0, Commission::count(), 'no commission row may exist yet');
    }

    public function test_a_rejected_deposit_pays_nobody_and_activates_nobody(): void
    {
        [$referrer, $buyer, $admin, $deposit] = $this->activationFixture();

        $this->actingAs($admin)
            ->post(route('admin.deposits.reject', $deposit))
            ->assertSessionHasNoErrors();

        $this->assertSame('rejected', $deposit->fresh()->status);
        $this->assertFalse($buyer->fresh()->is_active, 'a rejected payment must not activate the plan');
        $this->assertSame(0.0, (float) $referrer->fresh()->balance);
        $this->assertSame(0, Commission::count());

        // And the rejected deposit can never be approved afterwards.
        $this->actingAs($admin)->post(route('admin.deposits.approve', $deposit));
        $this->assertSame(0.0, (float) $referrer->fresh()->balance);
    }

    public function test_a_short_deposit_pays_nobody(): void
    {
        [$referrer, $buyer, $admin, $deposit] = $this->activationFixture();

        // Underpay for the plan: Rs 1 instead of Rs 350.
        $deposit->update(['amount' => 1.00]);

        $this->actingAs($admin)
            ->post(route('admin.deposits.approve', $deposit))
            ->assertSessionHas('error');

        $this->assertSame('pending', $deposit->fresh()->status, 'a mismatched deposit must not be approved');
        $this->assertFalse($buyer->fresh()->is_active);
        $this->assertSame(0.0, (float) $referrer->fresh()->balance);
        $this->assertSame(0, Commission::count());
    }

    public function test_a_member_cannot_approve_their_own_deposit(): void
    {
        [$referrer, $buyer, , $deposit] = $this->activationFixture();

        $this->actingAs($buyer)
            ->post(route('admin.deposits.approve', $deposit))
            ->assertForbidden();

        $this->assertSame('pending', $deposit->fresh()->status);
        $this->assertFalse($buyer->fresh()->is_active);
        $this->assertSame(0.0, (float) $referrer->fresh()->balance);
        $this->assertSame(0, Commission::count());
    }

    /**
     * A referrer, an inactive buyer who signed up under them, an admin, and a
     * pending deposit of the correct amount for the Premium plan.
     *
     * @return array{0: User, 1: User, 2: User, 3: Deposit}
     */
    private function activationFixture(): array
    {
        $referrer = User::factory()->create(['is_active' => true]);
        $buyer = User::factory()->create([
            'is_active' => false,
            'referred_by' => $referrer->id,
        ]);
        $admin = User::factory()->create(['is_admin' => true]);
        $plan = Plan::create([
            'name' => 'Premium',
            'price' => 350,
            'is_active' => true,
        ]);
        $deposit = Deposit::create([
            'user_id' => $buyer->id,
            'plan_id' => $plan->id,
            'amount' => $plan->price,
            'method' => 'jazzcash',
            'account_number' => '03001234567',
            'transaction_id' => 'TX-APPROVE',
            'status' => 'pending',
        ]);

        return [$referrer, $buyer, $admin, $deposit];
    }

    public function test_contact_form_sends_the_message_to_support(): void
    {
        Mail::fake();

        $this->post(route('contact.store'), [
            'name' => 'Test Sender',
            'email' => 'sender@example.test',
            'subject' => 'Skills inquiry',
            'message' => 'I would like to learn more.',
        ])->assertSessionHas('success');

        Mail::assertSent(ContactFormMessage::class, function ($mail) {
            return $mail->senderEmail === 'sender@example.test'
                && $mail->messageSubject === 'Skills inquiry';
        });
    }

    public function test_registration_sends_email_verification_notification(): void
    {
        Notification::fake();

        $this->post('/register', [
            'name' => 'New Member',
            'email' => 'new-member@example.test',
            'phone' => '03001234567',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ])->assertRedirect(route('dashboard'));

        Notification::assertSentTo(User::where('email', 'new-member@example.test')->firstOrFail(), VerifyEmail::class);
    }

    public function test_unverified_users_cannot_access_the_dashboard(): void
    {
        $user = User::factory()->unverified()->create();

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertRedirect(route('verification.notice'));
    }
}
