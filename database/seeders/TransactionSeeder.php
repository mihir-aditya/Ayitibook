<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed transaction_details
        DB::table('transaction_details')->insert([
            [
                'transaction_id' => 'TXN1001',
                'user_id' => 10,
                'order_id' => 'ORD1001',
                'transaction_type' => 'order_payment',
                'payment_method' => 'Credit Card',
                'amount' => 150.00,
                'transaction_status' => 'success',
                'transaction_date' => now()->subDays(5),
            ],
            [
                'transaction_id' => 'TXN1002',
                'user_id' => 10,
                'order_id' => null,
                'transaction_type' => 'wallet_reload',
                'payment_method' => 'Net Banking',
                'amount' => 200.00,
                'transaction_status' => 'success',
                'transaction_date' => now()->subDays(3),
            ],
            [
                'transaction_id' => 'TXN1003',
                'user_id' => 10,
                'order_id' => 'ORD1002',
                'transaction_type' => 'order_payment',
                'payment_method' => 'Debit Card',
                'amount' => 75.50,
                'transaction_status' => 'pending',
                'transaction_date' => now()->subDays(1),
            ],
        ]);

        // Seed wallet_transactions
        DB::table('wallet_transactions')->insert([
            [
                'transaction_id' => 'WAL1001',
                'user_id' => 10,
                'amount' => 200.00,
                'transaction_type' => 'credit',
                'purpose' => 'Wallet Reload',
                'balance_after' => 200.00,
                'created_at' => now()->subDays(3),
            ],
            [
                'transaction_id' => 'WAL1002',
                'user_id' => 10,
                'amount' => 150.00,
                'transaction_type' => 'debit',
                'purpose' => 'Order Payment',
                'balance_after' => 50.00,
                'created_at' => now()->subDays(2),
            ],
            [
                'transaction_id' => 'WAL1003',
                'user_id' => 10,
                'amount' => 100.00,
                'transaction_type' => 'credit',
                'purpose' => 'Refund',
                'balance_after' => 150.00,
                'created_at' => now()->subDays(1),
            ],
        ]);
    }
}
