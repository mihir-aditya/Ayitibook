{{-- resources/views/delivery-partner/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Delivery Partner Panel') - {{ config('app.name') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #4e73df;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
        }

        body {
            font-size: 0.9rem;
            background: #f8f9fc;
        }

        #wrapper {
            display: flex;
        }

        #content-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        #content {
            flex: 1;
            padding: 1.5rem 1.5rem 0;
        }

        /* Sidebar */
        .sidebar {
            min-width: 250px;
            max-width: 250px;
            background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
            color: #fff;
            transition: all 0.3s;
            min-height: 100vh;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .sidebar .sidebar-brand {
            height: 4.375rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .sidebar .nav-item {
            position: relative;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1rem;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .sidebar .nav-link i {
            margin-right: 0.5rem;
            width: 1.25rem;
            text-align: center;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar .nav-item .badge {
            float: right;
            margin-top: 0.2rem;
        }

        /* Topbar */
        .topbar {
            height: 4.375rem;
            background: #fff;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            margin-bottom: 1.5rem;
        }

        .topbar .nav-item .nav-link {
            padding: 0 1rem;
            height: 4.375rem;
            display: flex;
            align-items: center;
            color: #858796;
        }

        .topbar .nav-item .nav-link:hover {
            color: #4e73df;
        }

        .topbar .dropdown-menu {
            width: 300px;
            padding: 0;
        }

        .dropdown-item {
            padding: 0.5rem 1.5rem;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            margin-bottom: 1.5rem;
        }

        .card-header {
            background: #fff;
            border-bottom: 1px solid #e3e6f0;
            padding: 1rem 1.25rem;
            font-weight: 600;
            color: #4e73df;
        }

        /* Stats Cards */
        .stat-card {
            border-left: 0.25rem solid;
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card.primary {
            border-left-color: var(--primary-color);
        }

        .stat-card.success {
            border-left-color: var(--success-color);
        }

        .stat-card.info {
            border-left-color: var(--info-color);
        }

        .stat-card.warning {
            border-left-color: var(--warning-color);
        }

        .stat-card .stat-icon {
            font-size: 2rem;
            opacity: 0.3;
        }

        /* Status badges */
        .badge-status {
            padding: 0.35rem 0.65rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05rem;
        }

        .badge-pending { background: #f6c23e; color: #fff; }
        .badge-assigned { background: #4e73df; color: #fff; }
        .badge-picked_up { background: #36b9cc; color: #fff; }
        .badge-in_transit { background: #1cc88a; color: #fff; }
        .badge-delivered { background: #1cc88a; color: #fff; }
        .badge-failed { background: #e74a3b; color: #fff; }
        .badge-returned { background: #858796; color: #fff; }

        /* Online/Offline indicators */
        .online-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }

        .online { background: #1cc88a; box-shadow: 0 0 0 2px rgba(28, 200, 138, 0.2); }
        .offline { background: #858796; box-shadow: 0 0 0 2px rgba(133, 135, 150, 0.2); }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                min-width: 100%;
                max-width: 100%;
                min-height: auto;
            }
            
            #wrapper {
                flex-direction: column;
            }
        }

        /* Map container */
        #map {
            height: 400px;
            border-radius: 0.35rem;
        }

        /* Loading spinner */
        .spinner-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .spinner-overlay.show {
            display: flex;
        }
    </style>

    @stack('styles')
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-brand">
                <i class="fas fa-truck me-2"></i>
                <span>Delivery Panel</span>
            </div>

            <ul class="nav flex-column mt-3">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('delivery-partner.dashboard') ? 'active' : '' }}" 
                       href="{{ route('delivery-partner.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('delivery-partner.available-pickups') ? 'active' : '' }}" 
                       href="{{ route('delivery-partner.available-pickups') }}">
                        <i class="fas fa-box-open"></i>
                        <span>Available Pickups</span>
                        @php
                            $availableCount = \App\Models\Order::where('order_status', 'confirmed')
                                ->whereDoesntHave('deliveryPartnerPickup')
                                ->count();
                        @endphp
                        @if($availableCount > 0)
                            <span class="badge bg-danger">{{ $availableCount }}</span>
                        @endif
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('delivery-partner.my-pickups') ? 'active' : '' }}" 
                       href="{{ route('delivery-partner.my-pickups') }}">
                        <i class="fas fa-tasks"></i>
                        <span>My Pickups</span>
                        @php
                            $activeDeliveries = Auth::guard('delivery_partner')->user()->activePickups()->count();
                        @endphp
                        @if($activeDeliveries > 0)
                            <span class="badge bg-warning">{{ $activeDeliveries }}</span>
                        @endif
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('delivery-partner.earnings') ? 'active' : '' }}" 
                       href="{{ route('delivery-partner.earnings') }}">
                        <i class="fas fa-dollar-sign"></i>
                        <span>Earnings</span>
                    </a>
                </li>

                <li class="nav-item mt-4">
                    <hr class="bg-light opacity-25">
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('delivery-partner.profile') ? 'active' : '' }}" 
                       href="{{ route('delivery-partner.profile') }}">
                        <i class="fas fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('delivery-partner.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Content Wrapper -->
        <div id="content-wrapper">
            <!-- Topbar -->
            <nav class="topbar navbar navbar-expand navbar-light bg-white">
                <div class="container-fluid px-4">
                    <button class="btn btn-link d-md-none" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>

                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span class="online-indicator {{ Auth::guard('delivery_partner')->user()->is_online ? 'online' : 'offline' }}"></span>
                            <span class="fw-bold">{{ Auth::guard('delivery_partner')->user()->is_online ? 'Online' : 'Offline' }}</span>
                        </div>
                        
                        <form action="{{ route('delivery-partner.toggle-online') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm {{ Auth::guard('delivery_partner')->user()->is_online ? 'btn-outline-danger' : 'btn-outline-success' }}">
                                <i class="fas {{ Auth::guard('delivery_partner')->user()->is_online ? 'fa-power-off' : 'fa-play' }}"></i>
                                {{ Auth::guard('delivery_partner')->user()->is_online ? 'Go Offline' : 'Go Online' }}
                            </button>
                        </form>
                    </div>

                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <span class="me-2">{{ Auth::guard('delivery_partner')->user()->name }}</span>
                                <i class="fas fa-user-circle fa-2x"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('delivery-partner.profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw me-2"></i>Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw me-2"></i>Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <div id="content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>

            <!-- Footer -->
            
        </div>
    </div>

    <!-- Spinner Overlay -->
    <div class="spinner-overlay" id="spinner">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;"></div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        // Sidebar toggle for mobile
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('show');
        });

        // Show spinner on form submit
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                document.getElementById('spinner').classList.add('show');
            });
        });

        // Auto hide alerts after 5 seconds
        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.classList.remove('show');
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);

        // Online/Offline status toggle AJAX
        function updateLocation() {
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    fetch('{{ route("delivery-partner.update-location") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            latitude: position.coords.latitude,
                            longitude: position.coords.longitude
                        })
                    });
                });
            }
        }

        // Update location every 5 minutes if online
        @if(Auth::guard('delivery_partner')->user()->is_online)
            updateLocation();
            setInterval(updateLocation, 300000); // 5 minutes
        @endif
    </script>

    @stack('scripts')
</body>
</html>