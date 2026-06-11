<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /* =========================
       Show Products List
    ========================== */
    public function index(Request $request)
    {
        $query = Product::with(['seller', 'category', 'brand']);

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('seller', function ($q) use ($search) {
                        $q->where('shop_name', 'like', "%{$search}%")
                            ->orWhere('name', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by seller
        if ($request->has('seller') && $request->seller != 'all') {
            $query->where('seller_id', $request->seller);
        }

        // Filter by category
        if ($request->has('category') && $request->category != 'all') {
            $query->where('category_id', $request->category);
        }

        // Filter by brand
        if ($request->has('brand') && $request->brand != 'all') {
            $query->where('brand_id', $request->brand);
        }

        // Filter by status
        if ($request->has('status') && $request->status != 'all') {
            if ($request->status == 'active') {
                $query->where('is_active', 1);
            } elseif ($request->status == 'inactive') {
                $query->where('is_active', 0);
            } elseif ($request->status == 'out_of_stock') {
                $query->where('stock_quantity', '<=', 0);
            } elseif ($request->status == 'low_stock') {
                $query->where('stock_quantity', '>', 0)
                    ->where('stock_quantity', '<=', DB::raw('low_stock_quantity'));
            }
        }

        // Filter by price range
        if ($request->has('price_from') && $request->price_from != '') {
            $query->where('price', '>=', $request->price_from);
        }

        if ($request->has('price_to') && $request->price_to != '') {
            $query->where('price', '<=', $request->price_to);
        }

        // Filter by stock range
        if ($request->has('stock_from') && $request->stock_from != '') {
            $query->where('stock_quantity', '>=', $request->stock_from);
        }

        if ($request->has('stock_to') && $request->stock_to != '') {
            $query->where('stock_quantity', '<=', $request->stock_to);
        }

        // Filter by flash sale
        if ($request->has('flash_sale') && $request->flash_sale != 'all') {
            $query->where('is_flash_sale', $request->flash_sale == 'yes' ? 1 : 0);
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        // Handle special sorting cases
        if ($sortBy == 'seller') {
            $query->leftJoin('sellers', 'products.seller_id', '=', 'sellers.id')
                ->orderBy('sellers.shop_name', $sortOrder)
                ->select('products.*');
        } elseif ($sortBy == 'category') {
            $query->leftJoin('categories', 'products.category_id', '=', 'categories.id')
                ->orderBy('categories.name', $sortOrder)
                ->select('products.*');
        } else {
            $query->orderBy($sortBy, $sortOrder);
        }

        $products = $query->paginate(20)->withQueryString();

        // Get filter data
        $sellers = Seller::where('status', 'approved')->get();
        // In ProductController::index() method:
        $categories = Category::where('status', 1)->get();
        // NOT: Category::where('is_active', 1)->get();
        $brands = Brand::where('status', 1)->get();

        // Statistics
        $stats = [
            'total' => Product::count(),
            'active' => Product::where('is_active', 1)->count(),
            'inactive' => Product::where('is_active', 0)->count(),
            'out_of_stock' => Product::where('stock_quantity', '<=', 0)->count(),
            'low_stock' => Product::where('stock_quantity', '>', 0)
                ->where('stock_quantity', '<=', DB::raw('low_stock_quantity'))
                ->count(),
            'flash_sale' => Product::where('is_flash_sale', 1)->count(),
            'today' => Product::whereDate('created_at', today())->count(),
            'week' => Product::where('created_at', '>=', now()->subWeek())->count(),
        ];

        return view('admin.products.index', compact('products', 'sellers', 'categories', 'brands', 'stats'));
    }

    /* =========================
       Show Create Product Form
    ========================== */
    public function create()
    {
        $sellers = Seller::where('status', 'approved')->get();
        $categories = Category::where('status', 1)->get(); // Fixed: use 'status' not 'is_active'
        $brands = Brand::where('status', 1)->get();

        return view('admin.products.create', compact('sellers', 'categories', 'brands'));
    }

    /* =========================
       Store New Product
    ========================== */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'seller_id' => 'required|exists:sellers,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'sku' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('products')->where(function ($query) use ($request) {
                    return $query->where('seller_id', $request->seller_id);
                }),
            ],
            'price' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'discount_price' => 'nullable|numeric|min:0',
            'discount_type' => 'nullable|in:flat,percent',
            'stock_quantity' => 'required|integer|min:0',
            'low_stock_quantity' => 'required|integer|min:1',
            'maximum_purchase_quantity' => 'nullable|integer|min:0',
            'weight' => 'nullable|numeric|min:0',
            'length' => 'nullable|numeric|min:0',
            'width' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
            'can_purchase' => 'boolean',
            'show_stock_out' => 'boolean',
            'refundable' => 'boolean',
            'is_active' => 'boolean',
            'is_flash_sale' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
            'videos' => 'nullable|array',
            'videos.*' => 'mimes:mp4,avi,mov,wmv|max:5120',
        ]);

        // Generate slug if not provided
        $slug = Str::slug($request->name.'-'.Str::random(6));

        // Handle thumbnail upload
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('products/thumbnails', 'public');
        }

        // Handle images upload
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('products/images', 'public');
            }
        }

        // Handle videos upload
        $videos = [];
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $videos[] = $video->store('products/videos', 'public');
            }
        }
        // Create product
        $product = Product::create([
            'seller_id' => $validated['seller_id'],
            'name' => $validated['name'],
            'slug' => $slug,
            'sku' => $validated['sku'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'brand_id' => $validated['brand_id'],
            'price' => $validated['price'],
            'currency' => $validated['currency'],
            'discount_price' => $validated['discount_price'],
            'discount_type' => $validated['discount_type'],
            'stock_quantity' => $validated['stock_quantity'],
            'low_stock_quantity' => $validated['low_stock_quantity'],
            'maximum_purchase_quantity' => $validated['maximum_purchase_quantity'] ?? 0,
            'weight' => $validated['weight'],
            'length' => $validated['length'],
            'width' => $validated['width'],
            'height' => $validated['height'],
            'can_purchase' => $request->boolean('can_purchase'),
            'show_stock_out' => $request->boolean('show_stock_out'),
            'refundable' => $request->boolean('refundable'),
            'is_active' => $request->boolean('is_active'),
            'is_flash_sale' => $request->boolean('is_flash_sale'),
            'meta_title' => $validated['meta_title'],
            'meta_keywords' => $validated['meta_keywords'],
            'meta_description' => $validated['meta_description'],
            'thumbnail' => $thumbnailPath,
            'affiliate_percentage' => $validated['affiliate_percentage'] ?? 10,
            'images' => ! empty($images) ? $images : null, // Pass as array
            'videos' => ! empty($videos) ? $videos : null, // Pass as array
        ]);

        // Handle variants if provided
        if ($request->has('variants')) {
            foreach ($request->variants as $variantData) {
                if (! empty($variantData['variant_name'])) {
                    $variantImages = [];
                    if (isset($variantData['images'])) {
                        foreach ($variantData['images'] as $image) {
                            $variantImages[] = $image->store('products/variants', 'public');
                        }
                    }

                    $variantVideos = [];
                    if (isset($variantData['videos'])) {
                        foreach ($variantData['videos'] as $video) {
                            $variantVideos[] = $video->store('products/variants', 'public');
                        }
                    }

                    ProductVariant::create([
                        'product_id' => $product->id,
                        'variant_name' => $variantData['variant_name'],
                        'sku' => $variantData['sku'],
                        'price' => $variantData['price'] ?? $product->price,
                        'quantity' => $variantData['quantity'] ?? $product->stock_quantity,
                        'images' => ! empty($variantImages) ? json_encode($variantImages) : null,
                        'videos' => ! empty($variantVideos) ? json_encode($variantVideos) : null,
                    ]);
                }
            }
        }

        $this->logActivity("Created product: {$product->name}");

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully');
    }

    /* =========================
       Show Product Details
    ========================== */
    public function show(Product $product)
    {
        // Eager load variants with proper handling
        $product->load(['seller', 'category', 'brand', 'variants', 'sizes', 'reviews.user']);

        // Get related statistics
        $stats = [
            'total_views' => 0,
            'total_sales' => $product->sold_count + $product->sales_count,
            'total_revenue' => ($product->sold_count + $product->sales_count) * $product->price,
            'variant_count' => $product->variants->count(),
            'total_stock' => $product->stock_quantity + $product->variants->sum('quantity'),
        ];

        // Get similar products
        $similarProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', 1)
            ->take(5)
            ->get();

        return view('admin.products.show', compact('product', 'stats', 'similarProducts'));
    }

    /* =========================
       Show Edit Product Form
    ========================== */
    public function edit(Product $product)
    {
        $sellers = Seller::where('status', 'approved')->get();
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();

        $product->load('variants');

        return view('admin.products.edit', compact('product', 'sellers', 'categories', 'brands'));
    }

    /* =========================
       Update Product
    ========================== */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'seller_id' => 'required|exists:sellers,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'sku' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('products')->where(function ($query) use ($request, $product) {
                    return $query->where('seller_id', $request->seller_id)
                        ->where('id', '!=', $product->id);
                }),
            ],
            'price' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'discount_price' => 'nullable|numeric|min:0',
            'discount_type' => 'nullable|in:flat,percent',
            'stock_quantity' => 'required|integer|min:0',
            'low_stock_quantity' => 'required|integer|min:1',
            'maximum_purchase_quantity' => 'nullable|integer|min:0',
            'weight' => 'nullable|numeric|min:0',
            'length' => 'nullable|numeric|min:0',
            'width' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
            'can_purchase' => 'boolean',
            'show_stock_out' => 'boolean',
            'refundable' => 'boolean',
            'is_active' => 'boolean',
            'is_flash_sale' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
            'videos' => 'nullable|array',
            'videos.*' => 'mimes:mp4,avi,mov,wmv|max:5120',
            'remove_images' => 'nullable|array',
            'remove_videos' => 'nullable|array',
            'affiliate_percentage' => 'nullable|numeric|min:0|max:100',
        ]);

        // Handle thumbnail upload/removal
        $thumbnailPath = $product->thumbnail;
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($thumbnailPath) {
                Storage::disk('public')->delete($thumbnailPath);
            }
            $thumbnailPath = $request->file('thumbnail')->store('products/thumbnails', 'public');
        } elseif ($request->boolean('remove_thumbnail')) {
            if ($thumbnailPath) {
                Storage::disk('public')->delete($thumbnailPath);
                $thumbnailPath = null;
            }
        }

        // Handle images upload/removal
        $images = $product->images ?? [];

        // Remove selected images
        // Remove selected images
        if ($request->has('remove_images')) {
            foreach ($request->remove_images as $imageToRemove) {
                if (($key = array_search($imageToRemove, $images)) !== false) {
                    Storage::disk('public')->delete($imageToRemove);
                    unset($images[$key]);
                }
            }
            $images = array_values($images); // Reindex array
        }

        // Add new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('products/images', 'public');
            }
        }

        // Handle videos upload/removal
        $videos = $product->videos ?? []; // Get existing videos as array

        // Remove selected videos
        if ($request->has('remove_videos')) {
            foreach ($request->remove_videos as $videoToRemove) {
                if (($key = array_search($videoToRemove, $videos)) !== false) {
                    Storage::disk('public')->delete($videoToRemove);
                    unset($videos[$key]);
                }
            }
            $videos = array_values($videos); // Reindex array
        }

        // Add new videos
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $videos[] = $video->store('products/videos', 'public');
            }
        }
        if ($request->has('sizes') || $request->has('new_sizes')) {
            // Delete existing sizes
            $product->sizes()->delete();

            // Process existing sizes from the form
            $sizes = $request->input('sizes', []);
            $newSizes = $request->input('new_sizes', []);

            $allSizes = array_merge($sizes, $newSizes);
            $allSizes = array_filter($allSizes, function ($value) {
                return ! empty(trim($value));
            });

            foreach ($allSizes as $sizeValue) {
                $product->sizes()->create(['size' => trim($sizeValue)]);
            }
        }
        // Update product

        // ... other fields ...

        // Update slug if name changed
        $slug = $product->slug;
        if ($product->name != $validated['name']) {
            $slug = Str::slug($validated['name'].'-'.Str::random(6));
        }

        // Update product
        $product->update([
            'seller_id' => $validated['seller_id'],
            'name' => $validated['name'],
            'slug' => $slug,
            'sku' => $validated['sku'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'brand_id' => $validated['brand_id'],
            'price' => $validated['price'],
            'currency' => $validated['currency'],
            'discount_price' => $validated['discount_price'],
            'discount_type' => $validated['discount_type'],
            'stock_quantity' => $validated['stock_quantity'],
            'low_stock_quantity' => $validated['low_stock_quantity'],
            'maximum_purchase_quantity' => $validated['maximum_purchase_quantity'] ?? 0,
            'weight' => $validated['weight'],
            'length' => $validated['length'],
            'width' => $validated['width'],
            'height' => $validated['height'],
            'can_purchase' => $request->boolean('can_purchase'),
            'show_stock_out' => $request->boolean('show_stock_out'),
            'refundable' => $request->boolean('refundable'),
            'is_active' => $request->boolean('is_active'),
            'is_flash_sale' => $request->boolean('is_flash_sale'),
            'meta_title' => $validated['meta_title'],
            'meta_keywords' => $validated['meta_keywords'],
            'meta_description' => $validated['meta_description'],
            'thumbnail' => $thumbnailPath,
            'affiliate_percentage' => $validated['affiliate_percentage'] ?? $product->affiliate_percentage, // If not provided, keep the old value
            'images' => ! empty($images) ? $images : null, // Pass as array
            'videos' => ! empty($videos) ? $videos : null, // Pass as array
        ]);

        // Handle variants update
        if ($request->has('variants')) {
            $existingVariantIds = [];

            foreach ($request->variants as $variantData) {
                if (isset($variantData['id'])) {
                    // Update existing variant
                    $variant = ProductVariant::find($variantData['id']);
                    if ($variant) {
                        $existingVariantIds[] = $variant->id;

                        // Handle variant images
                        $variantImages = $variant->images
                            ? (is_array($variant->images) ? $variant->images : json_decode($variant->images, true))
                            : [];
                        if (isset($variantData['remove_images'])) {
                            foreach ($variantData['remove_images'] as $imageToRemove) {
                                $key = array_search($imageToRemove, $variantImages);
                                if ($key !== false) {
                                    Storage::disk('public')->delete($imageToRemove);
                                    unset($variantImages[$key]);
                                }
                            }
                            $variantImages = array_values($variantImages);
                        }

                        if (isset($variantData['images'])) {
                            foreach ($variantData['images'] as $image) {
                                $variantImages[] = $image->store('products/variants', 'public');
                            }
                        }

                        // Handle variant videos
                        $variantVideos = $variant->videos
                            ? (is_array($variant->videos) ? $variant->videos : json_decode($variant->videos, true))
                            : [];
                        if (isset($variantData['remove_videos'])) {
                            foreach ($variantData['remove_videos'] as $videoToRemove) {
                                $key = array_search($videoToRemove, $variantVideos);
                                if ($key !== false) {
                                    Storage::disk('public')->delete($videoToRemove);
                                    unset($variantVideos[$key]);
                                }
                            }
                            $variantVideos = array_values($variantVideos);
                        }

                        if (isset($variantData['videos'])) {
                            foreach ($variantData['videos'] as $video) {
                                $variantVideos[] = $video->store('products/variants', 'public');
                            }
                        }

                        $variant->update([
                            'variant_name' => $variantData['variant_name'],
                            'sku' => $variantData['sku'],
                            'price' => $variantData['price'] ?? $product->price,
                            'quantity' => $variantData['quantity'] ?? $product->stock_quantity,
                            'images' => ! empty($variantImages) ? json_encode($variantImages) : null,
                            'videos' => ! empty($variantVideos) ? json_encode($variantVideos) : null,
                        ]);
                    }
                } elseif (! empty($variantData['variant_name'])) {
                    // Create new variant
                    $variantImages = [];
                    if (isset($variantData['images'])) {
                        foreach ($variantData['images'] as $image) {
                            $variantImages[] = $image->store('products/variants', 'public');
                        }
                    }

                    $variantVideos = [];
                    if (isset($variantData['videos'])) {
                        foreach ($variantData['videos'] as $video) {
                            $variantVideos[] = $video->store('products/variants', 'public');
                        }
                    }

                    $variant = ProductVariant::create([
                        'product_id' => $product->id,
                        'variant_name' => $variantData['variant_name'],
                        'sku' => $variantData['sku'],
                        'price' => $variantData['price'] ?? $product->price,
                        'quantity' => $variantData['quantity'] ?? $product->stock_quantity,
                        'images' => ! empty($variantImages) ? json_encode($variantImages) : null,
                        'videos' => ! empty($variantVideos) ? json_encode($variantVideos) : null,
                    ]);

                    $existingVariantIds[] = $variant->id;
                }
            }

            // Delete variants not in the request
            ProductVariant::where('product_id', $product->id)
                ->whereNotIn('id', $existingVariantIds)
                ->delete();
        } else {
            // Delete all variants if none provided
            ProductVariant::where('product_id', $product->id)->delete();
        }

        $this->logActivity("Updated product: {$product->name}");

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully');
    }

    /* =========================
       Delete Product
    ========================== */
    public function destroy(Product $product)
    {
        // Delete associated files
        if ($product->thumbnail) {
            Storage::disk('public')->delete($product->thumbnail);
        }

        if ($product->images) {
            $images = is_array($product->images) ? $product->images : json_decode($product->images, true);
            foreach ($images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        if ($product->videos) {
            $videos = is_array($product->videos) ? $product->videos : json_decode($product->videos, true);
            foreach ($videos as $video) {
                Storage::disk('public')->delete($video);
            }
        }

        // Delete variant files
        foreach ($product->variants as $variant) {
            if ($variant->images) {
                $images = is_array($variant->images) ? $variant->images : json_decode($variant->images, true);
                foreach ($images as $image) {
                    Storage::disk('public')->delete($image);
                }
            }

            if ($variant->videos) {
                $videos = is_array($variant->videos) ? $variant->videos : json_decode($variant->videos, true);
                foreach ($videos as $video) {
                    Storage::disk('public')->delete($video);
                }
            }
        }

        $productName = $product->name;
        $product->delete();

        $this->logActivity("Deleted product: {$productName}");

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully');
    }

    /* =========================
       Bulk Actions
    ========================== */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:activate,deactivate,delete,flash_sale_enable,flash_sale_disable',
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
        ]);

        $action = $request->action;
        $productIds = $request->product_ids;
        $count = 0;

        switch ($action) {
            case 'activate':
                Product::whereIn('id', $productIds)->update(['is_active' => 1]);
                $count = count($productIds);
                break;

            case 'deactivate':
                Product::whereIn('id', $productIds)->update(['is_active' => 0]);
                $count = count($productIds);
                break;

            case 'flash_sale_enable':
                Product::whereIn('id', $productIds)->update(['is_flash_sale' => 1]);
                $count = count($productIds);
                break;

            case 'flash_sale_disable':
                Product::whereIn('id', $productIds)->update(['is_flash_sale' => 0]);
                $count = count($productIds);
                break;

            case 'delete':
                // Delete associated files
                $products = Product::whereIn('id', $productIds)->get();
                foreach ($products as $product) {
                    if ($product->thumbnail) {
                        Storage::disk('public')->delete($product->thumbnail);
                    }

                    if ($product->images) {
                        $images = is_array($product->images) ? $product->images : json_decode($product->images, true);
                        foreach ($images as $image) {
                            Storage::disk('public')->delete($image);
                        }
                    }

                    if ($product->videos) {
                        $videos = is_array($product->videos) ? $product->videos : json_decode($product->videos, true);
                        foreach ($videos as $video) {
                            Storage::disk('public')->delete($video);
                        }
                    }
                }

                Product::whereIn('id', $productIds)->delete();
                $count = count($productIds);
                break;
        }

        $this->logActivity("Bulk action '{$action}' on {$count} products");

        return back()->with('success', "{$count} products updated successfully");
    }

    /* =========================
       Toggle Product Status
    ========================== */
    public function toggleStatus(Product $product)
    {
        $product->update([
            'is_active' => ! $product->is_active,
        ]);

        $status = $product->is_active ? 'activated' : 'deactivated';
        $this->logActivity("{$status} product: {$product->name}");

        return back()->with('success', "Product {$status} successfully");
    }

    /* =========================
       Toggle Flash Sale Status
    ========================== */
    public function toggleFlashSale(Product $product)
    {
        $product->update([
            'is_flash_sale' => ! $product->is_flash_sale,
        ]);

        $status = $product->is_flash_sale ? 'added to flash sale' : 'removed from flash sale';
        $this->logActivity("{$status}: {$product->name}");

        return back()->with('success', "Product {$status} successfully");
    }

    /* =========================
       Update Stock
    ========================== */
    public function updateStock(Request $request, Product $product)
    {
        $request->validate([
            'stock_quantity' => 'required|integer|min:0',
            'type' => 'required|in:set,add,subtract',
        ]);

        $oldStock = $product->stock_quantity;

        switch ($request->type) {
            case 'set':
                $product->stock_quantity = $request->stock_quantity;
                break;
            case 'add':
                $product->stock_quantity += $request->stock_quantity;
                break;
            case 'subtract':
                $product->stock_quantity -= $request->stock_quantity;
                if ($product->stock_quantity < 0) {
                    $product->stock_quantity = 0;
                }
                break;
        }

        $product->save();

        $this->logActivity("Updated stock for {$product->name}: {$oldStock} → {$product->stock_quantity}");

        return back()->with('success', 'Stock updated successfully');
    }

    /* =========================
       Export Products
    ========================== */
    public function export(Request $request)
    {
        $type = $request->get('type', 'csv');
        $products = Product::with(['seller', 'category', 'brand'])->get();

        if ($type == 'csv') {
            return $this->exportToCsv($products);
        }

        return back()->with('error', 'Invalid export type');
    }

    /* =========================
       Export to CSV
    ========================== */
    private function exportToCsv($products)
    {
        $fileName = 'products-'.date('Y-m-d').'.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $columns = [
            'ID', 'Name', 'SKU', 'Seller', 'Category', 'Brand', 'Price', 'Currency',
            'Discount Price', 'Stock', 'Sold Count', 'Status', 'Flash Sale', 'affiliate_percentage',
            'Created At',
        ];

        $callback = function () use ($products, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($products as $product) {
                fputcsv($file, [
                    $product->id,
                    $product->name,
                    $product->sku ?? 'N/A',
                    $product->seller->shop_name ?? 'N/A',
                    $product->category->name ?? 'N/A',
                    $product->brand->name ?? 'N/A',
                    $product->price,
                    $product->currency,
                    $product->discount_price ?? 'N/A',
                    $product->stock_quantity,
                    $product->sold_count + $product->sales_count,
                    $product->is_active ? 'Active' : 'Inactive',
                    $product->is_flash_sale ? 'Yes' : 'No',
                    $product->affiliate_percentage ?? 10,
                    $product->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /* =========================
       Get Product Statistics
    ========================== */
    public function getStatistics()
    {
        $stats = [
            'total_products' => Product::count(),
            'active_products' => Product::where('is_active', 1)->count(),
            'inactive_products' => Product::where('is_active', 0)->count(),
            'out_of_stock' => Product::where('stock_quantity', '<=', 0)->count(),
            'low_stock' => Product::where('stock_quantity', '>', 0)
                ->where('stock_quantity', '<=', DB::raw('low_stock_quantity'))
                ->count(),
            'flash_sale_products' => Product::where('is_flash_sale', 1)->count(),
            'new_today' => Product::whereDate('created_at', today())->count(),
            'new_week' => Product::where('created_at', '>=', now()->subWeek())->count(),
            'total_revenue' => Product::sum(DB::raw('price * (sold_count + sales_count)')),
        ];

        // Monthly product creation data for chart
        $monthlyProducts = Product::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subYear())
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Top selling products
        $topSelling = Product::orderByRaw('(sold_count + sales_count) DESC')
            ->take(10)
            ->get(['id', 'name', 'sold_count', 'sales_count', 'price']);

        return response()->json([
            'success' => true,
            'stats' => $stats,
            'monthly_data' => $monthlyProducts,
            'top_selling' => $topSelling,
        ]);
    }

    /* =========================
       Activity Logger
    ========================== */
    private function logActivity($action)
    {
        // Check if table exists before logging
        if (Schema::hasTable('activity_logs')) {
            DB::table('activity_logs')->insert([
                'admin_id' => auth()->guard('admin')->id(),
                'action' => $action,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
