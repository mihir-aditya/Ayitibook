<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $seller->shop_name ?? $seller->name }} — Store</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">

    {{-- Vendor CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">

    {{-- Site CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Boxicons --}}
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js" defer></script>

    <style>
        /* =========================================================
           SELLER STORE PAGE — CUSTOM STYLES
           Follows existing site conventions:
             - CSS variables from style.css (--bs-primary, etc.)
             - Bootstrap 5 grid
             - Same card / button patterns as product listing pages
        ========================================================= */

        body { overflow-x: hidden; }

        /* ── Store Hero Banner ───────────────────────────────────── */
        .store-hero {
            position: relative;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 40%, #0f3460 100%);
            overflow: hidden;
            padding: 0;
        }

        .store-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 70% 50%, rgba(var(--bs-primary-rgb, 220,53,69), .18) 0%, transparent 70%),
                radial-gradient(ellipse 40% 50% at 10% 80%, rgba(255,106,0,.12) 0%, transparent 60%);
            pointer-events: none;
        }

        .store-hero-inner {
            position: relative;
            z-index: 2;
            padding: 48px 0 40px;
        }

        /* avatar ring */
        .store-avatar-wrap {
            position: relative;
            display: inline-block;
        }
        .store-avatar {
            width: 96px;
            height: 96px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255,255,255,.25);
            background: rgba(255,255,255,.08);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 38px;
            color: #fff;
            font-weight: 700;
        }
        .store-avatar img { width: 96px; height: 96px; border-radius: 50%; object-fit: cover; }
        .store-verified-badge {
            position: absolute;
            bottom: 4px;
            right: 4px;
            width: 22px;
            height: 22px;
            background: #22c55e;
            border-radius: 50%;
            border: 2px solid #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: #fff;
        }

        /* store name & meta */
        .store-name {
            font-size: clamp(1.5rem, 4vw, 2.2rem);
            font-weight: 800;
            color: #fff;
            margin: 0 0 4px;
            font-family: 'Poppins', sans-serif;
            letter-spacing: -.4px;
        }
        .store-shop-slug {
            font-size: .85rem;
            color: rgba(255,255,255,.55);
            margin: 0 0 10px;
        }
        .store-meta-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 16px;
        }
        .store-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: .75rem;
            font-weight: 500;
        }
        .store-badge.verified  { background: rgba(34,197,94,.15);  color: #4ade80; border: 1px solid rgba(34,197,94,.3); }
        .store-badge.location  { background: rgba(255,255,255,.08); color: rgba(255,255,255,.8); border: 1px solid rgba(255,255,255,.15); }
        .store-badge.cod       { background: rgba(59,130,246,.15);  color: #93c5fd; border: 1px solid rgba(59,130,246,.3); }

        /* stats row */
        .store-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 28px;
            margin-top: 4px;
        }
        .store-stat { text-align: center; }
        .store-stat .num {
            font-size: 1.5rem;
            font-weight: 800;
            color: #fff;
            line-height: 1;
            font-family: 'Poppins', sans-serif;
        }
        .store-stat .lbl {
            font-size: .72rem;
            color: rgba(255,255,255,.5);
            text-transform: uppercase;
            letter-spacing: .08em;
            margin-top: 3px;
        }
        .store-stat-divider {
            width: 1px;
            height: 40px;
            background: rgba(255,255,255,.15);
            align-self: center;
        }

        /* subscribe button */
        .btn-subscribe {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 22px;
            border-radius: 30px;
            font-size: .875rem;
            font-weight: 600;
            border: 2px solid rgba(255,255,255,.4);
            color: #fff;
            background: rgba(255,255,255,.1);
            backdrop-filter: blur(8px);
            transition: all .25s ease;
            cursor: pointer;
            white-space: nowrap;
        }
        .btn-subscribe:hover,
        .btn-subscribe:focus {
            background: rgba(255,255,255,.2);
            border-color: rgba(255,255,255,.65);
            color: #fff;
        }
        .btn-subscribe.subscribed {
            background: rgba(34,197,94,.2);
            border-color: rgba(34,197,94,.5);
            color: #4ade80;
        }
        .btn-subscribe.subscribed:hover {
            background: rgba(239,68,68,.15);
            border-color: rgba(239,68,68,.45);
            color: #fca5a5;
        }
        .btn-subscribe .sub-icon { font-size: 1rem; }
        .btn-subscribe .sub-count {
            font-size: .75rem;
            opacity: .7;
            font-weight: 400;
        }

        /* ── Content Area ────────────────────────────────────────── */
        .store-content { padding: 32px 0 60px; }

        /* ── Filter Sidebar ─────────────────────────────────────── */
        .filter-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 1px 8px rgba(0,0,0,.07);
            padding: 20px;
            margin-bottom: 20px;
        }
        .filter-card-title {
            font-size: .78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: #6b7280;
            margin-bottom: 14px;
        }
        .filter-category-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            background: none;
            border: none;
            padding: 7px 10px;
            border-radius: 8px;
            font-size: .875rem;
            color: #374151;
            cursor: pointer;
            transition: background .15s;
            text-align: left;
        }
        .filter-category-btn:hover,
        .filter-category-btn.active {
            background: rgba(var(--bs-primary-rgb, 220,53,69), .08);
            color: var(--bs-primary, #dc3545);
            font-weight: 600;
        }
        .filter-category-btn .cat-count {
            font-size: .72rem;
            background: #f3f4f6;
            color: #6b7280;
            padding: 2px 7px;
            border-radius: 10px;
        }
        .filter-category-btn.active .cat-count {
            background: rgba(var(--bs-primary-rgb, 220,53,69), .1);
            color: var(--bs-primary, #dc3545);
        }

        /* price inputs */
        .price-input-row { display: flex; gap: 8px; align-items: center; }
        .price-input-row input {
            width: 0;
            flex: 1;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 7px 10px;
            font-size: .875rem;
            color: #374151;
            outline: none;
            transition: border-color .2s;
        }
        .price-input-row input:focus { border-color: var(--bs-primary, #dc3545); }
        .price-input-row span { color: #9ca3af; font-size: .85rem; }

        .filter-apply-btn {
            width: 100%;
            padding: 9px;
            border-radius: 8px;
            background: var(--bs-primary, #dc3545);
            color: #fff;
            font-weight: 600;
            font-size: .875rem;
            border: none;
            cursor: pointer;
            margin-top: 12px;
            transition: opacity .2s;
        }
        .filter-apply-btn:hover { opacity: .88; }

        /* stock toggle */
        .stock-toggle {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }
        .toggle-switch {
            width: 38px; height: 20px;
            background: #e5e7eb;
            border-radius: 10px;
            position: relative;
            transition: background .2s;
            flex-shrink: 0;
        }
        .toggle-switch::after {
            content: "";
            position: absolute;
            width: 16px; height: 16px;
            background: #fff;
            border-radius: 50%;
            top: 2px; left: 2px;
            transition: transform .2s, box-shadow .2s;
            box-shadow: 0 1px 3px rgba(0,0,0,.2);
        }
        input[type="checkbox"].toggle-input:checked ~ .toggle-switch { background: var(--bs-primary, #dc3545); }
        input[type="checkbox"].toggle-input:checked ~ .toggle-switch::after { transform: translateX(18px); }
        input[type="checkbox"].toggle-input { display: none; }
        .toggle-label { font-size: .875rem; color: #374151; cursor: pointer; }

        /* ── Toolbar ─────────────────────────────────────────────── */
        .store-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 20px;
        }
        .toolbar-count {
            font-size: .875rem;
            color: #6b7280;
        }
        .toolbar-count strong { color: #111827; }
        .sort-select {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 8px 14px;
            font-size: .875rem;
            color: #374151;
            background: #fff;
            cursor: pointer;
            outline: none;
            transition: border-color .2s;
        }
        .sort-select:focus { border-color: var(--bs-primary, #dc3545); }

        .search-store-wrap {
            position: relative;
            flex: 1;
            max-width: 360px;
        }
        .search-store-wrap input {
            width: 100%;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 8px 14px 8px 38px;
            font-size: .875rem;
            outline: none;
            transition: border-color .2s;
        }
        .search-store-wrap input:focus { border-color: var(--bs-primary, #dc3545); }
        .search-store-wrap i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 1rem;
        }

        /* ── Product Grid / Card ─────────────────────────────────── */
        /* Reuses existing card patterns from the site */
        .store-product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 16px;
        }

        .product-card-store {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 1px 6px rgba(0,0,0,.07);
            overflow: hidden;
            transition: box-shadow .25s, transform .25s;
            position: relative;
            display: flex;
            flex-direction: column;
        }
        .product-card-store:hover {
            box-shadow: 0 8px 28px rgba(0,0,0,.13);
            transform: translateY(-3px);
        }

        .product-card-store .img-wrap {
            position: relative;
            aspect-ratio: 1 / 1;
            overflow: hidden;
            background: #f9fafb;
        }
        .product-card-store .img-wrap img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform .4s ease;
        }
        .product-card-store:hover .img-wrap img { transform: scale(1.06); }

        /* badges on image */
        .card-badge {
            position: absolute;
            top: 8px; left: 8px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            z-index: 2;
        }
        .badge-discount {
            background: var(--bs-primary, #dc3545);
            color: #fff;
            font-size: .68rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 4px;
        }
        .badge-flash {
            background: #f59e0b;
            color: #fff;
            font-size: .68rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 4px;
        }
        .badge-out-stock {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,.45);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 3;
        }
        .badge-out-stock span {
            background: rgba(0,0,0,.7);
            color: #fff;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: .75rem;
            font-weight: 600;
        }

        /* quick action buttons on hover */
        .card-actions {
            position: absolute;
            top: 8px; right: 8px;
            display: flex;
            flex-direction: column;
            gap: 6px;
            z-index: 4;
            opacity: 0;
            transform: translateX(8px);
            transition: opacity .25s, transform .25s;
        }
        .product-card-store:hover .card-actions {
            opacity: 1;
            transform: translateX(0);
        }
        .card-action-btn {
            width: 32px; height: 32px;
            border-radius: 50%;
            background: #fff;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .9rem;
            color: #374151;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0,0,0,.12);
            transition: background .15s, color .15s;
        }
        .card-action-btn:hover { background: var(--bs-primary, #dc3545); color: #fff; }

        .product-card-store .card-body { padding: 12px; flex: 1; display: flex; flex-direction: column; }

        .product-card-store .cat-label {
            font-size: .68rem;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: .07em;
            margin-bottom: 4px;
        }
        .product-card-store .product-name {
            font-size: .875rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 6px;
            line-height: 1.35;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .product-card-store .rating-row {
            display: flex;
            align-items: center;
            gap: 4px;
            margin-bottom: 8px;
        }
        .product-card-store .stars { color: #f59e0b; font-size: .75rem; }
        .product-card-store .rating-num { font-size: .72rem; color: #6b7280; }

        .product-card-store .price-row {
            display: flex;
            align-items: baseline;
            gap: 6px;
            margin-top: auto;
            margin-bottom: 10px;
        }
        .product-card-store .final-price {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--bs-primary, #dc3545);
        }
        .product-card-store .orig-price {
            font-size: .8rem;
            color: #9ca3af;
            text-decoration: line-through;
        }

        .btn-add-cart {
            width: 100%;
            padding: 8px;
            border-radius: 8px;
            border: 1.5px solid var(--bs-primary, #dc3545);
            background: transparent;
            color: var(--bs-primary, #dc3545);
            font-size: .8rem;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s, color .2s;
        }
        .btn-add-cart:hover {
            background: var(--bs-primary, #dc3545);
            color: #fff;
        }

        /* ── Empty state ─────────────────────────────────────────── */
        .store-empty {
            text-align: center;
            padding: 64px 20px;
        }
        .store-empty i { font-size: 56px; color: #d1d5db; margin-bottom: 16px; }
        .store-empty h5 { font-weight: 700; color: #374151; margin-bottom: 8px; }
        .store-empty p { color: #9ca3af; font-size: .9rem; }

        /* ── Pagination ──────────────────────────────────────────── */
        .store-pagination .pagination {
            --bs-pagination-border-radius: 8px;
            gap: 4px;
        }
        .store-pagination .page-link {
            border-radius: 8px !important;
            color: #374151;
            border: 1px solid #e5e7eb;
            font-size: .875rem;
            padding: 6px 12px;
        }
        .store-pagination .page-item.active .page-link {
            background: var(--bs-primary, #dc3545);
            border-color: var(--bs-primary, #dc3545);
        }

        /* ── Mobile collapsible filter ───────────────────────────── */
        @media (max-width: 767px) {
            .store-hero-inner { padding: 32px 0 28px; }
            .store-stats { gap: 16px; }
            .store-stat .num { font-size: 1.2rem; }
            .store-product-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; }
            .mobile-filter-toggle {
                display: inline-flex !important;
                align-items: center;
                gap: 6px;
                padding: 8px 16px;
                border-radius: 8px;
                border: 1px solid #e5e7eb;
                background: #fff;
                font-size: .875rem;
                font-weight: 500;
                cursor: pointer;
            }
            #filter-sidebar { display: none; }
            #filter-sidebar.open { display: block; }
        }
        @media (min-width: 768px) {
            .mobile-filter-toggle { display: none !important; }
            #filter-sidebar { display: block !important; }
        }
    </style>
</head>

<body>
    @include('includes.header')

    <div class="page-wrapper">
        <main class="main-wrapper">

            {{-- ═══════════════════════════════════════════════════════
                 STORE HERO BANNER
            ════════════════════════════════════════════════════════ --}}
            <section class="store-hero">
                <div class="store-hero-inner">
                    <div class="container">
                        <div class="row align-items-center g-4">

                            {{-- Avatar + Name --}}
                            <div class="col-12 col-md-7">
                                <div class="d-flex align-items-center gap-4">
                                    <div class="store-avatar-wrap flex-shrink-0">
                                        <div class="store-avatar">
                                            @if ($seller->logo ?? false)
                                                <img src="{{ asset('storage/' . $seller->logo) }}" alt="{{ $seller->shop_name }}">
                                            @else
                                                {{ strtoupper(substr($seller->shop_name ?? $seller->name, 0, 1)) }}
                                            @endif
                                        </div>
                                        @if ($seller->is_verified)
                                            <div class="store-verified-badge" title="Verified Seller">
                                                <i class="fas fa-check" style="font-size:9px;"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <div>
                                        <h1 class="store-name">{{ $seller->shop_name ?? $seller->name }}</h1>
                                        @if ($seller->shop_slug)
                                            <p class="store-shop-slug">@ {{ $seller->shop_slug }}</p>
                                        @endif

                                        <div class="store-meta-badges">
                                            @if ($seller->is_verified)
                                                <span class="store-badge verified">
                                                    <i class="fas fa-shield-alt"></i> Verified Seller
                                                </span>
                                            @endif
                                            @if ($seller->shop_address || $seller->municipality)
                                                <span class="store-badge location">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    {{ $seller->municipality ?? $seller->shop_address }}
                                                </span>
                                            @endif
                                            @if ($seller->accepts_cod)
                                                <span class="store-badge cod">
                                                    <i class="fas fa-money-bill-wave"></i> Cash on Delivery
                                                </span>
                                            @endif
                                        </div>

                                        {{-- Stats row --}}
                                        <div class="store-stats">
                                            <div class="store-stat">
                                                <div class="num">{{ number_format($totalProducts) }}</div>
                                                <div class="lbl">Products</div>
                                            </div>
                                            <div class="store-stat-divider"></div>
                                            <div class="store-stat">
                                                <div class="num">{{ number_format($totalSales) }}</div>
                                                <div class="lbl">Sales</div>
                                            </div>
                                            <div class="store-stat-divider"></div>
                                            <div class="store-stat" id="subscriber-count-stat">
                                                <div class="num" id="subscriber-count-num">{{ number_format($subscriberCount) }}</div>
                                                <div class="lbl">Followers</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Subscribe CTA --}}
                            <div class="col-12 col-md-5 d-flex justify-content-md-end align-items-center gap-3">
                                @auth
                                    <button class="btn-subscribe {{ $isSubscribed ? 'subscribed' : '' }}"
                                            id="subscribe-btn"
                                            data-seller-id="{{ $seller->id }}"
                                            data-subscribed="{{ $isSubscribed ? '1' : '0' }}">
                                        <i class="bx {{ $isSubscribed ? 'bx-check-circle' : 'bx-bell' }} sub-icon"></i>
                                        <span id="subscribe-label">{{ $isSubscribed ? 'Following' : 'Follow Store' }}</span>
                                        <span class="sub-count" id="subscribe-count-badge">({{ number_format($subscriberCount) }})</span>
                                    </button>
                                @else
                                    <a href="{{ route('login') }}" class="btn-subscribe">
                                        <i class="bx bx-bell sub-icon"></i>
                                        Follow Store
                                    </a>
                                @endauth
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            {{-- END Store Hero --}}

            {{-- ═══════════════════════════════════════════════════════
                 BREADCRUMB
            ════════════════════════════════════════════════════════ --}}
            <div class="container py-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0" style="font-size:.85rem;">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none" style="color:var(--bs-primary);">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('seller.store', $seller) }}" class="text-decoration-none" style="color:var(--bs-primary);">Stores</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $seller->shop_name ?? $seller->name }}</li>
                    </ol>
                </nav>
            </div>

            {{-- ═══════════════════════════════════════════════════════
                 MAIN CONTENT  (sidebar + products)
            ════════════════════════════════════════════════════════ --}}
            <section class="store-content">
                <div class="container">
                    <div class="row g-4">

                        {{-- ── LEFT SIDEBAR ───────────────────────── --}}
                        <div class="col-12 col-md-3">

                            {{-- Mobile filter toggle --}}
                            <button class="mobile-filter-toggle mb-3 w-100" onclick="document.getElementById('filter-sidebar').classList.toggle('open')">
                                <i class="bx bx-filter-alt"></i> Filters
                            </button>

                            <form method="GET" action="{{ route('seller.store', $seller) }}" id="filter-sidebar">

                                {{-- Keep search & sort in filter form --}}
                                <input type="hidden" name="q"    value="{{ $search }}">
                                <input type="hidden" name="sort" value="{{ $sort }}">

                                {{-- Categories --}}
                                @if ($sellerCategories->isNotEmpty())
                                <div class="filter-card">
                                    <div class="filter-card-title">Categories</div>
                                    <button type="submit" name="category_id" value=""
                                            class="filter-category-btn {{ !$categoryId ? 'active' : '' }}">
                                        All Products
                                        <span class="cat-count">{{ $totalProducts }}</span>
                                    </button>
                                    @foreach ($sellerCategories as $cat)
                                        <button type="submit" name="category_id" value="{{ $cat->id }}"
                                                class="filter-category-btn {{ $categoryId == $cat->id ? 'active' : '' }}">
                                            {{ $cat->name }}
                                            <span class="cat-count">{{ $cat->products_count }}</span>
                                        </button>
                                    @endforeach
                                </div>
                                @endif

                                {{-- Price Range --}}
                                <div class="filter-card">
                                    <div class="filter-card-title">Price Range</div>
                                    <div class="price-input-row">
                                        <input type="number" name="min_price" placeholder="Min" value="{{ $minPrice }}" min="0">
                                        <span>—</span>
                                        <input type="number" name="max_price" placeholder="Max" value="{{ $maxPrice }}" min="0">
                                    </div>
                                    @if ($categoryId)
                                        <input type="hidden" name="category_id" value="{{ $categoryId }}">
                                    @endif
                                    <button type="submit" class="filter-apply-btn">Apply</button>
                                </div>

                                {{-- In Stock Toggle --}}
                                <div class="filter-card">
                                    <div class="filter-card-title">Availability</div>
                                    <label class="stock-toggle">
                                        <input type="checkbox" name="in_stock" value="1"
                                               class="toggle-input" id="in-stock-check"
                                               {{ $inStock ? 'checked' : '' }}
                                               onchange="this.form.submit()">
                                        <div class="toggle-switch"></div>
                                        <span class="toggle-label">In Stock Only</span>
                                    </label>
                                </div>

                            </form>
                        </div>
                        {{-- END sidebar --}}

                        {{-- ── MAIN PRODUCTS COLUMN ───────────────── --}}
                        <div class="col-12 col-md-9">

                            {{-- Toolbar --}}
                            <div class="store-toolbar">
                                {{-- Search within store --}}
                                <form method="GET" action="{{ route('seller.store', $seller) }}" class="search-store-wrap">
                                    @if ($categoryId) <input type="hidden" name="category_id" value="{{ $categoryId }}"> @endif
                                    @if ($minPrice)   <input type="hidden" name="min_price"   value="{{ $minPrice }}"> @endif
                                    @if ($maxPrice)   <input type="hidden" name="max_price"   value="{{ $maxPrice }}"> @endif
                                    @if ($inStock)    <input type="hidden" name="in_stock"    value="1"> @endif
                                    <input type="hidden" name="sort" value="{{ $sort }}">
                                    <i class="bx bx-search"></i>
                                    <input type="text" name="q" value="{{ $search }}" placeholder="Search in this store…" autocomplete="off">
                                </form>

                                <div class="d-flex align-items-center gap-2">
                                    <span class="toolbar-count">
                                        <strong>{{ $products->total() }}</strong> product{{ $products->total() != 1 ? 's' : '' }}
                                    </span>

                                    {{-- Sort --}}
                                    <form method="GET" action="{{ route('seller.store', $seller) }}" id="sort-form">
                                        @if ($search)     <input type="hidden" name="q"           value="{{ $search }}"> @endif
                                        @if ($categoryId) <input type="hidden" name="category_id" value="{{ $categoryId }}"> @endif
                                        @if ($minPrice)   <input type="hidden" name="min_price"   value="{{ $minPrice }}"> @endif
                                        @if ($maxPrice)   <input type="hidden" name="max_price"   value="{{ $maxPrice }}"> @endif
                                        @if ($inStock)    <input type="hidden" name="in_stock"    value="1"> @endif
                                        <select name="sort" class="sort-select" onchange="document.getElementById('sort-form').submit()">
                                            <option value="newest"      {{ $sort === 'newest'      ? 'selected' : '' }}>Newest</option>
                                            <option value="best_selling"{{ $sort === 'best_selling'? 'selected' : '' }}>Best Selling</option>
                                            <option value="price_asc"   {{ $sort === 'price_asc'   ? 'selected' : '' }}>Price: Low–High</option>
                                            <option value="price_desc"  {{ $sort === 'price_desc'  ? 'selected' : '' }}>Price: High–Low</option>
                                            <option value="name_asc"    {{ $sort === 'name_asc'    ? 'selected' : '' }}>Name A–Z</option>
                                        </select>
                                    </form>
                                </div>
                            </div>

                            {{-- Active filter chips --}}
                            @if ($search || $categoryId || $minPrice || $maxPrice || $inStock)
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                @if ($search)
                                    <a href="{{ route('seller.store', array_merge(request()->except(['q']), ['seller' => $seller->id])) }}"
                                       class="badge rounded-pill text-bg-secondary text-decoration-none d-inline-flex align-items-center gap-1">
                                        "{{ $search }}" <i class="bx bx-x"></i>
                                    </a>
                                @endif
                                @if ($categoryId)
                                    @php $activeCat = $sellerCategories->firstWhere('id', $categoryId); @endphp
                                    <a href="{{ route('seller.store', array_merge(request()->except(['category_id']), ['seller' => $seller->id])) }}"
                                       class="badge rounded-pill text-bg-secondary text-decoration-none d-inline-flex align-items-center gap-1">
                                        {{ $activeCat->name ?? 'Category' }} <i class="bx bx-x"></i>
                                    </a>
                                @endif
                                @if ($minPrice || $maxPrice)
                                    <a href="{{ route('seller.store', array_merge(request()->except(['min_price','max_price']), ['seller' => $seller->id])) }}"
                                       class="badge rounded-pill text-bg-secondary text-decoration-none d-inline-flex align-items-center gap-1">
                                        Price @if($minPrice) ≥ {{ $minPrice }} @endif @if($maxPrice) ≤ {{ $maxPrice }} @endif
                                        <i class="bx bx-x"></i>
                                    </a>
                                @endif
                                @if ($inStock)
                                    <a href="{{ route('seller.store', array_merge(request()->except(['in_stock']), ['seller' => $seller->id])) }}"
                                       class="badge rounded-pill text-bg-secondary text-decoration-none d-inline-flex align-items-center gap-1">
                                        In Stock <i class="bx bx-x"></i>
                                    </a>
                                @endif
                                <a href="{{ route('seller.store', $seller) }}"
                                   class="badge rounded-pill text-bg-danger text-decoration-none">
                                    Clear All
                                </a>
                            </div>
                            @endif

                            {{-- Product Grid --}}
                            @if ($products->isNotEmpty())
                                <div class="store-product-grid">
                                    @foreach ($products as $product)
                                    @php
                                        $thumb = $product->thumbnail
                                            ? asset('storage/' . $product->thumbnail)
                                            : ((!empty($product->images[0])) ? asset('storage/' . $product->images[0]) : asset('assets/images/placeholder.png'));
                                        $hasDiscount = $product->discount_percentage > 0;
                                    @endphp
                                    <div class="product-card-store">
                                        {{-- Image --}}
                                        <div class="img-wrap">
                                            <a href="{{ route('product-details', $product->id) }}">
                                                <img src="{{ $thumb }}"
                                                     alt="{{ $product->name }}"
                                                     loading="lazy">
                                            </a>

                                            {{-- Badges --}}
                                            <div class="card-badge">
                                                @if ($hasDiscount)
                                                    <span class="badge-discount">-{{ round($product->discount_percentage) }}%</span>
                                                @endif
                                                @if ($product->is_flash_sale)
                                                    <span class="badge-flash">⚡ Flash</span>
                                                @endif
                                            </div>

                                            {{-- Out of stock overlay --}}
                                            @if ($product->stock_quantity <= 0 && !$product->show_stock_out)
                                                <div class="badge-out-stock">
                                                    <span>Out of Stock</span>
                                                </div>
                                            @endif

                                            {{-- Hover actions --}}
                                            <div class="card-actions">
                                                <button class="card-action-btn" title="Add to Wishlist"
                                                        onclick="event.preventDefault()">
                                                    <i class="bx bx-heart"></i>
                                                </button>
                                                <a href="{{ route('product-details', $product->id) }}"
                                                   class="card-action-btn" title="Quick View">
                                                    <i class="bx bx-show"></i>
                                                </a>
                                            </div>
                                        </div>

                                        {{-- Card Body --}}
                                        <div class="card-body">
                                            @if ($product->category)
                                                <div class="cat-label">{{ $product->category->name }}</div>
                                            @endif

                                            <a href="{{ route('product-details', $product->id) }}"
                                               class="text-decoration-none">
                                                <div class="product-name">{{ $product->name }}</div>
                                            </a>

                                            {{-- Rating --}}
                                            @if ($product->reviews_count > 0)
                                            <div class="rating-row">
                                                <div class="stars">
                                                    @for ($s = 1; $s <= 5; $s++)
                                                        <i class="fas fa-star{{ $s <= round($product->avg_rating) ? '' : ($s - 0.5 <= $product->avg_rating ? '-half-alt' : '-o') }}"></i>
                                                    @endfor
                                                </div>
                                                <span class="rating-num">({{ $product->reviews_count }})</span>
                                            </div>
                                            @endif

                                            {{-- Price --}}
                                            <div class="price-row">
                                                <span class="final-price">
                                                    {{ $product->currency ?? '$' }}{{ number_format($product->final_price, 2) }}
                                                </span>
                                                @if ($hasDiscount)
                                                    <span class="orig-price">
                                                        {{ $product->currency ?? '$' }}{{ number_format($product->price, 2) }}
                                                    </span>
                                                @endif
                                            </div>

                                            {{-- Add to Cart --}}
                                            @if ($product->stock_quantity > 0 || $product->show_stock_out)
                                                <button class="btn-add-cart"
                                                        onclick="addToCart({{ $product->id }})">
                                                    <i class="bx bx-cart-add"></i> Add to Cart
                                                </button>
                                            @else
                                                <button class="btn-add-cart" disabled style="opacity:.5;cursor:not-allowed;">
                                                    Out of Stock
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                {{-- Pagination --}}
                                @if ($products->hasPages())
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $products->links('pagination::bootstrap-5') }}
                                </div>
                                @endif
                                {{-- @if(method_exists($orders, 'links'))
          <div class="d-flex justify-content-center mt-4">
            {{ $orders->appends(request()->query())->links('pagination::bootstrap-5') }}
          </div>
        @endif --}}

                            @else
                                <div class="store-empty">
                                    <i class="bx bx-package"></i>
                                    <h5>No Products Found</h5>
                                    <p>
                                        @if ($search || $categoryId || $minPrice || $maxPrice || $inStock)
                                            Try adjusting your filters or
                                            <a href="{{ route('seller.store', $seller) }}" style="color:var(--bs-primary);">clear all</a>.
                                        @else
                                            This seller hasn't listed any products yet.
                                        @endif
                                    </p>
                                </div>
                            @endif

                        </div>
                        {{-- END products column --}}

                    </div>
                </div>
            </section>

        </main>
    </div>

    @include('includes.footer')

    {{-- Scripts --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/mobile.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // ── Subscribe / Unsubscribe ─────────────────────────────────────
        const subscribeBtn = document.getElementById('subscribe-btn');

        if (subscribeBtn) {
            subscribeBtn.addEventListener('click', async function () {
                const sellerId   = this.dataset.sellerId;
                const subscribed = this.dataset.subscribed === '1';
                const csrfToken  = document.querySelector('meta[name="csrf-token"]').content;

                this.disabled = true;

                try {
                    const res  = await fetch(`/store/${sellerId}/subscribe`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                    });
                    const data = await res.json();

                    if (res.ok) {
                        // Update button state
                        this.dataset.subscribed = data.subscribed ? '1' : '0';

                        const icon  = this.querySelector('.sub-icon');
                        const label = document.getElementById('subscribe-label');
                        const count = document.getElementById('subscribe-count-badge');
                        const statNum = document.getElementById('subscriber-count-num');

                        if (data.subscribed) {
                            this.classList.add('subscribed');
                            icon.className  = 'bx bx-check-circle sub-icon';
                            label.textContent = 'Following';
                        } else {
                            this.classList.remove('subscribed');
                            icon.className  = 'bx bx-bell sub-icon';
                            label.textContent = 'Follow Store';
                        }

                        const fmt = new Intl.NumberFormat();
                        if (count)   count.textContent   = `(${fmt.format(data.subscriber_count)})`;
                        if (statNum) statNum.textContent = fmt.format(data.subscriber_count);
                    }
                } catch (err) {
                    console.error('Subscribe error:', err);
                } finally {
                    this.disabled = false;
                }
            });
        }

        // ── Add to Cart (wire to your existing cart logic) ─────────────
        function addToCart(productId) {
            // Replace with your site's actual cart AJAX call
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ product_id: productId, quantity: 1 }),
            })
            .then(r => r.json())
            .then(data => {
                // Update cart count badge if it exists in your header
                if (data.cart_count !== undefined) {
                    const badge = document.querySelector('.cart-count, #cart-count, [data-cart-count]');
                    if (badge) badge.textContent = data.cart_count;
                }
            })
            .catch(console.error);
        }
    </script>
</body>
</html>