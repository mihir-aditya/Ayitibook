{{-- resources/views/seller/partials/_sidebar.blade.php --}}
{{-- Usage: @php $seller = Auth::guard('seller')->user(); @endphp --}}
{{-- Then: @include('seller.partials._sidebar', ['active' => 'dashboard']) --}}
@php $seller = $seller ?? Auth::guard('seller')->user(); @endphp
<aside class="sh-sidebar">
    <div class="sh-sidebar-logo">
        <div class="sh-logo-icon">🛍</div>
        <span>SellerHub</span>
    </div>
    <nav class="sh-sidebar-nav">
        <div class="sh-nav-label">Main</div>
        <a href="{{ route('seller.dashboard') }}" class="sh-nav-item {{ ($active ?? '') === 'dashboard' ? 'active' : '' }}">
            <span class="sh-icon">▦</span> Dashboard
        </a>
        <a href="{{ route('seller.products.index') }}" class="sh-nav-item {{ ($active ?? '') === 'products' ? 'active' : '' }}">
            <span class="sh-icon">📦</span> Products
        </a>
        <a href="{{ route('seller.orders.index') }}" class="sh-nav-item {{ ($active ?? '') === 'orders' ? 'active' : '' }}">
            <span class="sh-icon">🛒</span> Orders
            <span class="sh-nav-badge">3</span>
        </a>

        {{-- <div class="sh-nav-label">Finance</div>
        <a href="#" class="sh-nav-item"><span class="sh-icon">💳</span> Payouts</a>
        <a href="#" class="sh-nav-item"><span class="sh-icon">📊</span> Analytics</a> --}}

        <div class="sh-nav-label">Store</div>
        <a href="{{ route('seller.profile.edit') }}" class="sh-nav-item {{ ($active ?? '') === 'profile' ? 'active' : '' }}">
            <span class="sh-icon">🏪</span> Shop Profile
        </a>
        {{-- <a href="#" class="sh-nav-item"><span class="sh-icon">⭐</span> Reviews</a> --}}
        <a href="{{ route('seller.refunds.index') }}" class="sh-nav-item {{ ($active ?? '') === 'refunds' ? 'active' : '' }}">
            <span class="sh-icon">↩️</span> Refunds
        </a>
        {{-- <a href="#" class="sh-nav-item"><span class="sh-icon">🛡</span> Insurance Fund</a> --}}
        {{-- <a href="#" class="sh-nav-item"><span class="sh-icon">⚙️</span> Settings</a> --}}
    </nav>
    <div class="sh-sidebar-footer">
        <div class="sh-seller-card">
            <div class="sh-avatar">{{ strtoupper(substr($seller->name, 0, 1)) }}</div>
            <div class="sh-sc-info">
                <div class="sh-sc-name">{{ $seller->shop_name }}</div>
                <div class="sh-sc-role">Seller · {{ ucfirst($seller->status) }}</div>
            </div>
            <div class="sh-online"></div>
        </div>
    </div>
</aside>