<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Plan;
use App\Models\User;
use App\Services\CommissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminDepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::with('user', 'plan')->latest()->paginate(10);

        return view('admin.deposits', compact('deposits'));
    }

    public function approve(Deposit $deposit, Request $request, CommissionService $commissionService)
    {
        $data = $request->validate(['note' => 'nullable|string|max:1000']);
        $result = DB::transaction(function () use ($deposit, $data, $commissionService) {
            $lockedDeposit = Deposit::query()->lockForUpdate()->findOrFail($deposit->id);

            if ($lockedDeposit->status !== 'pending') {
                return 'not_pending';
            }

            $user = User::query()->lockForUpdate()->findOrFail($lockedDeposit->user_id);
            if ($user->is_active) {
                return 'already_active';
            }

            $plan = Plan::findOrFail($lockedDeposit->plan_id);
            if ((int) round((float) $lockedDeposit->amount * 100) !== (int) round((float) $plan->price * 100)) {
                return 'amount_mismatch';
            }

            $lockedDeposit->update([
                'status' => 'approved',
                'admin_note' => $data['note'] ?? null,
            ]);
            $user->update([
                'is_active' => true,
                'plan_id' => $lockedDeposit->plan_id,
            ]);

            $commissionService->giveDirectReferralBonus($user);
            $commissionService->distributeCommissions($user, (float) $plan->price);

            // A plan priced below the full 7-level liability would pay out
            // more than it collects. This does not block the sale, but it
            // must never happen silently.
            $margin = $commissionService::marginFor((float) $plan->price);
            if ($margin < 0) {
                Log::warning('Deposit approved below platform cost', [
                    'deposit_id' => $lockedDeposit->id,
                    'plan' => $plan->name,
                    'plan_price' => (float) $plan->price,
                    'worst_case_commission' => $commissionService::totalLiabilityPerSale(),
                    'margin' => $margin,
                ]);
            }

            return 'approved';
        });

        if ($result !== 'approved') {
            $message = match ($result) {
                'already_active' => 'This user already has an active plan.',
                'amount_mismatch' => 'The deposit amount does not match the selected plan price.',
                default => 'Only pending deposits can be approved.',
            };

            return redirect()->route('admin.deposits')->with('error', $message);
        }

        return redirect()->route('admin.deposits')->with('success', "Deposit #{$deposit->id} approved. Commissions distributed.");
    }

    public function reject(Deposit $deposit, Request $request)
    {
        $data = $request->validate(['note' => 'nullable|string|max:1000']);
        $rejected = DB::transaction(function () use ($deposit, $data) {
            $lockedDeposit = Deposit::query()->lockForUpdate()->findOrFail($deposit->id);

            if ($lockedDeposit->status !== 'pending') {
                return false;
            }

            $lockedDeposit->update([
                'status' => 'rejected',
                'admin_note' => $data['note'] ?? null,
            ]);

            return true;
        });

        if (! $rejected) {
            return redirect()->route('admin.deposits')->with('error', 'Only pending deposits can be rejected.');
        }

        return redirect()->route('admin.deposits')->with('success', "Deposit #{$deposit->id} rejected.");
    }
}
