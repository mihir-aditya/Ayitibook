<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // GET /products
    public function index(Request $request)
    {
        $search  = $request->get('q');
        $perPage = (int) $request->get('per_page', 9);

        $products = Product::whereNull('deleted_at')
            ->where('is_active', '1') // important for marketplace
            ->when($search, function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        if ($request->wantsJson()) {
            return response()->json($products);
        }

        return view('pages.search-product', compact('products', 'search'));
    }

    // GET /products/{product}
    public function show(Product $product)
    {
        abort_if(
            $product->deleted_at || $product->status !== 'active',
            404
        );

        return view('pages.product-details', compact('product'));
    }
}
