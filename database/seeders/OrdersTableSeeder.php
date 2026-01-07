<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OrdersTableSeeder extends Seeder
{
    public function run(): void
    {
        // Insert sample orders
        $now = Carbon::now();

        $orders = [
            [
                'order_id' => 100001,
                'user_id' => null,
                'address_id' => null,
                'payment_method' => 'Credit Card',
                'total_amount' => 2499.00,
                'order_status' => 'placed',
                'placed_at' => $now->subDays(6),
                'created_at' => $now->subDays(6),
                'updated_at' => $now->subDays(6),
            ],
            [
                'order_id' => 100002,
                'user_id' => null,
                'address_id' => null,
                'payment_method' => 'UPI',
                'total_amount' => 1599.50,
                'order_status' => 'shipped',
                'placed_at' => $now->subDays(3),
                'created_at' => $now->subDays(3),
                'updated_at' => $now->subDays(3),
            ],
            [
                'order_id' => 100003,
                'user_id' => null,
                'address_id' => null,
                'payment_method' => 'COD',
                'total_amount' => 499.99,
                'order_status' => 'delivered',
                'placed_at' => $now->subDay(),
                'created_at' => $now->subDay(),
                'updated_at' => $now->subDay(),
            ],
        ];

        foreach ($orders as $order) {
            $id = DB::table('orders')->insertGetId($order);

            // create sample order items for each order
            DB::table('order_items')->insert([
                [
                    'order_id' => $order['order_id'],
                    'product_id' => 1,
                    'variant_id' => 1,
                    'quantity' => 1,
                    'price' => $order['total_amount'],
                    'created_at' => $order['placed_at'],
                    'updated_at' => $order['placed_at'],
                ],
            ]);
        }
    }
}
