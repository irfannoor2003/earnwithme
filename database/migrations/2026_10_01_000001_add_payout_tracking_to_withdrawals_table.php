<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('withdrawals', function (Blueprint $table) {
            // What was actually sent to the member, and proof of it. Approving
            // a withdrawal only flips a status otherwise, so there is no way to
            // answer "did I pay this, and how much?" after the fact.
            $table->decimal('paid_amount', 10, 2)->nullable()->after('fee');
            $table->string('payout_reference', 100)->nullable()->after('paid_amount');
            $table->timestamp('paid_at')->nullable()->after('payout_reference');
        });
    }

    public function down(): void
    {
        Schema::table('withdrawals', function (Blueprint $table) {
            $table->dropColumn(['paid_amount', 'payout_reference', 'paid_at']);
        });
    }
};
