{{-- resources/views/seller/profile/profile.blade.php --}}

@php
    $seller = Auth::guard('seller')->user();

    $statusConfig = [
        'pending'  => ['label' => 'Pending Review', 'icon' => '🕐', 'bg' => 'rgba(245,158,11,.10)', 'fg' => '#92680a',  'border' => 'rgba(245,158,11,.25)'],
        'approved' => ['label' => 'Approved',        'icon' => '✅', 'bg' => 'rgba(34,196,122,.10)', 'fg' => '#0d9a5e',  'border' => 'rgba(34,196,122,.25)'],
        'rejected' => ['label' => 'Rejected',        'icon' => '❌', 'bg' => 'rgba(244,63,94,.10)',  'fg' => '#c0213a',  'border' => 'rgba(244,63,94,.25)'],
    ];
    $sc = $statusConfig[$seller->status] ?? $statusConfig['pending'];

    $snLabels = [
        'has_sn'        => 'Has Serial Number',
        'has_lot'       => 'Has Lot Number',
        'auto_generate' => 'Auto Generate',
    ];

    $agreements = [
        ['field' => 'agreed_video_before_shipping', 'label' => 'Record video before shipping'],
        ['field' => 'agreed_qr_otp_validation',     'label' => 'QR / OTP order validation'],
        ['field' => 'agreed_returns_48hrs',          'label' => 'Process returns within 48 hrs'],
        ['field' => 'agreed_insurance_fund',         'label' => 'Contribute to insurance fund'],
        ['field' => 'agreed_rating_penalty',         'label' => 'Accept rating penalty policy'],
        ['field' => 'agreed_to_terms',               'label' => 'Agreed to platform terms'],
    ];
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile — {{ $seller->shop_name ?? $seller->name }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    @include('seller.partials._base')
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #f0f2f7;
            --surface:   #ffffff;
            --card:      #ffffff;
            --border:    #e4e7ef;
            --border2:   #d1d5e0;
            --muted:     #e8eaf0;
            --text:      #1a1d28;
            --sub:       #7a82a0;
            --accent:    #5b7cfa;
            --accent2:   #22c47a;
            --accent3:   #f59e0b;
            --danger:    #f43f5e;
            --purple:    #8b5cf6;
            --font:      'DM Sans', sans-serif;
            --mono:      'DM Mono', monospace;
            --radius:    14px;
            --sidebar-w: 240px;
            --header-h:  64px;
            --shadow:    0 1px 4px rgba(0,0,0,.06), 0 4px 16px rgba(0,0,0,.04);
            --shadow-md: 0 2px 8px rgba(0,0,0,.08), 0 8px 24px rgba(0,0,0,.06);
        }

        html, body { height: 100%; background: var(--bg); color: var(--text); font-family: var(--font); font-size: 14px; }

        /* ── LAYOUT ── */
        .layout { display: grid; grid-template-columns: var(--sidebar-w) 1fr; grid-template-rows: var(--header-h) 1fr; min-height: 100vh; }

        /* ── SIDEBAR ── */
        .sidebar {
            grid-row: 1 / -1;
            background: var(--surface); border-right: 1px solid var(--border);
            display: flex; flex-direction: column;
            position: sticky; top: 0; height: 100vh;
        }
        .sidebar-logo {
            height: var(--header-h);
            display: flex; align-items: center; gap: 10px;
            padding: 0 20px; border-bottom: 1px solid var(--border);
            font-weight: 700; font-size: 15px; letter-spacing: -.3px; color: var(--text);
        }
        .sidebar-logo .logo-icon {
            width: 32px; height: 32px; border-radius: 8px;
            background: linear-gradient(135deg, var(--accent), #8b5cf6);
            display: flex; align-items: center; justify-content: center; font-size: 16px;
        }
        .sidebar-nav { flex: 1; padding: 16px 12px; display: flex; flex-direction: column; gap: 2px; overflow-y: auto; }
        .nav-section-label { font-size: 10px; font-weight: 700; letter-spacing: 1.2px; color: var(--sub); text-transform: uppercase; padding: 12px 8px 6px; }
        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 12px; border-radius: 9px;
            color: var(--sub); text-decoration: none; font-size: 13.5px; font-weight: 500;
            transition: all .15s;
        }
        .nav-item:hover { background: var(--bg); color: var(--text); }
        .nav-item.active { background: rgba(91,124,250,.10); color: var(--accent); }
        .nav-item .icon { width: 18px; text-align: center; font-size: 15px; }
        .sidebar-footer { padding: 16px 12px; border-top: 1px solid var(--border); }
        .seller-card {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px; border-radius: 10px;
            background: var(--bg); border: 1px solid var(--border);
        }
        .s-avatar {
            width: 34px; height: 34px; border-radius: 50%;
            background: linear-gradient(135deg, var(--accent2), var(--accent));
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 13px; color: #fff; flex-shrink: 0;
        }
        .seller-card .info { flex: 1; min-width: 0; }
        .seller-card .info .sname { font-size: 13px; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: var(--text); }
        .seller-card .info .srole { font-size: 11px; color: var(--sub); }
        .status-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--accent2); flex-shrink: 0; box-shadow: 0 0 6px var(--accent2); }

        /* ── HEADER ── */
        .header {
            grid-column: 2; height: var(--header-h);
            background: var(--surface); border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 28px; position: sticky; top: 0; z-index: 10;
        }
        .breadcrumb { display: flex; align-items: center; gap: 6px; font-size: 13px; color: var(--sub); }
        .breadcrumb a { color: var(--sub); text-decoration: none; transition: color .15s; }
        .breadcrumb a:hover { color: var(--accent); }
        .breadcrumb .sep { opacity: .4; }
        .breadcrumb .current { color: var(--text); font-weight: 600; }
        .header-right { display: flex; align-items: center; gap: 10px; }

        /* ── BUTTONS ── */
        .btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 16px; border-radius: 9px; font-size: 13px; font-weight: 600;
            cursor: pointer; transition: all .15s; text-decoration: none; border: none; font-family: var(--font);
        }
        .btn-primary { background: var(--accent); color: #fff; box-shadow: 0 2px 8px rgba(91,124,250,.3); }
        .btn-primary:hover { opacity: .88; transform: translateY(-1px); }
        .btn-ghost { background: var(--bg); color: var(--text); border: 1px solid var(--border); }
        .btn-ghost:hover { border-color: var(--border2); box-shadow: var(--shadow); }
        .btn-danger { background: rgba(244,63,94,.10); color: var(--danger); border: 1px solid rgba(244,63,94,.25); }
        .btn-danger:hover { background: rgba(244,63,94,.18); }
        .btn-lg { padding: 11px 24px; font-size: 14px; }

        /* ── MAIN ── */
        .main { grid-column: 2; padding: 28px; overflow-y: auto; }

        /* ── FLASH ── */
        .flash {
            padding: 13px 18px; border-radius: 10px; font-size: 13px;
            margin-bottom: 22px; display: flex; align-items: center; gap: 10px;
            animation: fadeUp .3s ease both;
        }
        .flash-success { background: rgba(34,196,122,.08); border: 1px solid rgba(34,196,122,.25); color: #0d9a5e; }
        .flash-error   { background: rgba(244,63,94,.07);  border: 1px solid rgba(244,63,94,.2);  color: #c0213a; }

        /* ── PROFILE HERO ── */
        .profile-hero {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: var(--radius); box-shadow: var(--shadow);
            padding: 28px; margin-bottom: 22px;
            display: flex; align-items: center; justify-content: space-between; gap: 24px;
            position: relative; overflow: hidden;
            animation: fadeUp .35s ease both;
        }
        .profile-hero::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 4px;
            background: linear-gradient(90deg, var(--accent), var(--purple), var(--accent2));
        }
        .profile-hero-left { display: flex; align-items: center; gap: 20px; }
        .hero-avatar {
            width: 72px; height: 72px; border-radius: 20px;
            background: linear-gradient(135deg, var(--accent), var(--purple));
            display: flex; align-items: center; justify-content: center;
            font-size: 28px; font-weight: 700; color: #fff; flex-shrink: 0;
            box-shadow: 0 4px 16px rgba(91,124,250,.3);
        }
        .hero-name  { font-size: 20px; font-weight: 700; color: var(--text); margin-bottom: 4px; }
        .hero-meta  { display: flex; align-items: center; flex-wrap: wrap; gap: 10px; }
        .hero-chip {
            display: inline-flex; align-items: center; gap: 5px;
            font-size: 12px; font-weight: 600; padding: 4px 10px;
            border-radius: 20px; background: var(--bg); border: 1px solid var(--border); color: var(--sub);
        }
        .hero-chip.verified { background: rgba(34,196,122,.08); border-color: rgba(34,196,122,.25); color: #0d9a5e; }
        .hero-chip.unverified { background: rgba(244,63,94,.08); border-color: rgba(244,63,94,.2); color: var(--danger); }
        .hero-stats { display: flex; gap: 28px; flex-shrink: 0; }
        .hero-stat { text-align: center; }
        .hero-stat-val { font-size: 22px; font-weight: 700; color: var(--text); font-family: var(--mono); }
        .hero-stat-label { font-size: 11.5px; color: var(--sub); margin-top: 2px; font-weight: 500; }
        .hero-stat-divider { width: 1px; background: var(--border); align-self: stretch; }
        .status-pill {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 11.5px; font-weight: 700; padding: 5px 12px;
            border-radius: 20px; border: 1px solid;
        }
        .status-pill-dot { width: 7px; height: 7px; border-radius: 50%; }

        /* ── TABS ── */
        .tabs { display: flex; gap: 4px; margin-bottom: 22px; }
        .tab {
            padding: 8px 18px; border-radius: 9px; font-size: 13px; font-weight: 600;
            cursor: pointer; transition: all .15s; color: var(--sub);
            border: 1px solid transparent; background: none;
            font-family: var(--font); display: flex; align-items: center; gap: 6px;
        }
        .tab:hover { background: var(--surface); color: var(--text); border-color: var(--border); }
        .tab.active { background: var(--surface); color: var(--accent); border-color: var(--border); box-shadow: var(--shadow); }
        .tab-panel { display: none; }
        .tab-panel.active { display: block; }

        /* ── CONTENT GRID ── */
        .form-grid { display: grid; grid-template-columns: 1fr 300px; gap: 20px; align-items: start; }

        /* ── CARD ── */
        .card {
            background: var(--card); border: 1px solid var(--border);
            border-radius: var(--radius); box-shadow: var(--shadow);
            margin-bottom: 18px; overflow: hidden;
            animation: fadeUp .35s ease both;
        }
        .card-header {
            display: flex; align-items: center; gap: 10px;
            padding: 16px 22px; border-bottom: 1px solid var(--border);
        }
        .card-header-icon { font-size: 15px; }
        .card-header-title { font-size: 13.5px; font-weight: 700; color: var(--text); }
        .card-header-action { margin-left: auto; }
        .card-body { padding: 22px; }

        /* ── FORM FIELDS ── */
        .field { margin-bottom: 18px; }
        .field:last-child { margin-bottom: 0; }
        .field-row { display: grid; gap: 16px; margin-bottom: 18px; }
        .field-row.cols-2 { grid-template-columns: 1fr 1fr; }
        .field-row.cols-3 { grid-template-columns: 1fr 1fr 1fr; }

        label.field-label {
            display: block; font-size: 11px; font-weight: 700;
            color: var(--sub); text-transform: uppercase; letter-spacing: .6px;
            margin-bottom: 7px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"],
        select,
        textarea {
            width: 100%; padding: 9px 12px;
            border: 1.5px solid var(--border); border-radius: 9px;
            font-family: var(--font); font-size: 13.5px; color: var(--text);
            background: var(--surface); outline: none;
            transition: border-color .15s, box-shadow .15s;
            -webkit-appearance: none;
        }
        input:focus, select:focus, textarea:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(91,124,250,.12);
        }
        input.is-invalid, textarea.is-invalid {
            border-color: var(--danger);
        }
        input.is-invalid:focus { box-shadow: 0 0 0 3px rgba(244,63,94,.12); }
        textarea { resize: vertical; min-height: 90px; line-height: 1.6; }
        select { cursor: pointer; }
        .invalid-msg { font-size: 11.5px; color: var(--danger); margin-top: 5px; font-weight: 500; }
        .field-hint { font-size: 11.5px; color: var(--sub); margin-top: 5px; }
        input[readonly], input[disabled] { background: var(--muted); color: var(--sub); cursor: not-allowed; }

        /* ── TOGGLE ── */
        .toggle-row {
            display: flex; align-items: center; justify-content: space-between;
            padding: 12px 0; border-bottom: 1px solid var(--border);
        }
        .toggle-row:last-child { border-bottom: none; }
        .toggle-name { font-size: 13px; font-weight: 600; color: var(--text); display: flex; align-items: center; gap: 7px; }
        .toggle-desc { font-size: 11.5px; color: var(--sub); margin-top: 2px; }
        .toggle-switch { position: relative; flex-shrink: 0; }
        .toggle-switch input[type="checkbox"] { position: absolute; opacity: 0; width: 0; height: 0; }
        .toggle-track {
            display: block; width: 42px; height: 24px; border-radius: 20px;
            background: var(--border2); cursor: pointer; transition: background .2s; position: relative;
        }
        .toggle-track::after {
            content: ''; position: absolute; top: 3px; left: 3px;
            width: 18px; height: 18px; border-radius: 50%;
            background: #fff; transition: transform .2s;
            box-shadow: 0 1px 3px rgba(0,0,0,.2);
        }
        .toggle-switch input:checked + .toggle-track { background: var(--accent2); }
        .toggle-switch input:checked + .toggle-track::after { transform: translateX(18px); }
        .toggle-switch input:disabled + .toggle-track { opacity: .55; cursor: not-allowed; }

        /* ── CATEGORIES TAG INPUT ── */
        .tag-input-wrap {
            border: 1.5px solid var(--border); border-radius: 9px; padding: 8px 10px;
            display: flex; flex-wrap: wrap; gap: 6px; min-height: 44px; cursor: text;
            background: var(--surface); transition: border-color .15s, box-shadow .15s;
        }
        .tag-input-wrap:focus-within {
            border-color: var(--accent); box-shadow: 0 0 0 3px rgba(91,124,250,.12);
        }
        .tag {
            display: inline-flex; align-items: center; gap: 5px;
            background: rgba(91,124,250,.10); color: var(--accent);
            border: 1px solid rgba(91,124,250,.2); border-radius: 6px;
            font-size: 12.5px; font-weight: 600; padding: 3px 9px;
        }
        .tag-remove {
            cursor: pointer; color: var(--accent); font-size: 13px; line-height: 1;
            border: none; background: none; padding: 0; font-family: var(--font); font-weight: 700;
        }
        .tag-remove:hover { color: var(--danger); }
        .tag-input {
            border: none; outline: none; flex: 1; min-width: 120px;
            font-family: var(--font); font-size: 13px; color: var(--text); background: transparent;
            padding: 2px 4px;
        }

        /* ── PASSWORD STRENGTH ── */
        .pw-strength-bar {
            height: 4px; border-radius: 10px; background: var(--muted);
            overflow: hidden; margin-top: 7px;
        }
        .pw-strength-fill {
            height: 100%; border-radius: 10px; width: 0%; transition: width .3s, background .3s;
        }
        .pw-strength-label { font-size: 11px; color: var(--sub); margin-top: 4px; text-align: right; }

        /* ── DETAIL READ-ONLY LIST ── */
        .info-list { display: flex; flex-direction: column; }
        .info-row {
            display: flex; align-items: center; justify-content: space-between;
            padding: 12px 0; border-bottom: 1px solid var(--border); gap: 16px;
        }
        .info-row:last-child { border-bottom: none; }
        .info-label { font-size: 11.5px; font-weight: 700; color: var(--sub); text-transform: uppercase; letter-spacing: .6px; }
        .info-value { font-size: 13.5px; font-weight: 600; color: var(--text); text-align: right; }
        .info-value.mono { font-family: var(--mono); font-size: 12.5px; }
        .info-value.muted { color: var(--sub); font-style: italic; font-weight: 400; }

        /* ── AGREEMENT CHECK ── */
        .agreement-item {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 12px; border-radius: 9px; margin-bottom: 6px;
        }
        .agreement-item:last-child { margin-bottom: 0; }
        .agreement-item.agreed { background: rgba(34,196,122,.06); border: 1px solid rgba(34,196,122,.2); }
        .agreement-item.not-agreed { background: rgba(244,63,94,.04); border: 1px solid rgba(244,63,94,.12); }
        .agreement-check { font-size: 16px; flex-shrink: 0; }
        .agreement-label { font-size: 13px; font-weight: 500; color: var(--text); }

        /* ── DIVIDER ── */
        .divider { border: none; border-top: 1px solid var(--border); margin: 20px 0; }

        /* ── STICKY ── */
        .sticky-sidebar { position: sticky; top: calc(var(--header-h) + 20px); }

        /* ── ANIMATION ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
<div class="layout">

    {{-- ── SIDEBAR ── --}}
     @include('seller.partials._sidebar', ['active' => 'profile'])
    {{-- ── HEADER ── --}}
    <header class="header">
        <div class="breadcrumb">
            <a href="{{ route('seller.dashboard') }}">Dashboard</a>
            <span class="sep">›</span>
            <span class="current">My Profile</span>
        </div>
        <div class="header-right">
            <button type="submit" form="profileForm" class="btn btn-primary">✓ Save Changes</button>
        </div>
    </header>

    {{-- ── MAIN ── --}}
    <main class="main">

        {{-- FLASH --}}
        @if(session('success'))
            <div class="flash flash-success">✅ &nbsp;{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="flash flash-error">
                ⚠️ &nbsp;<strong>Fix errors below:</strong> &nbsp;{{ $errors->first() }}
            </div>
        @endif

        {{-- PROFILE HERO --}}
        <div class="profile-hero">
            <div class="profile-hero-left">
                <div class="hero-avatar">{{ strtoupper(substr($seller->shop_name ?? $seller->name, 0, 1)) }}</div>
                <div>
                    <div class="hero-name">{{ $seller->shop_name ?? $seller->name }}</div>
                    <div class="hero-meta">
                        <span class="hero-chip">👤 {{ $seller->name }}</span>
                        <span class="hero-chip">📧 {{ $seller->email }}</span>
                        @if($seller->username)
                            <span class="hero-chip" style="font-family:var(--mono);">@{{ $seller->username }}</span>
                        @endif
                        <span class="hero-chip {{ $seller->is_verified ? 'verified' : 'unverified' }}">
                            {{ $seller->is_verified ? '✅ Verified' : '⚠️ Unverified' }}
                        </span>
                        <span class="status-pill"
                              style="background:{{ $sc['bg'] }}; color:{{ $sc['fg'] }}; border-color:{{ $sc['border'] }};">
                            <span class="status-pill-dot" style="background:{{ $sc['fg'] }};"></span>
                            {{ $sc['label'] }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="hero-stats">
                <div class="hero-stat">
                    <div class="hero-stat-val">{{ $seller->products_count ?? 0 }}</div>
                    <div class="hero-stat-label">Products</div>
                </div>
                <div class="hero-stat-divider"></div>
                <div class="hero-stat">
                    <div class="hero-stat-val">{{ $seller->payment_method === 'bank' ? '🏦' : '👛' }}</div>
                    <div class="hero-stat-label">{{ ucfirst($seller->payment_method ?? 'Not set') }}</div>
                </div>
                <div class="hero-stat-divider"></div>
                <div class="hero-stat">
                    <div class="hero-stat-val">{{ $seller->accepts_cod ? 'Yes' : 'No' }}</div>
                    <div class="hero-stat-label">Accepts COD</div>
                </div>
            </div>
        </div>

        {{-- TABS --}}
        <div class="tabs">
            <button class="tab active" onclick="switchTab('general', this)">🧑 General Info</button>
            <button class="tab" onclick="switchTab('shop', this)">🏪 Shop Details</button>
            <button class="tab" onclick="switchTab('security', this)">🔒 Password</button>
            <button class="tab" onclick="switchTab('agreements', this)">📋 Agreements</button>
        </div>

        <form method="POST" action="{{ route('seller.profile.update') }}" id="profileForm">
            @csrf
            @method('PUT')

            {{-- ══════════════════════════════════════
                 TAB 1 — GENERAL INFO
            ══════════════════════════════════════ --}}
            <div id="tab-general" class="tab-panel active">
                <div class="form-grid">
                    <div>
                        {{-- Personal Info --}}
                        <div class="card">
                            <div class="card-header">
                                <span class="card-header-icon">🧑</span>
                                <span class="card-header-title">Personal Information</span>
                            </div>
                            <div class="card-body">
                                <div class="field-row cols-2">
                                    <div>
                                        <label class="field-label">Full Name <span style="color:var(--danger)">*</span></label>
                                        <input type="text" name="name"
                                               value="{{ old('name', $seller->name) }}"
                                               placeholder="Your full name"
                                               class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                                               required>
                                        @error('name')<div class="invalid-msg">{{ $message }}</div>@enderror
                                    </div>
                                    <div>
                                        <label class="field-label">Username</label>
                                        <input type="text" value="{{ $seller->username ?? '—' }}" readonly>
                                        <div class="field-hint">Username cannot be changed</div>
                                    </div>
                                </div>
                                <div class="field-row cols-2">
                                    <div>
                                        <label class="field-label">Email Address <span style="color:var(--danger)">*</span></label>
                                        <input type="email" name="email"
                                               value="{{ old('email', $seller->email) }}"
                                               placeholder="you@example.com"
                                               class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                                               required>
                                        @error('email')<div class="invalid-msg">{{ $message }}</div>@enderror
                                    </div>
                                    <div>
                                        <label class="field-label">Phone Number <span style="color:var(--danger)">*</span></label>
                                        <input type="tel" name="phone"
                                               value="{{ old('phone', $seller->phone) }}"
                                               placeholder="+234 800 000 0000"
                                               class="{{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                               required>
                                        @error('phone')<div class="invalid-msg">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="field-row cols-2">
                                    <div>
                                        <label class="field-label">GST Number</label>
                                        <input type="text" name="gst_number"
                                               value="{{ old('gst_number', $seller->gst_number) }}"
                                               placeholder="GST / VAT number"
                                               style="font-family:var(--mono); font-size:13px;"
                                               class="{{ $errors->has('gst_number') ? 'is-invalid' : '' }}">
                                        @error('gst_number')<div class="invalid-msg">{{ $message }}</div>@enderror
                                    </div>
                                    <div>
                                        <label class="field-label">PAN Number</label>
                                        <input type="text" name="pan_number"
                                               value="{{ old('pan_number', $seller->pan_number) }}"
                                               placeholder="PAN / Tax ID"
                                               style="font-family:var(--mono); font-size:13px;"
                                               class="{{ $errors->has('pan_number') ? 'is-invalid' : '' }}">
                                        @error('pan_number')<div class="invalid-msg">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div>
                                    <label class="field-label">National ID</label>
                                    <input type="text" value="{{ $seller->national_id ?? '—' }}" readonly>
                                    <div class="field-hint">Contact support to update your National ID</div>
                                </div>
                            </div>
                        </div>

                        {{-- Operational Settings --}}
                        <div class="card">
                            <div class="card-header">
                                <span class="card-header-icon">⚙️</span>
                                <span class="card-header-title">Operational Settings</span>
                            </div>
                            <div class="card-body">
                                <div class="field-row cols-3">
                                    <div>
                                        <label class="field-label">Serial Number Type</label>
                                        <select name="serial_number_type">
                                            <option value="">— Select —</option>
                                            <option value="has_sn" @selected(old('serial_number_type', $seller->serial_number_type) === 'has_sn')>Has Serial No.</option>
                                            <option value="has_lot" @selected(old('serial_number_type', $seller->serial_number_type) === 'has_lot')>Has Lot No.</option>
                                            <option value="auto_generate" @selected(old('serial_number_type', $seller->serial_number_type) === 'auto_generate')>Auto Generate</option>
                                        </select>
                                        @error('serial_number_type')<div class="invalid-msg">{{ $message }}</div>@enderror
                                    </div>
                                    <div>
                                        <label class="field-label">Payment Method</label>
                                        <select name="payment_method">
                                            <option value="">— Select —</option>
                                            <option value="bank" @selected(old('payment_method', $seller->payment_method) === 'bank')>🏦 Bank Transfer</option>
                                            <option value="wallet" @selected(old('payment_method', $seller->payment_method) === 'wallet')>👛 Wallet</option>
                                        </select>
                                        @error('payment_method')<div class="invalid-msg">{{ $message }}</div>@enderror
                                    </div>
                                    <div style="display:flex; flex-direction:column; justify-content:flex-end;">
                                        <label class="field-label">Cash on Delivery</label>
                                        <div class="toggle-row" style="border:none; padding:0;">
                                            <div>
                                                <div class="toggle-name" style="font-size:13.5px;">Accept COD</div>
                                                <div class="toggle-desc">Allow pay-on-delivery orders</div>
                                            </div>
                                            <label class="toggle-switch" style="margin-left:12px;">
                                                <input type="checkbox" name="accepts_cod" value="1"
                                                       @checked(old('accepts_cod', $seller->accepts_cod))>
                                                <span class="toggle-track"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- RIGHT SIDEBAR --}}
                    <div class="sticky-sidebar">
                        {{-- Save Card --}}
                        <div class="card">
                            <div class="card-body" style="display:flex; flex-direction:column; gap:10px;">
                                <button type="submit" form="profileForm" class="btn btn-primary btn-lg" style="width:100%; justify-content:center;">
                                    ✓ &nbsp;Save Changes
                                </button>
                                <a href="{{ route('seller.dashboard') }}" class="btn btn-ghost" style="width:100%; justify-content:center;">
                                    ← &nbsp;Back to Dashboard
                                </a>
                            </div>
                        </div>

                        {{-- Account Status --}}
                        <div class="card">
                            <div class="card-header">
                                <span class="card-header-icon">🔍</span>
                                <span class="card-header-title">Account Status</span>
                            </div>
                            <div class="card-body" style="padding-top:6px; padding-bottom:6px;">
                                <div class="info-list">
                                    <div class="info-row">
                                        <span class="info-label">Status</span>
                                        <span class="info-value">
                                            <span style="display:inline-flex; align-items:center; gap:5px; font-size:12.5px; font-weight:700; padding:3px 10px; border-radius:20px; background:{{ $sc['bg'] }}; color:{{ $sc['fg'] }}; border:1px solid {{ $sc['border'] }};">
                                                {{ $sc['icon'] }} {{ $sc['label'] }}
                                            </span>
                                        </span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Verified</span>
                                        <span class="info-value">
                                            @if($seller->is_verified)
                                                <span style="color:#0d9a5e; font-weight:700;">✅ Yes</span>
                                            @else
                                                <span style="color:var(--danger); font-weight:700;">❌ No</span>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Phone Verified</span>
                                        <span class="info-value {{ $seller->phone_verified_at ? '' : 'muted' }}">
                                            {{ $seller->phone_verified_at ? \Carbon\Carbon::parse($seller->phone_verified_at)->format('M d, Y') : 'Not verified' }}
                                        </span>
                                    </div>
                                    <div class="info-row" style="border-bottom:none;">
                                        <span class="info-label">Member Since</span>
                                        <span class="info-value">{{ $seller->created_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Product Categories Quick View --}}
                        @if(!empty($seller->product_categories))
                        <div class="card">
                            <div class="card-header">
                                <span class="card-header-icon">🗂️</span>
                                <span class="card-header-title">Your Categories</span>
                            </div>
                            <div class="card-body">
                                <div style="display:flex; flex-wrap:wrap; gap:6px;">
                                    @foreach($seller->product_categories as $cat)
                                    <span style="display:inline-flex; align-items:center; font-size:12px; font-weight:600; padding:4px 10px; border-radius:20px; background:rgba(91,124,250,.08); color:var(--accent); border:1px solid rgba(91,124,250,.2);">
                                        {{ $cat }}
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════════════
                 TAB 2 — SHOP DETAILS
            ══════════════════════════════════════ --}}
            <div id="tab-shop" class="tab-panel">
                <div class="form-grid">
                    <div>
                        <div class="card">
                            <div class="card-header">
                                <span class="card-header-icon">🏪</span>
                                <span class="card-header-title">Shop Information</span>
                            </div>
                            <div class="card-body">
                                <div class="field-row cols-2">
                                    <div>
                                        <label class="field-label">Shop Name</label>
                                        <input type="text" name="shop_name"
                                               value="{{ old('shop_name', $seller->shop_name) }}"
                                               placeholder="Your store name"
                                               class="{{ $errors->has('shop_name') ? 'is-invalid' : '' }}">
                                        @error('shop_name')<div class="invalid-msg">{{ $message }}</div>@enderror
                                    </div>
                                    <div>
                                        <label class="field-label">Shop Slug</label>
                                        <input type="text" value="{{ $seller->shop_slug ?? '—' }}" readonly
                                               style="font-family:var(--mono); font-size:13px;">
                                        <div class="field-hint">Contact support to change your slug</div>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="field-label">Shop Address</label>
                                    <textarea name="shop_address"
                                              placeholder="Full shop / warehouse address…"
                                              class="{{ $errors->has('shop_address') ? 'is-invalid' : '' }}">{{ old('shop_address', $seller->shop_address) }}</textarea>
                                    @error('shop_address')<div class="invalid-msg">{{ $message }}</div>@enderror
                                </div>
                                <div>
                                    <label class="field-label">Municipality / City</label>
                                    <input type="text" name="municipality"
                                           value="{{ old('municipality', $seller->municipality) }}"
                                           placeholder="e.g. Lagos, Abuja…"
                                           class="{{ $errors->has('municipality') ? 'is-invalid' : '' }}">
                                    @error('municipality')<div class="invalid-msg">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        {{-- Product Categories --}}
                        <div class="card">
                            <div class="card-header">
                                <span class="card-header-icon">🗂️</span>
                                <span class="card-header-title">Product Categories</span>
                            </div>
                            <div class="card-body">
                                <label class="field-label">Categories you sell in</label>
                                <div class="tag-input-wrap" id="tagWrap" onclick="document.getElementById('tagRawInput').focus()">
                                    @foreach(old('product_categories', $seller->product_categories ?? []) as $cat)
                                        <span class="tag">
                                            {{ $cat }}
                                            <button type="button" class="tag-remove" onclick="removeTag(this)">×</button>
                                            <input type="hidden" name="product_categories[]" value="{{ $cat }}">
                                        </span>
                                    @endforeach
                                    <input type="text" id="tagRawInput" class="tag-input" placeholder="Type a category & press Enter…">
                                </div>
                                <div class="field-hint">Press <kbd style="background:var(--muted); padding:1px 5px; border-radius:4px; font-size:11px;">Enter</kbd> or <kbd style="background:var(--muted); padding:1px 5px; border-radius:4px; font-size:11px;">,</kbd> to add a category</div>
                                @error('product_categories')<div class="invalid-msg">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- Right: save + shop preview --}}
                    <div class="sticky-sidebar">
                        <div class="card">
                            <div class="card-body" style="display:flex; flex-direction:column; gap:10px;">
                                <button type="submit" form="profileForm" class="btn btn-primary btn-lg" style="width:100%; justify-content:center;">✓ Save Changes</button>
                                <a href="{{ route('seller.dashboard') }}" class="btn btn-ghost" style="width:100%; justify-content:center;">← Back to Dashboard</a>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <span class="card-header-icon">🗺️</span>
                                <span class="card-header-title">Location Preview</span>
                            </div>
                            <div class="card-body">
                                <div class="info-list">
                                    <div class="info-row" style="padding:10px 0;">
                                        <span class="info-label">Municipality</span>
                                        <span class="info-value {{ $seller->municipality ? '' : 'muted' }}">{{ $seller->municipality ?: 'Not set' }}</span>
                                    </div>
                                    <div class="info-row" style="padding:10px 0; border-bottom:none;">
                                        <span class="info-label">Shop Address</span>
                                        <span class="info-value {{ $seller->shop_address ? '' : 'muted' }}" style="text-align:right; max-width:160px; white-space:normal; line-height:1.4; font-size:12.5px;">
                                            {{ $seller->shop_address ?: 'Not set' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════════════
                 TAB 3 — PASSWORD
            ══════════════════════════════════════ --}}
            <div id="tab-security" class="tab-panel">
                <div class="form-grid">
                    <div>
                        <div class="card">
                            <div class="card-header">
                                <span class="card-header-icon">🔒</span>
                                <span class="card-header-title">Change Password</span>
                            </div>
                            <div class="card-body">
                                <div class="field">
                                    <label class="field-label">Current Password</label>
                                    <input type="password" name="current_password"
                                           placeholder="Enter your current password"
                                           autocomplete="current-password"
                                           class="{{ $errors->has('current_password') ? 'is-invalid' : '' }}">
                                    @error('current_password')<div class="invalid-msg">{{ $message }}</div>@enderror
                                </div>

                                <hr class="divider">

                                <div class="field">
                                    <label class="field-label">New Password</label>
                                    <input type="password" name="password" id="newPassword"
                                           placeholder="Min. 8 characters"
                                           autocomplete="new-password"
                                           class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                                           oninput="updatePwStrength(this.value)">
                                    <div class="pw-strength-bar">
                                        <div class="pw-strength-fill" id="pwStrengthFill"></div>
                                    </div>
                                    <div class="pw-strength-label" id="pwStrengthLabel">Enter a new password</div>
                                    @error('password')<div class="invalid-msg">{{ $message }}</div>@enderror
                                </div>

                                <div class="field">
                                    <label class="field-label">Confirm New Password</label>
                                    <input type="password" name="password_confirmation"
                                           placeholder="Repeat new password"
                                           autocomplete="new-password"
                                           id="confirmPassword"
                                           oninput="checkPwMatch()">
                                    <div class="field-hint" id="pwMatchHint"></div>
                                </div>

                                <div style="margin-top:4px; padding:14px; background:rgba(91,124,250,.05); border:1px solid rgba(91,124,250,.15); border-radius:10px; font-size:13px; color:var(--sub); line-height:1.6;">
                                    💡 Leave the password fields blank if you don't want to change your password.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sticky-sidebar">
                        <div class="card">
                            <div class="card-body" style="display:flex; flex-direction:column; gap:10px;">
                                <button type="submit" form="profileForm" class="btn btn-primary btn-lg" style="width:100%; justify-content:center;">✓ Save Changes</button>
                                <a href="{{ route('seller.dashboard') }}" class="btn btn-ghost" style="width:100%; justify-content:center;">← Back to Dashboard</a>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <span class="card-header-icon">🛡️</span>
                                <span class="card-header-title">Security Tips</span>
                            </div>
                            <div class="card-body">
                                @foreach([
                                    ['icon'=>'🔑','tip'=>'Use at least 8 characters'],
                                    ['icon'=>'🔠','tip'=>'Mix upper & lowercase letters'],
                                    ['icon'=>'🔢','tip'=>'Include numbers and symbols'],
                                    ['icon'=>'🚫','tip'=>'Avoid common passwords'],
                                ] as $tip)
                                <div style="display:flex; align-items:center; gap:10px; padding:8px 0; border-bottom:1px solid var(--border); font-size:13px; color:var(--sub);">
                                    <span style="font-size:16px;">{{ $tip['icon'] }}</span>
                                    {{ $tip['tip'] }}
                                </div>
                                @endforeach
                                <div style="display:flex; align-items:center; gap:10px; padding:8px 0; font-size:13px; color:var(--sub);">
                                    <span style="font-size:16px;">🔄</span> Change your password regularly
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════════════
                 TAB 4 — AGREEMENTS (read-only)
            ══════════════════════════════════════ --}}
            <div id="tab-agreements" class="tab-panel">
                <div class="form-grid">
                    <div>
                        <div class="card">
                            <div class="card-header">
                                <span class="card-header-icon">📋</span>
                                <span class="card-header-title">Platform Agreements</span>
                            </div>
                            <div class="card-body">
                                <p style="font-size:13px; color:var(--sub); margin-bottom:20px; line-height:1.6;">
                                    These agreements were accepted during your seller registration. Contact support if you have questions about any of these policies.
                                </p>
                                @foreach($agreements as $ag)
                                @php $agreed = (bool)$seller->{$ag['field']}; @endphp
                                <div class="agreement-item {{ $agreed ? 'agreed' : 'not-agreed' }}">
                                    <span class="agreement-check">{{ $agreed ? '✅' : '❌' }}</span>
                                    <span class="agreement-label">{{ $ag['label'] }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="sticky-sidebar">
                        <div class="card">
                            <div class="card-header">
                                <span class="card-header-icon">📊</span>
                                <span class="card-header-title">Agreement Summary</span>
                            </div>
                            <div class="card-body">
                                @php
                                    $totalAgreements = count($agreements);
                                    $agreedCount = collect($agreements)->filter(fn($a) => (bool)$seller->{$a['field']})->count();
                                    $agreedPct = $totalAgreements > 0 ? round($agreedCount / $totalAgreements * 100) : 0;
                                @endphp
                                <div style="text-align:center; padding:10px 0 18px;">
                                    <div style="font-size:40px; font-weight:700; font-family:var(--mono); color:{{ $agreedCount === $totalAgreements ? 'var(--accent2)' : 'var(--accent3)' }};">
                                        {{ $agreedCount }}/{{ $totalAgreements }}
                                    </div>
                                    <div style="font-size:12px; color:var(--sub); margin-top:4px;">Agreements accepted</div>
                                    <div style="height:6px; background:var(--muted); border-radius:10px; margin-top:12px; overflow:hidden;">
                                        <div style="height:100%; width:{{ $agreedPct }}%; background:{{ $agreedCount === $totalAgreements ? 'var(--accent2)' : 'var(--accent3)' }}; border-radius:10px; transition:width .4s;"></div>
                                    </div>
                                </div>
                                @if($agreedCount < $totalAgreements)
                                <div style="padding:12px 14px; background:rgba(245,158,11,.07); border:1px solid rgba(245,158,11,.2); border-radius:9px; font-size:12.5px; color:#92680a; line-height:1.5;">
                                    ⚠️ Some agreements were not accepted. Contact support for assistance.
                                </div>
                                @else
                                <div style="padding:12px 14px; background:rgba(34,196,122,.07); border:1px solid rgba(34,196,122,.2); border-radius:9px; font-size:12.5px; color:#0d9a5e; line-height:1.5;">
                                    ✅ All agreements accepted. Your account is fully compliant.
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </main>
</div>

<script>
// ─────────────────────────────────
// TABS
// ─────────────────────────────────
function switchTab(name, btn) {
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
    document.getElementById('tab-' + name).classList.add('active');
    btn.classList.add('active');
}

// ─────────────────────────────────
// PASSWORD STRENGTH
// ─────────────────────────────────
function updatePwStrength(val) {
    const fill  = document.getElementById('pwStrengthFill');
    const label = document.getElementById('pwStrengthLabel');
    let score = 0;
    if (val.length >= 8)  score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    const levels = [
        { pct: 0,   color: 'var(--muted)',    text: 'Enter a new password' },
        { pct: 25,  color: 'var(--danger)',   text: '⚠️ Very weak' },
        { pct: 50,  color: 'var(--accent3)',  text: '🔸 Fair' },
        { pct: 75,  color: '#3b82f6',         text: '🔷 Good' },
        { pct: 100, color: 'var(--accent2)',  text: '✅ Strong' },
    ];

    const lvl = val.length === 0 ? levels[0] : levels[score];
    fill.style.width      = lvl.pct + '%';
    fill.style.background = lvl.color;
    label.textContent     = lvl.text;
    label.style.color     = lvl.color === 'var(--muted)' ? 'var(--sub)' : lvl.color;
    checkPwMatch();
}

function checkPwMatch() {
    const pw   = document.getElementById('newPassword')?.value;
    const conf = document.getElementById('confirmPassword')?.value;
    const hint = document.getElementById('pwMatchHint');
    if (!conf || !pw) { hint.textContent = ''; return; }
    if (pw === conf) {
        hint.textContent = '✅ Passwords match';
        hint.style.color = 'var(--accent2)';
    } else {
        hint.textContent = '❌ Passwords do not match';
        hint.style.color = 'var(--danger)';
    }
}

// ─────────────────────────────────
// TAG INPUT (Product Categories)
// ─────────────────────────────────
const tagInput = document.getElementById('tagRawInput');
const tagWrap  = document.getElementById('tagWrap');

if (tagInput) {
    tagInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ',') {
            e.preventDefault();
            const val = this.value.trim().replace(/,+$/, '');
            if (!val) return;
            addTag(val);
            this.value = '';
        }
        if (e.key === 'Backspace' && this.value === '') {
            const tags = tagWrap.querySelectorAll('.tag');
            if (tags.length) tags[tags.length - 1].remove();
        }
    });
}

function addTag(val) {
    if (!val) return;
    const existing = Array.from(tagWrap.querySelectorAll('input[name]')).map(i => i.value.toLowerCase());
    if (existing.includes(val.toLowerCase())) return;
    const span = document.createElement('span');
    span.className = 'tag';
    span.innerHTML = `${val}<button type="button" class="tag-remove" onclick="removeTag(this)">×</button><input type="hidden" name="product_categories[]" value="${val}">`;
    tagWrap.insertBefore(span, tagInput);
}

function removeTag(btn) {
    btn.closest('.tag').remove();
}

// ─────────────────────────────────
// RESTORE ACTIVE TAB ON ERRORS
// ─────────────────────────────────
@if($errors->has('current_password') || $errors->has('password'))
    switchTab('security', document.querySelectorAll('.tab')[2]);
@elseif($errors->has('shop_name') || $errors->has('shop_address') || $errors->has('municipality') || $errors->has('product_categories'))
    switchTab('shop', document.querySelectorAll('.tab')[1]);
@endif
</script>
</body>
</html>