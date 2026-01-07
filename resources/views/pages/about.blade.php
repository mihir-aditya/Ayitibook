<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Website Page Title -->
  <title>AyitiBook | About Us</title>

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
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
  <link rel="stylesheet" type="text/css" href="assets/css/footer.css">

 
  
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




<!-- end--=========================== -->



  <div class="page-wrapper">
  <main class="main-wrapper">
    <div class="container">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb py-1">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">About</li>
        </ol>
      </nav>

      <!-- Hero Section -->
      <section class="row align-items-center mb-5">
        <div class="col-md-6">
          <h1 class="about-title mb-4">Our Story</h1>
          <p class="description-text">
            Launched in 2015, exclusive is South Asia's premier online shopping marketplace with an active presence in
            Bangladesh. Supported by wide range of tailored marketing, data and service solutions, exclusive has 10,500+
            sellers and 300 brands and serves 5 millions customers across the region.
          </p>
          <p class="description-text">
            Exclusive has more than 1 Million products to offer, growing at a very fast. Exclusive offers a diverse
            assortment in categories ranging from consumer.
          </p>
        </div>
        <div class="col-md-6">
          <img src="./assets/images/about/Side-Image.png" alt="icon-delivery">
        </div>
      </section>

      <!-- Stats Section -->
      <section class="row g-4 mb-5">
        <div class="col-6 col-md-3">
          <div class="about-services-card card text-center h-100">
            <div class="card-body">
              <div class="about-services">
                <div class="icon-media">
                  <div class="box-bg">

                    <!-- <img src="./assets/images/footer/icon-delivery.png" alt="icon-delivery"> -->
                    <svg width="35" height="32" viewBox="0 0 35 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M31.6416 1H24.9883L25.8216 9.33333C25.8216 9.33333 27.4883 11 29.9883 11C31.3006 11.0017 32.5684 10.524 33.5533 9.65667C33.6574 9.55938 33.735 9.43716 33.7787 9.30156C33.8224 9.16596 33.8309 9.02145 33.8033 8.88167L32.6266 1.83333C32.5873 1.60049 32.4668 1.38909 32.2865 1.23656C32.1062 1.08404 31.8778 1.00024 31.6416 1V1Z"
                        stroke="white" stroke-width="2" />
                      <path
                        d="M24.9883 1L25.8216 9.33333C25.8216 9.33333 24.1549 11 21.6549 11C19.1549 11 17.4883 9.33333 17.4883 9.33333V1H24.9883Z"
                        stroke="#FAFAFA" stroke-width="2" />
                      <path
                        d="M17.4886 1V9.33333C17.4886 9.33333 15.8219 11 13.3219 11C10.8219 11 9.15527 9.33333 9.15527 9.33333L9.98861 1H17.4886Z"
                        stroke="#FAFAFA" stroke-width="2" />
                      <path
                        d="M9.98827 1H3.3366C3.09993 0.999912 2.87089 1.08377 2.69023 1.23666C2.50957 1.38955 2.38899 1.60157 2.34994 1.835L1.17494 8.88333C1.14747 9.02311 1.15601 9.16758 1.19974 9.30315C1.24348 9.43873 1.32097 9.56095 1.42494 9.65833C1.9716 10.1417 3.19327 11.0017 4.98827 11.0017C7.48827 11.0017 9.15494 9.335 9.15494 9.335L9.98827 1.00167V1Z"
                        stroke="#FAFAFA" stroke-width="2" />
                      <path
                        d="M2.5 11V27.6667C2.5 28.5507 2.85119 29.3986 3.47631 30.0237C4.10143 30.6488 4.94928 31 5.83333 31H29.1667C30.0507 31 30.8986 30.6488 31.5237 30.0237C32.1488 29.3986 32.5 28.5507 32.5 27.6667V11"
                        stroke="#FAFAFA" stroke-width="2" />
                      <path
                        d="M22.2217 31.0001V21.0001C22.2217 20.116 21.8705 19.2682 21.2454 18.6431C20.6202 18.0179 19.7724 17.6667 18.8883 17.6667H15.555C14.671 17.6667 13.8231 18.0179 13.198 18.6431C12.5729 19.2682 12.2217 20.116 12.2217 21.0001V31.0001"
                        stroke="#FAFAFA" stroke-width="2" stroke-miterlimit="16" />
                    </svg>

                  </div>
                </div>
                <h6 class="service-title">10.5k</h6>
                <p class="service-desc">Sellers active our site</p>
              </div>
            </div>
          </div>
        </div>



        <div class="col-6 col-md-3">
          <div class="about-services-card card text-center h-100">
            <div class="card-body">
              <div class="about-services">
                <div class="icon-media">
                  <div class="box-bg">
                    <!-- <i class="fas fa-truck"></i>   -->
                    <!-- <img src="./assets/images/footer/icon-delivery.png" alt="icon-delivery"> -->
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M20.0003 37.2728C29.5397 37.2728 37.273 29.5395 37.273 20C37.273 10.4606 29.5397 2.72729 20.0003 2.72729C10.4608 2.72729 2.72754 10.4606 2.72754 20C2.72754 29.5395 10.4608 37.2728 20.0003 37.2728Z"
                        stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                      <path
                        d="M25.0914 14.547C24.762 13.9758 24.2834 13.505 23.707 13.1848C23.1305 12.8646 22.4777 12.7072 21.8186 12.7294H18.1823C17.2178 12.7294 16.2929 13.1124 15.611 13.7941C14.929 14.4759 14.5459 15.4005 14.5459 16.3647C14.5459 17.3288 14.929 18.2535 15.611 18.9353C16.2929 19.617 17.2178 20 18.1823 20H21.8186C22.783 20 23.708 20.383 24.3899 21.0648C25.0719 21.7465 25.455 22.6712 25.455 23.6354C25.455 24.5995 25.0719 25.5242 24.3899 26.2059C23.708 26.8877 22.783 27.2707 21.8186 27.2707H18.1823C17.5232 27.2929 16.8704 27.1354 16.2939 26.8153C15.7174 26.4951 15.2389 26.0242 14.9095 25.453"
                        stroke="black" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round" />
                      <path d="M20 8.18188V12.1213M20 27.8789V31.8182" stroke="black" stroke-width="2.75"
                        stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                  </div>
                </div>
                <h6 class="service-title">33k</h6>
                <p class="service-desc">Monthly Product Sale</p>
              </div>

            </div>
          </div>
        </div>


        <div class="col-6 col-md-3">
          <div class="about-services-card card text-center h-100">
            <div class="card-body">
              <div class="about-services">
                <div class="icon-media">
                  <div class="box-bg">
                    <!-- <i class="fas fa-truck"></i>   -->
                    <!-- <img src="./assets/images/footer/icon-delivery.png" alt="icon-delivery"> -->
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M11.667 11.6667V8.33339C11.667 7.36818 11.9464 6.42362 12.4714 5.6137C12.9965 4.80379 13.7447 4.16315 14.6258 3.76912C15.5069 3.37509 16.4832 3.24451 17.4369 3.39313C18.3906 3.54176 19.2809 3.96325 20.0003 4.60672C20.7197 3.96325 21.61 3.54176 22.5637 3.39313C23.5174 3.24451 24.4937 3.37509 25.3749 3.76912C26.256 4.16315 27.0042 4.80379 27.5292 5.6137C28.0543 6.42362 28.3336 7.36818 28.3337 8.33339V11.6667H30.8337C31.4967 11.6667 32.1326 11.9301 32.6014 12.399C33.0703 12.8678 33.3337 13.5037 33.3337 14.1667V30.8417C33.3337 32.3866 32.72 33.8682 31.6276 34.9606C30.5352 36.053 29.0535 36.6667 27.5087 36.6667H13.3337C11.5655 36.6667 9.86986 35.9643 8.61961 34.7141C7.36937 33.4639 6.66699 31.7682 6.66699 30.0001V14.1667C6.66699 13.5037 6.93038 12.8678 7.39922 12.399C7.86807 11.9301 8.50395 11.6667 9.16699 11.6667H11.667ZM22.7253 34.1667C22.0454 33.1914 21.6818 32.0306 21.6837 30.8417V14.1667H9.16699V30.0001C9.16699 30.5472 9.27477 31.089 9.48416 31.5946C9.69356 32.1001 10.0005 32.5594 10.3874 32.9463C10.7743 33.3332 11.2336 33.6402 11.7391 33.8496C12.2447 34.0589 12.7865 34.1667 13.3337 34.1667H22.7253ZM19.167 11.6667V8.33339C19.167 7.67035 18.9036 7.03446 18.4348 6.56562C17.9659 6.09678 17.33 5.83339 16.667 5.83339C16.004 5.83339 15.3681 6.09678 14.8992 6.56562C14.4304 7.03446 14.167 7.67035 14.167 8.33339V11.6667H19.167ZM21.667 11.6667H25.8337V8.33339C25.8337 7.81878 25.6749 7.31669 25.379 6.89566C25.0832 6.47463 24.6645 6.15517 24.1803 5.98089C23.6961 5.8066 23.1699 5.78599 22.6736 5.92186C22.1773 6.05773 21.7349 6.34346 21.407 6.74005C21.5753 7.24005 21.667 7.77672 21.667 8.33339V11.6667ZM24.1837 30.8417C24.1837 31.7236 24.534 32.5693 25.1575 33.1929C25.7811 33.8164 26.6268 34.1667 27.5087 34.1667C28.3905 34.1667 29.2362 33.8164 29.8598 33.1929C30.4833 32.5693 30.8337 31.7236 30.8337 30.8417V14.1667H24.1837V30.8417Z"
                        fill="#fff" />
                    </svg>

                  </div>
                </div>
                <h6 class="service-title">45.5k</h6>
                <p class="service-desc">Customer active in our site</p>
              </div>

            </div>
          </div>
        </div>


        <div class="col-6 col-md-3">
          <div class="about-services-card card text-center h-100">
            <div class="card-body">
              <div class="about-services">
                <div class="icon-media">
                  <div class="box-bg">
                    <!-- <i class="fas fa-truck"></i>   -->
                    <!-- <img src="./assets/images/footer/icon-delivery.png" alt="icon-delivery"> -->
                    <svg width="31" height="34" viewBox="0 0 31 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M15.9278 15.1455V15.6455L16.4278 15.6455C17.0916 15.6455 17.739 15.8513 18.281 16.2345C18.8229 16.6177 19.2328 17.1595 19.4541 17.7852C19.4727 17.8381 19.4808 17.8941 19.4778 17.95C19.4748 18.0061 19.4608 18.061 19.4366 18.1116C19.4124 18.1622 19.3784 18.2076 19.3367 18.2451C19.295 18.2826 19.2463 18.3116 19.1933 18.3303C19.1404 18.3489 19.0844 18.357 19.0283 18.354C18.9723 18.351 18.9174 18.337 18.8667 18.3128C18.7645 18.264 18.6858 18.1765 18.6481 18.0696L18.648 18.0693C18.4856 17.6103 18.1849 17.2129 17.7873 16.9318C17.3896 16.6508 16.9146 16.4999 16.4277 16.5L15.9278 16.5002V17V20.7091V21.2091H16.4278C17.2789 21.2091 18.0952 21.5472 18.697 22.149C19.2988 22.7508 19.6369 23.5671 19.6369 24.4181C19.6369 25.2692 19.2988 26.0855 18.697 26.6873C18.0952 27.2891 17.2789 27.6272 16.4278 27.6272H15.9278V28.1272V28.5545H15.0733V28.1272V27.6272L14.5733 27.6272C13.9096 27.6272 13.2621 27.4214 12.7202 27.0382C12.1782 26.655 11.7684 26.1132 11.5471 25.4875L11.5472 25.4874L11.5422 25.4743C11.5216 25.421 11.512 25.3641 11.5138 25.307C11.5156 25.2499 11.5289 25.1938 11.5528 25.1419C11.5767 25.09 11.6107 25.0434 11.6529 25.0049C11.6952 24.9664 11.7447 24.9368 11.7985 24.9177C11.8524 24.8987 11.9095 24.8907 11.9665 24.8941C12.0236 24.8975 12.0793 24.9124 12.1305 24.9377C12.1817 24.9631 12.2273 24.9985 12.2646 25.0418C12.3019 25.085 12.3301 25.1354 12.3476 25.1898L12.3499 25.1968L12.3523 25.2038C12.6768 26.1185 13.5484 26.7727 14.5733 26.7727H15.0733V26.2727V22.5636V22.0636H14.5733C13.7222 22.0636 12.906 21.7255 12.3042 21.1237C11.7024 20.5219 11.3643 19.7057 11.3643 18.8546C11.3643 18.0035 11.7024 17.1872 12.3042 16.5854C12.906 15.9836 13.7222 15.6455 14.5733 15.6455H15.0733V15.1455V14.7183H15.9278V15.1455ZM15.0733 17V16.5H14.5733C13.9488 16.5 13.35 16.7481 12.9084 17.1897C12.4668 17.6312 12.2188 18.2301 12.2188 18.8546C12.2188 19.479 12.4668 20.0779 12.9084 20.5195C13.35 20.961 13.9488 21.2091 14.5733 21.2091H15.0733V20.7091V17ZM15.9278 26.2727V26.7727H16.4278C17.0523 26.7727 17.6512 26.5246 18.0927 26.083C18.5343 25.6415 18.7824 25.0426 18.7824 24.4181C18.7824 23.7937 18.5343 23.1948 18.0927 22.7532C17.6512 22.3117 17.0523 22.0636 16.4278 22.0636H15.9278V22.5636V26.2727Z"
                        fill="#FAFAFA" stroke="#FAFAFA" />
                      <path
                        d="M22.7695 9.57708L23.0001 9.82015C24.8981 11.8209 26.4858 14.0947 27.7105 16.5657L27.7115 16.5676C28.9873 19.1702 29.7037 21.8132 29.5867 24.1299L29.5867 24.13C29.4723 26.3911 28.5716 28.3571 26.5218 29.8058L26.5218 29.8059C24.4129 31.2959 20.9467 32.3334 15.5354 32.3334C10.1198 32.3334 6.63966 31.314 4.51316 29.842L4.51293 29.8419C2.44943 28.4118 1.53763 26.4719 1.41014 24.2372L22.7695 9.57708ZM22.7695 9.57708L22.457 9.69792M22.7695 9.57708L22.457 9.69792M22.457 9.69792C18.1083 11.3796 12.8707 11.3796 8.5219 9.69971L8.34173 10.1661L7.97519 9.82605C6.15729 11.7855 4.46566 14.1896 3.25095 16.6927L3.25091 16.6928M22.457 9.69792L3.25091 16.6928M3.25091 16.6928C1.98037 19.3122 1.2784 21.9431 1.41013 24.237L3.25091 16.6928ZM25.3428 3.18126C25.7832 3.39911 26.1642 3.60747 26.4775 3.79415L23.3457 8.37238L23.114 8.71101L23.4009 9.00431C25.3394 10.986 27.1697 13.5162 28.4805 16.1918C29.7935 18.872 30.5679 21.6623 30.441 24.1734C30.3151 26.6636 29.3054 28.8861 27.0163 30.5034C24.7051 32.1362 21.0382 33.188 15.5364 33.188C10.0332 33.188 6.35436 32.155 4.02802 30.544C1.72448 28.9488 0.699103 26.7542 0.558033 24.2855C0.415712 21.795 1.17576 19.0151 2.48354 16.32C3.7889 13.6298 5.62285 11.0597 7.58124 8.99914L7.85891 8.70699L7.63235 8.37363L4.52247 3.79779C4.67984 3.70509 4.8536 3.60734 5.04301 3.50644L5.04302 3.50644L5.04474 3.50552C5.23531 3.40304 5.44085 3.29755 5.66136 3.19001L5.85726 3.09446C8.10344 2.02389 11.6645 0.809326 15.5364 0.809326C19.4385 0.809326 22.9975 2.04271 25.2165 3.11993L25.3412 3.18044C25.3417 3.18072 25.3423 3.18099 25.3428 3.18126ZM24.7117 4.86165L25.2968 4.00623L24.2631 4.08066C21.6696 4.26739 18.6003 4.87467 15.6554 5.72728C13.6714 6.30043 11.4387 6.21917 9.33386 5.83094C8.80462 5.73281 8.27901 5.61601 7.75803 5.48074L6.47261 5.147L7.21875 6.24561L8.99909 8.86698L9.09097 9.00226L9.24502 9.0571C13.1692 10.4542 17.7996 10.4541 21.7245 9.05904L21.5571 8.58792L21.9698 8.87021L24.7117 4.86165ZM9.48767 4.99034L9.48813 4.99042C11.523 5.36523 13.6079 5.42967 15.4168 4.9057L15.4175 4.90549C17.3859 4.33204 19.388 3.88104 21.4122 3.55508L21.4768 2.58267C19.7353 2.05833 17.6905 1.66385 15.5354 1.66385C12.2536 1.66385 9.20629 2.57774 7.08002 3.48023L7.27538 3.94048L7.1328 4.41973C7.88966 4.64489 8.68211 4.8412 9.48767 4.99034Z"
                        fill="#FAFAFA" stroke="#FAFAFA" />
                    </svg>



                  </div>
                </div>
                <h6 class="service-title">25k</h6>
                <p class="service-desc">Annual gross sale in our site</p>
              </div>

            </div>
          </div>
        </div>
      </section>

      <!-- team section -->
      <div class="row">

        <div class="col-lg-3 col-md-6">
            <div class="team-9">
                <div class="team-img">
                    <img src="https://1.bp.blogspot.com/-8c7QTLoyajs/YLjr2V6KYRI/AAAAAAAACO8/ViVPQpLWVM0jGh3RZhh-Ha1-1r3Oj62wQCNcBGAsYHQ/s16000/team-1-3.jpg" alt="Team Image">
                </div>
                <div class="team-content">
                    <h2>Josh Dunn</h2>
                    <h3>CEO &amp; Founder</h3>
                </div>
                <div class="team-overlay">
                    <p>Some text goes here that describes about team member</p>
                    <div class="team-social">
                        <a class="social-tw" href=""><i class="fab fa-twitter"></i></a>
                        <a class="social-fb" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="social-li" href=""><i class="fab fa-linkedin-in"></i></a>
                        <a class="social-in" href=""><i class="fab fa-instagram"></i></a>
                        <a class="social-yt" href=""><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="team-9">
                <div class="team-img">
                    <img src="https://1.bp.blogspot.com/-vhmWFWO2r8U/YLjr2A57toI/AAAAAAAACO4/0GBonlEZPmAiQW4uvkCTm5LvlJVd_-l_wCNcBGAsYHQ/s16000/team-1-2.jpg" alt="Team Image">
                </div>
                <div class="team-content">
                    <h2>Mollie Ross</h2>
                    <h3>Art Director</h3>
                </div>
                <div class="team-overlay">
                    <p>Some text goes here that describes about team member</p>
                    <div class="team-social">
                        <a class="social-tw" href=""><i class="fab fa-twitter"></i></a>
                        <a class="social-fb" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="social-li" href=""><i class="fab fa-linkedin-in"></i></a>
                        <a class="social-in" href=""><i class="fab fa-instagram"></i></a>
                        <a class="social-yt" href=""><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="team-9">
                <div class="team-img">
                    <img src="https://1.bp.blogspot.com/-o0FrH2W7UoQ/YLjr2H_R7vI/AAAAAAAACO0/OCC2qfWChJoJVl4nr6YZvyGPwo2Hc43DQCNcBGAsYHQ/s16000/team-1-1.jpg" alt="Team Image">
                </div>
                <div class="team-content">
                    <h2>Dylan Adams</h2>
                    <h3>Developer</h3>
                </div>
                <div class="team-overlay">
                    <p>Some text goes here that describes about team member</p>
                    <div class="team-social">
                        <a class="social-tw" href=""><i class="fab fa-twitter"></i></a>
                        <a class="social-fb" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="social-li" href=""><i class="fab fa-linkedin-in"></i></a>
                        <a class="social-in" href=""><i class="fab fa-instagram"></i></a>
                        <a class="social-yt" href=""><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="team-9">
                <div class="team-img">
                    <img src="https://1.bp.blogspot.com/-AO5j2Y9lzME/YLjr3mxiqAI/AAAAAAAACPE/KAaYYTtQTrgBE3diTbxGoc4U4fCGx-C2gCNcBGAsYHQ/s16000/team-1-4.jpg" alt="Team Image">
                </div>
                <div class="team-content">
                    <h2>Jennifer Page</h2>
                    <h3>Designer</h3>
                </div>
                <div class="team-overlay">
                    <p>Some text goes here that describes about team member</p>
                    <div class="team-social">
                        <a class="social-tw" href=""><i class="fab fa-twitter"></i></a>
                        <a class="social-fb" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="social-li" href=""><i class="fab fa-linkedin-in"></i></a>
                        <a class="social-in" href=""><i class="fab fa-instagram"></i></a>
                        <a class="social-yt" href=""><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div> 
      <!-- end -->

      <!-- our-services -->
      <section class="our-services section-gap pt-0">
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
                    <p class="service-service-desc">We reurn money within 30 days</p>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </section>

    </div>
  </main>
</div>
  <!-- Site Footer -->
   @include('components.footer')

 


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/js/custom-swiper.js"></script>
  <script src="assets/js/main.js"></script>
    <!-- mobile js -->
  <script src="assets/js/mobile.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>



    <script>
        const menu = document.querySelector(".menu");
        const menuMain = menu.querySelector(".menu-main");
        const goBack = menu.querySelector(".go-back");
        const menuTrigger = document.querySelector(".mobile-menu-trigger");
        const closeMenu = menu.querySelector(".mobile-menu-close");
        let subMenu;
        menuMain.addEventListener("click", (e) => {
          if (!menu.classList.contains("active")) {
            return;
          }
          if (e.target.closest(".menu-item-has-children")) {
            const hasChildren = e.target.closest(".menu-item-has-children");
            showSubMenu(hasChildren);
          }
        });
        goBack.addEventListener("click", () => {
          hideSubMenu();
        })
        menuTrigger.addEventListener("click", () => {
          toggleMenu();
        })
        closeMenu.addEventListener("click", () => {
          toggleMenu();
        })
        document.querySelector(".menu-overlay").addEventListener("click", () => {
          toggleMenu();
        })
        function toggleMenu() {
          menu.classList.toggle("active");
          document.querySelector(".menu-overlay").classList.toggle("active");
        }
        function showSubMenu(hasChildren) {
          subMenu = hasChildren.querySelector(".sub-menu");
          subMenu.classList.add("active");
          subMenu.style.animation = "slideLeft 0.5s ease forwards";
          const menuTitle = hasChildren.querySelector("i").parentNode.childNodes[0].textContent;
          menu.querySelector(".current-menu-title").innerHTML = menuTitle;
          menu.querySelector(".mobile-menu-head").classList.add("active");
        }
    
        function hideSubMenu() {
          subMenu.style.animation = "slideRight 0.5s ease forwards";
          setTimeout(() => {
            subMenu.classList.remove("active");
          }, 300);
          menu.querySelector(".current-menu-title").innerHTML = "";
          menu.querySelector(".mobile-menu-head").classList.remove("active");
        }
    
        window.onresize = function () {
          if (this.innerWidth > 991) {
            if (menu.classList.contains("active")) {
              toggleMenu();
            }
    
          }
        }
    
    
      </script>
</body>

</html>