<!DOCTYPE html>
<html lang="en-US" dir="ltr" data-navigation-type="default" data-navbar-horizontal-shape="default">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Order Details - Ayatibook</title>

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
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
      <x-sidebar/>
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
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('seller.orders.index') }}">Orders</a></li>
            <li class="breadcrumb-item active">{{ $order->order_id }}</li>
        </ol>
    </nav>

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-dark mb-0">Order #{{ $order->order_id }}</h1>
            <p class="text-muted small">Order details and tracking information</p>
        </div>
        <div class="d-flex gap-2">
            <button id="printOrderBtn" class="btn btn-outline-secondary">
                <i class="fas fa-print"></i> Print
            </button>
            <button id="downloadInvoiceBtn" class="btn btn-outline-primary">
                <i class="fas fa-file-pdf"></i> Invoice
            </button>
            <button id="shippingLabelBtn" class="btn btn-outline-warning">
                <i class="fas fa-shipping-fast"></i> Shipping Label
            </button>
        </div>
    </div>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Order Status Timeline -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light border-bottom">
                    <h5 class="mb-0">📍 Order Status</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        @php
                        $statuses = ['placed', 'confirmed', 'shipped', 'delivered'];
                        $currentIndex = array_search($order->order_status, $statuses);
                        @endphp
                        
                        @foreach(['placed' => 'Placed', 'confirmed' => 'Confirmed', 'shipped' => 'Shipped', 'delivered' => 'Delivered'] as $status => $label)
                        @php
                        $statusIndex = array_search($status, $statuses);
                        $isActive = $statusIndex <= $currentIndex;
                        $isCurrent = $order->order_status === $status;
                        @endphp
                        <div class="text-center flex-grow-1">
                            <div class="mb-2">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle {{ $isActive ? 'bg-success' : 'bg-light' }} text-white" style="width: 40px; height: 40px; font-size: 18px;">
                                    @if($isCurrent)
                                        <i class="fas fa-circle-notch"></i>
                                    @elseif($isActive)
                                        <i class="fas fa-check"></i>
                                    @else
                                        <i class="fas fa-circle"></i>
                                    @endif
                                </div>
                            </div>
                            <small class="d-block {{ $isActive ? 'fw-bold text-dark' : 'text-muted' }}">{{ $label }}</small>
                        </div>
                        @if(!$loop->last)
                        <div class="flex-grow-1 d-flex align-items-center mx-2">
                            <div class="w-100" style="height: 2px; background: {{ $isActive ? '#28a745' : '#e9ecef' }};"></div>
                        </div>
                        @endif
                        @endforeach
                    </div>

                    <!-- Update Status Dropdown -->
                    <div class="mt-4 pt-4 border-top">
                        <label class="form-label small text-muted">Update Status</label>
                        <div class="d-flex gap-2">
                            <select 
    id="statusSelect"
    class="form-select form-select-sm"
    style="max-width: 200px;"
    data-current-status="{{ $order->order_status }}"
    data-order-id="{{ $order->sl_no }}"
>
    <option value="placed" {{ $order->order_status === 'placed' ? 'selected' : '' }}>Placed</option>
    <option value="confirmed" {{ $order->order_status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
    <option value="shipped" {{ $order->order_status === 'shipped' ? 'selected' : '' }}>Shipped</option>
    <option value="delivered" {{ $order->order_status === 'delivered' ? 'selected' : '' }}>Delivered</option>
    <option value="cancelled" {{ $order->order_status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
    <option value="refunded" {{ $order->order_status === 'refunded' ? 'selected' : '' }}>Refunded</option>
</select>

<button class="btn btn-sm btn-primary" onclick="updateOrderStatus()">
    Update
</button>
</div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light border-bottom">
                    <h5 class="mb-0">📦 Order Items</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-end">Price</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded p-2 me-3" style="width: 50px; height: 50px;">
                                            <i class="fas fa-box text-secondary"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-500">{{ $item->product_name ?? 'Product' }}</p>
                                            @if($item->variant_name)
                                            <small class="text-muted">{{ $item->variant_name }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark">{{ $item->quantity }}</span>
                                </td>
                                <td class="text-end">Rs. {{ number_format($item->price, 2) }}</td>
                                <td class="text-end fw-bold">Rs. {{ number_format($item->quantity * $item->price, 2) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-3 text-muted">No items in this order</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Order Summary -->
                <div class="card-footer bg-white">
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal:</span>
                                <span>Rs. {{ number_format($order->total_amount * 0.9, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Shipping:</span>
                                <span>Rs. {{ number_format($order->total_amount * 0.05, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                                <span>Tax:</span>
                                <span>Rs. {{ number_format($order->total_amount * 0.05, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between" style="font-size: 18px;">
                                <span class="fw-bold">Total:</span>
                                <span class="fw-bold text-success">Rs. {{ number_format($order->total_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notes Section -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light border-bottom">
                    <h5 class="mb-0">📝 Order Notes</h5>
                </div>
                <div class="card-body">
                    <textarea id="orderNotes" class="form-control" rows="3" placeholder="Add internal notes about this order...">{{ $order->notes ?? '' }}</textarea>
                    <button id="saveNotesBtn" class="btn btn-sm btn-primary mt-2" disabled>Save Notes</button>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Customer Information -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light border-bottom">
                    <h5 class="mb-0">👤 Customer Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label small text-muted">Name</label>
                        <p class="mb-0 fw-500">{{ $user->name ?? 'N/A' }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-muted">Email</label>
                        <p class="mb-0"><a href="mailto:{{ $user->email ?? '#' }}">{{ $user->email ?? 'N/A' }}</a></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-muted">Phone</label>
                        <p class="mb-0">{{ $user->phone ?? 'N/A' }}</p>
                    </div>
                    <div class="pt-3 border-top">
                        <a href="#" class="btn btn-sm btn-outline-primary w-100">View Customer Profile</a>
                    </div>
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light border-bottom">
                    <h5 class="mb-0">📍 Shipping Address</h5>
                </div>
                <div class="card-body">
                    @if($address)
                    <p class="mb-0">
                        {{ $address->address ?? 'N/A' }}<br>
                        <small class="text-muted">
                            {{ $address->city ?? '' }}, {{ $address->state ?? '' }} {{ $address->zip ?? '' }}<br>
                            {{ $address->country ?? 'Pakistan' }}
                        </small>
                    </p>
                    @else
                    <p class="text-muted small">No shipping address on file</p>
                    @endif
                </div>
            </div>

            <!-- Payment Information -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light border-bottom">
                    <h5 class="mb-0">💳 Payment Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label small text-muted">Method</label>
                        <p class="mb-0">
                            <span class="badge bg-light text-dark">
                                <i class="fas fa-credit-card"></i>
                                {{ ucfirst($order->payment_method ?? 'Unknown') }}
                            </span>
                        </p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-muted">Amount</label>
                        <p class="mb-0 fw-bold text-success" style="font-size: 20px;">Rs. {{ number_format($order->total_amount, 2) }}</p>
                    </div>
                    <div>
                        <label class="form-label small text-muted">Date</label>
                        <p class="mb-0">{{ $order->placed_at?->format('M d, Y H:i A') ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light border-bottom">
                    <h5 class="mb-0">⚡ Quick Actions</h5>
                </div>
                <div class="card-body d-flex flex-column gap-2">
                    <button class="btn btn-sm btn-primary" onclick="sendNotification()">
                        <i class="fas fa-bell"></i> Send Notification
                    </button>
                    <button id="downloadInvoiceBtn" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-file-pdf"></i> Download Invoice
                    </button>
                    <button id="contactCustomerBtn" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-envelope"></i> Contact Customer
                    </button>
                    <button id="cancelOrderBtn" class="btn btn-sm btn-outline-danger">
                        <i class="fas fa-times"></i> Cancel Order
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .btn, .breadcrumb, .card-header, .d-flex.justify-content-between.align-items-center {
        display: none !important;
    }
}
</style>

<script>
async function updateOrderStatus() {
    const select = document.getElementById('statusSelect');

    const newStatus = select.value;
    const currentStatus = select.dataset.currentStatus;
    const orderSlNo = select.dataset.orderId;

    if (newStatus === currentStatus) {
        showToast('Status is already selected', 'warning');
        return;
    }

    if (!confirm(`Update order status to "${newStatus}"?`)) {
        select.value = currentStatus;
        return;
    }

    try {
        const response = await fetch(`/seller/orders/${orderSlNo}/status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ status: newStatus })
        });

        if (!response.ok) {
            throw new Error('Request failed');
        }

        showToast('Status updated successfully', 'success');

        setTimeout(() => {
            location.reload();
        }, 1200);

    } catch (error) {
        console.error(error);
        showToast('Failed to update status', 'danger');
        select.value = currentStatus;
    }
}

function downloadInvoice() {
    alert('Generating invoice...');
    // window.location.href = '/seller/orders/{{ $order->sl_no }}/invoice';
}

function generateShippingLabel() {
    alert('Generating shipping label...');
}

function saveNotes() {
    alert('Notes saved successfully!');
}

function sendNotification() {
    alert('Notification sent to customer!');
}

function contactCustomer() {
    alert('Opening contact options...');
}

function cancelOrder() {
    if (confirm('Are you sure you want to cancel this order?')) {
        alert('Order cancelled successfully!');
        // location.reload();
    }
}
</script>

<style>
/* Page Background */
.container-fluid {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
    padding-top: 2rem;
    padding-bottom: 2rem;
}

/* Breadcrumb */
.breadcrumb {
    background-color: rgba(255, 255, 255, 0.7);
    border-radius: 0.5rem;
    padding: 0.75rem 1rem;
    margin-bottom: 2rem;
}

.breadcrumb-item a {
    color: #0d6efd;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s ease;
}

.breadcrumb-item a:hover {
    color: #0a58ca;
    text-decoration: underline;
}

.breadcrumb-item.active {
    color: #6c757d;
    font-weight: 600;
}

/* Header */
.h3 {
    font-weight: 700;
    letter-spacing: -0.5px;
}

/* Cards */
.card {
    transition: all 0.3s ease;
    border-radius: 0.75rem;
    border: none;
    overflow: hidden;
}

.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12) !important;
}

.card-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-bottom: 2px solid #e9ecef;
    padding: 1.25rem 1.5rem;
}

.card-header h5 {
    font-weight: 700;
    color: #212529;
    margin: 0;
    font-size: 1.1rem;
}

.card-body {
    padding: 1.5rem;
}

.card-footer {
    padding: 1.5rem;
    border-top: 2px solid #f0f0f0;
}

/* Timeline Styling */
.d-flex.justify-content-between.align-items-center > div {
    display: flex;
    flex-direction: column;
    align-items: center;
    flex: 1;
}

.rounded-circle {
    transition: all 0.3s ease;
    font-size: 1.25rem;
}

.bg-success {
    background-color: #28a745 !important;
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
}

.bg-light {
    background-color: #f8f9fa !important;
    border: 2px solid #e9ecef;
}

/* Status Badge */
.badge {
    padding: 0.5rem 0.75rem;
    font-weight: 600;
    border-radius: 0.375rem;
    font-size: 0.875rem;
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
}

.table td {
    padding: 1rem;
    vertical-align: middle;
}

/* Form Elements */
.form-label {
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.form-control, .form-select {
    border-radius: 0.5rem;
    border: 1.5px solid #e9ecef;
    transition: all 0.2s ease;
    font-size: 0.95rem;
}

.form-control:focus, .form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
}

.form-control::placeholder {
    color: #adb5bd;
}

/* Buttons */
.btn {
    font-weight: 600;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    transition: all 0.2s ease;
    border: none;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.btn-primary {
    background-color: #0d6efd;
}

.btn-primary:hover {
    background-color: #0a58ca;
}

.btn-outline-primary {
    color: #0d6efd;
    border: 2px solid #0d6efd;
}

.btn-outline-primary:hover {
    background-color: #0d6efd;
    color: white;
}

.btn-outline-secondary {
    color: #6c757d;
    border: 2px solid #6c757d;
}

.btn-outline-secondary:hover {
    background-color: #6c757d;
    color: white;
}

.btn-outline-warning {
    color: #ffc107;
    border: 2px solid #ffc107;
}

.btn-outline-warning:hover {
    background-color: #ffc107;
    color: #000;
}

.btn-sm {
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
}

/* Sidebar */
.col-lg-4 > .card {
    margin-bottom: 1.5rem;
}

/* Summary Section */
.d-flex.justify-content-between {
    padding: 0.75rem 0;
    border-bottom: 1px solid #f0f0f0;
}

.d-flex.justify-content-between:last-child {
    border-bottom: none;
}

.d-flex.justify-content-between.pb-3 {
    padding-bottom: 1rem;
    border-bottom: 2px solid #f0f0f0;
}

/* Text Colors */
.text-success {
    color: #28a745 !important;
    font-weight: 700;
}

.text-muted {
    color: #6c757d !important;
}

.text-dark {
    color: #212529 !important;
}

/* Responsive Layout */
@media (max-width: 991px) {
    .col-lg-4 {
        margin-top: 2rem;
    }
}

@media (max-width: 768px) {
    .container-fluid {
        padding-top: 1rem;
        padding-bottom: 1rem;
    }
    
    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 1rem;
    }
    
    .card-body {
        padding: 1rem;
    }
    
    .table {
        font-size: 0.875rem;
    }
    
    .btn {
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
    }
}

/* Print Styles */
@media print {
    .container-fluid {
        background: white;
    }
    
    .btn, .breadcrumb, .card-header,
    .d-flex.justify-content-between {
        display: none !important;
    }
    
    .card {
        page-break-inside: avoid;
        box-shadow: none !important;
        border: 1px solid #dee2e6 !important;
        margin-bottom: 1rem;
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

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.8;
    }
}

.fa-circle-notch {
    animation: pulse 1.5s infinite;
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

/* Links */
a {
    color: #0d6efd;
    text-decoration: none;
    transition: color 0.2s ease;
}

a:hover {
    color: #0a58ca;
    text-decoration: underline;
}

/* Textarea */
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

textarea.form-control {
    resize: vertical;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
</style>

<script>
// Dynamic Order Management Functions
const orderId = '{{ $order->order_id }}';
const orderSlNo = '{{ $order->sl_no }}';

// Update order status dynamically
// document.getElementById('statusSelect')?.addEventListener('change', async function() {
//     const newStatus = this.value;
//     const currentStatus = '{{ $order->order_status }}';
    
//     if (newStatus === currentStatus) return;
    
//     try {
//         const response = await fetch(`/seller/orders/${orderSlNo}/status`, {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json',
//                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
//             },
//             body: JSON.stringify({ status: newStatus })
//         });
        
//         if (response.ok) {
//             showToast('Status updated successfully', 'success');
//             // Reload page to reflect changes
//             setTimeout(() => location.reload(), 1500);
//         } else {
//             showToast('Failed to update status', 'danger');
//             this.value = currentStatus;
//         }
//     } catch (error) {
//         console.error('Error updating status:', error);
//         showToast('Error updating status', 'danger');
//         this.value = currentStatus;
//     }
// });

// Update order notes dynamically
document.getElementById('saveNotesBtn')?.addEventListener('click', async function() {
    const notes = document.getElementById('orderNotes')?.value || '';
    
    try {
        const response = await fetch(`/seller/orders/${orderSlNo}/notes`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
            },
            body: JSON.stringify({ notes: notes })
        });
        
        if (response.ok) {
            showToast('Notes saved successfully', 'success');
        } else {
            showToast('Failed to save notes', 'danger');
        }
    } catch (error) {
        console.error('Error saving notes:', error);
        showToast('Error saving notes', 'danger');
    }
});

// Download invoice
document.getElementById('downloadInvoiceBtn')?.addEventListener('click', function() {
    showToast('Generating invoice...', 'info');
    // Simulate invoice generation
    setTimeout(() => {
        window.location.href = `/seller/orders/${orderSlNo}/invoice`;
    }, 500);
});

// Generate shipping label
document.getElementById('shippingLabelBtn')?.addEventListener('click', function() {
    showToast('Generating shipping label...', 'info');
    setTimeout(() => {
        window.location.href = `/seller/orders/${orderSlNo}/shipping-label`;
    }, 500);
});

// Cancel order
document.getElementById('cancelOrderBtn')?.addEventListener('click', function() {
    if (confirm('Are you sure you want to cancel this order? This action cannot be undone.')) {
        cancelOrder();
    }
});

async function cancelOrder() {
    try {
        const response = await fetch(`/seller/orders/${orderSlNo}/cancel`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
            }
        });
        
        if (response.ok) {
            showToast('Order cancelled successfully', 'success');
            setTimeout(() => {
                window.location.href = '/seller/orders';
            }, 1500);
        } else {
            showToast('Failed to cancel order', 'danger');
        }
    } catch (error) {
        console.error('Error cancelling order:', error);
        showToast('Error cancelling order', 'danger');
    }
}

// Contact customer
document.getElementById('contactCustomerBtn')?.addEventListener('click', function() {
    const email = '{{ $user->email ?? '' }}';
    const phone = '{{ $user->phone ?? '' }}';
    
    if (email) {
        window.location.href = `mailto:${email}?subject=Order ${orderId} Inquiry`;
    } else if (phone) {
        window.location.href = `tel:${phone}`;
    } else {
        showToast('No contact information available', 'warning');
    }
});

// Show toast notification
function showToast(message, type = 'info') {
    const toastHtml = `
        <div class="toast align-items-center text-white bg-${type} border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    `;
    
    const container = document.createElement('div');
    container.className = 'toast-container position-fixed bottom-0 end-0 p-3';
    container.innerHTML = toastHtml;
    
    document.body.appendChild(container);
    
    const toast = new bootstrap.Toast(container.querySelector('.toast'));
    toast.show();
    
    setTimeout(() => container.remove(), 3000);
}

// Real-time form validation
document.getElementById('orderNotes')?.addEventListener('input', function() {
    const saveBtn = document.getElementById('saveNotesBtn');
    if (saveBtn) {
        saveBtn.disabled = this.value.length === 0;
    }
});

// Print order
document.getElementById('printOrderBtn')?.addEventListener('click', function() {
    window.print();
});
</script>
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
