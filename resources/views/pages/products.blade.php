<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shop — AyitiBook</title>
    <meta charset="UTF-8">
    <meta name="author" content="AyitiBook">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="assets/images/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-touch-icon.png">

    <link rel="stylesheet" type="text/css" href="assets/vendor/fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
    <link rel="stylesheet" type="text/css" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/header.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <style>
        /* ── Global ─────────────────────────────────────── */
        :root {
            --red:    #db4444;
            --dark:   #1d1f22;
            --mid:    #4a4a5a;
            --light:  #f5f5f5;
            --border: #e8e8e8;
            --white:  #ffffff;
            --shadow: 0 4px 20px rgba(0,0,0,.08);
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            overflow-x: hidden;
            font-family: 'Poppins', sans-serif;
            color: var(--dark);
            background: #fafafa;
        }

        /* ── Breadcrumb ──────────────────────────────────── */
        .breadcrumb-section {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 14px 0;
        }

        .breadcrumb-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            color: var(--mid);
        }

        .breadcrumb-wrap a {
            color: var(--mid);
            text-decoration: none;
            transition: color .2s;
        }

        .breadcrumb-wrap a:hover { color: var(--red); }

        .breadcrumb-wrap span.sep { color: #bbb; }

        .breadcrumb-wrap span.active { color: var(--dark); font-weight: 500; }

        /* ── Page Hero ───────────────────────────────────── */
        .shop-hero {
            background: linear-gradient(135deg, #fff5f5 0%, #fff 60%);
            padding: 36px 0 28px;
            border-bottom: 1px solid var(--border);
        }

        .shop-hero h1 {
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 4px;
        }

        .shop-hero p {
            color: var(--mid);
            font-size: 14px;
            margin: 0;
        }

        .hero-stats {
            display: flex;
            gap: 24px;
            align-items: center;
        }

        .hero-stat {
            text-align: center;
        }

        .hero-stat strong {
            display: block;
            font-size: 22px;
            font-weight: 700;
            color: var(--red);
            line-height: 1;
        }

        .hero-stat small {
            font-size: 11px;
            color: var(--mid);
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        /* ── Layout ──────────────────────────────────────── */
        .shop-layout {
            display: grid;
            grid-template-columns: 256px 1fr;
            gap: 28px;
            padding: 32px 0 60px;
        }

        @media (max-width: 991px) {
            .shop-layout {
                grid-template-columns: 1fr;
            }
            .sidebar {
                display: none;
            }
            .sidebar.mobile-open {
                display: block;
                position: fixed;
                top: 0; left: 0;
                width: 280px;
                height: 100%;
                background: white;
                z-index: 999;
                overflow-y: auto;
                padding: 20px;
                box-shadow: 4px 0 20px rgba(0,0,0,.15);
            }
        }

        /* ── Sidebar ─────────────────────────────────────── */
        .sidebar {
            align-self: start;
            position: sticky;
            top: 80px;
        }

        .filter-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 16px;
        }

        .filter-card-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
            cursor: pointer;
        }

        .filter-card-head h5 {
            font-size: 14px;
            font-weight: 600;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        .filter-card-head .toggle-icon {
            font-size: 18px;
            color: var(--mid);
            transition: transform .25s;
        }

        .filter-card-head.collapsed .toggle-icon {
            transform: rotate(-90deg);
        }

        .filter-body {}

        /* Category filter */
        .cat-filter-list { list-style: none; padding: 0; margin: 0; }

        .cat-filter-list li {
            margin-bottom: 6px;
        }

        .cat-filter-list li a {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 10px;
            border-radius: 6px;
            text-decoration: none;
            color: var(--mid);
            font-size: 13.5px;
            transition: background .2s, color .2s;
        }

        .cat-filter-list li a:hover,
        .cat-filter-list li a.active {
            background: #fff0f0;
            color: var(--red);
            font-weight: 500;
        }

        .cat-filter-list li a .count {
            background: var(--light);
            border-radius: 20px;
            padding: 1px 8px;
            font-size: 11px;
            color: var(--mid);
        }

        .cat-filter-list li a.active .count {
            background: #ffd5d5;
            color: var(--red);
        }

        .cat-sub-list {
            list-style: none;
            padding: 0 0 0 16px;
            margin: 4px 0 0;
            display: none;
        }

        .cat-sub-list.open { display: block; }

        .cat-sub-list li a {
            font-size: 13px;
            padding: 6px 10px;
        }

        /* Brand checkboxes */
        .brand-check-item {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
            font-size: 13.5px;
            cursor: pointer;
            color: var(--mid);
        }

        .brand-check-item input[type="checkbox"] {
            accent-color: var(--red);
            width: 15px;
            height: 15px;
        }

        .brand-check-item:hover { color: var(--dark); }

        /* Price range */
        .price-range-wrap { padding: 4px 0; }

        .price-inputs {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-top: 10px;
        }

        .price-inputs input {
            width: 100%;
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 7px 10px;
            font-size: 13px;
            font-family: 'Poppins', sans-serif;
            outline: none;
            transition: border-color .2s;
        }

        .price-inputs input:focus { border-color: var(--red); }

        .price-inputs .sep { color: var(--mid); flex-shrink: 0; }

        input[type="range"] {
            width: 100%;
            accent-color: var(--red);
            cursor: pointer;
        }

        .price-range-labels {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: var(--mid);
            margin-top: 4px;
        }

        /* Stock / Rating filters */
        .radio-filter-item {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
            font-size: 13.5px;
            color: var(--mid);
            cursor: pointer;
        }

        .radio-filter-item input[type="radio"] {
            accent-color: var(--red);
            width: 15px;
            height: 15px;
        }

        .star-row { display: flex; align-items: center; gap: 3px; }

        .star-row i { color: #ffd700; font-size: 13px; }

        /* Filter Actions */
        .filter-actions {
            display: flex;
            gap: 10px;
            margin-top: 4px;
        }

        .btn-apply-filter {
            flex: 1;
            background: var(--red);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 10px;
            font-size: 13px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: opacity .2s;
        }

        .btn-apply-filter:hover { opacity: .88; }

        .btn-reset-filter {
            flex: 1;
            background: var(--light);
            color: var(--dark);
            border: none;
            border-radius: 6px;
            padding: 10px;
            font-size: 13px;
            font-weight: 500;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: background .2s;
        }

        .btn-reset-filter:hover { background: var(--border); }

        /* ── Toolbar ─────────────────────────────────────── */
        .products-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 20px;
        }

        .toolbar-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .result-count {
            font-size: 13.5px;
            color: var(--mid);
        }

        .result-count strong { color: var(--dark); }

        .active-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .filter-tag {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #fff0f0;
            color: var(--red);
            border: 1px solid #ffd5d5;
            border-radius: 20px;
            padding: 3px 10px;
            font-size: 12px;
            font-weight: 500;
        }

        .filter-tag a {
            color: var(--red);
            text-decoration: none;
            font-size: 14px;
            line-height: 1;
        }

        .toolbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sort-select {
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 13.5px;
            font-family: 'Poppins', sans-serif;
            color: var(--dark);
            outline: none;
            cursor: pointer;
            background: white;
            transition: border-color .2s;
            min-width: 180px;
        }

        .sort-select:focus { border-color: var(--red); }

        .view-toggle {
            display: flex;
            gap: 4px;
        }

        .view-btn {
            width: 34px;
            height: 34px;
            border: 1px solid var(--border);
            border-radius: 6px;
            display: grid;
            place-items: center;
            cursor: pointer;
            background: white;
            color: var(--mid);
            transition: all .2s;
        }

        .view-btn.active,
        .view-btn:hover {
            background: var(--red);
            border-color: var(--red);
            color: white;
        }

        .mobile-filter-btn {
            display: none;
            align-items: center;
            gap: 6px;
            background: var(--dark);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 14px;
            font-size: 13px;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
        }

        @media (max-width: 991px) {
            .mobile-filter-btn { display: flex; }
        }

        /* ── Category Tabs (horizontal on top) ───────────── */
        .category-tabs {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 22px;
        }

        .cat-tab {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 16px;
            border: 1.5px solid var(--border);
            border-radius: 30px;
            font-size: 13px;
            font-weight: 500;
            color: var(--mid);
            text-decoration: none;
            background: white;
            transition: all .2s;
            white-space: nowrap;
        }

        .cat-tab:hover {
            border-color: var(--red);
            color: var(--red);
        }

        .cat-tab.active {
            background: var(--red);
            border-color: var(--red);
            color: white;
        }

        .cat-tab .badge {
            background: rgba(0,0,0,.12);
            color: inherit;
            border-radius: 20px;
            padding: 1px 7px;
            font-size: 11px;
        }

        /* ── Product Grid ────────────────────────────────── */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .products-grid.list-view {
            grid-template-columns: 1fr;
        }

        @media (max-width: 1280px) {
            .products-grid:not(.list-view) {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .products-grid:not(.list-view) {
                grid-template-columns: 1fr;
            }
        }

        /* ── Product Card ────────────────────────────────── */
        .product-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
            overflow: hidden;
            transition: box-shadow .25s, transform .25s;
            position: relative;
        }

        .product-card:hover {
            box-shadow: 0 8px 28px rgba(0,0,0,.12);
            transform: translateY(-3px);
        }

        /* List view card */
        .products-grid.list-view .product-card {
            display: grid;
            grid-template-columns: 200px 1fr;
        }

        .products-grid.list-view .product-card .product-img {
            height: 100%;
            min-height: 180px;
        }

        .product-badges {
            position: absolute;
            top: 10px;
            left: 10px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            z-index: 2;
        }

        .badge-discount {
            background: var(--red);
            color: white;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 4px;
        }

        .badge-new {
            background: #00c57a;
            color: white;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 4px;
        }

        .badge-flash {
            background: #ff8c00;
            color: white;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 4px;
        }

        .product-img {
            position: relative;
            overflow: hidden;
            background: var(--light);
            height: 210px;
        }

        .product-img img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 12px;
            transition: transform .35s;
        }

        .product-card:hover .product-img img {
            transform: scale(1.06);
        }

        .product-actions {
            position: absolute;
            bottom: -50px;
            left: 0;
            right: 0;
            display: flex;
            gap: 0;
            transition: bottom .25s;
            background: rgba(255,255,255,.95);
            backdrop-filter: blur(4px);
        }

        .product-card:hover .product-actions { bottom: 0; }

        .product-actions .action-btn {
            flex: 1;
            padding: 10px 6px;
            text-align: center;
            font-size: 12.5px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: none;
            background: transparent;
            font-family: 'Poppins', sans-serif;
            transition: background .2s, color .2s;
        }

        .action-btn.cart-btn {
            color: var(--red);
            border-top: 1px solid var(--border);
            border-right: 1px solid var(--border);
        }

        .action-btn.cart-btn:hover { background: var(--red); color: white; }

        .action-btn.buy-btn {
            color: var(--dark);
            border-top: 1px solid var(--border);
        }

        .action-btn.buy-btn:hover { background: var(--dark); color: white; }

        .product-icon-div {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .icon-btn {
            width: 32px;
            height: 32px;
            background: white;
            border-radius: 50%;
            display: grid;
            place-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,.12);
            text-decoration: none;
            color: var(--mid);
            font-size: 15px;
            transition: background .2s, color .2s;
            border: none;
            cursor: pointer;
        }

        .icon-btn:hover,
        .icon-btn.active-like-icon { background: var(--red); color: white; }

        .product-info {
            padding: 14px 16px;
        }

        .product-category-tag {
            font-size: 11px;
            color: var(--mid);
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-bottom: 4px;
        }

        .product-title {
            font-size: 14px;
            font-weight: 600;
            margin: 0 0 8px;
            line-height: 1.4;
        }

        .product-title a {
            color: var(--dark);
            text-decoration: none;
            transition: color .2s;
        }

        .product-title a:hover { color: var(--red); }

        .product-price-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
        }

        .price-now {
            font-size: 16px;
            font-weight: 700;
            color: var(--red);
        }

        .price-old {
            font-size: 13px;
            color: #aaa;
            text-decoration: line-through;
        }

        .product-brand {
            font-size: 12px;
            color: var(--mid);
            margin-bottom: 6px;
        }

        .product-rating {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 8px;
        }

        .stars { display: flex; gap: 2px; }

        .stars i { color: #ffd700; font-size: 12px; }

        .stars i.empty { color: #ddd; }

        .rating-count {
            font-size: 12px;
            color: var(--mid);
        }

        .stock-badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 500;
            padding: 2px 8px;
            border-radius: 20px;
        }

        .stock-badge.in-stock { background: #e6faf2; color: #00a86b; }
        .stock-badge.low-stock { background: #fff4e0; color: #e07800; }
        .stock-badge.out-stock { background: #ffe8e8; color: var(--red); }

        /* List view info */
        .products-grid.list-view .product-info {
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .products-grid.list-view .product-description {
            display: block;
            font-size: 13px;
            color: var(--mid);
            margin: 8px 0;
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-description { display: none; }

        /* ── Empty State ─────────────────────────────────── */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            grid-column: 1 / -1;
        }

        .empty-state i {
            font-size: 56px;
            color: #ddd;
            margin-bottom: 16px;
        }

        .empty-state h4 {
            font-size: 18px;
            color: var(--mid);
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 14px;
            color: #aaa;
        }

        /* ── Pagination ──────────────────────────────────── */
        .pagination-wrap {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
            margin-top: 36px;
        }

        .pagination-wrap a,
        .pagination-wrap span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 13.5px;
            text-decoration: none;
            color: var(--mid);
            background: white;
            transition: all .2s;
        }

        .pagination-wrap a:hover { border-color: var(--red); color: var(--red); }

        .pagination-wrap span.current {
            background: var(--red);
            border-color: var(--red);
            color: white;
            font-weight: 600;
        }

        .pagination-wrap span.dots {
            border: none;
            background: none;
            color: #aaa;
        }

        /* ── Sidebar overlay (mobile) ────────────────────── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.45);
            z-index: 998;
        }

        .sidebar-overlay.show { display: block; }

        .sidebar-close-btn {
            display: none;
            background: none;
            border: none;
            font-size: 22px;
            cursor: pointer;
            color: var(--mid);
            margin-bottom: 16px;
        }

        @media (max-width: 991px) {
            .sidebar-close-btn { display: block; }
        }

        /* ── Megamenu (same as dashboard) ────────────────── */
        #megamenu {
            position: sticky;
            top: 70px;
            z-index: 100;
            display: none;
        }

        .category-list { background-color: #f7f4f424; padding: 0 10px; box-shadow: rgba(99,99,99,.2) 0 2px 4px 0; }
        .category-list .parent-menu-list { display: flex; justify-content: space-between; align-items: center; position: relative; }
        .category-list .parent-menu-list a { color: #000; }
        .category-list .parent-menu { padding: 11px 13px; position: relative; }
        .category-list .inner-menu { background: #fff; position: absolute; top: 100%; left: 0; padding: 0; box-shadow: rgba(96,93,93,.21) 0 2px 9px; border-radius: 4px; opacity: 0; visibility: hidden; transition: all .3s ease-in-out; z-index: 10; width: 220px; }
        .category-list .inner-menu .inner-sub-menu-list { padding: 12px 17px; white-space: nowrap; position: relative; color: #131212; font-weight: 400; font-size: 14px; }
        .inner-sub-menu-list { position: relative !important; }
        .inner-sub-menu-list::after { content: "\f105"; position: absolute; right: 10px; top: 50%; transform: translateY(-50%); font-size: 13px; font-family: "Font Awesome 5 free"; font-weight: 900; }
        .category-list .inner-menu .inner-sub-menu-list .inner-sub-menu { position: absolute; left: 220px; width: 220px; top: -1px; background: #fbfbfb; opacity: 0; visibility: hidden; transition: all .3s ease-in-out; z-index: 10; box-shadow: rgba(0,0,0,.1) -4px 4px 8px; border: 1px solid #d3d3d34f; border-radius: 4px; }
        .category-list .inner-menu .inner-sub-menu-list .inner-sub-menu li { padding: 12px 16px; }
        .category-list .inner-menu .inner-sub-menu-list:hover>.inner-sub-menu { opacity: 1; visibility: visible; }
        .category-list .parent-menu:hover>.inner-menu { opacity: 1; visibility: visible; }
        .category-list .inner-menu .inner-sub-menu-list:hover { background: #e8b3ba; font-weight: 500; }
        .category-list .inner-menu .inner-sub-menu-list .inner-sub-menu li:hover { background: #f2c0ce; }
        .category-list .inner-menu .inner-sub-menu-list .inner-sub-menu.open-left { left: auto; right: 220px; }
        .inner-sub-menu.open-left { left: auto; right: 220px; }

        /* Loading skeleton */
        @keyframes shimmer {
            0% { background-position: -800px 0; }
            100% { background-position: 800px 0; }
        }

        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 800px 100%;
            animation: shimmer 1.4s infinite;
            border-radius: 6px;
        }

        .skeleton-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
            overflow: hidden;
        }

        .skeleton-img { height: 210px; }
        .skeleton-line { height: 14px; margin: 14px 16px 8px; }
        .skeleton-line.short { width: 60%; }
        .skeleton-line.price { height: 18px; width: 40%; margin-bottom: 12px; }
    </style>
</head>

<body>

<!-- ========== TOP BAR ========== -->
<div class="top-bar bg-dark d-none d-lg-block">
    <div class="container py-0">
        <div class="row align-items-center">
            <div class="col-md-3">
                <div class="location">
                    <i class="fas fa-map-marker-alt me-1"></i> Update Location
                    <p class="mb-1">New Delhi, India</p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-white mb-0 d-inline">Summer Sale For All Swim Suits And Free Express Delivery - OFF 50%!</p>
                        <a href="javascript:void(0);" class="btn-link top-header-link font-14 fw-medium">ShopNow</a>
                    </div>
                    <div class="d-flex align-items-center">
                        <select class="form-select custom-select"><option selected>English</option></select>
                        <select class="form-select custom-select"><option selected>India</option></select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ========== HEADER ========== -->
<header>
    <div class="d-flex align-items-center justify-content-between header-large">
        <div class="website-logo">
            <a href="{{ route('dashboard') }}"><img src="assets/images/logo/logo.svg" alt="AyitiBook Logo"></a>
        </div>
        <nav>
            <label for="drop" class="toggle">&#8801;</label>
            <input type="checkbox" id="drop" />
            <ul class="menu">
                <li class="nav-menu"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="nav-menu"><a href="about.html">About Us</a></li>
                <li class="nav-menu" id="categoryLink">
                    <label for="drop-2" class="toggle">Category ▾</label>
                    <a href="#">Category</a>
                    <input type="checkbox" id="drop-2" />
                </li>
                <li class="nav-menu"><a href="{{ route('search-product') }}" class="active">Shop</a></li>
                <li class="nav-menu"><a href="contact.html">Contact</a></li>
            </ul>
        </nav>
        <div class="header-item item-right hide-element">
            <div class="search-bar">
                <form action="{{ route('search-product') }}" method="GET">
                    <input type="text" name="q" placeholder="What are you looking for?" value="{{ request('q') }}">
                    <button type="submit" class="search-icon"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <a href="{{ route('wishlist.index') }}" class="icon-tag position-relative">
                <i class="far fa-heart fs-5"></i>
            </a>
            <a href="{{ route('cart.index') }}" class="icon-tag position-relative">
                <i class="fas fa-shopping-bag fs-5"></i>
                <span class="badge bg-danger position-absolute top-0 start-100 translate-middle rounded-pill">{{ session('cart_count', 0) }}</span>
            </a>
            <li class="dropdown ml-2">
                <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-toggle="dropdown">
                    <div class="avatar avatar-md avatar-indicators avatar-online">
                        <i class='bx bx-user'></i>
                    </div>
                </a>
                <div class="profile-dropdown dropdown-menu pb-2" aria-labelledby="dropdownUser">
                    <ul class="list-unstyled">
                        <li><a class="dropdown-item" href="{{ route('account.my-account') }}">My Account</a></li>
                        <li><a class="dropdown-item" href="{{ route('my-orders') }}">My Orders</a></li>
                        <li><a class="dropdown-item" href="/logout">Sign Out</a></li>
                    </ul>
                </div>
            </li>
        </div>
    </div>
</header>

<!-- ========== MEGA MENU ========== -->
<div style="display:none;" id="megamenu" class="container py-3">
    <div class="category-list">
        <ul class="parent-menu-list">
            @foreach($topCategories ?? [] as $topCat)
            <li class="parent-menu">
                <a href="{{ route('products.by-category', $topCat->slug) }}" class="main-link">{{ $topCat->name }}</a>
                @if($topCat->children->count())
                <ul class="inner-menu">
                    @foreach($topCat->children as $child)
                    <li class="inner-sub-menu-list">
                        <a href="{{ route('products.by-category', $child->slug) }}" class="item-link">{{ $child->name }}</a>
                        @if($child->children->count())
                        <ul class="inner-sub-menu">
                            @foreach($child->children as $grandchild)
                            <li><a href="{{ route('products.by-category', $grandchild->slug) }}">{{ $grandchild->name }}</a></li>
                            @endforeach
                        </ul>
                        @endif
                    </li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
</div>

<!-- ========== BREADCRUMB ========== -->
<section class="breadcrumb-section">
    <div class="container">
        <div class="breadcrumb-wrap">
            <a href="{{ route('dashboard') }}">Home</a>
            <span class="sep">/</span>
            @if(isset($currentCategory))
                <a href="{{ route('products') }}">Shop</a>
                <span class="sep">/</span>
                @if($currentCategory->parent)
                    <a href="{{ route('products', ['category' => $currentCategory->parent->slug]) }}">{{ $currentCategory->parent->name }}</a>
                    <span class="sep">/</span>
                @endif
                <span class="active">{{ $currentCategory->name }}</span>
            @else
                <span class="active">Shop</span>
            @endif
        </div>
    </div>
</section>

<!-- ========== PAGE HERO ========== -->
<section class="shop-hero">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h1>
                    @if(isset($currentCategory))
                        {{ $currentCategory->name }}
                    @elseif(request('q'))
                        Results for "{{ request('q') }}"
                    @else
                        All Products
                    @endif
                </h1>
                <p>
                    @if(isset($currentCategory) && $currentCategory->parent)
                        In {{ $currentCategory->parent->name }} &rarr; {{ $currentCategory->name }}
                    @else
                        Discover our full collection of products
                    @endif
                </p>
            </div>
            <div class="hero-stats">
                <div class="hero-stat">
                    <strong>{{ $products->total() }}</strong>
                    <small>Products</small>
                </div>
                <div class="hero-stat">
                    <strong>{{ $categories->count() }}</strong>
                    <small>Categories</small>
                </div>
                <div class="hero-stat">
                    <strong>{{ $brands->count() }}</strong>
                    <small>Brands</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== MAIN CONTENT ========== -->
<div class="container">
    <div class="shop-layout">

        <!-- ===== SIDEBAR ===== -->
        <aside class="sidebar" id="sidebar">
            <button class="sidebar-close-btn" onclick="closeSidebar()">
                <i class="fas fa-times"></i> Close Filters
            </button>

            <!-- Category Filter -->
            <div class="filter-card">
                <div class="filter-card-head" onclick="toggleFilterCard(this)">
                    <h5><i class="fas fa-tag me-2" style="color:var(--red)"></i>Categories</h5>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </div>
                <div class="filter-body">
                    <ul class="cat-filter-list">
                        <li>
                            <a href="{{ route('products', array_merge(request()->except('category', 'page'), [])) }}"
                               class="{{ !request('category') ? 'active' : '' }}">
                                <span>All Products</span>
                                <span class="count">{{ $totalProductsCount ?? $products->total() }}</span>
                            </a>
                        </li>
                        @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('products', array_merge(request()->except('category', 'page'), ['category' => $cat->slug])) }}"
                               class="{{ request('category') === $cat->slug ? 'active' : '' }}"
                               onclick="toggleSubcats(event, 'sub-{{ $cat->id }}')">
                                <span>{{ $cat->name }}</span>
                                <span class="count">{{ $cat->products_count ?? 0 }}</span>
                            </a>
                            @if($cat->children->count())
                            <ul class="cat-sub-list {{ request('category') === $cat->slug || ($currentCategory->parent_id ?? null) === $cat->id ? 'open' : '' }}" id="sub-{{ $cat->id }}">
                                @foreach($cat->children as $child)
                                <li>
                                    <a href="{{ route('products', array_merge(request()->except('category', 'page'), ['category' => $child->slug])) }}"
                                       class="{{ request('category') === $child->slug ? 'active' : '' }}">
                                        <span>{{ $child->name }}</span>
                                        <span class="count">{{ $child->products_count ?? 0 }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Brand Filter -->
            <form id="filter-form" action="{{ route('products') }}" method="GET">
                {{-- Pass through existing filters --}}
                @if(request('q'))<input type="hidden" name="q" value="{{ request('q') }}">@endif
                @if(request('category'))<input type="hidden" name="category" value="{{ request('category') }}">@endif
                @if(request('sort'))<input type="hidden" name="sort" value="{{ request('sort') }}">@endif
                @if(request('per_page'))<input type="hidden" name="per_page" value="{{ request('per_page') }}">@endif

                <div class="filter-card">
                    <div class="filter-card-head" onclick="toggleFilterCard(this)">
                        <h5><i class="fas fa-copyright me-2" style="color:var(--red)"></i>Brands</h5>
                        <i class="fas fa-chevron-down toggle-icon"></i>
                    </div>
                    <div class="filter-body">
                        @foreach($brands as $brand)
                        <label class="brand-check-item">
                            <input type="checkbox" name="brands[]" value="{{ $brand->id }}"
                                {{ in_array($brand->id, request('brands', [])) ? 'checked' : '' }}>
                            {{ $brand->name }}
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Price Range -->
                <div class="filter-card">
                    <div class="filter-card-head" onclick="toggleFilterCard(this)">
                        <h5><i class="fas fa-dollar-sign me-2" style="color:var(--red)"></i>Price Range</h5>
                        <i class="fas fa-chevron-down toggle-icon"></i>
                    </div>
                    <div class="filter-body">
                        <div class="price-range-wrap">
                            <input type="range" id="priceRange" min="0" max="10000" step="50"
                                   value="{{ request('max_price', 10000) }}"
                                   oninput="document.getElementById('maxPriceInput').value = this.value">
                            <div class="price-range-labels">
                                <span>$0</span>
                                <span>$10,000</span>
                            </div>
                            <div class="price-inputs">
                                <input type="number" name="min_price" id="minPriceInput"
                                       placeholder="Min" value="{{ request('min_price', 0) }}" min="0">
                                <span class="sep">–</span>
                                <input type="number" name="max_price" id="maxPriceInput"
                                       placeholder="Max" value="{{ request('max_price', 10000) }}" max="10000"
                                       oninput="document.getElementById('priceRange').value = this.value">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rating Filter -->
                <div class="filter-card">
                    <div class="filter-card-head" onclick="toggleFilterCard(this)">
                        <h5><i class="fas fa-star me-2" style="color:var(--red)"></i>Rating</h5>
                        <i class="fas fa-chevron-down toggle-icon"></i>
                    </div>
                    <div class="filter-body">
                        @foreach([4, 3, 2, 1] as $stars)
                        <label class="radio-filter-item">
                            <input type="radio" name="min_rating" value="{{ $stars }}"
                                {{ request('min_rating') == $stars ? 'checked' : '' }}>
                            <span class="star-row">
                                @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star" style="{{ $i <= $stars ? 'color:#ffd700' : 'color:#ddd' }}"></i>
                                @endfor
                                <span style="font-size:12px;color:var(--mid);margin-left:4px;">& up</span>
                            </span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Availability -->
                <div class="filter-card">
                    <div class="filter-card-head" onclick="toggleFilterCard(this)">
                        <h5><i class="fas fa-boxes me-2" style="color:var(--red)"></i>Availability</h5>
                        <i class="fas fa-chevron-down toggle-icon"></i>
                    </div>
                    <div class="filter-body">
                        <label class="brand-check-item">
                            <input type="checkbox" name="in_stock" value="1" {{ request('in_stock') ? 'checked' : '' }}>
                            In Stock Only
                        </label>
                        <label class="brand-check-item">
                            <input type="checkbox" name="flash_sale" value="1" {{ request('flash_sale') ? 'checked' : '' }}>
                            Flash Sale
                        </label>
                        <label class="brand-check-item">
                            <input type="checkbox" name="refundable" value="1" {{ request('refundable') ? 'checked' : '' }}>
                            Refundable
                        </label>
                    </div>
                </div>

                <div class="filter-actions">
                    <button type="submit" class="btn-apply-filter">Apply Filters</button>
                    <a href="{{ route('products') }}" class="btn-reset-filter" style="display:flex;align-items:center;justify-content:center;text-decoration:none;">Reset</a>
                </div>

            </form>
        </aside>

        <!-- ===== PRODUCTS AREA ===== -->
        <div class="products-area">

            <!-- Category Tabs -->
            @if($topLevelCategories->count())
            <div class="category-tabs">
                <a href="{{ route('products', request()->except('category', 'page')) }}"
                   class="cat-tab {{ !request('category') ? 'active' : '' }}">
                    All
                </a>
                @foreach($topLevelCategories as $topCat)
                <a href="{{ route('products', array_merge(request()->except('category', 'page'), ['category' => $topCat->slug])) }}"
                   class="cat-tab {{ request('category') === $topCat->slug || (isset($currentCategory) && ($currentCategory->slug === $topCat->slug || $currentCategory->parent_id == $topCat->id)) ? 'active' : '' }}">
                    {{ $topCat->name }}
                    @if($topCat->products_count ?? false)
                    <span class="badge">{{ $topCat->products_count }}</span>
                    @endif
                </a>
                @endforeach
            </div>
            @endif

            <!-- Toolbar -->
            <div class="products-toolbar">
                <div class="toolbar-left">
                    <button class="mobile-filter-btn" onclick="openSidebar()">
                        <i class="fas fa-sliders-h"></i> Filters
                    </button>
                    <span class="result-count">
                        Showing <strong>{{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }}</strong>
                        of <strong>{{ $products->total() }}</strong> products
                    </span>
                    <!-- Active filter tags -->
                    <div class="active-filters">
                        @if(request('category'))
                        <span class="filter-tag">
                            {{ $currentCategory->name ?? request('category') }}
                            <a href="{{ route('products', request()->except('category')) }}">&times;</a>
                        </span>
                        @endif
                        @if(request('q'))
                        <span class="filter-tag">
                            "{{ request('q') }}"
                            <a href="{{ route('products', request()->except('q')) }}">&times;</a>
                        </span>
                        @endif
                        @if(request('in_stock'))
                        <span class="filter-tag">
                            In Stock
                            <a href="{{ route('products', request()->except('in_stock')) }}">&times;</a>
                        </span>
                        @endif
                        @if(request('flash_sale'))
                        <span class="filter-tag">
                            Flash Sale
                            <a href="{{ route('products', request()->except('flash_sale')) }}">&times;</a>
                        </span>
                        @endif
                        @foreach(request('brands', []) as $bid)
                        <span class="filter-tag">
                            Brand #{{ $bid }}
                            <a href="{{ route('products', array_merge(request()->except('brands'), ['brands' => array_filter(request('brands', []), fn($b) => $b != $bid)])) }}">&times;</a>
                        </span>
                        @endforeach
                    </div>
                </div>
                <div class="toolbar-right">
                    <form id="sort-form" action="{{ route('products') }}" method="GET">
                        @foreach(request()->except('sort') as $key => $val)
                            @if(is_array($val))
                                @foreach($val as $v)
                                <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                                @endforeach
                            @else
                                <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                            @endif
                        @endforeach
                        <select class="sort-select" name="sort" onchange="document.getElementById('sort-form').submit()">
                            <option value="">Sort: Default</option>
                            <option value="price_asc"    {{ request('sort') === 'price_asc'    ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc"   {{ request('sort') === 'price_desc'   ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="newest"       {{ request('sort') === 'newest'       ? 'selected' : '' }}>Newest First</option>
                            <option value="oldest"       {{ request('sort') === 'oldest'       ? 'selected' : '' }}>Oldest First</option>
                            <option value="best_selling" {{ request('sort') === 'best_selling' ? 'selected' : '' }}>Best Selling</option>
                            <option value="rating"       {{ request('sort') === 'rating'       ? 'selected' : '' }}>Top Rated</option>
                            <option value="name_asc"     {{ request('sort') === 'name_asc'     ? 'selected' : '' }}>Name: A–Z</option>
                            <option value="name_desc"    {{ request('sort') === 'name_desc'    ? 'selected' : '' }}>Name: Z–A</option>
                        </select>
                    </form>
                    <!-- Per page -->
                    <form id="perpage-form" action="{{ route('products') }}" method="GET">
                        @foreach(request()->except('per_page', 'page') as $key => $val)
                            @if(is_array($val))
                                @foreach($val as $v)
                                <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                                @endforeach
                            @else
                                <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                            @endif
                        @endforeach
                        <select class="sort-select" name="per_page" onchange="document.getElementById('perpage-form').submit()" style="min-width:90px">
                            @foreach([9, 18, 27, 36] as $n)
                            <option value="{{ $n }}" {{ request('per_page', 9) == $n ? 'selected' : '' }}>{{ $n }} / page</option>
                            @endforeach
                        </select>
                    </form>
                    <div class="view-toggle">
                        <button class="view-btn active" id="gridViewBtn" onclick="setView('grid')" title="Grid View">
                            <i class="fas fa-th"></i>
                        </button>
                        <button class="view-btn" id="listViewBtn" onclick="setView('list')" title="List View">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="products-grid" id="productsGrid">

                @forelse($products as $product)
                <div class="product-card">

                    <!-- Badges -->
                    <div class="product-badges">
                        @if($product->discount_price)
                        <span class="badge-discount">
                            @if($product->discount_type === 'percent')
                                -{{ $product->discount_price }}%
                            @else
                                Sale
                            @endif
                        </span>
                        @endif
                        @if($product->is_flash_sale)
                        <span class="badge-flash">Flash</span>
                        @endif
                        @if($product->created_at->gt(now()->subDays(7)))
                        <span class="badge-new">New</span>
                        @endif
                    </div>

                    <!-- Product Image -->
                    <div class="product-img">
                        <a href="/product-detail/{{ $product->id }}">
                            <img src="{{ $product->thumbnail ? asset('storage/'.$product->thumbnail) : asset('assets/images/placeholder.png') }}"
                                 alt="{{ $product->name }}"
                                 loading="lazy">
                        </a>

                        <!-- Hover Actions -->
                        <div class="product-actions">
                            @if($product->is_cart ?? false)
                            <a href="{{ route('cart') }}" class="action-btn cart-btn">
                                <i class="fas fa-shopping-cart me-1"></i> Go to Cart
                            </a>
                            @else
                            <button class="action-btn cart-btn" onclick="addToCart({{ $product->id }})">
                                <i class="fas fa-cart-plus me-1"></i> Add to Cart
                            </button>
                            @endif
                            <button class="action-btn buy-btn" onclick="buyNow({{ $product->id }})">
                                <i class="fas fa-bolt me-1"></i> Buy Now
                            </button>
                        </div>

                        <!-- Wishlist / Share -->
                        <div class="product-icon-div">
                            <button class="icon-btn {{ ($product->is_wishlist ?? false) ? 'active-like-icon' : '' }}"
                                    id="like-{{ $product->id }}"
                                    onclick="addWishlist({{ $product->id }})"
                                    title="Add to Wishlist">
                                <i class="far fa-heart"></i>
                            </button>
                            <a class="icon-btn" href="/product-detail/{{ $product->id }}" title="Quick View">
                                <i class="far fa-eye"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="product-info">
                        <p class="product-category-tag">
                            {{ $product->category->name ?? 'Uncategorized' }}
                            @if($product->brand)
                             &bull; {{ $product->brand->name }}
                            @endif
                        </p>
                        <h6 class="product-title">
                            <a href="/product-detail/{{ $product->id }}">{{ $product->name }}</a>
                        </h6>

                        <!-- Description (list view only) -->
                        <p class="product-description">{{ Str::limit(strip_tags($product->description), 120) }}</p>

                        <!-- Price -->
                        <div class="product-price-row">
                            <span class="price-now">
                                ${{ number_format($product->final_price ?? $product->price, 2) }}
                            </span>
                            @if($product->discount_price && $product->discount_price != $product->price)
                            <span class="price-old">${{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>

                        <!-- Rating -->
                        @php $avg = $product->averageRating(); @endphp
                        <div class="product-rating">
                            <div class="stars">
                                @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= round($avg) ? '' : 'empty' }}"
                                   style="{{ $i <= round($avg) ? 'color:#ffd700' : 'color:#ddd' }}"></i>
                                @endfor
                            </div>
                            <span class="rating-count">({{ $product->reviews->count() ?? 0 }})</span>
                        </div>

                        <!-- Stock Status -->
                        @if($product->stock_quantity <= 0)
                        <span class="stock-badge out-stock">Out of Stock</span>
                        @elseif($product->stock_quantity <= ($product->low_stock_quantity ?? 5))
                        <span class="stock-badge low-stock">Low Stock ({{ $product->stock_quantity }} left)</span>
                        @else
                        <span class="stock-badge in-stock">In Stock</span>
                        @endif
                    </div>
                </div>

                @empty

                <div class="empty-state">
                    <i class="fas fa-search"></i>
                    <h4>No products found</h4>
                    <p>Try adjusting your filters or search terms.</p>
                    <a href="{{ route('products') }}" class="btn btn-secondary mt-3">Clear All Filters</a>
                </div>

                @endforelse

            </div>

            <!-- Pagination -->
            @if($products->hasPages())
            <div class="pagination-wrap">
                {{-- Previous --}}
                @if($products->onFirstPage())
                <span><i class="fas fa-chevron-left"></i></span>
                @else
                <a href="{{ $products->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                @endif

                {{-- Pages --}}
                @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                    @if($page == $products->currentPage())
                    <span class="current">{{ $page }}</span>
                    @elseif($page == 1 || $page == $products->lastPage() || abs($page - $products->currentPage()) <= 2)
                    <a href="{{ $url }}">{{ $page }}</a>
                    @elseif(abs($page - $products->currentPage()) == 3)
                    <span class="dots">…</span>
                    @endif
                @endforeach

                {{-- Next --}}
                @if($products->hasMorePages())
                <a href="{{ $products->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                @else
                <span><i class="fas fa-chevron-right"></i></span>
                @endif
            </div>
            @endif

        </div><!-- /products-area -->
    </div><!-- /shop-layout -->
</div><!-- /container -->

<!-- Mobile Sidebar Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>


<!-- ========== FOOTER ========== -->
@include('includes.footer')


<!-- ========== SCRIPTS ========== -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/js/custom-swiper.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/mobile.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script>
// ── View toggle ────────────────────────────────────────
function setView(mode) {
    const grid = document.getElementById('productsGrid');
    const gridBtn = document.getElementById('gridViewBtn');
    const listBtn = document.getElementById('listViewBtn');

    if (mode === 'list') {
        grid.classList.add('list-view');
        listBtn.classList.add('active');
        gridBtn.classList.remove('active');
        localStorage.setItem('shopView', 'list');
    } else {
        grid.classList.remove('list-view');
        gridBtn.classList.add('active');
        listBtn.classList.remove('active');
        localStorage.setItem('shopView', 'grid');
    }
}

// Restore saved view preference
document.addEventListener('DOMContentLoaded', function () {
    const saved = localStorage.getItem('shopView');
    if (saved === 'list') setView('list');
});

// ── Mobile sidebar ─────────────────────────────────────
function openSidebar() {
    document.getElementById('sidebar').classList.add('mobile-open');
    document.getElementById('sidebarOverlay').classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeSidebar() {
    document.getElementById('sidebar').classList.remove('mobile-open');
    document.getElementById('sidebarOverlay').classList.remove('show');
    document.body.style.overflow = '';
}

// ── Filter card toggle ─────────────────────────────────
function toggleFilterCard(head) {
    const body = head.nextElementSibling;
    head.classList.toggle('collapsed');
    body.style.display = head.classList.contains('collapsed') ? 'none' : 'block';
}

// ── Sub-category expand ────────────────────────────────
function toggleSubcats(e, id) {
    const sub = document.getElementById(id);
    if (sub) {
        e.preventDefault();
        sub.classList.toggle('open');
    }
}

// ── Wishlist ───────────────────────────────────────────
function addWishlist(productId) {
    fetch(`/wishlist/add/${productId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content || '',
            'Accept': 'application/json',
        }
    })
    .then(r => r.json())
    .then(data => {
        const btn = document.getElementById('like-' + productId);
        if (btn) btn.classList.toggle('active-like-icon');
        showToast(data.message || 'Wishlist updated!');
    })
    .catch(() => showToast('Please login to use wishlist.'));
}

// ── Add to cart ────────────────────────────────────────
function addToCart(productId) {
    fetch(`/cart/add/${productId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content || '',
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ quantity: 1 })
    })
    .then(r => r.json())
    .then(data => {
        showToast(data.message || 'Added to cart!');
    })
    .catch(() => showToast('Could not add to cart.'));
}

// ── Buy Now ────────────────────────────────────────────
function buyNow(productId) {
    window.location.href = `/checkout?product=${productId}&qty=1`;
}

// ── Toast notification ─────────────────────────────────
function showToast(msg) {
    if (typeof Toastify !== 'undefined') {
        Toastify({
            text: msg,
            duration: 3000,
            gravity: 'top',
            position: 'right',
            backgroundColor: '#db4444',
            stopOnFocus: true,
        }).showToast();
    }
}

// ── Mega menu toggle ───────────────────────────────────
const categoryLink = document.getElementById('categoryLink');
const megamenu = document.getElementById('megamenu');
if (categoryLink && megamenu) {
    categoryLink.addEventListener('mouseenter', () => megamenu.style.display = 'block');
    categoryLink.addEventListener('mouseleave', () => {
        setTimeout(() => {
            if (!megamenu.matches(':hover')) megamenu.style.display = 'none';
        }, 150);
    });
    megamenu.addEventListener('mouseleave', () => megamenu.style.display = 'none');
}

// ── Sub-menu overflow detection ────────────────────────
document.querySelectorAll('.inner-sub-menu-list').forEach(item => {
    item.addEventListener('mouseenter', function () {
        const submenu = this.querySelector('.inner-sub-menu');
        if (submenu) {
            submenu.classList.remove('open-left');
            submenu.style.visibility = 'hidden';
            submenu.style.opacity = '0';
            submenu.style.display = 'block';
            const rect = submenu.getBoundingClientRect();
            submenu.style.display = '';
            submenu.style.visibility = '';
            submenu.style.opacity = '';
            if (rect.left + rect.width > window.innerWidth) {
                submenu.classList.add('open-left');
            }
        }
    });
});
</script>

</body>
</html>