{{-- resources/views/admin/delivery-partners/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Delivery Partners Management')

@section('content')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">

<style>
:root {
    --ink:       #0d0f14;
    --ink-2:     #1e2230;
    --ink-3:     #2d3348;
    --surface:   #f4f5f8;
    --surface-2: #eceef3;
    --white:     #ffffff;
    --accent:    #3b5bdb;
    --accent-2:  #1971c2;
    --green:     #087f5b;
    --green-bg:  #d3f9d8;
    --amber:     #e67700;
    --amber-bg:  #fff3bf;
    --red:       #c92a2a;
    --red-bg:    #ffe3e3;
    --sky:       #0c7fbc;
    --sky-bg:    #dde9f7;
    --border:    #e2e5ec;
    --text-muted:#6b7280;
    --radius-sm: 6px;
    --radius:    10px;
    --radius-lg: 16px;
    --shadow-sm: 0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
    --shadow:    0 4px 12px rgba(0,0,0,.07), 0 2px 4px rgba(0,0,0,.04);
    --shadow-lg: 0 12px 32px rgba(0,0,0,.10), 0 4px 8px rgba(0,0,0,.05);
}

* { box-sizing: border-box; }

body { font-family: 'DM Sans', sans-serif; background: var(--surface); color: var(--ink); }

/* ── PAGE HEADER ─────────────────────────────── */
.dp-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 1.75rem;
}

.dp-header__eyebrow {
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

.dp-header__eyebrow::before {
    content: '';
    display: inline-block;
    width: 18px;
    height: 2px;
    background: var(--accent);
    border-radius: 2px;
}

.dp-header__title {
    font-family: 'Syne', sans-serif;
    font-size: 1.75rem;
    font-weight: 800;
    color: var(--ink);
    margin: 0 0 .25rem;
    line-height: 1.15;
}

.dp-header__sub {
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

@media (max-width: 900px) {
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 480px) {
    .stats-grid { grid-template-columns: 1fr 1fr; }
}

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

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow);
}

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
.sc-blue  .stat-card__accent-bar { background: linear-gradient(90deg, #3b5bdb, #748ffc); }
.sc-blue  .stat-card__icon-wrap  { background: #eef1fd; color: var(--accent); }
.sc-green .stat-card__accent-bar { background: linear-gradient(90deg, #087f5b, #38d9a9); }
.sc-green .stat-card__icon-wrap  { background: #e6fcf5; color: var(--green); }
.sc-amber .stat-card__accent-bar { background: linear-gradient(90deg, #e67700, #ffd43b); }
.sc-amber .stat-card__icon-wrap  { background: #fff9db; color: var(--amber); }
.sc-sky   .stat-card__accent-bar { background: linear-gradient(90deg, #0c7fbc, #74c0fc); }
.sc-sky   .stat-card__icon-wrap  { background: #e8f4fd; color: var(--sky); }

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
    grid-template-columns: 2fr 1fr 1fr 1fr auto;
    gap: .75rem;
    align-items: end;
}

@media (max-width: 1024px) {
    .filter-row { grid-template-columns: 1fr 1fr 1fr; }
    .filter-row .filter-actions { grid-column: 1 / -1; }
}

@media (max-width: 640px) {
    .filter-row { grid-template-columns: 1fr 1fr; }
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

.input-with-icon {
    position: relative;
}

.input-with-icon .icon {
    position: absolute;
    left: .75rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    font-size: .8rem;
    pointer-events: none;
}

.input-with-icon .form-control {
    padding-left: 2.2rem;
}

.select-wrap {
    position: relative;
}

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

.filter-actions {
    display: flex;
    gap: .5rem;
}

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

/* ── BULK ACTIONS ────────────────────────────── */
.bulk-bar {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: .85rem 1.4rem;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: .75rem;
    box-shadow: var(--shadow-sm);
}

.bulk-bar__left {
    display: flex;
    align-items: center;
    gap: .9rem;
    flex-wrap: wrap;
}

.bulk-count {
    display: flex;
    align-items: center;
    gap: .4rem;
}

.bulk-count__badge {
    font-family: 'Syne', sans-serif;
    font-size: .82rem;
    font-weight: 700;
    background: var(--accent);
    color: #fff;
    border-radius: 999px;
    padding: .18rem .65rem;
    min-width: 30px;
    text-align: center;
    transition: transform .15s;
}

.bulk-count__label {
    font-size: .8rem;
    color: var(--text-muted);
}

.bulk-divider {
    width: 1px;
    height: 22px;
    background: var(--border);
}

.bulk-actions-group {
    display: flex;
    align-items: center;
    gap: .35rem;
    flex-wrap: wrap;
}

.btn-bulk {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    padding: .38rem .85rem;
    border-radius: var(--radius);
    font-family: 'DM Sans', sans-serif;
    font-size: .78rem;
    font-weight: 500;
    border: 1px solid;
    cursor: pointer;
    background: var(--white);
    transition: background .12s, transform .1s;
}

.btn-bulk:hover { transform: translateY(-1px); }

.btn-bulk--activate { color: var(--green);  border-color: rgba(8,127,91,.25);  }
.btn-bulk--activate:hover  { background: var(--green-bg); }

.btn-bulk--deactivate { color: var(--amber); border-color: rgba(230,119,0,.25); }
.btn-bulk--deactivate:hover { background: var(--amber-bg); }

.btn-bulk--verify { color: var(--sky);   border-color: rgba(12,127,188,.25); }
.btn-bulk--verify:hover  { background: var(--sky-bg); }

.btn-bulk--delete { color: var(--red);   border-color: rgba(201,42,42,.25);  }
.btn-bulk--delete:hover  { background: var(--red-bg); }

.bulk-bar__hint {
    font-size: .75rem;
    color: var(--text-muted);
    display: flex;
    align-items: center;
    gap: .35rem;
}

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

.table-card__title i {
    color: var(--accent);
    font-size: .85rem;
}

.table-total-badge {
    font-size: .72rem;
    font-weight: 600;
    background: var(--surface-2);
    color: var(--text-muted);
    border-radius: 999px;
    padding: .2rem .65rem;
}

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
    color: var(--text-muted);
    padding: .75rem 1rem;
    white-space: nowrap;
}

.dp-table thead th:first-child { padding-left: 1.4rem; }
.dp-table thead th:last-child  { padding-right: 1.4rem; text-align: center; }

.dp-table tbody tr {
    border-bottom: 1px solid var(--border);
    transition: background .1s;
}

.dp-table tbody tr:last-child { border-bottom: none; }

.dp-table tbody tr:hover { background: rgba(59,91,219,.025); }

.dp-table tbody tr.row-selected { background: rgba(59,91,219,.045); }

.dp-table td {
    padding: .9rem 1rem;
    font-size: .855rem;
    vertical-align: middle;
}

.dp-table td:first-child { padding-left: 1.4rem; }
.dp-table td:last-child  { padding-right: 1.4rem; }

/* Checkbox */
.dp-checkbox {
    width: 16px;
    height: 16px;
    border: 1.5px solid var(--border);
    border-radius: 4px;
    cursor: pointer;
    accent-color: var(--accent);
}

/* Partner cell */
.partner-info {
    display: flex;
    align-items: center;
    gap: .85rem;
}

.partner-avatar {
    position: relative;
    flex-shrink: 0;
}

.partner-avatar img,
.partner-avatar .avatar-init {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid var(--border);
}

.partner-avatar .avatar-init {
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #4263eb, #7048e8);
    color: #fff;
    font-family: 'Syne', sans-serif;
    font-size: 1rem;
    font-weight: 700;
}

.online-dot {
    position: absolute;
    bottom: 1px; right: 1px;
    width: 11px; height: 11px;
    border-radius: 50%;
    border: 2px solid var(--white);
}

.online-dot--on  { background: #12b886; }
.online-dot--off { background: #ced4da; }

.partner-name {
    font-weight: 600;
    color: var(--ink);
    font-size: .88rem;
    margin-bottom: .18rem;
    line-height: 1.2;
}

.partner-meta {
    display: flex;
    align-items: center;
    gap: .5rem;
}

.partner-id {
    font-size: .68rem;
    font-weight: 600;
    color: var(--text-muted);
    background: var(--surface-2);
    padding: .12rem .45rem;
    border-radius: var(--radius-sm);
    font-family: 'Syne', sans-serif;
    letter-spacing: .04em;
}

.partner-date {
    font-size: .72rem;
    color: var(--text-muted);
}

/* Contact cell */
.contact-stack {
    display: flex;
    flex-direction: column;
    gap: .3rem;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: .45rem;
    font-size: .8rem;
    color: var(--ink-3);
}

.contact-item i {
    width: 14px;
    color: var(--text-muted);
    font-size: .75rem;
    flex-shrink: 0;
}

/* Vehicle cell */
.vehicle-info {
    display: flex;
    flex-direction: column;
    gap: .3rem;
}

.vehicle-type-badge {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    padding: .28rem .65rem;
    border-radius: var(--radius-sm);
    font-size: .76rem;
    font-weight: 500;
    background: var(--surface-2);
    color: var(--ink-3);
    border: 1px solid var(--border);
    width: fit-content;
}

.vehicle-plate {
    font-size: .76rem;
    color: var(--text-muted);
    font-family: 'DM Sans', sans-serif;
    font-style: italic;
}

/* Status badges */
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

.sp-active   { background: var(--green-bg); color: var(--green); }
.sp-inactive { background: var(--amber-bg); color: var(--amber); }
.sp-suspended { background: var(--red-bg);  color: var(--red);  }
.sp-verified { background: var(--sky-bg);   color: var(--sky);  }
.sp-pending  { background: var(--amber-bg); color: var(--amber);}
.sp-rejected { background: var(--red-bg);   color: var(--red);  }

.status-stack {
    display: flex;
    flex-direction: column;
    gap: .35rem;
}

/* Performance cell */
.perf-cell {
    text-align: center;
}

.perf-numbers {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    margin-bottom: .35rem;
}

.perf-item {
    text-align: center;
}

.perf-value {
    font-family: 'Syne', sans-serif;
    font-size: .95rem;
    font-weight: 700;
    color: var(--ink);
    display: block;
}

.perf-value.earnings { color: var(--green); }

.perf-label {
    font-size: .67rem;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: .05em;
    margin-top: .05rem;
}

.perf-divider {
    width: 1px;
    height: 28px;
    background: var(--border);
}

.rating-row {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .35rem;
}

.stars { color: #f59e0b; font-size: .72rem; letter-spacing: 1px; }

.rating-val {
    font-family: 'Syne', sans-serif;
    font-size: .8rem;
    font-weight: 700;
    color: var(--ink);
}

.rating-count {
    font-size: .72rem;
    color: var(--text-muted);
}

/* Actions cell */
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

.btn-action--view:hover    { background: var(--sky-bg);   border-color: rgba(12,127,188,.3); color: var(--sky);   }
.btn-action--edit:hover    { background: var(--amber-bg); border-color: rgba(230,119,0,.3);  color: var(--amber); }
.btn-action--verify:hover  { background: var(--green-bg); border-color: rgba(8,127,91,.3);   color: var(--green); }
.btn-action--verified      { background: var(--surface);  color: var(--border); cursor: default; }
.btn-action--verified:hover { transform: none; background: var(--surface); }

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

/* Pagination footer */
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

/* Bootstrap pagination override */
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

.pagination .page-link:hover       { background: var(--surface-2); color: var(--ink); }
.pagination .page-item.active .page-link { background: var(--accent); border-color: var(--accent); color: #fff; }

/* ── NOTIFICATIONS ───────────────────────────── */
.dp-toast {
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

.dp-toast.show   { transform: translateX(0); }
.dp-toast.warning { background: var(--amber); }

/* ── RESPONSIVE ──────────────────────────────── */
@media (max-width: 1024px) {
    .dp-table .col-contact,
    .dp-table .col-vehicle  { display: none; }
}

@media (max-width: 768px) {
    .dp-table .col-perf { display: none; }
}
</style>
@endpush

<div class="container-fluid px-4 py-2">

    {{-- Page Header --}}
    <div class="dp-header">
        <div>
            <div class="dp-header__eyebrow">
                <i class="fas fa-truck"></i> Fleet Management
            </div>
            <h1 class="dp-header__title">Delivery Partners</h1>
            <p class="dp-header__sub">Monitor and manage your delivery fleet performance</p>
        </div>
        <div>
            <a href="{{ route('admin.delivery-partners.create') }}" class="btn-primary-solid">
                <i class="fas fa-plus"></i> Add New Partner
            </a>
        </div>
    </div>

    {{-- Stats --}}
    <div class="stats-grid">
        <div class="stat-card sc-blue">
            <div class="stat-card__accent-bar"></div>
            <div class="stat-card__icon-wrap"><i class="fas fa-users"></i></div>
            <div class="stat-card__label">Total Partners</div>
            <div class="stat-card__value">{{ $stats['total'] }}</div>
            <div class="stat-card__footer">
                <span class="stat-card__badge" style="background:#eef1fd;color:var(--accent)">
                    <i class="fas fa-arrow-up" style="font-size:.6rem"></i> 12%
                </span>
                <span>since last month</span>
            </div>
        </div>

        <div class="stat-card sc-green">
            <div class="stat-card__accent-bar"></div>
            <div class="stat-card__icon-wrap"><i class="fas fa-check-circle"></i></div>
            <div class="stat-card__label">Active</div>
            <div class="stat-card__value">{{ $stats['active'] }}</div>
            <div class="stat-card__footer">
                <span class="stat-card__badge" style="background:var(--green-bg);color:var(--green)">
                    {{ round(($stats['active'] / max($stats['total'], 1)) * 100) }}%
                </span>
                <span>currently working</span>
            </div>
        </div>

        <div class="stat-card sc-amber">
            <div class="stat-card__accent-bar"></div>
            <div class="stat-card__icon-wrap"><i class="fas fa-clock"></i></div>
            <div class="stat-card__label">Pending Verification</div>
            <div class="stat-card__value">{{ $stats['pending_verification'] }}</div>
            <div class="stat-card__footer">
                <span class="stat-card__badge" style="background:var(--amber-bg);color:var(--amber)">
                    <i class="fas fa-exclamation" style="font-size:.6rem"></i> Action
                </span>
                <span>awaiting review</span>
            </div>
        </div>

        <div class="stat-card sc-sky">
            <div class="stat-card__accent-bar"></div>
            <div class="stat-card__icon-wrap"><i class="fas fa-wifi"></i></div>
            <div class="stat-card__label">Online Now</div>
            <div class="stat-card__value">{{ $stats['online'] }}</div>
            <div class="stat-card__footer">
                <span class="stat-card__badge" style="background:var(--sky-bg);color:var(--sky)">
                    <i class="fas fa-circle" style="font-size:.5rem"></i> Live
                </span>
                <span>available for delivery</span>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="filter-card">
        <div class="filter-card__title">
            <i class="fas fa-sliders-h"></i> Filter & Search
        </div>
        <form method="GET">
            <div class="filter-row">
                <div class="form-group">
                    <label>Search Partners</label>
                    <div class="input-with-icon">
                        <i class="fas fa-search icon"></i>
                        <input type="text" name="search" class="form-control"
                               placeholder="Name, email, phone…"
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

                <div class="form-group">
                    <label>Verification</label>
                    <div class="select-wrap">
                        <select name="verification_status" class="form-select">
                            <option value="">All</option>
                            <option value="pending"  {{ request('verification_status') == 'pending'  ? 'selected' : '' }}>Pending</option>
                            <option value="verified" {{ request('verification_status') == 'verified' ? 'selected' : '' }}>Verified</option>
                            <option value="rejected" {{ request('verification_status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Sort By</label>
                    <div class="select-wrap">
                        <select name="sort" class="form-select">
                            <option value="latest"     {{ request('sort') == 'latest'     ? 'selected' : '' }}>Latest</option>
                            <option value="oldest"     {{ request('sort') == 'oldest'     ? 'selected' : '' }}>Oldest</option>
                            <option value="name_asc"   {{ request('sort') == 'name_asc'   ? 'selected' : '' }}>Name A–Z</option>
                            <option value="name_desc"  {{ request('sort') == 'name_desc'  ? 'selected' : '' }}>Name Z–A</option>
                            <option value="rating"     {{ request('sort') == 'rating'     ? 'selected' : '' }}>Highest Rating</option>
                            <option value="deliveries" {{ request('sort') == 'deliveries' ? 'selected' : '' }}>Most Deliveries</option>
                        </select>
                    </div>
                </div>

                <div class="form-group filter-actions">
                    <label style="visibility:hidden">.</label>
                    <button type="submit" class="btn-apply">
                        <i class="fas fa-filter"></i> Apply
                    </button>
                    <a href="{{ route('admin.delivery-partners.index') }}" class="btn-reset">
                        <i class="fas fa-redo"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- Bulk Actions Bar --}}
    <div class="bulk-bar">
        <div class="bulk-bar__left">
            <div class="bulk-count">
                <span class="bulk-count__badge" id="selectedCount">0</span>
                <span class="bulk-count__label">partners selected</span>
            </div>
            <div class="bulk-divider"></div>
            <div class="bulk-actions-group">
                <button class="btn-bulk btn-bulk--activate"   onclick="bulkAction('activate')">
                    <i class="fas fa-check-circle"></i> Activate
                </button>
                <button class="btn-bulk btn-bulk--deactivate" onclick="bulkAction('deactivate')">
                    <i class="fas fa-pause-circle"></i> Deactivate
                </button>
                <button class="btn-bulk btn-bulk--verify"     onclick="bulkAction('verify')">
                    <i class="fas fa-check-double"></i> Verify
                </button>
                <button class="btn-bulk btn-bulk--delete"     onclick="bulkAction('delete')">
                    <i class="fas fa-trash-alt"></i> Delete
                </button>
            </div>
        </div>
        <div class="bulk-bar__hint">
            <i class="fas fa-hand-pointer"></i>
            Select partners to perform bulk actions
        </div>
    </div>

    {{-- Table Card --}}
    <div class="table-card">
        <div class="table-card__header">
            <div class="table-card__title">
                <i class="fas fa-list-ul"></i> Partners List
            </div>
            <span class="table-total-badge">{{ $partners->total() }} total</span>
        </div>

        <div style="overflow-x:auto;">
            <table class="dp-table">
                <thead>
                    <tr>
                        <th style="width:44px">
                            <input type="checkbox" class="dp-checkbox" id="selectAll">
                        </th>
                        <th>Partner</th>
                        <th class="col-contact">Contact</th>
                        <th class="col-vehicle">Vehicle</th>
                        <th>Status</th>
                        <th class="col-perf" style="text-align:center">Performance</th>
                        <th style="text-align:center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($partners as $partner)
                    <tr class="partner-row" data-id="{{ $partner->id }}">
                        {{-- Checkbox --}}
                        <td>
                            <input type="checkbox" class="dp-checkbox select-item" value="{{ $partner->id }}">
                        </td>

                        {{-- Partner details --}}
                        <td>
                            <div class="partner-info">
                                <div class="partner-avatar">
                                    @if($partner->avatar)
                                        <img src="{{ asset('storage/' . $partner->avatar) }}" alt="{{ $partner->name }}">
                                    @else
                                        <div class="avatar-init">{{ substr($partner->name, 0, 1) }}</div>
                                    @endif
                                    <span class="online-dot {{ $partner->is_online ? 'online-dot--on' : 'online-dot--off' }}"></span>
                                </div>
                                <div>
                                    <div class="partner-name">{{ $partner->name }}</div>
                                    <div class="partner-meta">
                                        <span class="partner-id">#{{ str_pad($partner->id, 5, '0', STR_PAD_LEFT) }}</span>
                                        <span class="partner-date">{{ $partner->created_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </td>

                        {{-- Contact --}}
                        <td class="col-contact">
                            <div class="contact-stack">
                                <div class="contact-item">
                                    <i class="fas fa-envelope"></i>
                                    {{ $partner->email }}
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-phone"></i>
                                    {{ $partner->phone }}
                                </div>
                            </div>
                        </td>

                        {{-- Vehicle --}}
                        <td class="col-vehicle">
                            <div class="vehicle-info">
                                <span class="vehicle-type-badge">
                                    <i class="fas fa-{{ $partner->vehicle_type === 'motorcycle' ? 'motorcycle' : 'car' }}"></i>
                                    {{ ucfirst($partner->vehicle_type) }}
                                </span>
                                <span class="vehicle-plate">{{ $partner->vehicle_number }}</span>
                            </div>
                        </td>

                        {{-- Status --}}
                        <td>
                            <div class="status-stack">
                                <span class="status-pill
                                    @if($partner->status === 'active')    sp-active
                                    @elseif($partner->status === 'inactive') sp-inactive
                                    @else sp-suspended @endif">
                                    <i class="fas fa-{{ $partner->status === 'active' ? 'check-circle' : ($partner->status === 'inactive' ? 'pause-circle' : 'ban') }}" style="font-size:.7rem"></i>
                                    {{ ucfirst($partner->status) }}
                                </span>
                                <span class="status-pill
                                    @if($partner->verification_status === 'verified') sp-verified
                                    @elseif($partner->verification_status === 'pending') sp-pending
                                    @else sp-rejected @endif">
                                    <i class="fas fa-{{ $partner->verification_status === 'verified' ? 'shield-alt' : ($partner->verification_status === 'pending' ? 'clock' : 'times-circle') }}" style="font-size:.7rem"></i>
                                    {{ ucfirst($partner->verification_status) }}
                                </span>
                            </div>
                        </td>

                        {{-- Performance --}}
                        <td class="col-perf perf-cell">
                            <div class="perf-numbers">
                                <div class="perf-item">
                                    <span class="perf-value">{{ $partner->total_deliveries }}</span>
                                    <span class="perf-label">Deliveries</span>
                                </div>
                                <div class="perf-divider"></div>
                                <div class="perf-item">
                                    <span class="perf-value earnings">${{ number_format($partner->total_earnings, 2) }}</span>
                                    <span class="perf-label">Earnings</span>
                                </div>
                            </div>
                            <div class="rating-row">
                                <span class="rating-val">{{ number_format($partner->rating, 1) }}</span>
                                <span class="stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i <= round($partner->rating) ? '' : '-o' }}"></i>
                                    @endfor
                                </span>
                                <span class="rating-count">({{ $partner->total_ratings }})</span>
                            </div>
                        </td>

                        {{-- Actions --}}
                        <td>
                            <div class="action-group">
                                <a href="{{ route('admin.delivery-partners.show', $partner) }}"
                                   class="btn-action btn-action--view"
                                   title="View Details"
                                   data-bs-toggle="tooltip">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.delivery-partners.edit', $partner) }}"
                                   class="btn-action btn-action--edit"
                                   title="Edit Partner"
                                   data-bs-toggle="tooltip">
                                    <i class="fas fa-pen"></i>
                                </a>
                                @if($partner->verification_status === 'pending')
                                    <button class="btn-action btn-action--verify"
                                            onclick="verifyPartner({{ $partner->id }})"
                                            title="Verify Partner"
                                            data-bs-toggle="tooltip">
                                        <i class="fas fa-check-double"></i>
                                    </button>
                                @else
                                    <button class="btn-action btn-action--verified" disabled title="Already Verified" data-bs-toggle="tooltip">
                                        <i class="fas fa-check"></i>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <div class="empty-state__icon">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <h5>No Delivery Partners Found</h5>
                                <p>Get started by adding your first delivery partner</p>
                                <a href="{{ route('admin.delivery-partners.create') }}" class="btn-primary-solid">
                                    <i class="fas fa-plus"></i> Add New Partner
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($partners->hasPages())
        <div class="table-footer">
            <span class="table-footer__info">
                Showing {{ $partners->firstItem() }}–{{ $partners->lastItem() }} of {{ $partners->total() }} entries
            </span>
            <div>{{ $partners->withQueryString()->links('pagination::bootstrap-5') }}</div>
        </div>
        @endif
    </div>

</div>

{{-- Hidden forms --}}
<form id="bulk-form" method="POST" action="{{ route('admin.delivery-partners.bulk-action') }}" style="display:none">
    @csrf
    <input type="hidden" name="action" id="bulk-action">
</form>

<form id="verify-form" method="POST" action="" style="display:none">
    @csrf
</form>

{{-- Toast --}}
<div class="dp-toast" id="dpToast">
    <i class="fas fa-info-circle"></i>
    <span id="dpToastMsg"></span>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Tooltips
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
        new bootstrap.Tooltip(el, { trigger: 'hover' });
    });

    // Select all
    document.getElementById('selectAll').addEventListener('change', function () {
        document.querySelectorAll('.select-item').forEach(cb => {
            cb.checked = this.checked;
            toggleRowHighlight(cb.closest('tr'), cb.checked);
        });
        updateCount();
    });

    // Individual checkboxes
    document.querySelectorAll('.select-item').forEach(cb => {
        cb.addEventListener('change', function () {
            toggleRowHighlight(this.closest('tr'), this.checked);
            updateCount();
            syncSelectAll();
        });
    });
});

function toggleRowHighlight(row, on) {
    row.classList.toggle('row-selected', on);
}

function syncSelectAll() {
    const all   = document.querySelectorAll('.select-item');
    const checked = document.querySelectorAll('.select-item:checked');
    document.getElementById('selectAll').checked = all.length > 0 && all.length === checked.length;
    document.getElementById('selectAll').indeterminate = checked.length > 0 && checked.length < all.length;
}

function updateCount() {
    const n = document.querySelectorAll('.select-item:checked').length;
    document.getElementById('selectedCount').textContent = n;
}

function bulkAction(action) {
    const ids = [...document.querySelectorAll('.select-item:checked')].map(cb => cb.value);
    if (!ids.length) { showToast('Please select at least one partner.', 'warning'); return; }
    if (!confirm(`${action.charAt(0).toUpperCase() + action.slice(1)} ${ids.length} selected partner(s)?`)) return;

    const form = document.getElementById('bulk-form');
    document.getElementById('bulk-action').value = action;
    document.querySelectorAll('#bulk-form input[name="ids[]"]').forEach(i => i.remove());
    ids.forEach(id => {
        const inp = document.createElement('input');
        inp.type = 'hidden'; inp.name = 'ids[]'; inp.value = id;
        form.appendChild(inp);
    });
    form.submit();
}

function verifyPartner(id) {
    if (!confirm('Verify this partner?')) return;
    const form = document.getElementById('verify-form');
    form.action = `/admin/delivery-partners/${id}/verify`;
    form.submit();
}

function showToast(msg, type = 'info') {
    const toast = document.getElementById('dpToast');
    document.getElementById('dpToastMsg').textContent = msg;
    toast.className = 'dp-toast' + (type === 'warning' ? ' warning' : '');
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 3200);
}
</script>
@endpush

@endsection