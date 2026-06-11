{{-- resources/views/admin/affiliates/edit.blade.php --}}
@extends('admin.layouts.affiliate')

@section('title', 'Edit Affiliate')

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

.af-header__left { display: flex; align-items: center; gap: 1.1rem; }

.af-header__avatar {
    width: 52px; height: 52px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg, #6741d9, #9775fa);
    color: #fff;
    font-family: 'Syne', sans-serif;
    font-size: 1.3rem;
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

.af-header__sub {
    font-size: .82rem;
    color: var(--text-muted);
    margin: 0;
}

.af-header__actions { display: flex; align-items: center; gap: .5rem; }

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

/* ── LAYOUT ──────────────────────────────────── */
.form-layout {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 1rem;
    align-items: start;
}

@media (max-width: 900px) { .form-layout { grid-template-columns: 1fr; } }

/* ── FORM CARD ───────────────────────────────── */
.form-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
}

.form-card__header {
    padding: 1.1rem 1.5rem;
    border-bottom: 1px solid var(--border);
}

.form-card__title {
    font-family: 'Syne', sans-serif;
    font-size: .92rem;
    font-weight: 700;
    color: var(--ink);
    display: flex;
    align-items: center;
    gap: .55rem;
}

.form-card__title i { color: var(--accent); font-size: .85rem; }

.form-card__body { padding: 1.75rem; }

/* ── SECTIONS ────────────────────────────────── */
.form-section-label {
    font-family: 'Syne', sans-serif;
    font-size: .68rem;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--text-muted);
    padding-bottom: .6rem;
    border-bottom: 1px solid var(--border);
    margin-bottom: 1.25rem;
    display: flex;
    align-items: center;
    gap: .4rem;
}

/* ── FIELD GROUPS ────────────────────────────── */
.field-group { margin-bottom: 1.4rem; }
.field-group:last-of-type { margin-bottom: 0; }

.field-label {
    display: flex;
    align-items: center;
    gap: .4rem;
    font-family: 'Syne', sans-serif;
    font-size: .73rem;
    font-weight: 700;
    letter-spacing: .05em;
    text-transform: uppercase;
    color: var(--ink-3);
    margin-bottom: .5rem;
}

.field-label .required-dot {
    width: 5px; height: 5px;
    border-radius: 50%;
    background: var(--red);
}

/* ── INPUTS ──────────────────────────────────── */
.form-control,
.form-select {
    width: 100%;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: .65rem 1rem;
    font-family: 'DM Sans', sans-serif;
    font-size: .875rem;
    color: var(--ink);
    transition: border-color .15s, box-shadow .15s, background .15s;
    appearance: none;
    -webkit-appearance: none;
}

/* Editable */
.form-control,
.form-select { background: var(--surface); }

.form-control:focus,
.form-select:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(59,91,219,.12);
    background: var(--white);
}

/* Read-only / disabled */
.form-control:disabled,
.form-control[readonly] {
    background: var(--surface-2);
    color: var(--text-muted);
    cursor: not-allowed;
    border-style: dashed;
}

.form-control.is-invalid { border-color: var(--red); }
.form-control.is-invalid:focus { box-shadow: 0 0 0 3px rgba(201,42,42,.12); }
.form-select.is-invalid { border-color: var(--red); }
.form-select.is-invalid:focus { box-shadow: 0 0 0 3px rgba(201,42,42,.12); }

.invalid-feedback {
    font-size: .78rem;
    color: var(--red);
    margin-top: .4rem;
    display: flex;
    align-items: center;
    gap: .3rem;
}

/* Select wrapper */
.select-wrap { position: relative; }
.select-wrap::after {
    content: '\f107';
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    position: absolute;
    right: 1rem; top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    font-size: .75rem;
    pointer-events: none;
}
.form-select { padding-right: 2.5rem; }

/* Input with icon */
.input-with-icon { position: relative; }
.input-with-icon .input-icon {
    position: absolute;
    left: .85rem; top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    font-size: .78rem;
    pointer-events: none;
}
.input-with-icon .form-control { padding-left: 2.3rem; }

/* Readonly lock icon */
.readonly-badge {
    display: inline-flex;
    align-items: center;
    gap: .3rem;
    font-size: .68rem;
    color: var(--text-muted);
    background: var(--surface-2);
    border: 1px solid var(--border);
    border-radius: 999px;
    padding: .15rem .55rem;
    margin-left: .4rem;
    font-weight: 500;
    letter-spacing: 0;
    text-transform: none;
}

/* Code badge inline */
.code-badge {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    background: var(--violet-bg);
    border: 1px solid rgba(103,65,217,.15);
    border-radius: var(--radius-sm);
    padding: .28rem .65rem;
    font-family: 'DM Mono', 'Courier New', monospace;
    font-size: .82rem;
    color: var(--violet);
    font-weight: 600;
    letter-spacing: .03em;
}

/* Status select color hints */
.status-hint {
    display: flex;
    gap: .5rem;
    margin-top: .5rem;
    flex-wrap: wrap;
}

.status-chip {
    display: inline-flex;
    align-items: center;
    gap: .3rem;
    padding: .22rem .6rem;
    border-radius: 999px;
    font-size: .7rem;
    font-weight: 500;
    cursor: default;
}

.sc-active    { background: var(--green-bg); color: var(--green); }
.sc-inactive  { background: var(--amber-bg); color: var(--amber); }
.sc-suspended { background: var(--red-bg);   color: var(--red);   }

/* ── FORM ACTIONS ────────────────────────────── */
.form-actions {
    display: flex;
    align-items: center;
    gap: .75rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--border);
    margin-top: 1.75rem;
}

.btn-submit {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    background: var(--accent);
    color: #fff;
    font-family: 'Syne', sans-serif;
    font-size: .85rem;
    font-weight: 600;
    letter-spacing: .02em;
    padding: .7rem 1.6rem;
    border-radius: var(--radius);
    border: none;
    cursor: pointer;
    text-decoration: none;
    transition: background .15s, transform .12s, box-shadow .15s;
    box-shadow: 0 2px 8px rgba(59,91,219,.3);
}
.btn-submit:hover {
    background: var(--accent-2);
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(59,91,219,.35);
}

.btn-cancel {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    background: transparent;
    color: var(--text-muted);
    font-family: 'DM Sans', sans-serif;
    font-size: .83rem;
    font-weight: 500;
    padding: .68rem 1rem;
    border-radius: var(--radius);
    border: 1px solid var(--border);
    cursor: pointer;
    text-decoration: none;
    transition: background .15s, color .15s;
}
.btn-cancel:hover { background: var(--surface-2); color: var(--ink); }

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

/* Summary rows */
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

.summary-value {
    font-weight: 600;
    color: var(--ink);
    font-size: .82rem;
    text-align: right;
}

.summary-value.earnings {
    font-family: 'Syne', sans-serif;
    font-size: .95rem;
    color: var(--green);
}

/* Warning box */
.warning-box {
    background: var(--amber-bg);
    border: 1px solid rgba(230,119,0,.2);
    border-radius: var(--radius);
    padding: .85rem 1rem;
    display: flex;
    gap: .65rem;
    align-items: flex-start;
}

.warning-box i {
    color: var(--amber);
    font-size: .85rem;
    margin-top: .1rem;
    flex-shrink: 0;
}

.warning-box__text {
    font-size: .78rem;
    color: var(--amber);
    line-height: 1.5;
}

.warning-box__text strong {
    display: block;
    font-family: 'Syne', sans-serif;
    font-size: .72rem;
    font-weight: 700;
    letter-spacing: .03em;
    margin-bottom: .15rem;
}
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
                    <i class="fas fa-pen"></i> Edit Affiliate
                </div>
                <h1 class="af-header__title">{{ $affiliate->user->name }}</h1>
                <p class="af-header__sub">{{ $affiliate->user->email }} &middot; <code style="font-size:.78rem;color:var(--violet)">{{ $affiliate->affiliate_code }}</code></p>
            </div>
        </div>
        <div class="af-header__actions">
            <a href="{{ route('admin.affiliate.show', $affiliate) }}" class="btn-secondary-outline">
                <i class="fas fa-arrow-left"></i> Back to Profile
            </a>
        </div>
    </div>

    <div class="form-layout">

        {{-- Main Form --}}
        <div class="form-card">
            <div class="form-card__header">
                <div class="form-card__title">
                    <i class="fas fa-sliders-h"></i> Affiliate Settings
                </div>
            </div>
            <div class="form-card__body">
                <form action="{{ route('admin.affiliate.update', $affiliate) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Read-only section --}}
                    <div class="form-section-label">
                        <i class="fas fa-lock" style="font-size:.65rem"></i> Account Details
                        <span style="font-weight:400;text-transform:none;letter-spacing:0;font-size:.72rem;margin-left:.2rem">— read only</span>
                    </div>

                    <div class="field-group">
                        <label class="field-label">
                            <i class="fas fa-user" style="color:var(--violet);font-size:.8rem"></i>
                            Affiliate User
                            <span class="readonly-badge"><i class="fas fa-lock"></i> locked</span>
                        </label>
                        <div class="input-with-icon">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text"
                                   class="form-control"
                                   value="{{ $affiliate->user->name }} ({{ $affiliate->user->email }})"
                                   disabled>
                        </div>
                    </div>

                    <div class="field-group" style="margin-bottom:1.75rem">
                        <label class="field-label">
                            <i class="fas fa-tag" style="color:var(--violet);font-size:.8rem"></i>
                            Affiliate Code
                            <span class="readonly-badge"><i class="fas fa-lock"></i> locked</span>
                        </label>
                        <div class="input-with-icon">
                            <i class="fas fa-tag input-icon"></i>
                            <input type="text"
                                   class="form-control"
                                   value="{{ $affiliate->affiliate_code }}"
                                   disabled>
                        </div>
                    </div>

                    {{-- Editable section --}}
                    <div class="form-section-label">
                        <i class="fas fa-pen" style="font-size:.65rem"></i> Editable Fields
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="status">
                            <i class="fas fa-toggle-on" style="color:var(--accent);font-size:.8rem"></i>
                            Account Status
                            <span class="required-dot" title="Required"></span>
                        </label>
                        <div class="select-wrap">
                            <select name="status"
                                    id="status"
                                    class="form-select @error('status') is-invalid @enderror"
                                    required>
                                <option value="active"    {{ $affiliate->status == 'active'    ? 'selected' : '' }}>Active</option>
                                <option value="inactive"  {{ $affiliate->status == 'inactive'  ? 'selected' : '' }}>Inactive</option>
                                <option value="suspended" {{ $affiliate->status == 'suspended' ? 'selected' : '' }}>Suspended</option>
                            </select>
                        </div>
                        @error('status')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                        <div class="status-hint">
                            <span class="status-chip sc-active"><i class="fas fa-check-circle" style="font-size:.65rem"></i> Active — can earn commissions</span>
                            <span class="status-chip sc-inactive"><i class="fas fa-pause-circle" style="font-size:.65rem"></i> Inactive — paused</span>
                            <span class="status-chip sc-suspended"><i class="fas fa-ban" style="font-size:.65rem"></i> Suspended — blocked</span>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                        <a href="{{ route('admin.affiliate.show', $affiliate) }}" class="btn-cancel">
                            Cancel
                        </a>
                    </div>

                </form>
            </div>
        </div>

        {{-- Sidebar --}}
        <div>
            {{-- Quick Summary --}}
            <div class="sidebar-card">
                <div class="sidebar-card__header">
                    <div class="sidebar-card__title">
                        <i class="fas fa-chart-bar"></i> Current Stats
                    </div>
                </div>
                <div class="sidebar-card__body">
                    <div class="summary-row">
                        <span class="summary-label">Total Earnings</span>
                        <span class="summary-value earnings">${{ number_format($affiliate->total_earnings, 2) }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Member Since</span>
                        <span class="summary-value">{{ $affiliate->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Last Updated</span>
                        <span class="summary-value">{{ $affiliate->updated_at->diffForHumans() }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Affiliate Code</span>
                        <span class="code-badge">{{ $affiliate->affiliate_code }}</span>
                    </div>
                </div>
            </div>

            {{-- Warning notice --}}
            <div class="sidebar-card">
                <div class="sidebar-card__header">
                    <div class="sidebar-card__title">
                        <i class="fas fa-exclamation-triangle"></i> Important
                    </div>
                </div>
                <div class="sidebar-card__body">
                    <div class="warning-box">
                        <i class="fas fa-exclamation-triangle"></i>
                        <div class="warning-box__text">
                            <strong>Suspending affects payouts</strong>
                            Suspending an affiliate will prevent them from earning new commissions. Existing unpaid commissions will not be affected.
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
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