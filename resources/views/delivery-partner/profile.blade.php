{{-- resources/views/delivery-partner/profile.blade.php --}}
@extends('delivery-partner.layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-gray-800">My Profile</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('delivery-partner.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 mb-4">
            <!-- Profile Card -->
            <div class="card">
                <div class="card-body text-center">
                    <!-- Avatar Upload Form -->
                    <form id="avatarForm" action="{{ route('delivery-partner.profile.update') }}" 
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="position-relative d-inline-block mb-3">
                            @if($partner->avatar)
                                <img src="{{ asset('storage/' . $partner->avatar) }}" 
                                     alt="{{ $partner->name }}" 
                                     class="rounded-circle img-thumbnail" 
                                     style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto" 
                                     style="width: 150px; height: 150px;">
                                    <span class="display-4 text-white">{{ substr($partner->name, 0, 1) }}</span>
                                </div>
                            @endif
                            
                            <!-- Hidden file input -->
                            <input type="file" id="avatarInput" name="avatar" accept="image/*" 
                                   style="display: none;" onchange="document.getElementById('avatarForm').submit();">
                            
                            <!-- Upload button -->
                            <button type="button" class="btn btn-sm btn-primary position-absolute bottom-0 end-0" 
                                    onclick="document.getElementById('avatarInput').click();">
                                <i class="fas fa-camera"></i>
                            </button>
                        </div>
                    </form>

                    <h4 class="mb-1">{{ $partner->name }}</h4>
                    <p class="text-muted mb-2">
                        <span class="online-indicator {{ $partner->is_online ? 'online' : 'offline' }}"></span>
                        {{ $partner->is_online ? 'Online' : 'Offline' }}
                    </p>
                    <p class="mb-2">
                        <span class="badge bg-{{ $partner->status === 'active' ? 'success' : 'warning' }}">
                            {{ ucfirst($partner->status) }}
                        </span>
                        <span class="badge bg-{{ $partner->verification_status === 'verified' ? 'success' : 'info' }}">
                            {{ ucfirst($partner->verification_status) }}
                        </span>
                    </p>

                    <hr>

                    <div class="row text-center">
                        <div class="col-4">
                            <h5 class="mb-1">{{ $partner->total_deliveries }}</h5>
                            <small class="text-muted">Deliveries</small>
                        </div>
                        <div class="col-4">
                            <h5 class="mb-1">{{ number_format($partner->rating, 1) }}</h5>
                            <small class="text-muted">Rating</small>
                        </div>
                        <div class="col-4">
                            <h5 class="mb-1">{{ $partner->total_ratings }}</h5>
                            <small class="text-muted">Reviews</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8 mb-4">
            <!-- Edit Profile Form -->
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-edit me-2"></i>Edit Profile
                </div>
                <div class="card-body">
                    <form action="{{ route('delivery-partner.profile.update') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $partner->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control bg-light" id="email" 
                                       value="{{ $partner->email }}" readonly disabled>
                                <small class="text-muted">Email cannot be changed</small>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" value="{{ old('phone', $partner->phone) }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="vehicle_type" class="form-label">Vehicle Type</label>
                                <select class="form-select @error('vehicle_type') is-invalid @enderror" 
                                        id="vehicle_type" name="vehicle_type" required>
                                    <option value="bicycle" {{ $partner->vehicle_type == 'bicycle' ? 'selected' : '' }}>Bicycle</option>
                                    <option value="motorcycle" {{ $partner->vehicle_type == 'motorcycle' ? 'selected' : '' }}>Motorcycle</option>
                                    <option value="scooter" {{ $partner->vehicle_type == 'scooter' ? 'selected' : '' }}>Scooter</option>
                                    <option value="car" {{ $partner->vehicle_type == 'car' ? 'selected' : '' }}>Car</option>
                                    <option value="van" {{ $partner->vehicle_type == 'van' ? 'selected' : '' }}>Van</option>
                                    <option value="truck" {{ $partner->vehicle_type == 'truck' ? 'selected' : '' }}>Truck</option>
                                </select>
                                @error('vehicle_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="vehicle_number" class="form-label">Vehicle Number</label>
                                <input type="text" class="form-control @error('vehicle_number') is-invalid @enderror" 
                                       id="vehicle_number" name="vehicle_number" value="{{ old('vehicle_number', $partner->vehicle_number) }}" required>
                                @error('vehicle_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="license_number" class="form-label">License Number</label>
                                <input type="text" class="form-control @error('license_number') is-invalid @enderror" 
                                       id="license_number" name="license_number" value="{{ old('license_number', $partner->license_number) }}" required>
                                @error('license_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" 
                                          id="address" name="address" rows="2" required>{{ old('address', $partner->address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                       id="city" name="city" value="{{ old('city', $partner->city) }}" required>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="state" class="form-label">State</label>
                                <input type="text" class="form-control @error('state') is-invalid @enderror" 
                                       id="state" name="state" value="{{ old('state', $partner->state) }}" required>
                                @error('state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="postal_code" class="form-label">Postal Code</label>
                                <input type="text" class="form-control @error('postal_code') is-invalid @enderror" 
                                       id="postal_code" name="postal_code" value="{{ old('postal_code', $partner->postal_code) }}" required>
                                @error('postal_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Add loading indicator for avatar upload
document.getElementById('avatarInput')?.addEventListener('change', function() {
    if (this.files && this.files[0]) {
        // Show loading state
        const submitBtn = document.createElement('button');
        submitBtn.type = 'submit';
        submitBtn.style.display = 'none';
        document.getElementById('avatarForm').appendChild(submitBtn);
        
        // Optional: Show a toast or loading message
        // You can add a loading spinner here if needed
    }
});
</script>
@endpush
@endsection