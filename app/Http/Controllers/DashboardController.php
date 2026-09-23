<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\Deposit;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user()->load('plan', 'referrals');
        
        $totalCommissions = Commission::where('to_user_id', $user->id)->sum('amount');
        $pendingDeposits = Deposit::where('user_id', $user->id)->where('status', 'pending')->count();
        $activeReferrals = $user->referrals()->where('is_active', true)->count();
        $recentCommissions = Commission::where('to_user_id', $user->id)->with('fromUser')->latest()->take(5)->get();

        $levelCommissions = Commission::where('to_user_id', $user->id)
            ->selectRaw('level, sum(amount) as total')
            ->groupBy('level')
            ->get()
            ->pluck('total', 'level');

        return view('dashboard', compact(
            'user', 'totalCommissions', 'pendingDeposits',
            'activeReferrals', 'recentCommissions', 'levelCommissions'
        ));
    }
}
