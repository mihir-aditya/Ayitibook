@extends('admin.layouts.basic')

@section('title', 'Orders Management')
@section('page-title', 'Orders Management')

@section('content')
    <style>
        .orders-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.25rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border-left: 4px solid;
            transition: transform 0.3s ease;
            text-align: center;
        }

        .stat-card:hover {
            transform: translateY(-2px);
        }

        .stat-card.blue {
            border-left-color: #3b82f6;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
        }

        .stat-card.green {
            border-left-color: #10b981;
            background: linear-gradient(135deg, #10b981 0%, #047857 100%);
            color: white;
        }

        .stat-card.orange {
            border-left-color: #f59e0b;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .stat-card.red {
            border-left-color: #ef4444;
            background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%);
            color: white;
        }

        .stat-card.purple {
            border-left-color: #8b5cf6;
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white;
        }

        .stat-card.indigo {
            border-left-color: #6366f1;
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: white;
        }

        .stat-card.teal {
            border-left-color: #14b8a6;
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            color: white;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }

        .stat-label {
            font-size: 0.75rem;
            opacity: 0.9;
            margin-top: 0.25rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .filters-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
            border: 1px solid #e5e7eb;
        }

        .filter-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .filter-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #111827;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-toggle {
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .filter-toggle:hover {
            background: #f3f4f6;
            color: #374151;
        }

        .filter-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .filter-form.hidden {
            display: none;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-select,
        .form-input {
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.875rem;
            color: #374151;
            background: white;
            transition: all 0.2s ease;
        }

        .form-select:focus,
        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .filter-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 1rem;
            grid-column: 1 / -1;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.875rem;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
        }

        .table-container {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .table-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #111827;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .table-actions {
            display: flex;
            gap: 0.75rem;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
        }

        .data-table th {
            padding: 0.75rem 1rem;
            text-align: left;
            font-weight: 600;
            color: #374151;
            border-bottom: 2px solid #e5e7eb;
            background: #f9fafb;
            white-space: nowrap;
        }

        .data-table td {
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
            color: #4b5563;
            vertical-align: middle;
        }

        .data-table tr:hover td {
            background: #f9fafb;
        }

        .order-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .order-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
        }

        .order-details {
            display: flex;
            flex-direction: column;
        }

        .order-id {
            font-weight: 600;
            color: #111827;
            margin-bottom: 0.25rem;
        }

        .order-date {
            font-size: 0.75rem;
            color: #6b7280;
        }

        .customer-info {
            font-size: 0.875rem;
        }

        .customer-name {
            font-weight: 600;
            color: #111827;
            margin-bottom: 0.25rem;
        }

        .customer-email {
            font-size: 0.75rem;
            color: #6b7280;
        }

        .amount {
            font-weight: 700;
            color: #111827;
            font-size: 1rem;
        }

        .items-count {
            background: #f3f4f6;
            color: #374151;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-placed {
            background: #dbeafe;
            color: #3b82f6;
        }

        .status-confirmed {
            background: #e0e7ff;
            color: #6366f1;
        }

        .status-shipped {
            background: #fef9c3;
            color: #ca8a04;
        }

        .status-delivered {
            background: #d1fae5;
            color: #059669;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #ef4444;
        }

        .status-refunded {
            background: #f3e8ff;
            color: #8b5cf6;
        }

        .payment-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .payment-cash {
            background: #f3f4f6;
            color: #374151;
        }

        .payment-card {
            background: #dbeafe;
            color: #3b82f6;
        }

        .payment-online {
            background: #d1fae5;
            color: #10b981;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            padding: 0.375rem;
            border-radius: 6px;
            border: none;
            background: none;
            color: #6b7280;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .action-btn:hover {
            background: #f3f4f6;
            color: #374151;
        }

        .action-btn.view:hover {
            background: #dbeafe;
            color: #3b82f6;
        }

        .action-btn.edit:hover {
            background: #fef3c7;
            color: #d97706;
        }

        .bulk-select {
            width: 18px;
            height: 18px;
            border-radius: 4px;
            border: 2px solid #d1d5db;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .bulk-select:checked {
            background: #3b82f6;
            border-color: #3b82f6;
        }

        .select-all-container {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .bulk-actions {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 1rem;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }

        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid #e5e7eb;
        }

        .pagination-info {
            font-size: 0.875rem;
            color: #6b7280;
        }

        .pagination {
            display: flex;
            gap: 0.25rem;
        }

        .page-link {
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            border: 1px solid #d1d5db;
            background: white;
            color: #374151;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .page-link:hover:not(.disabled) {
            background: #f3f4f6;
        }

        .page-link.active {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            border-color: #3b82f6;
        }

        .page-link.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .empty-state {
            padding: 3rem 1rem;
            text-align: center;
            color: #9ca3af;
        }

        .empty-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #e5e7eb;
        }

        @media (max-width: 768px) {
            .filter-form {
                grid-template-columns: 1fr;
            }

            .table-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .table-actions {
                width: 100%;
                justify-content: space-between;
            }

            .pagination-container {
                flex-direction: column;
                gap: 1rem;
            }

            .bulk-actions {
                flex-wrap: wrap;
            }

            .action-buttons {
                flex-wrap: wrap;
            }
        }
    </style>

    <div class="orders-container">
        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-card blue">
                <div class="stat-value">{{ number_format($stats['total']) }}</div>
                <div class="stat-label">Total Orders</div>
            </div>

            <div class="stat-card blue">
                <div class="stat-value">{{ number_format($stats['placed']) }}</div>
                <div class="stat-label">Placed</div>
            </div>

            <div class="stat-card indigo">
                <div class="stat-value">{{ number_format($stats['confirmed']) }}</div>
                <div class="stat-label">Confirmed</div>
            </div>

            <div class="stat-card orange">
                <div class="stat-value">{{ number_format($stats['shipped']) }}</div>
                <div class="stat-label">Shipped</div>
            </div>

            <div class="stat-card green">
                <div class="stat-value">{{ number_format($stats['delivered']) }}</div>
                <div class="stat-label">Delivered</div>
            </div>

            <div class="stat-card red">
                <div class="stat-value">{{ number_format($stats['cancelled']) }}</div>
                <div class="stat-label">Cancelled</div>
            </div>

            <div class="stat-card purple">
                <div class="stat-value">{{ number_format($stats['refunded']) }}</div>
                <div class="stat-label">Refunded</div>
            </div>

            <div class="stat-card purple">
                <div class="stat-value">₹{{ number_format($stats['total_revenue'], 2) }}</div>
                <div class="stat-label">Total Revenue</div>
            </div>

            <div class="stat-card teal">
                <div class="stat-value">₹{{ number_format($stats['avg_order_value'], 2) }}</div>
                <div class="stat-label">Avg Order Value</div>
            </div>
        </div>

        <!-- Filters -->
        <div class="filters-card">
            <div class="filter-header">
                <h3 class="filter-title">
                    <i class="fas fa-filter"></i> Filters
                </h3>
                <button class="filter-toggle" id="filterToggle">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </div>

            <form method="GET" action="{{ route('admin.orders.index') }}" class="filter-form" id="filterForm">
                <div class="form-group">
                    <label class="form-label">Search</label>
                    <input type="text" name="search" class="form-input" placeholder="Order ID, customer, amount..."
                        value="{{ request('search') }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="all">All Status</option>
                        <option value="placed"     {{ request('status') == 'placed'     ? 'selected' : '' }}>Placed</option>
                        <option value="confirmed"  {{ request('status') == 'confirmed'  ? 'selected' : '' }}>Confirmed</option>
                        <option value="shipped"    {{ request('status') == 'shipped'    ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered"  {{ request('status') == 'delivered'  ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled"  {{ request('status') == 'cancelled'  ? 'selected' : '' }}>Cancelled</option>
                        <option value="refunded"   {{ request('status') == 'refunded'   ? 'selected' : '' }}>Refunded</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Payment Method</label>
                    <select name="payment_method" class="form-select">
                        <option value="all">All Methods</option>
                        <option value="cash" {{ request('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                        <option value="card" {{ request('payment_method') == 'card' ? 'selected' : '' }}>Card</option>
                        <option value="online" {{ request('payment_method') == 'online' ? 'selected' : '' }}>Online
                        </option>
                        <option value="upi" {{ request('payment_method') == 'upi' ? 'selected' : '' }}>UPI</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Seller</label>
                    <select name="seller" class="form-select">
                        <option value="all">All Sellers</option>
                        @foreach ($sellers as $seller)
                            <option value="{{ $seller->id }}" {{ request('seller') == $seller->id ? 'selected' : '' }}>
                                {{ $seller->shop_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Date From</label>
                    <input type="date" name="date_from" class="form-input" value="{{ request('date_from') }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Date To</label>
                    <input type="date" name="date_to" class="form-input" value="{{ request('date_to') }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Amount From</label>
                    <input type="number" name="amount_from" class="form-input" placeholder="Min amount" step="0.01"
                        value="{{ request('amount_from') }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Amount To</label>
                    <input type="number" name="amount_to" class="form-input" placeholder="Max amount" step="0.01"
                        value="{{ request('amount_to') }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Sort By</label>
                    <select name="sort_by" class="form-select">
                        <option value="placed_at" {{ request('sort_by') == 'placed_at' ? 'selected' : '' }}>Order Date
                        </option>
                        <option value="total_amount" {{ request('sort_by') == 'total_amount' ? 'selected' : '' }}>Amount
                        </option>
                        <option value="order_id" {{ request('sort_by') == 'order_id' ? 'selected' : '' }}>Order ID</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Sort Order</label>
                    <select name="sort_order" class="form-select">
                        <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Descending</option>
                        <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                    </select>
                </div>

                <div class="filter-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Apply Filters
                    </button>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Clear Filters
                    </a>
                </div>
            </form>
        </div>

        <!-- Bulk Actions -->
        <div class="bulk-actions" id="bulkActions" style="display: none;">
            <span id="selectedCount">0 orders selected</span>
            <div style="display: flex; gap: 0.5rem;">
                <select id="bulkActionSelect" class="form-select" style="width: auto;">
                    <option value="">Choose Action</option>
                    <option value="placed">Mark as Placed</option>
                    <option value="confirmed">Mark as Confirmed</option>
                    <option value="shipped">Mark as Shipped</option>
                    <option value="delivered">Mark as Delivered</option>
                    <option value="cancelled">Cancel Orders</option>
                    <option value="refunded">Mark as Refunded</option>
                    <option value="delete">Delete Orders</option>
                </select>
                <button type="button" class="btn btn-primary" onclick="applyBulkAction()">
                    Apply
                </button>
                <button type="button" class="btn btn-secondary" onclick="clearSelection()">
                    Clear
                </button>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="table-container">
            <div class="table-header">
                <h3 class="table-title">
                    <i class="fas fa-shopping-cart"></i> Orders List
                </h3>
                <div class="table-actions">
                    <a href="{{ route('admin.orders.export') }}?type=csv" class="btn btn-secondary">
                        <i class="fas fa-download"></i> Export CSV
                    </a>
                </div>
            </div>

            @if ($orders->count() > 0)
                <div class="select-all-container">
                    <input type="checkbox" id="selectAll" class="bulk-select" onchange="toggleSelectAll()">
                    <label for="selectAll" style="font-size: 0.875rem; color: #374151;">
                        Select all {{ $orders->total() }} orders
                    </label>
                </div>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th style="width: 40px;">
                                    <input type="checkbox" id="selectAllVisible" class="bulk-select"
                                        onchange="toggleSelectAllVisible()">
                                </th>
                                <th>Order</th>
                                <th>Customer</th>
                                <th>Items</th>
                                <th>Amount</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="order-select bulk-select"
                                            value="{{ $order->sl_no }}" onchange="updateSelection()">
                                    </td>
                                    <td>
                                        <div class="order-info">
                                            <div class="order-icon">
                                                <i class="fas fa-receipt"></i>
                                            </div>
                                            <div class="order-details">
                                                <div class="order-id">#{{ $order->order_id }}</div>
                                                <div class="order-date">
                                                    @if ($order->placed_at)
                                                        {{ $order->placed_at->format('M d, Y H:i') }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="customer-info">
                                            <div class="customer-name">
                                                {{ $order->user->name ?? 'Guest' }}
                                            </div>
                                            <div class="customer-email">
                                                {{ $order->user->email ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="items-count">
                                            {{ $order->items->count() }} items
                                        </span>
                                    </td>
                                    <td>
                                        <div class="amount">₹{{ number_format($order->total_amount, 2) }}</div>
                                    </td>
                                    <td>
                                        @php
                                            $paymentMethod = strtolower($order->payment_method ?? 'cash');
                                        @endphp

                                        @if ($paymentMethod == 'card')
                                            <span class="payment-badge payment-card">
                                                <i class="fas fa-credit-card"></i> Card
                                            </span>
                                        @elseif($paymentMethod == 'online')
                                            <span class="payment-badge payment-online">
                                                <i class="fas fa-globe"></i> Online
                                            </span>
                                        @else
                                            <span class="payment-badge payment-cash">
                                                <i class="fas fa-money-bill"></i> {{ ucfirst($paymentMethod) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $status = strtolower($order->order_status ?? 'placed');
                                        @endphp
                                        @switch($status)
                                            @case('placed')
                                                <span class="status-badge status-placed">
                                                    <i class="fas fa-shopping-cart"></i> Placed
                                                </span>
                                                @break
                                            @case('confirmed')
                                                <span class="status-badge status-confirmed">
                                                    <i class="fas fa-check"></i> Confirmed
                                                </span>
                                                @break
                                            @case('shipped')
                                                <span class="status-badge status-shipped">
                                                    <i class="fas fa-shipping-fast"></i> Shipped
                                                </span>
                                                @break
                                            @case('delivered')
                                                <span class="status-badge status-delivered">
                                                    <i class="fas fa-box-open"></i> Delivered
                                                </span>
                                                @break
                                            @case('cancelled')
                                                <span class="status-badge status-cancelled">
                                                    <i class="fas fa-times-circle"></i> Cancelled
                                                </span>
                                                @break
                                            @case('refunded')
                                                <span class="status-badge status-refunded">
                                                    <i class="fas fa-undo"></i> Refunded
                                                </span>
                                                @break
                                            @default
                                                <span class="status-badge" style="background:#f3f4f6;color:#6b7280;">
                                                    <i class="fas fa-circle"></i> {{ ucfirst($status) }}
                                                </span>
                                        @endswitch
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.orders.show', $order->order_id) }}"
                                                class="action-btn view" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <!-- Status Update Dropdown -->
                                            <div style="position: relative; display: inline-block;">
                                                <button class="action-btn" title="Update Status">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <div
                                                    style="position: absolute; top: 100%; left: 0; background: white; border: 1px solid #e5e7eb; border-radius: 6px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); z-index: 10; display: none; min-width: 160px;">
                                                    <form action="{{ route('admin.orders.update-status', $order) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" name="status" value="placed"
                                                            style="width:100%;text-align:left;padding:0.5rem 1rem;border:none;background:none;cursor:pointer;font-size:0.875rem;">
                                                            <i class="fas fa-shopping-cart" style="color:#3b82f6;margin-right:0.5rem;"></i>
                                                            Placed
                                                        </button>
                                                        <button type="submit" name="status" value="confirmed"
                                                            style="width:100%;text-align:left;padding:0.5rem 1rem;border:none;background:none;cursor:pointer;font-size:0.875rem;">
                                                            <i class="fas fa-check" style="color:#6366f1;margin-right:0.5rem;"></i>
                                                            Confirmed
                                                        </button>
                                                        <button type="submit" name="status" value="shipped"
                                                            style="width:100%;text-align:left;padding:0.5rem 1rem;border:none;background:none;cursor:pointer;font-size:0.875rem;">
                                                            <i class="fas fa-shipping-fast" style="color:#ca8a04;margin-right:0.5rem;"></i>
                                                            Shipped
                                                        </button>
                                                        <button type="submit" name="status" value="delivered"
                                                            style="width:100%;text-align:left;padding:0.5rem 1rem;border:none;background:none;cursor:pointer;font-size:0.875rem;">
                                                            <i class="fas fa-box-open" style="color:#059669;margin-right:0.5rem;"></i>
                                                            Delivered
                                                        </button>
                                                        <button type="submit" name="status" value="cancelled"
                                                            style="width:100%;text-align:left;padding:0.5rem 1rem;border:none;background:none;cursor:pointer;font-size:0.875rem;">
                                                            <i class="fas fa-times-circle" style="color:#ef4444;margin-right:0.5rem;"></i>
                                                            Cancelled
                                                        </button>
                                                        <button type="submit" name="status" value="refunded"
                                                            style="width:100%;text-align:left;padding:0.5rem 1rem;border:none;background:none;cursor:pointer;font-size:0.875rem;">
                                                            <i class="fas fa-undo" style="color:#8b5cf6;margin-right:0.5rem;"></i>
                                                            Refunded
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>

                                            <form action="{{ route('admin.orders.destroy', $order) }}" method="POST"
                                                style="display: inline;"
                                                onsubmit="return confirm('Are you sure you want to delete this order?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-btn" title="Delete"
                                                    style="color: #ef4444;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pagination-container">
                    <div class="pagination-info">
                        Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} entries
                    </div>
                    <div class="pagination">
                        {{-- Manual pagination --}}
                        @if ($orders->hasPages())
                            {{-- Previous Page Link --}}
                            @if ($orders->onFirstPage())
                                <span class="page-link disabled">
                                    <i class="fas fa-chevron-left"></i> Previous
                                </span>
                            @else
                                <a href="{{ $orders->previousPageUrl() }}" class="page-link">
                                    <i class="fas fa-chevron-left"></i> Previous
                                </a>
                            @endif

                            {{-- Page Numbers --}}
                            @php
                                $current = $orders->currentPage();
                                $last = $orders->lastPage();
                                $start = max($current - 2, 1);
                                $end = min($current + 2, $last);
                            @endphp

                            @if ($start > 1)
                                <a href="{{ $orders->url(1) }}" class="page-link">1</a>
                                @if ($start > 2)
                                    <span class="page-link disabled">...</span>
                                @endif
                            @endif

                            @for ($i = $start; $i <= $end; $i++)
                                @if ($i == $current)
                                    <span class="page-link active">{{ $i }}</span>
                                @else
                                    <a href="{{ $orders->url($i) }}" class="page-link">{{ $i }}</a>
                                @endif
                            @endfor

                            @if ($end < $last)
                                @if ($end < $last - 1)
                                    <span class="page-link disabled">...</span>
                                @endif
                                <a href="{{ $orders->url($last) }}" class="page-link">{{ $last }}</a>
                            @endif

                            {{-- Next Page Link --}}
                            @if ($orders->hasMorePages())
                                <a href="{{ $orders->nextPageUrl() }}" class="page-link">
                                    Next <i class="fas fa-chevron-right"></i>
                                </a>
                            @else
                                <span class="page-link disabled">
                                    Next <i class="fas fa-chevron-right"></i>
                                </span>
                            @endif
                        @endif
                    </div>
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <h3 style="color: #6b7280; margin-bottom: 0.5rem;">No Orders Found</h3>
                    <p style="color: #9ca3af;">Try adjusting your filters.</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Toggle filter form
        document.getElementById('filterToggle').addEventListener('click', function() {
            const form = document.getElementById('filterForm');
            const icon = this.querySelector('i');

            form.classList.toggle('hidden');
            if (form.classList.contains('hidden')) {
                icon.className = 'fas fa-chevron-down';
            } else {
                icon.className = 'fas fa-chevron-up';
            }
        });

        // Bulk selection functionality
        let selectedOrders = [];

        function toggleSelectAll() {
            const checkboxes = document.querySelectorAll('.order-select');
            const selectAll = document.getElementById('selectAll');

            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
                if (selectAll.checked) {
                    if (!selectedOrders.includes(parseInt(checkbox.value))) {
                        selectedOrders.push(parseInt(checkbox.value));
                    }
                } else {
                    selectedOrders = selectedOrders.filter(id => id !== parseInt(checkbox.value));
                }
            });

            updateSelection();
        }

        function toggleSelectAllVisible() {
            const checkboxes = document.querySelectorAll('.order-select');
            const selectAllVisible = document.getElementById('selectAllVisible');

            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAllVisible.checked;
                if (selectAllVisible.checked) {
                    if (!selectedOrders.includes(parseInt(checkbox.value))) {
                        selectedOrders.push(parseInt(checkbox.value));
                    }
                } else {
                    selectedOrders = selectedOrders.filter(id => id !== parseInt(checkbox.value));
                }
            });

            updateSelection();
        }

        function updateSelection() {
            selectedOrders = [];
            const checkboxes = document.querySelectorAll('.order-select:checked');

            checkboxes.forEach(checkbox => {
                selectedOrders.push(parseInt(checkbox.value));
            });

            const bulkActions = document.getElementById('bulkActions');
            const selectedCount = document.getElementById('selectedCount');

            if (selectedOrders.length > 0) {
                bulkActions.style.display = 'flex';
                selectedCount.textContent = `${selectedOrders.length} orders selected`;
            } else {
                bulkActions.style.display = 'none';
            }

            // Update select all checkboxes
            const totalVisible = document.querySelectorAll('.order-select').length;
            const selectedVisible = checkboxes.length;

            document.getElementById('selectAllVisible').checked = selectedVisible === totalVisible && totalVisible > 0;
            document.getElementById('selectAll').checked = false;
        }

        function clearSelection() {
            const checkboxes = document.querySelectorAll('.order-select');
            checkboxes.forEach(checkbox => checkbox.checked = false);
            selectedOrders = [];
            updateSelection();
        }

        function applyBulkAction() {
            const action = document.getElementById('bulkActionSelect').value;

            if (!action) {
                alert('Please select an action');
                return;
            }

            if (selectedOrders.length === 0) {
                alert('Please select at least one order');
                return;
            }

            if (action === 'delete' && !confirm(
                    `Are you sure you want to delete ${selectedOrders.length} orders? This action cannot be undone.`)) {
                return;
            }

            // Create form and submit
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('admin.orders.bulk-action') }}';

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'PUT';
            form.appendChild(methodField);

            const actionField = document.createElement('input');
            actionField.type = 'hidden';
            actionField.name = 'action';
            actionField.value = action;
            form.appendChild(actionField);

            selectedOrders.forEach(orderId => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'order_ids[]';
                input.value = orderId;
                form.appendChild(input);
            });

            document.body.appendChild(form);
            form.submit();
        }

        // Initialize filters based on URL parameters
        document.addEventListener('DOMContentLoaded', function() {
            // Show filter form if any filter is active
            const urlParams = new URLSearchParams(window.location.search);
            const hasFilters = Array.from(urlParams.keys()).some(key =>
                !['page', 'sort_by', 'sort_order'].includes(key) && urlParams.get(key)
            );

            if (hasFilters) {
                const form = document.getElementById('filterForm');
                const icon = document.querySelector('#filterToggle i');
                form.classList.remove('hidden');
                icon.className = 'fas fa-chevron-up';
            }

            // Status dropdown toggle
            document.querySelectorAll('.action-btn .fa-edit').forEach(icon => {
                icon.parentElement.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const dropdown = this.nextElementSibling;
                    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
                });
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function() {
                document.querySelectorAll('.action-btn + div').forEach(dropdown => {
                    dropdown.style.display = 'none';
                });
            });
        });
    </script>

    @if (session('success'))
        <script>
            showNotification('{{ session('success') }}', 'success');
        </script>
    @endif

    @if (session('error'))
        <script>
            showNotification('{{ session('error') }}', 'error');
        </script>
    @endif

    <script>
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        color: white;
        font-weight: 500;
        z-index: 9999;
        animation: slideIn 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    `;

            if (type === 'success') {
                notification.style.background = 'linear-gradient(135deg, #10b981 0%, #047857 100%)';
            } else if (type === 'error') {
                notification.style.background = 'linear-gradient(135deg, #ef4444 0%, #b91c1c 100%)';
            }

            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }
    </script>

    <style>
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
    </style>
@endsection