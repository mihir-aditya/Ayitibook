@extends('seller.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-container">
        <!-- Page Header -->
        <div class="page-header">
            <div class="header-content">
                <div class="header-left">
                    <h1 class="page-title">Add New Product</h1>
                    <p class="page-subtitle">Create a new product listing for your store</p>
                </div>
                <div class="header-right">
                    <div class="action-buttons">
                        <a href="{{ route('seller.products.index') }}" class="btn btn-outline">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                            </svg>
                            Back to Products
                        </a>
                    </div>
                </div>
            </div>
            <div class="progress-bar">
                <div class="progress-step active">
                    <span class="step-number">1</span>
                    <span class="step-text">Basic Info</span>
                </div>
                <div class="progress-step">
                    <span class="step-number">2</span>
                    <span class="step-text">Pricing</span>
                </div>
                <div class="progress-step">
                    <span class="step-number">3</span>
                    <span class="step-text">Inventory</span>
                </div>
                <div class="progress-step">
                    <span class="step-number">4</span>
                    <span class="step-text">Media</span>
                </div>
                <div class="progress-step">
                    <span class="step-number">5</span>
                    <span class="step-text">Review</span>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <div class="alert-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                    </div>
                    <div class="alert-content">
                        <h4>Please fix the following errors:</h4>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('seller.products.store') }}" enctype="multipart/form-data" id="productForm">
                @csrf

                <div class="form-sections">
                    <!-- Section 1: Basic Information -->
                    <div class="form-section-card">
                        <div class="section-header">
                            <div class="section-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M6 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-1 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0z"/>
                                    <path d="M2 1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2a1 1 0 0 1 1-1zm0 5.586 7 7L13.586 9l-7-7H2v4.586z"/>
                                </svg>
                            </div>
                            <h2 class="section-title">Basic Information</h2>
                        </div>
                        <div class="section-content">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">
                                        Product Name
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" name="name" value="{{ old('name') }}" required
                                        placeholder="Enter product name" class="form-control @error('name') is-invalid @enderror">
                                    <div class="form-hint">Make it descriptive and unique</div>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        SKU (Stock Keeping Unit)
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" name="sku" value="{{ old('sku') }}" required
                                        placeholder="e.g., PROD-001" class="form-control @error('sku') is-invalid @enderror">
                                    <div class="form-hint">Unique identifier for this product</div>
                                    @error('sku')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group full-width">
                                    <label class="form-label">
                                        Description
                                        <span class="char-counter">
                                            <span id="charCount">0</span>/2000
                                        </span>
                                    </label>
                                    <textarea name="description" rows="4" placeholder="Describe your product in detail..."
                                        class="form-control textarea-autosize @error('description') is-invalid @enderror"
                                        oninput="updateCharCount(this)">{{ old('description') }}</textarea>
                                    <div class="form-hint">Include key features, benefits, and specifications</div>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Category</label>
                                    <div class="select-wrapper">
                                        <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                            <option value="">Select Category</option>
                                            <!-- Categories would be populated dynamically -->
                                            <option value="1" {{ old('category_id') == '1' ? 'selected' : '' }}>Electronics</option>
                                            <option value="2" {{ old('category_id') == '2' ? 'selected' : '' }}>Fashion</option>
                                            <option value="3" {{ old('category_id') == '3' ? 'selected' : '' }}>Home & Garden</option>
                                            <option value="4" {{ old('category_id') == '4' ? 'selected' : '' }}>Sports</option>
                                        </select>
                                        <div class="select-arrow">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <a href="#" class="text-link">+ Add new category</a>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Brand</label>
                                    <div class="select-wrapper">
                                        <select name="brand_id" class="form-control @error('brand_id') is-invalid @enderror">
                                            <option value="">Select Brand</option>
                                            <option value="1" {{ old('brand_id') == '1' ? 'selected' : '' }}>Apple</option>
                                            <option value="2" {{ old('brand_id') == '2' ? 'selected' : '' }}>Samsung</option>
                                            <option value="3" {{ old('brand_id') == '3' ? 'selected' : '' }}>Nike</option>
                                            <option value="4" {{ old('brand_id') == '4' ? 'selected' : '' }}>Adidas</option>
                                        </select>
                                        <div class="select-arrow">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <a href="#" class="text-link">+ Add new brand</a>
                                    @error('brand_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Pricing -->
                    <div class="form-section-card">
                        <div class="section-header">
                            <div class="section-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
                                </svg>
                            </div>
                            <h2 class="section-title">Pricing</h2>
                        </div>
                        <div class="section-content">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">
                                        Base Price
                                        <span class="required">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="0.01" name="price" value="{{ old('price') }}" required
                                            placeholder="0.00" class="form-control @error('price') is-invalid @enderror">
                                    </div>
                                    <div class="form-hint">Original selling price</div>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Sale Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="0.01" name="discount_price" value="{{ old('discount_price') }}"
                                            placeholder="0.00" class="form-control @error('discount_price') is-invalid @enderror">
                                    </div>
                                    <div class="form-hint">Discounted price (optional)</div>
                                    @error('discount_price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Discount Type</label>
                                    <div class="select-wrapper">
                                        <select name="discount_type" class="form-control @error('discount_type') is-invalid @enderror">
                                            <option value="">No discount</option>
                                            <option value="percent" {{ old('discount_type') == 'percent' ? 'selected' : '' }}>Percentage (%)</option>
                                            <option value="flat" {{ old('discount_type') == 'flat' ? 'selected' : '' }}>Fixed amount</option>
                                        </select>
                                        <div class="select-arrow">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    @error('discount_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        Currency
                                        <span class="required">*</span>
                                    </label>
                                    <div class="select-wrapper">
                                        <select name="currency" class="form-control @error('currency') is-invalid @enderror" required>
                                            <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>USD ($)</option>
                                            <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                                            <option value="GBP" {{ old('currency') == 'GBP' ? 'selected' : '' }}>GBP (£)</option>
                                            <option value="INR" {{ old('currency') == 'INR' ? 'selected' : '' }}>INR (₹)</option>
                                        </select>
                                        <div class="select-arrow">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    @error('currency')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Inventory & Shipping -->
                    <div class="form-section-card">
                        <div class="section-header">
                            <div class="section-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                                </svg>
                            </div>
                            <h2 class="section-title">Inventory & Shipping</h2>
                        </div>
                        <div class="section-content">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">
                                        Stock Quantity
                                        <span class="required">*</span>
                                    </label>
                                    <input type="number" name="stock_quantity" value="{{ old('stock_quantity') }}" required
                                        placeholder="0" min="0" class="form-control @error('stock_quantity') is-invalid @enderror">
                                    <div class="form-hint">Available items in stock</div>
                                    @error('stock_quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Low Stock Alert</label>
                                    <input type="number" name="low_stock_quantity" value="{{ old('low_stock_quantity') }}"
                                        placeholder="0" min="0" class="form-control @error('low_stock_quantity') is-invalid @enderror">
                                    <div class="form-hint">Get notified when stock is low</div>
                                    @error('low_stock_quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Max Purchase Quantity</label>
                                    <input type="number" name="maximum_purchase_quantity" value="{{ old('maximum_purchase_quantity') }}"
                                        placeholder="No limit" min="1" class="form-control @error('maximum_purchase_quantity') is-invalid @enderror">
                                    <div class="form-hint">Maximum items per order</div>
                                    @error('maximum_purchase_quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Weight (kg)</label>
                                    <input type="number" step="0.01" name="weight" placeholder="0.00" value="{{ old('weight') }}"
                                        class="form-control @error('weight') is-invalid @enderror">
                                    <div class="form-hint">Product weight for shipping</div>
                                    @error('weight')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="dimensions-grid">
                                <h4 class="dimensions-title">Dimensions (cm)</h4>
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label class="form-label">Length</label>
                                        <input type="number" step="0.01" name="length" placeholder="0.00" value="{{ old('length') }}"
                                            class="form-control @error('length') is-invalid @enderror">
                                        @error('length')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Width</label>
                                        <input type="number" step="0.01" name="width" placeholder="0.00" value="{{ old('width') }}"
                                            class="form-control @error('width') is-invalid @enderror">
                                        @error('width')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Height</label>
                                        <input type="number" step="0.01" name="height" placeholder="0.00" value="{{ old('height') }}"
                                            class="form-control @error('height') is-invalid @enderror">
                                        @error('height')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 4: Product Features -->
                    <div class="form-section-card">
                        <div class="section-header">
                            <div class="section-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            </div>
                            <h2 class="section-title">Product Features</h2>
                        </div>
                        <div class="section-content">
                            <div class="feature-toggle-grid">
                                <label class="feature-toggle">
                                    <input type="checkbox" name="can_purchase" value="1" {{ old('can_purchase', 1) ? 'checked' : '' }} class="toggle-input">
                                    <span class="toggle-slider"></span>
                                    <div class="toggle-content">
                                        <span class="toggle-title">Available for Purchase</span>
                                        <span class="toggle-description">Allow customers to buy this product</span>
                                    </div>
                                </label>

                                <label class="feature-toggle">
                                    <input type="checkbox" name="refundable" value="1" {{ old('refundable') ? 'checked' : '' }} class="toggle-input">
                                    <span class="toggle-slider"></span>
                                    <div class="toggle-content">
                                        <span class="toggle-title">Refundable</span>
                                        <span class="toggle-description">Allow returns and refunds</span>
                                    </div>
                                </label>

                                <label class="feature-toggle">
                                    <input type="checkbox" name="is_flash_sale" value="1" {{ old('is_flash_sale') ? 'checked' : '' }} class="toggle-input">
                                    <span class="toggle-slider"></span>
                                    <div class="toggle-content">
                                        <span class="toggle-title">Flash Sale</span>
                                        <span class="toggle-description">Promote as limited time offer</span>
                                    </div>
                                </label>

                                <label class="feature-toggle">
                                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }} class="toggle-input">
                                    <span class="toggle-slider"></span>
                                    <div class="toggle-content">
                                        <span class="toggle-title">Active Listing</span>
                                        <span class="toggle-description">Make product visible to customers</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Section 5: Media -->
                    <div class="form-section-card">
                        <div class="section-header">
                            <div class="section-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                                    <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"/>
                                </svg>
                            </div>
                            <h2 class="section-title">Media</h2>
                        </div>
                        <div class="section-content">
                            <div class="media-upload-grid">
                                <!-- Thumbnail Upload -->
                                <div class="media-upload-box">
                                    <div class="upload-header">
                                        <span class="upload-title">Thumbnail Image</span>
                                        <span class="upload-required">*</span>
                                    </div>
                                    <p class="upload-description">Main product image (Displayed in product listings)</p>
                                    <div class="upload-area @error('thumbnail') has-error @enderror" id="thumbnailUpload">
                                        <input type="file" name="thumbnail" class="upload-input" accept="image/*" id="thumbnailInput">
                                        <div class="upload-placeholder">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                            </svg>
                                            <p>Drag & drop or click to upload</p>
                                            <span class="upload-hint">PNG, JPG, GIF up to 5MB</span>
                                        </div>
                                        <div class="upload-preview" id="thumbnailPreview"></div>
                                    </div>
                                    @error('thumbnail')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Gallery Images -->
                                <div class="media-upload-box">
                                    <div class="upload-header">
                                        <span class="upload-title">Product Gallery</span>
                                    </div>
                                    <p class="upload-description">Additional images (Supports multiple uploads)</p>
                                    <div class="upload-area @error('images') has-error @enderror" id="galleryUpload">
                                        <input type="file" name="images[]" class="upload-input" multiple accept="image/*" id="galleryInput">
                                        <div class="upload-placeholder">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                                                <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"/>
                                            </svg>
                                            <p>Drag & drop or click to upload</p>
                                            <span class="upload-hint">Up to 10 images, 5MB each</span>
                                        </div>
                                        <div class="upload-preview" id="galleryPreview"></div>
                                    </div>
                                    @error('images')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Videos -->
                                <div class="media-upload-box">
                                    <div class="upload-header">
                                        <span class="upload-title">Product Videos</span>
                                    </div>
                                    <p class="upload-description">Video demonstrations (Optional)</p>
                                    <div class="upload-area @error('videos') has-error @enderror" id="videoUpload">
                                        <input type="file" name="videos[]" class="upload-input" multiple accept="video/*" id="videoInput">
                                        <div class="upload-placeholder">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M0 12V4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm6.79-6.907A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814l-3.5-2.5z"/>
                                            </svg>
                                            <p>Drag & drop or click to upload</p>
                                            <span class="upload-hint">MP4, MOV up to 50MB</span>
                                        </div>
                                        <div class="upload-preview" id="videoPreview"></div>
                                    </div>
                                    @error('videos')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 6: SEO & Meta -->
                    <div class="form-section-card">
                        <div class="section-header">
                            <div class="section-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </div>
                            <h2 class="section-title">SEO Optimization</h2>
                        </div>
                        <div class="section-content">
                            <div class="seo-preview">
                                <div class="seo-preview-content">
                                    <h3 class="seo-preview-title" id="seoPreviewTitle">{{ old('meta_title') ?: 'Your product title will appear here' }}</h3>
                                    <p class="seo-preview-url">https://yourstore.com/products/{{ old('sku') ?: 'product-slug' }}</p>
                                    <p class="seo-preview-description" id="seoPreviewDesc">
                                        {{ old('meta_description') ?: 'Your product description will appear here. This is what shows up in search engine results.' }}
                                    </p>
                                </div>
                                <p class="seo-note">This is how your product might appear in search results</p>
                            </div>

                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Meta Title</label>
                                    <input type="text" name="meta_title" value="{{ old('meta_title') }}"
                                        placeholder="Optimized title for search engines" class="form-control @error('meta_title') is-invalid @enderror"
                                        oninput="updateSeoPreview()">
                                    <div class="form-hint">Recommended: 50-60 characters</div>
                                    @error('meta_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Meta Keywords</label>
                                    <input type="text" name="meta_keywords" value="{{ old('meta_keywords') }}"
                                        placeholder="keyword1, keyword2, keyword3" class="form-control @error('meta_keywords') is-invalid @enderror">
                                    <div class="form-hint">Comma separated keywords</div>
                                    @error('meta_keywords')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group full-width">
                                    <label class="form-label">Meta Description</label>
                                    <textarea name="meta_description" rows="3" placeholder="Brief description for search results..."
                                        class="form-control @error('meta_description') is-invalid @enderror"
                                        oninput="updateSeoPreview()">{{ old('meta_description') }}</textarea>
                                    <div class="form-hint">Recommended: 150-160 characters</div>
                                    @error('meta_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <div class="form-actions-left">
                        <button type="button" class="btn btn-outline" onclick="saveAsDraft()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M10 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0z"/>
                            </svg>
                            Save as Draft
                        </button>
                    </div>
                    <div class="form-actions-right">
                        <a href="{{ route('seller.products.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293L6.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L10.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                            </svg>
                            Create Product
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    :root {
        --primary: #3b82f6;
        --primary-hover: #2563eb;
        --primary-light: #dbeafe;
        --secondary: #7c3aed;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --danger-hover: #dc2626;
        --dark: #1e293b;
        --dark-gray: #334155;
        --gray: #64748b;
        --light-gray: #e2e8f0;
        --lighter-gray: #f1f5f9;
        --white: #ffffff;
        --border: #cbd5e1;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.12);
        --shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        --shadow-lg: 0 10px 25px -5px rgba(0,0,0,0.1);
        --shadow-xl: 0 20px 40px -10px rgba(0,0,0,0.15);
        --radius: 8px;
        --radius-lg: 12px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        background: #f8fafc;
        color: var(--dark);
        line-height: 1.5;
    }

    .container-fluid {
        width: 100%;
        padding-right: 1rem;
        padding-left: 1rem;
        margin-right: auto;
        margin-left: auto;
    }

    /* Page Container */
    .page-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1.5rem;
    }

    /* Page Header */
    .page-header {
        background: var(--white);
        border-radius: var(--radius-lg);
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 2rem;
    }

    .header-left {
        flex: 1;
    }

    .page-title {
        font-size: 1.875rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 0.5rem;
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .page-subtitle {
        color: var(--gray);
        font-size: 0.95rem;
    }

    .header-right {
        flex-shrink: 0;
    }

    .action-buttons {
        display: flex;
        gap: 0.75rem;
    }

    /* Progress Bar */
    .progress-bar {
        display: flex;
        justify-content: space-between;
        position: relative;
        padding: 0 1rem;
    }

    .progress-bar::before {
        content: '';
        position: absolute;
        top: 20px;
        left: 10%;
        right: 10%;
        height: 2px;
        background: var(--light-gray);
        z-index: 1;
    }

    .progress-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 2;
    }

    .step-number {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--lighter-gray);
        border: 2px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: var(--gray);
        margin-bottom: 0.5rem;
        transition: var(--transition);
    }

    .progress-step.active .step-number {
        background: var(--primary);
        border-color: var(--primary);
        color: var(--white);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .step-text {
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--gray);
    }

    .progress-step.active .step-text {
        color: var(--primary);
        font-weight: 600;
    }

    /* Main Content */
    .main-content {
        margin-bottom: 3rem;
    }

    /* Alert */
    .alert {
        display: flex;
        align-items: flex-start;
        padding: 1rem 1.25rem;
        border-radius: var(--radius);
        margin-bottom: 1.5rem;
        animation: slideDown 0.3s ease;
    }

    .alert-danger {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        border-left: 4px solid var(--danger);
        color: #991b1b;
    }

    .alert-icon {
        margin-right: 0.75rem;
        flex-shrink: 0;
        margin-top: 0.125rem;
    }

    .alert-content {
        flex: 1;
    }

    .alert-content h4 {
        font-size: 1rem;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .alert-content ul {
        list-style: none;
        padding-left: 0;
    }

    .alert-content li {
        padding: 0.25rem 0;
        position: relative;
        padding-left: 1.25rem;
    }

    .alert-content li::before {
        content: '•';
        position: absolute;
        left: 0;
        font-weight: bold;
    }

    /* Form Sections */
    .form-sections {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .form-section-card {
        background: var(--white);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        transition: var(--transition);
    }

    .form-section-card:hover {
        box-shadow: var(--shadow-lg);
        transform: translateY(-2px);
    }

    .section-header {
        display: flex;
        align-items: center;
        padding: 1.5rem;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 1px solid var(--border);
    }

    .section-icon {
        margin-right: 0.75rem;
        color: var(--primary);
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--dark);
    }

    .section-content {
        padding: 1.5rem;
    }

    /* Form Grid */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-label {
        font-weight: 600;
        font-size: 0.9rem;
        color: var(--dark-gray);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .required {
        color: var(--danger);
        font-size: 0.8rem;
        font-weight: 600;
    }

    .char-counter {
        font-size: 0.8rem;
        color: var(--gray);
        font-weight: normal;
    }

    /* Form Controls */
    .form-control {
        padding: 0.75rem 1rem;
        border: 2px solid var(--border);
        border-radius: var(--radius);
        font-size: 0.95rem;
        font-family: inherit;
        transition: var(--transition);
        background: var(--white);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-control.is-invalid {
        border-color: var(--danger);
        background: #fef2f2;
    }

    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }

    .form-control::placeholder {
        color: var(--gray);
        opacity: 0.7;
    }

    .textarea-autosize {
        resize: vertical;
        min-height: 100px;
        line-height: 1.5;
    }

    /* Input Group */
    .input-group {
        display: flex;
        border: 2px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
        transition: var(--transition);
    }

    .input-group:focus-within {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .input-group-text {
        padding: 0.75rem 1rem;
        background: var(--lighter-gray);
        border-right: 2px solid var(--border);
        color: var(--dark-gray);
        font-weight: 500;
        display: flex;
        align-items: center;
    }

    .input-group .form-control {
        flex: 1;
        border: none;
        border-radius: 0;
    }

    .input-group .form-control:focus {
        box-shadow: none;
    }

    /* Select Wrapper */
    .select-wrapper {
        position: relative;
    }

    .select-wrapper .form-control {
        appearance: none;
        padding-right: 2.5rem;
        cursor: pointer;
    }

    .select-arrow {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        color: var(--gray);
    }

    /* Text Link */
    .text-link {
        font-size: 0.85rem;
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
        margin-top: 0.25rem;
        transition: var(--transition);
    }

    .text-link:hover {
        color: var(--primary-hover);
        text-decoration: underline;
    }

    /* Form Hint */
    .form-hint {
        font-size: 0.8rem;
        color: var(--gray);
        margin-top: 0.25rem;
    }

    /* Invalid Feedback */
    .invalid-feedback {
        font-size: 0.85rem;
        color: var(--danger);
        margin-top: 0.25rem;
        font-weight: 500;
    }

    /* Dimensions Grid */
    .dimensions-grid {
        padding: 1.5rem;
        background: var(--lighter-gray);
        border-radius: var(--radius);
        border: 1px solid var(--border);
    }

    .dimensions-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--dark-gray);
        margin-bottom: 1rem;
    }

    /* Feature Toggles */
    .feature-toggle-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
    }

    .feature-toggle {
        display: flex;
        align-items: center;
        padding: 1rem;
        background: var(--lighter-gray);
        border-radius: var(--radius);
        border: 1px solid var(--border);
        cursor: pointer;
        transition: var(--transition);
        gap: 1rem;
    }

    .feature-toggle:hover {
        background: var(--light-gray);
        border-color: var(--primary);
    }

    .toggle-input {
        display: none;
    }

    .toggle-slider {
        position: relative;
        width: 48px;
        height: 24px;
        background: var(--gray);
        border-radius: 12px;
        transition: var(--transition);
        flex-shrink: 0;
    }

    .toggle-slider::before {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: var(--white);
        top: 2px;
        left: 2px;
        transition: var(--transition);
    }

    .toggle-input:checked + .toggle-slider {
        background: var(--success);
    }

    .toggle-input:checked + .toggle-slider::before {
        transform: translateX(24px);
    }

    .toggle-content {
        flex: 1;
    }

    .toggle-title {
        display: block;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.25rem;
    }

    .toggle-description {
        display: block;
        font-size: 0.85rem;
        color: var(--gray);
    }

    /* Media Upload */
    .media-upload-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }

    .media-upload-box {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .upload-header {
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .upload-title {
        font-weight: 600;
        color: var(--dark);
    }

    .upload-required {
        color: var(--danger);
        font-weight: 600;
    }

    .upload-description {
        font-size: 0.9rem;
        color: var(--gray);
        margin: 0;
    }

    .upload-area {
        position: relative;
        min-height: 200px;
        border: 2px dashed var(--border);
        border-radius: var(--radius);
        background: var(--lighter-gray);
        transition: var(--transition);
        overflow: hidden;
    }

    .upload-area.has-error {
        border-color: var(--danger);
        background: #fef2f2;
    }

    .upload-area:hover {
        border-color: var(--primary);
        background: var(--primary-light);
    }

    .upload-input {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        z-index: 2;
    }

    .upload-placeholder {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        text-align: center;
        color: var(--gray);
        transition: var(--transition);
    }

    .upload-placeholder svg {
        margin-bottom: 1rem;
        color: var(--gray);
        opacity: 0.7;
    }

    .upload-placeholder p {
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .upload-hint {
        font-size: 0.85rem;
        opacity: 0.7;
    }

    .upload-preview {
        position: relative;
        z-index: 1;
        display: none;
        padding: 1rem;
    }

    /* SEO Preview */
    .seo-preview {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .seo-preview-content {
        border-left: 3px solid var(--primary);
        padding-left: 1rem;
    }

    .seo-preview-title {
        color: #1a0dab;
        font-size: 1.125rem;
        font-weight: 400;
        margin-bottom: 0.25rem;
        line-height: 1.3;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }

    .seo-preview-url {
        color: #006621;
        font-size: 0.85rem;
        margin-bottom: 0.5rem;
    }

    .seo-preview-description {
        color: #545454;
        font-size: 0.9rem;
        line-height: 1.4;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .seo-note {
        font-size: 0.85rem;
        color: var(--gray);
        margin-top: 1rem;
        text-align: center;
        font-style: italic;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 2rem;
        background: var(--white);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        margin-top: 2rem;
    }

    .form-actions-left,
    .form-actions-right {
        display: flex;
        gap: 1rem;
    }

    /* Buttons */
    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: var(--radius);
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: var(--transition);
        border: 2px solid transparent;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        text-decoration: none;
        font-family: inherit;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        color: var(--white);
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    .btn-secondary {
        background: var(--white);
        color: var(--dark);
        border-color: var(--border);
    }

    .btn-secondary:hover {
        background: var(--lighter-gray);
        border-color: var(--gray);
    }

    .btn-outline {
        background: transparent;
        color: var(--primary);
        border-color: var(--primary);
    }

    .btn-outline:hover {
        background: var(--primary-light);
    }

    /* Animations */
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .page-container {
            padding: 1rem;
        }

        .page-header {
            padding: 1.5rem;
        }

        .header-content {
            flex-direction: column;
            gap: 1rem;
        }

        .action-buttons {
            width: 100%;
        }

        .btn {
            flex: 1;
        }

        .progress-bar {
            flex-wrap: wrap;
            gap: 1rem;
        }

        .progress-bar::before {
            display: none;
        }

        .progress-step {
            flex: 1;
            min-width: 80px;
        }

        .form-actions {
            flex-direction: column;
            gap: 1rem;
        }

        .form-actions-left,
        .form-actions-right {
            width: 100%;
        }

        .form-actions-left .btn,
        .form-actions-right .btn {
            width: 100%;
        }

        .form-section-card {
            margin: 0 -1rem;
            border-radius: 0;
            border-left: none;
            border-right: none;
        }

        .media-upload-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .feature-toggle-grid {
            grid-template-columns: 1fr;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .progress-step {
            min-width: 60px;
        }

        .step-number {
            width: 32px;
            height: 32px;
            font-size: 0.85rem;
        }

        .step-text {
            font-size: 0.75rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Character counter for description
        function updateCharCount(textarea) {
            const charCount = document.getElementById('charCount');
            charCount.textContent = textarea.value.length;
        }

        // Initialize character count
        const descriptionTextarea = document.querySelector('textarea[name="description"]');
        if (descriptionTextarea) {
            updateCharCount(descriptionTextarea);
            descriptionTextarea.addEventListener('input', function() {
                updateCharCount(this);
            });
        }

        // SEO Preview updates
        window.updateSeoPreview = function() {
            const metaTitle = document.querySelector('input[name="meta_title"]');
            const metaDescription = document.querySelector('textarea[name="meta_description"]');
            const seoTitle = document.getElementById('seoPreviewTitle');
            const seoDesc = document.getElementById('seoPreviewDesc');

            if (metaTitle && metaTitle.value) {
                seoTitle.textContent = metaTitle.value;
            } else {
                seoTitle.textContent = 'Your product title will appear here';
            }

            if (metaDescription && metaDescription.value) {
                seoDesc.textContent = metaDescription.value;
            } else {
                seoDesc.textContent = 'Your product description will appear here. This is what shows up in search engine results.';
            }
        }

        // File upload previews
        function handleFileUpload(input, previewId) {
            const preview = document.getElementById(previewId);
            const placeholder = input.previousElementSibling;

            input.addEventListener('change', function(e) {
                const files = Array.from(e.target.files);
                if (files.length > 0) {
                    placeholder.style.display = 'none';
                    preview.style.display = 'block';
                    preview.innerHTML = '';

                    files.forEach((file, index) => {
                        if (file.type.startsWith('image/')) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const img = document.createElement('img');
                                img.src = e.target.result;
                                img.style.maxWidth = '100px';
                                img.style.maxHeight = '100px';
                                img.style.margin = '5px';
                                img.style.borderRadius = '4px';
                                preview.appendChild(img);
                            }
                            reader.readAsDataURL(file);
                        } else if (file.type.startsWith('video/')) {
                            const div = document.createElement('div');
                            div.className = 'video-preview';
                            div.innerHTML = `
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M0 12V4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm6.79-6.907A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814l-3.5-2.5z"/>
                                </svg>
                                <span>${file.name}</span>
                            `;
                            div.style.display = 'flex';
                            div.style.alignItems = 'center';
                            div.style.gap = '8px';
                            div.style.margin = '5px';
                            div.style.padding = '8px';
                            div.style.background = '#f1f5f9';
                            div.style.borderRadius = '4px';
                            preview.appendChild(div);
                        }
                    });
                } else {
                    placeholder.style.display = 'flex';
                    preview.style.display = 'none';
                }
            });
        }

        // Initialize file upload handlers
        const thumbnailInput = document.getElementById('thumbnailInput');
        const galleryInput = document.getElementById('galleryInput');
        const videoInput = document.getElementById('videoInput');

        if (thumbnailInput) handleFileUpload(thumbnailInput, 'thumbnailPreview');
        if (galleryInput) handleFileUpload(galleryInput, 'galleryPreview');
        if (videoInput) handleFileUpload(videoInput, 'videoPreview');

        // Save as draft
        window.saveAsDraft = function() {
            const form = document.getElementById('productForm');
            const draftInput = document.createElement('input');
            draftInput.type = 'hidden';
            draftInput.name = 'draft';
            draftInput.value = '1';
            form.appendChild(draftInput);
            
            // Add confirmation
            if (confirm('Save as draft? You can continue editing later.')) {
                form.submit();
            } else {
                form.removeChild(draftInput);
            }
        }

        // Auto-resize textareas
        const textareas = document.querySelectorAll('.textarea-autosize');
        textareas.forEach(textarea => {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
        });

        // Form validation
        const form = document.getElementById('productForm');
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('is-invalid');
                    
                    // Add error message if not exists
                    if (!field.nextElementSibling?.classList.contains('invalid-feedback')) {
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'invalid-feedback';
                        errorDiv.textContent = 'This field is required';
                        field.parentNode.insertBefore(errorDiv, field.nextElementSibling);
                    }
                } else {
                    field.classList.remove('is-invalid');
                    const errorDiv = field.nextElementSibling;
                    if (errorDiv && errorDiv.classList.contains('invalid-feedback')) {
                        errorDiv.remove();
                    }
                }
            });

            if (!isValid) {
                e.preventDefault();
                // Scroll to first error
                const firstError = form.querySelector('.is-invalid');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });

        // Price validation
        const priceInput = document.querySelector('input[name="price"]');
        const discountInput = document.querySelector('input[name="discount_price"]');

        if (priceInput && discountInput) {
            discountInput.addEventListener('input', function() {
                if (parseFloat(this.value) >= parseFloat(priceInput.value)) {
                    this.classList.add('is-invalid');
                    const errorDiv = this.nextElementSibling;
                    if (!errorDiv || !errorDiv.classList.contains('invalid-feedback')) {
                        const error = document.createElement('div');
                        error.className = 'invalid-feedback';
                        error.textContent = 'Discount price must be lower than base price';
                        this.parentNode.insertBefore(error, this.nextElementSibling);
                    }
                } else {
                    this.classList.remove('is-invalid');
                    const errorDiv = this.nextElementSibling;
                    if (errorDiv && errorDiv.classList.contains('invalid-feedback')) {
                        errorDiv.remove();
                    }
                }
            });
        }

        // Initialize SEO preview
        updateSeoPreview();
    });
</script>
@endsection