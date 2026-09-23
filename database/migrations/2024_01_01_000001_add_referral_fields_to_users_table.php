<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('name');
            $table->string('referral_code', 10)->unique()->after('email');
            $table->foreignId('referred_by')->nullable()->after('referral_code')->constrained('users')->nullOnDelete();
            $table->foreignId('plan_id')->nullable()->after('referred_by');
            $table->boolean('is_active')->default(false)->after('plan_id');
            $table->boolean('is_admin')->default(false)->after('is_active');
            $table->decimal('balance', 12, 2)->default(0)->after('is_admin');
            $table->decimal('total_earned', 12, 2)->default(0)->after('balance');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 'referral_code', 'referred_by', 'plan_id',
                'is_active', 'is_admin', 'balance', 'total_earned',
            ]);
        });
    }
};
