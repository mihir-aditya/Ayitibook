<?php

namespace App\Http\Controllers\Affiliate;

use App\Models\AffiliateClick;
use App\Models\AffiliateLink;
use App\Services\AffiliateLinkService;
use Illuminate\Http\Request;

class ClickTrackingController extends \App\Http\Controllers\Controller
{
    protected AffiliateLinkService $linkService;

    public function __construct(AffiliateLinkService $linkService)
    {
        $this->linkService = $linkService;
    }

    /**
     * Track affiliate link click
     *
     * Usage: /affiliate/track/{linkCode}/{customerId?}
     */
    public function trackClick(Request $request, string $linkCode)
    {
        $customerId = auth()->id(); // auto detect logged in customer

        $affiliateLink = $this->linkService->getAffiliateLink($linkCode);

        if (! $affiliateLink) {
            abort(404, 'Affiliate link not found');
        }

        $click = $this->linkService->recordClick(
            $affiliateLink->id,
            $affiliateLink->affiliate_id,
            $customerId
        );

        $product = $affiliateLink->product;

        if ($product && isset($product->slug)) {
            return redirect()->route('product-details', $product->slug);
        }

        return response()->json([
            'success' => true,
            'click_id' => $click->id,
        ]);
    }

    /**
     * Mark click as converted (purchase made)
     */
    public function markAsConverted(AffiliateClick $click)
    {
        $this->linkService->markClickAsConverted($click);

        return response()->json([
            'success' => true,
            'message' => 'Click marked as converted',
        ]);
    }

    /**
     * Get click statistics
     */
    public function getStatistics(AffiliateLink $affiliateLink)
    {
        $statistics = $this->linkService->getLinkStatistics($affiliateLink);

        return response()->json($statistics);
    }

    /**
     * Webhook to handle customer purchase and mark clicks as converted
     */
public function handlePurchaseWebhook(Request $request)
{
    $validated = $request->validate([
        'customer_id' => 'required|integer',
        'product_id'  => 'required|integer', // ✅ REQUIRED NOW
        'order_id'    => 'required|integer',
        'amount'      => 'required|numeric',
    ]);

    // Find active lock for THIS product only
    $lock = \App\Models\CustomerAffiliateLock::where('customer_id', $validated['customer_id'])
        ->where('product_id', $validated['product_id'])
        ->where('locked_until', '>', now())
        ->first();

    if ($lock) {

        // Convert only clicks related to this product
        AffiliateClick::where('affiliate_id', $lock->affiliate_id)
            ->where('customer_id', $validated['customer_id'])
            ->whereHas('affiliateLink', function ($q) use ($validated) {
                $q->where('product_id', $validated['product_id']);
            })
            ->where('status', 'pending')
            ->update(['status' => 'converted']);
    }

    return response()->json([
        'success' => true,
        'message' => 'Purchase processed',
        'lock_found' => $lock ? true : false,
    ]);
}}
