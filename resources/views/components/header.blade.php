<header class="">
    <div class="d-flex align-items-center justify-content-between header-large">
      <div class="website-logo">
        <a href="/home"><img src="assets/images/logo/logo.svg" alt="AyitiBook Logo"></a>
      </div>
      <nav>
        <label for="drop" class="toggle">&#8801; </label>
        <input type="checkbox" id="drop" />
        <ul class="menu">
          <li class="nav-menu"><a href="/home">Home</a></li>
          <li class="nav-menu"><a href="/about">about us</a></li>

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

          <li class="nav-menu"><a href="/contact">Contact</a></li>
        </ul>
      </nav>
      <div class="header-item item-right hide-element">
        <form action="{{ route('search-product') }}" method="GET" class="search-bar">
          <input type="text" id="search-input" name="q" value="{{ request('q') }}" placeholder="What are you looking for?" autocomplete="off">
          <button type="submit" class="search-icon">
            <i class="fas fa-search"></i>
          </button>
        </form>

        <a href="/wishlist" class="icon-tag position-relative">
          <img src="./assets/images/Wishlist.png" alt="Wishlist-img" class="">
          {{-- <span class="wishlist-count">1</span> --}}
          <span id="wishlist-count" class="wishlist-count">{{ $wishlistCount ?? 0 }}</span>
        </a>
        <a href="{{ route('cart.index') }}" class="icon-tag  position-relative">
          <img src="./assets/images/buy-icon.png" alt="buy-icon">
          <span id="cart-count" class="shop-cart-count">{{ $cartCount ?? 0 }}</span>
        </a>
        <a href="{{ route('cart.index') }}" class="icon-tag wallet-bx position-relative">
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
                  <a class="dropdown-item dropdown-list-group-item" href="/my-account">
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
                
                <a class="dropdown-item" href="{{ route('logout') }}" 
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M4 12H13.5M6 15L3 12L6 9M11 7V6C11 5.46957 11.2107 4.96086 11.5858 4.58579C11.9609 4.21071 12.4696 4 13 4H18C18.5304 4 19.0391 4.21071 19.4142 4.58579C19.7893 4.96086 20 5.46957 20 6V18C20 18.5304 19.7893 19.0391 19.4142 19.4142C19.0391 19.7893 18.5304 20 18 20H13C12.4696 20 11.9609 19.7893 11.5858 19.4142C11.2107 19.0391 11 18.5304 11 18V17"
          stroke="#FAFAFA" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
    Sign Out
</a>

<!-- Hidden form -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

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