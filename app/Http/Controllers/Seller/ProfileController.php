<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $seller = Auth::guard('seller')->user();
        $seller->loadCount('products');
        return view('seller.profile', compact('seller'));
    }

    public function update(Request $request)
    {
        $seller = Auth::guard('seller')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:sellers,email,' . $seller->id,
            'phone' => 'required|string|max:15',
            'gst_number' => 'nullable|string|max:20',
            'pan_number' => 'nullable|string|max:20',
            'shop_name' => 'nullable|string|max:255',
            'shop_address' => 'nullable|string|max:500',

            // Password rules
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|min:8|confirmed',
        ]);

        /* ---------------- Update Profile ---------------- */
        $seller->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gst_number' => $request->gst_number,
            'pan_number' => $request->pan_number,
            'shop_name' => $request->shop_name,
            'shop_address' => $request->shop_address,
        ]);

        /* ---------------- Update Password ---------------- */
        if ($request->filled('password')) {

            if (!Hash::check($request->current_password, $seller->password)) {
                return back()
                    ->withErrors(['current_password' => 'Current password is incorrect'])
                    ->withInput();
            }

            $seller->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return back()->with('success', 'Profile updated successfully!');
    }
}
