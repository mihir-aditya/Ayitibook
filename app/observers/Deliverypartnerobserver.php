<?php

namespace App\Observers;

use App\Models\DeliveryPartner;

class DeliveryPartnerObserver
{
    /**
     * Recalculate and persist the badge tier whenever the partner record is saved.
     * We skip the observer recursion by using updateQuietly().
     */
    public function saving(DeliveryPartner $partner): void
    {
        // Only recalculate if any badge-affecting attribute changed
        $watched = ['total_deliveries', 'rating', 'deposit_amount', 'success_rate', 'major_warnings', 'max_cod_value'];

        $isDirty = collect($watched)->some(fn ($col) => $partner->isDirty($col));

        if ($isDirty || $partner->wasRecentlyCreated) {
            $partner->badge_tier = $partner->getBadgeTier();
        }
    }
}