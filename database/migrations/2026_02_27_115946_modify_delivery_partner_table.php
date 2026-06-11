<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('delivery_partners', function (Blueprint $table) {
            // Deposit held by the platform (in HTG)
            $table->decimal('deposit_amount', 10, 2)->default(0)->after('total_ratings');

            // Percentage of deliveries completed successfully (0–100)
            $table->decimal('success_rate', 5, 2)->default(0)->after('deposit_amount');

            // Count of active major warnings/violations
            $table->unsignedSmallInteger('major_warnings')->default(0)->after('success_rate');

            // Maximum cash-on-delivery value the partner currently handles (in HTG)
            // Used only for Platinum deposit requirement
            $table->decimal('max_cod_value', 10, 2)->default(0)->after('major_warnings');

            // Cached badge tier (recomputed by job/observer); improves query performance
            $table->string('badge_tier', 20)->default('unranked')->after('max_cod_value');
        });
    }

    public function down(): void
    {
        Schema::table('delivery_partners', function (Blueprint $table) {
            $table->dropColumn(['deposit_amount', 'success_rate', 'major_warnings', 'max_cod_value', 'badge_tier']);
        });
    }
};