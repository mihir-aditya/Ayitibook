<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout - AyitiBook</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/footer.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/header.css') }}">
</head>

<body>
    @include('components.top-header')
    @include('components.header')

    <div class="page-wrapper">
        <main class="main-wrapper">
            <div class="container checkout-container">
                <nav class="breadcrumb mb-4">
                    <a href="/">Home</a> / <span>Checkout</span>
                </nav>

                <div class="row">
                    <!-- Billing Form -->
                    <div class="col-lg-7 col-md-6">
                        <h3 class="mb-3">Billing Details</h3>
                        {{-- <form action="{{ route('checkout.placeOrder') }}" method="POST"> --}}
                        <form method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="phone">Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="phone" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>

                            <div class="form-group mb-3">
                                <label for="address">Address <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="address" rows="3" required></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="city">City</label>
                                <input type="text" class="form-control" name="city">
                            </div>

                            <div class="form-group mb-3">
                                <label for="zip">Postal Code</label>
                                <input type="text" class="form-control" name="zip">
                            </div>
                        </form>
                    </div>

                    <!-- Order Summary -->
                    <div class="col-lg-5 col-md-6">
                        <div class="cart-summary">
                            <h3 class="mb-3">Your Order</h3>
                            <ul class="list-group mb-3">
                                @foreach($cartItems as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $item->product->name }}</strong><br>
                                            <small>Qty: {{ $item->quantity }}</small>
                                        </div>
                                        <span>{{ $item->product->currency }}{{ $item->product->price * $item->quantity }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            <p>Subtotal: <span class="float-end">{{ $subtotal }}</span></p>
                            <p>Shipping: <span class="float-end">Free</span></p>
                            <h4>Total: <span class="float-end">{{ $total }}</span></h4>

                            <!-- Payment Methods -->
                            <h5 class="mt-4">Payment Method</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" value="cod" checked>
                                <label class="form-check-label">Cash on Delivery</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" value="card">
                                <label class="form-check-label">Credit/Debit Card</label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-4">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('components.footer')

    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom-swiper.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/mobile.js') }}"></script>
</body>
</html>
