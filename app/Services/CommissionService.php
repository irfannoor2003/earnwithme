<?php

namespace App\Services;

use App\Models\Commission;
use App\Models\User;

class CommissionService
{
    /**
     * Commission paid per approved sale, per level.
     *
     * These figures are the platform's cost of doing business. They must sum
     * to less than the plan price or the platform pays out more than it
     * takes in, so see totalLiabilityPerSale() and marginFor().
     */
    const LEVEL_AMOUNTS = [
        1 => 110,  // Rs 110
        2 => 50,   // Rs 50
        3 => 30,   // Rs 30
        4 => 20,   // Rs 20
        5 => 10,   // Rs 10
        6 => 10,   // Rs 10
        7 => 10,   // Rs 10
    ];

    const DIRECT_REFERRAL_BONUS = 20; // Rs 20 one-time bonus for new user

    /**
     * Deepest level the platform ever pays. Drives both the payout walk and
     * the team tree rendered to members, so the two cannot drift apart.
     */
    const MAX_LEVEL = 7;

    /**
     * Worst-case commission cost of one fully-populated 7-level chain.
     *
     * 240 (levels) + 20 (signup bonus) = Rs 260. A shorter chain costs less,
     * so this is the ceiling the plan price has to clear.
     */
    public static function totalLiabilityPerSale(): float
    {
        return round(array_sum(self::LEVEL_AMOUNTS) + self::DIRECT_REFERRAL_BONUS, 2);
    }

    /**
     * Platform margin retained on a sale of the given plan price.
     *
     * Negative means the platform would pay out more than it collected.
     */
    public static function marginFor(float $planPrice): float
    {
        return round($planPrice - self::totalLiabilityPerSale(), 2);
    }

    public function distributeCommissions(User $buyer, float $planPrice): array
    {
        $commissions = [];
        $currentUser = $buyer;

        foreach (self::LEVEL_AMOUNTS as $level => $amount) {
            $referrer = $currentUser->referrer;

            if (! $referrer) {
                break;
            }

            // Inactive users and admins cannot earn commissions, but the walk
            // continues through them: an inactive member still sits between
            // the buyer and the upline, so levels above are unaffected.
            if ($referrer->is_active && ! $referrer->is_admin && $amount > 0) {
                Commission::create([
                    'from_user_id' => $buyer->id,
                    'to_user_id' => $referrer->id,
                    'level' => $level,
                    'amount' => $amount,
                    'plan_price' => $planPrice,
                ]);

                $referrer->increment('balance', $amount);
                $referrer->increment('total_earned', $amount);

                $commissions[] = [
                    'user' => $referrer,
                    'level' => $level,
                    'amount' => $amount,
                ];
            }

            $currentUser = $referrer;
        }

        return $commissions;
    }

    public function giveDirectReferralBonus(User $newUser): void
    {
        $referrer = $newUser->referrer;

        if (! $referrer || ! $referrer->is_active || $referrer->is_admin) {
            return;
        }

        $alreadyPaid = Commission::where('from_user_id', $newUser->id)
            ->where('to_user_id', $referrer->id)
            ->where('level', 1)
            ->where('plan_price', 0)
            ->exists();

        if ($alreadyPaid) {
            return;
        }

        $bonus = self::DIRECT_REFERRAL_BONUS;

        Commission::create([
            'from_user_id' => $newUser->id,
            'to_user_id' => $referrer->id,
            'level' => 1,
            'amount' => $bonus,
            'plan_price' => 0,
        ]);

        $referrer->increment('balance', $bonus);
        $referrer->increment('total_earned', $bonus);
    }
}
