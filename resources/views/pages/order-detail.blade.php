<!DOCTYPE html>
<html lang="en">

<head>
    <title>Order #{{ $order->order_id }} – AyitiBook</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">

    <link rel="icon" type="image/png" href="/assets/images/favicon.png">
    <link rel="stylesheet" href="/assets/vendor/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/custom.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link rel="stylesheet" href="/assets/css/header.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

    <style>
        /* ── Base ───────────────────────────────────────── */
        body { overflow-x: hidden; background: #f5f5f5; font-family: 'Poppins', sans-serif; }

        /* ── Breadcrumb ─────────────────────────────────── */
        .breadcrumb-bar {
            background: #fff;
            border-bottom: 1px solid #e8e8e8;
            padding: 12px 0;
            margin-bottom: 32px;
        }
        .breadcrumb-bar .breadcrumb { margin: 0; background: transparent; padding: 0; font-size: 13px; }
        .breadcrumb-bar .breadcrumb-item a { color: #DB4444; text-decoration: none; }
        .breadcrumb-bar .breadcrumb-item.active { color: #555; }
        .breadcrumb-bar .breadcrumb-item + .breadcrumb-item::before { color: #999; }

        /* ── Page wrapper ───────────────────────────────── */
        .order-detail-page { padding: 0 0 60px; }

        /* ── Sidebar ────────────────────────────────────── */
        .account-sidebar {
            background: #fff;
            border-radius: 8px;
            padding: 28px 0;
            box-shadow: 0 1px 6px rgba(0,0,0,.07);
            position: sticky;
            top: 90px;
        }
        .account-sidebar .sidebar-user {
            padding: 0 24px 20px;
            border-bottom: 1px solid #f0f0f0;
        }
        .account-sidebar .sidebar-user .avatar-circle {
            width: 52px; height: 52px;
            background: linear-gradient(135deg, #DB4444, #f06363);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 20px; font-weight: 600; flex-shrink: 0;
        }
        .account-sidebar .sidebar-user .user-info h6 { font-size: 14px; font-weight: 600; margin: 0 0 2px; }
        .account-sidebar .sidebar-user .user-info p  { font-size: 12px; color: #888; margin: 0; }
        .account-sidebar .sidebar-nav { padding: 16px 0 0; }
        .account-sidebar .sidebar-section-title {
            font-size: 11px; font-weight: 700; text-transform: uppercase;
            letter-spacing: .8px; color: #aaa; padding: 0 24px; margin-bottom: 6px;
        }
        .account-sidebar .nav-link {
            display: flex; align-items: center; gap: 12px; padding: 11px 24px;
            color: #555; font-size: 14px; font-weight: 400; text-decoration: none;
            transition: all .2s; border-left: 3px solid transparent;
        }
        .account-sidebar .nav-link i { font-size: 18px; width: 20px; text-align: center; color: #aaa; }
        .account-sidebar .nav-link:hover,
        .account-sidebar .nav-link.active {
            background: #fff5f5; color: #DB4444; border-left-color: #DB4444; font-weight: 600;
        }
        .account-sidebar .nav-link:hover i,
        .account-sidebar .nav-link.active i { color: #DB4444; }

        /* ── Cards shared ───────────────────────────────── */
        .detail-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 1px 6px rgba(0,0,0,.07);
            margin-bottom: 20px;
            overflow: hidden;
        }
        .detail-card-head {
            display: flex; align-items: center; justify-content: space-between;
            padding: 16px 22px; border-bottom: 1px solid #f0f0f0;
            background: #fafafa; flex-wrap: wrap; gap: 8px;
        }
        .detail-card-head h5 {
            font-size: 15px; font-weight: 700; margin: 0; display: flex; align-items: center; gap: 8px;
        }
        .detail-card-head h5 i { color: #DB4444; font-size: 18px; }
        .detail-card-body { padding: 20px 22px; }

        /* ── Status badge ───────────────────────────────── */
        .status-badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 5px 14px; border-radius: 14px; font-size: 13px; font-weight: 600; text-transform: capitalize;
        }
        .status-badge::before { content: ''; width: 8px; height: 8px; border-radius: 50%; display: inline-block; }
        .status-pending    { background:#fff8e1; color:#f59e0b; } .status-pending::before    { background:#f59e0b; }
        .status-confirmed  { background:#e3f2fd; color:#1e88e5; } .status-confirmed::before  { background:#1e88e5; }
        .status-processing { background:#ede7f6; color:#7b1fa2; } .status-processing::before { background:#7b1fa2; }
        .status-shipped    { background:#e0f7fa; color:#00897b; } .status-shipped::before    { background:#00897b; }
        .status-delivered  { background:#e8f5e9; color:#2e7d32; } .status-delivered::before  { background:#2e7d32; }
        .status-cancelled  { background:#fce4ec; color:#c62828; } .status-cancelled::before  { background:#c62828; }
        .status-refunded   { background:#f3e5f5; color:#6a1b9a; } .status-refunded::before   { background:#6a1b9a; }

        /* ── Order Summary Hero ─────────────────────────── */
        .order-hero {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 1px 6px rgba(0,0,0,.07);
            padding: 24px 24px 20px;
            margin-bottom: 20px;
        }
        .order-hero .hero-top {
            display: flex; align-items: flex-start; justify-content: space-between;
            flex-wrap: wrap; gap: 16px; margin-bottom: 20px;
        }
        .order-hero .order-id-label {
            font-size: 12px; color: #999; text-transform: uppercase; letter-spacing: .6px; margin-bottom: 4px;
        }
        .order-hero .order-id-value {
            font-size: 22px; font-weight: 700; color: #222;
        }
        .order-hero .order-id-value span { color: #DB4444; }
        .order-hero .order-date { font-size: 13px; color: #888; margin-top: 4px; }

        /* Progress tracker */
        .order-progress { margin-top: 4px; }
        .progress-steps {
            display: flex; align-items: flex-start; position: relative;
        }
        .progress-steps::before {
            content: ''; position: absolute; top: 17px; left: 0; right: 0; height: 2px;
            background: #eee; z-index: 0;
        }
        .progress-fill {
            position: absolute; top: 17px; left: 0; height: 2px;
            background: #DB4444; z-index: 1; transition: width .4s ease;
        }
        .progress-step {
            flex: 1; display: flex; flex-direction: column; align-items: center;
            position: relative; z-index: 2;
        }
        .progress-step .step-dot {
            width: 34px; height: 34px; border-radius: 50%; border: 2px solid #ddd;
            background: #fff; display: flex; align-items: center; justify-content: center;
            font-size: 14px; color: #ccc; transition: all .3s; margin-bottom: 8px;
        }
        .progress-step.done .step-dot {
            background: #DB4444; border-color: #DB4444; color: #fff;
        }
        .progress-step.active .step-dot {
            background: #fff; border-color: #DB4444; color: #DB4444;
            box-shadow: 0 0 0 3px rgba(219,68,68,.15);
        }
        .progress-step .step-label {
            font-size: 11px; color: #aaa; text-align: center; font-weight: 500; white-space: nowrap;
        }
        .progress-step.done .step-label,
        .progress-step.active .step-label { color: #DB4444; font-weight: 600; }

        /* ── Order Items Table ──────────────────────────── */
        .items-table { width: 100%; border-collapse: collapse; }
        .items-table thead tr { border-bottom: 2px solid #f0f0f0; }
        .items-table thead th {
            font-size: 12px; font-weight: 700; text-transform: uppercase;
            letter-spacing: .5px; color: #aaa; padding: 0 0 12px; text-align: left;
        }
        .items-table thead th:last-child { text-align: right; }
        .items-table tbody tr { border-bottom: 1px dashed #f5f5f5; }
        .items-table tbody tr:last-child { border-bottom: none; }
        .items-table td { padding: 14px 0; vertical-align: middle; }

        .product-cell { display: flex; align-items: center; gap: 14px; }
        .product-cell .prod-img {
            width: 64px; height: 64px; border-radius: 8px; border: 1px solid #eee;
            object-fit: cover; flex-shrink: 0; background: #f9f9f9;
            display: flex; align-items: center; justify-content: center; color: #ddd; overflow: hidden;
        }
        .product-cell .prod-img img { width: 100%; height: 100%; object-fit: cover; }
        .product-cell .prod-info .prod-name {
            font-size: 14px; font-weight: 600; color: #333; margin: 0 0 3px;
        }
        .product-cell .prod-info .prod-variant { font-size: 12px; color: #999; }
        .product-cell .prod-info .prod-sku { font-size: 11px; color: #bbb; margin-top: 2px; }

        .items-table .qty-cell { font-size: 14px; color: #555; text-align: center; }
        .items-table .price-cell { font-size: 13.5px; color: #888; }
        .items-table .subtotal-cell { font-size: 14px; font-weight: 700; color: #DB4444; text-align: right; }

        /* ── Price Summary ──────────────────────────────── */
        .price-summary { border-top: 1.5px solid #f0f0f0; padding-top: 18px; margin-top: 4px; }
        .price-row {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 10px; font-size: 14px;
        }
        .price-row .label { color: #888; }
        .price-row .value { font-weight: 500; color: #444; }
        .price-row.total-row {
            border-top: 1.5px dashed #eee; padding-top: 12px; margin-top: 4px;
        }
        .price-row.total-row .label { font-size: 15px; font-weight: 700; color: #333; }
        .price-row.total-row .value  { font-size: 16px; font-weight: 700; color: #DB4444; }

        /* ── Info Grid ──────────────────────────────────── */
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        @media (max-width: 600px) { .info-grid { grid-template-columns: 1fr; } }

        .info-label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .6px; color: #bbb; margin-bottom: 6px; }
        .info-value { font-size: 14px; color: #444; font-weight: 500; line-height: 1.6; }
        .info-value .payment-icon { font-size: 18px; vertical-align: middle; margin-right: 5px; color: #DB4444; }

        /* ── Delivery Partner ───────────────────────────── */
        .delivery-partner-card {
            display: flex; align-items: center; gap: 16px;
            background: #f9f9f9; border-radius: 10px; padding: 16px;
        }
        .delivery-partner-card .dp-avatar {
            width: 50px; height: 50px; border-radius: 50%; background: #DB4444;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 20px; font-weight: 700; flex-shrink: 0;
        }
        .delivery-partner-card .dp-info h6 { font-size: 15px; font-weight: 600; margin: 0 0 2px; color: #333; }
        .delivery-partner-card .dp-info p  { font-size: 12px; color: #888; margin: 0; }
        .delivery-partner-card .dp-status  { margin-left: auto; }

        /* ── Action Buttons ─────────────────────────────── */
        .action-bar {
            background: #fff; border-radius: 10px; box-shadow: 0 1px 6px rgba(0,0,0,.07);
            padding: 18px 22px; display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 12px; margin-bottom: 20px;
        }
        .action-bar .back-link {
            display: inline-flex; align-items: center; gap: 6px;
            color: #888; font-size: 14px; text-decoration: none; transition: color .2s;
        }
        .action-bar .back-link:hover { color: #DB4444; }
        .btn-primary-red {
            padding: 9px 22px; background: #DB4444; color: #fff; border: none;
            border-radius: 6px; font-size: 13.5px; font-weight: 500; cursor: pointer;
            text-decoration: none; transition: background .2s; display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-primary-red:hover { background: #c13333; color: #fff; }
        .btn-outline-red {
            padding: 9px 22px; background: #fff; color: #DB4444; border: 1.5px solid #DB4444;
            border-radius: 6px; font-size: 13.5px; font-weight: 500; cursor: pointer;
            text-decoration: none; transition: all .2s; display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-outline-red:hover { background: #DB4444; color: #fff; }
        .btn-outline-grey {
            padding: 9px 22px; background: #fff; color: #666; border: 1.5px solid #ddd;
            border-radius: 6px; font-size: 13.5px; font-weight: 500; cursor: pointer;
            text-decoration: none; transition: all .2s; display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-outline-grey:hover { border-color: #DB4444; color: #DB4444; }

        /* Responsive */
        @media (max-width: 768px) {
            .detail-card-body { padding: 16px 16px; }
            .detail-card-head { padding: 14px 16px; }
            .order-hero { padding: 18px 16px 16px; }
            .action-bar { padding: 14px 16px; }
            .progress-step .step-label { font-size: 10px; }
            .items-table thead { display: none; }
            .items-table tbody tr { display: block; padding: 12px 0; }
            .items-table td { display: block; padding: 4px 0; }
            .items-table .subtotal-cell { text-align: left; }
        }
    </style>
</head>

<body>

    {{-- ── Top bar ──────────────────────────────────────── --}}
    <div class="top-bar bg-dark d-none d-lg-block">
        <div class="container py-0">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <div class="location"><i class="fas fa-map-marker-alt me-1"></i> Update Location</div>
                </div>
                <div class="col-md-9">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="text-white mb-0 d-inline">Summer Sale For All Swim Suits And Free Express Delivery - OFF 50%!</p>
                        <div class="d-flex align-items-center">
                            <select class="form-select custom-select"><option selected>English</option></select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('includes.header')

    {{-- ── Breadcrumb ───────────────────────────────────── --}}
    {{-- <div class="breadcrumb-bar">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('account.my-account') }}">My Account</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('account.my-orders') }}">My Orders</a></li>
                    <li class="breadcrumb-item active">Order #{{ $order->order_id }}</li>
                </ol>
            </nav>
        </div>
    </div> --}}

    {{-- ── Main ─────────────────────────────────────────── --}}
    <section class="order-detail-page">
        <div class="container">

            {{-- Flash messages --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row g-4">

                {{-- ── Sidebar ─────────────────────────── --}}
                {{-- <div class="col-lg-3 col-md-4 d-none d-md-block">
                    <div class="account-sidebar">
                        <div class="sidebar-user d-flex align-items-center gap-3">
                            <div class="avatar-circle">
                                {{ strtoupper(substr(auth()->user()->first_name ?? auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="user-info">
                                <h6>{{ auth()->user()->first_name ?? auth()->user()->name }} {{ auth()->user()->last_name ?? '' }}</h6>
                                <p>{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        <nav class="sidebar-nav"> 
                            <p class="sidebar-section-title mt-3">Manage My Account</p>
                            <a href="{{ route('profile.edit') }}" class="nav-link"><i class='bx bx-user'></i> My Profile</a>
                            <a href="{{ route('profile.edit') }}" class="nav-link"><i class='bx bx-edit'></i> Edit Profile</a>
                            <p class="sidebar-section-title mt-3">My Orders</p>
                            <a href="{{ route('my-orders') }}" class="nav-link active"><i class='bx bx-box'></i> My Orders</a>
                            <a href="#" class="nav-link"><i class='bx bx-x-circle'></i> My Cancellations</a>
                            <a href="#" class="nav-link"><i class='bx bx-undo'></i> My Returns</a>
                            <p class="sidebar-section-title mt-3">My Wishlist</p>
                            <a href="{{ route('wishlist.index') }}" class="nav-link"><i class='bx bx-heart'></i> Wishlist</a>
                            <p class="sidebar-section-title mt-3">Account</p>
                            <a href="{{ route('logout') }}" class="nav-link"
                               onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
                                <i class='bx bx-log-out'></i> Sign Out
                            </a>
                            <form id="sidebar-logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
                        </nav> -
                    </div>
                </div> --}}

                {{-- ── Detail Content ───────────────────── --}}
                <div class="col-lg-9 col-md-8 col-12">

                    {{-- ── Action bar ───── --}}
                    <div class="action-bar">
                        <a href="{{ route('my-orders') }}" class="back-link">
                            <i class="fas fa-arrow-left"></i> Back to My Orders
                        </a>
                        <div class="d-flex gap-2 flex-wrap">
                            @if (in_array($order->order_status, ['pending', 'confirmed']))
                                <form action="{{ route('order.cancel', $order->order_id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to cancel this order?')">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn-outline-grey">
                                        <i class='bx bx-x'></i> Cancel Order
                                    </button>
                                </form>
                            @endif
                            @if ($order->order_status === 'delivered')
                                <a href="#" class="btn-outline-red">
                                    <i class='bx bx-undo'></i> Request Return
                                </a>
                            @endif
                            <a href="{{ route('my-orders') }}" class="btn-primary-red" onclick="window.print(); return false;">
                                <i class='bx bx-printer'></i> Print
                            </a>
                        </div>
                    </div>

                    {{-- ── Order Hero ───── --}}
                    <div class="order-hero">
                        <div class="hero-top">
                            <div>
                                <p class="order-id-label">Order ID</p>
                                <div class="order-id-value">#<span>{{ $order->order_id }}</span></div>
                                <div class="order-date">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    Placed on {{ $order->placed_at ? $order->placed_at->format('d F Y, h:i A') : 'N/A' }}
                                </div>
                            </div>
                            <div class="text-end">
                                @php $statusClass = 'status-' . strtolower(str_replace(' ', '-', $order->order_status)); @endphp
                                <span class="status-badge {{ $statusClass }}">{{ ucfirst($order->order_status) }}</span>
                                @if ($order->isAssignedForDelivery())
                                    <div class="mt-2">
                                        <span style="font-size:12px; color:#2e7d32; background:#e8f5e9; padding:3px 10px; border-radius:10px; font-weight:500;">
                                            <i class="fas fa-motorcycle me-1" style="font-size:11px;"></i> Out for Delivery
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- ── Progress Tracker ── --}}
                        @php
                            $steps = [
                                'pending'    => ['label' => 'Order Placed',   'icon' => 'bx bx-receipt'],
                                'confirmed'  => ['label' => 'Confirmed',      'icon' => 'bx bx-check-circle'],
                                'processing' => ['label' => 'Processing',     'icon' => 'bx bx-cog'],
                                'shipped'    => ['label' => 'Shipped',        'icon' => 'bx bx-package'],
                                'delivered'  => ['label' => 'Delivered',      'icon' => 'bx bxs-check-circle'],
                            ];
                            $statusOrder  = array_keys($steps);
                            $currentIndex = array_search(strtolower($order->order_status), $statusOrder);
                            $isCancelled  = $order->order_status === 'cancelled';
                            $fillPct      = $currentIndex !== false ? ($currentIndex / (count($steps) - 1)) * 100 : 0;
                        @endphp

                        @if (! $isCancelled)
                            <div class="order-progress">
                                <div class="progress-steps">
                                    <div class="progress-fill" style="width: {{ $fillPct }}%;"></div>
                                    @foreach ($steps as $key => $step)
                                        @php
                                            $stepIndex = array_search($key, $statusOrder);
                                            $isDone    = $currentIndex !== false && $stepIndex < $currentIndex;
                                            $isActive  = $currentIndex !== false && $stepIndex === $currentIndex;
                                            $cls = $isDone ? 'done' : ($isActive ? 'active' : '');
                                        @endphp
                                        <div class="progress-step {{ $cls }}">
                                            <div class="step-dot">
                                                @if ($isDone)
                                                    <i class="fas fa-check" style="font-size:13px;"></i>
                                                @else
                                                    <i class="{{ $step['icon'] }}"></i>
                                                @endif
                                            </div>
                                            <span class="step-label">{{ $step['label'] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="mt-3 d-flex align-items-center gap-2"
                                 style="background:#fce4ec; padding:12px 16px; border-radius:8px; font-size:13px; color:#c62828;">
                                <i class="fas fa-times-circle"></i>
                                <strong>This order was cancelled.</strong>
                            </div>
                        @endif
                    </div>
                    {{-- /.order-hero --}}

                    {{-- ── Order Items ───── --}}
                    <div class="detail-card">
                        <div class="detail-card-head">
                            <h5><i class='bx bx-list-ul'></i> Order Items</h5>
                            <span style="font-size:13px; color:#888;">{{ $order->items->count() }} item{{ $order->items->count() !== 1 ? 's' : '' }}</span>
                        </div>
                        <div class="detail-card-body">
                            <table class="items-table">
                                <thead>
                                    <tr>
                                        <th style="width:45%;">Product</th>
                                        <th style="text-align:center;">Qty</th>
                                        <th>Unit Price</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td>
                                                <div class="product-cell">
                                                    <div class="prod-img">
                                                        @if (isset($item->product) && $item->product->thumbnail)
                                                            <img src="{{ asset('storage/' . $item->product->thumbnail) }}"
                                                                 alt="{{ $item->product_name ?? 'Product' }}">
                                                        @else
                                                            <i class='bx bx-image-alt' style="font-size:24px;"></i>
                                                        @endif
                                                    </div>
                                                    <div class="prod-info">
                                                        <p class="prod-name">
                                                            {{ $item->product_name ?? ($item->product->name ?? 'Product') }}
                                                        </p>
                                                        @if (!empty($item->variant))
                                                            <span class="prod-variant">{{ $item->variant }}</span>
                                                        @endif
                                                        @if (!empty($item->sku))
                                                            <span class="prod-sku">SKU: {{ $item->sku }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="qty-cell">× {{ $item->quantity }}</td>
                                            <td class="price-cell">${{ number_format($item->price, 2) }}</td>
                                            <td class="subtotal-cell">${{ number_format($item->price * $item->quantity, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- ── Price Summary ── --}}
                            <div class="price-summary">
                                @php
                                    $subtotal  = $order->items->sum(fn($i) => $i->price * $i->quantity);
                                    $discount  = max(0, $subtotal - $order->total_amount);
                                @endphp
                                <div class="price-row">
                                    <span class="label">Subtotal</span>
                                    <span class="value">${{ number_format($subtotal, 2) }}</span>
                                </div>
                                @if ($discount > 0)
                                    <div class="price-row">
                                        <span class="label">Discount</span>
                                        <span class="value text-success">- ${{ number_format($discount, 2) }}</span>
                                    </div>
                                @endif
                                <div class="price-row">
                                    <span class="label">Shipping</span>
                                    <span class="value" style="color:#2e7d32;">Free</span>
                                </div>
                                <div class="price-row total-row">
                                    <span class="label">Total</span>
                                    <span class="value">${{ number_format($order->total_amount, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- /.order items --}}

                    {{-- ── Info Row: Shipping + Payment ── --}}
                    <div class="detail-card">
                        <div class="detail-card-head">
                            <h5><i class='bx bx-info-circle'></i> Order Information</h5>
                        </div>
                        <div class="detail-card-body">
                            <div class="info-grid">

                                {{-- Shipping Address --}}
                                <div>
                                    <p class="info-label">Shipping Address</p>
                                    @if ($order->address)
                                        <div class="info-value">
                                            <strong>{{ $order->address->full_name ?? (auth()->user()->first_name . ' ' . auth()->user()->last_name) }}</strong><br>
                                            {{ $order->address->address_line_1 ?? '' }}
                                            @if (!empty($order->address->address_line_2))
                                                , {{ $order->address->address_line_2 }}
                                            @endif
                                            <br>
                                            {{ $order->address->city ?? '' }}{{ !empty($order->address->state) ? ', ' . $order->address->state : '' }}
                                            {{ $order->address->postal_code ?? '' }}<br>
                                            {{ $order->address->country ?? '' }}
                                            @if (!empty($order->address->phone))
                                                <br><i class="fas fa-phone me-1" style="font-size:11px; color:#DB4444;"></i>{{ $order->address->phone }}
                                            @endif
                                        </div>
                                    @else
                                        <div class="info-value" style="color:#bbb;">Address not available</div>
                                    @endif
                                </div>

                                {{-- Payment --}}
                                <div>
                                    <p class="info-label">Payment Method</p>
                                    <div class="info-value">
                                        @php
                                            $pmIcons = [
                                                'cod'          => 'bx bx-money',
                                                'cash_on_delivery' => 'bx bx-money',
                                                'card'         => 'bx bx-credit-card',
                                                'online'       => 'bx bx-credit-card',
                                                'wallet'       => 'bx bxs-wallet',
                                                'upi'          => 'bx bx-qr',
                                                'bank_transfer'=> 'bx bx-transfer',
                                            ];
                                            $pmKey  = strtolower(str_replace(' ', '_', $order->payment_method ?? ''));
                                            $pmIcon = $pmIcons[$pmKey] ?? 'bx bx-credit-card';
                                        @endphp
                                        <i class="{{ $pmIcon }} payment-icon"></i>
                                        {{ ucwords(str_replace(['_','-'], ' ', $order->payment_method ?? 'N/A')) }}
                                    </div>

                                    <p class="info-label mt-4">Order Date</p>
                                    <div class="info-value">
                                        <i class="far fa-calendar me-1" style="color:#DB4444;"></i>
                                        {{ $order->placed_at ? $order->placed_at->format('d M Y, h:i A') : 'N/A' }}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- /.info card --}}

                    {{-- ── Delivery Partner (if assigned) ─ --}}
                    @if ($order->deliveryPartnerPickup && $order->deliveryPartnerPickup->deliveryPartner)
                        @php $dp = $order->deliveryPartnerPickup->deliveryPartner; @endphp
                        <div class="detail-card">
                            <div class="detail-card-head">
                                <h5><i class='bx bx-map'></i> Delivery Information</h5>
                                <span class="status-badge status-shipped" style="font-size:12px;">
                                    {{ ucfirst($order->deliveryPartnerPickup->status ?? 'Assigned') }}
                                </span>
                            </div>
                            <div class="detail-card-body">
                                <div class="delivery-partner-card">
                                    <div class="dp-avatar">
                                        {{ strtoupper(substr($dp->name ?? 'D', 0, 1)) }}
                                    </div>
                                    <div class="dp-info">
                                        <h6>{{ $dp->name ?? 'Delivery Partner' }}</h6>
                                        <p>
                                            @if (!empty($dp->phone))
                                                <i class="fas fa-phone me-1" style="font-size:11px;"></i>{{ $dp->phone }}
                                            @endif
                                            @if (!empty($dp->vehicle_number))
                                                &nbsp;·&nbsp; <i class="fas fa-motorcycle me-1" style="font-size:11px;"></i>{{ $dp->vehicle_number }}
                                            @endif
                                        </p>
                                    </div>
                                    @if (!empty($order->deliveryPartnerPickup->picked_at))
                                        <div class="dp-status">
                                            <div style="font-size:11px; color:#888; text-align:right;">Picked up</div>
                                            <div style="font-size:13px; font-weight:600; color:#333;">
                                                {{ \Carbon\Carbon::parse($order->deliveryPartnerPickup->picked_at)->format('d M, h:i A') }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                </div>{{-- /.col --}}
            </div>{{-- /.row --}}
        </div>{{-- /.container --}}
    </section>

    @include('includes.footer')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/mobile.js"></script>
</body>
</html>