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
        Schema::create('bnpl_loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('order_id')->nullable()->index();
            $table->string('loan_number')->unique();
            $table->string('product_title');
            $table->decimal('loan_amount', 10, 2);
            $table->integer('total_installments'); // 3 or 4 installments
            $table->integer('paid_installments')->default(0);
            $table->decimal('installment_amount', 10, 2);
            $table->decimal('remaining_amount', 10, 2);
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->enum('status', ['active', 'completed', 'defaulted', 'cancelled'])->default('active');
            $table->timestamp('loan_date');
            $table->timestamp('next_payment_due')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->decimal('interest_rate', 5, 2)->default(0); // If any interest is charged
            $table->decimal('late_fees', 10, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index('loan_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bnpl_loans');
    }
};
