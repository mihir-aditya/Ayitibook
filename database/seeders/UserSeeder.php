<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Test User',
                'username' => 'testuser',
                'phone' => '9999999999',
                'password' => Hash::make('password'),
                'status' => 1,
                'wallet_balance' => 100.00
            ]
        );
    }
}
