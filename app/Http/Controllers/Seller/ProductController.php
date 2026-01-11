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
            'sellr.apps.e-commerce.admin.products',
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

        return view('sellr.apps.e-commerce.admin.addproduct', compact('categories', 'brands', 'tags'));
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

        $product->load('variants');

        return view(
            'sellr.apps.e-commerce.landing.productview',
            compact('product')
        );
    }

    /* =====================================================
     | Edit Page
     ===================================================== */
    public function edit($id)
    {
        $product = Product::with('variants')
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

        if ($request->hasFile('thumbnail')) {
            if ($product->thumbnail) {
                Storage::disk('public')->delete($product->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')
                ->store('products/thumbnails', 'public');
        }

        $product->update($data);

        /* Re-create variants */
        $product->variants()->delete();

        if ($request->has('variants')) {
            foreach ($request->variants as $variant) {
                if (! empty($variant['variant_name'])) {
                    ProductVariant::create([
                        'product_id' => $product->id,
                        'variant_name' => $variant['variant_name'],
                        'sku' => $variant['sku'] ?? $this->generateSku(),
                        'price' => $variant['price'] ?? $product->price,
                        'quantity' => $variant['quantity'] ?? 0,
                    ]);
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
