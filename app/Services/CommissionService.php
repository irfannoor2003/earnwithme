<?php

namespace App\Services;

use App\Models\Commission;
use App\Models\User;

class CommissionService
{
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

    public function distributeCommissions(User $buyer, float $planPrice): array
    {
        $commissions = [];
        $currentUser = $buyer;

        foreach (self::LEVEL_AMOUNTS as $level => $amount) {
            $referrer = $currentUser->referrer;

            if (!$referrer) {
                break;
            }

            // Inactive users and admins cannot earn commissions
            if ($referrer->is_active && !$referrer->is_admin && $amount > 0) {
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

        if (!$referrer || !$referrer->is_active || $referrer->is_admin) {
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
