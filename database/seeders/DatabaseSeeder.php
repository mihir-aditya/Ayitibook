<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            \Database\Seeders\OrdersTableSeeder::class,
            TransactionSeeder::class,
        ]);
        $this->call(CategorySeeder::class);
    }
}
