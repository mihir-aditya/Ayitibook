{{-- resources/views/delivery-partner/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Delivery Partner Registration - {{ config('app.name') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2rem 0;
            font-family: 'Nunito', sans-serif;
        }
        .register-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 800px;
            margin: 0 auto;
        }
        .register-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        .register-header h3 {
            margin: 0;
            font-weight: 600;
        }
        .register-header p {
            margin: 0.5rem 0 0;
            opacity: 0.9;
        }
        .register-body {
            padding: 2rem;
            background: white;
        }
        .form-control, .form-select {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            border: 1px solid #e1e5eb;
        }
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 0.75rem;
            color: white;
            font-weight: 600;
            width: 100%;
            transition: transform 0.2s;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            color: white;
        }
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e1e5eb;
        }
        .login-link a {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
        .alert {
            border-radius: 10px;
        }
        .section-title {
            color: #667eea;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e1e5eb;
        }
    </style>
</head>
<body>
    <div class="register-card">
        <div class="register-header">
            <i class="fas fa-truck fa-3x mb-3"></i>
            <h3>Become a Delivery Partner</h3>
            <p>Join our delivery network and start earning</p>
        </div>
        <div class="register-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>Please fix the errors below.
                </div>
            @endif

            <form method="POST" action="{{ route('delivery-partner.register.submit') }}">
                @csrf

                <!-- Personal Information -->
                <h5 class="section-title">
                    <i class="fas fa-user me-2"></i>Personal Information
                </h5>
                
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" 
                                   placeholder="Enter your full name" required>
                        </div>
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" 
                                   placeholder="Enter your email" required>
                        </div>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-phone"></i></span>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone') }}" 
                                   placeholder="Enter your phone number" required>
                        </div>
                        @error('phone')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" placeholder="Enter password" required>
                        </div>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" 
                                   id="password_confirmation" name="password_confirmation" 
                                   placeholder="Confirm password" required>
                        </div>
                    </div>
                </div>

                <!-- Vehicle Information -->
                <h5 class="section-title">
                    <i class="fas fa-motorcycle me-2"></i>Vehicle Information
                </h5>

                <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                        <label for="vehicle_type" class="form-label">Vehicle Type <span class="text-danger">*</span></label>
                        <select class="form-select @error('vehicle_type') is-invalid @enderror" 
                                id="vehicle_type" name="vehicle_type" required>
                            <option value="">Select vehicle type</option>
                            <option value="bicycle" {{ old('vehicle_type') == 'bicycle' ? 'selected' : '' }}>Bicycle</option>
                            <option value="motorcycle" {{ old('vehicle_type') == 'motorcycle' ? 'selected' : '' }}>Motorcycle</option>
                            <option value="scooter" {{ old('vehicle_type') == 'scooter' ? 'selected' : '' }}>Scooter</option>
                            <option value="car" {{ old('vehicle_type') == 'car' ? 'selected' : '' }}>Car</option>
                            <option value="van" {{ old('vehicle_type') == 'van' ? 'selected' : '' }}>Van</option>
                            <option value="truck" {{ old('vehicle_type') == 'truck' ? 'selected' : '' }}>Truck</option>
                        </select>
                        @error('vehicle_type')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="vehicle_number" class="form-label">Vehicle Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('vehicle_number') is-invalid @enderror" 
                               id="vehicle_number" name="vehicle_number" value="{{ old('vehicle_number') }}" 
                               placeholder="Enter vehicle number" required>
                        @error('vehicle_number')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="license_number" class="form-label">License Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('license_number') is-invalid @enderror" 
                               id="license_number" name="license_number" value="{{ old('license_number') }}" 
                               placeholder="Enter license number" required>
                        @error('license_number')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Address Information -->
                <h5 class="section-title">
                    <i class="fas fa-map-marker-alt me-2"></i>Address Information
                </h5>

                <div class="row mb-3">
                    <div class="col-12 mb-3">
                        <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                  id="address" name="address" rows="2" 
                                  placeholder="Enter your full address" required>{{ old('address') }}</textarea>
                        @error('address')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                        <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('city') is-invalid @enderror" 
                               id="city" name="city" value="{{ old('city') }}" 
                               placeholder="Enter city" required>
                        @error('city')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="state" class="form-label">State <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('state') is-invalid @enderror" 
                               id="state" name="state" value="{{ old('state') }}" 
                               placeholder="Enter state" required>
                        @error('state')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="postal_code" class="form-label">Postal Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('postal_code') is-invalid @enderror" 
                               id="postal_code" name="postal_code" value="{{ old('postal_code') }}" 
                               placeholder="Enter postal code" required>
                        @error('postal_code')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Your account will be verified by our team after registration. You'll receive an email once approved.
                </div>

                <button type="submit" class="btn-register">
                    <i class="fas fa-user-plus me-2"></i>Register as Delivery Partner
                </button>
            </form>

            <div class="login-link">
                <p class="mb-0">Already have an account? <a href="{{ route('delivery-partner.login') }}">Login here</a></p>
            </div>
        </div>
    </div>
</body>
</html>