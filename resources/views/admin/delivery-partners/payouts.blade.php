{{-- resources/views/admin/delivery-partners/payouts.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Delivery Partner Payouts')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="page-header d-flex justify-content-between align-items-center mb-4 py-3">
        <div>
            <h4 class="fw-bold mb-2">
                <i class="fas fa-money-bill-wave me-2 text-success"></i>Partner Payouts
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.delivery-partners.index') }}" class="text-decoration-none">Delivery Partners</a></li>
                    <li class="breadcrumb-item active">Payouts</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card bg-gradient-warning">
                <div class="stat-card-body">
                    <h6 class="text-white mb-2">Pending</h6>
                    <h3 class="text-white mb-0">${{ number_format($stats['pending'], 2) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-gradient-info">
                <div class="stat-card-body">
                    <h6 class="text-white mb-2">Processing</h6>
                    <h3 class="text-white mb-0">${{ number_format($stats['processing'], 2) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-gradient-success">
                <div class="stat-card-body">
                    <h6 class="text-white mb-2">Completed</h6>
                    <h3 class="text-white mb-0">${{ number_format($stats['completed'], 2) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-gradient-primary">
                <div class="stat-card-body">
                    <h6 class="text-white mb-2">Total</h6>
                    <h3 class="text-white mb-0">${{ number_format($stats['total'], 2) }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" 
                           placeholder="Search by reference..." 
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-filter me-2"></i>Filter
                    </button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('admin.delivery-partners.payouts') }}" class="btn btn-secondary w-100">
                        <i class="fas fa-redo me-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Payouts Table -->
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>Reference</th>
                            <th>Partner</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Status</th>
                            <th>Requested On</th>
                            <th>Processed At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payouts as $payout)
                        <tr>
                            <td>
                                <span class="fw-bold">{{ $payout->payout_reference }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($payout->deliveryPartner->avatar)
                                        <img src="{{ asset('storage/' . $payout->deliveryPartner->avatar) }}" 
                                             class="rounded-circle me-2" width="32" height="32">
                                    @else
                                        <div class="bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center" 
                                             style="width: 32px; height: 32px;">
                                            <span class="text-white small">{{ substr($payout->deliveryPartner->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        {{ $payout->deliveryPartner->name }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="fw-bold text-success">${{ number_format($payout->amount, 2) }}</span>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark">
                                    {{ strtoupper($payout->payout_method) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $payout->status === 'completed' ? 'success' : ($payout->status === 'pending' ? 'warning' : ($payout->status === 'processing' ? 'info' : 'danger')) }}">
                                    {{ ucfirst($payout->status) }}
                                </span>
                            </td>
                            <td>{{ $payout->created_at->format('M d, Y') }}</td>
                            <td>
                                @if($payout->processed_at)
                                    {{ $payout->processed_at->format('M d, Y') }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-primary" 
                                        data-bs-toggle="modal" data-bs-target="#updateStatusModal{{ $payout->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Update Status Modal -->
                        <div class="modal fade" id="updateStatusModal{{ $payout->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update Payout Status</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="{{ route('admin.delivery-partners.payouts.update-status', $payout) }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Payout Reference</label>
                                                <input type="text" class="form-control" value="{{ $payout->payout_reference }}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Amount</label>
                                                <input type="text" class="form-control" value="${{ number_format($payout->amount, 2) }}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select name="status" class="form-select" required>
                                                    <option value="pending" {{ $payout->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="processing" {{ $payout->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                                    <option value="completed" {{ $payout->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                    <option value="failed" {{ $payout->status == 'failed' ? 'selected' : '' }}>Failed</option>
                                                    <option value="cancelled" {{ $payout->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="notes" class="form-label">Notes</label>
                                                <textarea name="notes" class="form-control" rows="3">{{ $payout->notes }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Update Status</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="empty-state">
                                    <i class="fas fa-money-bill-wave fa-3x text-muted mb-3"></i>
                                    <h5>No Payouts Found</h5>
                                    <p class="text-muted">There are no payout requests yet</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($payouts->hasPages())
        <div class="card-footer">
            {{ $payouts->withQueryString()->links() }}
        </div>
        @endif
    </div>
</div>

@push('styles')
<style>
.stat-card {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
}

.stat-card-body {
    padding: 1.5rem;
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #fad961 0%, #f76b1c 100%);
}

.bg-gradient-info {
    background: linear-gradient(135deg, #3b8cff 0%, #6c5ce7 100%);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.empty-state {
    padding: 3rem;
    text-align: center;
}

.modal-content {
    border-radius: 15px;
    border: none;
}

.modal-header {
    border-bottom: 1px solid #f0f2f5;
    padding: 1.25rem 1.5rem;
}

.modal-body {
    padding: 1.5rem;
}

.modal-footer {
    border-top: 1px solid #f0f2f5;
    padding: 1.25rem 1.5rem;
}
</style>
@endpush
@endsection