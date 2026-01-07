@extends('seller.layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('seller.orders.index') }}" class="btn btn-secondary btn-sm">← Back to Orders</a>
</div>

<div class="card">
    <div class="card-header">
        <h3>Order #{{ $order->order_id ?? $order->sl_no }}</h3>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <h5>Order Details</h5>
                <p><strong>Order ID:</strong> {{ $order->order_id ?? $order->sl_no }}</p>
                <p><strong>Status:</strong> <span class="badge bg-{{ $order->order_status === 'placed' ? 'warning' : ($order->order_status === 'delivered' ? 'success' : 'secondary') }}">{{ ucfirst($order->order_status) }}</span></p>
                <p><strong>Payment Method:</strong> {{ $order->payment_method ?? 'N/A' }}</p>
                <p><strong>Total Amount:</strong> ₹{{ number_format($order->total_amount ?? 0, 2) }}</p>
            </div>
            <div class="col-md-6">
                <h5>Timeline</h5>
                <p><strong>Placed At:</strong> {{ isset($order->placed_at) ? \Carbon\Carbon::parse($order->placed_at)->format('d M Y, h:i A') : 'N/A' }}</p>
                <p><strong>Created At:</strong> {{ isset($order->created_at) ? \Carbon\Carbon::parse($order->created_at)->format('d M Y, h:i A') : 'N/A' }}</p>
                <p><strong>Updated At:</strong> {{ isset($order->updated_at) ? \Carbon\Carbon::parse($order->updated_at)->format('d M Y, h:i A') : 'N/A' }}</p>
            </div>
        </div>

        <hr>

        <h5>Order Items</h5>
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Variant ID</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>{{ $item->product_id ?? 'N/A' }}</td>
                        <td>{{ $item->variant_id ?? 'N/A' }}</td>
                        <td>{{ $item->quantity ?? 0 }}</td>
                        <td>₹{{ number_format($item->price ?? 0, 2) }}</td>
                        <td>₹{{ number_format(($item->quantity ?? 0) * ($item->price ?? 0), 2) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">No items in this order.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="row mt-4">
            <div class="col-md-6 offset-md-6">
                <div class="card bg-light">
                    <div class="card-body">
                        <h5>Order Total: <strong>₹{{ number_format($order->total_amount ?? 0, 2) }}</strong></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
