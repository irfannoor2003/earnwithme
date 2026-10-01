<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminWithdrawalController extends Controller
{
    public function index()
    {
        $withdrawals = Withdrawal::with('user')->latest()->paginate(10);

        return view('admin.withdrawals', compact('withdrawals'));
    }

    public function approve(Withdrawal $withdrawal, Request $request)
    {
        $data = $request->validate([
            'note' => 'nullable|string|max:1000',
            // Recorded so the ledger can be reconciled against JazzCash /
            // EasyPaisa later. Optional so one-click approve still works,
            // but without it there is no record of what was actually sent.
            'paid_amount' => ['nullable', 'numeric', 'decimal:0,2', 'min:0.01'],
            'payout_reference' => ['nullable', 'string', 'max:100'],
        ]);

        $approved = DB::transaction(function () use ($withdrawal, $data) {
            $lockedWithdrawal = Withdrawal::query()->lockForUpdate()->findOrFail($withdrawal->id);

            if ($lockedWithdrawal->status !== 'pending') {
                return false;
            }

            $lockedWithdrawal->update([
                'status' => 'approved',
                'admin_note' => $data['note'] ?? null,
                'paid_amount' => $data['paid_amount'] ?? null,
                'payout_reference' => $data['payout_reference'] ?? null,
                'paid_at' => now(),
            ]);

            return true;
        });

        if (! $approved) {
            return redirect()->route('admin.withdrawals')->with('error', 'Only pending withdrawals can be approved.');
        }

        return redirect()->route('admin.withdrawals')->with('success', "Withdrawal #{$withdrawal->id} approved.");
    }

    public function reject(Withdrawal $withdrawal, Request $request)
    {
        $data = $request->validate(['note' => 'nullable|string|max:1000']);
        $rejected = DB::transaction(function () use ($withdrawal, $data) {
            $lockedWithdrawal = Withdrawal::query()->lockForUpdate()->findOrFail($withdrawal->id);

            if ($lockedWithdrawal->status !== 'pending') {
                return false;
            }

            $user = User::query()->lockForUpdate()->findOrFail($lockedWithdrawal->user_id);
            $user->increment('balance', (float) $lockedWithdrawal->amount + (float) $lockedWithdrawal->fee);

            $lockedWithdrawal->update([
                'status' => 'rejected',
                'admin_note' => $data['note'] ?? null,
            ]);

            return true;
        });

        if (! $rejected) {
            return redirect()->route('admin.withdrawals')->with('error', 'Only pending withdrawals can be rejected.');
        }

        return redirect()->route('admin.withdrawals')->with('success', "Withdrawal #{$withdrawal->id} rejected. Amount and fee refunded.");
    }
}
