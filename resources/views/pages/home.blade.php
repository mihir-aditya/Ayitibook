<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Website Page Title -->
  <title>AyitiBook</title>

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

  <!-- Toastify CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <style>
.price {
    font-size: 20px;
    font-weight: bold;
}
.price sup {
    font-size: 10px;
    vertical-align: super;
}
.price .currency {
    font-size: 10px;
    vertical-align: top;
}
</style>
</head>

<style>
 body {
  overflow-x: hidden; /* Prevent page from scrolling horizontally */
}

/* Added By JK ....Start  */
#megamenu {
  position: sticky;
  top: 70px; /* adjust to match your header height */
  z-index: 100;
  /* background: white; */
  display: none; /* default is hidden */
  /* box-shadow: 0 2px 5px rgba(0,0,0,0.1); */
}

.category-list .inner-menu .inner-sub-menu-list .inner-sub-menu.open-left {
    left: auto;
    right: 220px; /* opens to the left */
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

.category-list .inner-menu .inner-sub-menu-list:hover > .inner-sub-menu {
  display: block;
}

@media screen and (max-width: 1200px) {
  /* If menu goes beyond screen width, show to the left instead */
  .category-list .inner-menu .inner-sub-menu-list:hover > .inner-sub-menu {
    left: auto;
    right: 100%;
  }
}

  .category-list {
    background-color: #f7f4f424;
     padding:0px 10px;
      box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 4px 0px;
  }


  .category-list .parent-menu-list {
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: relative;
}

.category-list .parent-menu-list  a{
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
.inner-sub-menu-list::after{
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
.category-list .inner-menu .inner-sub-menu-list  .inner-sub-menu{
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

.category-list .inner-menu .inner-sub-menu-list  .inner-sub-menu li{
  padding: 12px 16px;
}
.parent-menu-list .parent-menu:hover .main-link{
  transition: all 0.5s ease-in-out;
  color: var(--bs-primary);
  
}
/* Hover effect */
.category-list .parent-menu:hover > .inner-menu {
  opacity: 1;
  visibility: visible;
}
.category-list .inner-menu .inner-sub-menu-list:hover{
  background: #e8b3ba;
  font-weight: 500;
}

.category-list .inner-menu .inner-sub-menu-list:hover > .inner-sub-menu{
  opacity: 1;
  visibility: visible;
}
.category-list .inner-menu .inner-sub-menu-list  .inner-sub-menu li:hover{
  background: #f2c0ce;
}
</style>

<body>
  <!-- ====================site header ============================================-->
   @include('components.top-header')
  <!-- large size header -->
  @include('components.header')
  

  


  <div class="page-wrapper">
    <main class="main-wrapper">

      <!-- Hero Section section1-->
      <section class="hero-banner section-gap pt-0 pb-0">
        <div class="container">
          <div class="row g-0 g-lg-2 g-xl-5">
            <div class="col-xl-3">
              <div class="side-menu">
                <ul class="menu-list">
                  <li><a class="link active" href="javascript:void(0);">Woman's Fashion</a></li>
                  <li><a class="link active" href="javascript:void(0);">Man's Fashion</a></li>
                  <li><a class="link" href="javascript:void(0);">Electronics</a></li>
                  <li><a class="link" href="javascript:void(0);">Home & Lifestyle</a></li>
                  <li><a class="link" href="javascript:void(0);">Medicine</a></li>
                  <li><a class="link" href="javascript:void(0);">Sports & Outdoor</a></li>
                  <li><a class="link" href="javascript:void(0);">Baby's & Toys</a></li>
                  <li><a class="link" href="javascript:void(0);">Groceries & Pets</a></li>
                  <li><a class="link" href="javascript:void(0);">Health & Beauty</a></li>
                </ul>
              </div>
            </div>
            <div class="col-xl-9">
              <div class="right-bnr-area">
                <div class="swiper bnr-swiper">
                  <div class="swiper-wrapper">

                    <div class="swiper-slide">
                      <div class="banner-content">
                        <div class="left-content">
                          <div class="brand-title">
                            <img src="assets/images/banner/brand/apple.svg" alt="">
                            <span class="fw-normal lh-1">iPhone 14 Series</span>
                          </div>
                          <h1 class="title">Up to 10% off Voucher</h1>
                          <a href="javascript:void(0);" class="btn-link">Shop Now</a>
                        </div>
                        <div class="right-content">
                          <div class="image-div">
                            <img src="assets/images/banner/bnr-right-img.png" alt="bnr-right-img">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="banner-content">
                        <div class="left-content">
                          <div class="brand-title">
                            <img src="assets/images/banner/brand/apple.svg" alt="">
                            <span class="fw-normal lh-1">iPhone 14 Series</span>
                          </div>
                          <h1 class="title">Up to 10% off Voucher</h1>
                          <a href="javascript:void(0);" class="btn-link">Shop Now</a>
                        </div>
                        <div class="right-content">
                          <div class="image-div">
                            <img src="assets/images/banner/bnr-right-img.png" alt="bnr-right-img">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="banner-content">
                        <div class="left-content">
                          <div class="brand-title">
                            <img src="assets/images/banner/brand/apple.svg" alt="">
                            <span class="fw-normal lh-1">iPhone 14 Series</span>
                          </div>
                          <h1 class="title">Up to 10% off Voucher</h1>
                          <a href="javascript:void(0);" class="btn-link">Shop Now</a>
                        </div>
                        <div class="right-content">
                          <div class="image-div">
                            <img src="assets/images/banner/bnr-right-img.png" alt="bnr-right-img">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-pagination"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Deals Section section2-->
      <section class="deal-section">
        <div class="container">

          <div class="d-flex align-items-end gap-xl-5 gap-2 mb-3 flex-wrap position-relative">
            <div class="section-head mb-0">
              <span class="sub-title">Today's</span>
              <h2 class="title mb-0">Flash Sales</h2>
            </div>
            <div class="countdown" id="countdown1">
              <ul>
                <li>days<span id="days1"></span></li>
                <li>Hours<span id="hours2"></span></li>
                <li>Minutes<span id="minutes3"></span></li>
                <li>Seconds<span id="seconds4"></span></li>
              </ul>
            </div>
            <div class="swiper-navigation">
              <!-- Navigation buttons -->
              <div class="swiper-button-prev"><i class="fas fa-arrow-left"></i></div>
              <div class="swiper-button-next"><i class="fas fa-arrow-right"></i></div>
            </div>
          </div>
          <!-- Swiper -->
          <div class="swiper mySwiper pt-3 ">
            <div class="swiper-wrapper">

              @foreach($flashsale as $item)
                <div class="swiper-slide">
                <div class="latest-sale-box mb-4">
                  <div class="media-box ">
                    <div class="product-img">
                      <a href="/product-detail/{{ $item->slug }}">
                        <img src="{{ asset($item->thumbnail) }}" alt="img1">
                      </a>

                      <div class="hover-btn">
                           {{-- check it's already on cart --}}
                          @if($item->is_cart)
                           <a href="/cart" class="btn add-cart"> Go To Cart</a>
                          @else
                          <a href="javascript:void(0);" onclick="addToCart({{ $item->id }})" class="btn add-cart"> Add To Cart</a>
                          @endif
                        <a href="javascript:void(0);" onclick="buyNow({{ $item->id }})" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>
                    <span class="badge style1 badge-primary">
                      - 40%
                    </span>
                    <div class="product-icon-div">
                      <ul class="ps-0">
                        <li class="like-icon">
                          <a href="javascript:void(0);" id="like-{{ $item->id }}" class="{{ $item->is_wishlist ? 'active-like-icon' : '' }}" onclick="addWishlist({{ $item->id }})">
                              <i class="far fa-heart"></i>
                          </a>
                        </li>

                        <li class="view-icon">
                          <a href="javascript:void(0);" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">
                    <h6 class="title">
                      <a href="/product-detail/{{ $item->slug }}"> {{ $item->name }}</a>
                    </h6>
                    <div class="meta-div">
                      <span class="price text-danger">
                        <span class="currency">{{ $item->currency }}</span>{{ $item->price }}<sup>49</sup>
                    </span>
                      <p class="text1 text-muted  "><strike>{{ $item->currency }}160</strike></p>
                      <p class="text3 text-success">({{ $item->stock_quantity  }} Stocks)</p>
                    </div>
                    <div class="bottom-box d-flex align-items-center">
                      <div class="d-flex align-items-center rating-icon">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                      <p class="rating-num mb-0"> (88)</p>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach

            

              
            </div>
          </div>
          <div class="text-center btn-gap">
            <a href="{{ route('search-product') }}" class="btn btn-secondary rounded">View all Product</a>
          </div>
          <hr>
        </div>
      </section>


      <!-- Category-section section3-->
      <section class="Category-section">
        <div class="container pt-0">
          <div class="d-flex align-items-end gap-xl-5 gap-2 mb-3 flex-wrap position-relative">
            <div class="section-head mb-0">
              <span class="sub-title">Categories</span>
              <h2 class="title mb-0">Browse By Category</h2>
            </div>
            <div class="swiper-navigation">
              <!-- Navigation buttons -->
              <div class="swiper-button-prev"><i class="fas fa-arrow-left"></i></div>
              <div class="swiper-button-next"><i class="fas fa-arrow-right"></i></div>
            </div>
          </div>
          <div class="swiper Category-swiper section-inner-gap">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <div class="Category-box icon-box-style1">
                  <div class="icon-div">
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g clip-path="url(#clip0_1270_353)">
                        <path
                          d="M38.9375 6.125H17.0625C15.5523 6.125 14.3281 7.34922 14.3281 8.85938V47.1406C14.3281 48.6508 15.5523 49.875 17.0625 49.875H38.9375C40.4477 49.875 41.6719 48.6508 41.6719 47.1406V8.85938C41.6719 7.34922 40.4477 6.125 38.9375 6.125Z"
                          stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M25.667 7H31.1357" stroke="black" stroke-width="3" stroke-linecap="round"
                          stroke-linejoin="round" />
                        <path d="M28 44.0052V44.0305" stroke="black" stroke-width="2.5" stroke-linecap="round"
                          stroke-linejoin="round" />
                        <line x1="15.167" y1="39.8333" x2="40.8337" y2="39.8333" stroke="black" stroke-width="2" />
                      </g>
                      <defs>
                        <clipPath id="clip0_1270_353">
                          <rect width="56" height="56" fill="white" />
                        </clipPath>
                      </defs>
                    </svg>

                  </div>
                  <div class="inner-content-box">
                    <h6 class="name">phone</h6>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="Category-box icon-box-style1">
                  <div class="icon-div">
                    <!-- <img src="./assets/images/Category/Category2.png" alt="Category2"> -->
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g clip-path="url(#clip0_139_1085)">
                        <path
                          d="M46.6667 9.33325H9.33333C8.04467 9.33325 7 10.3779 7 11.6666V34.9999C7 36.2886 8.04467 37.3333 9.33333 37.3333H46.6667C47.9553 37.3333 49 36.2886 49 34.9999V11.6666C49 10.3779 47.9553 9.33325 46.6667 9.33325Z"
                          stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M16.3333 46.6667H39.6667" stroke="black" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round" />
                        <path d="M21 37.3333V46.6666" stroke="black" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round" />
                        <path d="M35 37.3333V46.6666" stroke="black" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round" />
                        <path d="M8 32H48" stroke="black" stroke-width="2" stroke-linecap="round" />
                      </g>
                      <defs>
                        <clipPath id="clip0_139_1085">
                          <rect width="56" height="56" fill="white" />
                        </clipPath>
                      </defs>
                    </svg>


                  </div>
                  <div class="inner-content-box">
                    <h6 class="name">computers</h6>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="Category-box icon-box-style1">
                  <div class="icon-div">
                    <!-- <img src="./assets/images/Category/Category3.png" alt="Category3"> -->
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g clip-path="url(#clip0_139_1524)">
                        <path
                          d="M35 14H21C17.134 14 14 17.134 14 21V35C14 38.866 17.134 42 21 42H35C38.866 42 42 38.866 42 35V21C42 17.134 38.866 14 35 14Z"
                          stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M21 42V49H35V42" stroke="black" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round" />
                        <path d="M21 14V7H35V14" stroke="black" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round" />
                        <line x1="24" y1="23" x2="24" y2="34" stroke="black" stroke-width="2" stroke-linecap="round" />
                        <line x1="28" y1="28" x2="28" y2="34" stroke="black" stroke-width="2" stroke-linecap="round" />
                        <line x1="32" y1="26" x2="32" y2="34" stroke="black" stroke-width="2" stroke-linecap="round" />
                      </g>
                      <defs>
                        <clipPath id="clip0_139_1524">
                          <rect width="56" height="56" fill="white" />
                        </clipPath>
                      </defs>
                    </svg>

                  </div>
                  <div class="inner-content-box">
                    <h6 class="name">SmartWatch</h6>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="Category-box icon-box-style1">
                  <div class="icon-div">
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g clip-path="url(#clip0_139_3595)">
                        <path
                          d="M11.6667 16.3333H14C15.2377 16.3333 16.4247 15.8416 17.2998 14.9664C18.175 14.0912 18.6667 12.9043 18.6667 11.6666C18.6667 11.0477 18.9125 10.4543 19.3501 10.0167C19.7877 9.57909 20.3812 9.33325 21 9.33325H35C35.6188 9.33325 36.2123 9.57909 36.6499 10.0167C37.0875 10.4543 37.3333 11.0477 37.3333 11.6666C37.3333 12.9043 37.825 14.0912 38.7002 14.9664C39.5753 15.8416 40.7623 16.3333 42 16.3333H44.3333C45.571 16.3333 46.758 16.8249 47.6332 17.7001C48.5083 18.5753 49 19.7622 49 20.9999V41.9999C49 43.2376 48.5083 44.4246 47.6332 45.2997C46.758 46.1749 45.571 46.6666 44.3333 46.6666H11.6667C10.429 46.6666 9.242 46.1749 8.36683 45.2997C7.49167 44.4246 7 43.2376 7 41.9999V20.9999C7 19.7622 7.49167 18.5753 8.36683 17.7001C9.242 16.8249 10.429 16.3333 11.6667 16.3333"
                          stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                          d="M28 37.3333C31.866 37.3333 35 34.1992 35 30.3333C35 26.4673 31.866 23.3333 28 23.3333C24.134 23.3333 21 26.4673 21 30.3333C21 34.1992 24.134 37.3333 28 37.3333Z"
                          stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                      </g>
                      <defs>
                        <clipPath id="clip0_139_3595">
                          <rect width="56" height="56" fill="black" />
                        </clipPath>
                      </defs>
                    </svg>

                  </div>
                  <div class="inner-content-box">
                    <h6 class="name">Camera</h6>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="Category-box icon-box-style1">
                  <div class="icon-div">
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g clip-path="url(#clip0_139_1167)">
                        <path
                          d="M16.3333 30.3333H14C11.4227 30.3333 9.33331 32.4226 9.33331 34.9999V41.9999C9.33331 44.5772 11.4227 46.6666 14 46.6666H16.3333C18.9106 46.6666 21 44.5772 21 41.9999V34.9999C21 32.4226 18.9106 30.3333 16.3333 30.3333Z"
                          stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                          d="M42 30.3333H39.6667C37.0893 30.3333 35 32.4226 35 34.9999V41.9999C35 44.5772 37.0893 46.6666 39.6667 46.6666H42C44.5773 46.6666 46.6667 44.5772 46.6667 41.9999V34.9999C46.6667 32.4226 44.5773 30.3333 42 30.3333Z"
                          stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                          d="M9.33331 34.9999V27.9999C9.33331 23.0492 11.3 18.3013 14.8007 14.8006C18.3013 11.2999 23.0493 9.33325 28 9.33325C32.9507 9.33325 37.6986 11.2999 41.1993 14.8006C44.7 18.3013 46.6666 23.0492 46.6666 27.9999V34.9999"
                          stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                      </g>
                      <defs>
                        <clipPath id="clip0_139_1167">
                          <rect width="56" height="56" fill="white" />
                        </clipPath>
                      </defs>
                    </svg>

                  </div>
                  <div class="inner-content-box">
                    <h6 class="name">HeadPhones</h6>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="Category-box icon-box-style1">
                  <div class="icon-div">
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g clip-path="url(#clip0_139_1373)">
                        <path
                          d="M46.6666 14H9.33329C6.75596 14 4.66663 16.0893 4.66663 18.6667V37.3333C4.66663 39.9107 6.75596 42 9.33329 42H46.6666C49.244 42 51.3333 39.9107 51.3333 37.3333V18.6667C51.3333 16.0893 49.244 14 46.6666 14Z"
                          stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M14 27.9999H23.3333M18.6667 23.3333V32.6666" stroke="black" stroke-width="2"
                          stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M35 25.6667V25.6909" stroke="black" stroke-width="3" stroke-linecap="round"
                          stroke-linejoin="round" />
                        <path d="M42 30.3333V30.3574" stroke="black" stroke-width="3" stroke-linecap="round"
                          stroke-linejoin="round" />
                      </g>
                      <defs>
                        <clipPath id="clip0_139_1373">
                          <rect width="56" height="56" fill="white" />
                        </clipPath>
                      </defs>
                    </svg>

                  </div>
                  <div class="inner-content-box">
                    <h6 class="name">Gaming</h6>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="Category-box icon-box-style1">
                  <div class="icon-div">
                    <img src="./assets/images/Category/Category1.png" alt="Category1">
                  </div>
                  <div class="inner-content-box">
                    <h6 class="name">phone</h6>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="Category-box icon-box-style1">
                  <div class="icon-div">
                    <img src="./assets/images/Category/Category2.png" alt="Category2">
                  </div>
                  <div class="inner-content-box">
                    <h6 class="name">computers</h6>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="Category-box icon-box-style1">
                  <div class="icon-div">
                    <img src="./assets/images/Category/Category3.png" alt="Category3">
                  </div>
                  <div class="inner-content-box">
                    <h6 class="name">SmartWatch</h6>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="Category-box icon-box-style1">
                  <div class="icon-div">
                    <img src="./assets/images/Category/Category6.png" alt="Category4">
                  </div>
                  <div class="inner-content-box">
                    <h6 class="name">Camera</h6>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="Category-box icon-box-style1">
                  <div class="icon-div">
                    <img src="./assets/images/Category/Category5.png" alt="Category5">
                  </div>
                  <div class="inner-content-box">
                    <h6 class="name">HeadPhones</h6>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="Category-box icon-box-style1">
                  <div class="icon-div">
                    <img src="./assets/images/Category/Category6.png" alt="Category6">
                  </div>
                  <div class="inner-content-box">
                    <h6 class="name">Gaming</h6>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div> -->
          </div>
        </div>
      </section>
      <div class="container py-1">
        <hr>
      </div>
      <!-- end================== -->

      <!-- best-product-sale section4-->
      <section class="product-sale-section ">
        <div class="container">
          <div class="d-flex align-items-center justify-content-between gap-xl-5 gap-2 mb-3 flex-wrap">
            <div class="section-head mb-0">
              <span class="sub-title">this month</span>
              <h2 class="title mb-0">Best Selling Products</h2>
            </div>
            <a href="{{ route('search-product') }}" class="btn btn-secondary">View All</a>
          </div>
          <!-- Swiper -->
          <div class="swiper product-sale section-inner-gap">
            <div class="swiper-wrapper">

              @foreach($bestsellers as $item)
              <div class="swiper-slide">
                <div class="latest-sale-box mb-4">
                  <div class="media-box">
                    <div class="product-img">
                      <a href="/product-detail/{{ $item->slug }}">
                        <img src="{{ $item->thumbnail }}" alt="{{ $item->name }}">
                      </a>
                      <div class="hover-btn">
                            {{-- check it's already on cart --}}
                            @if($item->is_cart)
                            <a href="/cart" class="btn add-cart"> Go To Cart</a>
                            @else
                            <a href="javascript:void(0);" onclick="addToCart({{ $item->id }})" class="btn add-cart"> Add To Cart</a>
                            @endif
                          <a href="javascript:void(0);" onclick="buyNow({{ $item->id }})" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>
                    <span class="badge style1 badge-primary">
                      - 40%
                    </span>
                    <div class="product-icon-div">
                      <ul class="ps-0">
                       <li class="like-icon">
                          <a href="javascript:void(0);" id="like-{{ $item->id }}" class="{{ $item->is_wishlist ? 'active-like-icon' : '' }}" onclick="addWishlist({{ $item->id }})">
                              <i class="far fa-heart"></i>
                          </a>
                        </li>

                        <li class="view-icon">
                          <a href="javascript:void(0);" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">
                    <h6 class="title">
                      <a href="/product-detail/{{ $item->slug }}"> {{ $item->name }}</a>
                    </h6>
                    <div class="meta-div">
                      <span class="text1 text-danger">${{ $item->price }}</span>
                      <p class="text1 text-secondary ">${{ $item->old_price }}</p>
                      <p class="text3 text-success">({{ $item->stock }} Stocks)</p>
                    </div>
                    <div class="bottom-box d-flex align-items-center">
                      <div class="d-flex align-items-center rating-icon">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                      <p class="rating-num mb-0"> (88)</p>

                    </div>
                  </div>
                </div>
              </div>

              @endforeach
            </div>
          </div>
        </div>
      </section>

      <!-- advertising banner section5-->
      <section class="section4 add-banner">
        <div class="container">
          <div class="Categories-bg">
            <div class="row">
              <div class="col-lg-5 col-md-12">
                <div class="left-content-area">
                  <span class="tag">Categories</span>
                  <h2 class="add-title">enhance your <br> music experience</h2>
                  <div class="counter-box">
                    <div class="timer">
                      <div class="main-div">
                        <div id="hours" class="count">23</div>
                        <span>Hours</span>
                      </div>

                      <div class="main-div">
                        <div id="days" class="count">5</div>
                        <span>Days</span>
                      </div>

                      <div class="main-div">
                        <div id="minutes" class="count">59</div>
                        <span>Minutes</span>
                      </div>
                      <div class="main-div">
                        <div id="seconds" class="count">35</div>
                        <span>Seconds</span>
                      </div>
                    </div>
                  </div>
                  <div class="buy-btn-box">
                    <a href="" class="btn btn-buy">Buy Now</a>
                  </div>
                </div>
              </div>
              <div class="col-lg-7 col-md-12 col-sm-12">
                <div class="right-image-area bnr-add-div">
                  <img src="./assets/images/banner/add-banner.png" alt="banner-addvertisment image">
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!--  our-product -->
      <section class="section5 our-product ">
        <div class="container">
          <div class="d-flex align-items-end gap-xl-5 gap-2 mb-3 flex-wrap position-relative">
            <div class="section-head mb-0">
              <span class="sub-title">Our Products</span>
              <h2 class="title mb-0">Explore Our Products</h2>
            </div>
            <div class="swiper-navigation">
              <!-- Navigation buttons -->
              <div class="swiper-button-prev"><i class="fas fa-arrow-left"></i></div>
              <div class="swiper-button-next"><i class="fas fa-arrow-right"></i></div>
            </div>
          </div>
          <!-- Swiper -->
          <div class="swiper our-product-slider section-inner-gap">
            <div class="swiper-wrapper">
              @foreach($products->slice(0, 4) as $product)
                     <div class="swiper-slide">
                <div class="latest-sale-box mb-4">
                  <div class="media-box">
                    <div class="product-img">
                      <a href="product-detail.html">
                        <img src="{{ asset($product->thumbnail) }}" alt="explore-p1">
                      </a>
                      <div class="hover-btn">
                        @if($item->is_cart)
                           <a href="/cart" class="btn add-cart"> Go To Cart</a>
                          @else
                          <a href="javascript:void(0);" onclick="addToCart({{ $product->id }})" class="btn add-cart"> Add To Cart</a>
                          @endif
                        <a href="javascript:void(0);" onclick="buyNow({{ $product->id }})" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>

                    <div class="product-icon-div">
                      <ul class="ps-0">
                        <li class="like-icon">
                          <a href="javascript:void(0);" id="like-{{ $product->id }}" class="{{ $product->is_wishlist ? 'active-like-icon' : '' }}" onclick="addWishlist({{ $product->id }})">
                              <i class="far fa-heart"></i>
                          </a>
                        </li>

                        <li class="view-icon">
                          <a href="javascript:void(0);" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">
                    <h6 class="title">
                      <a href="/product/{{ $product->slug }}"> {{ $product->name }}</a>
                    </h6>
                    <div class="meta-div">
                      <span class="text1 text-danger">{{ $product->currency }}{{ $product->price }}</span>
                    </div>
                    <div class="bottom-box d-flex align-items-center">
                      <div class="d-flex align-items-center rating-icon">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                      <p class="rating-num mb-0"> (35)</p>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
              
            </div>
          </div>

          <div class="swiper our-product-slider">
            <div class="swiper-wrapper">
              @foreach($products->slice(4, 4) as $product)
                     <div class="swiper-slide">
                <div class="latest-sale-box mb-4">
                  <div class="media-box">
                    <div class="product-img">
                      <a href="product-detail.html">
                        <img src="{{ asset($product->thumbnail) }}" alt="explore-p1">
                      </a>
                      <div class="hover-btn">
                        @if($item->is_cart)
                           <a href="/cart" class="btn add-cart"> Go To Cart</a>
                          @else
                          <a href="javascript:void(0);" onclick="addToCart({{ $product->id }})" class="btn add-cart"> Add To Cart</a>
                          @endif
                        <a href="javascript:void(0);" onclick="buyNow({{ $product->id }})" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>

                    <div class="product-icon-div">
                      <ul class="ps-0">
                        <li class="like-icon">
                          <a href="javascript:void(0);" id="like-{{ $product->id }}" class="{{ $product->is_wishlist ? 'active-like-icon' : '' }}" onclick="addWishlist({{ $product->id }})">
                              <i class="far fa-heart"></i>
                          </a>
                        </li>

                        <li class="view-icon">
                          <a href="javascript:void(0);" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">
                    <h6 class="title">
                      <a href="/product/{{ $product->slug }}"> {{ $product->name }}</a>
                    </h6>
                    <div class="meta-div">
                      <span class="text1 text-danger">{{ $product->currency }}{{ $product->price }}</span>
                    </div>
                    <div class="bottom-box d-flex align-items-center">
                      <div class="d-flex align-items-center rating-icon">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                      <p class="rating-num mb-0"> (35)</p>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>

          <div class="text-center my-4">
            <a href="{{ route('search-product') }}" class="btn btn-secondary rounded">View all Product</a>
          </div>
        </div>
      </section>

      <!-- our partners -->
      <section class="our-partners">
        <div class="container">
          <div class="logos">
            <div class="logo_items">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">

            </div>
            <div class="logo_items">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">
              <img src="https://navneetdwivedi.github.io/Logo_Slider/logo.png">

            </div>
          </div>
        </div>
      </section>

      <!-- our feaure -->
      <section class="feature-section ">
        <div class="container">
          <div class="d-flex align-items-end gap-xl-5 gap-2 mb-3 flex-wrap">
            <div class="section-head mb-0">
              <span class="sub-title">Featured</span>
              <h2 class="title mb-0">New Arrival</h2>
            </div>
          </div>
          <div class="row section-inner-gap">
            <div class="col-md-6  mb-3">
              <div class="feature-image-box">
                <div class="feature-img">
                  <div class="content-area">
                    <h4 class="feature-title">PlayStation 5</h4>
                    <h4 class="feature-des">Black and White version of the PS5 <br> coming out on sale.</h4>
                    <a href="#" class="btn-link">Shop Now</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <div class="row">
                <div class="col-lg-12 mb-3">
                  <div class="feature-image-box style2">
                    <div class="feature-img">
                      <div class="content-area">
                        <h4 class="feature-title">Women's Collections</h4>
                        <h4 class="feature-des">Featured woman collections that <br> give you another vibe.</h4>
                        <a href="#" class="btn-link">Shop Now</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <div class="feature-image-box style3">
                    <div class="feature-img">
                      <div class="content-area">
                        <h4 class="feature-title">Speakers</h4>
                        <h4 class="feature-des">Amazon wireless speakers</h4>
                        <a href="#" class="btn-link">Shop Now</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <div class="feature-image-box style4">
                    <div class="feature-img">
                      <div class="content-area">
                        <h4 class="feature-title">Perfume</h4>
                        <h4 class="feature-des">GUCCI INTENSE OUD EDP.</h4>
                        <a href="#" class="btn-link">Shop Now</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- end====== -->


      <!-- our-services -->
      <section class="our-services">
        <div class="container">
          <div class="row">
            <div class="col-lg-11 mx-auto">
              <div class="row justify-conent-center">
                <div class="col-lg-4 col-md-6 mb-4">
                  <div class="services-icon-div text-center">
                    <div class="icon-media">
                      <div class="box-bg">
                        <!-- <i class="fas fa-truck"></i>   -->
                        <img src="./assets/images/footer/icon-delivery.png" alt="icon-delivery">
                      </div>
                    </div>
                    <h6 class="service-title">FREE AND FAST DELIVERY</h6>
                    <p class="service-service-desc">Free delivery for all orders over $140</p>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                  <div class="services-icon-div text-center">
                    <div class="icon-media">
                      <div class="box-bg">
                        <img src="./assets/images/footer/Icon-Customer service.png" alt="icon-delivery">
                      </div>
                    </div>
                    <h6 class="service-title">24/7 CUSTOMER SERVICE</h6>
                    <p class="service-service-desc">Friendly 24/7 customer support</p>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                  <div class="services-icon-div text-center">
                    <div class="icon-media">
                      <div class="box-bg">
                        <img src="./assets/images/footer/Icon-secure.png" alt="icon-delivery">
                      </div>
                    </div>
                    <h6 class="service-title">MONEY BACK GUARANTEE</h6>
                    <p class="service-service-desc">We return money within 30 days</p>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </section>
      <!-- end====== -->
    </main>
  </div>


  @include('components.footer')


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  
  <script src="assets/js/custom-swiper.js"></script>
  <script src="assets/js/main.js"></script>
    <!-- mobile js -->
  <script src="assets/js/mobile.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Toastify JS -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



  <!-- banner swiper -->
  <script>
    function bnrSwiper() {
      var swiper = new Swiper(".bnr-swiper", {
        spaceBetween: 0,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        mousewheel: true,
        keyboard: true,
      });
    }
    bnrSwiper();
  </script>

  <!-- counter 1 -->
  <script>
    // Set initial countdown values
    let days = 5;
    let hours = 23;
    let minutes = 59;
    let seconds = 35;

    // Function to update the countdown
    function updateCountdown() {
      // Decrement seconds
      seconds--;

      // Adjust other units when seconds reach zero
      if (seconds < 0) {
        seconds = 59;
        minutes--;
      }

      if (minutes < 0) {
        minutes = 59;
        hours--;
      }

      if (hours < 0) {
        hours = 23;
        days--;
      }

      // Stop the countdown when all units reach zero
      if (days <= 0 && hours <= 0 && minutes <= 0 && seconds <= 0) {
        clearInterval(countdownInterval);
        document.querySelector('.timer').innerHTML = '<h2>Countdown Ended!</h2>';
        return;
      }

      // Update the DOM elements
      document.getElementById('days').textContent = days;
      document.getElementById('hours').textContent = hours;
      document.getElementById('minutes').textContent = minutes;
      document.getElementById('seconds').textContent = seconds;
    }

    // Start the countdown
    const countdownInterval = setInterval(updateCountdown, 1000);
  </script>

  <!-- header mega menu  -->
  <script>
    // Added by Jk ... Start 
    document.querySelectorAll('.inner-sub-menu-list').forEach(item => {
    item.addEventListener('mouseenter', function () {
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



    // Added by Jk ... End 

    

  </script>

  <!-- banner counter1 -->
  <script>
    // Set your countdown target date/time here (YYYY-MM-DDTHH:MM:SS)
    const targetDate = new Date("2025-05-01T00:00:00").getTime();
  
    function updateCountdown() {
      const now = new Date().getTime();
      const distance = targetDate - now;
  
      if (distance < 0) {
        document.getElementById("countdown1").innerHTML = "<p>Offer expired!</p>";
        return;
      }
  
      // Time calculations
      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);
  
      // Update HTML
      document.getElementById("days1").innerText = days;
      document.getElementById("hours2").innerText = hours;
      document.getElementById("minutes3").innerText = minutes;
      document.getElementById("seconds4").innerText = seconds;
    }
  
    // Initial call and run every second
    updateCountdown();
    setInterval(updateCountdown, 1000);
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

                document.getElementById('like-' + productId).classList.toggle('active-like-icon');

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

    function refreshWishlistCount() {
    $.ajax({
        url: "{{ route('wishlist.count') }}",
        type: "GET",
        success: function(data) {
            $("#wishlist-count").text(data.count);
        }
    });
}
</script>

<script>
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