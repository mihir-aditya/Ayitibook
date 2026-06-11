{{-- resources/views/admin/delivery-partners/edit.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Edit Partner — ' . $deliveryPartner->name)

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
    --muted:     #6b7280;
    --radius-sm: 6px;
    --radius:    10px;
    --radius-lg: 16px;
    --shadow-sm: 0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
    --shadow:    0 4px 12px rgba(0,0,0,.07), 0 2px 4px rgba(0,0,0,.04);
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
    color: var(--amber);
    margin-bottom: .3rem;
    display: flex;
    align-items: center;
    gap: .4rem;
}

.page-header__eyebrow::before {
    content: '';
    display: inline-block;
    width: 18px; height: 2px;
    background: var(--amber);
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
    padding: 0; margin: 0;
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

.header-actions { display: flex; gap: .5rem; flex-wrap: wrap; }

.btn-view {
    display: inline-flex; align-items: center; gap: .4rem;
    background: var(--sky-bg); color: var(--sky);
    border: 1px solid rgba(12,127,188,.25);
    font-family: 'DM Sans', sans-serif; font-size: .82rem; font-weight: 500;
    padding: .55rem 1.1rem; border-radius: var(--radius);
    text-decoration: none; transition: background .13s, transform .1s;
}
.btn-view:hover { background: #c5dff3; transform: translateY(-1px); color: var(--sky); }

.btn-back {
    display: inline-flex; align-items: center; gap: .4rem;
    background: var(--white); color: var(--ink-3);
    border: 1px solid var(--border);
    font-family: 'DM Sans', sans-serif; font-size: .82rem; font-weight: 500;
    padding: .55rem 1.1rem; border-radius: var(--radius);
    text-decoration: none; transition: background .13s;
}
.btn-back:hover { background: var(--surface-2); color: var(--ink); }

/* ── TWO-COLUMN LAYOUT ─────────────────── */
.edit-layout {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 1.25rem;
    align-items: start;
}

@media (max-width: 900px) {
    .edit-layout { grid-template-columns: 1fr; }
}

/* ── SIDEBAR CARDS ─────────────────────── */
.side-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}

.side-card + .side-card { margin-top: 1rem; }

.side-card__header {
    padding: .95rem 1.3rem;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; gap: .5rem;
    font-family: 'Syne', sans-serif;
    font-size: .82rem;
    font-weight: 700;
    color: var(--ink);
}

.side-card__header i { font-size: .78rem; }
.sc-hdr-blue   i { color: var(--accent); }
.sc-hdr-green  i { color: var(--green); }
.sc-hdr-sky    i { color: var(--sky); }

.side-card__body { padding: 1.3rem; }

/* Avatar upload */
.avatar-area {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: .9rem;
}

.avatar-ring {
    position: relative;
    cursor: pointer;
}

.avatar-ring img,
.avatar-ring .avatar-init {
    width: 110px; height: 110px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--border);
    display: block;
    transition: opacity .15s;
}

.avatar-ring .avatar-init {
    display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg, #4263eb, #7048e8);
    color: #fff;
    font-family: 'Syne', sans-serif;
    font-size: 2.2rem; font-weight: 800;
}

.avatar-ring:hover img,
.avatar-ring:hover .avatar-init { opacity: .75; }

.avatar-ring__overlay {
    position: absolute;
    inset: 0;
    border-radius: 50%;
    background: rgba(59,91,219,.0);
    display: flex; align-items: center; justify-content: center;
    transition: background .15s;
    pointer-events: none;
}

.avatar-ring:hover .avatar-ring__overlay {
    background: rgba(59,91,219,.15);
}

.avatar-ring__overlay i {
    color: #fff;
    font-size: 1.3rem;
    opacity: 0;
    transition: opacity .15s;
}

.avatar-ring:hover .avatar-ring__overlay i { opacity: 1; }

.avatar-actions {
    display: flex; gap: .45rem;
}

.btn-avatar-upload {
    display: inline-flex; align-items: center; gap: .35rem;
    padding: .4rem .9rem;
    border-radius: var(--radius);
    font-size: .78rem; font-weight: 500;
    cursor: pointer; border: none;
    background: var(--accent); color: #fff;
    transition: background .13s;
}
.btn-avatar-upload:hover { background: var(--accent-2); }

.btn-avatar-remove {
    display: inline-flex; align-items: center; gap: .35rem;
    padding: .4rem .85rem;
    border-radius: var(--radius);
    font-size: .78rem; font-weight: 500;
    cursor: pointer;
    background: var(--red-bg); color: var(--red);
    border: 1px solid rgba(201,42,42,.2);
    transition: background .13s;
}
.btn-avatar-remove:hover { background: #ffc9c9; }

.avatar-hint {
    font-size: .72rem;
    color: var(--muted);
    text-align: center;
}

/* Status card */
.status-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: .65rem 0;
    border-bottom: 1px solid var(--surface);
}
.status-row:last-of-type { border-bottom: none; }

.status-row__label {
    font-size: .76rem;
    color: var(--muted);
    font-weight: 500;
}

.status-pill {
    display: inline-flex; align-items: center; gap: .3rem;
    padding: .22rem .65rem;
    border-radius: 999px;
    font-size: .72rem; font-weight: 600;
}

.sp-active    { background: var(--green-bg); color: var(--green); }
.sp-inactive  { background: var(--amber-bg); color: var(--amber); }
.sp-suspended { background: var(--red-bg);   color: var(--red);   }
.sp-verified  { background: var(--sky-bg);   color: var(--sky);   }
.sp-pending   { background: var(--amber-bg); color: var(--amber); }
.sp-rejected  { background: var(--red-bg);   color: var(--red);   }

.online-row {
    display: flex; align-items: center; gap: .4rem;
    font-size: .76rem; color: var(--muted);
}

.online-dot { width: 8px; height: 8px; border-radius: 50%; }
.online-dot--on  { background: #12b886; }
.online-dot--off { background: #adb5bd; }

.btn-verify-full {
    display: flex; align-items: center; justify-content: center; gap: .5rem;
    width: 100%;
    padding: .55rem 1rem;
    margin-top: .9rem;
    background: var(--green-bg);
    color: var(--green);
    border: 1px solid rgba(8,127,91,.25);
    border-radius: var(--radius);
    font-family: 'DM Sans', sans-serif; font-size: .82rem; font-weight: 500;
    cursor: pointer;
    transition: background .13s, transform .1s;
}
.btn-verify-full:hover { background: #b2f2bb; transform: translateY(-1px); }

/* Stats sidebar */
.stat-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: .6rem 0;
    border-bottom: 1px solid var(--surface);
}
.stat-row:last-child { border-bottom: none; }

.stat-row__label {
    font-size: .75rem;
    color: var(--muted);
    font-weight: 500;
}

.stat-row__value {
    font-family: 'Syne', sans-serif;
    font-size: .85rem;
    font-weight: 700;
    color: var(--ink);
}

.stat-row__value.green { color: var(--green); }

/* ── MAIN FORM CARD ────────────────────── */
.form-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}

.form-card__header {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; gap: .5rem;
    font-family: 'Syne', sans-serif;
    font-size: .88rem; font-weight: 700;
    color: var(--ink);
}

.form-card__header i { color: var(--amber); font-size: .82rem; }

.form-card__body { padding: 1.75rem 1.5rem; }

/* ── SECTION HEADERS ───────────────────── */
.section-head {
    display: flex;
    align-items: center;
    gap: .55rem;
    margin-bottom: 1.25rem;
    padding-bottom: .75rem;
    border-bottom: 1px solid var(--border);
}

.section-head__icon {
    width: 28px; height: 28px;
    border-radius: var(--radius-sm);
    display: flex; align-items: center; justify-content: center;
    font-size: .72rem;
    flex-shrink: 0;
}

.si-blue  { background: #eef1fd; color: var(--accent); }
.si-green { background: var(--green-bg); color: var(--green); }
.si-red   { background: var(--red-bg);   color: var(--red);   }
.si-grey  { background: var(--surface-2); color: var(--muted); }

.section-head__label {
    font-family: 'Syne', sans-serif;
    font-size: .82rem;
    font-weight: 700;
    color: var(--ink-2);
    letter-spacing: .01em;
}

.section-divider { margin: 1.75rem 0; }

/* ── FORM CONTROLS ─────────────────────── */
.form-fields {
    display: grid;
    gap: .9rem;
}

.form-fields.cols-2 { grid-template-columns: 1fr 1fr; }
.form-fields.cols-3 { grid-template-columns: 1fr 1fr 1fr; }
.form-fields.cols-1 { grid-template-columns: 1fr; }

@media (max-width: 640px) {
    .form-fields.cols-2,
    .form-fields.cols-3 { grid-template-columns: 1fr; }
}

.form-group label {
    display: block;
    font-size: .76rem;
    font-weight: 500;
    color: var(--ink-3);
    margin-bottom: .38rem;
    letter-spacing: .01em;
}

.form-group label .req {
    color: var(--red);
    margin-left: .2rem;
}

.form-control,
.form-select,
.form-textarea {
    width: 100%;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: .58rem .9rem;
    font-family: 'DM Sans', sans-serif;
    font-size: .86rem;
    color: var(--ink);
    transition: border-color .15s, background .15s, box-shadow .15s;
    appearance: none;
    -webkit-appearance: none;
    outline: none;
}

.form-textarea {
    resize: vertical;
    min-height: 80px;
}

.form-control:focus,
.form-select:focus,
.form-textarea:focus {
    border-color: var(--accent);
    background: var(--white);
    box-shadow: 0 0 0 3px rgba(59,91,219,.1);
}

.form-control.is-invalid,
.form-select.is-invalid,
.form-textarea.is-invalid {
    border-color: var(--red);
    box-shadow: none;
}

.form-control.is-invalid:focus,
.form-select.is-invalid:focus {
    box-shadow: 0 0 0 3px rgba(201,42,42,.1);
}

.invalid-msg {
    font-size: .73rem;
    color: var(--red);
    margin-top: .3rem;
    display: flex; align-items: center; gap: .3rem;
}

.field-hint {
    font-size: .72rem;
    color: var(--muted);
    margin-top: .3rem;
}

.select-wrap {
    position: relative;
}

.select-wrap::after {
    content: '\f107';
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    position: absolute;
    right: .85rem; top: 50%;
    transform: translateY(-50%);
    color: var(--muted); font-size: .75rem;
    pointer-events: none;
}

/* Password field */
.password-wrap { position: relative; }

.password-wrap .form-control { padding-right: 2.6rem; }

.password-toggle {
    position: absolute;
    right: .85rem; top: 50%;
    transform: translateY(-50%);
    background: none; border: none;
    color: var(--muted); font-size: .8rem;
    cursor: pointer;
    padding: 0;
    transition: color .13s;
}

.password-toggle:hover { color: var(--accent); }

/* ── FORM FOOTER ───────────────────────── */
.form-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: .6rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--border);
    margin-top: 1.75rem;
}

.btn-reset-form {
    display: inline-flex; align-items: center; gap: .4rem;
    padding: .58rem 1.2rem;
    border-radius: var(--radius);
    background: var(--surface-2);
    border: 1px solid var(--border);
    color: var(--ink-3);
    font-family: 'DM Sans', sans-serif; font-size: .84rem; font-weight: 500;
    cursor: pointer;
    transition: background .13s;
}
.btn-reset-form:hover { background: var(--border); color: var(--ink); }

.btn-save {
    display: inline-flex; align-items: center; gap: .45rem;
    padding: .58rem 1.6rem;
    border-radius: var(--radius);
    background: var(--accent);
    border: none;
    color: #fff;
    font-family: 'Syne', sans-serif; font-size: .84rem; font-weight: 600;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(59,91,219,.28);
    transition: background .13s, transform .1s, box-shadow .13s;
}
.btn-save:hover {
    background: var(--accent-2);
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(59,91,219,.35);
}
</style>
@endpush

<div class="container-fluid px-4 py-2">

    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <div class="page-header__eyebrow">
                <i class="fas fa-pen"></i> Editing Partner
            </div>
            <h1 class="page-header__title">{{ $deliveryPartner->name }}</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.delivery-partners.index') }}">Delivery Partners</a></li>
                <li><a href="{{ route('admin.delivery-partners.show', $deliveryPartner) }}">{{ $deliveryPartner->name }}</a></li>
                <li class="active">Edit</li>
            </ol>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.delivery-partners.show', $deliveryPartner) }}" class="btn-view">
                <i class="fas fa-eye"></i> View Partner
            </a>
            <a href="{{ route('admin.delivery-partners.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="edit-layout">

        {{-- ── SIDEBAR ──────────────────────────── --}}
        <div>

            {{-- Avatar Card --}}
            <div class="side-card">
                <div class="side-card__header sc-hdr-blue">
                    <i class="fas fa-camera"></i> Profile Picture
                </div>
                <div class="side-card__body">
                    <form id="avatarForm"
                          action="{{ route('admin.delivery-partners.update', $deliveryPartner) }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="avatar-area">
                            <label class="avatar-ring" for="avatar" title="Click to change photo">
                                <div id="avatarPreview">
                                    @if($deliveryPartner->avatar)
                                        <img src="{{ asset('storage/' . $deliveryPartner->avatar) }}"
                                             alt="{{ $deliveryPartner->name }}" id="avatarImg">
                                    @else
                                        <div class="avatar-init" id="avatarInit">{{ substr($deliveryPartner->name, 0, 1) }}</div>
                                    @endif
                                </div>
                                <div class="avatar-ring__overlay">
                                    <i class="fas fa-camera"></i>
                                </div>
                            </label>

                            <input type="file" id="avatar" name="avatar" class="d-none" accept="image/*">

                            <div class="avatar-actions">
                                <label for="avatar" class="btn-avatar-upload">
                                    <i class="fas fa-upload"></i> Change
                                </label>
                                @if($deliveryPartner->avatar)
                                <button type="button" class="btn-avatar-remove" onclick="removeAvatar()">
                                    <i class="fas fa-trash-alt"></i> Remove
                                </button>
                                @endif
                            </div>

                            <p class="avatar-hint">JPG, PNG or GIF · Max 2 MB</p>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Account Status Card --}}
            <div class="side-card">
                <div class="side-card__header sc-hdr-green">
                    <i class="fas fa-shield-alt"></i> Account Status
                </div>
                <div class="side-card__body">
                    <div class="status-row">
                        <span class="status-row__label">Status</span>
                        <span class="status-pill
                            @if($deliveryPartner->status === 'active')    sp-active
                            @elseif($deliveryPartner->status === 'inactive') sp-inactive
                            @else sp-suspended @endif">
                            <i class="fas fa-{{ $deliveryPartner->status === 'active' ? 'check-circle' : ($deliveryPartner->status === 'inactive' ? 'pause-circle' : 'ban') }}" style="font-size:.62rem"></i>
                            {{ ucfirst($deliveryPartner->status) }}
                        </span>
                    </div>
                    <div class="status-row">
                        <span class="status-row__label">Verification</span>
                        <span class="status-pill
                            @if($deliveryPartner->verification_status === 'verified') sp-verified
                            @elseif($deliveryPartner->verification_status === 'pending') sp-pending
                            @else sp-rejected @endif">
                            <i class="fas fa-{{ $deliveryPartner->verification_status === 'verified' ? 'shield-alt' : ($deliveryPartner->verification_status === 'pending' ? 'clock' : 'times-circle') }}" style="font-size:.62rem"></i>
                            {{ ucfirst($deliveryPartner->verification_status) }}
                        </span>
                    </div>
                    <div class="status-row">
                        <span class="status-row__label">Presence</span>
                        <span class="online-row">
                            <span class="online-dot {{ $deliveryPartner->is_online ? 'online-dot--on' : 'online-dot--off' }}"></span>
                            {{ $deliveryPartner->is_online ? 'Online' : 'Offline' }}
                        </span>
                    </div>

                    @if($deliveryPartner->verification_status === 'pending')
                    <form action="{{ route('admin.delivery-partners.verify', $deliveryPartner) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-verify-full">
                            <i class="fas fa-check-double"></i> Verify Account
                        </button>
                    </form>
                    @endif
                </div>
            </div>

            {{-- Quick Stats Card --}}
            <div class="side-card">
                <div class="side-card__header sc-hdr-sky">
                    <i class="fas fa-chart-bar"></i> Quick Stats
                </div>
                <div class="side-card__body">
                    <div class="stat-row">
                        <span class="stat-row__label">Total Deliveries</span>
                        <span class="stat-row__value">{{ $deliveryPartner->total_deliveries }}</span>
                    </div>
                    <div class="stat-row">
                        <span class="stat-row__label">Total Earnings</span>
                        <span class="stat-row__value green">${{ number_format($deliveryPartner->total_earnings, 2) }}</span>
                    </div>
                    <div class="stat-row">
                        <span class="stat-row__label">Rating</span>
                        <span class="stat-row__value">{{ number_format($deliveryPartner->rating, 1) }} <span style="font-size:.7rem;color:var(--muted);font-family:'DM Sans',sans-serif;font-weight:400">({{ $deliveryPartner->total_ratings }})</span></span>
                    </div>
                    <div class="stat-row">
                        <span class="stat-row__label">Member Since</span>
                        <span class="stat-row__value" style="font-size:.78rem">{{ $deliveryPartner->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

        </div>{{-- /sidebar --}}

        {{-- ── MAIN FORM ────────────────────────── --}}
        <div class="form-card">
            <div class="form-card__header">
                <i class="fas fa-pen"></i> Edit Information
            </div>
            <div class="form-card__body">
                <form action="{{ route('admin.delivery-partners.update', $deliveryPartner) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- ── Personal Information ── --}}
                    <div class="section-head">
                        <span class="section-head__icon si-blue"><i class="fas fa-user"></i></span>
                        <span class="section-head__label">Personal Information</span>
                    </div>

                    <div class="form-fields cols-2">
                        <div class="form-group">
                            <label>Full Name <span class="req">*</span></label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   name="name"
                                   value="{{ old('name', $deliveryPartner->name) }}"
                                   placeholder="Full name"
                                   required>
                            @error('name')
                                <p class="invalid-msg"><i class="fas fa-exclamation-circle" style="font-size:.68rem"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Email Address <span class="req">*</span></label>
                            <input type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email', $deliveryPartner->email) }}"
                                   placeholder="email@example.com"
                                   required>
                            @error('email')
                                <p class="invalid-msg"><i class="fas fa-exclamation-circle" style="font-size:.68rem"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Phone Number <span class="req">*</span></label>
                            <input type="text"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   name="phone"
                                   value="{{ old('phone', $deliveryPartner->phone) }}"
                                   placeholder="+1 000 000 0000"
                                   required>
                            @error('phone')
                                <p class="invalid-msg"><i class="fas fa-exclamation-circle" style="font-size:.68rem"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>New Password</label>
                            <div class="password-wrap">
                                <input type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password"
                                       id="passwordField"
                                       placeholder="Leave blank to keep current">
                                <button type="button" class="password-toggle" onclick="togglePassword()">
                                    <i class="fas fa-eye" id="pwdIcon"></i>
                                </button>
                            </div>
                            <p class="field-hint">Minimum 8 characters</p>
                            @error('password')
                                <p class="invalid-msg"><i class="fas fa-exclamation-circle" style="font-size:.68rem"></i>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="section-divider" style="border-top: 1px solid var(--border);"></div>

                    {{-- ── Vehicle Information ── --}}
                    <div class="section-head">
                        <span class="section-head__icon si-green"><i class="fas fa-motorcycle"></i></span>
                        <span class="section-head__label">Vehicle Information</span>
                    </div>

                    <div class="form-fields cols-3">
                        <div class="form-group">
                            <label>Vehicle Type <span class="req">*</span></label>
                            <div class="select-wrap">
                                <select class="form-select @error('vehicle_type') is-invalid @enderror"
                                        name="vehicle_type" required>
                                    <option value="">Select type</option>
                                    <option value="bike"    {{ old('vehicle_type', $deliveryPartner->vehicle_type) == 'bike'    ? 'selected' : '' }}>Bike</option>
                                    <option value="scooter" {{ old('vehicle_type', $deliveryPartner->vehicle_type) == 'scooter' ? 'selected' : '' }}>Scooter</option>
                                    <option value="car"     {{ old('vehicle_type', $deliveryPartner->vehicle_type) == 'car'     ? 'selected' : '' }}>Car</option>
                                </select>
                            </div>
                            @error('vehicle_type')
                                <p class="invalid-msg"><i class="fas fa-exclamation-circle" style="font-size:.68rem"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Vehicle Number <span class="req">*</span></label>
                            <input type="text"
                                   class="form-control @error('vehicle_number') is-invalid @enderror"
                                   name="vehicle_number"
                                   value="{{ old('vehicle_number', $deliveryPartner->vehicle_number) }}"
                                   placeholder="e.g. MH01AB1234"
                                   required>
                            @error('vehicle_number')
                                <p class="invalid-msg"><i class="fas fa-exclamation-circle" style="font-size:.68rem"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>License Number <span class="req">*</span></label>
                            <input type="text"
                                   class="form-control @error('license_number') is-invalid @enderror"
                                   name="license_number"
                                   value="{{ old('license_number', $deliveryPartner->license_number) }}"
                                   placeholder="License number"
                                   required>
                            @error('license_number')
                                <p class="invalid-msg"><i class="fas fa-exclamation-circle" style="font-size:.68rem"></i>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="section-divider" style="border-top: 1px solid var(--border);"></div>

                    {{-- ── Address Information ── --}}
                    <div class="section-head">
                        <span class="section-head__icon si-red"><i class="fas fa-map-marker-alt"></i></span>
                        <span class="section-head__label">Address Information</span>
                    </div>

                    <div class="form-fields cols-1" style="margin-bottom:.9rem">
                        <div class="form-group">
                            <label>Street Address <span class="req">*</span></label>
                            <textarea class="form-textarea @error('address') is-invalid @enderror"
                                      name="address"
                                      rows="2"
                                      placeholder="Street address"
                                      required>{{ old('address', $deliveryPartner->address) }}</textarea>
                            @error('address')
                                <p class="invalid-msg"><i class="fas fa-exclamation-circle" style="font-size:.68rem"></i>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-fields cols-3">
                        <div class="form-group">
                            <label>City <span class="req">*</span></label>
                            <input type="text"
                                   class="form-control @error('city') is-invalid @enderror"
                                   name="city"
                                   value="{{ old('city', $deliveryPartner->city) }}"
                                   placeholder="City"
                                   required>
                            @error('city')
                                <p class="invalid-msg"><i class="fas fa-exclamation-circle" style="font-size:.68rem"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>State <span class="req">*</span></label>
                            <input type="text"
                                   class="form-control @error('state') is-invalid @enderror"
                                   name="state"
                                   value="{{ old('state', $deliveryPartner->state) }}"
                                   placeholder="State"
                                   required>
                            @error('state')
                                <p class="invalid-msg"><i class="fas fa-exclamation-circle" style="font-size:.68rem"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Pincode <span class="req">*</span></label>
                            <input type="text"
                                   class="form-control @error('pincode') is-invalid @enderror"
                                   name="pincode"
                                   value="{{ old('pincode', $deliveryPartner->pincode) }}"
                                   placeholder="Pincode"
                                   required>
                            @error('pincode')
                                <p class="invalid-msg"><i class="fas fa-exclamation-circle" style="font-size:.68rem"></i>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="section-divider" style="border-top: 1px solid var(--border);"></div>

                    {{-- ── Account Settings ── --}}
                    <div class="section-head">
                        <span class="section-head__icon si-grey"><i class="fas fa-cog"></i></span>
                        <span class="section-head__label">Account Settings</span>
                    </div>

                    <div class="form-fields cols-2">
                        <div class="form-group">
                            <label>Account Status</label>
                            <div class="select-wrap">
                                <select class="form-select @error('status') is-invalid @enderror"
                                        name="status">
                                    <option value="active"    {{ old('status', $deliveryPartner->status) == 'active'    ? 'selected' : '' }}>Active</option>
                                    <option value="inactive"  {{ old('status', $deliveryPartner->status) == 'inactive'  ? 'selected' : '' }}>Inactive</option>
                                    <option value="suspended" {{ old('status', $deliveryPartner->status) == 'suspended' ? 'selected' : '' }}>Suspended</option>
                                </select>
                            </div>
                            @error('status')
                                <p class="invalid-msg"><i class="fas fa-exclamation-circle" style="font-size:.68rem"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Verification Status</label>
                            <div class="select-wrap">
                                <select class="form-select @error('verification_status') is-invalid @enderror"
                                        name="verification_status">
                                    <option value="pending"  {{ old('verification_status', $deliveryPartner->verification_status) == 'pending'  ? 'selected' : '' }}>Pending</option>
                                    <option value="verified" {{ old('verification_status', $deliveryPartner->verification_status) == 'verified' ? 'selected' : '' }}>Verified</option>
                                    <option value="rejected" {{ old('verification_status', $deliveryPartner->verification_status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </div>
                            @error('verification_status')
                                <p class="invalid-msg"><i class="fas fa-exclamation-circle" style="font-size:.68rem"></i>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div class="form-footer">
                        <button type="button" class="btn-reset-form" onclick="window.location.reload()">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                        <button type="submit" class="btn-save">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>

                </form>
            </div>
        </div>{{-- /form-card --}}

    </div>{{-- /edit-layout --}}
</div>

@push('scripts')
<script>
// Avatar live preview + auto-submit
document.getElementById('avatar').addEventListener('change', function () {
    if (!this.files || !this.files[0]) return;
    const reader = new FileReader();
    reader.onload = function (e) {
        const preview = document.getElementById('avatarPreview');
        preview.innerHTML = `<img src="${e.target.result}" alt="Preview" id="avatarImg">`;
    };
    reader.readAsDataURL(this.files[0]);
    document.getElementById('avatarForm').submit();
});

// Password visibility toggle
function togglePassword() {
    const field = document.getElementById('passwordField');
    const icon  = document.getElementById('pwdIcon');
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}

// Remove avatar
function removeAvatar() {
    if (!confirm('Remove profile picture?')) return;
    // Implement avatar removal as needed
}
</script>
@endpush

@endsection