<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            /*
             | type values (used to pick icon/colour in blade):
             |  order_placed | order_confirmed | order_shipped | order_delivered
             |  order_cancelled | order_refunded
             |  refund_pending | refund_approved | refund_rejected | refund_processed
             |  delivery_update
             |  new_product   (subscribed seller uploaded a product)
             |  flash_sale    (subscribed seller started flash sale)
             |  payment_success | payment_failed
             |  general
             */
            $table->string('type', 60);

            $table->string('title');
            $table->text('message');

            // Optional deep-link data stored as JSON
            // e.g. {"url":"/orders/123", "order_id":123, "product_id":45}
            $table->json('data')->nullable();

            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'read_at']);   // fast unread count query
            $table->index(['user_id', 'created_at']); // fast listing query
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};