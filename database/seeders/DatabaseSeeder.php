<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Note: WithoutModelEvents is deliberately NOT used here. It suppresses
     * the User model's `creating` hook, which is what generates the
     * non-nullable referral_code - seeding would fail outright.
     */
    public function run(): void
    {
        Plan::firstOrCreate(['name' => 'Premium'], [
            'price' => 350,
            'description' => 'Unlock your full earning potential with our Premium plan. Start earning through our 7-level referral commission system today.',
            'features' => ['7-Level Referral Commission', 'Direct Referral Bonus (Rs 20)', 'Daily Commission Tracking', 'JazzCash/EasyPaisa Withdrawal', 'Full Dashboard & Analytics', 'Priority Support'],
            'is_active' => true,
        ]);

        $adminEmail = config('services.admin.email');
        $adminPassword = config('services.admin.password');

        if (! $adminEmail || ! $adminPassword) {
            $this->command?->warn('Admin user was not seeded. Set ADMIN_EMAIL and ADMIN_PASSWORD to create one.');

            return;
        }

        $admin = User::firstOrNew(['email' => $adminEmail]);

        // forceFill: is_admin is deliberately not mass assignable so it can
        // never arrive from request input. Only trusted code may set it.
        $admin->forceFill([
            'name' => 'Admin',
            'phone' => null,
            'password' => $adminPassword,
            'is_active' => true,
            'is_admin' => true,
            // Member routes sit behind the 'verified' middleware, so an
            // unverified admin is permanently redirected to /email/verify.
            'email_verified_at' => $admin->email_verified_at ?? now(),
        ])->save();

        if ($admin->wasRecentlyCreated) {
            $this->command?->info("Admin {$adminEmail} created.");
        } else {
            $this->command?->info("Admin {$adminEmail} updated.");
        }
    }
}
