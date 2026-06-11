<?php

namespace App\Http\Controllers;

use App\Models\CustomerProfile;
use App\Models\Address;
use App\Models\Order;
use App\Models\BnplTier;
use App\Models\TransactionDetail;
use App\Models\WalletTransaction;
use App\Models\RefundRequest;
use App\Models\Seller;
use App\Models\Wishlist;
use App\Services\BnplService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the profile edit page.
     */
    public function edit(Request $request): View
    {
        $user    = $request->user();
        $profile = $request->user()->customerProfile;

        return view('profile.edit', [
            'user'              => $user,
            'profile'           => $profile,
            'paymentOptions'    => CustomerProfile::paymentOptions(),
            'deliveryOptions'   => CustomerProfile::deliveryOptions(),
            'frequencyOptions'  => CustomerProfile::frequencyOptions(),
            'orderValueOptions' => CustomerProfile::orderValueOptions(),
            'monthlyOptions'    => CustomerProfile::monthlyEstimateOptions(),
            'interestOptions'   => CustomerProfile::interestOptions(),
            'idTypeOptions'     => CustomerProfile::idTypeOptions(),
        ]);
    }

    /* ══════════════════════════════════════════════════
       TAB 1 — Account Info
    ══════════════════════════════════════════════════ */
    public function updateAccount(Request $request): RedirectResponse
    {
        $user = $request->user();

        $request->validate([
            'first_name'  => ['required', 'string', 'max:255'],
            'last_name'   => ['required', 'string', 'max:255'],
            'name'        => ['nullable', 'string', 'max:255'],
            'username'    => ['nullable', 'string', 'max:50', Rule::unique('users')->ignore($user->id)],
            'email'       => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone'       => ['required', 'string', 'max:15', Rule::unique('users')->ignore($user->id)],
            'gender'      => ['nullable', 'in:male,female,others,not_say'],
            'dial_code'   => ['nullable', 'string', 'max:10'],
            'address'     => ['nullable', 'string', 'max:500'],
            'profile_pic' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        $user->first_name = $request->first_name;
        $user->last_name  = $request->last_name;
        $user->name       = $request->name ?: trim($request->first_name . ' ' . $request->last_name);
        $user->username   = $request->username ?: ($user->username ?: strtolower(str_replace(' ', '', $user->name)));
        $user->phone      = $request->phone;

        if ($user->email !== $request->email) {
            $user->email             = $request->email;
            $user->email_verified_at = null;
        }

        if ($request->hasFile('profile_pic')) {
            $file     = $request->file('profile_pic');
            $filename = 'avatar_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $destDir  = public_path('storage/avatars');

            if (!file_exists($destDir)) mkdir($destDir, 0755, true);

            if ($user->profile_pic && file_exists(public_path('storage/' . $user->profile_pic))) {
                @unlink(public_path('storage/' . $user->profile_pic));
            }

            $file->move($destDir, $filename);
            $user->profile_pic = 'avatars/' . $filename;
        }

        $user->save();

        CustomerProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'gender'    => $request->gender,
                'dial_code' => $request->dial_code,
                'address'   => $request->address,
                'is_complete' => $request->has('address') ? true : $user->customerProfile->is_complete ?? false,
            ]
        );

        return Redirect::route('profile.edit')
            ->with('status', 'profile-updated')
            ->with('active_tab', 'account');
    }

    /* ══════════════════════════════════════════════════
       TAB 2 — Address
    ══════════════════════════════════════════════════ */
    public function updateAddress(Request $request): RedirectResponse
    {
        $request->validate([
            'address'     => ['required', 'string', 'max:500'],
            'zone'        => ['required', 'string', 'max:255'],
            'city'        => ['required', 'string', 'max:255'],
            'state'       => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'country'     => ['required', 'string', 'max:100'],
        ]);

        CustomerProfile::updateOrCreate(
            ['user_id' => $request->user()->id],
            [
                'address'     => $request->address,
                'zone'        => $request->zone,
                'city'        => $request->city,
                'state'       => $request->state,
                'postal_code' => $request->postal_code,
                'country'     => $request->country,
                'is_complete' => true,
            ]
        );

        return Redirect::route('profile.edit')
            ->with('status', 'profile-updated')
            ->with('active_tab', 'address');
    }

    /* ══════════════════════════════════════════════════
       TAB 3 — Shopping Preferences
    ══════════════════════════════════════════════════ */
    public function updatePreferences(Request $request): RedirectResponse
    {
        $request->validate([
            'preferred_payment'     => ['required', 'in:cod,card,wallet'],
            'delivery_preference'   => ['required', 'in:standard,fast'],
            'purchase_frequency'    => ['required', 'in:daily,weekly,monthly,rarely'],
            'avg_order_value'       => ['required', 'in:<50,50-200,200-500,500+'],
            'buyer_type'            => ['required', 'in:personal,business'],
            'monthly_estimate'      => ['required', 'in:<100,100-500,500-2000,2000+'],
            'interest_categories'   => ['nullable', 'array'],
            'interest_categories.*' => ['string'],
        ]);

        CustomerProfile::updateOrCreate(
            ['user_id' => $request->user()->id],
            [
                'preferred_payment'   => $request->preferred_payment,
                'delivery_preference' => $request->delivery_preference,
                'purchase_frequency'  => $request->purchase_frequency,
                'avg_order_value'     => $request->avg_order_value,
                'buyer_type'          => $request->buyer_type,
                'monthly_estimate'    => $request->monthly_estimate,
                'interest_categories' => $request->interest_categories ?? [],
                'is_complete'         => true,
            ]
        );

        return Redirect::route('profile.edit')
            ->with('status', 'profile-updated')
            ->with('active_tab', 'preferences');
    }

    /* ══════════════════════════════════════════════════
       TAB 4 — Security (password only)
    ══════════════════════════════════════════════════ */
    public function updatePassword(Request $request): RedirectResponse
    {
        $user = $request->user();

        $request->validate([
            'current_password' => ['required'],
            'new_password'     => ['required', 'min:8', 'confirmed'],
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()
                ->withErrors(['current_password' => 'The current password you entered is incorrect.'])
                ->with('active_tab', 'security');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return Redirect::route('profile.edit')
            ->with('status', 'password-updated')
            ->with('active_tab', 'security');
    }

    /* ══════════════════════════════════════════════════
       Public profile view router for single-file pages
    ══════════════════════════════════════════════════ */
    public function show(string $page): View
    {
        $pageMap = [
            'bnpl' => 'profile.bnpl',
            'cancellation' => 'profile.cancellation',
            'dashboard' => 'profile.dashboard',
            'demo' => 'profile.demo',
            'demo2' => 'profile.demo2',
            'edit' => 'profile.edit',
            'profile' => 'profile.edit',
            'profile-page' => 'profile.profile',
            'loyalty-rewards' => 'profile.loyalty_rewards',
            'myreviews' => 'profile.myreviews',
            'notifications' => 'profile.notifications',
            'order-details' => 'profile.order-details',
            'order' => 'profile.order',
            'return' => 'profile.return',
            'saved-payment' => 'profile.saved_payment',
            'subscribed-sellers' => 'profile.Subscribed_Sellers',
            'transaction' => 'profile.Transaction',
            'wallet-transactions' => 'profile.wallet_&_transections',
            'wishlist' => 'profile.wishlist',
            'address' => 'profile.address',
            'profile-page' => 'profile.profile',
        ];

        if (! array_key_exists($page, $pageMap)) {
            abort(404);
        }

        $user = Auth::user();

        $view = $pageMap[$page];

        if (! view()->exists($view)) {
            abort(404);
        }

        $data = [
            'user'            => $user,
            'profile'         => $user?->customerProfile,
            'orders'          => $user?->orders()->with('items.product')->latest()->get(),
            'orderCount'      => $user?->orders()->count(),
            'wishlistItems'   => Wishlist::with('product')->where('user_id', $user->id)->get(),
            'wishlistCount'   => Wishlist::where('user_id', $user->id)->count(),
            'reviews'         => $user?->reviews()->latest()->get(),
            'bnplStatus'      => ($user?->customerProfile?->bnpl_enabled ?? false),
            'loyaltyPoints'   => ($user?->customerProfile?->loyalty_points ?? 0),
        ];

        if ($page === 'address') {
            $data['addresses'] = Address::where('user_id', $user->id)->get();
        }

        if ($page === 'transaction') {
            $data['transactions'] = TransactionDetail::where('user_id', $user->id)->latest()->get();
        }

        if ($page === 'wallet-transactions') {
            $walletTransactions = WalletTransaction::where('user_id', $user->id)->latest()->get();
            $data['walletTransactions'] = $walletTransactions;
            $data['walletBalance'] = $user->wallet_balance;
        }

        if ($page === 'return') {
            $data['refundRequests'] = RefundRequest::with('orderItem.product', 'order')->where('user_id', $user->id)->latest('requested_at')->get();
        }

        if ($page === 'cancellation') {
            $data['cancelledOrders'] = Order::with('items.product')->where('user_id', $user->id)->where('order_status', 'cancelled')->latest()->get();
        }

        if ($page === 'subscribed-sellers') {
            $request = request();

            // ── Subscribed sellers (search + sort + paginate) ──────────
            $subscriptionsQuery = $user->subscribedSellers()
                ->withCount('products')
                ->withCount('subscribers');

            if ($search = $request->get('search')) {
                $subscriptionsQuery->where(function ($q) use ($search) {
                    $q->where('shop_name', 'like', "%{$search}%")
                      ->orWhere('name',      'like', "%{$search}%");
                });
            }

            match ($request->get('sort', 'latest')) {
                'products' => $subscriptionsQuery->orderByDesc('products_count'),
                'rated'    => $subscriptionsQuery->orderByDesc('rating'),
                default    => $subscriptionsQuery->orderByDesc('seller_subscriptions.created_at'),
            };

            $data['subscribedSellers'] = $subscriptionsQuery->paginate(10)->withQueryString();

            // ── Recommended: approved sellers not yet subscribed ───────
            $subscribedIds = $user->subscribedSellers()->pluck('sellers.id');

            $data['recommended'] = Seller::approved()
                ->whereNotIn('id', $subscribedIds)
                ->withCount('products')
                ->withCount('subscribers')
                ->inRandomOrder()
                ->limit(8)
                ->get();
        }

        if ($page === 'bnpl') {
            $bnplService = new BnplService();

            $data['bnplProfile'] = $user->bnplProfile;
            $data['bnplLoans'] = $user->bnplLoans()->with('payments')->get();
            $data['bnplPayments'] = $user->bnplPayments()->latest()->get();
            $data['bnplMilestones'] = $user->bnplMilestones()->get();
            $data['latestCreditScore'] = $user->bnplCreditScores()->latest('calculated_at')->first();
            $data['bnplTiers'] = BnplTier::active()->ordered()->get();

            // Use service for calculations
            $data['currentCreditScore'] = $bnplService->calculateCreditScore($user->id);
            $data['creditTier'] = $bnplService->getCreditTier($data['currentCreditScore']);
            $data['availableLimit'] = $bnplService->calculateAvailableLimit($user->id);
            $data['eligibility'] = $bnplService->checkEligibility($user->id);
            $data['upcomingPayments'] = $bnplService->getUpcomingPayments($user->id, 5);
            $data['paymentHistory'] = $bnplService->getPaymentHistory($user->id, 10);

            // Update milestones
            $bnplService->updateMilestones($user->id);
        }

        return view($view, $data);
    }

    /* ══════════════════════════════════════════════════
       Delete account
    ══════════════════════════════════════════════════ */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}