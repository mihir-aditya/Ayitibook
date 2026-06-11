<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_delivery_partners_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('delivery_partners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('inactive');
            $table->enum('verification_status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->string('id_proof')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->string('vehicle_number')->nullable();
            $table->string('license_number')->nullable();
            $table->decimal('current_latitude', 10, 8)->nullable();
            $table->decimal('current_longitude', 11, 8)->nullable();
            $table->timestamp('last_location_update')->nullable();
            $table->decimal('total_deliveries', 10, 2)->default(0);
            $table->decimal('total_earnings', 10, 2)->default(0);
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('total_ratings')->default(0);
            $table->boolean('is_online')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('delivery_partners');
    }
};