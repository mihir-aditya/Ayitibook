<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:seller');
    }

    /* =====================================================
     | Show / Edit Profile Page
     ===================================================== */
    public function edit()
    {
        $seller = Auth::guard('seller')->user();
        $seller->loadCount('products');

        return view('seller.profile.profile', compact('seller'));
    }

    /* =====================================================
     | Update Profile
     ===================================================== */
    public function update(Request $request)
    {
        $seller = Auth::guard('seller')->user();

        /* ── Validation ── */
        $request->validate([
            // Personal
            'name'                 => ['required', 'string', 'max:255'],
            'email'                => ['required', 'email', 'max:255', Rule::unique('sellers', 'email')->ignore($seller->id)],
            'phone'                => ['required', 'string', 'max:15'],
            'gst_number'           => ['nullable', 'string', 'max:20'],
            'pan_number'           => ['nullable', 'string', 'max:20'],

            // Shop
            'shop_name'            => ['nullable', 'string', 'max:255'],
            'shop_address'         => ['nullable', 'string', 'max:500'],
            'municipality'         => ['nullable', 'string', 'max:255'],

            // Operations
            'product_categories'   => ['nullable', 'array'],
            'product_categories.*' => ['string', 'max:100'],
            'serial_number_type'   => ['nullable', Rule::in(['has_sn', 'has_lot', 'auto_generate'])],
            'accepts_cod'          => ['nullable', 'boolean'],
            'payment_method'       => ['nullable', Rule::in(['bank', 'wallet'])],

            // Password
            'current_password'     => ['nullable', 'required_with:password', 'string'],
            'password'             => ['nullable', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required'          => 'Your full name is required.',
            'email.required'         => 'Email address is required.',
            'email.unique'           => 'This email is already in use by another account.',
            'phone.required'         => 'Phone number is required.',
            'current_password.required_with' => 'Please enter your current password to set a new one.',
            'password.min'           => 'New password must be at least 8 characters.',
            'password.confirmed'     => 'New password and confirmation do not match.',
        ]);

        /* ── Build Update Payload ── */
        $updateData = [
            'name'               => $request->name,
            'email'              => $request->email,
            'phone'              => $request->phone,
            'gst_number'         => $request->gst_number,
            'pan_number'         => $request->pan_number,
            'shop_name'          => $request->shop_name,
            'shop_address'       => $request->shop_address,
            'municipality'       => $request->municipality,
            'product_categories' => $request->product_categories ?? [],
            'serial_number_type' => $request->serial_number_type,
            'accepts_cod'        => $request->boolean('accepts_cod'),
            'payment_method'     => $request->payment_method,
        ];

        $seller->update($updateData);

        /* ── Handle Password Change ── */
        if ($request->filled('password')) {

            if (! Hash::check($request->current_password, $seller->password)) {
                return back()
                    ->withErrors(['current_password' => 'The current password you entered is incorrect.'])
                    ->withInput()
                    ->with('_active_tab', 'security');
            }

            $seller->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return back()->with('success', 'Your profile has been updated successfully!');
    }
}