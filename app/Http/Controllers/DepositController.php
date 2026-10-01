<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'plan_id' => ['required', 'integer', Rule::exists('plans', 'id')->where(fn ($query) => $query->where('is_active', true))],
            'amount' => 'required|numeric|decimal:0,2|min:170|max:70000',
            'payment_method' => 'required|in:jazzcash,easypaisa',
            'account_number' => 'required|string|max:15',
            'transaction_id' => [
                'required',
                'string',
                'max:50',
                Rule::unique('deposits', 'transaction_id')->where(fn ($query) => $query->where('method', $request->input('payment_method'))),
            ],
        ]);

        $user = auth()->user();

        if ($user->is_active) {
            return redirect()->route('deposit')->with('error', 'You already have an active plan. You can only buy one plan at a time.');
        }

        $alreadyPending = Deposit::where('user_id', $user->id)->where('status', 'pending')->exists();
        if ($alreadyPending) {
            return redirect()->route('deposit')->with('error', 'You already have a deposit awaiting review. Please wait for it to be processed.');
        }

        $plan = Plan::whereKey($request->integer('plan_id'))
            ->where('is_active', true)
            ->firstOrFail();

        if ((int) round((float) $request->input('amount') * 100) !== (int) round((float) $plan->price * 100)) {
            return back()->withInput()->withErrors([
                'amount' => 'The deposit amount must match the selected plan price.',
            ]);
        }

        Deposit::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'amount' => $plan->price,
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
