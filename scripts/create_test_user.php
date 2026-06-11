<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Create test user
$user = App\Models\User::create([
    'name' => 'Auto Affiliate Test',
    'email' => 'autofit_test_'.time().'@example.com',
    'password' => bcrypt('password'),
    'status' => 1,
]);

$affiliate = App\Models\Affiliate::where('user_id', $user->id)->first();

echo "User id: {$user->id}\n";
echo "User email: {$user->email}\n";
echo "Affiliate id: " . ($affiliate->id ?? 'null') . "\n";
echo "Affiliate code: " . ($affiliate->affiliate_code ?? 'none') . "\n";
