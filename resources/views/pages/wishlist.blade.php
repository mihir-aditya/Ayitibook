<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Website Page Title -->
    <title>wishlist |AyitiBook</title>

    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="author" content="Author Name">
    <meta name="robots" content="index, follow">

    <!-- Viewport Meta Tag -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon Tags -->
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-touch-icon.png">

    <!-- CSS Stylesheet Link -->
    <link rel="stylesheet" type="text/css" href="assets/vendor/fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/swiper/swiper-bundle.min.css">

    <!-- common css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
    <link rel="stylesheet" type="text/css" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/header.css">


    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>



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
    </style>
</head>

<body>
 <!-- ====================site header ============================================-->
   @include('components.top-header')
  <!-- large size header -->
  @include('components.header')


    <div class="page-wrapper">
        <main class="main-wrapper">
            <div class="container-fluid">
                <div class="wishlist-container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 mb-3">
                            <aside class="sidebar">
                                <div id="leftside-navigation" class="nano">
                                    <ul class="nano-content">
                                        <li class="sub-menu">
                                            <a href="javascript:void(0);" class="active"><i
                                                    class="fa fa-cogs"></i><span>account information</span><i
                                                    class="arrow fa fa-angle-right pull-right"></i></a>
                                            <ul>

                                                <li><a href="ui-alerts-notifications.html">Trades</a>
                                                </li>
                                                <li><a href="ui-panels.html">Assurance</a>
                                                </li>
                                                <li><a href="ui-buttons.html">Projects</a>
                                                </li>
                                                <li><a href="ui-slider-progress.html">Marketing</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="sub-menu">
                                            <a href="javascript:void(0);"><i class='bx bx-user'></i><span>account
                                                    management</span><i
                                                    class="arrow fa fa-angle-right pull-right"></i></a>
                                            <ul>
                                                <li><a href="tables-basic.html">Basic Tables</a>
                                                </li>

                                                <li><a href="tables-data.html">Data Tables</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="sub-menu">
                                            <a href="javascript:void(0);"><i class="fas fa-gift"></i><span>Wallet & gift
                                                    cards</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                                            <ul>
                                                <li><a href="forms-components.html">Components</a>
                                                </li>
                                                <li><a href="forms-validation.html">Validation</a>
                                                </li>
                                                <li><a href="forms-mask.html">Mask</a>
                                                </li>
                                                <li><a href="forms-wizard.html">Wizard</a>
                                                </li>
                                                <li><a href="forms-multiple-file.html">Multiple File Upload</a>
                                                </li>
                                                <li><a href="forms-wysiwyg.html">WYSIWYG Editor</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="sub-menu ">
                                            <a href="javascript:void(0);"><i class="far fa-list-alt"></i><span>my
                                                    orders</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                                            <ul>
                                                <li class=""><a href="mail-inbox.html">Inbox</a>
                                                </li>
                                                <li><a href="mail-compose.html">Compose Mail</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="sub-menu">
                                            <a href="cart-page.html"><i class="fas fa-cart-plus"></i><span>my
                                                    cart</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                                        </li>
                                        <li class="sub-menu">
                                            <a href="product-detail.html"><i class="far fa-envelope"></i><span>my
                                                    review</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                                        </li>
                                        <li class="sub-menu">
                                            <a href="typography.html"><i class="far fa-bell"></i><span>notification and
                                                    messages</span><i
                                                    class="arrow fa fa-angle-right pull-right"></i></a>
                                        </li>
                                        <li class="sub-menu">
                                            <a href="javascript:void(0);"><i
                                                    class="fas fa-phone-square-alt"></i><span>contact us</span><i
                                                    class="arrow fa fa-angle-right pull-right"></i></a>
                                        </li>
                                </div>
                            </aside>

                        </div>
                        <!-- Main Content -->
                        <main class="col-xl-9 col-lg-8 col-md-8 col-sm-6">
                            <!-- Wishlist Header -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h2 class="wishlist-title">Wishlist (4)</h2>
                                <a href="#" class="btn btn-outline-secondary">Move All To Bag</a>
                            </div>
                            <!-- Swiper -->
                            <div class="swiper wishlist-swiper mb-4">
                                <div class="swiper-wrapper">
                                    @foreach($wishlists as $wishlist)
                                        <div class="swiper-slide">
                                        <div class="wishlist-item mb-4">
                                            <div class="media-box ">
                                                <div class="product-img">
                                                    <a href="/product-detail/{{ $wishlist->product->slug }}">
                                                        <img src="{{ asset($wishlist->product->thumbnail) }}" alt="media">
                                                    </a>

                                                    <div class="hover-btn">
                                                        <a href="/cart" class="btn add-cart"> Add To Cart</a>
                                                    </div>
                                                </div>
                                                <span class="badge style1 badge-primary">
                                                    -35%
                                                </span>
                                                <div class="product-icon-div">
                                                    <ul class="ps-0">
                                                        <li class="share-icon meta-icon">
                                                            <a href="" class=""><i
                                                                    class='bx bx-share bx-flip-horizontal'></i></a>
                                                        </li>
                                                        <li class="delete-icon meta-icon">
                                                            <a href="" class=""><i class="fas fa-trash-alt"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="content-box">
                                                <h6 class="title">
                                                    <a href="/product-detail/{{ $wishlist->product->slug }}">{{ $wishlist->product->name }}</a>
                                                </h6>
                                                <div class="meta-div">
                                                    <span class="text1 text-danger">${{ $wishlist->product->price }}</span>
                                                    <p class="text1 text-gray "> <strike>${{ $wishlist->product->old_price }}</strike></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                   
                                    {{-- <div class="swiper-slide">
                                        <div class="wishlist-item mb-4">
                                            <div class="media-box ">
                                                <div class="product-img">
                                                    <a href="product-detail.html">
                                                        <img src="./assets/images/wishlist/media2.png" alt="media">
                                                    </a>

                                                    <div class="hover-btn">
                                                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                                                    </div>
                                                </div>
                                                <div class="product-icon-div">
                                                    <ul class="ps-0">
                                                        <li class="share-icon meta-icon">
                                                            <a href="" class=""><i
                                                                    class='bx bx-share bx-flip-horizontal'></i></a>
                                                        </li>
                                                        <li class="delete-icon meta-icon">
                                                            <a href="" class=""><i class="fas fa-trash-alt"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="content-box">
                                                <h6 class="title">
                                                    <a href="product-detail.html">RGB liquid CPU Cooler</a>
                                                </h6>
                                                <div class="meta-div">
                                                    <span class="text1 text-danger">$1960</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="wishlist-item mb-4">
                                            <div class="media-box ">
                                                <div class="product-img">
                                                    <a href="product-detail.html">
                                                        <img src="./assets/images/wishlist/media3.png" alt="media">
                                                    </a>

                                                    <div class="hover-btn">
                                                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                                                    </div>
                                                </div>
                                                <div class="product-icon-div">
                                                    <ul class="ps-0">
                                                        <li class="share-icon meta-icon">
                                                            <a href="" class=""><i
                                                                    class='bx bx-share bx-flip-horizontal'></i></a>
                                                        </li>
                                                        <li class="delete-icon meta-icon">
                                                            <a href="#" class=""><i class="fas fa-trash-alt"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="content-box">
                                                <h6 class="title">
                                                    <a href="product-detail.html">GP11 Shooter USB Gamepad</a>
                                                </h6>
                                                <div class="meta-div">
                                                    <span class="text1 text-danger">$550</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="wishlist-item mb-4">
                                            <div class="media-box ">
                                                <div class="product-img">
                                                    <a href="product-detail.html">
                                                        <img src="./assets/images/wishlist/media1.png" alt="media">
                                                    </a>

                                                    <div class="hover-btn">
                                                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                                                    </div>
                                                </div>
                                                <span class="badge style1 badge-primary">
                                                    -35%
                                                </span>
                                                <div class="product-icon-div">
                                                    <ul class="ps-0">
                                                        <li class="share-icon meta-icon">
                                                            <a href="" class=""><i
                                                                    class='bx bx-share bx-flip-horizontal'></i></a>
                                                        </li>
                                                        <li class="delete-icon meta-icon">
                                                            <a href="" class=""><i class="fas fa-trash-alt"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="content-box">
                                                <h6 class="title">
                                                    <a href="product-detail.html">Gucci duffle bag</a>
                                                </h6>
                                                <div class="meta-div">
                                                    <span class="text1 text-danger">$960</span>
                                                    <p class="text1 text-gray "> <strike>$1160</strike></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="wishlist-item mb-4">
                                            <div class="media-box ">
                                                <div class="product-img">
                                                    <a href="product-detail.html">
                                                        <img src="./assets/images/wishlist/media1.png" alt="media">
                                                    </a>

                                                    <div class="hover-btn">
                                                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                                                    </div>
                                                </div>
                                                <span class="badge style1 badge-primary">
                                                    -35%
                                                </span>
                                                <div class="product-icon-div">
                                                    <ul class="ps-0">
                                                        <li class="share-icon meta-icon">
                                                            <a href="" class=""><i
                                                                    class='bx bx-share bx-flip-horizontal'></i></a>
                                                        </li>
                                                        <li class="delete-icon meta-icon">
                                                            <a href="" class=""><i class="fas fa-trash-alt"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="content-box">
                                                <h6 class="title">
                                                    <a href="product-detail.html">Gucci duffle bag</a>
                                                </h6>
                                                <div class="meta-div">
                                                    <span class="text1 text-danger">$960</span>
                                                    <p class="text1 text-gray "> <strike>$1160</strike></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="wishlist-item mb-4">
                                            <div class="media-box ">
                                                <div class="product-img">
                                                    <a href="product-detail.html">
                                                        <img src="./assets/images/wishlist/media2.png" alt="media">
                                                    </a>

                                                    <div class="hover-btn">
                                                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                                                    </div>
                                                </div>
                                                <div class="product-icon-div">
                                                    <ul class="ps-0">
                                                        <li class="share-icon meta-icon">
                                                            <a href="" class=""><i
                                                                    class='bx bx-share bx-flip-horizontal'></i></a>
                                                        </li>
                                                        <li class="delete-icon meta-icon">
                                                            <a href="" class=""><i class="fas fa-trash-alt"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="content-box">
                                                <h6 class="title">
                                                    <a href="product-detail.html">RGB liquid CPU Cooler</a>
                                                </h6>
                                                <div class="meta-div">
                                                    <span class="text1 text-danger">$1960</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>


                            <!-- Recommended Product -->
                            <div
                                class="d-flex align-items-center justify-content-between gap-xl-5 gap-2 mb-3 flex-wrap">
                                <div class="section-head mb-0">
                                    <span class="sub-title mb-0">Recommended Product</span>
                                </div>
                                <a href="all-product.html" class="btn btn-outline-secondary px-4">See All</a>
                            </div>
                            <!-- Swiper -->
                            <div class="swiper more-product">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="wishlist-item mb-4">
                                            <div class="media-box ">
                                                <div class="product-img">
                                                    <a href="product-detail.html">
                                                        <img src="./assets/images/wishlist/media1.png" alt="media">
                                                    </a>

                                                    <div class="hover-btn">
                                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
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
                                                            <a href="" class=""><i
                                                                    class='bx bx-share bx-flip-horizontal'></i></a>
                                                        </li>
                                                        <li class="like-icon">
                                                            <a href="" class=""><i class="far fa-heart"></i></a>
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
                                        <div class="wishlist-item mb-4">
                                            <div class="media-box ">
                                                <div class="product-img">
                                                    <a href="product-detail.html">
                                                        <img src="./assets/images/wishlist/product-media2.png"
                                                            alt="media">
                                                    </a>

                                                    <div class="hover-btn">
                                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                            Add To Cart</a>
                                                    </div>
                                                </div>
                                                <div class="product-icon-div">
                                                    <ul class="ps-0">
                                                        <li class="share-icon meta-icon">
                                                            <a href="" class=""><i
                                                                    class='bx bx-share bx-flip-horizontal'></i></a>
                                                        </li>
                                                        <li class="like-icon">
                                                            <a href="" class=""><i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="content-box">
                                                <h6 class="title">
                                                    <a href="product-detail.html">IPS LCD Gaming Monitor</a>
                                                </h6>
                                                <div class="meta-div">
                                                    <span class="text1 text-danger">$1160</span>
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
                                        <div class="wishlist-item mb-4">
                                            <div class="media-box ">
                                                <div class="product-img">
                                                    <a href="product-detail.html">
                                                        <img src="./assets/images/wishlist/product-media3.png"
                                                            alt="media">
                                                    </a>

                                                    <div class="hover-btn">
                                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
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
                                                            <a href="" class=""><i
                                                                    class='bx bx-share bx-flip-horizontal'></i></a>
                                                        </li>
                                                        <li class="like-icon">
                                                            <a href="" class=""><i class="far fa-heart"></i></a>
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
                                        <div class="wishlist-item mb-4">
                                            <div class="media-box ">
                                                <div class="product-img">
                                                    <a href="product-detail.html">
                                                        <img src="./assets/images/wishlist/product-media3.png"
                                                            alt="media">
                                                    </a>

                                                    <div class="hover-btn">
                                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
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
                                                            <a href="" class=""><i
                                                                    class='bx bx-share bx-flip-horizontal'></i></a>
                                                        </li>
                                                        <li class="like-icon">
                                                            <a href="" class=""><i class="far fa-heart"></i></a>
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
                                        <div class="wishlist-item mb-4">
                                            <div class="media-box ">
                                                <div class="product-img">
                                                    <a href="product-detail.html">
                                                        <img src="./assets/images/wishlist/media1.png" alt="media">
                                                    </a>

                                                    <div class="hover-btn">
                                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
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
                                                            <a href="" class=""><i
                                                                    class='bx bx-share bx-flip-horizontal'></i></a>
                                                        </li>
                                                        <li class="like-icon">
                                                            <a href="" class=""><i class="far fa-heart"></i></a>
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
                                        <div class="wishlist-item mb-4">
                                            <div class="media-box ">
                                                <div class="product-img">
                                                    <a href="product-detail.html">
                                                        <img src="./assets/images/wishlist/product-media2.png"
                                                            alt="media">
                                                    </a>

                                                    <div class="hover-btn">
                                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                            Add To Cart</a>
                                                    </div>
                                                </div>
                                                <div class="product-icon-div">
                                                    <ul class="ps-0">
                                                        <li class="share-icon meta-icon">
                                                            <a href="" class=""><i
                                                                    class='bx bx-share bx-flip-horizontal'></i></a>
                                                        </li>
                                                        <li class="like-icon">
                                                            <a href="" class=""><i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="content-box">
                                                <h6 class="title">
                                                    <a href="product-detail.html">IPS LCD Gaming Monitor</a>
                                                </h6>
                                                <div class="meta-div">
                                                    <span class="text1 text-danger">$1160</span>
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
                                        <div class="wishlist-item mb-4">
                                            <div class="media-box ">
                                                <div class="product-img">
                                                    <a href="product-detail.html">
                                                        <img src="./assets/images/wishlist/product-media3.png"
                                                            alt="media">
                                                    </a>

                                                    <div class="hover-btn">
                                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
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
                                                            <a href="" class=""><i
                                                                    class='bx bx-share bx-flip-horizontal'></i></a>
                                                        </li>
                                                        <li class="like-icon">
                                                            <a href="" class=""><i class="far fa-heart"></i></a>
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
                                        <div class="wishlist-item mb-4">
                                            <div class="media-box ">
                                                <div class="product-img">
                                                    <a href="product-detail.html">
                                                        <img src="./assets/images/wishlist/product-media3.png"
                                                            alt="media">
                                                    </a>

                                                    <div class="hover-btn">
                                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
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
                                                            <a href="" class=""><i
                                                                    class='bx bx-share bx-flip-horizontal'></i></a>
                                                        </li>
                                                        <li class="like-icon">
                                                            <a href="" class=""><i class="far fa-heart"></i></a>
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
                            <!-- just for you -->
                            <div
                                class="d-flex align-items-center justify-content-between gap-xl-5 gap-2 mb-3 flex-wrap">
                                <div class="section-head mb-0">
                                    <span class="sub-title mb-0">Just For You</span>
                                </div>
                                <a href="all-product.html" class="btn btn-outline-secondary px-4">See All</a>
                            </div>
                            <!-- Swiper -->
                            <div class="swiper more-product">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="wishlist-item mb-4">
                                            <div class="media-box ">
                                                <div class="product-img">
                                                    <a href="product-detail.html">
                                                        <img src="./assets/images/wishlist/media1.png" alt="media">
                                                    </a>

                                                    <div class="hover-btn">
                                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
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
                                                            <a href="" class=""><i
                                                                    class='bx bx-share bx-flip-horizontal'></i></a>
                                                        </li>
                                                        <li class="like-icon">
                                                            <a href="" class=""><i class="far fa-heart"></i></a>
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
                                        <div class="wishlist-item mb-4">
                                            <div class="media-box ">
                                                <div class="product-img">
                                                    <a href="product-detail.html">
                                                        <img src="./assets/images/wishlist/product-media2.png"
                                                            alt="media">
                                                    </a>

                                                    <div class="hover-btn">
                                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                            Add To Cart</a>
                                                    </div>
                                                </div>
                                                <div class="product-icon-div">
                                                    <ul class="ps-0">
                                                        <li class="share-icon meta-icon">
                                                            <a href="" class=""><i
                                                                    class='bx bx-share bx-flip-horizontal'></i></a>
                                                        </li>
                                                        <li class="like-icon">
                                                            <a href="" class=""><i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="content-box">
                                                <h6 class="title">
                                                    <a href="product-detail.html">IPS LCD Gaming Monitor</a>
                                                </h6>
                                                <div class="meta-div">
                                                    <span class="text1 text-danger">$1160</span>
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
                                        <div class="wishlist-item mb-4">
                                            <div class="media-box ">
                                                <div class="product-img">
                                                    <a href="product-detail.html">
                                                        <img src="./assets/images/wishlist/product-media3.png"
                                                            alt="media">
                                                    </a>

                                                    <div class="hover-btn">
                                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
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
                                                            <a href="" class=""><i
                                                                    class='bx bx-share bx-flip-horizontal'></i></a>
                                                        </li>
                                                        <li class="like-icon">
                                                            <a href="" class=""><i class="far fa-heart"></i></a>
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
                                        <div class="wishlist-item mb-4">
                                            <div class="media-box ">
                                                <div class="product-img">
                                                    <a href="product-detail.html">
                                                        <img src="./assets/images/wishlist/product-media3.png"
                                                            alt="media">
                                                    </a>

                                                    <div class="hover-btn">
                                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
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
                                                            <a href="" class=""><i
                                                                    class='bx bx-share bx-flip-horizontal'></i></a>
                                                        </li>
                                                        <li class="like-icon">
                                                            <a href="" class=""><i class="far fa-heart"></i></a>
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
                                        <div class="wishlist-item mb-4">
                                            <div class="media-box ">
                                                <div class="product-img">
                                                    <a href="product-detail.html">
                                                        <img src="./assets/images/wishlist/media1.png" alt="media">
                                                    </a>

                                                    <div class="hover-btn">
                                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
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
                                                            <a href="" class=""><i
                                                                    class='bx bx-share bx-flip-horizontal'></i></a>
                                                        </li>
                                                        <li class="like-icon">
                                                            <a href="" class=""><i class="far fa-heart"></i></a>
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
                                        <div class="wishlist-item mb-4">
                                            <div class="media-box ">
                                                <div class="product-img">
                                                    <a href="product-detail.html">
                                                        <img src="./assets/images/wishlist/product-media2.png"
                                                            alt="media">
                                                    </a>

                                                    <div class="hover-btn">
                                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                            Add To Cart</a>
                                                    </div>
                                                </div>
                                                <div class="product-icon-div">
                                                    <ul class="ps-0">
                                                        <li class="share-icon meta-icon">
                                                            <a href="" class=""><i
                                                                    class='bx bx-share bx-flip-horizontal'></i></a>
                                                        </li>
                                                        <li class="like-icon">
                                                            <a href="" class=""><i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="content-box">
                                                <h6 class="title">
                                                    <a href="product-detail.html">IPS LCD Gaming Monitor</a>
                                                </h6>
                                                <div class="meta-div">
                                                    <span class="text1 text-danger">$1160</span>
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
                                        <div class="wishlist-item mb-4">
                                            <div class="media-box ">
                                                <div class="product-img">
                                                    <a href="product-detail.html">
                                                        <img src="./assets/images/wishlist/product-media3.png"
                                                            alt="media">
                                                    </a>

                                                    <div class="hover-btn">
                                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
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
                                                            <a href="" class=""><i
                                                                    class='bx bx-share bx-flip-horizontal'></i></a>
                                                        </li>
                                                        <li class="like-icon">
                                                            <a href="" class=""><i class="far fa-heart"></i></a>
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
                                        <div class="wishlist-item mb-4">
                                            <div class="media-box ">
                                                <div class="product-img">
                                                    <a href="product-detail.html">
                                                        <img src="./assets/images/wishlist/product-media3.png"
                                                            alt="media">
                                                    </a>

                                                    <div class="hover-btn">
                                                        <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8.25 20.25C8.66421 20.25 9 19.9142 9 19.5C9 19.0858 8.66421 18.75 8.25 18.75C7.83579 18.75 7.5 19.0858 7.5 19.5C7.5 19.9142 7.83579 20.25 8.25 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                                    stroke="white" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
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
                                                            <a href="" class=""><i
                                                                    class='bx bx-share bx-flip-horizontal'></i></a>
                                                        </li>
                                                        <li class="like-icon">
                                                            <a href="" class=""><i class="far fa-heart"></i></a>
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
                        </main>
                    </div>
                </div>

            </div>







        </main>


        <!-- Site Footer -->
        @include('components.footer')
        <!-- End Site Footer -->
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/custom-swiper.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- mobile js -->
    <script src="assets/js/mobile.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Scripts JS -->
    <script>
        $("#leftside-navigation .sub-menu > a").click(function(e) {
            $("#leftside-navigation ul ul").slideUp(), $(this).next().is(":visible") || $(this).next().slideDown(),
                e.stopPropagation()
        })
    </script>

</body>

</html>