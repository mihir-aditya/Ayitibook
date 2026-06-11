<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Services\NotificationService;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:seller');
    }

    /* =====================================================
     | Generate UNIQUE SKU (Products + Variants)
     ===================================================== */
    private function generateSku(): string
    {
        do {
            $sku = (string) rand(1000, 99999);
        } while (
            Product::where('sku', $sku)->exists() ||
            ProductVariant::where('sku', $sku)->exists()
        );

        return $sku;
    }

    /* =====================================================
     | Product List
     ===================================================== */
    public function index(Request $request)
    {
        $sellerId = auth('seller')->id();
        $search = $request->query('q');

        $query = Product::where('seller_id', $sellerId)->latest();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        if ($request->ajax()) {
            return response()->json([
                'items' => $query->limit(50)->get()->map(function ($p) {
                    return [
                        'id' => $p->id,
                        'name' => $p->name,
                        'sku' => $p->sku,
                        'price' => number_format($p->price, 2),
                        'is_active' => (bool) $p->is_active,
                        'thumbnail' => $p->thumbnail
                            ? asset('storage/'.$p->thumbnail)
                            : null,
                    ];
                }),
            ]);
        }

        return view(
            'seller.products.products',
            ['products' => $query->paginate(10)]
        );
    }

    /* =====================================================
     | Create Page
     ===================================================== */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        $tags = Tag::where('status', 1)->get();

        return view('seller.products.addproduct', compact('categories', 'brands', 'tags'));
    }

    /* =====================================================
     | Store Product + Variants
     ===================================================== */
    public function store(ProductRequest $request)
    {
        DB::transaction(function () use ($request) {

            $data = $request->validated();

            $data['seller_id'] = auth('seller')->id();

            $data['is_active'] = $request->boolean('is_active');
            $data['can_purchase'] = $request->boolean('can_purchase');
            $data['refundable'] = $request->boolean('refundable');
            $data['is_flash_sale'] = $request->boolean('is_flash_sale');
            $data['affiliate_percentage'] = $request->input('affiliate_percentage', 10); // Default to 10% if not provided
            /* =============================
             | HANDLE VARIANTS FIRST
             ============================= */
            $variants = array_values($request->input('variants', []));

            if (count($variants)) {
                $data['price'] = collect($variants)->pluck('price')->min();
                $data['stock_quantity'] = collect($variants)->pluck('quantity')->sum();
            }

            /* Fallbacks */
            $data['sku'] = $data['sku'] ?? $this->generateSku();
            $data['seller_id'] = auth('seller')->id();
            $data['slug'] = Str::slug($data['name']);

            /* =============================
             | MEDIA
             ============================= */
            if ($request->hasFile('thumbnail')) {
                $data['thumbnail'] = $request->file('thumbnail')
                    ->store('products/thumbnails', 'public');
            }

            if ($request->hasFile('images')) {
                $data['images'] = collect($request->file('images'))
                    ->map(fn ($img) => $img->store('products/images', 'public'))
                    ->toJson();
            }

            if ($request->hasFile('videos')) {
                $data['videos'] = collect($request->file('videos'))
                    ->map(fn ($vid) => $vid->store('products/videos', 'public'))
                    ->toJson();
            }

            /* =============================
             | CREATE PRODUCT
             ============================= */
            $product = Product::create($data);

            /* =============================
             | CREATE VARIANTS
             ============================= */
            foreach ($variants as $index => $variant) {

                if (empty($variant['variant_name'])) {
                    continue;
                }

                $variantImages = [];
                if ($request->hasFile("variants.$index.images")) {
                    foreach ($request->file("variants.$index.images") as $img) {
                        $variantImages[] = $img->store('variants/images', 'public');
                    }
                }

                $variantVideos = [];
                if ($request->hasFile("variants.$index.videos")) {
                    foreach ($request->file("variants.$index.videos") as $vid) {
                        $variantVideos[] = $vid->store('variants/videos', 'public');
                    }
                }

                ProductVariant::create([
                    'product_id' => $product->id,
                    'variant_name' => $variant['variant_name'],
                    'sku' => $variant['sku'] ?? $this->generateSku(),
                    'price' => $variant['price'],
                    'quantity' => $variant['quantity'],
                    'images' => $variantImages,
                    'videos' => $variantVideos,
                ]);
            }
            $seller = auth('seller')->user();
            $notifService = app(NotificationService::class);

            $notifService->newProduct($product, $seller);

            // If it is a flash-sale product, also send the flash-sale notification
            if (! empty($data['is_flash_sale'])) {
                $notifService->flashSale($product, $seller);
            }
        });

        return redirect()
            ->route('seller.products.index')
            ->with('success', 'Product created successfully!');
    }

    /* =====================================================
     | Show Product (Seller View)
     ===================================================== */
    public function show(Product $product)
    {
        abort_if($product->seller_id !== auth('seller')->id(), 403);

        $product->load([
            'variants',
            'sizes',
            'reviews.user',
            'category',
            'brand',
            'affiliateLinks.affiliate.user',
            'affiliateLinks.clicks',
            'affiliateLinks.commissions',
        ]);

        return view('seller.products.productview', compact('product'));
    }

    /* =====================================================
     | Edit Page
     ===================================================== */
    public function edit($id)
    {
        $product = Product::with(['variants', 'sizes'])
            ->where('seller_id', auth('seller')->id())
            ->findOrFail($id);

        return view('seller.products.editproduct', compact('product'));
    }

    /* =====================================================
     | Update Product + Variants
     ===================================================== */
    public function update(ProductRequest $request, Product $product)
    {
        abort_if($product->seller_id !== auth('seller')->id(), 403);

        $data = $request->validated();
        $data['sku'] = $data['sku'] ?? $product->sku ?? $this->generateSku();

        // Update thumbnail if new one uploaded
        if ($request->hasFile('thumbnail')) {
            if ($product->thumbnail) {
                Storage::disk('public')->delete($product->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')
                ->store('products/thumbnails', 'public');
        }
        if ($request->boolean('is_flash_sale') && ! $product->getOriginal('is_flash_sale')) {
            $seller = auth('seller')->user();
            app(NotificationService::class)->flashSale($product, $seller);
        }

        $product->update($data);

        // ──────────────────────────────────────────────────────────
        // HANDLE VARIANT IMAGES REMOVAL
        // ──────────────────────────────────────────────────────────
        $removedVariantImages = json_decode($request->input('removed_variant_images', '[]'), true);
        $removedByIndex = [];
        foreach ($removedVariantImages as $item) {
            $removedByIndex[$item['variant_index']][] = $item['image'];
        }

        // Load existing variants for comparison
        $existingVariants = $product->variants->keyBy('id');
        $keepVariantIds = [];

        // ──────────────────────────────────────────────────────────
        // PROCESS SUBMITTED VARIANTS
        // ──────────────────────────────────────────────────────────
        $submittedVariants = $request->input('variants', []);
        foreach ($submittedVariants as $idx => $variantData) {
            $variantId = $variantData['id'] ?? null;
            $keepVariantIds[] = $variantId;

            // Determine which existing images to keep
            $existingImages = $variantData['existing_images'] ?? [];
            $removedForThis = $removedByIndex[$idx] ?? [];
            $finalExistingImages = array_diff($existingImages, $removedForThis);

            // Delete removed images from storage
            foreach ($removedForThis as $imgPath) {
                Storage::disk('public')->delete($imgPath);
            }

            // Upload new images
            $newImages = [];
            if ($request->hasFile("variants.$idx.images")) {
                foreach ($request->file("variants.$idx.images") as $img) {
                    $newImages[] = $img->store('variants/images', 'public');
                }
            }

            $allImages = array_merge($finalExistingImages, $newImages);

            // Prepare variant data
            $variantDataToSave = [
                'variant_name' => $variantData['variant_name'],
                'sku' => $variantData['sku'] ?? $this->generateSku(),
                'price' => $variantData['price'],
                'quantity' => $variantData['quantity'],
                'images' => $allImages,
                'videos' => [], // handle videos if needed
            ];

            if ($variantId && $existingVariants->has($variantId)) {
                // Update existing variant
                $existingVariants[$variantId]->update($variantDataToSave);
            } else {
                // Create new variant
                $variantDataToSave['product_id'] = $product->id;
                ProductVariant::create($variantDataToSave);
            }
        }

        // ──────────────────────────────────────────────────────────
        // DELETE VARIANTS THAT WERE REMOVED
        // ──────────────────────────────────────────────────────────
        $variantsToDelete = $product->variants()->whereNotIn('id', $keepVariantIds)->get();
        foreach ($variantsToDelete as $variant) {
            // Delete variant images from storage
            if ($variant->images) {
                foreach ($variant->images as $img) {
                    Storage::disk('public')->delete($img);
                }
            }
            $variant->delete();
        }

        // ──────────────────────────────────────────────────────────
        // HANDLE SIZES
        // ──────────────────────────────────────────────────────────
        if ($request->has('sizes')) {
            $product->sizes()->delete();
            foreach ($request->input('sizes', []) as $sizeName) {
                if (! empty($sizeName)) {
                    $product->sizes()->create(['size' => trim($sizeName)]);
                }
            }
        }

        return redirect()
            ->route('seller.products.index')
            ->with('success', 'Product updated successfully!');
    }

    /* =====================================================
     | Delete Product
     ===================================================== */
    public function destroy(Product $product, $id)
    {

        abort_if($product->seller_id !== auth('seller')->id(), 403);

        DB::transaction(function () use ($product) {

            /* =============================
             | DELETE VARIANT MEDIA
             ============================= */
            foreach ($product->variants as $variant) {
                if (! empty($variant->images)) {
                    Storage::disk('public')->delete($variant->images);
                }
                if (! empty($variant->videos)) {
                    Storage::disk('public')->delete($variant->videos);
                }
            }

            /* =============================
             | DELETE PRODUCT MEDIA
             ============================= */
            if ($product->thumbnail) {
                Storage::disk('public')->delete($product->thumbnail);
            }

            if (! empty($product->images)) {
                Storage::disk('public')->delete(json_decode($product->images, true));
            }

            if (! empty($product->videos)) {
                Storage::disk('public')->delete(json_decode($product->videos, true));
            }

            /* =============================
             | DELETE PRODUCT
             | (Variants auto-deleted via FK or model hook)
             ============================= */
            $product->delete();
        });

        return back()->with('success', 'Product deleted successfully.');
    }

    /* =====================================================
     | Quick Add Category
     ===================================================== */
    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
        ]);

        try {
            $slug = $validated['slug'] ?? Str::slug($validated['name']);

            $category = Category::create([
                'name' => $validated['name'],
                'slug' => $slug,
                'status' => 1,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Category created successfully',
                'category' => $category,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating category: '.$e->getMessage(),
            ], 422);
        }
    }

    /* =====================================================
     | Quick Add Brand
     ===================================================== */
    public function storeBrand(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
            'brand_id' => 'required|string|max:255',
        ]);

        try {
            $brand = Brand::create([
                'name' => $validated['name'],
                'brand_id' => $validated['brand_id'],
                'status' => 1,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Brand created successfully',
                'brand' => $brand,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating brand: '.$e->getMessage(),
            ], 422);
        }
    }

    /* =====================================================
     | Quick Add Tag
     ===================================================== */
    public function storeTag(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
            'slug' => 'nullable|string|max:255|unique:tags,slug',
        ]);

        try {
            $slug = $validated['slug'] ?? Str::slug($validated['name']);

            $tag = Tag::create([
                'name' => $validated['name'],
                'slug' => $slug,
                'status' => 1,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Tag created successfully',
                'tag' => $tag,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating tag: '.$e->getMessage(),
            ], 422);
        }
    }
}
