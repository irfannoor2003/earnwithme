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

    public function test_first_approved_deposit_pays_direct_bonus_once(): void
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

        $this->actingAs($admin)
            ->post(route('admin.deposits.approve', $deposit))
            ->assertSessionHasNoErrors();

        $this->assertSame('130.00', $referrer->fresh()->balance);
        $this->assertSame(2, Commission::where('from_user_id', $buyer->id)->count());

        $this->actingAs($admin)
            ->post(route('admin.deposits.approve', $deposit))
            ->assertSessionHas('error');

        $this->assertSame('130.00', $referrer->fresh()->balance);
        $this->assertSame(2, Commission::where('from_user_id', $buyer->id)->count());
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
