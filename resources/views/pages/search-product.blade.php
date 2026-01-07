<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Website Page Title -->
    <title>Search Product |AyitiBook</title>

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

    <style>
        /* Responsive fixed-size product cards */
        /* Ensure column wrappers stretch to equal height */
        #results-wrapper > .col-6,
        #results-wrapper > .col-md-4 {
            display: flex;
        }

        /* Make card fill column and layout consistent */
        #results-wrapper .card {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        /* Image area fixed height and cover */
        #results-wrapper .card-img-top {
            width: 100%;
            object-fit: cover;
            display: block;
        }

        /* Title area reserve space for 2 lines */
        #results-wrapper .card-title {
            min-height: 3rem; /* ~2 lines */
            overflow: hidden;
        }

        /* Place price/buttons at bottom */
        #results-wrapper .card-body { display: flex; flex-direction: column; }
        #results-wrapper .card-body > .mt-auto { margin-top: auto; }

        /* Breakpoint heights: smaller on mobile */
        @media (max-width: 576px) {
            #results-wrapper .card-img-top { height: 140px; }
        }
        @media (min-width: 577px) and (max-width: 767px) {
            #results-wrapper .card-img-top { height: 160px; }
        }
        @media (min-width: 768px) and (max-width: 991px) {
            #results-wrapper .card-img-top { height: 190px; }
        }
        @media (min-width: 992px) {
            #results-wrapper .card-img-top { height: 220px; }
        }
    </style>





    <div class="container-fluid search-page">
        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs search-tabs mb-4" id="productTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="electronics-tab" data-bs-toggle="tab" data-bs-target="#electronics"
                    type="button" role="tab" aria-controls="electronics" aria-selected="true">Products</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="clothing-tab" data-bs-toggle="tab" data-bs-target="#clothing" type="button"
                    role="tab" aria-controls="clothing" aria-selected="false">All suppliers</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="false">Regional supplies</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="toys-tab" data-bs-toggle="tab" data-bs-target="#toys" type="button"
                    role="tab" aria-controls="toys" aria-selected="false">Verified manufacturers</button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="productTabsContent">
            <!-- Electronics Tab -->
            <div class="tab-pane fade show active" id="electronics" role="tabpanel" aria-labelledby="electronics-tab">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 mb-3">
                        <div class="sidebar-container">
                            <ul class="accordion" id="customAccordion">
                                <h6 class="mt-1"><b>Filters</b></h6>

                                <!-- Categories -->
                                <li class="accordion-item mt-0">
                                    <div class="accordion-button">
                                        <i class="far fa-list-alt"></i> Filter Categories
                                    </div>
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="smartphones">
                                            <label class="form-check-label" for="smartphones">Smartphones</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="laptops">
                                            <label class="form-check-label" for="laptops">Laptops</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="tablets">
                                            <label class="form-check-label" for="tablets">Tablets</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="accessories">
                                            <label class="form-check-label" for="accessories">Accessories</label>
                                        </div>
                                    </div>
                                </li>

                                <!-- Categories -->
                                <li class="accordion-item mt-0">
                                    <div class="accordion-button">
                                        <i class="far fa-list-alt"></i> Supplier features
                                    </div>
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="smartphones">
                                            <label class="form-check-label" for="smartphones">Verfied Supplier</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="laptops">
                                            <label class="form-check-label" for="laptops">Verfied pro Supplier</label>
                                        </div>

                                    </div>
                                </li>

                                <!-- Price Range -->
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="fas fa-dollar-sign"></i> Price Range
                                    </div>
                                    <div class="accordion-body">
                                        <input type="range" class="form-range" min="0" max="2000" id="priceRange">
                                        <div class="d-flex justify-content-between">
                                            <span>$0</span>
                                            <span>$2000</span>
                                        </div>
                                        <div class="mt-2">
                                            <label>Current range: $<span id="priceValue">1000</span></label>
                                        </div>
                                    </div>
                                </li>

                                <!-- Brands -->
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="fas fa-bold"></i> Brands
                                    </div>
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="apple">
                                            <label class="form-check-label" for="apple">Apple</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="samsung">
                                            <label class="form-check-label" for="samsung">Samsung</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="sony">
                                            <label class="form-check-label" for="sony">Sony</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="lg">
                                            <label class="form-check-label" for="lg">LG</label>
                                        </div>
                                    </div>
                                </li>

                                <!-- Location -->
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="far fa-list-alt"></i> Location
                                    </div>
                                    <div class="accordion-body flag-scroll">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="bd">
                                            <label class="form-check-label" for="bd"><img src="assets/images/bd.png"
                                                    class="flag-img"> Bangladesh</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="cn">
                                            <label class="form-check-label" for="cn"><img src="assets/images/cn.png"
                                                    class="flag-img"> China</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="hk">
                                            <label class="form-check-label" for="hk"><img src="assets/images/hk.png"
                                                    class="flag-img"> Hong Kong SAR China</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="in">
                                            <label class="form-check-label" for="in"><img src="assets/images/in.png"
                                                    class="flag-img"> India</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="bd">
                                            <label class="form-check-label" for="bd"><img src="assets/images/bd.png"
                                                    class="flag-img"> Bangladesh</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="cn">
                                            <label class="form-check-label" for="cn"><img src="assets/images/cn.png"
                                                    class="flag-img"> China</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="hk">
                                            <label class="form-check-label" for="hk"><img src="assets/images/hk.png"
                                                    class="flag-img"> Hong Kong SAR China</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="in">
                                            <label class="form-check-label" for="in"><img src="assets/images/in.png"
                                                    class="flag-img"> India</label>
                                        </div>
                                    </div>
                                </li>


                                <h6 class="mt-3"><b>Tools</b></h6>
                                <!-- Brands -->
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="far fa-envelope"></i> Messages
                                    </div>

                                </li>
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="fas fa-bold"></i> Calendar
                                    </div>

                                </li>

                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="fas fa-bold"></i> Files & Library
                                    </div>

                                </li>
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="far fa-bell"></i> Invoice Manager
                                    </div>

                                </li>


                                <h6 class="mt-3"><b>Rating</b></h6>
                                <!-- Brands -->
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="far fa-envelope"></i> Buyers
                                    </div>

                                </li>
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="fas fa-bold"></i> Clients
                                    </div>

                                </li>

                                <!-- Ratings -->
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="far fa-star"></i> Ratings
                                    </div>
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rating" id="rating5">
                                            <label class="form-check-label" for="rating5">
                                                ⭐⭐⭐⭐⭐
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rating" id="rating4">
                                            <label class="form-check-label" for="rating4">
                                                ⭐⭐⭐⭐ & Up
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rating" id="rating3">
                                            <label class="form-check-label" for="rating3">
                                                ⭐⭐⭐ & Up
                                            </label>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <div class="mt-3">
                                <button class="btn btn-primary w-100">Apply Filters</button>
                            </div>
                        </div>
                    </div>
                    <!-- Product List -->
                    <div class="col-xl-9 col-lg-8 col-md-8 col-sm-6">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 id="results-title">Products</h4>
                            <div class="dropdown custom-dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                    id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    Sort by: Featured
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                                    <li><a class="dropdown-item" href="#">Featured</a></li>
                                    <li><a class="dropdown-item" href="#">Price: Low to High</a></li>
                                    <li><a class="dropdown-item" href="#">Price: High to Low</a></li>
                                    <li><a class="dropdown-item" href="#">Customer Rating</a></li>
                                    <li><a class="dropdown-item" href="#">Newest</a></li>
                                </ul>
                            </div>
                        </div>

<div id="search-results" class="mb-4">
    <div class="row" id="results-wrapper">

        @forelse($products as $product)
            <div class="col-6 col-md-4 mb-4">
                <div class="card h-100">
                    <a href="{{ route('product-details', $product->slug) }}">
                        <img src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : asset('assets/images/placeholder.png') }}" class="card-img-top" alt="{{ $product->name }}">
                    </a>
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title mb-2"><a href="{{ route('product-details', $product->slug) }}">{{ $product->name }}</a></h6>
                        <div class="mt-auto">
                            @if($product->discount_price)
                                <div class="text-danger fw-bold">{{ $product->currency ?? '$' }}{{ number_format($product->discount_price) }}</div>
                                <div class="text-muted"><strike>{{ $product->currency ?? '$' }}{{ number_format($product->price) }}</strike></div>
                            @else
                                <div class="text-danger fw-bold">{{ $product->currency ?? '$' }}{{ number_format($product->price) }}</div>
                            @endif
                            <div class="mt-2 d-flex justify-content-between align-items-center">
                                <a href="{{ route('cart.add', $product->id) }}" class="btn btn-sm btn-primary">Add To Cart</a>
                                @if($product->discount_price && $product->price > 0)
                                    @php $discount = round((($product->price - $product->discount_price) / $product->price) * 100); @endphp
                                    <span class="badge bg-primary">-{{ $discount }}%</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-4">
                <p class="text-muted">No products found. Try searching for something else.</p>
            </div>
        @endforelse

    </div>
</div>

<div id="pagination-links" class="mt-4 d-flex justify-content-center">
    @if(method_exists($products, 'links'))
        {!! $products->links('pagination::bootstrap-5') !!}
    @endif
</div>

                            <!-- just for you -->
                        <div class="d-flex align-items-center justify-content-between gap-xl-5 gap-2 mb-3 flex-wrap">
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
                                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path
                                                                d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                    <img src="./assets/images/wishlist/product-media2.png" alt="media">
                                                </a>

                                                <div class="hover-btn">
                                                    <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path
                                                                d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                    <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                                </a>

                                                <div class="hover-btn">
                                                    <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                    <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                                </a>

                                                <div class="hover-btn">
                                                    <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path
                                                                d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                    <img src="./assets/images/wishlist/product-media2.png" alt="media">
                                                </a>

                                                <div class="hover-btn">
                                                    <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path
                                                                d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                    <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                                </a>

                                                <div class="hover-btn">
                                                    <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                    <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                                </a>

                                                <div class="hover-btn">
                                                    <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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


                    </div>
                </div>
            </div>

            <!-- Clothing Tab -->
            <div class="tab-pane fade" id="clothing" role="tabpanel" aria-labelledby="clothing-tab">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 mb-3">
                        <div class="sidebar-container">
                            <ul class="accordion" id="customAccordion">
                                <h6 class="mt-1"><b>Filters</b></h6>
                                <!-- Categories -->
                                <li class="accordion-item mt-0">
                                    <div class="accordion-button">
                                        <i class="far fa-list-alt"></i> Filter Categories
                                    </div>
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="smartphones">
                                            <label class="form-check-label" for="smartphones">Smartphones</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="laptops">
                                            <label class="form-check-label" for="laptops">Laptops</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="tablets">
                                            <label class="form-check-label" for="tablets">Tablets</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="accessories">
                                            <label class="form-check-label" for="accessories">Accessories</label>
                                        </div>
                                    </div>
                                </li>

                                <!-- Categories -->
                                <li class="accordion-item mt-0">
                                    <div class="accordion-button">
                                        <i class="far fa-list-alt"></i> Supplier features
                                    </div>
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="smartphones">
                                            <label class="form-check-label" for="smartphones">Verfied Supplier</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="laptops">
                                            <label class="form-check-label" for="laptops">Verfied pro Supplier</label>
                                        </div>

                                    </div>
                                </li>

                                <!-- Price Range -->
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="fas fa-dollar-sign"></i> Price Range
                                    </div>
                                    <div class="accordion-body">
                                        <input type="range" class="form-range" min="0" max="2000" id="priceRange">
                                        <div class="d-flex justify-content-between">
                                            <span>$0</span>
                                            <span>$2000</span>
                                        </div>
                                        <div class="mt-2">
                                            <label>Current range: $<span id="priceValue">1000</span></label>
                                        </div>
                                    </div>
                                </li>

                                <!-- Brands -->
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="fas fa-bold"></i> Brands
                                    </div>
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="apple">
                                            <label class="form-check-label" for="apple">Apple</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="samsung">
                                            <label class="form-check-label" for="samsung">Samsung</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="sony">
                                            <label class="form-check-label" for="sony">Sony</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="lg">
                                            <label class="form-check-label" for="lg">LG</label>
                                        </div>
                                    </div>
                                </li>

                                <!-- Location -->
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="far fa-list-alt"></i> Location
                                    </div>
                                    <div class="accordion-body flag-scroll">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="bd">
                                            <label class="form-check-label" for="bd"><img src="assets/images/bd.png"
                                                    class="flag-img"> Bangladesh</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="cn">
                                            <label class="form-check-label" for="cn"><img src="assets/images/cn.png"
                                                    class="flag-img"> China</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="hk">
                                            <label class="form-check-label" for="hk"><img src="assets/images/hk.png"
                                                    class="flag-img"> Hong Kong SAR China</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="in">
                                            <label class="form-check-label" for="in"><img src="assets/images/in.png"
                                                    class="flag-img"> India</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="bd">
                                            <label class="form-check-label" for="bd"><img src="assets/images/bd.png"
                                                    class="flag-img"> Bangladesh</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="cn">
                                            <label class="form-check-label" for="cn"><img src="assets/images/cn.png"
                                                    class="flag-img"> China</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="hk">
                                            <label class="form-check-label" for="hk"><img src="assets/images/hk.png"
                                                    class="flag-img"> Hong Kong SAR China</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="in">
                                            <label class="form-check-label" for="in"><img src="assets/images/in.png"
                                                    class="flag-img"> India</label>
                                        </div>
                                    </div>
                                </li>



                                <h6 class="mt-3"><b>Tools</b></h6>
                                <!-- Brands -->
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="far fa-envelope"></i> Messages
                                    </div>

                                </li>
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="fas fa-bold"></i> Calendar
                                    </div>

                                </li>

                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="fas fa-bold"></i> Files & Library
                                    </div>

                                </li>
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="far fa-bell"></i> Invoice Manager
                                    </div>

                                </li>


                                <h6 class="mt-3"><b>Rating</b></h6>
                                <!-- Brands -->
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="far fa-envelope"></i> Buyers
                                    </div>

                                </li>
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="fas fa-bold"></i> Clients
                                    </div>

                                </li>

                                <!-- Ratings -->
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="far fa-star"></i> Ratings
                                    </div>
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rating" id="rating5">
                                            <label class="form-check-label" for="rating5">
                                                ⭐⭐⭐⭐⭐
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rating" id="rating4">
                                            <label class="form-check-label" for="rating4">
                                                ⭐⭐⭐⭐ & Up
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rating" id="rating3">
                                            <label class="form-check-label" for="rating3">
                                                ⭐⭐⭐ & Up
                                            </label>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <div class="mt-3">
                                <button class="btn btn-primary w-100">Apply Filters</button>
                            </div>
                        </div>
                    </div>
                    <!-- Product List -->
                    <div class="col-xl-9 col-lg-8 col-md-8 col-sm-6">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4>Electronics (24 products)</h4>
                            <div class="dropdown custom-dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                    id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    Sort by: Featured
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                                    <li><a class="dropdown-item" href="#">Featured</a></li>
                                    <li><a class="dropdown-item" href="#">Price: Low to High</a></li>
                                    <li><a class="dropdown-item" href="#">Price: High to Low</a></li>
                                    <li><a class="dropdown-item" href="#">Customer Rating</a></li>
                                    <li><a class="dropdown-item" href="#">Newest</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="swiper wishlist-swiper mb-4">
                            <div class="swiper-wrapper">
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
                                </div>
                            </div>
                        </div>
                        <!-- just for you -->
                        <div class="d-flex align-items-center justify-content-between gap-xl-5 gap-2 mb-3 flex-wrap">
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
                                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path
                                                                d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                    <img src="./assets/images/wishlist/product-media2.png" alt="media">
                                                </a>

                                                <div class="hover-btn">
                                                    <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path
                                                                d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                    <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                                </a>

                                                <div class="hover-btn">
                                                    <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                    <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                                </a>

                                                <div class="hover-btn">
                                                    <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path
                                                                d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                    <img src="./assets/images/wishlist/product-media2.png" alt="media">
                                                </a>

                                                <div class="hover-btn">
                                                    <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path
                                                                d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                    <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                                </a>

                                                <div class="hover-btn">
                                                    <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                    <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                                </a>

                                                <div class="hover-btn">
                                                    <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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

                    </div>
                </div>
            </div>

            <!-- Home & Garden Tab -->
            <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 mb-3">
                        <div class="sidebar-container">
                            <ul class="accordion" id="customAccordion">
                                <h6 class="mt-1"><b>Filters</b></h6>
                                <!-- Categories -->
                                <li class="accordion-item mt-0">
                                    <div class="accordion-button">
                                        <i class="far fa-list-alt"></i> Filter Categories
                                    </div>
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="smartphones">
                                            <label class="form-check-label" for="smartphones">Smartphones</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="laptops">
                                            <label class="form-check-label" for="laptops">Laptops</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="tablets">
                                            <label class="form-check-label" for="tablets">Tablets</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="accessories">
                                            <label class="form-check-label" for="accessories">Accessories</label>
                                        </div>
                                    </div>
                                </li>

                                <!-- Categories -->
                                <li class="accordion-item mt-0">
                                    <div class="accordion-button">
                                        <i class="far fa-list-alt"></i> Supplier features
                                    </div>
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="smartphones">
                                            <label class="form-check-label" for="smartphones">Verfied Supplier</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="laptops">
                                            <label class="form-check-label" for="laptops">Verfied pro Supplier</label>
                                        </div>

                                    </div>
                                </li>

                                <!-- Price Range -->
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="fas fa-dollar-sign"></i> Price Range
                                    </div>
                                    <div class="accordion-body">
                                        <input type="range" class="form-range" min="0" max="2000" id="priceRange">
                                        <div class="d-flex justify-content-between">
                                            <span>$0</span>
                                            <span>$2000</span>
                                        </div>
                                        <div class="mt-2">
                                            <label>Current range: $<span id="priceValue">1000</span></label>
                                        </div>
                                    </div>
                                </li>

                                <!-- Brands -->
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="fas fa-bold"></i> Brands
                                    </div>
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="apple">
                                            <label class="form-check-label" for="apple">Apple</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="samsung">
                                            <label class="form-check-label" for="samsung">Samsung</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="sony">
                                            <label class="form-check-label" for="sony">Sony</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="lg">
                                            <label class="form-check-label" for="lg">LG</label>
                                        </div>
                                    </div>
                                </li>

                                <!-- Location -->
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="far fa-list-alt"></i> Location
                                    </div>
                                    <div class="accordion-body flag-scroll">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="bd">
                                            <label class="form-check-label" for="bd"><img src="assets/images/bd.png"
                                                    class="flag-img"> Bangladesh</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="cn">
                                            <label class="form-check-label" for="cn"><img src="assets/images/cn.png"
                                                    class="flag-img"> China</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="hk">
                                            <label class="form-check-label" for="hk"><img src="assets/images/hk.png"
                                                    class="flag-img"> Hong Kong SAR China</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="in">
                                            <label class="form-check-label" for="in"><img src="assets/images/in.png"
                                                    class="flag-img"> India</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="bd">
                                            <label class="form-check-label" for="bd"><img src="assets/images/bd.png"
                                                    class="flag-img"> Bangladesh</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="cn">
                                            <label class="form-check-label" for="cn"><img src="assets/images/cn.png"
                                                    class="flag-img"> China</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="hk">
                                            <label class="form-check-label" for="hk"><img src="assets/images/hk.png"
                                                    class="flag-img"> Hong Kong SAR China</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="in">
                                            <label class="form-check-label" for="in"><img src="assets/images/in.png"
                                                    class="flag-img"> India</label>
                                        </div>
                                    </div>
                                </li>



                                <h6 class="mt-3"><b>Tools</b></h6>
                                <!-- Brands -->
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="far fa-envelope"></i> Messages
                                    </div>

                                </li>
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="fas fa-bold"></i> Calendar
                                    </div>

                                </li>

                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="fas fa-bold"></i> Files & Library
                                    </div>

                                </li>
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="far fa-bell"></i> Invoice Manager
                                    </div>

                                </li>


                                <h6 class="mt-3"><b>Rating</b></h6>
                                <!-- Brands -->
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="far fa-envelope"></i> Buyers
                                    </div>

                                </li>
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="fas fa-bold"></i> Clients
                                    </div>

                                </li>

                                <!-- Ratings -->
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="far fa-star"></i> Ratings
                                    </div>
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rating" id="rating5">
                                            <label class="form-check-label" for="rating5">
                                                ⭐⭐⭐⭐⭐
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rating" id="rating4">
                                            <label class="form-check-label" for="rating4">
                                                ⭐⭐⭐⭐ & Up
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rating" id="rating3">
                                            <label class="form-check-label" for="rating3">
                                                ⭐⭐⭐ & Up
                                            </label>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <div class="mt-3">
                                <button class="btn btn-primary w-100">Apply Filters</button>
                            </div>
                        </div>
                    </div>
                    <!-- Product List -->
                    <div class="col-xl-9 col-lg-8 col-md-8 col-sm-6">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4>Electronics (24 products)</h4>
                            <div class="dropdown custom-dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                    id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    Sort by: Featured
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                                    <li><a class="dropdown-item" href="#">Featured</a></li>
                                    <li><a class="dropdown-item" href="#">Price: Low to High</a></li>
                                    <li><a class="dropdown-item" href="#">Price: High to Low</a></li>
                                    <li><a class="dropdown-item" href="#">Customer Rating</a></li>
                                    <li><a class="dropdown-item" href="#">Newest</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="swiper wishlist-swiper mb-4">
                            <div class="swiper-wrapper">
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
                                </div>
                            </div>
                        </div>
                        <!-- just for you -->
                        <div class="d-flex align-items-center justify-content-between gap-xl-5 gap-2 mb-3 flex-wrap">
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
                                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path
                                                                d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                    <img src="./assets/images/wishlist/product-media2.png" alt="media">
                                                </a>

                                                <div class="hover-btn">
                                                    <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path
                                                                d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                    <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                                </a>

                                                <div class="hover-btn">
                                                    <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                    <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                                </a>

                                                <div class="hover-btn">
                                                    <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path
                                                                d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                    <img src="./assets/images/wishlist/product-media2.png" alt="media">
                                                </a>

                                                <div class="hover-btn">
                                                    <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path
                                                                d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                    <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                                </a>

                                                <div class="hover-btn">
                                                    <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                    <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                                </a>

                                                <div class="hover-btn">
                                                    <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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


                    </div>
                </div>
            </div>

            <!-- Toys & Games Tab -->
            <div class="tab-pane fade" id="toys" role="tabpanel" aria-labelledby="toys-tab">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 mb-3">
                        <div class="sidebar-container">
                            <ul class="accordion" id="customAccordion">
                                <h6 class="mt-1"><b>Filters</b></h6>
                                <!-- Categories -->
                                <li class="accordion-item mt-0">
                                    <div class="accordion-button">
                                        <i class="far fa-list-alt"></i> Filter Categories
                                    </div>
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="smartphones">
                                            <label class="form-check-label" for="smartphones">Smartphones</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="laptops">
                                            <label class="form-check-label" for="laptops">Laptops</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="tablets">
                                            <label class="form-check-label" for="tablets">Tablets</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="accessories">
                                            <label class="form-check-label" for="accessories">Accessories</label>
                                        </div>
                                    </div>
                                </li>

                                <!-- Categories -->
                                <li class="accordion-item mt-0">
                                    <div class="accordion-button">
                                        <i class="far fa-list-alt"></i> Supplier features
                                    </div>
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="smartphones">
                                            <label class="form-check-label" for="smartphones">Verfied Supplier</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="laptops">
                                            <label class="form-check-label" for="laptops">Verfied pro Supplier</label>
                                        </div>

                                    </div>
                                </li>

                                <!-- Price Range -->
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="fas fa-dollar-sign"></i> Price Range
                                    </div>
                                    <div class="accordion-body">
                                        <input type="range" class="form-range" min="0" max="2000" id="priceRange">
                                        <div class="d-flex justify-content-between">
                                            <span>$0</span>
                                            <span>$2000</span>
                                        </div>
                                        <div class="mt-2">
                                            <label>Current range: $<span id="priceValue">1000</span></label>
                                        </div>
                                    </div>
                                </li>

                                <!-- Brands -->
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="fas fa-bold"></i> Brands
                                    </div>
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="apple">
                                            <label class="form-check-label" for="apple">Apple</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="samsung">
                                            <label class="form-check-label" for="samsung">Samsung</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="sony">
                                            <label class="form-check-label" for="sony">Sony</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="lg">
                                            <label class="form-check-label" for="lg">LG</label>
                                        </div>
                                    </div>
                                </li>

                                <!-- Location -->
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="far fa-list-alt"></i> Location
                                    </div>
                                    <div class="accordion-body flag-scroll">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="bd">
                                            <label class="form-check-label" for="bd"><img src="assets/images/bd.png"
                                                    class="flag-img"> Bangladesh</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="cn">
                                            <label class="form-check-label" for="cn"><img src="assets/images/cn.png"
                                                    class="flag-img"> China</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="hk">
                                            <label class="form-check-label" for="hk"><img src="assets/images/hk.png"
                                                    class="flag-img"> Hong Kong SAR China</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="in">
                                            <label class="form-check-label" for="in"><img src="assets/images/in.png"
                                                    class="flag-img"> India</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="bd">
                                            <label class="form-check-label" for="bd"><img src="assets/images/bd.png"
                                                    class="flag-img"> Bangladesh</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="cn">
                                            <label class="form-check-label" for="cn"><img src="assets/images/cn.png"
                                                    class="flag-img"> China</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="hk">
                                            <label class="form-check-label" for="hk"><img src="assets/images/hk.png"
                                                    class="flag-img"> Hong Kong SAR China</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="in">
                                            <label class="form-check-label" for="in"><img src="assets/images/in.png"
                                                    class="flag-img"> India</label>
                                        </div>
                                    </div>
                                </li>



                                <h6 class="mt-3"><b>Tools</b></h6>
                                <!-- Brands -->
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="far fa-envelope"></i> Messages
                                    </div>

                                </li>
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="fas fa-bold"></i> Calendar
                                    </div>

                                </li>

                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="fas fa-bold"></i> Files & Library
                                    </div>

                                </li>
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="far fa-bell"></i> Invoice Manager
                                    </div>

                                </li>


                                <h6 class="mt-3"><b>Rating</b></h6>
                                <!-- Brands -->
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="far fa-envelope"></i> Buyers
                                    </div>

                                </li>
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="fas fa-bold"></i> Clients
                                    </div>

                                </li>

                                <!-- Ratings -->
                                <li class="accordion-item">
                                    <div class="accordion-button">
                                        <i class="far fa-star"></i> Ratings
                                    </div>
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rating" id="rating5">
                                            <label class="form-check-label" for="rating5">
                                                ⭐⭐⭐⭐⭐
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rating" id="rating4">
                                            <label class="form-check-label" for="rating4">
                                                ⭐⭐⭐⭐ & Up
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rating" id="rating3">
                                            <label class="form-check-label" for="rating3">
                                                ⭐⭐⭐ & Up
                                            </label>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <div class="mt-3">
                                <button class="btn btn-primary w-100">Apply Filters</button>
                            </div>
                        </div>
                    </div>
                    <!-- Product List -->
                    <div class="col-xl-9 col-lg-8 col-md-8 col-sm-6">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4>Electronics (24 products)</h4>
                            <div class="dropdown custom-dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                    id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    Sort by: Featured
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                                    <li><a class="dropdown-item" href="#">Featured</a></li>
                                    <li><a class="dropdown-item" href="#">Price: Low to High</a></li>
                                    <li><a class="dropdown-item" href="#">Price: High to Low</a></li>
                                    <li><a class="dropdown-item" href="#">Customer Rating</a></li>
                                    <li><a class="dropdown-item" href="#">Newest</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="swiper wishlist-swiper mb-4">
                            <div class="swiper-wrapper">
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
                                </div>
                            </div>
                        </div>
                        <!-- just for you -->
                        <div class="d-flex align-items-center justify-content-between gap-xl-5 gap-2 mb-3 flex-wrap">
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
                                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path
                                                                d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                    <img src="./assets/images/wishlist/product-media2.png" alt="media">
                                                </a>

                                                <div class="hover-btn">
                                                    <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path
                                                                d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                    <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                                </a>

                                                <div class="hover-btn">
                                                    <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                    <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                                </a>

                                                <div class="hover-btn">
                                                    <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path
                                                                d="M18.75 20.25C19.1642 20.25 19.5 19.9142 19.5 19.5C19.5 19.0858 19.1642 18.75 18.75 18.75C18.3358 18.75 18 19.0858 18 19.5C18 19.9142 18.3358 20.25 18.75 20.25Z"
                                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path d="M2.25 3.75H5.25L7.5 16.5H19.5" stroke="white"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                    <img src="./assets/images/wishlist/product-media2.png" alt="media">
                                                </a>

                                                <div class="hover-btn">
                                                    <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path
                                                                d="M7.5 12.5H19.1925C19.2792 12.5001 19.3633 12.4701 19.4304 12.4151C19.4975 12.3601 19.5434 12.2836 19.5605 12.1986L20.9105 5.44859C20.9214 5.39417 20.92 5.338 20.9066 5.28414C20.8931 5.23029 20.8679 5.18009 20.8327 5.13717C20.7975 5.09426 20.7532 5.05969 20.703 5.03597C20.6528 5.01225 20.598 4.99996 20.5425 5H6"
                                                                stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                    <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                                </a>

                                                <div class="hover-btn">
                                                    <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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
                                                    <img src="./assets/images/wishlist/product-media3.png" alt="media">
                                                </a>

                                                <div class="hover-btn">
                                                    <a href="cart-page.html" class="btn add-cart add-cart2"><svg
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
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

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



    <script>
        // Price range slider functionality
        document.addEventListener('DOMContentLoaded', function () {
            // Price range slider
            const priceRange = document.getElementById('priceRange');
            const priceValue = document.getElementById('priceValue');

            if (priceRange && priceValue) {
                priceRange.addEventListener('input', function () {
                    priceValue.textContent = this.value;
                });
            }

            // Initialize Bootstrap tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Add to cart button functionality
            const addToCartButtons = document.querySelectorAll('.btn-outline-primary');
            addToCartButtons.forEach(button => {
                button.addEventListener('click', function () {
                    // Get product info
                    const card = this.closest('.card');
                    const productName = card.querySelector('.card-title').textContent;

                    // Show alert
                    alert(`Added ${productName} to cart!`);

                    // Change button text temporarily
                    const originalText = this.innerHTML;
                    this.innerHTML = 'Added!';
                    this.classList.remove('btn-outline-primary');
                    this.classList.add('btn-success');

                    // Reset button after 2 seconds
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.classList.remove('btn-success');
                        this.classList.add('btn-outline-primary');
                    }, 2000);
                });
            });

            // Filter application
            const applyFilterButtons = document.querySelectorAll('.sidebar-container .btn-primary');
            applyFilterButtons.forEach(button => {
                button.addEventListener('click', function () {
                    alert('Filters applied! (This would normally filter the products)');
                });
            });

            // Sort dropdown functionality
            const sortDropdownItems = document.querySelectorAll('.dropdown-item');
            sortDropdownItems.forEach(item => {
                item.addEventListener('click', function (e) {
                    e.preventDefault();
                    const sortText = this.textContent;
                    const dropdownButton = this.closest('.dropdown').querySelector('.dropdown-toggle');
                    dropdownButton.textContent = `Sort by: ${sortText}`;

                    alert(`Products sorted by: ${sortText}`);
                });
            });
        });
    </script>

    <script>
        function performSearch(query = null) {
            const searchInput = document.getElementById('search-input');
            const q = query || searchInput.value.trim();
            
            if (!q) {
                document.getElementById('results-wrapper').innerHTML = '<div style="width:100%; text-align:center; padding:40px;"><p class="text-muted">Enter a search term</p></div>';
                document.getElementById('results-title').textContent = 'Products';
                document.getElementById('pagination-links').innerHTML = '';
                return;
            }
            
            fetch(`{{ route('search-product') }}?q=${encodeURIComponent(q)}`, {
                headers: {'Accept': 'application/json'}
            })
            .then(res => res.json())
            .then(data => {
                const results = data.data || [];
                const total = data.total || 0;
                
                if (results.length === 0) {
                    document.getElementById('results-wrapper').innerHTML = `
                        <div style="width:100%; text-align:center; padding:40px;">
                            <p class="text-muted">No products found for "${q}"</p>
                        </div>
                    `;
                    document.getElementById('pagination-links').innerHTML = '';
                } else {
                    renderProducts(results);
                }
                
                document.getElementById('results-title').textContent = `${total} Products found for "${q}"`;
            })
            .catch(err => console.error('Search error:', err));
        }

        function renderProducts(products) {
            const html = products.map(p => `
                <div class="col-6 col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="/product-detail/${p.slug}">
                            <img src="${p.thumbnail ? '/storage/' + p.thumbnail : '/assets/images/placeholder.png'}" class="card-img-top" alt="${p.name}">
                        </a>
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title mb-2"><a href="/product-detail/${p.slug}">${p.name}</a></h6>
                            <div class="mt-auto">
                                ${p.discount_price ? `
                                    <div class="text-danger fw-bold">${p.currency || '$'}${parseFloat(p.discount_price).toLocaleString()}</div>
                                    <div class="text-muted"><strike>${p.currency || '$'}${parseFloat(p.price).toLocaleString()}</strike></div>
                                ` : `
                                    <div class="text-danger fw-bold">${p.currency || '$'}${parseFloat(p.price).toLocaleString()}</div>
                                `}
                                <div class="mt-2 d-flex justify-content-between align-items-center">
                                    <a href="/cart/add/${p.id}" class="btn btn-sm btn-primary">Add To Cart</a>
                                    ${p.discount_price && p.price > 0 ? `<span class="badge bg-primary">-${Math.round(((p.price - p.discount_price) / p.price) * 100)}%</span>` : ''}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `).join('');

            document.getElementById('results-wrapper').innerHTML = html;
            document.getElementById('pagination-links').innerHTML = '';
        }

        // Real-time search on input
        document.getElementById('search-input').addEventListener('keyup', debounce(function() {
            performSearch(this.value);
        }, 300));

        function debounce(func, delay) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), delay);
            };
        }
    </script>

    <script>
        document.querySelectorAll(".accordion-button").forEach(button => {
            button.addEventListener("click", () => {
                const currentItem = button.closest(".accordion-item");
                const content = button.nextElementSibling;

                const isOpen = content.classList.contains("show");

                // Close all
                document.querySelectorAll(".accordion-item").forEach(item => {
                    item.classList.remove("active");
                    const body = item.querySelector(".accordion-body");
                    if (body) {
                        body.classList.remove("show");
                    }
                });

                // Toggle current
                if (!isOpen) {
                    currentItem.classList.add("active");
                    content.classList.add("show");
                }
            });
        });
    </script>






    <!-- mobile js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/custom-swiper.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/mobile.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>