@extends('seller.layouts.app')

@section('content')
<div class="seller-profile">
    <div class="profile-grid">
        <!-- Left: Profile Card -->
        <aside class="profile-card">
            <div class="avatar-wrap">
                @if(!empty($seller->avatar))
                    <img src="{{ asset('storage/' . $seller->avatar) }}" alt="{{ $seller->name }}" class="avatar-img">
                @else
                    <div class="avatar-placeholder">{{ strtoupper(substr($seller->name ?? 'S', 0, 1)) }}</div>
                @endif
            </div>

            <div class="profile-info">
                <h2 class="seller-name">{{ $seller->name }}</h2>
                <p class="shop-name">{{ $seller->shop_name ?? '—' }}</p>

                <div class="badges">
                    @if($seller->is_verified)
                        <span class="badge badge-verified">Verified</span>
                    @else
                        <span class="badge badge-unverified">Not Verified</span>
                    @endif

                    <span class="badge badge-status">{{ ucfirst($seller->status ?? 'inactive') }}</span>
                </div>
            </div>

            <div class="profile-stats">
                <div class="stat">
                    <span class="stat-value">{{ $seller->products_count ?? '—' }}</span>
                    <span class="stat-label">Products</span>
                </div>
                <div class="stat">
                    <span class="stat-value">{{ $seller->orders_count ?? '—' }}</span>
                    <span class="stat-label">Orders</span>
                </div>
                <div class="stat">
                    <span class="stat-value">{{ $seller->rating ?? '—' }}</span>
                    <span class="stat-label">Rating</span>
                </div>
            </div>

            <div class="card-actions">
                <a href="{{ route('seller.products.index') }}" class="btn btn-outline">Manage Products</a>
                <a href="{{ route('seller.orders.index') }}" class="btn btn-outline">View Orders</a>
            </div>
        </aside>

        <!-- Right: Profile Form -->
        <main class="profile-form-wrap">
            <form method="POST" action="{{ route('seller.profile.update') }}" class="profile-form">
                @csrf

                <h3 class="section-heading">Account Information</h3>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" value="{{ old('name', $seller->name) }}" required class="form-input">
                        @error('name')<span class="error-text">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $seller->email) }}" required class="form-input">
                        @error('email')<span class="error-text">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $seller->phone) }}" class="form-input">
                        @error('phone')<span class="error-text">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Shop Name</label>
                        <input type="text" name="shop_name" value="{{ old('shop_name', $seller->shop_name) }}" class="form-input">
                        @error('shop_name')<span class="error-text">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-row single">
                    <div class="form-group">
                        <label class="form-label">Shop Address</label>
                        <input type="text" name="shop_address" value="{{ old('shop_address', $seller->shop_address) }}" class="form-input">
                        @error('shop_address')<span class="error-text">{{ $message }}</span>@enderror
                    </div>
                </div>

                <h3 class="section-heading">Business Identifiers</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">GST Number</label>
                        <input type="text" name="gst_number" value="{{ old('gst_number', $seller->gst_number) }}" class="form-input">
                        @error('gst_number')<span class="error-text">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">PAN Number</label>
                        <input type="text" name="pan_number" value="{{ old('pan_number', $seller->pan_number) }}" class="form-input">
                        @error('pan_number')<span class="error-text">{{ $message }}</span>@enderror
                    </div>
                </div>

                <h3 class="section-heading">Change Password</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Current Password</label>
                        <input type="password" name="current_password" autocomplete="current-password" class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">New Password</label>
                        <input type="password" name="password" autocomplete="new-password" class="form-input">
                    </div>
                </div>

                <div class="form-row single">
                    <div class="form-group">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" autocomplete="new-password" class="form-input">
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('seller.dashboard') }}" class="btn btn-outline">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </main>
    </div>
</div>

<style>
    :root{
        --primary:#667eea; --secondary:#764ba2; --muted:#6b7280; --bg:#f7fafc;
    }
    .seller-profile{max-width:1100px;margin:0 auto;padding:28px}
    .profile-grid{display:grid;grid-template-columns:320px 1fr;gap:28px}
    .profile-card{background:white;padding:20px;border-radius:12px;border:1px solid #e6edf7;box-shadow:0 8px 30px rgba(102,126,234,0.06);display:flex;flex-direction:column;align-items:center}
    .avatar-wrap{width:140px;height:140px;border-radius:14px;overflow:hidden;border:4px solid rgba(0,0,0,0.04);margin-bottom:14px}
    .avatar-img{width:100%;height:100%;object-fit:cover;display:block;border-radius:10px}
    .avatar-placeholder{width:140px;height:140px;background:linear-gradient(135deg,var(--primary),var(--secondary));color:white;display:flex;align-items:center;justify-content:center;font-size:48px;font-weight:700;border-radius:12px}
    .seller-name{margin:0;font-size:1.25rem;font-weight:700;color:#111827}
    .shop-name{margin:6px 0;color:var(--muted)}
    .badges{display:flex;gap:8px;margin-top:8px}
    .badge{padding:6px 10px;border-radius:999px;font-weight:600;font-size:0.8rem}
    .badge-verified{background:linear-gradient(135deg,#c6f6d5,#9ae6b4);color:#22543d}
    .badge-unverified{background:#fff3cd;color:#856404}
    .badge-status{background:#eef2ff;color:#4338ca}
    .profile-stats{display:flex;gap:12px;margin-top:18px;width:100%;justify-content:space-between}
    .stat{text-align:center}
    .stat-value{display:block;font-weight:700;font-size:1.1rem}
    .stat-label{color:var(--muted);font-size:0.85rem}
    .card-actions{display:flex;gap:8px;margin-top:18px}
    .btn{padding:10px 16px;border-radius:8px;border:none;cursor:pointer;font-weight:600}
    .btn-outline{background:white;border:1px solid #e6edf7;color:#374151}
    .btn-primary{background:linear-gradient(135deg,var(--primary),var(--secondary));color:white}

    .profile-form-wrap{background:white;padding:20px;border-radius:12px;border:1px solid #e6edf7}
    .profile-form .section-heading{font-size:1rem;font-weight:700;margin:0 0 12px 0;color:#111827}
    .form-row{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:12px}
    .form-row.single{grid-template-columns:1fr}
    .form-group{display:flex;flex-direction:column;gap:6px}
    .form-label{font-weight:600;color:#374151}
    .form-input{padding:10px 12px;border-radius:8px;border:1px solid #e6edf7;background:#fff}
    .form-input:focus{outline:none;box-shadow:0 0 0 4px rgba(102,126,234,0.06);border-color:var(--primary)}
    .error-text{color:#dc2626;font-size:0.85rem}
    .form-actions{display:flex;justify-content:flex-end;gap:12px;margin-top:18px}

    @media(max-width:900px){.profile-grid{grid-template-columns:1fr;}.profile-card{flex-direction:row;align-items:flex-start;gap:16px}.avatar-wrap{width:96px;height:96px}.avatar-placeholder{width:96px;height:96px;font-size:28px}.profile-stats{display:none}}
    @media(prefers-reduced-motion:reduce){*{transition:none!important}}
</style>

@endsection
