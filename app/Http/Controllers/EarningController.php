<?php

namespace App\Http\Controllers;

use App\Models\Commission;

class EarningController extends Controller
{
    public function index()
    {
        return view('earning-details');
    }

    public function earnings()
    {
        $user = auth()->user();
        $commissions = Commission::where('to_user_id', $user->id)
            ->with('fromUser')
            ->latest()
            ->paginate(20);

        $totalByLevel = Commission::where('to_user_id', $user->id)
            ->selectRaw('level, sum(amount) as total, count(*) as count')
            ->groupBy('level')
            ->get();

        return view('earnings', compact('commissions', 'totalByLevel'));
    }
}
