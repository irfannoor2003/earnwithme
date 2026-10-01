<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRewardController extends Controller
{
    public function index()
    {
        $rewards = Reward::with('user', 'issuer')->latest()->paginate(10);
        $users = User::where('is_admin', false)->orderBy('name')->get(['id', 'name', 'email']);

        return view('admin.rewards', compact('rewards', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            // decimal:0,2 blocks scientific notation and exponents, which
            // otherwise pass a bare `numeric` check and then get rounded by
            // the decimal(12,2) column.
            'amount' => ['required', 'numeric', 'decimal:0,2', 'min:1', 'max:1000000'],
            'reason' => 'required|string|max:255',
        ]);

        $amount = round((float) $request->amount, 2);

        $issued = DB::transaction(function () use ($request, $amount) {
            $user = User::query()->lockForUpdate()->findOrFail($request->user_id);

            $reward = Reward::create([
                'user_id' => $user->id,
                'issued_by' => auth()->id(),
                'amount' => $amount,
                'reason' => $request->reason,
            ]);

            // Credit the user's balance in the same transaction as the reward
            // row, so the ledger can never disagree with itself.
            $user->increment('balance', $amount);
            $user->increment('total_earned', $amount);

            return [$reward, $user->fresh()];
        });

        [$reward, $user] = $issued;

        return redirect()
            ->route('admin.rewards')
            ->with('success', 'Reward of Rs '.number_format($amount, 2)." issued to {$user->name}. Balance credited.");
    }

    public function receipt(Reward $reward)
    {
        $reward->load('user', 'issuer');

        return view('receipts.show', [
            'type' => 'Reward',
            'record' => $reward,
            'user' => $reward->user,
        ]);
    }
}
