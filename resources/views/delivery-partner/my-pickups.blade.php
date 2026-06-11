{{-- resources/views/delivery-partner/my-pickups.blade.php --}}
@extends('delivery-partner.layouts.app')

@section('title', 'My Pickups')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-gray-800">My Pickups</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('delivery-partner.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">My Pickups</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('delivery-partner.available-pickups') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i>Find New Pickups
            </a>
        </div>
    </div>

    <!-- Status Filter Tabs -->
    <div class="card mb-4">
        <div class="card-body">
            <ul class="nav nav-pills nav-fill">
                <li class="nav-item">
                    <a class="nav-link {{ !request('status') ? 'active' : '' }}" 
                       href="{{ route('delivery-partner.my-pickups') }}">
                        All
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'assigned' ? 'active' : '' }}" 
                       href="{{ route('delivery-partner.my-pickups', ['status' => 'assigned']) }}">
                        Assigned
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'picked_up' ? 'active' : '' }}" 
                       href="{{ route('delivery-partner.my-pickups', ['status' => 'picked_up']) }}">
                        Picked Up
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'in_transit' ? 'active' : '' }}" 
                       href="{{ route('delivery-partner.my-pickups', ['status' => 'in_transit']) }}">
                        In Transit
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'delivered' ? 'active' : '' }}" 
                       href="{{ route('delivery-partner.my-pickups', ['status' => 'delivered']) }}">
                        Delivered
                    </a>
                </li>
            </ul>
        </div>
    </div>

    @if($pickups->isEmpty())
        <div class="card">
            <div class="card-body text-center py-5">
                <img src="https://via.placeholder.com/200?text=No+Pickups" 
                     alt="No pickups" class="mb-4" style="opacity: 0.5;">
                <h4 class="text-muted">No Pickups Found</h4>
                <p class="text-muted mb-4">You haven't accepted any pickups yet.</p>
                <a href="{{ route('delivery-partner.available-pickups') }}" class="btn btn-primary">
                    <i class="fas fa-box-open me-2"></i>View Available Pickups
                </a>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>Order #</th>
                                <th>Pickup From</th>
                                <th>Deliver To</th>
                                <th>Status</th>
                                <th>Assigned At</th>
                                <th>Delivery Fee</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pickups as $pickup)
                                <tr>
                                    <td>
                                        <span class="fw-bold">#{{ $pickup->order->order_id }}</span>
                                        @if($pickup->otp_verified)
                                            <span class="badge bg-success ms-2" title="OTP Verified">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-store text-success me-2"></i>
                                            <div>
                                                <div>{{ $pickup->seller->name ?? 'Seller' }}</div>
                                                <small class="text-muted">{{ Str::limit($pickup->pickup_address, 30) }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-map-pin text-danger me-2"></i>
                                            <div>
                                                <div>{{ $pickup->order->user->name ?? 'Customer' }}</div>
                                                <small class="text-muted">{{ Str::limit($pickup->delivery_address, 30) }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $pickup->status }}">
                                            {{ str_replace('_', ' ', ucfirst($pickup->status)) }}
                                        </span>
                                        @if($pickup->status === 'assigned' && $pickup->delivery_otp)
                                            <br>
                                            <small class="text-muted">OTP: <strong>{{ $pickup->delivery_otp }}</strong></small>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $pickup->assigned_at->format('M d, H:i') }}
                                        <br>
                                        <small class="text-muted">{{ $pickup->assigned_at->diffForHumans() }}</small>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-success">${{ number_format($pickup->delivery_fee, 2) }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('delivery-partner.pickups.show', $pickup) }}" 
                                           class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if(method_exists($pickups, 'links'))
                <div class="card-footer">
                    {{ $pickups->withQueryString()->links() }}
                </div>
            @endif
        </div>
    @endif
</div>

@push('styles')
<style>
    .nav-pills .nav-link.active {
        background-color: #4e73df;
    }
    .badge-assigned { background: #4e73df; color: white; }
    .badge-picked_up { background: #36b9cc; color: white; }
    .badge-in_transit { background: #1cc88a; color: white; }
    .badge-delivered { background: #1cc88a; color: white; }
    .badge-failed { background: #e74a3b; color: white; }
    .badge-returned { background: #858796; color: white; }
</style>
@endpush
@endsection