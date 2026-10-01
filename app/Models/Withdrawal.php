<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Withdrawal extends Model
{
    protected $fillable = [
        'user_id', 'amount', 'fee', 'method', 'account_number',
        'account_name', 'status', 'admin_note',
        'paid_amount', 'payout_reference', 'paid_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'fee' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Processing fee for a withdrawal, in rupees.
     *
     * The single source of truth for the fee: the controller charges it, the
     * form previews it and the receipt prints it, so all three agree.
     *
     * Rounded to 2dp because the balance column is decimal(12,2) - an
     * unrounded fee would let the stored balance drift from the amount
     * actually deducted.
     */
    public static function feeFor(float $amount): float
    {
        return round($amount * ((float) config('withdrawals.fee_percent') / 100), 2);
    }
}
