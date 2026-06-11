{{-- resources/views/admin/affiliate-clicks/show.blade.php --}}
@extends('admin.layouts.affiliate')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Click Details</h1>
        <a href="{{ route('admin.affiliate.clicks.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    {{-- Click Details --}}
    <div class="card">
        <div class="card-header">
            <h5>Click Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Affiliate:</strong> {{ $affiliateClick->affiliate->user->name }} ({{ $affiliateClick->affiliate->affiliate_code }})</p>
                    <p><strong>Product:</strong>
                        @if($affiliateClick->affiliateLink && $affiliateClick->affiliateLink->product)
                            {{ $affiliateClick->affiliateLink->product->name }}
                        @else
                            <em>General Link</em>
                        @endif
                    </p>
                    <p><strong>Link Code:</strong> {{ $affiliateClick->affiliateLink ? $affiliateClick->affiliateLink->link_code : 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Customer:</strong>
                        @if($affiliateClick->customer)
                            {{ $affiliateClick->customer->name }} ({{ $affiliateClick->customer->email }})
                        @else
                            <em>Anonymous</em>
                        @endif
                    </p>
                    <p><strong>IP Address:</strong> {{ $affiliateClick->ip_address }}</p>
                    <p><strong>Status:</strong>
                        <span class="badge badge-{{ $affiliateClick->status === 'converted' ? 'success' : 'secondary' }}">
                            {{ ucfirst(str_replace('_', ' ', $affiliateClick->status)) }}
                        </span>
                    </p>
                    <p><strong>Clicked At:</strong> {{ $affiliateClick->click_timestamp->format('M d, Y H:i:s') }}</p>
                </div>
            </div>

            @if($affiliateClick->user_agent)
            <div class="row mt-3">
                <div class="col-md-12">
                    <p><strong>User Agent:</strong></p>
                    <code class="d-block p-2 bg-light">{{ $affiliateClick->user_agent }}</code>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection