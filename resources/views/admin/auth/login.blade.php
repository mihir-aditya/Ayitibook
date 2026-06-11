<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | {{ config('app.name', 'E-Commerce') }}</title>
    
    <!-- Inter Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --ecom-red: #dc2626;
            --ecom-red-light: #fee2e2;
            --ecom-red-dark: #b91c1c;
            --ecom-gray-light: #f5f5f5;
            --ecom-gray: #6b7280;
            --ecom-gray-dark: #374151;
            --ecom-white: #ffffff;
            --ecom-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --ecom-shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.05);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: var(--ecom-white);
            color: var(--ecom-gray-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1.6;
        }
        
        .login-wrapper {
            width: 100%;
            max-width: 480px;
            padding: 20px;
        }
        
        .login-card {
            background: var(--ecom-white);
            border-radius: 16px;
            box-shadow: var(--ecom-shadow-lg);
            border: 1px solid var(--ecom-gray-light);
            overflow: hidden;
        }
        
        .login-header {
            background: linear-gradient(135deg, var(--ecom-white) 0%, var(--ecom-red-light) 100%);
            padding: 48px 40px 40px;
            text-align: center;
            border-bottom: 1px solid var(--ecom-gray-light);
        }
        
        .brand-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 24px;
        }
        
        .logo-icon {
            width: 48px;
            height: 48px;
            background: var(--ecom-red);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.2);
        }
        
        .logo-text {
            font-size: 28px;
            font-weight: 700;
            background: linear-gradient(90deg, var(--ecom-red) 0%, var(--ecom-red-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .header-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--ecom-gray-dark);
            margin-bottom: 8px;
        }
        
        .header-subtitle {
            color: var(--ecom-gray);
            font-size: 15px;
            font-weight: 400;
        }
        
        .login-body {
            padding: 40px;
        }
        
        .alert-container {
            margin-bottom: 24px;
        }
        
        .alert {
            padding: 14px 16px;
            border-radius: 10px;
            font-size: 14px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            animation: slideDown 0.3s ease-out;
        }
        
        .alert-success {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
        }
        
        .alert-danger {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: var(--ecom-red-dark);
        }
        
        .alert-info {
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            color: #1e40af;
        }
        
        .alert i {
            font-size: 16px;
            margin-top: 1px;
        }
        
        .form-group {
            margin-bottom: 24px;
        }
        
        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: var(--ecom-gray-dark);
            margin-bottom: 8px;
        }
        
        .input-group {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--ecom-gray);
            font-size: 18px;
            z-index: 2;
        }
        
        .form-control {
            width: 100%;
            padding: 14px 16px 14px 48px;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            background-color: var(--ecom-white);
            color: var(--ecom-gray-dark);
            transition: all 0.2s ease;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--ecom-red);
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }
        
        .form-control.is-invalid {
            border-color: var(--ecom-red);
        }
        
        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--ecom-gray);
            cursor: pointer;
            font-size: 18px;
            z-index: 2;
            padding: 4px;
            transition: color 0.2s;
        }
        
        .password-toggle:hover {
            color: var(--ecom-red);
        }
        
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }
        
        .checkbox-container {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }
        
        .checkbox-container input[type="checkbox"] {
            width: 18px;
            height: 18px;
            border-radius: 4px;
            border: 1px solid #d1d5db;
            cursor: pointer;
            accent-color: var(--ecom-red);
        }
        
        .checkbox-label {
            font-size: 14px;
            color: var(--ecom-gray-dark);
            user-select: none;
        }
        
        .forgot-link {
            font-size: 14px;
            color: var(--ecom-red);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }
        
        .forgot-link:hover {
            color: var(--ecom-red-dark);
            text-decoration: underline;
        }
        
        .btn-login {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, var(--ecom-red) 0%, var(--ecom-red-dark) 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(220, 38, 38, 0.25);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .security-notice {
            margin-top: 32px;
            padding: 16px;
            background-color: var(--ecom-gray-light);
            border-radius: 10px;
            text-align: center;
            font-size: 13px;
            color: var(--ecom-gray);
        }
        
        .security-notice i {
            color: var(--ecom-red);
            margin-right: 6px;
        }
        
        .login-footer {
            padding: 24px 40px;
            text-align: center;
            border-top: 1px solid var(--ecom-gray-light);
            color: var(--ecom-gray);
            font-size: 13px;
        }
        
        .login-footer a {
            color: var(--ecom-red);
            text-decoration: none;
            font-weight: 500;
        }
        
        .login-footer a:hover {
            text-decoration: underline;
        }
        
        .invalid-feedback {
            color: var(--ecom-red);
            font-size: 13px;
            margin-top: 6px;
            display: block;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        
        @media (max-width: 576px) {
            .login-wrapper {
                padding: 16px;
            }
            
            .login-header,
            .login-body {
                padding: 32px 24px;
            }
            
            .login-footer {
                padding: 20px 24px;
            }
            
            .header-title {
                font-size: 22px;
            }
            
            .logo-text {
                font-size: 24px;
            }
        }
        
        /* Loading animation for button */
        .btn-loading {
            position: relative;
            color: transparent !important;
        }
        
        .btn-loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <!-- Header -->
            <div class="login-header">
                <div class="brand-logo">
                    <div class="logo-icon">
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="logo-text">Ayitibook</div>
                </div>
                
                <h1 class="header-title">Admin Portal</h1>
            </div>
            
            <!-- Body -->
            <div class="login-body">
                @if(session('success'))
                    <div class="alert-container">
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert-container">
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle"></i>
                            <div>
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('admin.login') }}" id="loginForm">
                    @csrf
                    
                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-group">
                            <i class="input-icon fas fa-user"></i>
                            <input 
                                type="email" 
                                id="email" 
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                placeholder="admin@store.com"
                                required
                                autofocus
                            >
                        </div>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <i class="input-icon fas fa-lock"></i>
                            <input 
                                type="password" 
                                id="password" 
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="••••••••"
                                required
                            >
                            <button type="button" class="password-toggle" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Options -->
                    <div class="form-options">
                        <label class="checkbox-container">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class="checkbox-label">Remember me</span>
                        </label>
                        
                        <a href="#" class="forgot-link">Forgot password?</a>
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" class="btn-login" id="loginButton">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Sign In to Dashboard</span>
                    </button>
                    
                    <!-- Security Notice -->
                </form>
            </div>
            
           
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const toggleIcon = togglePassword.querySelector('i');
            
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Toggle eye icon
                if (type === 'text') {
                    toggleIcon.classList.remove('fa-eye');
                    toggleIcon.classList.add('fa-eye-slash');
                } else {
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye');
                }
            });
            
            // Form submission with loading state
            const loginForm = document.getElementById('loginForm');
            const loginButton = document.getElementById('loginButton');
            
            loginForm.addEventListener('submit', function() {
                // Add loading state to button
                loginButton.classList.add('btn-loading');
                loginButton.disabled = true;
            });
            
            // Auto focus on email if there's an error
            @if($errors->has('email'))
                document.getElementById('email').focus();
            @endif
            
            // Auto-hide alerts after 5 seconds
            setTimeout(() => {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-10px)';
                    alert.style.transition = 'opacity 0.3s, transform 0.3s';
                    
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 300);
                });
            }, 5000);
            
            // Add subtle animation to card on load
            const loginCard = document.querySelector('.login-card');
            loginCard.style.opacity = '0';
            loginCard.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                loginCard.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                loginCard.style.opacity = '1';
                loginCard.style.transform = 'translateY(0)';
            }, 100);
            
            // Add floating animation to logo icon
            const logoIcon = document.querySelector('.logo-icon');
            setInterval(() => {
                logoIcon.style.transform = 'translateY(-4px)';
                setTimeout(() => {
                    logoIcon.style.transform = 'translateY(0)';
                }, 1500);
            }, 3000);
        });
    </script>
</body>
</html>