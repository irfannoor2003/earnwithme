<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\Commission;
use App\Models\Plan;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $activeUsers = User::where('is_active', true)->count();
        $totalDeposits = Deposit::where('status', 'approved')->sum('amount');
        $pendingDeposits = Deposit::where('status', 'pending')->count();
        $totalWithdrawals = Withdrawal::where('status', 'approved')->sum('amount');
        $pendingWithdrawals = Withdrawal::where('status', 'pending')->sum('amount');
        $totalCommissions = Commission::sum('amount');

        $recentDeposits = Deposit::with('user', 'plan')->latest()->take(10)->get();
        $recentWithdrawals = Withdrawal::with('user')->latest()->take(10)->get();

        return view('admin.dashboard', compact('totalUsers', 'activeUsers', 'totalDeposits', 'pendingDeposits', 'totalWithdrawals', 'pendingWithdrawals', 'totalCommissions', 'recentDeposits', 'recentWithdrawals'));
    }
}
