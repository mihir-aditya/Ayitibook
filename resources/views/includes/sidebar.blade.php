<?php
  $current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Account | AyitiBook</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="icon" type="image/png" href="/assets/images/favicon.png">
  <link rel="stylesheet" href="/assets/vendor/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="/assets/vendor/swiper/swiper-bundle.min.css">
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/custom.css">
  <link rel="stylesheet" href="/assets/css/footer.css">
  <link rel="stylesheet" href="/assets/css/header.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

  <style>
    /* Active link */
    .aside-menu .nav-link.active {
      background-color: #282424 !important;
      color: #eee9e9 !important;
      font-weight: 500;
    }

    /* Normal link */
    .aside-menu .nav-link {
      color: #212529 !important;
    }

    /* Hover */
    .aside-menu .nav-link:hover {
      background-color: #f1f1f1;
      color: #e60b0b !important;
    }

    /* Collapse toggle arrow rotation */
    .aside-menu .collapse-toggle .bx-chevron-down {
      transition: transform 0.25s ease;
    }
    .aside-menu .collapse-toggle[aria-expanded="true"] .bx-chevron-down {
      transform: rotate(180deg);
    }
  </style>
</head>

<body>
  <div class="page-wrapper">
    <main class="main-wrapper">
      <div class="container">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Account</li>
          </ol>
        </nav>

        <div class="row">
          <!-- Sidebar -->
          <div class="col-lg-12 mb-4">
            <ul class="nav nav-pills flex-column gap-1 aside-menu">

              <!-- Dashboard -->
              <li class="nav-item">
                <a class="nav-link ajax-link <?= preg_match('#^/profile/dashboard(/|$)#', $_SERVER['REQUEST_URI']) ? 'active' : '' ?>"
                   href="/profile/dashboard">
                  <i class='bx bx-grid-alt'></i> Dashboard
                </a>
              </li>

              <!-- My Profile (collapsible) -->
              <?php
                $profile_pages = ['edit.blade.php', 'profile.blade.php', 'address.blade.php'];
                $is_profile_open = in_array($current_page, $profile_pages) ? 'show' : '';

                // Also open if current URI matches any child
                if (preg_match('#^/profile(/address)?$#', $_SERVER['REQUEST_URI'])) {
                  $is_profile_open = 'show';
                }
              ?>
              <li class="nav-item">
                {{-- Collapse toggle — NOT an ajax-link, Bootstrap handles it --}}
                <a class="nav-link collapse-toggle d-flex justify-content-between align-items-center"
                   data-bs-toggle="collapse"
                   href="#profileSubmenu"
                   role="button"
                   aria-expanded="<?= $is_profile_open ? 'true' : 'false' ?>"
                   aria-controls="profileSubmenu">
                  <span><i class='bx bx-user-circle'></i> My Profile</span>
                  <i class="bx bx-chevron-down"></i>
                </a>
                <div class="collapse <?= $is_profile_open ?> ps-4" id="profileSubmenu">
                  <ul class="nav flex-column">
                    <li><a class="nav-link ajax-link <?= preg_match('#^/profile$#', $_SERVER['REQUEST_URI']) ? 'active' : '' ?>"
                           href="/profile"><i class='bx bx-cog'></i> Manage My Profile</a></li>
                    <li><a class="nav-link ajax-link <?= preg_match('#^/profile/address$#', $_SERVER['REQUEST_URI']) ? 'active' : '' ?>"
                           href="/profile/address"><i class='bx bx-book'></i> Address Book</a></li>
                    <li><a class="nav-link ajax-link" href="#"><i class='bx bx-bar-chart-alt-2'></i> User Stats</a></li>
                  </ul>
                </div>
              </li>

              <!-- Payment Options (collapsible) -->
              <?php
                $payment_pages = ['wallet_&_transections.php', 'saved_payment.php', 'loyalty_rewards.php', 'bnpl.php'];
                $is_payment_open = in_array($current_page, $payment_pages) ? 'show' : '';

                if (preg_match('#^/profile/(wallet-transactions|saved-payment|loyalty-rewards|bnpl|transaction)(/|$)#', $_SERVER['REQUEST_URI'])) {
                  $is_payment_open = 'show';
                }
              ?>
              <li class="nav-item">
                <a class="nav-link collapse-toggle d-flex justify-content-between align-items-center"
                   data-bs-toggle="collapse"
                   href="#paymentSubmenu"
                   role="button"
                   aria-expanded="<?= $is_payment_open ? 'true' : 'false' ?>"
                   aria-controls="paymentSubmenu">
                  <span><i class='bx bx-wallet'></i> Payment Options</span>
                  <i class="bx bx-chevron-down"></i>
                </a>
                <div class="collapse <?= $is_payment_open ?> ps-4" id="paymentSubmenu">
                  <ul class="nav flex-column">
                    <li><a class="nav-link ajax-link <?= preg_match('#^/profile/wallet-transactions$#', $_SERVER['REQUEST_URI']) ? 'active' : '' ?>"
                           href="/profile/wallet-transactions"><i class='bx bx-wallet'></i> Wallet</a></li>
                    <li><a class="nav-link ajax-link <?= preg_match('#^/profile/saved-payment$#', $_SERVER['REQUEST_URI']) ? 'active' : '' ?>"
                           href="/profile/saved-payment"><i class='bx bx-credit-card'></i> Saved Payment Method</a></li>
                    <li><a class="nav-link ajax-link <?= preg_match('#^/profile/loyalty-rewards$#', $_SERVER['REQUEST_URI']) ? 'active' : '' ?>"
                           href="/profile/loyalty-rewards"><i class='bx bx-gift'></i> Loyalty Program & Rewards</a></li>
                    <li><a class="nav-link ajax-link <?= preg_match('#^/profile/bnpl$#', $_SERVER['REQUEST_URI']) ? 'active' : '' ?>"
                           href="/profile/bnpl"><i class='bx bx-money-withdraw'></i> Buy Now Pay Later (BNPL)</a></li>
                    <li><a class="nav-link ajax-link <?= preg_match('#^/profile/transaction$#', $_SERVER['REQUEST_URI']) ? 'active' : '' ?>"
                           href="/profile/transaction"><i class='bx bx-receipt'></i> Transaction Details</a></li>
                    <li><a class="nav-link ajax-link" href="#"><i class='bx bx-transfer'></i> Payment Gateway</a></li>
                  </ul>
                </div>
              </li>

              <!-- Manage Orders (collapsible) -->
              <?php
                $order_pages = ['order.php', 'return.php', 'cancellation.php'];
                $is_order_open = in_array($current_page, $order_pages) ? 'show' : '';

                if (preg_match('#^/profile/(order|return|cancellation)(/|$)#', $_SERVER['REQUEST_URI'])) {
                  $is_order_open = 'show';
                }
              ?>
              <li class="nav-item">
                <a class="nav-link collapse-toggle d-flex justify-content-between align-items-center"
                   data-bs-toggle="collapse"
                   href="#ordersSubmenu"
                   role="button"
                   aria-expanded="<?= $is_order_open ? 'true' : 'false' ?>"
                   aria-controls="ordersSubmenu">
                  <span><i class="bi bi-box-seam"></i> Manage Orders</span>
                  <i class="bx bx-chevron-down"></i>
                </a>
                <div class="collapse <?= $is_order_open ?> ps-4" id="ordersSubmenu">
                  <ul class="nav flex-column">
                    <li><a class="nav-link ajax-link <?= preg_match('#^/profile/order$#', $_SERVER['REQUEST_URI']) ? 'active' : '' ?>"
                           href="/profile/order"><i class='bx bx-list-ul'></i> Order History</a></li>
                    <li><a class="nav-link ajax-link <?= preg_match('#^/profile/return$#', $_SERVER['REQUEST_URI']) ? 'active' : '' ?>"
                           href="/profile/return"><i class='bx bx-credit-card-front'></i> Returns & Refunds</a></li>
                    <li><a class="nav-link ajax-link <?= preg_match('#^/profile/cancellation$#', $_SERVER['REQUEST_URI']) ? 'active' : '' ?>"
                           href="/profile/cancellation"><i class='bx bx-x-circle'></i> Canceled Orders</a></li>
                  </ul>
                </div>
              </li>

              <!-- Standalone links -->
              <li class="nav-item"><a class="nav-link ajax-link <?= preg_match('#^/profile/wishlist$#', $_SERVER['REQUEST_URI']) ? 'active' : '' ?>"
                 href="/profile/wishlist"><i class='bx bx-heart-circle'></i> My Wishlist</a></li>
              <li class="nav-item"><a class="nav-link ajax-link <?= preg_match('#^/profile/myreviews$#', $_SERVER['REQUEST_URI']) ? 'active' : '' ?>"
                 href="/profile/myreviews"><i class='bx bx-star'></i> My Reviews</a></li>
              <li class="nav-item"><a class="nav-link ajax-link <?= preg_match('#^/profile/notifications$#', $_SERVER['REQUEST_URI']) ? 'active' : '' ?>"
                 href="/profile/notifications"><i class='bx bx-bell'></i> Notifications</a></li>
              <li class="nav-item"><a class="nav-link ajax-link <?= preg_match('#^/profile/subscribed-sellers$#', $_SERVER['REQUEST_URI']) ? 'active' : '' ?>"
                 href="/profile/subscribed-sellers"><i class='bx bx-user-check'></i> Subscribed Seller</a></li>
              <li class="nav-item"><a class="nav-link ajax-link" href="#"><i class='bx bx-history'></i> Recently Viewed</a></li>

            </ul>
          </div>
        </div>
      </div>
    </main>
  </div>

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    $(function () {

      // ── Highlight active link by current path ──────────────────────────
      function setActiveSidebar(path) {
        $('.aside-menu .ajax-link').removeClass('active');
        $('.aside-menu .ajax-link').each(function () {
          var href = $(this).attr('href');
          if (href && href !== '#' && href === path) {
            $(this).addClass('active');

            // If inside a collapse panel, make sure it's open
            var $panel = $(this).closest('.collapse');
            if ($panel.length && !$panel.hasClass('show')) {
              $panel.addClass('show');
              $panel.prev('.collapse-toggle').attr('aria-expanded', 'true');
            }
          }
        });
      }

      // ── AJAX page load ─────────────────────────────────────────────────
      function loadPage(href, pushState) {
        // Skip pure anchors
        if (!href || href === '#' || href.startsWith('javascript:')) return;

        // Only AJAX-load /profile routes; hard-navigate everything else
        if (href.indexOf('/profile') !== 0) {
          window.location.href = href;
          return;
        }

        if (pushState) {
          history.pushState({ href: href }, '', href);
        }

        setActiveSidebar(href);

        $.get(href)
          .done(function (response) {
            var $parsed = $('<div>').append($.parseHTML(response, document, true));

            // Swap main content
            var newMain = $parsed.find('main.main-wrapper').html();
            if (newMain) {
              $('main.main-wrapper').html(newMain);
            }

            // Swap page title
            var newTitle = $parsed.filter('title').text() || $parsed.find('title').text();
            if (newTitle) document.title = newTitle;

            // Scroll to top
            window.scrollTo(0, 0);
          })
          .fail(function () {
            // Graceful fallback: just navigate normally
            window.location.href = href;
          });
      }

      // ── Click handler — only on .ajax-link, NOT on collapse toggles ───
      $(document).on('click', '.aside-menu .ajax-link', function (e) {
        var href = $(this).attr('href');
        if (!href || href === '#' || href.startsWith('javascript:')) return;

        e.preventDefault();
        loadPage(href, true);
      });

      // ── Browser back/forward ───────────────────────────────────────────
      window.addEventListener('popstate', function (e) {
        var href = (e.state && e.state.href) ? e.state.href : window.location.pathname;
        loadPage(href, false);
      });

      // ── Set initial state so the first popstate works correctly ───────
      history.replaceState({ href: window.location.pathname }, '', window.location.pathname);

    });
  </script>
</body>
</html>