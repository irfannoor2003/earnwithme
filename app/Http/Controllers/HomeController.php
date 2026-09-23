<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use App\Models\Deposit;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $plans = Plan::where('is_active', true)->get();
        $totalUsers = User::count();
        $totalDeposits = Deposit::where('status', 'approved')->sum('amount');
        $totalWithdrawals = Withdrawal::where('status', 'approved')->sum('amount');
        $recentDeposits = Deposit::with('user', 'plan')->where('status', 'approved')->latest()->take(10)->get();
        $recentWithdrawals = Withdrawal::with('user')->where('status', 'approved')->latest()->take(10)->get();

        $baseUsers = 5001;
        $baseDeposits = 600000;
        $baseWithdrawals = 500000;

        $displayUsers = $totalUsers + $baseUsers;
        $displayDeposits = $totalDeposits + $baseDeposits;
        $displayWithdrawals = $totalWithdrawals + $baseWithdrawals;

        return view('home', compact(
            'plans', 'totalUsers', 'totalDeposits', 'totalWithdrawals',
            'recentDeposits', 'recentWithdrawals', 'displayUsers',
            'displayDeposits', 'displayWithdrawals'
        ));
    }
}
