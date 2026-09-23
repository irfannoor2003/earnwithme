<?php

namespace App\Http\Controllers;

use App\Models\User;

class AboutController extends Controller
{
    public function index()
    {
        $baseUsers = 5001;
        $totalUsers = User::count() + $baseUsers;
        $totalDeposits = \App\Models\Deposit::where('status', 'approved')->sum('amount') + 600000;
        $totalWithdrawals = \App\Models\Withdrawal::where('status', 'approved')->sum('amount') + 500000;

        return view('about', compact('totalUsers', 'totalDeposits', 'totalWithdrawals'));
    }
}
