{{-- resources/views/seller/dashboard.blade.php --}}
@php $seller = Auth::guard('seller')->user(); @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard — {{ $seller->shop_name }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
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
            padding: 0 20px;
            border-bottom: 1px solid var(--border);
            font-weight: 700; font-size: 15px; letter-spacing: -.3px;
            color: var(--text);
        }
        .sidebar-logo .logo-icon {
            width: 32px; height: 32px; border-radius: 8px;
            background: linear-gradient(135deg, var(--accent), #8b5cf6);
            display: flex; align-items: center; justify-content: center;
            font-size: 16px;
        }
        .sidebar-nav { flex: 1; padding: 16px 12px; display: flex; flex-direction: column; gap: 2px; overflow-y: auto; }
        .nav-section-label {
            font-size: 10px; font-weight: 700; letter-spacing: 1.2px;
            color: var(--sub); text-transform: uppercase;
            padding: 12px 8px 6px;
        }
        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 12px; border-radius: 9px;
            color: var(--sub); text-decoration: none; font-size: 13.5px; font-weight: 500;
            transition: all .15s; cursor: pointer;
        }
        .nav-item:hover { background: var(--bg); color: var(--text); }
        .nav-item.active { background: rgba(91,124,250,.10); color: var(--accent); }
        .nav-item .icon { width: 18px; text-align: center; font-size: 15px; }
        .nav-item .badge {
            margin-left: auto; background: var(--danger);
            color: #fff; font-size: 10px; font-weight: 700;
            padding: 2px 6px; border-radius: 20px;
        }
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
            grid-column: 2;
            height: var(--header-h);
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 28px;
            position: sticky; top: 0; z-index: 10;
            box-shadow: 0 1px 0 var(--border);
        }
        .header-left { display: flex; align-items: center; gap: 10px; }
        .header-title { font-size: 15px; font-weight: 700; color: var(--text); }
        .header-sub { font-size: 12px; color: var(--sub); margin-top: 1px; }
        .header-right { display: flex; align-items: center; gap: 10px; }
        .header-btn {
            width: 36px; height: 36px; border-radius: 9px;
            background: var(--bg); border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: var(--sub); font-size: 15px;
            text-decoration: none; transition: all .15s; position: relative;
        }
        .header-btn:hover { color: var(--text); border-color: var(--border2); box-shadow: var(--shadow); }
        .notif-badge {
            position: absolute; top: -3px; right: -3px;
            width: 14px; height: 14px; border-radius: 50%;
            background: var(--danger); border: 2px solid var(--surface);
            font-size: 8px; font-weight: 700; color: #fff;
            display: flex; align-items: center; justify-content: center;
        }
        .btn-primary {
            display: flex; align-items: center; gap: 6px;
            padding: 8px 16px; border-radius: 9px;
            background: var(--accent); color: #fff;
            font-size: 13px; font-weight: 600; text-decoration: none;
            border: none; cursor: pointer; transition: all .15s;
            box-shadow: 0 2px 8px rgba(91,124,250,.3);
        }
        .btn-primary:hover { opacity: .88; transform: translateY(-1px); }

        /* ── MAIN ── */
        .main { grid-column: 2; padding: 28px; overflow-y: auto; }

        /* ── METRICS GRID ── */
        .metrics { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }

        .metric-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px;
            position: relative; overflow: hidden;
            box-shadow: var(--shadow);
            animation: fadeUp .4s ease both;
        }
        .metric-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 3px;
        }
        .metric-card.blue::before   { background: linear-gradient(90deg, var(--accent), transparent); }
        .metric-card.green::before  { background: linear-gradient(90deg, var(--accent2), transparent); }
        .metric-card.amber::before  { background: linear-gradient(90deg, var(--accent3), transparent); }
        .metric-card.red::before    { background: linear-gradient(90deg, var(--danger), transparent); }

        .metric-icon {
            width: 40px; height: 40px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; margin-bottom: 14px;
        }
        .metric-card.blue  .metric-icon { background: rgba(91,124,250,.10); }
        .metric-card.green .metric-icon { background: rgba(34,196,122,.10); }
        .metric-card.amber .metric-icon { background: rgba(245,158,11,.10); }
        .metric-card.red   .metric-icon { background: rgba(244,63,94,.10); }

        .metric-label { font-size: 11.5px; color: var(--sub); font-weight: 600; text-transform: uppercase; letter-spacing: .6px; }
        .metric-value { font-size: 26px; font-weight: 700; font-family: var(--mono); margin: 4px 0 6px; letter-spacing: -1px; color: var(--text); }
        .metric-change { font-size: 11.5px; display: flex; align-items: center; gap: 4px; }
        .metric-change.up   { color: var(--accent2); }
        .metric-change.down { color: var(--danger); }

        /* ── CHARTS ROW ── */
        .charts-row { display: grid; grid-template-columns: 1.6fr 1fr; gap: 16px; margin-bottom: 24px; }

        .chart-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 22px;
            box-shadow: var(--shadow);
            animation: fadeUp .5s ease both;
        }
        .chart-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }
        .chart-title { font-size: 14px; font-weight: 700; color: var(--text); }
        .chart-sub { font-size: 12px; color: var(--sub); margin-top: 2px; }
        .period-tabs { display: flex; gap: 4px; }
        .period-tab {
            padding: 4px 10px; border-radius: 6px;
            font-size: 11.5px; font-weight: 500; cursor: pointer;
            color: var(--sub); border: 1px solid transparent; transition: all .15s;
        }
        .period-tab.active { background: var(--bg); color: var(--text); border-color: var(--border); }
        canvas { width: 100% !important; }

        /* ── BOTTOM ROW ── */
        .bottom-row { display: grid; grid-template-columns: 1.4fr 1fr; gap: 16px; }

        /* ── TABLE CARD ── */
        .table-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            animation: fadeUp .6s ease both;
        }
        .table-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 18px 22px;
            border-bottom: 1px solid var(--border);
        }
        .table-title { font-size: 14px; font-weight: 700; color: var(--text); }
        .link-btn { font-size: 12px; color: var(--accent); text-decoration: none; font-weight: 600; }
        .link-btn:hover { text-decoration: underline; }
        table { width: 100%; border-collapse: collapse; }
        th {
            padding: 10px 22px; text-align: left;
            font-size: 11px; font-weight: 700; letter-spacing: .7px; text-transform: uppercase;
            color: var(--sub); background: var(--bg);
            border-bottom: 1px solid var(--border);
        }
        td {
            padding: 13px 22px;
            font-size: 13px; color: var(--text);
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(91,124,250,.03); }

        /* ── STATUS PILLS ── */
        .pill {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 3px 9px; border-radius: 20px;
            font-size: 11px; font-weight: 700; white-space: nowrap;
        }
        .pill-delivered { background: rgba(34,196,122,.12);  color: #16a05a; }
        .pill-pending   { background: rgba(245,158,11,.12);  color: #c47d0a; }
        .pill-shipped   { background: rgba(91,124,250,.12);  color: var(--accent); }
        .pill-cancelled { background: rgba(244,63,94,.12);   color: var(--danger); }
        .pill::before { content: ''; width: 5px; height: 5px; border-radius: 50%; background: currentColor; }

        /* ── ACTIVITY CARD ── */
        .activity-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            animation: fadeUp .6s ease both;
        }
        .activity-list { padding: 6px 0; }
        .activity-item {
            display: flex; align-items: flex-start; gap: 12px;
            padding: 13px 20px;
            border-bottom: 1px solid var(--border);
            transition: background .15s;
        }
        .activity-item:last-child { border-bottom: none; }
        .activity-item:hover { background: var(--bg); }
        .act-icon {
            width: 32px; height: 32px; border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; flex-shrink: 0; margin-top: 1px;
        }
        .act-icon.order   { background: rgba(91,124,250,.12); }
        .act-icon.review  { background: rgba(245,158,11,.12); }
        .act-icon.stock   { background: rgba(244,63,94,.12); }
        .act-icon.payout  { background: rgba(34,196,122,.12); }
        .act-body .act-title { font-size: 13px; font-weight: 500; line-height: 1.3; color: var(--text); }
        .act-body .act-time  { font-size: 11px; color: var(--sub); margin-top: 3px; }

        /* ── QUICK STATS ── */
        .quick-stats { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 16px; }
        .quick-stat {
            background: var(--bg); border: 1px solid var(--border);
            border-radius: 10px; padding: 12px 14px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .qs-label { font-size: 11px; color: var(--sub); font-weight: 500; }
        .qs-value { font-size: 18px; font-weight: 700; font-family: var(--mono); margin-top: 2px; color: var(--text); }

        /* ── PROGRESS BAR ── */
        .progress-row { margin-bottom: 12px; }
        .progress-label { display: flex; justify-content: space-between; margin-bottom: 5px; font-size: 12px; }
        .progress-label span:last-child { color: var(--sub); font-size: 11px; }
        .progress-track { height: 5px; background: var(--muted); border-radius: 99px; overflow: hidden; }
        .progress-fill  { height: 100%; border-radius: 99px; transition: width 1s cubic-bezier(.4,0,.2,1); }

        /* ── WELCOME ALERT ── */
        .verify-alert {
            display: flex; align-items: center; gap: 8px;
            background: rgba(245,158,11,.08); border: 1px solid rgba(245,158,11,.25);
            border-radius: 10px; padding: 10px 16px;
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .metric-card:nth-child(1) { animation-delay: .05s; }
        .metric-card:nth-child(2) { animation-delay: .10s; }
        .metric-card:nth-child(3) { animation-delay: .15s; }
        .metric-card:nth-child(4) { animation-delay: .20s; }

        /* ── SCROLLBAR ── */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--border2); border-radius: 99px; }

        /* ── RESPONSIVE ── */
        @media (max-width: 1200px) {
            .metrics { grid-template-columns: repeat(2, 1fr); }
            .charts-row, .bottom-row { grid-template-columns: 1fr; }
        }
        @media (max-width: 768px) {
            :root { --sidebar-w: 0px; }
            .sidebar { display: none; }
            .layout { grid-template-columns: 1fr; }
            .header { grid-column: 1; }
            .main { grid-column: 1; padding: 16px; }
            .metrics { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
</head>
<body>
<div class="layout">

    {{-- SIDEBAR --}}
    <aside class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-icon">🛍</div>
            <span>SellerHub</span>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-section-label">Main</div>
            <a href="{{ route('seller.dashboard') }}" class="nav-item active">
                <span class="icon">▦</span> Dashboard
            </a>
            <a href="{{ route('seller.products.index') }}" class="nav-item">
                <span class="icon">📦</span> Products
            </a>
            <a href="{{ route('seller.orders.index') }}" class="nav-item">
                <span class="icon">🛒</span> Orders
                <span class="badge">3</span>
            </a>
            <div class="nav-section-label">Finance</div>
            <a href="#" class="nav-item"><span class="icon">💳</span> Payouts</a>
            <a href="#" class="nav-item"><span class="icon">📊</span> Analytics</a>
            <div class="nav-section-label">Store</div>
            <a href="{{ route('seller.profile') }}" class="nav-item"><span class="icon">🏪</span> Shop Profile</a>
            <a href="#" class="nav-item"><span class="icon">⭐</span> Reviews</a>
            <a href="{{ route('seller.refunds.index') }}" class="nav-item"><span class="icon">↩️</span> Refunds</a>
            <a href="#" class="nav-item"><span class="icon">⚙️</span> Settings</a>
        </nav>
        <div class="sidebar-footer">
            <div class="seller-card">
                <div class="avatar">{{ strtoupper(substr($seller->name, 0, 1)) }}</div>
                <div class="info">
                    <div class="sname">{{ $seller->shop_name }}</div>
                    <div class="srole">Seller · {{ ucfirst($seller->status) }}</div>
                </div>
                <div class="status-dot"></div>
            </div>
        </div>
    </aside>

    {{-- HEADER --}}
    <header class="header">
        <div class="header-left">
            <div>
                <div class="header-title">Dashboard</div>
                <div class="header-sub">{{ now()->format('l, F j, Y') }}</div>
            </div>
        </div>
        <div class="header-right">
            <a href="{{ route('seller.orders.index') }}" class="header-btn" title="Orders">
                🛒
                <span class="notif-badge">3</span>
            </a>
            <a href="#" class="header-btn" title="Notifications">🔔</a>
            <a href="{{ route('seller.products.create') }}" class="btn-primary">+ Add Product</a>
            <form method="POST" action="{{ route('seller.logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="header-btn" title="Logout">↩</button>
            </form>
        </div>
    </header>

    {{-- MAIN --}}
    <main class="main">

        {{-- Welcome Strip --}}
        <div style="margin-bottom:24px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px;">
            <div>
                <h1 style="font-size:20px; font-weight:700; letter-spacing:-.4px; color:var(--text);">
                    Good {{ now()->hour < 12 ? 'morning' : (now()->hour < 17 ? 'afternoon' : 'evening') }}, {{ $seller->name }} 👋
                </h1>
                <p style="color:var(--sub); font-size:13px; margin-top:4px;">
                    Here's what's happening with <strong style="color:var(--text)">{{ $seller->shop_name }}</strong> today.
                </p>
            </div>
            @if(!$seller->is_verified)
                <div class="verify-alert">
                    <span style="font-size:16px;">⚠️</span>
                    <div>
                        <div style="font-size:12px; font-weight:700; color:var(--accent3);">Verification Pending</div>
                        <div style="font-size:11px; color:var(--sub);">Complete your shop verification</div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Metric Cards --}}
        <div class="metrics">
            <div class="metric-card blue">
                <div class="metric-icon">📦</div>
                <div class="metric-label">Total Products</div>
                <div class="metric-value">{{ number_format($totalProducts) }}</div>
                <div class="metric-change up">↑ {{ $activeProducts }} active</div>
            </div>
            <div class="metric-card green">
                <div class="metric-icon">🛒</div>
                <div class="metric-label">Total Orders</div>
                <div class="metric-value">{{ number_format($totalOrders) }}</div>
                <div class="metric-change up">↑ Last 30 days</div>
            </div>
            <div class="metric-card amber">
                <div class="metric-icon">💰</div>
                <div class="metric-label">Total Revenue</div>
                <div class="metric-value">{{ number_format($totalRevenue, 0) }}</div>
                <div class="metric-change up">↑ Delivered orders</div>
            </div>
            <div class="metric-card red">
                <div class="metric-icon">⭐</div>
                <div class="metric-label">Seller Rating</div>
                <div class="metric-value">4.8</div>
                <div class="metric-change up">↑ Top 10%</div>
            </div>
        </div>

        {{-- Charts --}}
        <div class="charts-row">
            <div class="chart-card">
                <div class="chart-header">
                    <div>
                        <div class="chart-title">Revenue Overview</div>
                        <div class="chart-sub">Last 6 months — delivered orders</div>
                    </div>
                    <div class="period-tabs">
                        <div class="period-tab active">6M</div>
                        <div class="period-tab">1Y</div>
                        <div class="period-tab">All</div>
                    </div>
                </div>
                <canvas id="revenueChart" height="100"></canvas>
            </div>
            <div class="chart-card">
                <div class="chart-header">
                    <div>
                        <div class="chart-title">Orders Breakdown</div>
                        <div class="chart-sub">By status</div>
                    </div>
                </div>
                <canvas id="ordersDonut" height="140"></canvas>
            </div>
        </div>

        {{-- Bottom Row --}}
        <div class="bottom-row">

            {{-- Recent Orders --}}
            <div class="table-card">
                <div class="table-header">
                    <div class="table-title">Recent Orders</div>
                    <a href="{{ route('seller.orders.index') }}" class="link-btn">View all →</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Product</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $demoOrders = [
                                ['#ORD-8821', '📱 iPhone Case', '₦4,500', 'delivered'],
                                ['#ORD-8820', '🎧 Headphones', '₦12,000', 'shipped'],
                                ['#ORD-8819', '⌚ Smart Watch', '₦35,000', 'pending'],
                                ['#ORD-8818', '💻 Laptop Stand', '₦8,200', 'delivered'],
                                ['#ORD-8817', '🖱 Wireless Mouse', '₦5,500', 'cancelled'],
                            ];
                        @endphp
                        @foreach($demoOrders as [$id, $product, $amount, $status])
                            <tr>
                                <td><span style="font-family:var(--mono); font-size:12px; color:var(--accent); font-weight:600;">{{ $id }}</span></td>
                                <td>{{ $product }}</td>
                                <td style="font-family:var(--mono); font-weight:700;">{{ $amount }}</td>
                                <td><span class="pill pill-{{ $status }}">{{ ucfirst($status) }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Right Column --}}
            <div style="display:flex; flex-direction:column; gap:16px;">

                {{-- Shop Health --}}
                <div class="chart-card" style="padding:18px;">
                    <div class="chart-header" style="margin-bottom:14px;">
                        <div class="chart-title">Shop Health</div>
                    </div>
                    <div class="quick-stats">
                        <div class="quick-stat">
                            <div>
                                <div class="qs-label">Active Products</div>
                                <div class="qs-value" style="color:var(--accent2);">{{ $activeProducts }}</div>
                            </div>
                            <span style="font-size:20px;">📦</span>
                        </div>
                        <div class="quick-stat">
                            <div>
                                <div class="qs-label">Fulfilment</div>
                                <div class="qs-value" style="color:var(--accent);">96%</div>
                            </div>
                            <span style="font-size:20px;">✅</span>
                        </div>
                        <div class="quick-stat">
                            <div>
                                <div class="qs-label">Return Rate</div>
                                <div class="qs-value" style="color:var(--accent3);">2.1%</div>
                            </div>
                            <span style="font-size:20px;">↩️</span>
                        </div>
                        <div class="quick-stat">
                            <div>
                                <div class="qs-label">Avg. Rating</div>
                                <div class="qs-value" style="color:var(--accent2);">4.8</div>
                            </div>
                            <span style="font-size:20px;">⭐</span>
                        </div>
                    </div>
                    @if($seller->product_categories && count($seller->product_categories))
                        <div style="margin-top:4px;">
                            <div style="font-size:11px; color:var(--sub); margin-bottom:10px; text-transform:uppercase; letter-spacing:.6px; font-weight:700;">Your Categories</div>
                            @foreach(array_slice($seller->product_categories, 0, 3) as $i => $cat)
                                @php $pct = [72, 55, 33][$i] ?? 40; @endphp
                                <div class="progress-row">
                                    <div class="progress-label">
                                        <span style="font-size:12px; font-weight:500;">{{ $cat }}</span>
                                        <span>{{ $pct }}%</span>
                                    </div>
                                    <div class="progress-track">
                                        <div class="progress-fill" style="width:{{ $pct }}%; background:{{ ['var(--accent)','var(--accent2)','var(--accent3)'][$i] }};"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Activity Feed --}}
                <div class="activity-card">
                    <div class="table-header">
                        <div class="table-title">Recent Activity</div>
                    </div>
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="act-icon order">🛒</div>
                            <div class="act-body">
                                <div class="act-title">New order #ORD-8821 received</div>
                                <div class="act-time">2 minutes ago</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="act-icon review">⭐</div>
                            <div class="act-body">
                                <div class="act-title">5-star review on "Wireless Mouse"</div>
                                <div class="act-time">1 hour ago</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="act-icon stock">⚠️</div>
                            <div class="act-body">
                                <div class="act-title">Low stock alert — iPhone Case (2 left)</div>
                                <div class="act-time">3 hours ago</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="act-icon payout">💸</div>
                            <div class="act-body">
                                <div class="act-title">Payout of ₦24,500 processed</div>
                                <div class="act-time">Yesterday</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>

<script>
const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
const revenueRaw = @json($revenueChart);
const ordersRaw  = @json($ordersChart);
const now = new Date();
const last6 = Array.from({length: 6}, (_, i) => {
    const d = new Date(now.getFullYear(), now.getMonth() - 5 + i, 1);
    return { label: months[d.getMonth()], month: d.getMonth() + 1 };
});
const revData   = last6.map(m => revenueRaw[m.month] ?? 0);
const orderData = last6.map(m => ordersRaw[m.month]  ?? 0);
const labels    = last6.map(m => m.label);

Chart.defaults.color = '#7a82a0';
Chart.defaults.font.family = "'DM Sans', sans-serif";

const revenueCtx = document.getElementById('revenueChart').getContext('2d');
const gradient = revenueCtx.createLinearGradient(0, 0, 0, 220);
gradient.addColorStop(0, 'rgba(91,124,250,0.20)');
gradient.addColorStop(1, 'rgba(91,124,250,0.00)');

new Chart(revenueCtx, {
    type: 'line',
    data: {
        labels,
        datasets: [
            {
                label: 'Revenue',
                data: revData,
                borderColor: '#5b7cfa',
                backgroundColor: gradient,
                fill: true, tension: .45,
                pointRadius: 4, pointBackgroundColor: '#5b7cfa',
                pointBorderColor: '#fff', pointBorderWidth: 2, borderWidth: 2.5,
            },
            {
                label: 'Orders',
                data: orderData,
                borderColor: '#22c47a',
                backgroundColor: 'transparent',
                fill: false, tension: .45,
                pointRadius: 4, pointBackgroundColor: '#22c47a',
                pointBorderColor: '#fff', pointBorderWidth: 2,
                borderWidth: 2, borderDash: [5, 4],
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'top', labels: { boxWidth: 10, padding: 16, font: { size: 12 } } },
            tooltip: { backgroundColor: '#fff', borderColor: '#e4e7ef', borderWidth: 1, padding: 10, titleColor: '#1a1d28', bodyColor: '#7a82a0' }
        },
        scales: {
            x: { grid: { color: '#f0f2f7' }, border: { display: false } },
            y: { grid: { color: '#f0f2f7' }, border: { display: false } }
        }
    }
});

new Chart(document.getElementById('ordersDonut').getContext('2d'), {
    type: 'doughnut',
    data: {
        labels: ['Delivered', 'Shipped', 'Pending', 'Cancelled'],
        datasets: [{
            data: [62, 18, 14, 6],
            backgroundColor: ['#22c47a', '#5b7cfa', '#f59e0b', '#f43f5e'],
            borderColor: '#fff',
            borderWidth: 3, hoverOffset: 6,
        }]
    },
    options: {
        responsive: true, cutout: '68%',
        plugins: {
            legend: { position: 'bottom', labels: { boxWidth: 10, padding: 14, font: { size: 11 } } },
            tooltip: { backgroundColor: '#fff', borderColor: '#e4e7ef', borderWidth: 1, titleColor: '#1a1d28', bodyColor: '#7a82a0' }
        }
    }
});
</script>
</body>
</html>