<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sellers', function (Blueprint $table) {

            // Identity
            $table->string('national_id')->nullable()->unique()->after('username');

            // Location
            $table->string('municipality')->nullable()->after('shop_address');

            // Products
            $table->json('product_categories')->nullable()->after('municipality');
            $table->enum('serial_number_type', ['has_sn', 'has_lot', 'auto_generate'])->nullable()->after('product_categories');
            $table->boolean('accepts_cod')->default(false)->after('serial_number_type');

            // Payment
            $table->enum('payment_method', ['bank', 'wallet'])->nullable()->after('accepts_cod');

            // Seller obligations
            $table->boolean('agreed_video_before_shipping')->default(false)->after('payment_method');
            $table->boolean('agreed_qr_otp_validation')->default(false)->after('agreed_video_before_shipping');
            $table->boolean('agreed_returns_48hrs')->default(false)->after('agreed_qr_otp_validation');
            $table->boolean('agreed_insurance_fund')->default(false)->after('agreed_returns_48hrs');
            $table->boolean('agreed_rating_penalty')->default(false)->after('agreed_insurance_fund');

            // Digital agreement
            $table->boolean('agreed_to_terms')->default(false)->after('agreed_rating_penalty');

            // Phone verification
            $table->timestamp('phone_verified_at')->nullable()->after('agreed_to_terms');

        });
    }

    public function down(): void
    {
        Schema::table('sellers', function (Blueprint $table) {
            $table->dropColumn([
                'national_id',
                'municipality',
                'product_categories',
                'serial_number_type',
                'accepts_cod',
                'payment_method',
                'agreed_video_before_shipping',
                'agreed_qr_otp_validation',
                'agreed_returns_48hrs',
                'agreed_insurance_fund',
                'agreed_rating_penalty',
                'agreed_to_terms',
                'phone_verified_at',
            ]);
        });
    }
};