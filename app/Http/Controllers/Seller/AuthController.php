<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('seller.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // ✅ LOGIN USING SELLER GUARD
        if (Auth::guard('seller')->attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()->route('seller.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid seller email or password.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('seller')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('seller.login');
    }
}
