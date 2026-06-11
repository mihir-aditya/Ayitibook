{{-- resources/views/admin/affiliate-commissions/show.blade.php --}}
@extends('admin.layouts.affiliate')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Commission Details</h1>
        <a href="{{ route('admin.affiliate.commissions.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    {{-- Commission Details --}}
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Commission Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Affiliate:</strong> {{ $commission->affiliate->user->name }} ({{ $commission->affiliate->affiliate_code }})</p>
                            <p><strong>Order:</strong>
                                @if($commission->order)
                                    #{{ $commission->order->id }}
                                @else
                                    <em>N/A</em>
                                @endif
                            </p>
                            <p><strong>Amount:</strong> ${{ number_format($commission->amount, 2) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Status:</strong>
                                <span class="badge badge-{{ $commission->status === 'paid' ? 'success' : ($commission->status === 'approved' ? 'info' : ($commission->status === 'pending' ? 'warning' : 'danger')) }}">
                                    {{ ucfirst($commission->status) }}
                                </span>
                            </p>
                            <p><strong>Created:</strong> {{ $commission->created_at->format('M d, Y H:i') }}</p>
                            @if($commission->updated_at != $commission->created_at)
                            <p><strong>Last Updated:</strong> {{ $commission->updated_at->format('M d, Y H:i') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Actions</h5>
                </div>
                <div class="card-body">
                    @if($commission->status === 'pending')
                        <form action="{{ route('admin.affiliate.commissions.approve', $commission) }}" method="POST" class="mb-2">
                            @csrf
                            <button type="submit" class="btn btn-success btn-block">Approve Commission</button>
                        </form>
                        <form action="{{ route('admin.affiliate.commissions.reject', $commission) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-block">Reject Commission</button>
                        </form>
                    @elseif($commission->status === 'approved')
                        <form action="{{ route('admin.affiliate.commissions.pay', $commission) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-block">Mark as Paid</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection