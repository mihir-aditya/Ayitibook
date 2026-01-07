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
        return view('seller.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:sellers,email',
            'password' => 'required|min:6|confirmed',
            'shop_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'shop_address' => 'required|string',
        ]);

        Seller::create([
            'name' => $validated['name'],
            'username' => Str::slug($validated['name']) . rand(100,999),
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'shop_name' => $validated['shop_name'],
            'shop_slug' => Str::slug($validated['shop_name']),
            'shop_address' => $validated['shop_address'],
            'password' => Hash::make($validated['password']),
            'status' => 'approved',
            'is_verified' => false,
        ]);

        return redirect()
            ->route('seller.login')
            ->with('status', 'Seller account created successfully. Please login.');
    }
}
