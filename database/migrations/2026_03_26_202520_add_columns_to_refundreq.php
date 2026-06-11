<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('refund_requests', function (Blueprint $table) {
            // Amount decided by admin at approval time
            $table->decimal('refund_amount', 10, 2)->nullable()->after('status');

            // Admin's decision note / internal comment
            $table->text('admin_note')->nullable()->after('refund_amount');
        });
    }

    public function down(): void
    {
        Schema::table('refund_requests', function (Blueprint $table) {
            $table->dropColumn(['refund_amount', 'admin_note']);
        });
    }
};