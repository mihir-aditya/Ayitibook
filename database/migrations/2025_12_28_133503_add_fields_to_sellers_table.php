<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('sellers', function (Blueprint $table) {
            // $table->string('name')->after('id');
            // $table->string('username')->unique()->after('name');
            // $table->string('email')->unique()->after('username');
            $table->string('password')->after('phone');
        });
    }

    public function down(): void
    {
        Schema::table('sellers', function (Blueprint $table) {
            $table->dropColumn([
                // 'name',
                // 'username',
                // 'email',
                'password'
            ]);
        });
    }
};
