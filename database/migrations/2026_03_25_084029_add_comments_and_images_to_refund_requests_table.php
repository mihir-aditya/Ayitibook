<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommentsAndImagesToRefundRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('refund_requests', function (Blueprint $table) {
            $table->text('comments')->nullable()->after('reason');
            $table->json('images')->nullable()->after('comments');
        });
    }

    public function down()
    {
        Schema::table('refund_requests', function (Blueprint $table) {
            $table->dropColumn(['comments', 'images']);
        });
    }
}