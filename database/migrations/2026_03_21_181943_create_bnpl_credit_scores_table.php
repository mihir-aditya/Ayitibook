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
        Schema::create('bnpl_credit_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('score'); // 0-100
            $table->string('tier'); // none, starter, growth, plus, pro
            $table->decimal('limit_amount', 10, 2);
            $table->text('reason')->nullable(); // What caused this score change
            $table->json('factors')->nullable(); // Breakdown of factors affecting score
            $table->timestamp('calculated_at');
            $table->timestamps();

            $table->index(['user_id', 'calculated_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bnpl_credit_scores');
    }
};
