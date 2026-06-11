@extends('admin.layouts.basic')

@section('title', 'Admin Management')
@section('page-title', 'Admin Management')

@push('styles')
<style>
.am-wrap * { box-sizing: border-box; }
.am-wrap { font-size: 14px; color: var(--ink); line-height: 1.6; }

/* ── stat cards ── */
.am-stats {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 14px; margin-bottom: 22px;
}
.am-stat {
    background: #fff; border: 1px solid var(--border);
    border-radius: var(--radius); padding: 16px 18px;
    display: flex; align-items: center; gap: 14px;
    box-shadow: var(--shadow-sm);
}
.am-stat-icon {
    width: 42px; height: 42px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 17px; flex-shrink: 0;
}
.am-stat-label { font-size: 11px; color: var(--muted); text-transform: uppercase; letter-spacing: .5px; margin-bottom: 2px; }
.am-stat-value { font-size: 22px; font-weight: 700; color: var(--ink); line-height: 1.2; }

/* ── filter card ── */
.am-filter-card {
    background: #fff; border: 1px solid var(--border);
    border-radius: var(--radius); padding: 16px 20px;
    margin-bottom: 18px; box-shadow: var(--shadow-sm);
}
.am-filter-row { display: flex; flex-wrap: wrap; gap: 10px; align-items: flex-end; }
.am-filter-group { display: flex; flex-direction: column; gap: 4px; }
.am-filter-group label { font-size: 11.5px; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: .4px; }

.am-input, .am-select {
    height: 36px; padding: 0 12px;
    border: 1px solid var(--border); border-radius: 8px;
    font-size: 13px; color: var(--ink); background: var(--surface);
    outline: none; transition: border-color .15s; font-family: inherit;
}
.am-input:focus, .am-select:focus { border-color: var(--accent); background: #fff; }
.am-input { width: 220px; }
.am-select {
    padding-right: 30px; appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236b7280' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 10px center;
}

/* ── buttons ── */
.am-btn {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 0 16px; height: 36px; border-radius: 8px;
    font-size: 13px; font-weight: 600; border: 1px solid transparent;
    cursor: pointer; transition: opacity .15s, background .15s;
    font-family: inherit; text-decoration: none; white-space: nowrap;
}
.am-btn:hover { opacity: .88; }
.am-btn-primary { background: var(--accent); color: #fff; border-color: var(--accent); }
.am-btn-ghost   { background: #fff; color: var(--ink); border-color: var(--border); }
.am-btn-red     { background: var(--red, #ef4444); color: #fff; }
.am-btn-sm      { height: 30px; padding: 0 11px; font-size: 12px; }

/* ── main card ── */
.am-card {
    background: #fff; border: 1px solid var(--border);
    border-radius: var(--radius); box-shadow: var(--shadow-sm); overflow: hidden;
}
.am-card-head {
    display: flex; align-items: center; justify-content: space-between;
    padding: 14px 20px; border-bottom: 1px solid var(--border);
    background: var(--surface); gap: 10px; flex-wrap: wrap;
}
.am-card-head h3 {
    margin: 0; font-size: 14px; font-weight: 700; color: var(--ink);
    display: flex; align-items: center; gap: 8px;
}
.am-card-head h3 i { color: var(--accent); font-size: 15px; }

/* ── table ── */
.am-table { width: 100%; border-collapse: collapse; font-size: 13px; }
.am-table thead tr { background: var(--surface); }
.am-table thead th {
    padding: 11px 14px; text-align: left; font-size: 11.5px;
    font-weight: 700; text-transform: uppercase; letter-spacing: .5px;
    color: var(--muted); white-space: nowrap; border-bottom: 1px solid var(--border);
}
.am-table thead th.center { text-align: center; }
.am-table tbody tr { border-bottom: 1px solid #f3f4f6; transition: background .1s; }
.am-table tbody tr:last-child { border-bottom: none; }
.am-table tbody tr:hover { background: #f9fafb; }
.am-table td { padding: 13px 14px; vertical-align: middle; color: var(--ink); }
.am-table td.center { text-align: center; }

/* ── avatar ── */
.am-avatar {
    width: 36px; height: 36px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 14px; font-weight: 700; color: #fff;
    flex-shrink: 0; letter-spacing: .5px;
}

/* ── badges ── */
.badge {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 3px 10px; border-radius: 999px;
    font-size: 11.5px; font-weight: 700; line-height: 1.4; white-space: nowrap;
}
.badge-green  { background: #dcfce7; color: #15803d; }
.badge-red    { background: #fee2e2; color: #b91c1c; }
.badge-blue   { background: #dbeafe; color: #1d4ed8; }
.badge-purple { background: #ede9fe; color: #6d28d9; }
.badge-gray   { background: #f3f4f6; color: #4b5563; }
.badge-amber  { background: #fef3c7; color: #92400e; }
.badge-dot::before {
    content: ''; width: 6px; height: 6px; border-radius: 50%;
    background: currentColor; display: inline-block;
}

/* ── empty ── */
.am-empty { text-align: center; padding: 56px 20px; color: var(--muted); }
.am-empty i { font-size: 40px; display: block; margin-bottom: 14px; color: #d1d5db; }

/* ── pagination ── */
.am-pagination { display: flex; justify-content: flex-end; padding: 14px 20px; border-top: 1px solid var(--border); }

/* ── password modal ── */
.am-modal-overlay {
    display: none; position: fixed; inset: 0;
    background: rgba(13,15,20,.5); z-index: 9000;
    align-items: flex-start; justify-content: center;
    padding: 60px 16px; overflow-y: auto;
    backdrop-filter: blur(3px);
}
.am-modal-overlay.open { display: flex; }
.am-modal {
    background: #fff; border-radius: 14px;
    width: 100%; max-width: 460px; margin: auto;
    box-shadow: 0 24px 60px rgba(0,0,0,.16);
    overflow: hidden; animation: amIn .2s ease;
}
@keyframes amIn {
    from { opacity:0; transform: translateY(-14px) scale(.98); }
    to   { opacity:1; transform: translateY(0) scale(1); }
}
.am-modal-head {
    display: flex; align-items: center; justify-content: space-between;
    padding: 16px 22px; background: var(--surface);
    border-bottom: 1px solid var(--border);
}
.am-modal-title { font-size: 15px; font-weight: 700; color: var(--ink); margin: 0; display: flex; align-items: center; gap: 8px; }
.am-modal-title i { color: var(--accent); }
.am-modal-close {
    width: 32px; height: 32px; border: none; background: var(--surface-2, #f3f4f6);
    border-radius: 8px; cursor: pointer; font-size: 15px; color: var(--muted);
    display: flex; align-items: center; justify-content: center; transition: background .15s;
}
.am-modal-close:hover { background: #fee2e2; color: #b91c1c; }
.am-modal-body { padding: 22px; }
.am-form-group { display: flex; flex-direction: column; gap: 5px; margin-bottom: 16px; }
.am-form-group label { font-size: 11.5px; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: .4px; }
.am-form-group .am-input { width: 100%; height: 40px; }
</style>
@endpush

@section('content')
<div class="am-wrap">

{{-- Flash messages --}}
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

{{-- STAT CHIPS --}}
<div class="am-stats">
    @php
    $statItems = [
        ['Total',    $stats['total'],   'fas fa-users-cog',    '#eff6ff','#1d4ed8'],
        ['Admins',   $stats['admin'],   'fas fa-crown',        '#fef3c7','#92400e'],
        ['Managers', $stats['manager'], 'fas fa-user-tie',     '#ede9fe','#6d28d9'],
        ['Support',  $stats['support'], 'fas fa-headset',      '#ecfdf5','#065f46'],
        ['Active',   $stats['active'],  'fas fa-circle',       '#f0fdf4','#15803d'],
    ];
    @endphp
    @foreach($statItems as [$lbl, $val, $icon, $bg, $col])
    <div class="am-stat">
        <div class="am-stat-icon" style="background:{{ $bg }};color:{{ $col }};"><i class="{{ $icon }}"></i></div>
        <div>
            <div class="am-stat-label">{{ $lbl }}</div>
            <div class="am-stat-value">{{ $val }}</div>
        </div>
    </div>
    @endforeach
</div>

{{-- FILTERS --}}
<div class="am-filter-card">
    <form method="GET" action="{{ route('admin.admins.index') }}">
        <div class="am-filter-row">
            <div class="am-filter-group" style="flex:1;min-width:200px;">
                <label>Search</label>
                <div style="position:relative;">
                    <i class="fas fa-search" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:var(--muted);font-size:12px;"></i>
                    <input type="text" name="search" class="am-input" style="width:100%;padding-left:30px;"
                           placeholder="Name, email, username…" value="{{ request('search') }}">
                </div>
            </div>
            <div class="am-filter-group">
                <label>Role</label>
                <select name="role" class="am-select" style="width:140px;">
                    <option value="all" {{ request('role','all')==='all' ? 'selected' : '' }}>All roles</option>
                    <option value="admin"   {{ request('role')==='admin'   ? 'selected' : '' }}>Admin</option>
                    <option value="manager" {{ request('role')==='manager' ? 'selected' : '' }}>Manager</option>
                    <option value="support" {{ request('role')==='support' ? 'selected' : '' }}>Support</option>
                </select>
            </div>
            <div class="am-filter-group">
                <label>Status</label>
                <select name="status" class="am-select" style="width:130px;">
                    <option value="all"      {{ request('status','all')==='all'      ? 'selected' : '' }}>All</option>
                    <option value="active"   {{ request('status')==='active'         ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status')==='inactive'       ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div style="display:flex;gap:8px;">
                <button type="submit" class="am-btn am-btn-primary"><i class="fas fa-filter"></i> Filter</button>
                <a href="{{ route('admin.admins.index') }}" class="am-btn am-btn-ghost"><i class="fas fa-times"></i> Clear</a>
            </div>
        </div>
    </form>
</div>

{{-- MAIN TABLE --}}
<div class="am-card">
    <div class="am-card-head">
        <h3><i class="fas fa-users-cog"></i> Admins
            <span style="background:#f3f4f6;color:#4b5563;border-radius:999px;padding:1px 9px;font-size:12px;font-weight:700;">
                {{ $admins->total() }}
            </span>
        </h3>
        <a href="{{ route('admin.admins.create') }}" class="am-btn am-btn-primary">
            <i class="fas fa-plus"></i> Add Admin
        </a>
    </div>

    @if($admins->count())
    <div style="overflow-x:auto;">
        <table class="am-table">
            <thead>
                <tr>
                    <th>Admin</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th class="center">Role</th>
                    <th class="center">Status</th>
                    <th>Last Login</th>
                    <th class="center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @php
            $avatarColors = ['admin'=>'#1d4ed8','manager'=>'#6d28d9','support'=>'#065f46'];
            $roleBadge    = ['admin'=>'badge-amber','manager'=>'badge-purple','support'=>'badge-green'];
            $roleIcon     = ['admin'=>'fas fa-crown','manager'=>'fas fa-user-tie','support'=>'fas fa-headset'];
            @endphp
            @foreach($admins as $adm)
            @php
                $isSelf = $adm->id === auth('admin')->id();
                $color  = $avatarColors[$adm->role] ?? '#374151';
                $initials = strtoupper(substr($adm->name, 0, 1)) . (strpos($adm->name,' ')!==false ? strtoupper(substr(strrchr($adm->name,' '),1,1)) : '');
            @endphp
            <tr>
                {{-- Admin info --}}
                <td>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div class="am-avatar" style="background:{{ $color }};">{{ $initials }}</div>
                        <div>
                            <div style="font-weight:600;font-size:13px;color:var(--ink);">
                                {{ $adm->name }}
                                @if($isSelf)
                                <span style="font-size:10.5px;background:#eff6ff;color:#1d4ed8;border-radius:999px;padding:1px 7px;margin-left:4px;font-weight:700;">You</span>
                                @endif
                            </div>
                            <div style="font-size:11.5px;color:var(--muted);">{{ $adm->email }}</div>
                        </div>
                    </div>
                </td>

                {{-- username --}}
                <td><span style="font-family:monospace;font-size:12px;color:var(--muted);">{{ $adm->username }}</span></td>

                {{-- phone --}}
                <td style="color:var(--muted);font-size:13px;">{{ $adm->phone ?? '—' }}</td>

                {{-- role --}}
                <td class="center">
                    <span class="badge {{ $roleBadge[$adm->role] ?? 'badge-gray' }} badge-dot">
                        <i class="{{ $roleIcon[$adm->role] ?? 'fas fa-user' }}" style="font-size:9px;"></i>
                        {{ ucfirst($adm->role) }}
                    </span>
                </td>

                {{-- status --}}
                <td class="center">
                    <span class="badge {{ $adm->status ? 'badge-green' : 'badge-red' }} badge-dot">
                        {{ $adm->status ? 'Active' : 'Inactive' }}
                    </span>
                </td>

                {{-- last login --}}
                <td style="font-size:12.5px;color:var(--muted);white-space:nowrap;">
                    {{ $adm->last_login_at ? $adm->last_login_at->diffForHumans() : 'Never' }}
                </td>

                {{-- actions --}}
                <td class="center">
                    <div style="display:flex;gap:5px;justify-content:center;flex-wrap:wrap;">
                        {{-- Edit --}}
                        <a href="{{ route('admin.admins.edit', $adm) }}"
                           class="am-btn am-btn-ghost am-btn-sm" title="Edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        {{-- Reset password --}}
                        <button type="button"
                                class="am-btn am-btn-ghost am-btn-sm"
                                onclick="openPwdModal({{ $adm->id }}, '{{ addslashes($adm->name) }}')"
                                title="Reset password">
                            <i class="fas fa-key"></i>
                        </button>

                        {{-- Toggle status --}}
                        @if(!$isSelf)
                        <form method="POST" action="{{ route('admin.admins.toggle-status', $adm) }}" style="display:inline;">
                            @csrf @method('PATCH')
                            <button type="submit"
                                    class="am-btn am-btn-sm {{ $adm->status === 'active' ? 'am-btn-ghost' : 'am-btn-ghost' }}"
                                    style="{{ $adm->status ? 'color:#b45309;border-color:#fcd34d;' : 'color:#15803d;border-color:#86efac;' }}"
                                    title="{{ $adm->status ? 'Deactivate' : 'Activate' }}"
                                    onclick="return confirm('{{ $adm->status ? 'Deactivate' : 'Activate' }} {{ addslashes($adm->name) }}?')">
                                <i class="fas {{ $adm->status ? 'fa-ban' : 'fa-check-circle' }}"></i>
                            </button>
                        </form>

                        {{-- Delete --}}
                        <form method="POST" action="{{ route('admin.admins.destroy', $adm) }}" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="am-btn am-btn-red am-btn-sm" title="Delete"
                                    onclick="return confirm('Permanently delete {{ addslashes($adm->name) }}? This cannot be undone.')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @if($admins->hasPages())
    <div class="am-pagination">{{ $admins->links() }}</div>
    @endif

    @else
    <div class="am-empty">
        <i class="fas fa-users-cog"></i>
        <p>No admins found.</p>
    </div>
    @endif
</div>

{{-- PASSWORD RESET MODAL --}}
<div class="am-modal-overlay" id="pwdModal" onclick="if(event.target===this)closePwdModal()">
    <div class="am-modal">
        <div class="am-modal-head">
            <h2 class="am-modal-title"><i class="fas fa-key"></i> Reset Password — <span id="pwd-name"></span></h2>
            <button class="am-modal-close" onclick="closePwdModal()"><i class="fas fa-times"></i></button>
        </div>
        <div class="am-modal-body">
            <form method="POST" id="pwdForm">
                @csrf @method('PATCH')
                <div class="am-form-group">
                    <label>New Password</label>
                    <input type="password" name="password" class="am-input" placeholder="Min 8 chars, letters & numbers" required>
                </div>
                <div class="am-form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="am-input" placeholder="Repeat password" required>
                </div>
                <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:4px;">
                    <button type="button" class="am-btn am-btn-ghost" onclick="closePwdModal()">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary"><i class="fas fa-save"></i> Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>{{-- /.am-wrap --}}

@push('scripts')
<script>
var PWD_BASE = "{{ rtrim(route('admin.admins.index'), '/') }}";

function openPwdModal(id, name) {
    document.getElementById('pwd-name').textContent = name;
    document.getElementById('pwdForm').action = '/admin/admins/' + id + '/reset-password';
    document.getElementById('pwdModal').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closePwdModal() {
    document.getElementById('pwdModal').classList.remove('open');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closePwdModal();
});
</script>
@endpush
@endsection