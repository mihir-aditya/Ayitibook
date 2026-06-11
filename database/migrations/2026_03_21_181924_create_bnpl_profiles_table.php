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
        Schema::create('bnpl_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('is_eligible')->default(false);
            $table->boolean('is_enabled')->default(false);
            $table->integer('credit_score')->default(0); // 0-100
            $table->decimal('current_limit', 10, 2)->default(0);
            $table->decimal('available_limit', 10, 2)->default(0);
            $table->decimal('used_limit', 10, 2)->default(0);
            $table->string('tier')->default('none'); // none, starter, growth, plus, pro
            $table->integer('total_loans')->default(0);
            $table->integer('completed_loans')->default(0);
            $table->integer('active_loans')->default(0);
            $table->decimal('total_borrowed', 10, 2)->default(0);
            $table->decimal('total_repaid', 10, 2)->default(0);
            $table->decimal('outstanding_amount', 10, 2)->default(0);
            $table->integer('on_time_payments')->default(0);
            $table->integer('late_payments')->default(0);
            $table->integer('missed_payments')->default(0);
            $table->timestamp('last_payment_date')->nullable();
            $table->timestamp('eligibility_checked_at')->nullable();
            $table->json('milestone_progress')->nullable(); // Store milestone progress as JSON
            $table->timestamps();

            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bnpl_profiles');
    }
};
