@extends('admin.layouts.basic')

@section('title', 'Order Details: #' . $order->order_id)
@section('page-title', 'Order Details: #' . $order->order_id)

@section('content')
    <style>
        .order-details-container { max-width: 1400px; margin: 0 auto; }

        .order-header {
            background: white; border-radius: 12px; padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem; border: 1px solid #e5e7eb;
        }
        .header-content { display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 2rem; }
        .order-info { flex: 1; min-width: 300px; }
        .order-id { font-size: 1.75rem; font-weight: 700; color: #111827; margin: 0 0 0.5rem 0; }
        .order-date { color: #6b7280; margin: 0 0 1rem 0; font-size: 0.875rem; }
        .status-section { display: flex; gap: 1rem; align-items: center; margin: 1rem 0; flex-wrap: wrap; }
        .status-badge-large {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.75rem 1.5rem; border-radius: 9999px; font-weight: 600; font-size: 0.875rem;
        }
        .status-placed    { background:#dbeafe; color:#3b82f6; }
        .status-confirmed { background:#e0e7ff; color:#6366f1; }
        .status-shipped   { background:#fef9c3; color:#ca8a04; }
        .status-delivered { background:#d1fae5; color:#059669; }
        .status-cancelled { background:#fee2e2; color:#ef4444; }
        .status-refunded  { background:#f3e8ff; color:#8b5cf6; }
        .payment-badge-large {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.75rem 1.5rem; border-radius: 9999px; font-weight: 600;
            font-size: 0.875rem; background:#f3f4f6; color:#374151;
        }
        .order-actions { display: flex; flex-direction: column; gap: 1rem; min-width: 260px; }

        /* Stat Cards */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit,minmax(180px,1fr)); gap: 1rem; margin-bottom: 1.5rem; }
        .stat-card {
            background: white; border-radius: 12px; padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); border-left: 4px solid;
            transition: transform .3s ease; text-align: center;
        }
        .stat-card:hover { transform: translateY(-2px); }
        .stat-card.blue   { border-left-color:#3b82f6; }
        .stat-card.green  { border-left-color:#10b981; }
        .stat-card.orange { border-left-color:#f59e0b; }
        .stat-card.purple { border-left-color:#8b5cf6; }
        .stat-card.red    { border-left-color:#ef4444; }
        .stat-icon  { font-size: 2rem; margin-bottom: .5rem; color: #6b7280; }
        .stat-value { font-size: 1.5rem; font-weight: 700; color: #111827; margin: 0; }
        .stat-label { font-size: .875rem; color: #6b7280; margin-top: .25rem; }

        /* Cards */
        .info-card {
            background: white; border-radius: 12px; padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); margin-bottom: 1.5rem; border: 1px solid #e5e7eb;
        }
        .card-title {
            font-size: 1.25rem; font-weight: 600; color: #111827; margin: 0 0 1rem 0;
            padding-bottom: .75rem; border-bottom: 2px solid #e5e7eb;
            display: flex; align-items: center; gap: .5rem;
        }
        .two-col-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
        .info-grid { display: grid; grid-template-columns: repeat(auto-fit,minmax(220px,1fr)); gap: 1rem; }
        .info-item { display: flex; flex-direction: column; margin-bottom: 1rem; }
        .info-label { font-size: .875rem; color: #6b7280; margin-bottom: .25rem; font-weight: 500; }
        .info-value { font-weight: 600; color: #111827; }
        .info-value.normal { font-weight: 400; line-height: 1.6; }

        /* Address box */
        .address-box {
            background: #f8fafc; border: 1px solid #e5e7eb; border-radius: 8px;
            padding: 1rem 1.25rem; line-height: 1.8;
        }
        .address-box .name { font-weight: 700; font-size: 1rem; color: #111827; }
        .address-box .phone { color: #3b82f6; font-weight: 500; }

        /* Table */
        .table-container {
            background: white; border-radius: 12px; padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); overflow: hidden; border: 1px solid #e5e7eb;
            margin-bottom: 1.5rem;
        }
        .table-responsive { overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th {
            padding: .75rem 1rem; text-align: left; font-weight: 600; color: #374151;
            border-bottom: 2px solid #e5e7eb; background: #f9fafb; white-space: nowrap;
        }
        .data-table td { padding: 1rem; border-bottom: 1px solid #e5e7eb; color: #4b5563; vertical-align: middle; }
        .data-table tr:hover td { background: #f9fafb; }
        .product-info { display: flex; align-items: center; gap: .75rem; }
        .product-image {
            width: 60px; height: 60px; border-radius: 8px;
            background: #f3f4f6; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .product-image img { width: 100%; height: 100%; object-fit: cover; border-radius: 8px; }
        .product-name { font-weight: 600; color: #111827; margin-bottom: .2rem; }
        .product-sku   { font-size: .75rem; color: #6b7280; }
        .product-seller{ font-size: .75rem; color: #3b82f6; font-weight: 500; }
        .variant-tag {
            display: inline-block; font-size: .7rem; background: #ede9fe; color: #7c3aed;
            border-radius: 4px; padding: .1rem .45rem; font-weight: 600; margin-top: .2rem;
        }
        .size-tag {
            display: inline-block; font-size: .7rem; background: #fef3c7; color: #b45309;
            border-radius: 4px; padding: .1rem .45rem; font-weight: 600; margin-top: .2rem;
        }
        .price  { font-weight: 700; color: #111827; }
        .total  { font-weight: 700; color: #111827; font-size: 1rem; }
        .quantity-badge {
            background: #f3f4f6; color: #374151; padding: .25rem .75rem;
            border-radius: 6px; font-size: .875rem; font-weight: 600;
        }

        /* Amount summary */
        .amount-summary { background: #f8fafc; border-radius: 8px; padding: 1.5rem; margin-top: 1.5rem; }
        .amount-row { display: flex; justify-content: space-between; align-items: center; padding: .65rem 0; border-bottom: 1px solid #e5e7eb; }
        .amount-row:last-child { border-bottom: none; }
        .amount-label { color: #6b7280; font-size: .875rem; }
        .amount-value { font-weight: 600; color: #111827; }
        .amount-row.discount .amount-value { color: #10b981; }
        .amount-row.grand-total { font-size: 1.125rem; font-weight: 700; color: #111827; }

        /* Transaction badges */
        .txn-badge {
            display: inline-flex; align-items: center; gap: .35rem;
            padding: .3rem .75rem; border-radius: 9999px; font-size: .75rem; font-weight: 600;
        }
        .txn-success  { background:#d1fae5; color:#059669; }
        .txn-pending  { background:#fef3c7; color:#d97706; }
        .txn-failed   { background:#fee2e2; color:#ef4444; }
        .txn-refunded { background:#f3e8ff; color:#8b5cf6; }
        .txn-type-credit { background:#dbeafe; color:#2563eb; }
        .txn-type-debit  { background:#fee2e2; color:#dc2626; }

        /* Timeline */
        .timeline-container { position: relative; padding-left: 2rem; }
        .timeline-line { position: absolute; left: 1rem; top: 0; bottom: 0; width: 2px; background: #e5e7eb; }
        .timeline-item { position: relative; margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid #f3f4f6; }
        .timeline-item:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
        .timeline-dot {
            position: absolute; left: -2.125rem; top: 0;
            width: 1.5rem; height: 1.5rem; border-radius: 50%;
            background: white; border: 3px solid; display: flex;
            align-items: center; justify-content: center; font-size: .75rem;
        }
        .timeline-dot.blue   { border-color:#3b82f6; color:#3b82f6; }
        .timeline-dot.indigo { border-color:#6366f1; color:#6366f1; }
        .timeline-dot.green  { border-color:#10b981; color:#10b981; }
        .timeline-dot.amber  { border-color:#ca8a04; color:#ca8a04; }
        .timeline-dot.orange { border-color:#f59e0b; color:#f59e0b; }
        .timeline-dot.red    { border-color:#ef4444; color:#ef4444; }
        .timeline-dot.purple { border-color:#8b5cf6; color:#8b5cf6; }
        .timeline-event { font-weight: 600; color: #111827; margin-bottom: .25rem; }
        .timeline-description { font-size: .875rem; color: #6b7280; margin-bottom: .25rem; }
        .timeline-date { font-size: .75rem; color: #9ca3af; }

        /* Buttons */
        .action-buttons { display: flex; gap: .75rem; margin-top: 1.5rem; flex-wrap: wrap; }
        .btn { padding: .75rem 1.5rem; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: .5rem; transition: all .3s ease; border: none; cursor: pointer; font-size: .875rem; }
        .btn-primary  { background: linear-gradient(135deg,#3b82f6 0%,#1d4ed8 100%); color: white; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(59,130,246,.3); }
        .btn-success  { background: linear-gradient(135deg,#10b981 0%,#047857 100%); color: white; }
        .btn-success:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(16,185,129,.3); }
        .btn-danger   { background: linear-gradient(135deg,#ef4444 0%,#b91c1c 100%); color: white; }
        .btn-danger:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(239,68,68,.3); }
        .btn-secondary{ background: #f3f4f6; color: #374151; border: 1px solid #d1d5db; }
        .btn-secondary:hover { background: #e5e7eb; }

        /* Status form */
        .status-form { background: #f8fafc; border-radius: 8px; padding: 1.5rem; }
        .form-group { margin-bottom: 1rem; }
        .form-label { display: block; font-size: .875rem; font-weight: 500; color: #374151; margin-bottom: .5rem; }
        .form-select, .form-textarea {
            width: 100%; padding: .75rem; border: 1px solid #d1d5db;
            border-radius: 6px; font-size: .875rem; color: #374151; background: white;
        }
        .form-textarea { min-height: 90px; resize: vertical; }
        .form-actions { display: flex; gap: .75rem; margin-top: 1rem; }

        .empty-state { padding: 2.5rem 1rem; text-align: center; color: #9ca3af; }
        .empty-icon  { font-size: 3rem; margin-bottom: 1rem; color: #e5e7eb; }

        @media (max-width: 768px) {
            .header-content, .two-col-grid { flex-direction: column; }
            .two-col-grid { display: block; }
            .order-actions { width: 100%; }
            .action-buttons, .form-actions { flex-direction: column; }
            .btn { width: 100%; justify-content: center; }
            .info-grid { grid-template-columns: 1fr; }
        }
    </style>

    <div class="order-details-container">

        {{-- ══════════════════════════════════════
             ORDER HEADER
        ══════════════════════════════════════ --}}
        <div class="order-header">
            <div class="header-content">
                <div class="order-info">
                    <h1 class="order-id">Order #{{ $order->order_id }}</h1>
                    <p class="order-date">
                        @if ($order->placed_at)
                            Placed on {{ $order->placed_at->format('F d, Y \a\t h:i A') }}
                        @else
                            Date not available
                        @endif
                    </p>

                    <div class="status-section">
                        @php $status = strtolower($order->order_status ?? 'pending'); @endphp
                        <span class="status-badge-large status-{{ $status }}">
                            @switch($status)
                                @case('placed')     <i class="fas fa-shopping-cart"></i> Placed     @break
                                @case('confirmed')  <i class="fas fa-check"></i> Confirmed           @break
                                @case('shipped')    <i class="fas fa-shipping-fast"></i> Shipped     @break
                                @case('delivered')  <i class="fas fa-box-open"></i> Delivered        @break
                                @case('cancelled')  <i class="fas fa-times-circle"></i> Cancelled    @break
                                @case('refunded')   <i class="fas fa-undo"></i> Refunded             @break
                                @default            <i class="fas fa-circle"></i> {{ ucfirst($status) }}
                            @endswitch
                        </span>

                        <span class="payment-badge-large">
                            @switch(strtolower($order->payment_method ?? ''))
                                @case('cod')    <i class="fas fa-money-bill-wave"></i>  @break
                                @case('upi')    <i class="fas fa-mobile-alt"></i>       @break
                                @case('wallet') <i class="fas fa-wallet"></i>           @break
                                @default        <i class="fas fa-credit-card"></i>
                            @endswitch
                            {{ ucwords(str_replace('_', ' ', $order->payment_method ?? 'Not specified')) }}
                        </span>
                    </div>

                    <div class="action-buttons">
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Orders
                        </a>
                        <button onclick="window.print()" class="btn btn-secondary">
                            <i class="fas fa-print"></i> Print
                        </button>
                        <button onclick="copyOrderId()" class="btn btn-secondary">
                            <i class="fas fa-copy"></i> Copy ID
                        </button>
                        <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Delete this order permanently?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>

                <div class="order-actions">
                    <div class="status-form">
                        <h3 style="font-size:1rem;font-weight:600;color:#111827;margin-bottom:1rem;">
                            <i class="fas fa-edit"></i> Update Status
                        </h3>
                        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="status" class="form-label">New Status</label>
                                <select id="status" name="status" class="form-select" required>
                                    @foreach(['placed','confirmed','processing','shipped','delivered','cancelled','refunded'] as $s)
                                        <option value="{{ $s }}" {{ $status == $s ? 'selected' : '' }}>
                                            {{ ucfirst($s) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="notes" class="form-label">Notes (Optional)</label>
                                <textarea id="notes" name="notes" class="form-textarea"
                                    placeholder="Add notes about this change..."></textarea>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary" style="flex:1;">
                                    <i class="fas fa-save"></i> Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══════════════════════════════════════
             STATS CARDS
        ══════════════════════════════════════ --}}
        <div class="stats-grid">
            <div class="stat-card blue">
                <div class="stat-icon"><i class="fas fa-box"></i></div>
                <div class="stat-value">{{ $orderStats['items_count'] }}</div>
                <div class="stat-label">Items</div>
            </div>
            <div class="stat-card green">
                <div class="stat-icon"><i class="fas fa-store"></i></div>
                <div class="stat-value">{{ $orderStats['unique_sellers'] }}</div>
                <div class="stat-label">Sellers</div>
            </div>
            <div class="stat-card orange">
                <div class="stat-icon"><i class="fas fa-cubes"></i></div>
                <div class="stat-value">{{ $orderStats['total_quantity'] }}</div>
                <div class="stat-label">Total Qty</div>
            </div>
            <div class="stat-card purple">
                <div class="stat-icon"><i class="fas fa-rupee-sign"></i></div>
                <div class="stat-value">₹{{ number_format($order->total_amount, 2) }}</div>
                <div class="stat-label">Order Total</div>
            </div>
        </div>

        {{-- ══════════════════════════════════════
             CUSTOMER INFORMATION
        ══════════════════════════════════════ --}}
        <div class="info-card">
            <h3 class="card-title"><i class="fas fa-user"></i> Customer Information</h3>
            <div class="info-grid">
                @if ($order->user)
                    <div class="info-item">
                        <span class="info-label">Full Name</span>
                        <span class="info-value">{{ $order->user->name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ $order->user->email }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Phone</span>
                        <span class="info-value">{{ $order->user->phone ?? '—' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Customer Since</span>
                        <span class="info-value">
                            {{ $order->user->created_at ? $order->user->created_at->format('M d, Y') : '—' }}
                        </span>
                    </div>
                @else
                    <div class="info-item" style="grid-column:span 2;">
                        <span class="info-label">Customer</span>
                        <span class="info-value">Guest / Deleted Account</span>
                    </div>
                @endif
            </div>
        </div>

        {{-- ══════════════════════════════════════
             BILLING & SHIPPING ADDRESS
        ══════════════════════════════════════ --}}
        <div class="info-card">
            <h3 class="card-title"><i class="fas fa-map-marker-alt"></i> Billing &amp; Shipping Address</h3>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;">

                {{-- Billing Address --}}
                <div>
                    <p class="info-label" style="margin-bottom:.6rem;font-size:.95rem;">
                        <i class="fas fa-file-invoice" style="color:#6366f1;"></i> Billing Address
                    </p>
                    @if ($order->billing_name || $order->billing_address)
                        <div class="address-box">
                            <div class="name">{{ $order->billing_name ?? '—' }}</div>
                            @if ($order->billing_phone)
                                <div class="phone"><i class="fas fa-phone-alt fa-xs"></i> {{ $order->billing_phone }}</div>
                            @endif
                            @if ($order->billing_email)
                                <div><i class="fas fa-envelope fa-xs" style="color:#9ca3af;"></i> {{ $order->billing_email }}</div>
                            @endif
                            <div style="margin-top:.4rem;">
                                {{ $order->billing_address ?? '' }}@if($order->billing_city), {{ $order->billing_city }}@endif
                                @if($order->billing_state), {{ $order->billing_state }}@endif
                                @if($order->billing_country), {{ $order->billing_country }}@endif
                                @if($order->billing_zip) – {{ $order->billing_zip }}@endif
                            </div>
                        </div>
                    @elseif ($order->address)
                        {{-- Fallback to linked address record --}}
                        <div class="address-box">
                            <div class="name">{{ $order->address->first_name }} {{ $order->address->last_name }}</div>
                            <div class="phone"><i class="fas fa-phone-alt fa-xs"></i> {{ $order->address->phone }}</div>
                            <div style="margin-top:.4rem;">
                                {{ $order->address->address }}, {{ $order->address->city }},
                                {{ $order->address->state ?? '' }} {{ $order->address->pincode }},
                                {{ $order->address->country ?? '' }}
                            </div>
                        </div>
                    @else
                        <div class="address-box" style="color:#9ca3af;">No billing address on record.</div>
                    @endif
                </div>

                {{-- Shipping Address --}}
                <div>
                    <p class="info-label" style="margin-bottom:.6rem;font-size:.95rem;">
                        <i class="fas fa-truck" style="color:#10b981;"></i> Shipping Address
                    </p>
                    @if ($order->shipping_name || $order->shipping_address)
                        <div class="address-box">
                            <div class="name">{{ $order->shipping_name ?? '—' }}</div>
                            @if ($order->shipping_phone)
                                <div class="phone"><i class="fas fa-phone-alt fa-xs"></i> {{ $order->shipping_phone }}</div>
                            @endif
                            <div style="margin-top:.4rem;">
                                {{ $order->shipping_address ?? '' }}@if($order->shipping_city), {{ $order->shipping_city }}@endif
                                @if($order->shipping_state), {{ $order->shipping_state }}@endif
                                @if($order->shipping_country), {{ $order->shipping_country }}@endif
                                @if($order->shipping_zip) – {{ $order->shipping_zip }}@endif
                            </div>
                        </div>
                    @elseif ($order->address)
                        <div class="address-box">
                            <div class="name">{{ $order->address->first_name }} {{ $order->address->last_name }}</div>
                            <div class="phone"><i class="fas fa-phone-alt fa-xs"></i> {{ $order->address->phone }}</div>
                            <div style="margin-top:.4rem;">
                                {{ $order->address->address }}, {{ $order->address->city }},
                                {{ $order->address->state ?? '' }} {{ $order->address->pincode }},
                                {{ $order->address->country ?? '' }}
                            </div>
                        </div>
                    @else
                        <div class="address-box" style="color:#9ca3af;">Same as billing / No address on record.</div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ══════════════════════════════════════
             ORDER ITEMS
        ══════════════════════════════════════ --}}
        <div class="table-container">
            <h3 class="card-title">
                <i class="fas fa-shopping-bag"></i> Order Items
                <span style="font-size:.875rem;color:#6b7280;margin-left:.5rem;">
                    ({{ $order->items->count() }} items)
                </span>
            </h3>

            @if ($order->items->count() > 0)
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Variant / Size</th>
                                <th>Seller</th>
                                <th>Unit Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <td>
                                        <div class="product-info">
                                            <div class="product-image">
                                                @if ($item->product && $item->product->thumbnail)
                                                    <img src="{{ Storage::url($item->product->thumbnail) }}"
                                                         alt="{{ $item->product->name }}">
                                                @else
                                                    <i class="fas fa-box" style="color:#9ca3af;"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="product-name">
                                                    {{ $item->product->name ?? 'Product not found' }}
                                                </div>
                                                @if ($item->product && $item->product->sku)
                                                    <div class="product-sku">SKU: {{ $item->product->sku }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($item->variant && $item->size )
                                            <span class="variant-tag">
                                                <i class="fas fa-layer-group fa-xs"></i>
                                                {{ $item->variant->variant_name }}
                                            </span>
                                            <span class="size-tag">
                                                <i class="fas fa-ruler fa-xs"></i>
                                                {{ $item->size }}
                                            </span>
                                        @elseif ($item->variant)
                                            <span class="variant-tag">
                                                <i class="fas fa-layer-group fa-xs"></i>
                                                {{ $item->variant->variant_name }}
                                            </span>
                                        @elseif ($item->size)
                                            <span class="size-tag">
                                                <i class="fas fa-ruler fa-xs"></i>
                                                {{ $item->size }}
                                            </span>
                                        @endif
                                        @if (!$item->variant && !$item->size)
                                            <span style="color:#9ca3af;font-size:.8rem;">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->product && $item->product->seller)
                                            <div class="product-seller">
                                                <i class="fas fa-store fa-xs"></i>
                                                {{ $item->product->seller->shop_name }}
                                            </div>
                                        @else
                                            <span style="color:#9ca3af;">N/A</span>
                                        @endif
                                    </td>
                                    <td><div class="price">₹{{ number_format($item->price, 2) }}</div></td>
                                    <td><span class="quantity-badge">{{ $item->quantity }}</span></td>
                                    <td><div class="total">₹{{ number_format($item->price * $item->quantity, 2) }}</div></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Amount Summary --}}
                <div class="amount-summary">
                    <div class="amount-row">
                        <span class="amount-label">Subtotal</span>
                        <span class="amount-value">₹{{ number_format($orderStats['subtotal'], 2) }}</span>
                    </div>
                    @if ($orderStats['tax'] > 0)
                        <div class="amount-row">
                            <span class="amount-label">Tax</span>
                            <span class="amount-value">₹{{ number_format($orderStats['tax'], 2) }}</span>
                        </div>
                    @endif
                    @if ($orderStats['shipping'] > 0)
                        <div class="amount-row">
                            <span class="amount-label">Shipping Fee</span>
                            <span class="amount-value">₹{{ number_format($orderStats['shipping'], 2) }}</span>
                        </div>
                    @endif
                    @if ($orderStats['discount'] > 0)
                        <div class="amount-row discount">
                            <span class="amount-label">
                                Discount
                                @if ($order->coupon_code)
                                    <span style="font-size:.75rem;background:#d1fae5;color:#059669;border-radius:4px;padding:.1rem .4rem;margin-left:.4rem;">
                                        {{ $order->coupon_code }}
                                    </span>
                                @endif
                            </span>
                            <span class="amount-value">− ₹{{ number_format($orderStats['discount'], 2) }}</span>
                        </div>
                    @endif
                    <div class="amount-row grand-total">
                        <span class="amount-label">Grand Total</span>
                        <span class="amount-value">₹{{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon"><i class="fas fa-shopping-bag"></i></div>
                    <h3 style="color:#6b7280;margin-bottom:.5rem;">No Items Found</h3>
                    <p style="color:#9ca3af;">This order doesn't have any items.</p>
                </div>
            @endif
        </div>

        {{-- ══════════════════════════════════════
             PAYMENT & TRANSACTION DETAILS
        ══════════════════════════════════════ --}}
        <div class="info-card">
            <h3 class="card-title"><i class="fas fa-receipt"></i> Payment &amp; Transaction Details</h3>

            {{-- Summary row --}}
            <div class="info-grid" style="margin-bottom:1.25rem;">
                <div class="info-item">
                    <span class="info-label">Payment Method</span>
                    <span class="info-value">
                        {{ ucwords(str_replace('_', ' ', $order->payment_method ?? 'N/A')) }}
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">Total Charged</span>
                    <span class="info-value">₹{{ number_format($order->total_amount, 2) }}</span>
                </div>
                @if ($order->coupon_code)
                    <div class="info-item">
                        <span class="info-label">Coupon Code</span>
                        <span class="info-value" style="color:#059669;">{{ $order->coupon_code }}</span>
                    </div>
                @endif
                @if ($orderStats['discount'] > 0)
                    <div class="info-item">
                        <span class="info-label">Discount Applied</span>
                        <span class="info-value" style="color:#10b981;">
                            − ₹{{ number_format($orderStats['discount'], 2) }}
                        </span>
                    </div>
                @endif
            </div>

            {{-- Transaction log --}}
            @if ($transactions->count() > 0)
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>Type</th>
                                <th>Method</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $txn)
                                <tr>
                                    <td style="font-family:monospace;font-size:.85rem;">{{ $txn->transaction_id }}</td>
                                    <td>
                                        @php $ttype = strtolower($txn->transaction_type ?? ''); @endphp
                                        <span class="txn-badge {{ $ttype === 'credit' ? 'txn-type-credit' : 'txn-type-debit' }}">
                                            <i class="fas fa-{{ $ttype === 'credit' ? 'arrow-down' : 'arrow-up' }}"></i>
                                            {{ ucfirst($txn->transaction_type ?? '—') }}
                                        </span>
                                    </td>
                                    <td>{{ ucwords(str_replace('_',' ',$txn->payment_method ?? '—')) }}</td>
                                    <td class="price">₹{{ number_format($txn->amount, 2) }}</td>
                                    <td>
                                        @php $ts = strtolower($txn->transaction_status ?? ''); @endphp
                                        <span class="txn-badge
                                            @if($ts==='success' || $ts==='completed') txn-success
                                            @elseif($ts==='pending') txn-pending
                                            @elseif($ts==='failed') txn-failed
                                            @elseif($ts==='refunded') txn-refunded
                                            @else txn-pending @endif">
                                            {{ ucfirst($txn->transaction_status ?? '—') }}
                                        </span>
                                    </td>
                                    <td style="font-size:.8rem;color:#6b7280;">
                                        {{ $txn->transaction_date ? $txn->transaction_date->format('d M Y, h:i A') : '—' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div style="text-align:center;padding:1.5rem;color:#9ca3af;font-size:.875rem;">
                    <i class="fas fa-info-circle" style="margin-right:.4rem;"></i>
                    No transaction records found for this order.
                </div>
            @endif
        </div>

        {{-- ══════════════════════════════════════
             ORDER TIMELINE
        ══════════════════════════════════════ --}}
        <div class="info-card">
            <h3 class="card-title"><i class="fas fa-history"></i> Order Timeline</h3>

            @if (!empty($timeline))
                <div class="timeline-container">
                    <div class="timeline-line"></div>
                    @foreach ($timeline as $event)
                        <div class="timeline-item">
                            <div class="timeline-dot {{ $event['color'] ?? 'blue' }} {{ isset($event['current']) ? 'current' : '' }}">
                                <i class="{{ $event['icon'] ?? 'fas fa-circle' }}"></i>
                            </div>
                            <div style="margin-left:.5rem;">
                                <div class="timeline-event">{{ $event['event'] }}</div>
                                <div class="timeline-description">{{ $event['description'] ?? '' }}</div>
                                <div class="timeline-date">{{ $event['date']->format('M d, Y \a\t h:i A') }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state" style="padding:1.5rem;">
                    <div class="empty-icon"><i class="fas fa-history"></i></div>
                    <p style="color:#9ca3af;font-size:.875rem;">No timeline events available.</p>
                </div>
            @endif
        </div>

        {{-- ══════════════════════════════════════
             ADDITIONAL ORDER INFO
        ══════════════════════════════════════ --}}
        <div class="info-card">
            <h3 class="card-title"><i class="fas fa-info-circle"></i> Additional Information</h3>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Order ID</span>
                    <span class="info-value">#{{ $order->order_id }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Payment Method</span>
                    <span class="info-value">
                        {{ ucwords(str_replace('_',' ',$order->payment_method ?? 'Not specified')) }}
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">Order Status</span>
                    <span class="info-value">{{ ucfirst($order->order_status ?? 'Pending') }}</span>
                </div>
                @if ($order->placed_at)
                    <div class="info-item">
                        <span class="info-label">Placed At</span>
                        <span class="info-value">{{ $order->placed_at->format('F d, Y H:i') }}</span>
                    </div>
                @endif
                @if ($order->seller_id)
                    <div class="info-item">
                        <span class="info-label">Primary Seller ID</span>
                        <span class="info-value">{{ $order->seller_id }}</span>
                    </div>
                @endif
                @if ($order->address_id)
                    <div class="info-item">
                        <span class="info-label">Address Record ID</span>
                        <span class="info-value">{{ $order->address_id }}</span>
                    </div>
                @endif
                @if ($orderStats['tax'] > 0)
                    <div class="info-item">
                        <span class="info-label">Tax</span>
                        <span class="info-value">₹{{ number_format($orderStats['tax'], 2) }}</span>
                    </div>
                @endif
                @if ($orderStats['shipping'] > 0)
                    <div class="info-item">
                        <span class="info-label">Shipping Fee</span>
                        <span class="info-value">₹{{ number_format($orderStats['shipping'], 2) }}</span>
                    </div>
                @endif
            </div>
        </div>

    </div>{{-- end .order-details-container --}}

    {{-- Keyframes belong in a style tag, NOT inside script --}}
    <style>
        @keyframes pulse {
            0%   { box-shadow: 0 0 0 0 rgba(59,130,246,.4); }
            70%  { box-shadow: 0 0 0 10px rgba(59,130,246,0); }
            100% { box-shadow: 0 0 0 0 rgba(59,130,246,0); }
        }
        .timeline-dot.current { animation: pulse 2s infinite; }

        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to   { transform: translateX(0);    opacity: 1; }
        }
        @keyframes slideOut {
            from { transform: translateX(0);    opacity: 1; }
            to   { transform: translateX(100%); opacity: 0; }
        }
    </style>

    <script>
        function copyOrderId() {
            navigator.clipboard.writeText('{{ $order->order_id }}').then(() => {
                showNotification('Order ID copied!', 'success');
            });
        }

        function showNotification(message, type) {
            const n = document.createElement('div');
            n.style.cssText = [
                'position:fixed','top:20px','right:20px','padding:1rem 1.5rem',
                'border-radius:8px','color:white','font-weight:500','z-index:9999',
                'animation:slideIn .3s ease','box-shadow:0 4px 12px rgba(0,0,0,.1)'
            ].join(';');
            n.style.background = type === 'success'
                ? 'linear-gradient(135deg,#10b981 0%,#047857 100%)'
                : 'linear-gradient(135deg,#ef4444 0%,#b91c1c 100%)';
            n.textContent = message;
            document.body.appendChild(n);
            setTimeout(() => {
                n.style.animation = 'slideOut .3s ease';
                setTimeout(() => n.remove(), 300);
            }, 3000);
        }

        // Status change guard
        document.querySelectorAll('form[action*="update-status"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                const newStatus  = this.querySelector('#status').value;
                const curStatus  = '{{ $status }}';
                if (newStatus === curStatus) {
                    e.preventDefault();
                    showNotification('Order is already ' + newStatus, 'error');
                }
            });
        });
    </script>

    @if (session('success'))
        <script>showNotification('{{ session('success') }}', 'success');</script>
    @endif
    @if (session('error'))
        <script>showNotification('{{ session('error') }}', 'error');</script>
    @endif

@endsection