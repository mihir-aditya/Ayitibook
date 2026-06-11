<!-- Complete the missing parts and fix the HTML structure -->

@extends('admin.layouts.basic')

@section('title', 'Seller Details: ' . $seller->shop_name)
@section('page-title', 'Seller Details: ' . $seller->shop_name)

@section('content')
<style>
    .seller-details-container {
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .seller-header {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        margin-bottom: 1.5rem;
        border: 1px solid #e5e7eb;
    }
    
    .seller-avatar-large {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }
    
    .seller-name {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }
    
    .seller-email {
        color: #6b7280;
        margin: 0.5rem 0;
        font-size: 1rem;
    }
    
    .seller-shop {
        color: #3b82f6;
        font-weight: 600;
        font-size: 1.25rem;
        margin: 0.5rem 0;
    }
    
    .status-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-weight: 600;
        font-size: 0.875rem;
    }
    
    .status-pending {
        background: #fef3c7;
        color: #f59e0b;
    }
    
    .status-approved {
        background: #d1fae5;
        color: #10b981;
    }
    
    .status-rejected {
        background: #fee2e2;
        color: #ef4444;
    }
    
    .verified-badge {
        background: #dbeafe;
        color: #3b82f6;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border-left: 4px solid;
        transition: transform 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-4px);
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
    
    .stat-card.purple {
        border-left-color: #8b5cf6;
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
    }
    
    .stat-card.red {
        border-left-color: #dc2626;
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        color: white;
    }
    
    .stat-icon {
        font-size: 2rem;
        opacity: 0.9;
        margin-bottom: 1rem;
    }
    
    .stat-value {
        font-size: 1.75rem;
        font-weight: 700;
        margin: 0;
    }
    
    .stat-label {
        font-size: 0.875rem;
        opacity: 0.9;
        margin-top: 0.5rem;
    }
    
    .info-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        margin-bottom: 1.5rem;
        border: 1px solid #e5e7eb;
    }
    
    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #111827;
        margin: 0 0 1rem 0;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
    }
    
    .info-item {
        display: flex;
        flex-direction: column;
        margin-bottom: 1rem;
    }
    
    .info-label {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 0.25rem;
    }
    
    .info-value {
        font-weight: 600;
        color: #111827;
    }
    
    .table-container {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border: 1px solid #e5e7eb;
    }
    
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .data-table th {
        padding: 1rem;
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
    
    .action-buttons {
        display: flex;
        gap: 0.75rem;
        margin-top: 1.5rem;
    }
    
    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        color: white;
    }
    
    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(220, 38, 38, 0.3);
    }
    
    .btn-secondary {
        background: #f3f4f6;
        color: #374151;
        border: 1px solid #d1d5db;
    }
    
    .btn-secondary:hover {
        background: #e5e7eb;
    }
    
    .product-image {
        width: 40px;
        height: 40px;
        background: #f3f4f6;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #9ca3af;
    }
    
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .info-grid {
            grid-template-columns: 1fr;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
    }
    
    @media (max-width: 480px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .seller-header {
            padding: 1.5rem;
        }
        
        .table-container {
            padding: 1rem;
        }
    }
</style>

<div class="seller-details-container">
    <!-- Seller Header -->
    <div class="seller-header">
        <div style="display: flex; align-items: center; gap: 2rem; flex-wrap: wrap;">
            <div>
                <div class="seller-avatar-large">
                    {{ strtoupper(substr($seller->name, 0, 1)) }}
                </div>
            </div>
            
            <div style="flex: 1;">
                <h1 class="seller-name">{{ $seller->name }}</h1>
                <div class="seller-email">
                    <i class="fas fa-envelope"></i> {{ $seller->email }}
                </div>
                <div class="seller-shop">
                    <i class="fas fa-store"></i> {{ $seller->shop_name }}
                </div>
                <div style="display: flex; gap: 1rem; align-items: center; margin-top: 1rem;">
                    @if($seller->status == 'approved')
                        <span class="status-badge status-approved">
                            <i class="fas fa-check-circle"></i> Approved
                        </span>
                    @elseif($seller->status == 'pending')
                        <span class="status-badge status-pending">
                            <i class="fas fa-clock"></i> Pending
                        </span>
                    @else
                        <span class="status-badge status-rejected">
                            <i class="fas fa-times-circle"></i> Rejected
                        </span>
                    @endif
                    
                    @if($seller->is_verified)
                        <span class="verified-badge">
                            <i class="fas fa-shield-alt"></i> Verified
                        </span>
                    
                    @else
                        <span class="unverified-badge">
                            <i class="fas fa-shield-alt"></i> Unverified
                    @endif
               
                    @if($seller->phone)
                        <span style="color: #6b7280;">
                            <i class="fas fa-phone"></i> {{ $seller->phone }}
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="action-buttons">
                <a href="{{ route('admin.sellers.edit', $seller) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit Seller
                </a>
                <a href="{{ route('admin.sellers.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>
    
    <!-- Statistics -->
    <div class="stats-grid">
        <div class="stat-card blue">
            <div class="stat-icon">
                <i class="fas fa-box"></i>
            </div>
            <div class="stat-value">{{ number_format($stats['total_products']) }}</div>
            <div class="stat-label">Total Products</div>
        </div>
        
        <div class="stat-card green">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-value">{{ number_format($stats['active_products']) }}</div>
            <div class="stat-label">Active Products</div>
        </div>
        
        <div class="stat-card orange">
            <div class="stat-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="stat-value">{{ number_format($stats['total_orders']) }}</div>
            <div class="stat-label">Total Orders</div>
        </div>
        
        <div class="stat-card purple">
            <div class="stat-icon">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="stat-value">${{ number_format($stats['total_revenue'], 2) }}</div>
            <div class="stat-label">Total Revenue</div>
        </div>
        
        @if(isset($stats['pending_orders']))
        <div class="stat-card red">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-value">{{ number_format($stats['pending_orders']) }}</div>
            <div class="stat-label">Pending Orders</div>
        </div>
        @endif
    </div>
    
    <!-- Seller Information -->
    <div class="info-card">
        <h3 class="card-title">
            <i class="fas fa-info-circle"></i> Seller Information
        </h3>
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Seller ID</span>
                <span class="info-value">{{ $seller->id }}</span>
            </div>
            
            <div class="info-item">
                <span class="info-label">Username</span>
                <span class="info-value">{{ $seller->username }}</span>
            </div>
            
            <div class="info-item">
                <span class="info-label">Shop Slug</span>
                <span class="info-value">{{ $seller->shop_slug }}</span>
            </div>
            
            <div class="info-item">
                <span class="info-label">Member Since</span>
                <span class="info-value">{{ $seller->created_at->format('F d, Y') }}</span>
            </div>
            
            <div class="info-item">
                <span class="info-label">Last Updated</span>
                <span class="info-value">{{ $seller->updated_at->format('F d, Y') }}</span>
            </div>
        </div>
    </div>
    
    <!-- Business Information -->
    @if($seller->gst_number || $seller->pan_number || $seller->shop_address)
    <div class="info-card">
        <h3 class="card-title">
            <i class="fas fa-building"></i> Business Information
        </h3>
        <div class="info-grid">
            @if($seller->gst_number)
            <div class="info-item">
                <span class="info-label">GST Number</span>
                <span class="info-value">{{ $seller->gst_number }}</span>
            </div>
            @endif
            
            @if($seller->pan_number)
            <div class="info-item">
                <span class="info-label">PAN Number</span>
                <span class="info-value">{{ $seller->pan_number }}</span>
            </div>
            @endif
            
            @if($seller->shop_address)
            <div class="info-item" style="grid-column: span 2;">
                <span class="info-label">Shop Address</span>
                <span class="info-value">{{ $seller->shop_address }}</span>
            </div>
            @endif
        </div>
    </div>
    @endif
    
    <!-- Recent Products -->
    @if($recentProducts->count() > 0)
    <div class="table-container">
        <h3 class="card-title">
            <i class="fas fa-box-open"></i> Recent Products
        </h3>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentProducts as $product)
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div class="product-image">
                                    <i class="fas fa-box"></i>
                                </div>
                                <div>
                                    <div style="font-weight: 600; color: #111827;">{{ $product->name }}</div>
                                    @if($product->sku)
                                    <div style="font-size: 0.75rem; color: #6b7280;">SKU: {{ $product->sku }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td style="font-weight: 600; color: #111827;">
                            ${{ number_format($product->price, 2) }}
                        </td>
                        <td>
                            <span style="padding: 0.25rem 0.75rem; border-radius: 6px; background: {{ $product->stock > 10 ? '#d1fae5' : ($product->stock > 0 ? '#fef3c7' : '#fee2e2') }}; color: {{ $product->stock > 10 ? '#10b981' : ($product->stock > 0 ? '#d97706' : '#ef4444') }}; font-weight: 600;">
                                {{ number_format($product->stock) }}
                            </span>
                        </td>
                        <td>
                            @if($product->is_active)
                                <span style="background: #d1fae5; color: #10b981; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">
                                    <i class="fas fa-check-circle"></i> Active
                                </span>
                            @else
                                <span style="background: #fee2e2; color: #ef4444; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">
                                    <i class="fas fa-times-circle"></i> Inactive
                                </span>
                            @endif
                        </td>
                        <td>
                            {{ $product->created_at->format('M d, Y') }}<br>
                            <small style="color: #6b7280;">{{ $product->created_at->diffForHumans() }}</small>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($stats['total_products'] > 5)
        <div style="text-align: center; margin-top: 1rem;">
            <a href="" class="btn btn-secondary" style="padding: 0.5rem 1rem;">
                View All Products
            </a>
        </div>
        @endif
    </div>
    @else
    <div class="info-card">
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-box-open"></i>
            </div>
            <h3 style="color: #6b7280; margin-bottom: 0.5rem;">No Products Found</h3>
            <p style="color: #9ca3af;">This seller hasn't added any products yet.</p>
        </div>
    </div>
    @endif
    
    <!-- Recent Orders -->
    @if($recentOrders->count() > 0)
    <div class="table-container">
        <h3 class="card-title">
            <i class="fas fa-shopping-cart"></i> Recent Orders
        </h3>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentOrders as $order)
                    <tr>
                        <td style="font-weight: 600; color: #111827;">
                            #{{ $order->order_id ?? $order->id }}
                        </td>
                        <td>
                            @if($order->placed_at)
                                {{ \Carbon\Carbon::parse($order->placed_at)->format('M d, Y') }}
                            @elseif($order->created_at)
                                {{ $order->created_at->format('M d, Y') }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if($order->customer)
                                {{ $order->customer->name ?? 'N/A' }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td style="font-weight: 600; color: #111827;">
                            ${{ number_format($order->total_amount, 2) }}
                        </td>
                        <td>
                            @php
                                $status = strtolower($order->order_status ?? 'pending');
                            @endphp
                            
                            @if($status == 'pending')
                                <span style="background: #fef3c7; color: #d97706; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">
                                    <i class="fas fa-clock"></i> Pending
                                </span>
                            @elseif($status == 'processing')
                                <span style="background: #dbeafe; color: #3b82f6; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">
                                    <i class="fas fa-cog"></i> Processing
                                </span>
                            @elseif($status == 'completed')
                                <span style="background: #d1fae5; color: #10b981; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">
                                    <i class="fas fa-check-circle"></i> Completed
                                </span>
                            @elseif($status == 'cancelled')
                                <span style="background: #fee2e2; color: #ef4444; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">
                                    <i class="fas fa-times-circle"></i> Cancelled
                                </span>
                            @else
                                <span style="background: #f3f4f6; color: #6b7280; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">
                                    {{ ucfirst($status) }}
                                </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($stats['total_orders'] > 5)
        <div style="text-align: center; margin-top: 1rem;">
            <a href="{{ route('admin.orders.index') }}?seller={{ $seller->id }}" class="btn btn-secondary" style="padding: 0.5rem 1rem;">
                View All Orders
            </a>
        </div>
        @endif
    </div>
    @elseif($stats['total_orders'] == 0)
    <div class="info-card">
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <h3 style="color: #6b7280; margin-bottom: 0.5rem;">No Orders Found</h3>
            <p style="color: #9ca3af;">This seller hasn't received any orders yet.</p>
        </div>
    </div>
    @endif
    
    <!-- Quick Actions -->
    <div class="info-card" style="background: #f8fafc; border: 2px solid #e5e7eb;">
        <h3 class="card-title" style="color: #dc2626;">
            <i class="fas fa-bolt"></i> Quick Actions
        </h3>
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            @if($seller->status == 'pending')
                <a href="{{ route('admin.sellers.update-status', [$seller, 'approved']) }}" 
                   class="btn" style="background: #10b981; color: white;"
                   onclick="return confirm('Approve this seller?')">
                    <i class="fas fa-check"></i> Approve Seller
                </a>
                <a href="{{ route('admin.sellers.update-status', [$seller, 'rejected']) }}" 
                   class="btn" style="background: #ef4444; color: white;"
                   onclick="return confirm('Reject this seller?')">
                    <i class="fas fa-times"></i> Reject Seller
                </a>
            @elseif($seller->status == 'approved')
                <a href="{{ route('admin.sellers.update-status', [$seller, 'rejected']) }}" 
                   class="btn" style="background: #ef4444; color: white;"
                   onclick="return confirm('Reject this seller?')">
                    <i class="fas fa-times"></i> Reject Seller
                </a>
                <a href="{{ route('admin.sellers.update-status', [$seller, 'pending']) }}" 
                   class="btn" style="background: #f59e0b; color: white;"
                   onclick="return confirm('Set seller to pending?')">
                    <i class="fas fa-clock"></i> Set Pending
                </a>
            @else
                <a href="{{ route('admin.sellers.update-status', [$seller, 'approved']) }}" 
                   class="btn" style="background: #10b981; color: white;"
                   onclick="return confirm('Approve this seller?')">
                    <i class="fas fa-check"></i> Approve Seller
                </a>
                <a href="{{ route('admin.sellers.update-status', [$seller, 'pending']) }}" 
                   class="btn" style="background: #f59e0b; color: white;"
                   onclick="return confirm('Set seller to pending?')">
                    <i class="fas fa-clock"></i> Set Pending
                </a>
            @endif
            
            @if($seller->is_verified)
                <a href="{{ route('admin.sellers.toggle-verification', $seller) }}" 
                   class="btn" style="background: #6b7280; color: white;"
                   onclick="return confirm('Unverify this seller?')">
                    <i class="fas fa-times-circle"></i> Unverify Seller
                </a>
            @else
                <a href="{{ route('admin.sellers.toggle-verification', $seller) }}" 
                   class="btn" style="background: #3b82f6; color: white;"
                   onclick="return confirm('Verify this seller?')">
                    <i class="fas fa-shield-alt"></i> Verify Seller
                </a>
            @endif
            
            <!-- Password Reset Form -->
            <form action="{{ route('admin.sellers.update-password', $seller) }}" method="POST" style="display: inline;">
                @csrf
                @method('PUT')
                <button type="button" onclick="showPasswordResetModal()" class="btn" style="background: #8b5cf6; color: white;">
                    <i class="fas fa-key"></i> Reset Password
                </button>
            </form>
            
            <!-- Delete Form -->
            <form action="{{ route('admin.sellers.destroy', $seller) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" 
                        onclick="return confirm('Are you sure you want to delete this seller? This action cannot be undone.')">
                    <i class="fas fa-trash"></i> Delete Seller
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Password Reset Modal -->
<div id="passwordResetModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
    <div style="background: white; border-radius: 12px; padding: 2rem; width: 90%; max-width: 400px;">
        <h3 style="margin: 0 0 1rem 0; color: #111827;">Reset Password</h3>
        <p style="color: #6b7280; margin-bottom: 1.5rem;">Set a new password for {{ $seller->name }}</p>
        
        <form action="{{ route('admin.sellers.update-password', $seller) }}" method="POST">
            @csrf
            @method('PUT')
            <div style="margin-bottom: 1rem;">
                <label style="display: block; margin-bottom: 0.5rem; color: #374151; font-weight: 500;">New Password</label>
                <input type="password" name="password" required 
                       style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;"
                       placeholder="Enter new password">
                @error('password')
                    <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>
            
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; color: #374151; font-weight: 500;">Confirm Password</label>
                <input type="password" name="password_confirmation" required 
                       style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px;"
                       placeholder="Confirm new password">
            </div>
            
            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn" style="background: #10b981; color: white; flex: 1;">
                    Update Password
                </button>
                <button type="button" onclick="hidePasswordResetModal()" class="btn" style="background: #6b7280; color: white; flex: 1;">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function showPasswordResetModal() {
        document.getElementById('passwordResetModal').style.display = 'flex';
    }
    
    function hidePasswordResetModal() {
        document.getElementById('passwordResetModal').style.display = 'none';
    }
    
    // Close modal when clicking outside
    document.getElementById('passwordResetModal').addEventListener('click', function(e) {
        if (e.target === this) {
            hidePasswordResetModal();
        }
    });
    
    // Handle form success messages
    @if(session('success'))
        alert('{{ session('success') }}');
    @endif
    
    @if(session('error'))
        alert('{{ session('error') }}');
    @endif
</script>

@if(session('success'))
<script>
    // Show success toast notification
    const successMessage = '{{ session('success') }}';
    if (successMessage) {
        showNotification(successMessage, 'success');
    }
    
    function showNotification(message, type) {
        // Create notification element
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
        `;
        
        if (type === 'success') {
            notification.style.background = 'linear-gradient(135deg, #10b981 0%, #047857 100%)';
        } else if (type === 'error') {
            notification.style.background = 'linear-gradient(135deg, #ef4444 0%, #b91c1c 100%)';
        }
        
        notification.textContent = message;
        document.body.appendChild(notification);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
</script>
@endif
@endsection