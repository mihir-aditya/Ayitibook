<?php
// app/Http/Controllers/DeliveryPartner/AuthController.php

namespace App\Http\Controllers\DeliveryPartner;

use App\Http\Controllers\Controller;
use App\Models\DeliveryPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Show login form.
     */
    public function showLoginForm()
    {
        return view('delivery-partner.auth.login');
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        
        if (Auth::guard('delivery_partner')->attempt($credentials)) {
            $partner = Auth::guard('delivery_partner')->user();
            
            if ($partner->status !== 'active') {
                Auth::guard('delivery_partner')->logout();
                return back()->with('error', 'Your account is not active. Please contact admin.');
            }
            
            return redirect()->intended(route('delivery-partner.dashboard'));
        }

        return back()->with('error', 'Invalid credentials.');
    }

    /**
     * Show registration form.
     */
    public function showRegisterForm()
    {
        return view('delivery-partner.auth.register');
    }

    /**
     * Handle registration request.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:delivery_partners',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:20',
            'vehicle_type' => 'required|string|in:bicycle,motorcycle,scooter,car,van,truck',
            'vehicle_number' => 'required|string|max:20',
            'license_number' => 'required|string|max:50',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $partner = DeliveryPartner::create([
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
            'postal_code' => $request->postal_code,
            'status' => 'inactive',
            'verification_status' => 'pending',
            'is_online' => false,
            'total_deliveries' => 0,
            'total_earnings' => 0,
            'rating' => 0,
            'total_ratings' => 0,
        ]);

        return redirect()->route('delivery-partner.login')
            ->with('success', 'Registration successful! Please wait for admin approval.');
    }

    /**
     * Handle logout.
     */
    public function logout()
    {
        $partner = Auth::guard('delivery_partner')->user();
        
        // Set offline on logout
        if ($partner) {
            $partner->update(['is_online' => false]);
        }
        
        Auth::guard('delivery_partner')->logout();
        return redirect()->route('delivery-partner.login');
    }
}