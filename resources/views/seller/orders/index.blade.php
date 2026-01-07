@extends('seller.layouts.app')

@section('content')
<h2 class="mb-3">Orders</h2>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Total</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @forelse($orders as $order)
            <tr style="cursor: pointer;" onclick="window.location.href='{{ route('seller.orders.show', $order->sl_no) }}'">
                <td><a href="{{ route('seller.orders.show', $order->sl_no) }}">#{{ $order->order_id ?? $order->sl_no }}</a></td>
                <td>{{ $order->user_id ?? 'Guest' }}</td>
                <td>₹{{ number_format($order->total_amount ?? 0, 2) }}</td>
                <td><span class="badge bg-{{ $order->order_status === 'placed' ? 'warning' : ($order->order_status === 'delivered' ? 'success' : 'secondary') }}">{{ ucfirst($order->order_status) }}</span></td>
                <td>{{ isset($order->placed_at) ? \Carbon\Carbon::parse($order->placed_at)->format('d M Y') : '' }}</td>
            </tr>
        @empty
            <tr><td colspan="5">No orders found.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
