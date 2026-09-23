<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commission extends Model
{
    protected $fillable = [
        'from_user_id', 'to_user_id', 'level', 'amount', 'plan_price',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'plan_price' => 'decimal:2',
        'level' => 'integer',
    ];

    public function fromUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function toUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }
}
