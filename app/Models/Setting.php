<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function get(string $key, $default = null)
    {
        $settings = Cache::remember('settings', 3600, function () {
            return static::pluck('value', 'key')->toArray();
        });

        return $settings[$key] ?? $default;
    }

    public static function set(string $key, $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget('settings');
    }

    /**
     * Write several settings, invalidating the cache exactly once.
     *
     * Setting::set() forgets on every call, so saving the settings screen
     * dropped the cache five times and let a concurrent read repopulate it
     * from a half-written state.
     *
     * @param  array<string, mixed>  $pairs
     */
    public static function setMany(array $pairs): void
    {
        DB::transaction(function () use ($pairs) {
            foreach ($pairs as $key => $value) {
                static::updateOrCreate(['key' => $key], ['value' => $value]);
            }
        });

        // Invalidate only after the whole batch is committed, so a reader can
        // never cache a partially applied set.
        Cache::forget('settings');
    }
}
