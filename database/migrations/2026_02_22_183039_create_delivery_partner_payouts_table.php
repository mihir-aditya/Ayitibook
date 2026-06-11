<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_delivery_partner_payouts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('delivery_partner_payouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delivery_partner_id')->constrained()->onDelete('cascade');
            $table->string('payout_reference')->unique();
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['pending', 'processing', 'completed', 'failed', 'cancelled'])->default('pending');
            $table->enum('payout_method', ['bank_transfer', 'cash', 'upi', 'paypal'])->default('bank_transfer');
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('upi_id')->nullable();
            $table->json('payout_details')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('delivery_partner_payouts');
    }
};