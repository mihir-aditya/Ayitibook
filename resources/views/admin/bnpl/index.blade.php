@extends('admin.layouts.basic')

@section('title', 'BNPL Management')
@section('page-title', 'BNPL Management')

@push('styles')
<style>
/* ── BNPL-specific component styles ── */

/* Stat cards */
.bnpl-stats {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 14px;
    margin-bottom: 24px;
}

.bnpl-stat {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 18px 20px;
    display: flex;
    align-items: center;
    gap: 14px;
    box-shadow: var(--shadow-sm);
    transition: box-shadow .15s;
}

.bnpl-stat:hover { box-shadow: var(--shadow); }

.bnpl-stat__icon {
    width: 44px; height: 44px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1rem;
    flex-shrink: 0;
}

.bnpl-stat__label {
    font-size: .68rem; font-weight: 600;
    letter-spacing: .06em; text-transform: uppercase;
    color: var(--muted);
    line-height: 1;
    margin-bottom: 4px;
}

.bnpl-stat__value {
    font-family: 'Syne', sans-serif;
    font-size: 1.45rem; font-weight: 800;
    color: var(--ink);
    line-height: 1;
}

.bnpl-stat__sub {
    font-size: .72rem;
    color: var(--muted);
    margin-top: 3px;
}

/* Panel card */
.panel {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
    margin-bottom: 20px;
    overflow: hidden;
}

.panel__header {
    padding: 16px 20px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap;
}

.panel__title {
    font-family: 'Syne', sans-serif;
    font-size: .9rem; font-weight: 700;
    color: var(--ink);
    display: flex; align-items: center; gap: 8px;
}

.panel__title i {
    color: var(--accent);
    font-size: .85rem;
}

.panel__body {
    padding: 20px;
}

.panel__body--flush { padding: 0; }

/* Filters bar */
.filters-bar {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.filter-input, .filter-select {
    height: 34px;
    padding: 0 12px;
    border: 1px solid var(--border);
    border-radius: 8px;
    font-family: 'DM Sans', sans-serif;
    font-size: .8rem;
    color: var(--ink);
    background: var(--surface);
    outline: none;
    transition: border-color .13s, box-shadow .13s;
}

.filter-input { min-width: 200px; padding-left: 32px; }

.filter-input:focus, .filter-select:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(59,91,219,.1);
    background: var(--white);
}

.filter-wrap {
    position: relative;
}

.filter-wrap i {
    position: absolute;
    left: 10px; top: 50%;
    transform: translateY(-50%);
    font-size: .72rem;
    color: var(--muted);
    pointer-events: none;
}

/* Table */
.data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: .82rem;
}

.data-table thead tr {
    background: var(--surface);
    border-bottom: 1px solid var(--border);
}

.data-table th {
    padding: 11px 16px;
    text-align: left;
    font-family: 'Syne', sans-serif;
    font-size: .68rem; font-weight: 700;
    letter-spacing: .06em; text-transform: uppercase;
    color: var(--muted);
    white-space: nowrap;
}

.data-table td {
    padding: 12px 16px;
    border-bottom: 1px solid var(--border);
    color: var(--ink-3);
    vertical-align: middle;
}

.data-table tbody tr:last-child td { border-bottom: none; }

.data-table tbody tr:hover td { background: var(--surface); }

/* Badges */
.badge {
    display: inline-flex; align-items: center; gap: 4px;
    font-size: .67rem; font-weight: 700;
    letter-spacing: .04em; text-transform: uppercase;
    padding: 3px 9px;
    border-radius: 999px;
    white-space: nowrap;
}

.badge-active    { background: var(--green-bg);  color: var(--green); }
.badge-pending   { background: var(--amber-bg);  color: var(--amber); }
.badge-completed { background: var(--accent-dim); color: var(--accent); }
.badge-overdue   { background: var(--red-bg);    color: var(--red); }
.badge-inactive  { background: var(--surface-2); color: var(--muted); }

/* Tier badges */
.tier-badge {
    font-family: 'Syne', sans-serif;
    font-size: .68rem; font-weight: 800;
    padding: 3px 10px;
    border-radius: 6px;
    letter-spacing: .04em;
}

.tier-bronze   { background: #fdf0e0; color: #b45309; }
.tier-silver   { background: #f1f5f9; color: #475569; }
.tier-gold     { background: #fefce8; color: #a16207; }
.tier-platinum { background: #ede9fe; color: #6d28d9; }
.tier-none     { background: var(--surface-2); color: var(--muted); }

/* Score bar */
.score-bar {
    display: flex; align-items: center; gap: 8px;
}

.score-bar__track {
    flex: 1;
    height: 5px;
    background: var(--surface-2);
    border-radius: 999px;
    overflow: hidden;
    min-width: 60px;
}

.score-bar__fill {
    height: 100%;
    border-radius: 999px;
    background: linear-gradient(90deg, var(--accent), #7048e8);
}

.score-bar__value {
    font-family: 'Syne', sans-serif;
    font-size: .75rem; font-weight: 700;
    color: var(--ink-3);
    flex-shrink: 0;
}

/* Action btn */
.btn-action {
    display: inline-flex; align-items: center; gap: 5px;
    height: 30px; padding: 0 12px;
    border-radius: 7px; border: none; cursor: pointer;
    font-family: 'DM Sans', sans-serif;
    font-size: .75rem; font-weight: 500;
    text-decoration: none;
    transition: filter .12s, box-shadow .12s;
}

.btn-action:hover { filter: brightness(.93); }

.btn-primary   { background: var(--accent); color: #fff; }
.btn-secondary { background: var(--surface-2); color: var(--ink-3); }
.btn-danger    { background: var(--red-bg); color: var(--red); }

/* Summary row */
.summary-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

@media (max-width: 768px) {
    .summary-grid { grid-template-columns: 1fr; }
    .bnpl-stats   { grid-template-columns: 1fr 1fr; }
}

/* Chart container */
.chart-wrap {
    position: relative;
    height: 220px;
}

/* Tier distribution */
.tier-dist {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.tier-row {
    display: flex; align-items: center; gap: 12px;
}

.tier-row__label {
    width: 64px;
    font-family: 'Syne', sans-serif;
    font-size: .72rem; font-weight: 700;
    flex-shrink: 0;
}

.tier-row__bar {
    flex: 1;
    height: 10px;
    background: var(--surface-2);
    border-radius: 999px;
    overflow: hidden;
}

.tier-row__fill {
    height: 100%;
    border-radius: 999px;
    transition: width .5s ease;
}

.tier-row__count {
    font-size: .75rem; font-weight: 600;
    color: var(--muted);
    flex-shrink: 0;
    width: 36px;
    text-align: right;
}

/* Empty state */
.empty-state {
    text-align: center;
    padding: 48px 20px;
}

.empty-state i {
    font-size: 2rem;
    color: var(--muted);
    opacity: .4;
    display: block;
    margin-bottom: 12px;
}

.empty-state p {
    color: var(--muted);
    font-size: .85rem;
}

/* Overdue highlight */
.overdue-row td { background: #fff8f8 !important; }

/* Pagination */
.pagination-wrap {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 20px;
    border-top: 1px solid var(--border);
    flex-wrap: wrap;
    gap: 10px;
}

.pagination-info {
    font-size: .78rem;
    color: var(--muted);
}
</style>
@endpush

@section('content')

{{-- ── Top Stats ── --}}
<div class="bnpl-stats">

    <div class="bnpl-stat">
        <div class="bnpl-stat__icon" style="background:var(--accent-dim);color:var(--accent);">
            <i class="fas fa-users"></i>
        </div>
        <div>
            <div class="bnpl-stat__label">BNPL Users</div>
            <div class="bnpl-stat__value">{{ number_format($stats['total_users'] ?? 0) }}</div>
            <div class="bnpl-stat__sub">{{ $stats['eligible_users'] ?? 0 }} eligible</div>
        </div>
    </div>

    <div class="bnpl-stat">
        <div class="bnpl-stat__icon" style="background:var(--green-bg);color:var(--green);">
            <i class="fas fa-file-invoice-dollar"></i>
        </div>
        <div>
            <div class="bnpl-stat__label">Active Loans</div>
            <div class="bnpl-stat__value">{{ number_format($stats['active_loans'] ?? 0) }}</div>
            <div class="bnpl-stat__sub">${{ number_format($stats['active_loan_value'] ?? 0, 0) }} outstanding</div>
        </div>
    </div>

    <div class="bnpl-stat">
        <div class="bnpl-stat__icon" style="background:var(--amber-bg);color:var(--amber);">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div>
            <div class="bnpl-stat__label">Overdue</div>
            <div class="bnpl-stat__value">{{ number_format($stats['overdue_count'] ?? 0) }}</div>
            <div class="bnpl-stat__sub">${{ number_format($stats['overdue_amount'] ?? 0, 0) }} at risk</div>
        </div>
    </div>

    <div class="bnpl-stat">
        <div class="bnpl-stat__icon" style="background:var(--green-bg);color:var(--green);">
            <i class="fas fa-check-circle"></i>
        </div>
        <div>
            <div class="bnpl-stat__label">Repaid</div>
            <div class="bnpl-stat__value">${{ number_format($stats['total_repaid'] ?? 0, 0) }}</div>
            <div class="bnpl-stat__sub">{{ $stats['completed_loans'] ?? 0 }} loans completed</div>
        </div>
    </div>

    <div class="bnpl-stat">
        <div class="bnpl-stat__icon" style="background:#ede9fe;color:#6d28d9;">
            <i class="fas fa-star"></i>
        </div>
        <div>
            <div class="bnpl-stat__label">Avg Credit Score</div>
            <div class="bnpl-stat__value">{{ number_format($stats['avg_credit_score'] ?? 0) }}</div>
            <div class="bnpl-stat__sub">out of 1000</div>
        </div>
    </div>

    <div class="bnpl-stat">
        <div class="bnpl-stat__icon" style="background:var(--red-bg);color:var(--red);">
            <i class="fas fa-ban"></i>
        </div>
        <div>
            <div class="bnpl-stat__label">Defaults</div>
            <div class="bnpl-stat__value">{{ number_format($stats['default_count'] ?? 0) }}</div>
            <div class="bnpl-stat__sub">{{ number_format($stats['default_rate'] ?? 0, 1) }}% default rate</div>
        </div>
    </div>

</div>

{{-- ── Summary Row ── --}}
<div class="summary-grid">

    {{-- Loan Activity Chart --}}
    <div class="panel">
        <div class="panel__header">
            <span class="panel__title"><i class="fas fa-chart-area"></i> Loan Activity (Last 30 Days)</span>
        </div>
        <div class="panel__body">
            <div class="chart-wrap">
                <canvas id="loanActivityChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Tier Distribution --}}
    <div class="panel">
        <div class="panel__header">
            <span class="panel__title"><i class="fas fa-layer-group"></i> Credit Tier Distribution</span>
        </div>
        <div class="panel__body">
            <div class="tier-dist" style="margin-bottom: 16px;">
                @php
                    $tiers = $tierDistribution ?? [
                        'platinum' => 0, 'gold' => 0, 'silver' => 0, 'bronze' => 0
                    ];
                    $total = array_sum($tiers) ?: 1;
                @endphp

                <div class="tier-row">
                    <span class="tier-row__label" style="color:#6d28d9;">Platinum</span>
                    <div class="tier-row__bar"><div class="tier-row__fill" style="width:{{ ($tiers['platinum']/$total)*100 }}%;background:linear-gradient(90deg,#8b5cf6,#6d28d9);"></div></div>
                    <span class="tier-row__count">{{ $tiers['platinum'] }}</span>
                </div>
                <div class="tier-row">
                    <span class="tier-row__label" style="color:#a16207;">Gold</span>
                    <div class="tier-row__bar"><div class="tier-row__fill" style="width:{{ ($tiers['gold']/$total)*100 }}%;background:linear-gradient(90deg,#fbbf24,#d97706);"></div></div>
                    <span class="tier-row__count">{{ $tiers['gold'] }}</span>
                </div>
                <div class="tier-row">
                    <span class="tier-row__label" style="color:#475569;">Silver</span>
                    <div class="tier-row__bar"><div class="tier-row__fill" style="width:{{ ($tiers['silver']/$total)*100 }}%;background:linear-gradient(90deg,#94a3b8,#64748b);"></div></div>
                    <span class="tier-row__count">{{ $tiers['silver'] }}</span>
                </div>
                <div class="tier-row">
                    <span class="tier-row__label" style="color:#b45309;">Bronze</span>
                    <div class="tier-row__bar"><div class="tier-row__fill" style="width:{{ ($tiers['bronze']/$total)*100 }}%;background:linear-gradient(90deg,#f97316,#b45309);"></div></div>
                    <span class="tier-row__count">{{ $tiers['bronze'] }}</span>
                </div>
            </div>

            {{-- Payment health --}}
            <div style="border-top:1px solid var(--border);padding-top:14px;">
                <div style="font-size:.72rem;font-weight:600;letter-spacing:.05em;text-transform:uppercase;color:var(--muted);margin-bottom:10px;">Payment Health</div>
                <div style="display:flex;gap:14px;flex-wrap:wrap;">
                    <div style="text-align:center;">
                        <div style="font-family:'Syne',sans-serif;font-size:1.3rem;font-weight:800;color:var(--green);">{{ number_format($stats['on_time_rate'] ?? 0, 1) }}%</div>
                        <div style="font-size:.7rem;color:var(--muted);">On-time</div>
                    </div>
                    <div style="text-align:center;">
                        <div style="font-family:'Syne',sans-serif;font-size:1.3rem;font-weight:800;color:var(--amber);">{{ number_format($stats['late_rate'] ?? 0, 1) }}%</div>
                        <div style="font-size:.7rem;color:var(--muted);">Late</div>
                    </div>
                    <div style="text-align:center;">
                        <div style="font-family:'Syne',sans-serif;font-size:1.3rem;font-weight:800;color:var(--red);">{{ number_format($stats['missed_rate'] ?? 0, 1) }}%</div>
                        <div style="font-size:.7rem;color:var(--muted);">Missed</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- ── Overdue Payments Alert ── --}}
@if(($overduePayments ?? collect())->count() > 0)
<div class="panel" style="border-color: rgba(201,42,42,.3); margin-bottom: 20px;">
    <div class="panel__header" style="background:#fff8f8;">
        <span class="panel__title" style="color:var(--red);">
            <i class="fas fa-exclamation-circle" style="color:var(--red);"></i>
            Overdue Payments Requiring Attention
        </span>
        <span class="badge badge-overdue">{{ $overduePayments->count() }} overdue</span>
    </div>
    <div class="panel__body--flush" style="overflow-x:auto;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Loan #</th>
                    <th>Installment</th>
                    <th>Amount Due</th>
                    <th>Due Date</th>
                    <th>Days Late</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($overduePayments->take(5) as $payment)
                <tr class="overdue-row">
                    <td>
                        <div style="font-weight:600;color:var(--ink);">{{ $payment->user->name ?? 'N/A' }}</div>
                        <div style="font-size:.72rem;color:var(--muted);">{{ $payment->user->email ?? '' }}</div>
                    </td>
                    <td style="font-family:'Syne',sans-serif;font-weight:700;">{{ $payment->loan->loan_number ?? '#'.$payment->loan_id }}</td>
                    <td>{{ $payment->installment_number }} / {{ $payment->loan->total_installments ?? '?' }}</td>
                    <td style="font-weight:700;color:var(--red);">${{ number_format($payment->amount_due, 2) }}</td>
                    <td>{{ \Carbon\Carbon::parse($payment->due_date)->format('M d, Y') }}</td>
                    <td>
                        <span class="badge badge-overdue">{{ $payment->days_late ?? \Carbon\Carbon::parse($payment->due_date)->diffInDays(now()) }}d late</span>
                    </td>
                    <td>
                        <a href="{{ route('admin.bnpl.users.show', $payment->user_id) }}" class="btn-action btn-secondary">
                            <i class="fas fa-eye"></i> View
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

{{-- ── Users BNPL Table ── --}}
<div class="panel">
    <div class="panel__header">
        <span class="panel__title"><i class="fas fa-credit-card"></i> BNPL Users</span>
        <div class="filters-bar">
            <div class="filter-wrap">
                <i class="fas fa-search"></i>
                <input type="text" class="filter-input" id="searchInput" placeholder="Search user, email…">
            </div>
            <select class="filter-select" id="tierFilter">
                <option value="">All Tiers</option>
                <option value="platinum">Platinum</option>
                <option value="gold">Gold</option>
                <option value="silver">Silver</option>
                <option value="bronze">Bronze</option>
            </select>
            <select class="filter-select" id="statusFilter">
                <option value="">All Status</option>
                <option value="eligible">Eligible</option>
                <option value="ineligible">Ineligible</option>
            </select>
        </div>
    </div>

    <div style="overflow-x: auto;">
        <table class="data-table" id="bnplTable">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Credit Score</th>
                    <th>Tier</th>
                    <th>Available Limit</th>
                    <th>Active Loans</th>
                    <th>Outstanding</th>
                    <th>On-time %</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bnplProfiles ?? [] as $profile)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,var(--accent),#7048e8);display:flex;align-items:center;justify-content:center;color:#fff;font-family:'Syne',sans-serif;font-size:.75rem;font-weight:700;flex-shrink:0;">
                                {{ strtoupper(substr($profile->user->name ?? 'U', 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-weight:600;color:var(--ink);">{{ $profile->user->name ?? 'Unknown' }}</div>
                                <div style="font-size:.72rem;color:var(--muted);">{{ $profile->user->email ?? '' }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="score-bar">
                            <div class="score-bar__track">
                                <div class="score-bar__fill" style="width:{{ (($profile->credit_score ?? 0)/1000)*100 }}%"></div>
                            </div>
                            <span class="score-bar__value">{{ $profile->credit_score ?? 0 }}</span>
                        </div>
                    </td>
                    <td>
                        @php $tier = strtolower($profile->tier ?? 'none'); @endphp
                        <span class="tier-badge tier-{{ $tier }}">{{ ucfirst($profile->tier ?? 'None') }}</span>
                    </td>
                    <td style="font-weight:600;">${{ number_format($profile->available_limit ?? 0, 0) }}</td>
                    <td>
                        @if(($profile->active_loans ?? 0) > 0)
                            <span class="badge badge-active">{{ $profile->active_loans }} active</span>
                        @else
                            <span style="color:var(--muted);font-size:.8rem;">—</span>
                        @endif
                    </td>
                    <td>
                        @if(($profile->outstanding_amount ?? 0) > 0)
                            <span style="color:var(--red);font-weight:600;">${{ number_format($profile->outstanding_amount, 2) }}</span>
                        @else
                            <span style="color:var(--green);font-weight:600;">$0.00</span>
                        @endif
                    </td>
                    <td>
                        @php
                            $totalPay = ($profile->on_time_payments ?? 0) + ($profile->late_payments ?? 0) + ($profile->missed_payments ?? 0);
                            $onTimeRate = $totalPay > 0 ? round(($profile->on_time_payments / $totalPay) * 100) : 0;
                        @endphp
                        <span style="color: {{ $onTimeRate >= 90 ? 'var(--green)' : ($onTimeRate >= 70 ? 'var(--amber)' : 'var(--red)') }}; font-weight: 600;">
                            {{ $onTimeRate }}%
                        </span>
                    </td>
                    <td>
                        @if($profile->is_eligible && $profile->is_enabled)
                            <span class="badge badge-active">Active</span>
                        @elseif($profile->is_eligible && !$profile->is_enabled)
                            <span class="badge badge-pending">Disabled</span>
                        @else
                            <span class="badge badge-inactive">Ineligible</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.bnpl.users.show', $profile->user_id) }}" class="btn-action btn-primary">
                            <i class="fas fa-eye"></i> View
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9">
                        <div class="empty-state">
                            <i class="fas fa-credit-card"></i>
                            <p>No BNPL profiles found.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(isset($bnplProfiles) && method_exists($bnplProfiles, 'links'))
    <div class="pagination-wrap">
        <span class="pagination-info">
            Showing {{ $bnplProfiles->firstItem() }}–{{ $bnplProfiles->lastItem() }} of {{ $bnplProfiles->total() }} users
        </span>
        {{ $bnplProfiles->links() }}
    </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
(function () {

    /* ── Loan Activity Chart ── */
    const ctx = document.getElementById('loanActivityChart');
    if (ctx) {
        const labels = @json($chartLabels ?? array_map(fn($i) => now()->subDays(29-$i)->format('M d'), range(0,29)));
        const loansData = @json($chartLoans ?? array_fill(0, 30, 0));
        const paymentsData = @json($chartPayments ?? array_fill(0, 30, 0));

        new Chart(ctx, {
            type: 'line',
            data: {
                labels,
                datasets: [
                    {
                        label: 'New Loans',
                        data: loansData,
                        borderColor: '#3b5bdb',
                        backgroundColor: 'rgba(59,91,219,.08)',
                        borderWidth: 2,
                        fill: true,
                        tension: .4,
                        pointRadius: 0,
                        pointHoverRadius: 4,
                    },
                    {
                        label: 'Payments Received',
                        data: paymentsData,
                        borderColor: '#087f5b',
                        backgroundColor: 'rgba(8,127,91,.05)',
                        borderWidth: 2,
                        fill: true,
                        tension: .4,
                        pointRadius: 0,
                        pointHoverRadius: 4,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: { font: { family: "'DM Sans'", size: 11 }, usePointStyle: true, pointStyleWidth: 10 }
                    },
                    tooltip: { mode: 'index', intersect: false }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: "'DM Sans'", size: 10 }, maxTicksLimit: 8 }
                    },
                    y: {
                        grid: { color: 'rgba(0,0,0,.04)' },
                        ticks: { font: { family: "'DM Sans'", size: 10 }, beginAtZero: true }
                    }
                }
            }
        });
    }

    /* ── Table search / filter ── */
    const searchInput  = document.getElementById('searchInput');
    const tierFilter   = document.getElementById('tierFilter');
    const statusFilter = document.getElementById('statusFilter');
    const tbody        = document.querySelector('#bnplTable tbody');

    function filterTable() {
        const search = searchInput.value.toLowerCase();
        const tier   = tierFilter.value.toLowerCase();
        const status = statusFilter.value.toLowerCase();

        Array.from(tbody.querySelectorAll('tr')).forEach(row => {
            const text       = row.textContent.toLowerCase();
            const tierBadge  = (row.querySelector('.tier-badge')?.textContent ?? '').toLowerCase();
            const statusBadge = (row.querySelector('.badge:not(.tier-badge)')?.textContent ?? '').toLowerCase();

            const matchSearch = !search || text.includes(search);
            const matchTier   = !tier   || tierBadge.includes(tier);
            const matchStatus = !status || statusBadge.includes(status);

            row.style.display = matchSearch && matchTier && matchStatus ? '' : 'none';
        });
    }

    if (searchInput)  searchInput.addEventListener('input', filterTable);
    if (tierFilter)   tierFilter.addEventListener('change', filterTable);
    if (statusFilter) statusFilter.addEventListener('change', filterTable);

})();
</script>
@endpush