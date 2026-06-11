<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bnpl_tiers', function (Blueprint $table) {
            $table->id();
            $table->string('tier_name')->unique(); // none, starter, growth, plus, pro
            $table->string('display_name');
            $table->integer('min_score');
            $table->integer('max_score');
            $table->decimal('limit_amount', 10, 2);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index(['min_score', 'max_score']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bnpl_tiers');
    }
};
