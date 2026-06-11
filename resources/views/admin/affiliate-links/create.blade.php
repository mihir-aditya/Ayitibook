{{-- resources/views/admin/affiliate-links/create.blade.php --}}
@extends('admin.layouts.affiliate')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Create New Affiliate Link</h1>
        <a href="{{ route('admin.affiliate.links.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.affiliate.links.store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label for="affiliate_id">Select Affiliate</label>
                    <select name="affiliate_id" id="affiliate_id" class="form-control @error('affiliate_id') is-invalid @enderror" required>
                        <option value="">Select an affiliate</option>
                        @foreach($affiliates as $aff)
                            <option value="{{ $aff->id }}" {{ (isset($affiliate) && $affiliate->id == $aff->id) || old('affiliate_id') == $aff->id ? 'selected' : '' }}>
                                {{ $aff->user->name }} ({{ $aff->affiliate_code }})
                            </option>
                        @endforeach
                    </select>
                    @error('affiliate_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="product_id">Select Product (Optional)</label>
                    <select name="product_id" id="product_id" class="form-control @error('product_id') is-invalid @enderror">
                        <option value="">Select a product (leave empty for general affiliate link)</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Create Affiliate Link</button>
            </form>
        </div>
    </div>
</div>
@endsection