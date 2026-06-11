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
        // Drop the table if it exists from a previous attempt
        Schema::dropIfExists('commissions');

        Schema::create('commissions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('affiliate_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();

            $table->decimal('amount', 12, 2);
            $table->decimal('commission_percentage', 5, 2);

            $table->enum('status', ['pending','approved','paid'])
                  ->default('pending');

            $table->timestamps();

            // Add foreign key indexes
            $table->index('order_id');
            $table->index('affiliate_id');
            $table->index('customer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commissions');
    }
};
