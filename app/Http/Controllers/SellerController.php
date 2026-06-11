<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    /**
     * Display the seller's public store page.
     * Route: GET /store/{seller}
     */
    public function store(Request $request, Seller $seller)
    {
        // Only show approved sellers
        abort_if(! $seller->isApproved(), 404);

        // ── Filters from request ──────────────────────────────────────
        $search    = $request->get('q');
        $sort      = $request->get('sort', 'newest');
        $minPrice  = $request->get('min_price');
        $maxPrice  = $request->get('max_price');
        $inStock   = $request->boolean('in_stock');
        $categoryId = $request->get('category_id');
        $perPage   = (int) $request->get('per_page', 12);

        // ── Base query: active products by this seller ───────────────
        $query = Product::whereNull('deleted_at')
            ->where('is_active', 1)
            ->where('seller_id', $seller->id)
            ->with(['category', 'brand', 'reviews']);

        // Search
        if ($search) {
            $query->search($search);
        }

        // Category filter
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        // Price range
        if ($minPrice !== null && $minPrice !== '') {
            $query->where('price', '>=', (float) $minPrice);
        }
        if ($maxPrice !== null && $maxPrice !== '') {
            $query->where('price', '<=', (float) $maxPrice);
        }

        // Stock filter
        if ($inStock) {
            $query->where('stock_quantity', '>', 0);
        }

        // ── Sorting ──────────────────────────────────────────────────
        match ($sort) {
            'price_asc'    => $query->orderBy('price', 'asc'),
            'price_desc'   => $query->orderBy('price', 'desc'),
            'best_selling' => $query->orderBy('sold_count', 'desc'),
            'name_asc'     => $query->orderBy('name', 'asc'),
            default        => $query->orderBy('created_at', 'desc'),
        };

        // ── Paginate ─────────────────────────────────────────────────
        $products = $query->paginate($perPage)->withQueryString();

        // ── Enrich products with computed attributes ──────────────────
        $products->getCollection()->transform(function ($product) {
            $product->avg_rating        = round($product->reviews->avg('rating') ?? 0, 1);
            $product->reviews_count     = $product->reviews->count();
            $product->final_price       = $this->calculateFinalPrice($product);
            $product->discount_percentage = $this->calculateDiscountPercentage($product);
            return $product;
        });

        // ── Seller stats ─────────────────────────────────────────────
        $totalProducts   = Product::whereNull('deleted_at')->where('is_active', 1)->where('seller_id', $seller->id)->count();
        $totalSales      = Product::whereNull('deleted_at')->where('seller_id', $seller->id)->sum('sold_count');
        $subscriberCount = $seller->subscribers()->count();

        // ── Categories this seller has products in ────────────────────
        $sellerCategories = Category::where('status', true)
            ->whereHas('products', fn ($q) => $q->where('seller_id', $seller->id)->where('is_active', 1)->whereNull('deleted_at'))
            ->withCount(['products' => fn ($q) => $q->where('seller_id', $seller->id)->where('is_active', 1)->whereNull('deleted_at')])
            ->orderBy('name')
            ->get();

        // ── Is the auth user subscribed? ──────────────────────────────
        $isSubscribed = false;
        if (auth()->check()) {
            $isSubscribed = auth()->user()->isSubscribedTo($seller);
        }

        return view('pages.seller-store', compact(
            'seller',
            'products',
            'totalProducts',
            'totalSales',
            'subscriberCount',
            'sellerCategories',
            'isSubscribed',
            'search',
            'sort',
            'minPrice',
            'maxPrice',
            'inStock',
            'categoryId',
        ));
    }

    // ── Toggle subscribe/unsubscribe ──────────────────────────────────
    public function toggleSubscribe(Request $request, Seller $seller)
    {
        abort_if(! auth()->check(), 401);

        $user = auth()->user();

        if ($user->isSubscribedTo($seller)) {
            $user->subscribedSellers()->detach($seller->id);
            $subscribed = false;
        } else {
            $user->subscribedSellers()->attach($seller->id);
            $subscribed = true;
        }

        if ($request->wantsJson()) {
            return response()->json([
                'subscribed'       => $subscribed,
                'subscriber_count' => $seller->subscribers()->count(),
            ]);
        }

        return back()->with('success', $subscribed ? 'Subscribed to seller!' : 'Unsubscribed from seller.');
    }

    // ── Price helpers (mirrors ProductController) ─────────────────────
    protected function calculateFinalPrice(Product $product): float
    {
        if ($product->discount_price && $product->discount_type) {
            if ($product->discount_type === 'percent') {
                return round($product->price - ($product->price * $product->discount_price / 100), 2);
            }
            return (float) $product->discount_price;
        }
        return (float) $product->price;
    }

    protected function calculateDiscountPercentage(Product $product): float
    {
        if (! $product->discount_price || $product->price <= 0) return 0;

        if ($product->discount_type === 'percent') {
            return (float) $product->discount_price;
        }

        return round((($product->price - $product->discount_price) / $product->price) * 100, 2);
    }
}