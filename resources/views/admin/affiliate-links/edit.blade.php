{{-- resources/views/admin/affiliate-links/edit.blade.php --}}
@extends('admin.layouts.affiliate')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Affiliate Link</h1>
        <a href="{{ route('admin.affiliate.links.show', $affiliateLink) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.affiliate.links.update', $affiliateLink) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="product_id">Select Product (Optional)</label>
                    <select name="product_id" id="product_id" class="form-control @error('product_id') is-invalid @enderror">
                        <option value="">Select a product (leave empty for general affiliate link)</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ $affiliateLink->product_id == $product->id ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="link_code">Link Code</label>
                    <input type="text" name="link_code" id="link_code"
                           class="form-control @error('link_code') is-invalid @enderror"
                           value="{{ old('link_code', $affiliateLink->link_code) }}" readonly>
                    <small class="form-text text-muted">Link code cannot be changed after creation.</small>
                    @error('link_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update Link</button>
            </form>
        </div>
    </div>
</div>
@endsection