<html lang="en">

<head>
    <title>Register - AyitiBook</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="assets/images/favicon.png">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/vendor/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/header.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body>
    @include('components.top-header')
    @include('components.header')

    <div class="page-wrapper">
        <main class="main-wrapper">
            <div class="container">
                <div class="auth-container">
                    <nav class="breadcrumb mb-4">
                        <a href="{{ url('/') }}">Home</a> / <span>Register</span>
                    </nav>

                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-8">
                            <div class="auth-box shadow-sm rounded-3 p-4 bg-white">
                                <h2 class="text-center mb-4">Create an Account</h2>

                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <!-- Name -->
                                    <div class="mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}" required
                                            class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <!-- UserName -->
                                    <div class="mb-3">
                                        <label class="form-label">User Name</label>
                                        <input type="text" name="username" value="{{ old('username') }}" required
                                            class="form-control @error('username') is-invalid @enderror">
                                        @error('username')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <!-- Email -->
                                    <div class="mb-3">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" name="email" value="{{ old('email') }}" required
                                            class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Phone -->
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

                                    <!-- Confirm Password -->
                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" name="password_confirmation" required
                                            class="form-control">
                                    </div>

                                    <!-- Submit -->
                                    <button type="submit" class="btn btn-primary w-100">Register</button>

                                    <!-- Link -->
                                    <div class="text-center mt-3">
                                        <a href="{{ route('login') }}">Already registered? Login</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('components.footer')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/custom-swiper.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/mobile.js"></script>
</body>
</html>
