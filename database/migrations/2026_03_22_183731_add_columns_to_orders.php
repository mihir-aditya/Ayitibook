<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Billing info
            $table->string('billing_name')->nullable()->after('address_id');
            $table->string('billing_phone', 20)->nullable()->after('billing_name');
            $table->string('billing_email')->nullable()->after('billing_phone');
            $table->string('billing_address')->nullable()->after('billing_email');
            $table->string('billing_city', 100)->nullable()->after('billing_address');
            $table->string('billing_state', 100)->nullable()->after('billing_city');
            $table->string('billing_country', 100)->nullable()->after('billing_state');
            $table->string('billing_zip', 20)->nullable()->after('billing_country');

            // Shipping info (separate from billing)
            $table->string('shipping_name')->nullable()->after('billing_zip');
            $table->string('shipping_phone', 20)->nullable()->after('shipping_name');
            $table->string('shipping_address')->nullable()->after('shipping_phone');
            $table->string('shipping_city', 100)->nullable()->after('shipping_address');
            $table->string('shipping_state', 100)->nullable()->after('shipping_city');
            $table->string('shipping_country', 100)->nullable()->after('shipping_state');
            $table->string('shipping_zip', 20)->nullable()->after('shipping_country');

            // Financials
            $table->decimal('tax', 10, 2)->default(0)->after('total_amount');
            $table->decimal('shipping_fee', 10, 2)->default(0)->after('tax');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'billing_name','billing_phone','billing_email',
                'billing_address','billing_city','billing_state','billing_country','billing_zip',
                'shipping_name','shipping_phone','shipping_address',
                'shipping_city','shipping_state','shipping_country','shipping_zip',
                'tax','shipping_fee',
            ]);
        });
    }
};