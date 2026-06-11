@extends('admin.layouts.basic')

@section('title', 'Add New Admin')
@section('page-title', 'Add New Admin')

@push('styles')
<style>
.am-form-wrap * { box-sizing: border-box; }
.am-form-wrap { font-size: 14px; color: var(--ink); line-height: 1.6; max-width: 780px; }

.am-form-card {
    background: #fff; border: 1px solid var(--border);
    border-radius: var(--radius); box-shadow: var(--shadow-sm); overflow: hidden;
    margin-bottom: 20px;
}
.am-form-card-head {
    padding: 14px 22px; background: var(--surface);
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; gap: 9px;
    font-size: 13px; font-weight: 700; color: var(--ink);
}
.am-form-card-head i { color: var(--accent); font-size: 14px; }
.am-form-card-body { padding: 22px; }

.am-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
@media (max-width: 600px) { .am-grid-2 { grid-template-columns: 1fr; } }

.am-field { display: flex; flex-direction: column; gap: 5px; margin-bottom: 16px; }
.am-field:last-child { margin-bottom: 0; }
.am-field label {
    font-size: 11.5px; font-weight: 700; color: var(--muted);
    text-transform: uppercase; letter-spacing: .4px;
    display: flex; align-items: center; gap: 5px;
}
.am-field label .req { color: #ef4444; }
.am-input, .am-select, .am-textarea {
    height: 40px; padding: 0 12px;
    border: 1px solid var(--border); border-radius: 8px;
    font-size: 13px; color: var(--ink); background: var(--surface);
    outline: none; transition: border-color .15s, box-shadow .15s; font-family: inherit;
    width: 100%;
}
.am-input:focus, .am-select:focus { border-color: var(--accent); background: #fff; box-shadow: 0 0 0 3px rgba(99,102,241,.08); }
.am-input.is-invalid, .am-select.is-invalid { border-color: #ef4444; background: #fff8f8; }
.am-select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236b7280' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 12px center;
    padding-right: 34px;
}
.am-hint { font-size: 11.5px; color: var(--muted); margin-top: 3px; }
.am-error { font-size: 11.5px; color: #ef4444; margin-top: 3px; display: flex; align-items: center; gap: 4px; }

/* role cards */
.am-role-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 10px; }
@media (max-width: 500px) { .am-role-grid { grid-template-columns: 1fr; } }
.am-role-card {
    border: 2px solid var(--border); border-radius: 10px;
    padding: 14px 16px; cursor: pointer;
    transition: border-color .15s, background .15s;
    position: relative;
}
.am-role-card input[type=radio] { position: absolute; opacity: 0; width: 0; height: 0; }
.am-role-card:has(input:checked) {
    border-color: var(--accent); background: #eff6ff;
}
.am-role-card:hover { border-color: #a5b4fc; }
.am-role-icon { font-size: 20px; margin-bottom: 6px; }
.am-role-name { font-size: 13px; font-weight: 700; color: var(--ink); margin-bottom: 3px; }
.am-role-desc { font-size: 11.5px; color: var(--muted); line-height: 1.5; }

/* password strength */
.am-pwd-bar { height: 4px; border-radius: 2px; background: #e5e7eb; margin-top: 6px; overflow: hidden; }
.am-pwd-fill { height: 100%; border-radius: 2px; transition: width .3s, background .3s; width: 0; }
.am-pwd-label { font-size: 11px; color: var(--muted); margin-top: 3px; }

/* footer buttons */
.am-form-footer {
    display: flex; justify-content: flex-end; gap: 10px;
    padding: 16px 22px; background: var(--surface);
    border-top: 1px solid var(--border);
}
.am-btn {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 0 18px; height: 38px; border-radius: 8px;
    font-size: 13px; font-weight: 600; border: 1px solid transparent;
    cursor: pointer; transition: opacity .15s; font-family: inherit; text-decoration: none;
}
.am-btn:hover { opacity: .88; }
.am-btn-primary { background: var(--accent); color: #fff; border-color: var(--accent); }
.am-btn-ghost   { background: #fff; color: var(--ink); border-color: var(--border); }
</style>
@endpush

@section('content')
<div class="am-form-wrap">

{{-- breadcrumb --}}
<div style="display:flex;align-items:center;gap:8px;font-size:13px;color:var(--muted);margin-bottom:18px;">
    <a href="{{ route('admin.admins.index') }}" style="color:var(--accent);text-decoration:none;font-weight:600;">
        <i class="fas fa-users-cog"></i> Admins
    </a>
    <i class="fas fa-chevron-right" style="font-size:10px;"></i>
    <span>Add New Admin</span>
</div>

<form method="POST" action="{{ route('admin.admins.store') }}">
@csrf

{{-- ── Basic Info ── --}}
<div class="am-form-card">
    <div class="am-form-card-head"><i class="fas fa-user"></i> Basic Information</div>
    <div class="am-form-card-body">
        <div class="am-grid-2">
            <div class="am-field">
                <label>Full Name <span class="req">*</span></label>
                <input type="text" name="name" class="am-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                       value="{{ old('name') }}" placeholder="e.g. Ravi Sharma" autofocus required>
                @error('name')<div class="am-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
            </div>
            <div class="am-field">
                <label>Username <span class="req">*</span></label>
                <input type="text" name="username" class="am-input {{ $errors->has('username') ? 'is-invalid' : '' }}"
                       value="{{ old('username') }}" placeholder="e.g. ravi_sharma" required>
                <div class="am-hint">Letters, numbers, underscores and dashes only.</div>
                @error('username')<div class="am-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
            </div>
        </div>
        <div class="am-grid-2">
            <div class="am-field">
                <label>Email <span class="req">*</span></label>
                <input type="email" name="email" class="am-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                       value="{{ old('email') }}" placeholder="ravi@example.com" required>
                @error('email')<div class="am-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
            </div>
            <div class="am-field">
                <label>Phone</label>
                <input type="text" name="phone" class="am-input {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                       value="{{ old('phone') }}" placeholder="+91 98765 43210">
                @error('phone')<div class="am-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
            </div>
        </div>
    </div>
</div>

{{-- ── Role ── --}}
<div class="am-form-card">
    <div class="am-form-card-head"><i class="fas fa-shield-alt"></i> Role & Permissions</div>
    <div class="am-form-card-body">
        <div class="am-field" style="margin-bottom:0;">
            <label style="margin-bottom:10px;">Assign Role <span class="req">*</span></label>
            <div class="am-role-grid">

                <label class="am-role-card">
                    <input type="radio" name="role" value="support" {{ old('role','support')==='support' ? 'checked' : '' }}>
                    <div class="am-role-icon" style="color:#059669;">🎧</div>
                    <div class="am-role-name">Support</div>
                    <div class="am-role-desc">View orders & refunds, update their status. No write access to products or users.</div>
                </label>

                <label class="am-role-card">
                    <input type="radio" name="role" value="manager" {{ old('role')==='manager' ? 'checked' : '' }}>
                    <div class="am-role-icon" style="color:#7c3aed;">👔</div>
                    <div class="am-role-name">Manager</div>
                    <div class="am-role-desc">Full operational access: products, sellers, users (no delete), delivery, BNPL, affiliates.</div>
                </label>

                <label class="am-role-card">
                    <input type="radio" name="role" value="admin" {{ old('role')==='admin' ? 'checked' : '' }}>
                    <div class="am-role-icon" style="color:#b45309;">👑</div>
                    <div class="am-role-name">Admin</div>
                    <div class="am-role-desc">Full access including user deletion and admin management. Use sparingly.</div>
                </label>

            </div>
            @error('role')<div class="am-error" style="margin-top:8px;"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
        </div>
    </div>
</div>

{{-- ── Status & Password ── --}}
<div class="am-form-card">
    <div class="am-form-card-head"><i class="fas fa-lock"></i> Account & Password</div>
    <div class="am-form-card-body">
        <div class="am-field">
            <label>Account Status <span class="req">*</span></label>
            <select name="status" class="am-select {{ $errors->has('status') ? 'is-invalid' : '' }}" style="max-width:200px;">
                <option value="1" {{ old('status','1')==='1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status')==='0'     ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')<div class="am-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
        </div>

        <div class="am-grid-2">
            <div class="am-field" style="margin-bottom:0;">
                <label>Password <span class="req">*</span></label>
                <input type="password" name="password" id="pwd" class="am-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                       placeholder="Min 8 chars" required oninput="checkStrength(this.value)">
                <div class="am-pwd-bar"><div class="am-pwd-fill" id="pwdBar"></div></div>
                <div class="am-pwd-label" id="pwdLabel">Enter a password</div>
                @error('password')<div class="am-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
            </div>
            <div class="am-field" style="margin-bottom:0;">
                <label>Confirm Password <span class="req">*</span></label>
                <input type="password" name="password_confirmation" class="am-input" placeholder="Repeat password" required>
            </div>
        </div>
    </div>
</div>

{{-- ── Footer ── --}}
<div class="am-form-footer" style="border-radius:var(--radius);border:1px solid var(--border);background:var(--surface);">
    <a href="{{ route('admin.admins.index') }}" class="am-btn am-btn-ghost">
        <i class="fas fa-arrow-left"></i> Cancel
    </a>
    <button type="submit" class="am-btn am-btn-primary">
        <i class="fas fa-user-plus"></i> Create Admin
    </button>
</div>

</form>
</div>

@push('scripts')
<script>
function checkStrength(val) {
    var bar   = document.getElementById('pwdBar');
    var label = document.getElementById('pwdLabel');
    var score = 0;
    if (val.length >= 8)              score++;
    if (val.length >= 12)             score++;
    if (/[A-Z]/.test(val))            score++;
    if (/[0-9]/.test(val))            score++;
    if (/[^A-Za-z0-9]/.test(val))    score++;
    var map = [
        { w:'0%',   bg:'#e5e7eb', txt:'Enter a password' },
        { w:'20%',  bg:'#ef4444', txt:'Very weak' },
        { w:'40%',  bg:'#f97316', txt:'Weak' },
        { w:'60%',  bg:'#eab308', txt:'Fair' },
        { w:'80%',  bg:'#22c55e', txt:'Strong' },
        { w:'100%', bg:'#15803d', txt:'Very strong' },
    ];
    var s = map[Math.min(score, 5)];
    bar.style.width = s.w; bar.style.background = s.bg; label.textContent = s.txt;
    label.style.color = score >= 3 ? s.bg : '#9ca3af';
}
</script>
@endpush
@endsection