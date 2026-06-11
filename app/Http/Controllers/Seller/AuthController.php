<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('seller.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::guard('seller')->attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Invalid seller email or password.',
            ]);
        }

        $seller = Auth::guard('seller')->user();

        // Not yet approved by admin
        if (! $seller->isApproved()) {
            Auth::guard('seller')->logout();

            return back()->withErrors([
                'email' => 'Your seller account is pending admin approval. We will notify you by email once approved.',
            ]);
        }

        // Approved but email/phone not verified
        if (! $seller->is_verified) {
            Auth::guard('seller')->logout();

            return back()->withErrors([
                'email' => 'Your account has not been verified yet. Please check your email for a verification link.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('seller.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('seller')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('seller.login');
    }
}