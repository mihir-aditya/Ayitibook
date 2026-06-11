{{-- resources/views/admin/delivery-partners/show.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Delivery Partner — ' . $deliveryPartner->name)

@section('content')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">

<style>
:root {
    --ink:        #0d0f14;
    --ink-2:      #1e2230;
    --ink-3:      #2d3348;
    --surface:    #f4f5f8;
    --surface-2:  #eceef3;
    --white:      #ffffff;
    --accent:     #3b5bdb;
    --accent-2:   #1971c2;
    --green:      #087f5b;
    --green-bg:   #d3f9d8;
    --amber:      #e67700;
    --amber-bg:   #fff3bf;
    --red:        #c92a2a;
    --red-bg:     #ffe3e3;
    --sky:        #0c7fbc;
    --sky-bg:     #dde9f7;
    --border:     #e2e5ec;
    --muted:      #6b7280;
    --radius-sm:  6px;
    --radius:     10px;
    --radius-lg:  16px;
    --shadow-sm:  0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
    --shadow:     0 4px 12px rgba(0,0,0,.07), 0 2px 4px rgba(0,0,0,.04);
    --shadow-lg:  0 16px 40px rgba(0,0,0,.10), 0 4px 8px rgba(0,0,0,.05);
}

* { box-sizing: border-box; }
body { font-family: 'DM Sans', sans-serif; background: var(--surface); color: var(--ink); }

/* ── PAGE HEADER ───────────────────────── */
.page-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 1.75rem;
}

.page-header__eyebrow {
    font-family: 'Syne', sans-serif;
    font-size: .7rem;
    font-weight: 600;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--accent);
    margin-bottom: .3rem;
    display: flex;
    align-items: center;
    gap: .4rem;
}

.page-header__eyebrow::before {
    content: '';
    display: inline-block;
    width: 18px; height: 2px;
    background: var(--accent);
    border-radius: 2px;
}

.page-header__title {
    font-family: 'Syne', sans-serif;
    font-size: 1.6rem;
    font-weight: 800;
    color: var(--ink);
    margin: 0 0 .4rem;
    line-height: 1.15;
}

.breadcrumb {
    display: flex;
    align-items: center;
    gap: .35rem;
    list-style: none;
    padding: 0;
    margin: 0;
    font-size: .78rem;
    color: var(--muted);
}

.breadcrumb li + li::before {
    content: '/';
    color: var(--border);
    margin-right: .35rem;
}

.breadcrumb a { color: var(--accent); text-decoration: none; }
.breadcrumb a:hover { text-decoration: underline; }
.breadcrumb .active { color: var(--muted); }

.header-actions {
    display: flex;
    gap: .5rem;
    flex-wrap: wrap;
}

.btn-edit {
    display: inline-flex; align-items: center; gap: .4rem;
    background: var(--amber-bg); color: var(--amber);
    border: 1px solid rgba(230,119,0,.25);
    font-family: 'DM Sans', sans-serif; font-size: .82rem; font-weight: 500;
    padding: .55rem 1.1rem;
    border-radius: var(--radius);
    text-decoration: none;
    transition: background .13s, transform .1s;
}

.btn-edit:hover { background: #ffe8a3; transform: translateY(-1px); color: var(--amber); }

.btn-back {
    display: inline-flex; align-items: center; gap: .4rem;
    background: var(--white); color: var(--ink-3);
    border: 1px solid var(--border);
    font-family: 'DM Sans', sans-serif; font-size: .82rem; font-weight: 500;
    padding: .55rem 1.1rem;
    border-radius: var(--radius);
    text-decoration: none;
    transition: background .13s;
}

.btn-back:hover { background: var(--surface-2); color: var(--ink); }

/* ── HERO PROFILE CARD ─────────────────── */
.profile-hero {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    margin-bottom: 1.25rem;
}

.profile-hero__cover {
    height: 110px;
    background: linear-gradient(125deg, #3b5bdb 0%, #364fc7 40%, #5c7cfa 75%, #74c0fc 100%);
    position: relative;
}

.profile-hero__cover::after {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.profile-hero__body {
    padding: 0 1.75rem 1.75rem;
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1rem;
}

.profile-hero__left {
    display: flex;
    align-items: flex-end;
    gap: 1.25rem;
    flex-wrap: wrap;
}

.profile-avatar {
    margin-top: -52px;
    position: relative;
    flex-shrink: 0;
}

.profile-avatar img,
.profile-avatar .avatar-init {
    width: 96px; height: 96px;
    border-radius: 50%;
    border: 4px solid var(--white);
    object-fit: cover;
    box-shadow: var(--shadow);
}

.profile-avatar .avatar-init {
    display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg, #4263eb, #7048e8);
    color: #fff;
    font-family: 'Syne', sans-serif;
    font-size: 2.2rem; font-weight: 800;
}

.online-badge {
    position: absolute;
    bottom: 4px; right: 4px;
    width: 18px; height: 18px;
    border-radius: 50%;
    border: 3px solid var(--white);
}

.online-badge--on  { background: #12b886; }
.online-badge--off { background: #adb5bd; }

.profile-info {
    padding-bottom: .2rem;
}

.profile-name {
    font-family: 'Syne', sans-serif;
    font-size: 1.45rem;
    font-weight: 800;
    color: var(--ink);
    margin: 0 0 .2rem;
    line-height: 1.15;
}

.profile-contact {
    display: flex;
    flex-wrap: wrap;
    gap: .9rem;
    margin-top: .3rem;
}

.profile-contact-item {
    display: flex; align-items: center; gap: .4rem;
    font-size: .8rem;
    color: var(--muted);
}

.profile-contact-item i {
    font-size: .75rem;
    width: 14px;
}

.profile-hero__right {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: .4rem;
    padding-bottom: .15rem;
}

/* Status pills */
.status-pill {
    display: inline-flex; align-items: center; gap: .3rem;
    padding: .28rem .75rem;
    border-radius: 999px;
    font-size: .75rem;
    font-weight: 600;
    white-space: nowrap;
}

.sp-active    { background: var(--green-bg); color: var(--green); }
.sp-inactive  { background: var(--amber-bg); color: var(--amber); }
.sp-suspended { background: var(--red-bg);   color: var(--red);   }
.sp-verified  { background: var(--sky-bg);   color: var(--sky);   }
.sp-pending   { background: var(--amber-bg); color: var(--amber); }
.sp-rejected  { background: var(--red-bg);   color: var(--red);   }

/* ── STAT CARDS ────────────────────────── */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: .875rem;
    margin-bottom: 1.25rem;
}

@media (max-width: 1100px) { .stats-grid { grid-template-columns: repeat(3,1fr); } }
@media (max-width: 700px)  { .stats-grid { grid-template-columns: repeat(2,1fr); } }
@media (max-width: 400px)  { .stats-grid { grid-template-columns: 1fr; } }

.stat-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 1.25rem 1.35rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    box-shadow: var(--shadow-sm);
    transition: transform .18s, box-shadow .18s;
}

.stat-card:hover { transform: translateY(-3px); box-shadow: var(--shadow); }

.stat-card__icon {
    width: 46px; height: 46px;
    border-radius: var(--radius);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.05rem;
    flex-shrink: 0;
}

.sc-blue  .stat-card__icon { background: #eef1fd; color: var(--accent); }
.sc-green .stat-card__icon { background: var(--green-bg); color: var(--green); }
.sc-amber .stat-card__icon { background: var(--amber-bg); color: var(--amber); }
.sc-sky   .stat-card__icon { background: var(--sky-bg);   color: var(--sky); }

/* ── BADGE STAT CARD ───────────────────── */
.sc-badge {
    border: 1.5px solid var(--badge-color, #e2e5ec);
    position: relative;
    overflow: hidden;
}

.sc-badge::before {
    content: '';
    position: absolute;
    inset: 0;
    background: var(--badge-bg, #f4f5f8);
    opacity: .45;
    pointer-events: none;
}

.sc-badge .stat-card__icon--badge {
    background: var(--badge-bg, #f4f5f8);
    color: var(--badge-color, #6b7280);
    font-size: 1.15rem;
    position: relative;
}

.sc-badge .stat-card__value--badge {
    font-family: 'Syne', sans-serif;
    font-size: 1.25rem;
    font-weight: 800;
    line-height: 1;
    margin-bottom: .2rem;
    position: relative;
}

.sc-badge .stat-card__label {
    position: relative;
}

.badge-next-hint {
    font-size: .68rem;
    font-weight: 500;
    color: var(--amber);
    margin-top: .3rem;
    display: flex;
    align-items: center;
    gap: .25rem;
    position: relative;
    cursor: default;
}

.badge-next-hint i { font-size: .6rem; }

.badge-next-hint--max {
    color: var(--green);
}

/* Platinum shimmer on the badge card */
.sc-badge.tier-platinum {
    animation: card-shimmer 3s ease-in-out infinite;
}

@keyframes card-shimmer {
    0%,100% { box-shadow: var(--shadow-sm); }
    50%      { box-shadow: 0 0 0 2px rgba(123,104,238,.3), var(--shadow); }
}

.stat-card__value {
    font-family: 'Syne', sans-serif;
    font-size: 1.55rem;
    font-weight: 800;
    color: var(--ink);
    line-height: 1;
    margin-bottom: .2rem;
}

.stat-card__label {
    font-size: .73rem;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: .05em;
    font-weight: 500;
}

/* ── CONTENT GRID ──────────────────────── */
.content-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

@media (max-width: 768px) { .content-grid { grid-template-columns: 1fr; } }

.content-grid .full-width { grid-column: 1 / -1; }

/* ── INFO CARD ─────────────────────────── */
.info-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}

.info-card__header {
    padding: 1rem 1.4rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
}

.info-card__title {
    font-family: 'Syne', sans-serif;
    font-size: .88rem;
    font-weight: 700;
    color: var(--ink);
    display: flex;
    align-items: center;
    gap: .5rem;
}

.info-card__title i { font-size: .82rem; }
.ic-blue   .info-card__title i { color: var(--accent); }
.ic-green  .info-card__title i { color: var(--green); }
.ic-red    .info-card__title i { color: var(--red); }
.ic-sky    .info-card__title i { color: var(--sky); }
.ic-amber  .info-card__title i { color: var(--amber); }
.ic-purple .info-card__title i { color: #7048e8; }

.info-card__body { padding: 1.4rem; }
.info-card__body--flush { padding: 0; }

/* Info rows */
.info-row {
    display: flex;
    align-items: flex-start;
    gap: .75rem;
    padding: .65rem 0;
    border-bottom: 1px solid var(--surface);
}

.info-row:last-child { border-bottom: none; }

.info-row__label {
    font-size: .75rem;
    font-weight: 500;
    color: var(--muted);
    min-width: 130px;
    padding-top: .05rem;
}

.info-row__value {
    font-size: .85rem;
    color: var(--ink-3);
    flex: 1;
}

.info-row__value strong { color: var(--ink); font-weight: 600; }

/* Vehicle badge */
.vehicle-badge {
    display: inline-flex; align-items: center; gap: .4rem;
    padding: .28rem .65rem;
    background: var(--surface-2);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    font-size: .8rem;
    color: var(--ink-3);
    font-weight: 500;
}

/* ── MAP PLACEHOLDER ───────────────────── */
#map {
    height: 200px;
    border-radius: var(--radius);
    background: var(--surface-2);
    overflow: hidden;
}

.map-coords {
    display: flex; align-items: center; gap: .5rem;
    font-size: .78rem;
    color: var(--muted);
    margin-top: .75rem;
}

.map-coords i { font-size: .72rem; color: var(--accent); }

.map-last-seen {
    display: flex; align-items: center; gap: .5rem;
    font-size: .78rem; color: var(--muted);
    margin-top: .35rem;
}

.map-online-dot {
    width: 8px; height: 8px;
    border-radius: 50%;
}

.map-online-dot--on  { background: #12b886; }
.map-online-dot--off { background: #adb5bd; }

.map-empty {
    height: 200px;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    gap: .5rem;
    color: var(--muted);
    font-size: .82rem;
}

.map-empty i { font-size: 2.2rem; color: var(--border); }

/* ── DATA TABLES ───────────────────────── */
.dp-table {
    width: 100%;
    border-collapse: collapse;
}

.dp-table thead {
    background: var(--surface);
    border-bottom: 1px solid var(--border);
}

.dp-table thead th {
    font-family: 'Syne', sans-serif;
    font-size: .68rem;
    font-weight: 700;
    letter-spacing: .07em;
    text-transform: uppercase;
    color: var(--muted);
    padding: .75rem 1.1rem;
    white-space: nowrap;
}

.dp-table tbody tr {
    border-bottom: 1px solid var(--border);
    transition: background .1s;
}

.dp-table tbody tr:last-child { border-bottom: none; }
.dp-table tbody tr:hover { background: rgba(59,91,219,.025); }

.dp-table td {
    padding: .85rem 1.1rem;
    font-size: .835rem;
    color: var(--ink-3);
    vertical-align: middle;
}

.dp-table .order-id {
    font-family: 'Syne', sans-serif;
    font-size: .78rem;
    font-weight: 700;
    color: var(--accent);
}

.dp-table .amount {
    font-family: 'Syne', sans-serif;
    font-weight: 700;
    color: var(--green);
}

/* Delivery status pills */
.delivery-pill {
    display: inline-flex; align-items: center; gap: .25rem;
    padding: .22rem .6rem;
    border-radius: 999px;
    font-size: .71rem;
    font-weight: 600;
}

.dp-delivered  { background: var(--green-bg); color: var(--green); }
.dp-pending    { background: var(--amber-bg); color: var(--amber); }
.dp-cancelled  { background: var(--red-bg);   color: var(--red);   }
.dp-active     { background: var(--sky-bg);   color: var(--sky);   }

/* Payout pills */
.payout-pill {
    display: inline-flex; align-items: center; gap: .25rem;
    padding: .22rem .6rem;
    border-radius: 999px;
    font-size: .71rem;
    font-weight: 600;
}

.pp-completed { background: var(--green-bg); color: var(--green); }
.pp-pending   { background: var(--amber-bg); color: var(--amber); }
.pp-other     { background: var(--surface-2); color: var(--muted); }

/* View all link */
.view-all-link {
    font-size: .78rem;
    color: var(--accent);
    text-decoration: none;
    font-weight: 500;
    display: flex; align-items: center; gap: .3rem;
    transition: gap .13s;
}

.view-all-link:hover { gap: .5rem; color: var(--accent-2); }

/* Payout total badge */
.payout-total {
    font-family: 'Syne', sans-serif;
    font-size: .78rem;
    font-weight: 700;
    background: var(--green-bg);
    color: var(--green);
    padding: .25rem .75rem;
    border-radius: 999px;
}

/* Empty state */
.table-empty {
    padding: 2.5rem;
    text-align: center;
    color: var(--muted);
    font-size: .82rem;
}

.table-empty i {
    font-size: 1.6rem;
    color: var(--border);
    display: block;
    margin-bottom: .5rem;
}
</style>
@endpush

<div class="container-fluid px-4 py-2">

    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <div class="page-header__eyebrow">
                <i class="fas fa-truck"></i> Fleet Management
            </div>
            <h1 class="page-header__title">Partner Details</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.delivery-partners.index') }}">Delivery Partners</a></li>
                <li class="active">{{ $deliveryPartner->name }}</li>
            </ol>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.delivery-partners.edit', $deliveryPartner) }}" class="btn-edit">
                <i class="fas fa-pen"></i> Edit Partner
            </a>
            <a href="{{ route('admin.delivery-partners.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    {{-- Hero Profile Card --}}
    <div class="profile-hero">
        <div class="profile-hero__cover"></div>
        <div class="profile-hero__body">
            <div class="profile-hero__left">
                <div class="profile-avatar">
                    @if($deliveryPartner->avatar)
                        <img src="{{ asset('storage/' . $deliveryPartner->avatar) }}" alt="{{ $deliveryPartner->name }}">
                    @else
                        <div class="avatar-init">{{ substr($deliveryPartner->name, 0, 1) }}</div>
                    @endif
                    <span class="online-badge {{ $deliveryPartner->is_online ? 'online-badge--on' : 'online-badge--off' }}"></span>
                </div>
                <div class="profile-info">
                    <h2 class="profile-name">{{ $deliveryPartner->name }}</h2>
                    <div class="profile-contact">
                        <span class="profile-contact-item">
                            <i class="fas fa-envelope"></i> {{ $deliveryPartner->email }}
                        </span>
                        <span class="profile-contact-item">
                            <i class="fas fa-phone"></i> {{ $deliveryPartner->phone }}
                        </span>
                        <span class="profile-contact-item">
                            <i class="fas fa-calendar-alt"></i> Joined {{ $deliveryPartner->created_at->format('M Y') }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="profile-hero__right">
                <span class="status-pill
                    @if($deliveryPartner->status === 'active')    sp-active
                    @elseif($deliveryPartner->status === 'inactive') sp-inactive
                    @else sp-suspended @endif">
                    <i class="fas fa-{{ $deliveryPartner->status === 'active' ? 'check-circle' : ($deliveryPartner->status === 'inactive' ? 'pause-circle' : 'ban') }}" style="font-size:.65rem"></i>
                    {{ ucfirst($deliveryPartner->status) }}
                </span>
                <span class="status-pill
                    @if($deliveryPartner->verification_status === 'verified') sp-verified
                    @elseif($deliveryPartner->verification_status === 'pending') sp-pending
                    @else sp-rejected @endif">
                    <i class="fas fa-{{ $deliveryPartner->verification_status === 'verified' ? 'shield-alt' : ($deliveryPartner->verification_status === 'pending' ? 'clock' : 'times-circle') }}" style="font-size:.65rem"></i>
                    {{ ucfirst($deliveryPartner->verification_status) }}
                </span>
            </div>
        </div>
    </div>

    {{-- Stats --}}
    @php
        $badgeInfo  = $deliveryPartner->getBadgeInfo();
        $badgeTier  = $deliveryPartner->getBadgeTier();
        $badgeHints = $deliveryPartner->getBadgeProgressHints();

        /* Per-tier colour tokens passed as CSS custom properties */
        $tierColors = [
            'platinum' => ['color' => '#7B68EE', 'bg' => '#e8e6ff'],
            'gold'     => ['color' => '#d4a000', 'bg' => '#fff9c4'],
            'silver'   => ['color' => '#7a8694', 'bg' => '#f0f0f0'],
            'bronze'   => ['color' => '#b8700e', 'bg' => '#f5deb3'],
            'beginner' => ['color' => '#475569', 'bg' => '#e2e8f0'],
            'unranked' => ['color' => '#9ca3af', 'bg' => '#f3f4f6'],
        ];
        $tc = $tierColors[$badgeTier] ?? $tierColors['unranked'];
    @endphp

    <div class="stats-grid">
        <div class="stat-card sc-blue">
            <div class="stat-card__icon"><i class="fas fa-truck"></i></div>
            <div>
                <div class="stat-card__value">{{ $stats['total_deliveries'] }}</div>
                <div class="stat-card__label">Total Deliveries</div>
            </div>
        </div>

        <div class="stat-card sc-green">
            <div class="stat-card__icon"><i class="fas fa-dollar-sign"></i></div>
            <div>
                <div class="stat-card__value">${{ number_format($stats['total_earnings'], 2) }}</div>
                <div class="stat-card__label">Total Earnings</div>
            </div>
        </div>

        <div class="stat-card sc-amber">
            <div class="stat-card__icon"><i class="fas fa-clock"></i></div>
            <div>
                <div class="stat-card__value">{{ $stats['active_deliveries'] }}</div>
                <div class="stat-card__label">Active Deliveries</div>
            </div>
        </div>

        <div class="stat-card sc-sky">
            <div class="stat-card__icon"><i class="fas fa-star"></i></div>
            <div>
                <div class="stat-card__value">{{ number_format($stats['rating'], 1) }}</div>
                <div class="stat-card__label">Rating · {{ $stats['total_ratings'] }} reviews</div>
            </div>
        </div>

        {{-- Badge Tier Card ─ same size, dynamic colour --}}
        <div class="stat-card sc-badge tier-{{ $badgeTier }}"
             style="--badge-color:{{ $tc['color'] }}; --badge-bg:{{ $tc['bg'] }}">
            <div class="stat-card__icon stat-card__icon--badge">
                <i class="{{ $badgeInfo['icon'] }}"></i>
            </div>
            <div>
                <div class="stat-card__value stat-card__value--badge"
                     style="color:{{ $tc['color'] }}">
                    {{ $badgeInfo['label'] }}
                </div>
                <div class="stat-card__label">Badge Tier</div>
                @if(count($badgeHints))
                    <div class="badge-next-hint"
                         title="{{ implode(' · ', $badgeHints) }}">
                        <i class="fas fa-arrow-up"></i>
                        {{ count($badgeHints) }} step{{ count($badgeHints) > 1 ? 's' : '' }} to next tier
                    </div>
                @else
                    <div class="badge-next-hint badge-next-hint--max">
                        <i class="fas fa-check-circle"></i> Max tier reached
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Content Grid --}}
    <div class="content-grid">

        {{-- Personal Information --}}
        <div class="info-card ic-blue">
            <div class="info-card__header">
                <div class="info-card__title"><i class="fas fa-user-circle"></i> Personal Information</div>
            </div>
            <div class="info-card__body">
                <div class="info-row">
                    <span class="info-row__label">Full Name</span>
                    <span class="info-row__value"><strong>{{ $deliveryPartner->name }}</strong></span>
                </div>
                <div class="info-row">
                    <span class="info-row__label">Email Address</span>
                    <span class="info-row__value">{{ $deliveryPartner->email }}</span>
                </div>
                <div class="info-row">
                    <span class="info-row__label">Phone Number</span>
                    <span class="info-row__value">{{ $deliveryPartner->phone }}</span>
                </div>
                <div class="info-row">
                    <span class="info-row__label">Member Since</span>
                    <span class="info-row__value">{{ $deliveryPartner->created_at->format('F d, Y') }}</span>
                </div>
                @if($deliveryPartner->documents_verified_at)
                <div class="info-row">
                    <span class="info-row__label">Verified On</span>
                    <span class="info-row__value">{{ $deliveryPartner->documents_verified_at->format('F d, Y') }}</span>
                </div>
                @endif
            </div>
        </div>

        {{-- Vehicle Information --}}
        <div class="info-card ic-green">
            <div class="info-card__header">
                <div class="info-card__title"><i class="fas fa-motorcycle"></i> Vehicle Information</div>
            </div>
            <div class="info-card__body">
                <div class="info-row">
                    <span class="info-row__label">Vehicle Type</span>
                    <span class="info-row__value">
                        <span class="vehicle-badge">
                            <i class="fas fa-{{ $deliveryPartner->vehicle_type === 'motorcycle' ? 'motorcycle' : 'car' }}"></i>
                            {{ ucfirst($deliveryPartner->vehicle_type) }}
                        </span>
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-row__label">Vehicle Number</span>
                    <span class="info-row__value"><strong>{{ $deliveryPartner->vehicle_number }}</strong></span>
                </div>
                <div class="info-row">
                    <span class="info-row__label">License Number</span>
                    <span class="info-row__value">{{ $deliveryPartner->license_number }}</span>
                </div>
            </div>
        </div>

        {{-- Address Information --}}
        <div class="info-card ic-red">
            <div class="info-card__header">
                <div class="info-card__title"><i class="fas fa-map-marker-alt"></i> Address Information</div>
            </div>
            <div class="info-card__body">
                <div class="info-row">
                    <span class="info-row__label">Street Address</span>
                    <span class="info-row__value">{{ $deliveryPartner->address }}</span>
                </div>
                <div class="info-row">
                    <span class="info-row__label">City</span>
                    <span class="info-row__value">{{ $deliveryPartner->city }}</span>
                </div>
                <div class="info-row">
                    <span class="info-row__label">State</span>
                    <span class="info-row__value">{{ $deliveryPartner->state }}</span>
                </div>
                <div class="info-row">
                    <span class="info-row__label">Pincode</span>
                    <span class="info-row__value"><strong>{{ $deliveryPartner->pincode }}</strong></span>
                </div>
            </div>
        </div>

        {{-- Current Location --}}
        <div class="info-card ic-sky">
            <div class="info-card__header">
                <div class="info-card__title"><i class="fas fa-map-pin"></i> Current Location</div>
            </div>
            <div class="info-card__body">
                @if($deliveryPartner->latitude && $deliveryPartner->longitude)
                    <div id="map"></div>
                    <div class="map-coords">
                        <i class="fas fa-globe"></i>
                        {{ $deliveryPartner->latitude }}, {{ $deliveryPartner->longitude }}
                    </div>
                    <div class="map-last-seen">
                        <span class="map-online-dot {{ $deliveryPartner->is_online ? 'map-online-dot--on' : 'map-online-dot--off' }}"></span>
                        Last seen {{ $deliveryPartner->updated_at->diffForHumans() }}
                    </div>
                @else
                    <div class="map-empty">
                        <i class="fas fa-map-marked-alt"></i>
                        Location not available
                    </div>
                @endif
            </div>
        </div>

        {{-- Recent Deliveries --}}
        <div class="info-card ic-amber full-width">
            <div class="info-card__header">
                <div class="info-card__title"><i class="fas fa-history"></i> Recent Deliveries</div>
                <a href="#" class="view-all-link">View All <i class="fas fa-arrow-right" style="font-size:.7rem"></i></a>
            </div>
            <div class="info-card__body--flush">
                <div style="overflow-x:auto">
                    <table class="dp-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Pickup Address</th>
                                <th>Delivery Address</th>
                                <th>Status</th>
                                <th>Fee</th>
                                <th>Delivered At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($deliveryPartner->pickups()->with('order')->latest()->take(5)->get() as $pickup)
                            <tr>
                                <td><span class="order-id">#{{ $pickup->order->order_id }}</span></td>
                                <td>{{ $pickup->order->user->name ?? '—' }}</td>
                                <td>{{ Str::limit($pickup->pickup_address, 32) }}</td>
                                <td>{{ Str::limit($pickup->delivery_address, 32) }}</td>
                                <td>
                                    @php
                                        $s = $pickup->status;
                                        $cls = match($s) {
                                            'delivered'  => 'dp-delivered',
                                            'pending'    => 'dp-pending',
                                            'cancelled'  => 'dp-cancelled',
                                            default      => 'dp-active',
                                        };
                                    @endphp
                                    <span class="delivery-pill {{ $cls }}">
                                        {{ str_replace('_', ' ', ucfirst($s)) }}
                                    </span>
                                </td>
                                <td><span class="amount">${{ number_format($pickup->delivery_fee, 2) }}</span></td>
                                <td>{{ $pickup->delivered_at ? $pickup->delivered_at->format('M d, H:i') : '—' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">
                                    <div class="table-empty">
                                        <i class="fas fa-box-open"></i>
                                        No deliveries yet
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Pending Payouts --}}
        <div class="info-card ic-purple full-width">
            <div class="info-card__header">
                <div class="info-card__title"><i class="fas fa-money-bill-wave"></i> Pending Payouts</div>
                <span class="payout-total">${{ number_format($stats['pending_payouts'], 2) }} pending</span>
            </div>
            <div class="info-card__body--flush">
                <div style="overflow-x:auto">
                    <table class="dp-table">
                        <thead>
                            <tr>
                                <th>Reference</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Requested On</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($deliveryPartner->payouts()->latest()->take(5)->get() as $payout)
                            <tr>
                                <td style="font-family:'Syne',sans-serif;font-size:.78rem;font-weight:600;color:var(--ink-3)">
                                    {{ $payout->payout_reference }}
                                </td>
                                <td><span class="amount">${{ number_format($payout->amount, 2) }}</span></td>
                                <td>{{ ucfirst($payout->payout_method) }}</td>
                                <td>{{ $payout->created_at->format('M d, Y') }}</td>
                                <td>
                                    @php
                                        $ps = $payout->status;
                                        $pcls = match($ps) {
                                            'completed' => 'pp-completed',
                                            'pending'   => 'pp-pending',
                                            default     => 'pp-other',
                                        };
                                    @endphp
                                    <span class="payout-pill {{ $pcls }}">{{ ucfirst($ps) }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">
                                    <div class="table-empty">
                                        <i class="fas fa-wallet"></i>
                                        No payout requests
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>{{-- /content-grid --}}
</div>

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
<script>
@if($deliveryPartner->latitude && $deliveryPartner->longitude)
(function initMap() {
    const loc = { lat: {{ $deliveryPartner->latitude }}, lng: {{ $deliveryPartner->longitude }} };
    const map = new google.maps.Map(document.getElementById('map'), {
        center: loc,
        zoom: 15,
        disableDefaultUI: true,
        styles: [
            { featureType: 'all', stylers: [{ saturation: -30 }] },
            { featureType: 'poi', stylers: [{ visibility: 'off' }] }
        ]
    });
    new google.maps.Marker({ position: loc, map, title: '{{ $deliveryPartner->name }}' });
})();
@endif
</script>
@endpush

@endsection