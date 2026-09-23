<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function index()
    {
        if (auth()->user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        $user = auth()->user()->load('referrals.plan');
        
        if (!$user->is_active) {
            $totalReferrals = 0;
            $activeReferrals = 0;
            $level1 = collect();
            $level2 = collect();
            $level3 = collect();
            $level4 = collect();
            $level5 = collect();
            
            return view('referrals', compact('user', 'level1', 'level2', 'level3', 'level4', 'level5', 'totalReferrals', 'activeReferrals'));
        }

        $level1 = $user->referrals;
        $level2 = $this->getLevelReferrals($level1);
        $level3 = $this->getLevelReferrals($level2);
        $level4 = $this->getLevelReferrals($level3);
        $level5 = $this->getLevelReferrals($level4);

        $totalReferrals = $user->getTotalReferrals();
        $activeReferrals = $user->getActiveDirectReferrals();

        return view('referrals', compact('user', 'level1', 'level2', 'level3', 'level4', 'level5', 'totalReferrals', 'activeReferrals'));
    }

    private function getLevelReferrals($parents)
    {
        $parentIds = $parents->pluck('id');
        return \App\Models\User::whereIn('referred_by', $parentIds)->get();
    }
}
