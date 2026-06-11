{{-- resources/views/admin/affiliates/index.blade.php --}}
@extends('admin.layouts.affiliate')

@section('title', 'Affiliates Management')

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

.af-header__eyebrow {
    font-family: 'Syne', sans-serif;
    font-size: .7rem;
    font-weight: 600;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--violet);
    margin-bottom: .3rem;
    display: flex;
    align-items: center;
    gap: .4rem;
}

.af-header__eyebrow::before {
    content: '';
    display: inline-block;
    width: 18px;
    height: 2px;
    background: var(--violet);
    border-radius: 2px;
}

.af-header__title {
    font-family: 'Syne', sans-serif;
    font-size: 1.75rem;
    font-weight: 800;
    color: var(--ink);
    margin: 0 0 .25rem;
    line-height: 1.15;
}

.af-header__sub {
    color: var(--text-muted);
    font-size: .875rem;
    margin: 0;
}

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
.btn-primary-solid:hover {
    background: var(--accent-2);
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(59,91,219,.35);
    color: #fff;
}

/* ── STAT CARDS ──────────────────────────────── */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: .875rem;
    margin-bottom: 1.75rem;
}

@media (max-width: 900px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 480px) { .stats-grid { grid-template-columns: 1fr 1fr; } }

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

/* Color variants */
.sc-violet .stat-card__accent-bar { background: linear-gradient(90deg, #6741d9, #9775fa); }
.sc-violet .stat-card__icon-wrap  { background: var(--violet-bg); color: var(--violet); }
.sc-green  .stat-card__accent-bar { background: linear-gradient(90deg, #087f5b, #38d9a9); }
.sc-green  .stat-card__icon-wrap  { background: #e6fcf5; color: var(--green); }
.sc-amber  .stat-card__accent-bar { background: linear-gradient(90deg, #e67700, #ffd43b); }
.sc-amber  .stat-card__icon-wrap  { background: #fff9db; color: var(--amber); }
.sc-sky    .stat-card__accent-bar { background: linear-gradient(90deg, #0c7fbc, #74c0fc); }
.sc-sky    .stat-card__icon-wrap  { background: #e8f4fd; color: var(--sky); }

/* ── FILTER CARD ─────────────────────────────── */
.filter-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 1.4rem 1.5rem;
    margin-bottom: 1rem;
    box-shadow: var(--shadow-sm);
}

.filter-card__title {
    font-family: 'Syne', sans-serif;
    font-size: .78rem;
    font-weight: 700;
    letter-spacing: .08em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: .5rem;
}

.filter-row {
    display: grid;
    grid-template-columns: 2fr 1fr auto;
    gap: .75rem;
    align-items: end;
}

@media (max-width: 768px) {
    .filter-row { grid-template-columns: 1fr 1fr; }
    .filter-row .filter-actions { grid-column: 1 / -1; }
}

.form-group label {
    display: block;
    font-size: .75rem;
    font-weight: 500;
    color: var(--ink-3);
    margin-bottom: .4rem;
    letter-spacing: .01em;
}

.form-control,
.form-select {
    width: 100%;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: .55rem .85rem;
    font-family: 'DM Sans', sans-serif;
    font-size: .855rem;
    color: var(--ink);
    transition: border-color .15s, box-shadow .15s;
    appearance: none;
    -webkit-appearance: none;
}

.form-control:focus,
.form-select:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(59,91,219,.12);
    background: var(--white);
}

.input-with-icon { position: relative; }

.input-with-icon .icon {
    position: absolute;
    left: .75rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    font-size: .8rem;
    pointer-events: none;
}

.input-with-icon .form-control { padding-left: 2.2rem; }

.select-wrap { position: relative; }

.select-wrap::after {
    content: '\f107';
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    position: absolute;
    right: .85rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    font-size: .75rem;
    pointer-events: none;
}

.filter-actions { display: flex; gap: .5rem; }

.btn-apply {
    flex: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: .4rem;
    background: var(--accent);
    color: #fff;
    font-family: 'DM Sans', sans-serif;
    font-size: .83rem;
    font-weight: 500;
    padding: .56rem 1rem;
    border-radius: var(--radius);
    border: none;
    cursor: pointer;
    text-decoration: none;
    transition: background .15s;
    white-space: nowrap;
}
.btn-apply:hover { background: var(--accent-2); color: #fff; }

.btn-reset {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: .4rem;
    background: var(--surface-2);
    color: var(--ink-3);
    font-family: 'DM Sans', sans-serif;
    font-size: .83rem;
    font-weight: 500;
    padding: .56rem .9rem;
    border-radius: var(--radius);
    border: 1px solid var(--border);
    cursor: pointer;
    text-decoration: none;
    transition: background .15s;
    white-space: nowrap;
}
.btn-reset:hover { background: var(--border); color: var(--ink); }

/* ── TABLE CARD ──────────────────────────────── */
.table-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
}

.table-card__header {
    padding: 1.1rem 1.5rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    background: var(--white);
}

.table-card__title {
    font-family: 'Syne', sans-serif;
    font-size: .92rem;
    font-weight: 700;
    color: var(--ink);
    display: flex;
    align-items: center;
    gap: .55rem;
}

.table-card__title i { color: var(--accent); font-size: .85rem; }

.table-total-badge {
    font-size: .72rem;
    font-weight: 600;
    background: var(--surface-2);
    color: var(--text-muted);
    border-radius: 999px;
    padding: .2rem .65rem;
}

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
    padding: .75rem 1rem;
    white-space: nowrap;
}

.af-table thead th:first-child { padding-left: 1.4rem; }
.af-table thead th:last-child  { padding-right: 1.4rem; text-align: center; }

.af-table tbody tr {
    border-bottom: 1px solid var(--border);
    transition: background .1s;
}

.af-table tbody tr:last-child { border-bottom: none; }
.af-table tbody tr:hover { background: rgba(59,91,219,.025); }

.af-table td {
    padding: .9rem 1rem;
    font-size: .855rem;
    vertical-align: middle;
}

.af-table td:first-child { padding-left: 1.4rem; }
.af-table td:last-child  { padding-right: 1.4rem; }

/* Affiliate info cell */
.affiliate-info {
    display: flex;
    align-items: center;
    gap: .85rem;
}

.affiliate-avatar {
    flex-shrink: 0;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #6741d9, #9775fa);
    color: #fff;
    font-family: 'Syne', sans-serif;
    font-size: .95rem;
    font-weight: 700;
    border: 2px solid var(--border);
}

.affiliate-name {
    font-weight: 600;
    color: var(--ink);
    font-size: .88rem;
    margin-bottom: .18rem;
    line-height: 1.2;
}

.affiliate-email {
    font-size: .76rem;
    color: var(--text-muted);
}

/* Code badge */
.code-badge {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    background: var(--surface-2);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: .28rem .65rem;
    font-family: 'DM Mono', 'Courier New', monospace;
    font-size: .78rem;
    color: var(--violet);
    font-weight: 600;
    letter-spacing: .03em;
}

/* Status pill */
.status-pill {
    display: inline-flex;
    align-items: center;
    gap: .3rem;
    padding: .25rem .65rem;
    border-radius: 999px;
    font-size: .73rem;
    font-weight: 500;
    width: fit-content;
}

.sp-active    { background: var(--green-bg);  color: var(--green);  }
.sp-inactive  { background: var(--amber-bg);  color: var(--amber);  }
.sp-suspended { background: var(--red-bg);    color: var(--red);    }

/* Metric cell */
.metric-cell { text-align: right; }

.metric-value {
    font-family: 'Syne', sans-serif;
    font-size: .95rem;
    font-weight: 700;
    color: var(--ink);
    display: block;
}

.metric-value.earnings { color: var(--green); }

.metric-label {
    font-size: .67rem;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: .05em;
}

/* Mini stat pair */
.mini-stat-pair {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: .1rem;
}

/* ID badge */
.id-badge {
    font-size: .68rem;
    font-weight: 600;
    color: var(--text-muted);
    background: var(--surface-2);
    padding: .12rem .45rem;
    border-radius: var(--radius-sm);
    font-family: 'Syne', sans-serif;
    letter-spacing: .04em;
}

/* Date */
.date-text {
    font-size: .78rem;
    color: var(--text-muted);
}

/* Actions */
.action-group {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .35rem;
}

.btn-action {
    width: 32px;
    height: 32px;
    border-radius: var(--radius);
    border: 1px solid var(--border);
    background: var(--white);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .77rem;
    cursor: pointer;
    text-decoration: none;
    transition: background .12s, border-color .12s, transform .1s, color .12s;
    color: var(--text-muted);
}

.btn-action:hover { transform: translateY(-1px); }
.btn-action--view:hover   { background: var(--sky-bg);    border-color: rgba(12,127,188,.3);  color: var(--sky);    }
.btn-action--edit:hover   { background: var(--amber-bg);  border-color: rgba(230,119,0,.3);   color: var(--amber);  }
.btn-action--delete:hover { background: var(--red-bg);    border-color: rgba(201,42,42,.3);   color: var(--red);    }

/* Empty state */
.empty-state {
    padding: 4rem 2rem;
    text-align: center;
}

.empty-state__icon {
    width: 72px;
    height: 72px;
    background: var(--surface-2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.25rem;
    font-size: 1.6rem;
    color: var(--text-muted);
}

.empty-state h5 {
    font-family: 'Syne', sans-serif;
    font-size: 1rem;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: .4rem;
}

.empty-state p {
    font-size: .875rem;
    color: var(--text-muted);
    margin-bottom: 1.25rem;
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

.table-footer__info {
    font-size: .78rem;
    color: var(--text-muted);
}

/* Pagination */
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

/* Toast */
.af-toast {
    position: fixed;
    top: 1.25rem;
    right: 1.25rem;
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
        <div>
            <div class="af-header__eyebrow">
                <i class="fas fa-handshake"></i> Partner Program
            </div>
            <h1 class="af-header__title">Affiliates</h1>
            <p class="af-header__sub">Track and manage your affiliate partner network</p>
        </div>
        <div>
            <a href="{{ route('admin.affiliate.create') }}" class="btn-primary-solid">
                <i class="fas fa-plus"></i> Add New Affiliate
            </a>
        </div>
    </div>

    {{-- Stats --}}
    <div class="stats-grid">
        <div class="stat-card sc-violet">
            <div class="stat-card__accent-bar"></div>
            <div class="stat-card__icon-wrap"><i class="fas fa-users"></i></div>
            <div class="stat-card__label">Total Affiliates</div>
            <div class="stat-card__value">{{ $affiliates->total() }}</div>
            <div class="stat-card__footer">
                <span class="stat-card__badge" style="background:var(--violet-bg);color:var(--violet)">
                    <i class="fas fa-user-plus" style="font-size:.6rem"></i> All time
                </span>
            </div>
        </div>

        <div class="stat-card sc-green">
            <div class="stat-card__accent-bar"></div>
            <div class="stat-card__icon-wrap"><i class="fas fa-check-circle"></i></div>
            <div class="stat-card__label">Active</div>
            <div class="stat-card__value">{{ $affiliates->where('status', 'active')->count() }}</div>
            <div class="stat-card__footer">
                <span class="stat-card__badge" style="background:var(--green-bg);color:var(--green)">
                    <i class="fas fa-circle" style="font-size:.5rem"></i> Live
                </span>
                <span>earning now</span>
            </div>
        </div>

        <div class="stat-card sc-amber">
            <div class="stat-card__accent-bar"></div>
            <div class="stat-card__icon-wrap"><i class="fas fa-dollar-sign"></i></div>
            <div class="stat-card__label">Total Earnings Paid</div>
            <div class="stat-card__value">${{ number_format($affiliates->sum('total_earnings'), 0) }}</div>
            <div class="stat-card__footer">
                <span class="stat-card__badge" style="background:var(--amber-bg);color:var(--amber)">
                    <i class="fas fa-arrow-up" style="font-size:.6rem"></i> Lifetime
                </span>
            </div>
        </div>

        <div class="stat-card sc-sky">
            <div class="stat-card__accent-bar"></div>
            <div class="stat-card__icon-wrap"><i class="fas fa-mouse-pointer"></i></div>
            <div class="stat-card__label">Total Clicks</div>
            <div class="stat-card__value">—</div>
            <div class="stat-card__footer">
                <span class="stat-card__badge" style="background:var(--sky-bg);color:var(--sky)">
                    <i class="fas fa-chart-line" style="font-size:.6rem"></i> All links
                </span>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="filter-card">
        <div class="filter-card__title">
            <i class="fas fa-sliders-h"></i> Filter & Search
        </div>
        <form method="GET" action="{{ route('admin.affiliate.index') }}">
            <div class="filter-row">
                <div class="form-group">
                    <label>Search Affiliates</label>
                    <div class="input-with-icon">
                        <i class="fas fa-search icon"></i>
                        <input type="text" name="search" class="form-control"
                               placeholder="Name, email or code…"
                               value="{{ request('search') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <div class="select-wrap">
                        <select name="status" class="form-select">
                            <option value="">All Status</option>
                            <option value="active"    {{ request('status') == 'active'    ? 'selected' : '' }}>Active</option>
                            <option value="inactive"  {{ request('status') == 'inactive'  ? 'selected' : '' }}>Inactive</option>
                            <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                        </select>
                    </div>
                </div>

                <div class="form-group filter-actions">
                    <label style="visibility:hidden">.</label>
                    <button type="submit" class="btn-apply">
                        <i class="fas fa-filter"></i> Apply
                    </button>
                    <a href="{{ route('admin.affiliate.index') }}" class="btn-reset">
                        <i class="fas fa-redo"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- Table Card --}}
    <div class="table-card">
        <div class="table-card__header">
            <div class="table-card__title">
                <i class="fas fa-list-ul"></i> Affiliates List
            </div>
            <span class="table-total-badge">{{ $affiliates->total() }} total</span>
        </div>

        <div style="overflow-x:auto;">
            <table class="af-table">
                <thead>
                    <tr>
                        <th>Affiliate</th>
                        <th>Code</th>
                        <th>Status</th>
                        <th style="text-align:right">Earnings</th>
                        <th style="text-align:right">Links</th>
                        <th style="text-align:right">Clicks</th>
                        <th>Joined</th>
                        <th style="text-align:center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($affiliates as $affiliate)
                    <tr>
                        {{-- Affiliate --}}
                        <td>
                            <div class="affiliate-info">
                                <div class="affiliate-avatar">
                                    {{ strtoupper(substr($affiliate->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="affiliate-name">{{ $affiliate->user->name }}</div>
                                    <div class="affiliate-email">{{ $affiliate->user->email }}</div>
                                </div>
                            </div>
                        </td>

                        {{-- Code --}}
                        <td>
                            <span class="code-badge">
                                <i class="fas fa-tag" style="font-size:.65rem;opacity:.6"></i>
                                {{ $affiliate->affiliate_code }}
                            </span>
                        </td>

                        {{-- Status --}}
                        <td>
                            <span class="status-pill
                                @if($affiliate->status === 'active')    sp-active
                                @elseif($affiliate->status === 'inactive') sp-inactive
                                @else sp-suspended @endif">
                                <i class="fas fa-{{ $affiliate->status === 'active' ? 'check-circle' : ($affiliate->status === 'inactive' ? 'pause-circle' : 'ban') }}" style="font-size:.7rem"></i>
                                {{ ucfirst($affiliate->status) }}
                            </span>
                        </td>

                        {{-- Earnings --}}
                        <td class="metric-cell">
                            <span class="metric-value earnings">${{ number_format($affiliate->total_earnings, 2) }}</span>
                            <span class="metric-label">Earned</span>
                        </td>

                        {{-- Links --}}
                        <td class="metric-cell">
                            <span class="metric-value">{{ $affiliate->affiliateLinks()->count() }}</span>
                            <span class="metric-label">Links</span>
                        </td>

                        {{-- Clicks --}}
                        <td class="metric-cell">
                            <span class="metric-value">{{ $affiliate->affiliateClicks()->count() }}</span>
                            <span class="metric-label">Clicks</span>
                        </td>

                        {{-- Joined --}}
                        <td>
                            <span class="date-text">{{ $affiliate->created_at->format('M d, Y') }}</span>
                        </td>

                        {{-- Actions --}}
                        <td>
                            <div class="action-group">
                                <a href="{{ route('admin.affiliate.show', $affiliate) }}"
                                   class="btn-action btn-action--view"
                                   title="View"
                                   data-bs-toggle="tooltip">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.affiliate.edit', $affiliate) }}"
                                   class="btn-action btn-action--edit"
                                   title="Edit"
                                   data-bs-toggle="tooltip">
                                    <i class="fas fa-pen"></i>
                                </a>
                                @if($affiliate->total_earnings == 0 && $affiliate->commissions()->count() == 0)
                                <form action="{{ route('admin.affiliate.destroy', $affiliate) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn-action btn-action--delete"
                                            onclick="return confirm('Are you sure you want to delete this affiliate?')"
                                            title="Delete"
                                            data-bs-toggle="tooltip">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <div class="empty-state__icon">
                                    <i class="fas fa-handshake"></i>
                                </div>
                                <h5>No Affiliates Found</h5>
                                <p>Get started by adding your first affiliate partner</p>
                                <a href="{{ route('admin.affiliate.create') }}" class="btn-primary-solid">
                                    <i class="fas fa-plus"></i> Add New Affiliate
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($affiliates->hasPages())
        <div class="table-footer">
            <span class="table-footer__info">
                Showing {{ $affiliates->firstItem() }}–{{ $affiliates->lastItem() }} of {{ $affiliates->total() }} entries
            </span>
            <div>{{ $affiliates->withQueryString()->links('pagination::bootstrap-5') }}</div>
        </div>
        @endif
    </div>

</div>

{{-- Toast --}}
<div class="af-toast" id="afToast">
    <i class="fas fa-info-circle"></i>
    <span id="afToastMsg"></span>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
        new bootstrap.Tooltip(el, { trigger: 'hover' });
    });
});

function showToast(msg, type = 'info') {
    const toast = document.getElementById('afToast');
    document.getElementById('afToastMsg').textContent = msg;
    toast.className = 'af-toast' + (type === 'warning' ? ' warning' : '');
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 3200);
}
</script>
@endpush

@endsection