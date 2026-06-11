@extends('admin.layouts.basic')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
    <div class="stat-card">
        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px;">
            <div style="width: 50px; height: 50px; background: #fee2e2; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #dc2626; font-size: 20px;">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <div style="font-size: 12px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Total Users</div>
                <div style="font-size: 28px; font-weight: bold; color: #111827;">{{ number_format($stats['total_users'] ?? 0) }}</div>
            </div>
        </div>
    </div>
    
    <div class="stat-card">
        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px;">
            <div style="width: 50px; height: 50px; background: #d1fae5; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #10b981; font-size: 20px;">
                <i class="fas fa-user-tie"></i>
            </div>
            <div>
                <div style="font-size: 12px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Total Sellers</div>
                <div style="font-size: 28px; font-weight: bold; color: #111827;">{{ number_format($stats['total_sellers'] ?? 0) }}</div>
            </div>
        </div>
    </div>
    
    <div class="stat-card">
        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px;">
            <div style="width: 50px; height: 50px; background: #fef3c7; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #f59e0b; font-size: 20px;">
                <i class="fas fa-box"></i>
            </div>
            <div>
                <div style="font-size: 12px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Total Products</div>
                <div style="font-size: 28px; font-weight: bold; color: #111827;">{{ number_format($stats['total_products'] ?? 0) }}</div>
            </div>
        </div>
    </div>
    
    <div class="stat-card">
        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px;">
            <div style="width: 50px; height: 50px; background: #dbeafe; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #3b82f6; font-size: 20px;">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div>
                <div style="font-size: 12px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Total Orders</div>
                <div style="font-size: 28px; font-weight: bold; color: #111827;">{{ number_format($stats['total_orders'] ?? 0) }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Revenue Stats -->
<div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
    <div class="stat-card">
        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px;">
            <div style="width: 50px; height: 50px; background: #fee2e2; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #dc2626; font-size: 20px;">
                <i class="fas fa-calendar-day"></i>
            </div>
            <div>
                <div style="font-size: 12px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Today's Revenue</div>
                <div style="font-size: 28px; font-weight: bold; color: #111827;">${{ number_format($stats['revenue_today'] ?? 0, 2) }}</div>
            </div>
        </div>
    </div>
    
    <div class="stat-card">
        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px;">
            <div style="width: 50px; height: 50px; background: #d1fae5; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #10b981; font-size: 20px;">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div>
                <div style="font-size: 12px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Monthly Revenue</div>
                <div style="font-size: 28px; font-weight: bold; color: #111827;">${{ number_format($stats['revenue_month'] ?? 0, 2) }}</div>
            </div>
        </div>
    </div>
    
    <div class="stat-card">
        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px;">
            <div style="width: 50px; height: 50px; background: #fef3c7; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #f59e0b; font-size: 20px;">
                <i class="fas fa-chart-line"></i>
            </div>
            <div>
                <div style="font-size: 12px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Total Revenue</div>
                <div style="font-size: 28px; font-weight: bold; color: #111827;">${{ number_format($stats['revenue_total'] ?? 0, 2) }}</div>
            </div>
        </div>
    </div>
    
    <div class="stat-card">
        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px;">
            <div style="width: 50px; height: 50px; background: #fee2e2; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #ef4444; font-size: 20px;">
                <i class="fas fa-clock"></i>
            </div>
            <div>
                <div style="font-size: 12px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px;">Pending Orders</div>
                <div style="font-size: 28px; font-weight: bold; color: #111827;">{{ number_format($stats['pending_orders'] ?? 0) }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="stat-card">
    <h3 style="margin-top: 0; color: #374151; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px;">
        <i class="fas fa-clock"></i> Recent Orders
    </h3>
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f9fafb;">
                    <th style="padding: 12px; text-align: left; color: #374151;">Order ID</th>
                    <th style="padding: 12px; text-align: left; color: #374151;">Date</th>
                    <th style="padding: 12px; text-align: left; color: #374151;">Amount</th>
                    <th style="padding: 12px; text-align: left; color: #374151;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 12px;">#{{ $order->order_id ?? $order->sl_no }}</td>
                    <td style="padding: 12px;">
                        @if($order->placed_at)
                            {{ \Carbon\Carbon::parse($order->placed_at)->format('M d, Y') }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td style="padding: 12px;">${{ number_format($order->total_amount, 2) }}</td>
                    <td style="padding: 12px;">
                        @php
                            $status = strtolower($order->order_status ?? 'pending');
                        @endphp
                        
                        @if($status == 'pending')
                            <span style="background: #fef3c7; color: #f59e0b; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Pending</span>
                        @elseif($status == 'processing')
                            <span style="background: #dbeafe; color: #3b82f6; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Processing</span>
                        @elseif($status == 'completed')
                            <span style="background: #d1fae5; color: #10b981; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Completed</span>
                        @elseif($status == 'cancelled')
                            <span style="background: #fee2e2; color: #ef4444; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Cancelled</span>
                        @else
                            <span style="background: #f3f4f6; color: #6b7280; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">{{ ucfirst($status) }}</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="padding: 40px; text-align: center; color: #9ca3af;">
                        <i class="fas fa-inbox" style="font-size: 48px; margin-bottom: 10px;"></i>
                        <p>No orders found</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Top Products -->
@if(isset($topProducts) && $topProducts->count() > 0)
<div class="stat-card" style="margin-top: 30px;">
    <h3 style="margin-top: 0; color: #374151; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px;">
        <i class="fas fa-chart-bar"></i> Top Selling Products
    </h3>
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f9fafb;">
                    <th style="padding: 12px; text-align: left; color: #374151;">Product</th>
                    <th style="padding: 12px; text-align: left; color: #374151;">Sold</th>
                    <th style="padding: 12px; text-align: left; color: #374151;">Rating</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topProducts as $product)
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 12px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 40px; height: 40px; background: #f3f4f6; border-radius: 8px;"></div>
                            <div>
                                <strong>{{ $product->name ?? 'Product #' . $product->id }}</strong><br>
                                <small style="color: #6b7280;">{{ $product->category ?? 'General' }}</small>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 12px;">{{ number_format($product->sold_count ?? 0) }}</td>
                    <td style="padding: 12px;">
                        <div style="display: flex; align-items: center; gap: 2px;">
                            <i class="fas fa-star" style="color: #f59e0b;"></i>
                            <span>{{ number_format($product->rating ?? 0, 1) }}</span>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

<script>
    // Simple chart using CSS
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Dashboard loaded successfully');
        
        // Add hover effects
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.boxShadow = '0 10px 25px rgba(0,0,0,0.1)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
            });
        });
    });
</script>
@endsection