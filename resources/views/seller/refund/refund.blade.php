{{-- resources/views/seller/refund.blade.php --}}
@php $seller = Auth::guard('seller')->user(); @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refund Requests — SellerHub</title>
    @include('seller.partials._base')
    <style>
        .metrics-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }
        @media(max-width:900px){ .metrics-row { grid-template-columns: repeat(2,1fr); } }

        .sh-metric:nth-child(1){animation-delay:.05s}
        .sh-metric:nth-child(2){animation-delay:.10s}
        .sh-metric:nth-child(3){animation-delay:.15s}
        .sh-metric:nth-child(4){animation-delay:.20s}

        /* Product in table */
        .td-product { display: flex; align-items: center; gap: 10px; }
        .td-product img { width: 36px; height: 36px; border-radius: 8px; object-fit: cover; border: 1px solid var(--border); }
        .td-product .prod-ph { width: 36px; height: 36px; border-radius: 8px; background: var(--muted); display: flex; align-items: center; justify-content: center; font-size: 18px; border: 1px solid var(--border); }

        /* Customer cell */
        .td-customer { display: flex; flex-direction: column; gap: 1px; }
        .td-customer .cn { font-size: 13px; font-weight: 600; color: var(--text); }
        .td-customer .ce { font-size: 11px; color: var(--sub); }

        /* Bulk bar */
        .sh-bulk-bar {
            display: none; align-items: center; gap: 12px;
            background: var(--accent-bg); border: 1px solid rgba(91,124,250,.2);
            border-radius: 10px; padding: 10px 16px; margin-bottom: 16px;
            flex-wrap: wrap;
        }
        .sh-bulk-bar.show { display: flex; }

        /* Actions */
        .act-row { display: flex; align-items: center; gap: 6px; justify-content: flex-end; }
        .act-btn {
            width: 30px; height: 30px; border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            border: 1px solid var(--border); background: var(--bg);
            color: var(--sub); font-size: 13px; cursor: pointer;
            transition: all .15s; text-decoration: none;
        }
        .act-btn:hover { background: var(--accent-bg); border-color: var(--accent); color: var(--accent); }

        .sh-dropdown { position: relative; }
        .sh-dropdown-menu {
            position: absolute; right: 0; top: calc(100% + 6px);
            background: var(--surface); border: 1px solid var(--border);
            border-radius: 10px; box-shadow: var(--shadow-lg);
            min-width: 180px; z-index: 200; overflow: hidden;
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
        .sh-dropdown-item.success { color: var(--accent2); }
        .sh-dropdown-item.success:hover { background: var(--accent2-bg); }
        .sh-dropdown-item.danger { color: var(--danger); }
        .sh-dropdown-item.danger:hover { background: var(--danger-bg); }
        .sh-dropdown-item.info { color: var(--accent); }
        .sh-dropdown-item.info:hover { background: var(--accent-bg); }
        .sh-dropdown-divider { height: 1px; background: var(--border); margin: 4px 0; }

        /* Refund reason cell */
        .refund-reason {
            max-width: 180px; white-space: nowrap; overflow: hidden;
            text-overflow: ellipsis; font-size: 12.5px; color: var(--text2);
        }

        /* Flash */
        .sh-flash { padding: 12px 18px; border-radius: 10px; margin-bottom: 18px; display: flex; align-items: center; gap: 10px; font-size: 13px; font-weight: 500; }
        .sh-flash.success { background: var(--accent2-bg); border: 1px solid rgba(34,196,122,.25); color: #14a05a; }
        .sh-flash.error   { background: var(--danger-bg);  border: 1px solid rgba(244,63,94,.25);  color: var(--danger); }

        /* Modal */
        .sh-modal-overlay {
            position: fixed; inset: 0; background: rgba(26,29,40,.45);
            z-index: 500; display: none; align-items: center; justify-content: center;
            padding: 20px; backdrop-filter: blur(2px);
        }
        .sh-modal-overlay.open { display: flex; }
        .sh-modal {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: var(--radius); box-shadow: var(--shadow-lg);
            width: 100%; max-width: 560px; max-height: 85vh;
            overflow-y: auto; animation: shFadeUp .2s ease;
        }
        .sh-modal-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 18px 22px; border-bottom: 1px solid var(--border);
        }
        .sh-modal-title { font-size: 15px; font-weight: 700; color: var(--text); }
        .sh-modal-close {
            width: 30px; height: 30px; border-radius: 7px;
            border: 1px solid var(--border); background: var(--bg);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: var(--sub); font-size: 16px;
            transition: all .15s;
        }
        .sh-modal-close:hover { background: var(--danger-bg); color: var(--danger); border-color: var(--danger); }
        .sh-modal-body { padding: 22px; }
        .sh-modal-footer { padding: 16px 22px; border-top: 1px solid var(--border); display: flex; gap: 8px; justify-content: flex-end; }

        /* Pagination */
        .sh-pagination { display: flex; align-items: center; gap: 4px; flex-wrap: wrap; }
        .sh-page-btn {
            min-width: 32px; height: 32px; border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            border: 1px solid var(--border); background: var(--surface);
            color: var(--text2); font-size: 13px; font-weight: 500;
            cursor: pointer; transition: all .15s; text-decoration: none; padding: 0 8px;
        }
        .sh-page-btn:hover { border-color: var(--accent); color: var(--accent); }
        .sh-page-btn.active { background: var(--accent); border-color: var(--accent); color: #fff; }
    </style>
</head>
<body>
<div class="sh-layout">

    @include('seller.partials._sidebar', ['active' => 'refunds'])

    <header class="sh-header">
        <div class="sh-header-left">
            <div>
                <div class="sh-header-title">Refund Requests</div>
                <div class="sh-header-sub">{{ now()->format('l, F j, Y') }}</div>
            </div>
        </div>
        <div class="sh-header-right">
            <a href="{{ route('seller.orders.index') }}" class="sh-icon-btn">🛒 <span class="sh-notif-dot">3</span></a>
            <a href="#" class="sh-icon-btn">🔔</a>
            <form method="POST" action="{{ route('seller.logout') }}" style="display:inline">
                @csrf <button type="submit" class="sh-icon-btn">↩</button>
            </form>
        </div>
    </header>

    <main class="sh-main">

        {{-- Breadcrumb --}}
        <div class="sh-breadcrumb">
            <a href="{{ route('seller.dashboard') }}">Dashboard</a>
            <span class="sep">/</span>
            <span class="current">Refund Requests</span>
        </div>

        {{-- Flash --}}
        @if(session('success'))
            <div class="sh-flash success"><span>✅</span> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="sh-flash error"><span>❌</span> {{ session('error') }}</div>
        @endif

        {{-- Page Header --}}
        <div class="sh-page-header">
            <div>
                <div class="sh-page-title">↩️ Refund Requests</div>
                <div class="sh-page-sub">Manage customer refund requests for your products</div>
            </div>
        </div>

        {{-- Metric Cards --}}
        <div class="metrics-row">
            <div class="sh-metric blue">
                <div class="sh-metric-icon">🧾</div>
                <div class="sh-metric-label">Total</div>
                <div class="sh-metric-value">{{ $refunds->total() }}</div>
                <div class="sh-metric-change up">All requests</div>
            </div>
            <div class="sh-metric amber">
                <div class="sh-metric-icon">⏳</div>
                <div class="sh-metric-label">Pending</div>
                <div class="sh-metric-value">{{ $refunds->where('status','pending')->count() }}</div>
                <div class="sh-metric-change down">Needs review</div>
            </div>
            <div class="sh-metric green">
                <div class="sh-metric-icon">✅</div>
                <div class="sh-metric-label">Approved</div>
                <div class="sh-metric-value">{{ $refunds->where('status','approved')->count() }}</div>
                <div class="sh-metric-change up">Processed</div>
            </div>
            <div class="sh-metric red">
                <div class="sh-metric-icon">💸</div>
                <div class="sh-metric-label">Refunded</div>
                <div class="sh-metric-value">{{ $refunds->where('status','refunded')->count() }}</div>
                <div class="sh-metric-change up">Completed</div>
            </div>
        </div>

        {{-- Bulk Actions Bar --}}
        <div class="sh-bulk-bar" id="bulkBar">
            <span style="font-size:13px; font-weight:600; color:var(--accent);" id="bulkCount">0 selected</span>
            <div style="display:flex; gap:8px; flex-wrap:wrap;">
                <select id="bulkStatusSelect" class="sh-select" style="width:160px;">
                    <option value="">Update Status…</option>
                    <option value="approved">Approve</option>
                    <option value="rejected">Reject</option>
                    <option value="refunded">Mark Refunded</option>
                </select>
                <button class="sh-btn sh-btn-primary sh-btn-sm" id="applyBulk">Apply</button>
                <button class="sh-btn sh-btn-secondary sh-btn-sm" id="clearBulk">Clear</button>
            </div>
        </div>

        {{-- Filter Bar --}}
        <div class="sh-filter-bar">
            <form method="GET" action="{{ route('seller.refunds.index') }}">
                <div class="sh-filter-row">
                    <div class="sh-filter-group">
                        <label class="sh-label">Search</label>
                        <div style="position:relative;">
                            <i class="fas fa-search" style="position:absolute; left:10px; top:50%; transform:translateY(-50%); color:var(--sub); font-size:12px;"></i>
                            <input type="text" name="search" class="sh-input" style="padding-left:30px;"
                                placeholder="Refund ID, order, customer…" value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="sh-filter-group" style="max-width:180px;">
                        <label class="sh-label">Status</label>
                        <select name="status" class="sh-select">
                            <option value="">All Status</option>
                            <option value="pending"  {{ request('status') == 'pending'  ? 'selected':'' }}>Pending</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected':'' }}>Approved</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected':'' }}>Rejected</option>
                            <option value="refunded" {{ request('status') == 'refunded' ? 'selected':'' }}>Refunded</option>
                        </select>
                    </div>
                    <div class="sh-filter-actions">
                        <button type="submit" class="sh-btn sh-btn-primary sh-btn-sm">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <a href="{{ route('seller.refunds.index') }}" class="sh-btn sh-btn-secondary sh-btn-sm">Reset</a>
                    </div>
                </div>
            </form>
        </div>

        {{-- Refunds Table --}}
        <div class="sh-card" style="animation: shFadeUp .5s ease;">
            <div class="sh-card-header">
                <div>
                    <div class="sh-card-title">Refund Requests ({{ $refunds->total() }})</div>
                    @if(request('status') || request('search'))
                        <div class="sh-card-sub">
                            Filtered results
                            @if(request('status'))<span class="sh-pill sh-pill-{{ request('status') }}" style="margin-left:6px;">{{ ucfirst(request('status')) }}</span>@endif
                        </div>
                    @endif
                </div>
                <label style="display:flex; align-items:center; gap:6px; font-size:13px; color:var(--sub); cursor:pointer;">
                    <input type="checkbox" id="masterCheck" onchange="toggleAll(this)"
                        style="width:14px; height:14px; accent-color:var(--accent);">
                    Select All
                </label>
            </div>

            @if($refunds->isEmpty())
                <div class="sh-empty">
                    <div class="sh-empty-icon">📭</div>
                    <div class="sh-empty-title">No refund requests found</div>
                    <div class="sh-empty-sub">
                        @if(request('search') || request('status'))
                            No results match your filters.
                            <a href="{{ route('seller.refunds.index') }}" style="margin-left:4px;">Clear filters</a>
                        @else
                            You don't have any refund requests at the moment.
                        @endif
                    </div>
                </div>
            @else
                <div class="sh-table-wrap">
                    <table class="sh-table">
                        <thead>
                            <tr>
                                <th style="width:40px; padding-left:22px;"></th>
                                <th>Refund ID</th>
                                <th>Order</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Requested</th>
                                <th style="text-align:right; padding-right:22px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($refunds as $refund)
                            <tr class="refund-row" data-id="{{ $refund->sl_no }}">
                                <td style="padding-left:22px;">
                                    <input type="checkbox" class="refund-check" value="{{ $refund->sl_no }}"
                                        style="width:14px; height:14px; cursor:pointer; accent-color:var(--accent);"
                                        onchange="updateBulkCount()">
                                </td>
                                <td>
                                    <span style="font-family:var(--mono); font-size:12px; font-weight:600; color:var(--accent);">
                                        #{{ $refund->sl_no }}
                                    </span>
                                </td>
                                <td>
                                    @if($refund->order)
                                        <a href="{{ route('seller.orders.show', $refund->order_id) }}"
                                           style="font-size:12.5px; font-weight:600; color:var(--accent);">
                                            #{{ $refund->order_id }}
                                        </a>
                                    @else
                                        <span style="color:var(--sub);">#{{ $refund->order_id }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($refund->user)
                                        <div class="td-customer">
                                            <div class="cn">{{ $refund->user->name ?? 'User #'.$refund->user_id }}</div>
                                            <div class="ce">{{ $refund->user->email ?? '' }}</div>
                                        </div>
                                    @else
                                        <span style="color:var(--sub); font-size:12px;">User #{{ $refund->user_id }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($refund->orderItem && $refund->orderItem->product)
                                        <div class="td-product">
                                            @if($refund->orderItem->product->image)
                                                <img src="{{ asset('storage/'.$refund->orderItem->product->image) }}" alt="Product">
                                            @else
                                                <div class="prod-ph">📦</div>
                                            @endif
                                            <div>
                                                <div style="font-size:12.5px; font-weight:600; color:var(--text);">
                                                    {{ Str::limit($refund->orderItem->product->name, 28) }}
                                                </div>
                                                <div style="font-size:11px; color:var(--sub);">Qty: {{ $refund->orderItem->quantity ?? 1 }}</div>
                                            </div>
                                        </div>
                                    @else
                                        <span style="color:var(--sub); font-size:12px;">Product #{{ $refund->order_item_id }}</span>
                                    @endif
                                </td>
                                <td>
                                    <span style="font-family:var(--mono); font-weight:700; color:var(--text);">
                                        @if($refund->orderItem)
                                            ${{ number_format($refund->orderItem->price * ($refund->orderItem->quantity ?? 1), 2) }}
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $pillMap = [
                                            'pending'  => 'pending',
                                            'approved' => 'approved',
                                            'rejected' => 'rejected',
                                            'refunded' => 'refunded',
                                        ];
                                    @endphp
                                    <span class="sh-pill sh-pill-{{ $pillMap[$refund->status] ?? 'secondary' }}">
                                        {{ ucfirst($refund->status) }}
                                    </span>
                                </td>
                                <td style="white-space:nowrap;">
                                    <div style="font-size:12.5px; font-weight:500; color:var(--text);">
                                        {{ $refund->requested_at->format('M d, Y') }}
                                    </div>
                                    <div style="font-size:11px; color:var(--sub);">
                                        {{ $refund->requested_at->format('h:i A') }}
                                    </div>
                                </td>
                                <td style="text-align:right; padding-right:22px;">
                                    <div class="act-row">
                                        {{-- View modal button --}}
                                        <button class="act-btn" onclick="openRefundModal({{ $refund->sl_no }})" title="View">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        @if($refund->status !== 'refunded')
                                        <div class="sh-dropdown">
                                            <button class="act-btn" onclick="toggleDropdown(this)">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="sh-dropdown-menu">
                                                @if($refund->status === 'pending')
                                                <form action="{{ route('seller.refunds.update-status', $refund->sl_no) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit" class="sh-dropdown-item success">
                                                        <i class="fas fa-check" style="width:14px;"></i> Approve
                                                    </button>
                                                </form>
                                                <form action="{{ route('seller.refunds.update-status', $refund->sl_no) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="sh-dropdown-item danger">
                                                        <i class="fas fa-times" style="width:14px;"></i> Reject
                                                    </button>
                                                </form>
                                                @endif

                                                @if($refund->status === 'approved')
                                                <form action="{{ route('seller.refunds.update-status', $refund->sl_no) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="status" value="refunded">
                                                    <button type="submit" class="sh-dropdown-item info">
                                                        <i class="fas fa-money-bill-wave" style="width:14px;"></i> Mark Refunded
                                                    </button>
                                                </form>
                                                @endif

                                                <div class="sh-dropdown-divider"></div>
                                                <a href="{{ route('seller.refunds.show', $refund->sl_no) }}" class="sh-dropdown-item">
                                                    <i class="fas fa-external-link-alt" style="width:14px;"></i> View Details
                                                </a>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($refunds->hasPages())
                <div class="sh-card-footer" style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px;">
                    <span style="font-size:12.5px; color:var(--sub);">
                        Showing {{ $refunds->firstItem() }}–{{ $refunds->lastItem() }} of {{ $refunds->total() }} entries
                    </span>
                    <div class="sh-pagination">
                        {{ $refunds->withQueryString()->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
                @endif
            @endif
        </div>

    </main>
</div>

{{-- View Refund Modal --}}
<div class="sh-modal-overlay" id="refundModal">
    <div class="sh-modal">
        <div class="sh-modal-header">
            <div class="sh-modal-title">↩️ Refund Request Details</div>
            <button class="sh-modal-close" onclick="closeRefundModal()">✕</button>
        </div>
        <div class="sh-modal-body" id="refundModalBody">
            <div style="text-align:center; padding:30px; color:var(--sub);">Loading…</div>
        </div>
        <div class="sh-modal-footer">
            <button class="sh-btn sh-btn-secondary" onclick="closeRefundModal()">Close</button>
        </div>
    </div>
</div>

<div class="sh-toast-container" id="toastContainer"></div>

<script>
/* ── Checkboxes ── */
function toggleAll(cb) {
    document.querySelectorAll('.refund-check').forEach(c => c.checked = cb.checked);
    updateBulkCount();
}
function updateBulkCount() {
    const n = document.querySelectorAll('.refund-check:checked').length;
    const bar = document.getElementById('bulkBar');
    document.getElementById('bulkCount').textContent = n + ' selected';
    bar.classList.toggle('show', n > 0);
}

/* ── Bulk Apply ── */
document.getElementById('applyBulk')?.addEventListener('click', function() {
    const status = document.getElementById('bulkStatusSelect').value;
    const ids = Array.from(document.querySelectorAll('.refund-check:checked')).map(c => c.value);
    if (!status) { showToast('Please select an action', 'warning'); return; }
    if (!ids.length) { showToast('Please select at least one request', 'warning'); return; }
    if (!confirm(`Update ${ids.length} refund(s) to "${status}"?`)) return;

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("seller.refunds.bulk-update") }}';
    const fields = { _token: '{{ csrf_token() }}', status, action: 'update' };
    Object.entries(fields).forEach(([k,v]) => {
        const i = document.createElement('input'); i.type='hidden'; i.name=k; i.value=v; form.appendChild(i);
    });
    ids.forEach(id => {
        const i = document.createElement('input'); i.type='hidden'; i.name='refund_ids[]'; i.value=id; form.appendChild(i);
    });
    document.body.appendChild(form);
    form.submit();
});

document.getElementById('clearBulk')?.addEventListener('click', function() {
    document.querySelectorAll('.refund-check').forEach(c => c.checked = false);
    document.getElementById('masterCheck').checked = false;
    updateBulkCount();
});

/* ── Confirm before form submit ── */
document.querySelectorAll('form[action*="update-status"]').forEach(f => {
    f.addEventListener('submit', function(e) {
        const status = this.querySelector('input[name="status"]').value;
        if (!confirm(`Are you sure you want to ${status} this refund?`)) e.preventDefault();
    });
});

/* ── Modal ── */
function openRefundModal(id) {
    document.getElementById('refundModalBody').innerHTML = `
        <div style="text-align:center; padding:30px; color:var(--sub);">
            <span style="font-size:24px; display:block; margin-bottom:8px;">🔄</span>
            Loading refund #${id}…
        </div>`;
    document.getElementById('refundModal').classList.add('open');
    // In production: fetch('/seller/refunds/' + id) and populate modal
    // For now show placeholder:
    setTimeout(() => {
        document.getElementById('refundModalBody').innerHTML = `
            <div style="display:flex; flex-direction:column; gap:14px;">
                <div style="background:var(--bg); border:1px solid var(--border); border-radius:10px; padding:16px;">
                    <div style="font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.6px; color:var(--sub); margin-bottom:6px;">Refund ID</div>
                    <div style="font-family:var(--mono); font-weight:700; color:var(--accent); font-size:15px;">#${id}</div>
                </div>
                <p style="color:var(--sub); font-size:13px; text-align:center;">
                    For full details, <a href="/seller/refunds/${id}">open the detail page</a>.
                </p>
            </div>`;
    }, 400);
}
function closeRefundModal() {
    document.getElementById('refundModal').classList.remove('open');
}
document.getElementById('refundModal').addEventListener('click', function(e) {
    if (e.target === this) closeRefundModal();
});

/* ── Dropdown ── */
function toggleDropdown(btn) {
    const dd = btn.closest('.sh-dropdown');
    document.querySelectorAll('.sh-dropdown.open').forEach(d => { if (d !== dd) d.classList.remove('open'); });
    dd.classList.toggle('open');
}
document.addEventListener('click', e => {
    if (!e.target.closest('.sh-dropdown')) document.querySelectorAll('.sh-dropdown.open').forEach(d => d.classList.remove('open'));
});

/* ── Toast ── */
function showToast(msg, type = 'info') {
    const icons = { success:'✅', error:'❌', warning:'⚠️', info:'ℹ️' };
    const t = document.createElement('div');
    t.className = `sh-toast ${type}`;
    t.innerHTML = `<span>${icons[type]}</span><span>${msg}</span>`;
    document.getElementById('toastContainer').appendChild(t);
    setTimeout(() => t.remove(), 3500);
}

/* ── Auto dismiss flash ── */
setTimeout(() => document.querySelectorAll('.sh-flash').forEach(f => f.style.opacity = '0'), 4500);
</script>
</body>
</html>