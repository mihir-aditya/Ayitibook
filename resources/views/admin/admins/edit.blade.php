@extends('admin.layouts.basic')

@section('title', 'Edit Admin — ' . $admin->name)
@section('page-title', 'Edit Admin')

@push('styles')
<style>
/* reuse same styles as create — scoped to am- prefix */
.am-form-wrap * { box-sizing: border-box; }
.am-form-wrap { font-size: 14px; color: var(--ink); line-height: 1.6; max-width: 780px; }
.am-form-card { background: #fff; border: 1px solid var(--border); border-radius: var(--radius); box-shadow: var(--shadow-sm); overflow: hidden; margin-bottom: 20px; }
.am-form-card-head { padding: 14px 22px; background: var(--surface); border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 9px; font-size: 13px; font-weight: 700; color: var(--ink); }
.am-form-card-head i { color: var(--accent); font-size: 14px; }
.am-form-card-body { padding: 22px; }
.am-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
@media (max-width: 600px) { .am-grid-2 { grid-template-columns: 1fr; } }
.am-field { display: flex; flex-direction: column; gap: 5px; margin-bottom: 16px; }
.am-field:last-child { margin-bottom: 0; }
.am-field label { font-size: 11.5px; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: .4px; display: flex; align-items: center; gap: 5px; }
.am-field label .req { color: #ef4444; }
.am-input, .am-select {
    height: 40px; padding: 0 12px; border: 1px solid var(--border); border-radius: 8px;
    font-size: 13px; color: var(--ink); background: var(--surface); outline: none;
    transition: border-color .15s, box-shadow .15s; font-family: inherit; width: 100%;
}
.am-input:focus, .am-select:focus { border-color: var(--accent); background: #fff; box-shadow: 0 0 0 3px rgba(99,102,241,.08); }
.am-input.is-invalid, .am-select.is-invalid { border-color: #ef4444; background: #fff8f8; }
.am-select { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236b7280' d='M6 8L1 3h10z'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; padding-right: 34px; }
.am-hint  { font-size: 11.5px; color: var(--muted); margin-top: 3px; }
.am-error { font-size: 11.5px; color: #ef4444; margin-top: 3px; display: flex; align-items: center; gap: 4px; }
.am-role-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 10px; }
@media (max-width: 500px) { .am-role-grid { grid-template-columns: 1fr; } }
.am-role-card { border: 2px solid var(--border); border-radius: 10px; padding: 14px 16px; cursor: pointer; transition: border-color .15s, background .15s; position: relative; }
.am-role-card input[type=radio] { position: absolute; opacity: 0; width: 0; height: 0; }
.am-role-card:has(input:checked) { border-color: var(--accent); background: #eff6ff; }
.am-role-card:hover { border-color: #a5b4fc; }
.am-role-icon { font-size: 20px; margin-bottom: 6px; }
.am-role-name { font-size: 13px; font-weight: 700; color: var(--ink); margin-bottom: 3px; }
.am-role-desc { font-size: 11.5px; color: var(--muted); line-height: 1.5; }
.am-form-footer { display: flex; justify-content: flex-end; gap: 10px; padding: 16px 22px; background: var(--surface); border-top: 1px solid var(--border); }
.am-btn { display: inline-flex; align-items: center; gap: 7px; padding: 0 18px; height: 38px; border-radius: 8px; font-size: 13px; font-weight: 600; border: 1px solid transparent; cursor: pointer; transition: opacity .15s; font-family: inherit; text-decoration: none; }
.am-btn:hover { opacity: .88; }
.am-btn-primary { background: var(--accent); color: #fff; border-color: var(--accent); }
.am-btn-ghost   { background: #fff; color: var(--ink); border-color: var(--border); }

/* self-edit warning banner */
.am-self-warn {
    background: #fefce8; border: 1px solid #fde68a; border-radius: 10px;
    padding: 12px 16px; margin-bottom: 18px;
    display: flex; align-items: center; gap: 10px; font-size: 13px; color: #92400e;
}
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
    <span>Edit — {{ $admin->name }}</span>
</div>

@if(session('success'))
<div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:10px;padding:12px 16px;margin-bottom:18px;display:flex;align-items:center;gap:10px;font-size:13px;color:#15803d;">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
</div>
@endif
@if(session('error'))
<div style="background:#fff1f2;border:1px solid #fecdd3;border-radius:10px;padding:12px 16px;margin-bottom:18px;display:flex;align-items:center;gap:10px;font-size:13px;color:#be123c;">
    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
</div>
@endif

@if($admin->id === auth('admin')->id())
<div class="am-self-warn">
    <i class="fas fa-exclamation-triangle" style="font-size:16px;flex-shrink:0;"></i>
    <span>You are editing <strong>your own account</strong>. You cannot change your own role.</span>
</div>
@endif

<form method="POST" action="{{ route('admin.admins.update', $admin) }}">
@csrf @method('PUT')

{{-- ── Basic Info ── --}}
<div class="am-form-card">
    <div class="am-form-card-head"><i class="fas fa-user"></i> Basic Information</div>
    <div class="am-form-card-body">
        <div class="am-grid-2">
            <div class="am-field">
                <label>Full Name <span class="req">*</span></label>
                <input type="text" name="name" class="am-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                       value="{{ old('name', $admin->name) }}" required>
                @error('name')<div class="am-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
            </div>
            <div class="am-field">
                <label>Username <span class="req">*</span></label>
                <input type="text" name="username" class="am-input {{ $errors->has('username') ? 'is-invalid' : '' }}"
                       value="{{ old('username', $admin->username) }}" required>
                <div class="am-hint">Letters, numbers, underscores and dashes only.</div>
                @error('username')<div class="am-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
            </div>
        </div>
        <div class="am-grid-2">
            <div class="am-field">
                <label>Email <span class="req">*</span></label>
                <input type="email" name="email" class="am-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                       value="{{ old('email', $admin->email) }}" required>
                @error('email')<div class="am-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
            </div>
            <div class="am-field">
                <label>Phone</label>
                <input type="text" name="phone" class="am-input {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                       value="{{ old('phone', $admin->phone) }}" placeholder="+91 98765 43210">
                @error('phone')<div class="am-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
            </div>
        </div>
    </div>
</div>

{{-- ── Role ── --}}
<div class="am-form-card">
    <div class="am-form-card-head"><i class="fas fa-shield-alt"></i> Role</div>
    <div class="am-form-card-body">
        <div class="am-field" style="margin-bottom:0;">
            <label style="margin-bottom:10px;">Assign Role <span class="req">*</span></label>
            <div class="am-role-grid">
                @php $isSelf = $admin->id === auth('admin')->id(); @endphp

                <label class="am-role-card" style="{{ $isSelf ? 'pointer-events:none;opacity:.7;' : '' }}">
                    <input type="radio" name="role" value="support"
                           {{ old('role', $admin->role)==='support' ? 'checked' : '' }}
                           {{ $isSelf ? 'disabled' : '' }}>
                    <div class="am-role-icon" style="color:#059669;">🎧</div>
                    <div class="am-role-name">Support</div>
                    <div class="am-role-desc">View orders & refunds, update status only.</div>
                </label>

                <label class="am-role-card" style="{{ $isSelf ? 'pointer-events:none;opacity:.7;' : '' }}">
                    <input type="radio" name="role" value="manager"
                           {{ old('role', $admin->role)==='manager' ? 'checked' : '' }}
                           {{ $isSelf ? 'disabled' : '' }}>
                    <div class="am-role-icon" style="color:#7c3aed;">👔</div>
                    <div class="am-role-name">Manager</div>
                    <div class="am-role-desc">Full operational access, no user delete.</div>
                </label>

                <label class="am-role-card" style="{{ $isSelf ? 'pointer-events:none;opacity:.7;' : '' }}">
                    <input type="radio" name="role" value="admin"
                           {{ old('role', $admin->role)==='admin' ? 'checked' : '' }}
                           {{ $isSelf ? 'disabled' : '' }}>
                    <div class="am-role-icon" style="color:#b45309;">👑</div>
                    <div class="am-role-name">Admin</div>
                    <div class="am-role-desc">Full access including admin management.</div>
                </label>
            </div>

            {{-- hidden fallback so form submits the current role when editing self --}}
            @if($isSelf)
            <input type="hidden" name="role" value="{{ $admin->role }}">
            <div class="am-hint" style="margin-top:8px;"><i class="fas fa-lock"></i> Role is locked while editing your own account.</div>
            @endif

            @error('role')<div class="am-error" style="margin-top:8px;"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
        </div>
    </div>
</div>

{{-- ── Status ── --}}
<div class="am-form-card">
    <div class="am-form-card-head"><i class="fas fa-toggle-on"></i> Account Status</div>
    <div class="am-form-card-body">
        <div class="am-field" style="margin-bottom:0;">
            <label>Status <span class="req">*</span></label>
            <select name="status" class="am-select {{ $errors->has('status') ? 'is-invalid' : '' }}"
                    style="max-width:200px;" {{ $isSelf ? 'disabled' : '' }}>
                <option value="1" {{ old('status', $admin->status ? '1' : '0')==='1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status', $admin->status ? '1' : '0')==='0' ? 'selected' : '' }}>Inactive</option>
            </select>
            @if($isSelf)
            <input type="hidden" name="status" value="{{ $admin->status ? 1 : 0 }}">
            <div class="am-hint"><i class="fas fa-lock"></i> Cannot deactivate your own account.</div>
            @endif
            @error('status')<div class="am-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
        </div>
    </div>
</div>

{{-- ── Footer ── --}}
<div class="am-form-footer" style="border-radius:var(--radius);border:1px solid var(--border);background:var(--surface);">
    <a href="{{ route('admin.admins.index') }}" class="am-btn am-btn-ghost">
        <i class="fas fa-arrow-left"></i> Cancel
    </a>
    <button type="submit" class="am-btn am-btn-primary">
        <i class="fas fa-save"></i> Save Changes
    </button>
</div>

</form>
</div>
@endsection