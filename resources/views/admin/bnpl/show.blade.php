@extends('admin.layouts.basic')

@section('title', 'BNPL Profile: ' . $user->name)
@section('page-title', 'BNPL Profile: ' . $user->name)

@push('styles')
<style>
/* ── Shared components ── */
.panel {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
    margin-bottom: 20px;
    overflow: hidden;
}

.panel__header {
    padding: 15px 20px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap;
}

.panel__title {
    font-family: 'Syne', sans-serif;
    font-size: .88rem; font-weight: 700;
    color: var(--ink);
    display: flex; align-items: center; gap: 8px;
}

.panel__title i { color: var(--accent); }

.panel__body { padding: 20px; }
.panel__body--flush { padding: 0; overflow-x: auto; }

/* Badge */
.badge {
    display: inline-flex; align-items: center; gap: 4px;
    font-size: .67rem; font-weight: 700;
    letter-spacing: .04em; text-transform: uppercase;
    padding: 3px 9px; border-radius: 999px;
    white-space: nowrap;
}
.badge-active    { background: var(--green-bg);  color: var(--green); }
.badge-completed { background: var(--accent-dim); color: var(--accent); }
.badge-overdue   { background: var(--red-bg);    color: var(--red); }
.badge-pending   { background: var(--amber-bg);  color: var(--amber); }
.badge-paid      { background: var(--green-bg);  color: var(--green); }
.badge-inactive  { background: var(--surface-2); color: var(--muted); }

/* Tier badge */
.tier-badge {
    font-family: 'Syne', sans-serif;
    font-size: .72rem; font-weight: 800;
    padding: 4px 12px; border-radius: 8px; letter-spacing: .04em;
}
.tier-bronze   { background: #fdf0e0; color: #b45309; }
.tier-silver   { background: #f1f5f9; color: #475569; }
.tier-gold     { background: #fefce8; color: #a16207; }
.tier-platinum { background: #ede9fe; color: #6d28d9; }
.tier-none     { background: var(--surface-2); color: var(--muted); }

/* Hero header */
.bnpl-hero {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
    padding: 24px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
}

.bnpl-hero__avatar {
    width: 64px; height: 64px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--accent), #7048e8);
    display: flex; align-items: center; justify-content: center;
    font-family: 'Syne', sans-serif;
    font-size: 1.5rem; font-weight: 800;
    color: #fff; flex-shrink: 0;
}

.bnpl-hero__info { flex: 1; min-width: 200px; }

.bnpl-hero__name {
    font-family: 'Syne', sans-serif;
    font-size: 1.25rem; font-weight: 800;
    color: var(--ink); margin-bottom: 4px;
}

.bnpl-hero__meta {
    font-size: .8rem; color: var(--muted);
    display: flex; align-items: center; gap: 12px; flex-wrap: wrap;
}

.bnpl-hero__meta span { display: flex; align-items: center; gap: 5px; }

.bnpl-hero__actions { display: flex; gap: 8px; flex-wrap: wrap; }

/* Credit score ring */
.score-ring-wrap {
    display: flex; align-items: center; gap: 20px;
    flex-wrap: wrap;
}

.score-ring {
    position: relative;
    width: 100px; height: 100px;
    flex-shrink: 0;
}

.score-ring svg {
    width: 100%; height: 100%;
    transform: rotate(-90deg);
}

.score-ring__track { fill: none; stroke: var(--surface-2); stroke-width: 8; }
.score-ring__fill  { fill: none; stroke-width: 8; stroke-linecap: round; transition: stroke-dashoffset .8s ease; }

.score-ring__label {
    position: absolute;
    inset: 0;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    text-align: center;
}

.score-ring__value {
    font-family: 'Syne', sans-serif;
    font-size: 1.3rem; font-weight: 800;
    color: var(--ink);
    line-height: 1;
}

.score-ring__max { font-size: .65rem; color: var(--muted); }

.score-details { flex: 1; }

.score-detail-row {
    display: flex; align-items: center;
    justify-content: space-between;
    padding: 6px 0;
    border-bottom: 1px solid var(--border);
    font-size: .82rem;
}

.score-detail-row:last-child { border-bottom: none; }
.score-detail-row__label { color: var(--muted); }
.score-detail-row__value { font-weight: 600; color: var(--ink-3); }

/* Limit bar */
.limit-visual {
    margin-top: 12px;
}
.limit-label-row {
    display: flex; justify-content: space-between;
    font-size: .75rem; color: var(--muted);
    margin-bottom: 6px;
}
.limit-track {
    height: 10px;
    background: var(--surface-2);
    border-radius: 999px;
    overflow: hidden;
    position: relative;
}
.limit-fill {
    height: 100%;
    border-radius: 999px;
    background: linear-gradient(90deg, var(--accent), #7048e8);
}

/* Stats mini grid */
.mini-stats {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
    gap: 12px;
    margin-bottom: 20px;
}

.mini-stat {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 14px 16px;
    box-shadow: var(--shadow-sm);
}

.mini-stat__label {
    font-size: .65rem; font-weight: 600;
    letter-spacing: .06em; text-transform: uppercase;
    color: var(--muted); margin-bottom: 4px;
}

.mini-stat__value {
    font-family: 'Syne', sans-serif;
    font-size: 1.2rem; font-weight: 800;
    color: var(--ink); line-height: 1;
}

/* Table */
.data-table { width: 100%; border-collapse: collapse; font-size: .82rem; }
.data-table thead tr { background: var(--surface); border-bottom: 1px solid var(--border); }
.data-table th {
    padding: 10px 16px; text-align: left;
    font-family: 'Syne', sans-serif;
    font-size: .67rem; font-weight: 700;
    letter-spacing: .06em; text-transform: uppercase;
    color: var(--muted); white-space: nowrap;
}
.data-table td {
    padding: 11px 16px;
    border-bottom: 1px solid var(--border);
    color: var(--ink-3); vertical-align: middle;
}
.data-table tbody tr:last-child td { border-bottom: none; }
.data-table tbody tr:hover td { background: var(--surface); }

/* Loan detail expand */
.loan-row { cursor: pointer; }
.loan-row td { transition: background .1s; }

.loan-detail-row { display: none; }
.loan-detail-row.open { display: table-row; }
.loan-detail-row td { background: var(--surface) !important; }

.installments-mini {
    display: flex; gap: 4px; flex-wrap: wrap;
    padding: 12px 16px;
}

.inst-dot {
    width: 24px; height: 24px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: .6rem; font-weight: 700;
    font-family: 'Syne', sans-serif;
    cursor: default;
    transition: transform .1s;
}

.inst-dot:hover { transform: scale(1.2); }
.inst-dot.paid    { background: var(--green-bg); color: var(--green); }
.inst-dot.pending { background: var(--amber-bg); color: var(--amber); }
.inst-dot.overdue { background: var(--red-bg);   color: var(--red); }

/* Milestone */
.milestone-item {
    display: flex; align-items: center; gap: 12px;
    padding: 10px 0;
    border-bottom: 1px solid var(--border);
}

.milestone-item:last-child { border-bottom: none; }

.milestone-icon {
    width: 36px; height: 36px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: .85rem; flex-shrink: 0;
}

.milestone-label {
    flex: 1;
    font-size: .82rem; font-weight: 500;
    color: var(--ink-3);
}

.milestone-progress {
    flex: 1;
    display: flex; align-items: center; gap: 8px;
}

.milestone-track {
    flex: 1; height: 6px;
    background: var(--surface-2);
    border-radius: 999px; overflow: hidden;
}

.milestone-fill {
    height: 100%;
    border-radius: 999px;
    transition: width .5s ease;
}

.milestone-pct {
    font-size: .72rem; font-weight: 700;
    color: var(--muted);
    flex-shrink: 0; width: 36px;
    text-align: right;
}

/* Action buttons */
.btn-action {
    display: inline-flex; align-items: center; gap: 5px;
    height: 30px; padding: 0 12px;
    border-radius: 7px; border: none; cursor: pointer;
    font-family: 'DM Sans', sans-serif;
    font-size: .75rem; font-weight: 500;
    text-decoration: none;
    transition: filter .12s;
}
.btn-action:hover { filter: brightness(.92); }
.btn-primary   { background: var(--accent);    color: #fff; }
.btn-secondary { background: var(--surface-2); color: var(--ink-3); }
.btn-danger    { background: var(--red-bg);    color: var(--red); }
.btn-success   { background: var(--green-bg);  color: var(--green); }
.btn-warning   { background: var(--amber-bg);  color: var(--amber); }

/* Two-col layout */
.two-col { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
@media (max-width: 860px) { .two-col { grid-template-columns: 1fr; } }

/* kv table */
.kv-table { width: 100%; }
.kv-table tr td:first-child { color: var(--muted); font-size: .8rem; width: 45%; padding: 6px 0; }
.kv-table tr td:last-child  { font-weight: 600; font-size: .82rem; color: var(--ink-3); padding: 6px 0; }

/* back link */
.back-link {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: .8rem; font-weight: 500;
    color: var(--muted); text-decoration: none;
    margin-bottom: 16px;
    transition: color .12s;
}
.back-link:hover { color: var(--ink); }

/* Admin override form */
.override-form label {
    display: block;
    font-size: .78rem; font-weight: 600;
    color: var(--muted);
    margin-bottom: 4px;
    margin-top: 12px;
}
.override-form input, .override-form select {
    width: 100%; height: 36px;
    padding: 0 12px;
    border: 1px solid var(--border);
    border-radius: 8px;
    font-family: 'DM Sans', sans-serif;
    font-size: .82rem;
    color: var(--ink);
    background: var(--surface);
    outline: none;
}
.override-form input:focus, .override-form select:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(59,91,219,.1);
    background: var(--white);
}
</style>
@endpush

@section('content')

<a href="{{ route('admin.bnpl.index') }}" class="back-link">
    <i class="fas fa-arrow-left"></i> Back to BNPL Management
</a>

{{-- ── Hero ── --}}
<div class="bnpl-hero">
    <div class="bnpl-hero__avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
    <div class="bnpl-hero__info">
        <div class="bnpl-hero__name">{{ $user->name }}</div>
        <div class="bnpl-hero__meta">
            <span><i class="fas fa-envelope"></i> {{ $user->email }}</span>
            @if($user->phone)
            <span><i class="fas fa-phone"></i> {{ $user->phone }}</span>
            @endif
            <span><i class="fas fa-calendar-alt"></i> Joined {{ $user->created_at->format('M d, Y') }}</span>
        </div>
        <div style="margin-top: 8px; display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
            @php $profile = $user->bnplProfile; @endphp
            @if($profile?->is_eligible && $profile?->is_enabled)
                <span class="badge badge-active"><i class="fas fa-check-circle"></i> BNPL Active</span>
            @elseif($profile?->is_eligible && !$profile?->is_enabled)
                <span class="badge badge-pending">BNPL Disabled</span>
            @else
                <span class="badge badge-inactive">Not Eligible</span>
            @endif

            @php $tierKey = strtolower($profile?->tier ?? 'none'); @endphp
            <span class="tier-badge tier-{{ $tierKey }}">{{ ucfirst($profile?->tier ?? 'No Tier') }}</span>
        </div>
    </div>
    <div class="bnpl-hero__actions">
        <a href="{{ route('admin.users.show', $user) }}" class="btn-action btn-secondary">
            <i class="fas fa-user"></i> User Profile
        </a>
        @if($profile?->is_enabled)
            <form action="{{ route('admin.bnpl.users.disable', $user) }}" method="POST" style="display:inline;">
                @csrf @method('PATCH')
                <button type="submit" class="btn-action btn-danger" onclick="return confirm('Disable BNPL for this user?')">
                    <i class="fas fa-ban"></i> Disable BNPL
                </button>
            </form>
        @else
            <form action="{{ route('admin.bnpl.users.enable', $user) }}" method="POST" style="display:inline;">
                @csrf @method('PATCH')
                <button type="submit" class="btn-action btn-success">
                    <i class="fas fa-check-circle"></i> Enable BNPL
                </button>
            </form>
        @endif
        <form action="{{ route('admin.bnpl.users.recalculate', $user) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn-action btn-secondary">
                <i class="fas fa-sync-alt"></i> Recalculate Score
            </button>
        </form>
    </div>
</div>

{{-- ── Mini Stats ── --}}
<div class="mini-stats">
    <div class="mini-stat">
        <div class="mini-stat__label">Total Loans</div>
        <div class="mini-stat__value">{{ $profile?->total_loans ?? 0 }}</div>
    </div>
    <div class="mini-stat">
        <div class="mini-stat__label">Active</div>
        <div class="mini-stat__value" style="color:var(--green);">{{ $profile?->active_loans ?? 0 }}</div>
    </div>
    <div class="mini-stat">
        <div class="mini-stat__label">Completed</div>
        <div class="mini-stat__value" style="color:var(--accent);">{{ $profile?->completed_loans ?? 0 }}</div>
    </div>
    <div class="mini-stat">
        <div class="mini-stat__label">Total Borrowed</div>
        <div class="mini-stat__value">${{ number_format($profile?->total_borrowed ?? 0, 0) }}</div>
    </div>
    <div class="mini-stat">
        <div class="mini-stat__label">Total Repaid</div>
        <div class="mini-stat__value" style="color:var(--green);">${{ number_format($profile?->total_repaid ?? 0, 0) }}</div>
    </div>
    <div class="mini-stat">
        <div class="mini-stat__label">Outstanding</div>
        <div class="mini-stat__value" style="color:{{ ($profile?->outstanding_amount ?? 0) > 0 ? 'var(--red)' : 'var(--ink)' }};">
            ${{ number_format($profile?->outstanding_amount ?? 0, 0) }}
        </div>
    </div>
    <div class="mini-stat">
        <div class="mini-stat__label">On-time Pays</div>
        <div class="mini-stat__value" style="color:var(--green);">{{ $profile?->on_time_payments ?? 0 }}</div>
    </div>
    <div class="mini-stat">
        <div class="mini-stat__label">Late Pays</div>
        <div class="mini-stat__value" style="color:var(--amber);">{{ $profile?->late_payments ?? 0 }}</div>
    </div>
    <div class="mini-stat">
        <div class="mini-stat__label">Missed Pays</div>
        <div class="mini-stat__value" style="color:var(--red);">{{ $profile?->missed_payments ?? 0 }}</div>
    </div>
</div>

{{-- ── Credit Score + Limit ── --}}
<div class="two-col">

    {{-- Credit Score --}}
    <div class="panel">
        <div class="panel__header">
            <span class="panel__title"><i class="fas fa-star"></i> Credit Score</span>
            <span style="font-size:.75rem;color:var(--muted);">
                Last updated: {{ $profile?->eligibility_checked_at ? $profile->eligibility_checked_at->diffForHumans() : 'Never' }}
            </span>
        </div>
        <div class="panel__body">
            @php
                $score = $profile?->credit_score ?? 0;
                $circumference = 2 * M_PI * 40;
                $offset = $circumference - ($score / 1000) * $circumference;
                $scoreColor = $score >= 800 ? '#6d28d9' : ($score >= 600 ? '#087f5b' : ($score >= 400 ? '#e67700' : '#c92a2a'));
            @endphp
            <div class="score-ring-wrap">
                <div class="score-ring">
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <circle class="score-ring__track" cx="50" cy="50" r="40"/>
                        <circle class="score-ring__fill"
                            cx="50" cy="50" r="40"
                            stroke="{{ $scoreColor }}"
                            stroke-dasharray="{{ $circumference }}"
                            stroke-dashoffset="{{ $offset }}"
                            id="scoreCircle"
                        />
                    </svg>
                    <div class="score-ring__label">
                        <div class="score-ring__value" style="color:{{ $scoreColor }}">{{ $score }}</div>
                        <div class="score-ring__max">/ 1000</div>
                    </div>
                </div>

                <div class="score-details">
                    <div class="score-detail-row">
                        <span class="score-detail-row__label">Tier</span>
                        <span class="tier-badge tier-{{ $tierKey }}">{{ ucfirst($profile?->tier ?? 'None') }}</span>
                    </div>
                    <div class="score-detail-row">
                        <span class="score-detail-row__label">Score Range</span>
                        @php $activeTier = $tiers->firstWhere('tier_name', $profile?->tier); @endphp
                        <span class="score-detail-row__value">
                            {{ $activeTier?->min_score ?? '—' }} – {{ $activeTier?->max_score ?? '—' }}
                        </span>
                    </div>
                    @if($latestCreditScore)
                    @foreach(($latestCreditScore->factors ?? []) as $key => $val)
                    <div class="score-detail-row">
                        <span class="score-detail-row__label">{{ ucwords(str_replace('_', ' ', $key)) }}</span>
                        <span class="score-detail-row__value">{{ is_numeric($val) ? number_format($val, 0) : $val }}</span>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Credit Limit ── --}}
    <div class="panel">
        <div class="panel__header">
            <span class="panel__title"><i class="fas fa-wallet"></i> Credit Limit</span>
        </div>
        <div class="panel__body">
            <div style="display: flex; gap: 20px; margin-bottom: 16px; flex-wrap: wrap;">
                <div>
                    <div style="font-size:.68rem;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:var(--muted);">Total Limit</div>
                    <div style="font-family:'Syne',sans-serif;font-size:1.6rem;font-weight:800;color:var(--ink);">${{ number_format($profile?->current_limit ?? 0, 0) }}</div>
                </div>
                <div>
                    <div style="font-size:.68rem;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:var(--muted);">Available</div>
                    <div style="font-family:'Syne',sans-serif;font-size:1.6rem;font-weight:800;color:var(--green);">${{ number_format($profile?->available_limit ?? 0, 0) }}</div>
                </div>
                <div>
                    <div style="font-size:.68rem;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:var(--muted);">Used</div>
                    <div style="font-family:'Syne',sans-serif;font-size:1.6rem;font-weight:800;color:var(--red);">${{ number_format($profile?->used_limit ?? 0, 0) }}</div>
                </div>
            </div>

            @php
                $currentLimit = $profile?->current_limit ?: 1;
                $usedPct = min(100, (($profile?->used_limit ?? 0) / $currentLimit) * 100);
            @endphp

            <div class="limit-visual">
                <div class="limit-label-row">
                    <span>Used: ${{ number_format($profile?->used_limit ?? 0, 0) }}</span>
                    <span>{{ number_format($usedPct, 0) }}% utilized</span>
                </div>
                <div class="limit-track">
                    <div class="limit-fill" style="width:{{ $usedPct }}%; background: {{ $usedPct >= 90 ? 'linear-gradient(90deg,var(--red),#e53e3e)' : ($usedPct >= 70 ? 'linear-gradient(90deg,var(--amber),#d97706)' : 'linear-gradient(90deg,var(--accent),#7048e8)') }};"></div>
                </div>
            </div>

            {{-- Admin override --}}
            <div style="margin-top: 18px; border-top: 1px solid var(--border); padding-top: 14px;">
                <div style="font-size:.75rem;font-weight:600;color:var(--muted);margin-bottom:10px;text-transform:uppercase;letter-spacing:.06em;">
                    <i class="fas fa-sliders-h"></i> Admin Override
                </div>
                <form action="{{ route('admin.bnpl.users.update-limit', $user) }}" method="POST" class="override-form" style="display:flex;gap:10px;align-items:flex-end;">
                    @csrf @method('PATCH')
                    <div style="flex:1;">
                        <label>New Limit ($)</label>
                        <input type="number" name="new_limit" placeholder="{{ $profile?->current_limit ?? 0 }}" min="0" step="100">
                    </div>
                    <button type="submit" class="btn-action btn-primary" style="height:36px;margin-bottom:0;">
                        <i class="fas fa-save"></i> Update
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>

{{-- ── Active Loans ── --}}
<div class="panel">
    <div class="panel__header">
        <span class="panel__title"><i class="fas fa-file-invoice-dollar"></i> Loans</span>
        <span style="font-size:.78rem;color:var(--muted);">{{ $user->bnplLoans->count() }} total</span>
    </div>
    <div class="panel__body--flush">
        <table class="data-table" id="loansTable">
            <thead>
                <tr>
                    <th></th>
                    <th>Loan #</th>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Progress</th>
                    <th>Next Payment</th>
                    <th>Status</th>
                    <th>Late Fees</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($user->bnplLoans()->with('payments')->latest()->get() as $loan)
                {{-- Main loan row --}}
                <tr class="loan-row" onclick="toggleLoan({{ $loan->id }})">
                    <td style="width:32px;color:var(--muted);font-size:.75rem;">
                        <i class="fas fa-chevron-right" id="chevron-{{ $loan->id }}" style="transition:transform .2s;"></i>
                    </td>
                    <td style="font-family:'Syne',sans-serif;font-weight:700;color:var(--ink);">
                        {{ $loan->loan_number ?? '#'.$loan->id }}
                    </td>
                    <td style="max-width:150px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{{ $loan->product_title ?? '' }}">
                        {{ Str::limit($loan->product_title ?? 'N/A', 30) }}
                    </td>
                    <td style="font-weight:600;">${{ number_format($loan->loan_amount, 2) }}</td>
                    <td style="min-width:140px;">
                        <div style="display:flex;align-items:center;gap:8px;">
                            <div style="flex:1;height:6px;background:var(--surface-2);border-radius:999px;overflow:hidden;">
                                <div style="height:100%;background:linear-gradient(90deg,var(--accent),#7048e8);width:{{ $loan->total_installments > 0 ? ($loan->paid_installments/$loan->total_installments)*100 : 0 }}%;border-radius:999px;"></div>
                            </div>
                            <span style="font-size:.72rem;font-weight:600;color:var(--muted);white-space:nowrap;">
                                {{ $loan->paid_installments }}/{{ $loan->total_installments }}
                            </span>
                        </div>
                    </td>
                    <td>
                        @if($loan->next_payment_due)
                            @php $dueDate = \Carbon\Carbon::parse($loan->next_payment_due); @endphp
                            <span style="color: {{ $dueDate->isPast() ? 'var(--red)' : ($dueDate->diffInDays(now()) <= 3 ? 'var(--amber)' : 'var(--ink-3)') }}; font-weight:500;">
                                {{ $dueDate->format('M d, Y') }}
                            </span>
                        @else
                            <span style="color:var(--muted);">—</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge badge-{{ $loan->status }}">{{ ucfirst($loan->status) }}</span>
                    </td>
                    <td>
                        @if(($loan->late_fees ?? 0) > 0)
                            <span style="color:var(--red);font-weight:600;">${{ number_format($loan->late_fees, 2) }}</span>
                        @else
                            <span style="color:var(--muted);">—</span>
                        @endif
                    </td>
                    <td style="color:var(--muted);font-size:.78rem;">
                        {{ \Carbon\Carbon::parse($loan->loan_date ?? $loan->created_at)->format('M d, Y') }}
                    </td>
                </tr>

                {{-- Expandable installment row --}}
                <tr class="loan-detail-row" id="loan-detail-{{ $loan->id }}">
                    <td colspan="9" style="padding:0;">
                        <div style="padding: 12px 16px;">
                            <div style="font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:var(--muted);margin-bottom:8px;">
                                Installments
                            </div>
                            <div class="installments-mini">
                                @foreach($loan->payments->sortBy('installment_number') as $p)
                                <div class="inst-dot inst-{{ $p->status }}" title="Installment #{{ $p->installment_number }} — ${{ number_format($p->amount_due, 2) }} — {{ ucfirst($p->status) }}{{ $p->paid_at ? ' — Paid ' . \Carbon\Carbon::parse($p->paid_at)->format('M d') : ' — Due ' . \Carbon\Carbon::parse($p->due_date)->format('M d') }}">
                                    {{ $p->installment_number }}
                                </div>
                                @endforeach
                            </div>

                            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:10px;margin-top:10px;">
                                <div style="font-size:.8rem;">
                                    <span style="color:var(--muted);">Installment Amt:</span>
                                    <strong>${{ number_format($loan->installment_amount, 2) }}</strong>
                                </div>
                                <div style="font-size:.8rem;">
                                    <span style="color:var(--muted);">Remaining:</span>
                                    <strong style="color:var(--red);">${{ number_format($loan->remaining_amount, 2) }}</strong>
                                </div>
                                <div style="font-size:.8rem;">
                                    <span style="color:var(--muted);">Paid:</span>
                                    <strong style="color:var(--green);">${{ number_format($loan->paid_amount, 2) }}</strong>
                                </div>
                                @if($loan->interest_rate > 0)
                                <div style="font-size:.8rem;">
                                    <span style="color:var(--muted);">Interest Rate:</span>
                                    <strong>{{ $loan->interest_rate }}%</strong>
                                </div>
                                @endif
                                @if($loan->notes)
                                <div style="font-size:.8rem;grid-column:1/-1;">
                                    <span style="color:var(--muted);">Notes:</span> {{ $loan->notes }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="9" style="text-align:center;padding:40px;color:var(--muted);">
                        <i class="fas fa-file-invoice-dollar" style="font-size:1.5rem;opacity:.3;display:block;margin-bottom:8px;"></i>
                        No loans found for this user.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ── Payment History ── --}}
<div class="panel">
    <div class="panel__header">
        <span class="panel__title"><i class="fas fa-receipt"></i> Payment History</span>
        <div style="display:flex;gap:8px;align-items:center;">
            <span style="font-size:.75rem;color:var(--muted);">{{ $user->bnplPayments->count() }} payments</span>
        </div>
    </div>
    <div class="panel__body--flush">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Ref</th>
                    <th>Loan</th>
                    <th>Installment</th>
                    <th>Amount Due</th>
                    <th>Amount Paid</th>
                    <th>Late Fees</th>
                    <th>Method</th>
                    <th>Due Date</th>
                    <th>Paid At</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($user->bnplPayments()->with('loan')->latest('due_date')->take(20)->get() as $payment)
                <tr style="{{ $payment->isOverdue() ? 'background:#fff8f8;' : '' }}">
                    <td style="font-family:'Syne',sans-serif;font-size:.72rem;font-weight:700;color:var(--muted);">
                        {{ $payment->payment_reference ?? '—' }}
                    </td>
                    <td style="font-weight:600;">{{ $payment->loan?->loan_number ?? '#'.$payment->loan_id }}</td>
                    <td style="text-align:center;">#{{ $payment->installment_number }}</td>
                    <td style="font-weight:600;">${{ number_format($payment->amount_due, 2) }}</td>
                    <td>
                        @if($payment->amount_paid > 0)
                            <span style="color:var(--green);font-weight:600;">${{ number_format($payment->amount_paid, 2) }}</span>
                        @else
                            <span style="color:var(--muted);">—</span>
                        @endif
                    </td>
                    <td>
                        @if(($payment->late_fees ?? 0) > 0)
                            <span style="color:var(--red);">${{ number_format($payment->late_fees, 2) }}</span>
                        @else —
                        @endif
                    </td>
                    <td>
                        @if($payment->payment_method)
                            <span style="font-size:.75rem;text-transform:capitalize;">{{ str_replace('_', ' ', $payment->payment_method) }}</span>
                        @else —
                        @endif
                    </td>
                    <td style="font-size:.78rem;">
                        @php $due = \Carbon\Carbon::parse($payment->due_date); @endphp
                        <span style="color: {{ $due->isPast() && $payment->status !== 'paid' ? 'var(--red)' : 'var(--ink-3)' }};">
                            {{ $due->format('M d, Y') }}
                        </span>
                    </td>
                    <td style="font-size:.78rem;color:var(--muted);">
                        {{ $payment->paid_at ? \Carbon\Carbon::parse($payment->paid_at)->format('M d, Y') : '—' }}
                    </td>
                    <td>
                        <span class="badge badge-{{ $payment->status }}">{{ ucfirst($payment->status) }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" style="text-align:center;padding:32px;color:var(--muted);">No payments found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ── Milestones + Credit Score History ── --}}
<div class="two-col">

    {{-- Milestones --}}
    <div class="panel">
        <div class="panel__header">
            <span class="panel__title"><i class="fas fa-trophy"></i> Milestones</span>
            <span style="font-size:.75rem;color:var(--muted);">{{ $user->bnplMilestones->where('is_completed', true)->count() }}/{{ $user->bnplMilestones->count() }} completed</span>
        </div>
        <div class="panel__body">
            @forelse($user->bnplMilestones as $milestone)
            <div class="milestone-item">
                <div class="milestone-icon" style="{{ $milestone->is_completed ? 'background:var(--green-bg);color:var(--green);' : 'background:var(--surface-2);color:var(--muted);' }}">
                    <i class="fas {{ $milestone->is_completed ? 'fa-check-circle' : 'fa-circle' }}"></i>
                </div>
                <div style="flex:1;">
                    <div style="font-size:.82rem;font-weight:600;color:{{ $milestone->is_completed ? 'var(--ink)' : 'var(--ink-3)' }};">
                        {{ $milestone->label }}
                    </div>
                    <div style="font-size:.7rem;color:var(--muted);">
                        {{ $milestone->current_value }} / {{ $milestone->required_value }}
                        @if($milestone->is_completed && $milestone->completed_at)
                            · Completed {{ \Carbon\Carbon::parse($milestone->completed_at)->format('M d, Y') }}
                        @endif
                    </div>
                </div>
                <div style="min-width:120px;">
                    <div style="height:6px;background:var(--surface-2);border-radius:999px;overflow:hidden;">
                        <div style="height:100%;width:{{ $milestone->progress_percentage }}%;background:{{ $milestone->is_completed ? 'var(--green)' : 'linear-gradient(90deg,var(--accent),#7048e8)' }};border-radius:999px;"></div>
                    </div>
                    <div style="font-size:.68rem;color:var(--muted);text-align:right;margin-top:2px;">{{ $milestone->progress_percentage }}%</div>
                </div>
            </div>
            @empty
            <div style="text-align:center;padding:24px;color:var(--muted);font-size:.85rem;">
                <i class="fas fa-trophy" style="font-size:1.5rem;opacity:.3;display:block;margin-bottom:8px;"></i>
                No milestones yet.
            </div>
            @endforelse
        </div>
    </div>

    {{-- Credit Score History --}}
    <div class="panel">
        <div class="panel__header">
            <span class="panel__title"><i class="fas fa-chart-line"></i> Credit Score History</span>
        </div>
        <div class="panel__body">
            <div style="height:180px;">
                <canvas id="scoreHistoryChart"></canvas>
            </div>

            @if($user->bnplCreditScores->count() > 0)
            <div style="margin-top: 14px; border-top: 1px solid var(--border); padding-top: 10px;">
                @foreach($user->bnplCreditScores()->latest('calculated_at')->take(4)->get() as $cs)
                <div style="display:flex;justify-content:space-between;align-items:center;padding:5px 0;border-bottom:1px solid var(--border);">
                    <div>
                        <span style="font-family:'Syne',sans-serif;font-size:.85rem;font-weight:700;color:var(--ink);">{{ $cs->score }}</span>
                        <span class="tier-badge tier-{{ strtolower($cs->tier ?? 'none') }}" style="margin-left:6px;font-size:.62rem;">{{ ucfirst($cs->tier ?? '—') }}</span>
                    </div>
                    <span style="font-size:.72rem;color:var(--muted);">{{ \Carbon\Carbon::parse($cs->calculated_at)->format('M d, Y') }}</span>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
function toggleLoan(loanId) {
    const detailRow = document.getElementById('loan-detail-' + loanId);
    const chevron   = document.getElementById('chevron-' + loanId);
    const isOpen    = detailRow.classList.contains('open');

    // Close all
    document.querySelectorAll('.loan-detail-row.open').forEach(r => r.classList.remove('open'));
    document.querySelectorAll('[id^="chevron-"]').forEach(c => c.style.transform = '');

    if (!isOpen) {
        detailRow.classList.add('open');
        chevron.style.transform = 'rotate(90deg)';
    }
}

/* ── Score History Chart ── */
(function () {
    const ctx = document.getElementById('scoreHistoryChart');
    if (!ctx) return;

    const scores = @json(
        $user->bnplCreditScores()
            ->latest('calculated_at')
            ->take(12)
            ->get()
            ->reverse()
            ->values()
            ->map(fn($s) => ['score' => $s->score, 'date' => \Carbon\Carbon::parse($s->calculated_at)->format('M d')])
    );

    if (scores.length === 0) return;

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: scores.map(s => s.date),
            datasets: [{
                label: 'Credit Score',
                data: scores.map(s => s.score),
                borderColor: '#3b5bdb',
                backgroundColor: 'rgba(59,91,219,.08)',
                borderWidth: 2,
                fill: true,
                tension: .4,
                pointRadius: 4,
                pointHoverRadius: 6,
                pointBackgroundColor: '#3b5bdb',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { family: "'DM Sans'", size: 10 } }
                },
                y: {
                    min: 0, max: 1000,
                    grid: { color: 'rgba(0,0,0,.04)' },
                    ticks: { font: { family: "'DM Sans'", size: 10 } }
                }
            }
        }
    });
})();
</script>
@endpush