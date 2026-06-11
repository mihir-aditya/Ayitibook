{{-- resources/views/delivery-partner/earnings.blade.php --}}
@extends('delivery-partner.layouts.app')

@section('title', 'Earnings')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-gray-800">Earnings</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('delivery-partner.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Earnings</li>
                </ol>
            </nav>
        </div>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#payoutModal">
            <i class="fas fa-money-bill-wave me-2"></i>Request Payout
        </button>
    </div>

    <!-- Earnings Summary Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card success h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-success text-uppercase mb-1">Total Earnings</div>
                            <div class="h3 mb-0 fw-bold">${{ number_format($earnings['total'], 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300 stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-card info h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-info text-uppercase mb-1">This Month</div>
                            <div class="h3 mb-0 fw-bold">${{ number_format($earnings['this_month'], 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-alt fa-2x text-gray-300 stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-card warning h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-warning text-uppercase mb-1">Today</div>
                            <div class="h3 mb-0 fw-bold">${{ number_format($earnings['today'], 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-sun fa-2x text-gray-300 stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-card primary h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-primary text-uppercase mb-1">Pending Payout</div>
                            <div class="h3 mb-0 fw-bold">${{ number_format($earnings['pending_payout'], 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hourglass-half fa-2x text-gray-300 stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings Chart -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-chart-line me-2"></i>Earnings Overview (Last 30 Days)
        </div>
        <div class="card-body">
            <canvas id="earningsChart" height="100"></canvas>
        </div>
    </div>

    <!-- Recent Earnings Table -->
    <div class="card">
        <div class="card-header">
            <i class="fas fa-history me-2"></i>Recent Deliveries & Earnings
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>Order #</th>
                            <th>Customer</th>
                            <th>Delivered At</th>
                            <th>Delivery Fee</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentEarnings as $pickup)
                            <tr>
                                <td>
                                    <span class="fw-bold">#{{ $pickup->order->order_id }}</span>
                                </td>
                                <td>{{ $pickup->order->user->name ?? 'N/A' }}</td>
                                <td>
                                    {{ $pickup->delivered_at ? $pickup->delivered_at->format('M d, Y H:i') : 'N/A' }}
                                    <br>
                                    <small class="text-muted">
                                        {{ $pickup->delivered_at ? $pickup->delivered_at->diffForHumans() : '' }}
                                    </small>
                                </td>
                                <td>
                                    <span class="fw-bold text-success">${{ number_format($pickup->delivery_fee, 2) }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-success">Delivered</span>
                                </td>
                                <td>
                                    <a href="{{ route('delivery-partner.pickups.show', $pickup) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <p class="text-muted mb-0">No earnings recorded yet</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if(method_exists($recentEarnings, 'links'))
            <div class="card-footer">
                {{ $recentEarnings->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Payout Request Modal -->
<div class="modal fade" id="payoutModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-money-bill-wave me-2"></i>Request Payout
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('delivery-partner.request-payout') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Available Balance</label>
                        <h4 class="text-success">${{ number_format($earnings['total'] - $earnings['pending_payout'], 2) }}</h4>
                        <small class="text-muted">Pending: ${{ number_format($earnings['pending_payout'], 2) }}</small>
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount to Withdraw</label>
                        <input type="number" 
                               class="form-control" 
                               id="amount" 
                               name="amount" 
                               min="100" 
                               max="{{ $earnings['total'] - $earnings['pending_payout'] }}" 
                               step="0.01" 
                               required>
                        <small class="text-muted">Minimum withdrawal: $100</small>
                    </div>

                    <div class="mb-3">
                        <label for="payout_method" class="form-label">Payout Method</label>
                        <select class="form-select" id="payout_method" name="payout_method" required>
                            <option value="">Select method</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="upi">UPI</option>
                        </select>
                    </div>

                    <div id="bankFields" style="display: none;">
                        <div class="mb-3">
                            <label for="bank_name" class="form-label">Bank Name</label>
                            <input type="text" class="form-control" id="bank_name" name="bank_name">
                        </div>
                        <div class="mb-3">
                            <label for="account_number" class="form-label">Account Number</label>
                            <input type="text" class="form-control" id="account_number" name="account_number">
                        </div>
                        <div class="mb-3">
                            <label for="ifsc_code" class="form-label">IFSC Code</label>
                            <input type="text" class="form-control" id="ifsc_code" name="ifsc_code">
                        </div>
                    </div>

                    <div id="upiField" style="display: none;">
                        <div class="mb-3">
                            <label for="upi_id" class="form-label">UPI ID</label>
                            <input type="text" class="form-control" id="upi_id" name="upi_id">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check me-2"></i>Request Payout
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Earnings Chart
    const ctx = document.getElementById('earningsChart').getContext('2d');
    
    // Generate last 30 days labels
    const labels = [];
    const data = [];
    for (let i = 29; i >= 0; i--) {
        const date = new Date();
        date.setDate(date.getDate() - i);
        labels.push(date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' }));
        
        // This is sample data - replace with actual data from your backend
        data.push(Math.floor(Math.random() * 200) + 50);
    }

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Daily Earnings ($)',
                data: data,
                borderColor: '#1cc88a',
                backgroundColor: 'rgba(28, 200, 138, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value;
                        }
                    }
                }
            }
        }
    });

    // Show/hide payout fields based on method
    document.getElementById('payout_method').addEventListener('change', function() {
        const bankFields = document.getElementById('bankFields');
        const upiField = document.getElementById('upiField');
        
        bankFields.style.display = 'none';
        upiField.style.display = 'none';
        
        if (this.value === 'bank_transfer') {
            bankFields.style.display = 'block';
            document.getElementById('bank_name').required = true;
            document.getElementById('account_number').required = true;
            document.getElementById('ifsc_code').required = true;
        } else if (this.value === 'upi') {
            upiField.style.display = 'block';
            document.getElementById('upi_id').required = true;
        }
    });
</script>
@endpush
@endsection