<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * The signup/welcome bonus was removed: level 1 (Rs 110) already pays the
     * referrer for the very same referred signup, so the extra Rs 20 was a
     * double payment for one event.
     *
     * DatabaseSeeder uses firstOrCreate, so it never updates the features of a
     * plan that already exists - every deployed database still advertises the
     * bonus until this strips it. Idempotent: running it twice is a no-op.
     */
    public function up(): void
    {
        DB::table('plans')
            ->whereNotNull('features')
            ->orderBy('id')
            ->each(function (object $plan) {
                $features = json_decode($plan->features, true);

                if (! is_array($features)) {
                    return;
                }

                $kept = array_values(array_filter($features, function ($feature) {
                    if (! is_string($feature)) {
                        return true;
                    }

                    $text = strtolower($feature);

                    // Catches every wording this bonus was published under:
                    // "Welcome Bonus", "Direct Referral Bonus (Rs 20)", etc.
                    return ! str_contains($text, 'welcome bonus')
                        && ! str_contains($text, 'direct referral bonus')
                        && ! str_contains($text, 'signup bonus');
                }));

                if ($kept !== array_values($features)) {
                    DB::table('plans')->where('id', $plan->id)->update([
                        'features' => json_encode($kept),
                    ]);
                }
            });
    }

    public function down(): void
    {
        // The removed bonus is not restored: it was a double payment and must
        // not come back through a rollback.
    }
};