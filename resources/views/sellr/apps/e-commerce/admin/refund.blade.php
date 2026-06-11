<!DOCTYPE html>
<html lang="en-US" dir="ltr" data-navigation-type="default" data-navbar-horizontal-shape="default">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Refund Requests - Adminzone</title>
    
    <!-- Favicons and CSS (same as before) -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('seller/assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('seller/assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('seller/assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('seller/assets/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('seller/assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('seller/assets/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">
    
    <!-- CSS -->
    <script src="{{ asset('seller/vendors/simplebar/simplebar.min.js')}}"></script>
    <script src="{{ asset('seller/assets/js/config.js') }}"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="{{ asset('seller/vendors/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('seller/release/v4.0.8/css/line-1.css') }}">
    <link href="{{ asset('seller/assets/css/theme-rtl.min.css') }}" type="text/css" rel="stylesheet" id="style-rtl">
    <link href="{{ asset('seller/assets/css/theme.min.css') }}" type="text/css" rel="stylesheet" id="style-default">
    <link href="{{ asset('seller/assets/css/user-rtl.min.css') }}" type="text/css" rel="stylesheet" id="user-style-rtl">
    <link href="{{ asset('seller/assets/css/user.min.css') }}" type="text/css" rel="stylesheet" id="user-style-default">
    
    <style>
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 50rem;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
        }
        .status-pending { background-color: #fff3cd; color: #856404; }
        .status-approved { background-color: #d1e7dd; color: #0f5132; }
        .status-rejected { background-color: #f8d7da; color: #721c24; }
        .status-refunded { background-color: #cfe2ff; color: #084298; }
        .empty-state {
            padding: 3rem;
            text-align: center;
            color: #6c757d;
        }
        .refund-item:hover {
            background-color: #f8f9fa;
        }
        .select-all-checkbox {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }
        .bulk-actions {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
            display: none;
        }
        .bulk-actions.show {
            display: flex;
        }
    </style>
    
    <script>
        var phoenixIsRTL = window.config.config.phoenixIsRTL;
        if (phoenixIsRTL) {
            var linkDefault = document.getElementById('style-default');
            var userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            var linkRTL = document.getElementById('style-rtl');
            var userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }
    </script>
</head>

<body>
    <main class="main" id="top">
        <x-sidebar/>
            <nav class="navbar navbar-top fixed-top navbar-expand" id="navbarDefault" style="display:none;">
        <div class="collapse navbar-collapse justify-content-between">
          <div class="navbar-logo">
            <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
            <a class="navbar-brand me-1 me-sm-3" href="../../../index.html">phoenix</a>
          </div>
        </div>
      </nav>
        <div class="content">
            <!-- Breadcrumb -->
            <nav class="mb-3" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('seller.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Refund Requests</li>
                </ol>
            </nav>
            
            <!-- Page Header -->
            <div class="mb-4">
                <h2 class="mb-2">Refund Requests</h2>
                <p class="text-body-secondary mb-0">Manage customer refund requests for your products</p>
            </div>
            
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-3 col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="text-body-tertiary">Total</h6>
                                    <h3 class="mb-0">{{ $refunds->total() }}</h3>
                                </div>
                                <div class="avatar avatar-lg">
                                    <span class="fas fa-receipt text-primary"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="text-body-tertiary">Pending</h6>
                                    <h3 class="mb-0">{{ $refunds->where('status', 'pending')->count() }}</h3>
                                </div>
                                <div class="avatar avatar-lg">
                                    <span class="fas fa-clock text-warning"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="text-body-tertiary">Approved</h6>
                                    <h3 class="mb-0">{{ $refunds->where('status', 'approved')->count() }}</h3>
                                </div>
                                <div class="avatar avatar-lg">
                                    <span class="fas fa-check-circle text-success"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="text-body-tertiary">Refunded</h6>
                                    <h3 class="mb-0">{{ $refunds->where('status', 'refunded')->count() }}</h3>
                                </div>
                                <div class="avatar avatar-lg">
                                    <span class="fas fa-money-bill-wave text-info"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bulk Actions Panel (Hidden by default) -->
            <div class="bulk-actions align-items-center gap-3" id="bulkActionsPanel">
                <div class="d-flex align-items-center">
                    <span class="me-2" id="selectedCount">0 items selected</span>
                </div>
                <div class="d-flex gap-2">
                    <select class="form-select form-select-sm" id="bulkStatusSelect" style="width: auto;">
                        <option value="">Update Status</option>
                        <option value="approved">Approve</option>
                        <option value="rejected">Reject</option>
                        <option value="refunded">Mark as Refunded</option>
                    </select>
                    <button class="btn btn-sm btn-primary" id="applyBulkAction">Apply</button>
                    <button class="btn btn-sm btn-outline-secondary" id="clearSelection">Clear</button>
                </div>
            </div>
            
            <!-- Search and Filter Bar -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('seller.refunds.index') }}" class="row g-3">
                        <div class="col-md-4">
                            <input type="text" 
                                   name="search" 
                                   class="form-control" 
                                   placeholder="Search by ID, order, or customer..." 
                                   value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-select">
                                <option value="">All Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="refunded" {{ request('status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('seller.refunds.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Refund Requests List -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Refund Requests ({{ $refunds->total() }})</h5>
                    <div class="d-flex gap-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="selectAllCheckbox">
                            <label class="form-check-label" for="selectAllCheckbox">Select All</label>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-0">
                    @if($refunds->isEmpty())
                        <div class="empty-state">
                            <div class="mb-3">
                                <span class="fas fa-receipt fa-4x text-body-tertiary"></span>
                            </div>
                            <h4 class="text-body-tertiary">No refund requests found</h4>
                            <p class="mb-0">You don't have any refund requests at the moment.</p>
                            @if(request('search') || request('status'))
                                <a href="{{ route('seller.refunds.index') }}" class="btn btn-primary mt-3">View All Refunds</a>
                            @endif
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-body-tertiary">
                                    <tr>
                                        <th class="border-0 ps-4" style="width: 40px;">
                                            <input type="checkbox" class="select-all-checkbox" id="masterCheckbox">
                                        </th>
                                        <th class="border-0">Refund ID</th>
                                        <th class="border-0">Order ID</th>
                                        <th class="border-0">Customer</th>
                                        <th class="border-0">Product</th>
                                        <th class="border-0">Amount</th>
                                        <th class="border-0">Status</th>
                                        <th class="border-0">Requested</th>
                                        <th class="border-0 text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($refunds as $refund)
                                    <tr class="refund-item">
                                        <td class="ps-4">
                                            <input type="checkbox" 
                                                   class="refund-checkbox" 
                                                   value="{{ $refund->sl_no }}"
                                                   data-status="{{ $refund->status }}">
                                        </td>
                                        <td class="fw-semibold">#{{ $refund->sl_no }}</td>
                                        <td>
                                            @if($refund->order)
                                                <a href="{{ route('seller.orders.show', $refund->order_id) }}" 
                                                   class="text-decoration-none">
                                                    Order #{{ $refund->order_id }}
                                                </a>
                                            @else
                                                #{{ $refund->order_id }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($refund->user)
                                                <div>
                                                    <div class="fw-semibold">{{ $refund->user->name ?? 'User #' . $refund->user_id }}</div>
                                                    <small class="text-body-tertiary">{{ $refund->user->email ?? '' }}</small>
                                                </div>
                                            @else
                                                <span class="text-body-tertiary">User #{{ $refund->user_id }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($refund->orderItem && $refund->orderItem->product)
                                                <div class="d-flex align-items-center gap-2">
                                                    @if($refund->orderItem->product->image)
                                                    <img src="{{ asset('storage/' . $refund->orderItem->product->image) }}" 
                                                         alt="Product" 
                                                         class="rounded" 
                                                         width="40" 
                                                         height="40"
                                                         style="object-fit: cover;">
                                                    @endif
                                                    <div>
                                                        <div class="fw-semibold">{{ Str::limit($refund->orderItem->product->name, 30) }}</div>
                                                        <small class="text-body-tertiary">Qty: {{ $refund->orderItem->quantity ?? 1 }}</small>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-body-tertiary">Product #{{ $refund->order_item_id }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($refund->orderItem)
                                                ${{ number_format($refund->orderItem->price * ($refund->orderItem->quantity ?? 1), 2) }}
                                            @else
                                                <span class="text-body-tertiary">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $statusClasses = [
                                                    'pending' => 'status-pending',
                                                    'approved' => 'status-approved',
                                                    'rejected' => 'status-rejected',
                                                    'refunded' => 'status-refunded'
                                                ];
                                                $statusIcons = [
                                                    'pending' => 'fas fa-clock',
                                                    'approved' => 'fas fa-check-circle',
                                                    'rejected' => 'fas fa-times-circle',
                                                    'refunded' => 'fas fa-money-bill-wave'
                                                ];
                                            @endphp
                                            <span class="status-badge {{ $statusClasses[$refund->status] ?? 'status-pending' }}">
                                                <span class="{{ $statusIcons[$refund->status] ?? 'fas fa-clock' }} me-1"></span>
                                                {{ ucfirst($refund->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div>{{ $refund->requested_at->format('M d, Y') }}</div>
                                            <small class="text-body-tertiary">{{ $refund->requested_at->format('h:i A') }}</small>
                                        </td>
                                        <td class="text-end pe-4">
                                            <div class="btn-group btn-group-sm">
                                                <button type="button" 
                                                        class="btn btn-outline-primary" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#viewRefundModal{{ $refund->sl_no }}">
                                                    <span class="fas fa-eye"></span>
                                                </button>
                                                
                                                @if($refund->status !== 'refunded')
                                                <div class="dropdown">
                                                    <button class="btn btn-outline-secondary dropdown-toggle" 
                                                            type="button" 
                                                            data-bs-toggle="dropdown">
                                                        <span class="fas fa-ellipsis-v"></span>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        @if($refund->status === 'pending')
                                                        <li>
                                                            <form action="{{ route('seller.refunds.update-status', $refund->sl_no) }}" 
                                                                  method="POST">
                                                                @csrf
                                                                <input type="hidden" name="status" value="approved">
                                                                <button type="submit" class="dropdown-item text-success">
                                                                    <span class="fas fa-check me-2"></span>Approve
                                                                </button>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('seller.refunds.update-status', $refund->sl_no) }}" 
                                                                  method="POST">
                                                                @csrf
                                                                <input type="hidden" name="status" value="rejected">
                                                                <button type="submit" class="dropdown-item text-danger">
                                                                    <span class="fas fa-times me-2"></span>Reject
                                                                </button>
                                                            </form>
                                                        </li>
                                                        @endif
                                                        
                                                        @if($refund->status === 'approved')
                                                        <li>
                                                            <form action="{{ route('seller.refunds.update-status', $refund->sl_no) }}" 
                                                                  method="POST">
                                                                @csrf
                                                                <input type="hidden" name="status" value="refunded">
                                                                <button type="submit" class="dropdown-item text-primary">
                                                                    <span class="fas fa-money-bill-wave me-2"></span>Mark as Refunded
                                                                </button>
                                                            </form>
                                                        </li>
                                                        @endif
                                                        
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <a class="dropdown-item" 
                                                               href="{{ route('seller.refunds.show', $refund->sl_no) }}">
                                                                <span class="fas fa-external-link-alt me-2"></span>View Details
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <!-- View Refund Modal -->
                                    <div class="modal fade" id="viewRefundModal{{ $refund->sl_no }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Refund Request #{{ $refund->sl_no }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Modal content (same as before) -->
                                                    <!-- You can reuse the modal content from previous example -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        @if($refunds->hasPages())
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-body-secondary">
                                    Showing {{ $refunds->firstItem() }} to {{ $refunds->lastItem() }} of {{ $refunds->total() }} entries
                                </div>
                                <div>
                                    {{ $refunds->withQueryString()->links('vendor.pagination.bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </main>

    <!-- JavaScripts -->
    <script src="{{ asset('seller/vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/is/is.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/lodash/lodash.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/list.js/list.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/dayjs/dayjs.min.js') }}"></script>
    <script src="{{ asset('seller/assets/js/phoenix.js') }}"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-dismiss alerts
            setTimeout(function() {
                var alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    var bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
            
            // Bulk selection logic
            const masterCheckbox = document.getElementById('masterCheckbox');
            const refundCheckboxes = document.querySelectorAll('.refund-checkbox');
            const bulkActionsPanel = document.getElementById('bulkActionsPanel');
            const selectedCount = document.getElementById('selectedCount');
            const bulkStatusSelect = document.getElementById('bulkStatusSelect');
            const applyBulkAction = document.getElementById('applyBulkAction');
            const clearSelection = document.getElementById('clearSelection');
            
            let selectedRefunds = new Set();
            
            // Update selected count
            function updateSelectedCount() {
                selectedCount.textContent = selectedRefunds.size + ' items selected';
                if (selectedRefunds.size > 0) {
                    bulkActionsPanel.classList.add('show');
                } else {
                    bulkActionsPanel.classList.remove('show');
                }
            }
            
            // Handle master checkbox
            masterCheckbox.addEventListener('change', function() {
                const isChecked = this.checked;
                refundCheckboxes.forEach(checkbox => {
                    checkbox.checked = isChecked;
                    if (isChecked) {
                        selectedRefunds.add(checkbox.value);
                    } else {
                        selectedRefunds.delete(checkbox.value);
                    }
                });
                updateSelectedCount();
            });
            
            // Handle individual checkboxes
            refundCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        selectedRefunds.add(this.value);
                    } else {
                        selectedRefunds.delete(this.value);
                        masterCheckbox.checked = false;
                    }
                    updateSelectedCount();
                });
            });
            
            // Clear selection
            clearSelection.addEventListener('click', function() {
                refundCheckboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
                masterCheckbox.checked = false;
                selectedRefunds.clear();
                updateSelectedCount();
            });
            
            // Apply bulk action
            applyBulkAction.addEventListener('click', function() {
                const status = bulkStatusSelect.value;
                if (!status) {
                    alert('Please select an action');
                    return;
                }
                
                if (selectedRefunds.size === 0) {
                    alert('Please select at least one refund request');
                    return;
                }
                
                if (confirm(`Are you sure you want to update ${selectedRefunds.size} refund(s) to ${status}?`)) {
                    // Create form and submit
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route("seller.refunds.bulk-update") }}';
                    
                    // Add CSRF token
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    form.appendChild(csrfToken);
                    
                    // Add status
                    const statusInput = document.createElement('input');
                    statusInput.type = 'hidden';
                    statusInput.name = 'status';
                    statusInput.value = status;
                    form.appendChild(statusInput);
                    
                    // Add action
                    const actionInput = document.createElement('input');
                    actionInput.type = 'hidden';
                    actionInput.name = 'action';
                    actionInput.value = 'update';
                    form.appendChild(actionInput);
                    
                    // Add refund IDs
                    selectedRefunds.forEach(id => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'refund_ids[]';
                        input.value = id;
                        form.appendChild(input);
                    });
                    
                    document.body.appendChild(form);
                    form.submit();
                }
            });
            
            // Confirm before updating status
            document.querySelectorAll('form[action*="update-status"]').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    const status = this.querySelector('input[name="status"]').value;
                    const statusText = status.charAt(0).toUpperCase() + status.slice(1);
                    
                    if (!confirm(`Are you sure you want to ${statusText.toLowerCase()} this refund request?`)) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</body>
</html>