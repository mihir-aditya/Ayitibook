@extends('admin.layouts.basic')

@section('title', 'User: ' . $user->name)
@section('page-title', 'User Details')

@push('styles')
<style>
/* ── Reset & base ─────────────────────────────── */
.ud-wrap * { box-sizing: border-box; }
.ud-wrap { max-width: 1080px; font-size: 14px; color: #1f2937; line-height: 1.6; }

/* ── Cards ────────────────────────────────────── */
.ud-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    margin-bottom: 20px;
    overflow: hidden;
}
.ud-card-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 20px;
    background: #f9fafb;
    border-bottom: 1px solid #e5e7eb;
    gap: 10px;
    flex-wrap: wrap;
}
.ud-card-head h3 {
    margin: 0;
    font-size: 14px;
    font-weight: 700;
    color: #111827;
    display: flex;
    align-items: center;
    gap: 8px;
}
.ud-card-head h3 i { color: #dc2626; font-size: 15px; }
.ud-card-body { padding: 20px; }

/* ── Tabs ─────────────────────────────────────── */
.ud-tabs {
    display: flex;
    gap: 2px;
    border-bottom: 2px solid #e5e7eb;
    overflow-x: auto;
    scrollbar-width: none;
}
.ud-tabs::-webkit-scrollbar { display: none; }
.ud-tab-btn {
    padding: 10px 18px;
    border: none;
    background: transparent;
    cursor: pointer;
    font-size: 13px;
    font-weight: 600;
    color: #6b7280;
    border-bottom: 2px solid transparent;
    margin-bottom: -2px;
    white-space: nowrap;
    transition: color .15s, border-color .15s, background .15s;
    border-radius: 6px 6px 0 0;
    display: flex;
    align-items: center;
    gap: 6px;
}
.ud-tab-btn:hover { color: #374151; background: #f3f4f6; }
.ud-tab-btn.active { color: #dc2626; border-bottom-color: #dc2626; background: #fff5f5; }
.ud-tab-btn i { font-size: 13px; }

/* ── Stat chips ───────────────────────────────── */
.ud-stats {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 12px;
    margin-bottom: 20px;
}
.ud-stat {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    padding: 14px 16px;
    display: flex;
    align-items: center;
    gap: 12px;
}
.ud-stat-icon {
    width: 40px; height: 40px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
}
.ud-stat-label { font-size: 11px; color: #6b7280; text-transform: uppercase; letter-spacing: .5px; margin-bottom: 2px; }
.ud-stat-value { font-size: 20px; font-weight: 700; color: #111827; line-height: 1.2; }
.ud-stat-value.sm { font-size: 16px; }

/* ── Key-value rows ───────────────────────────── */
.ud-kv { width: 100%; border-collapse: collapse; font-size: 13.5px; }
.ud-kv tr { border-bottom: 1px solid #f3f4f6; }
.ud-kv tr:last-child { border-bottom: none; }
.ud-kv td { padding: 9px 4px; vertical-align: middle; }
.ud-kv td:first-child { color: #6b7280; width: 155px; font-size: 12.5px; white-space: nowrap; }
.ud-kv td:last-child { font-weight: 600; color: #111827; }

/* ── Section title inside card ────────────────── */
.ud-section-title {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .6px;
    color: #6b7280;
    margin: 0 0 12px;
    padding-bottom: 6px;
    border-bottom: 1px solid #f3f4f6;
}

/* ── Badges ───────────────────────────────────── */
.badge {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 3px 10px;
    border-radius: 999px;
    font-size: 11.5px;
    font-weight: 700;
    line-height: 1.4;
}
.badge-green   { background: #dcfce7; color: #15803d; }
.badge-red     { background: #fee2e2; color: #b91c1c; }
.badge-yellow  { background: #fef9c3; color: #a16207; }
.badge-blue    { background: #dbeafe; color: #1d4ed8; }
.badge-purple  { background: #ede9fe; color: #6d28d9; }
.badge-cyan    { background: #cffafe; color: #0e7490; }
.badge-pink    { background: #fce7f3; color: #9d174d; }
.badge-gray    { background: #f3f4f6; color: #4b5563; }
.badge-indigo  { background: #e0e7ff; color: #3730a3; }
.badge-teal    { background: #ccfbf1; color: #0f766e; }

/* ── Tables ───────────────────────────────────── */
.ud-table { width: 100%; border-collapse: collapse; font-size: 13px; }
.ud-table thead tr { background: #f9fafb; }
.ud-table thead th {
    padding: 11px 14px;
    text-align: left;
    font-size: 11.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
    color: #6b7280;
    white-space: nowrap;
    border-bottom: 1px solid #e5e7eb;
}
.ud-table tbody tr { border-bottom: 1px solid #f3f4f6; transition: background .1s; }
.ud-table tbody tr:last-child { border-bottom: none; }
.ud-table tbody tr:hover { background: #fafafa; }
.ud-table td { padding: 12px 14px; vertical-align: middle; color: #1f2937; }
.ud-table tfoot td {
    padding: 12px 14px;
    background: #f9fafb;
    border-top: 2px solid #e5e7eb;
    font-weight: 700;
    color: #111827;
}
.ud-table .mono { font-family: 'SF Mono', 'Consolas', monospace; font-size: 12px; color: #6b7280; }
.ud-table .muted { color: #9ca3af; }
.ud-table .right { text-align: right; }
.ud-table .center { text-align: center; }

/* ── Product thumbnail ────────────────────────── */
.ud-thumb {
    width: 42px; height: 42px;
    object-fit: cover;
    border-radius: 6px;
    border: 1px solid #e5e7eb;
    flex-shrink: 0;
}
.ud-thumb-placeholder {
    width: 42px; height: 42px;
    border-radius: 6px;
    background: #f3f4f6;
    display: flex; align-items: center; justify-content: center;
    color: #d1d5db;
    font-size: 16px;
    flex-shrink: 0;
}

/* ── Product row in order ─────────────────────── */
.ud-product-cell { display: flex; align-items: center; gap: 10px; }
.ud-product-name { font-weight: 600; color: #111827; font-size: 13px; }
.ud-product-sku  { font-size: 11px; color: #9ca3af; margin-top: 1px; }

/* ── Order card ───────────────────────────────── */
.ud-order-card {
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    margin-bottom: 16px;
    overflow: hidden;
    background: #fff;
}
.ud-order-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 14px 18px;
    background: #f9fafb;
    border-bottom: 1px solid #e5e7eb;
    flex-wrap: wrap; gap: 10px;
}
.ud-order-id { font-size: 15px; font-weight: 700; color: #111827; }
.ud-order-id span { color: #dc2626; }
.ud-order-date { font-size: 12px; color: #9ca3af; margin-top: 2px; }
.ud-order-meta {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 1px;
    background: #f3f4f6;
    border-bottom: 1px solid #e5e7eb;
}
.ud-order-meta-cell {
    background: #fff;
    padding: 12px 18px;
}
.ud-order-meta-label { font-size: 11px; color: #9ca3af; text-transform: uppercase; letter-spacing: .4px; margin-bottom: 4px; }
.ud-order-meta-value { font-size: 13px; font-weight: 600; color: #111827; display: flex; align-items: center; gap: 6px; }

/* ── Refund item card ─────────────────────────── */
.ud-refund-card {
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    margin-bottom: 14px;
    overflow: hidden;
    background: #fff;
}
.ud-refund-header {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 1px;
    background: #f3f4f6;
    border-bottom: 1px solid #e5e7eb;
}
.ud-refund-header-cell {
    background: #f9fafb;
    padding: 10px 16px;
}
.ud-refund-label { font-size: 10.5px; color: #9ca3af; text-transform: uppercase; letter-spacing: .4px; margin-bottom: 3px; }
.ud-refund-value { font-size: 13px; font-weight: 600; color: #111827; }

/* ── Info grid 2-col ──────────────────────────── */
.ud-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 24px;
}

/* ── Wallet credit/debit color ────────────────── */
.cr { color: #15803d; font-weight: 700; }
.dr { color: #b91c1c; font-weight: 700; }

/* ── Address box ──────────────────────────────── */
.ud-address {
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 14px 16px;
    font-size: 13.5px;
    line-height: 1.8;
    color: #374151;
}

/* ── Action buttons ───────────────────────────── */
.ud-btn {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    border: 1px solid transparent;
    cursor: pointer;
    transition: opacity .15s;
}
.ud-btn:hover { opacity: .85; text-decoration: none; }
.ud-btn-primary { background: #dc2626; color: #fff; border-color: #dc2626; }
.ud-btn-amber   { background: #f59e0b; color: #fff; border-color: #f59e0b; }
.ud-btn-indigo  { background: #4f46e5; color: #fff; border-color: #4f46e5; }
.ud-btn-ghost   { background: #fff; color: #374151; border-color: #d1d5db; }

/* ── Avatar ───────────────────────────────────── */
.ud-avatar {
    width: 72px; height: 72px;
    background: #dc2626;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 28px; font-weight: 700;
    flex-shrink: 0;
    letter-spacing: -.5px;
}

/* ── Empty state ──────────────────────────────── */
.ud-empty {
    text-align: center;
    padding: 48px 20px;
    color: #9ca3af;
}
.ud-empty i { font-size: 36px; display: block; margin-bottom: 12px; color: #d1d5db; }
.ud-empty p { margin: 0; font-size: 14px; }

/* ── Divider ──────────────────────────────────── */
.ud-divider { border: none; border-top: 1px solid #f3f4f6; margin: 18px 0; }

/* ── Panel ────────────────────────────────────── */
.ud-panel { display: none; }
.ud-panel.active { display: block; }

/* ══════════════════════════════════════════
   MODAL OVERLAY
══════════════════════════════════════════ */
.ud-modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(17,24,39,.55);
    z-index: 9000;
    align-items: flex-start;
    justify-content: center;
    padding: 32px 16px 32px;
    overflow-y: auto;
    backdrop-filter: blur(2px);
}
.ud-modal-overlay.open { display: flex; }

.ud-modal {
    background: #fff;
    border-radius: 14px;
    width: 100%;
    max-width: 820px;
    margin: auto;
    box-shadow: 0 20px 60px rgba(0,0,0,.18);
    overflow: hidden;
    animation: modalIn .2s ease;
}
@keyframes modalIn {
    from { opacity: 0; transform: translateY(-18px) scale(.98); }
    to   { opacity: 1; transform: translateY(0) scale(1); }
}

.ud-modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 22px;
    border-bottom: 1px solid #e5e7eb;
    background: #f9fafb;
    gap: 12px;
    flex-wrap: wrap;
}
.ud-modal-title {
    font-size: 16px;
    font-weight: 700;
    color: #111827;
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 0;
}
.ud-modal-title i { color: #dc2626; }
.ud-modal-close {
    width: 32px; height: 32px;
    border: none;
    background: #f3f4f6;
    border-radius: 8px;
    cursor: pointer;
    font-size: 16px;
    color: #6b7280;
    display: flex; align-items: center; justify-content: center;
    transition: background .15s, color .15s;
    flex-shrink: 0;
}
.ud-modal-close:hover { background: #fee2e2; color: #dc2626; }
.ud-modal-body { padding: 22px; }

/* modal section headings */
.ud-modal-section {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .6px;
    color: #6b7280;
    margin: 0 0 10px;
    padding-bottom: 6px;
    border-bottom: 1px solid #f3f4f6;
}

/* modal grid */
.ud-modal-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 18px;
    margin-bottom: 20px;
}

/* progress tracker in modal */
.ud-progress { display: flex; align-items: flex-start; position: relative; margin: 4px 0 20px; }
.ud-progress::before {
    content: '';
    position: absolute;
    top: 15px; left: 0; right: 0; height: 2px;
    background: #e5e7eb; z-index: 0;
}
.ud-progress-fill {
    position: absolute; top: 15px; left: 0; height: 2px;
    background: #dc2626; z-index: 1; transition: width .4s ease;
}
.ud-progress-step {
    flex: 1; display: flex; flex-direction: column;
    align-items: center; position: relative; z-index: 2;
}
.ud-progress-dot {
    width: 30px; height: 30px;
    border-radius: 50%; border: 2px solid #d1d5db;
    background: #fff;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; color: #d1d5db;
    margin-bottom: 6px; transition: all .3s;
}
.ud-progress-step.done .ud-progress-dot  { background: #dc2626; border-color: #dc2626; color: #fff; }
.ud-progress-step.active .ud-progress-dot { background: #fff; border-color: #dc2626; color: #dc2626; box-shadow: 0 0 0 3px rgba(220,38,38,.12); }
.ud-progress-label { font-size: 10px; color: #9ca3af; text-align: center; font-weight: 500; white-space: nowrap; }
.ud-progress-step.done .ud-progress-label,
.ud-progress-step.active .ud-progress-label { color: #dc2626; font-weight: 700; }

/* cancelled pill */
.ud-cancelled-strip {
    background: #fee2e2;
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 13px;
    color: #b91c1c;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 18px;
}

/* items list inside modal */
.ud-modal-items { width: 100%; border-collapse: collapse; font-size: 13px; margin-bottom: 14px; }
.ud-modal-items thead th {
    font-size: 11px; font-weight: 700; text-transform: uppercase;
    letter-spacing: .4px; color: #9ca3af; padding: 0 0 10px; text-align: left;
    border-bottom: 1px solid #f3f4f6;
}
.ud-modal-items thead th:last-child { text-align: right; }
.ud-modal-items tbody tr { border-bottom: 1px dashed #f3f4f6; }
.ud-modal-items tbody tr:last-child { border-bottom: none; }
.ud-modal-items td { padding: 11px 0; vertical-align: middle; }
.ud-modal-items td:last-child { text-align: right; font-weight: 700; color: #dc2626; }

/* price rows */
.ud-price-rows { border-top: 1px solid #f3f4f6; padding-top: 12px; }
.ud-price-row { display: flex; justify-content: space-between; font-size: 13.5px; margin-bottom: 8px; }
.ud-price-row .lbl { color: #6b7280; }
.ud-price-row .val { font-weight: 600; color: #111827; }
.ud-price-row.total { border-top: 1px dashed #e5e7eb; padding-top: 10px; margin-top: 4px; }
.ud-price-row.total .lbl { font-size: 15px; font-weight: 700; color: #111827; }
.ud-price-row.total .val { font-size: 16px; font-weight: 700; color: #dc2626; }

/* address box in modal */
.ud-modal-address {
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 12px 14px;
    font-size: 13px;
    line-height: 1.8;
    color: #374151;
}

/* delivery partner strip */
.ud-dp-strip {
    display: flex;
    align-items: center;
    gap: 14px;
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    padding: 14px 16px;
}
.ud-dp-avatar {
    width: 44px; height: 44px;
    border-radius: 50%;
    background: #dc2626;
    color: #fff;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; font-weight: 700;
    flex-shrink: 0;
}

/* refund images in modal */
.ud-modal-img-grid { display: flex; gap: 8px; flex-wrap: wrap; }
.ud-modal-img-grid a img {
    width: 72px; height: 72px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    transition: opacity .15s;
}
.ud-modal-img-grid a img:hover { opacity: .75; }

/* clickable row hint */
.ud-order-card { cursor: pointer; transition: box-shadow .15s; }
.ud-order-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,.08); }
.ud-refund-card { cursor: pointer; transition: box-shadow .15s; }
.ud-refund-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,.08); }
</style>
@endpush

@section('content')
<div class="ud-wrap">

{{-- ════════════════════════════════════
     HEADER CARD
════════════════════════════════════ --}}
<div class="ud-card" style="margin-bottom: 20px;">
    <div class="ud-card-body">

        {{-- Profile row --}}
        <div style="display: flex; align-items: flex-start; gap: 18px; margin-bottom: 20px; flex-wrap: wrap;">
            <div class="ud-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
            <div style="flex: 1; min-width: 200px;">
                <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                    <h2 style="margin: 0; font-size: 20px; font-weight: 700; color: #111827;">{{ $user->name }}</h2>
                    @if($user->status == 1)
                        <span class="badge badge-green"><i class="fas fa-circle" style="font-size:7px;"></i> Active</span>
                    @else
                        <span class="badge badge-red"><i class="fas fa-circle" style="font-size:7px;"></i> Inactive</span>
                    @endif
                    @if($user->email_verified_at)
                        <span class="badge badge-blue"><i class="fas fa-check" style="font-size:9px;"></i> Verified</span>
                    @else
                        <span class="badge badge-gray">Unverified</span>
                    @endif
                    @if($user->kyc_verified)
                        <span class="badge badge-teal"><i class="fas fa-id-card" style="font-size:9px;"></i> KYC</span>
                    @endif
                </div>
                <div style="margin-top: 6px; display: flex; flex-wrap: wrap; gap: 16px;">
                    <span style="font-size: 13px; color: #6b7280;"><i class="fas fa-envelope" style="color:#dc2626; margin-right:5px;"></i>{{ $user->email }}</span>
                    @if($user->phone)
                    <span style="font-size: 13px; color: #6b7280;"><i class="fas fa-phone" style="color:#dc2626; margin-right:5px;"></i>{{ $user->phone }}</span>
                    @endif
                    <span style="font-size: 13px; color: #6b7280;"><i class="fas fa-wallet" style="color:#dc2626; margin-right:5px;"></i>&#8377;{{ number_format($walletStats['balance'], 2) }}</span>
                    <span style="font-size: 13px; color: #9ca3af;"><i class="fas fa-hashtag" style="margin-right:3px;"></i>{{ $user->id }}</span>
                </div>
                @if($user->last_login_at)
                <div style="margin-top: 5px; font-size: 12px; color: #9ca3af;">
                    <i class="fas fa-clock" style="margin-right:4px;"></i>Last login: {{ \Carbon\Carbon::parse($user->last_login_at)->format('d M Y, h:i A') }}
                    @if($user->last_login_ip) &nbsp;&middot;&nbsp; {{ $user->last_login_ip }}@endif
                </div>
                @endif
            </div>
            <div style="display: flex; gap: 8px; flex-wrap: wrap; align-items: flex-start;">
                <a href="{{ route('admin.users.edit', $user) }}" class="ud-btn ud-btn-amber">
                    <i class="fas fa-edit"></i> Edit
                </a>
                @if($user->bnplProfile)
                    <a href="{{ route('admin.bnpl.users.show', $user) }}" class="ud-btn ud-btn-indigo">
                        <i class="fas fa-credit-card"></i> BNPL
                    </a>
                @endif
                <a href="{{ route('admin.users.index') }}" class="ud-btn ud-btn-ghost">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>

        {{-- Tab nav --}}
        <div class="ud-tabs">
            @php
                $tabs = [
                    'overview'     => ['icon' => 'fas fa-user-circle',  'label' => 'Overview'],
                    'orders'       => ['icon' => 'fas fa-shopping-bag', 'label' => 'Orders',   'count' => $ordersStats->total_orders ?? 0],
                    'transactions' => ['icon' => 'fas fa-credit-card',  'label' => 'Payments', 'count' => $transactions->count()],
                    'wallet'       => ['icon' => 'fas fa-wallet',       'label' => 'Wallet',   'count' => $walletTransactions->count()],
                    'refunds'      => ['icon' => 'fas fa-undo-alt',     'label' => 'Refunds',  'count' => $refundRequests->count()],
                ];
            @endphp
            @foreach($tabs as $key => $tab)
            <button class="ud-tab-btn" id="tab-btn-{{ $key }}" onclick="switchTab('{{ $key }}')">
                <i class="{{ $tab['icon'] }}"></i>
                {{ $tab['label'] }}
                @if(isset($tab['count']) && $tab['count'] > 0)
                    <span style="background:#f3f4f6; color:#4b5563; border-radius:999px; padding:1px 7px; font-size:11px; font-weight:700;">{{ $tab['count'] }}</span>
                @endif
            </button>
            @endforeach
        </div>
    </div>
</div>

{{-- ════════════════════════════════════
     STATS ROW
════════════════════════════════════ --}}
<div class="ud-stats">
    @php
        $statItems = [
            ['label'=>'Total Orders',    'value'=>$ordersStats->total_orders    ?? 0,  'icon'=>'fas fa-shopping-bag', 'bg'=>'#eff6ff', 'color'=>'#1d4ed8'],
            ['label'=>'Total Spent',     'value'=>'&#8377;'.number_format($ordersStats->total_spent ?? 0, 2), 'icon'=>'fas fa-rupee-sign', 'bg'=>'#f0fdf4','color'=>'#15803d','sm'=>true],
            ['label'=>'Pending Orders',  'value'=>$ordersStats->pending_orders  ?? 0,  'icon'=>'fas fa-clock',  'bg'=>'#fffbeb', 'color'=>'#b45309'],
            ['label'=>'Cancelled',       'value'=>$ordersStats->cancelled_orders ?? 0, 'icon'=>'fas fa-ban',   'bg'=>'#fff1f2', 'color'=>'#be123c'],
            ['label'=>'Refund Requests', 'value'=>$refundRequests->count(),            'icon'=>'fas fa-undo',  'bg'=>'#faf5ff', 'color'=>'#7e22ce'],
            ['label'=>'Wallet Balance',  'value'=>'&#8377;'.number_format($walletStats['balance'], 2), 'icon'=>'fas fa-wallet', 'bg'=>'#f0fdfa','color'=>'#0f766e','sm'=>true],
        ];
    @endphp
    @foreach($statItems as $s)
    <div class="ud-stat">
        <div class="ud-stat-icon" style="background:{{ $s['bg'] }}; color:{{ $s['color'] }};"><i class="{{ $s['icon'] }}"></i></div>
        <div>
            <div class="ud-stat-label">{{ $s['label'] }}</div>
            <div class="ud-stat-value {{ isset($s['sm']) ? 'sm' : '' }}">{!! $s['value'] !!}</div>
        </div>
    </div>
    @endforeach
</div>

{{-- ════════════════════════════════════
     OVERVIEW PANEL
════════════════════════════════════ --}}
<div class="ud-panel" id="tab-overview">

    <div class="ud-card">
        <div class="ud-card-head"><h3><i class="fas fa-user-circle"></i> Account details</h3></div>
        <div class="ud-card-body">
            <div class="ud-info-grid">
                <div>
                    <p class="ud-section-title">Personal information</p>
                    <table class="ud-kv">
                        <tr><td>User ID</td><td style="font-family:monospace; font-size:12px;">#{{ $user->id }}</td></tr>
                        <tr><td>Full name</td><td>{{ $user->name }}</td></tr>
                        @if($user->username)
                        <tr><td>Username</td><td>@{{ $user->username }}</td></tr>
                        @endif
                        <tr><td>Email</td><td>{{ $user->email }}</td></tr>
                        <tr><td>Phone</td><td>{{ $user->phone ?? '—' }}</td></tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                @if($user->status == 1)
                                    <span class="badge badge-green">Active</span>
                                @else
                                    <span class="badge badge-red">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>KYC</td>
                            <td>
                                @if($user->kyc_verified)
                                    <span class="badge badge-teal">Verified</span>
                                @else
                                    <span class="badge badge-gray">Not verified</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div>
                    <p class="ud-section-title">Account activity</p>
                    <table class="ud-kv">
                        <tr><td>Member since</td><td>{{ $user->created_at->format('d M Y') }}</td></tr>
                        <tr><td>Last updated</td><td>{{ $user->updated_at->format('d M Y, h:i A') }}</td></tr>
                        <tr>
                            <td>Email verified</td>
                            <td>
                                @if($user->email_verified_at)
                                    <span style="color:#15803d; font-weight:600;">{{ $user->email_verified_at->format('d M Y') }}</span>
                                @else
                                    <span style="color:#b91c1c;">Not verified</span>
                                @endif
                            </td>
                        </tr>
                        <tr><td>Last login</td><td>{{ $user->last_login_at ? \Carbon\Carbon::parse($user->last_login_at)->format('d M Y, h:i A') : '—' }}</td></tr>
                        <tr><td>Last login IP</td><td style="font-family:monospace; font-size:12px;">{{ $user->last_login_ip ?? '—' }}</td></tr>
                        <tr><td>Wallet balance</td><td style="font-weight:700; color:#0f766e;">&#8377;{{ number_format($walletStats['balance'], 2) }}</td></tr>
                    </table>
                </div>
            </div>

            @if($user->address || $user->city || $user->state || $user->country)
            <hr class="ud-divider">
            <p class="ud-section-title" style="margin-bottom: 10px;">Address</p>
            <div class="ud-address">
                @if($user->address)<div>{{ $user->address }}</div>@endif
                <div>{{ implode(', ', array_filter([$user->city ?? '', $user->state ?? '', $user->zip_code ?? ''])) }}</div>
                @if($user->country)<div>{{ $user->country }}</div>@endif
            </div>
            @endif
        </div>
    </div>

    @if($user->bnplProfile)
    @php $bp = $user->bnplProfile; @endphp
    <div class="ud-card">
        <div class="ud-card-head">
            <h3><i class="fas fa-credit-card" style="color:#4f46e5;"></i> BNPL Profile</h3>
            <a href="{{ route('admin.bnpl.users.show', $user) }}" class="ud-btn ud-btn-indigo" style="padding:5px 12px; font-size:12px;">
                View full BNPL <i class="fas fa-arrow-right" style="font-size:10px;"></i>
            </a>
        </div>
        <div class="ud-card-body">
            <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(150px,1fr)); gap:12px;">
                @foreach([
                    ['Credit score',  $bp->credit_score ?? 0],
                    ['Tier',          ucfirst($bp->tier ?? 'None')],
                    ['Credit limit',  '&#8377;'.number_format($bp->credit_limit ?? 0,2)],
                    ['Used credit',   '&#8377;'.number_format($bp->used_credit  ?? 0,2)],
                    ['Status',        ($bp->is_eligible && $bp->is_enabled) ? 'Active' : 'Inactive'],
                ] as [$lbl,$val])
                <div style="background:#f9fafb; border:1px solid #e5e7eb; border-radius:8px; padding:12px 14px;">
                    <div class="ud-stat-label">{{ $lbl }}</div>
                    <div style="font-size:17px; font-weight:700; color:#111827; margin-top:4px;">{!! $val !!}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

</div>{{-- /overview --}}

{{-- ════════════════════════════════════
     ORDERS PANEL
════════════════════════════════════ --}}
<div class="ud-panel" id="tab-orders">
    @forelse($orders as $order)
    @php
        $oStatus = strtolower($order->order_status ?? 'pending');
        $oBadge  = ['pending'=>'badge-yellow','confirmed'=>'badge-blue','processing'=>'badge-purple','shipped'=>'badge-cyan','delivered'=>'badge-green','completed'=>'badge-green','cancelled'=>'badge-red','refunded'=>'badge-pink'];
        $oClass  = $oBadge[$oStatus] ?? 'badge-gray';
        $borderColor = ['pending'=>'#f59e0b','confirmed'=>'#3b82f6','processing'=>'#7c3aed','shipped'=>'#0891b2','delivered'=>'#15803d','completed'=>'#15803d','cancelled'=>'#dc2626','refunded'=>'#9d174d'];
        $bc = $borderColor[$oStatus] ?? '#d1d5db';
    @endphp
    <div class="ud-order-card" style="border-left: 3px solid {{ $bc }};" onclick="openOrderModal('{{ $order->order_id ?? $order->sl_no }}')" title="Click to view full order details">

        {{-- Order header --}}
        <div class="ud-order-header">
            <div>
                <div class="ud-order-id">#<span>{{ $order->order_id ?? $order->sl_no }}</span></div>
                <div class="ud-order-date">
                    <i class="far fa-calendar-alt" style="margin-right:4px;"></i>
                    {{ $order->placed_at ? \Carbon\Carbon::parse($order->placed_at)->format('d M Y, h:i A') : 'N/A' }}
                </div>
            </div>
            <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
                <span class="badge {{ $oClass }}">{{ ucfirst($oStatus) }}</span>
                @php $ps = strtolower($order->payment_status ?? 'pending'); @endphp
                <span class="badge {{ $ps === 'paid' ? 'badge-green' : ($ps === 'failed' ? 'badge-red' : 'badge-yellow') }}">
                    {{ ucfirst($ps) }}
                </span>
                <div style="text-align:right;">
                    <div style="font-size:11px; color:#9ca3af; text-transform:uppercase; letter-spacing:.4px;">Total</div>
                    <div style="font-size:17px; font-weight:700; color:#111827;">&#8377;{{ number_format($order->total_amount, 2) }}</div>
                </div>
            </div>
        </div>

        {{-- Meta strip --}}
        <div class="ud-order-meta">
            <div class="ud-order-meta-cell">
                <div class="ud-order-meta-label">Payment method</div>
                <div class="ud-order-meta-value">
                    <i class="fas fa-credit-card" style="color:#dc2626; font-size:13px;"></i>
                    {{ ucwords(str_replace(['_','-'],' ', $order->payment_method ?? 'N/A')) }}
                </div>
            </div>
            @if($order->address)
            <div class="ud-order-meta-cell">
                <div class="ud-order-meta-label">Ship to</div>
                <div class="ud-order-meta-value" style="font-size:12.5px;">
                    <i class="fas fa-map-marker-alt" style="color:#dc2626; font-size:12px;"></i>
                    {{ $order->address->full_name ?? $user->name }},
                    {{ $order->address->city ?? '' }}{{ !empty($order->address->state) ? ', '.$order->address->state : '' }}
                </div>
            </div>
            @endif
            <div class="ud-order-meta-cell">
                <div class="ud-order-meta-label">Items</div>
                <div class="ud-order-meta-value">{{ $order->items->count() }} item{{ $order->items->count() != 1 ? 's' : '' }}</div>
            </div>
        </div>

        {{-- Items table --}}
        <div style="overflow-x: auto;">
            <table class="ud-table">
                <thead>
                    <tr>
                        <th style="width:38%;">Product</th>
                        <th>Variant / Size</th>
                        <th class="center">Qty</th>
                        <th class="right">Unit price</th>
                        <th class="right">Subtotal</th>
                        <th class="center">Refund</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>
                            <div class="ud-product-cell">
                                @if($item->product && $item->product->thumbnail)
                                    <img src="{{ asset('storage/'.$item->product->thumbnail) }}" class="ud-thumb" onerror="this.style.display='none'">
                                @else
                                    <div class="ud-thumb-placeholder"><i class="fas fa-image"></i></div>
                                @endif
                                <div>
                                    <div class="ud-product-name">{{ $item->product->name ?? 'Product #'.$item->product_id }}</div>
                                    <div class="ud-product-sku">SKU: {{ $item->product->sku ?? '—' }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="display:flex; gap:5px; flex-wrap:wrap; align-items:center;">
                                @if($item->variant)
                                    <span class="badge badge-purple">{{ $item->variant->variant_name }}</span>
                                @endif
                                @if($item->size)
                                    <span class="badge badge-blue">{{ $item->size }}</span>
                                @endif
                                @if(!$item->variant && !$item->size)
                                    <span style="color:#9ca3af;">—</span>
                                @endif
                            </div>
                        </td>
                        <td class="center" style="font-weight:700; font-size:14px;">{{ $item->quantity }}</td>
                        <td class="right" style="color:#374151;">&#8377;{{ number_format($item->price, 2) }}</td>
                        <td class="right" style="font-weight:700; color:#111827;">&#8377;{{ number_format($item->price * $item->quantity, 2) }}</td>
                        <td class="center">
                            @if($item->hasRefundRequest())
                                @php
                                    $rr = \App\Models\RefundRequest::where('order_item_id', $item->sl_no)->latest('requested_at')->first();
                                    $rrs = strtolower($rr->status ?? 'pending');
                                    $rrbadge = ['pending'=>'badge-yellow','approved'=>'badge-green','rejected'=>'badge-red','processing'=>'badge-purple'];
                                @endphp
                                <span class="badge {{ $rrbadge[$rrs] ?? 'badge-gray' }}">{{ ucfirst($rrs) }}</span>
                            @else
                                <span style="color:#d1d5db; font-size:18px; line-height:1;">·</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="right" style="font-size:13px; color:#6b7280;">Order total</td>
                        <td class="right" style="color:#dc2626; font-size:15px;">&#8377;{{ number_format($order->total_amount, 2) }}</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    @empty
    <div class="ud-card">
        <div class="ud-empty">
            <i class="fas fa-shopping-bag"></i>
            <p>No orders found for this user.</p>
        </div>
    </div>
    @endforelse
</div>{{-- /orders --}}

{{-- ════════════════════════════════════
     PAYMENTS PANEL
════════════════════════════════════ --}}
<div class="ud-panel" id="tab-transactions">
    <div class="ud-card">
        <div class="ud-card-head"><h3><i class="fas fa-credit-card"></i> Payment transactions</h3></div>
        @if($transactions->count())
        <div style="overflow-x:auto;">
            <table class="ud-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Transaction ID</th>
                        <th>Order</th>
                        <th>Type</th>
                        <th>Method</th>
                        <th class="right">Amount</th>
                        <th class="center">Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $i => $txn)
                    @php
                        $ts = strtolower($txn->transaction_status ?? 'pending');
                        $tbadge = ['success'=>'badge-green','pending'=>'badge-yellow','failed'=>'badge-red','refunded'=>'badge-purple'];
                    @endphp
                    <tr>
                        <td style="color:#9ca3af; font-size:12px; width:36px;">{{ $i + 1 }}</td>
                        <td><span class="mono">{{ $txn->transaction_id }}</span></td>
                        <td style="font-weight:600;">#{{ $txn->order_id ?? '—' }}</td>
                        <td>{{ ucwords(str_replace('_',' ', $txn->transaction_type ?? '')) }}</td>
                        <td>{{ ucwords(str_replace(['_','-'],' ', $txn->payment_method ?? 'N/A')) }}</td>
                        <td class="right" style="font-weight:700; font-size:14px;">&#8377;{{ number_format($txn->amount, 2) }}</td>
                        <td class="center">
                            <span class="badge {{ $tbadge[$ts] ?? 'badge-gray' }}">{{ ucfirst($ts) }}</span>
                        </td>
                        <td style="font-size:12.5px; color:#6b7280; white-space:nowrap;">
                            {{ $txn->transaction_date ? \Carbon\Carbon::parse($txn->transaction_date)->format('d M Y, h:i A') : '—' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="ud-empty"><i class="fas fa-receipt"></i><p>No payment transactions found.</p></div>
        @endif
    </div>
</div>{{-- /transactions --}}

{{-- ════════════════════════════════════
     WALLET PANEL
════════════════════════════════════ --}}
<div class="ud-panel" id="tab-wallet">

    <div class="ud-stats" style="grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); margin-bottom: 20px;">
        @foreach([
            ['Current balance', '&#8377;'.number_format($walletStats['balance'],2),   'fas fa-wallet',    '#f0fdfa','#0f766e'],
            ['Total credited',  '&#8377;'.number_format($walletStats['total_in'],2),  'fas fa-arrow-down','#f0fdf4','#15803d'],
            ['Total debited',   '&#8377;'.number_format($walletStats['total_out'],2), 'fas fa-arrow-up',  '#fff1f2','#be123c'],
        ] as [$lbl,$val,$icon,$bg,$col])
        <div class="ud-stat">
            <div class="ud-stat-icon" style="background:{{ $bg }}; color:{{ $col }};"><i class="{{ $icon }}"></i></div>
            <div>
                <div class="ud-stat-label">{{ $lbl }}</div>
                <div class="ud-stat-value sm">{!! $val !!}</div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="ud-card">
        <div class="ud-card-head"><h3><i class="fas fa-history"></i> Wallet history</h3></div>
        @if($walletTransactions->count())
        <div style="overflow-x:auto;">
            <table class="ud-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Transaction ID</th>
                        <th class="center">Type</th>
                        <th>Purpose</th>
                        <th class="right">Amount</th>
                        <th class="right">Balance after</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($walletTransactions as $i => $wt)
                    @php $isCredit = strtolower($wt->transaction_type) === 'credit'; @endphp
                    <tr>
                        <td style="color:#9ca3af; font-size:12px; width:36px;">{{ $i + 1 }}</td>
                        <td><span class="mono">{{ $wt->transaction_id }}</span></td>
                        <td class="center">
                            @if($isCredit)
                                <span class="badge badge-green"><i class="fas fa-arrow-down" style="font-size:9px;"></i> Credit</span>
                            @else
                                <span class="badge badge-red"><i class="fas fa-arrow-up" style="font-size:9px;"></i> Debit</span>
                            @endif
                        </td>
                        <td>{{ ucwords(str_replace('_',' ', $wt->purpose ?? '—')) }}</td>
                        <td class="right {{ $isCredit ? 'cr' : 'dr' }}" style="font-size:14px;">
                            {{ $isCredit ? '+' : '-' }}&#8377;{{ number_format($wt->amount, 2) }}
                        </td>
                        <td class="right" style="font-weight:600; color:#374151;">&#8377;{{ number_format($wt->balance_after, 2) }}</td>
                        <td style="font-size:12.5px; color:#6b7280; white-space:nowrap;">
                            {{ $wt->created_at ? \Carbon\Carbon::parse($wt->created_at)->format('d M Y, h:i A') : '—' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="ud-empty"><i class="fas fa-wallet"></i><p>No wallet transactions found.</p></div>
        @endif
    </div>
</div>{{-- /wallet --}}

{{-- ════════════════════════════════════
     REFUNDS PANEL
════════════════════════════════════ --}}
<div class="ud-panel" id="tab-refunds">
    @forelse($refundRequests as $rr)
    @php
        $rs = strtolower($rr->status ?? 'pending');
        $rbadge = ['pending'=>'badge-yellow','approved'=>'badge-green','rejected'=>'badge-red','processing'=>'badge-purple'];
    @endphp
    <div class="ud-refund-card" onclick="openRefundModal('{{ $rr->refund_id }}')" title="Click to view full refund details">

        <div class="ud-refund-header">
            <div class="ud-refund-header-cell">
                <div class="ud-refund-label">Refund ID</div>
                <div class="ud-refund-value" style="font-family:monospace; font-size:12.5px;">{{ $rr->refund_id }}</div>
            </div>
            <div class="ud-refund-header-cell">
                <div class="ud-refund-label">Order</div>
                <div class="ud-refund-value">#{{ $rr->order_id }}</div>
            </div>
            <div class="ud-refund-header-cell">
                <div class="ud-refund-label">Status</div>
                <div class="ud-refund-value"><span class="badge {{ $rbadge[$rs] ?? 'badge-gray' }}">{{ ucfirst($rs) }}</span></div>
            </div>
            <div class="ud-refund-header-cell">
                <div class="ud-refund-label">Requested</div>
                <div class="ud-refund-value" style="font-size:12px; font-weight:500; color:#6b7280;">
                    {{ $rr->requested_at ? $rr->requested_at->format('d M Y, h:i A') : '—' }}
                </div>
            </div>
        </div>

        <div style="padding: 16px 18px; display:grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 20px;">

            @if($rr->orderItem)
            <div>
                <p class="ud-section-title" style="margin-bottom:10px;">Item</p>
                <div class="ud-product-cell" style="align-items:flex-start;">
                    @if($rr->orderItem->product && $rr->orderItem->product->thumbnail)
                        <img src="{{ asset('storage/'.$rr->orderItem->product->thumbnail) }}" class="ud-thumb" onerror="this.style.display='none'">
                    @else
                        <div class="ud-thumb-placeholder"><i class="fas fa-image"></i></div>
                    @endif
                    <div>
                        <div class="ud-product-name">{{ $rr->orderItem->product->name ?? 'Product #'.$rr->orderItem->product_id }}</div>
                        <div style="display:flex; gap:5px; flex-wrap:wrap; margin-top:5px;">
                            @if($rr->orderItem->variant)
                                <span class="badge badge-purple">{{ $rr->orderItem->variant->variant_name }}</span>
                            @endif
                            @if($rr->orderItem->size)
                                <span class="badge badge-blue">{{ $rr->orderItem->size }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div>
                <p class="ud-section-title" style="margin-bottom:10px;">Reason</p>
                <div style="font-size:13.5px; font-weight:600; color:#111827; margin-bottom:8px;">
                    {{ ucwords(str_replace('_',' ', $rr->reason ?? '—')) }}
                </div>
                @if($rr->comments)
                <div style="background:#f9fafb; border:1px solid #e5e7eb; border-radius:8px; padding:10px 12px; font-size:13px; color:#374151; line-height:1.6;">
                    {{ $rr->comments }}
                </div>
                @endif
            </div>

            @if(!empty($rr->images) && count($rr->images))
            <div>
                <p class="ud-section-title" style="margin-bottom:10px;">Attached images</p>
                <div style="display:flex; gap:8px; flex-wrap:wrap;">
                    @foreach($rr->images as $img)
                    <a href="{{ asset('storage/'.$img) }}" target="_blank" style="display:block;">
                        <img src="{{ asset('storage/'.$img) }}"
                             style="width:64px; height:64px; object-fit:cover; border-radius:8px; border:1px solid #e5e7eb;"
                             onmouseover="this.style.opacity='.75'" onmouseout="this.style.opacity='1'">
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
    @empty
    <div class="ud-card">
        <div class="ud-empty"><i class="fas fa-undo-alt"></i><p>No refund requests found.</p></div>
    </div>
    @endforelse
</div>{{-- /refunds --}}

</div>{{-- /.ud-wrap --}}

{{-- ══════════════════════════════════════════════════════
     ORDER DETAIL MODAL
══════════════════════════════════════════════════════ --}}
<div class="ud-modal-overlay" id="orderModal" onclick="if(event.target===this)closeModal('orderModal')">
    <div class="ud-modal">
        <div class="ud-modal-header">
            <h2 class="ud-modal-title"><i class="fas fa-shopping-bag"></i> <span id="om-title">Order Detail</span></h2>
            <div style="display:flex; align-items:center; gap:10px;">
                <span id="om-status-badge"></span>
                <button class="ud-modal-close" onclick="closeModal('orderModal')"><i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="ud-modal-body" id="om-body">
            {{-- populated by JS --}}
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════
     REFUND DETAIL MODAL
══════════════════════════════════════════════════════ --}}
<div class="ud-modal-overlay" id="refundModal" onclick="if(event.target===this)closeModal('refundModal')">
    <div class="ud-modal">
        <div class="ud-modal-header">
            <h2 class="ud-modal-title"><i class="fas fa-undo-alt"></i> <span id="rm-title">Refund Request</span></h2>
            <div style="display:flex; align-items:center; gap:10px;">
                <span id="rm-status-badge"></span>
                <button class="ud-modal-close" onclick="closeModal('refundModal')"><i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="ud-modal-body" id="rm-body">
            {{-- populated by JS --}}
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════
     ORDER DATA (PHP → JS)
══════════════════════════════════════════════════════ --}}
<script>
/* ── badge helpers ── */
const BADGE = {
    order: {
        pending:'badge-yellow', confirmed:'badge-blue', processing:'badge-purple',
        shipped:'badge-cyan',   delivered:'badge-green', completed:'badge-green',
        cancelled:'badge-red',  refunded:'badge-pink', default:'badge-gray'
    },
    payment: { paid:'badge-green', failed:'badge-red', pending:'badge-yellow', default:'badge-yellow' },
    refund:  { pending:'badge-yellow', approved:'badge-green', rejected:'badge-red', processing:'badge-purple', default:'badge-gray' },
    wallet:  { success:'badge-green', pending:'badge-yellow', failed:'badge-red', refunded:'badge-purple', default:'badge-gray' }
};
function badge(text, type, map) {
    var key = (text||'').toLowerCase();
    var cls = (map||{})[key] || (map||{}).default || 'badge-gray';
    return '<span class="badge '+cls+'">'+text+'</span>';
}

/* ── modal open / close ── */
function openModal(id)  { document.getElementById(id).classList.add('open');    document.body.style.overflow='hidden'; }
function closeModal(id) { document.getElementById(id).classList.remove('open'); document.body.style.overflow='';       }
document.addEventListener('keydown', function(e){ if(e.key==='Escape'){ closeModal('orderModal'); closeModal('refundModal'); } });

/* ══════════════════════════════════
   ORDER DATA
══════════════════════════════════ */
var ORDERS = {
@foreach($orders as $order)
@php
    $oStatus = strtolower($order->order_status ?? 'pending');
    $subtotal = $order->items->sum(fn($i) => $i->price * $i->quantity);
    $discount = max(0, $subtotal - ($order->total_amount + ($order->shipping_fee ?? 0) + ($order->tax ?? 0) - ($order->discount_amount ?? 0)));
    $realDiscount = $order->discount_amount ?? 0;
@endphp
"{{ $order->order_id ?? $order->sl_no }}": {
    id:          "{{ $order->order_id ?? $order->sl_no }}",
    status:      "{{ $oStatus }}",
    payStatus:   "{{ strtolower($order->payment_status ?? 'pending') }}",
    method:      "{{ ucwords(str_replace(['_','-'],' ', $order->payment_method ?? 'N/A')) }}",
    placedAt:    "{{ $order->placed_at ? \Carbon\Carbon::parse($order->placed_at)->format('d M Y, h:i A') : 'N/A' }}",
    total:       "{{ number_format($order->total_amount, 2) }}",
    subtotal:    "{{ number_format($subtotal, 2) }}",
    discount:    "{{ number_format($realDiscount, 2) }}",
    shipping:    "{{ number_format($order->shipping_fee ?? 0, 2) }}",
    tax:         "{{ number_format($order->tax ?? 0, 2) }}",
    coupon:      "{{ $order->coupon_code ?? '' }}",
    itemCount:   {{ $order->items->count() }},
    billingName: "{{ addslashes($order->billing_name ?? '') }}",
    billingPhone:"{{ $order->billing_phone ?? '' }}",
    billingEmail:"{{ $order->billing_email ?? '' }}",
    billingAddr: "{{ addslashes(implode(', ', array_filter([$order->billing_address ?? '', $order->billing_city ?? '', $order->billing_state ?? '', $order->billing_country ?? '', $order->billing_zip ?? '']))) }}",
    shipName:    "{{ addslashes($order->shipping_name ?? ($order->address->full_name ?? $user->name)) }}",
    shipPhone:   "{{ $order->shipping_phone ?? ($order->address->phone ?? '') }}",
    shipAddr:    "{{ addslashes(implode(', ', array_filter([$order->shipping_address ?? ($order->address->address_line_1 ?? ''), $order->shipping_city ?? ($order->address->city ?? ''), $order->shipping_state ?? ($order->address->state ?? ''), $order->shipping_country ?? ($order->address->country ?? ''), $order->shipping_zip ?? ($order->address->postal_code ?? '')]))) }}",
    @php $dp = optional($order->deliveryPartnerPickup); @endphp
    dpName:      "{{ addslashes($dp->deliveryPartner->name ?? '') }}",
    dpPhone:     "{{ $dp->deliveryPartner->phone ?? '' }}",
    dpVehicle:   "{{ $dp->deliveryPartner->vehicle_number ?? '' }}",
    dpStatus:    "{{ ucfirst($dp->status ?? '') }}",
    dpPickedAt:  "{{ $dp->picked_at ? \Carbon\Carbon::parse($dp->picked_at)->format('d M Y, h:i A') : '' }}",
    isDelivery:  {{ $order->isAssignedForDelivery() ? 'true' : 'false' }},
    items: [
        @foreach($order->items as $item)
        {
            name:    "{{ addslashes($item->product->name ?? 'Product #'.$item->product_id) }}",
            sku:     "{{ $item->product->sku ?? '' }}",
            thumb:   "{{ $item->product && $item->product->thumbnail ? asset('storage/'.$item->product->thumbnail) : '' }}",
            variant: "{{ addslashes($item->variant->variant_name ?? '') }}",
            size:    "{{ $item->size ?? '' }}",
            qty:     {{ $item->quantity }},
            price:   "{{ number_format($item->price, 2) }}",
            sub:     "{{ number_format($item->price * $item->quantity, 2) }}",
            @php
                $rr = \App\Models\RefundRequest::where('order_item_id', $item->sl_no)->latest('requested_at')->first();
            @endphp
            refundStatus: "{{ $rr ? ucfirst($rr->status) : '' }}"
        },
        @endforeach
    ]
},
@endforeach
};

/* ── open order modal ── */
function openOrderModal(orderId) {
    var o = ORDERS[orderId];
    if (!o) return;
    document.getElementById('om-title').textContent = 'Order #' + o.id;
    document.getElementById('om-status-badge').innerHTML =
        badge(o.status.charAt(0).toUpperCase()+o.status.slice(1), 'order', BADGE.order);

    /* progress tracker */
    var steps = [
        {key:'pending',    label:'Order Placed', icon:'fas fa-receipt'},
        {key:'confirmed',  label:'Confirmed',    icon:'fas fa-check-circle'},
        {key:'processing', label:'Processing',   icon:'fas fa-cog'},
        {key:'shipped',    label:'Shipped',       icon:'fas fa-box'},
        {key:'delivered',  label:'Delivered',     icon:'fas fa-check-double'},
    ];
    var statusOrder = steps.map(function(s){ return s.key; });
    var currIdx = statusOrder.indexOf(o.status);
    var isCancelled = o.status === 'cancelled' || o.status === 'refunded';
    var progressHtml = '';
    if (isCancelled) {
        progressHtml = '<div class="ud-cancelled-strip"><i class="fas fa-times-circle"></i> This order was '+o.status+'.</div>';
    } else {
        var fillPct = currIdx >= 0 ? (currIdx / (steps.length - 1)) * 100 : 0;
        progressHtml = '<div class="ud-progress" style="margin-bottom:20px;">';
        progressHtml += '<div class="ud-progress-fill" style="width:'+fillPct+'%;"></div>';
        steps.forEach(function(s, idx) {
            var isDone   = currIdx >= 0 && idx < currIdx;
            var isActive = currIdx >= 0 && idx === currIdx;
            var cls = isDone ? 'done' : (isActive ? 'active' : '');
            var dotContent = isDone
                ? '<i class="fas fa-check" style="font-size:11px;"></i>'
                : '<i class="'+s.icon+'" style="font-size:12px;"></i>';
            progressHtml += '<div class="ud-progress-step '+cls+'">';
            progressHtml += '<div class="ud-progress-dot">'+dotContent+'</div>';
            progressHtml += '<span class="ud-progress-label">'+s.label+'</span>';
            progressHtml += '</div>';
        });
        progressHtml += '</div>';
    }

    /* items table */
    var itemsHtml = '<table class="ud-modal-items"><thead><tr>';
    itemsHtml += '<th style="width:46%;">Product</th><th style="text-align:center;">Qty</th><th>Unit Price</th><th>Subtotal</th><th>Refund</th></tr></thead><tbody>';
    o.items.forEach(function(item) {
        var img = item.thumb
            ? '<img src="'+item.thumb+'" style="width:42px;height:42px;object-fit:cover;border-radius:6px;border:1px solid #e5e7eb;" onerror="this.style.display=\'none\'">'
            : '<div style="width:42px;height:42px;border-radius:6px;background:#f3f4f6;display:flex;align-items:center;justify-content:center;color:#d1d5db;font-size:16px;"><i class="fas fa-image"></i></div>';
        var badges = '';
        if (item.variant) badges += ' <span class="badge badge-purple" style="font-size:10px;">'+item.variant+'</span>';
        if (item.size)    badges += ' <span class="badge badge-blue" style="font-size:10px;">'+item.size+'</span>';
        var refundBadge = item.refundStatus
            ? badge(item.refundStatus, 'refund', BADGE.refund)
            : '<span style="color:#d1d5db;">—</span>';
        itemsHtml += '<tr>';
        itemsHtml += '<td><div style="display:flex;align-items:center;gap:10px;">'+img+'<div>';
        itemsHtml += '<div style="font-weight:600;color:#111827;font-size:13px;">'+item.name+'</div>';
        if (item.sku) itemsHtml += '<div style="font-size:11px;color:#9ca3af;">SKU: '+item.sku+'</div>';
        if (badges)   itemsHtml += '<div style="margin-top:4px;">'+badges+'</div>';
        itemsHtml += '</div></div></td>';
        itemsHtml += '<td style="text-align:center;font-weight:700;font-size:14px;">'+item.qty+'</td>';
        itemsHtml += '<td style="color:#374151;">&#8377;'+item.price+'</td>';
        itemsHtml += '<td>&#8377;'+item.sub+'</td>';
        itemsHtml += '<td style="text-align:center;">'+refundBadge+'</td>';
        itemsHtml += '</tr>';
    });
    itemsHtml += '</tbody></table>';

    /* price summary */
    var priceHtml = '<div class="ud-price-rows">';
    priceHtml += '<div class="ud-price-row"><span class="lbl">Subtotal</span><span class="val">&#8377;'+o.subtotal+'</span></div>';
    if (parseFloat(o.discount.replace(',','')) > 0) {
        priceHtml += '<div class="ud-price-row"><span class="lbl">Discount'+(o.coupon ? ' ('+o.coupon+')' : '')+'</span><span class="val" style="color:#15803d;">- &#8377;'+o.discount+'</span></div>';
    }
    if (parseFloat(o.shipping.replace(',','')) > 0) {
        priceHtml += '<div class="ud-price-row"><span class="lbl">Shipping</span><span class="val">&#8377;'+o.shipping+'</span></div>';
    } else {
        priceHtml += '<div class="ud-price-row"><span class="lbl">Shipping</span><span class="val" style="color:#15803d;">Free</span></div>';
    }
    if (parseFloat(o.tax.replace(',','')) > 0) {
        priceHtml += '<div class="ud-price-row"><span class="lbl">Tax</span><span class="val">&#8377;'+o.tax+'</span></div>';
    }
    priceHtml += '<div class="ud-price-row total"><span class="lbl">Total</span><span class="val">&#8377;'+o.total+'</span></div>';
    priceHtml += '</div>';

    /* shipping + billing addresses */
    var addrHtml = '<div class="ud-modal-grid">';
    addrHtml += '<div><p class="ud-modal-section">Shipping Address</p><div class="ud-modal-address">';
    if (o.shipName)  addrHtml += '<strong>'+o.shipName+'</strong><br>';
    if (o.shipAddr)  addrHtml += o.shipAddr+'<br>';
    if (o.shipPhone) addrHtml += '<i class="fas fa-phone" style="font-size:11px;color:#dc2626;margin-right:4px;"></i>'+o.shipPhone;
    addrHtml += '</div></div>';
    if (o.billingName || o.billingAddr) {
        addrHtml += '<div><p class="ud-modal-section">Billing Address</p><div class="ud-modal-address">';
        if (o.billingName)  addrHtml += '<strong>'+o.billingName+'</strong><br>';
        if (o.billingEmail) addrHtml += '<i class="fas fa-envelope" style="font-size:11px;color:#dc2626;margin-right:4px;"></i>'+o.billingEmail+'<br>';
        if (o.billingAddr)  addrHtml += o.billingAddr+'<br>';
        if (o.billingPhone) addrHtml += '<i class="fas fa-phone" style="font-size:11px;color:#dc2626;margin-right:4px;"></i>'+o.billingPhone;
        addrHtml += '</div></div>';
    }
    addrHtml += '</div>';

    /* payment info row */
    var infoHtml = '<div class="ud-modal-grid" style="margin-bottom:20px;">';
    infoHtml += '<div><p class="ud-modal-section">Payment</p>';
    infoHtml += '<table class="ud-kv"><tr><td>Method</td><td>'+o.method+'</td></tr>';
    infoHtml += '<tr><td>Status</td><td>'+badge(o.payStatus.charAt(0).toUpperCase()+o.payStatus.slice(1),'pay',BADGE.payment)+'</td></tr>';
    infoHtml += '<tr><td>Placed at</td><td style="font-size:12px;">'+o.placedAt+'</td></tr>';
    if (o.coupon) infoHtml += '<tr><td>Coupon</td><td><span class="badge badge-indigo">'+o.coupon+'</span></td></tr>';
    infoHtml += '</table></div>';
    infoHtml += '<div><p class="ud-modal-section">Summary</p>';
    infoHtml += '<table class="ud-kv"><tr><td>Items</td><td>'+o.itemCount+' item'+(o.itemCount!==1?'s':'')+'</td></tr>';
    infoHtml += '<tr><td>Total</td><td style="font-weight:700;color:#dc2626;font-size:15px;">&#8377;'+o.total+'</td></tr>';
    infoHtml += '</table></div>';
    infoHtml += '</div>';

    /* delivery partner */
    var dpHtml = '';
    if (o.isDelivery && o.dpName) {
        dpHtml = '<p class="ud-modal-section" style="margin-bottom:10px;">Delivery Partner</p>';
        dpHtml += '<div class="ud-dp-strip">';
        dpHtml += '<div class="ud-dp-avatar">'+o.dpName.charAt(0).toUpperCase()+'</div>';
        dpHtml += '<div><div style="font-size:14px;font-weight:600;color:#111827;">'+o.dpName+'</div>';
        var dpSub = [];
        if (o.dpPhone)   dpSub.push('<i class="fas fa-phone" style="font-size:10px;color:#dc2626;"></i> '+o.dpPhone);
        if (o.dpVehicle) dpSub.push('<i class="fas fa-motorcycle" style="font-size:10px;color:#6b7280;"></i> '+o.dpVehicle);
        if (dpSub.length) dpHtml += '<div style="font-size:12px;color:#6b7280;margin-top:3px;">'+dpSub.join(' &nbsp;·&nbsp; ')+'</div>';
        dpHtml += '</div>';
        if (o.dpStatus) {
            dpHtml += '<div style="margin-left:auto;text-align:right;">';
            dpHtml += '<div style="font-size:11px;color:#9ca3af;">Status</div>';
            dpHtml += '<div style="font-size:13px;font-weight:600;color:#111827;">'+o.dpStatus+'</div>';
            if (o.dpPickedAt) dpHtml += '<div style="font-size:11px;color:#9ca3af;margin-top:2px;">Picked: '+o.dpPickedAt+'</div>';
            dpHtml += '</div>';
        }
        dpHtml += '</div><br>';
    }

    document.getElementById('om-body').innerHTML =
        progressHtml +
        '<p class="ud-modal-section" style="margin-bottom:10px;">Order Items</p>' +
        itemsHtml + priceHtml +
        '<hr style="border:none;border-top:1px solid #f3f4f6;margin:20px 0;">' +
        infoHtml + addrHtml +
        (dpHtml ? '<hr style="border:none;border-top:1px solid #f3f4f6;margin:20px 0;">' + dpHtml : '');

    openModal('orderModal');
}

/* ══════════════════════════════════
   REFUND DATA
══════════════════════════════════ */
var REFUNDS = {
@foreach($refundRequests as $rr)
"{{ $rr->refund_id }}": {
    refundId:  "{{ $rr->refund_id }}",
    orderId:   "{{ $rr->order_id }}",
    status:    "{{ strtolower($rr->status ?? 'pending') }}",
    reason:    "{{ addslashes(ucwords(str_replace('_',' ', $rr->reason ?? ''))) }}",
    comments:  "{{ addslashes($rr->comments ?? '') }}",
    requestedAt: "{{ $rr->requested_at ? $rr->requested_at->format('d M Y, h:i A') : '—' }}",
    @if($rr->orderItem)
    @php $item = $rr->orderItem; @endphp
    itemName:  "{{ addslashes($item->product->name ?? 'Product #'.$item->product_id) }}",
    itemSku:   "{{ $item->product->sku ?? '' }}",
    itemThumb: "{{ $item->product && $item->product->thumbnail ? asset('storage/'.$item->product->thumbnail) : '' }}",
    itemVariant:"{{ addslashes($item->variant->variant_name ?? '') }}",
    itemSize:  "{{ $item->size ?? '' }}",
    itemQty:   {{ $item->quantity }},
    itemPrice: "{{ number_format($item->price, 2) }}",
    @else
    itemName:'', itemSku:'', itemThumb:'', itemVariant:'', itemSize:'', itemQty:0, itemPrice:'0.00',
    @endif
    images: [
        @if(!empty($rr->images) && count($rr->images))
            @foreach($rr->images as $img)
            "{{ asset('storage/'.$img) }}",
            @endforeach
        @endif
    ]
},
@endforeach
};

/* ── open refund modal ── */
function openRefundModal(refundId) {
    var r = REFUNDS[refundId];
    if (!r) return;
    document.getElementById('rm-title').textContent = 'Refund #' + r.refundId;
    document.getElementById('rm-status-badge').innerHTML = badge(
        r.status.charAt(0).toUpperCase()+r.status.slice(1), 'refund', BADGE.refund
    );

    var html = '';

    /* meta strip */
    html += '<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:1px;background:#f3f4f6;border:1px solid #e5e7eb;border-radius:10px;overflow:hidden;margin-bottom:20px;">';
    var metaItems = [
        ['Refund ID',    '<span style="font-family:monospace;font-size:12px;">'+r.refundId+'</span>'],
        ['Order',        '<strong>#'+r.orderId+'</strong>'],
        ['Requested',    '<span style="font-size:12px;color:#6b7280;">'+r.requestedAt+'</span>'],
        ['Status',       badge(r.status.charAt(0).toUpperCase()+r.status.slice(1),'refund',BADGE.refund)],
    ];
    metaItems.forEach(function(m) {
        html += '<div style="background:#f9fafb;padding:10px 16px;">';
        html += '<div style="font-size:10.5px;color:#9ca3af;text-transform:uppercase;letter-spacing:.4px;margin-bottom:3px;">'+m[0]+'</div>';
        html += '<div style="font-size:13px;font-weight:600;color:#111827;">'+m[1]+'</div>';
        html += '</div>';
    });
    html += '</div>';

    /* item + reason in 2-col grid */
    html += '<div class="ud-modal-grid">';

    /* item */
    if (r.itemName) {
        html += '<div><p class="ud-modal-section">Item Requested</p>';
        var img = r.itemThumb
            ? '<img src="'+r.itemThumb+'" style="width:52px;height:52px;object-fit:cover;border-radius:8px;border:1px solid #e5e7eb;" onerror="this.style.display=\'none\'">'
            : '<div style="width:52px;height:52px;border-radius:8px;background:#f3f4f6;display:flex;align-items:center;justify-content:center;color:#d1d5db;font-size:18px;"><i class="fas fa-image"></i></div>';
        html += '<div style="display:flex;align-items:flex-start;gap:12px;">';
        html += img + '<div>';
        html += '<div style="font-weight:600;color:#111827;font-size:13.5px;margin-bottom:4px;">'+r.itemName+'</div>';
        if (r.itemSku) html += '<div style="font-size:11px;color:#9ca3af;margin-bottom:5px;">SKU: '+r.itemSku+'</div>';
        var badges = '';
        if (r.itemVariant) badges += '<span class="badge badge-purple" style="font-size:10px;">'+r.itemVariant+'</span> ';
        if (r.itemSize)    badges += '<span class="badge badge-blue" style="font-size:10px;">'+r.itemSize+'</span>';
        if (badges) html += '<div style="margin-bottom:5px;">'+badges+'</div>';
        html += '<table class="ud-kv" style="font-size:12px;">';
        html += '<tr><td style="width:70px;">Quantity</td><td>'+r.itemQty+'</td></tr>';
        html += '<tr><td>Unit price</td><td>&#8377;'+r.itemPrice+'</td></tr>';
        html += '<tr><td>Item total</td><td style="color:#dc2626;font-weight:700;">&#8377;'+(parseFloat(r.itemPrice.replace(',',''))*r.itemQty).toFixed(2)+'</td></tr>';
        html += '</table></div></div></div>';
    }

    /* reason & comments */
    html += '<div><p class="ud-modal-section">Reason for Refund</p>';
    html += '<div style="font-size:14px;font-weight:700;color:#111827;margin-bottom:10px;">'+r.reason+'</div>';
    if (r.comments) {
        html += '<div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:8px;padding:12px;font-size:13px;color:#374151;line-height:1.7;">'+r.comments+'</div>';
    }
    html += '</div>';

    html += '</div>'; /* /modal-grid */

    /* images */
    if (r.images && r.images.length > 0) {
        html += '<hr style="border:none;border-top:1px solid #f3f4f6;margin:18px 0;">';
        html += '<p class="ud-modal-section" style="margin-bottom:12px;">Attached Images</p>';
        html += '<div class="ud-modal-img-grid">';
        r.images.forEach(function(src) {
            html += '<a href="'+src+'" target="_blank">';
            html += '<img src="'+src+'" alt="Refund image">';
            html += '</a>';
        });
        html += '</div>';
    }

    document.getElementById('rm-body').innerHTML = html;
    openModal('refundModal');
}

/* ══════════════════════════════════
   TAB SWITCHER
══════════════════════════════════ */
function switchTab(active) {
    document.querySelectorAll('.ud-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.ud-tab-btn').forEach(b => b.classList.remove('active'));
    var panel = document.getElementById('tab-' + active);
    var btn   = document.getElementById('tab-btn-' + active);
    if (panel) panel.classList.add('active');
    if (btn)   btn.classList.add('active');
    try { sessionStorage.setItem('ud_tab_{{ $user->id }}', active); } catch(e) {}
}
(function() {
    var t = 'overview';
    try { t = sessionStorage.getItem('ud_tab_{{ $user->id }}') || 'overview'; } catch(e) {}
    switchTab(t);
})();
</script>
@endsection