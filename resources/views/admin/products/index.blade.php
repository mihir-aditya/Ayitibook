@extends('admin.layouts.basic')

@section('title', 'Products Management')
@section('page-title', 'Products Management')

@section('content')
<style>
    .products-container {
        max-width: 1400px;
        margin: 0 auto;
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
    
    .form-select, .form-input {
        padding: 0.5rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 0.875rem;
        color: #374151;
        background: white;
        transition: all 0.2s ease;
    }
    
    .form-select:focus, .form-input:focus {
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
    
    .btn-success {
        background: linear-gradient(135deg, #10b981 0%, #047857 100%);
        color: white;
    }
    
    .btn-success:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%);
        color: white;
    }
    
    .btn-danger:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
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
    }
    
    .stat-card:hover {
        transform: translateY(-2px);
    }
    
    .stat-card.blue {
        border-left-color: #3b82f6;
    }
    
    .stat-card.green {
        border-left-color: #10b981;
    }
    
    .stat-card.red {
        border-left-color: #ef4444;
    }
    
    .stat-card.orange {
        border-left-color: #f59e0b;
    }
    
    .stat-card.purple {
        border-left-color: #8b5cf6;
    }
    
    .stat-card.indigo {
        border-left-color: #6366f1;
    }
    
    .stat-card.teal {
        border-left-color: #14b8a6;
    }
    
    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }
    
    .stat-label {
        font-size: 0.75rem;
        color: #6b7280;
        margin-top: 0.25rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
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
    
    .product-image {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        object-fit: cover;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9ca3af;
        font-size: 1.25rem;
    }
    
    .product-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .product-details {
        display: flex;
        flex-direction: column;
    }
    
    .product-name {
        font-weight: 600;
        color: #111827;
        margin-bottom: 0.25rem;
    }
    
    .product-sku {
        font-size: 0.75rem;
        color: #6b7280;
    }
    
    .product-seller {
        font-size: 0.75rem;
        color: #3b82f6;
        font-weight: 500;
    }
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
    }
    
    .status-active {
        background: #d1fae5;
        color: #10b981;
    }
    
    .status-inactive {
        background: #f3f4f6;
        color: #6b7280;
    }
    
    .stock-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.25rem 0.75rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 500;
    }
    
    .stock-in {
        background: #d1fae5;
        color: #10b981;
    }
    
    .stock-low {
        background: #fef3c7;
        color: #d97706;
    }
    
    .stock-out {
        background: #fee2e2;
        color: #ef4444;
    }
    
    .flash-badge {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 500;
    }
    
    .price-display {
        font-weight: 600;
        color: #111827;
    }
    
    .discount-price {
        color: #ef4444;
        text-decoration: line-through;
        font-size: 0.875rem;
        margin-left: 0.25rem;
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
    
    .action-btn.delete:hover {
        background: #fee2e2;
        color: #ef4444;
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
    }
</style>

<div class="products-container">
    <!-- Statistics -->
    <div class="stats-grid">
        <div class="stat-card blue">
            <div class="stat-value">{{ number_format($stats['total']) }}</div>
            <div class="stat-label">Total Products</div>
        </div>
        
        <div class="stat-card green">
            <div class="stat-value">{{ number_format($stats['active']) }}</div>
            <div class="stat-label">Active</div>
        </div>
        
        <div class="stat-card red">
            <div class="stat-value">{{ number_format($stats['out_of_stock']) }}</div>
            <div class="stat-label">Out of Stock</div>
        </div>
        
        <div class="stat-card orange">
            <div class="stat-value">{{ number_format($stats['low_stock']) }}</div>
            <div class="stat-label">Low Stock</div>
        </div>
        
        <div class="stat-card purple">
            <div class="stat-value">{{ number_format($stats['flash_sale']) }}</div>
            <div class="stat-label">Flash Sale</div>
        </div>
        
        <div class="stat-card indigo">
            <div class="stat-value">{{ number_format($stats['today']) }}</div>
            <div class="stat-label">Today</div>
        </div>
        
        <div class="stat-card teal">
            <div class="stat-value">{{ number_format($stats['week']) }}</div>
            <div class="stat-label">This Week</div>
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
        
        <form method="GET" action="{{ route('admin.products.index') }}" class="filter-form" id="filterForm">
            <div class="form-group">
                <label class="form-label">Search</label>
                <input type="text" name="search" class="form-input" 
                       placeholder="Search by name, SKU, seller..." 
                       value="{{ request('search') }}">
            </div>
            
            <div class="form-group">
                <label class="form-label">Seller</label>
                <select name="seller" class="form-select">
                    <option value="all">All Sellers</option>
                    @foreach($sellers as $seller)
                        <option value="{{ $seller->id }}" {{ request('seller') == $seller->id ? 'selected' : '' }}>
                            {{ $seller->shop_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">Category</label>
                <select name="category" class="form-select">
                    <option value="all">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">Brand</label>
                <select name="brand" class="form-select">
                    <option value="all">All Brands</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="all">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="out_of_stock" {{ request('status') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                    <option value="low_stock" {{ request('status') == 'low_stock' ? 'selected' : '' }}>Low Stock</option>
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">Flash Sale</label>
                <select name="flash_sale" class="form-select">
                    <option value="all">All</option>
                    <option value="yes" {{ request('flash_sale') == 'yes' ? 'selected' : '' }}>Flash Sale Only</option>
                    <option value="no" {{ request('flash_sale') == 'no' ? 'selected' : '' }}>Exclude Flash Sale</option>
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">Price From</label>
                <input type="number" name="price_from" class="form-input" 
                       placeholder="Min price" step="0.01"
                       value="{{ request('price_from') }}">
            </div>
            
            <div class="form-group">
                <label class="form-label">Price To</label>
                <input type="number" name="price_to" class="form-input" 
                       placeholder="Max price" step="0.01"
                       value="{{ request('price_to') }}">
            </div>
            
            <div class="form-group">
                <label class="form-label">Stock From</label>
                <input type="number" name="stock_from" class="form-input" 
                       placeholder="Min stock"
                       value="{{ request('stock_from') }}">
            </div>
            
            <div class="form-group">
                <label class="form-label">Stock To</label>
                <input type="number" name="stock_to" class="form-input" 
                       placeholder="Max stock"
                       value="{{ request('stock_to') }}">
            </div>
            
            <div class="form-group">
                <label class="form-label">Date From</label>
                <input type="date" name="date_from" class="form-input" 
                       value="{{ request('date_from') }}">
            </div>
            
            <div class="form-group">
                <label class="form-label">Date To</label>
                <input type="date" name="date_to" class="form-input" 
                       value="{{ request('date_to') }}">
            </div>
            
            <div class="form-group">
                <label class="form-label">Sort By</label>
                <select name="sort_by" class="form-select">
                    <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Created Date</option>
                    <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>Price</option>
                    <option value="stock_quantity" {{ request('sort_by') == 'stock_quantity' ? 'selected' : '' }}>Stock</option>
                    <option value="seller" {{ request('sort_by') == 'seller' ? 'selected' : '' }}>Seller</option>
                    <option value="category" {{ request('sort_by') == 'category' ? 'selected' : '' }}>Category</option>
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
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Clear Filters
                </a>
            </div>
        </form>
    </div>
    
    <!-- Bulk Actions (manager+ only) -->
@if(auth()->guard('admin')->user()->hasRole('manager'))
    <div class="bulk-actions" id="bulkActions" style="display: none;">
        <span id="selectedCount">0 products selected</span>
        <div style="display: flex; gap: 0.5rem;">
            <select id="bulkActionSelect" class="form-select" style="width: auto;">
                <option value="">Choose Action</option>
                <option value="activate">Activate</option>
                <option value="deactivate">Deactivate</option>
                <option value="flash_sale_enable">Enable Flash Sale</option>
                <option value="flash_sale_disable">Disable Flash Sale</option>
                <option value="delete">Delete</option>
            </select>
            <button type="button" class="btn btn-primary" onclick="applyBulkAction()">
                Apply
            </button>
            <button type="button" class="btn btn-secondary" onclick="clearSelection()">
                Clear
            </button>
        </div>
    </div>
@endif
    
    <!-- Products Table -->
    <div class="table-container">
        <div class="table-header">
            <h3 class="table-title">
                <i class="fas fa-boxes"></i> Products List
            </h3>
            <div class="table-actions">
@if(auth()->guard('admin')->user()->hasRole('manager'))
                <a href="{{ route('admin.products.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Add Product
                </a>
                <a href="{{ route('admin.products.export') }}?type=csv" class="btn btn-secondary">
                    <i class="fas fa-download"></i> Export CSV
                </a>
@endif
            </div>
        </div>
        
        @if($products->count() > 0)
@if(auth()->guard('admin')->user()->hasRole('manager'))
            <div class="select-all-container">
                <input type="checkbox" id="selectAll" class="bulk-select" onchange="toggleSelectAll()">
                <label for="selectAll" style="font-size: 0.875rem; color: #374151;">
                    Select all {{ $products->total() }} products
                </label>
            </div>
@endif
            
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            @if(auth()->guard('admin')->user()->hasRole('manager'))
                            <th style="width: 40px;">
                                <input type="checkbox" id="selectAllVisible" class="bulk-select" onchange="toggleSelectAllVisible()">
                            </th>
                            @endif
                            <th>Product</th>
                            <th>Seller</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            @if(auth()->guard('admin')->user()->hasRole('manager'))
                            <td>
                                <input type="checkbox" class="product-select bulk-select" 
                                       value="{{ $product->id }}" onchange="updateSelection()">
                            </td>
                            @endif
                            <td>
                                <div class="product-info">
                                    <div class="product-image">
                                        @if($product->thumbnail)
                                            <img src="{{ Storage::url($product->thumbnail) }}" 
                                                 alt="{{ $product->name }}"
                                                 style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                                        @else
                                            <i class="fas fa-box"></i>
                                        @endif
                                    </div>
                                    <div class="product-details">
                                        <div class="product-name">
                                            {{ $product->name }}
                                            @if($product->is_flash_sale)
                                                <span class="flash-badge" style="margin-left: 0.5rem;">
                                                    <i class="fas fa-bolt"></i> Flash
                                                </span>
                                            @endif
                                        </div>
                                        <div class="product-sku">
                                            SKU: {{ $product->sku ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="product-seller">
                                    {{ $product->seller->shop_name ?? 'N/A' }}
                                </div>
                            </td>
                            <td>
                                {{ $product->category->name ?? 'N/A' }}
                            </td>
                            <td>
                                <div class="price-display">
                                    {{ $product->currency }} {{ number_format($product->price, 2) }}
                                    @if($product->discount_price)
                                        <span class="discount-price">
                                            {{ $product->currency }} {{ number_format($product->discount_price, 2) }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if($product->stock_quantity <= 0)
                                    <span class="stock-badge stock-out">
                                        <i class="fas fa-times-circle"></i> Out of Stock
                                    </span>
                                @elseif($product->stock_quantity <= $product->low_stock_quantity)
                                    <span class="stock-badge stock-low">
                                        <i class="fas fa-exclamation-triangle"></i> {{ $product->stock_quantity }}
                                    </span>
                                @else
                                    <span class="stock-badge stock-in">
                                        <i class="fas fa-check-circle"></i> {{ $product->stock_quantity }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($product->is_active)
                                    <span class="status-badge status-active">
                                        <i class="fas fa-check-circle"></i> Active
                                    </span>
                                @else
                                    <span class="status-badge status-inactive">
                                        <i class="fas fa-times-circle"></i> Inactive
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    {{-- View: all roles --}}
                                    <a href="{{ route('admin.products.show', $product) }}" 
                                       class="action-btn view" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    {{-- Edit, Toggle, Flash: manager+ --}}
                                    @if(auth()->guard('admin')->user()->hasRole('manager'))
                                    <a href="{{ route('admin.products.edit', $product) }}" 
                                       class="action-btn edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.products.toggle-status', $product) }}" 
                                          method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="action-btn" title="{{ $product->is_active ? 'Deactivate' : 'Activate' }}">
                                            <i class="fas fa-power-off"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.products.toggle-flash-sale', $product) }}" 
                                          method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="action-btn" title="{{ $product->is_flash_sale ? 'Remove from Flash Sale' : 'Add to Flash Sale' }}">
                                            <i class="fas fa-bolt"></i>
                                        </button>
                                    </form>
                                    @endif
                                    {{-- Delete: admin only --}}
                                    @if(auth()->guard('admin')->user()->isAdmin())
                                    <form action="{{ route('admin.products.destroy', $product) }}" 
                                          method="POST" style="display: inline;"
                                          onsubmit="return confirm('Are you sure you want to delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="pagination-container">
                <div class="pagination-info">
                    Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} entries
                </div>
                <div class="pagination">
                    {{ $products->withQueryString()->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-box-open"></i>
                </div>
                <h3 style="color: #6b7280; margin-bottom: 0.5rem;">No Products Found</h3>
                <p style="color: #9ca3af;">Try adjusting your filters or add a new product.</p>
@if(auth()->guard('admin')->user()->hasRole('manager'))
                <a href="{{ route('admin.products.create') }}" class="btn btn-success" style="margin-top: 1rem;">
                    <i class="fas fa-plus"></i> Add New Product
                </a>
@endif
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
    let selectedProducts = [];
    
    function toggleSelectAll() {
        const checkboxes = document.querySelectorAll('.product-select');
        const selectAll = document.getElementById('selectAll');
        
        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAll.checked;
            if (selectAll.checked) {
                if (!selectedProducts.includes(parseInt(checkbox.value))) {
                    selectedProducts.push(parseInt(checkbox.value));
                }
            } else {
                selectedProducts = selectedProducts.filter(id => id !== parseInt(checkbox.value));
            }
        });
        
        updateSelection();
    }
    
    function toggleSelectAllVisible() {
        const checkboxes = document.querySelectorAll('.product-select');
        const selectAllVisible = document.getElementById('selectAllVisible');
        
        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAllVisible.checked;
            if (selectAllVisible.checked) {
                if (!selectedProducts.includes(parseInt(checkbox.value))) {
                    selectedProducts.push(parseInt(checkbox.value));
                }
            } else {
                selectedProducts = selectedProducts.filter(id => id !== parseInt(checkbox.value));
            }
        });
        
        updateSelection();
    }
    
    function updateSelection() {
        selectedProducts = [];
        const checkboxes = document.querySelectorAll('.product-select:checked');
        
        checkboxes.forEach(checkbox => {
            selectedProducts.push(parseInt(checkbox.value));
        });
        
        const bulkActions = document.getElementById('bulkActions');
        const selectedCount = document.getElementById('selectedCount');
        
        if (selectedProducts.length > 0) {
            bulkActions.style.display = 'flex';
            selectedCount.textContent = `${selectedProducts.length} products selected`;
        } else {
            bulkActions.style.display = 'none';
        }
        
        // Update select all checkboxes
        const totalVisible = document.querySelectorAll('.product-select').length;
        const selectedVisible = checkboxes.length;
        
        document.getElementById('selectAllVisible').checked = selectedVisible === totalVisible && totalVisible > 0;
        document.getElementById('selectAll').checked = false; // Clear the "select all X products" checkbox
    }
    
    function clearSelection() {
        const checkboxes = document.querySelectorAll('.product-select');
        checkboxes.forEach(checkbox => checkbox.checked = false);
        selectedProducts = [];
        updateSelection();
    }
    
    function applyBulkAction() {
        const action = document.getElementById('bulkActionSelect').value;
        
        if (!action) {
            alert('Please select an action');
            return;
        }
        
        if (selectedProducts.length === 0) {
            alert('Please select at least one product');
            return;
        }
        
        if (action === 'delete' && !confirm(`Are you sure you want to delete ${selectedProducts.length} products? This action cannot be undone.`)) {
            return;
        }
        
        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("admin.products.bulk-action") }}';
        
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
        
        selectedProducts.forEach(productId => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'product_ids[]';
            input.value = productId;
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
    });
</script>

@if(session('success'))
<script>
    showNotification('{{ session('success') }}', 'success');
</script>
@endif

@if(session('error'))
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