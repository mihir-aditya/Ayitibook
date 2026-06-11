<html lang="en">

<head>
    <!-- Website Page Title -->
    <title>Login - AyitiBook</title>

    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="author" content="AyitiBook">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/images/favicon.png">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="assets/vendor/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">

    <!-- Project CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/header.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- ==================== site header ==================== -->
    {{-- @include('includes.top-header') --}}
    @include('includes.header')

    <div class="page-wrapper">
        <main class="main-wrapper">
            <div class="container">
                <div class="auth-container">
                    <nav class="breadcrumb mb-4">
                        <a href="{{ url('/') }}">Home</a> / <span>Login</span>
                    </nav>

                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-8">
                            <div class="auth-box shadow-sm rounded-3 p-4 bg-white">
                                <h2 class="text-center mb-4">Login to AyitiBook</h2>

                                <!-- Status -->
                                @if(session('status'))
                                    <div class="alert alert-success">{{ session('status') }}</div>
                                @endif

                                <!-- Form -->
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                   <div class="mb-3">
    <label class="form-label">Phone Number</label>
    <input type="text" name="phone" value="{{ old('phone') }}" required
        class="form-control @error('phone') is-invalid @enderror">
    @error('phone')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

                                    <!-- Password -->
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" required
                                            class="form-control @error('password') is-invalid @enderror">
                                        @error('password')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Remember Me -->
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                        <label for="remember" class="form-check-label">Remember Me</label>
                                    </div>

                                    <!-- Submit -->
                                    <button type="submit" class="btn btn-primary w-100">Login</button>

                                    <!-- Links -->
                                    <div class="d-flex justify-content-between mt-3">
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot Password?</a>
                                        @endif
                                        <a href="{{ route('register') }}" class="text-decoration-none">Create Account</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('includes.footer')

    <!-- Vendor JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/custom-swiper.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/mobile.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
