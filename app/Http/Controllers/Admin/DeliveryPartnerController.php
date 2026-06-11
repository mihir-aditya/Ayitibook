<?php
// app/Http/Controllers/Admin/DeliveryPartnerController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryPartner;
use App\Models\DeliveryPartnerPayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DeliveryPartnerController extends Controller
{
    /**
     * Display a listing of delivery partners.
     */
    public function index(Request $request)
    {
        $query = DeliveryPartner::query();

        // Search
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Filter by verification status
        if ($request->has('verification_status') && !empty($request->verification_status)) {
            $query->where('verification_status', $request->verification_status);
        }

        $partners = $query->orderBy('created_at', 'desc')->paginate(15);

        $stats = [
            'total' => DeliveryPartner::count(),
            'active' => DeliveryPartner::where('status', 'active')->count(),
            'pending_verification' => DeliveryPartner::where('verification_status', 'pending')->count(),
            'online' => DeliveryPartner::where('is_online', true)->count(),
        ];

        return view('admin.delivery-partners.index', compact('partners', 'stats'));
    }

    /**
     * Show the form for creating a new delivery partner.
     */
    public function create()
    {
        return view('admin.delivery-partners.create');
    }

    /**
     * Store a newly created delivery partner.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:delivery_partners',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:20',
            'vehicle_type' => 'required|string|in:bike,scooter,car',
            'vehicle_number' => 'required|string|max:20',
            'license_number' => 'required|string|max:50',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|max:20', // Changed from postal_code to pincode
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'vehicle_type' => $request->vehicle_type,
            'vehicle_number' => $request->vehicle_number,
            'license_number' => $request->license_number,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'status' => 'active',
            'verification_status' => 'verified',
            'is_online' => false,
            'total_deliveries' => 0,
            'total_earnings' => 0,
            'rating' => 0,
            'total_ratings' => 0,
        ];

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('delivery-partners/avatars', 'public');
            $data['avatar'] = $path;
        }

        $partner = DeliveryPartner::create($data);

        return redirect()->route('admin.delivery-partners.show', $partner)
            ->with('success', 'Delivery partner created successfully.');
    }

    /**
     * Display the specified delivery partner.
     */
    public function show(DeliveryPartner $deliveryPartner)
    {
        $deliveryPartner->load(['pickups' => function($query) {
            $query->with('order.user')->latest()->limit(10);
        }, 'payouts' => function($query) {
            $query->latest()->limit(10);
        }]);

        $stats = [
            'total_deliveries' => $deliveryPartner->total_deliveries,
            'total_earnings' => $deliveryPartner->total_earnings,
            'rating' => $deliveryPartner->rating,
            'total_ratings' => $deliveryPartner->total_ratings,
            'active_deliveries' => $deliveryPartner->activePickups()->count(),
            'completed_this_month' => $deliveryPartner->pickups()
                ->where('status', 'delivered')
                ->whereMonth('delivered_at', now()->month)
                ->count(),
            'pending_payouts' => $deliveryPartner->payouts()
                ->where('status', 'pending')
                ->sum('amount'),
        ];

        return view('admin.delivery-partners.show', compact('deliveryPartner', 'stats'));
    }

    /**
     * Show the form for editing the specified delivery partner.
     */
    public function edit(DeliveryPartner $deliveryPartner)
    {
        return view('admin.delivery-partners.edit', compact('deliveryPartner'));
    }

    /**
     * Update the specified delivery partner.
     */
    public function update(Request $request, DeliveryPartner $deliveryPartner)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:delivery_partners,email,' . $deliveryPartner->id,
            'phone' => 'required|string|max:20',
            'status' => 'required|in:active,inactive,suspended',
            'verification_status' => 'required|in:pending,verified,rejected',
            'vehicle_type' => 'required|string|in:bike,scooter,car',
            'vehicle_number' => 'required|string|max:20',
            'license_number' => 'required|string|max:50',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        // Only validate password if it's provided
        if ($request->filled('password')) {
            $rules['password'] = 'string|min:8';
        }

        $request->validate($rules);

        $data = $request->except(['password', 'avatar']);

        // Handle password update
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($deliveryPartner->avatar) {
                Storage::disk('public')->delete($deliveryPartner->avatar);
            }
            
            $path = $request->file('avatar')->store('delivery-partners/avatars', 'public');
            $data['avatar'] = $path;
        }

        $deliveryPartner->update($data);

        return redirect()->route('admin.delivery-partners.show', $deliveryPartner)
            ->with('success', 'Delivery partner updated successfully.');
    }

    /**
     * Remove the specified delivery partner.
     */
    public function destroy(DeliveryPartner $deliveryPartner)
    {
        if ($deliveryPartner->pickups()->exists()) {
            return back()->with('error', 'Cannot delete partner with delivery history.');
        }

        // Delete avatar if exists
        if ($deliveryPartner->avatar) {
            Storage::disk('public')->delete($deliveryPartner->avatar);
        }

        $deliveryPartner->delete();

        return redirect()->route('admin.delivery-partners.index')
            ->with('success', 'Delivery partner deleted successfully.');
    }

    /**
     * Verify delivery partner.
     */
    public function verify(DeliveryPartner $deliveryPartner)
    {
        $deliveryPartner->update([
            'verification_status' => 'verified',
            'status' => 'active',
        ]);

        return back()->with('success', 'Partner verified successfully.');
    }

    /**
     * Reject delivery partner.
     */
    public function reject(Request $request, DeliveryPartner $deliveryPartner)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $deliveryPartner->update([
            'verification_status' => 'rejected',
            'status' => 'inactive',
        ]);

        // You might want to send an email with the rejection reason
        // $deliveryPartner->notify(new VerificationRejected($request->rejection_reason));

        return back()->with('success', 'Partner verification rejected.');
    }

    /**
     * View payouts.
     */
    public function payouts(Request $request)
    {
        $query = DeliveryPartnerPayout::with('deliveryPartner');

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Search by reference
        if ($request->has('search') && !empty($request->search)) {
            $query->where('payout_reference', 'like', '%' . $request->search . '%');
        }

        $payouts = $query->latest()->paginate(15);

        $stats = [
            'pending' => DeliveryPartnerPayout::where('status', 'pending')->sum('amount'),
            'processing' => DeliveryPartnerPayout::where('status', 'processing')->sum('amount'),
            'completed' => DeliveryPartnerPayout::where('status', 'completed')->sum('amount'),
            'failed' => DeliveryPartnerPayout::where('status', 'failed')->sum('amount'),
            'cancelled' => DeliveryPartnerPayout::where('status', 'cancelled')->sum('amount'),
            'total' => DeliveryPartnerPayout::sum('amount'),
        ];

        return view('admin.delivery-partners.payouts', compact('payouts', 'stats'));
    }

    /**
     * Update payout status.
     */
    public function updatePayoutStatus(Request $request, DeliveryPartnerPayout $payout)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,failed,cancelled',
            'notes' => 'nullable|string|max:500',
        ]);

        $oldStatus = $payout->status;
        
        $payout->update([
            'status' => $request->status,
            'notes' => $request->notes,
            'processed_at' => in_array($request->status, ['completed', 'failed']) ? now() : $payout->processed_at,
        ]);

        // If payout is completed, update partner's available balance
        if ($request->status === 'completed' && $oldStatus !== 'completed') {
            // You can implement logic to update available balance
            // $payout->deliveryPartner->decrement('available_balance', $payout->amount);
        }

        return back()->with('success', 'Payout status updated successfully.');
    }

    /**
     * Bulk action on partners.
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:activate,deactivate,verify,delete',
            'ids' => 'required|array',
            'ids.*' => 'exists:delivery_partners,id'
        ]);

        $partners = DeliveryPartner::whereIn('id', $request->ids);

        switch ($request->action) {
            case 'activate':
                $partners->update(['status' => 'active']);
                $message = 'Selected partners activated successfully.';
                break;
                
            case 'deactivate':
                $partners->update(['status' => 'inactive']);
                $message = 'Selected partners deactivated successfully.';
                break;
                
            case 'verify':
                $partners->update([
                    'verification_status' => 'verified',
                    'status' => 'active'
                ]);
                $message = 'Selected partners verified successfully.';
                break;
                
            case 'delete':
                $deletedCount = 0;
                foreach ($partners->get() as $partner) {
                    if ($partner->total_deliveries == 0) {
                        // Delete avatar if exists
                        if ($partner->avatar) {
                            Storage::disk('public')->delete($partner->avatar);
                        }
                        $partner->delete();
                        $deletedCount++;
                    }
                }
                $message = $deletedCount . ' partners (with no deliveries) deleted successfully.';
                break;
        }

        return back()->with('success', $message);
    }

    /**
     * Get statistics for AJAX.
     */
    public function getStatistics()
    {
        $stats = [
            'total' => DeliveryPartner::count(),
            'active' => DeliveryPartner::where('status', 'active')->count(),
            'online' => DeliveryPartner::where('is_online', true)->count(),
            'pending_verification' => DeliveryPartner::where('verification_status', 'pending')->count(),
            'total_deliveries' => DeliveryPartner::sum('total_deliveries'),
            'total_earnings' => DeliveryPartner::sum('total_earnings'),
        ];

        return response()->json($stats);
    }

    /**
     * Remove avatar.
     */
    public function removeAvatar(DeliveryPartner $deliveryPartner)
    {
        if ($deliveryPartner->avatar) {
            Storage::disk('public')->delete($deliveryPartner->avatar);
            $deliveryPartner->update(['avatar' => null]);
            
            return back()->with('success', 'Avatar removed successfully.');
        }

        return back()->with('error', 'No avatar found.');
    }
}