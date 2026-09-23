<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\User;
use App\Services\CommissionService;
use Illuminate\Http\Request;

class AdminDepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::with('user', 'plan')->latest()->paginate(10);
        return view('admin.deposits', compact('deposits'));
    }

    public function approve(Deposit $deposit, Request $request)
    {
        $deposit->update([
            'status' => 'approved',
            'admin_note' => $request->note,
        ]);

        $user = $deposit->user;
        if (!$user->is_active) {
            $user->update([
                'is_active' => true,
                'plan_id' => $deposit->plan_id,
            ]);

            $commissionService = new CommissionService();
            $commissionService->distributeCommissions($user, $deposit->plan->price);
        }

        return redirect()->route('admin.deposits')->with('success', "Deposit #{$deposit->id} approved. Commissions distributed.");
    }

    public function reject(Deposit $deposit, Request $request)
    {
        $deposit->update([
            'status' => 'rejected',
            'admin_note' => $request->note,
        ]);

        return redirect()->route('admin.deposits')->with('success', "Deposit #{$deposit->id} rejected.");
    }
}
