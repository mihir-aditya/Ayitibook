<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register - AyitiBook</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* ══════════════════════════════════════
           MULTI-STEP REGISTRATION
        ══════════════════════════════════════ */

        .register-wrapper {
            min-height: 100vh;
            padding: 40px 0 60px;
            background: linear-gradient(135deg, #fdf2f6 0%, #f5f0ff 100%);
        }

        /* ── Progress stepper ── */
        .stepper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            margin-bottom: 36px;
        }

        .step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .step-connector {
            flex: 1;
            height: 2px;
            background: #e5e7eb;
            max-width: 80px;
            margin-bottom: 24px;
            transition: background .4s ease;
        }
        .step-connector.done { background: var(--bs-secondary, #db5386); }

        .step-circle {
            width: 44px; height: 44px;
            border-radius: 50%;
            border: 2px solid #e5e7eb;
            background: #fff;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: .9rem;
            color: #9ca3af;
            transition: all .3s ease;
            margin-bottom: 6px;
        }
        .step-circle.active {
            border-color: var(--bs-secondary, #db5386);
            background: var(--bs-secondary, #db5386);
            color: #fff;
            box-shadow: 0 0 0 4px rgba(219,83,134,.15);
        }
        .step-circle.done {
            border-color: var(--bs-secondary, #db5386);
            background: var(--bs-secondary, #db5386);
            color: #fff;
        }
        .step-label {
            font-size: .72rem;
            font-weight: 500;
            color: #9ca3af;
            white-space: nowrap;
        }
        .step-item.active .step-label,
        .step-item.done  .step-label { color: var(--bs-secondary, #db5386); }

        /* ── Card ── */
        .register-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 40px rgba(0,0,0,.08);
            overflow: hidden;
        }

        .register-card-header {
            background: linear-gradient(135deg, var(--bs-secondary, #db5386), #9333ea);
            padding: 28px 36px 22px;
            color: #fff;
        }
        .register-card-header h2 {
            font-size: 1.35rem;
            font-weight: 700;
            margin: 0 0 4px;
        }
        .register-card-header p {
            font-size: .83rem;
            opacity: .85;
            margin: 0;
        }

        .register-card-body { padding: 32px 36px; }

        @media (max-width: 576px) {
            .register-card-header { padding: 22px 20px 18px; }
            .register-card-body   { padding: 24px 20px; }
        }

        /* ── Step panels ── */
        .step-panel { display: none; }
        .step-panel.active { display: block; animation: fadeSlideIn .3s ease; }

        @keyframes fadeSlideIn {
            from { opacity: 0; transform: translateX(18px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        /* ── Form elements ── */
        .form-label {
            font-size: .825rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }
        .form-label .req { color: #dc2626; }

        .form-control, .form-select {
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: .875rem;
            color: #111;
            background: #fafafa;
            transition: border-color .15s, box-shadow .15s, background .15s;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--bs-secondary, #db5386);
            box-shadow: 0 0 0 3px rgba(219,83,134,.1);
            background: #fff;
            outline: none;
        }
        .form-control.is-invalid, .form-select.is-invalid {
            border-color: #dc2626;
            background: #fff5f5;
        }
        .invalid-feedback { font-size: .78rem; }

        /* ── Password strength ── */
        .strength-bar-track {
            height: 4px; border-radius: 99px;
            background: #f0f0f0; margin-top: 6px;
            overflow: hidden;
        }
        .strength-bar-fill {
            height: 100%; border-radius: 99px;
            width: 0; transition: width .3s, background .3s;
        }
        .strength-label {
            font-size: .72rem; margin-top: 3px; font-weight: 500;
        }

        /* ── Option cards (payment / delivery) ── */
        .option-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
            gap: 10px;
            margin-top: 4px;
        }
        .option-card-label {
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            gap: 6px; padding: 14px 10px;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px; cursor: pointer;
            font-size: .78rem; font-weight: 500;
            color: #555; text-align: center;
            transition: all .2s ease;
            background: #fafafa;
        }
        .option-card-label i { font-size: 1.3rem; color: #9ca3af; transition: color .2s; }
        .option-card-label:hover { border-color: var(--bs-secondary, #db5386); background: #fdf4f8; }
        .option-card-input:checked + .option-card-label {
            border-color: var(--bs-secondary, #db5386);
            background: linear-gradient(135deg, #fdf4f8, #f5f0ff);
            color: var(--bs-secondary, #db5386);
            font-weight: 600;
        }
        .option-card-input:checked + .option-card-label i {
            color: var(--bs-secondary, #db5386);
        }
        .option-card-input { display: none; }

        /* ── Interest tag checkboxes ── */
        .interest-tags { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 6px; }
        .interest-tag-input { display: none; }
        .interest-tag-label {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 6px 14px; border-radius: 999px;
            border: 1.5px solid #e5e7eb;
            font-size: .78rem; font-weight: 500;
            cursor: pointer; color: #555;
            transition: all .15s ease;
            background: #fafafa;
        }
        .interest-tag-label:hover { border-color: var(--bs-secondary, #db5386); color: var(--bs-secondary, #db5386); }
        .interest-tag-input:checked + .interest-tag-label {
            background: var(--bs-secondary, #db5386);
            border-color: var(--bs-secondary, #db5386);
            color: #fff;
        }

        /* ── ID upload zone ── */
        .id-upload-zone {
            border: 2px dashed #d1d5db;
            border-radius: 14px;
            padding: 28px 20px;
            text-align: center;
            cursor: pointer;
            transition: all .2s ease;
            background: #fafafa;
            position: relative;
        }
        .id-upload-zone:hover,
        .id-upload-zone.dragover {
            border-color: var(--bs-secondary, #db5386);
            background: #fdf4f8;
        }
        .id-upload-zone .upload-icon {
            font-size: 2.2rem; color: #d1d5db;
            margin-bottom: 10px; display: block;
            transition: color .2s;
        }
        .id-upload-zone:hover .upload-icon { color: var(--bs-secondary, #db5386); }
        .id-upload-zone .upload-text {
            font-size: .85rem; color: #6b7280; line-height: 1.5;
        }
        .id-upload-zone .upload-text strong { color: var(--bs-secondary, #db5386); }
        #idPreview {
            display: none; margin-top: 16px;
            border-radius: 10px; overflow: hidden;
            border: 1px solid #e5e7eb;
            max-height: 180px; width: 100%;
            object-fit: contain; background: #f5f5f5;
        }
        .id-upload-clear {
            display: none; margin-top: 8px;
            font-size: .78rem; color: #dc2626;
            cursor: pointer; background: none;
            border: none; padding: 0;
        }

        /* ── Navigation buttons ── */
        .step-nav {
            display: flex; gap: 12px;
            margin-top: 28px; justify-content: flex-end;
        }
        .btn-step-prev {
            padding: 10px 28px;
            border: 1.5px solid #e5e7eb;
            background: #fff; border-radius: 10px;
            font-size: .875rem; font-weight: 600;
            color: #555; cursor: pointer;
            transition: all .2s;
        }
        .btn-step-prev:hover { border-color: #9ca3af; color: #111; }

        .btn-step-next, .btn-register-submit {
            padding: 10px 32px;
            background: linear-gradient(135deg, var(--bs-secondary, #db5386), #9333ea);
            color: #fff; border: none;
            border-radius: 10px; font-size: .875rem;
            font-weight: 600; cursor: pointer;
            transition: opacity .2s, transform .15s;
            display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-step-next:hover,
        .btn-register-submit:hover { opacity: .92; transform: translateY(-1px); }

        /* ── Validation error summary ── */
        .error-summary {
            background: #fff1f2; border: 1px solid #fecaca;
            border-radius: 10px; padding: 14px 18px;
            margin-bottom: 24px; font-size: .83rem; color: #991b1b;
        }
        .error-summary ul { margin: 6px 0 0; padding-left: 18px; }
        .error-summary li { margin-bottom: 2px; }

        /* ── Section dividers inside step ── */
        .step-section-title {
            font-size: .72rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: .08em;
            color: #9ca3af; margin: 22px 0 14px;
            display: flex; align-items: center; gap: 8px;
        }
        .step-section-title::after {
            content: ''; flex: 1; height: 1px; background: #f0f0f0;
        }

        /* ── Inline field error (JS) ── */
        .field-error {
            font-size: .75rem; color: #dc2626;
            margin-top: 4px; display: none;
        }
        .field-error.visible { display: block; }
    </style>
</head>

<body>
{{-- @include('includes.top-header') --}}
@include('includes.header')

<div class="page-wrapper">
    <main class="main-wrapper register-wrapper">
        <div class="container">

            {{-- Breadcrumb --}}
            <nav class="breadcrumb mb-4">
                <a href="{{ url('/') }}">Home</a> / <span>Register</span>
            </nav>

            {{-- Stepper --}}
            <div class="stepper mb-2" id="stepper">
                <div class="step-item active" id="step-indicator-1">
                    <div class="step-circle active" id="step-circle-1">1</div>
                    <span class="step-label">Account</span>
                </div>
                <div class="step-connector" id="step-conn-1"></div>
                <div class="step-item" id="step-indicator-2">
                    <div class="step-circle" id="step-circle-2">2</div>
                    <span class="step-label">Address</span>
                </div>
                <div class="step-connector" id="step-conn-2"></div>
                <div class="step-item" id="step-indicator-3">
                    <div class="step-circle" id="step-circle-3">3</div>
                    <span class="step-label">Preferences</span>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-9">

                    {{-- Validation error summary (server-side) --}}
                    @if($errors->any())
                    <div class="error-summary">
                        <strong><i class="fas fa-exclamation-circle me-1"></i> Please fix the following:</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="register-card">

                        {{-- Dynamic header (JS updates title/subtitle) --}}
                        <div class="register-card-header">
                            <h2 id="card-title">Create Your Account</h2>
                            <p  id="card-subtitle">Step 1 of 3 — Basic account information</p>
                        </div>

                        <div class="register-card-body">
                            <form method="POST"
                                  action="{{ route('register') }}"
                                  enctype="multipart/form-data"
                                  id="registerForm"
                                  novalidate>
                                @csrf

                                {{-- ════════════════════════════
                                     STEP 1 — Account Info
                                ════════════════════════════ --}}
                                <div class="step-panel active" id="panel-1">

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label" for="name">Full Name <span class="req">*</span></label>
                                            <input type="text" id="name" name="name"
                                                   value="{{ old('name') }}"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   placeholder="e.g. Jean Pierre">
                                            @error('name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            <div class="field-error" id="err-name"></div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label" for="username">Username <span class="req">*</span></label>
                                            <input type="text" id="username" name="username"
                                                   value="{{ old('username') }}"
                                                   class="form-control @error('username') is-invalid @enderror"
                                                   placeholder="e.g. jeanpierre99">
                                            @error('username')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            <div class="field-error" id="err-username"></div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label" for="email">Email Address <span class="req">*</span></label>
                                            <input type="email" id="email" name="email"
                                                   value="{{ old('email') }}"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   placeholder="you@example.com">
                                            @error('email')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            <div class="field-error" id="err-email"></div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label" for="phone">Phone Number <span class="req">*</span></label>
                                            <input type="tel" id="phone" name="phone"
                                                   value="{{ old('phone') }}"
                                                   class="form-control @error('phone') is-invalid @enderror"
                                                   placeholder="+509 XXXX XXXX">
                                            @error('phone')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            <div class="field-error" id="err-phone"></div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label" for="password">Password <span class="req">*</span></label>
                                            <div class="position-relative">
                                                <input type="password" id="password" name="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       placeholder="Min. 8 characters"
                                                       oninput="checkStrength(this.value)">
                                                <button type="button" class="btn-toggle-pw"
                                                        onclick="togglePw('password', this)"
                                                        style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:#9ca3af;cursor:pointer;font-size:.85rem;">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                            <div class="strength-bar-track">
                                                <div class="strength-bar-fill" id="strengthBar"></div>
                                            </div>
                                            <div class="strength-label" id="strengthLabel"></div>
                                            @error('password')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                            <div class="field-error" id="err-password"></div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label" for="password_confirmation">Confirm Password <span class="req">*</span></label>
                                            <div class="position-relative">
                                                <input type="password" id="password_confirmation"
                                                       name="password_confirmation"
                                                       class="form-control"
                                                       placeholder="Re-enter password">
                                                <button type="button" class="btn-toggle-pw"
                                                        onclick="togglePw('password_confirmation', this)"
                                                        style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:#9ca3af;cursor:pointer;font-size:.85rem;">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                            <div class="field-error" id="err-confirm"></div>
                                        </div>
                                    </div>

                                    <div class="text-center mt-4" style="font-size:.82rem;color:#6b7280;">
                                        Already have an account?
                                        <a href="{{ route('login') }}" style="color:var(--bs-secondary,#db5386);font-weight:600;">Sign In</a>
                                    </div>

                                    <div class="step-nav">
                                        <button type="button" class="btn-step-next" onclick="goToStep(2)">
                                            Next — Address <i class="fas fa-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>

                                {{-- ════════════════════════════
                                     STEP 2 — Address & Location
                                ════════════════════════════ --}}
                                <div class="step-panel" id="panel-2">

                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label" for="address">Street Address <span class="req">*</span></label>
                                            <input type="text" id="address" name="address"
                                                   value="{{ old('address') }}"
                                                   class="form-control @error('address') is-invalid @enderror"
                                                   placeholder="House / Apartment / Street">
                                            @error('address')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            <div class="field-error" id="err-address"></div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label" for="zone">Zone / Area <span class="req">*</span></label>
                                            <input type="text" id="zone" name="zone"
                                                   value="{{ old('zone') }}"
                                                   class="form-control @error('zone') is-invalid @enderror"
                                                   placeholder="e.g. Pétion-Ville">
                                            @error('zone')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            <div class="field-error" id="err-zone"></div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label" for="city">City <span class="req">*</span></label>
                                            <input type="text" id="city" name="city"
                                                   value="{{ old('city') }}"
                                                   class="form-control @error('city') is-invalid @enderror"
                                                   placeholder="e.g. Port-au-Prince">
                                            @error('city')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            <div class="field-error" id="err-city"></div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label" for="state">State / Department</label>
                                            <input type="text" id="state" name="state"
                                                   value="{{ old('state') }}"
                                                   class="form-control @error('state') is-invalid @enderror"
                                                   placeholder="e.g. Ouest">
                                            @error('state')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label" for="postal_code">Postal Code</label>
                                            <input type="text" id="postal_code" name="postal_code"
                                                   value="{{ old('postal_code') }}"
                                                   class="form-control"
                                                   placeholder="HT XXXX">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label" for="country">Country <span class="req">*</span></label>
                                            <input type="text" id="country" name="country"
                                                   value="{{ old('country', 'Haiti') }}"
                                                   class="form-control @error('country') is-invalid @enderror">
                                            @error('country')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="step-nav">
                                        <button type="button" class="btn-step-prev" onclick="goToStep(1)">
                                            <i class="fas fa-arrow-left"></i> Back
                                        </button>
                                        <button type="button" class="btn-step-next" onclick="goToStep(3)">
                                            Next — Preferences <i class="fas fa-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>

                                {{-- ════════════════════════════
                                     STEP 3 — Preferences + ID
                                ════════════════════════════ --}}
                                <div class="step-panel" id="panel-3">

                                    {{-- Shopping Behaviour --}}
                                    <div class="step-section-title">Shopping Preferences</div>

                                    {{-- Preferred payment --}}
                                    <div class="mb-4">
                                        <label class="form-label">Preferred Payment Method <span class="req">*</span></label>
                                        <div class="option-cards">
                                            @foreach($paymentOptions as $val => $label)
                                                <div>
                                                    <input type="radio" name="preferred_payment"
                                                           id="pay_{{ $val }}" value="{{ $val }}"
                                                           class="option-card-input"
                                                           {{ old('preferred_payment') == $val ? 'checked' : '' }}>
                                                    <label for="pay_{{ $val }}" class="option-card-label">
                                                        <i class="fas fa-{{ $val === 'cod' ? 'money-bill-wave' : ($val === 'card' ? 'credit-card' : 'wallet') }}"></i>
                                                        {{ $label }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('preferred_payment')
                                            <div class="text-danger mt-1" style="font-size:.78rem;">{{ $message }}</div>
                                        @enderror
                                        <div class="field-error" id="err-payment"></div>
                                    </div>

                                    {{-- Delivery preference --}}
                                    <div class="mb-4">
                                        <label class="form-label">Delivery Preference <span class="req">*</span></label>
                                        <div class="option-cards">
                                            @foreach($deliveryOptions as $val => $label)
                                                <div>
                                                    <input type="radio" name="delivery_preference"
                                                           id="del_{{ $val }}" value="{{ $val }}"
                                                           class="option-card-input"
                                                           {{ old('delivery_preference') == $val ? 'checked' : '' }}>
                                                    <label for="del_{{ $val }}" class="option-card-label">
                                                        <i class="fas fa-{{ $val === 'fast' ? 'bolt' : 'truck' }}"></i>
                                                        {{ $label }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('delivery_preference')
                                            <div class="text-danger mt-1" style="font-size:.78rem;">{{ $message }}</div>
                                        @enderror
                                        <div class="field-error" id="err-delivery"></div>
                                    </div>

                                    <div class="row g-3 mb-4">
                                        {{-- Purchase frequency --}}
                                        <div class="col-md-6">
                                            <label class="form-label" for="purchase_frequency">
                                                How often do you shop? <span class="req">*</span>
                                            </label>
                                            <select id="purchase_frequency" name="purchase_frequency"
                                                    class="form-select @error('purchase_frequency') is-invalid @enderror">
                                                <option value="">Select frequency</option>
                                                @foreach($frequencyOptions as $val => $label)
                                                    <option value="{{ $val }}" {{ old('purchase_frequency') == $val ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('purchase_frequency')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            <div class="field-error" id="err-frequency"></div>
                                        </div>

                                        {{-- Avg order value --}}
                                        <div class="col-md-6">
                                            <label class="form-label" for="avg_order_value">
                                                Average Order Value <span class="req">*</span>
                                            </label>
                                            <select id="avg_order_value" name="avg_order_value"
                                                    class="form-select @error('avg_order_value') is-invalid @enderror">
                                                <option value="">Select range</option>
                                                @foreach($orderValueOptions as $val => $label)
                                                    <option value="{{ $val }}" {{ old('avg_order_value') == $val ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('avg_order_value')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Loyalty / VIP --}}
                                    <div class="step-section-title">Loyalty & Account Type</div>

                                    <div class="row g-3 mb-4">
                                        {{-- Buyer type --}}
                                        <div class="col-md-6">
                                            <label class="form-label">Account Type <span class="req">*</span></label>
                                            <div class="option-cards">
                                                <div>
                                                    <input type="radio" name="buyer_type" id="type_personal"
                                                           value="personal" class="option-card-input"
                                                           {{ old('buyer_type', 'personal') == 'personal' ? 'checked' : '' }}>
                                                    <label for="type_personal" class="option-card-label">
                                                        <i class="fas fa-user"></i> Personal
                                                    </label>
                                                </div>
                                                <div>
                                                    <input type="radio" name="buyer_type" id="type_business"
                                                           value="business" class="option-card-input"
                                                           {{ old('buyer_type') == 'business' ? 'checked' : '' }}>
                                                    <label for="type_business" class="option-card-label">
                                                        <i class="fas fa-building"></i> Business
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Monthly estimate --}}
                                        <div class="col-md-6">
                                            <label class="form-label" for="monthly_estimate">
                                                Monthly Purchase Estimate <span class="req">*</span>
                                            </label>
                                            <select id="monthly_estimate" name="monthly_estimate"
                                                    class="form-select @error('monthly_estimate') is-invalid @enderror">
                                                <option value="">Select estimate</option>
                                                @foreach($monthlyOptions as $val => $label)
                                                    <option value="{{ $val }}" {{ old('monthly_estimate') == $val ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('monthly_estimate')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Interest categories --}}
                                    <div class="mb-4">
                                        <label class="form-label">Interest Categories <span class="text-muted fw-normal">(optional)</span></label>
                                        <div class="interest-tags">
                                            @foreach($interestOptions as $val => $label)
                                                <div>
                                                    <input type="checkbox" name="interest_categories[]"
                                                           id="int_{{ $val }}" value="{{ $val }}"
                                                           class="interest-tag-input"
                                                           {{ in_array($val, old('interest_categories', [])) ? 'checked' : '' }}>
                                                    <label for="int_{{ $val }}" class="interest-tag-label">
                                                        {{ $label }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    {{-- ID Verification --}}
                                    <div class="step-section-title">Identity Verification</div>

                                    <div class="row g-3 mb-3">
                                        <div class="col-md-5">
                                            <label class="form-label" for="id_type">ID Document Type <span class="req">*</span></label>
                                            <select id="id_type" name="id_type"
                                                    class="form-select @error('id_type') is-invalid @enderror">
                                                <option value="">Select ID type</option>
                                                @foreach($idTypeOptions as $val => $label)
                                                    <option value="{{ $val }}" {{ old('id_type') == $val ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('id_type')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            <div class="field-error" id="err-idtype"></div>
                                        </div>

                                        <div class="col-md-7">
                                            <label class="form-label">
                                                Upload ID Document <span class="req">*</span>
                                                <span class="text-muted fw-normal" style="font-size:.72rem;">(JPEG, PNG or PDF, max 4MB)</span>
                                            </label>

                                            <div class="id-upload-zone" id="idDropZone"
                                                 onclick="document.getElementById('id_document').click()"
                                                 ondragover="handleDragOver(event)"
                                                 ondragleave="handleDragLeave(event)"
                                                 ondrop="handleDrop(event)">
                                                <i class="fas fa-id-card upload-icon"></i>
                                                <div class="upload-text">
                                                    <strong>Click to upload</strong> or drag & drop<br>
                                                    <small>National ID, Passport or Driver's License</small>
                                                </div>
                                                <img id="idPreview" src="" alt="ID Preview">
                                                <div id="idFileName" style="font-size:.78rem;color:#6b7280;margin-top:8px;display:none;"></div>
                                            </div>

                                            <input type="file" id="id_document" name="id_document"
                                                   accept="image/jpeg,image/png,image/jpg,image/webp,application/pdf"
                                                   class="d-none @error('id_document') is-invalid @enderror"
                                                   onchange="handleIdUpload(this)">
                                            <button type="button" id="idClearBtn" class="id-upload-clear"
                                                    onclick="clearIdUpload()">
                                                <i class="fas fa-times me-1"></i> Remove
                                            </button>

                                            @error('id_document')
                                                <div class="text-danger mt-1" style="font-size:.78rem;">{{ $message }}</div>
                                            @enderror
                                            <div class="field-error" id="err-iddoc"></div>
                                        </div>
                                    </div>

                                    <div class="step-nav">
                                        <button type="button" class="btn-step-prev" onclick="goToStep(2)">
                                            <i class="fas fa-arrow-left"></i> Back
                                        </button>
                                        <button type="submit" class="btn-register-submit" id="submitBtn">
                                            <i class="fas fa-user-plus"></i> Create Account
                                        </button>
                                    </div>

                                </div>{{-- end panel-3 --}}

                            </form>
                        </div>{{-- end card body --}}
                    </div>{{-- end register-card --}}

                </div>
            </div>
        </div>
    </main>
</div>

@include('includes.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/mobile.js') }}"></script>

<script>
/* ════════════════════════════════════════
   MULTI-STEP NAVIGATION
════════════════════════════════════════ */

let currentStep = {{ $errors->any() ? 'detectErrorStep()' : '1' }};

const stepTitles = {
    1: { title: 'Create Your Account',         subtitle: 'Step 1 of 3 — Basic account information' },
    2: { title: 'Your Address & Location',      subtitle: 'Step 2 of 3 — Where should we deliver?' },
    3: { title: 'Preferences & Verification',   subtitle: 'Step 3 of 3 — Personalize your experience' },
};

function detectErrorStep() {
    // If server returned errors, jump to the step that has them
    const step2Fields = ['address','zone','city','state','postal_code','country'];
    const step3Fields = ['preferred_payment','delivery_preference','purchase_frequency',
                         'avg_order_value','buyer_type','monthly_estimate','id_type','id_document'];

    @if($errors->any())
        @foreach($errors->keys() as $key)
            if (step3Fields.includes('{{ $key }}')) return 3;
        @endforeach
        @foreach($errors->keys() as $key)
            if (step2Fields.includes('{{ $key }}')) return 2;
        @endforeach
    @endif
    return 1;
}

// Init on load
document.addEventListener('DOMContentLoaded', () => {
    currentStep = detectErrorStep();
    renderStep(currentStep);
});

function renderStep(step) {
    // Hide all panels
    document.querySelectorAll('.step-panel').forEach(p => p.classList.remove('active'));
    // Show target
    document.getElementById('panel-' + step).classList.add('active');

    // Update stepper circles
    for (let i = 1; i <= 3; i++) {
        const circle    = document.getElementById('step-circle-' + i);
        const indicator = document.getElementById('step-indicator-' + i);
        circle.classList.remove('active', 'done');
        indicator.classList.remove('active', 'done');

        if (i < step) {
            circle.classList.add('done');
            indicator.classList.add('done');
            circle.innerHTML = '<i class="fas fa-check" style="font-size:.7rem;"></i>';
        } else if (i === step) {
            circle.classList.add('active');
            indicator.classList.add('active');
            circle.textContent = i;
        } else {
            circle.textContent = i;
        }
    }

    // Update connectors
    for (let i = 1; i <= 2; i++) {
        const conn = document.getElementById('step-conn-' + i);
        conn.classList.toggle('done', i < step);
    }

    // Update card header
    document.getElementById('card-title').textContent    = stepTitles[step].title;
    document.getElementById('card-subtitle').textContent = stepTitles[step].subtitle;

    // Scroll to top of card
    document.querySelector('.register-card')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function goToStep(target) {
    // Validate current step before moving forward
    if (target > currentStep) {
        if (!validateStep(currentStep)) return;
    }
    currentStep = target;
    renderStep(currentStep);
}

/* ════════════════════════════════════════
   CLIENT-SIDE VALIDATION PER STEP
════════════════════════════════════════ */

function validateStep(step) {
    let valid = true;

    if (step === 1) {
        valid &= requireField('name',     'err-name',     'Full name is required.');
        valid &= requireField('username', 'err-username', 'Username is required.');
        valid &= requireEmail('email',    'err-email');
        valid &= requireField('phone',    'err-phone',    'Phone number is required.');
        valid &= requireField('password', 'err-password', 'Password is required.');
        valid &= matchPasswords();
    }

    if (step === 2) {
        valid &= requireField('address', 'err-address', 'Street address is required.');
        valid &= requireField('zone',    'err-zone',    'Zone / Area is required.');
        valid &= requireField('city',    'err-city',    'City is required.');
    }

    if (step === 3) {
        valid &= requireRadio('preferred_payment', 'err-payment',  'Please select a payment method.');
        valid &= requireRadio('delivery_preference','err-delivery', 'Please select a delivery preference.');
        valid &= requireSelect('purchase_frequency','err-frequency','Please select your shopping frequency.');
        valid &= requireSelect('id_type',            'err-idtype',  'Please select your ID document type.');
        valid &= requireFile('id_document',           'err-iddoc',   'Please upload your ID document.');
    }

    return !!valid;
}

/* ── Helpers ── */
function showErr(id, msg) {
    const el = document.getElementById(id);
    if (!el) return;
    el.textContent = msg;
    el.classList.add('visible');
}
function clearErr(id) {
    const el = document.getElementById(id);
    if (!el) return;
    el.classList.remove('visible');
}

function requireField(fieldId, errId, msg) {
    const val = document.getElementById(fieldId)?.value.trim();
    if (!val) { showErr(errId, msg); return false; }
    clearErr(errId); return true;
}
function requireEmail(fieldId, errId) {
    const val = document.getElementById(fieldId)?.value.trim();
    if (!val) { showErr(errId, 'Email address is required.'); return false; }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)) { showErr(errId, 'Please enter a valid email.'); return false; }
    clearErr(errId); return true;
}
function requireRadio(name, errId, msg) {
    const checked = document.querySelector(`input[name="${name}"]:checked`);
    if (!checked) { showErr(errId, msg); return false; }
    clearErr(errId); return true;
}
function requireSelect(fieldId, errId, msg) {
    const val = document.getElementById(fieldId)?.value;
    if (!val) { showErr(errId, msg); return false; }
    clearErr(errId); return true;
}
function requireFile(fieldId, errId, msg) {
    const input = document.getElementById(fieldId);
    if (!input || !input.files.length) { showErr(errId, msg); return false; }
    clearErr(errId); return true;
}
function matchPasswords() {
    const pw  = document.getElementById('password')?.value;
    const cpw = document.getElementById('password_confirmation')?.value;
    if (pw && cpw && pw !== cpw) {
        showErr('err-confirm', 'Passwords do not match.'); return false;
    }
    clearErr('err-confirm'); return true;
}

// Clear errors on input
document.querySelectorAll('.form-control, .form-select').forEach(el => {
    el.addEventListener('input', () => {
        const errEl = document.getElementById('err-' + el.id.replace('_', '-'));
        if (errEl) errEl.classList.remove('visible');
    });
});

/* ════════════════════════════════════════
   PASSWORD STRENGTH METER
════════════════════════════════════════ */
function checkStrength(pw) {
    let score = 0;
    if (pw.length >= 8)              score++;
    if (/[A-Z]/.test(pw))            score++;
    if (/[0-9]/.test(pw))            score++;
    if (/[^A-Za-z0-9]/.test(pw))     score++;

    const bar   = document.getElementById('strengthBar');
    const label = document.getElementById('strengthLabel');
    const levels = [
        { w: '0%',   bg: '',         text: '',           color: '' },
        { w: '25%',  bg: '#ef4444',  text: 'Weak',       color: '#ef4444' },
        { w: '50%',  bg: '#f97316',  text: 'Fair',       color: '#f97316' },
        { w: '75%',  bg: '#eab308',  text: 'Good',       color: '#eab308' },
        { w: '100%', bg: '#22c55e',  text: 'Strong 💪',  color: '#22c55e' },
    ];
    const lvl = levels[score];
    bar.style.width      = lvl.w;
    bar.style.background = lvl.bg;
    label.textContent    = lvl.text;
    label.style.color    = lvl.color;
}

function togglePw(fieldId, btn) {
    const input = document.getElementById(fieldId);
    const icon  = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}

/* ════════════════════════════════════════
   ID DOCUMENT UPLOAD
════════════════════════════════════════ */
function handleIdUpload(input) {
    const file = input.files[0];
    if (!file) return;

    document.getElementById('idFileName').textContent = file.name;
    document.getElementById('idFileName').style.display = 'block';
    document.getElementById('idClearBtn').style.display = 'inline-block';

    if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = e => {
            const preview = document.getElementById('idPreview');
            preview.src   = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        // PDF — show icon instead
        document.getElementById('idPreview').style.display = 'none';
        document.querySelector('#idDropZone .upload-icon').className = 'fas fa-file-pdf upload-icon';
        document.querySelector('#idDropZone .upload-icon').style.color = '#dc2626';
    }

    clearErr('err-iddoc');
}

function clearIdUpload() {
    document.getElementById('id_document').value = '';
    document.getElementById('idPreview').style.display   = 'none';
    document.getElementById('idFileName').style.display  = 'none';
    document.getElementById('idClearBtn').style.display  = 'none';
    document.querySelector('#idDropZone .upload-icon').className = 'fas fa-id-card upload-icon';
    document.querySelector('#idDropZone .upload-icon').style.color = '';
}

function handleDragOver(e) {
    e.preventDefault();
    document.getElementById('idDropZone').classList.add('dragover');
}
function handleDragLeave(e) {
    document.getElementById('idDropZone').classList.remove('dragover');
}
function handleDrop(e) {
    e.preventDefault();
    document.getElementById('idDropZone').classList.remove('dragover');
    const file = e.dataTransfer.files[0];
    if (!file) return;

    // Assign dropped file to input via DataTransfer
    const dt = new DataTransfer();
    dt.items.add(file);
    const input = document.getElementById('id_document');
    input.files = dt.files;
    handleIdUpload(input);
}

/* ════════════════════════════════════════
   SUBMIT — final validation before post
════════════════════════════════════════ */
document.getElementById('registerForm').addEventListener('submit', function(e) {
    if (!validateStep(3)) {
        e.preventDefault();
        return;
    }
    // Show loading state
    const btn = document.getElementById('submitBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating account…';
});
</script>

</body>
</html>