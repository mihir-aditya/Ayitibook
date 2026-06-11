<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /* =========================
       Show Admin Login Page
    ========================== */
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    /* =========================
       Admin Login
    ========================== */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard')
                ->with('success', 'Welcome Admin 👑');
        }

        return back()->withErrors([
            'email' => 'Invalid admin credentials',
        ])->withInput();
    }

    /* =========================
       Admin Dashboard
    ========================== */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /* =========================
       Admin Logout
    ========================== */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Logged out successfully');
    }
}
