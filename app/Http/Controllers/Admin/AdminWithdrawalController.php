<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class AdminWithdrawalController extends Controller
{
    public function index()
    {
        $withdrawals = Withdrawal::with('user')->latest()->paginate(10);
        return view('admin.withdrawals', compact('withdrawals'));
    }

    public function approve(Withdrawal $withdrawal, Request $request)
    {
        $withdrawal->update([
            'status' => 'approved',
            'admin_note' => $request->note,
        ]);

        return redirect()->route('admin.withdrawals')->with('success', "Withdrawal #{$withdrawal->id} approved.");
    }

    public function reject(Withdrawal $withdrawal, Request $request)
    {
        $user = $withdrawal->user;
        $user->increment('balance', $withdrawal->amount);

        $withdrawal->update([
            'status' => 'rejected',
            'admin_note' => $request->note,
        ]);

        return redirect()->route('admin.withdrawals')->with('success', "Withdrawal #{$withdrawal->id} rejected. Amount refunded.");
    }
}
