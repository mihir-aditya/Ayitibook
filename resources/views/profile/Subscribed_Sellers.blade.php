<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Subscriptions</title>
    <!-- Bootstrap 5 + Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* ========== Original & Additional Styles ========== */
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        /* Header & Search */
        .sub-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }
        .sub-header h2 {
            margin: 0;
            color: #1f2937;
            font-size: 1.35rem;
            font-weight: 700;
        }
        .sub-header p {
            margin: .2rem 0 0;
            color: #6b7280;
            font-size: .875rem;
        }
        .search-filter-bar {
            display: flex;
            gap: .6rem;
            align-items: center;
            flex-wrap: wrap;
        }
        .search-filter-bar input,
        .search-filter-bar select {
            padding: .45rem .75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: .875rem;
            color: #374151;
            background: #fff;
        }
        .search-filter-bar input:focus,
        .search-filter-bar select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,.12);
        }
        .search-filter-bar button {
            padding: .45rem .9rem;
            border: 1px solid #3b82f6;
            border-radius: 6px;
            background: #3b82f6;
            color: #fff;
            font-size: .8rem;
            cursor: pointer;
        }

        /* Divider */
        .divider {
            border-top: 1px dashed #e5e7eb;
            margin: 1rem 0 1.5rem;
        }

        /* Seller Cards */
        .seller-card {
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 1rem 1.25rem;
            margin-bottom: 1rem;
            background: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            transition: box-shadow .2s;
        }
        .seller-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,.07);
        }
        .seller-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .seller-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #3b82f6;
            background: #f3f4f6;
            flex-shrink: 0;
        }
        .seller-avatar-placeholder {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg,#3b82f6,#1d4ed8);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.4rem;
            font-weight: 700;
            flex-shrink: 0;
        }
        .seller-details h4 {
            margin: 0 0 .2rem;
            font-size: 1rem;
            color: #111827;
        }
        .seller-details p {
            margin: .15rem 0;
            font-size: .8rem;
            color: #6b7280;
        }
        .seller-details .subscribers-count {
            color: #3b82f6;
        }
        .actions {
            display: flex;
            gap: .5rem;
            flex-shrink: 0;
            flex-wrap: wrap;
        }
        .actions button,
        .actions a {
            padding: .45rem 1rem;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: .8rem;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            transition: all .2s;
        }
        .btn-unsubscribe {
            background: #dc2626;
            color: #fff;
        }
        .btn-unsubscribe:hover {
            background: #b91c1c;
        }
        .btn-visit {
            background: #3b82f6;
            color: #fff;
        }
        .btn-visit:hover {
            background: #2563eb;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #9ca3af;
        }
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #e5e7eb;
            display: block;
        }
        .empty-state h3 {
            color: #6b7280;
            margin-bottom: .4rem;
        }

        /* Recommended Section */
        .recommended {
            margin-top: 2.5rem;
        }
        .recommended h3 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #1f2937;
        }
        .slider-wrapper {
            position: relative;
            overflow: hidden;
        }
        .recommended-list {
            display: flex;
            gap: 1rem;
            transition: transform .5s ease-in-out;
        }
        .recommended-card {
            flex: 0 0 180px;
            text-align: center;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 1.1rem .75rem;
            transition: box-shadow .2s;
        }
        .recommended-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,.08);
        }
        .recommended-card .rec-avatar {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            object-fit: cover;
            background: #f3f4f6;
            margin: 0 auto .5rem;
            display: block;
        }
        .recommended-card .rec-avatar-placeholder {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg,#10b981,#047857);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.2rem;
            font-weight: 700;
            margin: 0 auto .5rem;
        }
        .recommended-card p {
            margin: 0 0 .6rem;
            font-size: .85rem;
            font-weight: 600;
            color: #111827;
        }
        .recommended-card .sub-meta {
            font-size: .72rem;
            color: #9ca3af;
            margin-bottom: .75rem;
        }
        .card-actions {
            display: flex;
            gap: .4rem;
            justify-content: center;
        }
        .card-actions button,
        .card-actions a {
            flex: 1;
            padding: .4rem .3rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: .75rem;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .2rem;
            transition: all .2s;
        }
        .btn-subscribe {
            background: #3b82f6;
            color: #fff;
        }
        .btn-subscribe:hover {
            background: #2563eb;
        }
        .btn-store {
            background: #10b981;
            color: #fff;
        }
        .btn-store:hover {
            background: #059669;
        }

        /* Slider navigation arrows */
        .slider-nav {
            display: flex;
            justify-content: flex-end;
            gap: .4rem;
            margin-bottom: .6rem;
        }
        .slider-nav button {
            width: 30px;
            height: 30px;
            border: 1px solid #d1d5db;
            border-radius: 50%;
            background: #fff;
            cursor: pointer;
            font-size: .8rem;
            color: #374151;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .slider-nav button:hover {
            background: #f3f4f6;
        }

        /* Toast animations */
        @keyframes toastIn {
            from { transform: translateX(110%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes toastOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(110%); opacity: 0; }
        }
    </style>
</head>
<body>

    <!-- Include your header partial (adjust path if needed) -->
    @include('includes.header')

    <div class="container my-4">
        <div class="row">
            <!-- Sidebar (col-3) -->
            <div class="col-lg-3">
                @include('includes.sidebar')
            </div>

            <!-- Main Content (col-9) -->
            <div class="col-lg-9">
                <div class="container">
                    <!-- Header -->
                    <div class="sub-header">
                        <div>
                            <h2><i class="fas fa-store" style="color:#3b82f6; margin-right:.4rem;"></i>My Subscriptions</h2>
                            <p>Stay updated with your favourite sellers</p>
                        </div>

                        <!-- Search + sort (GET form) -->
                        <form method="GET" action="{{ route('profile.page', 'subscribed-sellers') }}" class="search-filter-bar">
                            <input type="text" name="search" placeholder="Search sellers…" value="{{ request('search') }}">
                            <select name="sort" onchange="this.form.submit()">
                                <option value="latest"   {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>Latest Activity</option>
                                <option value="products" {{ request('sort') == 'products' ? 'selected' : '' }}>Most Products</option>
                                <option value="rated"    {{ request('sort') == 'rated' ? 'selected' : '' }}>Top Rated</option>
                            </select>
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>

                    <div class="divider"></div>

                    <!-- Subscribed Sellers List -->
                    @if($subscribedSellers->count())
                        @foreach($subscribedSellers as $seller)
                            <div class="seller-card" id="seller-card-{{ $seller->id }}">
                                <div class="seller-info">
                                    @if($seller->logo ?? null)
                                        <img class="seller-avatar" src="{{ Storage::url($seller->logo) }}" alt="{{ $seller->shop_name }}">
                                    @else
                                        <div class="seller-avatar-placeholder">{{ strtoupper(substr($seller->shop_name, 0, 1)) }}</div>
                                    @endif
                                    <div class="seller-details">
                                        <h4>{{ $seller->shop_name }}</h4>
                                        @if($seller->product_categories)
                                            <p><i class="fas fa-tag fa-xs"></i> {{ implode(', ', array_slice((array)$seller->product_categories, 0, 2)) }}</p>
                                        @endif
                                        <p class="subscribers-count"><i class="fas fa-users fa-xs"></i> {{ number_format($seller->subscribers_count) }} subscribers</p>
                                        <p><i class="fas fa-box fa-xs"></i> {{ number_format($seller->products_count) }} products listed</p>
                                    </div>
                                </div>
                                <div class="actions">
                                    <button class="btn-unsubscribe"
                                            onclick="toggleSubscription({{ $seller->id }}, this)"
                                            data-seller-id="{{ $seller->id }}"
                                            data-subscribed="1"
                                            data-shop="{{ $seller->shop_name }}">
                                        <i class="fas fa-bell-slash"></i> Unsubscribe
                                    </button>
                                    <a href="{{ route('seller.store', $seller) }}" class="btn-visit">
                                        <i class="fas fa-store"></i> Visit Store
                                    </a>
                                </div>
                            </div>
                        @endforeach

                        <!-- Pagination links -->
                        <div style="margin-top: 1rem;">
                            {{ $subscribedSellers->withQueryString()->links() }}
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-bell-slash"></i>
                            <h3>No subscriptions yet</h3>
                            <p>Follow sellers below to get notified about their new products.</p>
                        </div>
                    @endif

                    <!-- Recommended Sellers (if any) -->
                    @if($recommended->count())
                        <div class="recommended">
                            <h3><i class="fas fa-star" style="color:#f59e0b; margin-right:.4rem;"></i>Recommended Sellers</h3>

                            <div class="slider-nav">
                                <button onclick="slideRecommended(-1)" title="Previous"><i class="fas fa-chevron-left"></i></button>
                                <button onclick="slideRecommended(1)"  title="Next"><i class="fas fa-chevron-right"></i></button>
                            </div>

                            <div class="slider-wrapper">
                                <div class="recommended-list" id="recSlider">
                                    @foreach($recommended as $seller)
                                        <div class="recommended-card" id="rec-card-{{ $seller->id }}">
                                            @if($seller->logo ?? null)
                                                <img class="rec-avatar" src="{{ Storage::url($seller->logo) }}" alt="{{ $seller->shop_name }}">
                                            @else
                                                <div class="rec-avatar-placeholder">{{ strtoupper(substr($seller->shop_name, 0, 1)) }}</div>
                                            @endif
                                            <p>{{ $seller->shop_name }}</p>
                                            <div class="sub-meta">{{ number_format($seller->subscribers_count) }} subscribers</div>
                                            <div class="card-actions">
                                                <button class="btn-subscribe"
                                                        onclick="toggleSubscription({{ $seller->id }}, this)"
                                                        data-seller-id="{{ $seller->id }}"
                                                        data-subscribed="0"
                                                        data-shop="{{ $seller->shop_name }}">
                                                    <i class="fas fa-bell"></i> Subscribe
                                                </button>
                                                <a href="{{ route('products', ['seller' => $seller->id]) }}" class="btn-store">
                                                    <i class="fas fa-store"></i> Store
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // CSRF token for AJAX
        const csrfToken = '{{ csrf_token() }}';

        // Toggle subscription (subscribe/unsubscribe) via AJAX
        async function toggleSubscription(sellerId, btn) {
            const subscribed = btn.dataset.subscribed === '1';
            const shop = btn.dataset.shop;

            btn.disabled = true;
            const originalHtml = btn.innerHTML;

            try {
                const method = subscribed ? 'DELETE' : 'POST';
                const response = await fetch(`/sellers/${sellerId}/subscribe`, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                });

                if (!response.ok) throw new Error('Request failed');

                const data = await response.json();

                if (data.subscribed) {
                    // Subscribed
                    btn.dataset.subscribed = '1';
                    btn.innerHTML = '<i class="fas fa-bell-slash"></i> Unsubscribe';
                    btn.className = 'btn-unsubscribe';
                    // Remove from recommended section if present
                    const recCard = document.getElementById(`rec-card-${sellerId}`);
                    if (recCard) recCard.remove();
                    showToast(`Subscribed to ${shop}!`, 'success');
                } else {
                    // Unsubscribed
                    btn.dataset.subscribed = '0';
                    btn.innerHTML = '<i class="fas fa-bell"></i> Subscribe';
                    btn.className = 'btn-subscribe';
                    // Remove from subscribed list
                    const card = document.getElementById(`seller-card-${sellerId}`);
                    if (card) {
                        card.style.transition = 'opacity .3s';
                        card.style.opacity = '0';
                        setTimeout(() => card.remove(), 300);
                    }
                    showToast(`Unsubscribed from ${shop}.`, 'info');
                }
            } catch (error) {
                console.error(error);
                showToast('Something went wrong. Please try again.', 'error');
                btn.innerHTML = originalHtml;
            } finally {
                btn.disabled = false;
            }
        }

        // Recommended slider logic
        const cardWidth = 180 + 16; // card width + gap
        let sliderPos = 0;

        function slideRecommended(direction) {
            const slider = document.getElementById('recSlider');
            if (!slider) return;
            const maxScroll = slider.scrollWidth - slider.parentElement.offsetWidth;
            sliderPos = Math.max(0, Math.min(sliderPos + direction * cardWidth * 3, maxScroll));
            slider.style.transform = `translateX(-${sliderPos}px)`;
        }

        // Auto-slide every 3 seconds
        setInterval(() => {
            const slider = document.getElementById('recSlider');
            if (!slider) return;
            const maxScroll = slider.scrollWidth - slider.parentElement.offsetWidth;
            if (sliderPos >= maxScroll) {
                sliderPos = 0;
            } else {
                sliderPos += cardWidth;
            }
            slider.style.transform = `translateX(-${sliderPos}px)`;
        }, 3000);

        // Simple toast notification
        function showToast(message, type = 'success') {
            const colors = {
                success: '#10b981',
                info: '#3b82f6',
                error: '#ef4444'
            };
            const toast = document.createElement('div');
            toast.textContent = message;
            toast.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                padding: .85rem 1.25rem;
                border-radius: 8px;
                color: #fff;
                font-size: .875rem;
                font-weight: 500;
                box-shadow: 0 4px 12px rgba(0,0,0,.12);
                animation: toastIn .3s ease;
                background: ${colors[type] || colors.info};
            `;
            document.body.appendChild(toast);
            setTimeout(() => {
                toast.style.animation = 'toastOut .3s ease forwards';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
    </script>
</body>
</html>