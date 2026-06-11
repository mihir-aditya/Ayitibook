<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - Seller Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --success-color: #198754;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --border-radius: 0.375rem;
            --box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            --transition: all 0.3s ease;
        }

        body {
            background-color: #f5f7fb;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 2rem 0;
            margin: -1.5rem -1.5rem 2rem -1.5rem;
            border-radius: 0 0 1rem 1rem;
        }

        .page-title {
            color: white;
            font-weight: 600;
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
        }

        .breadcrumb {
            background: rgba(255, 255, 255, 0.1);
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 0;
        }

        .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: var(--transition);
        }

        .breadcrumb-item a:hover {
            color: white;
        }

        .breadcrumb-item.active {
            color: white;
            font-weight: 500;
        }

        /* Cards */
        .card {
            border: 1px solid #e9ecef;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            margin-bottom: 1.5rem;
        }

        .card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .card-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-bottom: 1px solid #e9ecef;
            padding: 1rem 1.5rem;
            font-weight: 600;
        }

        .card-title {
            margin: 0;
            font-size: 1.1rem;
            color: var(--dark-color);
        }

        .card-header i {
            color: var(--primary-color);
            font-size: 1.25rem;
        }

        /* Form Controls */
        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .form-control,
        .form-select {
            border: 2px solid #e9ecef;
            border-radius: var(--border-radius);
            padding: 0.75rem 1rem;
            transition: var(--transition);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
        }

        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: var(--danger-color);
        }

        .input-group-text {
            background-color: #f8f9fa;
            border: 2px solid #e9ecef;
            color: #6c757d;
            font-weight: 500;
        }

        /* Description Editor */
        .description-editor {
            position: relative;
        }

        .editor-toolbar {
            background: #f8f9fa;
            padding: 0.75rem 1rem;
            border-radius: 0 var(--border-radius) var(--border-radius) 0;
            border-left: 3px solid var(--primary-color);
            margin-top: 0.5rem;
        }

        /* Upload Areas */
        .upload-box {
            border: 2px dashed #dee2e6;
            border-radius: var(--border-radius);
            padding: 2rem;
            text-align: center;
            transition: var(--transition);
            cursor: pointer;
            background: var(--light-color);
        }

        .upload-box:hover {
            border-color: var(--primary-color);
            background: rgba(13, 110, 253, 0.05);
        }

        .upload-box.is-invalid {
            border-color: var(--danger-color);
            background: rgba(220, 53, 69, 0.05);
        }

        .upload-box i {
            transition: var(--transition);
        }

        .upload-box:hover i {
            color: var(--primary-color);
        }

        .gallery-item {
            position: relative;
            transition: var(--transition);
        }

        .gallery-item:hover {
            transform: scale(1.05);
        }

        .gallery-item img {
            width: 100%;
            height: 100px;
            object-fit: cover;
        }

        .btn-remove-image {
            width: 24px;
            height: 24px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.8;
            transition: var(--transition);
        }

        .btn-remove-image:hover {
            opacity: 1;
            transform: scale(1.1);
        }

        /* Product Status Switches */
        .list-group-item {
            border: none;
            padding: 1rem 0;
            background: transparent;
        }

        .form-check-input:checked {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
        }

        /* Preview Images */
        #thumbnailPreview img,
        #galleryPreview img {
            max-height: 150px;
            object-fit: contain;
            border-radius: var(--border-radius);
            border: 2px solid #e9ecef;
        }

        /* Variant Styles */
        .variant-card {
            border: 2px dashed #dee2e6;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: var(--transition);
            background: var(--light-color);
        }

        .variant-card:hover {
            border-color: var(--primary-color);
            background: rgba(13, 110, 253, 0.05);
        }

        .variant-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #dee2e6;
        }

        .variant-actions {
            display: flex;
            gap: 0.5rem;
        }

        .add-variant-btn {
            width: 100%;
            padding: 1.5rem;
            border: 2px dashed #dee2e6;
            border-radius: var(--border-radius);
            background: transparent;
            color: var(--secondary-color);
            transition: var(--transition);
            cursor: pointer;
        }

        .add-variant-btn:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
            background: rgba(13, 110, 253, 0.05);
        }

        .image-preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .image-preview {
            position: relative;
            width: 80px;
            height: 80px;
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: var(--border-radius);
            border: 1px solid #dee2e6;
        }

        .remove-image {
            position: absolute;
            top: -8px;
            right: -8px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--danger-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 12px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .page-header {
                margin: -1rem -1rem 1.5rem -1rem;
                padding: 1.5rem 0;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .card {
                margin-bottom: 1rem;
            }

            .upload-box {
                padding: 1.5rem;
            }

            .gallery-item img {
                height: 80px;
            }

            .variant-card {
                padding: 1rem;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeIn 0.5s ease-out;
        }

        /* Form Text */
        .form-text {
            font-size: 0.875rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0b5ed7 100%);
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: var(--transition);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.4);
        }

        .btn-outline-primary:hover {
            transform: translateY(-1px);
        }

        /* Alert */
        .alert {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: var(--box-shadow);
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da 0%, #f1aeb5 100%);
            color: #721c24;
        }

        /* List Group for Status */
        .list-group-item small {
            font-size: 0.875rem;
        }

        /* Container adjustments */
        .container-fluid {
            padding: 2rem;
        }

        @media (max-width: 768px) {
            .container-fluid {
                padding: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="page-title">Edit Product</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('seller.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('seller.products.index') }}">Products</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('seller.products.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to List
                    </a>
                    <button type="submit" form="productForm" class="btn btn-primary">
                        <i class="bi bi-check-circle me-2"></i>Update Product
                    </button>
                </div>
            </div>
        </div>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <strong>Please fix the following errors:</strong>
                </div>
                <ul class="mt-2 mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('seller.products.update', $product->id) }}" enctype="multipart/form-data"
            id="productForm" class="product-edit-form">
            @csrf
            @method('PUT')

            <div class="row">
                <!-- Left Column -->
                <div class="col-lg-8">
                    <!-- Basic Information Card -->
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center">
                            <i class="bi bi-info-circle me-2"></i>
                            <h5 class="card-title mb-0">Basic Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label for="productName" class="form-label">
                                        Product Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="productName" name="name" value="{{ old('name', $product->name) }}"
                                        placeholder="e.g., Wireless Bluetooth Headphones" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="sku" class="form-label">
                                        SKU <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('sku') is-invalid @enderror"
                                        id="sku" name="sku" value="{{ old('sku', $product->sku) }}"
                                        placeholder="PROD-001" required>
                                    @error('sku')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="description" class="form-label">Description</label>
                                    <div class="description-editor">
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                            rows="4" placeholder="Describe your product in detail...">{{ old('description', $product->description) }}</textarea>
                                        <div class="editor-toolbar">
                                            <small class="text-muted">Use clear and detailed descriptions to attract
                                                customers</small>
                                        </div>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Variants Card -->
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center">
                            <i class="bi bi-layers me-2"></i>
                            <h5 class="card-title mb-0">Product Variants</h5>
                        </div>
                        <div class="card-body">
                            <div id="variants-container">
                                @php
                                    $variants = $product->variants ?? [];
                                    $variantIndex = 0;
                                @endphp

                                @forelse($variants as $variant)
                                    <div class="variant-card" data-index="{{ $variantIndex }}">
                                        <input type="hidden" name="variants[{{ $variantIndex }}][id]"
                                            value="{{ $variant->id }}">
                                        <div class="variant-header">
                                            <h6 class="mb-0">Variant #{{ $loop->iteration }}</h6>
                                            <div class="variant-actions">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-danger remove-variant">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Variant Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    name="variants[{{ $variantIndex }}][variant_name]"
                                                    value="{{ old('variants.' . $variantIndex . '.variant_name', $variant->variant_name) }}"
                                                    placeholder="e.g., Blue, Large" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">SKU <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    name="variants[{{ $variantIndex }}][sku]"
                                                    value="{{ old('variants.' . $variantIndex . '.sku', $variant->sku) }}"
                                                    placeholder="VAR-001" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Price <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span
                                                        class="input-group-text">{{ $product->currency === 'INR' ? '₹' : ($product->currency === 'EUR' ? '€' : '$') }}</span>
                                                    <input type="number" class="form-control"
                                                        name="variants[{{ $variantIndex }}][price]" step="0.01"
                                                        value="{{ old('variants.' . $variantIndex . '.price', $variant->price) }}"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Stock Quantity <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" class="form-control"
                                                    name="variants[{{ $variantIndex }}][quantity]"
                                                    value="{{ old('variants.' . $variantIndex . '.quantity', $variant->quantity) }}"
                                                    required>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Images</label>
                                                <input type="file" class="form-control variant-images"
                                                    name="variants[{{ $variantIndex }}][images][]" multiple
                                                    accept="image/*">
                                                <div class="image-preview-container mt-2">
                                                    @if ($variant->images)
                                                        @php
                                                            $variantImages = is_array($variant->images)
                                                                ? $variant->images
                                                                : json_decode($variant->images, true);
                                                        @endphp
                                                        @foreach ($variantImages as $image)
                                                            <div class="image-preview">
                                                                <img src="{{ asset('storage/' . $image) }}"
                                                                    alt="Variant Image">
                                                                <div class="remove-image"
                                                                    onclick="removeVariantImage(this, '{{ $image }}', {{ $variantIndex }})">
                                                                    <i class="bi bi-x"></i>
                                                                </div>
                                                                <input type="hidden"
                                                                    name="variants[{{ $variantIndex }}][existing_images][]"
                                                                    value="{{ $image }}">
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php $variantIndex++; @endphp
                                @empty
                                    <div class="alert alert-info">
                                        <i class="bi bi-info-circle me-2"></i>
                                        No variants added yet. Click "Add New Variant" to create one.
                                    </div>
                                @endforelse
                            </div>

                            <button type="button" class="add-variant-btn" id="add-variant-btn">
                                <i class="bi bi-plus-circle me-2"></i>Add New Variant
                            </button>
                        </div>
                    </div>

                    <!-- Pricing & Inventory Card -->
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center">
                            <i class="bi bi-currency-dollar me-2"></i>
                            <h5 class="card-title mb-0">Pricing & Inventory</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label for="price" class="form-label">
                                        Base Price <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span
                                            class="input-group-text">{{ $product->currency === 'INR' ? '₹' : ($product->currency === 'EUR' ? '€' : '$') }}</span>
                                        <input type="number"
                                            class="form-control @error('price') is-invalid @enderror" id="price"
                                            name="price" step="0.01"
                                            value="{{ old('price', $product->price) }}" required>
                                    </div>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Will be auto-calculated from variants</small>
                                </div>
                                <div class="col-md-3">
                                    <label for="discountPrice" class="form-label">Discount Price</label>
                                    <div class="input-group">
                                        <span
                                            class="input-group-text">{{ $product->currency === 'INR' ? '₹' : ($product->currency === 'EUR' ? '€' : '$') }}</span>
                                        <input type="number"
                                            class="form-control @error('discount_price') is-invalid @enderror"
                                            id="discountPrice" name="discount_price" step="0.01"
                                            value="{{ old('discount_price', $product->discount_price) }}">
                                    </div>
                                    @error('discount_price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="discountType" class="form-label">Discount Type</label>
                                    <select class="form-select @error('discount_type') is-invalid @enderror"
                                        id="discountType" name="discount_type">
                                        <option value="">Select type</option>
                                        <option value="flat" @selected($product->discount_type === 'flat')>Flat Amount</option>
                                        <option value="percent" @selected($product->discount_type === 'percent')>Percentage</option>
                                    </select>
                                    @error('discount_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="currency" class="form-label">Currency</label>
                                    <select class="form-select @error('currency') is-invalid @enderror" id="currency"
                                        name="currency" required>
                                        <option value="INR" @selected($product->currency === 'INR')>INR (₹)</option>
                                        <option value="USD" @selected($product->currency === 'USD')>USD ($)</option>
                                        <option value="EUR" @selected($product->currency === 'EUR')>EUR (€)</option>
                                    </select>
                                    @error('currency')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="stockQuantity" class="form-label">Total Stock</label>
                                    <input type="number"
                                        class="form-control @error('stock_quantity') is-invalid @enderror"
                                        id="stockQuantity" name="stock_quantity"
                                        value="{{ old('stock_quantity', $product->stock_quantity) }}" readonly>
                                    @error('stock_quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Auto-calculated from variants</small>
                                </div>
                                <div class="col-md-4">
                                    <label for="lowStockAlert" class="form-label">Low Stock Alert</label>
                                    <input type="number"
                                        class="form-control @error('low_stock_quantity') is-invalid @enderror"
                                        id="lowStockAlert" name="low_stock_quantity"
                                        value="{{ old('low_stock_quantity', $product->low_stock_quantity) }}"
                                        placeholder="Default: 10">
                                    @error('low_stock_quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="maxPurchase" class="form-label">Max Purchase Quantity</label>
                                    <input type="number"
                                        class="form-control @error('maximum_purchase_quantity') is-invalid @enderror"
                                        id="maxPurchase" name="maximum_purchase_quantity"
                                        value="{{ old('maximum_purchase_quantity', $product->maximum_purchase_quantity) }}"
                                        placeholder="Default: 5">
                                    @error('maximum_purchase_quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="affiliatePercentage" class="form-label">Affiliate Percentage</label>
                                    <div class="input-group">
                                        <input type="number" step="0.01"
                                            class="form-control @error('affiliate_percentage') is-invalid @enderror"
                                            id="affiliatePercentage" name="affiliate_percentage"
                                            value="{{ old('affiliate_percentage', $product->affiliate_percentage ?? 0) }}"
                                            min="0" max="100" placeholder="0.00">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    @error('affiliate_percentage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Commission percentage for affiliates</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Media Card -->
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center">
                            <i class="bi bi-images me-2"></i>
                            <h5 class="card-title mb-0">Product Media</h5>
                        </div>
                        <div class="card-body">
                            <!-- Thumbnail -->
                            <div class="mb-4">
                                <label class="form-label">Product Thumbnail</label>
                                <div class="thumbnail-upload-area">
                                    @if ($product->thumbnail)
                                        <div class="current-thumbnail mb-3">
                                            <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                alt="Current thumbnail" class="img-thumbnail"
                                                style="max-height: 200px;">
                                            <div class="mt-2">
                                                <small class="text-muted">Current thumbnail</small>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="upload-box @error('thumbnail') is-invalid @enderror">
                                        <i class="bi bi-cloud-arrow-up display-4 text-muted"></i>
                                        <p class="mt-3 mb-1">Drag & drop thumbnail here or click to browse</p>
                                        <p class="text-muted small mb-3">Recommended: 800x800px, JPG or PNG (Max 2MB)
                                        </p>
                                        <input type="file" class="form-control d-none" id="thumbnailInput"
                                            name="thumbnail" accept="image/*">
                                        <button type="button" class="btn btn-outline-primary btn-sm"
                                            onclick="document.getElementById('thumbnailInput').click()">
                                            Choose File
                                        </button>
                                        <div id="thumbnailPreview" class="mt-3 d-none">
                                            <img src="" alt="Preview" class="img-thumbnail"
                                                style="max-height: 150px;">
                                        </div>
                                    </div>
                                    @error('thumbnail')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Gallery Images -->
                            <div class="mb-4">
                                <label class="form-label">Product Gallery</label>
                                <div class="gallery-upload-area">
                                    @php
                                        // Safely get images array
                                        $images = [];
                                        if ($product->images) {
                                            if (is_string($product->images)) {
                                                $decoded = json_decode($product->images, true);
                                                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                                    $images = $decoded;
                                                }
                                            } elseif (is_array($product->images)) {
                                                $images = $product->images;
                                            }
                                        }
                                    @endphp

                                    @if (!empty($images))
                                        <div class="current-gallery mb-3">
                                            <h6 class="text-muted mb-2">Current Images:</h6>
                                            <div class="row g-2">
                                                @foreach ($images as $index => $image)
                                                    <div class="col-3 col-md-2">
                                                        <div class="gallery-item position-relative">
                                                            <img src="{{ asset('storage/' . $image) }}"
                                                                alt="Gallery image {{ $index + 1 }}"
                                                                class="img-fluid rounded border">
                                                            <button type="button"
                                                                class="btn-remove-image btn btn-sm btn-danger position-absolute top-0 end-0 m-1"
                                                                data-image="{{ $image }}">
                                                                <i class="bi bi-x"></i>
                                                            </button>
                                                            <input type="hidden" name="existing_images[]"
                                                                value="{{ $image }}">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    <div class="upload-box @error('images') is-invalid @enderror">
                                        <i class="bi bi-cloud-arrow-up display-4 text-muted"></i>
                                        <p class="mt-3 mb-1">Drag & drop multiple images here or click to browse</p>
                                        <p class="text-muted small mb-3">Upload up to 10 images (Max 5MB each)</p>
                                        <input type="file" class="form-control d-none" id="galleryInput"
                                            name="images[]" multiple accept="image/*">
                                        <button type="button" class="btn btn-outline-primary btn-sm"
                                            onclick="document.getElementById('galleryInput').click()">
                                            Select Images
                                        </button>
                                        <div id="galleryPreview" class="row g-2 mt-3"></div>
                                    </div>
                                    @error('images')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- SEO Information Card -->
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center">
                            <i class="bi bi-search me-2"></i>
                            <h5 class="card-title mb-0">SEO Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="metaTitle" class="form-label">Meta Title</label>
                                    <input type="text"
                                        class="form-control @error('meta_title') is-invalid @enderror" id="metaTitle"
                                        name="meta_title" value="{{ old('meta_title', $product->meta_title) }}"
                                        placeholder="Optimized title for search engines (50-60 characters)">
                                    <div class="form-text">Recommended length: 50-60 characters</div>
                                    @error('meta_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="metaDescription" class="form-label">Meta Description</label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror" id="metaDescription"
                                        name="meta_description" rows="3">{{ old('meta_description', $product->meta_description) }}</textarea>
                                    <div class="form-text">Brief description for search results (150-160 characters)
                                    </div>
                                    @error('meta_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="metaKeywords" class="form-label">Meta Keywords</label>
                                    <input type="text"
                                        class="form-control @error('meta_keywords') is-invalid @enderror"
                                        id="metaKeywords" name="meta_keywords"
                                        value="{{ old('meta_keywords', $product->meta_keywords) }}"
                                        placeholder="keyword1, keyword2, keyword3">
                                    <div class="form-text">Separate keywords with commas</div>
                                    @error('meta_keywords')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-lg-4">
                    <!-- Category & Brand Card -->
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center">
                            <i class="bi bi-tag me-2"></i>
                            <h5 class="card-title mb-0">Category & Brand</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-select @error('category_id') is-invalid @enderror"
                                        id="category" name="category_id">
                                        <option value="">Select Category</option>
                                        @foreach ($categories ?? [] as $category)
                                            <option value="{{ $category->id }}" @selected($product->category_id == $category->id)>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="brand" class="form-label">Brand</label>
                                    <select class="form-select @error('brand_id') is-invalid @enderror"
                                        id="brand" name="brand_id">
                                        <option value="">Select Brand</option>
                                        @foreach ($brands ?? [] as $brand)
                                            <option value="{{ $brand->id }}" @selected($product->brand_id == $brand->id)>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Status Card -->
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center">
                            <i class="bi bi-toggle-on me-2"></i>
                            <h5 class="card-title mb-0">Product Status</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <label class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="bi bi-eye me-2"></i>
                                        <span>Product Visibility</span>
                                        <small class="d-block text-muted">Show/Hide product on store</small>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active"
                                            value="1" id="isActive" @checked($product->is_active)>
                                    </div>
                                </label>
                                <label class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="bi bi-cart-check me-2"></i>
                                        <span>Allow Purchases</span>
                                        <small class="d-block text-muted">Enable/Disable buying</small>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="can_purchase"
                                            value="1" id="canPurchase" @checked($product->can_purchase)>
                                    </div>
                                </label>
                                <label class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="bi bi-arrow-counterclockwise me-2"></i>
                                        <span>Refundable</span>
                                        <small class="d-block text-muted">Allow returns & refunds</small>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="refundable"
                                            value="1" id="refundable" @checked($product->refundable)>
                                    </div>
                                </label>
                                <label class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="bi bi-lightning me-2"></i>
                                        <span>Flash Sale</span>
                                        <small class="d-block text-muted">Feature in flash sales</small>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_flash_sale"
                                            value="1" id="flashSale" @checked($product->is_flash_sale)>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Dimensions & Weight Card -->
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center">
                            <i class="bi bi-rulers me-2"></i>
                            <h5 class="card-title mb-0">Dimensions & Weight</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="weight" class="form-label">Weight (kg)</label>
                                    <div class="input-group">
                                        <input type="number"
                                            class="form-control @error('weight') is-invalid @enderror" id="weight"
                                            name="weight" step="0.01"
                                            value="{{ old('weight', $product->weight) }}" placeholder="0.00">
                                        <span class="input-group-text">kg</span>
                                    </div>
                                    @error('weight')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="length" class="form-label">Length (cm)</label>
                                    <div class="input-group">
                                        <input type="number"
                                            class="form-control @error('length') is-invalid @enderror" id="length"
                                            name="length" step="0.01"
                                            value="{{ old('length', $product->length) }}" placeholder="0.00">
                                        <span class="input-group-text">cm</span>
                                    </div>
                                    @error('length')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="width" class="form-label">Width (cm)</label>
                                    <div class="input-group">
                                        <input type="number"
                                            class="form-control @error('width') is-invalid @enderror" id="width"
                                            name="width" step="0.01"
                                            value="{{ old('width', $product->width) }}" placeholder="0.00">
                                        <span class="input-group-text">cm</span>
                                    </div>
                                    @error('width')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="height" class="form-label">Height (cm)</label>
                                    <div class="input-group">
                                        <input type="number"
                                            class="form-control @error('height') is-invalid @enderror" id="height"
                                            name="height" step="0.01"
                                            value="{{ old('height', $product->height) }}" placeholder="0.00">
                                        <span class="input-group-text">cm</span>
                                    </div>
                                    @error('height')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Save Card -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-check-circle me-2"></i>Update Product
                                </button>
                                <a href="{{ route('seller.products.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-2"></i>Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hidden input for removed images -->
            <input type="hidden" name="removed_images" id="removed-images" value="[]">
            <input type="hidden" name="removed_variant_images" id="removed-variant-images" value="[]">
        </form>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Image preview functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Thumbnail preview
            const thumbnailInput = document.getElementById('thumbnailInput');
            const thumbnailPreview = document.getElementById('thumbnailPreview');

            if (thumbnailInput) {
                thumbnailInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            thumbnailPreview.innerHTML = `
                                <img src="${e.target.result}" alt="Thumbnail Preview" class="img-thumbnail">
                                <div class="mt-2">
                                    <small class="text-muted">New thumbnail preview</small>
                                </div>
                            `;
                            thumbnailPreview.classList.remove('d-none');
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Gallery preview
            const galleryInput = document.getElementById('galleryInput');
            const galleryPreview = document.getElementById('galleryPreview');

            if (galleryInput) {
                galleryInput.addEventListener('change', function(e) {
                    galleryPreview.innerHTML = '';

                    Array.from(e.target.files).forEach((file, index) => {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const col = document.createElement('div');
                            col.className = 'col-4 col-md-3';
                            col.innerHTML = `
                                <div class="gallery-item position-relative">
                                    <img src="${e.target.result}" alt="Gallery Preview ${index + 1}" class="img-fluid rounded border">
                                    <div class="position-absolute top-0 end-0 m-1">
                                        <span class="badge bg-primary">${index + 1}</span>
                                    </div>
                                </div>
                            `;
                            galleryPreview.appendChild(col);
                        }
                        reader.readAsDataURL(file);
                    });
                });
            }

            // Remove product image buttons
            document.querySelectorAll('.btn-remove-image').forEach(button => {
                button.addEventListener('click', function() {
                    const image = this.dataset.image;
                    if (confirm('Are you sure you want to remove this image?')) {
                        // Add to removed images list
                        const removedImagesInput = document.getElementById('removed-images');
                        let removedImages = JSON.parse(removedImagesInput.value);
                        removedImages.push(image);
                        removedImagesInput.value = JSON.stringify(removedImages);

                        // Remove the image from display
                        this.closest('.col-3').remove();
                    }
                });
            });

            // Character counters for SEO fields
            const metaTitle = document.getElementById('metaTitle');
            const metaDescription = document.getElementById('metaDescription');

            if (metaTitle) {
                // Initialize counter
                const initialLength = metaTitle.value.length;
                const titleFeedback = metaTitle.nextElementSibling;
                titleFeedback.textContent = `Characters: ${initialLength}/60`;

                metaTitle.addEventListener('input', function() {
                    const length = this.value.length;
                    const feedback = this.nextElementSibling;
                    feedback.textContent = `Characters: ${length}/60`;

                    if (length > 60) {
                        feedback.style.color = '#dc3545';
                    } else if (length > 50) {
                        feedback.style.color = '#ffc107';
                    } else {
                        feedback.style.color = '#198754';
                    }
                });
            }

            if (metaDescription) {
                // Initialize counter
                const initialLength = metaDescription.value.length;
                const descFeedback = metaDescription.nextElementSibling;
                descFeedback.textContent = `Characters: ${initialLength}/160`;

                metaDescription.addEventListener('input', function() {
                    const length = this.value.length;
                    const feedback = this.nextElementSibling;
                    feedback.textContent = `Characters: ${length}/160`;

                    if (length > 160) {
                        feedback.style.color = '#dc3545';
                    } else if (length > 150) {
                        feedback.style.color = '#ffc107';
                    } else {
                        feedback.style.color = '#198754';
                    }
                });
            }

            // Currency symbol update based on selection
            const currencySelect = document.getElementById('currency');

            if (currencySelect) {
                currencySelect.addEventListener('change', function() {
                    const currency = this.value;
                    let symbol = '$';

                    switch (currency) {
                        case 'INR':
                            symbol = '₹';
                            break;
                        case 'EUR':
                            symbol = '€';
                            break;
                        case 'USD':
                        default:
                            symbol = '$';
                    }

                    // Update currency symbols in all price inputs
                    document.querySelectorAll('.input-group-text').forEach(span => {
                        if (span.textContent === '₹' || span.textContent === '€' || span
                            .textContent === '$') {
                            span.textContent = symbol;
                        }
                    });
                });
            }
        });

        // Variant Management
        let variantIndex = {{ $variantIndex }};

        document.getElementById('add-variant-btn').addEventListener('click', function() {
            const container = document.getElementById('variants-container');

            // Remove info alert if present
            const alert = container.querySelector('.alert');
            if (alert) {
                alert.remove();
            }

            const newIndex = variantIndex++;
            const currencySymbol = document.querySelector('.input-group-text').textContent;

            const variantHtml = `
                <div class="variant-card" data-index="${newIndex}">
                    <div class="variant-header">
                        <h6 class="mb-0">New Variant</h6>
                        <div class="variant-actions">
                            <button type="button" class="btn btn-sm btn-outline-danger remove-variant">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Variant Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control variant-name" 
                                   name="variants[${newIndex}][variant_name]"
                                   placeholder="e.g., Blue, Large"
                                   required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">SKU <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control variant-sku" 
                                   name="variants[${newIndex}][sku]"
                                   placeholder="VAR-${String(newIndex + 1).padStart(3, '0')}"
                                   required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Price <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">${currencySymbol}</span>
                                <input type="number" 
                                       class="form-control variant-price" 
                                       name="variants[${newIndex}][price]"
                                       step="0.01"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Stock Quantity <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control variant-quantity" 
                                   name="variants[${newIndex}][quantity]"
                                   required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Images</label>
                            <input type="file" 
                                   class="form-control variant-images" 
                                   name="variants[${newIndex}][images][]"
                                   multiple
                                   accept="image/*">
                            <div class="image-preview-container mt-2"></div>
                        </div>
                    </div>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', variantHtml);
            attachVariantEvents(container.lastElementChild);
            updateProductTotals();
        });

        // Attach events to variant elements
        function attachVariantEvents(variantElement) {
            // Remove variant
            variantElement.querySelector('.remove-variant').addEventListener('click', function() {
                if (confirm('Are you sure you want to remove this variant?')) {
                    variantElement.remove();
                    renumberVariants();
                    updateProductTotals();
                }
            });

            // Image preview for variant images
            const imageInput = variantElement.querySelector('.variant-images');
            const previewContainer = variantElement.querySelector('.image-preview-container');

            if (imageInput) {
                imageInput.addEventListener('change', function(e) {
                    previewContainer.innerHTML = '';
                    Array.from(e.target.files).forEach((file, index) => {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const preview = document.createElement('div');
                            preview.className = 'image-preview';
                            preview.innerHTML = `
                                <img src="${e.target.result}" alt="Preview ${index + 1}">
                                <div class="remove-image" onclick="removeNewImage(this)">
                                    <i class="bi bi-x"></i>
                                </div>
                            `;
                            previewContainer.appendChild(preview);
                        };
                        reader.readAsDataURL(file);
                    });
                });
            }

            // Update totals when variant price/quantity changes
            variantElement.querySelectorAll('.variant-price, .variant-quantity').forEach(input => {
                input.addEventListener('input', updateProductTotals);
            });
        }

        // Remove variant image
        function removeVariantImage(element, imagePath, variantIndex) {
            if (confirm('Are you sure you want to remove this image?')) {
                // Add to removed variant images list
                const removedVariantImagesInput = document.getElementById('removed-variant-images');
                let removedVariantImages = JSON.parse(removedVariantImagesInput.value);
                removedVariantImages.push({
                    variant_index: variantIndex,
                    image: imagePath
                });
                removedVariantImagesInput.value = JSON.stringify(removedVariantImages);

                // Remove from display
                element.parentElement.remove();
            }
        }

        // Remove new image (not yet uploaded)
        function removeNewImage(element) {
            element.parentElement.remove();
        }

        // Renumber variants after removal
        function renumberVariants() {
            const variants = document.querySelectorAll('.variant-card');
            variants.forEach((variant, index) => {
                const header = variant.querySelector('h6');
                if (header && !variant.querySelector('[name*="[id]"]')?.value) {
                    header.textContent = `Variant #${index + 1}`;
                }

                // Update all input names
                variant.querySelectorAll('[name]').forEach(input => {
                    const name = input.getAttribute('name');
                    const newName = name.replace(/variants\[\d+\]/, `variants[${index}]`);
                    input.setAttribute('name', newName);
                });

                variant.setAttribute('data-index', index);
            });
            variantIndex = variants.length;
        }

        // Update product totals based on variants
        function updateProductTotals() {
            const variants = document.querySelectorAll('.variant-card');
            let minPrice = Infinity;
            let totalStock = 0;

            variants.forEach(variant => {
                const priceInput = variant.querySelector('.variant-price');
                const quantityInput = variant.querySelector('.variant-quantity');

                if (priceInput && priceInput.value) {
                    const price = parseFloat(priceInput.value);
                    if (price < minPrice) {
                        minPrice = price;
                    }
                }

                if (quantityInput && quantityInput.value) {
                    totalStock += parseInt(quantityInput.value) || 0;
                }
            });

            // Update product price and stock
            const priceInput = document.getElementById('price');
            const stockInput = document.getElementById('stockQuantity');

            if (minPrice !== Infinity) {
                priceInput.value = minPrice.toFixed(2);
            }

            stockInput.value = totalStock;
        }

        // Initialize events for existing variants
        document.querySelectorAll('.variant-card').forEach(variant => {
            attachVariantEvents(variant);
        });

        // Auto-generate SKU for new variants based on name
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('variant-name') && !e.target.closest('.variant-card').querySelector(
                    '[name*="[id]"]')?.value) {
                const variantCard = e.target.closest('.variant-card');
                const index = variantCard.getAttribute('data-index');
                const skuInput = variantCard.querySelector('.variant-sku');

                if (!skuInput.value || skuInput.value.startsWith('VAR-')) {
                    const variantName = e.target.value.trim().toUpperCase().replace(/\s+/g, '_');
                    const skuNumber = (parseInt(index) + 1).toString().padStart(3, '0');
                    skuInput.value = `VAR-${variantName || 'NEW'}-${skuNumber}`;
                }
            }
        });

        // Form validation before submit
        const form = document.getElementById('productForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                // Basic validation
                const productName = document.getElementById('productName').value.trim();
                const sku = document.getElementById('sku').value.trim();

                if (!productName || !sku) {
                    e.preventDefault();
                    alert('Please fill in all required fields (Product Name and SKU)');
                    return false;
                }

                // Variant validation
                const variants = document.querySelectorAll('.variant-card');
                let isValid = true;
                let errorMessage = '';

                variants.forEach((variant, index) => {
                    const name = variant.querySelector('[name*="variant_name"]').value.trim();
                    const variantSku = variant.querySelector('[name*="sku"]').value.trim();
                    const price = variant.querySelector('[name*="price"]').value;
                    const quantity = variant.querySelector('[name*="quantity"]').value;

                    if (!name || !variantSku || !price || !quantity) {
                        isValid = false;
                        errorMessage = `Variant #${index + 1} is missing required fields.`;
                    }

                    // Check for duplicate SKUs
                    const allSkus = Array.from(document.querySelectorAll('[name*="sku"]')).map(input =>
                        input.value.trim());
                    const duplicateSkus = allSkus.filter((sku, skuIndex) =>
                        sku && allSkus.indexOf(sku) !== skuIndex
                    );

                    if (duplicateSkus.length > 0) {
                        isValid = false;
                        errorMessage = 'Duplicate SKUs found. Each variant must have a unique SKU.';
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    alert(errorMessage);
                    return false;
                }

                // Additional validation for discount price
                const discountPrice = document.getElementById('discountPrice').value;
                const priceNum = parseFloat(document.getElementById('price').value);
                const discountNum = parseFloat(discountPrice);

                if (discountPrice && discountNum >= priceNum) {
                    e.preventDefault();
                    alert('Discount price must be less than the regular price');
                    return false;
                }

                return true;
            });
        }

        // Initialize product totals
        updateProductTotals();
    </script>
</body>

</html>
