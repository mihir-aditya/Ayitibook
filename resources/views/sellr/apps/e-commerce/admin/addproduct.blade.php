<!DOCTYPE html>
<html lang="en-US" dir="ltr" data-navigation-type="default" data-navbar-horizontal-shape="default">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Adminzone</title>

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('seller/assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('seller/assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('seller/assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('seller/assets/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('seller/assets/img/favicons/manifest.json') }}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('seller/vendors/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('seller/assets/js/config.js') }}"></script>

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="{{ asset('seller/vendors/dropzone/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('seller/vendors/choices/choices.min.css') }}" rel="stylesheet">
    <link href="{{ asset('seller/vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="../../../../../css2-1?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('seller/vendors/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="../../../../../release/v4.0.8/css/line-1.css">
    <link href="{{ asset('seller/assets/css/theme-rtl.min.css') }}" type="text/css" rel="stylesheet" id="style-rtl">
    <link href="{{ asset('seller/assets/css/theme.min.css') }}" type="text/css" rel="stylesheet" id="style-default">
    <link href="{{ asset('seller/assets/css/user-rtl.min.css') }}" type="text/css" rel="stylesheet" id="user-style-rtl">
    <link href="{{ asset('seller/assets/css/user.min.css') }}" type="text/css" rel="stylesheet" id="user-style-default">
    
    <script>
        var AdminzoneIsRTL = window.config.config.AdminzoneIsRTL;
        if (AdminzoneIsRTL) {
            var linkDefault = document.getElementById('style-default');
            var userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            var linkRTL = document.getElementById('style-rtl');
            var userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }
    </script>
    
    <style>
        .error-text {
            color: #dc3545;
            font-size: 0.85rem;
            margin-top: 4px;
        }
        .is-invalid {
            border-color: #dc3545 !important;
        }
        .variant-item {
            background-color: #f8f9fa;
        }
        .selected-tag-badge {
            font-size: 0.85rem;
        }
    </style>
</head>

<body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <main class="main" id="top">
        <x-sidebar/>
        <nav class="navbar navbar-top fixed-top navbar-expand" id="navbarDefault" style="display:none;"></nav>
        <nav class="navbar navbar-top navbar-slim fixed-top navbar-expand" id="topNavSlim" style="display:none;"></nav>
        
        <div class="content">
            <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data" id="productForm" class="mb-9">
                @csrf

                <div class="row g-3 flex-between-end mb-5">
                    <div class="col-auto">
                        <h2 class="mb-2">Add a product</h2>
                        <h5 class="text-body-tertiary fw-semibold">Orders placed across your store</h5>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-Adminzone-secondary me-2 mb-2 mb-sm-0" type="button" id="discardBtn">Discard</button>
                        <button class="btn btn-primary mb-2 mb-sm-0" type="submit">Publish product</button>
                    </div>
                </div>

                <div class="row g-5">
                    <div class="col-12 col-xl-8">
                        <h4 class="mb-3">Product Title</h4>
                        <input class="form-control mb-5" type="text" name="name" id="productName" placeholder="Write title here..." required>

                        <div class="mb-6">
                            <h4 class="mb-3">Product Description</h4>
                            <textarea class="tinymce" name="description" id="productDescription" data-tinymce='{"height":"30rem","placeholder":"Write a description here..."}'></textarea>
                        </div>
                        
                        <h4 class="mb-3">Thumbnail</h4>
                        <div class="dropzone p-0 mb-5">
                            <div class="fallback">
                                <input name="thumbnail" type="file" accept="image/jpeg,image/png,image/webp">
                            </div>
                        </div>
                        
                        <h4 class="mb-3">Display images</h4>
                        <div class="dropzone dropzone-multiple p-0 mb-5">
                            <div class="fallback">
                                <input name="images[]" type="file" accept="image/jpeg,image/png,image/webp" multiple>
                            </div>
                        </div>
                        
                        <h4 class="mb-3">Display Videos</h4>
                        <div class="dropzone dropzone-multiple p-0 mb-5">
                            <div class="fallback">
                                <input name="videos[]" type="file" accept="video/mp4,video/webm" multiple>
                            </div>
                        </div>
                        
                        <h4 class="mb-3">Inventory</h4>
                        <div class="tab-content py-3">
                            <div class="row g-3">
                                <div class="col-lg-6">
                                    <label class="form-label" for="regularPrice">Regular price</label>
                                    <input class="form-control" type="number" step="0.01" name="price" id="regularPrice" required>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="salePrice">Sale price</label>
                                    <input class="form-control" type="number" step="0.01" name="discount_price" id="salePrice">
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="form-label" for="stockQuantity">Stock Quantity</label>
                                <input class="form-control" type="number" name="stock_quantity" id="stockQuantity" required>
                            </div>

                            <div class="mt-4">
                                <label class="form-label" for="productSku">SKU</label>
                                <input class="form-control" type="text" name="sku" id="productSku">
                            </div>

                            <div class="mt-4">
                                <label class="form-label" for="currencySelect">Currency</label>
                                <select class="form-select" name="currency" id="currencySelect">
                                    <option value="" disabled selected>Select Currency</option>
                                    <option value="USD">USD</option>
                                    <option value="EUR">EUR</option>
                                    <option value="GBP">GBP</option>
                                    <option value="JPY">JPY</option>
                                    <option value="AUD">AUD</option>
                                    <option value="CAD">CAD</option>
                                    <option value="CHF">CHF</option>
                                    <option value="CNY">CNY</option>
                                    <option value="INR">INR</option>
                                    <option value="BRL">BRL</option>
                                </select>
                            </div>

                            <div class="mt-4">
                                <label class="form-label" for="productWeight">Weight (in Kg)</label>
                                <input class="form-control" type="number" step="0.0001" min="0" name="weight" id="productWeight">
                            </div>

                            <div id="variant_container"></div>
                            <button type="button" class="btn btn-Adminzone-primary mt-3" onclick="Add_new_variant()">
                                <i class="fa fa-plus me-1"></i> Add Variant
                            </button>
                        </div>
                    </div>

                    <!-- RIGHT SIDEBAR -->
                    <div class="col-12 col-xl-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Organize</h4>

                                <!-- CATEGORY -->
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5 class="mb-0 text-body-highlight">Category</h5>
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                            <i class="fas fa-plus"></i> Add New
                                        </button>
                                    </div>
                                    <select class="form-select" id="category_select" name="category_id" required>
                                        <option value="" disabled selected>Select Category</option>
                                        @foreach ($categories ?? [] as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- BRAND -->
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5 class="mb-0 text-body-highlight">Brand</h5>
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addBrandModal">
                                            <i class="fas fa-plus"></i> Add New
                                        </button>
                                    </div>
                                    <select class="form-select" id="brand_select" name="brand_id" required>
                                        <option value="" disabled selected>Select Brand</option>
                                        @foreach ($brands ?? [] as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- TAGS -->
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="mb-0 text-body-highlight">Tags</h5>
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addTagModal">
                                            <i class="fas fa-plus"></i> Add New
                                        </button>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary w-100 text-start" type="button" id="tagsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-tags"></i> Select Tags
                                        </button>
                                        <div class="dropdown-menu w-100" id="tags_dropdown" aria-labelledby="tagsDropdown" style="max-height: 300px; overflow-y: auto;">
                                            @foreach ($tags ?? [] as $tag)
                                                <div class="px-3 py-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input tag-checkbox" type="checkbox" id="tag_{{ $tag->id }}" name="tags[]" value="{{ $tag->id }}" data-tag-name="{{ $tag->name }}">
                                                        <label class="form-check-label" for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div id="selected_tags_display" class="mt-2 d-flex flex-wrap gap-2"></div>
                                </div>
                            </div>
                        </div>

                        <!-- SEO META TAGS -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h4 class="card-title mb-4">SEO Meta Tags</h4>

                                <div class="mb-3">
                                    <label class="form-label" for="meta_title">Meta Title</label>
                                    <input class="form-control" id="meta_title" name="meta_title" type="text" placeholder="Page title for search engines">
                                    <small class="text-muted">Recommended: 50-60 characters</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="meta_keywords">Meta Keywords</label>
                                    <input class="form-control" id="meta_keywords" name="meta_keywords" type="text" placeholder="Comma separated keywords">
                                    <small class="text-muted">Example: smartphone, mobile phone, android</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="meta_description">Meta Description</label>
                                    <textarea class="form-control" id="meta_description" name="meta_description" rows="3" placeholder="Brief description for search engines"></textarea>
                                    <small class="text-muted">Recommended: 150-160 characters</small>
                                </div>
                            </div>
                        </div>

                        <!-- FLAGS -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Status</h4>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                                    <label class="form-check-label">Active</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="can_purchase" value="1">
                                    <label class="form-check-label">Can Purchase</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="refundable" value="1">
                                    <label class="form-check-label">Refundable</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_flash_sale" value="1">
                                    <label class="form-check-label">Flash Sale</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="{{ asset('seller/vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/is/is.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/lodash/lodash.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/list.js/list.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/dayjs/dayjs.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/dropzone/dropzone-min.js') }}"></script>
    <script src="{{ asset('seller/vendors/choices/choices.min.js') }}"></script>
    <script src="{{ asset('seller/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('seller/assets/js/Adminzone.js') }}"></script>

    <!-- Initialize Bootstrap components -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Bootstrap modals
            var modals = document.querySelectorAll('.modal');
            modals.forEach(function(modal) {
                new bootstrap.Modal(modal);
            });
        });
    </script>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCategoryForm">
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Category Name *</label>
                            <input type="text" class="form-control" id="categoryName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="categorySlug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="categorySlug" name="slug" placeholder="auto-generated">
                        </div>
                        <div class="alert d-none" id="categoryMessage"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="addNewCategory()">Add Category</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Brand Modal -->
    <div class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="addBrandLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBrandLabel">Add New Brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addBrandForm">
                        <div class="mb-3">
                            <label for="brandName" class="form-label">Brand Name *</label>
                            <input type="text" class="form-control" id="brandName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="brandId" class="form-label">Brand ID *</label>
                            <input type="text" class="form-control" id="brandId" name="brand_id" required>
                        </div>
                        <div class="alert d-none" id="brandMessage"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="addNewBrand()">Add Brand</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Tag Modal -->
    <div class="modal fade" id="addTagModal" tabindex="-1" aria-labelledby="addTagLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTagLabel">Add New Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addTagForm">
                        <div class="mb-3">
                            <label for="tagName" class="form-label">Tag Name *</label>
                            <input type="text" class="form-control" id="tagName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="tagSlug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="tagSlug" name="slug" placeholder="auto-generated">
                        </div>
                        <div class="alert d-none" id="tagMessage"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="addNewTag()">Add Tag</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Application JavaScript -->
    <script>
        // Global variables
        let variantIndex = 0;
        const MAX_IMAGE_SIZE = 20 * 1024 * 1024;   // 20 MB
        const MAX_VIDEO_SIZE = 100 * 1024 * 1024;  // 100 MB
        const ALLOWED_IMAGE_TYPES = ['image/jpeg', 'image/png', 'image/webp'];
        const ALLOWED_VIDEO_TYPES = ['video/mp4', 'video/webm'];

        // DOM Ready
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize selected tags display
            updateSelectedTagsDisplay();
            
            // Attach event listeners to tag checkboxes
            document.querySelectorAll('.tag-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', updateSelectedTagsDisplay);
            });
            
            // Setup discard button
            document.getElementById('discardBtn').addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to discard all changes?')) {
                    e.preventDefault();
                    return;
                }
                
                // Clear all custom fields
                document.getElementById('variant_container').innerHTML = '';
                variantIndex = 0;
                toggleMainProductFields(false);
                updateSelectedTagsDisplay();
                
                // Reset TinyMCE editor if exists
                if (typeof tinymce !== 'undefined' && tinymce.get(0)) {
                    tinymce.get(0).setContent('');
                }
                
                // Reset form
                document.getElementById('productForm').reset();
            });
            
            // Auto clear error on input
            document.addEventListener('input', function(e) {
                if (e.target.classList.contains('is-invalid')) {
                    clearError(e.target);
                }
            });
            
            // File validation
            document.addEventListener("change", function(e) {
                const input = e.target;
                
                if (input.type !== "file") return;
                const isThumbnailInput = input.name.includes("thumbnail");
                const isImageInput = input.name.includes("images");
                const isVideoInput = input.name.includes("videos");
                
                if (!isImageInput && !isVideoInput && !isThumbnailInput) return;
                
                for (const file of input.files) {

                    // File type validation
                    if (isThumbnailInput && !validateFileType(file, ALLOWED_IMAGE_TYPES)) {
                        alert(`❌ "${file.name}" is not a valid image format. Allowed: JPG, PNG, WebP`);
                        input.value = "";
                        return;
                    }
                    
                    if (isImageInput && !validateFileType(file, ALLOWED_IMAGE_TYPES)) {
                        alert(`❌ "${file.name}" is not a valid image format. Allowed: JPG, PNG, WebP`);
                        input.value = "";
                        return;
                    }
                    
                    if (isVideoInput && !validateFileType(file, ALLOWED_VIDEO_TYPES)) {
                        alert(`❌ "${file.name}" is not a valid video format. Allowed: MP4, WebM`);
                        input.value = "";
                        return;
                    }
                    
                    // File size validation
                    if (isThumbnailInput && file.size > 2 * 1024 * 1024) {
                        alert(`❌ Thumbnail image "${file.name}" exceeds 2 MB.\nPlease upload a smaller image.`);
                        input.value = "";
                        return;
                    }
                    if (isImageInput && file.size > MAX_IMAGE_SIZE) {
                        alert(`❌ Image "${file.name}" exceeds 20 MB.\nPlease upload a smaller image.`);
                        input.value = "";
                        return;
                    }
                    
                    if (isVideoInput && file.size > MAX_VIDEO_SIZE) {
                        alert(`❌ Video "${file.name}" exceeds 100 MB.\nPlease upload a smaller video.`);
                        input.value = "";
                        return;
                    }
                }
            });
            
            // Form submission validation
            document.getElementById('productForm').addEventListener('submit', function(e) {
                let valid = true;
                
                // Clear previous errors
                document.querySelectorAll('.is-invalid').forEach(el => {
                    clearError(el);
                });
                
                // Product name validation
                const name = document.getElementById('productName');
                if (!name.value.trim()) {
                    showError(name, 'Product name is required');
                    valid = false;
                }
                
                // Check variants exist
                const variants = document.querySelectorAll('.variant-item');
                
                if (variants.length === 0) {
                    // Main product validation when no variants
                    const price = document.getElementById('regularPrice');
                    const qty = document.getElementById('stockQuantity');
                    
                    if (!price.value || price.value <= 0) {
                        showError(price, 'Valid price is required');
                        valid = false;
                    }
                    
                    if (!qty.value || qty.value < 0) {
                        showError(qty, 'Stock quantity is required');
                        valid = false;
                    }
                }
                
                // Variant validation
                variants.forEach(variant => {
                    const vName = variant.querySelector('[name*="[variant_name]"]');
                    const vPrice = variant.querySelector('[name*="[price]"]');
                    const vQty = variant.querySelector('[name*="[quantity]"]');
                    
                    if (!vName.value.trim()) {
                        showError(vName, 'Variant name required');
                        valid = false;
                    }
                    
                    if (!vPrice.value || vPrice.value <= 0) {
                        showError(vPrice, 'Variant price required');
                        valid = false;
                    }
                    
                    if (!vQty.value || vQty.value < 0) {
                        showError(vQty, 'Variant quantity required');
                        valid = false;
                    }
                });
                
                // Category validation
                const category = document.getElementById('category_select');
                if (!category.value) {
                    showError(category, 'Please select a category');
                    valid = false;
                }
                
                // Brand validation
                const brand = document.getElementById('brand_select');
                if (!brand.value) {
                    showError(brand, 'Please select a brand');
                    valid = false;
                }
                
                // Currency validation
                const currency = document.getElementById('currencySelect');
                if (!currency.value) {
                    showError(currency, 'Please select a currency');
                    valid = false;
                }
                
                if (!valid) {
                    e.preventDefault();
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            });
        });
        
        // Helper Functions
        function validateFileType(file, allowedTypes) {
            const fileType = file.type;
            return allowedTypes.some(type => fileType.startsWith(type));
        }
        
        function showError(input, message) {
            clearError(input);
            input.classList.add('is-invalid');
            
            const error = document.createElement('div');
            error.className = 'error-text';
            error.innerText = message;
            
            input.parentNode.appendChild(error);
        }
        
        function clearError(input) {
            input.classList.remove('is-invalid');
            const err = input.parentNode.querySelector('.error-text');
            if (err) err.remove();
        }
        
        function showMessage(element, text, type) {
            element.classList.remove('d-none', 'alert-success', 'alert-danger', 'alert-info');
            element.classList.add(`alert-${type}`);
            element.textContent = text;
        }
        
        // Variant Management Functions
        function Add_new_variant() {
            const container = document.getElementById("variant_container");
            
            // Disable main product fields when variants exist
            toggleMainProductFields(true);
            
            const newVariant = document.createElement("div");
            newVariant.className = "variant-item mb-4 p-3 border border-translucent rounded-3 position-relative";
            newVariant.setAttribute("data-index", variantIndex);
            
            newVariant.innerHTML = `
                <button type="button"
                    class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2"
                    onclick="removeVariant(this)"
                    title="Remove variant">
                    ✕
                </button>
                
                <h5 class="mb-3 text-body-highlight">
                    Variant #${variantIndex + 1}
                </h5>
                
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Variant Name *</label>
                        <input type="text"
                            name="variants[${variantIndex}][variant_name]"
                            class="form-control variant-name"
                            placeholder="e.g. Red / XL"
                            required>
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label">SKU</label>
                        <input type="text"
                            name="variants[${variantIndex}][sku]"
                            class="form-control"
                            placeholder="Auto-generated if empty">
                    </div>
                    
                    <div class="col-md-2">
                        <label class="form-label">Price *</label>
                        <input type="number"
                            step="0.01"
                            min="0.01"
                            name="variants[${variantIndex}][price]"
                            class="form-control variant-price"
                            required>
                    </div>
                    
                    <div class="col-md-2">
                        <label class="form-label">Quantity *</label>
                        <input type="number"
                            min="0"
                            name="variants[${variantIndex}][quantity]"
                            class="form-control variant-quantity"
                            required>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Variant Images</label>
                        <input type="file"
                            name="variants[${variantIndex}][images][]"
                            class="form-control"
                            accept="image/jpeg,image/png,image/webp"
                            multiple>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Variant Videos</label>
                        <input type="file"
                            name="variants[${variantIndex}][videos][]"
                            class="form-control"
                            accept="video/mp4,video/webm"
                            multiple>
                    </div>
                </div>
            `;
            
            container.appendChild(newVariant);
            variantIndex++;
        }
        
        function removeVariant(button) {
            const variantItem = button.closest(".variant-item");
            variantItem.remove();
            
            // If no variants left, re-enable main product fields
            if (document.querySelectorAll(".variant-item").length === 0) {
                toggleMainProductFields(false);
            }
        }
        
        function toggleMainProductFields(disable) {
            const fields = [
                'input[name="price"]',
                'input[name="discount_price"]',
                'input[name="stock_quantity"]',
                'input[name="sku"]'
            ];
            
            fields.forEach(selector => {
                const el = document.querySelector(selector);
                if (el) {
                    el.disabled = disable;
                    if (disable) {
                        el.removeAttribute('required');
                    } else {
                        el.setAttribute('required', 'required');
                    }
                }
            });
        }
        
        // Tag Management Functions
        function updateSelectedTagsDisplay() {
            const checkboxes = document.querySelectorAll('.tag-checkbox:checked');
            const display = document.getElementById('selected_tags_display');
            display.innerHTML = '';
            
            if (checkboxes.length === 0) {
                display.innerHTML = '<span class="text-muted">No tags selected</span>';
                return;
            }
            
            checkboxes.forEach(checkbox => {
                const tagName = checkbox.getAttribute('data-tag-name');
                const tagBadge = document.createElement('span');
                tagBadge.className = 'badge bg-primary selected-tag-badge';
                tagBadge.textContent = tagName;
                display.appendChild(tagBadge);
            });
        }
        
        // AJAX Functions
        function addNewCategory() {
            const form = document.getElementById('addCategoryForm');
            const name = document.getElementById('categoryName').value.trim();
            const slug = document.getElementById('categorySlug').value.trim() || 
                         name.toLowerCase().replace(/\s+/g, '-').replace(/[^\w-]/g, '');
            const messageEl = document.getElementById('categoryMessage');
            
            if (!name) {
                showMessage(messageEl, 'Please enter category name', 'danger');
                return;
            }
            
            fetch('{{ route('seller.categories.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ name, slug })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Add to select
                    const select = document.getElementById('category_select');
                    const option = new Option(data.category.name, data.category.id, false, true);
                    select.appendChild(option);
                    select.value = data.category.id;
                    
                    // Show success message
                    showMessage(messageEl, 'Category added successfully!', 'success');
                    
                    // Reset form and close modal after delay
                    setTimeout(() => {
                        form.reset();
                        messageEl.classList.add('d-none');
                        const modal = bootstrap.Modal.getInstance(document.getElementById('addCategoryModal'));
                        modal.hide();
                    }, 1500);
                } else {
                    throw new Error(data.message || 'Unknown error');
                }
            })
            .catch(error => {
                showMessage(messageEl, `Error: ${error.message}`, 'danger');
            });
        }
        
        function addNewBrand() {
            const form = document.getElementById('addBrandForm');
            const name = document.getElementById('brandName').value.trim();
            const brand_id = document.getElementById('brandId').value.trim();
            const messageEl = document.getElementById('brandMessage');
            
            if (!name || !brand_id) {
                showMessage(messageEl, 'Please fill all required fields', 'danger');
                return;
            }
            
            fetch('{{ route('seller.brands.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ name, brand_id })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Add to select
                    const select = document.getElementById('brand_select');
                    const option = new Option(data.brand.name, data.brand.id, false, true);
                    select.appendChild(option);
                    select.value = data.brand.id;
                    
                    // Show success message
                    showMessage(messageEl, 'Brand added successfully!', 'success');
                    
                    // Reset form and close modal after delay
                    setTimeout(() => {
                        form.reset();
                        messageEl.classList.add('d-none');
                        const modal = bootstrap.Modal.getInstance(document.getElementById('addBrandModal'));
                        modal.hide();
                    }, 1500);
                } else {
                    throw new Error(data.message || 'Unknown error');
                }
            })
            .catch(error => {
                showMessage(messageEl, `Error: ${error.message}`, 'danger');
            });
        }
        
        function addNewTag() {
            const form = document.getElementById('addTagForm');
            const name = document.getElementById('tagName').value.trim();
            const slug = document.getElementById('tagSlug').value.trim() || 
                         name.toLowerCase().replace(/\s+/g, '-').replace(/[^\w-]/g, '');
            const messageEl = document.getElementById('tagMessage');
            
            if (!name) {
                showMessage(messageEl, 'Please enter tag name', 'danger');
                return;
            }
            
            fetch('{{ route('seller.tags.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ name, slug })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Add to dropdown
                    const dropdown = document.getElementById('tags_dropdown');
                    const tagId = data.tag.id;
                    const tagName = data.tag.name;
                    
                    const checkboxHTML = `
                        <div class="px-3 py-2">
                            <div class="form-check">
                                <input class="form-check-input tag-checkbox" type="checkbox" id="tag_${tagId}" name="tags[]" value="${tagId}" data-tag-name="${tagName}" checked>
                                <label class="form-check-label" for="tag_${tagId}">${tagName}</label>
                            </div>
                        </div>
                    `;
                    dropdown.insertAdjacentHTML('beforeend', checkboxHTML);
                    
                    // Add event listener to new checkbox
                    const newCheckbox = document.getElementById(`tag_${tagId}`);
                    newCheckbox.addEventListener('change', updateSelectedTagsDisplay);
                    updateSelectedTagsDisplay();
                    
                    // Show success message
                    showMessage(messageEl, 'Tag added successfully!', 'success');
                    
                    // Reset form and close modal after delay
                    setTimeout(() => {
                        form.reset();
                        messageEl.classList.add('d-none');
                        const modal = bootstrap.Modal.getInstance(document.getElementById('addTagModal'));
                        modal.hide();
                    }, 1500);
                } else {
                    throw new Error(data.message || 'Unknown error');
                }
            })
            .catch(error => {
                showMessage(messageEl, `Error: ${error.message}`, 'danger');
            });
        }
    </script>

</body>

</html>