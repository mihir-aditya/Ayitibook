<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating'   => 'required|integer|min:1|max:5',
            'body'     => 'required|string|min:10|max:2000',
            'images'   => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // One review per user per product
        $existing = ProductReview::where('product_id', $product->id)
                                 ->where('user_id', Auth::id())
                                 ->first();

        if ($existing) {
            return back()->with('review_error', 'You have already reviewed this product.');
        }

        // ── Handle image uploads ──
        $imagePaths = [];

        if ($request->hasFile('images')) {

            // Ensure directory exists
            if (!Storage::disk('public')->exists('reviews')) {
                Storage::disk('public')->makeDirectory('reviews');
            }

            foreach ($request->file('images') as $image) {
                $path = $image->storePublicly('reviews', 'public');
                if ($path) {
                    $imagePaths[] = $path;
                }
            }
        }

        ProductReview::create([
            'product_id' => $product->id,
            'user_id'    => Auth::id(),
            'rating'     => (int) $request->rating,
            'body'       => $request->body,
            'images'     => !empty($imagePaths) ? $imagePaths : null,
        ]);

        return back()->with('review_success', 'Your review has been posted!');
    }

    public function edit(ProductReview $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403, 'You can only edit your own reviews.');
        }

        return view('profile.edit_review', compact('review'));
    }

    public function update(Request $request, ProductReview $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403, 'You can only edit your own reviews.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'body'   => 'required|string|min:10|max:2000',
            'remove_images' => 'nullable|array',
            'remove_images.*' => 'integer',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Handle image removals
        $currentImages = $review->images ?? [];
        if ($request->has('remove_images') && !empty($request->remove_images)) {
            $removeIndices = $request->remove_images;
            // Sort in descending order to remove from end first
            rsort($removeIndices);
            foreach ($removeIndices as $index) {
                if (isset($currentImages[$index])) {
                    // Delete the file from storage
                    Storage::disk('public')->delete($currentImages[$index]);
                    // Remove from array
                    unset($currentImages[$index]);
                }
            }
            // Reindex the array
            $currentImages = array_values($currentImages);
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            // Ensure directory exists
            if (!Storage::disk('public')->exists('reviews')) {
                Storage::disk('public')->makeDirectory('reviews');
            }

            foreach ($request->file('images') as $image) {
                $path = $image->storePublicly('reviews', 'public');
                if ($path) {
                    $currentImages[] = $path;
                }
            }
        }

        $review->update([
            'rating' => (int) $request->rating,
            'body'   => $request->body,
            'images' => !empty($currentImages) ? $currentImages : null,
        ]);

        return redirect()->route('profile.page', ['page' => 'myreviews'])
                         ->with('review_success', 'Your review has been updated.');
    }

    public function destroy(ProductReview $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403, 'You can only delete your own reviews.');
        }

        if (!empty($review->images)) {
            foreach ($review->images as $path) {
                Storage::disk('public')->delete($path);
            }
        }

        $review->delete();

        return back()->with('review_success', 'Your review has been deleted.');
    }
}