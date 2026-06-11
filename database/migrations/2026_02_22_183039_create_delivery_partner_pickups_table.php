<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_delivery_partner_pickups_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('delivery_partner_pickups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delivery_partner_id')->constrained()->onDelete('cascade');
            
            // Match exactly with orders.sl_no (int(11))
            $table->integer('order_sl_no');
            $table->foreign('order_sl_no')
                  ->references('sl_no')
                  ->on('orders')
                  ->onDelete('cascade');
            
            $table->foreignId('seller_id')->constrained()->onDelete('cascade');
            $table->enum('status', [
                'assigned', 
                'pickup_scheduled', 
                'picked_up', 
                'in_transit', 
                'delivered', 
                'failed', 
                'returned'
            ])->default('assigned');
            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('pickup_scheduled_at')->nullable();
            $table->timestamp('picked_up_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->text('pickup_address')->nullable();
            $table->text('delivery_address')->nullable();
            $table->string('delivery_otp')->nullable();
            $table->boolean('otp_verified')->default(false);
            $table->text('notes')->nullable();
            $table->text('cancellation_reason')->nullable();
            $table->json('delivery_proof')->nullable();
            $table->decimal('distance_km', 8, 2)->nullable();
            $table->decimal('delivery_fee', 10, 2)->default(0);
            $table->timestamps();
            
            // Add unique constraint to ensure one delivery per order
            $table->unique('order_sl_no', 'delivery_partner_pickups_order_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('delivery_partner_pickups');
    }
};