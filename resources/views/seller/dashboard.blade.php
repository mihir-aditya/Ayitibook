@extends('seller.layouts.app')

@section('content')
<div class="dashboard-wrap">
    <header class="dash-header">
        <h1>Seller Dashboard</h1>
        <p class="muted">Overview of sales, orders and product performance</p>
    </header>

    <section class="metrics-grid">
        <div class="metric-card">
            <div class="metric-title">Total Products</div>
            <div class="metric-value">{{ $totalProducts ?? 0 }}</div>
        </div>
        <div class="metric-card">
            <div class="metric-title">Active Products</div>
            <div class="metric-value">{{ $activeProducts ?? 0 }}</div>
        </div>
        <div class="metric-card">
            <div class="metric-title">Total Orders</div>
            <div class="metric-value">{{ $totalOrders ?? 0 }}</div>
        </div>
        <div class="metric-card">
            <div class="metric-title">Revenue</div>
            <div class="metric-value">₹{{ number_format($totalRevenue ?? 0, 2) }}</div>
        </div>
    </section>

    <section class="charts-grid">
        <div class="chart-card">
            <h3 class="chart-title">Orders (Last 30 days)</h3>
            <canvas id="ordersChart"></canvas>
        </div>

        <div class="chart-card">
            <h3 class="chart-title">Revenue (Last 30 days)</h3>
            <canvas id="revenueChart"></canvas>
        </div>
    </section>

    <section class="tables-grid">
        <div class="card-list">
            <h4>Top Products</h4>
            <ul>
                @foreach($topProducts ?? [] as $p)
                    <li class="top-item">
                        <span class="name">{{ $p['name'] }}</span>
                        <span class="count">{{ $p['sold'] }}</span>
                    </li>
                @endforeach
                @if(empty($topProducts))
                    <li class="muted">No data available</li>
                @endif
            </ul>
        </div>

        <div class="card-list">
            <h4>Order Status</h4>
            <ul>
                @foreach($ordersByStatus ?? [] as $status => $count)
                    <li class="status-item"><span>{{ ucfirst($status) }}</span><span>{{ $count }}</span></li>
                @endforeach
                @if(empty($ordersByStatus))
                    <li class="muted">No data available</li>
                @endif
            </ul>
        </div>
    </section>
</div>

<style>
    :root{--primary:#667eea;--accent:#06b6d4;--muted:#6b7280}
    .dashboard-wrap{max-width:1100px;margin:0 auto;padding:24px}
    .dash-header h1{margin:0;font-size:1.6rem}
    .muted{color:var(--muted);margin:4px 0 18px}
    .metrics-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:20px}
    .metric-card{background:#fff;padding:18px;border-radius:10px;border:1px solid #eef2ff;box-shadow:0 8px 30px rgba(102,126,234,0.04)}
    .metric-title{font-weight:600;color:var(--muted);font-size:0.9rem}
    .metric-value{font-size:1.35rem;font-weight:800;margin-top:6px}
    .charts-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px}
    .chart-card{background:#fff;padding:16px;border-radius:10px;border:1px solid #eef2ff}
    .chart-title{margin:0 0 10px;font-weight:700}
    .tables-grid{display:grid;grid-template-columns:1fr 320px;gap:18px;margin-top:18px}
    .card-list{background:#fff;padding:14px;border-radius:10px;border:1px solid #eef2ff}
    .card-list h4{margin:0 0 10px}
    .top-item,.status-item{display:flex;justify-content:space-between;padding:8px 6px;border-bottom:1px solid #f3f6fb}
    .top-item:last-child,.status-item:last-child{border-bottom:none}
    .muted{color:var(--muted);}
    @media(max-width:900px){.metrics-grid{grid-template-columns:repeat(2,1fr)}.charts-grid{grid-template-columns:1fr}.tables-grid{grid-template-columns:1fr}}
</style>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
(() => {
    // Data fallbacks: expect controller to provide arrays; else use zeros
    const ordersChart = @json($ordersChart ?? []);
    const revenueChart = @json($revenueChart ?? []);

    const ordersLabels = Object.keys(ordersChart);
    const ordersValues = Object.values(ordersChart);

    const revenueLabels = Object.keys(revenueChart);
    const revenueValues = Object.values(revenueChart);

    const ordersCtx = document.getElementById('ordersChart').getContext('2d');
    new Chart(ordersCtx, {
        type: 'line',
        data: {
            labels: ordersLabels,
            datasets: [{
                label: 'Orders',
                data: ordersValues,
                borderColor: getComputedStyle(document.documentElement).getPropertyValue('--primary') || '#667eea',
                backgroundColor: 'rgba(102,126,234,0.08)',
                tension: 0.3,
                pointRadius: 3,
                fill: true
            }]
        },
        options: {responsive:true, maintainAspectRatio:false, scales:{x:{grid:{display:false}}}}
    });

    const revCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revCtx, {
        type: 'bar',
        data: {
            labels: revenueLabels,
            datasets: [{
                label: 'Revenue',
                data: revenueValues,
                backgroundColor: 'rgba(6,182,212,0.85)'
            }]
        },
        options: {responsive:true, maintainAspectRatio:false, scales:{y:{ticks:{callback: (v)=> '₹'+v}}}}
    });
})();
</script>
