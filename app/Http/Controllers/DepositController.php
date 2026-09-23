<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Deposit;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $plans = Plan::where('is_active', true)->get();
        $deposits = Deposit::where('user_id', $user->id)->with('plan')->latest()->take(10)->get();

        return view('deposit', compact('plans', 'deposits', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'amount' => 'required|numeric|min:170|max:70000',
            'payment_method' => 'required|in:jazzcash,easypaisa',
            'account_number' => 'required|string|max:15',
            'transaction_id' => 'required|string|max:50',
        ]);

        $user = auth()->user();

        if ($user->is_active) {
            return redirect()->route('deposit')->with('error', 'You already have an active plan. You can only buy one plan at a time.');
        }

        $exists = Deposit::where('user_id', $user->id)
            ->where('transaction_id', $request->transaction_id)
            ->exists();

        if ($exists) {
            return redirect()->route('deposit')->with('error', 'A deposit with this Transaction ID already exists.');
        }

        Deposit::create([
            'user_id' => $user->id,
            'plan_id' => $request->plan_id,
            'amount' => $request->amount,
            'method' => $request->payment_method,
            'account_number' => $request->account_number,
            'transaction_id' => $request->transaction_id,
            'status' => 'pending',
        ]);

        return redirect()->route('deposit')->with('success', 'Deposit request submitted! It will be approved within 24 hours.');
    }

    public function receipt(Deposit $deposit)
    {
        abort_unless($deposit->user_id === auth()->id(), 403);
        abort_unless($deposit->status === 'approved', 404);

        $deposit->load('user', 'plan');

        return view('receipts.show', [
            'type' => 'Deposit',
            'record' => $deposit,
            'user' => $deposit->user,
        ]);
    }
}
