<!DOCTYPE html>
<html lang="en-US" dir="ltr" data-navigation-type="default" data-navbar-horizontal-shape="default">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Orders Management - Ayatibook</title>

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('seller/assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('seller/assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('seller/assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('seller/assets/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('seller/assets/img/favicons/manifest.json') }}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('seller/vendors/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('seller/assets/js/config.js') }}"></script>

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="{{ asset('seller/vendors/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/line-icons@1.0.0/css/line-icons.css">
    <link href="{{ asset('seller/assets/css/theme-rtl.min.css') }}" type="text/css" rel="stylesheet" id="style-rtl">
    <link href="{{ asset('seller/assets/css/theme.min.css') }}" type="text/css" rel="stylesheet" id="style-default">
    <link href="{{ asset('seller/assets/css/user-rtl.min.css') }}" type="text/css" rel="stylesheet" id="user-style-rtl">
    <link href="{{ asset('seller/assets/css/user.min.css') }}" type="text/css" rel="stylesheet" id="user-style-default">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
      var phoenixIsRTL = window.config.config.phoenixIsRTL;
      if (phoenixIsRTL) {
        var linkDefault = document.getElementById('style-default');
        var userLinkDefault = document.getElementById('user-style-default');
        linkDefault.setAttribute('disabled', true);
        userLinkDefault.setAttribute('disabled', true);
        document.querySelector('html').setAttribute('dir', 'rtl');
      } else {
        var linkRTL = document.getElementById('style-rtl');
        var userLinkRTL = document.getElementById('user-style-rtl');
        linkRTL.setAttribute('disabled', true);
        userLinkRTL.setAttribute('disabled', true);
      }
    </script>
  </head>

  <body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <x-Sidebar/>
       <nav class="navbar navbar-top fixed-top navbar-expand" id="navbarDefault" style="display:none;">
        <div class="collapse navbar-collapse justify-content-between">
          <div class="navbar-logo">
            <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
            <a class="navbar-brand me-1 me-sm-3" href="../../../index.html">phoenix</a>
          </div>
        </div>
      </nav>
      <div class="content">
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-dark mb-0">📦 Orders Management</h1>
            <p class="text-muted small">Manage and track all customer orders</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary" id="printBtn" onclick="printOrders()">
                <i class="fas fa-print"></i> Print
            </button>
            <button class="btn btn-outline-primary" id="exportBtn" onclick="exportOrders()">
                <i class="fas fa-download"></i> Export
            </button>
            <a href="{{ route('seller.products.index') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> New Order
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted small mb-1">Total Orders</p>
                            <h4 class="mb-0">{{ $orders->count() }}</h4>
                        </div>
                        <span class="badge bg-primary rounded-circle p-3">
                            <i class="fas fa-cube"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted small mb-1">Total Revenue</p>
                            <h4 class="mb-0">{{ 'Rs. ' . number_format($orders->sum('total_amount'), 2) }}</h4>
                        </div>
                        <span class="badge bg-success rounded-circle p-3">
                            <i class="fas fa-money-bill-wave"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted small mb-1">Average Order</p>
                            <h4 class="mb-0">{{ 'Rs. ' . number_format($orders->count() > 0 ? $orders->sum('total_amount') / $orders->count() : 0, 2) }}</h4>
                        </div>
                        <span class="badge bg-info rounded-circle p-3">
                            <i class="fas fa-chart-line"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted small mb-1">Pending Orders</p>
                            <h4 class="mb-0">{{ $orders->where('order_status', 'pending')->count() }}</h4>
                        </div>
                        <span class="badge bg-warning rounded-circle p-3">
                            <i class="fas fa-clock"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label small text-muted">Search</label>
                    <input type="text" id="searchInput" class="form-control form-control-sm" 
                        placeholder="Search order ID or customer...">
                </div>
                <div class="col-md-3">
                    <label class="form-label small text-muted">Status</label>
                    <select id="statusFilter" class="form-select form-select-sm">
                        <option value="">All Statuses</option>
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="shipped">Shipped</option>
                        <option value="delivered">Delivered</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small text-muted">Date Range</label>
                    <input type="date" id="dateFilter" class="form-control form-control-sm">
                </div>
                <div class="col-md-3">
                    <label class="form-label small text-muted">Sort By</label>
                    <select id="sortFilter" class="form-select form-select-sm">
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="highest">Highest Amount</option>
                        <option value="lowest">Lowest Amount</option>
                    </select>
                </div>
            </div>
            <div class="mt-3">
                <button class="btn btn-sm btn-primary" onclick="applyFilters()">Apply Filters</button>
                <button class="btn btn-sm btn-outline-secondary" onclick="resetFilters()">Reset</button>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Order ID</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr class="order-row" data-order-id="{{ $order->order_id }}" 
                        data-status="{{ $order->order_status }}" 
                        data-amount="{{ $order->total_amount }}"
                        data-date="{{ $order->placed_at }}">
                        <td class="ps-4">
                            <span class="fw-bold text-primary">{{ $order->order_id }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm bg-light rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                    <i class="fas fa-user text-primary"></i>
                                </div>
                                <div>
                                    <p class="mb-0 small fw-500">{{ $order->user->name ?? 'N/A' }}</p>
                                    <p class="mb-0 small text-muted">{{ $order->user->email ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="fw-bold">Rs. {{ number_format($order->total_amount, 2) }}</span>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark">{{ ucfirst($order->payment_method ?? 'Unknown') }}</span>
                        </td>
                        <td>
                            @php
                            $statusConfig = [
                                'placed' => ['icon' => '📝', 'class' => 'badge-secondary', 'label' => 'Placed'],
                                'confirmed' => ['icon' => '✔️', 'class' => 'badge-info', 'label' => 'Confirmed'],
                                'shipped' => ['icon' => '📦', 'class' => 'badge-primary', 'label' => 'Shipped'],
                                'delivered' => ['icon' => '✅', 'class' => 'badge-success', 'label' => 'Delivered'],
                                'cancelled' => ['icon' => '❌', 'class' => 'badge-danger', 'label' => 'Cancelled'],
                                'refunded' => ['icon' => '💰', 'class' => 'badge-warning', 'label' => 'Refunded']
                            ];
                            $config = $statusConfig[$order->order_status] ?? ['icon' => '❓', 'class' => 'badge-secondary', 'label' => ucfirst($order->order_status)];
                            @endphp
                            <span class="badge {{ $config['class'] }}">
                                {{ $config['icon'] }} {{ $config['label'] }}
                            </span>
                        </td>
                        <td>
                            <small class="text-muted">{{ $order->placed_at?->format('M d, Y') ?? 'N/A' }}</small>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('seller.orders.show', $order->sl_no) }}" class="btn btn-outline-primary" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button class="btn btn-outline-secondary" onclick="printOrder({{ $order->sl_no }})" title="Print">
                                    <i class="fas fa-print"></i>
                                </button>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="#" onclick="updateStatus({{ $order->sl_no }}, 'processing')">Mark as Processing</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="updateStatus({{ $order->sl_no }}, 'shipped')">Mark as Shipped</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="updateStatus({{ $order->sl_no }}, 'delivered')">Mark as Delivered</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-danger" href="#" onclick="deleteOrder({{ $order->sl_no }})">Delete Order</a></li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="text-muted">
                                <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                                <p class="mb-0">No orders found</p>
                                <small>Start selling to see orders here</small>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="card-footer bg-white d-flex justify-content-between align-items-center">
            <small class="text-muted">Showing {{ $orders->count() }} of {{ $orders->count() }} orders</small>
            <nav aria-label="Page navigation">
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<style>
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
    .badge-warning { background-color: #ffc107 !important; color: #000 !important; }
    .badge-info { background-color: #17a2b8 !important; color: #fff !important; }
    .badge-success { background-color: #28a745 !important; color: #fff !important; }
    .avatar { min-width: 40px; min-height: 40px; }
</style>

<script>
function applyFilters() {
    const search = document.getElementById('searchInput').value.toLowerCase();
    const status = document.getElementById('statusFilter').value;
    const date = document.getElementById('dateFilter').value;
    const sort = document.getElementById('sortFilter').value;
    
    let rows = Array.from(document.querySelectorAll('.order-row'));
    
    // Filter logic
    rows = rows.filter(row => {
        const orderId = row.dataset.orderId.toLowerCase();
        const rowStatus = row.dataset.status;
        const rowDate = row.dataset.date?.split('T')[0];
        
        const matchesSearch = orderId.includes(search) || row.textContent.toLowerCase().includes(search);
        const matchesStatus = !status || rowStatus === status;
        const matchesDate = !date || rowDate === date;
        
        return matchesSearch && matchesStatus && matchesDate;
    });
    
    // Sort logic
    rows.sort((a, b) => {
        switch(sort) {
            case 'newest':
                return new Date(b.dataset.date) - new Date(a.dataset.date);
            case 'oldest':
                return new Date(a.dataset.date) - new Date(b.dataset.date);
            case 'highest':
                return parseFloat(b.dataset.amount) - parseFloat(a.dataset.amount);
            case 'lowest':
                return parseFloat(a.dataset.amount) - parseFloat(b.dataset.amount);
            default:
                return 0;
        }
    });
    
    // Update visibility
    document.querySelectorAll('.order-row').forEach(row => row.style.display = 'none');
    rows.forEach(row => row.style.display = '');
}

function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('statusFilter').value = '';
    document.getElementById('dateFilter').value = '';
    document.getElementById('sortFilter').value = 'newest';
    document.querySelectorAll('.order-row').forEach(row => row.style.display = '');
}

function printOrder(orderId) {
    window.location.href = `/seller/orders/${orderId}/print`;
}

function printOrders() {
    window.print();
}

function exportOrders() {
    alert('Export functionality coming soon!');
}

function updateStatus(orderId, status) {
    if (confirm(`Update order status to ${status}?`)) {
        // AJAX call to update status
        console.log(`Update order ${orderId} to ${status}`);
        location.reload();
    }
}

function deleteOrder(orderId) {
    if (confirm('Are you sure you want to delete this order?')) {
        // AJAX call to delete order
        console.log(`Delete order ${orderId}`);
        location.reload();
    }
}

// Event listeners
document.getElementById('searchInput')?.addEventListener('keyup', applyFilters);
document.getElementById('statusFilter')?.addEventListener('change', applyFilters);
document.getElementById('dateFilter')?.addEventListener('change', applyFilters);
document.getElementById('sortFilter')?.addEventListener('change', applyFilters);
</script>

<style>
/* Page Styling */
.main {
    display: flex;
    width: 100%;
    height: 100vh;
}

.content {
    flex: 1;
    width: 100%;
    overflow-y: auto;
    overflow-x: hidden;
}

.container-fluid {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
    padding-top: 2rem;
    padding-bottom: 2rem;
}

/* Header Styling */
.h3 {
    font-weight: 700;
    letter-spacing: -0.5px;
}

/* Statistics Cards */
.card {
    transition: all 0.3s ease;
    border-radius: 0.75rem;
}

.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12) !important;
}

.card-body {
    padding: 1.5rem;
}

.badge {
    padding: 0.5rem 0.75rem;
    font-weight: 600;
    border-radius: 0.375rem;
}

.badge.rounded-circle {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
}

/* Filter Section */
.card-header {
    background-color: #f8f9fa !important;
    border-bottom: 2px solid #e9ecef;
    padding: 1rem 1.5rem;
}

.form-control, .form-select {
    border-radius: 0.5rem;
    border: 1.5px solid #e9ecef;
    transition: all 0.2s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
}

/* Table Styling */
.table {
    margin-bottom: 0;
}

.table thead th {
    background-color: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
    font-weight: 600;
    color: #495057;
    padding: 1rem;
    text-transform: uppercase;
    font-size: 0.875rem;
    letter-spacing: 0.5px;
}

.table tbody tr {
    border-bottom: 1px solid #f0f0f0;
    transition: background-color 0.2s ease;
}

.table tbody tr:hover {
    background-color: #f8f9fa !important;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
}

.table td {
    padding: 1rem;
    vertical-align: middle;
}

/* Avatar Styling */
.avatar {
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    font-weight: 600;
    font-size: 0.875rem;
}

/* Button Styling */
.btn {
    font-weight: 600;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    transition: all 0.2s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.btn-group-sm {
    gap: 0.25rem;
}

.btn-group-sm .btn {
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
}

/* Badge Colors */
.badge-warning {
    background-color: #ffc107 !important;
    color: #000 !important;
    font-weight: 600;
}

.badge-info {
    background-color: #17a2b8 !important;
}

.badge-success {
    background-color: #28a745 !important;
}

.badge-danger {
    background-color: #dc3545 !important;
}

/* Empty State */
.text-center.py-5 {
    background: #f8f9fa;
    border-radius: 0.75rem;
}

/* Pagination */
.pagination {
    gap: 0.25rem;
}

.page-item .page-link {
    border-radius: 0.5rem;
    border: 1px solid #dee2e6;
    color: #0d6efd;
    transition: all 0.2s ease;
}

.page-item .page-link:hover {
    background-color: #0d6efd;
    color: white;
}

.page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

/* Dropdown Menu */
.dropdown-menu {
    border-radius: 0.5rem;
    border: 1px solid #dee2e6;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.dropdown-item {
    padding: 0.75rem 1rem;
    color: #495057;
    transition: all 0.2s ease;
}

.dropdown-item:hover {
    background-color: #f8f9fa;
    color: #0d6efd;
}

.dropdown-item.text-danger:hover {
    background-color: #fff5f5;
    color: #dc3545;
}

/* Responsive */
@media (max-width: 768px) {
    .container-fluid {
        padding-top: 1rem;
        padding-bottom: 1rem;
    }
    
    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 1rem;
    }
    
    .table {
        font-size: 0.875rem;
    }
    
    .table th, .table td {
        padding: 0.75rem 0.5rem;
    }
}

/* Print Styles */
@media print {
    .btn, .dropdown-menu, .pagination,
    .d-flex.justify-content-between {
        display: none !important;
    }
    
    .card {
        page-break-inside: avoid;
        box-shadow: none !important;
        border: 1px solid #dee2e6 !important;
    }
    
    .table tbody tr:hover {
        background-color: white !important;
    }
}

/* Animations */
@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card {
    animation: slideUp 0.3s ease;
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>
      </div>
    </main>

    <!-- ===============================================-->
    <!--    Scripts-->
    <!-- ===============================================-->
    <script src="{{ asset('seller/vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/is/is.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/numeral/numeral.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/OverlayScrollbars/OverlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/list.js/list.min.js') }}"></script>
    <script src="{{ asset('seller/assets/js/theme.js') }}"></script>
  </body>
</html>
    </main>

    <!-- ===============================================-->
    <!--    Scripts-->
    <!-- ===============================================-->
    <script src="{{ asset('seller/vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/is/is.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/numeral/numeral.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/OverlayScrollbars/OverlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/list.js/list.min.js') }}"></script>
    <script src="{{ asset('seller/assets/js/theme.js') }}"></script>
  </body>
</html>
