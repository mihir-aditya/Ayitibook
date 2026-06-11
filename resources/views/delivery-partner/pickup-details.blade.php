{{-- resources/views/delivery-partner/pickup-details.blade.php --}}
@extends('delivery-partner.layouts.app')

@section('title', 'Pickup Details - Order #' . $pickup->order->order_id)

@section('content')
<div class="container-fluid px-4">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-gray-800">Pickup Details</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('delivery-partner.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('delivery-partner.my-pickups') }}">My Pickups</a></li>
                    <li class="breadcrumb-item active">Order #{{ $pickup->order->order_id }}</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('delivery-partner.my-pickups') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Pickups
            </a>
        </div>
    </div>

    <!-- Status Update Card -->
    @if(!in_array($pickup->status, ['delivered', 'failed', 'returned']))
        <div class="card mb-4 bg-light">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="fas fa-sync-alt me-2"></i>Update Delivery Status
                </h5>
                <form action="{{ route('delivery-partner.pickups.update-status', $pickup) }}" 
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row align-items-end">
                        <div class="col-md-4">
                            <label class="form-label">Current Status</label>
                            <select name="status" class="form-select" id="statusSelect">
                                @if($pickup->status == 'assigned')
                                    <option value="picked_up">Mark as Picked Up</option>
                                @endif
                                @if(in_array($pickup->status, ['assigned', 'picked_up']))
                                    <option value="in_transit">Mark as In Transit</option>
                                @endif
                                @if(in_array($pickup->status, ['assigned', 'picked_up', 'in_transit']))
                                    <option value="delivered">Mark as Delivered</option>
                                    <option value="failed">Mark as Failed</option>
                                @endif
                            </select>
                        </div>
                        
                        <div class="col-md-3" id="otpField" style="display: none;">
                            <label class="form-label">Delivery OTP</label>
                            <input type="text" name="otp" class="form-control" maxlength="6" 
                                   placeholder="Enter 6-digit OTP">
                        </div>
                        
                        <div class="col-md-3" id="proofField" style="display: none;">
                            <label class="form-label">Delivery Proof (Photo)</label>
                            <input type="file" name="proof" class="form-control" accept="image/*">
                        </div>
                        
                        <div class="col-md-2" id="failedReasonField" style="display: none;">
                            <label class="form-label">Reason for Failure</label>
                            <select name="cancellation_reason" class="form-select">
                                <option value="customer_not_available">Customer Not Available</option>
                                <option value="wrong_address">Wrong Address</option>
                                <option value="damaged_package">Damaged Package</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-check me-2"></i>Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <div class="row">
        <!-- Order Information -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <i class="fas fa-shopping-bag me-2"></i>Order Information
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th style="width: 40%">Order ID:</th>
                            <td><strong>#{{ $pickup->order->order_id }}</strong></td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                <span class="badge badge-{{ $pickup->status }}">
                                    {{ str_replace('_', ' ', ucfirst($pickup->status)) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Total Amount:</th>
                            <td>${{ number_format($pickup->order->total_amount, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Payment Method:</th>
                            <td>{{ $pickup->order->payment_method }}</td>
                        </tr>
                        <tr>
                            <th>Delivery Fee:</th>
                            <td class="text-success fw-bold">${{ number_format($pickup->delivery_fee, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Placed At:</th>
                            <td>{{ \Carbon\Carbon::parse($pickup->order->placed_at)->format('M d, Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Delivery Timeline -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <i class="fas fa-clock me-2"></i>Delivery Timeline
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <h6 class="mb-0">Assigned</h6>
                                <small class="text-muted">{{ $pickup->assigned_at->format('M d, Y H:i') }}</small>
                            </div>
                        </div>
                        
                        @if($pickup->picked_up_at)
                            <div class="timeline-item">
                                <div class="timeline-marker bg-info"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-0">Picked Up</h6>
                                    <small class="text-muted">{{ $pickup->picked_up_at->format('M d, Y H:i') }}</small>
                                </div>
                            </div>
                        @endif
                        
                        @if($pickup->delivered_at)
                            <div class="timeline-item">
                                <div class="timeline-marker bg-success"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-0">Delivered</h6>
                                    <small class="text-muted">{{ $pickup->delivered_at->format('M d, Y H:i') }}</small>
                                </div>
                            </div>
                        @endif
                        
                        @if($pickup->cancellation_reason)
                            <div class="timeline-item">
                                <div class="timeline-marker bg-danger"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-0">Failed</h6>
                                    <small class="text-muted">Reason: {{ $pickup->cancellation_reason }}</small>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Pickup Address -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-store me-2"></i>Pickup From (Seller)
                </div>
                <div class="card-body">
                    <h6 class="fw-bold">{{ $pickup->seller->store_name ?? $pickup->seller->name }}</h6>
                    <p class="mb-1">{{ $pickup->seller->email }}</p>
                    <p class="mb-1">{{ $pickup->seller->phone }}</p>
                    <hr>
                    <p class="mb-0">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        {{ $pickup->pickup_address }}
                    </p>
                    @if($pickup->status == 'assigned')
                        <button class="btn btn-sm btn-outline-primary mt-3" onclick="showDirections('pickup')">
                            <i class="fas fa-directions me-2"></i>Get Directions
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Delivery Address -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-danger text-white">
                    <i class="fas fa-map-pin me-2"></i>Deliver To (Customer)
                </div>
                <div class="card-body">
                    <h6 class="fw-bold">{{ $pickup->order->user->name ?? 'Customer' }}</h6>
                    <p class="mb-1">{{ $pickup->order->user->email ?? 'N/A' }}</p>
                    <p class="mb-1">{{ $pickup->order->user->phone ?? 'N/A' }}</p>
                    <hr>
                    <p class="mb-0">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        {{ $pickup->delivery_address }}
                    </p>
                    @if($pickup->delivery_otp && !$pickup->otp_verified)
                        <div class="alert alert-info mt-3 mb-0">
                            <i class="fas fa-key me-2"></i>
                            <strong>Delivery OTP:</strong> {{ $pickup->delivery_otp }}
                        </div>
                    @endif
                    @if(in_array($pickup->status, ['assigned', 'picked_up', 'in_transit']))
                        <button class="btn btn-sm btn-outline-danger mt-3" onclick="showDirections('delivery')">
                            <i class="fas fa-directions me-2"></i>Get Directions
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Delivery Proof (if delivered) -->
        @if($pickup->delivery_proof && count($pickup->delivery_proof) > 0)
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-camera me-2"></i>Delivery Proof
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($pickup->delivery_proof as $proof)
                                @if(is_array($proof) && $proof['type'] == 'image')
                                    <div class="col-md-3">
                                        <img src="{{ asset('storage/' . $proof['path']) }}" 
                                             class="img-fluid rounded" alt="Delivery Proof">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Map -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-map-marked-alt me-2"></i>Route Map
                </div>
                <div class="card-body">
                    <div id="routeMap" style="height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
<script>
    let map;
    let directionsService;
    let directionsRenderer;

    function initMap() {
        directionsService = new google.maps.DirectionsService();
        directionsRenderer = new google.maps.DirectionsRenderer();
        
        // Default center
        const center = { lat: 40.7128, lng: -74.0060 };
        
        map = new google.maps.Map(document.getElementById('routeMap'), {
            center: center,
            zoom: 12
        });
        
        directionsRenderer.setMap(map);
    }

    function showDirections(type) {
        // Get coordinates from addresses (you'll need to geocode the addresses)
        // This is a placeholder - you need to implement geocoding
        const origin = type === 'pickup' ? '{{ $pickup->pickup_address }}' : '{{ Auth::guard('delivery_partner')->user()->current_latitude }},{{ Auth::guard('delivery_partner')->user()->current_longitude }}';
        const destination = type === 'pickup' ? '{{ $pickup->delivery_address }}' : '{{ $pickup->pickup_address }}';
        
        const request = {
            origin: origin,
            destination: destination,
            travelMode: 'DRIVING'
        };
        
        directionsService.route(request, function(result, status) {
            if (status == 'OK') {
                directionsRenderer.setDirections(result);
            }
        });
    }

    // Show fields based on status selection
    document.getElementById('statusSelect')?.addEventListener('change', function() {
        const otpField = document.getElementById('otpField');
        const proofField = document.getElementById('proofField');
        const failedField = document.getElementById('failedReasonField');
        
        otpField.style.display = 'none';
        proofField.style.display = 'none';
        failedField.style.display = 'none';
        
        if (this.value === 'delivered') {
            otpField.style.display = 'block';
            proofField.style.display = 'block';
        } else if (this.value === 'failed') {
            failedField.style.display = 'block';
        }
    });
</script>
@endpush

@push('styles')
<style>
    .timeline {
        position: relative;
        padding-left: 30px;
    }
    .timeline-item {
        position: relative;
        padding-bottom: 20px;
    }
    .timeline-marker {
        position: absolute;
        left: -30px;
        width: 15px;
        height: 15px;
        border-radius: 50%;
        border: 2px solid #fff;
    }
    .timeline-content {
        padding-left: 15px;
    }
    .timeline-item:not(:last-child):before {
        content: '';
        position: absolute;
        left: -23px;
        top: 20px;
        bottom: 0;
        width: 2px;
        background: #e3e6f0;
    }
</style>
@endpush
@endsection