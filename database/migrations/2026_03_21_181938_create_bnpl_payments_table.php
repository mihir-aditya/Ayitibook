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
        Schema::create('bnpl_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->constrained('bnpl_loans')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('payment_reference')->unique();
            $table->integer('installment_number');
            $table->decimal('amount_due', 10, 2);
            $table->decimal('amount_paid', 10, 2);
            $table->decimal('late_fees', 10, 2)->default(0);
            $table->enum('status', ['pending', 'paid', 'overdue', 'missed', 'cancelled'])->default('pending');
            $table->enum('payment_method', ['wallet', 'card', 'upi', 'bank_transfer'])->nullable();
            $table->timestamp('due_date');
            $table->timestamp('paid_at')->nullable();
            $table->integer('days_late')->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['loan_id', 'installment_number']);
            $table->index(['user_id', 'status']);
            $table->index('due_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bnpl_payments');
    }
};
