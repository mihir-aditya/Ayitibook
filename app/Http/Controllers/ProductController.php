<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\NotificationService;

class ProductController extends Controller
{
    // ──────────────────────────────────────────────
    // GET /products
    // ──────────────────────────────────────────────
    public function index(Request $request)
    {
        // ── Inputs ────────────────────────────────
        $search        = $request->get('q');
        $categorySlug  = $request->get('category');
        $brandIds      = $request->get('brands', []);
        $minPrice      = $request->get('min_price');
        $maxPrice      = $request->get('max_price');
        $minRating     = $request->get('min_rating');
        $inStock       = $request->boolean('in_stock');
        $flashSale     = $request->boolean('flash_sale');
        $refundable    = $request->boolean('refundable');
        $sort          = $request->get('sort', '');
        $perPage       = (int) $request->get('per_page', 9);

        // ── Resolve current category ───────────────
        $currentCategory = null;
        $categoryIds     = [];

        if ($categorySlug) {
            $currentCategory = Category::where('slug', $categorySlug)
                ->where('status', true)
                ->first();

            if ($currentCategory) {
                // Include the category itself + all descendants
                $categoryIds = $currentCategory->getAllDescendantIds();
            }
        }

        // ── Build base query ───────────────────────
        $query = Product::whereNull('deleted_at')
            ->where('is_active', 1)
            ->with(['category', 'brand', 'reviews']);

        // Search
        if ($search) {
            $query->search($search);
        }

        // Category filter
        if (!empty($categoryIds)) {
            $query->whereIn('category_id', $categoryIds);
        }

        // Brand filter
        if (!empty($brandIds)) {
            $query->whereIn('brand_id', $brandIds);
        }

        // Price range
        if ($minPrice !== null && $minPrice !== '') {
            $query->where('price', '>=', (float) $minPrice);
        }
        if ($maxPrice !== null && $maxPrice !== '') {
            $query->where('price', '<=', (float) $maxPrice);
        }

        // Stock filter (using stock_quantity column)
        if ($inStock) {
            $query->where('stock_quantity', '>', 0);
        }

        // Flash sale filter (is_flash_sale is int, 1 = active)
        if ($flashSale) {
            $query->where('is_flash_sale', 1);
        }

        // Refundable filter
        if ($refundable) {
            $query->where('refundable', 1);
        }

        // Rating filter (requires joining/subquery via reviews)
        if ($minRating) {
            $query->whereHas('reviews', function ($q) use ($minRating) {
                $q->havingRaw('AVG(rating) >= ?', [$minRating]);
            });
        }

        // ── Sorting ────────────────────────────────
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'best_selling':
                $query->orderBy('sold_count', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        // ── Paginate ───────────────────────────────
        $products = $query
            ->paginate($perPage)
            ->withQueryString();

        // ── Sidebar data ───────────────────────────
        // Root categories with children + product counts
        $categories = Category::where('status', true)
            ->whereNull('parent_id')
            ->with(['children' => fn ($q) => $q->where('status', true)->withCount('products')])
            ->withCount('products')
            ->orderBy('name')
            ->get();

        // Top-level categories for the horizontal tabs
        $topLevelCategories = Category::where('status', true)
            ->whereNull('parent_id')
            ->withCount(['products' => fn ($q) => $q->where('is_active', 1)])
            ->orderBy('name')
            ->get();

        // Brands
        $brands = Brand::where('status', true)
            ->has('products')
            ->orderBy('name')
            ->get();

        // Total count (before category filter, for hero stats)
        $totalProductsCount = Product::whereNull('deleted_at')
            ->where('is_active', 1)
            ->count();

        // ── JSON response for API ──────────────────
        if ($request->wantsJson()) {
            return response()->json([
                'products'        => $products,
                'categories'      => $categories,
                'brands'          => $brands,
                'currentCategory' => $currentCategory,
            ]);
        }

        return view('pages.products', compact(
            'products',
            'categories',
            'topLevelCategories',
            'brands',
            'currentCategory',
            'search',
            'totalProductsCount'
        ));
    }

    // ──────────────────────────────────────────────
    // GET /products/{product}
    // ──────────────────────────────────────────────
    public function show(Product $product)
    {
        abort_if($product->trashed() || !$product->is_active, 404);

        // Load relationships
        $product->load([
            'seller',
            'reviews.user',
            'category',
            'brand',
            'variants',
        ]);

        // Parse JSON fields
        if ($product->images && is_string($product->images)) {
            $product->images = json_decode($product->images, true);
        }
        if ($product->videos && is_string($product->videos)) {
            $product->videos = json_decode($product->videos, true);
        }

        // Add computed attributes for rating and review counts
        $product->avg_rating = $product->reviews->avg('rating') ?? 0;
        $product->reviews_count = $product->reviews->count();

        // Calculate final price with discount if applicable
        $product->final_price = $this->calculateFinalPrice($product);
        
        // Calculate discount percentage
        $product->discount_percentage = $this->calculateDiscountPercentage($product);

        // ========== 1. RELATED PRODUCTS ==========
        // Products from the same category, excluding current product
        $relatedProducts = Product::whereNull('deleted_at')
            ->where('is_active', 1)
            ->where('id', '!=', $product->id)
            ->when($product->category_id, fn ($q) => $q->where('category_id', $product->category_id))
            ->with(['category', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->inRandomOrder()
            ->limit(8)
            ->get()
            ->map(function ($item) {
                $item->avg_rating = $item->reviews_avg_rating ?? 0;
                $item->reviews_count = $item->reviews->count();
                $item->final_price = $this->calculateFinalPrice($item);
                $item->discount_percentage = $this->calculateDiscountPercentage($item);
                return $item;
            });

        // ========== 2. SUGGESTED PRODUCTS ==========
        // Products from same brand or similar price range
        $suggestedProducts = Product::whereNull('deleted_at')
            ->where('is_active', 1)
            ->where('id', '!=', $product->id)
            ->where(function ($query) use ($product) {
                // Same brand OR similar price range (±20%)
                $query->where('brand_id', $product->brand_id)
                    ->orWhereBetween('price', [
                        $product->price * 0.8,
                        $product->price * 1.2
                    ]);
            })
            ->when($product->category_id, fn ($q) => $q->orWhere('category_id', $product->category_id))
            ->with(['category', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->inRandomOrder()
            ->limit(8)
            ->get()
            ->map(function ($item) {
                $item->avg_rating = $item->reviews_avg_rating ?? 0;
                $item->reviews_count = $item->reviews->count();
                $item->final_price = $this->calculateFinalPrice($item);
                $item->discount_percentage = $this->calculateDiscountPercentage($item);
                return $item;
            });

        // ========== 3. RECOMMENDED PRODUCTS (Based on user behavior) ==========
        $recommendedProducts = collect();
        
        if (auth()->check()) {
            // Get products from user's purchase history categories
            $userCategories = DB::table('orders')
                ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->where('orders.user_id', auth()->id())
                ->where('orders.status', 'completed')
                ->whereNotNull('products.category_id')
                ->select('products.category_id', DB::raw('COUNT(*) as purchase_count'))
                ->groupBy('products.category_id')
                ->orderBy('purchase_count', 'desc')
                ->limit(3)
                ->pluck('category_id')
                ->toArray();

            if (!empty($userCategories)) {
                $recommendedProducts = Product::whereNull('deleted_at')
                    ->where('is_active', 1)
                    ->where('id', '!=', $product->id)
                    ->whereIn('category_id', $userCategories)
                    ->with(['category', 'reviews'])
                    ->withAvg('reviews', 'rating')
                    ->inRandomOrder()
                    ->limit(8)
                    ->get()
                    ->map(function ($item) {
                        $item->avg_rating = $item->reviews_avg_rating ?? 0;
                        $item->reviews_count = $item->reviews->count();
                        $item->final_price = $this->calculateFinalPrice($item);
                        $item->discount_percentage = $this->calculateDiscountPercentage($item);
                        return $item;
                    });
            }
        }

        // If user not logged in or no purchase history, get popular products
        if ($recommendedProducts->isEmpty()) {
            $recommendedProducts = Product::whereNull('deleted_at')
                ->where('is_active', 1)
                ->where('id', '!=', $product->id)
                ->orderBy('sold_count', 'desc')
                ->with(['category', 'reviews'])
                ->withAvg('reviews', 'rating')
                ->limit(8)
                ->get()
                ->map(function ($item) {
                    $item->avg_rating = $item->reviews_avg_rating ?? 0;
                    $item->reviews_count = $item->reviews->count();
                    $item->final_price = $this->calculateFinalPrice($item);
                    $item->discount_percentage = $this->calculateDiscountPercentage($item);
                    return $item;
                });
        }

        // ========== 4. BEST SELLING PRODUCTS ==========
        $bestSellingProducts = Product::whereNull('deleted_at')
            ->where('is_active', 1)
            ->where('id', '!=', $product->id)
            ->orderBy('sold_count', 'desc')
            ->with(['category', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->limit(8)
            ->get()
            ->map(function ($item) {
                $item->avg_rating = $item->reviews_avg_rating ?? 0;
                $item->reviews_count = $item->reviews->count();
                $item->final_price = $this->calculateFinalPrice($item);
                $item->discount_percentage = $this->calculateDiscountPercentage($item);
                return $item;
            });

        // ========== 5. NEW ARRIVALS ==========
        $newArrivals = Product::whereNull('deleted_at')
            ->where('is_active', 1)
            ->where('id', '!=', $product->id)
            ->orderBy('created_at', 'desc')
            ->with(['category', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->limit(8)
            ->get()
            ->map(function ($item) {
                $item->avg_rating = $item->reviews_avg_rating ?? 0;
                $item->reviews_count = $item->reviews->count();
                $item->final_price = $this->calculateFinalPrice($item);
                $item->discount_percentage = $this->calculateDiscountPercentage($item);
                return $item;
            });

        // ========== 6. FREQUENTLY BOUGHT TOGETHER ==========
        $frequentlyBoughtTogether = collect();
        
        // Get products frequently bought together with this product
        // Note: This requires proper order_items table with order status tracking
        if (DB::table('order_items')->exists()) {
            $frequentlyBoughtTogether = Product::whereNull('deleted_at')
                ->where('is_active', 1)
                ->where('id', '!=', $product->id)
                ->whereIn('id', function ($query) use ($product) {
                    $query->select('order_items.product_id')
                        ->from('order_items')
                        ->join('orders', 'order_items.order_id', '=', 'orders.id')
                        ->whereIn('orders.id', function ($subquery) use ($product) {
                            $subquery->select('order_id')
                                ->from('order_items')
                                ->where('product_id', $product->id)
                                ->whereHas('order', fn($q) => $q->where('status', 'completed'));
                        })
                        ->where('order_items.product_id', '!=', $product->id)
                        ->groupBy('order_items.product_id')
                        ->orderByRaw('COUNT(*) DESC')
                        ->limit(4);
                })
                ->with(['category', 'reviews'])
                ->withAvg('reviews', 'rating')
                ->limit(4)
                ->get()
                ->map(function ($item) {
                    $item->avg_rating = $item->reviews_avg_rating ?? 0;
                    $item->reviews_count = $item->reviews->count();
                    $item->final_price = $this->calculateFinalPrice($item);
                    $item->discount_percentage = $this->calculateDiscountPercentage($item);
                    return $item;
                });
        }

        // ========== 7. SIMILAR PRICE RANGE ==========
        $similarPriceProducts = Product::whereNull('deleted_at')
            ->where('is_active', 1)
            ->where('id', '!=', $product->id)
            ->whereBetween('price', [
                $product->price * 0.7,
                $product->price * 1.3
            ])
            ->with(['category', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->inRandomOrder()
            ->limit(8)
            ->get()
            ->map(function ($item) {
                $item->avg_rating = $item->reviews_avg_rating ?? 0;
                $item->reviews_count = $item->reviews->count();
                $item->final_price = $this->calculateFinalPrice($item);
                $item->discount_percentage = $this->calculateDiscountPercentage($item);
                return $item;
            });

        // ========== 8. TOP RATED PRODUCTS ==========
        $topRatedProducts = Product::whereNull('deleted_at')
            ->where('is_active', 1)
            ->where('id', '!=', $product->id)
            ->has('reviews')
            ->withAvg('reviews', 'rating')
            ->orderBy('reviews_avg_rating', 'desc')
            ->orderBy('sold_count', 'desc')
            ->limit(8)
            ->get()
            ->map(function ($item) {
                $item->avg_rating = $item->reviews_avg_rating ?? 0;
                $item->reviews_count = $item->reviews->count();
                $item->final_price = $this->calculateFinalPrice($item);
                $item->discount_percentage = $this->calculateDiscountPercentage($item);
                return $item;
            });

        // ========== 9. FLASH SALE PRODUCTS ==========
        $flashSaleProducts = Product::whereNull('deleted_at')
            ->where('is_active', 1)
            ->where('is_flash_sale', 1)
            ->where('id', '!=', $product->id)
            ->with(['category', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->limit(8)
            ->get()
            ->map(function ($item) {
                $item->avg_rating = $item->reviews_avg_rating ?? 0;
                $item->reviews_count = $item->reviews->count();
                $item->final_price = $this->calculateFinalPrice($item);
                $item->discount_percentage = $this->calculateDiscountPercentage($item);
                return $item;
            });

        // ========== 10. PRODUCTS FROM SAME SELLER ==========
        $sameSellerProducts = collect();
        if ($product->seller_id) {
            $sameSellerProducts = Product::whereNull('deleted_at')
                ->where('is_active', 1)
                ->where('id', '!=', $product->id)
                ->where('seller_id', $product->seller_id)
                ->with(['category', 'reviews'])
                ->withAvg('reviews', 'rating')
                ->limit(8)
                ->get()
                ->map(function ($item) {
                    $item->avg_rating = $item->reviews_avg_rating ?? 0;
                    $item->reviews_count = $item->reviews->count();
                    $item->final_price = $this->calculateFinalPrice($item);
                    $item->discount_percentage = $this->calculateDiscountPercentage($item);
                    return $item;
                });
        }

        // ========== 11. DISCOUNTED PRODUCTS ==========
        $discountedProducts = Product::whereNull('deleted_at')
            ->where('is_active', 1)
            ->where('id', '!=', $product->id)
            ->whereNotNull('discount_price')
            ->where('discount_price', '>', 0)
            ->with(['category', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->orderBy('discount_price', 'desc')
            ->limit(8)
            ->get()
            ->map(function ($item) {
                $item->avg_rating = $item->reviews_avg_rating ?? 0;
                $item->reviews_count = $item->reviews->count();
                $item->final_price = $this->calculateFinalPrice($item);
                $item->discount_percentage = $this->calculateDiscountPercentage($item);
                return $item;
            });

        // ========== 12. LOW STOCK PRODUCTS (Alert) ==========
        $lowStockProducts = Product::whereNull('deleted_at')
            ->where('is_active', 1)
            ->where('id', '!=', $product->id)
            ->where('stock_quantity', '>', 0)
            ->where('stock_quantity', '<=', DB::raw('low_stock_quantity'))
            ->with(['category', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->limit(8)
            ->get()
            ->map(function ($item) {
                $item->avg_rating = $item->reviews_avg_rating ?? 0;
                $item->reviews_count = $item->reviews->count();
                $item->final_price = $this->calculateFinalPrice($item);
                $item->discount_percentage = $this->calculateDiscountPercentage($item);
                return $item;
            });

        // Increment view count (track product views)
        $product->increment('sales_count'); // Using sales_count as view counter
        // Or add a view_count column if needed, but for now use sales_count

        // Update recently viewed products in session
        $this->updateRecentlyViewed($product->id);

        return view('pages.product-details', compact(
            'product',
            'relatedProducts',
            'suggestedProducts',
            'recommendedProducts',
            'bestSellingProducts',
            'newArrivals',
            'frequentlyBoughtTogether',
            'similarPriceProducts',
            'topRatedProducts',
            'flashSaleProducts',
            'sameSellerProducts',
            'discountedProducts',
            'lowStockProducts'
        ));
    }

    /**
     * Calculate final price with discount
     */
    protected function calculateFinalPrice($product)
    {
        if (!$product->discount_price || !$product->discount_type) {
            return $product->price;
        }

        if ($product->discount_type === 'percent') {
            return $product->price - ($product->price * $product->discount_price / 100);
        } else { // flat discount
            return $product->price - $product->discount_price;
        }
    }

    /**
     * Calculate discount percentage
     */
    protected function calculateDiscountPercentage($product)
    {
        if (!$product->discount_price || !$product->discount_type || $product->price <= 0) {
            return 0;
        }

        if ($product->discount_type === 'percent') {
            return $product->discount_price;
        } else { // flat discount
            return round(($product->discount_price / $product->price) * 100);
        }
    }

    /**
     * Update recently viewed products in session
     */
    protected function updateRecentlyViewed($productId)
    {
        $recentlyViewed = session()->get('recently_viewed', []);
        
        // Remove if already exists to add it to the front
        $recentlyViewed = array_filter($recentlyViewed, fn($id) => $id != $productId);
        
        // Add to the beginning
        array_unshift($recentlyViewed, $productId);
        
        // Keep only last 10
        $recentlyViewed = array_slice($recentlyViewed, 0, 10);
        
        session()->put('recently_viewed', $recentlyViewed);
    }

    /**
     * Get recently viewed products
     */
    public function getRecentlyViewed()
    {
        $recentlyViewedIds = session()->get('recently_viewed', []);
        
        if (empty($recentlyViewedIds)) {
            return collect();
        }
        
        $products = Product::whereNull('deleted_at')
            ->where('is_active', 1)
            ->whereIn('id', $recentlyViewedIds)
            ->with(['category', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->get()
            ->keyBy('id')
            ->map(function ($item) {
                $item->avg_rating = $item->reviews_avg_rating ?? 0;
                $item->reviews_count = $item->reviews->count();
                $item->final_price = $this->calculateFinalPrice($item);
                $item->discount_percentage = $this->calculateDiscountPercentage($item);
                return $item;
            });
        
        // Return in the order they were viewed
        return collect($recentlyViewedIds)
            ->filter(fn($id) => $products->has($id))
            ->map(fn($id) => $products->get($id));
    }

    /**
     * API endpoint to get product recommendations
     */
    public function getRecommendations(Product $product)
    {
        $recommendations = [
            'related' => $this->getRelatedProducts($product),
            'suggested' => $this->getSuggestedProducts($product),
            'similar_price' => $this->getSimilarPriceProducts($product),
            'flash_sale' => $this->getFlashSaleProducts($product),
            'top_rated' => $this->getTopRatedProducts(),
            'best_selling' => $this->getBestSellingProducts(),
        ];
        
        return response()->json($recommendations);
    }

    /**
     * Get products frequently bought together with the given product
     */
    protected function getFrequentlyBoughtTogether(Product $product)
    {
        return Product::whereNull('deleted_at')
            ->where('is_active', 1)
            ->where('id', '!=', $product->id)
            ->whereIn('id', function ($query) use ($product) {
                $query->select('order_items.product_id')
                    ->from('order_items')
                    ->join('orders', 'order_items.order_id', '=', 'orders.id')
                    ->whereIn('orders.id', function ($subquery) use ($product) {
                        $subquery->select('order_id')
                            ->from('order_items')
                            ->where('product_id', $product->id);
                    })
                    ->where('order_items.product_id', '!=', $product->id)
                    ->groupBy('order_items.product_id')
                    ->orderByRaw('COUNT(*) DESC')
                    ->limit(4);
            })
            ->limit(4)
            ->get();
    }

    /**
     * Get products with similar price range
     */
    protected function getSimilarPriceProducts(Product $product)
    {
        return Product::whereNull('deleted_at')
            ->where('is_active', 1)
            ->where('id', '!=', $product->id)
            ->whereBetween('price', [
                $product->price * 0.7,
                $product->price * 1.3
            ])
            ->limit(8)
            ->get();
    }

    /**
     * Get related products from same category
     */
    protected function getRelatedProducts(Product $product)
    {
        return Product::whereNull('deleted_at')
            ->where('is_active', 1)
            ->where('id', '!=', $product->id)
            ->when($product->category_id, fn ($q) => $q->where('category_id', $product->category_id))
            ->limit(8)
            ->get();
    }

    /**
     * Get suggested products (same brand or similar price)
     */
    protected function getSuggestedProducts(Product $product)
    {
        return Product::whereNull('deleted_at')
            ->where('is_active', 1)
            ->where('id', '!=', $product->id)
            ->where(function ($query) use ($product) {
                $query->where('brand_id', $product->brand_id)
                    ->orWhereBetween('price', [
                        $product->price * 0.8,
                        $product->price * 1.2
                    ]);
            })
            ->limit(8)
            ->get();
    }

    /**
     * Get top rated products
     */
    public function getTopRatedProducts($limit = 8)
    {
        return Product::whereNull('deleted_at')
            ->where('is_active', 1)
            ->has('reviews')
            ->withAvg('reviews', 'rating')
            ->orderBy('reviews_avg_rating', 'desc')
            ->orderBy('sold_count', 'desc')
            ->limit($limit)
            ->get()
            ->map(function ($item) {
                $item->final_price = $this->calculateFinalPrice($item);
                $item->discount_percentage = $this->calculateDiscountPercentage($item);
                return $item;
            });
    }

    /**
     * Get best selling products
     */
    public function getBestSellingProducts($limit = 8)
    {
        return Product::whereNull('deleted_at')
            ->where('is_active', 1)
            ->orderBy('sold_count', 'desc')
            ->limit($limit)
            ->get()
            ->map(function ($item) {
                $item->final_price = $this->calculateFinalPrice($item);
                $item->discount_percentage = $this->calculateDiscountPercentage($item);
                return $item;
            });
    }

    /**
     * Get new arrivals
     */
    public function getNewArrivals($limit = 8)
    {
        return Product::whereNull('deleted_at')
            ->where('is_active', 1)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get()
            ->map(function ($item) {
                $item->final_price = $this->calculateFinalPrice($item);
                $item->discount_percentage = $this->calculateDiscountPercentage($item);
                return $item;
            });
    }

    /**
     * Get flash sale products
     */
    public function getFlashSaleProducts($limit = 8)
    {
        return Product::whereNull('deleted_at')
            ->where('is_active', 1)
            ->where('is_flash_sale', 1)
            ->limit($limit)
            ->get()
            ->map(function ($item) {
                $item->final_price = $this->calculateFinalPrice($item);
                $item->discount_percentage = $this->calculateDiscountPercentage($item);
                return $item;
            });
    }

    /**
     * Get discounted products
     */
    public function getDiscountedProducts($limit = 8)
    {
        return Product::whereNull('deleted_at')
            ->where('is_active', 1)
            ->whereNotNull('discount_price')
            ->where('discount_price', '>', 0)
            ->orderByRaw('(price - discount_price) / price DESC')
            ->limit($limit)
            ->get()
            ->map(function ($item) {
                $item->final_price = $this->calculateFinalPrice($item);
                $item->discount_percentage = $this->calculateDiscountPercentage($item);
                return $item;
            });
    }

    /**
     * Get products from same seller
     */
    public function getSameSellerProducts($sellerId, $excludeProductId = null, $limit = 8)
    {
        $query = Product::whereNull('deleted_at')
            ->where('is_active', 1)
            ->where('seller_id', $sellerId);
        
        if ($excludeProductId) {
            $query->where('id', '!=', $excludeProductId);
        }
        
        return $query->limit($limit)
            ->get()
            ->map(function ($item) {
                $item->final_price = $this->calculateFinalPrice($item);
                $item->discount_percentage = $this->calculateDiscountPercentage($item);
                return $item;
            });
    }
}