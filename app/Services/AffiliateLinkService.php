<?php

namespace App\Services;

use App\Models\Affiliate;
use App\Models\AffiliateClick;
use App\Models\AffiliateLink;
use App\Models\CustomerAffiliateLock;
use Illuminate\Support\Str;

class AffiliateLinkService
{
    /**
     * Create affiliate link for a product
     */
    public function createAffiliateLink(
        int $affiliateId,
        int $productId,
        ?string $linkCode = null
    ): AffiliateLink {
        if (! $linkCode) {
            $linkCode = $this->generateUniqueLinkCode();
        }

        return AffiliateLink::create([
            'affiliate_id' => $affiliateId,
            'product_id' => $productId,
            'link_code' => $linkCode,
            'clicks_count' => 0,
        ]);
    }

    /**
     * Generate unique link code
     */
    public function generateUniqueLinkCode(): string
    {
        do {
            $code = 'LNK_'.strtoupper(Str::random(12));
        } while (AffiliateLink::where('link_code', $code)->exists());

        return $code;
    }

    /**
     * Record click on affiliate link
     */
    public function recordClick(
        int $affiliateLinkId,
        int $affiliateId,
        ?int $customerId = null
    ): AffiliateClick {

        $link = AffiliateLink::findOrFail($affiliateLinkId);

        $click = AffiliateClick::create([
            'affiliate_link_id' => $affiliateLinkId,
            'affiliate_id' => $affiliateId,
            'customer_id' => $customerId,
            'click_timestamp' => now(),
            'status' => 'pending',
        ]);

        $link->increment('clicks_count');

        // ✅ Lock per PRODUCT
        if ($customerId) {
            $this->lockCustomerToAffiliate(
                $customerId,
                $affiliateId,
                $link->product_id   // ✅ PASS PRODUCT ID
            );
        }

        return $click;
    }

    /**
     * Mark click as converted
     */
    public function markClickAsConverted(AffiliateClick $click): bool
    {
        return $click->update(['status' => 'converted']);
    }

    /**
     * Get affiliate link by code
     */
    public function getAffiliateLink(string $linkCode): ?AffiliateLink
    {
        return AffiliateLink::where('link_code', $linkCode)->first();
    }

    /**
     * Get all links for affiliate
     */
    public function getAffiliateLinks(int $affiliateId)
    {
        return AffiliateLink::where('affiliate_id', $affiliateId)
            ->with('product')
            ->orderBy('clicks_count', 'desc')
            ->get();
    }

    /**
     * Get top performing links
     */
    public function getTopLinks(int $affiliateId, int $limit = 5)
    {
        return AffiliateLink::where('affiliate_id', $affiliateId)
            ->with('product')
            ->orderBy('clicks_count', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get link statistics
     */
    public function getLinkStatistics(AffiliateLink $link): array
    {
        $clicks = AffiliateClick::where('affiliate_link_id', $link->id)->get();
        $convertedClicks = $clicks->where('status', 'converted')->count();
        $totalClicks = $clicks->count();

        return [
            'total_clicks' => $totalClicks,
            'converted_clicks' => $convertedClicks,
            'conversion_rate' => $totalClicks > 0 ? round(($convertedClicks / $totalClicks) * 100, 2) : 0,
            'pending_clicks' => $clicks->where('status', 'pending')->count(),
        ];
    }

    /**
     * Lock customer to affiliate
     */
    public function lockCustomerToAffiliate(
        int $customerId,
        int $affiliateId,
        int $productId,
        int $daysLocked = 30
    ): void {

        CustomerAffiliateLock::updateOrCreate(
            [
                'customer_id' => $customerId,
                'product_id' => $productId,   // ✅ REQUIRED
            ],
            [
                'affiliate_id' => $affiliateId,
                'locked_until' => now()->addDays($daysLocked),
            ]
        );
    }

    /**
     * Check if customer is locked to affiliate
     */
    public function isCustomerLockedToAffiliate(
        int $customerId,
        int $affiliateId,
        int $productId
    ): bool {

        $lock = CustomerAffiliateLock::where('customer_id', $customerId)
            ->where('product_id', $productId)
            ->where('affiliate_id', $affiliateId)
            ->first();

        if (! $lock) {
            return false;
        }

        if ($lock->locked_until && $lock->locked_until->isPast()) {
            $lock->delete();

            return false;
        }

        return true;
    }

    /**
     * Get total clicks for affiliate
     */
    public function getTotalClicks(int $affiliateId): int
    {
        return AffiliateClick::where('affiliate_id', $affiliateId)->count();
    }

    /**
     * Get conversion rate for affiliate
     */
    public function getConversionRate(int $affiliateId): float
    {
        $clicks = AffiliateClick::where('affiliate_id', $affiliateId);
        $totalClicks = $clicks->count();

        if ($totalClicks == 0) {
            return 0;
        }

        $convertedClicks = (clone $clicks)->where('status', 'converted')->count();

        return round(($convertedClicks / $totalClicks) * 100, 2);
    }

    /**
     * Get click analytics
     */
    public function getClickAnalytics(int $affiliateId): array
    {
        $clicks = AffiliateClick::where('affiliate_id', $affiliateId)->get();

        return [
            'total_clicks' => $clicks->count(),
            'converted_clicks' => $clicks->where('status', 'converted')->count(),
            'pending_clicks' => $clicks->where('status', 'pending')->count(),
            'conversion_rate' => $this->getConversionRate($affiliateId),
            'average_clicks_per_link' => AffiliateLink::where('affiliate_id', $affiliateId)->avg('clicks_count') ?? 0,
        ];
    }

    /**
     * Delete affiliate link
     */
    public function deleteLink(int $linkId): bool
    {
        return AffiliateLink::destroy($linkId) > 0;
    }

    /**
     * Update link status or information
     */
    public function updateLink(int $linkId, array $data): bool
    {
        return AffiliateLink::where('id', $linkId)->update($data);
    }
}
