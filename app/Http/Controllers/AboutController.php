<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\User;
use App\Models\Withdrawal;

class AboutController extends Controller
{
    public function index()
    {
        // Real figures only - this page is public.
        $totalUsers = User::where('is_admin', false)->count();
        $totalDeposits = Deposit::where('status', 'approved')->sum('amount');
        $totalWithdrawals = Withdrawal::where('status', 'approved')->sum('amount');

        return view('about', compact('totalUsers', 'totalDeposits', 'totalWithdrawals'));
    }
}
