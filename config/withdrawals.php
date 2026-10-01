<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Processing Fee
    |--------------------------------------------------------------------------
    |
    | Percentage deducted from every withdrawal request on top of the amount
    | the member asked for. This fee is retained by the platform, so it is
    | never part of the payout made to the member's JazzCash/EasyPaisa
    | account. The withdrawal form and the controller both read this value,
    | so the figure shown to the member always matches the amount charged.
    |
    */

    'fee_percent' => env('WITHDRAWAL_FEE_PERCENT', 1),

    /*
    |--------------------------------------------------------------------------
    | Request Limits
    |--------------------------------------------------------------------------
    |
    | Per-request bounds. These are deliberately NOT a lifetime cap: a member
    | may submit as many requests as their balance allows. They exist to cap
    | the size of any single payout.
    |
    */

    'min_amount' => env('WITHDRAWAL_MIN_AMOUNT', 170),

    'max_amount' => env('WITHDRAWAL_MAX_AMOUNT', 70000),

];
