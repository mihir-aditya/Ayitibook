@extends('admin.layouts.basic')

@section('title', 'Product Details: ' . $product->name)
@section('page-title', 'Product Details: ' . $product->name)

@section('content')
    <style>
        .product-details-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .product-header {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
            border: 1px solid #e5e7eb;
        }

        .header-content {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .product-image-large {
            width: 300px;
            height: 300px;
            border-radius: 12px;
            overflow: hidden;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .product-image-large img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-image-large i {
            font-size: 4rem;
            color: #9ca3af;
        }

        .product-info-main {
            flex: 1;
            min-width: 300px;
        }

        .product-name {
            font-size: 1.75rem;
            font-weight: 700;
            color: #111827;
            margin: 0 0 0.5rem 0;
        }

        .product-sku {
            color: #6b7280;
            margin: 0 0 1rem 0;
            font-size: 0.875rem;
        }

        .product-price {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1rem 0;
        }

        .current-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: #111827;
        }

        .original-price {
            font-size: 1.125rem;
            color: #ef4444;
            text-decoration: line-through;
        }

        .product-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin: 1rem 0;
        }

        .meta-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.875rem;
        }

        .meta-badge.seller {
            background: #dbeafe;
            color: #3b82f6;
        }

        .meta-badge.category {
            background: #f3e8ff;
            color: #8b5cf6;
        }

        .meta-badge.brand {
            background: #fef3c7;
            color: #d97706;
        }

        .meta-badge.stock {
            background: #d1fae5;
            color: #10b981;
        }

        .meta-badge.stock-low {
            background: #fef3c7;
            color: #d97706;
        }

        .meta-badge.stock-out {
            background: #fee2e2;
            color: #ef4444;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .status-active {
            background: #d1fae5;
            color: #10b981;
        }

        .status-inactive {
            background: #f3f4f6;
            color: #6b7280;
        }

        .flash-badge {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
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
        }

        .stat-card.green {
            border-left-color: #10b981;
        }

        .stat-card.orange {
            border-left-color: #f59e0b;
        }

        .stat-card.purple {
            border-left-color: #8b5cf6;
        }

        .stat-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: #6b7280;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #111827;
            margin: 0;
        }

        .stat-label {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 0.25rem;
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
            font-weight: 500;
        }

        .info-value {
            font-weight: 600;
            color: #111827;
        }

        .info-value.text {
            font-weight: normal;
            line-height: 1.6;
        }

        .image-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .gallery-image {
            width: 120px;
            height: 120px;
            border-radius: 8px;
            overflow: hidden;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .gallery-image:hover {
            transform: scale(1.05);
        }

        .gallery-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .gallery-image i {
            font-size: 2rem;
            color: #9ca3af;
        }

        .video-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .gallery-video {
            width: 200px;
            height: 150px;
            border-radius: 8px;
            overflow: hidden;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.3s ease;
            position: relative;
        }

        .gallery-video:hover {
            transform: scale(1.05);
        }

        .gallery-video video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .gallery-video i {
            font-size: 2rem;
            color: #9ca3af;
        }

        .play-button {
            position: absolute;
            background: rgba(0, 0, 0, 0.7);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .variants-container {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
            border: 1px solid #e5e7eb;
        }

        .variants-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .variants-table th {
            padding: 0.75rem 1rem;
            text-align: left;
            font-weight: 600;
            color: #374151;
            border-bottom: 2px solid #e5e7eb;
            background: #f9fafb;
        }

        .variants-table td {
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
            color: #4b5563;
            vertical-align: middle;
        }

        .variants-table tr:hover td {
            background: #f9fafb;
        }

        .variant-image {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .variant-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .empty-state {
            padding: 3rem 1rem;
            text-align: center;
            color: #9ca3af;
        }

        .empty-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #e5e7ab;
        }

        .action-buttons {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
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
            font-size: 0.875rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #047857 100%);
            color: white;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%);
            color: white;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
        }

        .stock-update-form {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            margin-top: 0.5rem;
        }

        .stock-input {
            padding: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            width: 100px;
        }

        .stock-select {
            padding: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            background: white;
        }

        .stock-btn {
            padding: 0.5rem 1rem;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.875rem;
        }

        .stock-btn:hover {
            background: #2563eb;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            max-width: 90%;
            max-height: 90%;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            position: relative;
        }

        .modal-content img,
        .modal-content video {
            width: 100%;
            height: auto;
            max-height: 80vh;
            object-fit: contain;
        }

        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .similar-products {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .similar-product {
            background: white;
            border-radius: 8px;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            transition: transform 0.3s ease;
        }

        .similar-product:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .similar-product-image {
            width: 100%;
            height: 150px;
            border-radius: 6px;
            background: #f3f4f6;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .similar-product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .similar-product-name {
            font-weight: 600;
            color: #111827;
            margin-bottom: 0.25rem;
            font-size: 0.875rem;
        }

        .similar-product-price {
            font-weight: 700;
            color: #3b82f6;
            font-size: 1rem;
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
            }

            .product-image-large {
                width: 100%;
                max-width: 300px;
                margin: 0 auto;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .image-gallery {
                grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            }

            .gallery-image {
                width: 100px;
                height: 100px;
            }

            .video-gallery {
                grid-template-columns: 1fr;
            }

            .gallery-video {
                width: 100%;
            }
        }
    </style>

    <div class="product-details-container">
        <!-- Product Header -->
        <div class="product-header">
            <div class="header-content">
                <div class="product-image-large">
                    @if ($product->thumbnail)
                        <img src="{{ Storage::url($product->thumbnail) }}" alt="{{ $product->name }}" id="mainImage">
                    @else
                        <i class="fas fa-box"></i>
                    @endif
                </div>

                <div class="product-info-main">
                    <h1 class="product-name">{{ $product->name }}</h1>
                    <p class="product-sku">SKU: {{ $product->sku ?? 'Not set' }}</p>

                    <div class="product-price">
                        <span class="current-price">
                            {{ $product->currency }} {{ number_format($product->price, 2) }}
                        </span>
                        @if ($product->discount_price)
                            <span class="original-price">
                                {{ $product->currency }} {{ number_format($product->discount_price, 2) }}
                            </span>
                        @endif
                    </div>

                    <div class="product-meta">
                        <span class="meta-badge seller">
                            <i class="fas fa-store"></i>
                            {{ $product->seller->shop_name ?? 'N/A' }}
                        </span>

                        <span class="meta-badge category">
                            <i class="fas fa-tag"></i>
                            {{ $product->category->name ?? 'N/A' }}
                        </span>

                        <span class="meta-badge brand">
                            <i class="fas fa-trademark"></i>
                            {{ $product->brand->name ?? 'N/A' }}
                        </span>

                        @if ($product->stock_quantity <= 0)
                            <span class="meta-badge stock-out">
                                <i class="fas fa-times-circle"></i>
                                Out of Stock
                            </span>
                        @elseif($product->stock_quantity <= $product->low_stock_quantity)
                            <span class="meta-badge stock-low">
                                <i class="fas fa-exclamation-triangle"></i>
                                Low Stock: {{ $product->stock_quantity }}
                            </span>
                        @else
                            <span class="meta-badge stock">
                                <i class="fas fa-check-circle"></i>
                                In Stock: {{ $product->stock_quantity }}
                            </span>
                        @endif
                    </div>

                    <div style="display: flex; gap: 1rem; margin: 1rem 0;">
                        @if ($product->is_active)
                            <span class="status-badge status-active">
                                <i class="fas fa-check-circle"></i> Active
                            </span>
                        @else
                            <span class="status-badge status-inactive">
                                <i class="fas fa-times-circle"></i> Inactive
                            </span>
                        @endif

                        @if ($product->is_flash_sale)
                            <span class="flash-badge">
                                <i class="fas fa-bolt"></i> Flash Sale
                            </span>
                        @endif
                    </div>

                    <div class="action-buttons">
                        {{-- Edit, Toggle status, Flash sale: manager+ --}}
                        @if(auth()->guard('admin')->user()->hasRole('manager'))
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit Product
                        </a>

                        <form action="{{ route('admin.products.toggle-status', $product) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-secondary">
                                <i class="fas fa-power-off"></i>
                                {{ $product->is_active ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>

                        <form action="{{ route('admin.products.toggle-flash-sale', $product) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-secondary">
                                <i class="fas fa-bolt"></i>
                                {{ $product->is_flash_sale ? 'Remove from Flash Sale' : 'Add to Flash Sale' }}
                            </button>
                        </form>
                        @endif

                        {{-- Back: all roles --}}
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>

                        {{-- Delete: admin only --}}
                        @if(auth()->guard('admin')->user()->isAdmin())
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this product?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-card blue">
                <div class="stat-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="stat-value">{{ number_format($stats['total_sales']) }}</div>
                <div class="stat-label">Total Sales</div>
            </div>

            <div class="stat-card green">
                <div class="stat-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="stat-value">{{ $product->currency }} {{ number_format($stats['total_revenue'], 2) }}</div>
                <div class="stat-label">Total Revenue</div>
            </div>

            <div class="stat-card orange">
                <div class="stat-icon">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div class="stat-value">{{ number_format($stats['variant_count']) }}</div>
                <div class="stat-label">Variants</div>
            </div>

            <div class="stat-card purple">
                <div class="stat-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-value">{{ number_format($product->reviews->count()) }}</div>
                <div class="stat-label">Total Reviews</div>
            </div>

            <div class="stat-card purple">
                <div class="stat-icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="stat-value">{{ number_format($stats['total_stock']) }}</div>
                <div class="stat-label">Total Stock</div>
            </div>
        </div>

        <!-- Product Details -->
        <div class="info-card">
            <h3 class="card-title">
                <i class="fas fa-info-circle"></i> Product Details
            </h3>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Product ID</span>
                    <span class="info-value">{{ $product->id }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">Slug</span>
                    <span class="info-value">{{ $product->slug }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">Currency</span>
                    <span class="info-value">{{ $product->currency }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">Discount Type</span>
                    <span
                        class="info-value">{{ $product->discount_type ? ucfirst($product->discount_type) : 'None' }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">Maximum Purchase Quantity</span>
                    <span class="info-value">{{ $product->maximum_purchase_quantity ?: 'Unlimited' }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">Low Stock Threshold</span>
                    <span class="info-value">{{ $product->low_stock_quantity }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">Can Purchase?</span>
                    <span class="info-value">
                        @if ($product->can_purchase)
                            <span style="color: #10b981;">Yes</span>
                        @else
                            <span style="color: #ef4444;">No</span>
                        @endif
                    </span>
                </div>

                <div class="info-item">
                    <span class="info-label">Show When Out of Stock?</span>
                    <span class="info-value">
                        @if ($product->show_stock_out)
                            <span style="color: #10b981;">Yes</span>
                        @else
                            <span style="color: #ef4444;">No</span>
                        @endif
                    </span>
                </div>


                <div class="info-item">
                    <span class="info-label">Refundable?</span>
                    <span class="info-value">
                        @if ($product->refundable)
                            <span style="color: #10b981;">Yes</span>
                        @else
                            <span style="color: #ef4444;">No</span>
                        @endif
                    </span>
                </div>

                <div class="info-item">
                    <span class="info-label">Created At</span>
                    <span class="info-value">{{ $product->created_at->format('F d, Y H:i') }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">Updated At</span>
                    <span class="info-value">{{ $product->updated_at->format('F d, Y H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- Stock Management -->
        <div class="info-card">
            <h3 class="card-title">
                <i class="fas fa-boxes"></i> Stock Management
            </h3>
            <div style="display: flex; align-items: center; gap: 2rem; flex-wrap: wrap;">
                <div>
                    <div style="font-size: 0.875rem; color: #6b7280; margin-bottom: 0.25rem;">
                        Current Stock
                    </div>
                    <div style="font-size: 2rem; font-weight: 700; color: #111827;">
                        {{ $product->stock_quantity }}
                    </div>
                </div>

@if(auth()->guard('admin')->user()->hasRole('manager'))
                <form action="{{ route('admin.products.update-stock', $product) }}" method="POST"
                    class="stock-update-form">
                    @csrf
                    @method('PUT')
                    <input type="number" name="stock_quantity" class="stock-input" placeholder="Quantity"
                        min="0" required>
                    <select name="type" class="stock-select" required>
                        <option value="set">Set to</option>
                        <option value="add">Add</option>
                        <option value="subtract">Subtract</option>
                    </select>
                    <button type="submit" class="stock-btn">Update Stock</button>
                </form>
@endif
            </div>
        </div>

        <!-- Product Description -->
        @if ($product->description)
            <div class="info-card">
                <h3 class="card-title">
                    <i class="fas fa-align-left"></i> Description
                </h3>
                <div class="info-item">
                    <div class="info-value text">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>
            </div>
        @endif

        <!-- Product Images -->
        @php
            $images = $product->images
                ? (is_array($product->images) ? $product->images : json_decode($product->images, true))
                : [];
            $videos = $product->videos
                ? (is_array($product->videos) ? $product->videos : json_decode($product->videos, true))
                : [];
        @endphp

        @if (!empty($images))
            <div class="info-card">
                <h3 class="card-title">
                    <i class="fas fa-images"></i> Product Images
                </h3>
                <div class="image-gallery">
                    @foreach ($images as $image)
                        <div class="gallery-image" onclick="openModal('{{ Storage::url($image) }}', 'image')">
                            <img src="{{ Storage::url($image) }}" alt="Product Image {{ $loop->iteration }}">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Product Videos -->
        @if (!empty($videos))
            <div class="info-card">
                <h3 class="card-title">
                    <i class="fas fa-video"></i> Product Videos
                </h3>
                <div class="video-gallery">
                    @foreach ($videos as $video)
                        <div class="gallery-video" onclick="openModal('{{ Storage::url($video) }}', 'video')">
                            <video>
                                <source src="{{ Storage::url($video) }}" type="video/mp4">
                            </video>
                            <div class="play-button">
                                <i class="fas fa-play"></i>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Product Variants -->
        @if ($product->variants->count() > 0)
            <div class="variants-container">
                <h3 class="card-title">
                    <i class="fas fa-layer-group"></i> Product Variants
                    <span style="font-size: 0.875rem; color: #6b7280; margin-left: 0.5rem;">
                        ({{ $product->variants->count() }} variants)
                    </span>
                </h3>

                <div class="table-responsive">
                    <table class="variants-table">
                        <thead>
                            <tr>
                                <th>Variant</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Images</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->variants as $variant)
                                <tr>
                                    <td>
                                        <div style="font-weight: 600; color: #111827;">
                                            {{ $variant->variant_name }}
                                        </div>
                                    </td>
                                    <td>
                                        <div style="color: #6b7280; font-size: 0.875rem;">
                                            {{ $variant->sku ?? 'N/A' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 600; color: #111827;">
                                            {{ $product->currency }} {{ number_format($variant->price, 2) }}
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            style="padding: 0.25rem 0.75rem; border-radius: 6px; background: {{ $variant->quantity > 0 ? '#d1fae5' : '#fee2e2' }}; color: {{ $variant->quantity > 0 ? '#10b981' : '#ef4444' }}; font-weight: 600;">
                                            {{ $variant->quantity }}
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            // Safely get variant images
                                            $variantImages = $variant->images; // This will be an array
                                        @endphp

                                        @if (is_array($variantImages) && count($variantImages) > 0)
                                            <div style="display: flex; gap: 0.5rem;">
                                                @foreach (array_slice($variantImages, 0, 3) as $image)
                                                    @if (is_string($image) && !empty($image))
                                                        <div class="variant-image">
                                                            <img src="{{ Storage::url($image) }}" alt="Variant Image"
                                                                onclick="openModal('{{ Storage::url($image) }}', 'image')"
                                                                style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                                                        </div>
                                                    @endif
                                                @endforeach
                                                @if (count($variantImages) > 3)
                                                    <div class="variant-image"
                                                        style="background: #3b82f6; color: white; font-weight: 600; display: flex; align-items: center; justify-content: center;">
                                                        +{{ count($variantImages) - 3 }}
                                                    </div>
                                                @endif
                                            </div>
                                        @else
                                            <span style="color: #9ca3af; font-size: 0.875rem;">No images</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        <!-- Product Sizes -->
        @if ($product->sizes->count() > 0)
            <div class="info-card">
                <h3 class="card-title">
                    <i class="fas fa-ruler"></i> Available Sizes
                </h3>
                <div style="display: flex; flex-wrap: wrap; gap: 0.75rem;">
                    @foreach ($product->sizes as $size)
                        <span
                            style="padding: 0.5rem 1rem; background: #f3f4f6; border-radius: 8px; font-size: 0.875rem; font-weight: 500;">
                            {{ $size->size }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif
        <!-- Product Dimensions -->
        @if ($product->weight || $product->length || $product->width || $product->height)
            <div class="info-card">
                <h3 class="card-title">
                    <i class="fas fa-ruler-combined"></i> Dimensions & Weight
                </h3>
                <div class="info-grid">
                    @if ($product->weight)
                        <div class="info-item">
                            <span class="info-label">Weight</span>
                            <span class="info-value">{{ $product->weight }} kg</span>
                        </div>
                    @endif

                    @if ($product->length)
                        <div class="info-item">
                            <span class="info-label">Length</span>
                            <span class="info-value">{{ $product->length }} cm</span>
                        </div>
                    @endif

                    @if ($product->width)
                        <div class="info-item">
                            <span class="info-label">Width</span>
                            <span class="info-value">{{ $product->width }} cm</span>
                        </div>
                    @endif

                    @if ($product->height)
                        <div class="info-item">
                            <span class="info-label">Height</span>
                            <span class="info-value">{{ $product->height }} cm</span>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- SEO Information -->
        @if ($product->meta_title || $product->meta_keywords || $product->meta_description)
            <div class="info-card">
                <h3 class="card-title">
                    <i class="fas fa-search"></i> SEO Information
                </h3>
                <div class="info-grid">
                    @if ($product->meta_title)
                        <div class="info-item">
                            <span class="info-label">Meta Title</span>
                            <span class="info-value">{{ $product->meta_title }}</span>
                        </div>
                    @endif

                    @if ($product->meta_keywords)
                        <div class="info-item">
                            <span class="info-label">Meta Keywords</span>
                            <span class="info-value">{{ $product->meta_keywords }}</span>
                        </div>
                    @endif

                    @if ($product->meta_description)
                        <div class="info-item" style="grid-column: span 2;">
                            <span class="info-label">Meta Description</span>
                            <div class="info-value text">
                                {{ $product->meta_description }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Product Reviews -->
        @if ($product->reviews->count() > 0)
            <div class="info-card">
                <h3 class="card-title">
                    <i class="fas fa-star"></i> Customer Reviews
                    <span style="font-size: 0.875rem; color: #6b7280; margin-left: 0.5rem;">
                        ({{ $product->reviews->count() }} reviews, average {{ $product->averageRating() }}/5)
                    </span>
                </h3>

                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    @foreach ($product->reviews as $review)
                        <div style="border-bottom: 1px solid #e5e7eb; padding-bottom: 1rem;">
                            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.75rem;">
                                <div style="font-weight: 600; color: #111827;">
                                    {{ $review->user->name ?? 'Anonymous' }}
                                </div>
                                <div style="color: #f59e0b;">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $review->rating)
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <div style="font-size: 0.75rem; color: #9ca3af;">
                                    {{ $review->created_at->format('M d, Y') }}
                                </div>
                            </div>

                            @if ($review->body)
                                <div style="color: #4b5563; line-height: 1.6; margin-bottom: 0.75rem;">
                                    {{ $review->body }}
                                </div>
                            @endif

                            @if ($review->images && count($review->images) > 0)
                                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                    @foreach ($review->images as $image)
                                        @if (is_string($image) && !empty($image))
                                            <div class="gallery-image" style="width: 80px; height: 80px; cursor: pointer;"
                                                onclick="openModal('{{ Storage::url($image) }}', 'image')">
                                                <img src="{{ Storage::url($image) }}" alt="Review image"
                                                    style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Similar Products -->
        @if ($similarProducts->count() > 0)
            <div class="info-card">
                <h3 class="card-title">
                    <i class="fas fa-th-large"></i> Similar Products
                </h3>
                <div class="similar-products">
                    @foreach ($similarProducts as $similar)
                        <a href="{{ route('admin.products.show', $similar) }}" class="similar-product">
                            <div class="similar-product-image">
                                @if ($similar->thumbnail)
                                    <img src="{{ Storage::url($similar->thumbnail) }}" alt="{{ $similar->name }}">
                                @else
                                    <i class="fas fa-box"></i>
                                @endif
                            </div>
                            <div class="similar-product-name">{{ $similar->name }}</div>
                            <div class="similar-product-price">
                                {{ $similar->currency }} {{ number_format($similar->price, 2) }}
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Modal for images/videos -->
    <div id="mediaModal" class="modal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal()">
                <i class="fas fa-times"></i>
            </button>
            <div id="modalContent"></div>
        </div>
    </div>

    <script>
        function openModal(src, type) {
            const modal = document.getElementById('mediaModal');
            const modalContent = document.getElementById('modalContent');

            if (type === 'image') {
                modalContent.innerHTML = `<img src="${src}" alt="Product Media">`;
            } else if (type === 'video') {
                modalContent.innerHTML = `
                <video controls autoplay style="width: 100%; max-height: 80vh;">
                    <source src="${src}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            `;
            }

            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('mediaModal');
            const modalContent = document.getElementById('modalContent');

            // Stop video playback
            const video = modalContent.querySelector('video');
            if (video) {
                video.pause();
                video.currentTime = 0;
            }

            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        document.getElementById('mediaModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Update main image when clicking on gallery images
        const galleryImages = document.querySelectorAll('.gallery-image');
        const mainImage = document.getElementById('mainImage');

        galleryImages.forEach(img => {
            img.addEventListener('click', function() {
                const newSrc = this.querySelector('img').src;
                if (mainImage) {
                    mainImage.src = newSrc;
                }
            });
        });
    </script>

    @if (session('success'))
        <script>
            showNotification('{{ session('success') }}', 'success');
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