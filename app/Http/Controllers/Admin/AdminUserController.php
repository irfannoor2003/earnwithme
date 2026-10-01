<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\CommissionService;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::with('plan')->latest()->paginate(10);

        return view('admin.users', compact('users'));
    }

    public function referrals(User $user)
    {
        $levels = [];
        $current = collect([$user]);
        $maxLevel = CommissionService::MAX_LEVEL;

        for ($lvl = 1; $lvl <= $maxLevel; $lvl++) {
            $members = User::whereIn('referred_by', $current->pluck('id'))
                ->with('plan')
                ->orderBy('created_at')
                ->get();

            $levels[$lvl] = [
                'members' => $members,
                'count' => $members->count(),
                'active' => $members->where('is_active', true)->count(),
            ];

            $current = $members;

            if ($current->isEmpty()) {
                // Fill remaining levels as empty
                for ($j = $lvl + 1; $j <= $maxLevel; $j++) {
                    $levels[$j] = ['members' => collect(), 'count' => 0, 'active' => 0];
                }
                break;
            }
        }

        $totalReferrals = array_sum(array_column($levels, 'count'));
        $totalActive = array_sum(array_column($levels, 'active'));

        return view('admin.user-referrals', compact('user', 'levels', 'totalReferrals', 'totalActive'));
    }
}
