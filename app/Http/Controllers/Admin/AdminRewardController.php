<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use App\Models\User;
use Illuminate\Http\Request;

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
            'amount' => 'required|numeric|min:1|max:1000000',
            'reason' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($request->user_id);

        $reward = Reward::create([
            'user_id' => $user->id,
            'issued_by' => auth()->id(),
            'amount' => $request->amount,
            'reason' => $request->reason,
        ]);

        // Credit the user's balance immediately
        $user->increment('balance', $request->amount);
        $user->increment('total_earned', $request->amount);

        return redirect()
            ->route('admin.rewards')
            ->with('success', "Reward of Rs " . number_format($request->amount) . " issued to {$user->name}. Balance credited.");
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
