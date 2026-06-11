@extends('admin.layouts.basic')

@section('title', 'Refund & Return Requests')
@section('page-title', 'Refund & Return Requests')

@push('styles')
<style>
/* ── reset ─────────────────────────────────── */
.rf-wrap * { box-sizing: border-box; }
.rf-wrap { font-size: 14px; color: var(--ink); line-height: 1.6; }

/* ── stat cards ────────────────────────────── */
.rf-stats {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 14px;
    margin-bottom: 22px;
}
.rf-stat {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 16px 18px;
    display: flex;
    align-items: center;
    gap: 14px;
    box-shadow: var(--shadow-sm);
}
.rf-stat-icon {
    width: 42px; height: 42px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 17px;
    flex-shrink: 0;
}
.rf-stat-label { font-size: 11px; color: var(--muted); text-transform: uppercase; letter-spacing: .5px; margin-bottom: 2px; }
.rf-stat-value { font-size: 22px; font-weight: 700; color: var(--ink); line-height: 1.2; }

/* ── filter card ───────────────────────────── */
.rf-filter-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 16px 20px;
    margin-bottom: 18px;
    box-shadow: var(--shadow-sm);
}
.rf-filter-row {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    align-items: flex-end;
}
.rf-filter-group { display: flex; flex-direction: column; gap: 4px; }
.rf-filter-group label { font-size: 11.5px; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: .4px; }
.rf-input, .rf-select {
    height: 36px;
    padding: 0 12px;
    border: 1px solid var(--border);
    border-radius: 8px;
    font-size: 13px;
    color: var(--ink);
    background: var(--surface);
    outline: none;
    transition: border-color .15s;
    font-family: inherit;
}
.rf-input:focus, .rf-select:focus { border-color: var(--accent); background: #fff; }
.rf-input { width: 220px; }
.rf-select { padding-right: 30px; appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236b7280' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 10px center; }
.rf-btn {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 0 16px; height: 36px;
    border-radius: 8px;
    font-size: 13px; font-weight: 600;
    border: 1px solid transparent;
    cursor: pointer; transition: opacity .15s, background .15s;
    font-family: inherit; text-decoration: none;
    white-space: nowrap;
}
.rf-btn:hover { opacity: .88; }
.rf-btn-primary { background: var(--accent); color: #fff; border-color: var(--accent); }
.rf-btn-ghost   { background: #fff; color: var(--ink); border-color: var(--border); }
.rf-btn-green   { background: var(--green); color: #fff; }
.rf-btn-red     { background: var(--red); color: #fff; }
.rf-btn-amber   { background: var(--amber); color: #fff; }
.rf-btn-sm { height: 30px; padding: 0 12px; font-size: 12px; }

/* ── main table card ───────────────────────── */
.rf-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
}
.rf-card-head {
    display: flex; align-items: center; justify-content: space-between;
    padding: 14px 20px;
    border-bottom: 1px solid var(--border);
    background: var(--surface);
    gap: 10px; flex-wrap: wrap;
}
.rf-card-head h3 {
    margin: 0; font-size: 14px; font-weight: 700; color: var(--ink);
    display: flex; align-items: center; gap: 8px;
}
.rf-card-head h3 i { color: var(--accent); font-size: 15px; }

/* ── table ─────────────────────────────────── */
.rf-table { width: 100%; border-collapse: collapse; font-size: 13px; }
.rf-table thead tr { background: var(--surface); }
.rf-table thead th {
    padding: 11px 14px;
    text-align: left; font-size: 11.5px; font-weight: 700;
    text-transform: uppercase; letter-spacing: .5px; color: var(--muted);
    white-space: nowrap; border-bottom: 1px solid var(--border);
}
.rf-table thead th.center { text-align: center; }
.rf-table thead th.right  { text-align: right; }
.rf-table tbody tr { border-bottom: 1px solid #f3f4f6; transition: background .1s; }
.rf-table tbody tr:last-child { border-bottom: none; }
.rf-table tbody tr:hover { background: #f9fafb; }
.rf-table td { padding: 13px 14px; vertical-align: middle; color: var(--ink); }
.rf-table td.center { text-align: center; }
.rf-table td.right  { text-align: right; }
.rf-table .mono { font-family: 'SF Mono', 'Consolas', monospace; font-size: 12px; color: var(--muted); }
.rf-table .muted { color: #9ca3af; }

/* ── checkbox col ──────────────────────────── */
.rf-check { width: 18px; height: 18px; cursor: pointer; accent-color: var(--accent); }

/* ── product cell ──────────────────────────── */
.rf-prod-cell { display: flex; align-items: center; gap: 10px; }
.rf-thumb {
    width: 40px; height: 40px; object-fit: cover;
    border-radius: 6px; border: 1px solid var(--border); flex-shrink: 0;
}
.rf-thumb-ph {
    width: 40px; height: 40px; border-radius: 6px; background: var(--surface-2);
    display: flex; align-items: center; justify-content: center;
    color: #d1d5db; font-size: 15px; flex-shrink: 0;
}
.rf-prod-name { font-weight: 600; color: var(--ink); font-size: 13px; max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.rf-prod-sku  { font-size: 11px; color: var(--muted); margin-top: 1px; }

/* ── badges ─────────────────────────────────── */
.badge {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 3px 10px; border-radius: 999px;
    font-size: 11.5px; font-weight: 700; line-height: 1.4;
    white-space: nowrap;
}
.badge-green   { background: #dcfce7; color: #15803d; }
.badge-red     { background: #fee2e2; color: #b91c1c; }
.badge-yellow  { background: #fef9c3; color: #a16207; }
.badge-blue    { background: #dbeafe; color: #1d4ed8; }
.badge-purple  { background: #ede9fe; color: #6d28d9; }
.badge-gray    { background: #f3f4f6; color: #4b5563; }
.badge-cyan    { background: #cffafe; color: #0e7490; }
.badge-dot::before {
    content: ''; width: 6px; height: 6px; border-radius: 50%;
    background: currentColor; display: inline-block;
}

/* ── empty state ─────────────────────────────── */
.rf-empty { text-align: center; padding: 56px 20px; color: var(--muted); }
.rf-empty i { font-size: 40px; display: block; margin-bottom: 14px; color: #d1d5db; }
.rf-empty p { margin: 0; font-size: 14px; }

/* ── pagination ──────────────────────────────── */
.rf-pagination { display: flex; justify-content: flex-end; padding: 14px 20px; border-top: 1px solid var(--border); }

/* ─── MODAL ──────────────────────────────────── */
.rf-modal-overlay {
    display: none; position: fixed; inset: 0;
    background: rgba(13,15,20,.5);
    z-index: 9000; align-items: flex-start; justify-content: center;
    padding: 40px 16px; overflow-y: auto;
    backdrop-filter: blur(3px);
}
.rf-modal-overlay.open { display: flex; }

.rf-modal {
    background: #fff; border-radius: 14px;
    width: 100%; max-width: 780px; margin: auto;
    box-shadow: 0 24px 60px rgba(0,0,0,.16);
    overflow: hidden;
    animation: rfModalIn .2s ease;
}
@keyframes rfModalIn {
    from { opacity:0; transform: translateY(-16px) scale(.98); }
    to   { opacity:1; transform: translateY(0) scale(1); }
}
.rf-modal-head {
    display: flex; align-items: center; justify-content: space-between;
    padding: 16px 22px; background: var(--surface);
    border-bottom: 1px solid var(--border); gap: 10px; flex-wrap: wrap;
}
.rf-modal-title {
    font-size: 15px; font-weight: 700; color: var(--ink);
    display: flex; align-items: center; gap: 8px; margin: 0;
}
.rf-modal-title i { color: var(--accent); }
.rf-modal-close {
    width: 32px; height: 32px; border: none; background: var(--surface-2);
    border-radius: 8px; cursor: pointer; font-size: 15px; color: var(--muted);
    display: flex; align-items: center; justify-content: center;
    transition: background .15s, color .15s;
}
.rf-modal-close:hover { background: var(--red-bg); color: var(--red); }
.rf-modal-body { padding: 22px; }

/* section heading inside modal */
.rf-modal-sec {
    font-size: 11px; font-weight: 700; text-transform: uppercase;
    letter-spacing: .6px; color: var(--muted);
    margin: 0 0 10px; padding-bottom: 6px;
    border-bottom: 1px solid #f3f4f6;
}
.rf-modal-grid {
    display: grid; grid-template-columns: repeat(auto-fill, minmax(230px,1fr));
    gap: 18px; margin-bottom: 20px;
}
.rf-kv { width: 100%; border-collapse: collapse; font-size: 13px; }
.rf-kv tr { border-bottom: 1px solid #f9fafb; }
.rf-kv tr:last-child { border-bottom: none; }
.rf-kv td { padding: 7px 4px; vertical-align: middle; }
.rf-kv td:first-child { color: var(--muted); width: 130px; font-size: 12.5px; white-space: nowrap; }
.rf-kv td:last-child  { font-weight: 600; color: var(--ink); }

/* status update form inside modal */
.rf-modal-form-card {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: 10px; padding: 18px 20px; margin-top: 20px;
}
.rf-modal-form-card h4 {
    font-size: 13px; font-weight: 700; color: var(--ink);
    margin: 0 0 14px; display: flex; align-items: center; gap: 7px;
}
.rf-modal-form-card h4 i { color: var(--accent); }
.rf-form-row { display: flex; flex-wrap: wrap; gap: 12px; align-items: flex-end; }
.rf-form-group { display: flex; flex-direction: column; gap: 5px; }
.rf-form-group label { font-size: 11.5px; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: .4px; }
.rf-form-group .rf-input,
.rf-form-group .rf-select { height: 38px; }
.rf-textarea {
    width: 100%; padding: 10px 12px;
    border: 1px solid var(--border); border-radius: 8px;
    font-size: 13px; font-family: inherit; color: var(--ink);
    background: #fff; outline: none; resize: vertical; min-height: 72px;
    transition: border-color .15s;
}
.rf-textarea:focus { border-color: var(--accent); }

.rf-img-grid { display: flex; gap: 8px; flex-wrap: wrap; }
.rf-img-grid a img {
    width: 72px; height: 72px; object-fit: cover;
    border-radius: 8px; border: 1px solid var(--border);
    transition: opacity .15s;
}
.rf-img-grid a img:hover { opacity: .75; }

/* sort icon */
.sort-link { color: inherit; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; white-space: nowrap; }
.sort-link:hover { color: var(--accent); }
</style>
@endpush

@section('content')
<div class="rf-wrap">

{{-- ══════════════════════════════════
     STAT CHIPS
══════════════════════════════════ --}}
<div class="rf-stats">
    @php
    $statItems = [
        ['Total',      $stats['total'],      'fas fa-undo-alt',     '#eff6ff','#1d4ed8'],
        ['Pending',    $stats['pending'],    'fas fa-clock',        '#fffbeb','#b45309'],
        ['Refunded',   $stats['refunded'],   'fas fa-spinner',      '#ede9fe','#6d28d9'],
        ['Approved',   $stats['approved'],   'fas fa-check-circle', '#f0fdf4','#15803d'],
        ['Rejected',   $stats['rejected'],   'fas fa-times-circle', '#fff1f2','#be123c'],
    ];
    @endphp
    @foreach($statItems as [$lbl, $val, $icon, $bg, $col])
    <div class="rf-stat">
        <div class="rf-stat-icon" style="background:{{ $bg }}; color:{{ $col }};"><i class="{{ $icon }}"></i></div>
        <div>
            <div class="rf-stat-label">{{ $lbl }}</div>
            <div class="rf-stat-value">{{ $val }}</div>
        </div>
    </div>
    @endforeach
</div>

{{-- ══════════════════════════════════
     FILTERS
══════════════════════════════════ --}}
<div class="rf-filter-card">
    <form method="GET" action="{{ route('admin.refunds.index') }}">
        <div class="rf-filter-row">

            <div class="rf-filter-group" style="flex:1; min-width:200px;">
                <label>Search</label>
                <div style="position:relative;">
                    <i class="fas fa-search" style="position:absolute; left:10px; top:50%; transform:translateY(-50%); color:var(--muted); font-size:12px;"></i>
                    <input type="text" name="search" class="rf-input" style="width:100%; padding-left:30px;"
                           placeholder="Refund ID, Order ID, user name…"
                           value="{{ request('search') }}">
                </div>
            </div>

            <div class="rf-filter-group">
                <label>Status</label>
                <select name="status" class="rf-select" style="width:140px;">
                    <option value="all"       {{ request('status','all') === 'all'       ? 'selected' : '' }}>All statuses</option>
                    <option value="pending"   {{ request('status') === 'pending'         ? 'selected' : '' }}>Pending</option>
                    <option value="refunded"  {{ request('status') === 'refunded'      ? 'selected' : '' }}>Refunded</option>
                    <option value="approved"  {{ request('status') === 'approved'        ? 'selected' : '' }}>Approved</option>
                    <option value="rejected"  {{ request('status') === 'rejected'        ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <div class="rf-filter-group">
                <label>Reason</label>
                <select name="reason" class="rf-select" style="width:160px;">
                    <option value="all">All reasons</option>
                    @foreach($reasons as $r)
                    <option value="{{ $r }}" {{ request('reason') === $r ? 'selected' : '' }}>
                        {{ ucwords(str_replace('_',' ', $r)) }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="rf-filter-group">
                <label>From</label>
                <input type="date" name="date_from" class="rf-input" style="width:140px;" value="{{ request('date_from') }}">
            </div>

            <div class="rf-filter-group">
                <label>To</label>
                <input type="date" name="date_to" class="rf-input" style="width:140px;" value="{{ request('date_to') }}">
            </div>

            <div style="display:flex; gap:8px;">
                <button type="submit" class="rf-btn rf-btn-primary"><i class="fas fa-filter"></i> Filter</button>
                <a href="{{ route('admin.refunds.index') }}" class="rf-btn rf-btn-ghost"><i class="fas fa-times"></i> Clear</a>
            </div>

            <div style="margin-left:auto; display:flex; gap:8px;">
@if(auth()->guard('admin')->user()->hasRole('manager'))
                <a href="{{ route('admin.refunds.export', request()->query()) }}" class="rf-btn rf-btn-ghost">
                    <i class="fas fa-download"></i> CSV
                </a>
@endif
            </div>
        </div>
    </form>
</div>

{{-- ══════════════════════════════════
     MAIN TABLE CARD
══════════════════════════════════ --}}
<form method="POST" action="{{ route('admin.refunds.bulk') }}" id="bulkForm">
@csrf
<div class="rf-card">

    <div class="rf-card-head">
        <h3><i class="fas fa-undo-alt"></i> Refund & Return Requests
            <span style="background:#f3f4f6; color:#4b5563; border-radius:999px; padding:1px 9px; font-size:12px; font-weight:700;">
                {{ $refunds->total() }}
            </span>
        </h3>

        {{-- bulk actions: manager+ only --}}
        @if(auth()->guard('admin')->user()->hasRole('manager'))
        <div style="display:flex; gap:8px; align-items:center; flex-wrap:wrap;">
            <select name="action" class="rf-select" style="width:160px;" id="bulkAction">
                <option value="">— Bulk action —</option>
                <option value="approve">Approve selected</option>
                <option value="refunded">Mark refunded</option>
                <option value="reject">Reject selected</option>
                <option value="delete">Delete selected</option>
            </select>
            <button type="button" class="rf-btn rf-btn-primary rf-btn-sm" onclick="submitBulk()">
                <i class="fas fa-check"></i> Apply
            </button>
        </div>
        @endif
    </div>

    @if($refunds->count())
    <div style="overflow-x: auto;">
        <table class="rf-table">
            <thead>
                <tr>
                    @if(auth()->guard('admin')->user()->hasRole('manager'))
                    <th style="width:36px;">
                        <input type="checkbox" class="rf-check" id="checkAll" onchange="toggleAll(this)">
                    </th>
                    @endif
                    <th>
                        <a href="{{ request()->fullUrlWithQuery(['sort_by'=>'refund_id', 'sort_order'=> request('sort_order','desc')==='asc'?'desc':'asc']) }}" class="sort-link">
                            Refund ID <i class="fas fa-sort" style="font-size:10px; color:#d1d5db;"></i>
                        </a>
                    </th>
                    <th>Order</th>
                    <th>User</th>
                    <th>Item</th>
                    <th>Reason</th>
                    <th class="center">Status</th>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery(['sort_by'=>'requested_at', 'sort_order'=> request('sort_order','desc')==='asc'?'desc':'asc']) }}" class="sort-link">
                            Requested <i class="fas fa-sort" style="font-size:10px; color:#d1d5db;"></i>
                        </a>
                    </th>
                    <th class="center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($refunds as $refund)
                @php
                    $rs = strtolower($refund->status ?? 'pending');
                    $rbadge = ['pending'=>'badge-yellow','approved'=>'badge-green','rejected'=>'badge-red','refunded'=>'badge-blue'];
                @endphp
                <tr>
                    {{-- checkbox --}}
                    <td>
@if(auth()->guard('admin')->user()->hasRole('manager'))
                        <input type="checkbox" name="refund_ids[]" value="{{ $refund->sl_no }}" class="rf-check row-check">
@endif
                    </td>

                    {{-- refund id --}}
                    <td>
                        <span class="mono">{{ $refund->refund_id }}</span>
                    </td>

                    {{-- order --}}
                    <td>
                        <a href="{{ route('admin.orders.show', $refund->order_id) }}"
                           style="font-weight:600; color:var(--accent); text-decoration:none; font-size:13px;"
                           onclick="event.stopPropagation()">
                            #{{ $refund->order_id }}
                        </a>
                    </td>

                    {{-- user --}}
                    <td>
                        @if($refund->user)
                        <a href="{{ route('admin.users.show', $refund->user) }}"
                           style="font-weight:600; color:var(--ink); text-decoration:none;"
                           onclick="event.stopPropagation()">
                            {{ $refund->user->name }}
                        </a>
                        <div style="font-size:11.5px; color:var(--muted);">{{ $refund->user->email }}</div>
                        @else
                        <span class="muted">—</span>
                        @endif
                    </td>

                    {{-- item --}}
                    <td>
                        @if($refund->orderItem)
                        <div class="rf-prod-cell">
                            @if($refund->orderItem->product && $refund->orderItem->product->thumbnail)
                                <img src="{{ asset('storage/'.$refund->orderItem->product->thumbnail) }}" class="rf-thumb" onerror="this.style.display='none'">
                            @else
                                <div class="rf-thumb-ph"><i class="fas fa-image"></i></div>
                            @endif
                            <div>
                                <div class="rf-prod-name">{{ $refund->orderItem->product->name ?? 'Product #'.$refund->orderItem->product_id }}</div>
                                <div style="display:flex; gap:4px; flex-wrap:wrap; margin-top:3px;">
                                    @if($refund->orderItem->variant)
                                        <span class="badge badge-purple" style="font-size:10px;">{{ $refund->orderItem->variant->variant_name }}</span>
                                    @endif
                                    @if($refund->orderItem->size)
                                        <span class="badge badge-blue" style="font-size:10px;">{{ $refund->orderItem->size }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @else
                        <span class="muted">—</span>
                        @endif
                    </td>

                    {{-- reason --}}
                    <td style="max-width:160px;">
                        <div style="font-size:13px; font-weight:600; color:var(--ink);">
                            {{ ucwords(str_replace('_',' ', $refund->reason ?? '—')) }}
                        </div>
                        @if($refund->comments)
                        <div style="font-size:11.5px; color:var(--muted); margin-top:2px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; max-width:150px;">
                            {{ $refund->comments }}
                        </div>
                        @endif
                    </td>

                    {{-- status --}}
                    <td class="center">
                        <span class="badge {{ $rbadge[$rs] ?? 'badge-gray' }} badge-dot">
                            {{ ucfirst($rs) }}
                        </span>
                    </td>

                    {{-- date --}}
                    <td style="font-size:12.5px; color:var(--muted); white-space:nowrap;">
                        {{ $refund->requested_at ? $refund->requested_at->format('d M Y') : '—' }}<br>
                        <span style="font-size:11px;">{{ $refund->requested_at ? $refund->requested_at->format('h:i A') : '' }}</span>
                    </td>

                    {{-- actions --}}
                    <td class="center">
                        <div style="display:flex; gap:6px; justify-content:center; flex-wrap:wrap;">
                            <button type="button"
                                class="rf-btn rf-btn-ghost rf-btn-sm"
                                onclick="openDetailModal({{ $refund->sl_no }})"
                                title="View details">
                                <i class="fas fa-eye"></i> View
                            </button>

                            @if($rs === 'pending' || $rs === 'refunded')
                            <button type="button"
                                class="rf-btn rf-btn-sm"
                                style="background:#f0fdf4; color:#15803d; border:1px solid #bbf7d0;"
                                onclick="openStatusModal({{ $refund->sl_no }}, '{{ $refund->refund_id }}', '{{ $rs }}')"
                                title="Update status">
                                <i class="fas fa-edit"></i>
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- pagination --}}
    @if($refunds->hasPages())
    <div class="rf-pagination">
        {{ $refunds->links() }}
    </div>
    @endif

    @else
    <div class="rf-empty">
        <i class="fas fa-undo-alt"></i>
        <p>No refund or return requests found.</p>
    </div>
    @endif

</div>
</form>

{{-- ══════════════════════════════════
     DETAIL MODAL
══════════════════════════════════ --}}
<div class="rf-modal-overlay" id="detailModal" onclick="if(event.target===this)closeModal('detailModal')">
    <div class="rf-modal">
        <div class="rf-modal-head">
            <h2 class="rf-modal-title"><i class="fas fa-undo-alt"></i> <span id="dm-title">Refund Detail</span></h2>
            <div style="display:flex; align-items:center; gap:10px;">
                <span id="dm-badge"></span>
                <button class="rf-modal-close" onclick="closeModal('detailModal')"><i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="rf-modal-body" id="dm-body">
            <div style="text-align:center; padding:40px 0; color:var(--muted);">
                <i class="fas fa-spinner fa-spin" style="font-size:28px; margin-bottom:12px;"></i>
                <p>Loading…</p>
            </div>
        </div>
    </div>
</div>

{{-- ══════════════════════════════════
     STATUS UPDATE MODAL
══════════════════════════════════ --}}
<div class="rf-modal-overlay" id="statusModal" onclick="if(event.target===this)closeModal('statusModal')">
    <div class="rf-modal" style="max-width:520px;">
        <div class="rf-modal-head">
            <h2 class="rf-modal-title"><i class="fas fa-edit"></i> Update Status — <span id="sm-refund-id"></span></h2>
            <button class="rf-modal-close" onclick="closeModal('statusModal')"><i class="fas fa-times"></i></button>
        </div>
        <div class="rf-modal-body">
            <form method="POST" id="statusForm">
                @csrf
                @method('PATCH')

                <div class="rf-modal-grid" style="grid-template-columns:1fr;">
                    <div class="rf-form-group">
                        <label>New Status</label>
                        <select name="status" class="rf-select" id="sm-status" style="width:100%;">
                            <option value="pending">Pending</option>
                            <option value="refunded">Refunded</option>
                            <option value="approved">Approved — credits wallet</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                </div>

                <div class="rf-form-group" id="sm-amount-group" style="margin-bottom:14px; display:none;">
                    <label>Refund Amount</label>
                    <div style="position:relative;">
                        <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:var(--muted);font-weight:600;font-size:13px;">₹</span>
                        <input type="number" name="refund_amount" id="sm-refund-amount"
                               class="rf-input" style="width:100%;padding-left:26px;"
                               step="0.01" min="0.01" required>
                    </div>
                    <div id="sm-amount-hint" style="font-size:11.5px;color:var(--muted);margin-top:4px;"></div>
                </div>

                <div class="rf-form-group" style="margin-bottom:18px;">
                    <label>Admin Note <span style="color:var(--muted); font-weight:400;">(optional)</span></label>
                    <textarea name="admin_note" class="rf-textarea" placeholder="Internal note about this decision…"></textarea>
                </div>

                <div style="display:flex; justify-content:flex-end; gap:10px;">
                    <button type="button" class="rf-btn rf-btn-ghost" onclick="closeModal('statusModal')">Cancel</button>
                    <button type="submit" class="rf-btn rf-btn-primary"><i class="fas fa-save"></i> Save status</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>{{-- /.rf-wrap --}}

{{-- ══════════════════════════════════
     EMBEDDED REFUND DATA
══════════════════════════════════ --}}
<script>
/* ── refund data store: sl_no → object ── */
var RF = {
@foreach($refunds as $refund)
{{ $refund->sl_no }}: {
    slNo:       {{ $refund->sl_no }},
    refundId:   "{{ $refund->refund_id }}",
    orderId:    "{{ $refund->order_id }}",
    status:     "{{ strtolower($refund->status ?? 'pending') }}",
    reason:     "{{ addslashes(ucwords(str_replace('_',' ', $refund->reason ?? ''))) }}",
    comments:   "{{ addslashes($refund->comments ?? '') }}",
    requestedAt:"{{ $refund->requested_at ? $refund->requested_at->format('d M Y, h:i A') : '—' }}",
    userName:   "{{ addslashes($refund->user->name  ?? '—') }}",
    userEmail:  "{{ $refund->user->email ?? '—' }}",
    userId:     {{ $refund->user_id ?? 'null' }},
    @if($refund->orderItem)
    @php $oi = $refund->orderItem; @endphp
    itemName:   "{{ addslashes($oi->product->name ?? 'Product #'.$oi->product_id) }}",
    itemSku:    "{{ $oi->product->sku ?? '' }}",
    itemThumb:  "{{ $oi->product && $oi->product->thumbnail ? asset('storage/'.$oi->product->thumbnail) : '' }}",
    itemVariant:"{{ addslashes($oi->variant->variant_name ?? '') }}",
    itemSize:   "{{ $oi->size ?? '' }}",
    itemQty:    {{ $oi->quantity }},
    itemPrice:  "{{ number_format($oi->price, 2) }}",
    itemTotal:  "{{ number_format($oi->price * $oi->quantity, 2) }}",
    @else
    itemName:'', itemSku:'', itemThumb:'', itemVariant:'', itemSize:'', itemQty:0, itemPrice:'0.00', itemTotal:'0.00',
    @endif
    images: [
        @if(!empty($refund->images) && count($refund->images))
            @foreach($refund->images as $img)
            "{{ asset('storage/'.$img) }}",
            @endforeach
        @endif
    ],
    updateUrl: "{{ route('admin.refunds.update-status', $refund->sl_no) }}"
},
@endforeach
};

/* ── badge map ── */
var RBADGE = { pending:'badge-yellow', approved:'badge-green', rejected:'badge-red', refunded:'badge-blue' };
function makeBadge(status) {
    var cls = RBADGE[status] || 'badge-gray';
    return '<span class="badge '+cls+' badge-dot">'+status.charAt(0).toUpperCase()+status.slice(1)+'</span>';
}

/* ── modal open/close ── */
function openModal(id)  { document.getElementById(id).classList.add('open');    document.body.style.overflow='hidden'; }
function closeModal(id) { document.getElementById(id).classList.remove('open'); document.body.style.overflow=''; }
document.addEventListener('keydown', function(e){ if(e.key==='Escape'){ closeModal('detailModal'); closeModal('statusModal'); } });

/* ── detail modal ── */
function openDetailModal(slNo) {
    var r = RF[slNo];
    if (!r) return;
    document.getElementById('dm-title').textContent = 'Refund #' + r.refundId;
    document.getElementById('dm-badge').innerHTML   = makeBadge(r.status);

    var html = '';

    /* meta strip */
    var metaItems = [
        ['Refund ID',   '<span style="font-family:monospace;font-size:12px;">'+r.refundId+'</span>'],
        ['Order',       '<a href="/admin/orders/'+r.orderId+'" style="color:var(--accent);font-weight:600;">#'+r.orderId+'</a>'],
        ['User',        '<a href="/admin/users/'+r.userId+'" style="color:var(--ink);font-weight:600;">'+r.userName+'</a><br><span style="font-size:11.5px;color:var(--muted);">'+r.userEmail+'</span>'],
        ['Requested',   '<span style="font-size:12.5px;color:var(--muted);">'+r.requestedAt+'</span>'],
        ['Status',      makeBadge(r.status)],
    ];
    html += '<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(150px,1fr));gap:1px;background:var(--border);border:1px solid var(--border);border-radius:10px;overflow:hidden;margin-bottom:20px;">';
    metaItems.forEach(function(m) {
        html += '<div style="background:var(--surface);padding:10px 16px;">';
        html += '<div style="font-size:10.5px;color:var(--muted);text-transform:uppercase;letter-spacing:.4px;margin-bottom:3px;">'+m[0]+'</div>';
        html += '<div style="font-size:13px;font-weight:600;color:var(--ink);">'+m[1]+'</div>';
        html += '</div>';
    });
    html += '</div>';

    /* item + reason */
    html += '<div class="rf-modal-grid">';

    if (r.itemName) {
        html += '<div><p class="rf-modal-sec">Item</p>';
        var img = r.itemThumb
            ? '<img src="'+r.itemThumb+'" style="width:52px;height:52px;object-fit:cover;border-radius:8px;border:1px solid var(--border);" onerror="this.style.display=\'none\'">'
            : '<div style="width:52px;height:52px;border-radius:8px;background:var(--surface-2);display:flex;align-items:center;justify-content:center;color:#d1d5db;font-size:18px;"><i class="fas fa-image"></i></div>';
        html += '<div style="display:flex;gap:12px;align-items:flex-start;">'+img+'<div>';
        html += '<div style="font-weight:600;font-size:14px;color:var(--ink);margin-bottom:4px;">'+r.itemName+'</div>';
        if (r.itemSku)     html += '<div style="font-size:11px;color:var(--muted);margin-bottom:5px;">SKU: '+r.itemSku+'</div>';
        if (r.itemVariant) html += '<span class="badge badge-purple" style="font-size:10px;margin-right:4px;">'+r.itemVariant+'</span>';
        if (r.itemSize)    html += '<span class="badge badge-blue" style="font-size:10px;">'+r.itemSize+'</span>';
        html += '<table class="rf-kv" style="margin-top:8px;">';
        html += '<tr><td>Quantity</td><td>'+r.itemQty+'</td></tr>';
        html += '<tr><td>Unit price</td><td>&#8377;'+r.itemPrice+'</td></tr>';
        html += '<tr><td>Item total</td><td style="color:#dc2626;font-weight:700;">&#8377;'+r.itemTotal+'</td></tr>';
        html += '</table></div></div></div>';
    }

    html += '<div><p class="rf-modal-sec">Reason & Comments</p>';
    html += '<div style="font-size:15px;font-weight:700;color:var(--ink);margin-bottom:10px;">'+r.reason+'</div>';
    if (r.comments) {
        html += '<div style="background:var(--surface);border:1px solid var(--border);border-radius:8px;padding:12px 14px;font-size:13px;color:#374151;line-height:1.7;">'+r.comments+'</div>';
    }
    html += '</div></div>';

    /* images */
    if (r.images && r.images.length > 0) {
        html += '<hr style="border:none;border-top:1px solid #f3f4f6;margin:18px 0;">';
        html += '<p class="rf-modal-sec" style="margin-bottom:12px;">Attached Images</p>';
        html += '<div class="rf-img-grid">';
        r.images.forEach(function(src) {
            html += '<a href="'+src+'" target="_blank"><img src="'+src+'" alt="Refund image"></a>';
        });
        html += '</div>';
    }

    /* quick status update shortcut inside detail modal */
    html += '<div class="rf-modal-form-card"><h4><i class="fas fa-edit"></i> Quick Status Update</h4>';

    /* show auto-calculated amount for transparency */
    var itemTotal = parseFloat(r.itemTotal) || 0;
    if (itemTotal > 0) {
        html += '<div style="font-size:12px;color:var(--muted);margin-bottom:10px;">';
        html += '<i class="fas fa-info-circle" style="color:var(--accent);"></i> ';
        html += 'Approving will credit <strong style="color:var(--ink);">&#8377;' + r.itemTotal + '</strong> to customer wallet';
        html += ' (' + r.itemPrice + ' &times; ' + r.itemQty + ')';
        html += '</div>';
    }

    html += '<div style="display:flex;gap:10px;flex-wrap:wrap;">';
    var qBtns = [
        ['refunded', 'rf-btn-blue',  'fas fa-spinner', 'Mark Refunded'],
        ['approved', 'rf-btn-green', 'fas fa-check',   'Approve & Credit Wallet'],
        ['rejected', 'rf-btn-red',   'fas fa-times',   'Reject'],
    ];
    qBtns.forEach(function(b) {
        if (b[0] !== r.status) {
            html += '<form method="POST" action="'+r.updateUrl+'" style="display:inline;">';
            html += '<input type="hidden" name="_token" value="{{ csrf_token() }}">';
            html += '<input type="hidden" name="_method" value="PATCH">';
            html += '<input type="hidden" name="status" value="'+b[0]+'">';
            /* always include refund_amount — controller requires it when status=approved */
            if (b[0] === 'approved') {
                html += '<input type="hidden" name="refund_amount" value="'+itemTotal.toFixed(2)+'">';
            }
            html += '<button type="submit" class="rf-btn '+b[1]+' rf-btn-sm" style="height:34px;">';
            html += '<i class="'+b[2]+'"></i> '+b[3]+'</button></form>';
        }
    });
    html += '</div></div>';

    document.getElementById('dm-body').innerHTML = html;
    openModal('detailModal');
}

/* ── status update modal ── */
function openStatusModal(slNo, refundId, currentStatus) {
    var r = RF[slNo];
    if (!r) return;

    document.getElementById('sm-refund-id').textContent = '#' + refundId;
    document.getElementById('sm-status').value = currentStatus;
    document.getElementById('statusForm').action = r.updateUrl;

    var amountInput = document.getElementById('sm-refund-amount');
    var amountGroup = document.getElementById('sm-amount-group');
    var amountHint  = document.getElementById('sm-amount-hint');
    var statusSel   = document.getElementById('sm-status');

    /* Pre-fill with item total whenever modal opens */
    var itemTotal = parseFloat(r.itemTotal) || 0;
    if (amountInput) {
        amountInput.value = itemTotal > 0 ? itemTotal.toFixed(2) : '';
    }
    if (amountHint) {
        amountHint.textContent = itemTotal > 0
            ? 'Auto-filled from item total (₹' + r.itemPrice + ' × ' + r.itemQty + '). Edit to override.'
            : 'No item total found — enter amount manually.';
    }

    function toggleFields() {
        var isApproval = statusSel.value === 'approved';
        amountGroup.style.display = isApproval ? '' : 'none';
        if (amountInput) amountInput.required = isApproval;
    }
    statusSel.onchange = toggleFields;
    toggleFields(); /* run immediately to match current select value */

    closeModal('detailModal');
    openModal('statusModal');
}

/* ── bulk action ── */
function submitBulk() {
    var action = document.getElementById('bulkAction').value;
    if (!action) { alert('Please select a bulk action.'); return; }
    var checked = document.querySelectorAll('.row-check:checked');
    if (!checked.length) { alert('Please select at least one refund request.'); return; }
    if (action === 'delete' && !confirm('Delete ' + checked.length + ' refund request(s)?')) return;
    if (action === 'approve' && !confirm('Approve ' + checked.length + ' refund request(s)?')) return;
    document.getElementById('bulkForm').submit();
}

/* ── check-all ── */
function toggleAll(master) {
    document.querySelectorAll('.row-check').forEach(function(cb){ cb.checked = master.checked; });
}
</script>
@endsection