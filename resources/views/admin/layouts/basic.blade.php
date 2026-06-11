<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>@yield('title', 'Dashboard') — {{ config('app.name', 'AdminPanel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        /* ════════════════════════════════════════
       TOKENS
    ════════════════════════════════════════ */
        :root {
            --ink: #0d0f14;
            --ink-2: #1e2230;
            --ink-3: #2d3348;
            --surface: #f4f5f8;
            --surface-2: #eceef3;
            --white: #ffffff;
            --accent: #3b5bdb;
            --accent-dim: #eef1fd;
            --accent-2: #1971c2;
            --green: #087f5b;
            --green-bg: #d3f9d8;
            --amber: #e67700;
            --amber-bg: #fff3bf;
            --red: #c92a2a;
            --red-bg: #ffe3e3;
            --border: #e2e5ec;
            --muted: #6b7280;
            --sidebar-w: 240px;
            --navbar-h: 56px;
            --radius: 10px;
            --radius-lg: 16px;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, .06), 0 1px 2px rgba(0, 0, 0, .04);
            --shadow: 0 4px 12px rgba(0, 0, 0, .07), 0 2px 4px rgba(0, 0, 0, .04);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--surface);
            color: var(--ink);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ════════════════════════════════════════
       SHELL
    ════════════════════════════════════════ */
        .shell {
            display: flex;
            min-height: 100vh;
        }

        /* ════════════════════════════════════════
       SIDEBAR
    ════════════════════════════════════════ */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--ink);
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 200;
            display: flex;
            flex-direction: column;
            transition: transform .25s cubic-bezier(.4, 0, .2, 1);
            overflow: hidden;
        }

        .sidebar::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cpath d='M0 40L40 0H20L0 20M40 40V20L20 40' fill='%23ffffff' fill-opacity='0.015'/%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
        }

        /* Logo */
        .sidebar__logo {
            padding: 1.1rem 1.3rem;
            border-bottom: 1px solid rgba(255, 255, 255, .07);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
            text-decoration: none;
        }

        .sidebar__logo-inner {
            display: flex;
            align-items: center;
            gap: .7rem;
        }

        .logo-mark {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .9rem;
            color: #fff;
            flex-shrink: 0;
        }

        .logo-name {
            font-family: 'Syne', sans-serif;
            font-size: 1rem;
            font-weight: 800;
            color: var(--white);
            letter-spacing: -.01em;
        }

        .logo-name span {
            color: #748ffc;
        }

        .sidebar-close {
            display: none;
            background: none;
            border: none;
            color: rgba(255, 255, 255, .4);
            font-size: .9rem;
            cursor: pointer;
            padding: .25rem;
            transition: color .13s;
        }

        .sidebar-close:hover {
            color: rgba(255, 255, 255, .8);
        }

        /* Scroll area */
        .sidebar__scroll {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding: .75rem 0 1.5rem;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, .1) transparent;
        }

        .sidebar__scroll::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar__scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar__scroll::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, .1);
            border-radius: 4px;
        }

        /* Menu group */
        .menu-group {
            margin-bottom: .25rem;
        }

        .menu-group__title {
            padding: .75rem 1.3rem .3rem;
            font-family: 'Syne', sans-serif;
            font-size: .62rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, .28);
        }

        /* Menu item */
        .menu-item {
            display: flex;
            align-items: center;
            gap: .7rem;
            padding: .58rem 1.3rem;
            margin: 1px .6rem;
            border-radius: 8px;
            color: rgba(255, 255, 255, .55);
            text-decoration: none;
            font-size: .84rem;
            font-weight: 400;
            transition: background .13s, color .13s;
        }

        .menu-item i {
            width: 18px;
            font-size: .82rem;
            text-align: center;
            flex-shrink: 0;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, .07);
            color: rgba(255, 255, 255, .9);
        }

        .menu-item.active {
            background: var(--accent);
            color: #fff;
            font-weight: 500;
        }

        /* Sidebar footer */
        .sidebar__footer {
            flex-shrink: 0;
            padding: .9rem 1.3rem;
            border-top: 1px solid rgba(255, 255, 255, .07);
            display: flex;
            align-items: center;
            gap: .7rem;
        }

        .sidebar__footer-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4263eb, #7048e8);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne', sans-serif;
            font-size: .8rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .sidebar__footer-info {
            flex: 1;
            overflow: hidden;
        }

        .sidebar__footer-name {
            font-size: .78rem;
            font-weight: 600;
            color: rgba(255, 255, 255, .85);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.2;
        }

        .sidebar__footer-role {
            font-size: .68rem;
            color: rgba(255, 255, 255, .35);
        }

        .sidebar__footer-btn {
            background: none;
            border: none;
            color: rgba(255, 255, 255, .3);
            font-size: .78rem;
            cursor: pointer;
            padding: .25rem;
            flex-shrink: 0;
            transition: color .13s;
        }

        .sidebar__footer-btn:hover {
            color: rgba(255, 255, 255, .7);
        }

        /* ════════════════════════════════════════
       MAIN COLUMN
    ════════════════════════════════════════ */
        .main {
            flex: 1;
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left .25s cubic-bezier(.4, 0, .2, 1);
        }

        /* ════════════════════════════════════════
       TOP NAVBAR
    ════════════════════════════════════════ */
        .navbar {
            height: var(--navbar-h);
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: var(--shadow-sm);
        }

        .navbar__left {
            display: flex;
            align-items: center;
            gap: .75rem;
        }

        .navbar__hamburger {
            display: none;
            background: none;
            border: none;
            color: var(--muted);
            font-size: 1.1rem;
            cursor: pointer;
            padding: .35rem;
            border-radius: 6px;
            transition: background .13s, color .13s;
        }

        .navbar__hamburger:hover {
            background: var(--surface-2);
            color: var(--ink);
        }

        .navbar__page-title {
            font-family: 'Syne', sans-serif;
            font-size: .95rem;
            font-weight: 700;
            color: var(--ink);
        }

        .navbar__right {
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .navbar__welcome {
            font-size: .8rem;
            color: var(--muted);
            padding-right: .5rem;
            border-right: 1px solid var(--border);
            margin-right: .15rem;
            white-space: nowrap;
        }

        .navbar__avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4263eb, #7048e8);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne', sans-serif;
            font-size: .78rem;
            font-weight: 800;
            color: #fff;
            cursor: default;
            flex-shrink: 0;
        }

        /* ════════════════════════════════════════
       ALERTS
    ════════════════════════════════════════ */
        .alert {
            display: flex;
            align-items: flex-start;
            gap: .65rem;
            padding: .85rem 1.1rem;
            border-radius: var(--radius);
            margin-bottom: 1.25rem;
            font-size: .84rem;
            border: 1px solid;
            position: relative;
        }

        .alert i {
            font-size: .85rem;
            margin-top: .06rem;
            flex-shrink: 0;
        }

        .alert-success {
            background: var(--green-bg);
            color: var(--green);
            border-color: rgba(8, 127, 91, .2);
        }

        .alert-danger {
            background: var(--red-bg);
            color: var(--red);
            border-color: rgba(201, 42, 42, .2);
        }

        .alert__close {
            position: absolute;
            top: .7rem;
            right: .75rem;
            background: none;
            border: none;
            cursor: pointer;
            font-size: .75rem;
            opacity: .5;
            color: currentColor;
            transition: opacity .13s;
        }

        .alert__close:hover {
            opacity: 1;
        }

        /* ════════════════════════════════════════
       CONTENT + FOOTER
    ════════════════════════════════════════ */
        .content {
            flex: 1;
            padding: 1.5rem;
        }

        .footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border);
            background: var(--white);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: .5rem;
        }

        .footer__copy {
            font-size: .75rem;
            color: var(--muted);
        }

        .footer__version {
            font-family: 'Syne', sans-serif;
            font-size: .68rem;
            font-weight: 600;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: .3rem;
        }

        .footer__version i {
            font-size: .58rem;
            color: var(--green);
        }

        /* ════════════════════════════════════════
       SIDEBAR OVERLAY (mobile)
    ════════════════════════════════════════ */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .45);
            z-index: 199;
            backdrop-filter: blur(2px);
        }

        /* ════════════════════════════════════════
       RESPONSIVE
    ════════════════════════════════════════ */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
                box-shadow: 4px 0 24px rgba(0, 0, 0, .25);
            }

            .sidebar-close {
                display: flex !important;
            }

            .sidebar-overlay.open {
                display: block;
            }

            .main {
                margin-left: 0;
            }

            .navbar__hamburger {
                display: flex;
            }

            .navbar__welcome {
                display: none;
            }
        }

        /* ════════════════════════════════════════
       GLOBAL CHILD RESETS
    ════════════════════════════════════════ */
        a {
            color: inherit;
        }

        .pagination .page-link {
            font-family: 'DM Sans', sans-serif;
            font-size: .78rem;
            color: var(--ink-3);
            border-color: var(--border);
            border-radius: 6px !important;
            margin: 0 2px;
            padding: .35rem .65rem;
            transition: background .12s, color .12s;
        }

        .pagination .page-link:hover {
            background: var(--surface-2);
            color: var(--ink);
        }

        .pagination .page-item.active .page-link {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }
    </style>

    @stack('styles')
</head>

<body>

    <div class="shell">

        {{-- ── SIDEBAR ──────────────────────── --}}
        <aside class="sidebar" id="sidebar">

            <a href="{{ route('admin.dashboard') }}" class="sidebar__logo">
                <div class="sidebar__logo-inner">
                    <div class="logo-mark"><i class="fas fa-store"></i></div>
                    <div class="logo-name">Admin<span>Panel</span></div>
                </div>
                <button class="sidebar-close" id="sidebarClose" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </a>

            <div class="sidebar__scroll">

                {{-- ─────────────────────────────────────────────────────────
                     Helper: capture current admin role once for reuse
                ───────────────────────────────────────────────────────────── --}}
                @php $adminRole = auth()->guard('admin')->user()->role; @endphp

                {{-- ══════════════════════════════════════════════════════════
                     MAIN — all roles (admin, manager, support)
                ══════════════════════════════════════════════════════════════ --}}
                <div class="menu-group">
                    <div class="menu-group__title">Main</div>
                    <a href="{{ route('admin.dashboard') }}"
                        class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-chart-line"></i><span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.analytics') }}"
                        class="menu-item {{ request()->routeIs('admin.analytics') ? 'active' : '' }}">
                        <i class="fas fa-chart-bar"></i><span>Analytics</span>
                    </a>
                </div>

                {{-- ══════════════════════════════════════════════════════════
                     OPERATIONS — all roles (admin, manager, support)
                     Orders & Refunds: view + status update only for support
                ══════════════════════════════════════════════════════════════ --}}
                <div class="menu-group">
                    <div class="menu-group__title">Operations</div>
                    <a href="{{ route('admin.orders.index') }}"
                        class="menu-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                        <i class="fas fa-shopping-cart"></i><span>Orders</span>
                    </a>
                    <a href="{{ route('admin.refunds.index') }}"
                        class="menu-item {{ request()->routeIs('admin.refunds.*') ? 'active' : '' }}">
                        <i class="fas fa-undo-alt"></i><span>Refunds & Returns</span>
                    </a>
                </div>

                {{-- ══════════════════════════════════════════════════════════
                     MANAGEMENT — manager and admin only
                ══════════════════════════════════════════════════════════════ --}}
                @if(in_array($adminRole, ['admin', 'manager']))
                <div class="menu-group">
                    <div class="menu-group__title">Management</div>
                    <a href="{{ route('admin.users.index') }}"
                        class="menu-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i><span>Users</span>
                    </a>
                    <a href="{{ route('admin.sellers.index') }}"
                        class="menu-item {{ request()->routeIs('admin.sellers.*') ? 'active' : '' }}">
                        <i class="fas fa-user-tie"></i><span>Sellers</span>
                    </a>
                    <a href="{{ route('admin.products.index') }}"
                        class="menu-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <i class="fas fa-box"></i><span>Products</span>
                    </a>
                    <a href="{{ route('admin.delivery-partners.index') }}"
                        class="menu-item {{ request()->routeIs('admin.delivery-partners.*') ? 'active' : '' }}">
                        <i class="fas fa-truck"></i><span>Delivery Partners</span>
                    </a>
                    <a href="{{ route('admin.bnpl.index') }}"
                        class="menu-item {{ request()->routeIs('admin.bnpl*') ? 'active' : '' }}">
                        <i class="fas fa-credit-card"></i><span>BNPL</span>
                    </a>
                    <a href="{{ route('admin.affiliate.index') }}"
                        class="menu-item {{ request()->routeIs('admin.affiliate.index') ? 'active' : '' }}">
                        <i class="fas fa-handshake"></i><span>Affiliates</span>
                    </a>
                    <a href="{{ route('admin.affiliate.tracked-products') }}"
                        class="menu-item {{ request()->routeIs('admin.affiliate.tracked-products') ? 'active' : '' }}">
                        <i class="fas fa-eye"></i><span>Tracked Products</span>
                    </a>
                </div>
                @endif

                {{-- ══════════════════════════════════════════════════════════
                     SYSTEM — all roles (admin, manager, support)
                     Admin Users link: admin only
                ══════════════════════════════════════════════════════════════ --}}
                <div class="menu-group">
                    <div class="menu-group__title">System</div>
                    <a href="{{ route('admin.activity') }}"
                        class="menu-item {{ request()->routeIs('admin.activity') ? 'active' : '' }}">
                        <i class="fas fa-history"></i><span>Activity Log</span>
                    </a>
                    <a href="{{ route('admin.profile') }}"
                        class="menu-item {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                        <i class="fas fa-user-cog"></i><span>Profile</span>
                    </a>
                    @if($adminRole === 'admin')
                    <a href="{{ route('admin.admins.index') }}"
                        class="menu-item {{ request()->routeIs('admin.admins.*') ? 'active' : '' }}">
                        <i class="fas fa-users-cog"></i><span>Admin Users</span>
                    </a>
                    @endif
                </div>

            </div>

            <div class="sidebar__footer">
                <div class="sidebar__footer-avatar">
                    {{ strtoupper(substr(auth()->guard('admin')->user()->name, 0, 1)) }}
                </div>
                <div class="sidebar__footer-info">
                    <div class="sidebar__footer-name">{{ auth()->guard('admin')->user()->name }}</div>
                    <div class="sidebar__footer-role">{{ ucfirst(auth()->guard('admin')->user()->role) }}</div>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST" style="display:contents">
                    @csrf
                    <button type="submit" class="sidebar__footer-btn" title="Sign out">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>

        </aside>

        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        {{-- ── MAIN COLUMN ──────────────────── --}}
        <div class="main">

            <nav class="navbar">
                <div class="navbar__left">
                    <button class="navbar__hamburger" id="hamburger" aria-label="Menu">
                        <i class="fas fa-bars"></i>
                    </button>
                    <span class="navbar__page-title">@yield('page-title', 'Dashboard')</span>
                </div>
                <div class="navbar__right">
                    <span class="navbar__welcome">
                        Welcome, {{ auth()->guard('admin')->user()->name }}
                    </span>
                    <div class="navbar__avatar">
                        {{ strtoupper(substr(auth()->guard('admin')->user()->name, 0, 1)) }}
                    </div>
                </div>
            </nav>

            <main class="content">

                @if (session('success'))
                    <div class="alert alert-success" id="successAlert">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('success') }}</span>
                        <button class="alert__close" onclick="this.closest('.alert').remove()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        <div>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                        <button class="alert__close" onclick="this.closest('.alert').remove()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                @yield('content')
            </main>



        </div>
    </div>

    <script>
        (function() {
            var sidebar = document.getElementById('sidebar');
            var overlay = document.getElementById('sidebarOverlay');
            var hamburger = document.getElementById('hamburger');
            var closeBtn = document.getElementById('sidebarClose');

            function open() {
                sidebar.classList.add('open');
                overlay.classList.add('open');
                document.body.style.overflow = 'hidden';
            }

            function close() {
                sidebar.classList.remove('open');
                overlay.classList.remove('open');
                document.body.style.overflow = '';
            }

            if (hamburger) hamburger.addEventListener('click', open);
            if (closeBtn) closeBtn.addEventListener('click', close);
            if (overlay) overlay.addEventListener('click', close);

            // Auto-dismiss success alert
            var sa = document.getElementById('successAlert');
            if (sa) {
                setTimeout(function() {
                    sa.style.transition = 'opacity .4s';
                    sa.style.opacity = '0';
                    setTimeout(function() {
                        sa.remove();
                    }, 420);
                }, 4000);
            }

            // Child-page charts hook
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof initializeCharts === 'function') initializeCharts();
            });
        }());
    </script>

    @stack('scripts')
</body>

</html>