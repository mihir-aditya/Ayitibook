{{-- resources/views/delivery-partner/dashboard.blade.php --}}
@extends('delivery-partner.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-4">

    <!-- ── Page Heading ─────────────────────────────────────── -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-gray-800 mb-1">
                Welcome back, {{ $partner->name }}!
            </h1>
            {{-- Badge (inline) --}}
            <x-delivery-badge :partner="$partner" />
        </div>

        <div class="d-flex align-items-center">
            <div class="me-3">
                <span class="online-indicator {{ $partner->is_online ? 'online' : 'offline' }}"></span>
                <span class="fw-bold">{{ $partner->is_online ? 'Online' : 'Offline' }}</span>
            </div>
            <form action="{{ route('delivery-partner.toggle-online') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit"
                        class="btn btn-sm {{ $partner->is_online ? 'btn-outline-danger' : 'btn-outline-success' }}">
                    <i class="fas {{ $partner->is_online ? 'fa-power-off' : 'fa-play' }}"></i>
                    {{ $partner->is_online ? 'Go Offline' : 'Go Online' }}
                </button>
            </form>
        </div>
    </div>

    <!-- ── Statistics Cards ─────────────────────────────────── -->
    <div class="row g-4 mb-4">

        <!-- Active Deliveries -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card primary h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                                <i class="fas fa-tasks me-1"></i>Active Deliveries
                            </div>
                            <div class="h5 mb-0 fw-bold">{{ $stats['active_deliveries'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck fa-2x text-gray-300 stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Deliveries -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card success h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-success text-uppercase mb-1">
                                <i class="fas fa-check-circle me-1"></i>Total Deliveries
                            </div>
                            <div class="h5 mb-0 fw-bold">{{ $stats['total_deliveries'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-double fa-2x text-gray-300 stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rating -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card info h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-info text-uppercase mb-1">
                                <i class="fas fa-star me-1"></i>Rating
                            </div>
                            <div class="h5 mb-0 fw-bold">
                                {{ number_format($stats['rating'], 1) }}
                                <small class="text-muted">({{ $partner->total_ratings }} reviews)</small>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-star fa-2x text-gray-300 stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card warning h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                                <i class="fas fa-dollar-sign me-1"></i>Today's Earnings
                            </div>
                            <div class="h5 mb-0 fw-bold">
                                ${{ number_format($stats['today_deliveries'] * 5, 2) }}
                            </div>
                            <small class="text-muted">
                                ${{ number_format($stats['total_earnings'], 2) }} total
                            </small>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300 stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ── Badge Progress Card ───────────────────────────────── -->
    @php $badgeInfo = $partner->getBadgeInfo(); @endphp
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-start gap-4">

                        {{-- Current badge (large) --}}
                        <div class="text-center" style="min-width:120px">
                            <div class="mb-2">
                                <i class="{{ $badgeInfo['icon'] }} fa-3x"
                                   style="color:{{ $badgeInfo['color'] }}"></i>
                            </div>
                            <x-delivery-badge :partner="$partner" class="badge-lg" />
                            <div class="mt-1">
                                <small class="text-muted">Current Tier</small>
                            </div>
                        </div>

                        {{-- Stats breakdown --}}
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-3">
                                <i class="fas fa-chart-line me-2 text-primary"></i>
                                Badge Progress
                            </h6>
                            <div class="row g-3">
                                {{-- Deliveries --}}
                                <div class="col-sm-6 col-lg-3">
                                    <div class="p-3 bg-light rounded text-center">
                                        <div class="h4 fw-bold text-primary mb-0">
                                            {{ number_format($partner->total_deliveries) }}
                                        </div>
                                        <small class="text-muted">Total Deliveries</small>
                                    </div>
                                </div>
                                {{-- Rating --}}
                                <div class="col-sm-6 col-lg-3">
                                    <div class="p-3 bg-light rounded text-center">
                                        <div class="h4 fw-bold text-warning mb-0">
                                            {{ number_format($partner->rating, 1) }}
                                            <i class="fas fa-star fa-xs"></i>
                                        </div>
                                        <small class="text-muted">Rating</small>
                                    </div>
                                </div>
                                {{-- Success Rate --}}
                                <div class="col-sm-6 col-lg-3">
                                    <div class="p-3 bg-light rounded text-center">
                                        <div class="h4 fw-bold text-success mb-0">
                                            {{ number_format($partner->success_rate, 1) }}%
                                        </div>
                                        <small class="text-muted">Success Rate</small>
                                    </div>
                                </div>
                                {{-- Deposit --}}
                                <div class="col-sm-6 col-lg-3">
                                    <div class="p-3 bg-light rounded text-center">
                                        <div class="h4 fw-bold text-info mb-0">
                                            {{ number_format($partner->deposit_amount, 0) }}
                                        </div>
                                        <small class="text-muted">Deposit (HTG)</small>
                                    </div>
                                </div>
                            </div>

                            {{-- Next-tier hints --}}
                            @php $hints = $partner->getBadgeProgressHints(); @endphp
                            @if(count($hints))
                                <div class="mt-3 badge-progress-hints">
                                    <small class="fw-semibold text-muted d-block mb-1">
                                        <i class="fas fa-arrow-up me-1 text-warning"></i>
                                        What you need for the next tier:
                                    </small>
                                    @foreach($hints as $hint)
                                        <div class="small text-muted">
                                            <i class="fas fa-circle-dot me-1 text-warning" style="font-size:.6rem"></i>
                                            {{ $hint }}
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="mt-3 text-success small">
                                    <i class="fas fa-check-circle me-1"></i>
                                    You've reached the highest tier — keep up the excellent work!
                                </div>
                            @endif
                        </div>

                        {{-- Warnings pill (only when non-zero) --}}
                        @if($partner->major_warnings > 0)
                            <div class="text-center">
                                <div class="badge bg-danger rounded-pill px-3 py-2 fs-6">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    {{ $partner->major_warnings }}
                                    {{ Str::plural('Warning', $partner->major_warnings) }}
                                </div>
                                <div class="mt-1">
                                    <small class="text-muted">Contact support to resolve</small>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ── Active Deliveries Map ─────────────────────────────── -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-map-marked-alt me-2"></i>Current Location & Active Deliveries
                </div>
                <div class="card-body">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- ── Current + Recent Deliveries ──────────────────────── -->
    <div class="row">
        <!-- Current Deliveries -->
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-truck me-2"></i>Current Deliveries</span>
                    <a href="{{ route('delivery-partner.my-pickups') }}" class="btn btn-sm btn-primary">
                        View All <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
                <div class="card-body">
                    @php $activePickups = $partner->activePickups()->with('order')->get(); @endphp

                    @forelse($activePickups as $pickup)
                        <div class="border rounded p-3 mb-3">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <span class="badge badge-{{ $pickup->status }} mb-2">
                                        {{ str_replace('_', ' ', ucfirst($pickup->status)) }}
                                    </span>
                                    <h6 class="mb-1">Order #{{ $pickup->order->order_id }}</h6>
                                    <p class="small text-muted mb-0">
                                        <i class="fas fa-map-pin me-1"></i>
                                        {{ Str::limit($pickup->delivery_address, 50) }}
                                    </p>
                                </div>
                                <a href="{{ route('delivery-partner.pickups.show', $pickup) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                            <div class="progress" style="height: 5px;">
                                @php
                                    $progress = match($pickup->status) {
                                        'assigned'         => 20,
                                        'pickup_scheduled' => 40,
                                        'picked_up'        => 60,
                                        'in_transit'       => 80,
                                        'delivered'        => 100,
                                        default            => 0
                                    };
                                @endphp
                                <div class="progress-bar bg-success" style="width: {{ $progress }}%"></div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-truck fa-3x text-muted mb-3" style="opacity:.3"></i>
                            <h6 class="text-muted">No active deliveries</h6>
                            <p class="small text-muted">Check available pickups to start delivering</p>
                            <a href="{{ route('delivery-partner.available-pickups') }}"
                               class="btn btn-primary btn-sm">
                                <i class="fas fa-box-open me-2"></i>View Available Pickups
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <i class="fas fa-history me-2"></i>Recent Deliveries
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($recentPickups as $pickup)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="d-flex align-items-center mb-1">
                                            <span class="badge badge-{{ $pickup->status }} me-2">
                                                {{ ucfirst($pickup->status) }}
                                            </span>
                                            <small class="text-muted">
                                                {{ $pickup->delivered_at
                                                    ? $pickup->delivered_at->diffForHumans()
                                                    : $pickup->updated_at->diffForHumans() }}
                                            </small>
                                        </div>
                                        <div>
                                            <strong>Order #{{ $pickup->order->order_id }}</strong>
                                            <br>
                                            <small class="text-muted">
                                                <i class="fas fa-dollar-sign me-1"></i>
                                                ${{ number_format($pickup->delivery_fee, 2) }}
                                            </small>
                                        </div>
                                    </div>
                                    <a href="{{ route('delivery-partner.pickups.show', $pickup) }}"
                                       class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="list-group-item text-center py-4">
                                <p class="text-muted mb-0">No recent deliveries</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ── Quick Actions ─────────────────────────────────────── -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-bolt me-2"></i>Quick Actions
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <a href="{{ route('delivery-partner.available-pickups') }}"
                               class="btn btn-outline-primary w-100 py-3">
                                <i class="fas fa-box-open fa-2x mb-2"></i><br>
                                View Available Pickups
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('delivery-partner.my-pickups', ['status' => 'delivered']) }}"
                               class="btn btn-outline-success w-100 py-3">
                                <i class="fas fa-check-circle fa-2x mb-2"></i><br>
                                Completed Deliveries
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('delivery-partner.earnings') }}"
                               class="btn btn-outline-warning w-100 py-3">
                                <i class="fas fa-dollar-sign fa-2x mb-2"></i><br>
                                View Earnings
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('delivery-partner.profile') }}"
                               class="btn btn-outline-info w-100 py-3">
                                <i class="fas fa-user-circle fa-2x mb-2"></i><br>
                                Update Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
<script>
    let map, marker;
    let activeDeliveries = @json($activePickups ?? []);

    function initMap() {
        const defaultLocation = {
            lat: {{ $partner->current_latitude  ?? 40.7128 }},
            lng: {{ $partner->current_longitude ?? -74.0060 }}
        };

        map = new google.maps.Map(document.getElementById('map'), {
            center: defaultLocation,
            zoom: 12,
            styles: [{ featureType: 'poi', elementType: 'labels', stylers: [{ visibility: 'off' }] }]
        });

        if ({{ $partner->current_latitude ? 'true' : 'false' }}) {
            marker = new google.maps.Marker({
                position: defaultLocation,
                map,
                title: 'Your Location',
                icon: { url: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png' }
            });
        }

        activeDeliveries.forEach(delivery => {
            new google.maps.Marker({
                position: defaultLocation,  // Replace with actual delivery coordinates
                map,
                title: `Order #${delivery.order.order_id}`,
                icon: { url: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png' }
            });
        });
    }

    @if($partner->is_online)
    setInterval(() => {
        navigator.geolocation?.getCurrentPosition(pos => {
            fetch('{{ route("delivery-partner.update-location") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ latitude: pos.coords.latitude, longitude: pos.coords.longitude })
            }).then(() => {
                if (marker) {
                    const p = { lat: pos.coords.latitude, lng: pos.coords.longitude };
                    marker.setPosition(p);
                    map.panTo(p);
                }
            });
        });
    }, 30000);
    @endif

    // Activate Bootstrap tooltips on badges
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el =>
        new bootstrap.Tooltip(el)
    );
</script>
@endpush

@push('styles')
<link rel="stylesheet" href="{{ asset('css/delivery-badge.css') }}">
<style>
    #map { height: 300px; width: 100%; border-radius: 5px; }
    .progress { background-color: #e9ecef; border-radius: 10px; }
    .progress-bar { border-radius: 10px; }
</style>
@endpush