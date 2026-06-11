{{-- resources/views/admin/delivery-partners/create.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Add New Delivery Partner')

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
    color: var(--green);
    margin-bottom: .3rem;
    display: flex;
    align-items: center;
    gap: .4rem;
}

.page-header__eyebrow::before {
    content: '';
    display: inline-block;
    width: 18px; height: 2px;
    background: var(--green);
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

.btn-back {
    display: inline-flex; align-items: center; gap: .4rem;
    background: var(--white); color: var(--ink-3);
    border: 1px solid var(--border);
    font-family: 'DM Sans', sans-serif; font-size: .82rem; font-weight: 500;
    padding: .55rem 1.1rem; border-radius: var(--radius);
    text-decoration: none; transition: background .13s;
}
.btn-back:hover { background: var(--surface-2); color: var(--ink); }

/* ── STEP NAV ──────────────────────────── */
.steps-nav {
    display: flex;
    align-items: center;
    gap: 0;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    margin-bottom: 1.25rem;
}

.step-item {
    flex: 1;
    display: flex;
    align-items: center;
    gap: .65rem;
    padding: .9rem 1.4rem;
    border-right: 1px solid var(--border);
    cursor: pointer;
    transition: background .13s;
    position: relative;
}

.step-item:last-child { border-right: none; }

.step-item:hover { background: var(--surface); }

.step-item.active  { background: #eef1fd; }
.step-item.done    { background: var(--green-bg); }

.step-num {
    width: 28px; height: 28px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-family: 'Syne', sans-serif;
    font-size: .75rem; font-weight: 800;
    flex-shrink: 0;
    transition: background .13s, color .13s;
}

.step-item.pending .step-num { background: var(--surface-2); color: var(--muted); }
.step-item.active  .step-num { background: var(--accent);     color: #fff; }
.step-item.done    .step-num { background: var(--green);       color: #fff; }

.step-label {
    font-family: 'Syne', sans-serif;
    font-size: .75rem; font-weight: 700;
    color: var(--muted);
    line-height: 1.2;
}

.step-item.active .step-label { color: var(--accent); }
.step-item.done   .step-label { color: var(--green); }

.step-sub {
    font-size: .66rem;
    color: var(--muted);
    font-family: 'DM Sans', sans-serif;
    font-weight: 400;
}

@media (max-width: 640px) {
    .step-sub { display: none; }
    .step-item { padding: .75rem 1rem; }
}

/* ── FORM CARD ─────────────────────────── */
.form-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}

/* Form sections shown/hidden */
.form-step { display: none; }
.form-step.active { display: block; }

/* ── SECTION HEADER ────────────────────── */
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
.si-sky   { background: var(--sky-bg);   color: var(--sky);   }

.section-head__label {
    font-family: 'Syne', sans-serif;
    font-size: .82rem; font-weight: 700;
    color: var(--ink-2);
}

/* ── FORM FIELDS ───────────────────────── */
.form-body { padding: 1.75rem 1.5rem; }

.form-fields { display: grid; gap: .9rem; }
.form-fields.cols-2 { grid-template-columns: 1fr 1fr; }
.form-fields.cols-3 { grid-template-columns: 1fr 1fr 1fr; }
.form-fields.cols-1 { grid-template-columns: 1fr; }

@media (max-width: 640px) {
    .form-fields.cols-2,
    .form-fields.cols-3 { grid-template-columns: 1fr; }
}

.form-group label {
    display: block;
    font-size: .76rem; font-weight: 500;
    color: var(--ink-3);
    margin-bottom: .38rem;
}

.form-group label .req { color: var(--red); margin-left: .15rem; }

.form-control,
.form-select,
.form-textarea {
    width: 100%;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: .58rem .9rem;
    font-family: 'DM Sans', sans-serif;
    font-size: .86rem; color: var(--ink);
    transition: border-color .15s, background .15s, box-shadow .15s;
    appearance: none; -webkit-appearance: none;
    outline: none;
}

.form-textarea { resize: vertical; min-height: 80px; }

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
}

.form-control.is-invalid:focus,
.form-select.is-invalid:focus {
    box-shadow: 0 0 0 3px rgba(201,42,42,.1);
}

.invalid-msg {
    font-size: .73rem; color: var(--red);
    margin-top: .3rem;
    display: flex; align-items: center; gap: .3rem;
}

.field-hint {
    font-size: .72rem; color: var(--muted); margin-top: .3rem;
}

.select-wrap { position: relative; }

.select-wrap::after {
    content: '\f107';
    font-family: 'Font Awesome 5 Free'; font-weight: 900;
    position: absolute; right: .85rem; top: 50%;
    transform: translateY(-50%);
    color: var(--muted); font-size: .75rem;
    pointer-events: none;
}

/* Password field */
.password-wrap { position: relative; }
.password-wrap .form-control { padding-right: 2.6rem; }

.password-toggle {
    position: absolute; right: .85rem; top: 50%;
    transform: translateY(-50%);
    background: none; border: none;
    color: var(--muted); font-size: .8rem;
    cursor: pointer; padding: 0;
    transition: color .13s;
}
.password-toggle:hover { color: var(--accent); }

/* ── AVATAR UPLOAD ZONE ────────────────── */
.avatar-upload-zone {
    border: 2px dashed var(--border);
    border-radius: var(--radius-lg);
    padding: 2rem;
    text-align: center;
    cursor: pointer;
    transition: border-color .15s, background .15s;
    background: var(--surface);
    position: relative;
}

.avatar-upload-zone:hover,
.avatar-upload-zone.dragover {
    border-color: var(--accent);
    background: #eef1fd;
}

.avatar-upload-zone__preview {
    display: none;
    flex-direction: column;
    align-items: center;
    gap: .75rem;
}

.avatar-upload-zone__preview.visible { display: flex; }

.avatar-upload-zone__placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: .6rem;
}

.avatar-upload-zone__placeholder i {
    font-size: 2rem;
    color: var(--border);
}

.avatar-upload-zone__placeholder p {
    font-size: .82rem; color: var(--muted); margin: 0;
}

.avatar-upload-zone__placeholder strong {
    color: var(--accent); font-weight: 500;
}

.avatar-upload-zone__hint {
    font-size: .72rem; color: var(--muted); margin: 0;
}

.avatar-preview-img {
    width: 90px; height: 90px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--white);
    box-shadow: var(--shadow);
}

.avatar-preview-name {
    font-size: .8rem; color: var(--muted);
}

.avatar-preview-change {
    font-size: .75rem; color: var(--accent);
    cursor: pointer; font-weight: 500;
}

.avatar-preview-change:hover { text-decoration: underline; }

/* ── NAV BUTTONS ───────────────────────── */
.form-nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.25rem 1.5rem;
    border-top: 1px solid var(--border);
    background: var(--surface);
}

.btn-prev {
    display: inline-flex; align-items: center; gap: .4rem;
    padding: .58rem 1.2rem;
    border-radius: var(--radius);
    background: var(--white);
    border: 1px solid var(--border);
    color: var(--ink-3);
    font-family: 'DM Sans', sans-serif; font-size: .84rem; font-weight: 500;
    cursor: pointer;
    transition: background .13s;
}
.btn-prev:hover { background: var(--surface-2); }
.btn-prev:disabled { opacity: .4; cursor: not-allowed; }

.btn-next {
    display: inline-flex; align-items: center; gap: .45rem;
    padding: .58rem 1.5rem;
    border-radius: var(--radius);
    background: var(--accent);
    border: none; color: #fff;
    font-family: 'Syne', sans-serif; font-size: .84rem; font-weight: 600;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(59,91,219,.28);
    transition: background .13s, transform .1s, box-shadow .13s;
}
.btn-next:hover {
    background: var(--accent-2);
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(59,91,219,.35);
}

.btn-submit {
    display: inline-flex; align-items: center; gap: .45rem;
    padding: .58rem 1.8rem;
    border-radius: var(--radius);
    background: var(--green);
    border: none; color: #fff;
    font-family: 'Syne', sans-serif; font-size: .84rem; font-weight: 600;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(8,127,91,.28);
    transition: background .13s, transform .1s, box-shadow .13s;
}
.btn-submit:hover {
    background: #066045;
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(8,127,91,.35);
}

.step-indicator {
    font-size: .76rem; color: var(--muted);
    font-family: 'Syne', sans-serif; font-weight: 600;
}

/* ── REVIEW STEP ───────────────────────── */
.review-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.25rem;
}

@media (max-width: 640px) { .review-grid { grid-template-columns: 1fr; } }

.review-section {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.1rem;
}

.review-section__title {
    font-family: 'Syne', sans-serif;
    font-size: .72rem; font-weight: 700;
    letter-spacing: .07em; text-transform: uppercase;
    color: var(--muted);
    margin-bottom: .85rem;
    display: flex; align-items: center; gap: .4rem;
}

.review-section__title i { font-size: .68rem; }

.review-row {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: .75rem;
    padding: .42rem 0;
    border-bottom: 1px solid var(--border);
    font-size: .82rem;
}

.review-row:last-child { border-bottom: none; }

.review-row__label { color: var(--muted); font-weight: 500; min-width: 100px; }
.review-row__value { color: var(--ink-2); font-weight: 500; text-align: right; }

.avatar-review {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: .5rem;
    padding: 1rem 0;
}

.avatar-review img,
.avatar-review .av-init {
    width: 72px; height: 72px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid var(--border);
}

.avatar-review .av-init {
    display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg, #4263eb, #7048e8);
    color: #fff;
    font-family: 'Syne', sans-serif;
    font-size: 1.6rem; font-weight: 800;
}

.avatar-review__name {
    font-family: 'Syne', sans-serif;
    font-size: .88rem; font-weight: 700;
    color: var(--ink);
}

.review-grid.full-width { grid-column: 1 / -1; }
</style>
@endpush

<div class="container-fluid px-4 py-2">

    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <div class="page-header__eyebrow">
                <i class="fas fa-plus-circle"></i> New Partner
            </div>
            <h1 class="page-header__title">Add Delivery Partner</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.delivery-partners.index') }}">Delivery Partners</a></li>
                <li class="active">Add New</li>
            </ol>
        </div>
        <a href="{{ route('admin.delivery-partners.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    {{-- Step Navigation --}}
    <div class="steps-nav" id="stepsNav">
        <div class="step-item active" data-step="1">
            <div class="step-num">1</div>
            <div>
                <div class="step-label">Personal</div>
                <div class="step-sub">Name, email, phone</div>
            </div>
        </div>
        <div class="step-item pending" data-step="2">
            <div class="step-num">2</div>
            <div>
                <div class="step-label">Vehicle</div>
                <div class="step-sub">Type, plate, license</div>
            </div>
        </div>
        <div class="step-item pending" data-step="3">
            <div class="step-num">3</div>
            <div>
                <div class="step-label">Address</div>
                <div class="step-sub">Location details</div>
            </div>
        </div>
        <div class="step-item pending" data-step="4">
            <div class="step-num">4</div>
            <div>
                <div class="step-label">Photo</div>
                <div class="step-sub">Profile picture</div>
            </div>
        </div>
        <div class="step-item pending" data-step="5">
            <div class="step-num">5</div>
            <div>
                <div class="step-label">Review</div>
                <div class="step-sub">Confirm & submit</div>
            </div>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="form-card">
        <form action="{{ route('admin.delivery-partners.store') }}" method="POST" enctype="multipart/form-data" id="createForm" novalidate>
            @csrf

            {{-- ── STEP 1: Personal ──────────────────── --}}
            <div class="form-step active" id="step-1">
                <div class="form-body">
                    <div class="section-head">
                        <span class="section-head__icon si-blue"><i class="fas fa-user"></i></span>
                        <span class="section-head__label">Personal Information</span>
                    </div>

                    <div class="form-fields cols-2">
                        <div class="form-group">
                            <label>Full Name <span class="req">*</span></label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   name="name" id="f_name"
                                   value="{{ old('name') }}"
                                   placeholder="e.g. Raj Kumar"
                                   required>
                            @error('name')
                                <p class="invalid-msg"><i class="fas fa-exclamation-circle" style="font-size:.68rem"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Email Address <span class="req">*</span></label>
                            <input type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email" id="f_email"
                                   value="{{ old('email') }}"
                                   placeholder="partner@example.com"
                                   required>
                            @error('email')
                                <p class="invalid-msg"><i class="fas fa-exclamation-circle" style="font-size:.68rem"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Phone Number <span class="req">*</span></label>
                            <input type="text"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   name="phone" id="f_phone"
                                   value="{{ old('phone') }}"
                                   placeholder="+91 98765 43210"
                                   required>
                            @error('phone')
                                <p class="invalid-msg"><i class="fas fa-exclamation-circle" style="font-size:.68rem"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Password <span class="req">*</span></label>
                            <div class="password-wrap">
                                <input type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password" id="f_password"
                                       placeholder="Min. 8 characters"
                                       required>
                                <button type="button" class="password-toggle" onclick="togglePwd()">
                                    <i class="fas fa-eye" id="pwdIcon"></i>
                                </button>
                            </div>
                            <p class="field-hint">Must be at least 8 characters</p>
                            @error('password')
                                <p class="invalid-msg"><i class="fas fa-exclamation-circle" style="font-size:.68rem"></i>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── STEP 2: Vehicle ───────────────────── --}}
            <div class="form-step" id="step-2">
                <div class="form-body">
                    <div class="section-head">
                        <span class="section-head__icon si-green"><i class="fas fa-motorcycle"></i></span>
                        <span class="section-head__label">Vehicle Information</span>
                    </div>

                    <div class="form-fields cols-3">
                        <div class="form-group">
                            <label>Vehicle Type <span class="req">*</span></label>
                            <div class="select-wrap">
                                <select class="form-select @error('vehicle_type') is-invalid @enderror"
                                        name="vehicle_type" id="f_vehicle_type" required>
                                    <option value="">Select type</option>
                                    <option value="bike"    {{ old('vehicle_type') == 'bike'    ? 'selected' : '' }}>Bike</option>
                                    <option value="scooter" {{ old('vehicle_type') == 'scooter' ? 'selected' : '' }}>Scooter</option>
                                    <option value="car"     {{ old('vehicle_type') == 'car'     ? 'selected' : '' }}>Car</option>
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
                                   name="vehicle_number" id="f_vehicle_number"
                                   value="{{ old('vehicle_number') }}"
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
                                   name="license_number" id="f_license_number"
                                   value="{{ old('license_number') }}"
                                   placeholder="Driving license no."
                                   required>
                            @error('license_number')
                                <p class="invalid-msg"><i class="fas fa-exclamation-circle" style="font-size:.68rem"></i>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── STEP 3: Address ───────────────────── --}}
            <div class="form-step" id="step-3">
                <div class="form-body">
                    <div class="section-head">
                        <span class="section-head__icon si-red"><i class="fas fa-map-marker-alt"></i></span>
                        <span class="section-head__label">Address Information</span>
                    </div>

                    <div class="form-fields cols-1" style="margin-bottom:.9rem">
                        <div class="form-group">
                            <label>Street Address <span class="req">*</span></label>
                            <textarea class="form-textarea @error('address') is-invalid @enderror"
                                      name="address" id="f_address"
                                      rows="2"
                                      placeholder="House/flat number, street name, landmark"
                                      required>{{ old('address') }}</textarea>
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
                                   name="city" id="f_city"
                                   value="{{ old('city') }}"
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
                                   name="state" id="f_state"
                                   value="{{ old('state') }}"
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
                                   name="pincode" id="f_pincode"
                                   value="{{ old('pincode') }}"
                                   placeholder="6-digit pincode"
                                   required>
                            @error('pincode')
                                <p class="invalid-msg"><i class="fas fa-exclamation-circle" style="font-size:.68rem"></i>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── STEP 4: Photo ─────────────────────── --}}
            <div class="form-step" id="step-4">
                <div class="form-body">
                    <div class="section-head">
                        <span class="section-head__icon si-sky"><i class="fas fa-camera"></i></span>
                        <span class="section-head__label">Profile Picture</span>
                    </div>

                    <input type="file" id="avatar" name="avatar" class="d-none" accept="image/*">

                    <div class="avatar-upload-zone" id="avatarZone" onclick="document.getElementById('avatar').click()">
                        <div class="avatar-upload-zone__placeholder" id="avatarPlaceholder">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p><strong>Click to upload</strong> or drag and drop</p>
                            <p class="avatar-upload-zone__hint">JPG, PNG or GIF · Max 2 MB · Optional</p>
                        </div>
                        <div class="avatar-upload-zone__preview" id="avatarPreviewWrap">
                            <img src="" alt="Preview" id="avatarPreviewImg" class="avatar-preview-img">
                            <p class="avatar-preview-name" id="avatarFileName"></p>
                            <span class="avatar-preview-change" onclick="event.stopPropagation(); document.getElementById('avatar').click()">
                                <i class="fas fa-redo" style="font-size:.68rem"></i> Change photo
                            </span>
                        </div>
                    </div>

                    @error('avatar')
                        <p class="invalid-msg" style="margin-top:.5rem"><i class="fas fa-exclamation-circle" style="font-size:.68rem"></i>{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- ── STEP 5: Review ────────────────────── --}}
            <div class="form-step" id="step-5">
                <div class="form-body">
                    <div class="section-head">
                        <span class="section-head__icon si-green"><i class="fas fa-check-double"></i></span>
                        <span class="section-head__label">Review & Confirm</span>
                    </div>

                    {{-- Avatar + name preview at top --}}
                    <div class="avatar-review" id="reviewAvatar">
                        <div class="av-init" id="reviewAvatarInit"></div>
                        <div class="avatar-review__name" id="reviewName">—</div>
                    </div>

                    <div class="review-grid" style="margin-top:1.25rem">
                        <div class="review-section">
                            <div class="review-section__title"><i class="fas fa-user"></i> Personal</div>
                            <div class="review-row"><span class="review-row__label">Name</span><span class="review-row__value" id="rv-name">—</span></div>
                            <div class="review-row"><span class="review-row__label">Email</span><span class="review-row__value" id="rv-email">—</span></div>
                            <div class="review-row"><span class="review-row__label">Phone</span><span class="review-row__value" id="rv-phone">—</span></div>
                            <div class="review-row"><span class="review-row__label">Password</span><span class="review-row__value">••••••••</span></div>
                        </div>

                        <div class="review-section">
                            <div class="review-section__title"><i class="fas fa-motorcycle"></i> Vehicle</div>
                            <div class="review-row"><span class="review-row__label">Type</span><span class="review-row__value" id="rv-vehicle_type">—</span></div>
                            <div class="review-row"><span class="review-row__label">Number</span><span class="review-row__value" id="rv-vehicle_number">—</span></div>
                            <div class="review-row"><span class="review-row__label">License</span><span class="review-row__value" id="rv-license_number">—</span></div>
                        </div>

                        <div class="review-section" style="grid-column:1/-1">
                            <div class="review-section__title"><i class="fas fa-map-marker-alt"></i> Address</div>
                            <div style="display:grid;grid-template-columns:1fr 1fr;gap:0 1.5rem">
                                <div class="review-row"><span class="review-row__label">Street</span><span class="review-row__value" id="rv-address">—</span></div>
                                <div class="review-row"><span class="review-row__label">City</span><span class="review-row__value" id="rv-city">—</span></div>
                                <div class="review-row"><span class="review-row__label">State</span><span class="review-row__value" id="rv-state">—</span></div>
                                <div class="review-row"><span class="review-row__label">Pincode</span><span class="review-row__value" id="rv-pincode">—</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Step Navigation --}}
            <div class="form-nav">
                <button type="button" class="btn-prev" id="btnPrev" onclick="changeStep(-1)" disabled>
                    <i class="fas fa-arrow-left"></i> Previous
                </button>
                <span class="step-indicator" id="stepIndicator">Step 1 of 5</span>
                <div>
                    <button type="button" class="btn-next" id="btnNext" onclick="changeStep(1)">
                        Next <i class="fas fa-arrow-right"></i>
                    </button>
                    <button type="submit" class="btn-submit" id="btnSubmit" style="display:none">
                        <i class="fas fa-user-plus"></i> Create Partner
                    </button>
                </div>
            </div>

        </form>
    </div>

</div>

@push('scripts')
<script>
let currentStep = 1;
const TOTAL_STEPS = 5;

// Required fields per step
const stepFields = {
    1: ['f_name', 'f_email', 'f_phone', 'f_password'],
    2: ['f_vehicle_type', 'f_vehicle_number', 'f_license_number'],
    3: ['f_address', 'f_city', 'f_state', 'f_pincode'],
    4: [],   // avatar is optional
    5: [],
};

function changeStep(dir) {
    if (dir === 1 && !validateStep(currentStep)) return;

    const prev = currentStep;
    currentStep = Math.max(1, Math.min(TOTAL_STEPS, currentStep + dir));

    // Update DOM steps
    document.getElementById(`step-${prev}`).classList.remove('active');
    document.getElementById(`step-${currentStep}`).classList.add('active');

    // Update step nav pills
    document.querySelectorAll('.step-item').forEach(el => {
        const n = parseInt(el.dataset.step);
        el.classList.remove('active', 'done', 'pending');
        if (n < currentStep)  el.classList.add('done');
        else if (n === currentStep) el.classList.add('active');
        else el.classList.add('pending');
    });

    // Update buttons
    document.getElementById('btnPrev').disabled = currentStep === 1;
    const isLast = currentStep === TOTAL_STEPS;
    document.getElementById('btnNext').style.display   = isLast ? 'none' : '';
    document.getElementById('btnSubmit').style.display = isLast ? '' : 'none';
    document.getElementById('stepIndicator').textContent = `Step ${currentStep} of ${TOTAL_STEPS}`;

    // Populate review on last step
    if (currentStep === TOTAL_STEPS) populateReview();
}

function validateStep(step) {
    let ok = true;
    (stepFields[step] || []).forEach(id => {
        const el = document.getElementById(id);
        if (!el) return;
        const val = el.value.trim();
        if (!val) {
            el.classList.add('is-invalid');
            ok = false;
        } else {
            el.classList.remove('is-invalid');
        }
    });
    return ok;
}

// Live-clear invalid state on input
document.querySelectorAll('.form-control, .form-select, .form-textarea').forEach(el => {
    el.addEventListener('input', () => el.classList.remove('is-invalid'));
});

// Avatar drag & drop
const zone = document.getElementById('avatarZone');
const avatarInput = document.getElementById('avatar');

zone.addEventListener('dragover', e => { e.preventDefault(); zone.classList.add('dragover'); });
zone.addEventListener('dragleave', () => zone.classList.remove('dragover'));
zone.addEventListener('drop', e => {
    e.preventDefault();
    zone.classList.remove('dragover');
    const file = e.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) handleAvatarFile(file);
});

avatarInput.addEventListener('change', function () {
    if (this.files && this.files[0]) handleAvatarFile(this.files[0]);
});

function handleAvatarFile(file) {
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('avatarPreviewImg').src = e.target.result;
        document.getElementById('avatarFileName').textContent = file.name;
        document.getElementById('avatarPlaceholder').style.display = 'none';
        document.getElementById('avatarPreviewWrap').classList.add('visible');
    };
    reader.readAsDataURL(file);

    // Transfer file to input
    const dt = new DataTransfer();
    dt.items.add(file);
    avatarInput.files = dt.files;
}

// Password toggle
function togglePwd() {
    const f = document.getElementById('f_password');
    const i = document.getElementById('pwdIcon');
    f.type = f.type === 'password' ? 'text' : 'password';
    i.classList.toggle('fa-eye');
    i.classList.toggle('fa-eye-slash');
}

// Populate review step
function populateReview() {
    const fields = {
        name: 'f_name', email: 'f_email', phone: 'f_phone',
        vehicle_type: 'f_vehicle_type', vehicle_number: 'f_vehicle_number',
        license_number: 'f_license_number',
        address: 'f_address', city: 'f_city', state: 'f_state', pincode: 'f_pincode',
    };

    Object.entries(fields).forEach(([key, id]) => {
        const el   = document.getElementById(id);
        const dest = document.getElementById(`rv-${key}`);
        if (el && dest) dest.textContent = el.value.trim() || '—';
    });

    // Name & avatar in hero
    const name = document.getElementById('f_name').value.trim();
    document.getElementById('reviewName').textContent = name || '—';
    document.getElementById('reviewAvatarInit').textContent = name ? name.charAt(0).toUpperCase() : '?';

    // If an avatar was selected, show image
    const previewSrc = document.getElementById('avatarPreviewImg').src;
    if (previewSrc && previewSrc !== window.location.href) {
        const reviewAvatar = document.getElementById('reviewAvatar');
        reviewAvatar.innerHTML = `
            <img src="${previewSrc}" class="avatar-review-img" alt="Avatar" style="width:72px;height:72px;border-radius:50%;object-fit:cover;border:2px solid var(--border)">
            <div class="avatar-review__name">${name}</div>
        `;
    }
}

// If page reloads with old() values (server validation), show correct step
@if($errors->any())
document.addEventListener('DOMContentLoaded', () => {
    // Determine which step has errors
    const e1 = {{ $errors->has('name') || $errors->has('email') || $errors->has('phone') || $errors->has('password') ? 'true' : 'false' }};
    const e2 = {{ $errors->has('vehicle_type') || $errors->has('vehicle_number') || $errors->has('license_number') ? 'true' : 'false' }};
    const e3 = {{ $errors->has('address') || $errors->has('city') || $errors->has('state') || $errors->has('pincode') ? 'true' : 'false' }};

    if (e1)      { currentStep = 1; }
    else if (e2) { currentStep = 2; }
    else if (e3) { currentStep = 3; }
    else         { currentStep = 4; }

    // Apply correct step state
    document.querySelectorAll('.form-step').forEach(s => s.classList.remove('active'));
    document.getElementById(`step-${currentStep}`).classList.add('active');

    document.querySelectorAll('.step-item').forEach(el => {
        const n = parseInt(el.dataset.step);
        el.classList.remove('active','done','pending');
        if (n < currentStep)      el.classList.add('done');
        else if (n === currentStep) el.classList.add('active');
        else                        el.classList.add('pending');
    });

    document.getElementById('btnPrev').disabled = currentStep === 1;
    document.getElementById('stepIndicator').textContent = `Step ${currentStep} of ${TOTAL_STEPS}`;
});
@endif
</script>
@endpush

@endsection