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
  <div class="top-bar bg-dark d-none d-lg-block">
    <div class="container py-0">
      <div class="row align-items-center">
        <div class="col-md-3">
          <div class="shape-left">

            <div class="location ">
              <i class="fas fa-map-marker-alt me-1"></i> Update Location
              <p class="mb-1">New Delhi, India</p>
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="d-flex align-items-center justify-content-between ">
            <div class="">
              <p class="text-white mb-0 d-inline">Summer Sale For All Swim Suits And Free
                Express Delivery -
                OFF 50%!</p>
              <a href="javascript:void(0);" class="btn-link top-header-link font-14 fw-medium">ShopNow</a>
            </div>

            <div class="d-flex align-items-center">
              <select class="form-select custom-select" aria-label="Default select example">
                <option selected>English</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>

              <select class="form-select custom-select" aria-label="Default select example">
                <option selected>India</i></option>
                <option value="1">United States</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- large size header -->
  <header class="">
    <div class="d-flex align-items-center justify-content-between header-large">
      <div class="website-logo">
        <a href="index.html"><img src="assets/images/logo/logo.svg" alt="AyitiBook Logo"></a>
      </div>
      <nav>
        <label for="drop" class="toggle">&#8801; </label>
        <input type="checkbox" id="drop" />
        <ul class="menu">
          <li class="nav-menu"><a href="index.html">Home</a></li>
          <li class="nav-menu"><a href="about.html">about us</a></li>

          <!-- Code By JK  --> 
           <!-- Added id = categoryLink  -->
          <li class="nav-menu" id="categoryLink"> 
            <label for="drop-2" class="toggle">Category ▾</label>
            <a href="#">Category</a>
            <input type="checkbox" id="drop-2" />
            <!-- <ul class="sub-dropdown">
              <li class="nav-menu"><a href="#">Home, Kitchen</a></li>
              <li class="nav-menu"><a href="#">Furniture</a></li>
              <li class="nav-menu">
                <label for="drop-3" class="toggle">Women's Fashion</label>
                <a href="#">Women's Fashion</a>
                <input type="checkbox" id="drop-3" />
                <ul class="nested-menu">
                  <li class="nav-menu"><a href="#">Sarees</a></li>
                  <li class="nav-menu"><a href="#">Sandals</a></li>
                  <li class="nav-menu"><a href="#">Watchs</a></li>
                </ul>
              </li>
              <li class="nav-menu">

             
                <label for="drop-3" class="toggle">Men's Fashion</label>
                <a href="#">Men's Fashion</a>
                <input type="checkbox" id="drop-3" />
                <ul class="nested-menu">
                  <li class="nav-menu"><a href="#">T-Shirts</a></li>
                  <li class="nav-menu"><a href="#">Jeans</a></li>
                  <li class="nav-menu"><a href="#">Kurta</a></li>
                </ul>
              </li>
            </ul> -->
         
            
         
          </li>


          <li class="nav-menu">
            <!-- First Tier Drop Down -->
            <label for="drop-1" class="toggle">Pages</label>
            <a href="#">Pages</a>
            <input type="checkbox" id="drop-1" />
            <ul class="sub-dropdown">
              <li class="nav-menu"><a href="#">Login</a></li>
              <li class="nav-menu"><a href="#">privacy-policy</a></li>
              <li class="nav-menu"><a href="#">Term & condition</a></li>
            </ul>
          </li>

          <li class="nav-menu"><a href="contact.html">Contact</a></li>
        </ul>
      </nav>
      <div class="header-item item-right hide-element">
        <div class="search-bar">
          <input type="text" placeholder="What are you looking for?">
          <a href="search-product.html">
            <button class="search-icon">
              <i class="fas fa-search"></i>
            </button>
          </a>

        </div>

        <a href="wishlist.html" class="icon-tag position-relative">
          <img src="./assets/images/Wishlist.png" alt="Wishlist-img" class="">
          <span class="wishlist-count">1</span>
        </a>
        <a href="cart-page.html" class="icon-tag  position-relative">
          <img src="./assets/images/buy-icon.png" alt="buy-icon">
          <span class="shop-cart-count">2</span>
        </a>
        <a href="cart-page.html" class="icon-tag wallet-bx position-relative">
          <img src="./assets/images/wallet.png" alt="buy-icon" style="width:25px;">
          <span class="save-price">20$</span>
        </a>
        <li class="dropdown ml-2">
          <a class="rounded-circle " href="#" role="button" id="dropdownUser" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <div class="avatar avatar-md avatar-indicators avatar-online">
              <i class='bx bx-user'></i>
            </div>
          </a>
          <div class="profile-dropdown dropdown-menu pb-2" aria-labelledby="dropdownUser">
            <div class="">
              <ul class="list-unstyled">
                <li class="dropdown-submenu dropright-lg">
                  <a class="dropdown-item dropdown-list-group-item" href="my-account.html">
                    <!-- <i class="bx bx-user mr-2"></i>-->
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"
                      class="svg-icon">
                      <path
                        d="M24 27V24.3333C24 22.9188 23.5224 21.5623 22.6722 20.5621C21.8221 19.5619 20.669 19 19.4667 19H11.5333C10.331 19 9.17795 19.5619 8.32778 20.5621C7.47762 21.5623 7 22.9188 7 24.3333V27"
                        stroke="#FAFAFA" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                      <path
                        d="M16.5 14C18.9853 14 21 11.9853 21 9.5C21 7.01472 18.9853 5 16.5 5C14.0147 5 12 7.01472 12 9.5C12 11.9853 14.0147 14 16.5 14Z"
                        stroke="#FAFAFA" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Manage My Account
                  </a>
                </li>
                <li class="dropdown-submenu">
                  <a class="dropdown-item" href="@@webRoot/pages/profile-edit.html">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M3 6.30005V20.5C3 20.7653 3.10536 21.0196 3.29289 21.2072C3.48043 21.3947 3.73478 21.5 4 21.5H20C20.2652 21.5 20.5196 21.3947 20.7071 21.2072C20.8946 21.0196 21 20.7653 21 20.5V6.30005H3Z"
                        stroke="#FAFAFA" stroke-width="1.5" stroke-linejoin="round" />
                      <path
                        d="M21 6.3L18.1665 2.5H5.8335L3 6.3M15.7775 9.6C15.7775 11.699 14.0865 13.4 12 13.4C9.9135 13.4 8.222 11.699 8.222 9.6"
                        stroke="#FAFAFA" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    My Order
                  </a>
                </li>
                <li class="dropdown-submenu">
                  <a class="dropdown-item" href="@@webRoot/pages/student-subscriptions.html">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g clip-path="url(#clip0_1696_3552)">
                        <path d="M8 16L12 12M16 8L11.9992 12M11.9992 12L8 8M12 12L16 16" stroke="#FAFAFA"
                          stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <circle cx="12" cy="12" r="11.25" stroke="white" stroke-width="1.5" />
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
                  <a class="dropdown-item" href="@@webRoot/pages/student-subscriptions.html">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M15 0H5C2.24 0 0 2.23 0 4.98V11.96C0 14.71 2.24 16.94 5 16.94H6.5C6.77 16.94 7.13 17.12 7.3 17.34L8.8 19.33C9.46 20.21 10.54 20.21 11.2 19.33L12.7 17.34C12.89 17.09 13.19 16.94 13.5 16.94H15C17.76 16.94 20 14.71 20 11.96V4.98C20 2.23 17.76 0 15 0ZM6 10C5.44 10 5 9.55 5 9C5 8.45 5.45 8 6 8C6.55 8 7 8.45 7 9C7 9.55 6.56 10 6 10ZM10 10C9.44 10 9 9.55 9 9C9 8.45 9.45 8 10 8C10.55 8 11 8.45 11 9C11 9.55 10.56 10 10 10ZM14 10C13.44 10 13 9.55 13 9C13 8.45 13.45 8 14 8C14.55 8 15 8.45 15 9C15 9.55 14.56 10 14 10Z"
                        fill="white" />
                    </svg>

                    My Messages
                  </a>
                </li>
              </ul>
            </div>
            <ul class="list-unstyled">
              <li>
                <a class="dropdown-item" href="/logout">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M4 12H13.5M6 15L3 12L6 9M11 7V6C11 5.46957 11.2107 4.96086 11.5858 4.58579C11.9609 4.21071 12.4696 4 13 4H18C18.5304 4 19.0391 4.21071 19.4142 4.58579C19.7893 4.96086 20 5.46957 20 6V18C20 18.5304 19.7893 19.0391 19.4142 19.4142C19.0391 19.7893 18.5304 20 18 20H13C12.4696 20 11.9609 19.7893 11.5858 19.4142C11.2107 19.0391 11 18.5304 11 18V17"
                      stroke="#FAFAFA" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>

                  Sign Out
                </a>
              </li>
            </ul>
          </div>
        </li>

      </div>
    </div>

  </header>

  <div style="display: none;" id="megamenu" class="container py-3"> <!-- Code by JK -->
    <div class="category-list">

      <ul class="parent-menu-list">
        <li class="parent-menu">
          <a href="" class="main-link">
            fashion
          </a>
          <ul class="inner-menu">
            <li class="inner-sub-menu-list">
              <a href="" class="item-link ">Men's Top wear </a>
                <ul class="inner-sub-menu">
                  <li>
                  <a href="#">Men's T-shirt</a>
                  </li>
                  <li>
                  <a href="#">Men's Shirts </a>
                  </li>
                  <li>
                  <a href="#">Men's Sweatshirts</a>
                  </li>
                  <li>
                  <a href="#">Men's Jackets</a>
                  </li>
                </ul>
            </li>

            <li class="inner-sub-menu-list">
              <a href="" class="item-link">Men's Bottomwear Wear</a>

              <ul class="inner-sub-menu">
                <li>
                <a href="#">Men's Jeans</a>
                </li>
                <li>
                <a href="#">Men's  Trousers</a>
                </li>
                <li>
                <a href="#">Men's Trousers </a>
                </li>
                <li>
                <a href="#">Men's formal pents</a>
                </li>
              </ul>

            </li>

            <li class="inner-sub-menu-list">
              <a href="" class="item-link">women's Ethnic Wear</a>
              <ul class="inner-sub-menu">
                <li>
                <a href="#">women's Sarees</a>
                </li>
                <li>
                <a href="#">women's Kurtas </a>
                </li>
                <li>
                <a href="#">women's Lehengas</a>
                </li>
              </ul>
            </li>
            <li class="inner-sub-menu-list">
              <a href="" class="item-link">women's Western Wear</a>

              <ul class="inner-sub-menu">
                <li>
                <a href="#">women's Tops</a>
                </li>
                <li>
                <a href="#">women's Dresses </a>
                </li>
                <li>
                <a href="#">women's Skirts</a>
                </li>
              </ul>

            </li>

            <li class="inner-sub-menu-list">
              <a href="" class="item-link">women's footwear</a>

              <ul class="inner-sub-menu">
                <li>
                <a href="#">women's Flats</a>
                </li>
                <li>
                <a href="#">women's heels </a>
                </li>
                <li>
                <a href="#">women's Slippers</a>
                </li>
                <li>
                  <a href="#">women's Sneakers</a>
                  </li>
                  <li>
                    <a href="#">women's Flip-Flops</a>
                    </li>
              </ul>

            </li>
          </ul>
        </li>

      
        <li class="parent-menu">
          <a href="" class="main-link">
            Electronics 
          </a>
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
          <a href="" class="main-link">
            Home & Kitchen Category
          </a>
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
          <a href="" class="main-link">
            Beauty & Personal Care
          </a>
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
          <a href="" class="main-link">
            Sports & Fitness
          </a>
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

  <!-- sm/md header -->
  <div class="mobile-menu">
    <!-- Hamburger Icon -->
    <div class="menu-toggle" onclick="toggleSidebar()">
      ☰
    </div>

    <!--small /medium size Sidebar -->
    <div class="sidebar" id="sidebar">
      <div class="close-btn" onclick="toggleSidebar()">×</div>
      <ul class="menu">
        <li>
          <a href="#">Home</a>
        </li>
        <li class="submenu-parent">
          <a href="javascript:void(0)" onclick="toggleSubmenu(this)">About</a>
        </li>
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
          <a href="javascript:void(0)" onclick="toggleSubmenu(this)">Pages </a>
          <ul class="submenu">
            <li><a href="#">Login </a></li>
            <li><a href="#">privacy-policy</a></li>
            <li><a href="#">Terms & Condition</a></li>
          </ul>
        </li>
        <li>
          <a href="#">Contact</a>
        </li>
      </ul>
    </div>
  </div>
  <!-- end--=========================== -->


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
              <div class="swiper-slide">
                <div class="latest-sale-box mb-4">
                  <div class="media-box ">
                    <div class="product-img">
                      <a href="product-detail.html">
                        <img src="./assets/images/poducts/product1.png" alt="img1">
                      </a>

                      <div class="hover-btn">
                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                        <a href="cart-page.html" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>
                    <span class="badge style1 badge-primary">
                      - 40%
                    </span>
                    <div class="product-icon-div">
                      <ul class="ps-0">
                        <li class="like-icon">
                          <a href="" class=""><i class="far fa-heart"></i></a>
                        </li>
                        <li class="view-icon">
                          <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">
                    <h6 class="title">
                      <a href="product-detail.html"> HAVIT HV-G92 Gamepad</a>
                    </h6>
                    <div class="meta-div">
                      <span class="text1 text-danger">$120</span>
                      <p class="text1 text-muted  "><strike>$160</strike></p>
                      <p class="text3 text-success">(120 Stocks)</p>
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

              <div class="swiper-slide">
                <div class="latest-sale-box mb-4">
                  <div class="media-box">
                    <div class="product-img">
                      <a href="product-detail.html">
                        <img src="./assets/images/poducts/product2.png" alt="img2">
                      </a>
                      <div class="hover-btn">
                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                        <a href="cart-page.html" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>
                    <span class="badge style1 badge-primary">
                      - 40%
                    </span>
                    <div class="product-icon-div">
                      <ul class="ps-0">
                        <li class="like-icon">
                          <a href="" class=""><i class="far fa-heart"></i></a>
                        </li>
                        <li class="view-icon">
                          <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">
                    <h6 class="title">
                      <a href="product-detail.html"> AK-900 Wired Keyboard</a>
                    </h6>
                    <div class="meta-div">
                      <span class="text1 text-danger">$960</span>
                      <p class="text1 text-muted "><strike>$1160</strike></p>

                    </div>
                    <div class="bottom-box d-flex align-items-center">
                      <div class="d-flex align-items-center rating-icon">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star text-muted-light"></i>
                      </div>
                      <p class="rating-num mb-0"> (75)</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="swiper-slide">
                <div class="latest-sale-box mb-4">
                  <div class="media-box">
                    <div class="product-img">
                      <a href="product-detail.html">
                        <img src="./assets/images/poducts/product3.png" alt="img3">
                      </a>
                      <div class="hover-btn">
                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                        <a href="cart-page.html" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>
                    <span class="badge style1 badge-primary">
                      - 40%
                    </span>
                    <div class="product-icon-div">
                      <ul class="ps-0">
                        <li class="like-icon">
                          <a href="" class=""><i class="far fa-heart"></i></a>
                        </li>
                        <li class="view-icon">
                          <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">
                    <h6 class="title">
                      <a href="product-detail.html">IPS LCD Gaming Monitor</a>
                    </h6>
                    <div class="meta-div">
                      <span class="text1 text-danger">$370</span>
                      <p class="text1 text-muted "><strike>$400</strike></p>
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

              <div class="swiper-slide">
                <div class="latest-sale-box mb-4">
                  <div class="media-box">
                    <div class="product-img">
                      <a href="product-detail.html">
                        <img src="./assets/images/poducts/product4.png" alt="img4">
                      </a>
                      <div class="hover-btn">
                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                        <a href="cart-page.html" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>
                    <span class="badge style1 badge-primary">
                      - 40%
                    </span>
                    <div class="product-icon-div">
                      <ul class="ps-0">
                        <li class="like-icon">
                          <a href="" class=""><i class="far fa-heart"></i></a>
                        </li>
                        <li class="view-icon">
                          <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">
                    <h6 class="title">
                      <a href="product-detail.html">S-Series Comfort Chair</a>
                    </h6>
                    <div class="meta-div">
                      <span class="text1 text-danger">$375</span>
                      <p class="text1 text-muted "><strike>$400</strike></p>

                    </div>
                    <div class="bottom-box d-flex align-items-center">
                      <div class="d-flex align-items-center rating-icon">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                      <p class="rating-num mb-0"> (99)</p>

                    </div>
                  </div>
                </div>
              </div>



              <div class="swiper-slide">
                <div class="latest-sale-box mb-4">
                  <div class="media-box">
                    <div class="product-img">
                      <a href="product-detail.html">
                        <img src="./assets/images/poducts/product1.png" alt="img1">
                      </a>
                      <div class="hover-btn">
                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                        <a href="cart-page.html" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>
                    <span class="badge style1 badge-primary">
                      - 40%
                    </span>
                    <div class="product-icon-div">
                      <ul class="ps-0">
                        <li class="like-icon">
                          <a href="" class=""><i class="far fa-heart"></i></a>
                        </li>
                        <li class="view-icon">
                          <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">
                    <h6 class="title">
                      <a href="product-detail.html"> HAVIT HV-G92 Gamepad</a>
                    </h6>
                    <div class="meta-div">
                      <span class="text1 text-danger">$120</span>
                      <p class="text1 text-secondary ">$160</p>
                      <p class="text3 text-success">(120 Stocks)</p>
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

              <div class="swiper-slide">
                <div class="latest-sale-box mb-4">
                  <div class="media-box">
                    <div class="product-img">
                      <a href="product-detail.html">
                        <img src="./assets/images/poducts/product2.png" alt="img2">
                      </a>
                      <div class="hover-btn">
                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                        <a href="cart-page.html" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>
                    <span class="badge style1 badge-primary">
                      - 40%
                    </span>
                    <div class="product-icon-div">
                      <ul class="ps-0">
                        <li class="like-icon">
                          <a href="" class=""><i class="far fa-heart"></i></a>
                        </li>
                        <li class="view-icon">
                          <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">
                    <h6 class="title">
                      <a href="product-detail.html"> AK-900 Wired Keyboard</a>
                    </h6>
                    <div class="meta-div">
                      <span class="text1 text-danger">$960</span>
                      <p class="text1 text-muted "><strike>$1160</strike></p>

                    </div>
                    <div class="bottom-box d-flex align-items-center">
                      <div class="d-flex align-items-center rating-icon">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                      <p class="rating-num mb-0"> (75)</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="swiper-slide">
                <div class="latest-sale-box mb-4">
                  <div class="media-box">
                    <div class="product-img">
                      <a href="product-detail.html">
                        <img src="./assets/images/poducts/product3.png" alt="img3">
                      </a>
                      <div class="hover-btn">
                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                        <a href="cart-page.html" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>
                    <span class="badge style1 badge-primary">
                      - 40%
                    </span>
                    <div class="product-icon-div">
                      <ul class="ps-0">
                        <li class="like-icon">
                          <a href="" class=""><i class="far fa-heart"></i></a>
                        </li>
                        <li class="view-icon">
                          <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">
                    <h6 class="title">
                      <a href="product-detail.html">IPS LCD Gaming Monitor</a>
                    </h6>
                    <div class="meta-div">
                      <span class="text1 text-danger">$370</span>
                      <p class="text1 text-muted "><strike>$400</strike></p>
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

              <div class="swiper-slide">
                <div class="latest-sale-box mb-4">
                  <div class="media-box">
                    <div class="product-img">
                      <a href="product-detail.html">
                        <img src="./assets/images/poducts/product1.png" alt="img1">
                      </a>
                      <div class="hover-btn">
                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                        <a href="cart-page.html" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>
                    <span class="badge style1 badge-primary">
                      - 40%
                    </span>
                    <div class="product-icon-div">
                      <ul class="ps-0">
                        <li class="like-icon">
                          <a href="" class=""><i class="far fa-heart"></i></a>
                        </li>
                        <li class="view-icon">
                          <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">
                    <h6 class="title">
                      <a href="product-detail.html"> S-Series Comfort Chair </a>
                    </h6>
                    <div class="meta-div">
                      <span class="text1 text-danger">$375</span>
                      <p class="text1 text-muted "><strike>$400</strike></p>

                    </div>
                    <div class="bottom-box d-flex align-items-center">
                      <div class="d-flex align-items-center rating-icon">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                      <p class="rating-num mb-0"> (99)</p>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center btn-gap">
            <a href="all-product.html" class="btn btn-secondary rounded">View all Product</a>
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
            <a href="all-product.html" class="btn btn-secondary">View All</a>
          </div>
          <!-- Swiper -->
          <div class="swiper product-sale section-inner-gap">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <div class="latest-sale-box mb-4">
                  <div class="media-box">
                    <div class="product-img">
                      <a href="product-detail.html">
                        <img src="./assets/images/poducts/new-product1.png" alt="new-product1">
                      </a>
                      <div class="hover-btn">
                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                        <a href="cart-page.html" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>
                    <span class="badge style1 badge-primary">
                      - 40%
                    </span>
                    <div class="product-icon-div">
                      <ul class="ps-0">
                        <li class="like-icon">
                          <a href="" class=""><i class="far fa-heart"></i></a>
                        </li>
                        <li class="view-icon">
                          <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">
                    <h6 class="title">
                      <a href="product-detail.html"> HAVIT HV-G92 Gamepad</a>
                    </h6>
                    <div class="meta-div">
                      <span class="text1 text-danger">$120</span>
                      <p class="text1 text-secondary ">$160</p>
                      <p class="text3 text-success">(120 Stocks)</p>
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

              <div class="swiper-slide">
                <div class="latest-sale-box mb-4">
                  <div class="media-box">
                    <div class="product-img">
                      <a href="product-detail.html">
                        <img src="./assets/images/poducts/new-product2.png" alt="new-product2">
                      </a>
                      <div class="hover-btn">
                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                        <a href="cart-page.html" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>
                    <span class="badge style1 badge-primary">
                      - 40%
                    </span>
                    <div class="product-icon-div">
                      <ul class="ps-0">
                        <li class="like-icon">
                          <a href="" class=""><i class="far fa-heart"></i></a>
                        </li>
                        <li class="view-icon">
                          <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">
                    <h6 class="title">
                      <a href="product-detail.html"> HAVIT HV-G92 Gamepad</a>
                    </h6>
                    <div class="meta-div">
                      <span class="text1 text-danger">$120</span>
                      <p class="text1 text-secondary ">$160</p>
                      <p class="text3 text-success">(120 Stocks)</p>
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

              <div class="swiper-slide">
                <div class="latest-sale-box mb-4">
                  <div class="media-box">
                    <div class="product-img">

                      <a href="product-detail.html">
                        <img src="./assets/images/poducts/new-product3.png" alt="new-product3">
                      </a>
                      <div class="hover-btn">
                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                        <a href="cart-page.html" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>
                    <span class="badge style1 badge-primary">
                      - 40%
                    </span>
                    <div class="product-icon-div">
                      <ul class="ps-0">
                        <li class="like-icon">
                          <a href="" class=""><i class="far fa-heart"></i></a>
                        </li>
                        <li class="view-icon">
                          <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">
                    <h6 class="title"><a href="product-detail.html">HAVIT HV-G92 Gamepad</a>
                    </h6>
                    <div class="meta-div">
                      <span class="text1 text-danger">$120</span>
                      <p class="text1 text-secondary ">$160</p>
                      <p class="text3 text-success">(120 Stocks)</p>
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

              <div class="swiper-slide">
                <div class="latest-sale-box mb-4">
                  <div class="media-box">
                    <div class="product-img">

                      <a href="product-detail.html">
                        <img src="./assets/images/poducts/new-product4.png" alt="new-product4">
                      </a>
                      <div class="hover-btn">
                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                        <a href="cart-page.html" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>
                    <span class="badge style1 badge-primary">
                      - 40%
                    </span>
                    <div class="product-icon-div">
                      <ul class="ps-0">
                        <li class="like-icon">
                          <a href="" class=""><i class="far fa-heart"></i></a>
                        </li>
                        <li class="view-icon">
                          <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">
                    <h6 class="title"><a href="product-detail.html">HAVIT HV-G92 Gamepad</a>
                    </h6>
                    <div class="meta-div">
                      <span class="text1 text-danger">$120</span>
                      <p class="text1 text-secondary ">$160</p>
                      <p class="text3 text-success">(120 Stocks)</p>
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
              <div class="swiper-slide">
                <div class="latest-sale-box mb-4">
                  <div class="media-box">
                    <div class="product-img">
                      <a href="product-detail.html">
                        <img src="./assets/images/poducts/new-product1.png" alt="new-product1">
                      </a>
                      <div class="hover-btn">
                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                        <a href="cart-page.html" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>
                    <span class="badge style1 badge-primary">
                      - 40%
                    </span>
                    <div class="product-icon-div">
                      <ul class="ps-0">
                        <li class="like-icon">
                          <a href="" class=""><i class="far fa-heart"></i></a>
                        </li>
                        <li class="view-icon">
                          <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">
                    <h6 class="title"><a href="product-detail.html">HAVIT HV-G92 Gamepad</a>
                      <div class="meta-div">
                        <span class="text1 text-danger">$120</span>
                        <p class="text1 text-secondary ">$160</p>
                        <p class="text3 text-success">(120 Stocks)</p>
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
              <div class="swiper-slide">
                <div class="latest-sale-box mb-4">
                  <div class="media-box">
                    <div class="product-img">
                      <a href="product-detail.html">
                        <img src="./assets/images/poducts/new-product2.png" alt="new-product2">
                      </a>
                      <div class="hover-btn">
                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                        <a href="cart-page.html" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>
                    <span class="badge style1 badge-primary">
                      - 40%
                    </span>
                    <div class="product-icon-div">
                      <ul class="ps-0">
                        <li class="like-icon">
                          <a href="" class=""><i class="far fa-heart"></i></a>
                        </li>
                        <li class="view-icon">
                          <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">
                    <h6 class="title"><a href="product-detail.html">HAVIT HV-G92 Gamepad</a>
                      <div class="meta-div">
                        <span class="text1 text-danger">$120</span>
                        <p class="text1 text-secondary ">$160</p>
                        <p class="text3 text-success">(120 Stocks)</p>
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
              <div class="swiper-slide">
                <div class="latest-sale-box mb-4">
                  <div class="media-box">
                    <div class="product-img">

                      <a href="product-detail.html">
                        <img src="./assets/images/poducts/new-product3.png" alt="new-product3">
                      </a>
                      <div class="hover-btn">
                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                        <a href="cart-page.html" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>
                    <span class="badge style1 badge-primary">
                      - 40%
                    </span>
                    <div class="product-icon-div">
                      <ul class="ps-0">
                        <li class="like-icon">
                          <a href="" class=""><i class="far fa-heart"></i></a>
                        </li>
                        <li class="view-icon">
                          <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">
                    <h6 class="title"><a href="product-detail.html">HAVIT HV-G92 Gamepad</a>
                      <div class="meta-div">
                        <span class="text1 text-danger">$120</span>
                        <p class="text1 text-secondary ">$160</p>
                        <p class="text3 text-success">(120 Stocks)</p>
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
              <div class="swiper-slide">
                <div class="latest-sale-box mb-4">
                  <div class="media-box">
                    <div class="product-img">

                      <a href="product-detail.html">
                        <img src="./assets/images/poducts/new-product4.png" alt="new-product4">
                      </a>
                      <div class="hover-btn">
                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                        <a href="cart-page.html" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>
                    <span class="badge style1 badge-primary">
                      - 40%
                    </span>
                    <div class="product-icon-div">
                      <ul class="ps-0">
                        <li class="like-icon">
                          <a href="" class=""><i class="far fa-heart"></i></a>
                        </li>
                        <li class="view-icon">
                          <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">
                    <h6 class="title"><a href="product-detail.html">HAVIT HV-G92 Gamepad</a>
                      <div class="meta-div">
                        <span class="text1 text-danger">$120</span>
                        <p class="text1 text-secondary ">$160</p>
                        <p class="text3 text-success">(120 Stocks)</p>
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
              <div class="swiper-slide">
                <div class="latest-sale-box mb-4">
                  <div class="media-box">
                    <div class="product-img">
                      <a href="product-detail.html">
                        <img src="./assets/images/poducts/explore-p1.png" alt="explore-p1">
                      </a>
                      <div class="hover-btn">
                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                        <a href="cart-page.html" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>

                    <div class="product-icon-div">
                      <ul class="ps-0">
                        <li class="like-icon">
                          <a href="" class=""><i class="far fa-heart"></i></a>
                        </li>
                        <li class="view-icon">
                          <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">
                    <h6 class="title">
                      <a href="product-detail.html"> Breed Dry Dog Food</a>
                    </h6>
                    <div class="meta-div">
                      <span class="text1 text-danger">$100</span>
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
              <div class="swiper-slide">
                <div class="latest-sale-box mb-4">
                  <div class="media-box">
                    <div class="product-img">
                      <a href="product-detail.html">
                        <img src="./assets/images/poducts/explore-p2.png" alt="product2">
                      </a>
                      <div class="hover-btn">
                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                        <a href="cart-page.html" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>

                    <div class="product-icon-div">
                      <ul class="ps-0">
                        <li class="like-icon">
                          <a href="" class=""><i class="far fa-heart"></i></a>
                        </li>
                        <li class="view-icon">
                          <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">
                    <h6 class="title">
                      <a href="product-detail.html"> CANON EOS DSLR Camera</a>
                    </h6>
                    <div class="meta-div">
                      <span class="text1 text-danger">$360</span>
                    </div>
                    <div class="bottom-box d-flex align-items-center">
                      <div class="d-flex align-items-center rating-icon">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                      <p class="rating-num mb-0"> (95)</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="latest-sale-box mb-4">
                  <div class="media-box">
                    <div class="product-img">
                      <a href="product-detail.html">
                        <img src="./assets/images/poducts/explore-p3.png" alt="product3">
                      </a>
                      <div class="hover-btn">
                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                        <a href="cart-page.html" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>

                    <div class="product-icon-div">
                      <ul class="ps-0">
                        <li class="like-icon">
                          <a href="" class=""><i class="far fa-heart"></i></a>
                        </li>
                        <li class="view-icon">
                          <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">
                    <h6 class="title">
                      <a href="product-detail.html">ASUS FHD Gaming Laptop</a>
                    </h6>
                    <div class="meta-div">
                      <span class="text1 text-danger">$700</span>
                    </div>
                    <div class="bottom-box d-flex align-items-center">
                      <div class="d-flex align-items-center rating-icon">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                      <p class="rating-num mb-0"> (325)</p>

                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="latest-sale-box mb-4">
                  <div class="media-box">
                    <div class="product-img">
                      <a href="product-detail.html">
                        <img src="./assets/images/poducts/explore-p4.png" alt="product4">
                      </a>
                      <div class="hover-btn">
                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                        <a href="cart-page.html" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>
                    <div class="product-icon-div">
                      <ul class="ps-0">
                        <li class="like-icon">
                          <a href="" class=""><i class="far fa-heart"></i></a>
                        </li>
                        <li class="view-icon">
                          <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">
                    <h6 class="title">
                      <a href="product-detail.html"> Curology Product Set</a>
                    </h6>
                    <div class="meta-div">
                      <span class="text1 text-danger">$500</span>
                    </div>
                    <div class="bottom-box d-flex align-items-center">
                      <div class="d-flex align-items-center rating-icon">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                      <p class="rating-num mb-0"> (145)</p>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper our-product-slider">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <div class="latest-sale-box mb-4">
                  <div class="media-box">
                    <div class="product-img">
                      <a href="product-detail.html">
                        <img src="./assets/images/poducts/explore-p5.png" alt="product1">
                      </a>
                      <div class="hover-btn">
                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                        <a href="cart-page.html" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>
                    <span class="badge style1 badge-primary">
                      New
                    </span>
                    <div class="product-icon-div">
                      <ul class="ps-0">
                        <li class="like-icon">
                          <a href="" class=""><i class="far fa-heart"></i></a>
                        </li>
                        <li class="view-icon">
                          <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">

                    <h6 class="title">
                      <a href="product-detail.html"> Kids Electric Car</a>
                    </h6>
                    <div class="meta-div">
                      <span class="text1 text-danger">$960</span>
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
                <div class="latest-sale-box mb-4">
                  <div class="media-box">
                    <div class="product-img">
                      <a href="product-detail.html">
                        <img src="./assets/images/poducts/explore-p6.png" alt="product2">
                      </a>
                      <div class="hover-btn">
                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                        <a href="cart-page.html" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>

                    <div class="product-icon-div">
                      <ul class="ps-0">
                        <li class="like-icon">
                          <a href="" class=""><i class="far fa-heart"></i></a>
                        </li>
                        <li class="view-icon">
                          <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">
                    <h6 class="title">
                      <a href="product-detail.html"> Jr. Zoom Soccer Cleats</a>
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
                      <p class="rating-num mb-0"> (35)</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="latest-sale-box mb-4">
                  <div class="media-box">
                    <div class="product-img">
                      <a href="product-detail.html">
                        <img src="./assets/images/poducts/explore-p7.png" alt="product3">
                      </a>
                      <div class="hover-btn">
                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                        <a href="cart-page.html" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>
                    <span class="badge style1 badge-primary">
                      New
                    </span>
                    <div class="product-icon-div">
                      <ul class="ps-0">
                        <li class="like-icon">
                          <a href="" class=""><i class="far fa-heart"></i></a>
                        </li>
                        <li class="view-icon">
                          <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">


                    <h6 class="title">
                      <a href="product-detail.html"> GP11 Shooter USB Gamepad</a>
                    </h6>
                    <div class="meta-div">
                      <span class="text1 text-danger">$660</span>

                    </div>
                    <div class="bottom-box d-flex align-items-center">
                      <div class="d-flex align-items-center rating-icon">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                      </div>
                      <p class="rating-num mb-0"> (55)</p>

                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="latest-sale-box mb-4">
                  <div class="media-box">
                    <div class="product-img">
                      <a href="product-detail.html">
                        <img src="./assets/images/poducts/explore-p8.png" alt="product4">
                      </a>
                      <div class="hover-btn">
                        <a href="cart-page.html" class="btn add-cart"> Add To Cart</a>
                        <a href="cart-page.html" class="btn buy-now"> Buy Now</a>
                      </div>
                    </div>
                    <div class="product-icon-div">
                      <ul class="ps-0">
                        <li class="like-icon">
                          <a href="" class=""><i class="far fa-heart"></i></a>
                        </li>
                        <li class="view-icon">
                          <a href="" class=""><i class='bx bx-share bx-flip-horizontal'></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="content-box">
                    <h6 class="title">
                      <a href="product-detail.html">Quilted Satin Jacket</a>
                    </h6>
                    <div class="meta-div">
                      <span class="text1 text-danger">$660</span>

                    </div>
                    <div class="bottom-box d-flex align-items-center">
                      <div class="d-flex align-items-center rating-icon">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                      </div>
                      <p class="rating-num mb-0"> (55)</p>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="text-center my-4">
            <a href="all-product.html" class="btn btn-secondary rounded">View all Product</a>
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

  <footer class="footer footer-bg" style="background: url('assets/images/footer/footer-bg.jpg');">
    <div class="container pb-0">
      <div class="row text-white upper-text-box">
        <!-- Brand Section -->
        <div class="col-md-3 mb-4 mb-md-0">
          <div class="footer-link subscribe">
            <!-- footer-logo -->
            <div class="website-logo">
              <a href="index.html"><img src="assets/images/logo/logo.svg" alt="AyitiBook Logo"></a>
            </div>
            <!-- Clipart below the logo -->
            <div class="footer-clipart text-center mt-3">
              <img src="assets/images/footer/footer_clipart.png" alt="Footer Clipart"
                style="max-width: auto; height: auto; display: block;">
            </div>
          </div>
        </div>
        <!-- Support Section -->
        <div class="col-md-2 mb-4 mb-md-0">
          <div class="footer-link getintouch">
            <h6 class="link-head">Support</h6>
            <p class="text-one link-spacing">Hiaty somewhere</p>
            <p><a href="mailto:exclusive@gmail.com" class="text-white">exclusive@gmail.com</a></p>
            <p>+88015-88888-9999</p>
          </div>
        </div>
        <!-- Account Section -->
        <div class="col-md-2 mb-4 mb-md-0">
          <div class="footer-link accounts">
            <h6 class="link-head ">Account</h6>
            <ul class="list-unstyled footer-list">
              <li class="list-item"><a href="my-account.html" class="links">My Account</a></li>
              <li class="list-item"><a href="Login_Register.html" class="links">Login / Register</a></li>
              <li class="list-item"><a href="cart-page.html" class="links">Cart</a></li>
              <li class="list-item"><a href="wishlist.html" class="links">Wishlist</a></li>
              <li class="list-item"><a href="shop.html" class="links">Shop</a></li>
            </ul>
          </div>
        </div>

        <!-- Quick Link Section -->
        <div class="col-md-2 mb-4 mb-md-0">
          <div class="footer-link quick-links">
            <h6 class="link-head">Quick Link</h6>
            <ul class="list-unstyled footer-list">
              <li class="list-item"><a href="privacy-policy.html" class="links">Privacy Policy</a></li>
              <li class="list-item"><a href="terms-condition.html" class="links">Terms Of Use</a></li>
              <li class="list-item"><a href="faq.html" class="links">FAQ</a></li>
              <li class="list-item"><a href="contact.html" class="links">Contact</a></li>
            </ul>
          </div>

        </div>

        <!-- Download App Section -->
        <div class="col-md-3">
          <div class="footer-link download-app">
            <h6 class="link-head">Download App</h6>
            <div class="d-flex gap-3">
              <a href="#" class="text-white">
                <svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M6 7H10.5L10 9H6V18H4V9H0V7H4V5.128C4 3.345 4.186 2.698 4.534 2.046C4.87501 1.40181 5.40181 0.875009 6.046 0.534C6.698 0.186 7.345 0 9.128 0C9.65 0 10.108 0.0500001 10.5 0.15V2H9.128C7.804 2 7.401 2.078 6.99 2.298C6.686 2.46 6.46 2.686 6.298 2.99C6.078 3.401 6 3.804 6 5.128V7Z"
                    fill="white" />
                </svg>
              </a>
              <a href="#" class="text-white">
                <svg width="21" height="17" viewBox="0 0 21 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M10.905 4.84651L10.905 4.84646C10.9194 4.06035 11.2418 3.3113 11.8028 2.76049C12.3639 2.20969 13.1188 1.90116 13.905 1.90129L10.905 4.84651ZM10.905 4.84651L10.877 6.42135M10.905 4.84651L10.877 6.42135M2.75811 3.80857L2.89001 3.91846C4.76679 5.48211 6.71781 6.41823 8.74946 6.6952C8.74947 6.6952 8.74949 6.6952 8.74951 6.6952L10.3104 6.90718L2.75811 3.80857ZM2.75811 3.80857L2.72759 3.97751M2.75811 3.80857L2.72759 3.97751M2.72759 3.97751C2.42576 5.64819 2.5683 7.07086 3.1479 8.30176C3.72718 9.53198 4.73827 10.5605 6.15577 11.4519L6.15579 11.452M2.72759 3.97751L6.15579 11.452M6.15579 11.452L7.90279 12.55L7.954 12.4685M6.15579 11.452L7.954 12.4685M7.954 12.4685L7.90279 12.55C7.97196 12.5934 8.02943 12.6532 8.07016 12.724C8.1109 12.7948 8.13366 12.8745 8.13645 12.9562C8.13925 13.0378 8.122 13.1189 8.0862 13.1924C8.05041 13.2658 7.99716 13.3294 7.93112 13.3775L7.93101 13.3775M7.954 12.4685L7.93101 13.3775M7.93101 13.3775L6.33901 14.5405L6.11542 14.7039M7.93101 13.3775L6.11542 14.7039M6.11542 14.7039L6.39178 14.7211M6.11542 14.7039L6.39178 14.7211M6.39178 14.7211C7.3449 14.7805 8.25288 14.7385 9.00946 14.5884L9.00958 14.5884M6.39178 14.7211L9.00958 14.5884M9.00958 14.5884C11.3886 14.1134 13.3745 12.9794 14.7652 11.2211M9.00958 14.5884L14.7652 11.2211M10.877 6.42135C10.8757 6.49182 10.8594 6.5612 10.8293 6.62495C10.7993 6.6887 10.7561 6.74537 10.7026 6.79125C10.649 6.83712 10.5864 6.87117 10.5188 6.89115C10.4513 6.91112 10.3803 6.91659 10.3105 6.9072L10.877 6.42135ZM14.7652 11.2211C16.1557 9.46296 16.945 7.08835 16.945 4.14229M14.7652 11.2211L16.945 4.14229M16.945 4.14229C16.945 3.99668 16.8714 3.78474 16.744 3.55722M16.945 4.14229L16.744 3.55722M16.744 3.55722C16.6142 3.32559 16.4215 3.06508 16.1673 2.82049M16.744 3.55722L16.1673 2.82049M16.1673 2.82049C15.6587 2.33088 14.8999 1.90129 13.905 1.90129L16.1673 2.82049ZM18.4978 1.53842C18.8818 1.48388 19.3285 1.34345 19.916 1.01105C19.6101 2.49526 19.4321 3.16764 18.7642 4.08336L18.745 4.10969V4.14229C18.745 7.94153 17.578 10.7567 15.8258 12.7397C14.0726 14.7238 11.7277 15.8813 9.36243 16.3532C7.74529 16.6759 5.7544 16.5728 3.99643 16.2106C3.11813 16.0296 2.30077 15.7846 1.61983 15.4974C1.03727 15.2517 0.560091 14.9775 0.229559 14.6904C0.660648 14.6482 1.4114 14.5535 2.24366 14.3598C3.24355 14.1272 4.37173 13.7494 5.20306 13.141L5.31918 13.056L5.19904 12.9768C5.15724 12.9492 5.11178 12.9196 5.06301 12.8879C4.30477 12.3938 2.74648 11.3786 1.73155 9.51655C0.667136 7.56374 0.192566 4.66295 1.91362 0.425918C3.57889 2.34347 5.2726 3.66001 6.99504 4.3668L6.99505 4.36681C7.57662 4.60536 7.94255 4.72373 8.23185 4.79141C8.45087 4.84265 8.62608 4.86463 8.81173 4.88794C8.87034 4.89529 8.92998 4.90278 8.99238 4.91135L9.28722 4.95189L9.10594 4.77077C9.13096 3.8414 9.42538 2.93895 9.95386 2.17331C10.4904 1.39606 11.2442 0.79434 12.1211 0.443497C12.9979 0.0926537 13.9588 0.00827681 14.8833 0.200931C15.8079 0.393585 16.6551 0.854708 17.3189 1.52657L17.3485 1.55658L17.3907 1.55628C17.4934 1.55556 17.5972 1.55908 17.7036 1.56269C17.9483 1.57098 18.2068 1.57974 18.4978 1.53842Z"
                    fill="white" stroke="black" stroke-width="0.2" />
                </svg>
              </a>
              <a href="#" class="text-white">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M17 3H7C5.93913 3 4.92172 3.42143 4.17157 4.17157C3.42143 4.92172 3 5.93913 3 7V17C3 18.0609 3.42143 19.0783 4.17157 19.8284C4.92172 20.5786 5.93913 21 7 21H17C18.0609 21 19.0783 20.5786 19.8284 19.8284C20.5786 19.0783 21 18.0609 21 17V7C21 5.93913 20.5786 4.92172 19.8284 4.17157C19.0783 3.42143 18.0609 3 17 3Z"
                    stroke="white" stroke-width="1.5" stroke-linejoin="round" />
                  <path
                    d="M12 16C13.0609 16 14.0783 15.5786 14.8284 14.8284C15.5786 14.0783 16 13.0609 16 12C16 10.9391 15.5786 9.92172 14.8284 9.17157C14.0783 8.42143 13.0609 8 12 8C10.9391 8 9.92172 8.42143 9.17157 9.17157C8.42143 9.92172 8 10.9391 8 12C8 13.0609 8.42143 14.0783 9.17157 14.8284C9.92172 15.5786 10.9391 16 12 16V16Z"
                    stroke="white" stroke-width="1.5" stroke-linejoin="round" />
                  <path
                    d="M17.5 7.5C17.7652 7.5 18.0196 7.39464 18.2071 7.20711C18.3946 7.01957 18.5 6.76522 18.5 6.5C18.5 6.23478 18.3946 5.98043 18.2071 5.79289C18.0196 5.60536 17.7652 5.5 17.5 5.5C17.2348 5.5 16.9804 5.60536 16.7929 5.79289C16.6054 5.98043 16.5 6.23478 16.5 6.5C16.5 6.76522 16.6054 7.01957 16.7929 7.20711C16.9804 7.39464 17.2348 7.5 17.5 7.5Z"
                    fill="white" />
                </svg>
              </a>
              <a href="#" class="text-white">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M11.5 9.05C12.417 8.113 13.611 7.5 15 7.5C16.4587 7.5 17.8576 8.07946 18.8891 9.11091C19.9205 10.1424 20.5 11.5413 20.5 13V20.5H18.5V13C18.5 12.0717 18.1313 11.1815 17.4749 10.5251C16.8185 9.86875 15.9283 9.5 15 9.5C14.0717 9.5 13.1815 9.86875 12.5251 10.5251C11.8687 11.1815 11.5 12.0717 11.5 13V20.5H9.5V8H11.5V9.05ZM4.5 6C4.10218 6 3.72064 5.84196 3.43934 5.56066C3.15804 5.27936 3 4.89782 3 4.5C3 4.10218 3.15804 3.72064 3.43934 3.43934C3.72064 3.15804 4.10218 3 4.5 3C4.89782 3 5.27936 3.15804 5.56066 3.43934C5.84196 3.72064 6 4.10218 6 4.5C6 4.89782 5.84196 5.27936 5.56066 5.56066C5.27936 5.84196 4.89782 6 4.5 6ZM3.5 8H5.5V20.5H3.5V8Z"
                    fill="white" />
                </svg>
              </a>
            </div>
            <br>
            <!-- subscribe Section -->
            <div class=" mt-3">
              <div class="footer-link subscribe">
                <h6 class="link-head">Subscribe</h6>
                <p class="text-one">Get 10% off your first order</p>
                <div class="input-group footer-email-input d-flex align-items-center justify-content-between">
                  <input type="email" class="form-control" placeholder="Enter your email">
                  <div class="arrow-btn">
                    <a href="#" class="send-arrow-img">
                      <img src="./assets/images/footer/icon-send.png" alt="sent-arrow">
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <br>
        </div>
        <div class="footer-bottom px-0">
          <div class="container py-0">
            <div class="row">
              <div class="col text-center">
                <p class="mb-0 copyright
        ">&copy; Copyright Rimel 2022. All rights reserved</p>
              </div>
            </div>
          </div>
        </div>
      </div>
  </footer>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/js/custom-swiper.js"></script>
  <script src="assets/js/main.js"></script>
    <!-- mobile js -->
  <script src="assets/js/mobile.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


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
  
</body>

</html>