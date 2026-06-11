<?php

namespace App\Traits;

trait HasDeliveryBadge
{
    /**
     * Badge tier definitions.
     * Order matters: check highest tier first (Platinum → Gold → … → Beginner)
     */
    public static function badgeTiers(): array
    {
        return [
            'platinum' => [
                'label'        => 'Platinum',
                'color'        => '#7B68EE',   // medium-slate-blue
                'bg_class'     => 'badge-platinum',
                'icon'         => 'fas fa-gem',
                'min_rating'   => 4.8,
                'min_deposit'  => null,        // dynamic: deposit ≥ max COD value
                'max_warnings' => 0,
                'min_deliveries' => 0,         // any count
                'min_success_rate' => null,
            ],
            'gold' => [
                'label'        => 'Gold',
                'color'        => '#FFD700',
                'bg_class'     => 'badge-gold',
                'icon'         => 'fas fa-trophy',
                'min_deliveries' => 1500,
                'max_deliveries' => 4999,
                'min_rating'   => 4.7,
                'min_success_rate' => 95.0,
                'min_deposit'  => 1500,
                'max_warnings' => 0,           // 0 major warnings
            ],
            'silver' => [
                'label'        => 'Silver',
                'color'        => '#C0C0C0',
                'bg_class'     => 'badge-silver',
                'icon'         => 'fas fa-medal',
                'min_deliveries' => 300,
                'max_deliveries' => 1499,
                'min_rating'   => 4.6,
                'min_success_rate' => 90.0,
                'min_deposit'  => 1000,
                'max_warnings' => null,
            ],
            'bronze' => [
                'label'        => 'Bronze',
                'color'        => '#CD7F32',
                'bg_class'     => 'badge-bronze',
                'icon'         => 'fas fa-award',
                'min_deliveries' => 50,
                'max_deliveries' => 299,
                'min_rating'   => 4.5,
                'min_success_rate' => null,
                'min_deposit'  => 500,
                'max_warnings' => null,
            ],
            'beginner' => [
                'label'        => 'Beginner',
                'color'        => '#6C757D',
                'bg_class'     => 'badge-beginner',
                'icon'         => 'fas fa-star',
                'min_deliveries' => 0,
                'max_deliveries' => 49,
                'min_rating'   => 4.5,
                'min_success_rate' => null,
                'min_deposit'  => 250,
                'max_warnings' => null,
            ],
        ];
    }

    /**
     * Compute the partner's current badge tier key.
     * Returns 'unranked' if no tier criteria are met.
     *
     * Requires on the model:
     *   - $this->total_deliveries  (int)
     *   - $this->rating            (float)
     *   - $this->deposit_amount    (float, in HTG)
     *   - $this->success_rate      (float, 0–100)
     *   - $this->major_warnings    (int)
     *   - $this->max_cod_value     (float) — for Platinum deposit check
     */
    public function getBadgeTier(): string
    {
        $deliveries   = (int)   ($this->total_deliveries  ?? 0);
        $rating       = (float) ($this->rating            ?? 0);
        $deposit      = (float) ($this->deposit_amount    ?? 0);
        $successRate  = (float) ($this->success_rate      ?? 0);
        $warnings     = (int)   ($this->major_warnings    ?? 0);
        $maxCod       = (float) ($this->max_cod_value     ?? 0);

        // --- Platinum ---
        if (
            $rating   >= 4.8  &&
            $warnings === 0   &&
            $deposit  >= $maxCod
        ) {
            return 'platinum';
        }

        // --- Gold ---
        if (
            $deliveries >= 1500 && $deliveries <= 4999 &&
            $rating      >= 4.7  &&
            $successRate >= 95.0 &&
            $deposit     >= 1500 &&
            $warnings    === 0
        ) {
            return 'gold';
        }

        // --- Silver ---
        if (
            $deliveries >= 300  && $deliveries <= 1499 &&
            $rating      >= 4.6  &&
            $successRate >= 90.0 &&
            $deposit     >= 1000
        ) {
            return 'silver';
        }

        // --- Bronze ---
        if (
            $deliveries >= 50  && $deliveries <= 299 &&
            $rating      >= 4.5 &&
            $deposit     >= 500
        ) {
            return 'bronze';
        }

        // --- Beginner ---
        if (
            $deliveries <= 49 &&
            $rating     >= 4.5 &&
            $deposit    >= 250
        ) {
            return 'beginner';
        }

        return 'unranked';
    }

    /**
     * Returns the full tier config array for the partner's current badge.
     */
    public function getBadgeInfo(): array
    {
        $tier = $this->getBadgeTier();
        return self::badgeTiers()[$tier] ?? [
            'label'    => 'Unranked',
            'color'    => '#adb5bd',
            'bg_class' => 'badge-unranked',
            'icon'     => 'fas fa-question-circle',
        ];
    }

    /**
     * What requirements are missing before the partner reaches the NEXT tier.
     * Returns an array of human-readable strings.
     */
    public function getBadgeProgressHints(): array
    {
        $currentTier = $this->getBadgeTier();
        $tierOrder   = ['unranked', 'beginner', 'bronze', 'silver', 'gold', 'platinum'];
        $currentIdx  = array_search($currentTier, $tierOrder);
        $nextTierKey = $tierOrder[$currentIdx + 1] ?? null;

        if (! $nextTierKey || $nextTierKey === 'platinum') {
            // Build platinum hints manually (dynamic deposit)
            return $this->platinumHints();
        }

        $tiers      = self::badgeTiers();
        $next       = $tiers[$nextTierKey];
        $hints      = [];
        $deliveries  = (int)   ($this->total_deliveries ?? 0);
        $rating      = (float) ($this->rating           ?? 0);
        $deposit     = (float) ($this->deposit_amount   ?? 0);
        $successRate = (float) ($this->success_rate     ?? 0);

        if (isset($next['min_deliveries']) && $deliveries < $next['min_deliveries']) {
            $hints[] = ($next['min_deliveries'] - $deliveries) . ' more deliveries needed';
        }
        if ($rating < $next['min_rating']) {
            $hints[] = 'Raise rating to ' . $next['min_rating'] . ' (currently ' . number_format($rating, 1) . ')';
        }
        if ($next['min_success_rate'] && $successRate < $next['min_success_rate']) {
            $hints[] = 'Improve success rate to ' . $next['min_success_rate'] . '% (currently ' . number_format($successRate, 1) . '%)';
        }
        if ($next['min_deposit'] && $deposit < $next['min_deposit']) {
            $needed = $next['min_deposit'] - $deposit;
            $hints[] = 'Deposit ' . number_format($needed, 0) . ' HTG more (need ' . number_format($next['min_deposit'], 0) . ' HTG total)';
        }

        return $hints;
    }

    private function platinumHints(): array
    {
        $hints       = [];
        $rating      = (float) ($this->rating         ?? 0);
        $warnings    = (int)   ($this->major_warnings ?? 0);
        $deposit     = (float) ($this->deposit_amount ?? 0);
        $maxCod      = (float) ($this->max_cod_value  ?? 0);

        if ($rating   < 4.8)   $hints[] = 'Raise rating to 4.8 (currently ' . number_format($rating, 1) . ')';
        if ($warnings > 0)     $hints[] = 'Resolve all ' . $warnings . ' major warning(s)';
        if ($deposit  < $maxCod) {
            $needed = $maxCod - $deposit;
            $hints[] = 'Deposit ' . number_format($needed, 0) . ' HTG more to cover your max COD value (' . number_format($maxCod, 0) . ' HTG)';
        }

        return $hints;
    }
}