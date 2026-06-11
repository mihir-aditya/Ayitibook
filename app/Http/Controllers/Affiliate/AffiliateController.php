<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Models\AffiliateLink;
use App\Models\Commission;
use App\Models\Product;
use App\Services\AffiliateLinkService;
use App\Services\CommissionService;
use App\Http\Requests\CreateAffiliateLinkRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class AffiliateController extends Controller
{
    public function __construct(
        protected AffiliateLinkService $linkService,
        protected CommissionService $commissionService
    ) {}

    // ─────────────────────────────────────────────
    // Affiliate CRUD
    // ─────────────────────────────────────────────

    /**
     * Display a listing of all affiliates.
     */
    public function index()
    {
        $affiliates = Affiliate::with(['user', 'affiliateLinks', 'commissions'])
            ->paginate(15);

        return view('affiliate.index', compact('affiliates'));
    }

    /**
     * Show the form for creating a new affiliate.
     */
    public function create()
    {
        return view('affiliate.create');
    }

    /**
     * Store a newly created affiliate in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'user_id'        => 'required|exists:users,id|unique:affiliates,user_id',
            'affiliate_code' => 'required|unique:affiliates,affiliate_code',
            'status'         => 'required|in:active,suspended',
        ]);

        $affiliate = Affiliate::create($validated);

        return $this->redirectToAffiliate('show', $affiliate->id, 'Affiliate created successfully');
    }

    /**
     * Display the specified affiliate.
     */
    public function show(Affiliate $affiliate)
    {
        $this->authorizeOwner($affiliate);

        $affiliate->load(['user', 'affiliateLinks', 'commissions', 'affiliateClicks']);

        $totalEarnings       = $affiliate->commissions()->sum('amount');
        $totalClicks         = $affiliate->affiliateClicks()->count();
        $approvedCommissions = $affiliate->commissions()->where('status', 'approved')->count();

        return view('affiliate.show', compact('affiliate', 'totalEarnings', 'totalClicks', 'approvedCommissions'));
    }

    /**
     * Show the form for editing the specified affiliate.
     */
    public function edit(Affiliate $affiliate)
    {
        $this->authorizeOwner($affiliate);

        return view('affiliate.edit', compact('affiliate'));
    }

    /**
     * Update the specified affiliate in storage.
     */
    public function update(Request $request, Affiliate $affiliate): RedirectResponse
    {
        $this->authorizeOwner($affiliate);

        $validated = $request->validate([
            'affiliate_code' => 'required|unique:affiliates,affiliate_code,' . $affiliate->id,
            'status'         => 'required|in:active,suspended',
            'total_earnings' => 'nullable|numeric|min:0',
        ]);

        $affiliate->update($validated);

        return $this->redirectToAffiliate('show', $affiliate->id, 'Affiliate updated successfully');
    }

    /**
     * Remove the specified affiliate from storage.
     */
    public function destroy(Affiliate $affiliate): RedirectResponse
    {
        $this->authorizeOwner($affiliate);

        $affiliate->delete();

        return $this->redirectToAffiliate('index', null, 'Affiliate deleted successfully');
    }

    // ─────────────────────────────────────────────
    // Affiliate Links
    // ─────────────────────────────────────────────

    /**
     * Get affiliate links for the given affiliate.
     */
    public function getLinks(Affiliate $affiliate)
    {
        $this->authorizeOwner($affiliate);

        $links    = $affiliate->affiliateLinks()->with('product')->paginate(10);
        $products = Product::query()->orderBy('name')->get();

        return view('affiliate.links', compact('affiliate', 'links', 'products'));
    }

    /**
     * Show form to create a new affiliate link.
     */
    public function createLink(Affiliate $affiliate)
    {
        $this->authorizeOwner($affiliate);

        $products = Product::query()->orderBy('name')->get();

        return view('affiliate.create_link', compact('affiliate', 'products'));
    }

    /**
     * Store a newly created affiliate link.
     */
    public function storeLink(CreateAffiliateLinkRequest $request, Affiliate $affiliate): RedirectResponse
    {
        $this->authorizeOwner($affiliate);

        $data = $request->validated();

        $link = $this->linkService->createAffiliateLink(
            $affiliate->id,
            (int) $data['product_id'],
            $data['link_code'] ?? null
        );

        return redirect()->route('affiliate.links', $affiliate->affiliate_code)
            ->with('success', 'Link created! Your code: ' . $link->link_code);
    }

    /**
     * Delete an affiliate link, ensuring it belongs to the given affiliate.
     */
    public function destroyLink(Affiliate $affiliate, AffiliateLink $link): RedirectResponse
    {
        $this->authorizeOwner($affiliate);

        // Ensure the link actually belongs to this affiliate
        if ($link->affiliate_id !== $affiliate->id) {
            abort(403);
        }

        $link->delete();

        return redirect()->route('affiliate.links', $affiliate->affiliate_code)
            ->with('success', 'Link deleted successfully');
    }

    // ─────────────────────────────────────────────
    // Commissions
    // ─────────────────────────────────────────────

    /**
     * Get commission details for the given affiliate.
     */
    public function getCommissions(Affiliate $affiliate)
    {
        // FIX: was missing authorizeOwner — any user could see any affiliate's commissions
        $this->authorizeOwner($affiliate);

        $commissions = $affiliate->commissions()
            ->with(['order', 'customer'])
            ->paginate(15);

        $totalCommissions   = $affiliate->commissions()->sum('amount');
        $pendingCommissions = $affiliate->commissions()
            ->where('status', 'pending')
            ->sum('amount');

        return view('affiliate.commissions', compact(
            'affiliate',
            'commissions',
            'totalCommissions',
            'pendingCommissions'
        ));
    }

    /**
     * Approve a commission. Admin only.
     */
    public function approveCommission(Commission $commission): RedirectResponse
    {
        $this->authorizeAdmin();

        $commission->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Commission approved successfully');
    }

    /**
     * Reject a commission. Admin only.
     */
    public function rejectCommission(Commission $commission): RedirectResponse
    {
        $this->authorizeAdmin();

        $commission->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Commission rejected successfully');
    }

    /**
     * Mark a commission as paid. Admin only.
     */
    public function payCommission(Commission $commission): RedirectResponse
    {
        $this->authorizeAdmin();

        $commission->update(['status' => 'paid']);

        return redirect()->back()->with('success', 'Commission marked as paid successfully');
    }

    /**
     * Bulk approve commissions. Admin only.
     */
    public function bulkApproveCommissions(Request $request): RedirectResponse
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'commission_ids'   => 'required|array',
            'commission_ids.*' => 'integer|exists:commissions,id',
        ]);

        $ids = $validated['commission_ids'];

        Commission::whereIn('id', $ids)->update(['status' => 'approved']);

        return redirect()->back()
            ->with('success', count($ids) . ' commissions approved successfully');
    }

    /**
     * Bulk update affiliate status. Admin only.
     */
    public function bulkStatusUpdate(Request $request): RedirectResponse
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'affiliate_ids'   => 'required|array',
            'affiliate_ids.*' => 'integer|exists:affiliates,id',
            'status'          => 'required|in:active,suspended',
        ]);

        Affiliate::whereIn('id', $validated['affiliate_ids'])
            ->update(['status' => $validated['status']]);

        return redirect()->back()
            ->with('success', count($validated['affiliate_ids']) . ' affiliates updated successfully');
    }

    // ─────────────────────────────────────────────
    // Analytics & Dashboard
    // ─────────────────────────────────────────────

    /**
     * Get click analytics for the given affiliate.
     */
    public function getClicks(Affiliate $affiliate)
    {
        $this->authorizeOwner($affiliate);

        $clicks = $affiliate->affiliateClicks()
            ->with(['affiliateLink', 'customer'])
            ->paginate(20);

        $totalClicks    = $this->linkService->getTotalClicks($affiliate->id);
        $conversionRate = $this->linkService->getConversionRate($affiliate->id);

        return view('affiliate.clicks', compact('affiliate', 'clicks', 'totalClicks', 'conversionRate'));
    }

    /**
     * Get affiliate dashboard/statistics.
     */
    public function dashboard(Affiliate $affiliate)
    {
        $this->authorizeOwner($affiliate);

        $totalEarnings   = $affiliate->commissions()->sum('amount');
        $monthlyEarnings = $affiliate->commissions()
            ->where('status', 'paid')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('amount');

        $totalClicks         = $affiliate->affiliateClicks()->count();
        $totalLinks          = $affiliate->affiliateLinks()->count();
        $approvedCommissions = $affiliate->commissions()->where('status', 'approved')->count();

        $recentCommissions = $affiliate->commissions()
            ->latest()
            ->limit(5)
            ->get();

        return view('affiliate.dashboard', compact(
            'affiliate',
            'totalEarnings',
            'monthlyEarnings',
            'totalClicks',
            'totalLinks',
            'approvedCommissions',
            'recentCommissions'
        ));
    }

    /**
     * Get products being tracked by affiliates (admin view).
     */
    public function trackedProducts()
    {
        $this->authorizeAdmin();

        // FIX: The original used a broken join() inside a withCount() closure.
        // Click counts are now loaded via the relationship aggregate on AffiliateLink,
        // then summed at the collection level — or move this to a dedicated query/scope.
        $trackedProducts = Product::query()
            ->with([
                'affiliateLinks.affiliate.user',
                'affiliateLinks' => fn ($q) => $q->withCount('affiliateClicks'),
            ])
            ->whereHas('affiliateLinks')
            ->withCount('affiliateLinks as total_links')
            ->paginate(15);

        // Compute total_clicks per product in PHP after the eager load,
        // since withCount + join across a hasManyThrough is unreliable.
        $trackedProducts->each(function ($product) {
            $product->total_clicks = $product->affiliateLinks->sum('affiliate_clicks_count');
        });

        return view('admin.affiliate.tracked-products', compact('trackedProducts'));
    }

    // ─────────────────────────────────────────────
    // Quick Link Generation (AJAX — product detail page)
    // ─────────────────────────────────────────────

    /**
     * Generate (or retrieve) an affiliate link for the authenticated user + product.
     * Called via AJAX from the product-details share button.
     * Returns JSON: { url, link_code, commission_percentage }
     */
    public function generateLinkForProduct(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $user = auth()->user();

        // Resolve the affiliate record for this user
        $affiliate = Affiliate::where('user_id', $user->id)
            ->where('status', 'active')
            ->first();

        if (! $affiliate) {
            return response()->json(['not_affiliate' => true, 'message' => 'You are not an active affiliate.'], 403);
        }

        $productId = (int) $validated['product_id'];

        // Reuse an existing link for this affiliate+product combo if one exists
        $link = AffiliateLink::where('affiliate_id', $affiliate->id)
            ->where('product_id', $productId)
            ->first();

        if (! $link) {
            $link = $this->linkService->createAffiliateLink($affiliate->id, $productId);
        }

        $product = Product::find($productId);

        return response()->json([
            'url'                   => route('affiliate.track', ['code' => $link->link_code]),
            'link_code'             => $link->link_code,
            'commission_percentage' => $product?->affiliate_percentage,
        ]);
    }

    // ─────────────────────────────────────────────
    // ─────────────────────────────────────────────

    /**
     * Ensure the authenticated user owns this affiliate record.
     * Admins bypass this check.
     */
    protected function authorizeOwner(Affiliate $affiliate): void
    {
        if (auth('admin')->check()) {
            return;
        }

        if (! auth()->check() || auth()->id() !== $affiliate->user_id) {
            abort(403);
        }
    }

    /**
     * Ensure the current request is made by an admin.
     */
    protected function authorizeAdmin(): void
    {
        if (! auth('admin')->check()) {
            abort(403);
        }
    }

    /**
     * Redirect to the appropriate admin or affiliate route after a mutation.
     *
     * @param  string      $action  'show' | 'index'
     * @param  int|null    $id
     * @param  string      $message
     */
    protected function redirectToAffiliate(string $action, ?int $id, string $message): RedirectResponse
    {
        $guard = auth('admin')->check() ? 'admin.affiliate' : 'affiliate';

        $route = $action === 'index'
            ? route("dashboard")
            : route("affiliate.dashboard", $id);

        return redirect($route)->with('success', $message);
    }
}