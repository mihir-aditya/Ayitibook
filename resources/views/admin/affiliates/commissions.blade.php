{{-- resources/views/admin/affiliates/commissions.blade.php --}}
@extends('admin.layouts.affiliate')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Commissions for {{ $affiliate->user->name }}</h1>
        <a href="{{ route('admin.affiliate.show', $affiliate) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Affiliate
        </a>
    </div>

    {{-- Commissions Table --}}
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
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
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No commissions found for this affiliate.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $commissions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection