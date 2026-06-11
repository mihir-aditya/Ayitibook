<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Website Page Title -->
    <title>Contact | AyitiBook</title>

    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="author" content="Author Name">
    <meta name="robots" content="index, follow">

    <!-- Viewport Meta Tag -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon Tags -->
    <link rel="icon" type="image/png" href="/assets/images/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/apple-touch-icon.png">

    <!-- CSS Stylesheet Link -->
    <link rel="stylesheet" type="text/css" href="/assets/vendor/fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendor/swiper/swiper-bundle.min.css">

    <!-- common css -->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/custom.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/footer.css">
    <link rel="stylesheet" href="/assets/css/header.css">

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

        /* .End  */

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
    <!-- ====================site header ============================================-->

    {{-- ── Top Bar (desktop only) ──────────────────────────────── --}}
    <div class="top-bar bg-dark d-none d-lg-block">
        <div class="container py-0">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <div class="shape-left">
                        <div class="location">
                            <i class="fas fa-map-marker-alt me-1"></i> Update Location
                            <p class="mb-1">New Delhi, India</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="">
                            <p class="text-white mb-0 d-inline">Summer Sale For All Swim Suits And Free
                                Express Delivery - OFF 50%!</p>
                            <a href="javascript:void(0);" class="btn-link top-header-link font-14 fw-medium">ShopNow</a>
                        </div>

                        <div class="d-flex align-items-center">
                            <select class="form-select custom-select" aria-label="Language">
                                <option selected>English</option>
                                <option value="1">French</option>
                                <option value="2">Spanish</option>
                            </select>

                            <select class="form-select custom-select" aria-label="Country">
                                <option selected>India</option>
                                <option value="1">United States</option>
                                <option value="2">Haiti</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Large-screen Header ──────────────────────────────────── --}}
    <header class="">
        <div class="d-flex align-items-center justify-content-between header-large">

            {{-- Logo --}}
            <div class="website-logo">
                <a href="{{ url('/') }}"><img src="/assets/images/logo/logo.svg" alt="AyitiBook Logo"></a>
            </div>

            {{-- Main Nav --}}
            <nav>
                <label for="drop" class="toggle">&#8801;</label>
                <input type="checkbox" id="drop" />
                <ul class="menu">
                    @auth
                    @if (auth()->user()->affiliate)
                        <li class="nav-menu">
                            <a href="{{ route('affiliate.dashboard', auth()->user()->affiliate->affiliate_code) }}">
                                Affiliate
                            </a>
                        </li>
                    @endif
                @endauth
                    <li class="nav-menu"><a href="{{ url('/home') }}">Home</a></li>
                    <li class="nav-menu"><a href="{{ url('/about') }}">About Us</a></li>

                    <li class="nav-menu" id="categoryLink">
                        <label for="drop-2" class="toggle">Category ▾</label>
                        <a href="#">Category</a>
                        <input type="checkbox" id="drop-2" />
                    </li>

                    <li class="nav-menu">
                        <label for="drop-1" class="toggle">Pages</label>
                        <a href="#">Pages</a>
                        <input type="checkbox" id="drop-1" />
                        <ul class="sub-dropdown">
                            {{-- Only show Login link to guests --}}
                            @guest
                                <li class="nav-menu"><a href="{{ route('login') }}">Login</a></li>
                                <li class="nav-menu"><a href="{{ route('register') }}">Register</a></li>
                            @endguest
                            <li class="nav-menu"><a href="#">Privacy Policy</a></li>
                            <li class="nav-menu"><a href="#">Terms & Conditions</a></li>
                        </ul>
                    </li>

                    <li class="nav-menu"><a href="{{ url('/contact') }}">Contact</a></li>
                </ul>
            </nav>

            {{-- Right icons area --}}
            <div class="header-item item-right hide-element">

                {{-- Search (visible to everyone) --}}
                <div class="search-bar">
                    <form action="{{ route('search-product') }}" method="GET" class="search-bar">
                        <input type="text" id="search-input" name="q" value="{{ request('q') }}"
                            placeholder="What are you looking for?" autocomplete="off">
                        <button type="submit" class="search-icon">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                @auth
                    {{-- ── Authenticated: show all icons ── --}}

                    {{-- Wishlist --}}
                    <a href="{{ url('/wishlist') }}" class="icon-tag position-relative">
                        <img src="/assets/images/Wishlist.png" alt="Wishlist" class="">
                        <span class="wishlist-count" id="wishlist-count">0</span>
                    </a>

                    {{-- Cart --}}
                    <a href="{{ url('/cart') }}" class="icon-tag position-relative">
                        <img src="/assets/images/buy-icon.png" alt="Cart">
                        <span class="shop-cart-count" id="cart-count">0</span>
                    </a>

                    {{-- Wallet --}}
                    <a href="/profile/wallet-transactions" class="icon-tag wallet-bx position-relative">
                        <img src="/assets/images/wallet.png" alt="Wallet" style="width:25px;">
                        <span class="save-price">{{ auth()->user()->wallet_balance ?? '0' }}$</span>
                    </a>

                    {{-- Notification Bell --}}
                    @include('components.header')

                    {{-- Account Dropdown --}}
                    <li class="dropdown ml-2">
                        <a class="rounded-circle" href="#" role="button" id="dropdownUser"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="avatar avatar-md avatar-indicators avatar-online">
                                @if (auth()->user()->profile_pic)
                                    <img src="{{ asset('storage/' . auth()->user()->profile_pic) }}"
                                        alt="{{ auth()->user()->name }}"
                                        style="width:36px;height:36px;border-radius:50%;object-fit:cover;">
                                @else
                                    <i class='bx bx-user'></i>
                                @endif
                            </div>
                        </a>

                        <div class="profile-dropdown dropdown-menu pb-2" aria-labelledby="dropdownUser">

                            {{-- User info header --}}
                            <div class="px-3 py-2 border-bottom mb-1">
                                <div style="font-weight:700;font-size:.9rem;color:#fff;">
                                    {{ auth()->user()->name ?? auth()->user()->first_name . ' ' . auth()->user()->last_name }}
                                </div>
                                <div style="font-size:.75rem;color:rgba(255,255,255,.6);">{{ auth()->user()->email }}
                                </div>
                            </div>

                            <div class="" style="z-index=999;"> >
                                <ul class="list-unstyled">
                                    <li class="dropdown-submenu dropright-lg">
                                        <a class="dropdown-item dropdown-list-group-item"
                                            href="{{ route('profile.edit') }}">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg" class="svg-icon">
                                                <path
                                                    d="M24 27V24.3333C24 22.9188 23.5224 21.5623 22.6722 20.5621C21.8221 19.5619 20.669 19 19.4667 19H11.5333C10.331 19 9.17795 19.5619 8.32778 20.5621C7.47762 21.5623 7 22.9188 7 24.3333V27"
                                                    stroke="#FAFAFA" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M16.5 14C18.9853 14 21 11.9853 21 9.5C21 7.01472 18.9853 5 16.5 5C14.0147 5 12 7.01472 12 9.5C12 11.9853 14.0147 14 16.5 14Z"
                                                    stroke="#FAFAFA" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Manage My Account
                                        </a>
                                    </li>

                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item" href="{{ route('my-orders') }}">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M3 6.30005V20.5C3 20.7653 3.10536 21.0196 3.29289 21.2072C3.48043 21.3947 3.73478 21.5 4 21.5H20C20.2652 21.5 20.5196 21.3947 20.7071 21.2072C20.8946 21.0196 21 20.7653 21 20.5V6.30005H3Z"
                                                    stroke="#FAFAFA" stroke-width="1.5" stroke-linejoin="round" />
                                                <path
                                                    d="M21 6.3L18.1665 2.5H5.8335L3 6.3M15.7775 9.6C15.7775 11.699 14.0865 13.4 12 13.4C9.9135 13.4 8.222 11.699 8.222 9.6"
                                                    stroke="#FAFAFA" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            My Order
                                        </a>
                                    </li>

                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item"
                                            href="/profile/subscribed-sellers">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" stroke="#FAFAFA"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M13.73 21a2 2 0 0 1-3.46 0" stroke="#FAFAFA" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            My Subscriptions
                                        </a>
                                    </li>

                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item" href="/profile/cancellation">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_1696_3552)">
                                                    <path d="M8 16L12 12M16 8L11.9992 12M11.9992 12L8 8M12 12L16 16"
                                                        stroke="#FAFAFA" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <circle cx="12" cy="12" r="11.25" stroke="white"
                                                        stroke-width="1.5" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_1696_3552">
                                                        <rect width="24" height="24" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                            My Cancellations
                                        </a>
                                    </li>

                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item" href="#">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M15 0H5C2.24 0 0 2.23 0 4.98V11.96C0 14.71 2.24 16.94 5 16.94H6.5C6.77 16.94 7.13 17.12 7.3 17.34L8.8 19.33C9.46 20.21 10.54 20.21 11.2 19.33L12.7 17.34C12.89 17.09 13.19 16.94 13.5 16.94H15C17.76 16.94 20 14.71 20 11.96V4.98C20 2.23 17.76 0 15 0ZM6 10C5.44 10 5 9.55 5 9C5 8.45 5.45 8 6 8C6.55 8 7 8.45 7 9C7 9.55 6.56 10 6 10ZM10 10C9.44 10 9 9.55 9 9C9 8.45 9.45 8 10 8C10.55 8 11 8.45 11 9C11 9.55 10.56 10 10 10ZM14 10C13.44 10 13 9.55 13 9C13 8.45 13.45 8 14 8C14.55 8 15 8.45 15 9C15 9.55 14.56 10 14 10Z"
                                                    fill="white" />
                                            </svg>
                                            My Messages
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            {{-- Sign Out --}}
                            <ul class="list-unstyled">
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M4 12H13.5M6 15L3 12L6 9M11 7V6C11 5.46957 11.2107 4.96086 11.5858 4.58579C11.9609 4.21071 12.4696 4 13 4H18C18.5304 4 19.0391 4.21071 19.4142 4.58579C19.7893 4.96086 20 5.46957 20 6V18C20 18.5304 19.7893 19.0391 19.4142 19.4142C19.0391 19.7893 18.5304 20 18 20H13C12.4696 20 11.9609 19.7893 11.5858 19.4142C11.2107 19.0391 11 18.5304 11 18V17"
                                                stroke="#FAFAFA" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                        Sign Out
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display:none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>

                        </div>
                    </li>
                    {{-- END account dropdown --}}
                @else
                    {{-- ── Guest: Login / Register — sized to match header icon row ── --}}
                    <div style="display:flex;align-items:center;gap:8px;margin-left:10px;flex-shrink:0;">
                        <a href="{{ route('login') }}"
                            style="display:inline-flex;align-items:center;gap:5px;
              height:36px;padding:0 16px;
              border:1.5px solid #ccc;border-radius:6px;
              font-size:.82rem;font-weight:600;
              color:#333;background:#fff;
              text-decoration:none;white-space:nowrap;
              transition:border-color .2s,color .2s;">
                            <i class="bx bx-log-in"></i> Login
                        </a>
                        <a href="{{ route('register') }}"
                            style="display:inline-flex;align-items:center;gap:5px;
              height:36px;padding:0 16px;
              border:1.5px solid #db4444;border-radius:6px;
              font-size:.82rem;font-weight:600;
              color:#fff;background:#db4444;
              text-decoration:none;white-space:nowrap;
              transition:background .2s,opacity .2s;">
                            <i class="bx bx-user-plus"></i> Register
                        </a>
                    </div>
                @endauth

            </div>
            {{-- END item-right --}}

        </div>
    </header>

    {{-- ── Mega Menu (desktop category bar) ───────────────────── --}}
    <div style="display:none;" id="megamenu" class="container py-3">
        <div class="category-list">
            <ul class="parent-menu-list">

                <li class="parent-menu">
                    <a href="" class="main-link">Fashion</a>
                    <ul class="inner-menu">
                        <li class="inner-sub-menu-list">
                            <a href="" class="item-link">Men's Topwear</a>
                            <ul class="inner-sub-menu">
                                <li><a href="#">Men's T-Shirts</a></li>
                                <li><a href="#">Men's Shirts</a></li>
                                <li><a href="#">Men's Sweatshirts</a></li>
                                <li><a href="#">Men's Jackets</a></li>
                            </ul>
                        </li>
                        <li class="inner-sub-menu-list">
                            <a href="" class="item-link">Men's Bottomwear</a>
                            <ul class="inner-sub-menu">
                                <li><a href="#">Men's Jeans</a></li>
                                <li><a href="#">Men's Trousers</a></li>
                                <li><a href="#">Men's Formal Pants</a></li>
                            </ul>
                        </li>
                        <li class="inner-sub-menu-list">
                            <a href="" class="item-link">Women's Ethnic Wear</a>
                            <ul class="inner-sub-menu">
                                <li><a href="#">Sarees</a></li>
                                <li><a href="#">Kurtas</a></li>
                                <li><a href="#">Lehengas</a></li>
                            </ul>
                        </li>
                        <li class="inner-sub-menu-list">
                            <a href="" class="item-link">Women's Western Wear</a>
                            <ul class="inner-sub-menu">
                                <li><a href="#">Tops</a></li>
                                <li><a href="#">Dresses</a></li>
                                <li><a href="#">Skirts</a></li>
                            </ul>
                        </li>
                        <li class="inner-sub-menu-list">
                            <a href="" class="item-link">Women's Footwear</a>
                            <ul class="inner-sub-menu">
                                <li><a href="#">Flats</a></li>
                                <li><a href="#">Heels</a></li>
                                <li><a href="#">Sneakers</a></li>
                                <li><a href="#">Flip-Flops</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="parent-menu">
                    <a href="" class="main-link">Electronics</a>
                    <ul class="inner-menu">
                        <li class="inner-sub-menu-list">
                            <a href="" class="item-link">Mobiles</a>
                            <ul class="inner-sub-menu">
                                <li><a href="#">Smartphones</a></li>
                                <li><a href="#">Feature Phones</a></li>
                                <li><a href="#">Mobile Accessories</a></li>
                                <li><a href="#">Power Banks</a></li>
                            </ul>
                        </li>
                        <li class="inner-sub-menu-list">
                            <a href="" class="item-link">Laptops</a>
                            <ul class="inner-sub-menu">
                                <li><a href="#">Gaming Laptops</a></li>
                                <li><a href="#">Business Laptops</a></li>
                                <li><a href="#">2-in-1 Laptops</a></li>
                                <li><a href="#">Laptop Accessories</a></li>
                            </ul>
                        </li>
                        <li class="inner-sub-menu-list">
                            <a href="" class="item-link">Televisions</a>
                            <ul class="inner-sub-menu">
                                <li><a href="#">LED TVs</a></li>
                                <li><a href="#">Smart TVs</a></li>
                                <li><a href="#">4K Ultra HD TVs</a></li>
                                <li><a href="#">Android TVs</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="parent-menu">
                    <a href="" class="main-link">Home & Kitchen</a>
                    <ul class="inner-menu">
                        <li class="inner-sub-menu-list">
                            <a href="" class="item-link">Furniture</a>
                            <ul class="inner-sub-menu">
                                <li><a href="#">Sofas</a></li>
                                <li><a href="#">Beds</a></li>
                                <li><a href="#">Dining Tables</a></li>
                                <li><a href="#">Wardrobes</a></li>
                            </ul>
                        </li>
                        <li class="inner-sub-menu-list">
                            <a href="" class="item-link">Home Decor</a>
                            <ul class="inner-sub-menu">
                                <li><a href="#">Curtains</a></li>
                                <li><a href="#">Wall Art</a></li>
                                <li><a href="#">Clocks</a></li>
                                <li><a href="#">Lighting</a></li>
                            </ul>
                        </li>
                        <li class="inner-sub-menu-list">
                            <a href="" class="item-link">Kitchen Appliances</a>
                            <ul class="inner-sub-menu">
                                <li><a href="#">Mixer Grinders</a></li>
                                <li><a href="#">Microwaves</a></li>
                                <li><a href="#">Cooktops</a></li>
                                <li><a href="#">Toasters</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="parent-menu">
                    <a href="" class="main-link">Beauty & Personal Care</a>
                    <ul class="inner-menu">
                        <li class="inner-sub-menu-list">
                            <a href="" class="item-link">Makeup</a>
                            <ul class="inner-sub-menu">
                                <li><a href="#">Lipsticks</a></li>
                                <li><a href="#">Foundations</a></li>
                                <li><a href="#">Mascaras</a></li>
                                <li><a href="#">Eyeliners</a></li>
                            </ul>
                        </li>
                        <li class="inner-sub-menu-list">
                            <a href="" class="item-link">Skin Care</a>
                            <ul class="inner-sub-menu">
                                <li><a href="#">Face Wash</a></li>
                                <li><a href="#">Moisturizers</a></li>
                                <li><a href="#">Sunscreens</a></li>
                                <li><a href="#">Face Packs</a></li>
                            </ul>
                        </li>
                        <li class="inner-sub-menu-list">
                            <a href="" class="item-link">Hair Care</a>
                            <ul class="inner-sub-menu">
                                <li><a href="#">Shampoos</a></li>
                                <li><a href="#">Conditioners</a></li>
                                <li><a href="#">Hair Oils</a></li>
                                <li><a href="#">Serums</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="parent-menu">
                    <a href="" class="main-link">Sports & Fitness</a>
                    <ul class="inner-menu">
                        <li class="inner-sub-menu-list">
                            <a href="" class="item-link">Sportswear</a>
                            <ul class="inner-sub-menu">
                                <li><a href="#">T-Shirts</a></li>
                                <li><a href="#">Track Pants</a></li>
                                <li><a href="#">Shorts</a></li>
                                <li><a href="#">Sports Bras</a></li>
                            </ul>
                        </li>
                        <li class="inner-sub-menu-list">
                            <a href="" class="item-link">Fitness Equipment</a>
                            <ul class="inner-sub-menu">
                                <li><a href="#">Dumbbells</a></li>
                                <li><a href="#">Treadmills</a></li>
                                <li><a href="#">Exercise Bikes</a></li>
                                <li><a href="#">Yoga Mats</a></li>
                            </ul>
                        </li>
                        <li class="inner-sub-menu-list">
                            <a href="" class="item-link">Footwear</a>
                            <ul class="inner-sub-menu">
                                <li><a href="#">Running Shoes</a></li>
                                <li><a href="#">Training Shoes</a></li>
                                <li><a href="#">Cricket Shoes</a></li>
                                <li><a href="#">Football Boots</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
    {{-- END mega menu --}}

    {{-- ── Mobile Sidebar ───────────────────────────────────────── --}}
    <div class="mobile-menu">
        <div class="menu-toggle" onclick="toggleSidebar()">☰</div>

        <div class="sidebar" id="sidebar">
            <div class="close-btn" onclick="toggleSidebar()">×</div>
            <ul class="menu">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="submenu-parent">
                    <a href="javascript:void(0)" onclick="toggleSubmenu(this)">Category</a>
                    <ul class="submenu">
                        <li><a href="#">Home, Kitchen</a></li>
                        <li><a href="#">Furniture</a></li>
                        <li><a href="#">Women's Fashion</a></li>
                        <li><a href="#">Men's Fashion</a></li>
                    </ul>
                </li>
                <li class="submenu-parent">
                    <a href="javascript:void(0)" onclick="toggleSubmenu(this)">Pages</a>
                    <ul class="submenu">
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @endguest
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                    </ul>
                </li>

                {{-- Mobile auth menu items --}}
                @auth
                    <li><a href="{{ route('profile.edit') }}"><i class="bx bx-user me-1"></i> My Account</a></li>
                    <li><a href="{{ route('my-orders') }}"><i class="bx bx-package me-1"></i> My Orders</a></li>
                    <li><a href="{{ url('/wishlist') }}"><i class="bx bx-heart me-1"></i> Wishlist</a></li>
                    <li><a href="{{ url('/cart') }}"><i class="bx bx-cart me-1"></i> Cart</a></li>
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('mobile-logout-form').submit();">
                            <i class="bx bx-log-out me-1"></i> Sign Out
                        </a>
                        <form id="mobile-logout-form" action="{{ route('logout') }}" method="POST"
                            style="display:none;">@csrf</form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}"><i class="bx bx-log-in me-1"></i> Login</a></li>
                    <li><a href="{{ route('register') }}"><i class="bx bx-user-plus me-1"></i> Register</a></li>
                @endauth

                <li><a href="{{ url('/contact') }}">Contact</a></li>
            </ul>
        </div>
    </div>
    {{-- END mobile sidebar --}}
    <!-- end--=========================== -->



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="/dir/Ayitibook-project/17-april-2025/17-april-2025/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="/dir/Ayitibook-project/17-april-2025/17-april-2025/assets/js/custom-swiper.js"></script>
    <script src="/dir/Ayitibook-project/17-april-2025/17-april-2025/assets/js/main.js"></script>
    <!-- mobile js -->
    <script src="/dir/Ayitibook-project/17-april-2025/17-april-2025/assets/js/mobile.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    <!-- header mega menu  -->
    <script>
        // Show megamenu on hover for large screens
        document.querySelectorAll('.inner-sub-menu-list').forEach(item => {
            item.addEventListener('mouseenter', function() {
                const submenu = this.querySelector('.inner-sub-menu');
                if (submenu) {
                    // Always reset first
                    submenu.classList.remove('open-left');

                    // Temporarily make visible for measuring
                    submenu.style.visibility = 'hidden';
                    submenu.style.opacity = '0';
                    submenu.style.display = 'block';

                    const rect = submenu.getBoundingClientRect();
                    const willOverflow = rect.left + rect.width > window.innerWidth;

                    // Revert styles
                    submenu.style.display = '';
                    submenu.style.visibility = '';
                    submenu.style.opacity = '';

                    if (willOverflow) {
                        submenu.classList.add('open-left');
                    }
                }
            });
        });
    </script>

</body>

</html>