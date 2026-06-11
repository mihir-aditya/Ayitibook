<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SellerController extends Controller
{
    /* =========================
       Show Sellers List
    ========================== */
    public function index(Request $request)
    {
        $query = Seller::query();
        
        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('shop_name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }
        
        // Filter by status
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }
        
        // Filter by verification
        if ($request->has('is_verified') && $request->is_verified != 'all') {
            $query->where('is_verified', $request->is_verified == 'verified' ? 1 : 0);
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
        
        $sellers = $query->paginate(15)->withQueryString();
        
        // Statistics based on actual status values
        $stats = [
            'total' => Seller::count(),
            'pending' => Seller::where('status', 'pending')->count(),
            'approved' => Seller::where('status', 'approved')->count(),
            'rejected' => Seller::where('status', 'rejected')->count(),
            'verified' => Seller::where('is_verified', 1)->count(),
            'unverified' => Seller::where('is_verified', 0)->count(),
            'today' => Seller::whereDate('created_at', today())->count(),
            'week' => Seller::where('created_at', '>=', now()->subWeek())->count(),
            'month' => Seller::where('created_at', '>=', now()->subMonth())->count(),
        ];
        
        return view('admin.sellers.index', compact('sellers', 'stats'));
    }

    /* =========================
       Show Create Seller Form
    ========================== */
    public function create()
    {
        return view('admin.sellers.create');
    }

    /* =========================
       Store New Seller
    ========================== */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:sellers',
            'email' => 'required|email|unique:sellers',
            'shop_name' => 'required|string|max:255',
            'shop_slug' => 'required|string|max:255|unique:sellers',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|min:8|confirmed',
            'gst_number' => 'nullable|string|max:50',
            'pan_number' => 'nullable|string|max:50',
            'shop_address' => 'nullable|string',
            'status' => 'required|in:pending,approved,rejected',
            'is_verified' => 'nullable|in:0,1',
        ]);

        $seller = Seller::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'shop_name' => $request->shop_name,
            'shop_slug' => $request->shop_slug,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'gst_number' => $request->gst_number,
            'pan_number' => $request->pan_number,
            'shop_address' => $request->shop_address,
            'status' => $request->status,
            'is_verified' => $request->is_verified ?? 0,
        ]);

        // Log activity
        $this->logActivity("Created seller: {$seller->shop_name}");

        return redirect()->route('admin.sellers.index')
            ->with('success', 'Seller created successfully');
    }

    /* =========================
       Show Seller Details
    ========================== */
    public function show(Seller $seller)
    {
        // Get seller statistics
        $stats = $this->getSellerStats($seller);
        
        // Get recent products
        $recentProducts = $seller->products()
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Get recent orders (from seller's products)
        $recentOrders = Order::whereHas('items.product', function($query) use ($seller) {
                $query->where('seller_id', $seller->id);
            })
            ->orderBy('placed_at', 'desc')
            ->take(5)
            ->get();
        
        return view('admin.sellers.show', compact('seller', 'stats', 'recentProducts', 'recentOrders'));
    }

    /* =========================
       Show Edit Seller Form
    ========================== */
    public function edit(Seller $seller)
    {
        return view('admin.sellers.edit', compact('seller'));
    }

    /* =========================
       Update Seller
    ========================== */
    public function update(Request $request, Seller $seller)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sellers')->ignore($seller->id)
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('sellers')->ignore($seller->id)
            ],
            'shop_name' => 'required|string|max:255',
            'shop_slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sellers')->ignore($seller->id)
            ],
            'phone' => 'nullable|string|max:20',
            'gst_number' => 'nullable|string|max:50',
            'pan_number' => 'nullable|string|max:50',
            'shop_address' => 'nullable|string',
            'status' => 'required|in:pending,approved,rejected',
            'is_verified' => 'nullable|in:0,1',
        ]);

        $seller->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'shop_name' => $request->shop_name,
            'shop_slug' => $request->shop_slug,
            'phone' => $request->phone,
            'gst_number' => $request->gst_number,
            'pan_number' => $request->pan_number,
            'shop_address' => $request->shop_address,
            'status' => $request->status,
            'is_verified' => $request->is_verified ?? $seller->is_verified,
        ]);

        // Log activity
        $this->logActivity("Updated seller: {$seller->shop_name}");

        return redirect()->route('admin.sellers.index')
            ->with('success', 'Seller updated successfully');
    }

    /* =========================
       Update Seller Password
    ========================== */
    public function updatePassword(Request $request, Seller $seller)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $seller->update([
            'password' => Hash::make($request->password),
        ]);

        // Log activity
        $this->logActivity("Updated password for seller: {$seller->shop_name}");

        return back()->with('success', 'Password updated successfully');
    }

    /* =========================
       Delete Seller
    ========================== */
    public function destroy(Seller $seller)
    {
        // Check if seller has products before deleting
        if ($seller->products()->count() > 0) {
            return back()->with('error', 'Cannot delete seller with existing products');
        }

        $shopName = $seller->shop_name;
        $seller->delete();

        // Log activity
        $this->logActivity("Deleted seller: {$shopName}");

        return redirect()->route('admin.sellers.index')
            ->with('success', 'Seller deleted successfully');
    }

    /* =========================
       Bulk Actions
    ========================== */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:approve,reject,verify,unverify,delete',
            'seller_ids' => 'required|array',
            'seller_ids.*' => 'exists:sellers,id'
        ]);

        $action = $request->action;
        $sellerIds = $request->seller_ids;
        $count = 0;

        switch ($action) {
            case 'approve':
                Seller::whereIn('id', $sellerIds)->update(['status' => 'approved']);
                $count = count($sellerIds);
                break;
                
            case 'reject':
                Seller::whereIn('id', $sellerIds)->update(['status' => 'rejected']);
                $count = count($sellerIds);
                break;
                
            case 'verify':
                Seller::whereIn('id', $sellerIds)->update(['is_verified' => 1]);
                $count = count($sellerIds);
                break;
                
            case 'unverify':
                Seller::whereIn('id', $sellerIds)->update(['is_verified' => 0]);
                $count = count($sellerIds);
                break;
                
            case 'delete':
                // Check if any sellers have products
                $sellersWithProducts = Seller::whereIn('id', $sellerIds)
                    ->whereHas('products')
                    ->count();
                    
                if ($sellersWithProducts > 0) {
                    return back()->with('error', 'Cannot delete sellers with existing products');
                }
                
                Seller::whereIn('id', $sellerIds)->delete();
                $count = count($sellerIds);
                break;
        }

        // Log activity
        $this->logActivity("Bulk action '{$action}' on {$count} sellers");

        return back()->with('success', "{$count} sellers updated successfully");
    }

    /* =========================
       Export Sellers
    ========================== */
    public function export(Request $request)
    {
        $type = $request->get('type', 'csv');
        $sellers = Seller::all();
        
        if ($type == 'csv') {
            return $this->exportToCsv($sellers);
        }
        
        return back()->with('error', 'Invalid export type');
    }

    /* =========================
       Export to CSV
    ========================== */
    private function exportToCsv($sellers)
    {
        $fileName = 'sellers-' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $columns = ['ID', 'Shop Name', 'Owner Name', 'Username', 'Email', 'Phone', 'Status', 'Verified', 'GST Number', 'PAN Number', 'Products', 'Created At'];

        $callback = function() use ($sellers, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($sellers as $seller) {
                fputcsv($file, [
                    $seller->id,
                    $seller->shop_name,
                    $seller->name,
                    $seller->username,
                    $seller->email,
                    $seller->phone,
                    ucfirst($seller->status),
                    $seller->is_verified ? 'Yes' : 'No',
                    $seller->gst_number ?? 'N/A',
                    $seller->pan_number ?? 'N/A',
                    $seller->products()->count(),
                    $seller->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /* =========================
       Get Seller Statistics
    ========================== */
    private function getSellerStats(Seller $seller)
    {
        return [
            'total_products' => $seller->products()->count(),
            'active_products' => $seller->products()->where('is_active', 1)->count(),
            'total_orders' => Order::whereHas('items.product', function($query) use ($seller) {
                $query->where('seller_id', $seller->id);
            })->count(),
            'total_revenue' => Order::whereHas('items.product', function($query) use ($seller) {
                $query->where('seller_id', $seller->id);
            })->where('order_status', 'completed')->sum('total_amount') ?? 0,
            'pending_orders' => Order::whereHas('items.product', function($query) use ($seller) {
                $query->where('seller_id', $seller->id);
            })->where('order_status', 'pending')->count(),
            // 'avg_rating' => $seller->products()->avg('rating') ?? 0,
        ];
    }

    /* =========================
       Update Status
    ========================== */
    public function updateStatus(Seller $seller, $status)
    {
        if (!in_array($status, ['pending', 'approved', 'rejected'])) {
            return back()->with('error', 'Invalid status');
        }

        $seller->update(['status' => $status]);

        $action = $status == 'approved' ? 'approved' : ($status == 'rejected' ? 'rejected' : 'set to pending');
        
        // Log activity
        $this->logActivity("{$action} seller: {$seller->shop_name}");

        return back()->with('success', "Seller {$action} successfully");
    }

    /* =========================
       Toggle Verification
    ========================== */
    public function toggleVerification(Seller $seller)
    {
        $seller->update([
            'is_verified' => !$seller->is_verified
        ]);

        $status = $seller->is_verified ? 'verified' : 'unverified';
        
        // Log activity
        $this->logActivity("{$status} seller: {$seller->shop_name}");

        return back()->with('success', "Seller {$status} successfully");
    }

    /* =========================
       Get Seller Statistics for Chart
    ========================== */
    public function getStatistics()
    {
        $stats = [
            'total_sellers' => Seller::count(),
            'pending_sellers' => Seller::where('status', 'pending')->count(),
            'approved_sellers' => Seller::where('status', 'approved')->count(),
            'rejected_sellers' => Seller::where('status', 'rejected')->count(),
            'verified_sellers' => Seller::where('is_verified', 1)->count(),
            'new_today' => Seller::whereDate('created_at', today())->count(),
            'new_week' => Seller::where('created_at', '>=', now()->subWeek())->count(),
        ];

        // Monthly registration data for chart
        $monthlyRegistrations = Seller::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
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
        if (Schema::hasTable('activity_logs')) {
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