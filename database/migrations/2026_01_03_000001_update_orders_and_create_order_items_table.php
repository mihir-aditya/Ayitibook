<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add columns to existing orders table if they don't exist
        if (Schema::hasTable('orders')) {
            Schema::table('orders', function (Blueprint $table) {
                if (!Schema::hasColumn('orders', 'order_id')) {
                    $table->integer('order_id')->nullable()->unique()->after('id');
                }
                if (!Schema::hasColumn('orders', 'user_id')) {
                    $table->integer('user_id')->nullable()->after('order_id');
                }
                if (!Schema::hasColumn('orders', 'address_id')) {
                    $table->integer('address_id')->nullable()->after('user_id');
                }
                if (!Schema::hasColumn('orders', 'payment_method')) {
                    $table->enum('payment_method', ['COD','Credit Card','Debit Card','UPI','Net Banking','Wallet','Natcash','Moncash'])->nullable()->after('address_id');
                }
                if (!Schema::hasColumn('orders', 'total_amount')) {
                    $table->decimal('total_amount', 10, 2)->nullable()->after('payment_method');
                }
                if (!Schema::hasColumn('orders', 'order_status')) {
                    $table->enum('order_status', ['placed','confirmed','shipped','delivered','cancelled','refunded'])->default('placed')->after('total_amount');
                }
                if (!Schema::hasColumn('orders', 'placed_at')) {
                    $table->timestamp('placed_at')->useCurrent()->nullable()->after('order_status');
                }
            });
        }

        // Create order_items table if not exists
        if (!Schema::hasTable('order_items')) {
            Schema::create('order_items', function (Blueprint $table) {
                $table->id('sl_no');
                $table->integer('order_item_id')->nullable()->unique();
                $table->integer('order_id')->nullable()->index();
                $table->integer('product_id')->nullable()->index();
                $table->integer('variant_id')->nullable()->index();
                $table->integer('quantity')->nullable();
                $table->decimal('price', 10, 2)->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('order_items')) {
            Schema::dropIfExists('order_items');
        }

        if (Schema::hasTable('orders')) {
            Schema::table('orders', function (Blueprint $table) {
                if (Schema::hasColumn('orders', 'placed_at')) {
                    $table->dropColumn('placed_at');
                }
                if (Schema::hasColumn('orders', 'order_status')) {
                    $table->dropColumn('order_status');
                }
                if (Schema::hasColumn('orders', 'total_amount')) {
                    $table->dropColumn('total_amount');
                }
                if (Schema::hasColumn('orders', 'payment_method')) {
                    $table->dropColumn('payment_method');
                }
                if (Schema::hasColumn('orders', 'address_id')) {
                    $table->dropColumn('address_id');
                }
                if (Schema::hasColumn('orders', 'user_id')) {
                    $table->dropColumn('user_id');
                }
                if (Schema::hasColumn('orders', 'order_id')) {
                    $table->dropColumn('order_id');
                }
            });
        }
    }
};
