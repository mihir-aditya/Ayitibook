<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\RefundRequest;
use App\Models\TransactionDetail;
use App\Models\WalletTransaction;
class UserController extends Controller
{
    /* =========================
       Show Users List
    ========================== */
    public function index(Request $request)
    {
        $query = User::query();
        
        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }
        
        // Filter by status
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }
        
        // Filter by verification
        if ($request->has('email_verified') && $request->email_verified != 'all') {
            $query->where('email_verified_at', $request->email_verified == 'verified' ? '!=' : '=', null);
        }
        
        // Filter by date range
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);
        
        $users = $query->paginate(15)->withQueryString();
        
        // Statistics
        $stats = [
            'total' => User::count(),
            'active' => User::where('status', 1)->count(),
            'inactive' => User::where('status', 0)->count(),
            'verified' => User::whereNotNull('email_verified_at')->count(),
            'unverified' => User::whereNull('email_verified_at')->count(),
            'today' => User::whereDate('created_at', today())->count(),
            'week' => User::where('created_at', '>=', now()->subWeek())->count(),
            'month' => User::where('created_at', '>=', now()->subMonth())->count(),
        ];
        
        return view('admin.users.index', compact('users', 'stats'));
    }

    /* =========================
       Show Create User Form
    ========================== */
    public function create()
    {
        return view('admin.users.create');
    }

    /* =========================
       Store New User
    ========================== */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string|max:20|unique:users',
            'password' => 'required|min:8|confirmed',
            'status' => 'required|in:0,1',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'zip_code' => 'nullable|string',
            'country' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'status' => $request->status,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'country' => $request->country,
            'email_verified_at' => $request->has('verify_email') ? now() : null,
        ]);

        // Log activity
        $this->logActivity("Created user: {$user->email}");

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully');
    }

    /* =========================
       Show User Details
    ========================== */
    public function show(User $user)
{
    // ── Order stats ──────────────────────────────────────
    $ordersStats = DB::table('orders')
        ->where('user_id', $user->id)
        ->selectRaw('COUNT(*) as total_orders')
        ->selectRaw('SUM(CASE WHEN order_status = "completed" THEN total_amount ELSE 0 END) as total_spent')
        ->selectRaw('SUM(CASE WHEN order_status = "pending"   THEN 1 ELSE 0 END) as pending_orders')
        ->selectRaw('SUM(CASE WHEN order_status = "cancelled" THEN 1 ELSE 0 END) as cancelled_orders')
        ->first();
 
    // ── All orders with items + product + variant ────────
    $orders = $user->orders()
        ->with([
            'items.product',
            'items.variant',
            'address',
        ])
        ->orderBy('placed_at', 'desc')
        ->get();
 
    // ── Refund requests ───────────────────────────────────
    $refundRequests = \App\Models\RefundRequest::where('user_id', $user->id)
        ->with(['orderItem.product', 'orderItem.variant'])
        ->orderBy('requested_at', 'desc')
        ->get();
 
    // ── Transaction details (payment history) ────────────
    $transactions = \App\Models\TransactionDetail::where('user_id', $user->id)
        ->orderBy('transaction_date', 'desc')
        ->get();
 
    // ── Wallet transactions ───────────────────────────────
    $walletTransactions = \App\Models\WalletTransaction::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->get();
 
    // ── Wallet summary ────────────────────────────────────
    $walletStats = [
        'balance'   => $user->wallet_balance ?? 0,
        'total_in'  => $walletTransactions->where('transaction_type', 'credit')->sum('amount'),
        'total_out' => $walletTransactions->where('transaction_type', 'debit')->sum('amount'),
    ];
 
    return view('admin.users.show', compact(
        'user',
        'ordersStats',
        'orders',
        'refundRequests',
        'transactions',
        'walletTransactions',
        'walletStats',
    ));
}

    /* =========================
       Show Edit User Form
    ========================== */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /* =========================
       Update User
    ========================== */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)
            ],
            'phone' => [
                'nullable',
                'string',
                'max:20',
                Rule::unique('users')->ignore($user->id)
            ],
            'status' => 'required|in:0,1',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'zip_code' => 'nullable|string',
            'country' => 'nullable|string',
        ]);

        $oldData = $user->toArray();
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'country' => $request->country,
        ]);

        // Verify email if checkbox is checked
        if ($request->has('verify_email') && !$user->email_verified_at) {
            $user->email_verified_at = now();
            $user->save();
        }

        // Log activity
        $this->logActivity("Updated user: {$user->email}");

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully');
    }

    /* =========================
       Update User Password
    ========================== */
    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Log activity
        $this->logActivity("Updated password for user: {$user->email}");

        return back()->with('success', 'Password updated successfully');
    }

    /* =========================
       Delete User
    ========================== */
    public function destroy(User $user)
    {
        // Check if user has orders before deleting
        if ($user->orders()->count() > 0) {
            return back()->with('error', 'Cannot delete user with existing orders');
        }

        $email = $user->email;
        $user->delete();

        // Log activity
        $this->logActivity("Deleted user: {$email}");

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully');
    }

    /* =========================
       Bulk Actions
    ========================== */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:activate,deactivate,delete',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id'
        ]);

        $action = $request->action;
        $userIds = $request->user_ids;
        $count = 0;

        switch ($action) {
            case 'activate':
                User::whereIn('id', $userIds)->update(['status' => 1]);
                $count = count($userIds);
                break;
                
            case 'deactivate':
                User::whereIn('id', $userIds)->update(['status' => 0]);
                $count = count($userIds);
                break;
                
            case 'delete':
                // Check if any users have orders
                $usersWithOrders = User::whereIn('id', $userIds)
                    ->whereHas('orders')
                    ->count();
                    
                if ($usersWithOrders > 0) {
                    return back()->with('error', 'Cannot delete users with existing orders');
                }
                
                User::whereIn('id', $userIds)->delete();
                $count = count($userIds);
                break;
        }

        // Log activity
        $this->logActivity("Bulk action '{$action}' on {$count} users");

        return back()->with('success', "{$count} users {$action}d successfully");
    }

    /* =========================
       Export Users
    ========================== */
    public function export(Request $request)
    {
        $type = $request->get('type', 'csv');
        $users = User::all();
        
        if ($type == 'csv') {
            return $this->exportToCsv($users);
        }
        
        return back()->with('error', 'Invalid export type');
    }

    /* =========================
       Export to CSV
    ========================== */
    private function exportToCsv($users)
    {
        $fileName = 'users-' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $columns = ['ID', 'Name', 'Email', 'Phone', 'Status', 'Email Verified', 'Created At'];

        $callback = function() use ($users, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($users as $user) {
                fputcsv($file, [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->phone,
                    $user->status ? 'Active' : 'Inactive',
                    $user->email_verified_at ? 'Yes' : 'No',
                    $user->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /* =========================
       Get User Statistics
    ========================== */
    public function getStatistics()
    {
        $stats = [
            'total_users' => User::count(),
            'active_users' => User::where('status', 1)->count(),
            'new_today' => User::whereDate('created_at', today())->count(),
            'new_week' => User::where('created_at', '>=', now()->subWeek())->count(),
            'verified_users' => User::whereNotNull('email_verified_at')->count(),
        ];

        // Monthly registration data for chart
        $monthlyRegistrations = User::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subYear())
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return response()->json([
            'success' => true,
            'stats' => $stats,
            'monthly_data' => $monthlyRegistrations
        ]);
    }

    /* =========================
       Activity Logger
    ========================== */
    private function logActivity($action)
    {
        // Check if table exists before logging
        if (\Illuminate\Support\Facades\Schema::hasTable('activity_logs')) {
            DB::table('activity_logs')->insert([
                'admin_id' => auth()->guard('admin')->id(),
                'action' => $action,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}