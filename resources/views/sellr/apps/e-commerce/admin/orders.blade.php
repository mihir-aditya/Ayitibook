{{-- resources/views/seller/orders.blade.php --}}
@php $seller = Auth::guard('seller')->user(); @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Management — SellerHub</title>
    @include('seller.partials._base')
    <style>
        .metrics-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }
        @media(max-width:900px){ .metrics-row { grid-template-columns: repeat(2,1fr); } }

        /* Table customer cell */
        .td-customer { display: flex; align-items: center; gap: 10px; }
        .td-customer .cav {
            width: 32px; height: 32px; border-radius: 50%; flex-shrink: 0;
            background: linear-gradient(135deg, var(--accent), #8b5cf6);
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 700; color: #fff;
        }
        .td-customer .cname { font-size: 13px; font-weight: 500; color: var(--text); }
        .td-customer .cemail { font-size: 11px; color: var(--sub); }

        .order-id { font-family: var(--mono); font-size: 12px; font-weight: 600; color: var(--accent); }

        /* Action buttons */
        .act-row { display: flex; align-items: center; gap: 6px; }
        .act-btn {
            width: 30px; height: 30px; border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            border: 1px solid var(--border); background: var(--bg);
            color: var(--sub); font-size: 13px; cursor: pointer;
            transition: all .15s; text-decoration: none;
        }
        .act-btn:hover { background: var(--accent-bg); border-color: var(--accent); color: var(--accent); }

        /* Dropdown */
        .sh-dropdown { position: relative; }
        .sh-dropdown-menu {
            position: absolute; right: 0; top: calc(100% + 6px);
            background: var(--surface); border: 1px solid var(--border);
            border-radius: 10px; box-shadow: var(--shadow-lg);
            min-width: 170px; z-index: 200; overflow: hidden;
            display: none;
        }
        .sh-dropdown.open .sh-dropdown-menu { display: block; }
        .sh-dropdown-item {
            display: flex; align-items: center; gap: 8px;
            padding: 10px 14px; font-size: 13px; font-weight: 500;
            color: var(--text2); cursor: pointer; border: none;
            background: none; width: 100%; text-align: left;
            transition: background .12s; text-decoration: none;
        }
        .sh-dropdown-item:hover { background: var(--bg); text-decoration: none; }
        .sh-dropdown-item.danger { color: var(--danger); }
        .sh-dropdown-item.danger:hover { background: var(--danger-bg); }
        .sh-dropdown-divider { height: 1px; background: var(--border); margin: 4px 0; }

        /* Pagination */
        .sh-pagination { display: flex; align-items: center; gap: 4px; }
        .sh-page-btn {
            min-width: 32px; height: 32px; border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            border: 1px solid var(--border); background: var(--surface);
            color: var(--text2); font-size: 13px; font-weight: 500;
            cursor: pointer; transition: all .15s; text-decoration: none;
            padding: 0 8px;
        }
        .sh-page-btn:hover { border-color: var(--accent); color: var(--accent); }
        .sh-page-btn.active { background: var(--accent); border-color: var(--accent); color: #fff; }
        .sh-page-btn:disabled { opacity: .4; cursor: not-allowed; }

        .sh-metric:nth-child(1){animation-delay:.05s}
        .sh-metric:nth-child(2){animation-delay:.10s}
        .sh-metric:nth-child(3){animation-delay:.15s}
        .sh-metric:nth-child(4){animation-delay:.20s}
    </style>
</head>
<body>
<div class="sh-layout">

    {{-- SIDEBAR --}}
    @include('seller.partials._sidebar', ['active' => 'orders'])

    {{-- HEADER --}}
    <header class="sh-header">
        <div class="sh-header-left">
            <div>
                <div class="sh-header-title">Orders Management</div>
                <div class="sh-header-sub">{{ now()->format('l, F j, Y') }}</div>
            </div>
        </div>
        <div class="sh-header-right">
            <a href="{{ route('seller.orders.index') }}" class="sh-icon-btn" title="Orders">
                🛒 <span class="sh-notif-dot">3</span>
            </a>
            <a href="#" class="sh-icon-btn">🔔</a>
            <a href="{{ route('seller.products.create') }}" class="sh-btn sh-btn-primary">+ Add Product</a>
            <form method="POST" action="{{ route('seller.logout') }}" style="display:inline">
                @csrf <button type="submit" class="sh-icon-btn">↩</button>
            </form>
        </div>
    </header>

    {{-- MAIN --}}
    <main class="sh-main">

        {{-- Page Header --}}
        <div class="sh-page-header">
            <div>
                <div class="sh-page-title">📦 Orders Management</div>
                <div class="sh-page-sub">Manage and track all customer orders</div>
            </div>
            <div class="sh-page-actions">
                <button class="sh-btn sh-btn-secondary" onclick="window.print()">
                    <i class="fas fa-print"></i> Print
                </button>
                <button class="sh-btn sh-btn-secondary" onclick="exportOrders()">
                    <i class="fas fa-download"></i> Export
                </button>
                <a href="{{ route('seller.products.index') }}" class="sh-btn sh-btn-primary">
                    <i class="fas fa-plus"></i> New Order
                </a>
            </div>
        </div>

        {{-- Metric Cards --}}
        <div class="metrics-row">
            <div class="sh-metric blue">
                <div class="sh-metric-icon">🧾</div>
                <div class="sh-metric-label">Total Orders</div>
                <div class="sh-metric-value">{{ $orders->count() }}</div>
                <div class="sh-metric-change up">↑ All time</div>
            </div>
            <div class="sh-metric green">
                <div class="sh-metric-icon">💰</div>
                <div class="sh-metric-label">Total Revenue</div>
                <div class="sh-metric-value">{{ number_format($orders->sum('total_amount'), 0) }}</div>
                <div class="sh-metric-change up">↑ All orders</div>
            </div>
            <div class="sh-metric cyan">
                <div class="sh-metric-icon">📈</div>
                <div class="sh-metric-label">Avg Order Value</div>
                <div class="sh-metric-value">
                    {{ number_format($orders->count() > 0 ? $orders->sum('total_amount') / $orders->count() : 0, 0) }}
                </div>
                <div class="sh-metric-change up">↑ Per order</div>
            </div>
            <div class="sh-metric amber">
                <div class="sh-metric-icon">⏳</div>
                <div class="sh-metric-label">Pending Orders</div>
                <div class="sh-metric-value">{{ $orders->whereIn('order_status', ['pending','placed'])->count() }}</div>
                <div class="sh-metric-change down">Needs attention</div>
            </div>
        </div>

        {{-- Filter Bar --}}
        <div class="sh-filter-bar">
            <div class="sh-filter-row">
                <div class="sh-filter-group">
                    <label class="sh-label">Search</label>
                    <div style="position:relative">
                        <i class="fas fa-search" style="position:absolute; left:10px; top:50%; transform:translateY(-50%); color:var(--sub); font-size:12px;"></i>
                        <input type="text" id="searchInput" class="sh-input" style="padding-left:30px;" placeholder="Order ID or customer...">
                    </div>
                </div>
                <div class="sh-filter-group">
                    <label class="sh-label">Status</label>
                    <select id="statusFilter" class="sh-select">
                        <option value="">All Statuses</option>
                        <option value="placed">Placed</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="shipped">Shipped</option>
                        <option value="delivered">Delivered</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="refunded">Refunded</option>
                    </select>
                </div>
                <div class="sh-filter-group">
                    <label class="sh-label">Date</label>
                    <input type="date" id="dateFilter" class="sh-input">
                </div>
                <div class="sh-filter-group">
                    <label class="sh-label">Sort By</label>
                    <select id="sortFilter" class="sh-select">
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="highest">Highest Amount</option>
                        <option value="lowest">Lowest Amount</option>
                    </select>
                </div>
                <div class="sh-filter-actions">
                    <button class="sh-btn sh-btn-secondary sh-btn-sm" onclick="resetFilters()">Reset</button>
                </div>
            </div>
        </div>

        {{-- Orders Table --}}
        <div class="sh-card" style="animation: shFadeUp .5s ease;">
            <div class="sh-card-header">
                <div>
                    <div class="sh-card-title">All Orders</div>
                    <div class="sh-card-sub">{{ $orders->count() }} total orders</div>
                </div>
                <div id="selectedActions" style="display:none; align-items:center; gap:8px;">
                    <span style="font-size:12px; color:var(--sub);" id="selCount">0 selected</span>
                    <button class="sh-btn sh-btn-secondary sh-btn-sm" onclick="bulkUpdateStatus('shipped')">Mark Shipped</button>
                    <button class="sh-btn sh-btn-secondary sh-btn-sm" onclick="bulkUpdateStatus('delivered')">Mark Delivered</button>
                </div>
            </div>

            <div class="sh-table-wrap">
                <table class="sh-table">
                    <thead>
                        <tr>
                            <th style="width:40px; padding-left:22px;">
                                <input type="checkbox" id="masterCheck" onchange="toggleAll(this)" style="width:14px; height:14px; cursor:pointer; accent-color:var(--accent);">
                            </th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th style="text-align:right; padding-right:22px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="ordersTableBody">
                        @forelse($orders as $order)
                        <tr class="order-row"
                            data-order-id="{{ $order->order_id }}"
                            data-status="{{ $order->order_status }}"
                            data-amount="{{ $order->total_amount }}"
                            data-date="{{ $order->placed_at }}">
                            <td style="padding-left:22px;">
                                <input type="checkbox" class="row-check" value="{{ $order->sl_no }}"
                                    style="width:14px; height:14px; cursor:pointer; accent-color:var(--accent);"
                                    onchange="updateSelCount()">
                            </td>
                            <td>
                                <span class="order-id">{{ $order->order_id }}</span>
                            </td>
                            <td>
                                <div class="td-customer">
                                    <div class="cav">
                                        {{ strtoupper(substr($order->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="cname">{{ $order->user->name ?? 'N/A' }}</div>
                                        <div class="cemail">{{ $order->user->email ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span style="font-family:var(--mono); font-weight:700; color:var(--text);">
                                    Rs. {{ number_format($order->total_amount, 2) }}
                                </span>
                            </td>
                            <td>
                                <span class="sh-pill sh-pill-placed" style="font-size:11px;">
                                    {{ ucfirst($order->payment_method ?? 'Unknown') }}
                                </span>
                            </td>
                            <td>
                                @php
                                $statusMap = [
                                    'placed'    => 'placed',
                                    'confirmed' => 'confirmed',
                                    'shipped'   => 'shipped',
                                    'delivered' => 'delivered',
                                    'cancelled' => 'cancelled',
                                    'refunded'  => 'refunded',
                                    'pending'   => 'pending',
                                ];
                                $sc = $statusMap[$order->order_status] ?? 'secondary';
                                @endphp
                                <span class="sh-pill sh-pill-{{ $sc }}">{{ ucfirst($order->order_status) }}</span>
                            </td>
                            <td style="color:var(--sub); font-size:12.5px; white-space:nowrap;">
                                {{ $order->placed_at?->format('M d, Y') ?? 'N/A' }}
                            </td>
                            <td style="text-align:right; padding-right:22px;">
                                <div class="act-row" style="justify-content:flex-end;">
                                    <a href="{{ route('seller.orders.show', $order->sl_no) }}" class="act-btn" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button class="act-btn" onclick="window.location='/seller/orders/{{ $order->sl_no }}/print'" title="Print">
                                        <i class="fas fa-print"></i>
                                    </button>
                                    <div class="sh-dropdown">
                                        <button class="act-btn" onclick="toggleDropdown(this)" title="More">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="sh-dropdown-menu">
                                            <button class="sh-dropdown-item" onclick="updateStatus({{ $order->sl_no }}, 'confirmed')">
                                                <i class="fas fa-check" style="color:var(--accent); width:14px;"></i> Mark Confirmed
                                            </button>
                                            <button class="sh-dropdown-item" onclick="updateStatus({{ $order->sl_no }}, 'shipped')">
                                                <i class="fas fa-shipping-fast" style="color:var(--accent2); width:14px;"></i> Mark Shipped
                                            </button>
                                            <button class="sh-dropdown-item" onclick="updateStatus({{ $order->sl_no }}, 'delivered')">
                                                <i class="fas fa-check-circle" style="color:var(--accent2); width:14px;"></i> Mark Delivered
                                            </button>
                                            <div class="sh-dropdown-divider"></div>
                                            <button class="sh-dropdown-item danger" onclick="deleteOrder({{ $order->sl_no }})">
                                                <i class="fas fa-trash" style="width:14px;"></i> Delete Order
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">
                                <div class="sh-empty">
                                    <div class="sh-empty-icon">📭</div>
                                    <div class="sh-empty-title">No orders found</div>
                                    <div class="sh-empty-sub">Start selling to see orders here</div>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Footer / Pagination --}}
            <div class="sh-card-footer" style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px;">
                <span style="font-size:12.5px; color:var(--sub);">
                    Showing {{ $orders->count() }} orders
                </span>
                <div class="sh-pagination">
                    <button class="sh-page-btn" disabled><i class="fas fa-chevron-left" style="font-size:10px;"></i></button>
                    <button class="sh-page-btn active">1</button>
                    <button class="sh-page-btn"><i class="fas fa-chevron-right" style="font-size:10px;"></i></button>
                </div>
            </div>
        </div>

    </main>
</div>

{{-- Toast Container --}}
<div class="sh-toast-container" id="toastContainer"></div>

<script>
/* ── Live filters ── */
function applyFilters() {
    const search = document.getElementById('searchInput').value.toLowerCase();
    const status = document.getElementById('statusFilter').value;
    const date   = document.getElementById('dateFilter').value;
    const sort   = document.getElementById('sortFilter').value;

    let rows = Array.from(document.querySelectorAll('.order-row'));

    rows.forEach(r => r.style.display = 'none');

    let filtered = rows.filter(r => {
        const matchSearch = !search || r.textContent.toLowerCase().includes(search);
        const matchStatus = !status || r.dataset.status === status;
        const matchDate   = !date   || (r.dataset.date || '').startsWith(date);
        return matchSearch && matchStatus && matchDate;
    });

    filtered.sort((a, b) => {
        if (sort === 'newest') return new Date(b.dataset.date) - new Date(a.dataset.date);
        if (sort === 'oldest') return new Date(a.dataset.date) - new Date(b.dataset.date);
        if (sort === 'highest') return parseFloat(b.dataset.amount) - parseFloat(a.dataset.amount);
        if (sort === 'lowest')  return parseFloat(a.dataset.amount) - parseFloat(b.dataset.amount);
    });

    const tbody = document.getElementById('ordersTableBody');
    filtered.forEach(r => { r.style.display = ''; tbody.appendChild(r); });
}

function resetFilters() {
    ['searchInput','dateFilter'].forEach(id => document.getElementById(id).value = '');
    document.getElementById('statusFilter').value = '';
    document.getElementById('sortFilter').value = 'newest';
    document.querySelectorAll('.order-row').forEach(r => r.style.display = '');
}

document.getElementById('searchInput')?.addEventListener('keyup', applyFilters);
document.getElementById('statusFilter')?.addEventListener('change', applyFilters);
document.getElementById('dateFilter')?.addEventListener('change', applyFilters);
document.getElementById('sortFilter')?.addEventListener('change', applyFilters);

/* ── Checkbox selection ── */
function toggleAll(master) {
    document.querySelectorAll('.row-check').forEach(c => c.checked = master.checked);
    updateSelCount();
}
function updateSelCount() {
    const selected = document.querySelectorAll('.row-check:checked').length;
    const panel = document.getElementById('selectedActions');
    document.getElementById('selCount').textContent = selected + ' selected';
    panel.style.display = selected > 0 ? 'flex' : 'none';
}

/* ── Dropdown ── */
function toggleDropdown(btn) {
    const dd = btn.closest('.sh-dropdown');
    document.querySelectorAll('.sh-dropdown.open').forEach(d => { if (d !== dd) d.classList.remove('open'); });
    dd.classList.toggle('open');
}
document.addEventListener('click', e => {
    if (!e.target.closest('.sh-dropdown')) {
        document.querySelectorAll('.sh-dropdown.open').forEach(d => d.classList.remove('open'));
    }
});

/* ── Status update ── */
async function updateStatus(orderId, status) {
    if (!confirm(`Update order status to "${status}"?`)) return;
    try {
        const res = await fetch(`/seller/orders/${orderId}/status`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
            body: JSON.stringify({ status })
        });
        if (res.ok) { showToast('Status updated successfully', 'success'); setTimeout(() => location.reload(), 1200); }
        else showToast('Failed to update status', 'error');
    } catch { showToast('Network error', 'error'); }
}

function deleteOrder(id) {
    if (confirm('Are you sure you want to delete this order?')) {
        showToast('Delete not yet implemented', 'warning');
    }
}

function exportOrders() { showToast('Export feature coming soon', 'info'); }

/* ── Bulk status update ── */
async function bulkUpdateStatus(status) {
    const checked = Array.from(document.querySelectorAll('.row-check:checked')).map(c => c.value);
    if (!checked.length) { showToast('No orders selected', 'warning'); return; }
    if (!confirm(`Mark ${checked.length} order(s) as ${status}?`)) return;
    let ok = 0, fail = 0;
    for (const id of checked) {
        try {
            const res = await fetch(`/seller/orders/${id}/status`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                body: JSON.stringify({ status })
            });
            res.ok ? ok++ : fail++;
        } catch { fail++; }
    }
    showToast(`${ok} updated${fail ? ', ' + fail + ' failed' : ''}`, ok > 0 ? 'success' : 'error');
    if (ok > 0) setTimeout(() => location.reload(), 1400);
}

/* ── Toast ── */
function showToast(msg, type = 'info') {
    const icons = { success:'✅', error:'❌', warning:'⚠️', info:'ℹ️' };
    const t = document.createElement('div');
    t.className = `sh-toast ${type}`;
    t.innerHTML = `<span>${icons[type]||'ℹ️'}</span><span>${msg}</span>`;
    document.getElementById('toastContainer').appendChild(t);
    setTimeout(() => t.remove(), 3500);
}
</script>
</body>
</html>