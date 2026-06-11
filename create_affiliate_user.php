<?php

$user = \App\Models\User::create([
    'name' => 'Affiliate User',
    'email' => 'example@gmail.com',
    'password' => bcrypt('12345678'),
    'status' => 1,
]);

$affiliate = \App\Models\Affiliate::create([
    'user_id' => $user->id,
    'affiliate_code' => 'AFFD_' . strtoupper(uniqid()),
    'status' => 'active',
    'total_earnings' => 0,
]);

echo "User created: " . $user->id . "\n";
echo "Affiliate created: " . $affiliate->id . "\n";
echo "Email: " . $user->email . "\n";
echo "Password: 12345678\n";
