{{-- resources/views/seller/addproduct.blade.php --}}
@php $seller = Auth::guard('seller')->user(); @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Add Product — SellerHub</title>
    @include('seller.partials._base')
    <style>
        /* ── Page Layout ── */
        .ap-grid {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 20px;
            align-items: start;
        }
        @media (max-width: 1100px) { .ap-grid { grid-template-columns: 1fr; } }

        /* ── Section Cards ── */
        .ap-section {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-bottom: 20px;
            overflow: hidden;
            animation: shFadeUp .35s ease both;
        }
        .ap-section-header {
            padding: 16px 22px;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; gap: 10px;
        }
        .ap-section-icon {
            width: 30px; height: 30px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; flex-shrink: 0;
        }
        .ap-section-title { font-size: 14px; font-weight: 700; color: var(--text); }
        .ap-section-body { padding: 22px; }

        /* ── Form Fields ── */
        .ap-field { margin-bottom: 18px; }
        .ap-field:last-child { margin-bottom: 0; }

        /* Inline 2-col grid */
        .ap-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .ap-row-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; }
        @media(max-width:640px) { .ap-row-2, .ap-row-3 { grid-template-columns: 1fr; } }

        /* Character counter */
        .sh-input-wrap { position: relative; }
        .sh-char-count { position: absolute; right: 10px; top: 50%; transform: translateY(-50%); font-size: 11px; color: var(--sub); pointer-events: none; }

        /* Textarea */
        .sh-textarea { resize: vertical; min-height: 120px; }

        /* ── File Upload Zone ── */
        .ap-upload {
            border: 2px dashed var(--border2);
            border-radius: 10px; padding: 28px 20px;
            text-align: center; cursor: pointer;
            transition: all .2s; background: var(--bg);
            position: relative;
        }
        .ap-upload:hover, .ap-upload.drag-over {
            border-color: var(--accent);
            background: var(--accent-bg);
        }
        .ap-upload input[type=file] {
            position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
        }
        .ap-upload-icon { font-size: 28px; margin-bottom: 8px; }
        .ap-upload-label { font-size: 13.5px; font-weight: 600; color: var(--text2); }
        .ap-upload-hint  { font-size: 11.5px; color: var(--sub); margin-top: 4px; }
        .ap-upload-preview { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 12px; }
        .ap-preview-thumb {
            width: 72px; height: 72px; border-radius: 8px; object-fit: cover;
            border: 1px solid var(--border); background: var(--muted);
        }

        /* ── Variants ── */
        .variant-card {
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 10px; padding: 18px;
            margin-bottom: 14px; position: relative;
            animation: shFadeUp .25s ease;
        }
        .variant-card-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 14px;
        }
        .variant-num {
            font-size: 12px; font-weight: 700; text-transform: uppercase;
            letter-spacing: .6px; color: var(--accent);
            background: var(--accent-bg); padding: 3px 10px; border-radius: 20px;
        }
        .variant-remove {
            width: 26px; height: 26px; border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            border: 1px solid rgba(244,63,94,.2); background: var(--danger-bg);
            color: var(--danger); font-size: 12px; cursor: pointer;
            transition: all .15s;
        }
        .variant-remove:hover { background: var(--danger); color: #fff; }

        /* Disabled fields */
        .sh-input:disabled, .sh-select:disabled {
            background: var(--muted); color: var(--sub); cursor: not-allowed; opacity: .7;
        }

        /* ── Tags ── */
        .tags-dropdown-wrap { position: relative; }
        .tags-panel {
            position: absolute; top: calc(100% + 4px); left: 0; right: 0; z-index: 50;
            background: var(--surface); border: 1px solid var(--border);
            border-radius: 10px; box-shadow: var(--shadow-lg);
            max-height: 220px; overflow-y: auto; display: none;
        }
        .tags-panel.open { display: block; }
        .tag-option {
            display: flex; align-items: center; gap: 8px;
            padding: 9px 14px; cursor: pointer; font-size: 13px;
            transition: background .12s;
        }
        .tag-option:hover { background: var(--bg); }
        .tag-option input[type=checkbox] { width: 14px; height: 14px; accent-color: var(--accent); cursor: pointer; }
        .tags-selected { display: flex; flex-wrap: wrap; gap: 6px; margin-top: 10px; min-height: 26px; }
        .tag-chip {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 3px 10px; border-radius: 20px;
            background: var(--accent-bg); color: var(--accent);
            border: 1px solid rgba(91,124,250,.2);
            font-size: 12px; font-weight: 600;
        }
        .tag-chip-remove {
            width: 14px; height: 14px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 10px; cursor: pointer; color: var(--accent);
            background: rgba(91,124,250,.15); transition: all .12s;
        }
        .tag-chip-remove:hover { background: var(--accent); color: #fff; }

        /* ── Toggle (checkbox) ── */
        .sh-toggle-row {
            display: flex; align-items: center; justify-content: space-between;
            padding: 10px 0; border-bottom: 1px solid var(--border);
        }
        .sh-toggle-row:last-child { border-bottom: none; padding-bottom: 0; }
        .sh-toggle-label { font-size: 13.5px; font-weight: 500; color: var(--text2); }
        .sh-toggle-sub { font-size: 11.5px; color: var(--sub); margin-top: 1px; }
        /* Native checkbox toggle style */
        .sh-switch {
            position: relative; width: 40px; height: 22px; flex-shrink: 0;
        }
        .sh-switch input { opacity: 0; width: 0; height: 0; }
        .sh-switch-track {
            position: absolute; inset: 0; border-radius: 99px;
            background: var(--border2); cursor: pointer; transition: background .2s;
        }
        .sh-switch input:checked + .sh-switch-track { background: var(--accent); }
        .sh-switch-track::before {
            content: ''; position: absolute;
            width: 16px; height: 16px; left: 3px; bottom: 3px;
            border-radius: 50%; background: #fff;
            transition: transform .2s; box-shadow: 0 1px 3px rgba(0,0,0,.2);
        }
        .sh-switch input:checked + .sh-switch-track::before { transform: translateX(18px); }

        /* ── Validation ── */
        .sh-input.is-invalid, .sh-select.is-invalid, .sh-textarea.is-invalid {
            border-color: var(--danger) !important;
            box-shadow: 0 0 0 3px rgba(244,63,94,.10) !important;
        }
        .sh-error-text {
            font-size: 11.5px; color: var(--danger);
            margin-top: 4px; display: flex; align-items: center; gap: 4px;
        }

        /* ── Modal ── */
        .sh-modal-overlay {
            position: fixed; inset: 0; background: rgba(26,29,40,.45);
            z-index: 500; display: none; align-items: center; justify-content: center;
            padding: 20px; backdrop-filter: blur(2px);
        }
        .sh-modal-overlay.open { display: flex; }
        .sh-modal {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: var(--radius); box-shadow: var(--shadow-lg);
            width: 100%; max-width: 460px;
            animation: shFadeUp .2s ease;
        }
        .sh-modal-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 18px 22px; border-bottom: 1px solid var(--border);
        }
        .sh-modal-title { font-size: 15px; font-weight: 700; color: var(--text); }
        .sh-modal-close {
            width: 30px; height: 30px; border-radius: 7px;
            border: 1px solid var(--border); background: var(--bg);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: var(--sub); font-size: 16px; transition: all .15s;
        }
        .sh-modal-close:hover { background: var(--danger-bg); color: var(--danger); border-color: var(--danger); }
        .sh-modal-body { padding: 22px; display: flex; flex-direction: column; gap: 14px; }
        .sh-modal-footer { padding: 16px 22px; border-top: 1px solid var(--border); display: flex; gap: 8px; justify-content: flex-end; }
        .sh-modal-alert {
            padding: 10px 14px; border-radius: 8px; font-size: 13px; font-weight: 500;
            display: none;
        }
        .sh-modal-alert.success { background: var(--accent2-bg); border: 1px solid rgba(34,196,122,.25); color: #14a05a; display: block; }
        .sh-modal-alert.error   { background: var(--danger-bg); border: 1px solid rgba(244,63,94,.25); color: var(--danger); display: block; }

        /* Flash errors */
        .sh-errors-box {
            background: var(--danger-bg); border: 1px solid rgba(244,63,94,.25);
            border-radius: 10px; padding: 14px 18px; margin-bottom: 20px;
        }
        .sh-errors-box ul { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 4px; }
        .sh-errors-box li { font-size: 13px; color: var(--danger); display: flex; align-items: flex-start; gap: 6px; }
        .sh-errors-box li::before { content: '•'; flex-shrink: 0; margin-top: 1px; }

        /* Sticky top bar on scroll */
        .ap-sticky-bar {
            position: sticky; top: var(--header-h); z-index: 50;
            background: var(--surface); border-bottom: 1px solid var(--border);
            margin: -28px -28px 28px;
            padding: 14px 28px;
            display: flex; align-items: center; justify-content: space-between;
            gap: 12px; flex-wrap: wrap;
            box-shadow: 0 2px 8px rgba(0,0,0,.04);
        }

        /* SEO char counters */
        .ap-seo-bar {
            height: 4px; border-radius: 99px; background: var(--border);
            margin-top: 6px; overflow: hidden;
        }
        .ap-seo-fill { height: 100%; border-radius: 99px; transition: width .3s; background: var(--accent2); }
        .ap-seo-fill.warn { background: var(--accent3); }
        .ap-seo-fill.over { background: var(--danger); }

        .ap-section:nth-child(1){animation-delay:.05s}
        .ap-section:nth-child(2){animation-delay:.10s}
        .ap-section:nth-child(3){animation-delay:.15s}
        .ap-section:nth-child(4){animation-delay:.20s}
    </style>
</head>
<body>
<div class="sh-layout">

    @include('seller.partials._sidebar', ['active' => 'products'])

    <header class="sh-header">
        <div class="sh-header-left">
            <div>
                <div class="sh-header-title">Add Product</div>
                <div class="sh-header-sub">Create a new listing</div>
            </div>
        </div>
        <div class="sh-header-right">
            <a href="{{ route('seller.orders.index') }}" class="sh-icon-btn">🛒 <span class="sh-notif-dot">3</span></a>
            <a href="#" class="sh-icon-btn">🔔</a>
            <form method="POST" action="{{ route('seller.logout') }}" style="display:inline">
                @csrf <button type="submit" class="sh-icon-btn" title="Logout">↩</button>
            </form>
        </div>
    </header>

    <main class="sh-main">

        {{-- Validation Errors --}}
        @if($errors->any())
        <div class="sh-errors-box">
            <div style="font-size:13px; font-weight:700; color:var(--danger); margin-bottom:8px; display:flex; align-items:center; gap:6px;">
                ❌ Please fix the following errors:
            </div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
            @csrf

            {{-- Sticky Action Bar --}}
            <div class="ap-sticky-bar">
                <div>
                    <div class="sh-breadcrumb" style="margin:0;">
                        <a href="{{ route('seller.products.index') }}">Products</a>
                        <span class="sep">/</span>
                        <span class="current">Add New</span>
                    </div>
                </div>
                <div style="display:flex; gap:8px;">
                    <button type="button" id="discardBtn" class="sh-btn sh-btn-secondary">
                        Discard
                    </button>
                    <button type="submit" class="sh-btn sh-btn-primary">
                        <i class="fas fa-cloud-upload-alt"></i> Publish Product
                    </button>
                </div>
            </div>

            <div class="ap-grid">

                {{-- ══════════════════════════ LEFT COLUMN ══════════════════════════ --}}
                <div>

                    {{-- Product Title & Description --}}
                    <div class="ap-section">
                        <div class="ap-section-header">
                            <div class="ap-section-icon" style="background:var(--accent-bg);">📝</div>
                            <div class="ap-section-title">Basic Information</div>
                        </div>
                        <div class="ap-section-body">
                            <div class="ap-field">
                                <label class="sh-label">Product Title <span style="color:var(--danger)">*</span></label>
                                <input type="text" name="name" id="productName" class="sh-input"
                                    placeholder="e.g. Premium Wireless Headphones Pro"
                                    value="{{ old('name') }}" required maxlength="200">
                            </div>
                            <div class="ap-field">
                                <label class="sh-label">Product Description</label>
                                <textarea name="description" id="productDescription" class="sh-input sh-textarea"
                                    placeholder="Write a detailed description of your product, features, specifications...">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Media --}}
                    <div class="ap-section">
                        <div class="ap-section-header">
                            <div class="ap-section-icon" style="background:var(--accent3-bg);">🖼️</div>
                            <div class="ap-section-title">Media</div>
                        </div>
                        <div class="ap-section-body">

                            {{-- Thumbnail --}}
                            <div class="ap-field">
                                <label class="sh-label">Thumbnail <span style="color:var(--danger)">*</span></label>
                                <div class="ap-upload" id="thumbnailZone">
                                    <input type="file" name="thumbnail" id="thumbnailInput" accept="image/jpeg,image/png,image/webp"
                                        onchange="handleSinglePreview(this,'thumbnailPreview','thumbnailZone')">
                                    <div class="ap-upload-icon">🖼️</div>
                                    <div class="ap-upload-label">Click to upload thumbnail</div>
                                    <div class="ap-upload-hint">JPG, PNG or WebP · max 2 MB</div>
                                </div>
                                <div id="thumbnailPreview" class="ap-upload-preview"></div>
                            </div>

                            {{-- Display Images --}}
                            <div class="ap-field">
                                <label class="sh-label">Display Images</label>
                                <div class="ap-upload" id="imagesZone">
                                    <input type="file" name="images[]" id="imagesInput" accept="image/jpeg,image/png,image/webp"
                                        multiple onchange="handleMultiPreview(this,'imagesPreview')">
                                    <div class="ap-upload-icon">📷</div>
                                    <div class="ap-upload-label">Click or drag images here</div>
                                    <div class="ap-upload-hint">JPG, PNG or WebP · up to 20 MB each · multiple allowed</div>
                                </div>
                                <div id="imagesPreview" class="ap-upload-preview"></div>
                            </div>

                            {{-- Videos --}}
                            <div class="ap-field" style="margin-bottom:0;">
                                <label class="sh-label">Product Videos</label>
                                <div class="ap-upload" id="videosZone">
                                    <input type="file" name="videos[]" id="videosInput" accept="video/mp4,video/webm"
                                        multiple onchange="handleVideoPreview(this,'videosPreview')">
                                    <div class="ap-upload-icon">🎬</div>
                                    <div class="ap-upload-label">Click to upload videos</div>
                                    <div class="ap-upload-hint">MP4 or WebM · up to 100 MB each</div>
                                </div>
                                <div id="videosPreview" style="margin-top:10px; display:flex; flex-direction:column; gap:6px;"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Inventory --}}
                    <div class="ap-section">
                        <div class="ap-section-header">
                            <div class="ap-section-icon" style="background:var(--accent2-bg);">📊</div>
                            <div class="ap-section-title">Inventory & Pricing</div>
                            <span style="font-size:11.5px; color:var(--sub); margin-left:auto;" id="inventoryHint">
                                Disabled when variants are added
                            </span>
                        </div>
                        <div class="ap-section-body">
                            <div class="ap-row-2">
                                <div class="ap-field">
                                    <label class="sh-label">Regular Price <span style="color:var(--danger)">*</span></label>
                                    <div style="position:relative;">
                                        <span style="position:absolute;left:11px;top:50%;transform:translateY(-50%);font-size:13px;color:var(--sub);pointer-events:none;">₹</span>
                                        <input type="number" step="0.01" min="0" name="price" id="regularPrice"
                                            class="sh-input" style="padding-left:26px;" placeholder="0.00"
                                            value="{{ old('price') }}" required>
                                    </div>
                                </div>
                                <div class="ap-field">
                                    <label class="sh-label">Sale Price <span style="color:var(--sub); font-size:10px;">(optional)</span></label>
                                    <div style="position:relative;">
                                        <span style="position:absolute;left:11px;top:50%;transform:translateY(-50%);font-size:13px;color:var(--sub);pointer-events:none;">₹</span>
                                        <input type="number" step="0.01" min="0" name="discount_price" id="salePrice"
                                            class="sh-input" style="padding-left:26px;" placeholder="0.00"
                                            value="{{ old('discount_price') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="ap-row-3">
                                <div class="ap-field">
                                    <label class="sh-label">Stock Quantity <span style="color:var(--danger)">*</span></label>
                                    <input type="number" min="0" name="stock_quantity" id="stockQuantity"
                                        class="sh-input" placeholder="0"
                                        value="{{ old('stock_quantity') }}" required>
                                </div>
                                <div class="ap-field">
                                    <label class="sh-label">SKU</label>
                                    <input type="text" name="sku" id="productSku"
                                        class="sh-input" placeholder="Auto-generated"
                                        value="{{ old('sku') }}">
                                </div>
                                <div class="ap-field">
                                    <label class="sh-label">Weight (kg)</label>
                                    <input type="number" step="0.0001" min="0" name="weight" id="productWeight"
                                        class="sh-input" placeholder="0.000"
                                        value="{{ old('weight') }}">
                                </div>
                            </div>
                            <div class="ap-field" style="margin-bottom:0;">
                                <label class="sh-label">Currency</label>
                                <select name="currency" id="currencySelect" class="sh-select">
                                    <option value="" disabled selected>Select currency…</option>
                                    @foreach(['USD','EUR','GBP','JPY','AUD','CAD','CHF','CNY','INR','BRL','PKR'] as $cur)
                                        <option value="{{ $cur }}" {{ old('currency') == $cur ? 'selected' : '' }}>{{ $cur }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Variants --}}
                    <div class="ap-section">
                        <div class="ap-section-header">
                            <div class="ap-section-icon" style="background:var(--info-bg);">🎨</div>
                            <div class="ap-section-title">Product Variants</div>
                            <span style="font-size:11.5px; color:var(--sub); margin-left:4px;" id="variantCount">0 variants</span>
                        </div>
                        <div class="ap-section-body">
                            <div id="variant_container"></div>
                            <button type="button" class="sh-btn sh-btn-secondary" onclick="addVariant()"
                                style="margin-top:4px; border-style:dashed; color:var(--accent); border-color:rgba(91,124,250,.3); background:var(--accent-bg);">
                                <i class="fas fa-plus" style="font-size:11px;"></i> Add Variant
                            </button>
                            <div style="margin-top:12px; padding:10px 14px; background:var(--bg); border-radius:8px; border:1px solid var(--border); font-size:12px; color:var(--sub);">
                                💡 When variants are added, the main price and stock fields are disabled. The product price will be set to the lowest variant price automatically.
                            </div>
                        </div>
                    </div>

                </div>

                {{-- ══════════════════════════ RIGHT SIDEBAR ══════════════════════════ --}}
                <div>

                    {{-- Organize --}}
                    <div class="ap-section">
                        <div class="ap-section-header">
                            <div class="ap-section-icon" style="background:var(--accent-bg);">🗂️</div>
                            <div class="ap-section-title">Organize</div>
                        </div>
                        <div class="ap-section-body">

                            {{-- Category --}}
                            <div class="ap-field">
                                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:5px;">
                                    <label class="sh-label" style="margin:0;">Category <span style="color:var(--danger)">*</span></label>
                                    <button type="button" class="sh-btn sh-btn-secondary sh-btn-xs"
                                        onclick="openModal('categoryModal')">
                                        <i class="fas fa-plus" style="font-size:9px;"></i> New
                                    </button>
                                </div>
                                <select name="category_id" id="category_select" class="sh-select" required>
                                    <option value="" disabled selected>Select category…</option>
                                    @foreach($categories ?? [] as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Brand --}}
                            <div class="ap-field">
                                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:5px;">
                                    <label class="sh-label" style="margin:0;">Brand <span style="color:var(--danger)">*</span></label>
                                    <button type="button" class="sh-btn sh-btn-secondary sh-btn-xs"
                                        onclick="openModal('brandModal')">
                                        <i class="fas fa-plus" style="font-size:9px;"></i> New
                                    </button>
                                </div>
                                <select name="brand_id" id="brand_select" class="sh-select" required>
                                    <option value="" disabled selected>Select brand…</option>
                                    @foreach($brands ?? [] as $brand)
                                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Tags --}}
                            <div class="ap-field" style="margin-bottom:0;">
                                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:5px;">
                                    <label class="sh-label" style="margin:0;">Tags</label>
                                    <button type="button" class="sh-btn sh-btn-secondary sh-btn-xs"
                                        onclick="openModal('tagModal')">
                                        <i class="fas fa-plus" style="font-size:9px;"></i> New
                                    </button>
                                </div>
                                <div class="tags-dropdown-wrap">
                                    <button type="button" class="sh-input" style="text-align:left; cursor:pointer; display:flex; align-items:center; gap:6px; color:var(--sub);"
                                        onclick="toggleTagsPanel()">
                                        <i class="fas fa-tags" style="font-size:12px;"></i>
                                        <span id="tagsBtn">Select tags…</span>
                                        <i class="fas fa-chevron-down" style="margin-left:auto; font-size:10px;"></i>
                                    </button>
                                    <div id="tagsPanel" class="tags-panel">
                                        @foreach($tags ?? [] as $tag)
                                        <label class="tag-option">
                                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                                data-tag-name="{{ $tag->name }}"
                                                class="tag-checkbox" onchange="updateTagsDisplay()">
                                            {{ $tag->name }}
                                        </label>
                                        @endforeach
                                        @if(empty($tags) || count($tags) === 0)
                                        <div style="padding:12px 14px; color:var(--sub); font-size:12.5px; text-align:center;">
                                            No tags yet — add one above
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div id="tagsSelected" class="tags-selected">
                                    <span style="font-size:12px; color:var(--sub);">No tags selected</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SEO --}}
                    <div class="ap-section">
                        <div class="ap-section-header">
                            <div class="ap-section-icon" style="background:var(--accent3-bg);">🔍</div>
                            <div class="ap-section-title">SEO Meta Tags</div>
                        </div>
                        <div class="ap-section-body">
                            <div class="ap-field">
                                <label class="sh-label">Meta Title</label>
                                <input type="text" name="meta_title" id="metaTitle" class="sh-input"
                                    placeholder="Page title for search engines…"
                                    maxlength="80" oninput="updateSeoBar('metaTitleBar',this.value.length,50,60,80)"
                                    value="{{ old('meta_title') }}">
                                <div class="ap-seo-bar"><div class="ap-seo-fill" id="metaTitleBar" style="width:0%;"></div></div>
                                <div style="display:flex; justify-content:space-between; margin-top:3px;">
                                    <span style="font-size:11px; color:var(--sub);">Recommended: 50–60 chars</span>
                                    <span style="font-size:11px; color:var(--sub);" id="metaTitleCount">0/80</span>
                                </div>
                            </div>
                            <div class="ap-field">
                                <label class="sh-label">Meta Keywords</label>
                                <input type="text" name="meta_keywords" class="sh-input"
                                    placeholder="smartphone, mobile, android…"
                                    value="{{ old('meta_keywords') }}">
                                <div style="font-size:11px; color:var(--sub); margin-top:4px;">Comma-separated</div>
                            </div>
                            <div class="ap-field" style="margin-bottom:0;">
                                <label class="sh-label">Meta Description</label>
                                <textarea name="meta_description" id="metaDesc" class="sh-input sh-textarea"
                                    style="min-height:80px;" rows="3"
                                    placeholder="Brief description for search engines…"
                                    maxlength="200" oninput="updateSeoBar('metaDescBar',this.value.length,150,160,200)">{{ old('meta_description') }}</textarea>
                                <div class="ap-seo-bar"><div class="ap-seo-fill" id="metaDescBar" style="width:0%;"></div></div>
                                <div style="display:flex; justify-content:space-between; margin-top:3px;">
                                    <span style="font-size:11px; color:var(--sub);">Recommended: 150–160 chars</span>
                                    <span style="font-size:11px; color:var(--sub);" id="metaDescCount">0/200</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Status Flags --}}
                    <div class="ap-section">
                        <div class="ap-section-header">
                            <div class="ap-section-icon" style="background:var(--accent2-bg);">⚙️</div>
                            <div class="ap-section-title">Product Status</div>
                        </div>
                        <div class="ap-section-body">
                            @foreach([
                                ['is_active',    '1', 'Active',       'Product is visible to customers',   true],
                                ['can_purchase', '1', 'Can Purchase',  'Allow customers to buy this item',  false],
                                ['refundable',   '1', 'Refundable',    'Allow refund requests',             false],
                                ['is_flash_sale','1', 'Flash Sale',    'Show in flash sale section',        false],
                            ] as [$name, $val, $label, $sub, $checked])
                            <div class="sh-toggle-row">
                                <div>
                                    <div class="sh-toggle-label">{{ $label }}</div>
                                    <div class="sh-toggle-sub">{{ $sub }}</div>
                                </div>
                                <label class="sh-switch">
                                    <input type="checkbox" name="{{ $name }}" value="{{ $val }}"
                                        {{ old($name, $checked ? '1' : '') == '1' ? 'checked' : '' }}>
                                    <span class="sh-switch-track"></span>
                                </label>
                            </div>
                            @endforeach

                            <div class="ap-field" style="margin-top:14px; margin-bottom:0;">
                                <label class="sh-label">Affiliate %</label>
                                <div style="position:relative;">
                                    <input type="number" name="affiliate_percentage" class="sh-input"
                                        placeholder="10" min="0" max="100" step="0.1"
                                        style="padding-right:30px;" value="{{ old('affiliate_percentage', 10) }}">
                                    <span style="position:absolute; right:11px; top:50%; transform:translateY(-50%); font-size:13px; color:var(--sub); pointer-events:none;">%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </main>
</div>

{{-- ═══════════════════════════ MODALS ═══════════════════════════ --}}

{{-- Category Modal --}}
<div class="sh-modal-overlay" id="categoryModal">
    <div class="sh-modal">
        <div class="sh-modal-header">
            <div class="sh-modal-title">🗂️ Add New Category</div>
            <button class="sh-modal-close" onclick="closeModal('categoryModal')">✕</button>
        </div>
        <div class="sh-modal-body">
            <div class="ap-field">
                <label class="sh-label">Category Name <span style="color:var(--danger)">*</span></label>
                <input type="text" id="categoryName" class="sh-input" placeholder="e.g. Electronics">
            </div>
            <div class="ap-field">
                <label class="sh-label">Slug <span style="font-size:10px; color:var(--sub);">(auto-generated)</span></label>
                <input type="text" id="categorySlug" class="sh-input" placeholder="electronics">
            </div>
            <div id="categoryAlert" class="sh-modal-alert"></div>
        </div>
        <div class="sh-modal-footer">
            <button class="sh-btn sh-btn-secondary" onclick="closeModal('categoryModal')">Cancel</button>
            <button class="sh-btn sh-btn-primary" onclick="addNewCategory()">
                <i class="fas fa-plus"></i> Add Category
            </button>
        </div>
    </div>
</div>

{{-- Brand Modal --}}
<div class="sh-modal-overlay" id="brandModal">
    <div class="sh-modal">
        <div class="sh-modal-header">
            <div class="sh-modal-title">🏷️ Add New Brand</div>
            <button class="sh-modal-close" onclick="closeModal('brandModal')">✕</button>
        </div>
        <div class="sh-modal-body">
            <div class="ap-field">
                <label class="sh-label">Brand Name <span style="color:var(--danger)">*</span></label>
                <input type="text" id="brandName" class="sh-input" placeholder="e.g. Apple">
            </div>
            <div class="ap-field">
                <label class="sh-label">Brand ID <span style="color:var(--danger)">*</span></label>
                <input type="text" id="brandId" class="sh-input" placeholder="e.g. APPLE001">
            </div>
            <div id="brandAlert" class="sh-modal-alert"></div>
        </div>
        <div class="sh-modal-footer">
            <button class="sh-btn sh-btn-secondary" onclick="closeModal('brandModal')">Cancel</button>
            <button class="sh-btn sh-btn-primary" onclick="addNewBrand()">
                <i class="fas fa-plus"></i> Add Brand
            </button>
        </div>
    </div>
</div>

{{-- Tag Modal --}}
<div class="sh-modal-overlay" id="tagModal">
    <div class="sh-modal">
        <div class="sh-modal-header">
            <div class="sh-modal-title">🔖 Add New Tag</div>
            <button class="sh-modal-close" onclick="closeModal('tagModal')">✕</button>
        </div>
        <div class="sh-modal-body">
            <div class="ap-field">
                <label class="sh-label">Tag Name <span style="color:var(--danger)">*</span></label>
                <input type="text" id="tagName" class="sh-input" placeholder="e.g. wireless">
            </div>
            <div class="ap-field">
                <label class="sh-label">Slug <span style="font-size:10px; color:var(--sub);">(auto-generated)</span></label>
                <input type="text" id="tagSlug" class="sh-input" placeholder="wireless">
            </div>
            <div id="tagAlert" class="sh-modal-alert"></div>
        </div>
        <div class="sh-modal-footer">
            <button class="sh-btn sh-btn-secondary" onclick="closeModal('tagModal')">Cancel</button>
            <button class="sh-btn sh-btn-primary" onclick="addNewTag()">
                <i class="fas fa-plus"></i> Add Tag
            </button>
        </div>
    </div>
</div>

<div class="sh-toast-container" id="toastContainer"></div>

<script>
/* ══════════════════════════════════════════════════════
   VARIANTS
══════════════════════════════════════════════════════ */
let variantIndex = 0;

function addVariant() {
    const container = document.getElementById('variant_container');
    toggleInventoryFields(true);

    const el = document.createElement('div');
    el.className = 'variant-card';
    el.dataset.index = variantIndex;
    el.innerHTML = `
        <div class="variant-card-header">
            <span class="variant-num">Variant #${variantIndex + 1}</span>
            <button type="button" class="variant-remove" onclick="removeVariant(this)" title="Remove">✕</button>
        </div>
        <div class="ap-row-2" style="margin-bottom:12px;">
            <div>
                <label class="sh-label">Variant Name <span style="color:var(--danger)">*</span></label>
                <input type="text" name="variants[${variantIndex}][variant_name]"
                    class="sh-input" placeholder="e.g. Red / XL" required>
            </div>
            <div>
                <label class="sh-label">SKU</label>
                <input type="text" name="variants[${variantIndex}][sku]"
                    class="sh-input" placeholder="Auto-generated">
            </div>
        </div>
        <div class="ap-row-2" style="margin-bottom:12px;">
            <div>
                <label class="sh-label">Price <span style="color:var(--danger)">*</span></label>
                <div style="position:relative;">
                    <span style="position:absolute;left:11px;top:50%;transform:translateY(-50%);font-size:13px;color:var(--sub);pointer-events:none;">₹</span>
                    <input type="number" step="0.01" min="0.01" name="variants[${variantIndex}][price]"
                        class="sh-input" style="padding-left:26px;" placeholder="0.00" required>
                </div>
            </div>
            <div>
                <label class="sh-label">Quantity <span style="color:var(--danger)">*</span></label>
                <input type="number" min="0" name="variants[${variantIndex}][quantity]"
                    class="sh-input" placeholder="0" required>
            </div>
        </div>
        <div class="ap-row-2">
            <div>
                <label class="sh-label">Variant Images</label>
                <div class="ap-upload" style="padding:16px;">
                    <input type="file" name="variants[${variantIndex}][images][]"
                        accept="image/jpeg,image/png,image/webp" multiple>
                    <div style="font-size:12px; color:var(--sub);">📷 Upload images</div>
                </div>
            </div>
            <div>
                <label class="sh-label">Variant Videos</label>
                <div class="ap-upload" style="padding:16px;">
                    <input type="file" name="variants[${variantIndex}][videos][]"
                        accept="video/mp4,video/webm" multiple>
                    <div style="font-size:12px; color:var(--sub);">🎬 Upload videos</div>
                </div>
            </div>
        </div>
    `;
    container.appendChild(el);
    variantIndex++;
    updateVariantCount();
}

function removeVariant(btn) {
    btn.closest('.variant-card').remove();
    if (document.querySelectorAll('.variant-card').length === 0) {
        toggleInventoryFields(false);
    }
    updateVariantCount();
}

function updateVariantCount() {
    const n = document.querySelectorAll('.variant-card').length;
    document.getElementById('variantCount').textContent = n + ' variant' + (n !== 1 ? 's' : '');
}

function toggleInventoryFields(disable) {
    ['regularPrice','salePrice','stockQuantity','productSku'].forEach(id => {
        const el = document.getElementById(id);
        if (!el) return;
        el.disabled = disable;
        if (disable) { el.removeAttribute('required'); el.value = ''; }
        else el.setAttribute('required', '');
    });
    document.getElementById('inventoryHint').style.color = disable ? 'var(--accent3)' : 'var(--sub)';
}

/* ══════════════════════════════════════════════════════
   FILE PREVIEWS
══════════════════════════════════════════════════════ */
const MAX_IMG = 20 * 1024 * 1024;
const MAX_VID = 100 * 1024 * 1024;
const MAX_THUMB = 2 * 1024 * 1024;
const IMG_TYPES = ['image/jpeg','image/png','image/webp'];
const VID_TYPES = ['video/mp4','video/webm'];

function handleSinglePreview(input, previewId, zoneId) {
    const file = input.files[0];
    if (!file) return;
    if (!IMG_TYPES.includes(file.type)) { showToast('Only JPG, PNG, WebP allowed', 'error'); input.value = ''; return; }
    if (file.size > MAX_THUMB) { showToast('Thumbnail must be under 2 MB', 'error'); input.value = ''; return; }
    const reader = new FileReader();
    reader.onload = e => {
        const preview = document.getElementById(previewId);
        preview.innerHTML = `<img src="${e.target.result}" class="ap-preview-thumb" alt="Thumbnail">`;
        document.getElementById(zoneId).style.borderStyle = 'solid';
        document.getElementById(zoneId).style.borderColor = 'var(--accent2)';
    };
    reader.readAsDataURL(file);
}

function handleMultiPreview(input, previewId) {
    const files = Array.from(input.files);
    const preview = document.getElementById(previewId);
    files.forEach(file => {
        if (!IMG_TYPES.includes(file.type)) { showToast(`"${file.name}" invalid type`, 'error'); return; }
        if (file.size > MAX_IMG) { showToast(`"${file.name}" exceeds 20 MB`, 'error'); return; }
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'ap-preview-thumb';
            preview.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
}

function handleVideoPreview(input, previewId) {
    const files = Array.from(input.files);
    const preview = document.getElementById(previewId);
    files.forEach(file => {
        if (!VID_TYPES.includes(file.type)) { showToast(`"${file.name}" invalid type`, 'error'); return; }
        if (file.size > MAX_VID) { showToast(`"${file.name}" exceeds 100 MB`, 'error'); return; }
        const item = document.createElement('div');
        item.style.cssText = 'display:flex;align-items:center;gap:8px;padding:8px 12px;background:var(--bg);border:1px solid var(--border);border-radius:8px;font-size:12.5px;';
        item.innerHTML = `<span>🎬</span><span style="flex:1;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">${file.name}</span><span style="color:var(--sub);white-space:nowrap;">${(file.size/1024/1024).toFixed(1)} MB</span>`;
        preview.appendChild(item);
    });
}

/* Drag-over styles */
document.querySelectorAll('.ap-upload').forEach(zone => {
    zone.addEventListener('dragover', e => { e.preventDefault(); zone.classList.add('drag-over'); });
    zone.addEventListener('dragleave', () => zone.classList.remove('drag-over'));
    zone.addEventListener('drop', () => zone.classList.remove('drag-over'));
});

/* ══════════════════════════════════════════════════════
   TAGS
══════════════════════════════════════════════════════ */
function toggleTagsPanel() {
    document.getElementById('tagsPanel').classList.toggle('open');
}
document.addEventListener('click', e => {
    if (!e.target.closest('.tags-dropdown-wrap')) {
        document.getElementById('tagsPanel')?.classList.remove('open');
    }
});
function updateTagsDisplay() {
    const checked = document.querySelectorAll('.tag-checkbox:checked');
    const display = document.getElementById('tagsSelected');
    if (checked.length === 0) {
        display.innerHTML = '<span style="font-size:12px; color:var(--sub);">No tags selected</span>';
        document.getElementById('tagsBtn').textContent = 'Select tags…';
        return;
    }
    document.getElementById('tagsBtn').textContent = checked.length + ' tag' + (checked.length > 1 ? 's' : '') + ' selected';
    display.innerHTML = '';
    checked.forEach(cb => {
        const chip = document.createElement('span');
        chip.className = 'tag-chip';
        chip.innerHTML = `${cb.dataset.tagName}<span class="tag-chip-remove" onclick="removeTag('${cb.id}')">✕</span>`;
        display.appendChild(chip);
    });
}
function removeTag(id) {
    const cb = document.getElementById(id);
    if (cb) { cb.checked = false; updateTagsDisplay(); }
}

/* ══════════════════════════════════════════════════════
   SEO BARS
══════════════════════════════════════════════════════ */
function updateSeoBar(barId, len, min, max, total) {
    const bar = document.getElementById(barId);
    const pct = Math.min(100, (len / total) * 100);
    bar.style.width = pct + '%';
    bar.className = 'ap-seo-fill ' + (len > max ? 'over' : len >= min ? '' : 'warn');
    const countId = barId === 'metaTitleBar' ? 'metaTitleCount' : 'metaDescCount';
    document.getElementById(countId).textContent = len + '/' + total;
}

/* ══════════════════════════════════════════════════════
   MODALS
══════════════════════════════════════════════════════ */
function openModal(id)  { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }
document.querySelectorAll('.sh-modal-overlay').forEach(m => {
    m.addEventListener('click', e => { if (e.target === m) m.classList.remove('open'); });
});

function showModalAlert(id, msg, type) {
    const el = document.getElementById(id);
    el.textContent = msg;
    el.className = 'sh-modal-alert ' + type;
}

/* ── Add Category ── */
async function addNewCategory() {
    const name = document.getElementById('categoryName').value.trim();
    const slug = document.getElementById('categorySlug').value.trim() || name.toLowerCase().replace(/\s+/g,'-').replace(/[^\w-]/g,'');
    if (!name) { showModalAlert('categoryAlert','Category name is required','error'); return; }
    try {
        const res = await fetch('{{ route("seller.categories.store") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken(), 'Accept': 'application/json' },
            body: JSON.stringify({ name, slug })
        });
        const data = await res.json();
        if (data.success) {
            const sel = document.getElementById('category_select');
            sel.appendChild(new Option(data.category.name, data.category.id, true, true));
            showModalAlert('categoryAlert', '✅ Category added!', 'success');
            setTimeout(() => { document.getElementById('categoryName').value = ''; document.getElementById('categorySlug').value = ''; closeModal('categoryModal'); showToast('Category created', 'success'); }, 1200);
        } else { showModalAlert('categoryAlert', data.message || 'Error adding category', 'error'); }
    } catch { showModalAlert('categoryAlert', 'Network error', 'error'); }
}

/* ── Add Brand ── */
async function addNewBrand() {
    const name = document.getElementById('brandName').value.trim();
    const brand_id = document.getElementById('brandId').value.trim();
    if (!name || !brand_id) { showModalAlert('brandAlert','Both fields are required','error'); return; }
    try {
        const res = await fetch('{{ route("seller.brands.store") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken(), 'Accept': 'application/json' },
            body: JSON.stringify({ name, brand_id })
        });
        const data = await res.json();
        if (data.success) {
            const sel = document.getElementById('brand_select');
            sel.appendChild(new Option(data.brand.name, data.brand.id, true, true));
            showModalAlert('brandAlert', '✅ Brand added!', 'success');
            setTimeout(() => { document.getElementById('brandName').value = ''; document.getElementById('brandId').value = ''; closeModal('brandModal'); showToast('Brand created', 'success'); }, 1200);
        } else { showModalAlert('brandAlert', data.message || 'Error adding brand', 'error'); }
    } catch { showModalAlert('brandAlert', 'Network error', 'error'); }
}

/* ── Add Tag ── */
async function addNewTag() {
    const name = document.getElementById('tagName').value.trim();
    const slug = document.getElementById('tagSlug').value.trim() || name.toLowerCase().replace(/\s+/g,'-').replace(/[^\w-]/g,'');
    if (!name) { showModalAlert('tagAlert','Tag name is required','error'); return; }
    try {
        const res = await fetch('{{ route("seller.tags.store") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken(), 'Accept': 'application/json' },
            body: JSON.stringify({ name, slug })
        });
        const data = await res.json();
        if (data.success) {
            // Add to panel
            const panel = document.getElementById('tagsPanel');
            const label = document.createElement('label');
            label.className = 'tag-option';
            label.innerHTML = `<input type="checkbox" name="tags[]" value="${data.tag.id}" data-tag-name="${data.tag.name}" class="tag-checkbox" id="tag_${data.tag.id}" checked onchange="updateTagsDisplay()"> ${data.tag.name}`;
            panel.appendChild(label);
            updateTagsDisplay();
            showModalAlert('tagAlert', '✅ Tag added!', 'success');
            setTimeout(() => { document.getElementById('tagName').value = ''; document.getElementById('tagSlug').value = ''; closeModal('tagModal'); showToast('Tag created', 'success'); }, 1200);
        } else { showModalAlert('tagAlert', data.message || 'Error adding tag', 'error'); }
    } catch { showModalAlert('tagAlert', 'Network error', 'error'); }
}

/* ══════════════════════════════════════════════════════
   FORM VALIDATION
══════════════════════════════════════════════════════ */
document.getElementById('productForm').addEventListener('submit', function(e) {
    let valid = true;
    document.querySelectorAll('.is-invalid').forEach(el => clearError(el));

    const name = document.getElementById('productName');
    if (!name.value.trim()) { showError(name,'Product name is required'); valid = false; }

    const variants = document.querySelectorAll('.variant-card');
    if (variants.length === 0) {
        const price = document.getElementById('regularPrice');
        const qty   = document.getElementById('stockQuantity');
        if (!price.disabled && (!price.value || parseFloat(price.value) <= 0)) { showError(price,'Valid price is required'); valid = false; }
        if (!qty.disabled && (!qty.value || parseInt(qty.value) < 0)) { showError(qty,'Stock quantity is required'); valid = false; }
    } else {
        variants.forEach(v => {
            const vn = v.querySelector('[name*="[variant_name]"]');
            const vp = v.querySelector('[name*="[price]"]');
            const vq = v.querySelector('[name*="[quantity]"]');
            if (!vn.value.trim()) { showError(vn,'Variant name required'); valid = false; }
            if (!vp.value || parseFloat(vp.value) <= 0) { showError(vp,'Price required'); valid = false; }
            if (vq.value === '' || parseInt(vq.value) < 0) { showError(vq,'Quantity required'); valid = false; }
        });
    }

    const cat = document.getElementById('category_select');
    if (!cat.value) { showError(cat,'Please select a category'); valid = false; }
    const brd = document.getElementById('brand_select');
    if (!brd.value) { showError(brd,'Please select a brand'); valid = false; }

    if (!valid) { e.preventDefault(); window.scrollTo({ top: 0, behavior: 'smooth' }); showToast('Please fix the errors above', 'error'); }
});

/* ── Discard button ── */
document.getElementById('discardBtn').addEventListener('click', () => {
    if (confirm('Discard all changes and reset the form?')) {
        document.getElementById('productForm').reset();
        document.getElementById('variant_container').innerHTML = '';
        variantIndex = 0; updateVariantCount();
        toggleInventoryFields(false);
        ['thumbnailPreview','imagesPreview'].forEach(id => { const el = document.getElementById(id); if(el) el.innerHTML=''; });
        const vp = document.getElementById('videosPreview'); if(vp) vp.innerHTML = '';
        updateTagsDisplay();
        showToast('Form reset', 'info');
    }
});

/* ── Helpers ── */
function showError(input, msg) {
    input.classList.add('is-invalid');
    let err = input.parentNode.querySelector('.sh-error-text');
    if (!err) { err = document.createElement('div'); err.className = 'sh-error-text'; input.parentNode.appendChild(err); }
    err.innerHTML = `<i class="fas fa-exclamation-circle" style="font-size:10px;"></i> ${msg}`;
}
function clearError(input) {
    input.classList.remove('is-invalid');
    const e = input.parentNode.querySelector('.sh-error-text');
    if (e) e.remove();
}
document.addEventListener('input', e => { if (e.target.classList.contains('is-invalid')) clearError(e.target); });

function csrfToken() {
    return document.querySelector('meta[name="csrf-token"]').content;
}

function showToast(msg, type = 'info') {
    const icons = { success:'✅', error:'❌', warning:'⚠️', info:'ℹ️' };
    const t = document.createElement('div');
    t.className = `sh-toast ${type}`;
    t.innerHTML = `<span>${icons[type]}</span><span>${msg}</span>`;
    document.getElementById('toastContainer').appendChild(t);
    setTimeout(() => t.remove(), 3500);
}

/* Auto-slug from category name input */
document.getElementById('categoryName')?.addEventListener('input', function() {
    document.getElementById('categorySlug').value = this.value.toLowerCase().replace(/\s+/g,'-').replace(/[^\w-]/g,'');
});
document.getElementById('tagName')?.addEventListener('input', function() {
    document.getElementById('tagSlug').value = this.value.toLowerCase().replace(/\s+/g,'-').replace(/[^\w-]/g,'');
});
</script>
</body>
</html>