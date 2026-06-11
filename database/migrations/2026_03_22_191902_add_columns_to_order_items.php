<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            if (!Schema::hasColumn('order_items', 'variant_id')) {
                $table->unsignedBigInteger('variant_id')->nullable()->after('product_id');
            }
            if (!Schema::hasColumn('order_items', 'size')) {
                $table->string('size', 50)->nullable()->after('variant_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn(['variant_id', 'size']);
        });
    }
};