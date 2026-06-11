<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function show()
    {
        return view('seller.auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Step 1 – Identity
            'name'                          => 'required|string|max:255',
            'national_id'                   => 'required|string|max:50|unique:sellers,national_id',

            // Step 2 – Contact & Auth
            'phone'                         => 'required|string|max:20',
            'email'                         => 'required|email|unique:sellers,email',
            'password'                      => 'required|min:6|confirmed',

            // Step 3 – Business
            'shop_name'                     => 'required|string|max:255',
            'shop_address'                  => 'required|string',
            'municipality'                  => 'required|string|max:255',

            // Step 4 – Products
            'product_categories'            => 'required|array|min:1',
            'product_categories.*'          => 'string|max:100',
            'serial_number_type'            => 'required|in:has_sn,has_lot,auto_generate',
            'accepts_cod'                   => 'required|boolean',

            // Step 5 – Obligations (all must be accepted)
            'agreed_video_before_shipping'  => 'accepted',
            'agreed_qr_otp_validation'      => 'accepted',
            'agreed_returns_48hrs'          => 'accepted',
            'agreed_insurance_fund'         => 'accepted',
            'agreed_rating_penalty'         => 'accepted',

            // Step 6 – Payment & Terms
            'payment_method'                => 'required|in:bank,wallet',
            'agreed_to_terms'               => 'accepted',
        ], [
            'agreed_video_before_shipping.accepted' => 'You must agree to record product videos before shipping.',
            'agreed_qr_otp_validation.accepted'     => 'You must agree to use QR/OTP validation.',
            'agreed_returns_48hrs.accepted'          => 'You must agree to respond to returns within 48 hours.',
            'agreed_insurance_fund.accepted'         => 'You must agree to contribute to the insurance fund.',
            'agreed_rating_penalty.accepted'         => 'You must agree to the rating & penalty rules.',
            'agreed_to_terms.accepted'               => 'You must accept the Terms & Conditions to register.',
        ]);

        Seller::create([
            'name'                          => $validated['name'],
            'username'                      => Str::slug($validated['name']) . rand(100, 999),
            'email'                         => $validated['email'],
            'national_id'                   => $validated['national_id'],
            'phone'                         => $validated['phone'],
            'shop_name'                     => $validated['shop_name'],
            'shop_slug'                     => Str::slug($validated['shop_name']),
            'shop_address'                  => $validated['shop_address'],
            'municipality'                  => $validated['municipality'],
            'product_categories'            => $validated['product_categories'],
            'serial_number_type'            => $validated['serial_number_type'],
            'accepts_cod'                   => (bool) $validated['accepts_cod'],
            'payment_method'                => $validated['payment_method'],
            'agreed_video_before_shipping'  => true,
            'agreed_qr_otp_validation'      => true,
            'agreed_returns_48hrs'          => true,
            'agreed_insurance_fund'         => true,
            'agreed_rating_penalty'         => true,
            'agreed_to_terms'               => true,
            'password'                      => Hash::make($validated['password']),
            'status'                        => Seller::STATUS_PENDING, // pending admin approval
            'is_verified'                   => false,
        ]);

        return redirect()
            ->route('seller.login')
            ->with('status', 'Registration submitted! Your account is pending approval. We will notify you by email.');
    }
}