<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\SellerSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerSubscriptionController extends Controller
{
    /* ─────────────────────────────────────────────────────────────
       Subscribed-sellers page  (profile/subscribed-sellers)
    ───────────────────────────────────────────────────────────── */
    public function index(Request $request)
    {
        $user = Auth::user();

        /* ── Subscribed sellers ─────────────────────────── */
        $subscriptionsQuery = $user->subscribedSellers()
            ->withCount('products')          // $seller->products_count
            ->withCount('subscribers');      // $seller->subscribers_count

        // Live search
        if ($search = $request->get('search')) {
            $subscriptionsQuery->where(function ($q) use ($search) {
                $q->where('shop_name', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%");
            });
        }

        // Sort
        match ($request->get('sort', 'latest')) {
            'products'  => $subscriptionsQuery->orderByDesc('products_count'),
            'rated'     => $subscriptionsQuery->orderByDesc('rating'),      // add rating col if needed
            default     => $subscriptionsQuery->orderByDesc('seller_subscriptions.created_at'),
        };

        $subscribedSellers = $subscriptionsQuery->paginate(10)->withQueryString();

        /* ── Recommended sellers (approved, not yet subscribed) ── */
        $subscribedIds = $user->subscribedSellers()->pluck('sellers.id');

        $recommended = Seller::approved()
            ->whereNotIn('id', $subscribedIds)
            ->withCount('products')
            ->withCount('subscribers')
            ->inRandomOrder()
            ->limit(8)
            ->get();

        return view('profile.subscribed-sellers', compact('subscribedSellers', 'recommended'));
    }

    /* ─────────────────────────────────────────────────────────────
       Toggle subscribe / unsubscribe  (POST /sellers/{seller}/subscribe)
    ───────────────────────────────────────────────────────────── */
    public function toggle(Seller $seller)
    {
        $user = Auth::user();

        $existing = SellerSubscription::where('user_id', $user->id)
            ->where('seller_id', $seller->id)
            ->first();

        if ($existing) {
            $existing->delete();
            $subscribed = false;
            $message    = "Unsubscribed from {$seller->shop_name}.";
        } else {
            SellerSubscription::create([
                'user_id'   => $user->id,
                'seller_id' => $seller->id,
            ]);
            $subscribed = true;
            $message    = "Subscribed to {$seller->shop_name}!";
        }

        // AJAX response
        if (request()->expectsJson()) {
            return response()->json([
                'subscribed'        => $subscribed,
                'message'           => $message,
                'subscribers_count' => $seller->subscribers()->count(),
            ]);
        }

        return back()->with('success', $message);
    }

    /* ─────────────────────────────────────────────────────────────
       Hard unsubscribe  (DELETE /sellers/{seller}/subscribe)
       — used by the "Unsubscribe" button on the subscriptions page
    ───────────────────────────────────────────────────────────── */
    public function destroy(Seller $seller)
    {
        SellerSubscription::where('user_id', Auth::id())
            ->where('seller_id', $seller->id)
            ->delete();

        if (request()->expectsJson()) {
            return response()->json(['subscribed' => false]);
        }

        return back()->with('success', "Unsubscribed from {$seller->shop_name}.");
    }
}