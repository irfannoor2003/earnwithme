<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WithdrawController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $withdrawals = Withdrawal::where('user_id', $user->id)->latest()->take(10)->get();

        $min = (float) config('withdrawals.min_amount');
        $max = (float) config('withdrawals.max_amount');

        // Default the form to the minimum so the field is never empty, but
        // never suggest more than the member actually holds.
        $defaultAmount = min($min, (float) $user->balance);

        return view('withdraw', compact('withdrawals', 'user', 'min', 'max', 'defaultAmount'));
    }

    public function receipt(Withdrawal $withdrawal)
    {
        abort_unless($withdrawal->user_id === auth()->id(), 403);
        abort_unless($withdrawal->status === 'approved', 404);

        $withdrawal->load('user');

        return view('receipts.show', [
            'type' => 'Withdrawal',
            'record' => $withdrawal,
            'user' => $withdrawal->user,
        ]);
    }

    /**
     * Processing fee for a withdrawal, in rupees.
     *
     * Delegates to the model so the controller, the form and the receipt can
     * never disagree about what a withdrawal costs.
     */
    public static function feeFor(float $amount): float
    {
        return Withdrawal::feeFor($amount);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $min = (float) config('withdrawals.min_amount');
        $max = (float) config('withdrawals.max_amount');

        $request->validate([
            'amount' => ['required', 'numeric', 'decimal:0,2', "min:{$min}", "max:{$max}"],
            'payment_method' => 'required|in:jazzcash,easypaisa',
            'account_number' => 'required|string|max:15',
            'account_name' => 'nullable|string|max:100',
        ]);

        $amount = round((float) $request->input('amount'), 2);
        $fee = self::feeFor($amount);
        $totalDeduction = round($amount + $fee, 2);

        $result = DB::transaction(function () use ($request, $user, $amount, $fee, $totalDeduction) {
            $lockedUser = User::query()->lockForUpdate()->findOrFail($user->id);

            if ($totalDeduction > (float) $lockedUser->balance) {
                return 'insufficient';
            }

            $recentPending = Withdrawal::where('user_id', $lockedUser->id)
                ->where('status', 'pending')
                ->where('amount', $amount)
                ->where('method', $request->payment_method)
                ->where('account_number', $request->account_number)
                ->where('created_at', '>=', now()->subMinutes(2))
                ->exists();

            if ($recentPending) {
                return 'duplicate';
            }

            $lockedUser->decrement('balance', $totalDeduction);

            Withdrawal::create([
                'user_id' => $lockedUser->id,
                'amount' => $amount,
                'fee' => $fee,
                'method' => $request->payment_method,
                'account_number' => $request->account_number,
                'account_name' => $request->account_name,
                'status' => 'pending',
            ]);

            return 'created';
        });

        $feePercent = rtrim(rtrim(number_format((float) config('withdrawals.fee_percent'), 2, '.', ''), '0'), '.');

        if ($result === 'insufficient') {
            return redirect()->route('withdraw')->with('error', 'Insufficient balance. You need Rs '.number_format($totalDeduction, 2).' (amount + '.$feePercent.'% fee) but have Rs '.number_format((float) $user->fresh()->balance, 2).'.');
        }

        if ($result === 'duplicate') {
            return redirect()->route('withdraw')->with('error', 'You already have a similar pending withdrawal request.');
        }

        return redirect()->route('withdraw')->with('success', 'Withdrawal request submitted! Amount: Rs '.number_format($amount, 2).' | Fee: Rs '.number_format($fee, 2).' | Total deducted: Rs '.number_format($totalDeduction, 2).'. It will be processed within 24 hours.');
    }
}
