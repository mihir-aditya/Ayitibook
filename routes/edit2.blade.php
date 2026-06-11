<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Profile | AyitiBook</title>
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
           PROFILE PAGE
        ══════════════════════════════════════ */
        .profile-page {
            background: linear-gradient(135deg, #fdf2f6 0%, #f5f0ff 100%);
            min-height: 100vh;
            padding: 40px 0 60px;
        }

        /* ── Hero banner ── */
        .profile-hero {
            background: linear-gradient(135deg, var(--bs-secondary, #db5386), #9333ea);
            border-radius: 20px;
            padding: 32px 36px;
            display: flex;
            align-items: center;
            gap: 28px;
            margin-bottom: 28px;
            flex-wrap: wrap;
            position: relative;
            overflow: hidden;
        }
        .profile-hero::before {
            content: '';
            position: absolute; inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='28'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        /* Avatar */
        .avatar-wrapper {
            position: relative; flex-shrink: 0; z-index: 1;
        }
        .avatar-img {
            width: 96px; height: 96px; border-radius: 50%;
            border: 4px solid rgba(255,255,255,.4);
            object-fit: cover;
            background: rgba(255,255,255,.2);
        }
        .avatar-placeholder {
            width: 96px; height: 96px; border-radius: 50%;
            border: 4px solid rgba(255,255,255,.4);
            background: rgba(255,255,255,.2);
            display: flex; align-items: center; justify-content: center;
            font-size: 2rem; font-weight: 700; color: #fff;
        }
        .avatar-edit-btn {
            position: absolute; bottom: 0; right: 0;
            width: 28px; height: 28px; border-radius: 50%;
            background: #fff; border: none; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: .75rem; color: var(--bs-secondary, #db5386);
            box-shadow: 0 2px 8px rgba(0,0,0,.15);
            transition: transform .15s;
        }
        .avatar-edit-btn:hover { transform: scale(1.1); }

        .hero-info { flex: 1; z-index: 1; }
        .hero-info h2 { font-size: 1.4rem; font-weight: 700; color: #fff; margin: 0 0 4px; }
        .hero-info p  { font-size: .85rem; color: rgba(255,255,255,.8); margin: 0 0 12px; }

        /* Verification badge */
        .verify-badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 4px 12px; border-radius: 999px;
            font-size: .75rem; font-weight: 600;
        }
        .verify-badge.pending  { background: rgba(255,255,255,.2); color: #fff; }
        .verify-badge.verified { background: #d1fae5; color: #065f46; }
        .verify-badge.rejected { background: #fee2e2; color: #991b1b; }

        /* Stats row */
        .hero-stats {
            display: flex; gap: 20px; flex-wrap: wrap; margin-top: 14px;
        }
        .hero-stat {
            background: rgba(255,255,255,.15);
            border-radius: 10px; padding: 10px 18px;
            text-align: center;
        }
        .hero-stat .val { font-size: 1.1rem; font-weight: 700; color: #fff; }
        .hero-stat .lbl { font-size: .7rem; color: rgba(255,255,255,.75); }

        /* ── Tab navigation ── */
        .profile-tabs {
            display: flex; gap: 4px;
            background: #fff; border-radius: 14px;
            padding: 6px; margin-bottom: 24px;
            box-shadow: 0 2px 12px rgba(0,0,0,.06);
            flex-wrap: wrap;
        }
        .profile-tab-btn {
            flex: 1; min-width: 100px;
            padding: 9px 16px; border: none;
            border-radius: 10px; cursor: pointer;
            font-size: .8rem; font-weight: 500;
            color: #6b7280; background: transparent;
            transition: all .2s ease;
            display: flex; align-items: center;
            justify-content: center; gap: 7px;
            white-space: nowrap;
        }
        .profile-tab-btn:hover { background: #f5f5f5; color: #111; }
        .profile-tab-btn.active {
            background: linear-gradient(135deg, var(--bs-secondary, #db5386), #9333ea);
            color: #fff;
            box-shadow: 0 4px 12px rgba(219,83,134,.3);
        }
        .profile-tab-btn i { font-size: .85rem; }

        /* ── Tab panels ── */
        .tab-panel { display: none; }
        .tab-panel.active { display: block; animation: fadeIn .25s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }

        /* ── Cards ── */
        .profile-card {
            background: #fff; border-radius: 16px;
            box-shadow: 0 2px 16px rgba(0,0,0,.06);
            padding: 28px 32px; margin-bottom: 20px;
        }
        .profile-card-title {
            font-size: .95rem; font-weight: 700; color: #111;
            margin-bottom: 22px;
            display: flex; align-items: center; gap: 10px;
            padding-bottom: 14px;
            border-bottom: 1px solid #f3f4f6;
        }
        .profile-card-title i {
            width: 32px; height: 32px; border-radius: 8px;
            background: linear-gradient(135deg, var(--bs-secondary, #db5386), #9333ea);
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: .8rem;
        }

        @media (max-width: 576px) {
            .profile-card { padding: 20px 16px; }
        }

        /* ── Form elements ── */
        .form-label {
            font-size: .8rem; font-weight: 600;
            color: #374151; margin-bottom: 5px;
        }
        .form-control, .form-select {
            border: 1.5px solid #e5e7eb; border-radius: 10px;
            padding: 10px 14px; font-size: .875rem; color: #111;
            background: #fafafa;
            transition: border-color .15s, box-shadow .15s, background .15s;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--bs-secondary, #db5386);
            box-shadow: 0 0 0 3px rgba(219,83,134,.1);
            background: #fff; outline: none;
        }
        .form-control.is-invalid { border-color: #dc2626; background: #fff5f5; }
        .invalid-feedback { font-size: .75rem; }

        /* ── Option cards ── */
        .option-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 8px; margin-top: 4px;
        }
        .option-card-input { display: none; }
        .option-card-label {
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            gap: 5px; padding: 12px 8px;
            border: 1.5px solid #e5e7eb; border-radius: 10px;
            cursor: pointer; font-size: .76rem; font-weight: 500;
            color: #555; text-align: center;
            transition: all .2s; background: #fafafa;
        }
        .option-card-label i { font-size: 1.1rem; color: #9ca3af; transition: color .2s; }
        .option-card-label:hover { border-color: var(--bs-secondary, #db5386); background: #fdf4f8; }
        .option-card-input:checked + .option-card-label {
            border-color: var(--bs-secondary, #db5386);
            background: linear-gradient(135deg, #fdf4f8, #f5f0ff);
            color: var(--bs-secondary, #db5386); font-weight: 600;
        }
        .option-card-input:checked + .option-card-label i { color: var(--bs-secondary, #db5386); }

        /* ── Interest tags ── */
        .interest-tags { display: flex; flex-wrap: wrap; gap: 7px; margin-top: 6px; }
        .interest-tag-input { display: none; }
        .interest-tag-label {
            padding: 5px 13px; border-radius: 999px;
            border: 1.5px solid #e5e7eb;
            font-size: .76rem; font-weight: 500;
            cursor: pointer; color: #555;
            transition: all .15s; background: #fafafa;
        }
        .interest-tag-label:hover { border-color: var(--bs-secondary, #db5386); color: var(--bs-secondary, #db5386); }
        .interest-tag-input:checked + .interest-tag-label {
            background: var(--bs-secondary, #db5386);
            border-color: var(--bs-secondary, #db5386); color: #fff;
        }

        /* ── Section dividers ── */
        .section-divider {
            font-size: .7rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: .08em;
            color: #9ca3af; margin: 20px 0 14px;
            display: flex; align-items: center; gap: 8px;
        }
        .section-divider::after { content: ''; flex: 1; height: 1px; background: #f0f0f0; }

        /* ── Save button ── */
        .btn-save {
            padding: 11px 36px;
            background: linear-gradient(135deg, var(--bs-secondary, #db5386), #9333ea);
            color: #fff; border: none; border-radius: 10px;
            font-size: .875rem; font-weight: 600;
            cursor: pointer; transition: opacity .2s, transform .15s;
            display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-save:hover { opacity: .9; transform: translateY(-1px); }

        /* ── Alert banners ── */
        .profile-alert {
            border-radius: 10px; padding: 13px 18px;
            font-size: .85rem; margin-bottom: 20px;
            display: flex; align-items: center; gap: 10px;
        }
        .profile-alert.success { background: #f0fdf4; border: 1px solid #86efac; color: #166534; }
        .profile-alert.error   { background: #fff1f2; border: 1px solid #fecaca; color: #991b1b; }

        /* ── ID document viewer ── */
        .id-doc-viewer {
            border: 1.5px solid #e5e7eb; border-radius: 12px;
            padding: 16px; display: flex; align-items: center;
            gap: 14px; background: #fafafa; flex-wrap: wrap;
        }
        .id-doc-viewer img {
            width: 80px; height: 60px; object-fit: cover;
            border-radius: 8px; border: 1px solid #e5e7eb;
        }
        .id-doc-viewer .doc-info { flex: 1; }
        .id-doc-viewer .doc-info p { font-size: .78rem; color: #6b7280; margin: 0; }
        .id-doc-viewer .doc-info strong { font-size: .85rem; color: #111; }

        /* ── Security form ── */
        .password-toggle {
            position: relative;
        }
        .password-toggle input { padding-right: 44px; }
        .password-toggle button {
            position: absolute; right: 12px; top: 50%;
            transform: translateY(-50%);
            background: none; border: none;
            color: #9ca3af; cursor: pointer; font-size: .85rem;
        }

        /* ── Danger zone ── */
        .danger-zone-card {
            background: #fff; border-radius: 16px;
            border: 1.5px solid #fecaca;
            box-shadow: 0 2px 16px rgba(220,38,38,.06);
            padding: 28px 32px;
        }
        .danger-zone-card .profile-card-title i { background: linear-gradient(135deg, #ef4444, #b91c1c); }
        .btn-danger-outline {
            padding: 10px 24px; border: 1.5px solid #dc2626;
            border-radius: 10px; background: #fff;
            color: #dc2626; font-size: .875rem; font-weight: 600;
            cursor: pointer; transition: all .2s;
            display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-danger-outline:hover { background: #dc2626; color: #fff; }

        /* ── Delete confirm modal ── */
        #deleteAccountModal .modal-content {
            border-radius: 16px; border: none;
            box-shadow: 0 20px 60px rgba(0,0,0,.15);
        }
        #deleteAccountModal .modal-header {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            border-radius: 16px 16px 0 0; border: none;
        }
        #deleteAccountModal .modal-title { color: #fff; font-weight: 700; }

        /* ── Wallet badge ── */
        .wallet-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(255,255,255,.2); border-radius: 999px;
            padding: 4px 14px; font-size: .82rem;
            color: #fff; font-weight: 600;
        }
    </style>
</head>
<body>

@include('components.top-header')
@include('components.header')

@php
    $profile    = $profile ?? null;
    $verStatus  = $profile?->verification_status ?? 'pending';
    $interests  = $profile?->interest_categories ?? [];
    $avatarUrl  = $user->profile_pic
                    ? asset('storage/' . $user->profile_pic)
                    : null;
    $initials   = strtoupper(substr($user->name ?? 'U', 0, 2));

    // Which tab to open — either from session (after error) or default
    $activeTab  = session('active_tab', 'account');
    if ($errors->hasAny(['name','username','email','phone'])) $activeTab = 'account';
    if ($errors->hasAny(['address','zone','city','state','postal_code','country'])) $activeTab = 'address';
    if ($errors->hasAny(['preferred_payment','delivery_preference','purchase_frequency',
                         'avg_order_value','buyer_type','monthly_estimate'])) $activeTab = 'preferences';
    if ($errors->hasAny(['current_password','new_password'])) $activeTab = 'security';
@endphp

<div class="page-wrapper">
    <main class="main-wrapper profile-page">
        <div class="container">

            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb py-2">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active">My Profile</li>
                </ol>
            </nav>

            {{-- ── Hero Banner ── --}}
            <div class="profile-hero">
                {{-- Avatar --}}
                <div class="avatar-wrapper">
                    @if($avatarUrl)
                        <img src="{{ $avatarUrl }}" alt="{{ $user->name }}" class="avatar-img" id="heroAvatar">
                    @else
                        <div class="avatar-placeholder" id="heroAvatar">{{ $initials }}</div>
                    @endif
                    <button type="button" class="avatar-edit-btn"
                            onclick="switchTab('account'); setTimeout(()=>document.getElementById('profile_pic').click(),150)"
                            title="Change photo">
                        <i class="fas fa-camera"></i>
                    </button>
                </div>

                {{-- Info --}}
                <div class="hero-info">
                    <h2>{{ $user->name }}</h2>
                    <p>@{{ $user->username }} &nbsp;·&nbsp; {{ $user->email }}</p>

                    {{-- Verification badge --}}
                    <span class="verify-badge {{ $verStatus }}">
                        <i class="fas fa-{{ $verStatus === 'verified' ? 'check-circle' : ($verStatus === 'rejected' ? 'times-circle' : 'clock') }}"></i>
                        {{ ucfirst($verStatus) }}
                    </span>

                    {{-- Stats --}}
                    <div class="hero-stats">
                        <div class="hero-stat">
                            <div class="val">{{ $user->orders()->count() }}</div>
                            <div class="lbl">Orders</div>
                        </div>
                        <div class="hero-stat">
                            <div class="val">{{ \App\Models\ProductReview::where('user_id', $user->id)->count() }}</div>
                            <div class="lbl">Reviews</div>
                        </div>
                        <div class="hero-stat">
                            <span class="wallet-badge">
                                <i class="fas fa-wallet"></i>
                                ${{ number_format($user->wallet_balance ?? 0, 2) }}
                            </span>
                            <div class="lbl" style="color:rgba(255,255,255,.7);font-size:.65rem;margin-top:2px;">Wallet</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Flash alerts ── --}}
            @if(session('status') === 'profile-updated')
                <div class="profile-alert success">
                    <i class="fas fa-check-circle fa-lg"></i>
                    <div><strong>Saved!</strong> Your changes have been updated successfully.</div>
                </div>
            @endif
            @if(session('status') === 'password-updated')
                <div class="profile-alert success">
                    <i class="fas fa-check-circle fa-lg"></i>
                    <div><strong>Password updated!</strong> Your new password is now active.</div>
                </div>
            @endif

            @if($errors->any())
                <div class="profile-alert error">
                    <i class="fas fa-exclamation-circle fa-lg"></i>
                    <div>
                        <strong>Please fix the following errors:</strong>
                        <ul class="mb-0 mt-1 ps-3">
                            @foreach($errors->all() as $err)
                                <li style="font-size:.8rem;">{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- ── Tabs ── --}}
            <div class="profile-tabs">
                <button class="profile-tab-btn {{ $activeTab === 'account'     ? 'active' : '' }}" onclick="switchTab('account')">
                    <i class="fas fa-user"></i> Account
                </button>
                <button class="profile-tab-btn {{ $activeTab === 'address'     ? 'active' : '' }}" onclick="switchTab('address')">
                    <i class="fas fa-map-marker-alt"></i> Address
                </button>
                <button class="profile-tab-btn {{ $activeTab === 'preferences' ? 'active' : '' }}" onclick="switchTab('preferences')">
                    <i class="fas fa-sliders-h"></i> Preferences
                </button>
                <button class="profile-tab-btn {{ $activeTab === 'security'    ? 'active' : '' }}" onclick="switchTab('security')">
                    <i class="fas fa-lock"></i> Security
                </button>
                <button class="profile-tab-btn {{ $activeTab === 'danger'      ? 'active' : '' }}" onclick="switchTab('danger')">
                    <i class="fas fa-trash-alt"></i> Danger
                </button>
            </div>

            {{-- ════════════════════════════════════════
                 MAIN FORM (wraps Account + Address + Preferences)
            ════════════════════════════════════════ --}}

            {{-- ════════════════════════════════════════
                 TAB: ACCOUNT — form posts to profile.account
            ════════════════════════════════════════ --}}
            <div class="tab-panel {{ $activeTab === 'account' ? 'active' : '' }}" id="panel-account">
                <form method="POST" action="{{ route('profile.account') }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="profile-card">
                        <div class="profile-card-title">
                            <i class="fas fa-user"></i> Account Information
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="name">Full Name</label>
                                <input type="text" id="name" name="name"
                                       value="{{ old('name', $user->name) }}"
                                       class="form-control @error('name') is-invalid @enderror">
                                @error('name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="username">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text"
                                          style="border-radius:10px 0 0 10px;border:1.5px solid #e5e7eb;border-right:none;background:#f5f5f5;color:#9ca3af;font-size:.85rem;">@</span>
                                    <input type="text" id="username" name="username"
                                           value="{{ old('username', $user->username) }}"
                                           class="form-control @error('username') is-invalid @enderror"
                                           style="border-radius:0 10px 10px 0;">
                                </div>
                                @error('username')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="email">Email Address</label>
                                <input type="email" id="email" name="email"
                                       value="{{ old('email', $user->email) }}"
                                       class="form-control @error('email') is-invalid @enderror">
                                @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                @if(!$user->email_verified_at)
                                    <div style="font-size:.72rem;color:#d97706;margin-top:4px;">
                                        <i class="fas fa-exclamation-triangle me-1"></i> Email not verified
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="phone">Phone Number</label>
                                <input type="tel" id="phone" name="phone"
                                       value="{{ old('phone', $user->phone) }}"
                                       class="form-control @error('phone') is-invalid @enderror">
                                @error('phone')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            {{-- Profile photo --}}
                            <div class="col-12">
                                <label class="form-label">Profile Photo</label>
                                <div class="d-flex align-items-center gap-3 flex-wrap">
                                    <div id="avatarPreviewWrap">
                                        @if($avatarUrl)
                                            <img src="{{ $avatarUrl }}" id="avatarPreview"
                                                 style="width:64px;height:64px;border-radius:50%;object-fit:cover;border:2px solid #e5e7eb;">
                                        @else
                                            <div id="avatarPreview"
                                                 style="width:64px;height:64px;border-radius:50%;background:linear-gradient(135deg,var(--bs-secondary,#db5386),#9333ea);display:flex;align-items:center;justify-content:center;font-size:1.2rem;font-weight:700;color:#fff;">
                                                {{ $initials }}
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-outline-secondary btn-sm"
                                            onclick="document.getElementById('profile_pic').click()">
                                        <i class="fas fa-camera me-1"></i> Change Photo
                                    </button>
                                    <span style="font-size:.72rem;color:#9ca3af;">JPEG, PNG, WebP · max 2MB</span>
                                </div>
                                <input type="file" id="profile_pic" name="profile_pic"
                                       accept="image/jpeg,image/png,image/jpg,image/webp"
                                       class="d-none" onchange="previewAvatar(this)">
                                @error('profile_pic')<span class="text-danger d-block mt-1" style="font-size:.75rem;">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn-save">
                                <i class="fas fa-save"></i> Save Account
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- ════════════════════════════════════════
                 TAB: ADDRESS — form posts to profile.address
            ════════════════════════════════════════ --}}
            <div class="tab-panel {{ $activeTab === 'address' ? 'active' : '' }}" id="panel-address">
                <form method="POST" action="{{ route('profile.address') }}">
                    @csrf
                    @method('PATCH')

                    <div class="profile-card">
                        <div class="profile-card-title">
                            <i class="fas fa-map-marker-alt"></i> Address & Location
                        </div>

                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label" for="address">Street Address</label>
                                <input type="text" id="address" name="address"
                                       value="{{ old('address', $profile?->address) }}"
                                       class="form-control @error('address') is-invalid @enderror"
                                       placeholder="House / Apartment / Street">
                                @error('address')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="zone">Zone / Area</label>
                                <input type="text" id="zone" name="zone"
                                       value="{{ old('zone', $profile?->zone) }}"
                                       class="form-control @error('zone') is-invalid @enderror"
                                       placeholder="e.g. Pétion-Ville">
                                @error('zone')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="city">City</label>
                                <input type="text" id="city" name="city"
                                       value="{{ old('city', $profile?->city) }}"
                                       class="form-control @error('city') is-invalid @enderror"
                                       placeholder="e.g. Port-au-Prince">
                                @error('city')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="state">State / Department</label>
                                <input type="text" id="state" name="state"
                                       value="{{ old('state', $profile?->state) }}"
                                       class="form-control"
                                       placeholder="e.g. Ouest">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label" for="postal_code">Postal Code</label>
                                <input type="text" id="postal_code" name="postal_code"
                                       value="{{ old('postal_code', $profile?->postal_code) }}"
                                       class="form-control" placeholder="HT XXXX">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label" for="country">Country</label>
                                <input type="text" id="country" name="country"
                                       value="{{ old('country', $profile?->country ?? 'Haiti') }}"
                                       class="form-control @error('country') is-invalid @enderror">
                                @error('country')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn-save">
                                <i class="fas fa-save"></i> Save Address
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- ════════════════════════════════════════
                 TAB: PREFERENCES — form posts to profile.preferences
            ════════════════════════════════════════ --}}
            <div class="tab-panel {{ $activeTab === 'preferences' ? 'active' : '' }}" id="panel-preferences">
                <form method="POST" action="{{ route('profile.preferences') }}">
                    @csrf
                    @method('PATCH')

                    {{-- Shopping --}}
                    <div class="profile-card">
                        <div class="profile-card-title">
                            <i class="fas fa-shopping-bag"></i> Shopping Preferences
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Preferred Payment Method</label>
                            <div class="option-cards">
                                @foreach($paymentOptions as $val => $label)
                                    <div>
                                        <input type="radio" name="preferred_payment"
                                               id="pay_{{ $val }}" value="{{ $val }}"
                                               class="option-card-input"
                                               {{ old('preferred_payment', $profile?->preferred_payment) == $val ? 'checked' : '' }}>
                                        <label for="pay_{{ $val }}" class="option-card-label">
                                            <i class="fas fa-{{ $val === 'cod' ? 'money-bill-wave' : ($val === 'card' ? 'credit-card' : 'wallet') }}"></i>
                                            {{ $label }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('preferred_payment')
                                <div class="text-danger mt-1" style="font-size:.75rem;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Delivery Preference</label>
                            <div class="option-cards">
                                @foreach($deliveryOptions as $val => $label)
                                    <div>
                                        <input type="radio" name="delivery_preference"
                                               id="del_{{ $val }}" value="{{ $val }}"
                                               class="option-card-input"
                                               {{ old('delivery_preference', $profile?->delivery_preference) == $val ? 'checked' : '' }}>
                                        <label for="del_{{ $val }}" class="option-card-label">
                                            <i class="fas fa-{{ $val === 'fast' ? 'bolt' : 'truck' }}"></i>
                                            {{ $label }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="purchase_frequency">Shopping Frequency</label>
                                <select id="purchase_frequency" name="purchase_frequency"
                                        class="form-select @error('purchase_frequency') is-invalid @enderror">
                                    <option value="">Select</option>
                                    @foreach($frequencyOptions as $val => $label)
                                        <option value="{{ $val }}"
                                            {{ old('purchase_frequency', $profile?->purchase_frequency) == $val ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('purchase_frequency')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="avg_order_value">Average Order Value</label>
                                <select id="avg_order_value" name="avg_order_value"
                                        class="form-select @error('avg_order_value') is-invalid @enderror">
                                    <option value="">Select</option>
                                    @foreach($orderValueOptions as $val => $label)
                                        <option value="{{ $val }}"
                                            {{ old('avg_order_value', $profile?->avg_order_value) == $val ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('avg_order_value')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- Loyalty --}}
                    <div class="profile-card">
                        <div class="profile-card-title">
                            <i class="fas fa-crown"></i> Loyalty & Account Type
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Account Type</label>
                                <div class="option-cards">
                                    <div>
                                        <input type="radio" name="buyer_type" id="type_personal"
                                               value="personal" class="option-card-input"
                                               {{ old('buyer_type', $profile?->buyer_type ?? 'personal') == 'personal' ? 'checked' : '' }}>
                                        <label for="type_personal" class="option-card-label">
                                            <i class="fas fa-user"></i> Personal
                                        </label>
                                    </div>
                                    <div>
                                        <input type="radio" name="buyer_type" id="type_business"
                                               value="business" class="option-card-input"
                                               {{ old('buyer_type', $profile?->buyer_type) == 'business' ? 'checked' : '' }}>
                                        <label for="type_business" class="option-card-label">
                                            <i class="fas fa-building"></i> Business
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="monthly_estimate">Monthly Purchase Estimate</label>
                                <select id="monthly_estimate" name="monthly_estimate"
                                        class="form-select @error('monthly_estimate') is-invalid @enderror">
                                    <option value="">Select</option>
                                    @foreach($monthlyOptions as $val => $label)
                                        <option value="{{ $val }}"
                                            {{ old('monthly_estimate', $profile?->monthly_estimate) == $val ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('monthly_estimate')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="form-label">Interest Categories</label>
                            <div class="interest-tags">
                                @foreach($interestOptions as $val => $label)
                                    <div>
                                        <input type="checkbox" name="interest_categories[]"
                                               id="int_{{ $val }}" value="{{ $val }}"
                                               class="interest-tag-input"
                                               {{ in_array($val, old('interest_categories', $interests)) ? 'checked' : '' }}>
                                        <label for="int_{{ $val }}" class="interest-tag-label">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn-save">
                                <i class="fas fa-save"></i> Save Preferences
                            </button>
                        </div>
                    </div>

                    {{-- ID document viewer (read-only) --}}
                    @if($profile?->id_document)
                    <div class="profile-card">
                        <div class="profile-card-title">
                            <i class="fas fa-id-card"></i> Identity Verification
                        </div>
                        <div class="id-doc-viewer">
                            @php $ext = pathinfo($profile->id_document, PATHINFO_EXTENSION); @endphp
                            @if(in_array(strtolower($ext), ['jpg','jpeg','png','webp']))
                                <img src="{{ asset('storage/' . $profile->id_document) }}" alt="ID Document">
                            @else
                                <div style="width:80px;height:60px;border-radius:8px;background:#fee2e2;display:flex;align-items:center;justify-content:center;">
                                    <i class="fas fa-file-pdf" style="color:#dc2626;font-size:1.5rem;"></i>
                                </div>
                            @endif
                            <div class="doc-info">
                                <strong>{{ $idTypeOptions[$profile->id_type] ?? ucfirst($profile->id_type ?? '') }}</strong>
                                <p>Status:
                                    <span class="verify-badge {{ $verStatus }}" style="font-size:.7rem;padding:2px 8px;">
                                        {{ ucfirst($verStatus) }}
                                    </span>
                                </p>
                                @if($profile->verified_at)
                                    <p>Verified: {{ $profile->verified_at->format('d M Y') }}</p>
                                @endif
                            </div>
                            <a href="{{ asset('storage/' . $profile->id_document) }}"
                               target="_blank" rel="noopener"
                               class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-external-link-alt me-1"></i> View
                            </a>
                        </div>
                    </div>
                    @endif

                </form>
            </div>

            {{-- ════════════════════════════════════════
                 TAB: SECURITY — form posts to profile.password
            ════════════════════════════════════════ --}}
            <div class="tab-panel {{ $activeTab === 'security' ? 'active' : '' }}" id="panel-security">
                <div class="profile-card">
                    <div class="profile-card-title">
                        <i class="fas fa-lock"></i> Change Password
                    </div>

                    <form method="POST" action="{{ route('profile.password') }}">
                        @csrf
                        @method('PATCH')

                        <div class="row g-3" style="max-width:480px;">
                            <div class="col-12">
                                <label class="form-label" for="current_password">Current Password</label>
                                <div class="password-toggle">
                                    <input type="password" id="current_password" name="current_password"
                                           class="form-control @error('current_password') is-invalid @enderror"
                                           placeholder="Enter current password">
                                    <button type="button" onclick="togglePw('current_password', this)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('current_password')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label" for="new_password">New Password</label>
                                <div class="password-toggle">
                                    <input type="password" id="new_password" name="new_password"
                                           class="form-control @error('new_password') is-invalid @enderror"
                                           placeholder="Min. 8 characters"
                                           oninput="checkStrength(this.value)">
                                    <button type="button" onclick="togglePw('new_password', this)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div style="height:4px;border-radius:99px;background:#f0f0f0;margin-top:6px;overflow:hidden;">
                                    <div id="strengthBar" style="height:100%;border-radius:99px;width:0;transition:width .3s,background .3s;"></div>
                                </div>
                                <div id="strengthLabel" style="font-size:.72rem;margin-top:3px;font-weight:500;"></div>
                                @error('new_password')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label" for="new_password_confirmation">Confirm New Password</label>
                                <div class="password-toggle">
                                    <input type="password" id="new_password_confirmation"
                                           name="new_password_confirmation"
                                           class="form-control"
                                           placeholder="Re-enter new password">
                                    <button type="button" onclick="togglePw('new_password_confirmation', this)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn-save">
                                <i class="fas fa-key"></i> Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- ════════════════════════════════════════
                 TAB: DANGER ZONE
            ════════════════════════════════════════ --}}
            <div class="tab-panel {{ $activeTab === 'danger' ? 'active' : '' }}" id="panel-danger">
                <div class="danger-zone-card">
                    <div class="profile-card-title">
                        <i class="fas fa-trash-alt"></i> Danger Zone
                    </div>
                    <p style="font-size:.875rem;color:#6b7280;margin-bottom:20px;">
                        Once you delete your account, all your data including orders, reviews, and profile
                        will be <strong>permanently removed</strong>. This action cannot be undone.
                    </p>
                    <button type="button" class="btn-danger-outline"
                            data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                        <i class="fas fa-trash-alt"></i> Delete My Account
                    </button>
                </div>
            </div>

        </div>{{-- end container --}}
    </main>
</div>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body py-4">
                <div class="text-center mb-4">
                    <i class="fas fa-exclamation-triangle fa-2x text-warning mb-2 d-block"></i>
                    <p class="fw-semibold mb-1">Are you absolutely sure?</p>
                    <p class="text-muted" style="font-size:.85rem;">
                        This will permanently delete your account and all associated data.
                    </p>
                </div>
                <form method="POST" action="{{ route('profile.destroy') }}" id="deleteAccountForm">
                    @csrf
                    @method('DELETE')
                    <label class="form-label fw-semibold" for="delete_password">
                        Enter your password to confirm
                    </label>
                    <input type="password" name="password" id="delete_password"
                           class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                           placeholder="Your current password">
                    @error('password', 'userDeletion')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </form>
            </div>
            <div class="modal-footer border-0 justify-content-center gap-3">
                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="deleteAccountForm" class="btn btn-danger px-4">
                    <i class="fas fa-trash-alt me-1"></i> Yes, Delete My Account
                </button>
            </div>
        </div>
    </div>
</div>

@include('components.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/mobile.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
/* ── Tab switching ── */
function switchTab(tab) {
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.profile-tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('panel-' + tab).classList.add('active');
    document.querySelector(`[onclick="switchTab('${tab}')"]`).classList.add('active');
    // Remember tab in URL hash (no reload)
    history.replaceState(null, '', '#' + tab);
}

// Restore tab from URL hash on load
document.addEventListener('DOMContentLoaded', () => {
    const hash = window.location.hash.replace('#', '');
    const validTabs = ['account', 'address', 'preferences', 'security', 'danger'];
    if (hash && validTabs.includes(hash)) switchTab(hash);
});

/* ── Avatar preview ── */
function previewAvatar(input) {
    if (!input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
        const src = e.target.result;

        // Update hero avatar
        const heroAvatar = document.getElementById('heroAvatar');
        if (heroAvatar.tagName === 'IMG') {
            heroAvatar.src = src;
        } else {
            const img = document.createElement('img');
            img.src = src; img.className = 'avatar-img'; img.id = 'heroAvatar';
            heroAvatar.replaceWith(img);
        }

        // Update profile tab preview
        const preview = document.getElementById('avatarPreview');
        if (preview) {
            if (preview.tagName === 'IMG') {
                preview.src = src;
            } else {
                const img = document.createElement('img');
                img.src = src; img.id = 'avatarPreview';
                img.style.cssText = 'width:64px;height:64px;border-radius:50%;object-fit:cover;border:2px solid #e5e7eb;';
                preview.replaceWith(img);
            }
        }
    };
    reader.readAsDataURL(input.files[0]);
}

/* ── Password toggle ── */
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

/* ── Password strength ── */
function checkStrength(pw) {
    let score = 0;
    if (pw.length >= 8)          score++;
    if (/[A-Z]/.test(pw))        score++;
    if (/[0-9]/.test(pw))        score++;
    if (/[^A-Za-z0-9]/.test(pw)) score++;

    const bar   = document.getElementById('strengthBar');
    const label = document.getElementById('strengthLabel');
    const lvl   = [
        { w: '0%',   bg: '',         text: '',           color: '' },
        { w: '25%',  bg: '#ef4444',  text: 'Weak',       color: '#ef4444' },
        { w: '50%',  bg: '#f97316',  text: 'Fair',       color: '#f97316' },
        { w: '75%',  bg: '#eab308',  text: 'Good',       color: '#eab308' },
        { w: '100%', bg: '#22c55e',  text: 'Strong 💪',  color: '#22c55e' },
    ][score];
    bar.style.width      = lvl.w;
    bar.style.background = lvl.bg;
    label.textContent    = lvl.text;
    label.style.color    = lvl.color;
}

/* ── Auto-open delete modal if userDeletion errors ── */
@error('password', 'userDeletion')
    document.addEventListener('DOMContentLoaded', () => {
        new bootstrap.Modal(document.getElementById('deleteAccountModal')).show();
        switchTab('danger');
    });
@enderror
</script>
</body>
</html>