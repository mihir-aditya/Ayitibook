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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->foreignId('product_id')
                ->constrained('products')
                ->onDelete('cascade');

            $table->foreignId('variant_id')
                ->nullable()
                ->constrained('product_variants')
                ->onDelete('cascade');

            // Additional columns
            $table->string('size')->nullable();
            $table->integer('quantity')->unsigned()->default(1);

            // Timestamps
            $table->timestamps();

            // Unique constraint to prevent duplicate cart items
            $table->unique(['user_id', 'product_id', 'variant_id', 'size'], 'unique_cart_item');

            // Optional: Add indexes for better performance
            $table->index(['user_id', 'created_at']);
            $table->index('product_id');
            $table->index('variant_id');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart', function (Blueprint $table) {
            //
        });
    }
};
