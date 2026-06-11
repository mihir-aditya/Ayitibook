<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->unique()
                  ->constrained('users')
                  ->cascadeOnDelete();

            /* ── Step 2: Basic Profile ── */
            $table->string('address')->nullable();
            $table->string('zone')->nullable();          // city / area / zone
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->default('Haiti');

            /* ── Step 3: Shopping Preferences ── */
            // Payment method: cod | card | wallet
            $table->string('preferred_payment')->nullable();

            // Delivery preference: fast | standard
            $table->string('delivery_preference')->nullable();

            // How often they shop: daily | weekly | monthly | rarely
            $table->string('purchase_frequency')->nullable();

            // Average order value: <50 | 50-200 | 200-500 | 500+
            $table->string('avg_order_value')->nullable();

            // Business or personal
            $table->enum('buyer_type', ['personal', 'business'])->default('personal');

            // Monthly purchase estimate: <100 | 100-500 | 500-2000 | 2000+
            $table->string('monthly_estimate')->nullable();

            // Interest categories stored as JSON array
            $table->json('interest_categories')->nullable();

            /* ── Verification ── */
            // ID document upload path
            $table->string('id_document')->nullable();

            // ID type: national_id | passport | drivers_license
            $table->string('id_type')->nullable();

            // Verification status: pending | verified | rejected
            $table->enum('verification_status', ['pending', 'verified', 'rejected'])
                  ->default('pending');

            $table->timestamp('verified_at')->nullable();

            /* ── Profile completion flag ── */
            $table->boolean('is_complete')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_profiles');
    }
};