{{-- resources/views/admin/affiliate-links/show.blade.php --}}
@extends('admin.layouts.affiliate')

@section('title', 'Affiliate Link Details')

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
    --violet:     #6741d9;
    --violet-bg:  #f0ebff;
    --gray:       #868e96;
    --gray-bg:    #f1f3f5;
    --border:     #e2e5ec;
    --text-muted: #6b7280;
    --radius-sm:  6px;
    --radius:     10px;
    --radius-lg:  16px;
    --shadow-sm:  0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
    --shadow:     0 4px 12px rgba(0,0,0,.07), 0 2px 4px rgba(0,0,0,.04);
    --shadow-lg:  0 12px 32px rgba(0,0,0,.10), 0 4px 8px rgba(0,0,0,.05);
}

* { box-sizing: border-box; }
body { font-family: 'DM Sans', sans-serif; background: var(--surface); color: var(--ink); }

/* ── PAGE HEADER ─────────────────────────────── */
.af-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 1.75rem;
}

.af-header__left { display: flex; align-items: center; gap: 1.1rem; }

.af-header__icon-wrap {
    width: 52px; height: 52px;
    border-radius: var(--radius-lg);
    display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg, #6741d9, #9775fa);
    color: #fff;
    font-size: 1.2rem;
    border: 3px solid var(--white);
    box-shadow: var(--shadow);
    flex-shrink: 0;
}

.af-header__eyebrow {
    font-family: 'Syne', sans-serif;
    font-size: .7rem;
    font-weight: 600;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--violet);
    margin-bottom: .25rem;
    display: flex;
    align-items: center;
    gap: .4rem;
}

.af-header__eyebrow::before {
    content: '';
    display: inline-block;
    width: 18px; height: 2px;
    background: var(--violet);
    border-radius: 2px;
}

.af-header__title {
    font-family: 'Syne', sans-serif;
    font-size: 1.6rem;
    font-weight: 800;
    color: var(--ink);
    margin: 0 0 .2rem;
    line-height: 1.15;
}

.af-header__meta {
    display: flex;
    align-items: center;
    gap: .6rem;
    flex-wrap: wrap;
}

.af-header__actions { display: flex; align-items: center; gap: .5rem; }

.btn-primary-solid {
    display: inline-flex;
    align-items: center;
    gap: .45rem;
    background: var(--accent);
    color: #fff;
    font-family: 'Syne', sans-serif;
    font-size: .82rem;
    font-weight: 600;
    letter-spacing: .02em;
    padding: .6rem 1.25rem;
    border-radius: var(--radius);
    border: none;
    cursor: pointer;
    text-decoration: none;
    transition: background .15s, transform .12s, box-shadow .15s;
    box-shadow: 0 2px 8px rgba(59,91,219,.3);
    white-space: nowrap;
}
.btn-primary-solid:hover { background: var(--accent-2); transform: translateY(-1px); color: #fff; }

.btn-secondary-outline {
    display: inline-flex;
    align-items: center;
    gap: .45rem;
    background: var(--white);
    color: var(--ink-3);
    font-family: 'DM Sans', sans-serif;
    font-size: .82rem;
    font-weight: 500;
    padding: .58rem 1.1rem;
    border-radius: var(--radius);
    border: 1px solid var(--border);
    cursor: pointer;
    text-decoration: none;
    transition: background .15s;
    white-space: nowrap;
}
.btn-secondary-outline:hover { background: var(--surface-2); color: var(--ink); }

/* ── STAT CARDS ──────────────────────────────── */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: .875rem;
    margin-bottom: 1.75rem;
}

@media (max-width: 700px) { .stats-grid { grid-template-columns: 1fr 1fr; } }

.stat-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 1.3rem 1.4rem 1.2rem;
    position: relative;
    overflow: hidden;
    transition: transform .18s, box-shadow .18s;
    box-shadow: var(--shadow-sm);
}
.stat-card:hover { transform: translateY(-3px); box-shadow: var(--shadow); }

.stat-card__accent-bar {
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    border-radius: var(--radius-lg) var(--radius-lg) 0 0;
}

.stat-card__icon-wrap {
    width: 38px; height: 38px;
    border-radius: var(--radius);
    display: flex; align-items: center; justify-content: center;
    margin-bottom: .9rem;
    font-size: .95rem;
}

.stat-card__label {
    font-size: .72rem;
    font-weight: 500;
    letter-spacing: .06em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-bottom: .4rem;
}

.stat-card__value {
    font-family: 'Syne', sans-serif;
    font-size: 2rem;
    font-weight: 800;
    line-height: 1;
    color: var(--ink);
    margin-bottom: .5rem;
}

.stat-card__footer {
    display: flex;
    align-items: center;
    gap: .35rem;
    font-size: .75rem;
    color: var(--text-muted);
}

.stat-card__badge {
    display: inline-flex;
    align-items: center;
    gap: .2rem;
    padding: .2rem .55rem;
    border-radius: 999px;
    font-size: .68rem;
    font-weight: 600;
}

.sc-blue   .stat-card__accent-bar { background: linear-gradient(90deg, #3b5bdb, #748ffc); }
.sc-blue   .stat-card__icon-wrap  { background: #eef1fd; color: var(--accent); }
.sc-violet .stat-card__accent-bar { background: linear-gradient(90deg, #6741d9, #9775fa); }
.sc-violet .stat-card__icon-wrap  { background: var(--violet-bg); color: var(--violet); }
.sc-green  .stat-card__accent-bar { background: linear-gradient(90deg, #087f5b, #38d9a9); }
.sc-green  .stat-card__icon-wrap  { background: #e6fcf5; color: var(--green); }

/* ── LAYOUT ──────────────────────────────────── */
.detail-layout {
    display: grid;
    grid-template-columns: 1fr 280px;
    gap: 1rem;
    align-items: start;
    margin-bottom: 1rem;
}

@media (max-width: 900px) { .detail-layout { grid-template-columns: 1fr; } }

/* ── SECTION CARD ────────────────────────────── */
.section-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
    margin-bottom: 1rem;
}

.section-card:last-child { margin-bottom: 0; }

.section-card__header {
    padding: 1rem 1.4rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
}

.section-card__title {
    font-family: 'Syne', sans-serif;
    font-size: .88rem;
    font-weight: 700;
    color: var(--ink);
    display: flex;
    align-items: center;
    gap: .5rem;
}

.section-card__title i { color: var(--accent); font-size: .82rem; }

.section-card__body { padding: 1.4rem; }

/* ── INFO TABLE ──────────────────────────────── */
.info-table { width: 100%; border-collapse: collapse; }

.info-table tr { border-bottom: 1px solid var(--border); }
.info-table tr:last-child { border-bottom: none; }

.info-table th {
    font-family: 'Syne', sans-serif;
    font-size: .7rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    color: var(--text-muted);
    padding: .75rem 0;
    width: 36%;
    vertical-align: middle;
}

.info-table td {
    font-size: .855rem;
    color: var(--ink-3);
    padding: .75rem 0;
    vertical-align: middle;
}

/* ── CODE / URL BADGES ───────────────────────── */
.code-badge {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    background: var(--violet-bg);
    border: 1px solid rgba(103,65,217,.15);
    border-radius: var(--radius-sm);
    padding: .28rem .65rem;
    font-family: 'DM Mono', 'Courier New', monospace;
    font-size: .78rem;
    color: var(--violet);
    font-weight: 600;
    letter-spacing: .03em;
}

.url-wrap {
    display: flex;
    align-items: center;
    gap: .5rem;
}

.url-badge {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    background: var(--surface-2);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: .28rem .65rem;
    font-family: 'DM Mono', 'Courier New', monospace;
    font-size: .76rem;
    color: var(--ink-3);
    letter-spacing: .01em;
    max-width: 340px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.btn-copy {
    display: inline-flex;
    align-items: center;
    gap: .3rem;
    padding: .28rem .65rem;
    border-radius: var(--radius-sm);
    border: 1px solid var(--border);
    background: var(--white);
    font-size: .72rem;
    font-family: 'DM Sans', sans-serif;
    font-weight: 500;
    color: var(--text-muted);
    cursor: pointer;
    transition: background .12s, color .12s;
    white-space: nowrap;
}
.btn-copy:hover { background: var(--sky-bg); color: var(--sky); border-color: rgba(12,127,188,.3); }
.btn-copy.copied { background: var(--green-bg); color: var(--green); border-color: rgba(8,127,91,.3); }

/* ── SIDEBAR ─────────────────────────────────── */
.sidebar-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
    margin-bottom: 1rem;
}
.sidebar-card:last-child { margin-bottom: 0; }

.sidebar-card__header {
    padding: .9rem 1.25rem;
    border-bottom: 1px solid var(--border);
    background: var(--surface);
}

.sidebar-card__title {
    font-family: 'Syne', sans-serif;
    font-size: .75rem;
    font-weight: 700;
    letter-spacing: .08em;
    text-transform: uppercase;
    color: var(--text-muted);
    display: flex;
    align-items: center;
    gap: .4rem;
}

.sidebar-card__body { padding: 1.25rem; }

.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: .55rem 0;
    border-bottom: 1px solid var(--border);
    font-size: .82rem;
}
.summary-row:last-child { border-bottom: none; padding-bottom: 0; }
.summary-row:first-child { padding-top: 0; }

.summary-label { color: var(--text-muted); font-size: .78rem; }
.summary-value { font-weight: 600; color: var(--ink); font-size: .82rem; text-align: right; }

/* ── DATA TABLE ──────────────────────────────── */
.af-table {
    width: 100%;
    border-collapse: collapse;
}

.af-table thead {
    background: var(--surface);
    border-bottom: 1px solid var(--border);
}

.af-table thead th {
    font-family: 'Syne', sans-serif;
    font-size: .68rem;
    font-weight: 700;
    letter-spacing: .07em;
    text-transform: uppercase;
    color: var(--text-muted);
    padding: .7rem 1rem;
    white-space: nowrap;
}

.af-table thead th:first-child { padding-left: 1.4rem; }
.af-table thead th:last-child  { padding-right: 1.4rem; }

.af-table tbody tr {
    border-bottom: 1px solid var(--border);
    transition: background .1s;
}
.af-table tbody tr:last-child { border-bottom: none; }
.af-table tbody tr:hover { background: rgba(59,91,219,.025); }

.af-table td {
    padding: .85rem 1rem;
    font-size: .845rem;
    vertical-align: middle;
    color: var(--ink-3);
}
.af-table td:first-child { padding-left: 1.4rem; }
.af-table td:last-child  { padding-right: 1.4rem; }

/* Customer cell */
.customer-info { display: flex; flex-direction: column; gap: .1rem; }
.customer-name { font-weight: 600; color: var(--ink); font-size: .855rem; }
.customer-email { font-size: .74rem; color: var(--text-muted); }

/* IP badge */
.ip-badge {
    display: inline-flex;
    align-items: center;
    gap: .3rem;
    background: var(--surface-2);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: .2rem .55rem;
    font-family: 'DM Mono', 'Courier New', monospace;
    font-size: .75rem;
    color: var(--ink-3);
}

/* Agent text */
.agent-text {
    font-size: .76rem;
    color: var(--text-muted);
    max-width: 260px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    display: block;
}

/* Empty state */
.empty-row td {
    padding: 3rem 1.4rem;
    text-align: center;
    color: var(--text-muted);
}

.empty-row__icon {
    font-size: 1.6rem;
    opacity: .25;
    display: block;
    margin-bottom: .5rem;
}

/* Table footer */
.table-footer {
    padding: 1rem 1.4rem;
    border-top: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: .75rem;
    background: var(--surface);
}

.table-footer__info { font-size: .78rem; color: var(--text-muted); }

.pagination .page-link {
    font-family: 'DM Sans', sans-serif;
    font-size: .78rem;
    color: var(--ink-3);
    border-color: var(--border);
    border-radius: var(--radius-sm) !important;
    margin: 0 2px;
    padding: .35rem .65rem;
    transition: background .12s, color .12s;
}
.pagination .page-link:hover { background: var(--surface-2); color: var(--ink); }
.pagination .page-item.active .page-link { background: var(--accent); border-color: var(--accent); color: #fff; }

/* ── TOAST ───────────────────────────────────── */
.af-toast {
    position: fixed;
    top: 1.25rem; right: 1.25rem;
    padding: .75rem 1.1rem;
    background: var(--ink);
    color: var(--white);
    border-radius: var(--radius);
    font-size: .82rem;
    display: flex;
    align-items: center;
    gap: .5rem;
    z-index: 9999;
    box-shadow: var(--shadow-lg);
    transform: translateX(120%);
    transition: transform .22s cubic-bezier(.34,1.56,.64,1);
}
.af-toast.show { transform: translateX(0); }
</style>
@endpush

<div class="container-fluid px-4 py-2">

    {{-- Page Header --}}
    <div class="af-header">
        <div class="af-header__left">
            <div class="af-header__icon-wrap">
                <i class="fas fa-link"></i>
            </div>
            <div>
                <div class="af-header__eyebrow">
                    <i class="fas fa-link"></i> Affiliate Links
                </div>
                <h1 class="af-header__title">Link Details</h1>
                <div class="af-header__meta">
                    <span class="code-badge">
                        <i class="fas fa-tag" style="font-size:.65rem;opacity:.6"></i>
                        {{ $affiliateLink->link_code }}
                    </span>
                    <span style="font-size:.8rem;color:var(--text-muted)">
                        {{ $affiliateLink->affiliate->user->name }}
                    </span>
                </div>
            </div>
        </div>

        <div class="af-header__actions">
            <a href="{{ route('admin.affiliate.links.edit', $affiliateLink) }}" class="btn-primary-solid">
                <i class="fas fa-pen"></i> Edit Link
            </a>
            <a href="{{ route('admin.affiliate.show', $affiliateLink->affiliate->affiliate_code) }}"
               class="btn-secondary-outline">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="stats-grid">
        <div class="stat-card sc-blue">
            <div class="stat-card__accent-bar"></div>
            <div class="stat-card__icon-wrap"><i class="fas fa-mouse-pointer"></i></div>
            <div class="stat-card__label">Total Clicks</div>
            <div class="stat-card__value">{{ number_format($affiliateLink->clicks_count) }}</div>
            <div class="stat-card__footer">
                <span class="stat-card__badge" style="background:#eef1fd;color:var(--accent)">
                    <i class="fas fa-chart-line" style="font-size:.6rem"></i> All time
                </span>
            </div>
        </div>

        <div class="stat-card sc-violet">
            <div class="stat-card__accent-bar"></div>
            <div class="stat-card__icon-wrap"><i class="fas fa-box"></i></div>
            <div class="stat-card__label">Product</div>
            <div class="stat-card__value" style="font-size:1.1rem;line-height:1.3;padding-top:.4rem">
                {{ $affiliateLink->product ? $affiliateLink->product->name : 'General' }}
            </div>
            <div class="stat-card__footer">
                <span class="stat-card__badge" style="background:var(--violet-bg);color:var(--violet)">
                    {{ $affiliateLink->product ? 'Product link' : 'General link' }}
                </span>
            </div>
        </div>

        <div class="stat-card sc-green">
            <div class="stat-card__accent-bar"></div>
            <div class="stat-card__icon-wrap"><i class="fas fa-calendar-plus"></i></div>
            <div class="stat-card__label">Created</div>
            <div class="stat-card__value" style="font-size:1.1rem;line-height:1.3;padding-top:.4rem">
                {{ $affiliateLink->created_at->format('M d, Y') }}
            </div>
            <div class="stat-card__footer">
                <span class="stat-card__badge" style="background:var(--green-bg);color:var(--green)">
                    {{ $affiliateLink->created_at->diffForHumans() }}
                </span>
            </div>
        </div>
    </div>

    {{-- Detail + Sidebar --}}
    <div class="detail-layout">

        {{-- Link Information --}}
        <div class="section-card">
            <div class="section-card__header">
                <div class="section-card__title">
                    <i class="fas fa-info-circle"></i> Link Information
                </div>
            </div>
            <div class="section-card__body">
                <table class="info-table">
                    <tr>
                        <th>Affiliate</th>
                        <td>
                            <span style="font-weight:600">{{ $affiliateLink->affiliate->user->name }}</span>
                            <span class="code-badge" style="margin-left:.5rem">{{ $affiliateLink->affiliate->affiliate_code }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Link Code</th>
                        <td>
                            <span class="code-badge">
                                <i class="fas fa-link" style="font-size:.6rem;opacity:.5"></i>
                                {{ $affiliateLink->link_code }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Full URL</th>
                        <td>
                            <div class="url-wrap">
                                <span class="url-badge" id="linkUrl">{{ url('/r/' . $affiliateLink->link_code) }}</span>
                                <button class="btn-copy" id="copyBtn" onclick="copyUrl()">
                                    <i class="fas fa-copy"></i> Copy
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Product</th>
                        <td>
                            @if($affiliateLink->product)
                                <span style="font-weight:500">{{ $affiliateLink->product->name }}</span>
                            @else
                                <span style="color:var(--text-muted);font-style:italic">General Link — not tied to a product</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Total Clicks</th>
                        <td>
                            <span style="font-family:'Syne',sans-serif;font-weight:700;font-size:1.05rem;color:var(--accent)">
                                {{ number_format($affiliateLink->clicks_count) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Created</th>
                        <td style="color:var(--text-muted)">{{ $affiliateLink->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- Sidebar --}}
        <div>
            <div class="sidebar-card">
                <div class="sidebar-card__header">
                    <div class="sidebar-card__title">
                        <i class="fas fa-chart-bar"></i> Quick Stats
                    </div>
                </div>
                <div class="sidebar-card__body">
                    <div class="summary-row">
                        <span class="summary-label">Total Clicks</span>
                        <span class="summary-value" style="color:var(--accent);font-family:'Syne',sans-serif;font-size:.95rem">
                            {{ number_format($affiliateLink->clicks_count) }}
                        </span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Affiliate</span>
                        <span class="summary-value">{{ $affiliateLink->affiliate->user->name }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Product</span>
                        <span class="summary-value">{{ $affiliateLink->product->name ?? '—' }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Created</span>
                        <span class="summary-value">{{ $affiliateLink->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Age</span>
                        <span class="summary-value">{{ $affiliateLink->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Clicks Table --}}
    <div class="section-card">
        <div class="section-card__header">
            <div class="section-card__title">
                <i class="fas fa-mouse-pointer"></i> Recent Clicks
            </div>
            @if($clicks->count())
            <span style="font-size:.72rem;font-weight:600;background:var(--surface-2);color:var(--text-muted);border-radius:999px;padding:.2rem .65rem">
                {{ $clicks->total() }} total
            </span>
            @endif
        </div>

        <div style="overflow-x:auto">
            <table class="af-table">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>IP Address</th>
                        <th>User Agent</th>
                        <th>Clicked At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clicks as $click)
                    <tr>
                        <td>
                            @if($click->customer)
                                <div class="customer-info">
                                    <span class="customer-name">{{ $click->customer->name }}</span>
                                    <span class="customer-email">{{ $click->customer->email }}</span>
                                </div>
                            @else
                                <span style="color:var(--text-muted);font-style:italic;font-size:.82rem">Anonymous</span>
                            @endif
                        </td>
                        <td>
                            <span class="ip-badge">
                                <i class="fas fa-network-wired" style="font-size:.65rem;opacity:.5"></i>
                                {{ $click->ip_address }}
                            </span>
                        </td>
                        <td>
                            <span class="agent-text" title="{{ $click->user_agent }}">
                                {{ Str::limit($click->user_agent, 50) }}
                            </span>
                        </td>
                        <td style="color:var(--text-muted);white-space:nowrap">
                            {{ $click->created_at->format('M d, Y H:i') }}
                        </td>
                    </tr>
                    @empty
                    <tr class="empty-row">
                        <td colspan="4">
                            <span class="empty-row__icon"><i class="fas fa-mouse-pointer"></i></span>
                            No clicks recorded yet
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($clicks->hasPages())
        <div class="table-footer">
            <span class="table-footer__info">
                Showing {{ $clicks->firstItem() }}–{{ $clicks->lastItem() }} of {{ $clicks->total() }} clicks
            </span>
            <div>{{ $clicks->links('pagination::bootstrap-5') }}</div>
        </div>
        @endif
    </div>

</div>

{{-- Toast --}}
<div class="af-toast" id="afToast">
    <i class="fas fa-check-circle"></i>
    <span id="afToastMsg"></span>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
        new bootstrap.Tooltip(el, { trigger: 'hover' });
    });
});

function copyUrl() {
    const url = document.getElementById('linkUrl').textContent.trim();
    const btn = document.getElementById('copyBtn');

    navigator.clipboard.writeText(url).then(() => {
        btn.classList.add('copied');
        btn.innerHTML = '<i class="fas fa-check"></i> Copied!';
        showToast('Link URL copied to clipboard');
        setTimeout(() => {
            btn.classList.remove('copied');
            btn.innerHTML = '<i class="fas fa-copy"></i> Copy';
        }, 2200);
    });
}

function showToast(msg) {
    const toast = document.getElementById('afToast');
    document.getElementById('afToastMsg').textContent = msg;
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 2800);
}
</script>
@endpush

@endsection