<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Plan::create([
            'name' => 'Premium',
            'price' => 350,
            'description' => 'Unlock your full earning potential with our Premium plan. Start earning through our 7-level referral commission system today.',
            'features' => ['7-Level Referral Commission', 'Direct Referral Bonus (Rs 20)', 'Daily Commission Tracking', 'JazzCash/EasyPaisa Withdrawal', 'Full Dashboard & Analytics', 'Priority Support'],
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@meearningplatform.com',
            'phone' => '03001234567',
            'password' => Hash::make('password'),
            'referral_code' => 'ADMIN001',
            'is_active' => true,
            'is_admin' => true,
        ]);
    }
}
