<?php

namespace App\Models;

use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

#[Fillable(['name', 'email', 'phone', 'password', 'referral_code', 'referred_by', 'plan_id', 'is_active'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements MustVerifyEmailContract
{
    use CanResetPassword, HasFactory, MustVerifyEmail, Notifiable;

    /**
     * Deliberately NOT mass assignable: is_admin, balance, total_earned.
     *
     * balance and total_earned are only ever moved with increment()/decrement()
     * and forceFill(), which bypass this guard, and is_admin only via the
     * seeder. Keeping them off the fillable list means a controller that
     * passes request input to create()/update() cannot grant admin rights or
     * mint credit.
     */
    protected $guarded = ['is_admin', 'balance', 'total_earned'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
        'is_admin' => 'boolean',
        'balance' => 'decimal:2',
        'total_earned' => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::creating(function (User $user) {
            if (empty($user->referral_code)) {
                $user->referral_code = static::generateReferralCode();
            }
        });
    }

    /**
     * Referral codes are a unique column, so a collision must be retried
     * rather than surfaced to the member as a 500 on the signup form.
     */
    public static function generateReferralCode(): string
    {
        do {
            $code = strtoupper(Str::random(8));
        } while (static::where('referral_code', $code)->exists());

        return $code;
    }

    public function referrer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    public function referrals(): HasMany
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function deposits(): HasMany
    {
        return $this->hasMany(Deposit::class);
    }

    public function withdrawals(): HasMany
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function earnedCommissions(): HasMany
    {
        return $this->hasMany(Commission::class, 'to_user_id');
    }

    public function givenCommissions(): HasMany
    {
        return $this->hasMany(Commission::class, 'from_user_id');
    }

    public function getReferralLink(): string
    {
        return url('/register?ref='.$this->referral_code);
    }

    public function getActiveDirectReferrals(): int
    {
        return $this->referrals()->where('is_active', true)->count();
    }

    public function getTotalReferrals(): int
    {
        return $this->referrals()->count();
    }
}
