{{-- resources/views/delivery-partner/available-pickups.blade.php --}}
@extends('delivery-partner.layouts.app')

@section('title', 'Available Pickups')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-gray-800">Available Pickups</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('delivery-partner.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Available Pickups</li>
                </ol>
            </nav>
        </div>
        <div class="text-muted">
            <i class="fas fa-box-open me-2"></i>
            <span class="fw-bold">{{ $availableOrders->count() }}</span> orders available
        </div>
    </div>

    @if(!Auth::guard('delivery_partner')->user()->is_online)
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle me-2"></i>
            You are currently offline. Go online to see available pickups and accept orders.
            <form action="{{ route('delivery-partner.toggle-online') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-success ms-3">
                    <i class="fas fa-play me-1"></i>Go Online Now
                </button>
            </form>
        </div>
    @endif

    @if($availableOrders->isEmpty())
        <div class="card">
            <div class="card-body text-center py-5">
                <img src="https://via.placeholder.com/200?text=No+Available+Orders" 
                     alt="No orders" class="mb-4" style="opacity: 0.5;">
                <h4 class="text-muted">No Available Pickups</h4>
                <p class="text-muted mb-4">There are no orders available for pickup at the moment.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('delivery-partner.dashboard') }}" class="btn btn-primary">
                        <i class="fas fa-home me-2"></i>Back to Dashboard
                    </a>
                    <button onclick="location.reload()" class="btn btn-outline-secondary">
                        <i class="fas fa-sync-alt me-2"></i>Refresh
                    </button>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            @foreach($availableOrders as $order)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <span>
                                <i class="fas fa-box text-primary me-2"></i>
                                Order #{{ $order->order_id }}
                            </span>
                            <span class="badge bg-warning">Ready for Pickup</span>
                        </div>
                        <div class="card-body">
                            <!-- Seller Information -->
                            <div class="mb-3">
                                <h6 class="fw-bold mb-2">
                                    <i class="fas fa-store me-2 text-success"></i>Pickup From:
                                </h6>
                                <p class="mb-1">{{ $order->seller->store_name ?? $order->seller->name }}</p>
                                <p class="small text-muted mb-0">
                                    <i class="fas fa-map-marker-alt me-1"></i>
                                    {{ $order->seller->address ?? 'Address not available' }}
                                </p>
                            </div>

                            <!-- Customer Information -->
                            <div class="mb-3">
                                <h6 class="fw-bold mb-2">
                                    <i class="fas fa-user me-2 text-info"></i>Deliver To:
                                </h6>
                                <p class="mb-1">{{ $order->user->name ?? 'Customer' }}</p>
                                <p class="small text-muted mb-0">
                                    <i class="fas fa-map-marker-alt me-1"></i>
                                    {{ $order->shipping_address ?? 'Address not available' }}
                                </p>
                            </div>

                            <!-- Order Details -->
                            <div class="mb-3">
                                <h6 class="fw-bold mb-2">
                                    <i class="fas fa-shopping-bag me-2 text-warning"></i>Order Details:
                                </h6>
                                <div class="bg-light p-2 rounded">
                                    <p class="small mb-1">
                                        <strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}
                                    </p>
                                    <p class="small mb-1">
                                        <strong>Payment Method:</strong> {{ $order->payment_method }}
                                    </p>
                                    <p class="small mb-0">
                                        <strong>Placed:</strong> {{ \Carbon\Carbon::parse($order->placed_at)->diffForHumans() }}
                                    </p>
                                </div>
                            </div>

                            <!-- Estimated Delivery Fee -->
                            <div class="alert alert-info py-2 mb-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>
                                        <i class="fas fa-truck me-2"></i>Estimated Delivery Fee:
                                    </span>
                                    <span class="fw-bold">${{ number_format(rand(30, 80), 2) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <form action="{{ route('delivery-partner.accept-pickup', $order) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success w-100" 
                                        {{ !Auth::guard('delivery_partner')->user()->is_online ? 'disabled' : '' }}>
                                    <i class="fas fa-check-circle me-2"></i>Accept Pickup
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination if needed -->
        @if(method_exists($availableOrders, 'links'))
            <div class="mt-4">
                {{ $availableOrders->links() }}
            </div>
        @endif
    @endif
</div>
@endsection