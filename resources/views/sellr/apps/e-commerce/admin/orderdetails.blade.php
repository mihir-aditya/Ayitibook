{{-- resources/views/seller/dashboard.blade.php --}}
@php $seller = Auth::guard('seller')->user(); @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard — {{ $seller->shop_name }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    @include('seller.partials._base')
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
      <style>
        .od-grid { display: grid; grid-template-columns: 1fr 340px; gap: 20px; align-items: start; }
        @media(max-width:1024px){ .od-grid { grid-template-columns: 1fr; } }

        /* Status Timeline */
        .sh-timeline { display: flex; align-items: center; }
        .sh-tl-step  { display: flex; flex-direction: column; align-items: center; flex: 1; text-align: center; }
        .sh-tl-dot {
            width: 36px; height: 36px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; font-weight: 700; flex-shrink: 0;
            border: 2px solid var(--border); background: var(--surface); color: var(--sub);
            transition: all .3s; position: relative; z-index: 2;
        }
        .sh-tl-dot.done   { border-color: var(--accent2); background: var(--accent2-bg); color: var(--accent2); }
        .sh-tl-dot.active { border-color: var(--accent);  background: var(--accent-bg);  color: var(--accent);
                            box-shadow: 0 0 0 4px rgba(91,124,250,.12); }
        .sh-tl-label { font-size: 11px; font-weight: 600; color: var(--sub); margin-top: 6px; }
        .sh-tl-label.done   { color: var(--accent2); }
        .sh-tl-label.active { color: var(--accent); }
        .sh-tl-line { flex: 1; height: 2px; background: var(--border); margin: 0 -1px; margin-bottom: 18px; transition: background .3s; }
        .sh-tl-line.done { background: var(--accent2); }

        /* Sidebar info rows */
        .sh-info-row { padding: 10px 0; border-bottom: 1px solid var(--border); display: flex; flex-direction: column; gap: 2px; }
        .sh-info-row:last-child { border-bottom: none; padding-bottom: 0; }
        .sh-info-label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; color: var(--sub); }
        .sh-info-value { font-size: 13.5px; font-weight: 500; color: var(--text); margin-top: 1px; }
        .sh-info-value a { color: var(--accent); }

        /* Order item row */
        .oi-row { display: flex; align-items: center; gap: 16px; padding: 16px 22px; border-bottom: 1px solid var(--border); }
        .oi-row:last-child { border-bottom: none; }

        /* Thumbnail */
        .oi-thumb {
            width: 60px; height: 60px; border-radius: 10px; flex-shrink: 0;
            border: 1px solid var(--border); background: var(--muted);
            overflow: hidden; display: flex; align-items: center; justify-content: center;
        }
        .oi-thumb img  { width: 100%; height: 100%; object-fit: cover; display: block; }
        .oi-thumb-icon { font-size: 26px; line-height: 1; }

        /* Product info */
        .oi-info { flex: 1; min-width: 0; }
        .oi-name { font-size: 14px; font-weight: 700; color: var(--text); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .oi-tags { display: flex; flex-wrap: wrap; gap: 5px; margin-top: 5px; }
        .oi-tag  {
            display: inline-flex; align-items: center; gap: 3px;
            font-size: 11px; font-weight: 600; padding: 2px 8px;
            border-radius: 5px; background: var(--muted); color: var(--sub); border: 1px solid var(--border);
        }
        .oi-tag.variant { background: var(--accent-bg); color: var(--accent); border-color: rgba(91,124,250,.2); }
        .oi-tag.sku     { font-family: var(--mono); }
        .oi-tag.stock   { background: var(--accent2-bg); color: var(--accent2); border-color: rgba(16,185,129,.2); }
        .oi-tag.nostock { background: var(--danger-bg);  color: var(--danger);  border-color: rgba(239,68,68,.2); }

        /* Right: qty + prices */
        .oi-right    { text-align: right; flex-shrink: 0; }
        .oi-qty      { display: inline-flex; align-items: center; justify-content: center; min-width: 30px; height: 24px; border-radius: 6px; background: var(--muted); font-size: 12px; font-weight: 700; color: var(--text2); padding: 0 8px; margin-bottom: 4px; }
        .oi-unit     { font-size: 11.5px; color: var(--sub); margin-bottom: 2px; }
        .oi-total    { font-family: var(--mono); font-size: 14px; font-weight: 700; color: var(--text); }

        /* Order summary */
        .sum-row { display: flex; justify-content: space-between; align-items: center; padding: 8px 0; border-bottom: 1px solid var(--border); }
        .sum-row:last-child { border-bottom: none; }
        .sum-label { font-size: 13px; color: var(--sub); }
        .sum-value { font-size: 13px; font-family: var(--mono); font-weight: 600; color: var(--text); }
        .sum-row.total .sum-label { font-size: 15px; font-weight: 700; color: var(--text); }
        .sum-row.total .sum-value { font-size: 18px; color: var(--accent2); }

        /* Quick action btns */
        .qa-btn {
            display: flex; align-items: center; gap: 8px;
            padding: 10px 14px; border-radius: 9px; font-size: 13px; font-weight: 500;
            cursor: pointer; border: 1px solid var(--border); background: var(--surface);
            color: var(--text2); transition: all .15s; text-align: left; width: 100%;
        }
        .qa-btn:hover        { background: var(--bg); border-color: var(--border2); }
        .qa-btn.primary:hover { background: var(--accent-bg);  border-color: var(--accent); color: var(--accent); }
        .qa-btn.danger:hover  { background: var(--danger-bg);  border-color: var(--danger);  color: var(--danger); }
    </style>

</head>
<body>
<div class="layout">

    @include('seller.partials._sidebar', ['active' => 'dashboard'])

    <header class="header">
        <div class="header-left">
            <div>
                <div class="header-title">Dashboard</div>
                <div class="header-sub">{{ now()->format('l, F j, Y') }}</div>
            </div>
        </div>
        <div class="header-right">
            <a href="{{ route('seller.orders.index') }}" class="header-btn" title="Orders">🛒</a>
            <a href="#" class="header-btn" title="Notifications">🔔</a>
            <a href="{{ route('seller.products.create') }}" class="btn-primary">+ Add Product</a>
            <form method="POST" action="{{ route('seller.logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="header-btn" title="Logout">↩</button>
            </form>
        </div>
    </header>

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

            {{-- Recent Orders (REAL DATA) --}}
            <div class="table-card">
                <div class="table-header">
                    <div class="table-title">Recent Orders</div>
                    <a href="{{ route('seller.orders.index') }}" class="link-btn">View all →</a>
                </div>
                <div class="table-wrap">
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
                            @forelse($recentOrders as $order)
                                <tr>
                                    <td><span style="font-family:var(--mono); font-size:12px; color:var(--accent); font-weight:600;">{{ $order->order_number }}</span></td>
                                    <td>{{ $order->product_name }} (x{{ $order->quantity }})</td>
                                    <td style="font-family:var(--mono); font-weight:700;">{{ number_format($order->amount, 2) }}</td>
                                    <td><span class="pill pill-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 30px;">No orders yet</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Right Column (Shop Health & Activity) --}}
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

                {{-- Activity Feed (still demo, but can be extended) --}}
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
const orderId   = '{{ $order->order_id }}';
const orderSlNo = '{{ $order->sl_no }}';
const userEmail = '{{ $user?->email ?? '' }}';

async function updateOrderStatus() {
    const select        = document.getElementById('statusSelect');
    const newStatus     = select.value;
    const currentStatus = select.dataset.currentStatus;
    if (newStatus === currentStatus) { showToast('Status is already ' + newStatus, 'warning'); return; }
    if (!confirm(`Update order status to "${newStatus}"?`)) { select.value = currentStatus; return; }
    try {
        const res = await fetch(`/seller/orders/${orderSlNo}/status`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
            body: JSON.stringify({ status: newStatus })
        });
        const data = await res.json();
        if (!res.ok) throw new Error(data.error ?? 'Failed');
        select.dataset.currentStatus = newStatus;
        showToast('Status updated to ' + newStatus, 'success');
        setTimeout(() => location.reload(), 1200);
    } catch(e) {
        showToast(e.message || 'Failed to update status', 'error');
        select.value = currentStatus;
    }
}

document.getElementById('orderNotes')?.addEventListener('input', function () {
    document.getElementById('saveNotesBtn').disabled = !this.value.trim();
});
document.getElementById('saveNotesBtn')?.addEventListener('click', async function () {
    try {
        const res = await fetch(`/seller/orders/${orderSlNo}/notes`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
            body: JSON.stringify({ notes: document.getElementById('orderNotes').value })
        });
        showToast(res.ok ? 'Notes saved' : 'Failed to save notes', res.ok ? 'success' : 'error');
    } catch { showToast('Error saving notes', 'error'); }
});

document.getElementById('downloadInvoiceBtn') ?.addEventListener('click', () => { showToast('Generating invoice…','info');  setTimeout(() => window.location.href = `/seller/orders/${orderSlNo}/invoice`, 600); });
document.getElementById('downloadInvoiceBtn2')?.addEventListener('click', () => { showToast('Generating invoice…','info');  setTimeout(() => window.location.href = `/seller/orders/${orderSlNo}/invoice`, 600); });
document.getElementById('shippingLabelBtn')   ?.addEventListener('click', () => { showToast('Generating label…','info');   setTimeout(() => window.location.href = `/seller/orders/${orderSlNo}/shipping-label`, 600); });
document.getElementById('contactCustomerBtn') ?.addEventListener('click', () => {
    if (userEmail) window.location.href = `mailto:${userEmail}?subject=Regarding Order #${orderId}`;
    else showToast('No contact info available', 'warning');
});
document.getElementById('cancelOrderBtn')?.addEventListener('click', async () => {
    if (!confirm('Are you sure you want to cancel this order?')) return;
    try {
        const res = await fetch(`/seller/orders/${orderSlNo}/cancel`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
        });
        const data = await res.json();
        if (res.ok) { showToast('Order cancelled', 'success'); setTimeout(() => window.location.href = '/seller/orders', 1200); }
        else showToast(data.error || 'Failed to cancel order', 'error');
    } catch { showToast('Error cancelling order', 'error'); }
});

function sendNotification() { showToast('Notification sent to customer!', 'success'); }

function showToast(msg, type = 'info') {
    const icons = { success:'✅', error:'❌', warning:'⚠️', info:'ℹ️' };
    const t = document.createElement('div');
    t.className = `sh-toast ${type}`;
    t.innerHTML = `<span>${icons[type]}</span><span>${msg}</span>`;
    document.getElementById('toastContainer').appendChild(t);
    setTimeout(() => t.remove(), 3500);
}
</script>
</body>
</html>