@extends('admin.layouts.basic')

@section('title', 'Edit Product: ' . $product->name)
@section('page-title', 'Edit Product: ' . $product->name)

@section('content')
    <style>
        .edit-product-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .form-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
            border: 1px solid #e5e7eb;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #111827;
            margin: 0 0 1.5rem 0;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e5e7eb;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-label.required:after {
            content: " *";
            color: #ef4444;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.875rem;
            color: #374151;
            background: white;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-control.is-invalid {
            border-color: #ef4444;
        }

        .form-text {
            font-size: 0.75rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }

        .form-text.error {
            color: #ef4444;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .checkbox {
            width: 18px;
            height: 18px;
            border-radius: 4px;
            border: 2px solid #d1d5db;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .checkbox:checked {
            background: #3b82f6;
            border-color: #3b82f6;
        }

        .checkbox-label {
            font-size: 0.875rem;
            color: #374151;
            cursor: pointer;
        }

        .image-upload-area {
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            background: #f9fafb;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .image-upload-area:hover {
            border-color: #3b82f6;
            background: #eff6ff;
        }

        .image-upload-area.dragover {
            border-color: #3b82f6;
            background: #dbeafe;
        }

        .upload-icon {
            font-size: 2.5rem;
            color: #9ca3af;
            margin-bottom: 1rem;
        }

        .upload-text {
            color: #6b7280;
            margin-bottom: 0.5rem;
        }

        .upload-hint {
            font-size: 0.75rem;
            color: #9ca3af;
        }

        .image-preview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .image-preview {
            position: relative;
            width: 120px;
            height: 120px;
            border-radius: 8px;
            overflow: hidden;
            background: #f3f4f6;
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-remove {
            position: absolute;
            top: 0.25rem;
            right: 0.25rem;
            background: rgba(239, 68, 68, 0.9);
            color: white;
            border: none;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 0.75rem;
        }

        .variant-section {
            background: #f8fafc;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #e5e7eb;
        }

        .variant-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .variant-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #111827;
            margin: 0;
        }

        .variant-actions {
            display: flex;
            gap: 0.5rem;
        }

        .variant-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr auto;
            gap: 1rem;
            align-items: start;
            margin-bottom: 1rem;
            padding: 1rem;
            background: white;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
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

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.75rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
        }

        .tab-navigation {
            display: flex;
            border-bottom: 2px solid #e5e7eb;
            margin-bottom: 2rem;
            overflow-x: auto;
        }

        .tab-btn {
            padding: 1rem 1.5rem;
            background: none;
            border: none;
            font-weight: 500;
            color: #6b7280;
            cursor: pointer;
            white-space: nowrap;
            position: relative;
            transition: all 0.3s ease;
        }

        .tab-btn:hover {
            color: #374151;
        }

        .tab-btn.active {
            color: #3b82f6;
        }

        .tab-btn.active:after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background: #3b82f6;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .variants-container {
            margin-top: 1.5rem;
        }

        .no-variants {
            text-align: center;
            padding: 3rem 1rem;
            color: #9ca3af;
        }

        .no-variants-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #e5e7eb;
        }

        .thumbnail-preview {
            width: 150px;
            height: 150px;
            border-radius: 8px;
            overflow: hidden;
            background: #f3f4f6;
            margin-top: 0.5rem;
        }

        .thumbnail-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .thumbnail-remove {
            margin-top: 0.5rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.75rem;
            color: #ef4444;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .variant-row {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .tab-navigation {
                flex-wrap: nowrap;
                overflow-x: auto;
            }
        }
    </style>

    <div class="edit-product-container">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data"
            id="productForm">
            @csrf
            @method('PUT')

            <!-- Tab Navigation -->
            <div class="tab-navigation">
                <button type="button" class="tab-btn active" data-tab="basic">Basic Information</button>
                <button type="button" class="tab-btn" data-tab="images">Images & Media</button>
                <button type="button" class="tab-btn" data-tab="variants">Variants</button>
                <button type="button" class="tab-btn" data-tab="shipping">Shipping & Dimensions</button>
                <button type="button" class="tab-btn" data-tab="seo">SEO Settings</button>
                <button type="button" class="tab-btn" data-tab="sizes">Sizes</button>
            </div>

            <!-- Basic Information Tab -->
            <div class="tab-content active" id="basicTab">
                <div class="form-card">
                    <h3 class="form-title">
                        <i class="fas fa-info-circle"></i> Basic Information
                    </h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="name" class="form-label required">Product Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ old('name', $product->name) }}" required>
                            @error('name')
                                <div class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="sku" class="form-label">SKU</label>
                            <input type="text" id="sku" name="sku" class="form-control"
                                value="{{ old('sku', $product->sku) }}">
                            @error('sku')
                                <div class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="seller_id" class="form-label required">Seller</label>
                            <select id="seller_id" name="seller_id" class="form-control" required>
                                <option value="">Select Seller</option>
                                @foreach ($sellers as $seller)
                                    <option value="{{ $seller->id }}"
                                        {{ old('seller_id', $product->seller_id) == $seller->id ? 'selected' : '' }}>
                                        {{ $seller->shop_name }} ({{ $seller->name }})
                                    </option>
                                @endforeach
                            </select>
                            @error('seller_id')
                                <div class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="category_id" class="form-label required">Category</label>
                            <select id="category_id" name="category_id" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="brand_id" class="form-label required">Brand</label>
                            <select id="brand_id" name="brand_id" class="form-control" required>
                                <option value="">Select Brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <div class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label required">Description</label>
                        <textarea id="description" name="description" class="form-control" rows="6" required>{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div class="form-text error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="price" class="form-label required">Price</label>
                            <div style="display: flex; gap: 0.5rem;">
                                <select name="currency" class="form-control" style="width: 80px;">
                                    <option value="INR"
                                        {{ old('currency', $product->currency) == 'INR' ? 'selected' : '' }}>₹</option>
                                    <option value="USD"
                                        {{ old('currency', $product->currency) == 'USD' ? 'selected' : '' }}>$</option>
                                    <option value="EUR"
                                        {{ old('currency', $product->currency) == 'EUR' ? 'selected' : '' }}>€</option>
                                </select>
                                <input type="number" id="price" name="price" class="form-control" step="0.01"
                                    min="0" value="{{ old('price', $product->price) }}" required>
                            </div>
                            @error('price')
                                <div class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="discount_price" class="form-label">Discount Price</label>
                            <input type="number" id="discount_price" name="discount_price" class="form-control"
                                step="0.01" min="0"
                                value="{{ old('discount_price', $product->discount_price) }}">
                            @error('discount_price')
                                <div class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="discount_type" class="form-label">Discount Type</label>
                            <select id="discount_type" name="discount_type" class="form-control">
                                <option value="">Select Type</option>
                                <option value="flat"
                                    {{ old('discount_type', $product->discount_type) == 'flat' ? 'selected' : '' }}>Flat
                                    Amount</option>
                                <option value="percent"
                                    {{ old('discount_type', $product->discount_type) == 'percent' ? 'selected' : '' }}>
                                    Percentage</option>
                            </select>
                            @error('discount_type')
                                <div class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="affiliate_percentage" class="form-label">Affiliate Commission (%)</label>
                            <input type="number" id="affiliate_percentage" name="affiliate_percentage"
                                class="form-control" step="0.01" min="0" max="100"
                                value="{{ old('affiliate_percentage', $product->affiliate_percentage ?? 10) }}">
                            <div class="form-text">Commission paid to affiliates for each sale (0-100%)</div>
                            @error('affiliate_percentage')
                                <div class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="stock_quantity" class="form-label required">Stock Quantity</label>
                            <input type="number" id="stock_quantity" name="stock_quantity" class="form-control"
                                min="0" value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
                            @error('stock_quantity')
                                <div class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="low_stock_quantity" class="form-label required">Low Stock Alert</label>
                            <input type="number" id="low_stock_quantity" name="low_stock_quantity" class="form-control"
                                min="1" value="{{ old('low_stock_quantity', $product->low_stock_quantity) }}"
                                required>
                            <div class="form-text">Alert when stock reaches this level</div>
                            @error('low_stock_quantity')
                                <div class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="maximum_purchase_quantity" class="form-label">Max Purchase Quantity</label>
                            <input type="number" id="maximum_purchase_quantity" name="maximum_purchase_quantity"
                                class="form-control" min="0"
                                value="{{ old('maximum_purchase_quantity', $product->maximum_purchase_quantity) }}">
                            <div class="form-text">0 = Unlimited</div>
                            @error('maximum_purchase_quantity')
                                <div class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="checkbox-group">
                            <input type="checkbox" id="can_purchase" name="can_purchase" class="checkbox"
                                value="1" {{ old('can_purchase', $product->can_purchase) ? 'checked' : '' }}>
                            <label for="can_purchase" class="checkbox-label">Allow Purchase</label>
                        </div>

                        <div class="checkbox-group">
                            <input type="checkbox" id="show_stock_out" name="show_stock_out" class="checkbox"
                                value="1" {{ old('show_stock_out', $product->show_stock_out) ? 'checked' : '' }}>
                            <label for="show_stock_out" class="checkbox-label">Show When Out of Stock</label>
                        </div>

                        <div class="checkbox-group">
                            <input type="checkbox" id="refundable" name="refundable" class="checkbox" value="1"
                                {{ old('refundable', $product->refundable) ? 'checked' : '' }}>
                            <label for="refundable" class="checkbox-label">Refundable</label>
                        </div>

                        <div class="checkbox-group">
                            <input type="checkbox" id="is_flash_sale" name="is_flash_sale" class="checkbox"
                                value="1" {{ old('is_flash_sale', $product->is_flash_sale) ? 'checked' : '' }}>
                            <label for="is_flash_sale" class="checkbox-label">Flash Sale</label>
                        </div>

                        <div class="checkbox-group">
                            <input type="checkbox" id="is_active" name="is_active" class="checkbox" value="1"
                                {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                            <label for="is_active" class="checkbox-label">Active</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Images & Media Tab -->
            <div class="tab-content" id="imagesTab">
                <div class="form-card">
                    <h3 class="form-title">
                        <i class="fas fa-images"></i> Images & Media
                    </h3>

                    <!-- Thumbnail -->
                    <div class="form-group">
                        <label class="form-label">Thumbnail Image</label>
                        <input type="file" id="thumbnail" name="thumbnail" class="form-control" accept="image/*">

                        @if ($product->thumbnail)
                            <div class="thumbnail-preview">
                                <img src="{{ Storage::url($product->thumbnail) }}" alt="Thumbnail">
                            </div>
                            <div class="checkbox-group">
                                <input type="checkbox" id="remove_thumbnail" name="remove_thumbnail" class="checkbox"
                                    value="1">
                                <label for="remove_thumbnail" class="checkbox-label">Remove Thumbnail</label>
                            </div>
                        @endif
                        @error('thumbnail')
                            <div class="form-text error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Product Images -->
                    <div class="form-group">
                        <label class="form-label">Product Images</label>
                        <div class="image-upload-area" id="imageUploadArea">
                            <div class="upload-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="upload-text">
                                Drag & drop images here or click to browse
                            </div>
                            <div class="upload-hint">
                                Recommended: 800x800px, Max 2MB per image
                            </div>
                        </div>
                        <input type="file" id="images" name="images[]" multiple accept="image/*" class="d-none">

                        <!-- Existing Images -->
                        @php
                            $existingImages = $product->images ?? [];
                        @endphp

                        @if (is_array($existingImages) && count($existingImages) > 0)
                            <div class="image-preview-grid" id="existingImages">
                                @foreach ($existingImages as $index => $image)
                                    <div class="image-preview">
                                        <img src="{{ Storage::url($image) }}" alt="Product Image {{ $index + 1 }}">
                                        <button type="button" class="image-remove"
                                            onclick="removeExistingImage('{{ $image }}')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <input type="hidden" name="remove_images[]" id="remove_{{ $index }}"
                                            value="">
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- New Images Preview -->
                        <div class="image-preview-grid" id="newImagesPreview"></div>

                        @error('images')
                            <div class="form-text error">{{ $message }}</div>
                        @enderror
                        @error('images.*')
                            <div class="form-text error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Product Videos -->
                    <div class="form-group">
                        <label class="form-label">Product Videos</label>
                        <input type="file" id="videos" name="videos[]" multiple accept="video/*"
                            class="form-control">

                        <!-- Existing Videos -->
                        @php
                            $existingVideos = $product->videos ?? [];
                        @endphp

                        @if (is_array($existingVideos) && count($existingVideos) > 0)
                            <div style="margin-top: 1rem;">
                                <label class="form-label">Existing Videos:</label>
                                <div style="display: flex; flex-wrap: wrap; gap: 1rem; margin-top: 0.5rem;">
                                    @foreach ($existingVideos as $index => $video)
                                        <div
                                            style="background: #f3f4f6; padding: 0.75rem; border-radius: 6px; font-size: 0.875rem; display: flex; align-items: center; gap: 0.5rem;">
                                            <i class="fas fa-video"></i>
                                            <span>{{ basename($video) }}</span>
                                            <button type="button" onclick="removeExistingVideo('{{ $video }}')"
                                                style="background: none; border: none; color: #ef4444; cursor: pointer;">
                                                <i class="fas fa-times"></i>
                                            </button>
                                            <input type="hidden" name="remove_videos[]"
                                                id="remove_video_{{ $index }}" value="">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @error('videos')
                            <div class="form-text error">{{ $message }}</div>
                        @enderror
                        @error('videos.*')
                            <div class="form-text error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- Sizes Tab -->
            <div class="tab-content" id="sizesTab">
                <div class="form-card">
                    <h3 class="form-title">
                        <i class="fas fa-ruler"></i> Available Sizes
                    </h3>
                    <div id="sizesContainer">
                        @if ($product->sizes->count() > 0)
                            @foreach ($product->sizes as $index => $size)
                                <div class="size-row" style="display: flex; gap: 0.5rem; margin-bottom: 0.75rem;">
                                    <input type="text" name="sizes[]" class="form-control"
                                        value="{{ $size->size }}" placeholder="e.g., S, M, L, XL">
                                    <button type="button" class="btn btn-danger btn-sm delete-size-btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div id="newSizesContainer"></div>
                    <div style="text-align: center; margin-top: 1rem;">
                        <button type="button" class="btn btn-secondary" onclick="addSize()">
                            <i class="fas fa-plus"></i> Add Size
                        </button>
                    </div>
                </div>
            </div>
            <!-- Variants Tab -->
            <div class="tab-content" id="variantsTab">
                <div class="form-card">
                    <h3 class="form-title">
                        <i class="fas fa-layer-group"></i> Product Variants
                    </h3>

                    <div class="variants-container">
                        @if ($product->variants->count() > 0)
                            @foreach ($product->variants as $index => $variant)
                                @php
                                    $vImages = $variant->images
                                        ? (is_array($variant->images) ? $variant->images : json_decode($variant->images, true))
                                        : [];
                                    $vVideos = $variant->videos
                                        ? (is_array($variant->videos) ? $variant->videos : json_decode($variant->videos, true))
                                        : [];
                                @endphp
                                <div class="variant-row" data-variant-id="{{ $variant->id }}" style="display:block; padding:1.25rem; margin-bottom:1.5rem;">
                                    <input type="hidden" name="variants[{{ $index }}][id]"
                                        value="{{ $variant->id }}">

                                    <div class="form-row" style="margin-bottom:0;">
                                        <div>
                                            <label class="form-label">Variant Name</label>
                                            <input type="text" name="variants[{{ $index }}][variant_name]"
                                                class="form-control" value="{{ $variant->variant_name }}" required>
                                        </div>

                                        <div>
                                            <label class="form-label">SKU</label>
                                            <input type="text" name="variants[{{ $index }}][sku]"
                                                class="form-control" value="{{ $variant->sku }}">
                                        </div>

                                        <div>
                                            <label class="form-label">Price</label>
                                            <input type="number" name="variants[{{ $index }}][price]"
                                                class="form-control" step="0.01" min="0"
                                                value="{{ $variant->price }}">
                                        </div>

                                        <div>
                                            <label class="form-label">Quantity</label>
                                            <input type="number" name="variants[{{ $index }}][quantity]"
                                                class="form-control" min="0" value="{{ $variant->quantity }}">
                                        </div>

                                        <div style="display: flex; align-items: flex-end; gap: 0.5rem;">
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="removeVariant(this)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>

                                    {{-- Variant Images --}}
                                    <div style="margin-top:1rem;">
                                        <label class="form-label"><i class="fas fa-images"></i> Variant Images</label>
                                        @if (!empty($vImages))
                                            <div style="display:flex;flex-wrap:wrap;gap:0.75rem;margin-bottom:0.75rem;" class="variant-existing-images">
                                                @foreach ($vImages as $vImg)
                                                    <div class="image-preview" style="position:relative;width:90px;height:90px;border-radius:6px;overflow:hidden;background:#f3f4f6;">
                                                        <img src="{{ Storage::url($vImg) }}" style="width:100%;height:100%;object-fit:cover;">
                                                        <button type="button" class="image-remove"
                                                            onclick="markVariantImageRemoval(this, '{{ $vImg }}', {{ $index }})">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                        <input type="hidden" name="variants[{{ $index }}][remove_images][]"
                                                            id="vri_{{ $index }}_{{ $loop->index }}" value="" disabled>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                        <input type="file" name="variants[{{ $index }}][images][]"
                                            multiple accept="image/*" class="form-control" style="font-size:0.8rem;">
                                        <div class="form-text">Add new images for this variant (JPG, PNG, max 2MB each)</div>
                                    </div>

                                    {{-- Variant Videos --}}
                                    <div style="margin-top:1rem;">
                                        <label class="form-label"><i class="fas fa-video"></i> Variant Videos</label>
                                        @if (!empty($vVideos))
                                            <div style="display:flex;flex-wrap:wrap;gap:0.75rem;margin-bottom:0.75rem;">
                                                @foreach ($vVideos as $vVid)
                                                    <div style="background:#f3f4f6;padding:0.6rem 0.9rem;border-radius:6px;font-size:0.8rem;display:flex;align-items:center;gap:0.5rem;">
                                                        <i class="fas fa-file-video" style="color:#6b7280;"></i>
                                                        <span>{{ basename($vVid) }}</span>
                                                        <button type="button"
                                                            onclick="markVariantVideoRemoval(this, '{{ $vVid }}', {{ $index }})"
                                                            style="background:none;border:none;color:#ef4444;cursor:pointer;padding:0;">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                        <input type="hidden" name="variants[{{ $index }}][remove_videos][]"
                                                            id="vrv_{{ $index }}_{{ $loop->index }}" value="" disabled>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                        <input type="file" name="variants[{{ $index }}][videos][]"
                                            multiple accept="video/*" class="form-control" style="font-size:0.8rem;">
                                        <div class="form-text">Add new videos for this variant (MP4, MOV, max 5MB each)</div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="no-variants">
                                <div class="no-variants-icon">
                                    <i class="fas fa-box-open"></i>
                                </div>
                                <p>No variants added yet.</p>
                            </div>
                        @endif

                        <div id="newVariantsContainer"></div>

                        <div style="text-align: center; margin-top: 1.5rem;">
                            <button type="button" class="btn btn-secondary" onclick="addVariant()">
                                <i class="fas fa-plus"></i> Add Variant
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping & Dimensions Tab -->
            <div class="tab-content" id="shippingTab">
                <div class="form-card">
                    <h3 class="form-title">
                        <i class="fas fa-truck"></i> Shipping & Dimensions
                    </h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="weight" class="form-label">Weight (kg)</label>
                            <input type="number" id="weight" name="weight" class="form-control" step="0.01"
                                min="0" value="{{ old('weight', $product->weight) }}">
                            @error('weight')
                                <div class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="length" class="form-label">Length (cm)</label>
                            <input type="number" id="length" name="length" class="form-control" step="0.01"
                                min="0" value="{{ old('length', $product->length) }}">
                            @error('length')
                                <div class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="width" class="form-label">Width (cm)</label>
                            <input type="number" id="width" name="width" class="form-control" step="0.01"
                                min="0" value="{{ old('width', $product->width) }}">
                            @error('width')
                                <div class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="height" class="form-label">Height (cm)</label>
                            <input type="number" id="height" name="height" class="form-control" step="0.01"
                                min="0" value="{{ old('height', $product->height) }}">
                            @error('height')
                                <div class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO Settings Tab -->
            <div class="tab-content" id="seoTab">
                <div class="form-card">
                    <h3 class="form-title">
                        <i class="fas fa-search"></i> SEO Settings
                    </h3>

                    <div class="form-group">
                        <label for="meta_title" class="form-label">Meta Title</label>
                        <input type="text" id="meta_title" name="meta_title" class="form-control"
                            value="{{ old('meta_title', $product->meta_title) }}">
                        <div class="form-text">Recommended: 50-60 characters</div>
                        @error('meta_title')
                            <div class="form-text error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                        <input type="text" id="meta_keywords" name="meta_keywords" class="form-control"
                            value="{{ old('meta_keywords', $product->meta_keywords) }}">
                        <div class="form-text">Separate keywords with commas</div>
                        @error('meta_keywords')
                            <div class="form-text error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea id="meta_description" name="meta_description" class="form-control" rows="4">{{ old('meta_description', $product->meta_description) }}</textarea>
                        <div class="form-text">Recommended: 150-160 characters</div>
                        @error('meta_description')
                            <div class="form-text error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                {{-- Save: manager+ only (support cannot edit) --}}
                @if(auth()->guard('admin')->user()->hasRole('manager'))
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Product
                </button>
                @endif
                <a href="{{ route('admin.products.show', $product) }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </form>
    </div>

    <script>
        // Tab Navigation
        document.querySelectorAll('.tab-btn').forEach(button => {
            button.addEventListener('click', () => {
                const tabId = button.getAttribute('data-tab');

                // Update active tab button
                document.querySelectorAll('.tab-btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                button.classList.add('active');

                // Show active tab content
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.remove('active');
                });
                document.getElementById(tabId + 'Tab').classList.add('active');
            });
        });

        // Image Upload Handling
        const imageUploadArea = document.getElementById('imageUploadArea');
        const imageInput = document.getElementById('images');
        const newImagesPreview = document.getElementById('newImagesPreview');

        imageUploadArea.addEventListener('click', () => imageInput.click());

        imageUploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            imageUploadArea.classList.add('dragover');
        });

        imageUploadArea.addEventListener('dragleave', () => {
            imageUploadArea.classList.remove('dragover');
        });

        imageUploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            imageUploadArea.classList.remove('dragover');

            if (e.dataTransfer.files.length) {
                imageInput.files = e.dataTransfer.files;
                handleImageSelection();
            }
        });

        imageInput.addEventListener('change', handleImageSelection);

        function handleImageSelection() {
            newImagesPreview.innerHTML = '';
            const files = imageInput.files;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (!file.type.match('image.*')) continue;

                const reader = new FileReader();
                reader.onload = (e) => {
                    const div = document.createElement('div');
                    div.className = 'image-preview';
                    div.innerHTML = `
                    <img src="${e.target.result}" alt="New Image">
                    <button type="button" class="image-remove" onclick="removeNewImage(this)">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                    newImagesPreview.appendChild(div);
                };
                reader.readAsDataURL(file);
            }
        }

        function removeNewImage(button) {
            const previewDiv = button.closest('.image-preview');
            previewDiv.remove();
        }

        function removeExistingImage(imagePath) {
            const inputId = 'remove_' + imagePath.replace(/[^a-zA-Z0-9]/g, '_');
            const input = document.getElementById(inputId);
            if (input) {
                input.value = imagePath;
                const previewDiv = input.closest('.image-preview');
                previewDiv.style.opacity = '0.5';
                previewDiv.style.pointerEvents = 'none';
            }
        }

        function removeExistingVideo(videoPath) {
            const inputId = 'remove_video_' + videoPath.replace(/[^a-zA-Z0-9]/g, '_');
            const input = document.getElementById(inputId);
            if (input) {
                input.value = videoPath;
                const container = input.closest('div[style*="background: #f3f4f6"]');
                container.style.opacity = '0.5';
                container.style.pointerEvents = 'none';
            }
        }

        // Variants Management
        let variantCount = {{ $product->variants->count() }};

        function addVariant() {
            const container = document.getElementById('newVariantsContainer');
            const index = variantCount++;

            const variantDiv = document.createElement('div');
            variantDiv.className = 'variant-row';
            variantDiv.style.cssText = 'display:block; padding:1.25rem; margin-bottom:1.5rem;';
            variantDiv.innerHTML = `
            <div class="form-row" style="margin-bottom:0;">
                <div>
                    <label class="form-label">Variant Name</label>
                    <input type="text" name="variants[${index}][variant_name]" class="form-control" required>
                </div>
                <div>
                    <label class="form-label">SKU</label>
                    <input type="text" name="variants[${index}][sku]" class="form-control">
                </div>
                <div>
                    <label class="form-label">Price</label>
                    <input type="number" name="variants[${index}][price]" class="form-control" step="0.01" min="0">
                </div>
                <div>
                    <label class="form-label">Quantity</label>
                    <input type="number" name="variants[${index}][quantity]" class="form-control" min="0">
                </div>
                <div style="display: flex; align-items: flex-end; gap: 0.5rem;">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeVariant(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            <div style="margin-top:1rem;">
                <label class="form-label"><i class="fas fa-images"></i> Variant Images</label>
                <input type="file" name="variants[${index}][images][]" multiple accept="image/*" class="form-control" style="font-size:0.8rem;">
                <div class="form-text">JPG, PNG, max 2MB each</div>
            </div>
            <div style="margin-top:1rem;">
                <label class="form-label"><i class="fas fa-video"></i> Variant Videos</label>
                <input type="file" name="variants[${index}][videos][]" multiple accept="video/*" class="form-control" style="font-size:0.8rem;">
                <div class="form-text">MP4, MOV, max 5MB each</div>
            </div>
        `;

            container.appendChild(variantDiv);
        }

        function markVariantImageRemoval(btn, imagePath, variantIndex) {
            // Enable the hidden removal input
            const container = btn.closest('.image-preview');
            const hiddenInputs = container.querySelectorAll('input[type=hidden]');
            hiddenInputs.forEach(input => {
                input.value = imagePath;
                input.disabled = false;
            });
            container.style.opacity = '0.4';
            container.style.pointerEvents = 'none';
        }

        function markVariantVideoRemoval(btn, videoPath, variantIndex) {
            const container = btn.closest('div');
            // Find the hidden input inside
            const hiddenInput = container.querySelector('input[type=hidden]');
            if (hiddenInput) {
                hiddenInput.value = videoPath;
                hiddenInput.disabled = false;
            }
            container.style.opacity = '0.4';
            container.style.pointerEvents = 'none';
        }

        function removeVariant(button) {
            const variantRow = button.closest('.variant-row');
            variantRow.remove();
        }

        // Form Validation
        document.getElementById('productForm').addEventListener('submit', function(e) {
            // Basic validation
            const price = document.getElementById('price').value;
            const discountPrice = document.getElementById('discount_price').value;

            if (discountPrice && parseFloat(discountPrice) > parseFloat(price)) {
                e.preventDefault();
                alert('Discount price cannot be higher than regular price.');
                return false;
            }

            return true;
        });

        // Auto-calculate discount percentage
        document.getElementById('price').addEventListener('input', updateDiscountInfo);
        document.getElementById('discount_price').addEventListener('input', updateDiscountInfo);
        document.getElementById('discount_type').addEventListener('change', updateDiscountInfo);

        function updateDiscountInfo() {
            const price = parseFloat(document.getElementById('price').value) || 0;
            const discountPrice = parseFloat(document.getElementById('discount_price').value) || 0;
            const discountType = document.getElementById('discount_type').value;

            if (price > 0 && discountPrice > 0) {
                let discountInfo = '';
                if (discountType === 'percent') {
                    discountInfo = `${discountPrice}% off`;
                } else {
                    const discountPercent = ((price - discountPrice) / price * 100).toFixed(1);
                    discountInfo = `${discountPercent}% off (Save: ${(price - discountPrice).toFixed(2)})`;
                }

                // Show discount info (you can customize where to show it)
                console.log('Discount Info:', discountInfo);
            }
        }

        // Initialize discount info on page load
        document.addEventListener('DOMContentLoaded', updateDiscountInfo);
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

    {{-- Keyframes must live in a <style> tag, NOT inside <script> --}}
    <style>
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
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.style.cssText = [
                'position:fixed', 'top:20px', 'right:20px',
                'padding:1rem 1.5rem', 'border-radius:8px',
                'color:white', 'font-weight:500', 'z-index:9999',
                'animation:slideIn 0.3s ease',
                'box-shadow:0 4px 12px rgba(0,0,0,0.1)'
            ].join(';');

            notification.style.background = type === 'success'
                ? 'linear-gradient(135deg,#10b981 0%,#047857 100%)'
                : 'linear-gradient(135deg,#ef4444 0%,#b91c1c 100%)';

            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Sizes Management
        function addSize() {
            const container = document.getElementById('newSizesContainer');
            const sizeDiv = document.createElement('div');
            sizeDiv.className = 'size-row';
            sizeDiv.style.cssText = 'display:flex;gap:0.5rem;margin-bottom:0.75rem;';
            sizeDiv.innerHTML = `
                <input type="text" name="new_sizes[]" class="form-control" placeholder="e.g., S, M, L, XL">
                <button type="button" class="btn btn-danger btn-sm delete-size-btn">
                    <i class="fas fa-trash"></i>
                </button>
            `;
            container.appendChild(sizeDiv);
        }

        // Event delegation — handles delete for both existing and newly added size rows
        document.addEventListener('click', function(e) {
            const deleteBtn = e.target.closest('.delete-size-btn');
            if (deleteBtn) {
                const sizeRow = deleteBtn.closest('.size-row');
                if (sizeRow) sizeRow.remove();
            }
        });
    </script>
@endsection