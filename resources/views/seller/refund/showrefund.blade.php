{{-- resources/views/seller/refund/showrefund.blade.php --}}
@php
    $seller = Auth::guard('seller')->user();

    $statusConfig = [
        'pending'  => ['label' => 'Pending',  'color' => 'amber',  'icon' => '🕐', 'bg' => 'rgba(245,158,11,.10)',  'fg' => '#92680a',  'border' => 'rgba(245,158,11,.25)'],
        'approved' => ['label' => 'Approved', 'color' => 'green',  'icon' => '✅', 'bg' => 'rgba(34,196,122,.10)',  'fg' => '#0d9a5e',  'border' => 'rgba(34,196,122,.25)'],
        'rejected' => ['label' => 'Rejected', 'color' => 'red',    'icon' => '❌', 'bg' => 'rgba(244,63,94,.10)',   'fg' => '#c0213a',  'border' => 'rgba(244,63,94,.25)'],
        'refunded' => ['label' => 'Refunded', 'color' => 'blue',   'icon' => '💸', 'bg' => 'rgba(91,124,250,.10)',  'fg' => '#3a5fd9',  'border' => 'rgba(91,124,250,.25)'],
    ];

    $sc = $statusConfig[$refund->status] ?? $statusConfig['pending'];

    $validTransitions = [
        'pending'  => ['approved', 'rejected'],
        'approved' => ['refunded', 'pending'],
        'rejected' => ['pending'],
        'refunded' => [],
    ];
    $nextStatuses = $validTransitions[$refund->status] ?? [];

    $product  = $refund->orderItem?->product;
    $order    = $refund->order;
    $customer = $refund->user;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refund #{{ $refund->refund_id }} — Seller Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #f0f2f7;
            --surface:   #ffffff;
            --card:      #ffffff;
            --border:    #e4e7ef;
            --border2:   #d1d5e0;
            --muted:     #e8eaf0;
            --text:      #1a1d28;
            --sub:       #7a82a0;
            --accent:    #5b7cfa;
            --accent2:   #22c47a;
            --accent3:   #f59e0b;
            --danger:    #f43f5e;
            --purple:    #8b5cf6;
            --font:      'DM Sans', sans-serif;
            --mono:      'DM Mono', monospace;
            --radius:    14px;
            --sidebar-w: 240px;
            --header-h:  64px;
            --shadow:    0 1px 4px rgba(0,0,0,.06), 0 4px 16px rgba(0,0,0,.04);
            --shadow-md: 0 2px 8px rgba(0,0,0,.08), 0 8px 24px rgba(0,0,0,.06);
        }

        html, body { height: 100%; background: var(--bg); color: var(--text); font-family: var(--font); font-size: 14px; }

        /* ── LAYOUT ── */
        .layout { display: grid; grid-template-columns: var(--sidebar-w) 1fr; grid-template-rows: var(--header-h) 1fr; min-height: 100vh; }

        /* ── SIDEBAR ── */
        .sidebar {
            grid-row: 1 / -1;
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex; flex-direction: column;
            position: sticky; top: 0; height: 100vh;
        }
        .sidebar-logo {
            height: var(--header-h);
            display: flex; align-items: center; gap: 10px;
            padding: 0 20px; border-bottom: 1px solid var(--border);
            font-weight: 700; font-size: 15px; letter-spacing: -.3px; color: var(--text);
        }
        .sidebar-logo .logo-icon {
            width: 32px; height: 32px; border-radius: 8px;
            background: linear-gradient(135deg, var(--accent), #8b5cf6);
            display: flex; align-items: center; justify-content: center; font-size: 16px;
        }
        .sidebar-nav { flex: 1; padding: 16px 12px; display: flex; flex-direction: column; gap: 2px; overflow-y: auto; }
        .nav-section-label { font-size: 10px; font-weight: 700; letter-spacing: 1.2px; color: var(--sub); text-transform: uppercase; padding: 12px 8px 6px; }
        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 12px; border-radius: 9px;
            color: var(--sub); text-decoration: none; font-size: 13.5px; font-weight: 500;
            transition: all .15s;
        }
        .nav-item:hover { background: var(--bg); color: var(--text); }
        .nav-item.active { background: rgba(91,124,250,.10); color: var(--accent); }
        .nav-item .icon { width: 18px; text-align: center; font-size: 15px; }
        .sidebar-footer { padding: 16px 12px; border-top: 1px solid var(--border); }
        .seller-card {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px; border-radius: 10px;
            background: var(--bg); border: 1px solid var(--border);
        }
        .avatar {
            width: 34px; height: 34px; border-radius: 50%;
            background: linear-gradient(135deg, var(--accent2), var(--accent));
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 13px; color: #fff; flex-shrink: 0;
        }
        .seller-card .info { flex: 1; min-width: 0; }
        .seller-card .info .sname { font-size: 13px; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: var(--text); }
        .seller-card .info .srole { font-size: 11px; color: var(--sub); }
        .status-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--accent2); flex-shrink: 0; box-shadow: 0 0 6px var(--accent2); }

        /* ── HEADER ── */
        .header {
            grid-column: 2; height: var(--header-h);
            background: var(--surface); border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 28px; position: sticky; top: 0; z-index: 10;
        }
        .breadcrumb { display: flex; align-items: center; gap: 6px; font-size: 13px; color: var(--sub); }
        .breadcrumb a { color: var(--sub); text-decoration: none; transition: color .15s; }
        .breadcrumb a:hover { color: var(--accent); }
        .breadcrumb .sep { opacity: .4; }
        .breadcrumb .current { color: var(--text); font-weight: 600; }
        .header-right { display: flex; align-items: center; gap: 10px; }

        /* ── BUTTONS ── */
        .btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 16px; border-radius: 9px; font-size: 13px; font-weight: 600;
            cursor: pointer; transition: all .15s; text-decoration: none; border: none; font-family: var(--font);
        }
        .btn-primary { background: var(--accent); color: #fff; box-shadow: 0 2px 8px rgba(91,124,250,.3); }
        .btn-primary:hover { opacity: .88; transform: translateY(-1px); }
        .btn-ghost { background: var(--bg); color: var(--text); border: 1px solid var(--border); }
        .btn-ghost:hover { border-color: var(--border2); box-shadow: var(--shadow); }
        .btn-success { background: rgba(34,196,122,.12); color: #0d9a5e; border: 1px solid rgba(34,196,122,.3); }
        .btn-success:hover { background: rgba(34,196,122,.20); }
        .btn-danger  { background: rgba(244,63,94,.10); color: var(--danger); border: 1px solid rgba(244,63,94,.25); }
        .btn-danger:hover  { background: rgba(244,63,94,.18); }
        .btn-amber   { background: rgba(245,158,11,.10); color: #92680a; border: 1px solid rgba(245,158,11,.3); }
        .btn-amber:hover   { background: rgba(245,158,11,.18); }
        .btn-blue    { background: rgba(91,124,250,.10); color: var(--accent); border: 1px solid rgba(91,124,250,.3); }
        .btn-blue:hover    { background: rgba(91,124,250,.18); }
        .btn-sm { padding: 6px 12px; font-size: 12px; border-radius: 7px; }

        /* ── MAIN ── */
        .main { grid-column: 2; padding: 28px; overflow-y: auto; }

        /* ── FLASH MESSAGES ── */
        .flash {
            padding: 13px 18px; border-radius: 10px; font-size: 13px;
            margin-bottom: 20px; display: flex; align-items: center; gap: 10px;
        }
        .flash-success { background: rgba(34,196,122,.08); border: 1px solid rgba(34,196,122,.25); color: #0d9a5e; }
        .flash-error   { background: rgba(244,63,94,.07);  border: 1px solid rgba(244,63,94,.2);   color: #c0213a; }

        /* ── STATUS HERO ── */
        .status-hero {
            border-radius: var(--radius);
            padding: 22px 26px;
            margin-bottom: 22px;
            display: flex; align-items: center; justify-content: space-between;
            border: 1px solid;
            animation: fadeUp .35s ease both;
        }
        .status-hero-left { display: flex; align-items: center; gap: 16px; }
        .status-icon-big {
            width: 52px; height: 52px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; flex-shrink: 0;
        }
        .status-hero-title { font-size: 18px; font-weight: 700; color: var(--text); }
        .status-hero-sub   { font-size: 12.5px; color: var(--sub); margin-top: 3px; font-family: var(--mono); }
        .status-badge {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 12px; font-weight: 700; padding: 5px 14px;
            border-radius: 20px; border: 1px solid;
        }
        .status-badge-dot { width: 7px; height: 7px; border-radius: 50%; }

        /* ── CONTENT GRID ── */
        .content-grid { display: grid; grid-template-columns: 1fr 320px; gap: 20px; }

        /* ── CARD ── */
        .card {
            background: var(--card); border: 1px solid var(--border);
            border-radius: var(--radius); box-shadow: var(--shadow);
            margin-bottom: 18px; overflow: hidden;
            animation: fadeUp .35s ease both;
        }
        .card-header {
            display: flex; align-items: center; gap: 10px;
            padding: 16px 22px; border-bottom: 1px solid var(--border);
        }
        .card-header-icon { font-size: 15px; }
        .card-header-title { font-size: 13.5px; font-weight: 700; color: var(--text); }
        .card-header-badge {
            margin-left: auto; font-size: 11px; font-weight: 700;
            padding: 3px 8px; border-radius: 20px;
            background: var(--bg); color: var(--sub); border: 1px solid var(--border);
        }
        .card-body { padding: 22px; }

        /* ── DETAIL ROW ── */
        .detail-list { display: flex; flex-direction: column; gap: 0; }
        .detail-row {
            display: flex; align-items: flex-start; justify-content: space-between;
            padding: 12px 0; border-bottom: 1px solid var(--border); gap: 16px;
        }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { font-size: 11.5px; font-weight: 700; color: var(--sub); text-transform: uppercase; letter-spacing: .6px; min-width: 130px; padding-top: 1px; }
        .detail-value { font-size: 13.5px; font-weight: 600; color: var(--text); text-align: right; flex: 1; }
        .detail-value.mono { font-family: var(--mono); font-size: 12.5px; }
        .detail-value.muted { color: var(--sub); font-weight: 500; font-style: italic; }

        /* ── PRODUCT BLOCK ── */
        .product-block {
            display: flex; align-items: center; gap: 14px;
            padding: 16px; background: var(--bg); border-radius: 11px;
            border: 1px solid var(--border);
        }
        .product-thumb {
            width: 68px; height: 68px; border-radius: 10px;
            object-fit: cover; border: 1px solid var(--border);
            background: var(--muted); flex-shrink: 0;
        }
        .product-thumb-placeholder {
            width: 68px; height: 68px; border-radius: 10px;
            background: var(--muted); border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; flex-shrink: 0;
        }
        .product-name  { font-size: 14px; font-weight: 700; color: var(--text); margin-bottom: 4px; }
        .product-meta  { font-size: 12px; color: var(--sub); display: flex; flex-wrap: wrap; gap: 8px; }
        .product-meta span { display: flex; align-items: center; gap: 4px; }

        /* ── CHIP ── */
        .chip {
            display: inline-flex; align-items: center; gap: 5px;
            font-size: 11.5px; font-weight: 600; padding: 3px 10px;
            border-radius: 20px; border: 1px solid;
        }
        .chip-amber  { background: rgba(245,158,11,.10); color: #92680a;   border-color: rgba(245,158,11,.3); }
        .chip-green  { background: rgba(34,196,122,.10); color: #0d9a5e;   border-color: rgba(34,196,122,.3); }
        .chip-red    { background: rgba(244,63,94,.10);  color: var(--danger); border-color: rgba(244,63,94,.25); }
        .chip-blue   { background: rgba(91,124,250,.10); color: var(--accent); border-color: rgba(91,124,250,.25); }

        /* ── CUSTOMER BLOCK ── */
        .customer-block {
            display: flex; align-items: center; gap: 12px;
        }
        .customer-avatar {
            width: 42px; height: 42px; border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--purple));
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; font-weight: 700; color: #fff; flex-shrink: 0;
        }
        .customer-name  { font-size: 14px; font-weight: 700; color: var(--text); }
        .customer-email { font-size: 12px; color: var(--sub); margin-top: 2px; font-family: var(--mono); }

        /* ── REASON BOX ── */
        .reason-box {
            background: rgba(245,158,11,.06); border: 1px solid rgba(245,158,11,.2);
            border-left: 4px solid var(--accent3);
            border-radius: 0 10px 10px 0;
            padding: 14px 16px;
            font-size: 13.5px; line-height: 1.65; color: var(--text);
        }

        /* ── NOTES BOX ── */
        .notes-box {
            background: rgba(91,124,250,.05); border: 1px solid rgba(91,124,250,.18);
            border-left: 4px solid var(--accent);
            border-radius: 0 10px 10px 0;
            padding: 14px 16px;
            font-size: 13.5px; line-height: 1.65; color: var(--text);
        }
        .notes-empty { font-size: 13px; color: var(--sub); font-style: italic; }

        /* ── TIMELINE ── */
        .timeline { display: flex; flex-direction: column; gap: 0; position: relative; }
        .timeline::before {
            content: ''; position: absolute;
            left: 14px; top: 14px; bottom: 14px;
            width: 2px; background: var(--border);
        }
        .tl-item { display: flex; align-items: flex-start; gap: 14px; padding: 10px 0; position: relative; }
        .tl-dot {
            width: 28px; height: 28px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; flex-shrink: 0;
            border: 2px solid var(--surface);
            position: relative; z-index: 1;
        }
        .tl-dot.active-dot { background: var(--accent); color: #fff; box-shadow: 0 0 0 4px rgba(91,124,250,.15); }
        .tl-dot.done-dot   { background: var(--accent2); color: #fff; }
        .tl-dot.pending-dot { background: var(--muted); color: var(--sub); }
        .tl-body { flex: 1; padding-top: 4px; }
        .tl-title { font-size: 13px; font-weight: 700; color: var(--text); }
        .tl-time  { font-size: 11.5px; color: var(--sub); margin-top: 2px; font-family: var(--mono); }

        /* ── UPDATE FORM ── */
        .update-form { }
        .form-group { margin-bottom: 14px; }
        .form-group:last-child { margin-bottom: 0; }
        .form-label { display: block; font-size: 11px; font-weight: 700; color: var(--sub); text-transform: uppercase; letter-spacing: .6px; margin-bottom: 7px; }
        select, input[type="number"], textarea {
            width: 100%; padding: 9px 12px;
            border: 1.5px solid var(--border); border-radius: 9px;
            font-family: var(--font); font-size: 13.5px; color: var(--text);
            background: var(--surface); outline: none; transition: border-color .15s, box-shadow .15s;
        }
        select:focus, input[type="number"]:focus, textarea:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(91,124,250,.12);
        }
        textarea { resize: vertical; min-height: 80px; line-height: 1.6; }
        .input-addon { display: flex; }
        .input-addon .addon {
            padding: 0 11px; background: var(--bg); border: 1.5px solid var(--border);
            border-right: none; border-radius: 9px 0 0 9px;
            display: flex; align-items: center; font-size: 13px; font-weight: 600; color: var(--sub);
        }
        .input-addon input { border-radius: 0 9px 9px 0; }

        /* ── DIVIDER ── */
        .divider { border: none; border-top: 1px solid var(--border); margin: 16px 0; }

        /* ── ORDER AMOUNT ROW ── */
        .amount-row {
            display: flex; align-items: center; justify-content: space-between;
            padding: 10px 14px; border-radius: 9px;
            background: var(--bg); border: 1px solid var(--border);
            margin-bottom: 8px;
        }
        .amount-row:last-child { margin-bottom: 0; }
        .amount-label { font-size: 12.5px; font-weight: 600; color: var(--sub); }
        .amount-val   { font-size: 14px; font-weight: 700; color: var(--text); font-family: var(--mono); }
        .amount-val.highlight { color: var(--accent); font-size: 16px; }

        /* ── STICKY CARD ── */
        .sticky-card { position: sticky; top: calc(var(--header-h) + 20px); }

        /* ── ANIMATION ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .card:nth-child(2) { animation-delay: .05s; }
        .card:nth-child(3) { animation-delay: .10s; }
        .card:nth-child(4) { animation-delay: .15s; }
    </style>
</head>
<body>
<div class="layout">

    {{-- ── SIDEBAR ── --}}
    <aside class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-icon">🛍️</div>
            SellerHub
        </div>
        <nav class="sidebar-nav">
            <div class="nav-section-label">Main</div>
            <a href="{{ route('seller.dashboard') }}" class="nav-item"><span class="icon">📊</span> Dashboard</a>
            <a href="{{ route('seller.products.index') }}" class="nav-item"><span class="icon">📦</span> Products</a>
            <a href="#" class="nav-item"><span class="icon">🛒</span> Orders</a>
            <div class="nav-section-label">Finance</div>
            <a href="#" class="nav-item"><span class="icon">💰</span> Earnings</a>
            <a href="#" class="nav-item"><span class="icon">🔗</span> Affiliates</a>
            <div class="nav-section-label">Support</div>
            <a href="{{ route('seller.refunds.index') }}" class="nav-item active"><span class="icon">↩️</span> Refunds</a>
            <a href="#" class="nav-item"><span class="icon">⭐</span> Reviews</a>
            <a href="#" class="nav-item"><span class="icon">⚙️</span> Settings</a>
        </nav>
        <div class="sidebar-footer">
            <div class="seller-card">
                <div class="avatar">{{ strtoupper(substr($seller->shop_name ?? $seller->name, 0, 1)) }}</div>
                <div class="info">
                    <div class="sname">{{ $seller->shop_name ?? $seller->name }}</div>
                    <div class="srole">Seller Account</div>
                </div>
                <div class="status-dot"></div>
            </div>
        </div>
    </aside>

    {{-- ── HEADER ── --}}
    <header class="header">
        <div class="breadcrumb">
            <a href="{{ route('seller.dashboard') }}">Dashboard</a>
            <span class="sep">›</span>
            <a href="{{ route('seller.refunds.index') }}">Refunds</a>
            <span class="sep">›</span>
            <span class="current">#{{ $refund->refund_id }}</span>
        </div>
        <div class="header-right">
            @if($order)
                <a href="#" class="btn btn-ghost btn-sm">🧾 View Order</a>
            @endif
            <a href="{{ route('seller.refunds.index') }}" class="btn btn-ghost btn-sm">← Back to Refunds</a>
        </div>
    </header>

    {{-- ── MAIN ── --}}
    <main class="main">

        {{-- FLASH --}}
        @if(session('success'))
            <div class="flash flash-success">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="flash flash-error">⚠️ {{ session('error') }}</div>
        @endif

        {{-- STATUS HERO --}}
        <div class="status-hero" style="background: {{ $sc['bg'] }}; border-color: {{ $sc['border'] }};">
            <div class="status-hero-left">
                <div class="status-icon-big" style="background: {{ $sc['bg'] }}; border: 1.5px solid {{ $sc['border'] }};">
                    {{ $sc['icon'] }}
                </div>
                <div>
                    <div class="status-hero-title">Refund Request</div>
                    <div class="status-hero-sub">
                        ID: {{ $refund->refund_id }}
                        &nbsp;·&nbsp;
                        SL: #{{ $refund->sl_no }}
                        &nbsp;·&nbsp;
                        Requested {{ $refund->requested_at ? \Carbon\Carbon::parse($refund->requested_at)->diffForHumans() : '—' }}
                    </div>
                </div>
            </div>
            <div class="status-badge" style="background: {{ $sc['bg'] }}; color: {{ $sc['fg'] }}; border-color: {{ $sc['border'] }};">
                <span class="status-badge-dot" style="background: {{ $sc['fg'] }};"></span>
                {{ strtoupper($sc['label']) }}
            </div>
        </div>

        {{-- CONTENT GRID --}}
        <div class="content-grid">

            {{-- ════════ LEFT ════════ --}}
            <div>

                {{-- PRODUCT & ORDER --}}
                <div class="card">
                    <div class="card-header">
                        <span class="card-header-icon">📦</span>
                        <span class="card-header-title">Product & Order Details</span>
                        @if($order)
                            <span class="card-header-badge" style="font-family: var(--mono);">Order #{{ $order->sl_no ?? $order->id }}</span>
                        @endif
                    </div>
                    <div class="card-body">
                        {{-- Product --}}
                        @if($product)
                        <div class="product-block" style="margin-bottom:20px;">
                            @if($product->thumbnail)
                                <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->name }}" class="product-thumb">
                            @else
                                <div class="product-thumb-placeholder">🛒</div>
                            @endif
                            <div style="flex:1; min-width:0;">
                                <div class="product-name">{{ $product->name }}</div>
                                <div class="product-meta">
                                    @if($product->sku)
                                        <span>🏷️ SKU: <span style="font-family:var(--mono);">{{ $product->sku }}</span></span>
                                    @endif
                                    @if($product->category)
                                        <span>🗂️ {{ $product->category->name }}</span>
                                    @endif
                                    @if($product->brand)
                                        <span>🔖 {{ $product->brand->name }}</span>
                                    @endif
                                </div>
                            </div>
                            <a href="{{ route('seller.products.show', $product->id) }}" class="btn btn-ghost btn-sm" style="flex-shrink:0;">View →</a>
                        </div>
                        @else
                        <div style="padding:14px; background:var(--muted); border-radius:10px; font-size:13px; color:var(--sub); margin-bottom:20px;">
                            ⚠️ Product details unavailable.
                        </div>
                        @endif

                        {{-- Order Meta --}}
                        <div class="detail-list">
                            <div class="detail-row">
                                <span class="detail-label">Order ID</span>
                                <span class="detail-value mono">
                                    @if($order) #{{ $order->sl_no ?? $order->id }} @else — @endif
                                </span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Order Item ID</span>
                                <span class="detail-value mono">{{ $refund->order_item_id ?? '—' }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Item Price</span>
                                <span class="detail-value">
                                    @if($refund->orderItem && $refund->orderItem->price)
                                        {{ number_format($refund->orderItem->price, 2) }}
                                    @else
                                        —
                                    @endif
                                </span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Qty Ordered</span>
                                <span class="detail-value">{{ $refund->orderItem->quantity ?? '—' }}</span>
                            </div>
                            @if($order && $order->created_at)
                            <div class="detail-row">
                                <span class="detail-label">Order Date</span>
                                <span class="detail-value">{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y · H:i') }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- REFUND REASON --}}
                <div class="card">
                    <div class="card-header">
                        <span class="card-header-icon">💬</span>
                        <span class="card-header-title">Refund Reason</span>
                    </div>
                    <div class="card-body">
                        @if($refund->reason)
                            <div class="reason-box">{{ $refund->reason }}</div>
                        @else
                            <p class="notes-empty">No reason provided by the customer.</p>
                        @endif
                    </div>
                </div>

                {{-- ADMIN NOTES --}}
                <div class="card">
                    <div class="card-header">
                        <span class="card-header-icon">📝</span>
                        <span class="card-header-title">Seller Notes</span>
                    </div>
                    <div class="card-body">
                        @if(!empty($refund->admin_notes))
                            <div class="notes-box">{{ $refund->admin_notes }}</div>
                        @else
                            <p class="notes-empty">No notes added yet. Use the form on the right to add notes when updating status.</p>
                        @endif
                    </div>
                </div>

                {{-- TIMELINE --}}
                <div class="card">
                    <div class="card-header">
                        <span class="card-header-icon">🕓</span>
                        <span class="card-header-title">Status Timeline</span>
                    </div>
                    <div class="card-body">
                        @php
                            $allSteps = [
                                ['key' => 'pending',  'label' => 'Request Submitted', 'icon' => '📋'],
                                ['key' => 'approved', 'label' => 'Approved',          'icon' => '✅'],
                                ['key' => 'refunded', 'label' => 'Refunded',          'icon' => '💸'],
                            ];
                            $statusOrder = ['pending' => 0, 'approved' => 1, 'refunded' => 2];
                            $currentPos  = $statusOrder[$refund->status] ?? ($refund->status === 'rejected' ? -1 : 0);
                        @endphp

                        @if($refund->status === 'rejected')
                        <div class="timeline">
                            <div class="tl-item">
                                <div class="tl-dot done-dot">📋</div>
                                <div class="tl-body">
                                    <div class="tl-title">Request Submitted</div>
                                    <div class="tl-time">{{ $refund->requested_at ? \Carbon\Carbon::parse($refund->requested_at)->format('M d, Y · H:i') : '—' }}</div>
                                </div>
                            </div>
                            <div class="tl-item">
                                <div class="tl-dot" style="background:var(--danger); color:#fff; border:2px solid var(--surface);">❌</div>
                                <div class="tl-body">
                                    <div class="tl-title" style="color:var(--danger);">Rejected</div>
                                    <div class="tl-time">{{ $refund->processed_at ? \Carbon\Carbon::parse($refund->processed_at)->format('M d, Y · H:i') : 'Recently' }}</div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="timeline">
                            @foreach($allSteps as $step)
                            @php $pos = $statusOrder[$step['key']] ?? 0; @endphp
                            <div class="tl-item">
                                <div class="tl-dot {{ $pos < $currentPos ? 'done-dot' : ($pos === $currentPos ? 'active-dot' : 'pending-dot') }}">
                                    @if($pos < $currentPos) ✓
                                    @elseif($pos === $currentPos) {{ $step['icon'] }}
                                    @else ○
                                    @endif
                                </div>
                                <div class="tl-body">
                                    <div class="tl-title">{{ $step['label'] }}</div>
                                    <div class="tl-time">
                                        @if($pos === 0 && $refund->requested_at)
                                            {{ \Carbon\Carbon::parse($refund->requested_at)->format('M d, Y · H:i') }}
                                        @elseif($pos > 0 && $pos <= $currentPos && $refund->processed_at)
                                            {{ \Carbon\Carbon::parse($refund->processed_at)->format('M d, Y · H:i') }}
                                        @else
                                            Awaiting
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>

            </div>

            {{-- ════════ RIGHT ════════ --}}
            <div>

                {{-- STICKY WRAPPER --}}
                <div class="sticky-card">

                    {{-- REFUND AMOUNTS --}}
                    <div class="card">
                        <div class="card-header">
                            <span class="card-header-icon">💰</span>
                            <span class="card-header-title">Refund Amount</span>
                        </div>
                        <div class="card-body">
                            @php
                                $itemTotal = $refund->orderItem ? ($refund->orderItem->price * ($refund->orderItem->quantity ?? 1)) : 0;
                            @endphp
                            <div class="amount-row">
                                <span class="amount-label">Item Total</span>
                                <span class="amount-val">{{ number_format($itemTotal, 2) }}</span>
                            </div>
                            <div class="amount-row">
                                <span class="amount-label">Refund Amount</span>
                                <span class="amount-val highlight">
                                    @if(isset($refund->refund_amount) && $refund->refund_amount !== null)
                                        {{ number_format($refund->refund_amount, 2) }}
                                    @else
                                        <span style="font-size:12px; color:var(--sub); font-weight:500;">Not set</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- CUSTOMER INFO --}}
                    <div class="card">
                        <div class="card-header">
                            <span class="card-header-icon">👤</span>
                            <span class="card-header-title">Customer</span>
                        </div>
                        <div class="card-body">
                            @if($customer)
                            <div class="customer-block" style="margin-bottom:16px;">
                                <div class="customer-avatar">{{ strtoupper(substr($customer->name, 0, 1)) }}</div>
                                <div>
                                    <div class="customer-name">{{ $customer->name }}</div>
                                    <div class="customer-email">{{ $customer->email }}</div>
                                </div>
                            </div>
                            <div class="detail-list">
                                <div class="detail-row" style="padding:9px 0;">
                                    <span class="detail-label">User ID</span>
                                    <span class="detail-value mono">{{ $customer->id }}</span>
                                </div>
                                @if($customer->phone ?? false)
                                <div class="detail-row" style="padding:9px 0;">
                                    <span class="detail-label">Phone</span>
                                    <span class="detail-value mono">{{ $customer->phone }}</span>
                                </div>
                                @endif
                            </div>
                            @else
                            <p class="notes-empty">Customer info unavailable.</p>
                            @endif
                        </div>
                    </div>

                    {{-- UPDATE STATUS --}}
                    @if(count($nextStatuses) > 0)
                    <div class="card">
                        <div class="card-header">
                            <span class="card-header-icon">🔄</span>
                            <span class="card-header-title">Update Status</span>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('seller.refunds.updateStatus', $refund->sl_no) }}">
                                @csrf
                                @method('PATCH')

                                <div class="form-group">
                                    <label class="form-label">New Status</label>
                                    <select name="status" id="statusSelect" required>
                                        <option value="">— Select status —</option>
                                        @foreach($nextStatuses as $ns)
                                            @php
                                                $nsConf = $statusConfig[$ns];
                                            @endphp
                                            <option value="{{ $ns }}">{{ $nsConf['icon'] }}  {{ ucfirst($ns) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group" id="refundAmountGroup" style="display:none;">
                                    <label class="form-label">Refund Amount</label>
                                    <div class="input-addon">
                                        <span class="addon">₦</span>
                                        <input type="number" name="refund_amount" step="0.01" min="0"
                                               value="{{ $refund->refund_amount ?? $itemTotal }}"
                                               placeholder="0.00">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Notes (optional)</label>
                                    <textarea name="notes" placeholder="Add a note for this status update…">{{ $refund->admin_notes }}</textarea>
                                </div>

                                {{-- Dynamic submit button --}}
                                <button type="submit" class="btn btn-primary" id="submitBtn" style="width:100%; justify-content:center;" disabled>
                                    Select a status to continue
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                    {{-- Terminal state card --}}
                    <div class="card">
                        <div class="card-header">
                            <span class="card-header-icon">🔒</span>
                            <span class="card-header-title">Status Locked</span>
                        </div>
                        <div class="card-body">
                            <p style="font-size:13px; color:var(--sub); line-height:1.6;">
                                This refund has been marked as <strong style="color:{{ $sc['fg'] }};">{{ $sc['label'] }}</strong>
                                and can no longer be updated.
                            </p>
                            @if($refund->processed_at)
                            <div style="margin-top:12px; padding:10px 14px; background:var(--bg); border-radius:9px; border:1px solid var(--border);">
                                <span style="font-size:11px; color:var(--sub); font-weight:700; text-transform:uppercase; letter-spacing:.6px;">Processed</span>
                                <div style="font-size:13px; font-weight:600; margin-top:3px; font-family:var(--mono);">
                                    {{ \Carbon\Carbon::parse($refund->processed_at)->format('M d, Y · H:i') }}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    {{-- METADATA ── --}}
                    <div class="card">
                        <div class="card-header">
                            <span class="card-header-icon">🗂️</span>
                            <span class="card-header-title">Metadata</span>
                        </div>
                        <div class="card-body" style="padding-top:6px; padding-bottom:6px;">
                            <div class="detail-list">
                                <div class="detail-row" style="padding:10px 0;">
                                    <span class="detail-label">Refund ID</span>
                                    <span class="detail-value mono">{{ $refund->refund_id }}</span>
                                </div>
                                <div class="detail-row" style="padding:10px 0;">
                                    <span class="detail-label">Serial No.</span>
                                    <span class="detail-value mono">{{ $refund->sl_no }}</span>
                                </div>
                                <div class="detail-row" style="padding:10px 0;">
                                    <span class="detail-label">Requested</span>
                                    <span class="detail-value">
                                        {{ $refund->requested_at ? \Carbon\Carbon::parse($refund->requested_at)->format('M d, Y') : '—' }}
                                    </span>
                                </div>
                                <div class="detail-row" style="padding:10px 0;">
                                    <span class="detail-label">Processed</span>
                                    <span class="detail-value {{ $refund->processed_at ? '' : 'muted' }}">
                                        {{ $refund->processed_at ? \Carbon\Carbon::parse($refund->processed_at)->format('M d, Y') : 'Not yet' }}
                                    </span>
                                </div>
                                <div class="detail-row" style="padding:10px 0; border-bottom:none;">
                                    <span class="detail-label">Current Status</span>
                                    <span class="chip chip-{{ $sc['color'] }}">
                                        {{ $sc['icon'] }} {{ $sc['label'] }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>{{-- /sticky-card --}}
            </div>

        </div>{{-- /content-grid --}}
    </main>
</div>

<script>
    const statusConfig = {
        approved: { label: '✅  Approve this refund',  btnClass: 'btn-success', showAmount: true  },
        rejected: { label: '❌  Reject this refund',   btnClass: 'btn-danger',  showAmount: false },
        refunded: { label: '💸  Mark as refunded',     btnClass: 'btn-blue',    showAmount: true  },
        pending:  { label: '🕐  Reset to pending',     btnClass: 'btn-amber',   showAmount: false },
    };

    const select       = document.getElementById('statusSelect');
    const submitBtn    = document.getElementById('submitBtn');
    const amountGroup  = document.getElementById('refundAmountGroup');

    if (select) {
        select.addEventListener('change', function() {
            const val  = this.value;
            const conf = statusConfig[val];

            if (!val || !conf) {
                submitBtn.disabled = true;
                submitBtn.className = 'btn btn-primary';
                submitBtn.textContent = 'Select a status to continue';
                if (amountGroup) amountGroup.style.display = 'none';
                return;
            }

            submitBtn.disabled = false;
            submitBtn.className = `btn ${conf.btnClass}`;
            submitBtn.style.width = '100%';
            submitBtn.style.justifyContent = 'center';
            submitBtn.textContent = conf.label;

            if (amountGroup) {
                amountGroup.style.display = conf.showAmount ? '' : 'none';
            }
        });
    }
</script>
</body>
</html>