{{-- resources/views/admin/affiliate-commissions/index.blade.php --}}
@extends('admin.layouts.affiliate')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Affiliate Commissions</h1>
    </div>

    {{-- Filters --}}
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.affiliate.commissions.index') }}" class="row">
                <div class="col-md-3">
                    <input type="text" name="order_id" class="form-control"
                           placeholder="Order ID"
                           value="{{ request('order_id') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('admin.affiliate.commissions.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    {{-- Commissions Table --}}
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Affiliate</th>
                        <th>Order</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($commissions as $commission)
                    <tr>
                        <td>{{ $commission->id }}</td>
                        <td>
                            <strong>{{ $commission->affiliate->user->name }}</strong><br>
                            <small>{{ $commission->affiliate->affiliate_code }}</small>
                        </td>
                        <td>
                            @if($commission->order)
                                #{{ $commission->order->id }}
                            @else
                                <em>N/A</em>
                            @endif
                        </td>
                        <td>${{ number_format($commission->amount, 2) }}</td>
                        <td>
                            <span class="badge badge-{{ $commission->status === 'paid' ? 'success' : ($commission->status === 'approved' ? 'info' : ($commission->status === 'pending' ? 'warning' : 'danger')) }}">
                                {{ ucfirst($commission->status) }}
                            </span>
                        </td>
                        <td>{{ $commission->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('admin.affiliate.commissions.show', $commission) }}"
                               class="btn btn-sm btn-info" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if($commission->status === 'pending')
                            <form action="{{ route('admin.affiliate.commissions.approve', $commission) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success" title="Approve">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.affiliate.commissions.reject', $commission) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger" title="Reject">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                            @elseif($commission->status === 'approved')
                            <form action="{{ route('admin.affiliate.commissions.pay', $commission) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary" title="Mark as Paid">
                                    <i class="fas fa-dollar-sign"></i>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No commissions found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $commissions->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection