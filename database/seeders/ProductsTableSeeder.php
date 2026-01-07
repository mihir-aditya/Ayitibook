<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $names = [
            "Logitech G502 Hero Mouse", "Razer BlackWidow Keyboard", "HyperX Cloud II Headset",
            "ASUS TUF Gaming Monitor", "SteelSeries QcK Mousepad", "Corsair K70 RGB Keyboard",
            "MSI Optix Gaming Monitor", "Acer Predator Gaming Chair", "Cooler Master Gaming Case",
            "NZXT Kraken Z63 Cooler", "Gigabyte Aorus GPU", "AMD Ryzen 9 Processor",
            "Intel i9 Processor", "Samsung 980 Pro SSD", "WD Black HDD",
            "Seagate Barracuda HDD", "Kingston Fury RAM", "G.Skill Trident RAM",
            "Logitech G733 Headset", "Razer DeathAdder Mouse"
        ];

        $products = [];

        for ($i = 1; $i <= 50; $i++) {
            $name = $names[array_rand($names)];
            $products[] = [
                'name' => $name,
                'seller_id' => 3,
                'slug' => Str::slug($name) . '-' . $i,
                'description' => "High quality {$name} for gamers",
                'price' => rand(2000, 50000) / 100, // between 20.00 and 500.00
                'currency' => 'USD',
                'stock_quantity' => rand(10, 500),
                'sku' => 'SKU-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'is_active' => 1,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('products')->insert($products);
    }
}
