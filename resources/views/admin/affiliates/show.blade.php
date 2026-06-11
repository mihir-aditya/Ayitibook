{{-- resources/views/admin/affiliates/show.blade.php --}}
@extends('admin.layouts.affiliate')

@section('title', 'Affiliate Details')

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

.af-header__avatar {
    width: 56px; height: 56px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg, #6741d9, #9775fa);
    color: #fff;
    font-family: 'Syne', sans-serif;
    font-size: 1.4rem;
    font-weight: 800;
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

.af-header__email {
    font-size: .82rem;
    color: var(--text-muted);
    display: flex;
    align-items: center;
    gap: .35rem;
}

.af-header__actions {
    display: flex;
    align-items: center;
    gap: .5rem;
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
    transition: background .15s, border-color .15s;
    white-space: nowrap;
}
.btn-secondary-outline:hover { background: var(--surface-2); color: var(--ink); }

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

.sc-blue   .stat-card__accent-bar { background: linear-gradient(90deg, #3b5bdb, #748ffc); }
.sc-blue   .stat-card__icon-wrap  { background: #eef1fd; color: var(--accent); }
.sc-green  .stat-card__accent-bar { background: linear-gradient(90deg, #087f5b, #38d9a9); }
.sc-green  .stat-card__icon-wrap  { background: #e6fcf5; color: var(--green); }
.sc-violet .stat-card__accent-bar { background: linear-gradient(90deg, #6741d9, #9775fa); }
.sc-violet .stat-card__icon-wrap  { background: var(--violet-bg); color: var(--violet); }
.sc-amber  .stat-card__accent-bar { background: linear-gradient(90deg, #e67700, #ffd43b); }
.sc-amber  .stat-card__icon-wrap  { background: #fff9db; color: var(--amber); }

/* ── TWO-COLUMN INFO LAYOUT ──────────────────── */
.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-bottom: 1rem;
}

@media (max-width: 768px) { .info-grid { grid-template-columns: 1fr; } }

/* ── SECTION CARD ────────────────────────────── */
.section-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
    margin-bottom: 1rem;
}

.section-card__header {
    padding: 1rem 1.4rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    background: var(--white);
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

/* Info table inside cards */
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
    padding: .75rem 0 .75rem 0;
    width: 38%;
    vertical-align: top;
}

.info-table td {
    font-size: .855rem;
    color: var(--ink-3);
    padding: .75rem 0;
    vertical-align: top;
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
.sp-converted { background: var(--green-bg);  color: var(--green);  }
.sp-info      { background: var(--sky-bg);    color: var(--sky);    }
.sp-active-lock { background: var(--green-bg); color: var(--green); }
.sp-expired   { background: var(--gray-bg);   color: var(--gray);   }

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
.af-table thead th:last-child  { padding-right: 1.4rem; text-align: center; }

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

/* Action btn */
.btn-action {
    width: 30px; height: 30px;
    border-radius: var(--radius);
    border: 1px solid var(--border);
    background: var(--white);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: .75rem;
    cursor: pointer;
    text-decoration: none;
    transition: background .12s, border-color .12s, transform .1s, color .12s;
    color: var(--text-muted);
}
.btn-action:hover { transform: translateY(-1px); }
.btn-action--view:hover { background: var(--sky-bg); border-color: rgba(12,127,188,.3); color: var(--sky); }

/* Small add btn */
.btn-sm-add {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    background: var(--accent);
    color: #fff;
    font-family: 'DM Sans', sans-serif;
    font-size: .76rem;
    font-weight: 500;
    padding: .35rem .8rem;
    border-radius: var(--radius-sm);
    border: none;
    cursor: pointer;
    text-decoration: none;
    transition: background .15s;
    white-space: nowrap;
}
.btn-sm-add:hover { background: var(--accent-2); color: #fff; }

/* Empty row */
.empty-row td {
    padding: 2.5rem 1.4rem;
    text-align: center;
    color: var(--text-muted);
    font-size: .83rem;
}

/* Metric value */
.metric-num {
    font-family: 'Syne', sans-serif;
    font-weight: 700;
    color: var(--ink);
}

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
            <div class="af-header__avatar">
                {{ strtoupper(substr($affiliate->user->name, 0, 1)) }}
            </div>
            <div>
                <div class="af-header__eyebrow">
                    <i class="fas fa-handshake"></i> Affiliate Profile
                </div>
                <h1 class="af-header__title">{{ $affiliate->user->name }}</h1>
                <div class="af-header__meta">
                    <span class="af-header__email">
                        <i class="fas fa-envelope" style="font-size:.72rem"></i>
                        {{ $affiliate->user->email }}
                    </span>
                    <span class="status-pill {{ $affiliate->status === 'active' ? 'sp-active' : ($affiliate->status === 'inactive' ? 'sp-inactive' : 'sp-suspended') }}">
                        <i class="fas fa-{{ $affiliate->status === 'active' ? 'check-circle' : ($affiliate->status === 'inactive' ? 'pause-circle' : 'ban') }}" style="font-size:.65rem"></i>
                        {{ ucfirst($affiliate->status) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="af-header__actions">
            <a href="{{ route('admin.affiliate.edit', $affiliate) }}" class="btn-primary-solid">
                <i class="fas fa-pen"></i> Edit Affiliate
            </a>
            <a href="{{ route('admin.affiliate.index') }}" class="btn-secondary-outline">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    {{-- Stats --}}
    <div class="stats-grid">
        <div class="stat-card sc-blue">
            <div class="stat-card__accent-bar"></div>
            <div class="stat-card__icon-wrap"><i class="fas fa-mouse-pointer"></i></div>
            <div class="stat-card__label">Total Clicks</div>
            <div class="stat-card__value">{{ number_format($stats['total_clicks']) }}</div>
            <div class="stat-card__footer">
                <span class="stat-card__badge" style="background:#eef1fd;color:var(--accent)">
                    <i class="fas fa-link" style="font-size:.6rem"></i> All links
                </span>
            </div>
        </div>

        <div class="stat-card sc-green">
            <div class="stat-card__accent-bar"></div>
            <div class="stat-card__icon-wrap"><i class="fas fa-link"></i></div>
            <div class="stat-card__label">Total Links</div>
            <div class="stat-card__value">{{ number_format($stats['total_links']) }}</div>
            <div class="stat-card__footer">
                <span class="stat-card__badge" style="background:var(--green-bg);color:var(--green)">
                    <i class="fas fa-check" style="font-size:.6rem"></i> Active
                </span>
            </div>
        </div>

        <div class="stat-card sc-violet">
            <div class="stat-card__accent-bar"></div>
            <div class="stat-card__icon-wrap"><i class="fas fa-receipt"></i></div>
            <div class="stat-card__label">Total Commissions</div>
            <div class="stat-card__value">{{ number_format($stats['total_commissions']) }}</div>
            <div class="stat-card__footer">
                <span class="stat-card__badge" style="background:var(--violet-bg);color:var(--violet)">
                    <i class="fas fa-dollar-sign" style="font-size:.6rem"></i> Earned
                </span>
            </div>
        </div>

        <div class="stat-card sc-amber">
            <div class="stat-card__accent-bar"></div>
            <div class="stat-card__icon-wrap"><i class="fas fa-lock"></i></div>
            <div class="stat-card__label">Locked Customers</div>
            <div class="stat-card__value">{{ number_format($stats['total_locked_customers']) }}</div>
            <div class="stat-card__footer">
                <span class="stat-card__badge" style="background:var(--amber-bg);color:var(--amber)">
                    <i class="fas fa-user-lock" style="font-size:.6rem"></i> Retained
                </span>
            </div>
        </div>
    </div>

    {{-- Info Cards --}}
    <div class="info-grid">
        {{-- Affiliate Information --}}
        <div class="section-card">
            <div class="section-card__header">
                <div class="section-card__title">
                    <i class="fas fa-id-card"></i> Affiliate Information
                </div>
            </div>
            <div class="section-card__body">
                <table class="info-table">
                    <tr>
                        <th>Affiliate Code</th>
                        <td>
                            <span class="code-badge">
                                <i class="fas fa-tag" style="font-size:.65rem;opacity:.6"></i>
                                {{ $affiliate->affiliate_code }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="status-pill {{ $affiliate->status === 'active' ? 'sp-active' : ($affiliate->status === 'inactive' ? 'sp-inactive' : 'sp-suspended') }}">
                                <i class="fas fa-{{ $affiliate->status === 'active' ? 'check-circle' : ($affiliate->status === 'inactive' ? 'pause-circle' : 'ban') }}" style="font-size:.65rem"></i>
                                {{ ucfirst($affiliate->status) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Total Earnings</th>
                        <td>
                            <span style="font-family:'Syne',sans-serif;font-weight:700;color:var(--green);font-size:1rem">
                                ${{ number_format($affiliate->total_earnings, 2) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Joined Date</th>
                        <td style="color:var(--text-muted)">{{ $affiliate->created_at->format('F d, Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Last Updated</th>
                        <td style="color:var(--text-muted)">{{ $affiliate->updated_at->diffForHumans() }}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- User Information --}}
        <div class="section-card">
            <div class="section-card__header">
                <div class="section-card__title">
                    <i class="fas fa-user"></i> User Information
                </div>
            </div>
            <div class="section-card__body">
                <table class="info-table">
                    <tr>
                        <th>Full Name</th>
                        <td style="font-weight:600">{{ $affiliate->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email Address</th>
                        <td>
                            <a href="mailto:{{ $affiliate->user->email }}"
                               style="color:var(--accent);text-decoration:none;font-size:.84rem">
                                {{ $affiliate->user->email }}
                            </a>
                        </td>
                    </tr>
                    @if($affiliate->user->phone)
                    <tr>
                        <th>Phone</th>
                        <td>{{ $affiliate->user->phone }}</td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>

    {{-- Affiliate Links --}}
    <div class="section-card">
        <div class="section-card__header">
            <div class="section-card__title">
                <i class="fas fa-link"></i> Affiliate Links
            </div>
            <a href="{{ route('admin.affiliate.links.create', ['affiliate_id' => $affiliate->id]) }}"
               class="btn-sm-add">
                <i class="fas fa-plus"></i> Add Link
            </a>
        </div>
        <div style="overflow-x:auto">
            <table class="af-table">
                <thead>
                    <tr>
                        <th>Link Code</th>
                        <th>Product</th>
                        <th>Clicks</th>
                        <th>Created</th>
                        <th style="text-align:center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($affiliate->affiliateLinks as $link)
                    <tr>
                        <td>
                            <span class="code-badge">
                                <i class="fas fa-link" style="font-size:.6rem;opacity:.5"></i>
                                {{ $link->link_code }}
                            </span>
                        </td>
                        <td>{{ $link->product->name ?? 'General' }}</td>
                        <td><span class="metric-num">{{ number_format($link->clicks_count) }}</span></td>
                        <td style="color:var(--text-muted)">{{ $link->created_at->format('M d, Y') }}</td>
                        <td style="text-align:center">
                            <a href="{{ route('admin.affiliate.links.show', $link) }}"
                               class="btn-action btn-action--view"
                               title="View Link"
                               data-bs-toggle="tooltip">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr class="empty-row">
                        <td colspan="5">
                            <i class="fas fa-link" style="font-size:1.4rem;opacity:.3;display:block;margin-bottom:.5rem"></i>
                            No links created yet
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Recent Clicks --}}
    <div class="section-card">
        <div class="section-card__header">
            <div class="section-card__title">
                <i class="fas fa-mouse-pointer"></i> Recent Clicks
            </div>
        </div>
        <div style="overflow-x:auto">
            <table class="af-table">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Link</th>
                        <th>Status</th>
                        <th>Clicked At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($affiliate->affiliateClicks as $click)
                    <tr>
                        <td style="font-weight:500">{{ $click->customer->name ?? 'Guest' }}</td>
                        <td>
                            <span class="code-badge">{{ $click->affiliateLink->link_code }}</span>
                        </td>
                        <td>
                            <span class="status-pill {{ $click->status === 'converted' ? 'sp-converted' : 'sp-info' }}">
                                <i class="fas fa-{{ $click->status === 'converted' ? 'check-circle' : 'circle' }}" style="font-size:.65rem"></i>
                                {{ ucfirst($click->status) }}
                            </span>
                        </td>
                        <td style="color:var(--text-muted)">{{ $click->click_timestamp->format('M d, Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr class="empty-row">
                        <td colspan="4">
                            <i class="fas fa-mouse-pointer" style="font-size:1.4rem;opacity:.3;display:block;margin-bottom:.5rem"></i>
                            No clicks recorded yet
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Locked Customers --}}
    <div class="section-card">
        <div class="section-card__header">
            <div class="section-card__title">
                <i class="fas fa-lock"></i> Locked Customers
            </div>
        </div>
        <div style="overflow-x:auto">
            <table class="af-table">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Locked Until</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($affiliate->customerAffiliateLocks as $lock)
                    <tr>
                        <td style="font-weight:500">{{ $lock->customer->name }}</td>
                        <td style="color:var(--text-muted)">{{ $lock->locked_until->format('M d, Y H:i') }}</td>
                        <td>
                            @if($lock->locked_until > now())
                                <span class="status-pill sp-active-lock">
                                    <i class="fas fa-lock" style="font-size:.65rem"></i> Active
                                </span>
                            @else
                                <span class="status-pill sp-expired">
                                    <i class="fas fa-lock-open" style="font-size:.65rem"></i> Expired
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr class="empty-row">
                        <td colspan="3">
                            <i class="fas fa-user-lock" style="font-size:1.4rem;opacity:.3;display:block;margin-bottom:.5rem"></i>
                            No locked customers
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
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
</script>
@endpush

@endsection