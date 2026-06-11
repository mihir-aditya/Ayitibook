<?php

// app/Http/Controllers/DeliveryPartner/DashboardController.php

namespace App\Http\Controllers\DeliveryPartner;

use App\Http\Controllers\Controller;
use App\Models\DeliveryPartnerPickup;
use App\Models\Order;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show dashboard.
     */
    public function index()
    {
        $partner = Auth::guard('delivery_partner')->user();

        $stats = [
            'total_deliveries' => $partner->total_deliveries,
            'total_earnings' => $partner->total_earnings,
            'rating' => $partner->rating,
            'active_deliveries' => $partner->activePickups()->count(),
            'today_deliveries' => $partner->pickups()
                ->whereDate('delivered_at', today())
                ->count(),
            'pending_payouts' => $partner->payouts()
                ->where('status', 'pending')
                ->sum('amount'),
        ];

        $recentPickups = $partner->pickups()
            ->with('order')
            ->latest()
            ->limit(5)
            ->get();

        return view('delivery-partner.dashboard', compact('partner', 'stats', 'recentPickups'));
    }

    /**
     * Show available pickups.
     */
    public function availablePickups()
    {
        $partner = Auth::guard('delivery_partner')->user();

        // Get orders ready for pickup that aren't assigned
        $availableOrders = Order::where('status', 'processing')
            ->whereDoesntHave('deliveryPartnerPickup')
            ->with('seller')
            ->latest()
            ->get();

        return view('delivery-partner.available-pickups', compact('availableOrders'));
    }

    /**
     * Accept a pickup.
     */
    public function acceptPickup(Request $request, Order $order)
    {
        $partner = Auth::guard('delivery_partner')->user();

        // Check if partner is available
        if (! $partner->isAvailable()) {
            return back()->with('error', 'You are not available for new pickups.');
        }

        // Check if order is already assigned
        if ($order->deliveryPartnerPickup()->exists()) {
            return back()->with('error', 'This order is already assigned.');
        }

        // Generate OTP
        $otp = rand(100000, 999999);

        $pickup = DeliveryPartnerPickup::create([
            'delivery_partner_id' => $partner->id,
            'order_id' => $order->id,
            'seller_id' => $order->seller_id,
            'status' => 'assigned',
            'assigned_at' => now(),
            'pickup_address' => $order->seller->address,
            'delivery_address' => $order->shipping_address,
            'delivery_otp' => $otp,
            'delivery_fee' => $this->calculateDeliveryFee($order),
        ]);

        // Update order status
        $order->update(['status' => 'assigned_to_delivery']);

        return redirect()->route('delivery-partner.pickups.show', $pickup)
            ->with('success', 'Pickup assigned successfully! OTP: '.$otp);
    }

    /**
     * Show my pickups.
     */
    public function myPickups(Request $request)
    {
        $partner = Auth::guard('delivery_partner')->user();

        $query = $partner->pickups()->with('order.seller');

        // Filter by status
        if ($request->has('status') && ! empty($request->status)) {
            $query->where('status', $request->status);
        }

        $pickups = $query->latest()->paginate(15);

        return view('delivery-partner.my-pickups', compact('pickups'));
    }

    /**
     * Show pickup details.
     */
    public function showPickup(DeliveryPartnerPickup $pickup)
    {
        $this->authorize('view', $pickup);

        $pickup->load('order.seller', 'order.items.product');

        return view('delivery-partner.pickup-details', compact('pickup'));
    }

    /**
     * Update pickup status.
     */
    public function updatePickupStatus(Request $request, DeliveryPartnerPickup $pickup)
    {
        $this->authorize('update', $pickup);

        $request->validate([
            'status' => 'required|in:picked_up,in_transit,delivered,failed',
            'otp' => 'required_if:status,delivered|nullable|string|size:6',
            'proof' => 'nullable|image|max:5120', // Max 5MB
        ]);

        switch ($request->status) {

            case 'picked_up':
                $pickup->update(['status' => 'picked_up', 'picked_up_at' => now()]);
                // Notify buyer
                app(NotificationService::class)->deliveryUpdate(
                    $pickup->order, 'Picked up by delivery partner'
                );
                break;

            case 'in_transit':
                $pickup->update(['status' => 'in_transit']);
                // Notify buyer
                app(NotificationService::class)->deliveryUpdate(
                    $pickup->order, 'Your order is on the way'
                );
                break;

            case 'delivered':
                if (! $pickup->validateOtp($request->otp)) {
                    return back()->with('error', 'Invalid OTP.');
                }
                $proof = null;
                if ($request->hasFile('proof')) {
                    $path = $request->file('proof')->store('delivery-proofs', 'public');
                    $proof = ['type' => 'image', 'path' => $path];
                }
                $pickup->markAsDelivered($proof);
                // Notify buyer
                app(NotificationService::class)->orderDelivered($pickup->order);

                return redirect()->route('delivery-partner.my-pickups')
                    ->with('success', 'Delivery completed successfully!');

            case 'failed':
                $request->validate(['cancellation_reason' => 'required|string|max:500']);
                $pickup->update(['status' => 'failed', 'cancellation_reason' => $request->cancellation_reason]);
                $pickup->order->update(['status' => 'processing']);
                // Notify buyer
                app(NotificationService::class)->deliveryUpdate(
                    $pickup->order, 'Delivery attempt failed — will be rescheduled'
                );
                break;
        }

        return back()->with('success', 'Pickup status updated successfully.');
    }

    /**
     * Update location.
     */
    public function updateLocation(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $partner = Auth::guard('delivery_partner')->user();

        $partner->update([
            'current_latitude' => $request->latitude,
            'current_longitude' => $request->longitude,
            'last_location_update' => now(),
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Toggle online status.
     */
    public function toggleOnline()
    {
        $partner = Auth::guard('delivery_partner')->user();

        $partner->update([
            'is_online' => ! $partner->is_online,
        ]);

        return back()->with('success', 'Status updated successfully.');
    }

    /**
     * Show earnings.
     */
    public function earnings()
    {
        $partner = Auth::guard('delivery_partner')->user();

        $earnings = [
            'total' => $partner->total_earnings,
            'this_month' => $partner->pickups()
                ->where('status', 'delivered')
                ->whereMonth('delivered_at', now()->month)
                ->sum('delivery_fee'),
            'today' => $partner->pickups()
                ->where('status', 'delivered')
                ->whereDate('delivered_at', today())
                ->sum('delivery_fee'),
            'pending_payout' => $partner->payouts()
                ->where('status', 'pending')
                ->sum('amount'),
        ];

        $recentEarnings = $partner->pickups()
            ->where('status', 'delivered')
            ->with('order')
            ->latest('delivered_at')
            ->paginate(15);

        return view('delivery-partner.earnings', compact('partner', 'earnings', 'recentEarnings'));
    }

    /**
     * Request payout.
     */
    public function requestPayout(Request $request)
    {
        $partner = Auth::guard('delivery_partner')->user();

        $request->validate([
            'amount' => 'required|numeric|min:100|max:'.$partner->total_earnings,
            'payout_method' => 'required|in:bank_transfer,upi',
            'bank_name' => 'required_if:payout_method,bank_transfer',
            'account_number' => 'required_if:payout_method,bank_transfer',
            'ifsc_code' => 'required_if:payout_method,bank_transfer',
            'upi_id' => 'required_if:payout_method,upi',
        ]);

        $payout = $partner->payouts()->create([
            'payout_reference' => \App\Models\DeliveryPartnerPayout::generateReference(),
            'amount' => $request->amount,
            'status' => 'pending',
            'payout_method' => $request->payout_method,
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'ifsc_code' => $request->ifsc_code,
            'upi_id' => $request->upi_id,
        ]);

        return redirect()->route('delivery-partner.earnings')
            ->with('success', 'Payout request submitted successfully. Reference: '.$payout->payout_reference);
    }

    /**
     * Show profile.
     */
    public function profile()
    {
        $partner = Auth::guard('delivery_partner')->user();

        return view('delivery-partner.profile', compact('partner'));
    }

    /**
     * Update profile.
     */
    public function updateProfile(Request $request)
    {
        $partner = Auth::guard('delivery_partner')->user();

        // Check if this is an avatar-only upload or full profile update
        if ($request->hasFile('avatar')) {
            // Validate only avatar
            $request->validate([
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Delete old avatar if exists
            if ($partner->avatar && file_exists(storage_path('app/public/'.$partner->avatar))) {
                unlink(storage_path('app/public/'.$partner->avatar));
            }

            // Store new avatar
            $path = $request->file('avatar')->store('delivery-partners/avatars', 'public');

            $partner->update([
                'avatar' => $path,
            ]);

            return back()->with('success', 'Profile picture updated successfully.');
        }

        // Full profile update validation
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'vehicle_type' => 'required|string|in:bicycle,motorcycle,scooter,car,van,truck',
            'vehicle_number' => 'required|string|max:20',
            'license_number' => 'required|string|max:50',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
        ]);

        $data = $request->only([
            'name',
            'phone',
            'vehicle_type',
            'vehicle_number',
            'license_number',
            'address',
            'city',
            'state',
            'postal_code',
        ]);

        $partner->update($data);

        return back()->with('success', 'Profile updated successfully.');
    }

    /**
     * Calculate delivery fee.
     */
    private function calculateDeliveryFee($order)
    {
        // Implement your delivery fee calculation logic
        // This is a simple example
        $baseFee = 50; // Base fee
        $perKmFee = 10; // Fee per km

        // You would calculate distance from seller to customer
        $distance = 5; // Example distance

        return $baseFee + ($perKmFee * $distance);
    }
}
