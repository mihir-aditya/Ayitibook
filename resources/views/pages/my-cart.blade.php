<html lang="en">

<head>
    <!-- Website Page Title -->
    <title>Product Cart - AyitiBook</title>

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
            <div class="container">
                <div class="product-cart-container">
                    <nav class="breadcrumb mb-0">
                        <a href="index.html">Home</a> / <span>Cart</span>
                    </nav>
                    <!-- Cart Table -->
                    {{-- <div class="cart-table">
                        <table>
                            <thead>
                                <tr>
                                    <th class=" text-left">Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Discount</th>
                                    <th>Subtotal</th>
                                    <th>Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="product position-relative text-left">
                                        <div class="d-flex">
                                            <img src="./assets/images/cart-img-icon1.png" alt="LCD Monitor">
                                            <div class="product-detail">
                                                <span>LCD Monitor</span>
                                                <p>write description here</p>
                                            </div>
                                        </div>


                                        <span class="badge style1"><i class="fas fa-times"></i></span>

                                    </td>
                                    <td>$650</td>
                                    <td>
                                        <div class="quantity-select">
                                            <input type="number" class="quantity" value="1" min="1">
                                        </div>
                                    </td>
                                    <td class="prodcut-discount">30%</td>
                                    <td class="subtotal">$650</td>
                                    <td class="Actions">
                                        <a href="#" class="btn btn-danger btn-sm">delete</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="product position-relative text-left">
                                        <div class="d-flex">
                                            <img src="./assets/images/cart-img-icon2.png" alt="Gamepad">
                                            <div class="product-detail">
                                                <span>HI Gamepad</span>
                                                <p>write description here</p>
                                            </div>
                                        </div>
                                        <span class="badge style1"><i class="fas fa-times"></i></span>
                                    </td>

                                    <td>$550</td>
                                    <td>
                                        <div class="quantity-select">
                                            <input type="number" class="quantity" value="1" min="1">
                                        </div>
                                    </td>
                                    <td class="prodcut-discount">30%</td>
                                    <td class="subtotal">$1100</td>
                                    <td class="Actions">
                                        <a href="#" class="btn btn-danger btn-sm">delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> --}}

                    <div class="cart-table">
    <table>
        <thead>
            <tr>
                <th class="text-left">Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Discount</th>
                <th>Subtotal</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cartItems as $item)
                <tr>
                    <td class="product position-relative text-left">
                        <div class="d-flex">
                            <img src="{{ asset( 'storage/' .$item->product->thumbnail) }}" alt="{{ $item->product->name }}" width="60">
                            <div class="product-detail">
                                <span>{{ $item->product->name }}</span>
                                <p>{{ $item->product->short_description }}</p>
                            </div>
                        </div>
                    </td>
                    <td>{{ $item->product->currency }} {{ number_format($item->product->price, 2) }}</td>
                    <td>
                        <div class="quantity-select">
                            <input type="number" class="quantity" value="{{ $item->quantity }}" min="1" data-cart-id="{{ $item->id }}" onchange="updateQuantity(this)">
                        </div>
                    </td>
                    <td class="prodcut-discount">
                        {{ $item->product->discount_percent ?? 0 }}%
                    </td>
                    <td class="subtotal">
                       {{ $item->product->currency }} {{ number_format($item->product->price * $item->quantity, 2) }}
                    </td>
                    <td class="Actions">
    <button onclick="removeFromCart({{ $item->id }})"
        class="btn btn-danger btn-sm">
        Delete
    </button>
</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Your cart is empty.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


                    <!-- Buttons and Coupon -->
                    <div class="actions">
                        <button class="btn btn-outline-secondary">Return To Shop</button>
                        <button class="btn btn-outline-secondary">Update Cart</button>
                    </div>


                    <div class="row justify-content-between">
                        <div class="col-lg-7 col-md-6">
                            <div class="coupon-section">
                                <input type="text" class="coupon-code" placeholder="Coupon Code">
                                <button class="btn btn-primary">Apply Coupon</button>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <!-- Cart Total -->
                            {{-- <div class="cart-summary">
                                <h2>Cart Total</h2>
                                <div class="">
                                    <p>Subtotal: <span id="subtotal">$1750</span></p>
                                    <p>Shipping: <span id="shipping">Free</span></p>
                                    <p class="border-bottom-none">Total: <span id="total">$1750</span></p>
                                </div>
                                <div class="text-center mx-auto">
                                    <button class="btn btn-primary">Proceed to Checkout</button>
                                </div>
                            </div>
                        </div> --}}

                        @php
    $discount = session('coupon', 0);
    $discountAmount = $subtotal * $discount;
    $total = $subtotal - $discountAmount;

@endphp

<div class="cart-summary">
    <h2>Cart Total</h2>
    <div>
        <p>Subtotal: <span id="subtotal">₹ {{ number_format($subtotal, 2) }}</span></p>
        <p>Discount: <span id="discount">- ₹ {{ number_format($discountAmount, 2) }}</span></p>
        <p>Shipping: <span id="shipping">Free</span></p>
        <p class="border-bottom-none">Total: <span id="total">₹ {{ number_format($total, 2) }}</span></p>
    </div>
    <div class="text-center mx-auto">
        <a href="{{ route('cart.checkout') }}" class="btn btn-primary">Proceed to Checkout</a>
    </div>
</div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!-- end--------------------------->
    @include('components.footer')


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/custom-swiper.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- mobile js -->
    <script src="assets/js/mobile.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function removeFromCart(id) {
    fetch(`/cart/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success !== false) {
            location.reload();
        }
    });
}
        function updateQuantity(input) {
            const cartId = input.getAttribute('data-cart-id');
            const quantity = parseInt(input.value);
            
            if (quantity < 1) {
                input.value = 1;
                return;
            }

            fetch(`/cart/update/${cartId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({ quantity: quantity })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Failed to update quantity');
                }
            })
            .catch(err => {
                console.error('Error:', err);
                alert('Failed to update quantity');
            });
        }
    </script>
</body>

</html>
