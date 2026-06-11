<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_affiliate_locks', function (Blueprint $table) {
            $table->id();

            // Customer (who clicked)
            $table->foreignId('customer_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Product being tracked
            $table->foreignId('product_id')
                ->constrained()
                ->onDelete('cascade');

            // Affiliate owner
            $table->foreignId('affiliate_id')
                ->constrained()
                ->onDelete('cascade');

            // Lock expiration
            $table->timestamp('locked_until');

            $table->timestamps();

            // One customer per product lock
            $table->unique(['customer_id', 'product_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_affiliate_locks');
    }
};