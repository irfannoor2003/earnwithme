<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\CommissionService;

class ReferralController extends Controller
{
    public function index()
    {
        if (auth()->user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        $user = auth()->user()->load('referrals.plan');

        $totalReferrals = 0;
        $activeReferrals = 0;
        $levels = array_fill(1, CommissionService::MAX_LEVEL, collect());

        if ($user->is_active) {
            $levels[1] = $user->referrals;

            for ($level = 2; $level <= CommissionService::MAX_LEVEL; $level++) {
                $levels[$level] = $this->getLevelReferrals($levels[$level - 1]);
            }

            $totalReferrals = $user->getTotalReferrals();
            $activeReferrals = $user->getActiveDirectReferrals();
        }

        $level1 = $levels[1];
        $level2 = $levels[2];
        $level3 = $levels[3];
        $level4 = $levels[4];
        $level5 = $levels[5];

        return view('referrals', [
            'user' => $user,
            'level1' => $level1,
            'level2' => $level2,
            'level3' => $level3,
            'level4' => $level4,
            'level5' => $level5,
            'level6' => $levels[6],
            'level7' => $levels[7],
            'totalReferrals' => $totalReferrals,
            'activeReferrals' => $activeReferrals,
        ]);
    }

    private function getLevelReferrals($parents)
    {
        $parentIds = $parents->pluck('id');

        if ($parentIds->isEmpty()) {
            return collect();
        }

        return User::whereIn('referred_by', $parentIds)->get();
    }
}
