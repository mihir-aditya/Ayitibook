{{-- resources/views/seller/products/productview.blade.php --}}
@php
    use App\Models\Product; // <-- ADD THIS LINE

    $seller = Auth::guard('seller')->user();
    $avgRating = $product->averageRating();
    $reviewCount = $product->reviews()->count();
    $totalAffiliateLinks = $product->affiliateLinks()->count();
    $totalAffiliateClicks = $product->affiliateLinks()->withCount('clicks')->get()->sum('clicks_count') ?? 0;
    $totalAffiliateRevenue =
        $product->affiliateLinks()->with('commissions')->get()->flatMap->commissions->sum('amount') ?? 0;
    $finalPrice = $product->final_price;

    // Rating distribution
    $ratingDist = $product->reviews->groupBy('rating')->map->count();
    $starDistribution = [];
    for ($i = 5; $i >= 1; $i--) {
        $starDistribution[$i] = $ratingDist[$i] ?? 0;
    }

    // Related products (same category, active, excluding current)
    $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->where('is_active', true)
        ->limit(4)
        ->get();

    // Media
    $images = is_array($product->images) ? $product->images : [];
    $videos = is_array($product->videos) ? $product->videos : [];
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} — Seller Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Mono:wght@400;500&display=swap"
        rel="stylesheet">
    @include('seller.partials._base')
    <style>
        /* All your existing CSS stays exactly as in the original file */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --bg: #f0f2f7;
            --surface: #ffffff;
            --card: #ffffff;
            --border: #e4e7ef;
            --border2: #d1d5e0;
            --muted: #e8eaf0;
            --text: #1a1d28;
            --sub: #7a82a0;
            --accent: #5b7cfa;
            --accent2: #22c47a;
            --accent3: #f59e0b;
            --danger: #f43f5e;
            --purple: #8b5cf6;
            --font: 'DM Sans', sans-serif;
            --mono: 'DM Mono', monospace;
            --radius: 14px;
            --sidebar-w: 240px;
            --header-h: 64px;
            --shadow: 0 1px 4px rgba(0, 0, 0, .06), 0 4px 16px rgba(0, 0, 0, .04);
            --shadow-md: 0 2px 8px rgba(0, 0, 0, .08), 0 8px 24px rgba(0, 0, 0, .06);
        }

        /* Variant images gallery */
        .variant-images-gallery {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            align-items: center;
        }

        .more-images {
            font-size: 11px;
            font-weight: 600;
            color: var(--accent);
            cursor: pointer;
            background: rgba(91, 124, 250, .08);
            padding: 3px 8px;
            border-radius: 16px;
            transition: background .2s;
        }

        .more-images:hover {
            background: rgba(91, 124, 250, .16);
        }

        html,
        body {
            height: 100%;
            background: var(--bg);
            color: var(--text);
            font-family: var(--font);
            font-size: 14px;
        }

        /* LAYOUT */
        .layout {
            display: grid;
            grid-template-columns: var(--sidebar-w) 1fr;
            grid-template-rows: var(--header-h) 1fr;
            min-height: 100vh;
        }

        /* SIDEBAR (same as original) */
        .sidebar {
            grid-row: 1 / -1;
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .sidebar-logo {
            height: var(--header-h);
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 20px;
            border-bottom: 1px solid var(--border);
            font-weight: 700;
            font-size: 15px;
            letter-spacing: -.3px;
            color: var(--text);
        }

        .sidebar-logo .logo-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--accent), #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            display: flex;
            flex-direction: column;
            gap: 2px;
            overflow-y: auto;
        }

        .nav-section-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.2px;
            color: var(--sub);
            text-transform: uppercase;
            padding: 12px 8px 6px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 9px;
            color: var(--sub);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 500;
            transition: all .15s;
            cursor: pointer;
        }

        .nav-item:hover {
            background: var(--bg);
            color: var(--text);
        }

        .nav-item.active {
            background: rgba(91, 124, 250, .10);
            color: var(--accent);
        }

        .nav-item .icon {
            width: 18px;
            text-align: center;
            font-size: 15px;
        }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid var(--border);
        }

        .seller-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            background: var(--bg);
            border: 1px solid var(--border);
        }

        .avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent2), var(--accent));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
            color: #fff;
            flex-shrink: 0;
        }

        .seller-card .info {
            flex: 1;
            min-width: 0;
        }

        .seller-card .info .sname {
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: var(--text);
        }

        .seller-card .info .srole {
            font-size: 11px;
            color: var(--sub);
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--accent2);
            flex-shrink: 0;
            box-shadow: 0 0 6px var(--accent2);
        }

        /* HEADER */
        .header {
            grid-column: 2;
            height: var(--header-h);
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 10;
            box-shadow: 0 1px 0 var(--border);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: var(--sub);
        }

        .breadcrumb a {
            color: var(--sub);
            text-decoration: none;
        }

        .breadcrumb a:hover {
            color: var(--accent);
        }

        .breadcrumb .sep {
            opacity: .4;
        }

        .breadcrumb .current {
            color: var(--text);
            font-weight: 600;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-ghost {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 9px;
            background: var(--bg);
            color: var(--text);
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            border: 1px solid var(--border);
            cursor: pointer;
            transition: all .15s;
        }

        .btn-ghost:hover {
            border-color: var(--border2);
            box-shadow: var(--shadow);
        }

        .btn-danger {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 9px;
            background: rgba(244, 63, 94, .08);
            color: var(--danger);
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            border: 1px solid rgba(244, 63, 94, .2);
            cursor: pointer;
            transition: all .15s;
        }

        .btn-danger:hover {
            background: rgba(244, 63, 94, .14);
        }

        .flash-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
            background: rgba(245, 158, 11, .12);
            color: #92680a;
            border: 1px solid rgba(245, 158, 11, .3);
        }

        /* MAIN */
        .main {
            grid-column: 2;
            padding: 28px;
            overflow-y: auto;
        }

        /* METRICS STRIP */
        .metrics {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 14px;
            margin-bottom: 24px;
        }

        .metric-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 18px 20px;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .metric-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
        }

        .metric-card.blue::before {
            background: linear-gradient(90deg, var(--accent), transparent);
        }

        .metric-card.green::before {
            background: linear-gradient(90deg, var(--accent2), transparent);
        }

        .metric-card.amber::before {
            background: linear-gradient(90deg, var(--accent3), transparent);
        }

        .metric-card.red::before {
            background: linear-gradient(90deg, var(--danger), transparent);
        }

        .metric-card.purple::before {
            background: linear-gradient(90deg, var(--purple), transparent);
        }

        .metric-icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            margin-bottom: 12px;
        }

        .metric-icon.blue {
            background: rgba(91, 124, 250, .10);
        }

        .metric-icon.green {
            background: rgba(34, 196, 122, .10);
        }

        .metric-icon.amber {
            background: rgba(245, 158, 11, .10);
        }

        .metric-icon.red {
            background: rgba(244, 63, 94, .10);
        }

        .metric-icon.purple {
            background: rgba(139, 92, 246, .10);
        }

        .metric-val {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -.5px;
            color: var(--text);
        }

        .metric-label {
            font-size: 11.5px;
            color: var(--sub);
            margin-top: 3px;
            font-weight: 500;
        }

        .metric-sub {
            font-size: 11px;
            color: var(--sub);
            margin-top: 6px;
        }

        /* CONTENT GRID */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 20px;
        }

        /* CARD */
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-bottom: 20px;
            overflow: hidden;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 22px;
            border-bottom: 1px solid var(--border);
        }

        .card-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-title .ct-icon {
            font-size: 15px;
        }

        .card-badge {
            font-size: 11px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 20px;
            background: var(--bg);
            color: var(--sub);
            border: 1px solid var(--border);
        }

        .card-body {
            padding: 22px;
        }

        /* PRODUCT HERO */
        .product-hero {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 22px;
            align-items: start;
        }

        .product-thumb-wrap {
            position: relative;
        }

        .product-thumb {
            width: 130px;
            height: 130px;
            border-radius: 12px;
            object-fit: cover;
            border: 1px solid var(--border);
            background: var(--bg);
        }

        .product-thumb-placeholder {
            width: 130px;
            height: 130px;
            border-radius: 12px;
            background: var(--muted);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            color: var(--sub);
        }

        .status-pill {
            position: absolute;
            top: -6px;
            right: -6px;
            font-size: 10px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 20px;
            border: 2px solid var(--surface);
        }

        .status-pill.active {
            background: rgba(34, 196, 122, .15);
            color: #0d9a5e;
        }

        .status-pill.inactive {
            background: rgba(244, 63, 94, .12);
            color: var(--danger);
        }

        .product-info {
            min-width: 0;
        }

        .product-name {
            font-size: 18px;
            font-weight: 700;
            color: var(--text);
            line-height: 1.3;
            margin-bottom: 6px;
        }

        .product-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 14px;
        }

        .meta-chip {
            font-size: 11.5px;
            font-weight: 500;
            padding: 4px 10px;
            border-radius: 20px;
            background: var(--bg);
            border: 1px solid var(--border);
            color: var(--sub);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .meta-chip.accent {
            background: rgba(91, 124, 250, .08);
            color: var(--accent);
            border-color: rgba(91, 124, 250, .2);
        }

        .meta-chip.success {
            background: rgba(34, 196, 122, .08);
            color: #0d9a5e;
            border-color: rgba(34, 196, 122, .25);
        }

        .meta-chip.amber {
            background: rgba(245, 158, 11, .08);
            color: #92680a;
            border-color: rgba(245, 158, 11, .25);
        }

        .meta-chip.danger {
            background: rgba(244, 63, 94, .08);
            color: var(--danger);
            border-color: rgba(244, 63, 94, .25);
        }

        .price-row {
            display: flex;
            align-items: baseline;
            gap: 10px;
            margin-bottom: 8px;
        }

        .price-main {
            font-size: 26px;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -.5px;
        }

        .price-original {
            font-size: 14px;
            color: var(--sub);
            text-decoration: line-through;
        }

        .price-discount {
            font-size: 12px;
            font-weight: 700;
            color: #0d9a5e;
            background: rgba(34, 196, 122, .1);
            padding: 2px 8px;
            border-radius: 20px;
        }

        .sku-row {
            font-size: 12px;
            color: var(--sub);
            font-family: var(--mono);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .sku-copy {
            cursor: pointer;
            color: var(--accent);
            font-size: 12px;
            border: none;
            background: none;
            font-family: var(--mono);
            transition: opacity .15s;
        }

        .sku-copy:hover {
            opacity: .7;
        }

        /* TABS */
        .product-tabs {
            margin-top: 20px;
        }

        .tabs-header {
            display: flex;
            gap: 1rem;
            border-bottom: 2px solid var(--border);
            background: var(--card);
            border-radius: var(--radius) var(--radius) 0 0;
            padding: 0 22px;
        }

        .tab-btn {
            background: none;
            border: none;
            padding: 12px 0;
            margin-right: 24px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            color: var(--sub);
            transition: all 0.2s;
            border-bottom: 2px solid transparent;
            margin-bottom: -2px;
        }

        .tab-btn.active {
            color: var(--accent);
            border-bottom-color: var(--accent);
        }

        .tab-pane {
            display: none;
            padding: 22px;
            background: var(--card);
            border: 1px solid var(--border);
            border-top: none;
            border-radius: 0 0 var(--radius) var(--radius);
        }

        .tab-pane.active {
            display: block;
        }

        /* DESCRIPTION */
        .description-text {
            font-size: 13.5px;
            line-height: 1.7;
            color: var(--sub);
            white-space: pre-wrap;
        }

        .read-more-btn {
            background: none;
            border: none;
            color: var(--accent);
            font-weight: 600;
            cursor: pointer;
            margin-top: 8px;
        }

        /* SPECS TABLE */
        .specs-table {
            width: 100%;
            border-collapse: collapse;
        }

        .specs-table th,
        .specs-table td {
            padding: 12px;
            border-bottom: 1px solid var(--border);
            text-align: left;
        }

        .specs-table th {
            width: 30%;
            font-weight: 600;
            background: var(--bg);
        }

        /* VARIANTS TABLE */
        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .8px;
            color: var(--sub);
            padding: 10px 14px;
            background: var(--bg);
            border-bottom: 1px solid var(--border);
        }

        td {
            padding: 12px 14px;
            border-bottom: 1px solid var(--border);
            font-size: 13px;
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: rgba(240, 242, 247, .6);
        }

        .variant-name {
            font-weight: 600;
            color: var(--text);
        }

        .variant-sku {
            font-family: var(--mono);
            font-size: 11.5px;
            color: var(--sub);
            margin-top: 2px;
        }

        .stock-pill {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 11.5px;
            font-weight: 600;
            padding: 3px 9px;
            border-radius: 20px;
        }

        .stock-pill.in-stock {
            background: rgba(34, 196, 122, .1);
            color: #0d9a5e;
        }

        .stock-pill.low-stock {
            background: rgba(245, 158, 11, .1);
            color: #92680a;
        }

        .stock-pill.out-stock {
            background: rgba(244, 63, 94, .1);
            color: var(--danger);
        }

        .variant-thumb {
            width: 36px;
            height: 36px;
            border-radius: 7px;
            object-fit: cover;
            border: 1px solid var(--border);
        }

        .variant-thumb-placeholder {
            width: 36px;
            height: 36px;
            border-radius: 7px;
            background: var(--muted);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        /* SIZES */
        .sizes-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .size-badge {
            background: var(--bg);
            border: 1px solid var(--border);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            color: var(--text);
        }

        /* REVIEWS */
        .rating-overview {
            display: flex;
            gap: 24px;
            align-items: center;
            margin-bottom: 22px;
        }

        .rating-big {
            text-align: center;
        }

        .rating-big .num {
            font-size: 48px;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -2px;
            line-height: 1;
        }

        .rating-big .stars-row {
            display: flex;
            gap: 3px;
            justify-content: center;
            margin-top: 5px;
        }

        .rating-big .star-filled {
            color: var(--accent3);
            font-size: 16px;
        }

        .rating-big .star-empty {
            color: var(--border2);
            font-size: 16px;
        }

        .rating-big .count {
            font-size: 12px;
            color: var(--sub);
            margin-top: 4px;
        }

        .rating-bars {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .rating-bar-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .rating-bar-label {
            font-size: 12px;
            color: var(--sub);
            width: 14px;
            text-align: right;
            font-weight: 600;
        }

        .rating-bar-track {
            flex: 1;
            height: 7px;
            background: var(--muted);
            border-radius: 10px;
            overflow: hidden;
        }

        .rating-bar-fill {
            height: 100%;
            border-radius: 10px;
            background: var(--accent3);
        }

        .rating-bar-count {
            font-size: 11px;
            color: var(--sub);
            width: 20px;
        }

        .divider {
            border: none;
            border-top: 1px solid var(--border);
            margin: 18px 0;
        }

        .review-list {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .review-item {
            padding: 18px 0;
            border-bottom: 1px solid var(--border);
        }

        .review-item:last-child {
            border-bottom: none;
        }

        .review-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .review-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .review-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--purple));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            color: #fff;
        }

        .review-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--text);
        }

        .review-date {
            font-size: 11px;
            color: var(--sub);
            margin-top: 1px;
        }

        .review-stars {
            display: flex;
            gap: 2px;
        }

        .review-star {
            font-size: 13px;
        }

        .review-body {
            font-size: 13.5px;
            line-height: 1.65;
            color: var(--sub);
            margin-top: 8px;
        }

        .review-images {
            display: flex;
            gap: 8px;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        .review-img {
            width: 58px;
            height: 58px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid var(--border);
            cursor: pointer;
        }

        .no-reviews {
            text-align: center;
            padding: 40px 20px;
        }

        .no-reviews .nr-icon {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .no-reviews p {
            color: var(--sub);
            font-size: 13.5px;
        }

        /* MEDIA GALLERY */
        .image-gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .gallery-img {
            width: 82px;
            height: 82px;
            border-radius: 10px;
            object-fit: cover;
            border: 1px solid var(--border);
            cursor: pointer;
            transition: all .2s;
        }

        .gallery-img:hover {
            transform: scale(1.05);
            box-shadow: var(--shadow-md);
        }

        .gallery-empty {
            font-size: 13px;
            color: var(--sub);
            font-style: italic;
        }

        /* AFFILIATE STATS */
        .aff-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 0;
        }

        .aff-stat-box {
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 14px 16px;
        }

        .aff-stat-label {
            font-size: 11px;
            color: var(--sub);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .6px;
            margin-bottom: 5px;
        }

        .aff-stat-val {
            font-size: 18px;
            font-weight: 700;
            color: var(--text);
        }

        .aff-link-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 16px;
        }

        .aff-link-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 14px;
            border-radius: 9px;
            background: var(--bg);
            border: 1px solid var(--border);
        }

        .aff-link-info {
            min-width: 0;
        }

        .aff-link-code {
            font-size: 12.5px;
            font-weight: 700;
            color: var(--accent);
            font-family: var(--mono);
        }

        .aff-link-meta {
            font-size: 11px;
            color: var(--sub);
            margin-top: 2px;
        }

        .aff-link-clicks {
            font-size: 13px;
            font-weight: 700;
            color: var(--text);
        }

        .aff-link-clicks span {
            font-size: 11px;
            color: var(--sub);
            font-weight: 500;
        }

        .aff-pct {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 10px 14px;
            border-radius: 9px;
            background: rgba(91, 124, 250, .06);
            border: 1px solid rgba(91, 124, 250, .15);
            margin-bottom: 14px;
        }

        .aff-pct-val {
            font-size: 20px;
            font-weight: 700;
            color: var(--accent);
        }

        .aff-pct-label {
            font-size: 12px;
            color: var(--sub);
        }

        /* SEO META */
        .seo-row {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .seo-label {
            font-size: 11px;
            color: var(--sub);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .6px;
            margin-bottom: 4px;
        }

        .seo-val {
            font-size: 13px;
            color: var(--text);
            background: var(--bg);
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid var(--border);
        }

        .seo-val.muted {
            color: var(--sub);
            font-style: italic;
        }

        /* STATUS FLAGS */
        .flags-row {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .flag-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid var(--border);
        }

        .flag-item:last-child {
            border-bottom: none;
        }

        .flag-name {
            font-size: 13px;
            color: var(--text);
            font-weight: 500;
        }

        .flag-toggle {
            width: 36px;
            height: 20px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            padding: 2px 3px;
        }

        .flag-toggle.on {
            background: var(--accent2);
            justify-content: flex-end;
        }

        .flag-toggle.off {
            background: var(--border2);
            justify-content: flex-start;
        }

        .flag-toggle-dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .2);
        }

        /* RELATED PRODUCTS */
        .related-products {
            margin-top: 30px;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 16px;
        }

        .related-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 12px;
            text-align: center;
            transition: all 0.2s;
        }

        .related-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .related-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }

        .related-card h4 {
            font-size: 14px;
            font-weight: 600;
            margin: 8px 0 4px;
            color: var(--text);
        }

        .related-card .price {
            font-weight: 600;
            color: var(--accent);
        }

        .related-card .old-price {
            font-size: 12px;
            text-decoration: line-through;
            color: var(--sub);
            margin-left: 5px;
        }

        .related-card a {
            text-decoration: none;
            color: inherit;
        }

        /* LIGHTBOX */
        .lightbox {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .85);
            z-index: 999;
            align-items: center;
            justify-content: center;
        }

        .lightbox.open {
            display: flex;
        }

        .lightbox img {
            max-width: 90vw;
            max-height: 90vh;
            border-radius: 10px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .5);
        }

        .lightbox-close {
            position: absolute;
            top: 20px;
            right: 24px;
            font-size: 28px;
            color: #fff;
            cursor: pointer;
            border: none;
            background: none;
        }

        .empty-state {
            text-align: center;
            padding: 30px 20px;
            color: var(--sub);
            font-size: 13px;
        }

        .empty-state .es-icon {
            font-size: 28px;
            margin-bottom: 8px;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .main>* {
            animation: fadeUp .35s ease both;
        }
    </style>
</head>

<body>
    <div class="layout">
        @include('seller.partials._sidebar', ['active' => 'products'])

        <header class="header">
            <div class="header-left">
                <div class="breadcrumb">
                    <a href="{{ route('seller.dashboard') }}">Dashboard</a>
                    <span class="sep">›</span>
                    <a href="{{ route('seller.products.index') }}">Products</a>
                    <span class="sep">›</span>
                    <span class="current">{{ Str::limit($product->name, 35) }}</span>
                </div>
            </div>
            <div class="header-right">
                @if ($product->is_flash_sale)
                    <span class="flash-badge">⚡ Flash Sale</span>
                @endif
                <a href="{{ route('seller.products.edit', $product->id) }}" class="btn-ghost">✏️ Edit Product</a>
                <form method="POST" action="{{ route('seller.products.destroy', $product->id) }}"
                    onsubmit="return confirm('Delete this product? This action cannot be undone.')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-danger">🗑 Delete</button>
                </form>
            </div>
        </header>

        <main class="main">
            {{-- METRICS STRIP (unchanged) --}}
            <div class="metrics">
                <div class="metric-card blue">
                    <div class="metric-icon blue">💲</div>
                    <div class="metric-val">{{ number_format($finalPrice, 2) }}</div>
                    <div class="metric-label">Selling Price</div>
                    @if ($product->discount_price)
                        <div class="metric-sub" style="color:var(--accent2);">
                            {{ $product->discount_percentage }}% off · Was {{ number_format($product->price, 2) }}
                        </div>
                    @endif
                </div>
                <div
                    class="metric-card {{ $product->stock_quantity <= 0 ? 'red' : ($product->is_low_stock ? 'amber' : 'green') }}">
                    <div
                        class="metric-icon {{ $product->stock_quantity <= 0 ? 'red' : ($product->is_low_stock ? 'amber' : 'green') }}">
                        📦</div>
                    <div class="metric-val">{{ number_format($product->stock_quantity) }}</div>
                    <div class="metric-label">Stock Qty</div>
                    <div class="metric-sub">Sold: {{ number_format($product->sold_count + $product->sales_count) }}
                    </div>
                </div>
                <div class="metric-card amber">
                    <div class="metric-icon amber">⭐</div>
                    <div class="metric-val">{{ number_format($avgRating, 1) }}</div>
                    <div class="metric-label">Avg. Rating</div>
                    <div class="metric-sub">{{ $reviewCount }} review{{ $reviewCount !== 1 ? 's' : '' }}</div>
                </div>
                <div class="metric-card purple">
                    <div class="metric-icon purple">🔗</div>
                    <div class="metric-val">{{ $totalAffiliateLinks }}</div>
                    <div class="metric-label">Affiliate Links</div>
                    <div class="metric-sub">{{ number_format($totalAffiliateClicks) }} clicks</div>
                </div>
                <div class="metric-card green">
                    <div class="metric-icon green">🎛️</div>
                    <div class="metric-val">{{ $product->variants->count() }}</div>
                    <div class="metric-label">Variants</div>
                    <div class="metric-sub">Total stock: {{ number_format($product->total_stock) }}</div>
                </div>
            </div>

            <div class="content-grid">
                {{-- LEFT COLUMN (unchanged) --}}
                <div>
                    {{-- PRODUCT OVERVIEW CARD (unchanged) --}}
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><span class="ct-icon">🛍️</span> Product Overview</div>
                            <div style="display:flex; gap:8px; align-items:center;">
                                @if ($product->is_active)
                                    <span class="meta-chip success">● Active</span>
                                @else
                                    <span class="meta-chip danger">● Inactive</span>
                                @endif
                                @if ($product->can_purchase)
                                    <span class="meta-chip accent">Purchasable</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="product-hero">
                                <div class="product-thumb-wrap">
                                    @if ($product->thumbnail)
                                        <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                            alt="{{ $product->name }}" class="product-thumb"
                                            onclick="openLightbox(this.src)">
                                    @else
                                        <div class="product-thumb-placeholder">📷</div>
                                    @endif
                                    <span class="status-pill {{ $product->is_active ? 'active' : 'inactive' }}">
                                        {{ $product->is_active ? 'Live' : 'Off' }}
                                    </span>
                                </div>
                                <div class="product-info">
                                    <div class="product-name">{{ $product->name }}</div>
                                    <div class="product-meta">
                                        @if ($product->category)
                                            <span class="meta-chip"><span>🗂</span>
                                                {{ $product->category->name }}</span>
                                        @endif
                                        @if ($product->brand)
                                            <span class="meta-chip"><span>🏷</span> {{ $product->brand->name }}</span>
                                        @endif
                                        @if ($product->weight)
                                            <span class="meta-chip"><span>⚖️</span> {{ $product->weight }}kg</span>
                                        @endif
                                        @if ($product->refundable)
                                            <span class="meta-chip success"><span>↩️</span> Refundable</span>
                                        @endif
                                        @if ($product->is_flash_sale)
                                            <span class="meta-chip amber">⚡ Flash Sale</span>
                                        @endif
                                    </div>
                                    <div class="price-row">
                                        <div class="price-main">
                                            {{ $product->currency ?? '₦' }}{{ number_format($finalPrice, 2) }}</div>
                                        @if ($product->discount_price)
                                            <div class="price-original">{{ number_format($product->price, 2) }}</div>
                                            <div class="price-discount">-{{ $product->discount_percentage }}%</div>
                                        @endif
                                    </div>
                                    <div class="sku-row">
                                        SKU: <strong>{{ $product->sku }}</strong>
                                        <button class="sku-copy" onclick="copyText('{{ $product->sku }}', this)"
                                            title="Copy SKU">⎘</button>
                                        &nbsp;·&nbsp; Slug: <strong>{{ $product->slug }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- TABS (unchanged) --}}
                    <div class="product-tabs">
                        <div class="tabs-header">
                            <button class="tab-btn active" data-tab="description">Description</button>
                            <button class="tab-btn" data-tab="specs">Specifications</button>
                            <button class="tab-btn" data-tab="reviews">Reviews ({{ $reviewCount }})</button>
                            <button class="tab-btn" data-tab="media">Media</button>
                        </div>

                        <div class="tab-pane active" id="description">
                            <div class="description-text">{!! nl2br(e($product->description)) !!}</div>
                        </div>

                        <div class="tab-pane" id="specs">
                            <table class="specs-table">
                                <tr>
                                    <th>SKU</th>
                                    <td>{{ $product->sku }}</td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td>{{ $product->category->name ?? '—' }}</td>
                                </tr>
                                <tr>
                                    <th>Brand</th>
                                    <td>{{ $product->brand->name ?? '—' }}</td>
                                </tr>
                                <tr>
                                    <th>Weight</th>
                                    <td>{{ $product->weight ? $product->weight . ' kg' : '—' }}</td>
                                </tr>
                                <tr>
                                    <th>Dimensions (L×W×H)</th>
                                    <td>
                                        @if ($product->length || $product->width || $product->height)
                                            {{ $product->length ?? '?' }} × {{ $product->width ?? '?' }} ×
                                            {{ $product->height ?? '?' }}
                                        @else
                                            —
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Maximum Purchase</th>
                                    <td>{{ $product->maximum_purchase_quantity ?? 'Unlimited' }}</td>
                                </tr>
                                <tr>
                                    <th>Low Stock Threshold</th>
                                    <td>{{ $product->low_stock_quantity ?? '—' }}</td>
                                </tr>
                                <tr>
                                    <th>Affiliate Commission</th>
                                    <td>{{ $product->affiliate_percentage ?? 10 }}%</td>
                                </tr>
                                <tr>
                                    <th>Refundable</th>
                                    <td>{{ $product->refundable ? 'Yes' : 'No' }}</td>
                                </tr>
                                <tr>
                                    <th>Flash Sale</th>
                                    <td>{{ $product->is_flash_sale ? 'Yes' : 'No' }}</td>
                                </tr>
                                <tr>
                                    <th>Show When Out of Stock</th>
                                    <td>{{ $product->show_stock_out ? 'Yes' : 'No' }}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $product->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated</th>
                                    <td>{{ $product->updated_at->format('M d, Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="tab-pane" id="reviews">
                            @if ($reviewCount)
                                <div class="rating-overview">
                                    <div class="rating-big">
                                        <div class="num">{{ number_format($avgRating, 1) }}</div>
                                        <div class="stars-row">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span
                                                    class="{{ $i <= round($avgRating) ? 'star-filled' : 'star-empty' }}">★</span>
                                            @endfor
                                        </div>
                                        <div class="count">{{ $reviewCount }} reviews</div>
                                    </div>
                                    <div class="rating-bars">
                                        @foreach ([5, 4, 3, 2, 1] as $star)
                                            @php
                                                $cnt = $starDistribution[$star] ?? 0;
                                                $pct = $reviewCount > 0 ? ($cnt / $reviewCount) * 100 : 0;
                                            @endphp
                                            <div class="rating-bar-row">
                                                <div class="rating-bar-label">{{ $star }}</div>
                                                <div class="rating-bar-track">
                                                    <div class="rating-bar-fill" style="width:{{ $pct }}%;">
                                                    </div>
                                                </div>
                                                <div class="rating-bar-count">{{ $cnt }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="review-list">
                                    @foreach ($product->reviews as $review)
                                        <div class="review-item">
                                            <div class="review-top">
                                                <div class="review-user">
                                                    <div class="review-avatar">
                                                        {{ strtoupper(substr($review->user->name ?? 'U', 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <div class="review-name">
                                                            {{ $review->user->name ?? 'Anonymous' }}</div>
                                                        <div class="review-date">
                                                            {{ $review->created_at->format('M d, Y') }}</div>
                                                    </div>
                                                </div>
                                                <div class="review-stars">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <span class="review-star"
                                                            style="color:{{ $i <= $review->rating ? 'var(--accent3)' : 'var(--border2)' }}">★</span>
                                                    @endfor
                                                </div>
                                            </div>
                                            @if ($review->body)
                                                <div class="review-body">{{ $review->body }}</div>
                                            @endif
                                            @if (!empty($review->images))
                                                <div class="review-images">
                                                    @foreach ($review->image_urls as $imgUrl)
                                                        <img src="{{ $imgUrl }}" class="review-img"
                                                            onclick="openLightbox(this.src)">
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="no-reviews">
                                    <div class="nr-icon">💬</div>
                                    <p>No reviews yet.</p>
                                </div>
                            @endif
                        </div>

                        <div class="tab-pane" id="media">
                            @if (!empty($images) || !empty($videos))
                                @if (!empty($images))
                                    <div class="seo-label" style="margin-bottom:10px;">Images</div>
                                    <div class="image-gallery">
                                        @foreach ($images as $img)
                                            @if ($img)
                                                <img src="{{ asset('storage/' . $img) }}" alt="Product image"
                                                    class="gallery-img" onclick="openLightbox(this.src)">
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                                @if (!empty($videos))
                                    <div class="seo-label" style="margin-top:18px; margin-bottom:10px;">Videos</div>
                                    <div style="display:flex; flex-wrap:wrap; gap:10px;">
                                        @foreach ($videos as $vid)
                                            @if ($vid)
                                                <video width="180" height="120" controls
                                                    style="border-radius:10px; border:1px solid var(--border);">
                                                    <source src="{{ asset('storage/' . $vid) }}">
                                                </video>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            @else
                                <p class="gallery-empty">No media uploaded.</p>
                            @endif
                        </div>
                    </div>

                    {{-- VARIANTS CARD (unchanged) --}}
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><span class="ct-icon">🎛️</span> Variants</div><span
                                class="card-badge">{{ $product->variants->count() }} total</span>
                        </div>
                        @if ($product->variants->count())
                            <div class="table-wrap">
                                <table>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Variant</th>
                                            <th>SKU</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product->variants as $variant)
                                            @php
                                                $stockClass =
                                                    $variant->quantity <= 0
                                                        ? 'out-stock'
                                                        : ($variant->quantity <= 5
                                                            ? 'low-stock'
                                                            : 'in-stock');
                                                $stockLabel =
                                                    $variant->quantity <= 0
                                                        ? 'Out of Stock'
                                                        : ($variant->quantity <= 5
                                                            ? 'Low Stock'
                                                            : 'In Stock');
                                                $firstImg = $variant->first_image_url;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <div class="variant-images-gallery">
                                                        @php $variantImages = $variant->images; @endphp
                                                        @if (count($variantImages))
                                                            @foreach (array_slice($variantImages, 0, 3) as $img)
                                                                <img src="{{ asset('storage/' . $img) }}"
                                                                    class="variant-thumb"
                                                                    onclick="openLightbox(this.src)">
                                                            @endforeach
                                                            @if (count($variantImages) > 3)
                                                                <span class="more-images"
                                                                    onclick="openLightbox('{{ asset('storage/' . $variantImages[3]) }}')">
                                                                    +{{ count($variantImages) - 3 }} more
                                                                </span>
                                                            @endif
                                                        @else
                                                            <div class="variant-thumb-placeholder">🎛️</div>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="variant-name">{{ $variant->variant_name }}</div>
                                                </td>
                                                <td>
                                                    <div class="variant-sku">{{ $variant->sku }}</div>
                                                </td>
                                                <td style="font-weight:700;">{{ number_format($variant->price, 2) }}
                                                </td>
                                                <td><span
                                                        class="stock-pill {{ $stockClass }}">{{ $variant->quantity }}
                                                        · {{ $stockLabel }}</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="empty-state">
                                <div class="es-icon">🎛️</div>
                                <p>No variants added.</p>
                            </div>
                        @endif
                    </div>

                    {{-- SIZES CARD (if any) --}}
                    @if ($product->sizes->count())
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title"><span class="ct-icon">📏</span> Sizes</div><span
                                    class="card-badge">{{ $product->sizes->count() }} sizes</span>
                            </div>
                            <div class="card-body">
                                <div class="sizes-list">
                                    @foreach ($product->sizes as $size)
                                        <span class="size-badge">{{ $size->size }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- RIGHT COLUMN (unchanged) --}}
                <div>
                    {{-- STATUS FLAGS --}}
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><span class="ct-icon">🚦</span> Status Flags</div>
                        </div>
                        <div class="card-body" style="padding-top:0; padding-bottom:0;">
                            <div class="flags-row">
                                @php $flags = [ ['label' => 'Product Active', 'val' => $product->is_active], ['label' => 'Can Purchase', 'val' => $product->can_purchase], ['label' => 'Refundable', 'val' => $product->refundable], ['label' => 'Show When Out', 'val' => $product->show_stock_out ?? false], ['label' => 'Flash Sale', 'val' => $product->is_flash_sale] ]; @endphp
                                @foreach ($flags as $flag)
                                    <div class="flag-item"><span class="flag-name">{{ $flag['label'] }}</span>
                                        <div class="flag-toggle {{ $flag['val'] ? 'on' : 'off' }}">
                                            <div class="flag-toggle-dot"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- AFFILIATE STATS --}}
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><span class="ct-icon">🔗</span> Affiliate Performance</div>
                        </div>
                        <div class="card-body">
                            <div class="aff-pct">
                                <div class="aff-pct-val">{{ $product->affiliate_percentage ?? 10 }}%</div>
                                <div class="aff-pct-label">Commission rate for affiliates</div>
                            </div>
                            <div class="aff-stats">
                                <div class="aff-stat-box">
                                    <div class="aff-stat-label">Links Created</div>
                                    <div class="aff-stat-val">{{ $totalAffiliateLinks }}</div>
                                </div>
                                <div class="aff-stat-box">
                                    <div class="aff-stat-label">Total Clicks</div>
                                    <div class="aff-stat-val">{{ number_format($totalAffiliateClicks) }}</div>
                                </div>
                                <div class="aff-stat-box">
                                    <div class="aff-stat-label">Conversions</div>
                                    <div class="aff-stat-val">—</div>
                                </div>
                                <div class="aff-stat-box">
                                    <div class="aff-stat-label">Commissions Paid</div>
                                    <div class="aff-stat-val">{{ number_format($totalAffiliateRevenue, 2) }}</div>
                                </div>
                            </div>
                            @php
                                $affiliateLinks = $product
                                    ->affiliateLinks()
                                    ->with(['affiliate', 'clicks'])
                                    ->take(5)
                                    ->get();
                            @endphp
                            @if ($affiliateLinks->count())
                                <div
                                    style="font-size:11px; color:var(--sub); font-weight:700; text-transform:uppercase; margin-top:16px; margin-bottom:8px;">
                                    Top Links</div>
                                <div class="aff-link-list">
                                    @foreach ($affiliateLinks as $link)
                                        <div class="aff-link-item">
                                            <div class="aff-link-info">
                                                <div class="aff-link-code">
                                                    {{ $link->affiliate->affiliate_code ?? '—' }}</div>
                                                <div class="aff-link-meta">
                                                    {{ $link->affiliate->user->name ?? 'Unknown' }}</div>
                                            </div>
                                            <div class="aff-link-clicks">{{ $link->clicks->count() ?? 0 }}
                                                <span>clicks</span></div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-state" style="padding:20px 0 0;">
                                    <div class="es-icon">🔗</div>
                                    <p>No affiliate links yet.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- SEO META --}}
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><span class="ct-icon">🔍</span> SEO Meta</div>
                        </div>
                        <div class="card-body">
                            <div class="seo-row">
                                <div class="seo-item">
                                    <div class="seo-label">Meta Title</div>
                                    <div class="seo-val {{ $product->meta_title ? '' : 'muted' }}">
                                        {{ $product->meta_title ?? 'Not set' }}</div>
                                </div>
                                <div class="seo-item">
                                    <div class="seo-label">Meta Keywords</div>
                                    <div class="seo-val {{ $product->meta_keywords ? '' : 'muted' }}">
                                        {{ $product->meta_keywords ?? 'Not set' }}</div>
                                </div>
                                <div class="seo-item">
                                    <div class="seo-label">Meta Description</div>
                                    <div class="seo-val {{ $product->meta_description ? '' : 'muted' }}">
                                        {{ $product->meta_description ?? 'Not set' }}</div>
                                </div>
                                <div class="seo-item">
                                    <div class="seo-label">URL Slug</div>
                                    <div class="seo-val"
                                        style="font-family:var(--mono); font-size:12px; color:var(--accent);">
                                        /products/{{ $product->slug }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- TIMESTAMPS --}}
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><span class="ct-icon">🕓</span> Timeline</div>
                        </div>
                        <div class="card-body" style="padding-top:0; padding-bottom:0;">
                            <div class="flags-row">
                                <div class="flag-item"><span class="flag-name"
                                        style="color:var(--sub);">Created</span><span
                                        style="font-size:12.5px; font-weight:600; color:var(--text);">{{ $product->created_at->format('M d, Y') }}</span>
                                </div>
                                <div class="flag-item"><span class="flag-name" style="color:var(--sub);">Last
                                        Updated</span><span
                                        style="font-size:12.5px; font-weight:600; color:var(--text);">{{ $product->updated_at->format('M d, Y') }}</span>
                                </div>
                                @if ($product->deleted_at)
                                    <div class="flag-item"><span class="flag-name"
                                            style="color:var(--danger);">Deleted At</span><span
                                            style="font-size:12.5px; font-weight:600; color:var(--danger);">{{ $product->deleted_at->format('M d, Y') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RELATED PRODUCTS --}}
            @if ($relatedProducts->count())
                <div class="related-products">
                    <h3>You may also like</h3>
                    <div class="related-grid">
                        @foreach ($relatedProducts as $related)
                            <div class="related-card">
                                <a href="{{ route('seller.products.show', $related->id) }}">
                                    <img src="{{ $related->first_image_url ?: asset('images/placeholder.jpg') }}"
                                        alt="{{ $related->name }}">
                                    <h4>{{ $related->name }}</h4>
                                    <div class="price">{{ number_format($related->final_price, 2) }}@if ($related->discount_price)
                                            <span class="old-price">{{ number_format($related->price, 2) }}</span>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </main>
    </div>

    {{-- LIGHTBOX --}}
    <div class="lightbox" id="lightbox" onclick="closeLightbox()">
        <button class="lightbox-close" onclick="closeLightbox()">✕</button>
        <img id="lightbox-img" src="" alt="">
    </div>

    <script>
        function openLightbox(src) {
            document.getElementById('lightbox-img').src = src;
            document.getElementById('lightbox').classList.add('open');
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.remove('open');
        }
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeLightbox();
        });

        function copyText(text, btn) {
            navigator.clipboard.writeText(text).then(() => {
                const orig = btn.textContent;
                btn.textContent = '✓';
                setTimeout(() => btn.textContent = orig, 1500);
            });
        }
        const tabBtns = document.querySelectorAll('.tab-btn');
        const tabPanes = document.querySelectorAll('.tab-pane');
        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const tabId = btn.dataset.tab;
                tabBtns.forEach(b => b.classList.remove('active'));
                tabPanes.forEach(pane => pane.classList.remove('active'));
                btn.classList.add('active');
                document.getElementById(tabId).classList.add('active');
            });
        });
    </script>
</body>

</html>
