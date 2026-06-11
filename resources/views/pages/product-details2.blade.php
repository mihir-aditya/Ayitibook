<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $product->name }} | AyitiBook</title>
    <meta charset="UTF-8">
    <meta name="author" content="Author Name">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/apple-touch-icon.png') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <style>
        /* ── Subscribe icon ── */
        .subscribe-icon { position: relative; display: inline-block; }
        .subscribe-icon::after {
            content: attr(data-tooltip);
            position: absolute; bottom: 125%; left: 50%; transform: translateX(-50%);
            background-color: #333; color: #fff; padding: 4px 8px; border-radius: 4px;
            white-space: nowrap; font-size: 12px; opacity: 0; pointer-events: none;
            transition: opacity .2s ease-in-out; z-index: 10;
        }
        .subscribe-icon:hover::after { opacity: 1; }

        @keyframes ring {
            0%  { transform: rotate(0);    }  1%  { transform: rotate(30deg);  }
            3%  { transform: rotate(-28deg);} 5%  { transform: rotate(34deg);  }
            7%  { transform: rotate(-32deg);} 9%  { transform: rotate(30deg);  }
            11% { transform: rotate(-28deg);}13%  { transform: rotate(26deg);  }
            15% { transform: rotate(-24deg);}17%  { transform: rotate(22deg);  }
            19% { transform: rotate(-20deg);}21%  { transform: rotate(18deg);  }
            23% { transform: rotate(-16deg);}25%  { transform: rotate(14deg);  }
            27% { transform: rotate(-12deg);}29%  { transform: rotate(10deg);  }
            31% { transform: rotate(-8deg); }33%  { transform: rotate(6deg);   }
            35% { transform: rotate(-4deg); }37%  { transform: rotate(2deg);   }
            39% { transform: rotate(-1deg); }41%  { transform: rotate(0);      }
        }
        .ringing { color: goldenrod !important; animation: ring .6s ease-in-out; }

        /* ── Gallery ── */
        .product-gallery { display: flex; gap: 20px; }
        .thumbnails { display: flex; flex-direction: column; gap: 15px; }
        .thumb-item {
            width: 120px; height: 120px; border: 1px solid #ddd; border-radius: 8px;
            overflow: hidden; cursor: pointer; background-color: #f5f5f5;
        }
        .thumb-item:hover, .thumb-item.active { border-color: var(--bs-secondary); }
        .thumb-item img { width: 100%; height: 100%; object-fit: contain; }
        @media (max-width:768px) { .thumb-item { width: 120px; height: 80px; } }

        .main-image {
            height: 526px; display: flex; background-color: #F5F5F5; border-radius: 10px;
            width: 100%; text-align: center; align-items: center; justify-content: center;
        }
        .main-image img { width: 370px; height: 315px; border-radius: 8px; object-fit: contain; }
        @media (max-width:1024px) { .main-image img { width: 255px; height: 315px; } }
        @media (max-width:768px)  { .main-image { height: 440px; } }

        /* ── Nav pills ── */
        .nav-pills .nav-link {
            background: #f5f5f5; color: #fff; font-weight: 500;
            border: 1px solid transparent; padding: 0; width: 100%; max-height: 150px; height: 110px;
        }
        .nav-pills .nav-link.active { border-color: red; }
        .nav-link img { max-height: 70px; object-fit: cover; border: 2px solid transparent; border-radius: 5px; }

        .product-detail-page .tab-content { height: 465px; padding: 30px; }
        .tab-image-box { width: 100%; height: 300px; }
        .tab-image-box img { width: 100%; height: 100%; object-fit: contain; }

        .video-box i {
            color: #fff; width: 35px; line-height: 25px; height: 35px;
            background: #db5386 !important; border-radius: 100%;
            margin-bottom: 8px; text-align: center;
        }
        .video-box h6 { font-size: 14px !important; text-align: center; }

        /* ── Product detail text ── */
        .product-details { padding-left: 20px; }
        .product-title { font-size: 24px; font-weight: bold; margin-bottom: 15px; }
        .product-meta { display: flex; align-items: center; gap: 15px; margin-bottom: 20px; }
        .ratings { display: flex; align-items: center; gap: 5px; }
        .stars { color: #ffc107; }
        .star-empty { color: #ddd; }
        .review-count { color: #666; font-size: 14px; }
        .stock-info { font-size: 14px; }
        .in-stock { color: #00c853; }
        .out-of-stock { color: #dc3545; }
        .more-sellers { color: var(--bs-secondary); font-size: 14px; }

        .product-details .product-price { font-size: 24px; font-weight: 400; margin: 20px 0; }
        .original-price { text-decoration: line-through; color: #999; font-size: 16px; margin-left: 10px; }
        .discount-badge {
            background: #dc3545; color: #fff; font-size: 12px; padding: 2px 8px;
            border-radius: 4px; margin-left: 8px;
        }

        .product-description {
            color: #000; margin-bottom: 20px; font-size: 14px; line-height: 25px;
            padding-bottom: 20px; border-bottom: 1.6px solid #b1a9a9;
        }
        @media (max-width:1024px) {
            .product-description { margin-bottom: 15px; font-size: 12px; line-height: 22px; padding-bottom: 14px; }
        }

        /* ── Variant selector ── */
        .variant-section { margin-bottom: 20px; }
        .variant-label { font-size: 15px; font-weight: 600; margin-bottom: 10px; }
        .variant-options { display: flex; flex-wrap: wrap; gap: 10px; }
        .variant-btn {
            padding: 8px 16px; border: 1.5px solid #ccc; border-radius: 6px;
            background: #fff; cursor: pointer; font-size: 13px;
            transition: all .2s ease; white-space: nowrap;
        }
        .variant-btn:hover  { border-color: var(--bs-secondary); color: var(--bs-secondary); }
        .variant-btn.active {
            background: var(--bs-secondary); color: #fff;
            border-color: var(--bs-secondary); font-weight: 600;
        }
        .variant-btn.out-of-stock-variant { opacity: .5; cursor: not-allowed; text-decoration: line-through; }

        /* ── Quantity ── */
        .quantity-wrapper { display: flex; gap: 15px; margin-bottom: 25px; }
        .quantity-selector { display: flex; align-items: center; border: 1.4px solid #a19898; border-radius: 4px; }
        .qty-btn { border: none; background: none; padding: 8px 15px; cursor: pointer; }
        .qty-btn.minus { border-right: 1.4px solid var(--bs-secondary); background-color: var(--bs-secondary); color: #fff; }
        .qty-btn.plus  { border-left:  1.4px solid var(--bs-secondary); background-color: var(--bs-secondary); color: #fff; }
        .quantity-input { width: 50px; border: none; text-align: center; }
        @media (max-width:768px) { .qty-btn { padding: 8px 11px !important; } .quantity-input { width: 40px; } }

        /* ── Buttons ── */
        .btn-buy-now { background-color: var(--bs-secondary); color: white; border: none; padding: 8px 40px; border-radius: 5px; cursor: pointer; }
        .btn-wishlist { border: 1.5px solid #918a8a; background: none; padding: 3px 12px; border-radius: 5px; cursor: pointer; }
        .btn-wishlist:hover { background-color: var(--bs-primary); border-color: transparent; }
        .btn-wishlist:hover i { color: #fff; }
        .btn-add-cart { width: 100%; background-color: var(--bs-secondary); color: white; border: none; padding: 12px; border-radius: 4px; margin-bottom: 20px; cursor: pointer; }
        .active_wish { background-color: red !important; color: white !important; }

        /* ── Delivery info ── */
        .delivery-info { display: flex; align-items: center; gap: 15px; margin-bottom: 20px; }
        .info-card { display: flex; align-items: center; gap: 15px; padding: 15px; border: 1px solid #ddd; border-radius: 8px; }
        .info-card .icon { font-size: 24px; }
        .info-card h4 { font-size: 16px; margin: 0; }
        .info-card p { font-size: 12px; color: #000; margin: 0; }
        @media (max-width:1024px) { .info-card p { font-size: 10px; } .info-card h4 { font-size: 14px; } }
        @media (max-width:768px)  {
            .product-gallery { flex-direction: column; }
            .thumbnails { flex-direction: row; order: 2; }
            .main-image  { order: 1; }
            .quantity-wrapper { flex-wrap: wrap; }
            .delivery-info { flex-wrap: wrap; }
            .product-details { padding-left: 0; }
            .product-title { font-size: 19px; margin-bottom: 8px; }
            .product-meta { flex-wrap: wrap; gap: 5px; }
        }

        .contact-seller-btn { display: flex; justify-content: flex-end; }

        /* ── Mega-menu ── */
        body { overflow-x: hidden; }
        #megamenu { position: sticky; top: 70px; z-index: 100; display: none; }
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
        .category-list .parent-menu:hover>.inner-menu { opacity: 1; visibility: visible; }
        .category-list .inner-menu .inner-sub-menu-list:hover { background: #e8b3ba; font-weight: 500; }
        .category-list .inner-menu .inner-sub-menu-list:hover>.inner-sub-menu { opacity: 1; visibility: visible; }
        .category-list .inner-menu .inner-sub-menu-list .inner-sub-menu li:hover { background: #f2c0ce; }
        .category-list .inner-menu .inner-sub-menu-list .inner-sub-menu.open-left { left: auto; right: 220px; }

        #main-product-image { transition: opacity .25s ease; }
        #main-product-image.fading { opacity: 0; }

        .selected-variant-info {
            display: inline-flex; align-items: center; gap: 6px;
            background: #f0f7ff; border: 1px solid #b8d4f0; border-radius: 6px;
            padding: 4px 10px; font-size: 13px; margin-bottom: 14px;
        }

        /* ══════════════════════════════════════════
           REVIEWS & RATINGS STYLES
        ══════════════════════════════════════════ */

        /* ── Summary bar ── */
        .review-section { margin-top: 60px; margin-bottom: 60px; }
        .review-section .section-head .sub-title { font-size: 1.25rem; font-weight: 700; color: #111; }

        .rating-summary-card {
            background: #fff;
            border: 1px solid #f0f0f0;
            border-radius: 16px;
            padding: 28px 32px;
            display: flex;
            gap: 40px;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 32px;
            box-shadow: 0 2px 12px rgba(0,0,0,.05);
        }

        .rating-big-score {
            text-align: center;
            min-width: 110px;
        }
        .rating-big-score .score {
            font-size: 3.5rem;
            font-weight: 800;
            color: #111;
            line-height: 1;
        }
        .rating-big-score .out-of {
            font-size: .8rem;
            color: #888;
            margin-top: 4px;
        }
        .rating-big-score .total-reviews {
            font-size: .78rem;
            color: #888;
            margin-top: 6px;
        }

        /* Stars (global) */
        .rev-stars { color: #f5a623; font-size: .9rem; letter-spacing: 1px; }
        .rev-stars.lg { font-size: 1.2rem; }

        /* Breakdown bars */
        .rating-breakdown { flex: 1; min-width: 200px; }
        .rating-bar-row {
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 7px; font-size: .8rem;
        }
        .rating-bar-row .bar-label { min-width: 30px; color: #555; font-weight: 500; }
        .rating-bar-row .bar-track {
            flex: 1; height: 8px; background: #f0f0f0;
            border-radius: 99px; overflow: hidden;
        }
        .rating-bar-row .bar-fill {
            height: 100%; background: #f5a623;
            border-radius: 99px; transition: width .4s ease;
        }
        .rating-bar-row .bar-count { min-width: 24px; text-align: right; color: #888; }

        /* ── Write review form card ── */
        .write-review-card {
            background: #fff;
            border: 1px solid #f0f0f0;
            border-radius: 16px;
            padding: 28px 32px;
            margin-bottom: 32px;
            box-shadow: 0 2px 12px rgba(0,0,0,.05);
        }
        .write-review-card h5 {
            font-size: 1rem; font-weight: 700;
            color: #111; margin-bottom: 20px;
            display: flex; align-items: center; gap: 8px;
        }

        /* Interactive star picker */
        .star-picker { display: flex; gap: 6px; margin-bottom: 16px; flex-direction: row-reverse; justify-content: flex-end; }
        .star-picker input[type="radio"] { display: none; }
        .star-picker label {
            font-size: 2rem; color: #ddd; cursor: pointer;
            transition: color .15s, transform .1s;
        }
        /* Fill from hovered star leftward using sibling trick + reverse order */
        .star-picker label:hover,
        .star-picker label:hover ~ label,
        .star-picker input[type="radio"]:checked ~ label { color: #f5a623; }
        .star-picker label:hover { transform: scale(1.15); }

        .review-textarea {
            width: 100%; min-height: 110px;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px; padding: 12px 14px;
            font-size: .875rem; color: #111;
            resize: vertical; outline: none;
            transition: border-color .15s, box-shadow .15s;
            background: #fafafa;
        }
        .review-textarea:focus {
            border-color: var(--bs-secondary, #db5386);
            box-shadow: 0 0 0 3px rgba(219,83,134,.1);
            background: #fff;
        }

        /* Image preview strip */
        .image-upload-label {
            display: inline-flex; align-items: center; gap: 7px;
            cursor: pointer; font-size: .83rem; font-weight: 500;
            color: var(--bs-secondary, #db5386);
            border: 1.5px dashed var(--bs-secondary, #db5386);
            border-radius: 8px; padding: 7px 14px;
            transition: background .13s;
        }
        .image-upload-label:hover { background: rgba(219,83,134,.06); }

        #review-image-previews {
            display: flex; flex-wrap: wrap; gap: 10px; margin-top: 12px;
        }
        .img-preview-wrap {
            position: relative; width: 72px; height: 72px;
            border-radius: 8px; overflow: hidden;
            border: 1px solid #e5e7eb;
        }
        .img-preview-wrap img { width: 100%; height: 100%; object-fit: cover; }
        .img-preview-wrap .remove-img {
            position: absolute; top: 2px; right: 2px;
            background: rgba(0,0,0,.55); color: #fff;
            border: none; border-radius: 50%;
            width: 18px; height: 18px; font-size: 11px;
            cursor: pointer; display: flex; align-items: center; justify-content: center;
            line-height: 1;
        }

        /* Login prompt */
        .login-to-review {
            background: #fdf8ff;
            border: 1.5px dashed #d8b4fe;
            border-radius: 12px;
            padding: 22px 28px;
            text-align: center;
            margin-bottom: 32px;
            color: #555;
            font-size: .9rem;
        }
        .login-to-review a { color: var(--bs-secondary, #db5386); font-weight: 600; }

        /* Already reviewed banner */
        .already-reviewed-banner {
            background: #f0fdf4;
            border: 1.5px solid #86efac;
            border-radius: 12px;
            padding: 16px 22px;
            margin-bottom: 32px;
            display: flex; align-items: center; gap: 10px;
            font-size: .875rem; color: #166534;
        }

        /* ── Review cards ── */
        .review-card {
            background: #fff;
            border: 1px solid #f0f0f0;
            border-radius: 14px;
            padding: 22px 26px;
            margin-bottom: 18px;
            box-shadow: 0 1px 6px rgba(0,0,0,.04);
            transition: box-shadow .2s;
        }
        .review-card:hover { box-shadow: 0 4px 18px rgba(0,0,0,.08); }

        .review-card .reviewer-avatar {
            width: 40px; height: 40px; border-radius: 50%;
            background: linear-gradient(135deg, var(--bs-secondary, #db5386), #9333ea);
            color: #fff; font-weight: 700; font-size: .9rem;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .review-card .reviewer-name { font-weight: 600; font-size: .9rem; color: #111; }
        .review-card .review-date   { font-size: .75rem; color: #aaa; }
        .review-card .review-body   { font-size: .875rem; color: #444; line-height: 1.65; margin-top: 10px; }

        /* Review photos strip */
        .review-photos { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 12px; }
        .review-photos a { display: block; }
        .review-photos img {
            width: 72px; height: 72px; object-fit: cover;
            border-radius: 8px; border: 1px solid #eee;
            transition: transform .15s;
        }
        .review-photos img:hover { transform: scale(1.05); }

        /* Delete button */
        .btn-delete-review {
            display: inline-flex; align-items: center; gap: 5px;
            font-size: .78rem; font-weight: 500;
            color: #dc2626; background: #fff0f0;
            border: 1px solid #fecaca; border-radius: 6px;
            padding: 4px 10px; cursor: pointer;
            transition: background .13s, color .13s;
            text-decoration: none;
        }
        .btn-delete-review:hover { background: #dc2626; color: #fff; }

        /* Verified badge */
        .badge-verified {
            display: inline-flex; align-items: center; gap: 4px;
            font-size: .7rem; font-weight: 600;
            background: #ecfdf5; color: #059669;
            border: 1px solid #a7f3d0;
            border-radius: 999px; padding: 2px 8px;
        }

        /* Flash alert */
        .review-alert {
            border-radius: 10px; padding: 13px 18px;
            font-size: .875rem; margin-bottom: 20px;
            display: flex; align-items: center; gap: 10px;
        }
        .review-alert.success { background: #f0fdf4; border: 1px solid #86efac; color: #166534; }
        .review-alert.error   { background: #fff1f2; border: 1px solid #fecaca; color: #991b1b; }

        /* Confirm delete modal */
        #deleteReviewModal .modal-content {
            border-radius: 16px; border: none;
            box-shadow: 0 20px 60px rgba(0,0,0,.15);
        }
        #deleteReviewModal .modal-header {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            border-radius: 16px 16px 0 0;
            border: none; padding: 1.1rem 1.5rem;
        }
        #deleteReviewModal .modal-title { color: #fff; font-weight: 700; }
        #deleteReviewModal .btn-close-white { filter: invert(1); }

        @media (max-width: 768px) {
            .rating-summary-card { padding: 20px; gap: 20px; }
            .write-review-card   { padding: 20px; }
            .review-card         { padding: 16px; }
        }
    </style>
</head>

<body>

{{-- @include('includes.top-header') --}}
@include('includes.header')

@php
    /* ── images ── */
    $productImages = $product->images;
    if (is_string($productImages)) { $productImages = json_decode($productImages, true); }
    $productImages = is_array($productImages) ? array_filter($productImages) : [];

    /* ── videos ── */
    $productVideos = $product->videos;
    if (is_string($productVideos)) { $productVideos = json_decode($productVideos, true); }
    $productVideos = is_array($productVideos) ? array_filter($productVideos) : [];

    /* ── final price ── */
    $finalPrice  = $product->final_price ?? $product->price;
    $hasDiscount = $product->discount_price && $product->discount_type;
    $discountPct = $product->discount_percentage ?? 0;

    /* ── variants ── */
    $variants = $product->variants ?? collect();

    /* ── reviews data ── */
    $reviews        = $product->reviews ?? collect();
    $totalReviews   = $reviews->count();
    $avgRating      = $totalReviews > 0 ? round($reviews->avg('rating'), 1) : 0;
    $userReview     = auth()->check()
                      ? $reviews->firstWhere('user_id', auth()->id())
                      : null;

    // Breakdown: count per star level 5→1
    $ratingCounts = [];
    for ($s = 5; $s >= 1; $s--) {
        $ratingCounts[$s] = $reviews->where('rating', $s)->count();
    }
@endphp

<div class="page-wrapper">
    <div class="main-wrapper">
        <div class="container">

            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb py-3">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    @if($product->category)
                        <li class="breadcrumb-item"><a href="#">{{ $product->category->name }}</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                </ol>
            </nav>

            {{-- ════════ Product detail ════════ --}}
            <div class="container py-5 product-detail-page">
                <div class="row">

                    {{-- ── Left: Media gallery ── --}}
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-3">
                                <ul class="nav flex-column nav-pills" id="productTabs" role="tablist">
                                    <li class="nav-item mb-2" role="presentation">
                                        <button class="nav-link active" id="tab-thumb-tab"
                                            data-bs-toggle="pill" data-bs-target="#tab-thumb"
                                            type="button" role="tab">
                                            <img id="thumb-main-img"
                                                src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : asset('assets/images/no-image.png') }}"
                                                class="img-fluid" alt="{{ $product->name }}">
                                        </button>
                                    </li>
                                    @foreach($productVideos as $i => $video)
                                        <li class="nav-item mb-2" role="presentation">
                                            <button class="nav-link" id="tab-vid{{ $i }}-tab"
                                                data-bs-toggle="pill" data-bs-target="#tab-vid{{ $i }}"
                                                type="button" role="tab">
                                                <div class="video-box">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                    <h6>Video {{ $i + 1 }}</h6>
                                                </div>
                                            </button>
                                        </li>
                                    @endforeach
                                    @foreach($productImages as $i => $image)
                                        <li class="nav-item mb-2" role="presentation">
                                            <button class="nav-link" id="tab-img{{ $i }}-tab"
                                                data-bs-toggle="pill" data-bs-target="#tab-img{{ $i }}"
                                                type="button" role="tab">
                                                <img src="{{ asset('storage/' . $image) }}"
                                                    class="img-fluid" alt="{{ $product->name }}">
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="col-md-9">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="tab-thumb" role="tabpanel">
                                        <div class="tab-image-box">
                                            <img id="main-product-image"
                                                src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : asset('assets/images/no-image.png') }}"
                                                alt="{{ $product->name }}" class="w-100">
                                        </div>
                                    </div>
                                    @foreach($productVideos as $i => $video)
                                        <div class="tab-pane fade" id="tab-vid{{ $i }}" role="tabpanel">
                                            <video controls class="w-100" style="max-height:400px;">
                                                <source src="{{ asset('storage/' . $video) }}" type="video/mp4">
                                            </video>
                                        </div>
                                    @endforeach
                                    @foreach($productImages as $i => $image)
                                        <div class="tab-pane fade" id="tab-img{{ $i }}" role="tabpanel">
                                            <div class="tab-image-box">
                                                <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }} image {{ $i + 1 }}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ── Right: Product details ── --}}
                    <div class="col-md-6">
                        <div class="product-details">

                            <h1 class="product-title" id="product-title">{{ $product->name }}</h1>

                            <div class="d-flex align-items-center gap-2 mb-2">
                                @if($product->seller)
                                    <p class="seller-name text-danger text-capitalize mb-0">
                                        <a href="#">{{ $product->seller->name ?? 'Seller' }}</a>
                                    </p>
                                @else
                                    <p class="seller-name text-danger text-capitalize mb-0"><a href="#">Seller</a></p>
                                @endif
                                <span class="subscribe-icon" data-tooltip="Subscribe this Seller">
                                    <i class="fas fa-bell fa-lg text-primary" id="subscribeIcon" style="cursor:pointer;"></i>
                                </span>
                            </div>

                            <div class="product-meta">
                                <div class="ratings">
                                    {{-- Dynamic average from real reviews --}}
                                    <span class="rev-stars">
                                        @for($s = 1; $s <= 5; $s++)
                                            <i class="fa{{ $s <= round($avgRating) ? 's' : 'r' }} fa-star"></i>
                                        @endfor
                                    </span>
                                    <a href="#review-section" class="review-count">({{ $totalReviews }} {{ Str::plural('Review', $totalReviews) }}) |</a>
                                </div>
                                <div class="stock-info">
                                    <span id="stock-status" class="{{ $product->stock_quantity > 0 ? 'in-stock' : 'out-of-stock' }}">
                                        {{ $product->stock_quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                                    </span>
                                    <span id="stock-count">({{ $product->stock_quantity }} stocks)</span>
                                </div>
                                <span class="divider">|</span>
                                <span class="more-sellers">5 more sellers</span>
                            </div>

                            <div class="product-price" id="price-display">
                                <span class="current-price">{{ $product->currency }} {{ number_format($finalPrice, 2) }}</span>
                                @if($hasDiscount)
                                    <span class="original-price">{{ $product->currency }} {{ number_format($product->price, 2) }}</span>
                                    @if($discountPct > 0)
                                        <span class="discount-badge">-{{ round($discountPct) }}%</span>
                                    @endif
                                @endif
                            </div>

                            <p class="product-description">{{ $product->description }}</p>

                            <div class="mb-3" style="font-size:13px; color:#555;">
                                @if($product->sku) <span><strong>SKU:</strong> <span id="display-sku">{{ $product->sku }}</span></span> &nbsp;|&nbsp; @endif
                                @if($product->brand) <span><strong>Brand:</strong> {{ $product->brand->name }}</span> &nbsp;|&nbsp; @endif
                                @if($product->category) <span><strong>Category:</strong> {{ $product->category->name }}</span> @endif
                            </div>

                            @if($variants->count() > 0)
                            <div class="variant-section">
                                <div class="variant-label">
                                    <i class="fas fa-layer-group me-1 text-secondary"></i>
                                    Variants
                                    <span id="selected-variant-name" class="text-secondary fw-normal ms-1"></span>
                                </div>
                                <div class="variant-options" id="variant-options">
                                    <button class="variant-btn active"
                                        data-variant-id="base" data-variant-name="Base"
                                        data-variant-price="{{ $finalPrice }}" data-variant-sku="{{ $product->sku }}"
                                        data-variant-qty="{{ $product->stock_quantity }}"
                                        data-variant-images='@json(array_values(array_map(fn($img) => asset("storage/$img"), $productImages)))'
                                        data-variant-thumb="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : '' }}"
                                        onclick="selectVariant(this)">
                                        Default
                                    </button>
                                    @foreach($variants as $variant)
                                        @php
                                            $vImgs = $variant->images;
                                            if(is_string($vImgs)) $vImgs = json_decode($vImgs, true);
                                            $vImgs = is_array($vImgs) ? array_filter(array_values($vImgs)) : [];
                                            $firstThumb = !empty($vImgs) ? asset('storage/' . reset($vImgs)) : ($product->thumbnail ? asset('storage/' . $product->thumbnail) : '');
                                        @endphp
                                        <button class="variant-btn {{ $variant->quantity <= 0 ? 'out-of-stock-variant' : '' }}"
                                            data-variant-id="{{ $variant->id }}" data-variant-name="{{ $variant->variant_name }}"
                                            data-variant-price="{{ $variant->price }}" data-variant-sku="{{ $variant->sku }}"
                                            data-variant-qty="{{ $variant->quantity }}"
                                            data-variant-images='@json(array_values(array_map(fn($img) => asset("storage/$img"), $vImgs)))'
                                            data-variant-thumb="{{ $firstThumb }}"
                                            {{ $variant->quantity <= 0 ? 'disabled' : '' }}
                                            onclick="selectVariant(this)">
                                            {{ $variant->variant_name }}
                                            @if($variant->quantity <= 0)<small>(Out)</small>@endif
                                        </button>
                                    @endforeach
                                </div>
                                <div id="variant-info-badge" class="selected-variant-info mt-2" style="display:none;">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span id="variant-badge-text"></span>
                                </div>
                            </div>
                            @endif

                            <div class="quantity-wrapper">
                                <div class="quantity-selector">
                                    <button class="qty-btn minus" onclick="changeQuantity(-1)">−</button>
                                    <input type="number" id="quantity" value="1" min="1"
                                        max="{{ $product->maximum_purchase_quantity ?? 999 }}"
                                        class="quantity-input">
                                    <button class="qty-btn plus" onclick="changeQuantity(1)">+</button>
                                </div>
                                <button onclick="buyNow({{ $product->id }})" class="btn-buy-now">Buy Now</button>
                                <button id="wishlist-btn-{{ $product->id }}"
                                    onclick="addWishlist({{ $product->id }})"
                                    class="btn-wishlist {{ isset($product->is_wishlist) && $product->is_wishlist ? 'active_wish' : '' }}">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>

                            @if(isset($product->is_cart) && $product->is_cart)
                                <button onclick="window.location.href='{{ route('cart.index') }}'" class="btn btn-primary w-100 mb-4">Go To Cart</button>
                            @else
                                <button class="btn btn-primary w-100 mb-4" onclick="addToCart({{ $product->id }})">Add To Cart</button>
                            @endif

                            <div class="delivery-info">
                                <div class="info-card">
                                    <div class="icon">
                                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_delivery)"><path d="M11.6673 31.6667C13.5083 31.6667 15.0007 30.1743 15.0007 28.3333C15.0007 26.4924 13.5083 25 11.6673 25C9.82637 25 8.33398 26.4924 8.33398 28.3333C8.33398 30.1743 9.82637 31.6667 11.6673 31.6667Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M28.3333 31.6667C30.1743 31.6667 31.6667 30.1743 31.6667 28.3333C31.6667 26.4924 30.1743 25 28.3333 25C26.4924 25 25 26.4924 25 28.3333C25 30.1743 26.4924 31.6667 28.3333 31.6667Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33398 28.3335H7.00065C5.89608 28.3335 5.00065 27.4381 5.00065 26.3335V21.6668M3.33398 8.3335H19.6673C20.7719 8.3335 21.6673 9.22893 21.6673 10.3335V28.3335M15.0007 28.3335H25.0007M31.6673 28.3335H33.0007C34.1052 28.3335 35.0007 27.4381 35.0007 26.3335V18.3335M35.0007 18.3335H21.6673M35.0007 18.3335L30.5833 10.9712C30.2218 10.3688 29.5708 10.0002 28.8683 10.0002H21.6673" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M5 11.8181H11.6667" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M1.81836 15.4546H8.48503" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M5 19.0908H11.6667" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></g><defs><clipPath id="clip0_delivery"><rect width="40" height="40" fill="white"/></clipPath></defs></svg>
                                    </div>
                                    <div class="content"><h4>Free Delivery</h4><p>Enter your postal code for Delivery Availability</p></div>
                                </div>
                                @if(isset($product->seller) && $product->seller->accepts_cod == 1)
    <div class="info-card">
        <div class="icon">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M3 7H21V17H3V7Z"
                      stroke="black"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"/>
                <path d="M3 11H21"
                      stroke="black"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="content">
            <h4>Cash on Delivery Available</h4>
            <p>This seller accepts Cash on Delivery (COD).</p>
        </div>
    </div>
@endif
                                <div class="info-card">
                                    <div class="icon">
                                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_return)"><path d="M33.3327 18.3334C32.9251 15.4004 31.5645 12.6828 29.4604 10.5992C27.3564 8.51563 24.6256 7.18161 21.6888 6.80267C18.752 6.42372 15.7721 7.02088 13.208 8.50216C10.644 9.98343 8.6381 12.2666 7.49935 15.0001M6.66602 8.33341V15.0001H13.3327" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M6.66602 21.6667C7.07361 24.5997 8.43423 27.3173 10.5383 29.4009C12.6423 31.4845 15.3731 32.8186 18.3099 33.1975C21.2467 33.5764 24.2266 32.9793 26.7907 31.498C29.3547 30.0167 31.3606 27.7335 32.4994 25.0001M33.3327 31.6667V25.0001H26.666" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></g><defs><clipPath id="clip0_return"><rect width="40" height="40" fill="white"/></clipPath></defs></svg>
                                    </div>
                                    <div class="content"><h4>Return Delivery</h4><p>Free 30 Days Delivery Returns. <a href="#">Details</a></p></div>
                                </div>
                            </div>

                            <div class="contact-seller-btn">
                                <button class="btn btn-primary me-2" type="button">Send Enquiry</button>
                                <button class="btn btn-primary" type="button">Contact Seller</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- ════════ Product description ════════ --}}
            <div class="row mb-4 mt-5">
                <div class="col-md-7">
                    <div class="product-description-box">
                        <div class="d-flex align-items-end gap-xl-5 gap-2 mb-3 flex-wrap position-relative">
                            <div class="section-head mb-0"><span class="sub-title text-capitalize">Description</span></div>
                        </div>
                        <p class="product-des">{{ $product->description }}</p>
                    </div>
                </div>
                <div class="col-md-5">
                    @if($product->thumbnail)
                        <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="w-100 img-style">
                    @endif
                </div>
            </div>

            {{-- ════════ Related products ════════ --}}
            <div class="d-flex align-items-end gap-xl-5 gap-2 mb-3 flex-wrap position-relative mt-5">
                <div class="section-head mb-0"><span class="sub-title text-capitalize">Related Product</span></div>
            </div>
            <div class="swiper related-product-swiper pt-3">
                <div class="swiper-wrapper">
                    @forelse($relatedProducts ?? [] as $related)
                        <div class="swiper-slide">
                            <div class="related-product mb-4">
                                <div class="media-box">
                                    <div class="product-img">
                                        <a href="{{ route('products.show', $related) }}">
                                            <img src="{{ $related->thumbnail_url ?? asset('assets/images/no-image.png') }}" alt="{{ $related->name }}">
                                        </a>
                                        <div class="hover-btn">
                                            <button class="btn add-cart add-cart2" onclick="addToCart({{ $related->id }})">Add To Cart</button>
                                        </div>
                                    </div>
                                    @if($related->discount_price)
                                        <span class="badge style1 badge-primary">-{{ round($related->discount_percentage) }}%</span>
                                    @endif
                                </div>
                                <div class="content-box">
                                    <h6 class="title"><a href="{{ route('products.show', $related) }}">{{ $related->name }}</a></h6>
                                    <div class="meta-div">
                                        <span class="text1 text-danger">{{ $related->currency }} {{ number_format($related->final_price, 2) }}</span>
                                        @if($related->discount_price)
                                            <p class="text1 text-gray"><strike>{{ $related->currency }} {{ number_format($related->price, 2) }}</strike></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        @for($p = 0; $p < 4; $p++)
                        <div class="swiper-slide">
                            <div class="related-product mb-4" style="opacity:.4;">
                                <div class="media-box"><div class="product-img" style="background:#f5f5f5;height:200px;"></div></div>
                                <div class="content-box"><h6 class="title">No related products</h6></div>
                            </div>
                        </div>
                        @endfor
                    @endforelse
                </div>
            </div>


            {{-- ════════════════════════════════════════════════════
                 RATINGS & REVIEWS SECTION
            ════════════════════════════════════════════════════ --}}
            <section class="review-section" id="review-section">

                {{-- Section heading --}}
                <div class="d-flex align-items-center justify-content-between gap-2 mb-4 flex-wrap">
                    <div class="section-head mb-0">
                        <span class="sub-title text-capitalize text-dark mb-0">Ratings &amp; Reviews</span>
                    </div>
                    @auth
                        @if(!$userReview)
                            <a href="#write-review" class="btn btn-primary btn-sm">
                                <i class="fas fa-pen me-1"></i> Write a Review
                            </a>
                        @endif
                    @endauth
                </div>

                {{-- Flash messages --}}
                @if(session('review_success'))
                    <div class="review-alert success">
                        <i class="fas fa-check-circle"></i> {{ session('review_success') }}
                    </div>
                @endif
                @if(session('review_error'))
                    <div class="review-alert error">
                        <i class="fas fa-exclamation-circle"></i> {{ session('review_error') }}
                    </div>
                @endif

                {{-- ── Rating summary card ── --}}
                @if($totalReviews > 0)
                <div class="rating-summary-card">
                    {{-- Big score --}}
                    <div class="rating-big-score">
                        <div class="score">{{ number_format($avgRating, 1) }}</div>
                        <div class="rev-stars lg mt-1">
                            @for($s = 1; $s <= 5; $s++)
                                @if($s <= floor($avgRating))
                                    <i class="fas fa-star"></i>
                                @elseif($s - $avgRating < 1)
                                    <i class="fas fa-star-half-alt"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <div class="out-of">out of 5</div>
                        <div class="total-reviews">{{ $totalReviews }} {{ Str::plural('review', $totalReviews) }}</div>
                    </div>

                    {{-- Breakdown bars --}}
                    <div class="rating-breakdown">
                        @foreach($ratingCounts as $star => $count)
                        <div class="rating-bar-row">
                            <span class="bar-label">{{ $star }} <i class="fas fa-star" style="color:#f5a623;font-size:.7rem;"></i></span>
                            <div class="bar-track">
                                <div class="bar-fill" style="width: {{ $totalReviews > 0 ? round($count / $totalReviews * 100) : 0 }}%"></div>
                            </div>
                            <span class="bar-count">{{ $count }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- ── Write review form / login prompt / already-reviewed ── --}}
                @auth
                    @if($userReview)
                        {{-- Already reviewed banner --}}
                        <div class="already-reviewed-banner">
                            <i class="fas fa-check-circle fa-lg"></i>
                            <div>
                                <strong>You've already reviewed this product.</strong>
                                Your {{ $userReview->rating }}-star review is shown below.
                                You can delete it if you'd like to revise it.
                            </div>
                        </div>
                    @else
                        {{-- Write review form --}}
                        <div class="write-review-card" id="write-review">
                            <h5>
                                <i class="fas fa-pen-alt" style="color:var(--bs-secondary,#db5386);"></i>
                                Share your experience
                            </h5>

                            @if($errors->any())
                            <div class="review-alert error mb-3">
                                <i class="fas fa-exclamation-circle"></i>
                                <div>
                                    @foreach($errors->all() as $err)
                                        <div>{{ $err }}</div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <form action="{{ route('reviews.store', $product) }}"
                                  method="POST"
                                  enctype="multipart/form-data"
                                  id="reviewForm">
                                @csrf

                                {{-- Star picker --}}
                                <label class="form-label fw-semibold mb-1">Your Rating <span class="text-danger">*</span></label>
                                <div class="star-picker" id="starPicker">
                                    {{-- Reverse order for CSS sibling trick --}}
                                    @for($s = 5; $s >= 1; $s--)
                                        <input type="radio" name="rating" id="star{{ $s }}" value="{{ $s }}"
                                               {{ old('rating') == $s ? 'checked' : '' }} required>
                                        <label for="star{{ $s }}" title="{{ $s }} star{{ $s > 1 ? 's' : '' }}">&#9733;</label>
                                    @endfor
                                </div>
                                <p class="text-muted" id="star-hint" style="font-size:.78rem;margin-top:-8px;margin-bottom:14px;">Click a star to rate</p>

                                {{-- Review text --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold" for="reviewBody">
                                        Your Review <span class="text-danger">*</span>
                                    </label>
                                    <textarea id="reviewBody" name="body" class="review-textarea"
                                              placeholder="What did you like or dislike? How was the quality, packaging, delivery…"
                                              minlength="10" maxlength="2000" required>{{ old('body') }}</textarea>
                                    <div class="d-flex justify-content-between mt-1">
                                        <span style="font-size:.72rem;color:#aaa;">Min 10 characters</span>
                                        <span id="charCount" style="font-size:.72rem;color:#aaa;">0 / 2000</span>
                                    </div>
                                </div>

                                {{-- Photo upload --}}
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Photos <span class="text-muted fw-normal">(optional, up to 5)</span></label>
                                    <div>
                                        <label for="reviewImagesTrigger" class="image-upload-label">
                                            <i class="fas fa-camera"></i> Add Photos
                                        </label>
                                        {{-- Hidden container where we clone file inputs --}}
                                        <div id="fileInputsContainer"></div>
                                        {{-- Trigger input (not submitted) --}}
                                        <input type="file" id="reviewImagesTrigger"
                                               accept="image/jpeg,image/png,image/jpg,image/webp"
                                               class="d-none" onchange="previewImages(this)">
                                    </div>
                                    <div id="review-image-previews"></div>
                                </div>

                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-paper-plane me-1"></i> Submit Review
                                </button>
                            </form>
                        </div>
                    @endif
                @else
                    {{-- Not logged in --}}
                    <div class="login-to-review">
                        <i class="fas fa-lock mb-2 d-block" style="font-size:1.5rem;color:#c084fc;"></i>
                        <strong>Want to share your experience?</strong><br>
                        <a href="{{ route('login') }}">Log in</a> or <a href="{{ route('register') }}">create an account</a> to write a review.
                    </div>
                @endauth

                {{-- ── Review list ── --}}
                @if($totalReviews > 0)
                    <h6 class="fw-bold mb-3" style="color:#555;font-size:.85rem;text-transform:uppercase;letter-spacing:.05em;">
                        {{ $totalReviews }} {{ Str::plural('Review', $totalReviews) }}
                    </h6>

                    @foreach($reviews as $review)
                    <div class="review-card" id="review-{{ $review->id }}">
                        <div class="d-flex align-items-flex-start justify-content-between gap-3 flex-wrap">
                            {{-- Avatar + name --}}
                            <div class="d-flex align-items-center gap-3">
                                <div class="reviewer-avatar">
                                    {{ strtoupper(substr($review->user->name ?? 'A', 0, 2)) }}
                                </div>
                                <div>
                                    <div class="reviewer-name">
                                        {{ $review->user->name ?? 'Anonymous' }}
                                        @if(auth()->check() && $review->user_id === auth()->id())
                                            <span class="ms-1" style="font-size:.72rem;color:#9ca3af;font-weight:400;">(you)</span>
                                        @endif
                                    </div>
                                    <div class="review-date">{{ $review->created_at->format('d M Y') }}</div>
                                </div>
                            </div>

                            {{-- Stars + delete --}}
                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                <span class="rev-stars">
                                    @for($s = 1; $s <= 5; $s++)
                                        <i class="fa{{ $s <= $review->rating ? 's' : 'r' }} fa-star"></i>
                                    @endfor
                                    <span style="font-size:.78rem;color:#888;margin-left:4px;">{{ $review->rating }}/5</span>
                                </span>

                                @auth
                                    @if($review->user_id === auth()->id())
                                        {{-- Delete button triggers confirm modal --}}
                                        <button class="btn-delete-review"
                                                onclick="confirmDelete({{ $review->id }})">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    @endif
                                @endauth
                            </div>
                        </div>

                        {{-- Body --}}
                        <p class="review-body">{{ $review->body }}</p>

                        {{-- Review photos --}}
                        @if(!empty($review->images))
                        <div class="review-photos">
                            @foreach($review->image_urls as $imgUrl)
                                <a href="{{ $imgUrl }}" target="_blank" rel="noopener">
                                    <img src="{{ $imgUrl }}" alt="Review photo">
                                </a>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    @endforeach

                @else
                    <div class="text-center py-5" style="color:#bbb;">
                        <i class="far fa-comment-dots fa-3x mb-3 d-block"></i>
                        <p class="mb-0" style="font-size:.95rem;">No reviews yet. Be the first to review this product!</p>
                    </div>
                @endif

            </section>{{-- end review-section --}}


        </div>{{-- end .container --}}
    </div>
</div>

{{-- ══════════════════════════════════════════
     DELETE CONFIRM MODAL
══════════════════════════════════════════ --}}
<div class="modal fade" id="deleteReviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-trash-alt me-2"></i>Delete Review
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body py-4 text-center">
                <i class="fas fa-exclamation-triangle fa-2x text-warning mb-3 d-block"></i>
                <p class="mb-1 fw-semibold">Are you sure you want to delete your review?</p>
                <p class="text-muted" style="font-size:.85rem;">This action cannot be undone.</p>
            </div>
            <div class="modal-footer border-0 justify-content-center gap-3">
                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteReviewForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4">
                        <i class="fas fa-trash-alt me-1"></i> Yes, Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('includes.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/custom-swiper.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/mobile.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script>
/* ── Variant data ── */
const BASE_CURRENCY = "{{ $product->currency }}";
const BASE_PRICE    = {{ $finalPrice }};
const BASE_QTY      = {{ $product->stock_quantity }};
const BASE_SKU      = "{{ $product->sku }}";
const BASE_THUMB    = "{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : '' }}";
const BASE_IMAGES   = @json(array_values(array_map(fn($img) => asset("storage/$img"), $productImages)));

/* ── Quantity ── */
function changeQuantity(change) {
    const input = document.getElementById('quantity');
    let val = parseInt(input.value) || 1;
    val = Math.min(Math.max(val + change, 1), parseInt(input.max) || 999);
    input.value = val;
}

/* ── Subscribe bell ── */
document.getElementById("subscribeIcon").addEventListener("click", function () {
    this.classList.add("ringing");
    setTimeout(() => this.classList.remove("ringing"), 600);
    this.classList.toggle("subscribed");
    this.style.color = this.classList.contains("subscribed") ? "goldenrod" : "#0d6efd";
});

/* ── Variant selector ── */
function selectVariant(btn) {
    if (btn.disabled) return;
    document.querySelectorAll('#variant-options .variant-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    const price = parseFloat(btn.dataset.variantPrice);
    const sku   = btn.dataset.variantSku;
    const qty   = parseInt(btn.dataset.variantQty);
    const thumb = btn.dataset.variantThumb;
    let images  = [];
    try { images = JSON.parse(btn.dataset.variantImages || '[]'); } catch(e) {}

    document.querySelector('#price-display .current-price').textContent = BASE_CURRENCY + ' ' + price.toFixed(2);
    const skuEl = document.getElementById('display-sku');
    if (skuEl) skuEl.textContent = sku || '—';
    const stockStatus = document.getElementById('stock-status');
    const stockCount  = document.getElementById('stock-count');
    stockStatus.textContent = qty > 0 ? 'In Stock' : 'Out of Stock';
    stockStatus.className   = qty > 0 ? 'in-stock' : 'out-of-stock';
    stockCount.textContent  = '(' + qty + ' stocks)';
    document.getElementById('quantity').max = qty > 0 ? qty : 1;

    const badge = document.getElementById('variant-info-badge');
    if (btn.dataset.variantId === 'base') {
        badge.style.display = 'none';
        document.getElementById('selected-variant-name').textContent = '';
    } else {
        badge.style.display = 'inline-flex';
        document.getElementById('variant-badge-text').textContent = btn.dataset.variantName + (sku ? ' · SKU: ' + sku : '');
        document.getElementById('selected-variant-name').textContent = '— ' + btn.dataset.variantName;
    }

    const galleryImages = images.length > 0 ? images : (thumb ? [thumb] : BASE_IMAGES);
    const mainThumb = thumb || (BASE_IMAGES.length > 0 ? BASE_IMAGES[0] : '');
    const mainImg = document.getElementById('main-product-image');
    mainImg.classList.add('fading');
    setTimeout(() => { mainImg.src = mainThumb || galleryImages[0] || ''; mainImg.classList.remove('fading'); }, 250);
    rebuildGallery(mainThumb, galleryImages);
}

function rebuildGallery(thumbSrc, images) {
    const mainThumbImg = document.getElementById('thumb-main-img');
    if (mainThumbImg && thumbSrc) mainThumbImg.src = thumbSrc;
    document.querySelectorAll('[id^="tab-img"]').forEach(el => el.remove());
    const firstTab = document.getElementById('tab-thumb-tab');
    if (firstTab) {
        document.querySelectorAll('#productTabs .nav-link').forEach(l => l.classList.remove('active'));
        firstTab.classList.add('active');
        document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('show', 'active'));
        document.getElementById('tab-thumb')?.classList.add('show', 'active');
    }
    const tabList    = document.getElementById('productTabs');
    const tabContent = document.querySelector('.tab-content');
    images.forEach((imgUrl, i) => {
        if (!imgUrl) return;
        const li = document.createElement('li');
        li.className = 'nav-item mb-2'; li.setAttribute('role', 'presentation');
        li.innerHTML = `<button class="nav-link" id="tab-img${i}-tab" data-bs-toggle="pill" data-bs-target="#tab-img${i}" type="button" role="tab"><img src="${imgUrl}" class="img-fluid" alt="Variant image ${i+1}" style="width:100%;height:100%;object-fit:contain;"></button>`;
        tabList.appendChild(li);
        const pane = document.createElement('div');
        pane.className = 'tab-pane fade'; pane.id = `tab-img${i}`; pane.setAttribute('role', 'tabpanel');
        pane.innerHTML = `<div class="tab-image-box"><img src="${imgUrl}" alt="Variant image ${i+1}"></div>`;
        tabContent.appendChild(pane);
    });
}

/* ── Swiper ── */
new Swiper(".related-product-swiper", {
    slidesPerView: 4, spaceBetween: 30,
    pagination: { el: ".swiper-pagination", clickable: true },
    navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
    breakpoints: { 320:{slidesPerView:1}, 480:{slidesPerView:2}, 768:{slidesPerView:2}, 991:{slidesPerView:3}, 1024:{slidesPerView:3}, 1200:{slidesPerView:4} }
});

/* ── Cart / Wishlist / Buy-now ── */
function getSelectedVariantId() {
    const active = document.querySelector('#variant-options .variant-btn.active');
    if (!active || active.dataset.variantId === 'base') return null;
    return active.dataset.variantId;
}
function addToCart(productId) {
    $.ajax({ url:"{{ route('cart.add') }}", type:"POST",
        data:{ product_id:productId, variant_id:getSelectedVariantId(), quantity:document.getElementById('quantity').value, _token:"{{ csrf_token() }}" },
        success: r => { toast(r.message || "Added to cart!", "success"); refreshCartCount(); },
        error: xhr => toast(xhr.responseJSON?.message || "Something went wrong!", "error")
    });
}
function buyNow(productId) {
    $.ajax({ url:"{{ route('cart.add') }}", type:"POST",
        data:{ product_id:productId, variant_id:getSelectedVariantId(), quantity:document.getElementById('quantity').value, _token:"{{ csrf_token() }}" },
        success: r => { toast(r.message || "Added!", "success"); refreshCartCount(); window.location.href="{{ route('cart.index') }}"; },
        error: xhr => toast(xhr.responseJSON?.message || "Something went wrong!", "error")
    });
}
function addWishlist(productId) {
    $.ajax({ url:"/wishlist/add", type:"POST",
        data:{ product_id:productId, _token:"{{ csrf_token() }}" },
        success: r => { toast(r.message || "Added to wishlist!", "success"); document.getElementById('wishlist-btn-'+productId).classList.toggle('active_wish'); refreshWishlistCount(); },
        error: xhr => toast(xhr.responseJSON?.message || "Error", "error")
    });
}
function refreshCartCount()    { $.get("{{ route('cart.count') }}",     d => $("#cart-count").text(d.count)); }
function refreshWishlistCount(){ $.get("{{ route('wishlist.count') }}", d => $("#wishlist-count").text(d.count)); }
function toast(msg, type) {
    Toastify({ text:msg, duration:3000, gravity:"top", position:"right",
        backgroundColor: type==="success" ? "linear-gradient(to right,#00b09b,#96c93d)" : "linear-gradient(to right,#ff5f6d,#ffc371)"
    }).showToast();
}

/* ══════════════════════════════════════════
   REVIEW-SPECIFIC JS
══════════════════════════════════════════ */

/* ── Star picker label ── */
const starHints = { 1:'Terrible', 2:'Poor', 3:'Average', 4:'Good', 5:'Excellent' };
document.querySelectorAll('.star-picker input[type="radio"]').forEach(radio => {
    radio.addEventListener('change', function () {
        const hint = document.getElementById('star-hint');
        if (hint) hint.textContent = starHints[this.value] || '';
    });
});

/* ── Character counter ── */
const bodyEl = document.getElementById('reviewBody');
const countEl = document.getElementById('charCount');
if (bodyEl && countEl) {
    bodyEl.addEventListener('input', function() {
        countEl.textContent = this.value.length + ' / 2000';
        countEl.style.color = this.value.length > 1900 ? '#dc2626' : '#aaa';
    });
}

/* ── Image preview ──
   Strategy: each selected file gets its OWN hidden <input type="file" name="images[]">
   cloned from the trigger input. This avoids DataTransfer API issues on Windows/Chrome.
── */
let imageCount = 0;

function previewImages(trigger) {
    const maxFiles  = 5;
    const container = document.getElementById('review-image-previews');
    const hiddenBox = document.getElementById('fileInputsContainer');
    const file      = trigger.files[0];   // one at a time — trigger has no [multiple]

    if (!file) return;

    // Count existing hidden inputs that haven't been removed
    const existing = hiddenBox.querySelectorAll('input[type="file"]').length;
    if (existing >= maxFiles) {
        toast('You can upload a maximum of 5 photos.', 'error');
        trigger.value = '';
        return;
    }

    const idx = imageCount++;

    // ── Clone the trigger into a hidden real input that carries the file ──
    const hiddenInput = document.createElement('input');
    hiddenInput.type     = 'file';
    hiddenInput.name     = 'images[]';
    hiddenInput.id       = 'hiddenImg_' + idx;
    hiddenInput.style.display = 'none';
    hiddenInput.accept   = 'image/jpeg,image/png,image/jpg,image/webp';

    // We must re-use the same FileList — trick: use DataTransfer only for 1 file
    // (single-file DataTransfer is supported everywhere, unlike multi-file sync)
    try {
        const dt = new DataTransfer();
        dt.items.add(file);
        hiddenInput.files = dt.files;
    } catch(e) {
        // Fallback: just keep the trigger itself as the submitted input
        trigger.name = 'images[]';
        trigger.id   = 'hiddenImg_' + idx;
        hiddenBox.appendChild(trigger);

        // Create a fresh trigger for next image
        const newTrigger = document.createElement('input');
        newTrigger.type     = 'file';
        newTrigger.id       = 'reviewImagesTrigger';
        newTrigger.accept   = 'image/jpeg,image/png,image/jpg,image/webp';
        newTrigger.className = 'd-none';
        newTrigger.onchange  = function() { previewImages(this); };
        document.querySelector('label[for="reviewImagesTrigger"]').after(newTrigger);
        document.querySelector('label[for="reviewImagesTrigger"]').setAttribute('for', 'reviewImagesTrigger');

        showPreview(file, idx, container);
        return;
    }

    hiddenBox.appendChild(hiddenInput);

    // ── Show preview thumbnail ──
    showPreview(file, idx, container);

    // Reset trigger so same file can be re-selected
    trigger.value = '';
}

function showPreview(file, idx, container) {
    const reader = new FileReader();
    reader.onload = e => {
        const wrap = document.createElement('div');
        wrap.className      = 'img-preview-wrap';
        wrap.dataset.imgIdx = idx;
        wrap.innerHTML = `
            <img src="${e.target.result}" alt="Preview">
            <button type="button" class="remove-img" onclick="removePreview(${idx})">×</button>`;
        container.appendChild(wrap);
    };
    reader.readAsDataURL(file);
}

function removePreview(idx) {
    // Remove hidden input so it won't be submitted
    const inp = document.getElementById('hiddenImg_' + idx);
    if (inp) inp.remove();

    // Remove preview thumbnail
    const wrap = document.querySelector(`.img-preview-wrap[data-img-idx="${idx}"]`);
    if (wrap) wrap.remove();
}

/* ── Delete review confirm modal ── */
function confirmDelete(reviewId) {
    document.getElementById('deleteReviewForm').action = `/reviews/${reviewId}`;
    const modal = new bootstrap.Modal(document.getElementById('deleteReviewModal'));
    modal.show();
}

/* ── Auto-scroll to review section if flash message present ── */
@if(session('review_success') || session('review_error'))
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('review-section')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
@endif
</script>

</body>
</html>