<?php

namespace Database\Seeders;

use App\Models\BnplTier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BnplTiersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tiers = [
            [
                'tier_name' => 'none',
                'display_name' => 'Not Eligible',
                'min_score' => 0,
                'max_score' => 67,
                'limit_amount' => 0,
                'description' => 'Not eligible for BNPL',
                'sort_order' => 1,
            ],
            [
                'tier_name' => 'starter',
                'display_name' => 'Starter',
                'min_score' => 68,
                'max_score' => 79,
                'limit_amount' => 12,
                'description' => 'Lowest loan tier',
                'sort_order' => 2,
            ],
            [
                'tier_name' => 'growth',
                'display_name' => 'Growth',
                'min_score' => 80,
                'max_score' => 90,
                'limit_amount' => 19,
                'description' => 'Medium tier',
                'sort_order' => 3,
            ],
            [
                'tier_name' => 'plus',
                'display_name' => 'Plus',
                'min_score' => 91,
                'max_score' => 95,
                'limit_amount' => 28,
                'description' => 'Maximum loan tier',
                'sort_order' => 4,
            ],
            [
                'tier_name' => 'pro',
                'display_name' => 'Pro',
                'min_score' => 96,
                'max_score' => 100,
                'limit_amount' => 38,
                'description' => 'Maximum loan tier',
                'sort_order' => 5,
            ],
        ];

        foreach ($tiers as $tier) {
            BnplTier::updateOrCreate(
                ['tier_name' => $tier['tier_name']],
                $tier
            );
        }
    }
}
