<?php

use App\Models\Affiliate;
use App\Models\AffiliateClick;
use App\Models\Commission;

/**
 * Calculate commission conversion rate for an affiliate
 */
function calcCommissionConversionRate($affiliateId): float
{
    $affiliate = Affiliate::find($affiliateId);
    
    if (!$affiliate) {
        return 0;
    }

    $totalClicks = $affiliate->affiliateClicks()->count();
    $convertedClicks = $affiliate->affiliateClicks()->where('status', 'converted')->count();

    if ($totalClicks == 0) {
        return 0;
    }

    return round(($convertedClicks / $totalClicks) * 100, 2);
}

/**
 * Calculate commission amount based on order and percentage
 */
function calculateCommissionAmount($orderAmount, $commissionPercentage): float
{
    return round(($orderAmount * $commissionPercentage) / 100, 2);
}

/**
 * Generate unique affiliate link code
 */
function generateAffiliateLinkCode(): string
{
    $code = 'LNK_' . strtoupper(uniqid());
    
    // Ensure uniqueness
    while (\App\Models\AffiliateLink::where('link_code', $code)->exists()) {
        $code = 'LNK_' . strtoupper(uniqid());
    }
    
    return $code;
}

/**
 * Generate unique affiliate code
 */
function generateAffiliateCode(): string
{
    $code = 'AFF_' . strtoupper(bin2hex(random_bytes(4)));
    
    // Ensure uniqueness
    while (Affiliate::where('affiliate_code', $code)->exists()) {
        $code = 'AFF_' . strtoupper(bin2hex(random_bytes(4)));
    }
    
    return $code;
}

/**
 * Record affiliate click
 */
function recordAffiliateClick($affiliateLinkId, $affiliateId, $customerId): AffiliateClick
{
    return AffiliateClick::create([
        'affiliate_link_id' => $affiliateLinkId,
        'affiliate_id' => $affiliateId,
        'customer_id' => $customerId,
        'click_timestamp' => now(),
        'status' => 'pending',
    ]);
}

/**
 * Create or update commission for order
 */
function createCommissionForOrder($orderId, $affiliateId, $customerId, $amount, $commissionPercentage = 5): Commission
{
    $commission = Commission::updateOrCreate(
        ['order_id' => $orderId, 'affiliate_id' => $affiliateId],
        [
            'customer_id' => $customerId,
            'amount' => calculateCommissionAmount($amount, $commissionPercentage),
            'commission_percentage' => $commissionPercentage,
            'status' => 'pending',
        ]
    );

    return $commission;
}

/**
 * Update affiliate total earnings
 */
function updateAffiliateTotalEarnings($affiliateId): void
{
    $affiliate = Affiliate::find($affiliateId);
    
    if ($affiliate) {
        $totalEarnings = Commission::where('affiliate_id', $affiliateId)
            ->where('status', 'paid')
            ->sum('amount');
        
        $affiliate->update(['total_earnings' => $totalEarnings]);
    }
}

/**
 * Get earning summary for affiliate
 */
function getAffiliateEarningSummary($affiliateId): array
{
    $affiliate = Affiliate::find($affiliateId);
    
    if (!$affiliate) {
        return [];
    }

    return [
        'total_earnings' => $affiliate->total_earnings,
        'pending_amount' => $affiliate->commissions()->where('status', 'pending')->sum('amount'),
        'approved_amount' => $affiliate->commissions()->where('status', 'approved')->sum('amount'),
        'paid_amount' => $affiliate->commissions()->where('status', 'paid')->sum('amount'),
        'total_clicks' => $affiliate->affiliateClicks()->count(),
        'total_links' => $affiliate->affiliateLinks()->count(),
        'conversion_rate' => calcCommissionConversionRate($affiliateId),
    ];
}

/**
 * Get top performing affiliate links
 */
function getTopAffiliateLinks($affiliateId, $limit = 5): \Illuminate\Database\Eloquent\Collection
{
    return \App\Models\AffiliateLink::where('affiliate_id', $affiliateId)
        ->orderBy('clicks_count', 'desc')
        ->limit($limit)
        ->get();
}

/**
 * Get monthly earnings for affiliate
 */
function getMonthlyEarnings($affiliateId, $month = null, $year = null): float
{
    $month = $month ?? now()->month;
    $year = $year ?? now()->year;

    return Commission::where('affiliate_id', $affiliateId)
        ->where('status', 'paid')
        ->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->sum('amount');
}

/**
 * Check if customer is locked to affiliate
 */
function isCustomerLockedToAffiliate($customerId, $affiliateId): bool
{
    $lock = \App\Models\CustomerAffiliateLock::where('customer_id', $customerId)
        ->where('affiliate_id', $affiliateId)
        ->first();

    if (!$lock) {
        return false;
    }

    if ($lock->locked_until && $lock->locked_until->isPast()) {
        $lock->delete();
        return false;
    }

    return true;
}

/**
 * Lock customer to affiliate
 */
function lockCustomerToAffiliate($customerId, $affiliateId, $daysLocked = 30): void
{
    \App\Models\CustomerAffiliateLock::updateOrCreate(
        ['customer_id' => $customerId, 'affiliate_id' => $affiliateId],
        ['locked_until' => now()->addDays($daysLocked)]
    );
}
