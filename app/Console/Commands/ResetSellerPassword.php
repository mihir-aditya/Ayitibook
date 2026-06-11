<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;

class ResetSellerPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seller:reset-password {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset seller password by email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        $seller = Seller::where('email', $email)->first();

        if (!$seller) {
            $this->error('Seller not found ❌');
            return;
        }

        $seller->password = Hash::make($password);
        $seller->save();

        $this->info('✅ Seller password updated successfully');
    }
}
