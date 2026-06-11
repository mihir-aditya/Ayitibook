<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    /* ══════════════════════════════════════════
       INDEX – list all admins
    ══════════════════════════════════════════ */
    public function index(Request $request)
    {
        $query = Admin::query();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('name',     'like', "%{$s}%")
                  ->orWhere('email',    'like', "%{$s}%")
                  ->orWhere('username', 'like', "%{$s}%");
            });
        }

        if ($request->filled('role') && $request->role !== 'all') {
            $query->where('role', $request->role);
        }

        // status is stored as tinyint: 1 = active, 0 = inactive
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', (int) $request->status);
        }

        $admins = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();

        $stats = [
            'total'   => Admin::count(),
            'admin'   => Admin::where('role', 'admin')->count(),
            'manager' => Admin::where('role', 'manager')->count(),
            'support' => Admin::where('role', 'support')->count(),
            'active'  => Admin::where('status', 1)->count(),
        ];

        return view('admin.admins.index', compact('admins', 'stats'));
    }

    /* ══════════════════════════════════════════
       CREATE FORM
    ══════════════════════════════════════════ */
    public function create()
    {
        return view('admin.admins.create');
    }

    /* ══════════════════════════════════════════
       STORE
    ══════════════════════════════════════════ */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:admins,username|alpha_dash',
            'email'    => 'required|email|unique:admins,email',
            'phone'    => 'nullable|string|max:20',
            'role'     => 'required|in:admin,manager,support',
            'status'   => 'required|in:0,1',
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
        ]);

        Admin::create([
            'name'        => $request->name,
            'username'    => $request->username,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'role'        => $request->role,
            'status'      => (int) $request->status,   // 1 or 0
            'password'    => Hash::make($request->password),
            'super_admin' => $request->role === 'admin',
        ]);

        return redirect()->route('admin.admins.index')
            ->with('success', "Admin '{$request->name}' created successfully.");
    }

    /* ══════════════════════════════════════════
       EDIT FORM
    ══════════════════════════════════════════ */
    public function edit(Admin $admin)
    {
        return view('admin.admins.edit', compact('admin'));
    }

    /* ══════════════════════════════════════════
       UPDATE
    ══════════════════════════════════════════ */
    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'username' => ['required','string','max:50','alpha_dash', Rule::unique('admins','username')->ignore($admin->id)],
            'email'    => ['required','email', Rule::unique('admins','email')->ignore($admin->id)],
            'phone'    => 'nullable|string|max:20',
            'role'     => 'required|in:admin,manager,support',
            'status'   => 'required|in:0,1',
        ]);

        if ($admin->id === auth('admin')->id() && $request->role !== 'admin') {
            return back()->with('error', 'You cannot change your own role away from Admin.');
        }

        $admin->update([
            'name'        => $request->name,
            'username'    => $request->username,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'role'        => $request->role,
            'status'      => (int) $request->status,   // 1 or 0
            'super_admin' => $request->role === 'admin',
        ]);

        return redirect()->route('admin.admins.index')
            ->with('success', "Admin '{$admin->name}' updated successfully.");
    }

    /* ══════════════════════════════════════════
       RESET PASSWORD
    ══════════════════════════════════════════ */
    public function resetPassword(Request $request, Admin $admin)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
        ]);

        $admin->update(['password' => Hash::make($request->password)]);

        return back()->with('success', "Password for '{$admin->name}' has been reset.");
    }

    /* ══════════════════════════════════════════
       TOGGLE STATUS
    ══════════════════════════════════════════ */
    public function toggleStatus(Admin $admin)
    {
        if ($admin->id === auth('admin')->id()) {
            return back()->with('error', 'You cannot deactivate your own account.');
        }

        $newStatus = $admin->status ? 0 : 1;
        $admin->update(['status' => $newStatus]);

        $label = $newStatus ? 'active' : 'inactive';
        return back()->with('success', "Admin '{$admin->name}' is now {$label}.");
    }

    /* ══════════════════════════════════════════
       DESTROY
    ══════════════════════════════════════════ */
    public function destroy(Admin $admin)
    {
        if ($admin->id === auth('admin')->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $name = $admin->name;
        $admin->delete();

        return back()->with('success', "Admin '{$name}' has been deleted.");
    }
}