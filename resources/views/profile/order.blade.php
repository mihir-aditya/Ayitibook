<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order History | AyitiBook</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      background: #f8f9fa;
      font-family: 'Poppins', sans-serif;
    }
    .order-card {
      background: #fff;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      margin: 40px auto;
      max-width: 1200px;
    }
    .table thead th {
      background: #f1f1f1;
      font-weight: 600;
      border-bottom: 2px solid #dee2e6;
    }
    .product-img {
      width: 55px;
      height: 55px;
      object-fit: cover;
      border-radius: 6px;
      border: 1px solid #eee;
    }
    .more-items-badge {
      background: #f0f0f0;
      font-size: 11px;
      padding: 2px 8px;
      border-radius: 20px;
      color: #555;
      display: inline-block;
      margin-left: 8px;
    }
    .status-badge {
      padding: 6px 10px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 500;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }
    .status-badge.pending     { background: #e2e3e5; color: #41464b; }
    .status-badge.confirmed   { background: #cce5ff; color: #004085; }
    .status-badge.processing  { background: #fff3cd; color: #856404; }
    .status-badge.shipped     { background: #d4edda; color: #155724; }
    .status-badge.delivered   { background: #d4edda; color: #155724; }
    .status-badge.cancelled   { background: #f8d7da; color: #721c24; }
    .status-badge.returned    { background: #f8d7da; color: #721c24; }

    .action-btn {
      font-size: 12px;
      padding: 5px 12px;
      border-radius: 20px;
      margin: 2px;
      transition: all 0.2s;
    }
    .action-btn i {
      margin-right: 4px;
    }
    .action-btn:hover {
      transform: translateY(-1px);
    }

    .search-filter-row {
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
      align-items: center;
    }
    .search-filter-row .input-group {
      flex: 1 1 360px;
      min-width: 220px;
    }
    .dropdown-menu {
      background: rgba(255, 255, 255, 0.95);
      border: 1px solid #ddd;
      border-radius: 8px;
      max-height: 450px;
      overflow-y: auto;
      padding-bottom: 70px;
    }
    .dropdown-menu .fw-bold {
      color: #db4444;
      font-size: 14px;
      text-transform: uppercase;
    }
    .dropdown-menu .form-check-input {
      border: 2px solid #db4444;
      cursor: pointer;
    }
    .dropdown-menu .form-check-input:checked {
      background-color: #db4444;
      border-color: #db4444;
    }
    .dropdown-menu .form-check:hover {
      background: rgba(219, 68, 68, 0.08);
      border-radius: 6px;
    }
    .dropdown-menu .apply-btn button {
      display: block;
      width: 100%;
      border-radius: 0;
      padding: 12px;
      font-weight: 600;
      background: #dc3545;
      color: #fff;
      text-align: center;
      border: none;
    }
    .dropdown-menu .apply-btn button:hover {
      background: #c82333;
    }

    .table tbody tr {
      transition: background 0.2s;
    }
    .table tbody tr:hover {
      background: #fafafa;
    }

    .pagination {
      justify-content: center;
      margin-top: 1rem;
    }
    .page-link {
      color: #db4444;
    }
    .page-item.active .page-link {
      background-color: #db4444;
      border-color: #db4444;
      color: #fff;
    }

    @media (max-width: 768px) {
      .order-card {
        padding: 15px;
      }
      .action-btn {
        padding: 4px 8px;
        font-size: 11px;
      }
      .status-badge {
        font-size: 11px;
        padding: 4px 8px;
      }
      .product-img {
        width: 45px;
        height: 45px;
      }
    }
  </style>
</head>
<body>

@include('includes.header')

<div class="container my-4">
  <div class="row">
    <div class="col-lg-3">
      @include('includes.sidebar')
    </div>

    <div class="col-lg-9">
      <div class="order-card">
        <h3 class="mb-3">Order History</h3>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('my-orders') }}" id="filterForm">
          <div class="search-filter-row mb-3">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search orders (Order ID, Title, Status, Payment)..." value="{{ request('q') }}">
              <button class="btn btn-primary" type="submit">
                <i class="fa fa-search"></i>
              </button>
            </div>

            <div class="dropdown">
              <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Filter by <i class="fa fa-filter"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end p-3" style="min-width: 280px;">
                <!-- Sort By -->
                <div class="fw-bold mb-2">Sort By</div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="sort" value="latest" id="sortLatest" {{ request('sort') == 'latest' ? 'checked' : '' }}>
                  <label class="form-check-label" for="sortLatest">Latest First</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="sort" value="oldest" id="sortOldest" {{ request('sort') == 'oldest' ? 'checked' : '' }}>
                  <label class="form-check-label" for="sortOldest">Older First</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="sort" value="az" id="sortAZ" {{ request('sort') == 'az' ? 'checked' : '' }}>
                  <label class="form-check-label" for="sortAZ">A - Z</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="sort" value="za" id="sortZA" {{ request('sort') == 'za' ? 'checked' : '' }}>
                  <label class="form-check-label" for="sortZA">Z - A</label>
                </div>

                <hr>

                <!-- Order Time -->
                <div class="fw-bold mb-2">Order Time</div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="time" value="30days" id="time30" {{ request('time') == '30days' ? 'checked' : '' }}>
                  <label class="form-check-label" for="time30">Last 30 Days</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="time" value="2024" id="time2024" {{ request('time') == '2024' ? 'checked' : '' }}>
                  <label class="form-check-label" for="time2024">2024</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="time" value="2023" id="time2023" {{ request('time') == '2023' ? 'checked' : '' }}>
                  <label class="form-check-label" for="time2023">2023</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="time" value="2022" id="time2022" {{ request('time') == '2022' ? 'checked' : '' }}>
                  <label class="form-check-label" for="time2022">2022</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="time" value="2021" id="time2021" {{ request('time') == '2021' ? 'checked' : '' }}>
                  <label class="form-check-label" for="time2021">2021</label>
                </div>
                <div class="form-check mb-3">
                  <input class="form-check-input" type="radio" name="time" value="older" id="timeOlder" {{ request('time') == 'older' ? 'checked' : '' }}>
                  <label class="form-check-label" for="timeOlder">Older</label>
                </div>

                <hr>

                <!-- Order Status -->
                <div class="fw-bold mb-2">Order Status</div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" value="" id="statusAll" {{ request('status') == '' ? 'checked' : '' }}>
                  <label class="form-check-label" for="statusAll">All Orders</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" value="pending" id="statusPending" {{ request('status') == 'pending' ? 'checked' : '' }}>
                  <label class="form-check-label" for="statusPending">Pending</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" value="confirmed" id="statusConfirmed" {{ request('status') == 'confirmed' ? 'checked' : '' }}>
                  <label class="form-check-label" for="statusConfirmed">Confirmed</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" value="processing" id="statusProcessing" {{ request('status') == 'processing' ? 'checked' : '' }}>
                  <label class="form-check-label" for="statusProcessing">Processing</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" value="shipped" id="statusShipped" {{ request('status') == 'shipped' ? 'checked' : '' }}>
                  <label class="form-check-label" for="statusShipped">Shipped</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" value="delivered" id="statusDelivered" {{ request('status') == 'delivered' ? 'checked' : '' }}>
                  <label class="form-check-label" for="statusDelivered">Delivered</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" value="cancelled" id="statusCancelled" {{ request('status') == 'cancelled' ? 'checked' : '' }}>
                  <label class="form-check-label" for="statusCancelled">Cancelled</label>
                </div>

                <div class="apply-btn mt-3">
                  <button type="submit" class="btn btn-danger w-100">Apply Filters</button>
                </div>
                @if(request()->anyFilled(['q', 'sort', 'time', 'status']))
                  <a href="{{ route('my-orders') }}" class="btn btn-link btn-sm mt-2 d-block text-center">Clear Filters</a>
                @endif
              </div>
            </div>
          </div>
        </form>

        <!-- Orders Table -->
        <div class="table-responsive">
          <table class="table align-middle table-hover">
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Product(s)</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Payment</th>
                <th>Date & Time</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($orders as $order)
                @php
                  $items = $order->items;
                  $itemCount = $items->count();
                  $firstItem = $items->first();
                  $product = $firstItem?->product;

                  // Safely get variant name (supports both relationship and JSON)
                  $variantName = '';
                  if ($firstItem && $firstItem->variant) {
                      if (is_object($firstItem->variant) && isset($firstItem->variant->variant_name)) {
                          $variantName = $firstItem->variant->variant_name;
                      } elseif (is_array($firstItem->variant) && isset($firstItem->variant['variant_name'])) {
                          $variantName = $firstItem->variant['variant_name'];
                      } elseif (is_string($firstItem->variant)) {
                          $decoded = json_decode($firstItem->variant, true);
                          $variantName = $decoded['variant_name'] ?? '';
                      }
                  }
                @endphp
                <tr>
                  <td class="fw-bold">#{{ $order->order_id }}</td>

                  <!-- Product(s) -->
                  <td>
                    <div class="d-flex align-items-center gap-2">
                      <img src="{{ $product && $product->thumbnail ? asset('storage/' . $product->thumbnail) : asset('assets/images/placeholder.png') }}" 
                           class="product-img" alt="{{ $product->name ?? 'Product' }}">
                      <div>
                        <div class="fw-semibold">{{ $product->name ?? ($firstItem->product_name ?? 'Product') }}</div>
                        @if($variantName)
                          <small class="text-muted">{{ $variantName }}</small>
                        @endif
                        @if($itemCount > 1)
                          <span class="more-items-badge">+{{ $itemCount - 1 }} more</span>
                        @endif
                      </div>
                    </div>
                  </td>

                  <!-- Amount -->
                  <td class="fw-bold text-danger">${{ number_format($order->total_amount, 2) }}</td>

                  <!-- Status -->
                  <td>
                    <span class="status-badge {{ strtolower($order->order_status) }}">
                      <i class="fas 
                        @switch($order->order_status)
                          @case('pending') fa-clock @break
                          @case('confirmed') fa-check-circle @break
                          @case('processing') fa-cogs @break
                          @case('shipped') fa-truck @break
                          @case('delivered') fa-check-double @break
                          @case('cancelled') fa-times-circle @break
                          @default fa-circle
                        @endswitch
                      "></i>
                      {{ ucfirst($order->order_status) }}
                    </span>
                  </td>

                  <!-- Payment -->
                  <td>
                    <i class="fas 
                      @if(str_contains(strtolower($order->payment_method), 'card')) fa-credit-card
                      @elseif(str_contains(strtolower($order->payment_method), 'paypal')) fa-paypal
                      @elseif(str_contains(strtolower($order->payment_method), 'cod')) fa-money-bill-wave
                      @else fa-receipt
                      @endif
                    "></i>
                    {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}
                  </td>

                  <!-- Date & Time -->
                  <td>
                    {{ $order->placed_at ? $order->placed_at->format('M d, Y') : 'N/A' }}<br>
                    <small class="text-muted">{{ $order->placed_at ? $order->placed_at->format('h:i A') : '' }}</small>
                  </td>

                  <!-- Actions -->
                  <td>
                    <div class="d-flex flex-wrap gap-1">
                      <a href="{{ route('order.show', $order->order_id) }}" class="btn btn-sm btn-outline-primary action-btn" title="View Details">
                        <i class="fas fa-eye"></i> View
                      </a>

                      @if(in_array($order->order_status, ['shipped', 'processing', 'confirmed']))
                        <a href="{{ route('order.show', $order->order_id) }}" class="btn btn-sm btn-outline-info action-btn" title="Track Order">
                          <i class="fas fa-map-marker-alt"></i> Track
                        </a>
                      @endif

                      @if(in_array($order->order_status, ['pending','placed', 'confirmed']))
                        <form action="{{ route('order.cancel', $order->order_id) }}" method="POST" class="d-inline">
                          @csrf
                          @method('PATCH')
                          <button type="submit" class="btn btn-sm btn-outline-danger action-btn" onclick="return confirm('Cancel this order?')">
                            <i class="fas fa-times"></i> Cancel
                          </button>
                        </form>
                      @endif

                      @if(in_array($order->order_status, ['delivered', 'cancelled']))
                        <a href="#" class="btn btn-sm btn-outline-success action-btn" title="Buy Again">
                          <i class="fas fa-redo-alt"></i> Reorder
                        </a>
                      @endif
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="text-center py-5">
                    <i class="fas fa-box-open fa-3x text-muted mb-3 d-block"></i>
                    <h5>No orders found</h5>
                    @if(request()->anyFilled(['q', 'sort', 'time', 'status']))
                      <a href="{{ route('my-orders') }}" class="btn btn-link">Clear filters</a>
                    @else
                      <a href="/home" class="btn btn-primary mt-2">Start Shopping</a>
                    @endif
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        @if(method_exists($orders, 'links'))
          <div class="d-flex justify-content-center mt-4">
            {{ $orders->appends(request()->query())->links('pagination::bootstrap-5') }}
          </div>
        @endif
      </div>
    </div>
  </div>
</div>

@include('includes.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>