<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Website Page Title -->
    <title>Product-Detail | AyitiBook</title>

    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="author" content="Author Name">
    <meta name="robots" content="index, follow">

    <!-- Viewport Meta Tag -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon Tags -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/apple-touch-icon.png') }}">

    <!-- CSS Stylesheet Link -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">

    <!-- common css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">


    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    
  <!-- Toastify CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <style>

        .subscribe-icon {
           position: relative;
           display: inline-block;
       }
       
       /* Tooltip */
       .subscribe-icon::after {
           content: attr(data-tooltip);
           position: absolute;
           bottom: 125%;
           left: 50%;
           transform: translateX(-50%);
           background-color: #333;
           color: #fff;
           padding: 4px 8px;
           border-radius: 4px;
           white-space: nowrap;
           font-size: 12px;
           opacity: 0;
           pointer-events: none;
           transition: opacity 0.2s ease-in-out;
           z-index: 10;
       }
       .subscribe-icon:hover::after {
           opacity: 1;
       }
       
       /* Ring animation */
       @keyframes ring {
           0% { transform: rotate(0); }
           1% { transform: rotate(30deg); }
           3% { transform: rotate(-28deg); }
           5% { transform: rotate(34deg); }
           7% { transform: rotate(-32deg); }
           9% { transform: rotate(30deg); }
           11% { transform: rotate(-28deg); }
           13% { transform: rotate(26deg); }
           15% { transform: rotate(-24deg); }
           17% { transform: rotate(22deg); }
           19% { transform: rotate(-20deg); }
           21% { transform: rotate(18deg); }
           23% { transform: rotate(-16deg); }
           25% { transform: rotate(14deg); }
           27% { transform: rotate(-12deg); }
           29% { transform: rotate(10deg); }
           31% { transform: rotate(-8deg); }
           33% { transform: rotate(6deg); }
           35% { transform: rotate(-4deg); }
           37% { transform: rotate(2deg); }
           39% { transform: rotate(-1deg); }
           41% { transform: rotate(0); }
       }
       
       .ringing {
           color: goldenrod !important;
           animation: ring 0.6s ease-in-out;
       }
       
       

        .thumbnail-gallery img {
            cursor: pointer;
            border: 2px solid transparent;
            transition: border-color 0.2s;
        }

        .thumbnail-gallery img:hover,
        .thumbnail-gallery img.active {
            border-color: #dc3545;
        }

        .quantity-input {
            width: 50px;
            text-align: center;
        }

        .color-radio {
            width: 24px;
            height: 24px;
            cursor: pointer;
            border-radius: 50%;
            display: inline-block;
            margin-right: 10px;
            position: relative;
        }

        .color-radio.white {
            background: #fff;
            border: 1px solid #ddd;
        }

        .color-radio.black {
            background: #000;
        }

        .color-radio input {
            display: none;
        }

        .color-radio input:checked+span {
            display: block;
            width: 30px;
            height: 30px;
            position: absolute;
            top: -3px;
            left: -3px;
            border-radius: 50%;
            border: 2px solid #dc3545;
        }

        .size-btn {
            min-width: 40px;
        }

        .delivery-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }

        /*page detail css */
        .product-gallery {
            display: flex;
            gap: 20px;
        }

        .thumbnails {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .thumb-item {
            width: 120px;
            height: 120px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            background-color: #f5f5f5;
        }

        .thumb-item:hover {
            border-color: var(--bs-secondary);
        }

        .thumb-item.active {
            border-color: var(--bs-secondary);
        }

        .thumb-item img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        @media only screen and (max-width:768px) {
            .thumb-item {
                width: 120px;
                height: 80px;
            }

        }

        .main-image {
            height: 526px;
            display: flex;
            background-color: #F5F5F5;
            border-radius: 10px;
            width: 100%;
            text-align: center;
            align-items: center;
            justify-content: center;
        }

        .main-image img {
            width: 370px;
            height: 315px;
            border-radius: 8px;
            object-fit: contain;
        }

        @media only screen and (max-width: 1024px) {
            .main-image img {
                width: 255px;
                height: 315px;
            }

        }

        .product-details {
            padding-left: 20px;
        }

        @media only screen and (max-width:991px) {
            .product-details {
                padding-left: 12px;
            }
        }

        .product-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .product-meta {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        @media only screen and (max-width: 1024px) {
            .product-meta {
                gap: 10px;
            }
        }

        .ratings {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .stars {
            color: #ffc107;
        }

        .star-empty {
            color: #ddd;
        }

        .review-count {
            color: #666;
            font-size: 14px;
        }

        @media only screen and (max-width:991px) {
            .review-count {
                font-size: 12px !important;
            }
        }

        .stock-info {
            font-size: 14px;
        }

        .in-stock {
            color: #00c853;
        }

        .divider {
            color: #ddd;
        }

        @media only screen and (max-width:768px) {
            .stock-info {
                font-size: 13px;
            }

            .product-details {
                padding-left: 0px;
            }

            .product-title {
                font-size: 19px;
                margin-bottom: 8px;
            }

            .seller-name {
                margin-bottom: 5px;
            }

            .ratings {
                flex-wrap: wrap;
                align-items: center;
                gap: 0px;

            }

            .main-image {
                height: 440px;
            }

            .product-details .product-price {
                margin: 12px 0;
            }

            .qty-btn {
                padding: 8px 11px !important;
            }

            .quantity-input {
                width: 40px;
            }

            .info-card {
                flex-wrap: wrap;
                gap: 5px;
            }
        }

        .more-sellers {
            color: var(--bs-secondary);
            font-size: 14px;
        }

        .product-details .product-price {
            font-size: 24px;
            font-weight: 400;
            margin: 20px 0;
        }

        .product-description {
            color: #000000;
            margin-bottom: 20px;
            font-size: 14px;
            line-height: 25px;
            padding-bottom: 20px;
            border-bottom: 1.6px solid #b1a9a9;
        }

        @media only screen and (max-width: 1024px) {

            .product-description {
                margin-bottom: 15px;
                font-size: 12px;
                line-height: 22px;
                padding-bottom: 14px;
            }
        }

        .product-colors {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .product-colors .label {
            font-size: 16px !important;
            margin-bottom: 0px;
        }

        .product-sizes {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }

        .product-sizes h3 {
            font-size: 16px;
            margin-bottom: 0;
        }

        .color-options {
            display: flex;
            gap: 10px;
            padding-left: 11px;
        }

        .color-option input {
            display: none;
        }

        .color-circle {
            display: block;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 2px solid transparent;
            cursor: pointer;
        }

        .color-option input:checked+.color-circle {
            border-color: var(--bs-secondary);
        }

        .white {
            background-color: #fff;
            border: 1px solid #ddd;
        }

        .pink {
            background-color: #ff69b4;
        }


        .size-options {
            display: flex;
            gap: 15px;

            margin-left: 15px;
        }

        .size-option input {
            display: none;
        }

        .size-option span {
            display: block;
            padding: 5px 12px;
            border: 1.4px solid #928b8b;
            border-radius: 4px;
            cursor: pointer;
        }

        .size-option input:checked+span {
            background-color: var(--bs-secondary);
            color: white;
            border-color: var(--bs-secondary);
        }

        .quantity-wrapper {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            border: 1.4px solid #a19898;
            border-radius: 4px;

        }

        .qty-btn {
            border: none;
            background: none;
            padding: 8px 15px;
            cursor: pointer;
        }

        .qty-btn.minus {
            border-right: 1.4px solid var(--bs-secondary);
            background-color: var(--bs-secondary);
            color: #fff;
        }

        .qty-btn.plus {
            border-left: 1.4px solid var(--bs-secondary);
            background-color: var(--bs-secondary);
            color: #fff;
        }

        .quantity-input {
            width: 50px;
            border: none;
            text-align: center;
        }

        .btn-buy-now {
            background-color: var(--bs-secondary);
            color: white;
            border: none;
            padding: 8px 40px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-wishlist {
            border: 1.5px solid #918a8a;
            background: none;
            padding: 3px 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-wishlist:hover {
            background-color: var(--bs-primary);
            border-color: transparent;
        }

        .btn-wishlist:hover i {
            color: #fff;
        }

        .btn-add-cart {
            width: 100%;
            background-color: var(--bs-secondary);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
            cursor: pointer;
        }


        .delivery-info {
            display: flex;
            align-items: center;
            /* flex-direction: column; */
            gap: 15px;
            margin-bottom: 20px;
        }

        .info-card {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .info-card .icon {
            font-size: 24px;
        }

        .info-card h4 {
            font-size: 16px;
            margin: 0;
        }

        .info-card p {
            font-size: 12px;
            color: #000;
            margin: 0;
        }

        @media only screen and (max-width: 1024px) {
            .info-card p {
                font-size: 10px;
                color: #000;
                margin: 0;
            }

            .info-card h4 {
                font-size: 14px;
                margin: 0;
            }
        }

        .contact-seller-btn {
            display: flex;
            justify-content: flex-end;
        }

        .btn-contact {
            display: flex;
            align-items: center;
            gap: 5px;
            border: 1px solid #ddd;
            background: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
        }


        @media (max-width: 768px) {
            .product-gallery {
                flex-direction: column;
            }

            .thumbnails {
                flex-direction: row;
                order: 2;
            }

            .main-image {
                order: 1;
            }

            .quantity-wrapper {
                flex-wrap: wrap;
            }
        }

        /* review */
        .hover-dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .hover-dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content .btn {
            display: block;
            width: 100%;
            text-align: left;
            padding: 10px 16px;
            border: none;
            background: none;
            color: black;
            transition: background-color 0.3s;
        }

        .dropdown-content .btn:hover {
            background-color: #f1f1f1;
        }


        .nav-link img {
            max-height: 70px;
            object-fit: cover;
            border: 2px solid transparent;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }
        

        .nav-pills .nav-link{
            background: #f5f5f5;
            color: #fff;
            font-weight: 500;
            border: 1px solid transparent;
            padding: 0px;
            width: 100%;
            max-height: 150px;
            height: 110px;
       }
        .nav-pills .nav-link.active{
            border-color: red;;
        }
       .product-detail-page .tab-content{
            height: 465px;
            padding: 30px;
       }
       .tab-image-box{
        width: 100%;
        height: 300px;
       }
       .tab-image-box img{
        width: 100%;
        height: 100%;
        object-fit: contain;
       }
      .video-box i{
        color: #fff;
        width: 35px;
        line-height: 25px;
        height: 35px;
        background:
        #db5386 !important;
        border-radius:
        100%;
        margin-bottom: 8px;
        text-align: center;
        }

      .video-box h6{
            font-size: 14px !important;
            text-align: center;
        }
    </style>
<style>
    /* Optional: hide content initially */
    .accordion-body {
        display: none;
        padding: 10px;
        background: #fff;
    }

    .accordion-body.show {
        display: block;
    }


    /* header code */
    body {
        overflow-x: hidden;
        /* Prevent page from scrolling horizontally */
    }

    /* Added By JK ....Start  */
    #megamenu {
        position: sticky;
        top: 70px;
        /* adjust to match your header height */
        z-index: 100;
        /* background: white; */
        display: none;
        /* default is hidden */
        /* box-shadow: 0 2px 5px rgba(0,0,0,0.1); */
    }

    .category-list .inner-menu .inner-sub-menu-list .inner-sub-menu.open-left {
        left: auto;
        right: 220px;
        /* opens to the left */
    }

    .inner-sub-menu {
        left: 220px;
        /* default */
    }

    .inner-sub-menu.open-left {
        left: auto;
        right: 220px;
    }

    /* Added By JK ....End  */

    .category-list .inner-menu .inner-sub-menu-list .inner-sub-menu {
        right: auto;
        left: 100%;
        min-width: 220px;
    }

    .category-list .inner-menu .inner-sub-menu-list:hover>.inner-sub-menu {
        display: block;
    }

    @media screen and (max-width: 1200px) {

        /* If menu goes beyond screen width, show to the left instead */
        .category-list .inner-menu .inner-sub-menu-list:hover>.inner-sub-menu {
            left: auto;
            right: 100%;
        }
    }

    .category-list {
        background-color: #f7f4f424;
        padding: 0px 10px;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 4px 0px;
    }


    .category-list .parent-menu-list {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
    }

    .category-list .parent-menu-list a {
        color: #000;
    }

    .category-list .parent-menu {
        padding: 11px 13px;
        position: relative;
    }

    /* Submenu styling */
    .category-list .inner-menu {
        background:
            #fff;
        position: absolute;
        top: 100%;
        left: 0;
        padding:
            0;
        box-shadow: rgba(96, 93, 93, 0.21) 0px 2px 9px;
        border-radius:
            4px;
        opacity: 0;
        visibility: hidden;
        transition:
            all 0.3s ease-in-out;
        z-index: 10;
        width: 220px;
    }

    /* Submenu item */
    .category-list .inner-menu .inner-sub-menu-list {
        padding: 12px 17px;
        white-space: nowrap;
        position: relative;
        color: #131212;
        font-weight: 400;
        font-size: 14px;
    }

    .inner-sub-menu-list {
        position: relative !important;
    }

    .inner-sub-menu-list::after {
        content: "\f105";
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: inherit;
        font-size: 13px;
        font-family: "Font Awesome 5 free";
        font-weight: 900;
    }

    .category-list .inner-menu .inner-sub-menu-list .inner-sub-menu {
        position: absolute;
        left: 220px;
        width: 220px;
        top: -1px;
        background:
            #fbfbfb;
        opacity: 0;
        visibility: hidden;
        transition:
            all 0.3s ease-in-out;
        z-index: 10;
        box-shadow: rgba(0, 0, 0, 0.1) -4px 4px 8px;
        border:
            1px solid #d3d3d34f;
        border-radius:
            4px;
    }

    .category-list .inner-menu .inner-sub-menu-list .inner-sub-menu li {
        padding: 12px 16px;
    }

    .parent-menu-list .parent-menu:hover .main-link {
        transition: all 0.5s ease-in-out;
        color: var(--bs-primary);

    }

    /* Hover effect */
    .category-list .parent-menu:hover>.inner-menu {
        opacity: 1;
        visibility: visible;
    }

    .category-list .inner-menu .inner-sub-menu-list:hover {
        background: #e8b3ba;
        font-weight: 500;
    }

    .category-list .inner-menu .inner-sub-menu-list:hover>.inner-sub-menu {
        opacity: 1;
        visibility: visible;
    }

    .category-list .inner-menu .inner-sub-menu-list .inner-sub-menu li:hover {
        background: #f2c0ce;
    }

    .active_wish {
        background-color: red !important;
        color: white !important;
    }
</style>
</head>

<body>

    <!-- ====================site header ============================================-->
   @include('components.top-header')
  <!-- large size header -->
  @include('components.header')

 


    <div class="page-wrapper">
        <div class="main-wrapper">
            <div class="container">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb py-3">
                        <li class="breadcrumb-item"><a href="my-account.html">Account</a></li>
                        <li class="breadcrumb-item"><a href="#">Gaming</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                    </ol>
                </nav>

                <!-- product-detail-div" -->
                <div class="container py-5 product-detail-page">
                    <div class="row">
                        <!-- Product Images -->
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <!-- Nav tabs -->
                                    <ul class="nav flex-column nav-pills" id="productTabs" role="tablist">
                                        <li class="nav-item mb-2" role="presentation">
                                            <button class="nav-link active" id="tab1-tab" data-bs-toggle="pill"
                                                data-bs-target="#tab1" type="button" role="tab">
                                                <img src="{{ asset('storage/' . $product->thumbnail) }}" class="img-fluid"
                                                    alt="{{ $product->name }}">
                                            </button>
                                        </li>
                   @php
    $videos = collect(json_decode($product->videos, true) ?? [])
                ->filter(fn ($v) => !empty($v))
                ->values();
@endphp

@if($videos->count() > 0)
    @foreach ($videos as $video)
        <li class="nav-item mb-2" role="presentation">
            <button class="nav-link" id="tab{{ $loop->index + 2 }}-tab"
                data-bs-toggle="pill"
                data-bs-target="#tab{{ $loop->index + 2 }}"
                type="button"
                role="tab">
                <div class="video-box">
                    <i class="fa fa-play" aria-hidden="true"></i>
                    <h6>Video {{ $loop->iteration }}</h6>
                </div>
            </button>
        </li>
    @endforeach
@endif

                                        @foreach (json_decode($product->images, true) as $image)
    <li class="nav-item mb-2" role="presentation">
        <button
            class="nav-link"
            id="tab{{ $loop->index + $videos->count() + 2 }}-tab"
            data-bs-toggle="pill"
            data-bs-target="#tab{{ $loop->index + $videos->count() + 2 }}"
            type="button"
            role="tab">

            <img
                src="{{ asset('storage/' . $image) }}"
                class="img-fluid"
                alt="{{ $product->name }}">
        </button>
    </li>
@endforeach

                                    </ul>
                                </div>

                                <div class="col-md-9">
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                                            <div class="tab-image-box">
                                                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Main product image" class="w-100">
                                            </div>
                                        </div>
                                        @foreach ($videos as $video)
                                            <div class="tab-pane fade" id="tab{{ $loop->index + 2 }}" role="tabpanel">
                                                <video controls class="w-100" style="max-height: 400px;">
                                                    <source src="{{ asset('storage/' . $video) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        @endforeach
                                        @foreach (json_decode($product->images) as $image)
                                            <div class="tab-pane fade" id="tab{{ $loop->index + $videos->count() + 2 }}" role="tabpanel">
                                                <div class="tab-image-box">
                                                    <img src="{{ asset('storage/' . $image) }}" alt="Product image {{ $loop->index + 1 }}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- Product Details -->
                        <div class="col-md-6">
                            <div class="product-details">
                                <h1 class="product-title">{{ $product->name }}</h1>
                                 <div class="d-flex align-items-center gap-2 mb-2">
                                    <p class="seller-name text-danger text-capitalize mb-0"><a href="">Seller name</a></p>
                                     <span class="subscribe-icon" data-tooltip="Subscribe this Seller">
                                         <i class="fas fa-bell fa-lg text-primary" id="subscribeIcon" style="cursor: pointer;"></i>
                                     </span> 
                                 </div> 
                                                 
                                <div class="product-meta">
                                    <div class="ratings">
                                        <span class="stars">
                                            ★★★★<span class="star-empty">★</span>
                                        </span>
                                        <span class="review-count">(150 Reviews) | </span>
                                    </div>
                                    <div class="stock-info">
                                        <span class="in-stock">In Stock</span>
                                        <span class="stock-count">({{ $product->stock_quantity }} stocks)</span>
                                    </div>
                                    <span class="divider">|</span>
                                    <span class="more-sellers">5 more sellers</span>
                                </div>

                                <div class="product-price">{{ $product->currency }} {{ $product->price }}</div>

                                <p class="product-description">
                                    {{ $product->description }}
                                </p>

                                <div class="product-colors">
                                    <h3 class="label">Colours:</h3>
                                    <div class="color-options">
                                        <label class="color-option">
                                            <input type="radio" name="color" value="white" checked>
                                            <span class="color-circle white"></span>
                                        </label>
                                        <label class="color-option">
                                            <input type="radio" name="color" value="pink">
                                            <span class="color-circle pink"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="product-sizes">
                                    <h3>Size:</h3>
                                    <div class="size-options">
                                        <label class="size-option">
                                            <input type="radio" name="size" value="XS">
                                            <span>XS</span>
                                        </label>
                                        <label class="size-option">
                                            <input type="radio" name="size" value="S">
                                            <span>S</span>
                                        </label>
                                        <label class="size-option">
                                            <input type="radio" name="size" value="M" checked>
                                            <span>M</span>
                                        </label>
                                        <label class="size-option">
                                            <input type="radio" name="size" value="L">
                                            <span>L</span>
                                        </label>
                                        <label class="size-option">
                                            <input type="radio" name="size" value="XL">
                                            <span>XL</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="quantity-wrapper">
                                    <div class="quantity-selector">
                                        <button class="qty-btn minus" onclick="changeQuantity(-1)">-</button>
                                        <input type="number" id="quantity" value="1" min="1" class="quantity-input">
                                        <button class="qty-btn plus" onclick="changeQuantity(1)">+</button>
                                    </div>
                                    <button onclick="buyNow({{ $product->id }})" class="btn-buy-now">Buy Now</button>
                                    <button id="wishlist-btn-{{ $product->id }}" onclick="addWishlist({{ $product->id }})" class="btn-wishlist {{ $product->is_wishlist ? 'active_wish' : '' }}"><i class="far fa-heart"></i></button>
                                </div>

                                @if($product->is_cart)
                                    <button onclick="window.location.href='{{ route('cart.index') }}'" class="btn btn-primary w-100 mb-4">Go TO CART</button>
                                @else
                                <button class="btn btn-primary w-100 mb-4" onclick="addToCart({{ $product->id }})">ADD TO CART</button>
                                @endif

                                <div class="delivery-info">
                                    <div class="info-card">
                                        <div class="icon"> <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_1_5652)">
                                                    <path
                                                        d="M11.6673 31.6667C13.5083 31.6667 15.0007 30.1743 15.0007 28.3333C15.0007 26.4924 13.5083 25 11.6673 25C9.82637 25 8.33398 26.4924 8.33398 28.3333C8.33398 30.1743 9.82637 31.6667 11.6673 31.6667Z"
                                                        stroke="black" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M28.3333 31.6667C30.1743 31.6667 31.6667 30.1743 31.6667 28.3333C31.6667 26.4924 30.1743 25 28.3333 25C26.4924 25 25 26.4924 25 28.3333C25 30.1743 26.4924 31.6667 28.3333 31.6667Z"
                                                        stroke="black" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M8.33398 28.3335H7.00065C5.89608 28.3335 5.00065 27.4381 5.00065 26.3335V21.6668M3.33398 8.3335H19.6673C20.7719 8.3335 21.6673 9.22893 21.6673 10.3335V28.3335M15.0007 28.3335H25.0007M31.6673 28.3335H33.0007C34.1052 28.3335 35.0007 27.4381 35.0007 26.3335V18.3335M35.0007 18.3335H21.6673M35.0007 18.3335L30.5833 10.9712C30.2218 10.3688 29.5708 10.0002 28.8683 10.0002H21.6673"
                                                        stroke="black" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M8 28H6.66667C5.5621 28 4.66667 27.1046 4.66667 26V21.3333M3 8H19.3333C20.4379 8 21.3333 8.89543 21.3333 10V28M15 28H24.6667M32 28H32.6667C33.7712 28 34.6667 27.1046 34.6667 26V18M34.6667 18H21.3333M34.6667 18L30.2493 10.6377C29.8878 10.0353 29.2368 9.66667 28.5343 9.66667H21.3333"
                                                        stroke="black" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M5 11.8181H11.6667" stroke="black" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M1.81836 15.4546H8.48503" stroke="black" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M5 19.0908H11.6667" stroke="black" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_1_5652">
                                                        <rect width="40" height="40" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </div>
                                        <div class="content">
                                            <h4>Free Delivery</h4>
                                            <p>Enter your postal code for Delivery Availability</p>
                                        </div>
                                    </div>
                                    <div class="info-card">
                                        <div class="icon"><svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_1_5657)">
                                                    <path
                                                        d="M33.3327 18.3334C32.9251 15.4004 31.5645 12.6828 29.4604 10.5992C27.3564 8.51563 24.6256 7.18161 21.6888 6.80267C18.752 6.42372 15.7721 7.02088 13.208 8.50216C10.644 9.98343 8.6381 12.2666 7.49935 15.0001M6.66602 8.33341V15.0001H13.3327"
                                                        stroke="black" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M6.66602 21.6667C7.07361 24.5997 8.43423 27.3173 10.5383 29.4009C12.6423 31.4845 15.3731 32.8186 18.3099 33.1975C21.2467 33.5764 24.2266 32.9793 26.7907 31.498C29.3547 30.0167 31.3606 27.7335 32.4994 25.0001M33.3327 31.6667V25.0001H26.666"
                                                        stroke="black" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_1_5657">
                                                        <rect width="40" height="40" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </div>
                                        <div class="content">
                                            <h4>Return Delivery</h4>
                                            <p>Free 30 Days Delivery Returns. Details</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="contact-seller">
                                    <div class="dropdown button-dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Contact seller
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Send Enqury</a></li>
                                            <li><a class="dropdown-item" href="#">Send Enqury</a></li>
                                            <li><a class="dropdown-item" href="#">Send Enqury</a></li>
                                        </ul>
                                    </div>
                                </div> -->

                                <div class="contact-seller-btn">
                                   
                                        <button class="btn btn-primary me-2" type="button" aria-expanded="false">
                                           send Enqury
                                        </button>

                                        <button class="btn btn-primary" type="button"aria-expanded="false">
                                            Contact seller
                                        </button>
                                       
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                </div>



                 <!--product description -->
            <div class="row mb-4 mt-5">
                <div class="col-md-7">
                    <div class="product-description-box">
                        <div class="d-flex align-items-end gap-xl-5 gap-2 mb-3 flex-wrap position-relative">
                            <div class="section-head mb-0">
                                <span class="sub-title text-capitalize">Description</span>
                            </div>
                        </div>
                        <p class="product-des">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae reprehenderit a nihil
                            recusandae sapiente nulla explicabo tempora alias earum. Provident.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae reprehenderit a nihil
                            recusandae sapiente nulla explicabo tempora alias earum. Provident.
                        </p>
                    </div>
                </div>
                <div class="col-md-5">
                    <img src="./assets/images/poducts/sm-img3.png" alt="product image" class="w-100 img-style">
                </div>
            </div>

                  <!-- related product -->
            <div class="d-flex align-items-end gap-xl-5 gap-2 mb-3 flex-wrap position-relative mt-5">
                <div class="section-head mb-0">
                    <span class="sub-title text-capitalize">Related Product</span>
                </div>
            </div>
            <!-- Swiper -->
            <div class="swiper related-product-swiper pt-3 ">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="related-product mb-4">
                            <div class="media-box ">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="./assets/images/wishlist/media1.png" alt="media">
                                    </a>

                                    <div class="hover-btn">
                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Add To Cart</a>
                                    </div>
                                </div>
                                <span class="badge style1 badge-primary">
                                    -35%
                                </span>
                                <div class="product-icon-div">
                                    <ul class="ps-0">
                                        <li class="delete-icon meta-icon">
                                            <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                                        </li>
                                        <li class="view-icon meta-icon">
                                            <a href="" class=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content-box">
                                <h6 class="title">
                                    <a href="product-detail.html">ASUS FHD Gaming Laptop</a>
                                </h6>
                                <div class="meta-div">
                                    <span class="text1 text-danger">$960</span>
                                    <p class="text1 text-gray "> <strike>$1160</strike></p>
                                </div>
                                <div class="bottom-box d-flex align-items-center">
                                    <div class="d-flex align-items-center rating-icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="rating-num mb-0"> (65)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="related-product mb-4">
                            <div class="media-box ">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                    </a>

                                    <div class="hover-btn">
                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Add To Cart</a>
                                            
                                    </div>
                                </div>
                                <span class="badge style1 badge-primary">
                                    -35%
                                </span>
                                <div class="product-icon-div">
                                    <ul class="ps-0">
                                        <li class="delete-icon meta-icon">
                                            <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                                        </li>
                                        <li class="view-icon meta-icon">
                                            <a href="" class=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content-box">
                                <h6 class="title">
                                    <a href="product-detail.html">HAVIT HV-G92 Gamepad</a>
                                </h6>
                                <div class="meta-div">
                                    <span class="text1 text-danger">$560</span>
                                </div>
                                <div class="bottom-box d-flex align-items-center">
                                    <div class="d-flex align-items-center rating-icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="rating-num mb-0"> (65)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="related-product mb-4">
                            <div class="media-box ">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                    </a>

                                    <div class="hover-btn">
                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Add To Cart</a>
                                    </div>
                                </div>
                                <span class="badge style1 badge-primary">
                                    -35%
                                </span>
                                <div class="product-icon-div">
                                    <ul class="ps-0">
                                        <li class="delete-icon meta-icon">
                                            <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                                        </li>
                                        <li class="view-icon meta-icon">
                                            <a href="" class=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content-box">
                                <h6 class="title">
                                    <a href="product-detail.html">HAVIT HV-G92 Gamepad</a>
                                </h6>
                                <div class="meta-div">
                                    <span class="text1 text-danger">$560</span>
                                </div>
                                <div class="bottom-box d-flex align-items-center">
                                    <div class="d-flex align-items-center rating-icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="rating-num mb-0"> (65)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="related-product mb-4">
                            <div class="media-box ">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                    </a>

                                    <div class="hover-btn">
                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Add To Cart</a>
                                    </div>
                                </div>
                                <span class="badge style1 badge-primary">
                                    -35%
                                </span>
                                <div class="product-icon-div">
                                    <ul class="ps-0">
                                        <li class="delete-icon meta-icon">
                                            <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                                        </li>
                                        <li class="view-icon meta-icon">
                                            <a href="" class=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content-box">
                                <h6 class="title">
                                    <a href="product-detail.html">HAVIT HV-G92 Gamepad</a>
                                </h6>
                                <div class="meta-div">
                                    <span class="text1 text-danger">$560</span>
                                </div>
                                <div class="bottom-box d-flex align-items-center">
                                    <div class="d-flex align-items-center rating-icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="rating-num mb-0"> (65)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="related-product mb-4">
                            <div class="media-box ">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="./assets/images/wishlist/media1.png" alt="media">
                                    </a>

                                    <div class="hover-btn">
                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Add To Cart</a>
                                    </div>
                                </div>
                                <span class="badge style1 badge-primary">
                                    -35%
                                </span>
                                <div class="product-icon-div">
                                    <ul class="ps-0">
                                        <li class="delete-icon meta-icon">
                                            <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                                        </li>
                                        <li class="view-icon meta-icon">
                                            <a href="" class=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content-box">
                                <h6 class="title">
                                    <a href="product-detail.html">ASUS FHD Gaming Laptop</a>
                                </h6>
                                <div class="meta-div">
                                    <span class="text1 text-danger">$960</span>
                                    <p class="text1 text-gray "> <strike>$1160</strike></p>
                                </div>
                                <div class="bottom-box d-flex align-items-center">
                                    <div class="d-flex align-items-center rating-icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="rating-num mb-0"> (65)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="related-product mb-4">
                            <div class="media-box ">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                    </a>

                                    <div class="hover-btn">
                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Add To Cart</a>
                                    </div>
                                </div>
                                <span class="badge style1 badge-primary">
                                    -35%
                                </span>
                                <div class="product-icon-div">
                                    <ul class="ps-0">
                                        <li class="delete-icon meta-icon">
                                            <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content-box">
                                <h6 class="title">
                                    <a href="product-detail.html">HAVIT HV-G92 Gamepad</a>
                                </h6>
                                <div class="meta-div">
                                    <span class="text1 text-danger">$560</span>
                                </div>
                                <div class="bottom-box d-flex align-items-center">
                                    <div class="d-flex align-items-center rating-icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="rating-num mb-0"> (65)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="related-product mb-4">
                            <div class="media-box ">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                    </a>

                                    <div class="hover-btn">
                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Add To Cart</a>
                                    </div>
                                </div>
                                <span class="badge style1 badge-primary">
                                    -35%
                                </span>
                                <div class="product-icon-div">
                                    <ul class="ps-0">
                                        <li class="delete-icon meta-icon">
                                            <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                                        </li>
                                        <li class="view-icon meta-icon">
                                            <a href="" class=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content-box">
                                <h6 class="title">
                                    <a href="product-detail.html">HAVIT HV-G92 Gamepad</a>
                                </h6>
                                <div class="meta-div">
                                    <span class="text1 text-danger">$560</span>
                                </div>
                                <div class="bottom-box d-flex align-items-center">
                                    <div class="d-flex align-items-center rating-icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="rating-num mb-0"> (65)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="related-product mb-4">
                            <div class="media-box ">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                    </a>

                                    <div class="hover-btn">
                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Add To Cart</a>
                                    </div>
                                </div>
                                <span class="badge style1 badge-primary">
                                    -35%
                                </span>
                                <div class="product-icon-div">
                                    <ul class="ps-0">
                                        <li class="delete-icon meta-icon">
                                            <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                                        </li>
                                        <li class="view-icon meta-icon">
                                            <a href="" class=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content-box">
                                <h6 class="title">
                                    <a href="product-detail.html">HAVIT HV-G92 Gamepad</a>
                                </h6>
                                <div class="meta-div">
                                    <span class="text1 text-danger">$560</span>
                                </div>
                                <div class="bottom-box d-flex align-items-center">
                                    <div class="d-flex align-items-center rating-icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="rating-num mb-0"> (65)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Suggested product -->
            <div class="d-flex align-items-end gap-xl-5 gap-2 mb-3 flex-wrap position-relative mt-5">
                <div class="section-head mb-0">
                    <span class="sub-title text-capitalize">Suggested Product</span>
                </div>
            </div>
            <!-- Swiper -->
            <div class="swiper suggest-product-swiper pt-3 ">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="suggested-product mb-4">
                            <div class="media-box ">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="./assets/images/wishlist/media1.png" alt="media">
                                    </a>

                                    <div class="hover-btn">
                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Add To Cart</a>
                                    </div>
                                </div>
                                <span class="badge style1 badge-primary">
                                    -35%
                                </span>
                                <div class="product-icon-div">
                                    <ul class="ps-0">
                                        <li class="delete-icon meta-icon">
                                            <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                                        </li>
                                        <li class="view-icon meta-icon">
                                            <a href="" class=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content-box">
                                <h6 class="title">
                                    <a href="product-detail.html">ASUS FHD Gaming Laptop</a>
                                </h6>
                                <div class="meta-div">
                                    <span class="text1 text-danger">$960</span>
                                    <p class="text1 text-gray "> <strike>$1160</strike></p>
                                </div>
                                <div class="bottom-box d-flex align-items-center">
                                    <div class="d-flex align-items-center rating-icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="rating-num mb-0"> (65)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="suggested-product mb-4">
                            <div class="media-box ">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                    </a>

                                    <div class="hover-btn">
                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Add To Cart</a>
                                    </div>
                                </div>
                                <span class="badge style1 badge-primary">
                                    -35%
                                </span>
                                <div class="product-icon-div">
                                    <ul class="ps-0">
                                        <li class="delete-icon meta-icon">
                                            <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                                        </li>
                                        <li class="view-icon meta-icon">
                                            <a href="" class=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content-box">
                                <h6 class="title">
                                    <a href="product-detail.html">HAVIT HV-G92 Gamepad</a>
                                </h6>
                                <div class="meta-div">
                                    <span class="text1 text-danger">$560</span>
                                </div>
                                <div class="bottom-box d-flex align-items-center">
                                    <div class="d-flex align-items-center rating-icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="rating-num mb-0"> (65)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="suggested-product mb-4">
                            <div class="media-box ">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                    </a>

                                    <div class="hover-btn">
                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Add To Cart</a>
                                    </div>
                                </div>
                                <span class="badge style1 badge-primary">
                                    -35%
                                </span>
                                <div class="product-icon-div">
                                    <ul class="ps-0">
                                        <li class="delete-icon meta-icon">
                                            <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                                        </li>
                                        <li class="view-icon meta-icon">
                                            <a href="" class=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content-box">
                                <h6 class="title">
                                    <a href="product-detail.html">HAVIT HV-G92 Gamepad</a>
                                </h6>
                                <div class="meta-div">
                                    <span class="text1 text-danger">$560</span>
                                </div>
                                <div class="bottom-box d-flex align-items-center">
                                    <div class="d-flex align-items-center rating-icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="rating-num mb-0"> (65)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="suggested-product mb-4">
                            <div class="media-box ">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                    </a>

                                    <div class="hover-btn">
                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Add To Cart</a>
                                    </div>
                                </div>
                                <span class="badge style1 badge-primary">
                                    -35%
                                </span>
                                <div class="product-icon-div">
                                    <ul class="ps-0">
                                        <li class="delete-icon meta-icon">
                                            <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                                        </li>
                                        <li class="view-icon meta-icon">
                                            <a href="" class=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content-box">
                                <h6 class="title">
                                    <a href="product-detail.html">HAVIT HV-G92 Gamepad</a>
                                </h6>
                                <div class="meta-div">
                                    <span class="text1 text-danger">$560</span>
                                </div>
                                <div class="bottom-box d-flex align-items-center">
                                    <div class="d-flex align-items-center rating-icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="rating-num mb-0"> (65)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="suggested-product mb-4">
                            <div class="media-box ">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="./assets/images/wishlist/media1.png" alt="media">
                                    </a>

                                    <div class="hover-btn">
                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Add To Cart</a>
                                    </div>
                                </div>
                                <span class="badge style1 badge-primary">
                                    -35%
                                </span>
                                <div class="product-icon-div">
                                    <ul class="ps-0">
                                        <li class="delete-icon meta-icon">
                                            <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                                        </li>
                                        <li class="view-icon meta-icon">
                                            <a href="" class=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content-box">
                                <h6 class="title">
                                    <a href="product-detail.html">ASUS FHD Gaming Laptop</a>
                                </h6>
                                <div class="meta-div">
                                    <span class="text1 text-danger">$960</span>
                                    <p class="text1 text-gray "> <strike>$1160</strike></p>
                                </div>
                                <div class="bottom-box d-flex align-items-center">
                                    <div class="d-flex align-items-center rating-icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="rating-num mb-0"> (65)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="suggested-product mb-4">
                            <div class="media-box ">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                    </a>

                                    <div class="hover-btn">
                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Add To Cart</a>
                                    </div>
                                </div>
                                <span class="badge style1 badge-primary">
                                    -35%
                                </span>
                                <div class="product-icon-div">
                                    <ul class="ps-0">
                                        <li class="delete-icon meta-icon">
                                            <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content-box">
                                <h6 class="title">
                                    <a href="product-detail.html">HAVIT HV-G92 Gamepad</a>
                                </h6>
                                <div class="meta-div">
                                    <span class="text1 text-danger">$560</span>
                                </div>
                                <div class="bottom-box d-flex align-items-center">
                                    <div class="d-flex align-items-center rating-icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="rating-num mb-0"> (65)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="suggested-product mb-4">
                            <div class="media-box ">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                    </a>

                                    <div class="hover-btn">
                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Add To Cart</a>
                                    </div>
                                </div>
                                <span class="badge style1 badge-primary">
                                    -35%
                                </span>
                                <div class="product-icon-div">
                                    <ul class="ps-0">
                                        <li class="delete-icon meta-icon">
                                            <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                                        </li>
                                        <li class="view-icon meta-icon">
                                            <a href="" class=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content-box">
                                <h6 class="title">
                                    <a href="product-detail.html">HAVIT HV-G92 Gamepad</a>
                                </h6>
                                <div class="meta-div">
                                    <span class="text1 text-danger">$560</span>
                                </div>
                                <div class="bottom-box d-flex align-items-center">
                                    <div class="d-flex align-items-center rating-icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="rating-num mb-0"> (65)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="suggested-product mb-4">
                            <div class="media-box ">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                    </a>

                                    <div class="hover-btn">
                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Add To Cart</a>
                                    </div>
                                </div>
                                <span class="badge style1 badge-primary">
                                    -35%
                                </span>
                                <div class="product-icon-div">
                                    <ul class="ps-0">
                                        <li class="delete-icon meta-icon">
                                            <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                                        </li>
                                        <li class="view-icon meta-icon">
                                            <a href="" class=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content-box">
                                <h6 class="title">
                                    <a href="product-detail.html">HAVIT HV-G92 Gamepad</a>
                                </h6>
                                <div class="meta-div">
                                    <span class="text1 text-danger">$560</span>
                                </div>
                                <div class="bottom-box d-flex align-items-center">
                                    <div class="d-flex align-items-center rating-icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="rating-num mb-0"> (65)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <!-- latest -items list  -->
            <div class="d-flex align-items-end gap-xl-5 gap-2 mb-3 flex-wrap position-relative mt-4">
                <div class="section-head mb-0">
                    <span class="sub-title">New Arrivals</span>
                </div>
            </div>
            <!-- Swiper -->
            <div class="swiper latest-product pt-3 ">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="related-product mb-4">
                            <div class="media-box ">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="./assets/images/wishlist/media1.png" alt="media">
                                    </a>

                                    <div class="hover-btn">
                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Add To Cart</a>
                                    </div>
                                </div>
                                <span class="badge style1 badge-primary">
                                    -35%
                                </span>
                                <div class="product-icon-div">
                                    <ul class="ps-0">
                                        <li class="share-icon meta-icon">
                                            <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                                        </li>
                                        <li class="view-icon meta-icon">
                                            <a href="" class=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content-box">
                                <h6 class="title">
                                    <a href="product-detail.html">ASUS FHD Gaming Laptop</a>
                                </h6>
                                <div class="meta-div">
                                    <span class="text1 text-danger">$960</span>
                                    <p class="text1 text-gray "> <strike>$1160</strike></p>
                                </div>
                                <div class="bottom-box d-flex align-items-center">
                                    <div class="d-flex align-items-center rating-icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="rating-num mb-0"> (65)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="related-product mb-4">
                            <div class="media-box ">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                    </a>

                                    <div class="hover-btn">
                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Add To Cart</a>
                                    </div>
                                </div>
                                <span class="badge style1 badge-primary">
                                    -35%
                                </span>
                                <div class="product-icon-div">
                                    <ul class="ps-0">
                                        <li class="delete-icon meta-icon">
                                            <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                                        </li>
                                        <li class="view-icon meta-icon">
                                            <a href="" class=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content-box">
                                <h6 class="title">
                                    <a href="product-detail.html">HAVIT HV-G92 Gamepad</a>
                                </h6>
                                <div class="meta-div">
                                    <span class="text1 text-danger">$560</span>
                                </div>
                                <div class="bottom-box d-flex align-items-center">
                                    <div class="d-flex align-items-center rating-icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="rating-num mb-0"> (65)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="related-product mb-4">
                            <div class="media-box ">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                    </a>

                                    <div class="hover-btn">
                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Add To Cart</a>
                                    </div>
                                </div>
                                <span class="badge style1 badge-primary">
                                    -35%
                                </span>
                                <div class="product-icon-div">
                                    <ul class="ps-0">
                                        <li class="delete-icon meta-icon">
                                            <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                                        </li>
                                        <li class="view-icon meta-icon">
                                            <a href="" class=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content-box">
                                <h6 class="title">
                                    <a href="product-detail.html">HAVIT HV-G92 Gamepad</a>
                                </h6>
                                <div class="meta-div">
                                    <span class="text1 text-danger">$560</span>
                                </div>
                                <div class="bottom-box d-flex align-items-center">
                                    <div class="d-flex align-items-center rating-icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="rating-num mb-0"> (65)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="related-product mb-4">
                            <div class="media-box ">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                    </a>

                                    <div class="hover-btn">
                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Add To Cart</a>
                                    </div>
                                </div>
                                <span class="badge style1 badge-primary">
                                    -35%
                                </span>
                                <div class="product-icon-div">
                                    <ul class="ps-0">
                                        <li class="delete-icon meta-icon">
                                            <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                                        </li>
                                        <li class="view-icon meta-icon">
                                            <a href="" class=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content-box">
                                <h6 class="title">
                                    <a href="product-detail.html">HAVIT HV-G92 Gamepad</a>
                                </h6>
                                <div class="meta-div">
                                    <span class="text1 text-danger">$560</span>
                                </div>
                                <div class="bottom-box d-flex align-items-center">
                                    <div class="d-flex align-items-center rating-icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="rating-num mb-0"> (65)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="related-product mb-4">
                            <div class="media-box ">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="./assets/images/wishlist/media1.png" alt="media">
                                    </a>

                                    <div class="hover-btn">
                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Add To Cart</a>
                                    </div>
                                </div>
                                <span class="badge style1 badge-primary">
                                    -35%
                                </span>
                                <div class="product-icon-div">
                                    <ul class="ps-0">
                                        <li class="delete-icon meta-icon">
                                            <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                                        </li>
                                        <li class="view-icon meta-icon">
                                            <a href="" class=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content-box">
                                <h6 class="title">
                                    <a href="product-detail.html">ASUS FHD Gaming Laptop</a>
                                </h6>
                                <div class="meta-div">
                                    <span class="text1 text-danger">$960</span>
                                    <p class="text1 text-gray "> <strike>$1160</strike></p>
                                </div>
                                <div class="bottom-box d-flex align-items-center">
                                    <div class="d-flex align-items-center rating-icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="rating-num mb-0"> (65)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="related-product mb-4">
                            <div class="media-box ">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                    </a>

                                    <div class="hover-btn">
                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Add To Cart</a>
                                    </div>
                                </div>
                                <span class="badge style1 badge-primary">
                                    -35%
                                </span>
                                <div class="product-icon-div">
                                    <ul class="ps-0">
                                        <li class="delete-icon meta-icon">
                                            <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                                        </li>
                                        <li class="view-icon meta-icon">
                                            <a href="" class=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content-box">
                                <h6 class="title">
                                    <a href="product-detail.html">HAVIT HV-G92 Gamepad</a>
                                </h6>
                                <div class="meta-div">
                                    <span class="text1 text-danger">$560</span>
                                </div>
                                <div class="bottom-box d-flex align-items-center">
                                    <div class="d-flex align-items-center rating-icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="rating-num mb-0"> (65)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="related-product mb-4">
                            <div class="media-box ">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                    </a>

                                    <div class="hover-btn">
                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Add To Cart</a>
                                    </div>
                                </div>
                                <span class="badge style1 badge-primary">
                                    -35%
                                </span>
                                <div class="product-icon-div">
                                    <ul class="ps-0">
                                        <li class="delete-icon meta-icon">
                                            <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                                        </li>
                                        <li class="view-icon meta-icon">
                                            <a href="" class=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content-box">
                                <h6 class="title">
                                    <a href="product-detail.html">HAVIT HV-G92 Gamepad</a>
                                </h6>
                                <div class="meta-div">
                                    <span class="text1 text-danger">$560</span>
                                </div>
                                <div class="bottom-box d-flex align-items-center">
                                    <div class="d-flex align-items-center rating-icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="rating-num mb-0"> (65)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="related-product mb-4">
                            <div class="media-box ">
                                <div class="product-img">
                                    <a href="product-detail.html">
                                        <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                    </a>

                                    <div class="hover-btn">
                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Add To Cart</a>
                                    </div>
                                </div>
                                <span class="badge style1 badge-primary">
                                    -35%
                                </span>
                                <div class="product-icon-div">
                                    <ul class="ps-0">
                                        <li class="delete-icon meta-icon">
                                            <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                                        </li>
                                        <li class="view-icon meta-icon">
                                            <a href="" class=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content-box">
                                <h6 class="title">
                                    <a href="product-detail.html">HAVIT HV-G92 Gamepad</a>
                                </h6>
                                <div class="meta-div">
                                    <span class="text1 text-danger">$560</span>
                                </div>
                                <div class="bottom-box d-flex align-items-center">
                                    <div class="d-flex align-items-center rating-icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="rating-num mb-0"> (65)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- review -->
            <div class="review-section mb-5 mt-5">
                <div
                    class="d-flex align-items-center justify-content-between gap-xl-5 gap-2 mb-3 flex-wrap position-relative">
                    <div class="section-head mb-0">
                        <span class="sub-title text-capitalize text-dark mb-0">Ratings & Reviews</span>
                    </div>
                    <a href="#" class="btn btn-primary btn-sm">Post Your Reviews</a>
                </div>
                <!-- 1 -->
                <!-- <div class="review-box  border-bottom ">
                        <div class="d-flex align-items-start ">
                            <div class="rating-span">★ <b>5</b></div>
                            <div class="user-reviews">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur, repellendus!</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="review-product-img me-2">
                                <img src="./assets/images/poducts/sm-img3.png" alt="review-product-img">
                            </div>
                            <div class="review-product-img me-2">
                                <img src="./assets/images/poducts/sm-img3.png" alt="review-product-img">
                            </div>
                        </div>
                       
                        <div class="user-information mt-2">
                            <div class="d-flex align-items-center">
                                <h6 class="name mb-0 text-gray">pooja jangid</h6>
                                <div class="date">Dec,2024</div>
                            </div>
                        </div>
                   </div>  -->

                <!-- 2 -->
                <!-- <div class="review-box  border-bottom ">
                        <div class="d-flex align-items-start ">
                            <div class="rating-span">★ <b>5</b></div>
                            <div class="user-reviews">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur, repellendus!</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="review-product-img me-2">
                                <img src="./assets/images/poducts/sm-img3.png" alt="review-product-img">
                            </div>
                            <div class="review-product-img me-2">
                                <img src="./assets/images/poducts/sm-img3.png" alt="review-product-img">
                            </div>
                        </div>
                   
                        <div class="user-information mt-2">
                            <div class="d-flex align-items-center">
                                <h6 class="name mb-0 text-gray">pooja jangid</h6>
                                <div class="date">Dec,2024</div>
                            </div>
                        </div>
                    </div> -->

                <div class="review-wrapper  border-bottom ">
                    <!-- User Info and Rating -->
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-2">
                            <!-- <i class="fas fa-user"></i> -->
                            <img src="https://images-eu.ssl-images-amazon.com/images/S/amazon-avatars-global/default._CR0,0,1024,1024_SX48_.png"
                                alt="">
                        </div>
                        <span class="fw-bold">Ashiq Ali</span>
                    </div>

                    <!-- Star Rating and Title -->
                    <div class="mb-1">
                        <span class="star-rating me-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </span>
                        <span class="fw-semibold">Arif Bhai superb installation</span>
                    </div>

                    <!-- Review Date -->
                    <div class="mb-2">
                        <span class="review-date">Reviewed in India on 17 February 2024</span>
                    </div>

                    <!-- Style Info -->
                    <div class="mb-2">
                        <span class="style-name">Style Name: 2 Ton 5 Star (2023 Model)</span>
                        <span class="verified-badge ms-2">
                            <i class="fas fa-check-circle me-1"></i>
                            Verified Purchase
                        </span>
                    </div>

                    <!-- Review Text -->
                    <div class="mb-3">
                        <p class="mb-0">Arif Bhai very good intallation and reasonable price, 10 star , polite and
                            friendly</p>
                    </div>

                    <!-- Review Images -->
                    <div class="review-images">
                        <div class="d-flex gap-2">


                            <img src="./assets/images/poducts/sm-img3.png" alt="review-product-img">
                            <img src="./assets/images/poducts/sm-img3.png" alt="review-product-img">


                        </div>
                    </div>
                </div>
                <div class="review-wrapper  border-bottom ">
                    <!-- User Info and Rating -->
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-2">
                            <!-- <i class="fas fa-user"></i> -->
                            <img src="https://images-eu.ssl-images-amazon.com/images/S/amazon-avatars-global/default._CR0,0,1024,1024_SX48_.png"
                                alt="">
                        </div>
                        <span class="fw-bold">Ashiq Ali</span>
                    </div>

                    <!-- Star Rating and Title -->
                    <div class="mb-1">
                        <span class="star-rating me-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </span>
                        <span class="fw-semibold">Arif Bhai superb installation</span>
                    </div>

                    <!-- Review Date -->
                    <div class="mb-2">
                        <span class="review-date">Reviewed in India on 17 February 2024</span>
                    </div>

                    <!-- Style Info -->
                    <div class="mb-2">
                        <span class="style-name">Style Name: 2 Ton 5 Star (2023 Model)</span>
                        <span class="verified-badge ms-2">
                            <i class="fas fa-check-circle me-1"></i>
                            Verified Purchase
                        </span>
                    </div>

                    <!-- Review Text -->
                    <div class="mb-3">
                        <p class="mb-0">Arif Bhai very good intallation and reasonable price, 10 star , polite and
                            friendly</p>
                    </div>

                    <!-- Review Images -->
                    <div class="review-images">
                        <div class="d-flex gap-2">
                            <img src="./assets/images/poducts/sm-img3.png" alt="review-product-img">
                            <img src="./assets/images/poducts/sm-img3.png" alt="review-product-img">
                        </div>
                    </div>
                </div>
                <div class="review-wrapper  border-bottom ">
                    <!-- User Info and Rating -->
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-2">
                            <!-- <i class="fas fa-user"></i> -->
                            <img src="https://images-eu.ssl-images-amazon.com/images/S/amazon-avatars-global/default._CR0,0,1024,1024_SX48_.png"
                                alt="">
                        </div>
                        <span class="fw-bold">Ashiq Ali</span>
                    </div>

                    <!-- Star Rating and Title -->
                    <div class="mb-1">
                        <span class="star-rating me-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </span>
                        <span class="fw-semibold">Arif Bhai superb installation</span>
                    </div>

                    <!-- Review Date -->
                    <div class="mb-2">
                        <span class="review-date">Reviewed in India on 17 February 2024</span>
                    </div>

                    <!-- Style Info -->
                    <div class="mb-2">
                        <span class="style-name">Style Name: 2 Ton 5 Star (2023 Model)</span>
                        <span class="verified-badge ms-2">
                            <i class="fas fa-check-circle me-1"></i>
                            Verified Purchase
                        </span>
                    </div>

                    <!-- Review Text -->
                    <div class="mb-3">
                        <p class="mb-0">Arif Bhai very good intallation and reasonable price, 10 star , polite and
                            friendly</p>
                    </div>

                    <!-- Review Images -->
                    <div class="review-images">
                        <div class="d-flex gap-2">
                            <img src="./assets/images/poducts/sm-img3.png" alt="review-product-img">
                            <img src="./assets/images/poducts/sm-img3.png" alt="review-product-img">
                        </div>
                    </div>
                </div>
            </div>
            </div>

          
        </div>
    </div>

    <!-- Site Footer -->
    @include('components.footer')
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom-swiper.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
      <!-- mobile js -->
    <script src="{{ asset('assets/js/mobile.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    
  <!-- Toastify JS -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- subscribed button  -->
<script>
    const icon = document.getElementById("subscribeIcon");

    icon.addEventListener("click", function () {
        icon.classList.add("ringing");

        setTimeout(() => {
            icon.classList.remove("ringing");
        }, 600); // match the animation duration

        // Toggle gold color
        if (icon.classList.contains("subscribed")) {
            icon.classList.remove("subscribed");
            icon.style.color = "#0d6efd"; // Bootstrap primary
        } else {
            icon.classList.add("subscribed");
            icon.style.color = "goldenrod";
        }
    });
</script>

    <!-- related product -->
    <script>
        var swiper = new Swiper(".related-product-swiper", {
            slidesPerView: 4,
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            // autoplay: {
            // delay: 2500,
            // disableOnInteraction: false,
            // },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,

                },

                480: {
                    slidesPerView: 2,
                },

                768: {
                    slidesPerView: 2,
                },

                991: {
                    slidesPerView: 3,
                },

                1024: {
                    slidesPerView: 3,
                },
                1200: {
                    slidesPerView: 4,
                },
            }
        });
    </script>

    <!-- suggest product -->
    <script>
        var swiper = new Swiper(".suggest-product-swiper", {
            slidesPerView: 4,
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },

            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,

                },

                480: {
                    slidesPerView: 2,
                },

                768: {
                    slidesPerView: 2,
                },

                991: {
                    slidesPerView: 3,
                },

                1024: {
                    slidesPerView: 3,
                },
                1200: {
                    slidesPerView: 4,
                },
            }
        });
    </script>

    <!-- latest product -->
    <script>
        var swiper = new Swiper(".latest-product", {
            slidesPerView: 4,
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,

                },

                480: {
                    slidesPerView: 2,
                },

                768: {
                    slidesPerView: 2,
                },

                991: {
                    slidesPerView: 3,
                },

                1024: {
                    slidesPerView: 3,
                },
                1200: {
                    slidesPerView: 4,
                },
            }
        });

        function changeQuantity(change) {
           const quantityInput = document.getElementById('quantity');

           let currentValue= parseInt(quantityInput.value);

              if (change === -1 && currentValue > 1) {
                quantityInput.value = currentValue - 1;
              } else if (change === 1) {
                quantityInput.value = currentValue + 1;
              }
        }
    </script>

     <script>
    function addWishlist(productId) {
        $.ajax({
            url: "/wishlist/add",   // Laravel route
            type: "POST",
            data: {
                product_id: productId,
                _token: "{{ csrf_token() }}" // CSRF protection
            },
            success: function(response) {
                Toastify({
                    text: response.message || "Product added to wishlist!",
                    duration: 3000,
                    gravity: "top", // top or bottom
                    position: "right", // left, center or right
                    //  only  green color

                    backgroundColor:"#5cb85c",
                }).showToast();

                document.getElementById('wishlist-btn-' + productId).classList.toggle('active_wish');

                refreshWishlistCount();
            },
            error: function(xhr) {
                Toastify({
                    text: xhr.responseJSON?.message || "Error adding to wishlist",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                }).showToast();
            }
        });
    }

    function addToCart(productId) {
    $.ajax({
        url: "{{ route('cart.add') }}",
        type: "POST",
        data: {
            product_id: productId,
            _token: "{{ csrf_token() }}"
        },
        success: function(response) {
            // Toastify success message
            Toastify({
                text: response.message || "Added to cart!",
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
            }).showToast();

            // Refresh cart count in header
            refreshCartCount();
        },
        error: function(xhr) {
            Toastify({
                text: xhr.responseJSON?.message || "Something went wrong!",
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
            }).showToast();
        }
    });
}
function buyNow(productId) {
    $.ajax({
        url: "{{ route('cart.add') }}",
        type: "POST",
        data: {
            product_id: productId,
            _token: "{{ csrf_token() }}"
        },
        success: function(response) {
            // Toastify success message
            Toastify({
                text: response.message || "Added to cart!",
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
            }).showToast();

            // Refresh cart count in header
            refreshCartCount();
            // Redirect to cart page
            window.location.href = "{{ route('cart.index') }}";
        },
        error: function(xhr) {
            Toastify({
                text: xhr.responseJSON?.message || "Something went wrong!",
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
            }).showToast();
        }
    });
}

    function refreshWishlistCount() {
    $.ajax({
        url: "{{ route('wishlist.count') }}",
        type: "GET",
        success: function(data) {
            $("#wishlist-count").text(data.count);
        }
    });
}




function refreshCartCount() {
    $.ajax({
        url: "{{ route('cart.count') }}",
        type: "GET",
        success: function(data) {
            $("#cart-count").text(data.count); // cart count update karega
        }
    });
}
</script>


</body>

</html>