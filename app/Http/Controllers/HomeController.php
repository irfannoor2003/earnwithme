<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Plan;
use App\Models\User;
use App\Models\Withdrawal;

class HomeController extends Controller
{
    public function index()
    {
        $plans = Plan::where('is_active', true)->get();

        // Real, verifiable figures only. These are shown to the public, so
        // they must never be padded with invented numbers.
        $totalUsers = User::where('is_admin', false)->count();
        $totalDeposits = Deposit::where('status', 'approved')->sum('amount');
        $totalWithdrawals = Withdrawal::where('status', 'approved')->sum('amount');
        $recentDeposits = Deposit::with('user', 'plan')->where('status', 'approved')->latest()->take(10)->get();
        $recentWithdrawals = Withdrawal::with('user')->where('status', 'approved')->latest()->take(10)->get();

        return view('home', compact(
            'plans', 'totalUsers', 'totalDeposits', 'totalWithdrawals',
            'recentDeposits', 'recentWithdrawals'
        ));
    }
}
