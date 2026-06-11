<?php

namespace App\Console\Commands;


use App\Models\DeliveryPartner;
use Illuminate\Console\Command;

class RecalculateDeliveryBadges extends Command
{
    protected $signature   = 'badges:recalculate {--id= : Recalculate for a single partner}';
    protected $description = 'Recompute and persist badge_tier for all delivery partners';

    public function handle(): void
    {
        $query = DeliveryPartner::query();

        if ($id = $this->option('id')) {
            $query->where('id', $id);
        }

        $updated = 0;

        $query->each(function (DeliveryPartner $partner) use (&$updated) {
            $newTier = $partner->getBadgeTier();

            if ($partner->badge_tier !== $newTier) {
                // updateQuietly to avoid re-triggering the observer in a loop
                $partner->updateQuietly(['badge_tier' => $newTier]);
                $updated++;
            }
        });

        $this->info("Done. {$updated} badge(s) updated.");
    }
}