<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->enum('role', ['admin', 'manager', 'support'])
                  ->default('support')
                  ->after('status');
        });

        // Promote existing super_admin rows to role='admin'
        DB::table('admins')->where('super_admin', true)->update(['role' => 'admin']);
    }

    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};