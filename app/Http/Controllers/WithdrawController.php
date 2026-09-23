<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $withdrawals = Withdrawal::where('user_id', $user->id)->latest()->take(10)->get();

        return view('withdraw', compact('withdrawals', 'user'));
    }

    public function receipt(Withdrawal $withdrawal)
    {
        abort_unless($withdrawal->user_id === auth()->id(), 403);
        abort_unless(in_array($withdrawal->status, ['approved', 'completed']), 404);

        $withdrawal->load('user');

        return view('receipts.show', [
            'type' => 'Withdrawal',
            'record' => $withdrawal,
            'user' => $withdrawal->user,
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'amount' => 'required|numeric|min:170|max:70000',
            'payment_method' => 'required|in:jazzcash,easypaisa',
            'account_number' => 'required|string|max:15',
            'account_name' => 'nullable|string|max:100',
        ]);

        $amount = $request->amount;
        $fee = round($amount * 0.01, 2);
        $totalDeduction = $amount + $fee;

        if ($totalDeduction > $user->balance) {
            return redirect()->route('withdraw')->with('error', 'Insufficient balance. You need Rs ' . number_format($totalDeduction, 2) . ' (amount + 1% fee) but have Rs ' . number_format($user->balance, 2) . '.');
        }

        $recentPending = Withdrawal::where('user_id', $user->id)
            ->where('status', 'pending')
            ->where('amount', $amount)
            ->where('method', $request->payment_method)
            ->where('account_number', $request->account_number)
            ->where('created_at', '>=', now()->subMinutes(2))
            ->exists();

        if ($recentPending) {
            return redirect()->route('withdraw')->with('error', 'You already have a similar pending withdrawal request.');
        }

        $user->decrement('balance', $totalDeduction);

        Withdrawal::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'fee' => $fee,
            'method' => $request->payment_method,
            'account_number' => $request->account_number,
            'account_name' => $request->account_name,
            'status' => 'pending',
        ]);

        return redirect()->route('withdraw')->with('success', 'Withdrawal request submitted! Amount: Rs ' . number_format($amount, 2) . ' | Fee: Rs ' . number_format($fee, 2) . ' | Total deducted: Rs ' . number_format($totalDeduction, 2) . '. It will be processed within 24 hours.');
    }
}
