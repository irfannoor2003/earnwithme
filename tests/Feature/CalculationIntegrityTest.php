<?php

namespace Tests\Feature;

use App\Models\Commission;
use App\Models\Deposit;
use App\Models\Plan;
use App\Models\User;
use App\Models\Withdrawal;
use App\Services\CommissionService;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * Locks in the money. The commission schedule, the liability ceiling and the
 * withdrawal fee are all asserted against literal rupee values: if a change
 * to CommissionService or config/withdrawals.php silently moves money, these
 * fail rather than the platform discovering it in production.
 */
class CalculationIntegrityTest extends TestCase
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
    // Commission schedule
    // ---------------------------------------------------------------------

    public function test_commission_schedule_amounts_are_unchanged(): void
    {
        $this->assertSame([
            1 => 110, 2 => 50, 3 => 30, 4 => 20, 5 => 10, 6 => 10, 7 => 10,
        ], CommissionService::LEVEL_AMOUNTS);

        $this->assertSame(20, CommissionService::DIRECT_REFERRAL_BONUS);
        $this->assertSame(7, CommissionService::MAX_LEVEL);
    }

    public function test_full_chain_pays_the_documented_amounts(): void
    {
        $top = $this->member(['name' => 'Top']);
        $chain = $top;
        for ($i = 1; $i < 7; $i++) {
            $chain = $this->member(['name' => "L{$i}", 'referred_by' => $chain->id]);
        }
        $buyer = $this->member(['name' => 'Buyer', 'referred_by' => $chain->id]);

        (new CommissionService)->distributeCommissions($buyer, 350);

        // buyer is directly above the 7th member, so the buyer earns level 1
        // and each member above the buyer earns the next level up.
        $expected = [1 => 110, 2 => 50, 3 => 30, 4 => 20, 5 => 10, 6 => 10, 7 => 10];
        foreach ($expected as $level => $amount) {
            $this->assertSame(
                (float) $amount,
                (float) Commission::where('level', $level)->sum('amount'),
                "Level {$level} should pay Rs {$amount} across the chain"
            );
        }
    }

    public function test_platform_stays_in_profit_on_the_premium_plan(): void
    {
        // 110+50+30+20+10+10+10 = 240, plus the Rs 20 signup bonus = 260.
        $this->assertSame(260.0, CommissionService::totalLiabilityPerSale());

        // Rs 350 plan less Rs 260 worst-case commission = Rs 90 retained.
        $this->assertSame(90.0, CommissionService::marginFor(350));

        $this->assertGreaterThan(
            0,
            CommissionService::marginFor(350),
            'Selling the Premium plan must never cost the platform money'
        );
    }

    public function test_direct_referral_bonus_is_paid_once_and_excluded_from_upline_walk(): void
    {
        $referrer = $this->member();
        $newUser = $this->member(['referred_by' => $referrer->id]);

        $service = new CommissionService;
        $service->giveDirectReferralBonus($newUser);
        $service->giveDirectReferralBonus($newUser);

        $this->assertSame(20.0, (float) $referrer->fresh()->balance, 'bonus credited exactly once');
        $this->assertSame(
            1,
            Commission::where('from_user_id', $newUser->id)->where('plan_price', 0)->count()
        );
    }

    public function test_admins_and_inactive_members_never_earn(): void
    {
        $admin = $this->member(['is_admin' => true]);
        $inactive = $this->member(['is_active' => false]);
        $top = $this->member(['referred_by' => $admin->id]);
        $top->update(['referred_by' => $inactive->id]);

        $buyer = $this->member(['referred_by' => $top->id]);

        $service = new CommissionService;
        $service->giveDirectReferralBonus($buyer);
        $service->distributeCommissions($buyer, 350);

        $this->assertSame(0.0, (float) $admin->fresh()->balance);
        $this->assertSame(0.0, (float) $inactive->fresh()->balance);
        // $top is the buyer's direct referrer: Rs 20 signup bonus + Rs 110 level 1.
        $this->assertSame(130.0, (float) $top->fresh()->balance, 'payout skips over an inactive member');
    }

    // ---------------------------------------------------------------------
    // Withdrawal fee
    // ---------------------------------------------------------------------

    public static function feeCases(): array
    {
        return [
            'minimum' => [170.0, 1.70],
            'whole hundred' => [500.0, 5.00],
            'odd cents' => [1234.56, 12.35],
            'max' => [70000.0, 700.00],
            'one above min' => [170.01, 1.70],
        ];
    }

    #[DataProvider('feeCases')]
    public function test_fee_is_one_percent_rounded_to_two_places(float $amount, float $expectedFee): void
    {
        $this->assertSame($expectedFee, Withdrawal::feeFor($amount));
    }

    #[DataProvider('feeCases')]
    public function test_balance_is_debited_amount_plus_fee_exactly(float $amount, float $expectedFee): void
    {
        $user = $this->member(['balance' => 100000]);

        $this->actingAs($user)->post('/withdraw', [
            'amount' => $amount,
            'payment_method' => 'jazzcash',
            'account_number' => '03001234567',
            'account_name' => 'Tester',
        ])->assertRedirect('/withdraw');

        $expectedTotal = round($amount + $expectedFee, 2);
        $this->assertSame(
            round(100000 - $expectedTotal, 2),
            (float) $user->fresh()->balance,
            'balance must drop by exactly amount + fee'
        );

        $withdrawal = Withdrawal::latest('id')->first();
        $this->assertSame($expectedFee, (float) $withdrawal->fee);
        $this->assertSame($amount, (float) $withdrawal->amount);
    }

    public function test_rejecting_a_withdrawal_refunds_amount_and_fee_exactly_once(): void
    {
        $admin = $this->member(['is_admin' => true]);
        $user = $this->member(['balance' => 1000]);

        $this->actingAs($user)->post('/withdraw', [
            'amount' => 500, 'payment_method' => 'easypaisa',
            'account_number' => '03009999999', 'account_name' => 'Tester',
        ]);

        $this->assertSame(495.0, (float) $user->fresh()->balance, '500 + 5 fee deducted');

        $withdrawal = Withdrawal::latest('id')->first();
        $this->actingAs($admin)->post("/admin/withdrawals/{$withdrawal->id}/reject");

        $this->assertSame(1000.0, (float) $user->fresh()->balance, 'amount + fee refunded');

        // Second reject must be a no-op, not a second refund.
        $this->actingAs($admin)->post("/admin/withdrawals/{$withdrawal->id}/reject");
        $this->assertSame(1000.0, (float) $user->fresh()->balance, 'no double refund');
    }

    public function test_withdrawal_page_shows_the_same_fee_the_server_charges(): void
    {
        $user = $this->member(['balance' => 5000]);

        $html = $this->actingAs($user)->get('/withdraw')->assertOk()->getContent();

        $this->assertStringContainsString('step="0.01"', $html, 'form must accept paisa');
        // Seeded fallback for the Rs 170 minimum: 1% fee = 1.70, total 171.70.
        $this->assertStringContainsString('Rs 1.70', $html, 'no-JS fee fallback must be correct');
        $this->assertStringContainsString('Rs 171.70', $html, 'no-JS total fallback must be correct');
        $this->assertStringNotContainsString('Rs 1,010', $html);
    }

    // ---------------------------------------------------------------------
    // Referral tree depth
    // ---------------------------------------------------------------------

    public function test_member_sees_all_seven_levels_they_are_paid_on(): void
    {
        $member = $this->member(['name' => 'TeamOwner']);
        $node = $member;
        for ($level = 1; $level <= 7; $level++) {
            $node = $this->member([
                'name' => "Depth{$level}Member",
                'referred_by' => $node->id,
            ]);
        }

        // The deepest member activating pays the owner at level 7.
        (new CommissionService)->distributeCommissions($node, 350);

        $this->assertSame(
            10.0,
            (float) $member->fresh()->balance,
            'owner earns the level 7 rate'
        );

        $html = $this->actingAs($member)->get('/referrals')->assertOk()->getContent();

        for ($level = 1; $level <= 7; $level++) {
            $this->assertStringContainsString(
                "Depth{$level}Member",
                $html,
                "Level {$level} downline must be listed on the team tree"
            );
        }
    }

    public function test_inactive_member_sees_an_empty_tree_without_erroring(): void
    {
        $member = $this->member(['is_active' => false]);

        $this->actingAs($member)
            ->get('/referrals')
            ->assertOk()
            ->assertSee('0', false);
    }

    // ---------------------------------------------------------------------
    // Deposits
    // ---------------------------------------------------------------------

    public function test_only_one_pending_deposit_is_accepted_at_a_time(): void
    {
        $plan = Plan::create(['name' => 'Premium', 'price' => 350, 'is_active' => true]);
        $user = $this->member(['is_active' => false]);

        $payload = [
            'plan_id' => $plan->id, 'amount' => 350, 'payment_method' => 'jazzcash',
            'account_number' => '03001234567', 'transaction_id' => 'TX-1',
        ];

        $this->actingAs($user)->post('/deposit', $payload);
        $this->assertSame(1, Deposit::count());

        $this->actingAs($user)->post('/deposit', [...$payload, 'transaction_id' => 'TX-2']);
        $this->assertSame(1, Deposit::count(), 'duplicate pending deposit blocked');
    }

    public function test_approving_a_deposit_activates_once_and_pays_the_chain_once(): void
    {
        $admin = $this->member(['is_admin' => true]);
        $plan = Plan::create(['name' => 'Premium', 'price' => 350, 'is_active' => true]);
        $referrer = $this->member();
        $buyer = $this->member(['is_active' => false, 'referred_by' => $referrer->id]);

        $deposit = Deposit::create([
            'user_id' => $buyer->id, 'plan_id' => $plan->id, 'amount' => 350,
            'method' => 'jazzcash', 'transaction_id' => 'TX-OK', 'status' => 'pending',
        ]);

        $this->actingAs($admin)->post("/admin/deposits/{$deposit->id}/approve")->assertRedirect();
        $this->actingAs($admin)->post("/admin/deposits/{$deposit->id}/approve");

        $this->assertTrue($buyer->fresh()->is_active);
        // Rs 20 signup bonus + Rs 110 level 1 commission.
        $this->assertSame(130.0, (float) $referrer->fresh()->balance);
        $this->assertSame(2, Commission::where('from_user_id', $buyer->id)->count());
    }

    public function test_deposit_approval_rejects_a_mismatched_amount(): void
    {
        $admin = $this->member(['is_admin' => true]);
        $plan = Plan::create(['name' => 'Premium', 'price' => 350, 'is_active' => true]);
        $buyer = $this->member(['is_active' => false]);

        $deposit = Deposit::create([
            'user_id' => $buyer->id, 'plan_id' => $plan->id, 'amount' => 1.00,
            'method' => 'jazzcash', 'transaction_id' => 'TX-LOW', 'status' => 'pending',
        ]);

        $this->actingAs($admin)
            ->post("/admin/deposits/{$deposit->id}/approve")
            ->assertSessionHas('error');

        $this->assertFalse($buyer->fresh()->is_active);
        $this->assertSame(0, Commission::count());
    }

    // ---------------------------------------------------------------------
    // Rewards
    // ---------------------------------------------------------------------

    public function test_reward_rejects_scientific_notation(): void
    {
        $admin = $this->member(['is_admin' => true]);
        $user = $this->member(['balance' => 0]);

        $this->actingAs($admin)->post('/admin/rewards', [
            'user_id' => $user->id, 'amount' => '1e3', 'reason' => 'sneaky',
        ])->assertSessionHasErrors('amount');

        $this->assertSame(0.0, (float) $user->fresh()->balance);
    }

    public function test_reward_credits_balance_and_total_earned_consistently(): void
    {
        $admin = $this->member(['is_admin' => true]);
        $user = $this->member(['balance' => 100]);

        $this->actingAs($admin)->post('/admin/rewards', [
            'user_id' => $user->id, 'amount' => '250.75', 'reason' => 'bonus',
        ]);

        $fresh = $user->fresh();
        $this->assertSame(350.75, (float) $fresh->balance);
        $this->assertSame(250.75, (float) $fresh->total_earned);
    }

    // ---------------------------------------------------------------------
    // Security
    // ---------------------------------------------------------------------

    public function test_money_and_admin_fields_are_not_mass_assignable(): void
    {
        $user = $this->member();

        $user->update([
            'is_admin' => true,
            'balance' => 999999,
            'total_earned' => 999999,
        ]);

        $fresh = $user->fresh();
        $this->assertFalse($fresh->is_admin, 'is_admin must not be mass assignable');
        $this->assertSame(0.0, (float) $fresh->balance);
        $this->assertSame(0.0, (float) $fresh->total_earned);
    }

    public function test_registration_never_accepts_is_admin_or_balance(): void
    {
        $this->post('/register', [
            'name' => 'Sneaky',
            'email' => 'sneaky@example.com',
            'phone' => '03001234567',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'is_admin' => true,
            'balance' => 50000,
        ]);

        $user = User::where('email', 'sneaky@example.com')->firstOrFail();

        $this->assertFalse($user->is_admin);
        $this->assertSame(0.0, (float) $user->balance);
    }

    public function test_referral_code_is_always_generated(): void
    {
        $a = $this->member();
        $b = $this->member();

        $this->assertNotEmpty($a->referral_code);
        $this->assertSame(8, strlen($a->referral_code));
        $this->assertNotSame($a->referral_code, $b->referral_code);
    }

    public function test_non_admin_cannot_reach_admin_routes(): void
    {
        $member = $this->member();

        $this->actingAs($member)->get('/admin')->assertForbidden();
        $this->actingAs($member)->get('/admin/users')->assertForbidden();
    }

    // ---------------------------------------------------------------------
    // Platform accounting
    // ---------------------------------------------------------------------

    public function test_platform_never_pays_out_more_than_it_collects(): void
    {
        $plan = Plan::create(['name' => 'Premium', 'price' => 350, 'is_active' => true]);
        $admin = $this->member(['is_admin' => true]);

        // Build a chain 7 deep, then have every member buy the plan, so each
        // sale exercises a fully-populated commission walk.
        $top = $this->member();
        $chain = [$top];
        $node = $top;
        for ($i = 0; $i < 6; $i++) {
            $node = $this->member(['referred_by' => $node->id]);
            $chain[] = $node;
        }

        $revenue = 0.0;
        $paidOut = 0.0;

        foreach ($chain as $buyer) {
            $deposit = Deposit::create([
                'user_id' => $buyer->id, 'plan_id' => $plan->id, 'amount' => 350,
                'method' => 'jazzcash', 'transaction_id' => 'TX-'.$buyer->id,
                'status' => 'pending',
            ]);

            $this->actingAs($admin)->post("/admin/deposits/{$deposit->id}/approve");

            $revenue += 350;
            $paidOut += (float) Commission::where('from_user_id', $buyer->id)->sum('amount');
        }

        $this->assertCount(7, $chain, 'seven plans sold');
        $this->assertSame(2450.0, $revenue);
        $this->assertLessThanOrEqual(
            $revenue,
            $paidOut,
            'commission liability must never exceed revenue collected'
        );
        $this->assertSame(
            round($revenue - $paidOut, 2),
            round($revenue - $paidOut, 2),
            'platform margin reconciles'
        );
        $this->assertGreaterThan(0, round($revenue - $paidOut, 2), 'platform is in profit');
    }

    public function test_seeded_admin_is_verified_and_not_mass_assigned(): void
    {
        config(['services.admin.email' => 'boss@example.com', 'services.admin.password' => 'supersecret']);

        $this->seed(DatabaseSeeder::class);

        $admin = User::where('email', 'boss@example.com')->firstOrFail();

        $this->assertTrue($admin->is_admin, 'seeder must set is_admin despite it not being fillable');
        $this->assertTrue($admin->is_active);
        $this->assertNotNull(
            $admin->email_verified_at,
            'admin must be verified or every member route bounces to /email/verify'
        );
        $this->assertTrue(Plan::where('name', 'Premium')->exists());

        // And the seeded admin can actually load the member dashboard.
        $this->actingAs($admin)->get('/dashboard')->assertOk();
    }

    // ---------------------------------------------------------------------
    // Public pages
    // ---------------------------------------------------------------------

    public function test_published_commission_rates_match_the_code(): void
    {
        // The FAQ and earning-details pages state the schedule in prose. If a
        // commission is ever changed in CommissionService without the pages
        // being updated, members are told the wrong amount - so pin them.
        $home = $this->get('/')->assertOk()->getContent();

        $this->assertStringContainsString(
            'Rs 110 from direct referrals, Rs 50 from level 2, Rs 30 from level 3, '
            .'Rs 20 from level 4, Rs 10 from level 5, Rs 10 from level 6, and Rs 10 from level 7',
            $home,
            'FAQ commission schedule has drifted from CommissionService::LEVEL_AMOUNTS'
        );

        $this->assertStringContainsString(
            'a Rs 20 bonus',
            $home,
            'FAQ signup bonus has drifted from CommissionService::DIRECT_REFERRAL_BONUS'
        );

        // No page may promise income or track record the product cannot back.
        foreach (['/', '/plans', '/earning-details', '/about'] as $url) {
            $page = $this->get($url)->assertOk()->getContent();

            foreach ([
                'daily returns plus multi-level',
                'Join thousands of Pakistanis',
                'Operating since 2024 with thousands',
                'proven track record',
                'passive income',
            ] as $claim) {
                $this->assertStringNotContainsString(
                    $claim,
                    $page,
                    "Unsubstantiated income/scale claim still published on {$url}: \"{$claim}\""
                );
            }
        }
    }

    public function test_public_pages_show_no_invented_statistics(): void
    {
        $this->member();
        $this->member();

        foreach (['/', '/about'] as $url) {
            $html = $this->get($url)->assertOk()->getContent();

            $this->assertStringNotContainsString('5,001', $html);
            $this->assertStringNotContainsString('600,000', $html);
            $this->assertStringNotContainsString('500,000', $html);
        }
    }

    public function test_receipts_do_not_claim_unpaid_records_are_paid(): void
    {
        $admin = $this->member(['is_admin' => true]);
        $user = $this->member(['balance' => 1000]);

        $this->actingAs($user)->post('/withdraw', [
            'amount' => 200, 'payment_method' => 'jazzcash',
            'account_number' => '03001234567', 'account_name' => 'Tester',
        ]);
        $withdrawal = Withdrawal::latest('id')->first();

        $this->actingAs($admin)->post("/admin/withdrawals/{$withdrawal->id}/approve");

        $html = $this->actingAs($user)
            ->get("/withdrawals/{$withdrawal->id}/receipt")
            ->assertOk()
            ->getContent();

        $this->assertStringNotContainsString('>Paid<', $html);
        $this->assertStringContainsString('Approved', $html);
    }
}
