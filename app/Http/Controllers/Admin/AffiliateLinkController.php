<?php
// app/Http/Controllers/Admin/AffiliateLinkController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Models\AffiliateLink;
use App\Models\Product;
use Illuminate\Http\Request;

class AffiliateLinkController extends Controller
{
    /**
     * Display a listing of affiliate links.
     */
    public function index(Request $request)
    {
        $query = AffiliateLink::with(['affiliate.user', 'product']);

        // Filter by affiliate
        if ($request->has('affiliate_id') && !empty($request->affiliate_id)) {
            $query->where('affiliate_id', $request->affiliate_id);
        }

        // Search by link code
        if ($request->has('search') && !empty($request->search)) {
            $query->where('link_code', 'like', "%{$request->search}%");
        }

        $links = $query->orderBy('created_at', 'desc')->paginate(20);
        $affiliates = Affiliate::with('user')->where('status', 'active')->get();

        return view('admin.affiliate-links.index', compact('links', 'affiliates'));
    }

    /**
     * Show the form for creating a new link.
     */
    public function create(Request $request)
    {
        $affiliate = null;
        if ($request->has('affiliate_id')) {
            $affiliate = Affiliate::with('user')->findOrFail($request->affiliate_id);
        }

        $affiliates = Affiliate::with('user')->where('status', 'active')->get();
        $products = Product::where('is_active', '1')->get();

        return view('admin.affiliate-links.create', compact('affiliates', 'products', 'affiliate'));
    }

    /**
     * Store a newly created link.
     */
    public function store(Request $request)
    {
        $request->validate([
            'affiliate_id' => 'required|exists:affiliates,id',
            'product_id' => 'nullable|exists:products,id',
        ]);

        $link = AffiliateLink::create([
            'affiliate_id' => $request->affiliate_id,
            'product_id' => $request->product_id,
            'link_code' => $this->generateUniqueLinkCode(),
            'clicks_count' => 0,
        ]);

        return redirect()->route('admin.affiliate.links.show', $link)
                         ->with('success', 'Affiliate link created successfully.');
    }

    /**
     * Display the specified link.
     */
    public function show(AffiliateLink $affiliateLink)
    {
        $affiliateLink->load(['affiliate.user', 'product', 'clicks.customer']);

        $clicks = $affiliateLink->clicks()->latest()->paginate(20);

        return view('admin.affiliate-links.show', compact('affiliateLink', 'clicks'));
    }

    /**
     * Show the form for editing the specified link.
     */
    public function edit(AffiliateLink $affiliateLink)
    {
        $products = Product::where('is_active', '1')->get();

        return view('admin.affiliate-links.edit', compact('affiliateLink', 'products'));
    }

    /**
     * Update the specified link.
     */
    public function update(Request $request, AffiliateLink $affiliateLink)
    {
        $request->validate([
            'product_id' => 'nullable|exists:products,id',
        ]);

        $affiliateLink->update([
            'product_id' => $request->product_id,
        ]);

        return redirect()->route('admin.affiliate.links.show', $affiliateLink)
                         ->with('success', 'Affiliate link updated successfully.');
    }

    /**
     * Remove the specified link.
     */
    public function destroy(AffiliateLink $affiliateLink)
    {
        // Check if link has any clicks
        if ($affiliateLink->clicks()->exists()) {
            return back()->with('error', 'Cannot delete link with associated clicks.');
        }

        $affiliateLink->delete();

        return redirect()->route('admin.affiliate.links.index')
                         ->with('success', 'Affiliate link deleted successfully.');
    }

    /**
     * Generate a unique link code.
     */
    private function generateUniqueLinkCode(): string
    {
        do {
            $code = strtoupper(uniqid());
        } while (AffiliateLink::where('link_code', $code)->exists());

        return $code;
    }
}