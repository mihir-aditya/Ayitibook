<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seller Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="d-flex">

    <!-- Sidebar -->
    <div class="bg-dark text-white p-3" style="width:250px; min-height:100vh">
        <h4 class="mb-4">Seller Panel</h4>
<ul class="nav flex-column">
    <li class="nav-item mb-2">
        <a class="nav-link text-white" href="{{ route('seller.dashboard') }}">Dashboard</a>
    </li>

    <li class="nav-item mb-2">
        <a class="nav-link text-white" href="{{ route('seller.products.index') }}">Products</a>
    </li>

    <li class="nav-item mb-2">
        <a class="nav-link text-white" href="{{ route('seller.orders.index') }}">Orders</a>
    </li>

    <li class="nav-item mb-2">
        <a class="nav-link text-white" href="{{ route('seller.profile.edit') }}">Profile</a>
    </li>
    <li class="nav-item mb-2">
        <a class="nav-link text-white" href="{{ route('seller.logout') }}">Logout</a>
    </li>
</ul>

    </div>

    <!-- Main Content -->
    <div class="flex-fill p-4">
        @yield('content')
    </div>

</div>

</body>
</html>
