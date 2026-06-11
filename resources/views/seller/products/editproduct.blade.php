{{-- resources/views/seller/products/editproduct.blade.php --}}
@php $seller = Auth::guard('seller')->user(); @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit — {{ $product->name }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    @include('seller.partials._base')
    <style>
        /* All existing CSS from your original editproduct.blade.php stays here */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --bg:        #f0f2f7;
            --surface:   #ffffff;
            --card:      #ffffff;
            --border:    #e4e7ef;
            --border2:   #d1d5e0;
            --muted:     #e8eaf0;
            --text:      #1a1d28;
            --sub:       #7a82a0;
            --accent:    #5b7cfa;
            --accent2:   #22c47a;
            --accent3:   #f59e0b;
            --danger:    #f43f5e;
            --purple:    #8b5cf6;
            --font:      'DM Sans', sans-serif;
            --mono:      'DM Mono', monospace;
            --radius:    14px;
            --sidebar-w: 240px;
            --header-h:  64px;
            --shadow:    0 1px 4px rgba(0,0,0,.06), 0 4px 16px rgba(0,0,0,.04);
            --shadow-md: 0 2px 8px rgba(0,0,0,.08), 0 8px 24px rgba(0,0,0,.06);
        }

        html, body { height: 100%; background: var(--bg); color: var(--text); font-family: var(--font); font-size: 14px; }

        /* LAYOUT */
        .layout { display: grid; grid-template-columns: var(--sidebar-w) 1fr; grid-template-rows: var(--header-h) 1fr; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar {
            grid-row: 1 / -1;
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex; flex-direction: column;
            position: sticky; top: 0; height: 100vh;
        }
        .sidebar-logo {
            height: var(--header-h);
            display: flex; align-items: center; gap: 10px;
            padding: 0 20px;
            border-bottom: 1px solid var(--border);
            font-weight: 700; font-size: 15px; letter-spacing: -.3px;
        }
        .sidebar-logo .logo-icon {
            width: 32px; height: 32px; border-radius: 8px;
            background: linear-gradient(135deg, var(--accent), #8b5cf6);
            display: flex; align-items: center; justify-content: center;
            font-size: 16px;
        }
        .sidebar-nav { flex: 1; padding: 16px 12px; display: flex; flex-direction: column; gap: 2px; overflow-y: auto; }
        .nav-section-label { font-size: 10px; font-weight: 700; letter-spacing: 1.2px; color: var(--sub); text-transform: uppercase; padding: 12px 8px 6px; }
        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 12px; border-radius: 9px;
            color: var(--sub); text-decoration: none; font-size: 13.5px; font-weight: 500;
            transition: all .15s;
        }
        .nav-item:hover { background: var(--bg); color: var(--text); }
        .nav-item.active { background: rgba(91,124,250,.10); color: var(--accent); }
        .nav-item .icon { width: 18px; text-align: center; font-size: 15px; }
        .sidebar-footer { padding: 16px 12px; border-top: 1px solid var(--border); }
        .seller-card {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px; border-radius: 10px;
            background: var(--bg); border: 1px solid var(--border);
        }
        .avatar {
            width: 34px; height: 34px; border-radius: 50%;
            background: linear-gradient(135deg, var(--accent2), var(--accent));
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 13px; color: #fff; flex-shrink: 0;
        }
        .seller-card .info { flex: 1; min-width: 0; }
        .seller-card .info .sname { font-size: 13px; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .seller-card .info .srole { font-size: 11px; color: var(--sub); }
        .status-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--accent2); flex-shrink: 0; box-shadow: 0 0 6px var(--accent2); }

        /* HEADER */
        .header {
            grid-column: 2;
            height: var(--header-h);
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 28px;
            position: sticky; top: 0; z-index: 10;
        }
        .breadcrumb { display: flex; align-items: center; gap: 6px; font-size: 13px; color: var(--sub); }
        .breadcrumb a { color: var(--sub); text-decoration: none; transition: color .15s; }
        .breadcrumb a:hover { color: var(--accent); }
        .breadcrumb .sep { opacity: .4; }
        .breadcrumb .current { color: var(--text); font-weight: 600; }
        .header-right { display: flex; align-items: center; gap: 10px; }

        /* BUTTONS */
        .btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 16px; border-radius: 9px;
            font-size: 13px; font-weight: 600;
            cursor: pointer; transition: all .15s;
            text-decoration: none; border: none;
        }
        .btn-primary {
            background: var(--accent); color: #fff;
            box-shadow: 0 2px 8px rgba(91,124,250,.3);
        }
        .btn-primary:hover { opacity: .88; transform: translateY(-1px); }
        .btn-ghost {
            background: var(--bg); color: var(--text);
            border: 1px solid var(--border);
        }
        .btn-ghost:hover { border-color: var(--border2); box-shadow: var(--shadow); }
        .btn-danger-ghost {
            background: rgba(244,63,94,.08); color: var(--danger);
            border: 1px solid rgba(244,63,94,.2);
        }
        .btn-danger-ghost:hover { background: rgba(244,63,94,.14); }
        .btn-sm { padding: 5px 12px; font-size: 12px; border-radius: 7px; }
        .btn-lg { padding: 11px 24px; font-size: 14px; }

        /* MAIN */
        .main { grid-column: 2; padding: 28px; overflow-y: auto; }

        /* FORM GRID */
        .form-grid { display: grid; grid-template-columns: 1fr 320px; gap: 20px; align-items: start; }

        /* CARD */
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-bottom: 18px;
            overflow: hidden;
            animation: fadeUp .35s ease both;
        }
        .card:nth-child(2) { animation-delay: .05s; }
        .card:nth-child(3) { animation-delay: .10s; }
        .card:nth-child(4) { animation-delay: .15s; }
        .card-header {
            display: flex; align-items: center; gap: 10px;
            padding: 16px 22px;
            border-bottom: 1px solid var(--border);
        }
        .card-header-icon { font-size: 16px; }
        .card-header-title { font-size: 13.5px; font-weight: 700; color: var(--text); }
        .card-header-badge {
            margin-left: auto; font-size: 11px; font-weight: 700;
            padding: 3px 8px; border-radius: 20px;
            background: var(--bg); color: var(--sub); border: 1px solid var(--border);
        }
        .card-body { padding: 22px; }

        /* FORM ELEMENTS */
        .field { margin-bottom: 18px; }
        .field:last-child { margin-bottom: 0; }
        .field-row { display: grid; gap: 16px; margin-bottom: 18px; }
        .field-row.cols-2 { grid-template-columns: 1fr 1fr; }
        .field-row.cols-3 { grid-template-columns: 1fr 1fr 1fr; }
        .field-row.cols-4 { grid-template-columns: 1fr 1fr 1fr 1fr; }
        .field-row.cols-3-1 { grid-template-columns: 3fr 1fr; }

        label.field-label {
            display: block; font-size: 11.5px; font-weight: 700;
            color: var(--sub); text-transform: uppercase; letter-spacing: .6px;
            margin-bottom: 7px;
        }
        .required { color: var(--danger); margin-left: 2px; }

        input[type="text"],
        input[type="number"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 9px 12px;
            border: 1.5px solid var(--border);
            border-radius: 9px;
            font-family: var(--font);
            font-size: 13.5px;
            color: var(--text);
            background: var(--surface);
            transition: border-color .15s, box-shadow .15s;
            outline: none;
            -webkit-appearance: none;
        }
        input:focus, select:focus, textarea:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(91,124,250,.12);
        }
        input.is-invalid, select.is-invalid, textarea.is-invalid {
            border-color: var(--danger);
        }
        input.is-invalid:focus, textarea.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(244,63,94,.12);
        }
        .invalid-msg { font-size: 11.5px; color: var(--danger); margin-top: 5px; font-weight: 500; }
        textarea { resize: vertical; min-height: 100px; line-height: 1.6; }
        select { cursor: pointer; }

        .input-addon {
            display: flex; align-items: stretch;
        }
        .input-addon .addon {
            display: flex; align-items: center; justify-content: center;
            padding: 0 12px;
            background: var(--bg);
            border: 1.5px solid var(--border);
            border-right: none;
            border-radius: 9px 0 0 9px;
            font-size: 13px; font-weight: 600; color: var(--sub);
            white-space: nowrap;
        }
        .input-addon .addon-right {
            border-left: none;
            border-right: 1.5px solid var(--border);
            border-radius: 0 9px 9px 0;
        }
        .input-addon input {
            border-radius: 0 9px 9px 0;
            border-left: none;
        }
        .input-addon input.has-right {
            border-radius: 0;
            border-left: none;
            border-right: none;
        }
        .field-hint { font-size: 11.5px; color: var(--sub); margin-top: 5px; }
        .char-counter { font-size: 11.5px; color: var(--sub); float: right; margin-top: 5px; }
        .char-counter.ok { color: var(--accent2); }
        .char-counter.warn { color: var(--accent3); }
        .char-counter.bad { color: var(--danger); }

        /* TOGGLE SWITCH */
        .toggle-row {
            display: flex; align-items: center; justify-content: space-between;
            padding: 13px 0;
            border-bottom: 1px solid var(--border);
        }
        .toggle-row:last-child { border-bottom: none; }
        .toggle-info { }
        .toggle-name { font-size: 13px; font-weight: 600; color: var(--text); display: flex; align-items: center; gap: 7px; }
        .toggle-desc { font-size: 11.5px; color: var(--sub); margin-top: 2px; }
        .toggle-switch { position: relative; flex-shrink: 0; }
        .toggle-switch input[type="checkbox"] { position: absolute; opacity: 0; width: 0; height: 0; }
        .toggle-track {
            display: block; width: 42px; height: 24px; border-radius: 20px;
            background: var(--border2); cursor: pointer;
            transition: background .2s;
            position: relative;
        }
        .toggle-track::after {
            content: ''; position: absolute;
            top: 3px; left: 3px;
            width: 18px; height: 18px; border-radius: 50%;
            background: #fff; transition: transform .2s;
            box-shadow: 0 1px 3px rgba(0,0,0,.2);
        }
        .toggle-switch input:checked + .toggle-track { background: var(--accent2); }
        .toggle-switch input:checked + .toggle-track::after { transform: translateX(18px); }

        /* UPLOAD BOX */
        .upload-box {
            border: 2px dashed var(--border2);
            border-radius: 12px;
            padding: 28px 20px;
            text-align: center;
            cursor: pointer;
            background: var(--bg);
            transition: all .2s;
            position: relative;
        }
        .upload-box:hover, .upload-box.drag-over {
            border-color: var(--accent);
            background: rgba(91,124,250,.04);
        }
        .upload-box input[type="file"] {
            position: absolute; inset: 0; opacity: 0;
            cursor: pointer; width: 100%; height: 100%;
        }
        .upload-box .upload-icon { font-size: 28px; margin-bottom: 10px; }
        .upload-box .upload-title { font-size: 13.5px; font-weight: 600; color: var(--text); margin-bottom: 4px; }
        .upload-box .upload-hint { font-size: 12px; color: var(--sub); }
        .upload-btn {
            display: inline-flex; align-items: center; gap: 5px;
            margin-top: 12px; padding: 7px 14px; border-radius: 8px;
            background: var(--surface); border: 1.5px solid var(--border);
            font-size: 12px; font-weight: 600; color: var(--text);
            transition: all .15s; cursor: pointer; pointer-events: none;
        }
        .upload-box:hover .upload-btn { border-color: var(--accent); color: var(--accent); }

        /* THUMBNAIL PREVIEW */
        .thumb-preview {
            position: relative; display: inline-block;
            margin-bottom: 14px;
        }
        .thumb-preview img {
            width: 120px; height: 120px; object-fit: cover;
            border-radius: 10px; border: 2px solid var(--border);
            display: block;
        }
        .thumb-preview .thumb-label {
            position: absolute; bottom: -8px; left: 50%; transform: translateX(-50%);
            font-size: 10px; font-weight: 700; background: var(--surface);
            padding: 2px 8px; border-radius: 20px; border: 1px solid var(--border);
            color: var(--sub); white-space: nowrap;
        }
        .thumb-new-preview img {
            width: 100%; max-height: 160px; object-fit: cover;
            border-radius: 10px; border: 2px solid var(--accent);
            margin-top: 12px;
        }

        /* GALLERY */
        .gallery-grid { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 16px; }
        .gallery-item {
            position: relative; width: 80px; height: 80px;
            border-radius: 9px; overflow: hidden;
            border: 1.5px solid var(--border);
            transition: transform .2s;
        }
        .gallery-item:hover { transform: scale(1.04); }
        .gallery-item img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .gallery-remove {
            position: absolute; top: 3px; right: 3px;
            width: 20px; height: 20px; border-radius: 50%;
            background: var(--danger); color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; cursor: pointer;
            border: 2px solid #fff;
            box-shadow: 0 1px 4px rgba(0,0,0,.2);
            transition: transform .15s;
        }
        .gallery-remove:hover { transform: scale(1.15); }

        /* VARIANTS */
        .variant-card {
            border: 1.5px solid var(--border);
            border-radius: 11px;
            padding: 18px;
            margin-bottom: 12px;
            background: var(--surface);
            transition: border-color .2s;
            position: relative;
        }
        .variant-card:hover { border-color: var(--accent); }
        .variant-card::before {
            content: '';
            position: absolute; left: 0; top: 12px; bottom: 12px;
            width: 3px; border-radius: 0 3px 3px 0;
            background: var(--accent);
            opacity: 0; transition: opacity .2s;
        }
        .variant-card:hover::before { opacity: 1; }
        .variant-head {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 14px; padding-bottom: 12px;
            border-bottom: 1px solid var(--border);
        }
        .variant-num {
            font-size: 12px; font-weight: 700; color: var(--sub);
            text-transform: uppercase; letter-spacing: .6px;
        }
        .variant-remove {
            width: 28px; height: 28px; border-radius: 7px;
            background: rgba(244,63,94,.08); border: 1px solid rgba(244,63,94,.2);
            color: var(--danger); display: flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: 14px; transition: all .15s;
        }
        .variant-remove:hover { background: rgba(244,63,94,.16); }
        .variant-images-preview { display: flex; flex-wrap: wrap; gap: 6px; margin-top: 8px; }
        .v-img-preview {
            position: relative; width: 56px; height: 56px;
            border-radius: 7px; overflow: hidden; border: 1px solid var(--border);
        }
        .v-img-preview img { width: 100%; height: 100%; object-fit: cover; }
        .v-img-remove {
            position: absolute; top: 2px; right: 2px;
            width: 16px; height: 16px; border-radius: 50%;
            background: var(--danger); color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: 9px; cursor: pointer; border: 1.5px solid #fff;
        }

        /* ADD VARIANT BTN */
        .add-variant-btn {
            width: 100%; padding: 14px;
            border: 2px dashed var(--border2);
            border-radius: 11px;
            background: transparent;
            color: var(--sub);
            font-family: var(--font);
            font-size: 13px; font-weight: 600;
            cursor: pointer;
            transition: all .2s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .add-variant-btn:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: rgba(91,124,250,.04);
        }

        /* SIZES */
        .size-item { margin-bottom: 0; }
        .remove-size-btn {
            width: 32px; height: 32px; border-radius: 7px;
            background: rgba(244,63,94,.08); border: 1px solid rgba(244,63,94,.2);
            color: var(--danger); display: flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: 14px; transition: all .15s;
        }
        .remove-size-btn:hover { background: rgba(244,63,94,.16); }

        /* ALERT */
        .alert {
            padding: 14px 18px; border-radius: 10px;
            font-size: 13px; margin-bottom: 20px;
            display: flex; align-items: flex-start; gap: 10px;
        }
        .alert-error {
            background: rgba(244,63,94,.07);
            border: 1px solid rgba(244,63,94,.2);
            color: #c0213a;
        }
        .alert ul { margin: 6px 0 0 18px; }
        .alert li { margin-top: 3px; }

        .empty-variants {
            padding: 20px; border-radius: 10px;
            background: rgba(91,124,250,.05);
            border: 1px solid rgba(91,124,250,.15);
            color: var(--sub); font-size: 13px; text-align: center;
        }

        input[readonly] {
            background: var(--muted);
            color: var(--sub);
            cursor: not-allowed;
        }

        .save-card { position: sticky; top: calc(var(--header-h) + 20px); }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .section-sep { border: none; border-top: 1px solid var(--border); margin: 20px 0; }
        .currency-sym { font-family: var(--mono); }
    </style>
</head>
<body>
<div class="layout">

    @include('seller.partials._sidebar', ['active' => 'products'])

    <header class="header">
        <div class="breadcrumb">
            <a href="{{ route('seller.dashboard') }}">Dashboard</a>
            <span class="sep">›</span>
            <a href="{{ route('seller.products.index') }}">Products</a>
            <span class="sep">›</span>
            <a href="{{ route('seller.products.show', $product->id) }}">{{ Str::limit($product->name, 28) }}</a>
            <span class="sep">›</span>
            <span class="current">Edit</span>
        </div>
        <div class="header-right">
            <a href="{{ route('seller.products.show', $product->id) }}" class="btn btn-ghost">← View Product</a>
            <button type="submit" form="productForm" class="btn btn-primary">✓ Save Changes</button>
        </div>
    </header>

    <main class="main">

        @if ($errors->any())
        <div class="alert alert-error">
            <span>⚠️</span>
            <div>
                <strong>Please fix the following errors:</strong>
                <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        </div>
        @endif

        <form method="POST" action="{{ route('seller.products.update', $product->id) }}"
              enctype="multipart/form-data" id="productForm">
            @csrf
            @method('PUT')
            <input type="hidden" name="removed_images" id="removed-images" value="[]">
            <input type="hidden" name="removed_variant_images" id="removed-variant-images" value="[]">

            <div class="form-grid">

                {{-- LEFT COLUMN --}}
                <div>

                    {{-- BASIC INFO CARD --}}
                    <div class="card">
                        <div class="card-header">
                            <span class="card-header-icon">📝</span>
                            <span class="card-header-title">Basic Information</span>
                        </div>
                        <div class="card-body">
                            <div class="field-row cols-3-1">
                                <div>
                                    <label class="field-label">Product Name <span class="required">*</span></label>
                                    <input type="text" name="name"
                                           value="{{ old('name', $product->name) }}"
                                           placeholder="e.g., Wireless Bluetooth Headphones"
                                           class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                                           required>
                                    @error('name')<div class="invalid-msg">{{ $message }}</div>@enderror
                                </div>
                                <div>
                                    <label class="field-label">SKU <span class="required">*</span></label>
                                    <input type="text" name="sku"
                                           value="{{ old('sku', $product->sku) }}"
                                           placeholder="PROD-001"
                                           class="{{ $errors->has('sku') ? 'is-invalid' : '' }} "
                                           style="font-family:var(--mono); font-size:13px;"
                                           required>
                                    @error('sku')<div class="invalid-msg">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="field">
                                <label class="field-label">Description</label>
                                <textarea name="description"
                                          id="descTextarea"
                                          rows="5"
                                          placeholder="Describe your product clearly and in detail…"
                                          class="{{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description', $product->description) }}</textarea>
                                @error('description')<div class="invalid-msg">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- VARIANTS CARD --}}
                    <div class="card">
                        <div class="card-header">
                            <span class="card-header-icon">🎛️</span>
                            <span class="card-header-title">Product Variants</span>
                            <span class="card-header-badge" id="variant-count-badge">{{ $product->variants->count() }} variants</span>
                        </div>
                        <div class="card-body">
                            <div id="variants-container">
                                @php $variantIndex = 0; @endphp
                                @forelse($product->variants as $variant)
                                <div class="variant-card" data-index="{{ $variantIndex }}">
                                    <input type="hidden" name="variants[{{ $variantIndex }}][id]" value="{{ $variant->id }}">
                                    <div class="variant-head">
                                        <span class="variant-num">Variant #{{ $loop->iteration }}</span>
                                        <button type="button" class="variant-remove remove-variant" title="Remove">✕</button>
                                    </div>
                                    <div class="field-row cols-2">
                                        <div>
                                            <label class="field-label">Variant Name <span class="required">*</span></label>
                                            <input type="text" class="variant-name"
                                                   name="variants[{{ $variantIndex }}][variant_name]"
                                                   value="{{ old('variants.'.$variantIndex.'.variant_name', $variant->variant_name) }}"
                                                   placeholder="e.g., Blue / Large" required>
                                        </div>
                                        <div>
                                            <label class="field-label">SKU <span class="required">*</span></label>
                                            <input type="text" class="variant-sku"
                                                   name="variants[{{ $variantIndex }}][sku]"
                                                   value="{{ old('variants.'.$variantIndex.'.sku', $variant->sku) }}"
                                                   style="font-family:var(--mono); font-size:12.5px;"
                                                   placeholder="VAR-001" required>
                                        </div>
                                    </div>
                                    <div class="field-row cols-3">
                                        <div>
                                            <label class="field-label">Price <span class="required">*</span></label>
                                            <div class="input-addon">
                                                <span class="addon currency-sym" id="varCurSym_{{ $variantIndex }}">{{ $product->currency === 'INR' ? '₹' : ($product->currency === 'EUR' ? '€' : '₦') }}</span>
                                                <input type="number" class="variant-price"
                                                       name="variants[{{ $variantIndex }}][price]"
                                                       value="{{ old('variants.'.$variantIndex.'.price', $variant->price) }}"
                                                       step="0.01" min="0" required>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="field-label">Stock Qty <span class="required">*</span></label>
                                            <input type="number" class="variant-quantity"
                                                   name="variants[{{ $variantIndex }}][quantity]"
                                                   value="{{ old('variants.'.$variantIndex.'.quantity', $variant->quantity) }}"
                                                   min="0" required>
                                        </div>
                                        <div>
                                            <label class="field-label">Images</label>
                                            <input type="file"
                                                   class="variant-images"
                                                   name="variants[{{ $variantIndex }}][images][]"
                                                   multiple accept="image/*"
                                                   style="font-size:12px; padding:6px 10px;">
                                        </div>
                                    </div>
                                    {{-- Existing variant images --}}
                                    @if($variant->images && count((array)$variant->images))
                                    <div class="variant-images-preview">
                                        @php
                                            $vImgs = is_array($variant->images) ? $variant->images : json_decode($variant->images, true);
                                        @endphp
                                        @foreach((array)$vImgs as $vImg)
                                        @if($vImg)
                                        <div class="v-img-preview">
                                            <img src="{{ asset('storage/'.$vImg) }}" alt="">
                                            <div class="v-img-remove"
                                                 onclick="removeVariantImage(this,'{{ $vImg }}',{{ $variantIndex }})">✕</div>
                                            <input type="hidden" name="variants[{{ $variantIndex }}][existing_images][]" value="{{ $vImg }}">
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                                @php $variantIndex++; @endphp
                                @empty
                                <div class="empty-variants" id="empty-variants-msg">
                                    🎛️ &nbsp;No variants yet. Click "Add Variant" to create one.
                                </div>
                                @endforelse
                            </div>

                            <button type="button" class="add-variant-btn" id="add-variant-btn">
                                + Add Variant
                            </button>
                        </div>
                    </div>

                    {{-- PRICING & INVENTORY CARD --}}
                    <div class="card">
                        <div class="card-header">
                            <span class="card-header-icon">💲</span>
                            <span class="card-header-title">Pricing & Inventory</span>
                        </div>
                        <div class="card-body">
                            <div class="field-row cols-4">
                                <div>
                                    <label class="field-label">Base Price <span class="required">*</span></label>
                                    <div class="input-addon">
                                        <span class="addon currency-sym" id="mainCurSym">{{ $product->currency === 'INR' ? '₹' : ($product->currency === 'EUR' ? '€' : '₦') }}</span>
                                        <input type="number" id="price" name="price" step="0.01" min="0"
                                               value="{{ old('price', $product->price) }}"
                                               class="{{ $errors->has('price') ? 'is-invalid' : '' }}" required>
                                    </div>
                                    <div class="field-hint">Auto-calculated from variants</div>
                                    @error('price')<div class="invalid-msg">{{ $message }}</div>@enderror
                                </div>
                                <div>
                                    <label class="field-label">Discount Price</label>
                                    <div class="input-addon">
                                        <span class="addon currency-sym">{{ $product->currency === 'INR' ? '₹' : ($product->currency === 'EUR' ? '€' : '₦') }}</span>
                                        <input type="number" name="discount_price" step="0.01" min="0"
                                               value="{{ old('discount_price', $product->discount_price) }}"
                                               class="{{ $errors->has('discount_price') ? 'is-invalid' : '' }}">
                                    </div>
                                    @error('discount_price')<div class="invalid-msg">{{ $message }}</div>@enderror
                                </div>
                                <div>
                                    <label class="field-label">Discount Type</label>
                                    <select name="discount_type" class="{{ $errors->has('discount_type') ? 'is-invalid' : '' }}">
                                        <option value="">None</option>
                                        <option value="flat" @selected(old('discount_type', $product->discount_type) === 'flat')>Flat Amount</option>
                                        <option value="percent" @selected(old('discount_type', $product->discount_type) === 'percent')>Percentage</option>
                                    </select>
                                    @error('discount_type')<div class="invalid-msg">{{ $message }}</div>@enderror
                                </div>
                                <div>
                                    <label class="field-label">Currency</label>
                                    <select name="currency" id="currencySelect" class="{{ $errors->has('currency') ? 'is-invalid' : '' }}">
                                        <option value="NGN" @selected(old('currency', $product->currency) === 'NGN')>NGN (₦)</option>
                                        <option value="USD" @selected(old('currency', $product->currency) === 'USD')>USD ($)</option>
                                        <option value="EUR" @selected(old('currency', $product->currency) === 'EUR')>EUR (€)</option>
                                        <option value="INR" @selected(old('currency', $product->currency) === 'INR')>INR (₹)</option>
                                        <option value="GBP" @selected(old('currency', $product->currency) === 'GBP')>GBP (£)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="field-row cols-3">
                                <div>
                                    <label class="field-label">Total Stock</label>
                                    <input type="number" id="stockQuantity" name="stock_quantity"
                                           value="{{ old('stock_quantity', $product->stock_quantity) }}" readonly>
                                    <div class="field-hint">Auto-summed from variants</div>
                                </div>
                                <div>
                                    <label class="field-label">Low Stock Alert</label>
                                    <input type="number" name="low_stock_quantity"
                                           value="{{ old('low_stock_quantity', $product->low_stock_quantity) }}"
                                           placeholder="e.g. 10">
                                    @error('low_stock_quantity')<div class="invalid-msg">{{ $message }}</div>@enderror
                                </div>
                                <div>
                                    <label class="field-label">Max Purchase Qty</label>
                                    <input type="number" name="maximum_purchase_quantity"
                                           value="{{ old('maximum_purchase_quantity', $product->maximum_purchase_quantity) }}"
                                           placeholder="e.g. 5">
                                    @error('maximum_purchase_quantity')<div class="invalid-msg">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div style="max-width:200px;">
                                <label class="field-label">Affiliate Commission %</label>
                                <div class="input-addon">
                                    <input type="number" name="affiliate_percentage" step="0.01" min="0" max="100"
                                           value="{{ old('affiliate_percentage', $product->affiliate_percentage ?? 10) }}"
                                           class="{{ $errors->has('affiliate_percentage') ? 'is-invalid' : '' }} has-right">
                                    <span class="addon addon-right">%</span>
                                </div>
                                <div class="field-hint">Commission for affiliates on each sale</div>
                                @error('affiliate_percentage')<div class="invalid-msg">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- MEDIA CARD --}}
                    <div class="card">
                        <div class="card-header">
                            <span class="card-header-icon">🖼️</span>
                            <span class="card-header-title">Product Media</span>
                        </div>
                        <div class="card-body">

                            {{-- Thumbnail --}}
                            <label class="field-label" style="margin-bottom:12px;">Thumbnail</label>
                            @if($product->thumbnail)
                            <div style="margin-bottom:14px;">
                                <div class="thumb-preview">
                                    <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="Current thumbnail" id="currentThumbImg">
                                    <span class="thumb-label">Current</span>
                                </div>
                            </div>
                            @endif
                            <div class="upload-box" id="thumbDropzone">
                                <input type="file" name="thumbnail" id="thumbnailInput" accept="image/*">
                                <div class="upload-icon">📸</div>
                                <div class="upload-title">Drop new thumbnail or click to browse</div>
                                <div class="upload-hint">Recommended 800×800px · JPG or PNG · Max 2 MB</div>
                                <div class="upload-btn">Choose File</div>
                            </div>
                            <div class="thumb-new-preview" id="thumbNewPreview" style="display:none;">
                                <img src="" id="thumbNewImg" alt="New thumbnail preview">
                            </div>
                            @error('thumbnail')<div class="invalid-msg" style="margin-top:6px;">{{ $message }}</div>@enderror

                            <hr class="section-sep">

                            {{-- Gallery --}}
                            <label class="field-label" style="margin-bottom:12px;">Gallery Images</label>
                            @php
                                $galleryImgs = is_array($product->images) ? $product->images : json_decode($product->images ?? '[]', true);
                            @endphp
                            @if(!empty($galleryImgs))
                            <div class="gallery-grid" id="galleryExisting">
                                @foreach($galleryImgs as $gImg)
                                @if($gImg)
                                <div class="gallery-item" data-path="{{ $gImg }}">
                                    <img src="{{ asset('storage/'.$gImg) }}" alt="">
                                    <div class="gallery-remove" onclick="removeGalleryImage(this,'{{ $gImg }}')">✕</div>
                                    <input type="hidden" name="existing_images[]" value="{{ $gImg }}" class="existing-img-input">
                                </div>
                                @endif
                                @endforeach
                            </div>
                            @endif
                            <div class="gallery-grid" id="galleryNewPreviews"></div>
                            <div class="upload-box" id="galleryDropzone">
                                <input type="file" name="images[]" id="galleryInput" multiple accept="image/*">
                                <div class="upload-icon">🏞️</div>
                                <div class="upload-title">Drop images or click to browse</div>
                                <div class="upload-hint">Up to 10 images · Max 5 MB each</div>
                                <div class="upload-btn">Select Images</div>
                            </div>
                            @error('images')<div class="invalid-msg" style="margin-top:6px;">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    {{-- SEO CARD --}}
                    <div class="card">
                        <div class="card-header">
                            <span class="card-header-icon">🔍</span>
                            <span class="card-header-title">SEO Information</span>
                        </div>
                        <div class="card-body">
                            <div class="field">
                                <label class="field-label">Meta Title</label>
                                <input type="text" name="meta_title" id="metaTitle"
                                       value="{{ old('meta_title', $product->meta_title) }}"
                                       placeholder="Optimised title for search engines"
                                       class="{{ $errors->has('meta_title') ? 'is-invalid' : '' }}"
                                       maxlength="70">
                                <span class="char-counter" id="metaTitleCount">0/60</span>
                                <div class="field-hint">Recommended: 50–60 characters</div>
                                @error('meta_title')<div class="invalid-msg">{{ $message }}</div>@enderror
                            </div>
                            <div class="field">
                                <label class="field-label">Meta Description</label>
                                <textarea name="meta_description" id="metaDesc" rows="3"
                                          placeholder="Brief description for search results…"
                                          maxlength="180"
                                          class="{{ $errors->has('meta_description') ? 'is-invalid' : '' }}">{{ old('meta_description', $product->meta_description) }}</textarea>
                                <span class="char-counter" id="metaDescCount">0/160</span>
                                <div class="field-hint">Recommended: 150–160 characters</div>
                                @error('meta_description')<div class="invalid-msg">{{ $message }}</div>@enderror
                            </div>
                            <div class="field">
                                <label class="field-label">Meta Keywords</label>
                                <input type="text" name="meta_keywords"
                                       value="{{ old('meta_keywords', $product->meta_keywords) }}"
                                       placeholder="keyword1, keyword2, keyword3"
                                       class="{{ $errors->has('meta_keywords') ? 'is-invalid' : '' }}">
                                <div class="field-hint">Separate keywords with commas</div>
                                @error('meta_keywords')<div class="invalid-msg">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                </div>

                {{-- RIGHT COLUMN --}}
                <div>

                    {{-- SAVE CARD --}}
                    <div class="card save-card">
                        <div class="card-body" style="display:flex; flex-direction:column; gap:10px;">
                            <button type="submit" form="productForm" class="btn btn-primary btn-lg" style="width:100%; justify-content:center;">
                                ✓ &nbsp;Save Changes
                            </button>
                            <a href="{{ route('seller.products.show', $product->id) }}" class="btn btn-ghost" style="width:100%; justify-content:center;">
                                ← &nbsp;Discard & Go Back
                            </a>
                        </div>
                    </div>

                    {{-- CATEGORY & BRAND CARD --}}
                    <div class="card">
                        <div class="card-header">
                            <span class="card-header-icon">🏷️</span>
                            <span class="card-header-title">Category & Brand</span>
                        </div>
                        <div class="card-body">
                            <div class="field">
                                <label class="field-label">Category</label>
                                <select name="category_id" class="{{ $errors->has('category_id') ? 'is-invalid' : '' }}">
                                    <option value="">Select Category</option>
                                    @foreach($categories ?? [] as $category)
                                    <option value="{{ $category->id }}" @selected($product->category_id == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('category_id')<div class="invalid-msg">{{ $message }}</div>@enderror
                            </div>
                            <div class="field">
                                <label class="field-label">Brand</label>
                                <select name="brand_id" class="{{ $errors->has('brand_id') ? 'is-invalid' : '' }}">
                                    <option value="">Select Brand</option>
                                    @foreach($brands ?? [] as $brand)
                                    <option value="{{ $brand->id }}" @selected($product->brand_id == $brand->id)>
                                        {{ $brand->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('brand_id')<div class="invalid-msg">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- STATUS FLAGS CARD --}}
                    <div class="card">
                        <div class="card-header">
                            <span class="card-header-icon">🚦</span>
                            <span class="card-header-title">Status Flags</span>
                        </div>
                        <div class="card-body" style="padding-top:4px; padding-bottom:4px;">
                            @php
                                $flags = [
                                    ['name'=>'is_active',    'label'=>'Product Active',  'desc'=>'Show on storefront',          'icon'=>'👁️', 'val'=>$product->is_active],
                                    ['name'=>'can_purchase', 'label'=>'Allow Purchases', 'desc'=>'Enable add-to-cart',           'icon'=>'🛒', 'val'=>$product->can_purchase],
                                    ['name'=>'refundable',   'label'=>'Refundable',      'desc'=>'Accept returns & refunds',     'icon'=>'↩️', 'val'=>$product->refundable],
                                    ['name'=>'is_flash_sale','label'=>'Flash Sale',      'desc'=>'Feature in promotions',        'icon'=>'⚡', 'val'=>$product->is_flash_sale],
                                ];
                            @endphp
                            @foreach($flags as $flag)
                            <div class="toggle-row">
                                <div class="toggle-info">
                                    <div class="toggle-name">{{ $flag['icon'] }} {{ $flag['label'] }}</div>
                                    <div class="toggle-desc">{{ $flag['desc'] }}</div>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" name="{{ $flag['name'] }}" value="1"
                                           @checked(old($flag['name'], $flag['val']))>
                                    <span class="toggle-track"></span>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- SIZES CARD --}}
                    <div class="card">
                        <div class="card-header">
                            <span class="card-header-icon">📏</span>
                            <span class="card-header-title">Sizes (Optional)</span>
                            <span class="card-header-badge" id="size-count-badge">{{ $product->sizes->count() }} sizes</span>
                        </div>
                        <div class="card-body">
                            <div id="sizes-container">
                                @forelse($product->sizes as $size)
                                <div class="size-item" data-index="{{ $loop->index }}">
                                    <div class="field-row cols-3-1" style="margin-bottom: 10px;">
                                        <div class="size-input-wrapper">
                                            <input type="text" name="sizes[]" value="{{ $size->size }}" class="size-input"
                                                   placeholder="e.g., S, M, L, XL, 38, 40" style="width: 100%;">
                                        </div>
                                        <div>
                                            <button type="button" class="remove-size-btn" style="margin-top: 7px;">✕</button>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="empty-sizes-msg" style="text-align: center; color: var(--sub); padding: 20px;">
                                    No sizes added. Add sizes below.
                                </div>
                                @endforelse
                            </div>
                            <button type="button" id="add-size-btn" class="add-variant-btn" style="margin-top: 12px;">
                                + Add Size
                            </button>
                            <div class="field-hint" style="margin-top: 8px;">Add sizes like S, M, L, XL, or numeric values.</div>
                        </div>
                    </div>

                    {{-- DIMENSIONS & WEIGHT CARD --}}
                    <div class="card">
                        <div class="card-header">
                            <span class="card-header-icon">📐</span>
                            <span class="card-header-title">Dimensions & Weight</span>
                        </div>
                        <div class="card-body">
                            <div class="field">
                                <label class="field-label">Weight</label>
                                <div class="input-addon">
                                    <input type="number" name="weight" step="0.01" min="0"
                                           value="{{ old('weight', $product->weight) }}"
                                           placeholder="0.00" class="has-right">
                                    <span class="addon addon-right">kg</span>
                                </div>
                                @error('weight')<div class="invalid-msg">{{ $message }}</div>@enderror
                            </div>
                            <div class="field-row cols-2">
                                <div>
                                    <label class="field-label">Length</label>
                                    <div class="input-addon">
                                        <input type="number" name="length" step="0.01" min="0"
                                               value="{{ old('length', $product->length) }}"
                                               placeholder="0.00" class="has-right">
                                        <span class="addon addon-right">cm</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="field-label">Width</label>
                                    <div class="input-addon">
                                        <input type="number" name="width" step="0.01" min="0"
                                               value="{{ old('width', $product->width) }}"
                                               placeholder="0.00" class="has-right">
                                        <span class="addon addon-right">cm</span>
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label class="field-label">Height</label>
                                <div class="input-addon">
                                    <input type="number" name="height" step="0.01" min="0"
                                           value="{{ old('height', $product->height) }}"
                                           placeholder="0.00" class="has-right">
                                    <span class="addon addon-right">cm</span>
                                </div>
                                @error('height')<div class="invalid-msg">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </form>
    </main>
</div>

<script>
// ===================== Existing JavaScript (unchanged except for sizes addition) =====================

// Currency
const currencySymbols = { NGN:'₦', USD:'$', EUR:'€', INR:'₹', GBP:'£' };
document.getElementById('currencySelect').addEventListener('change', function() {
    const sym = currencySymbols[this.value] || '₦';
    document.querySelectorAll('.currency-sym').forEach(el => el.textContent = sym);
});

// Thumbnail preview
document.getElementById('thumbnailInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('thumbNewImg').src = e.target.result;
        document.getElementById('thumbNewPreview').style.display = '';
    };
    reader.readAsDataURL(file);
});

// Gallery preview
document.getElementById('galleryInput').addEventListener('change', function(e) {
    const container = document.getElementById('galleryNewPreviews');
    container.innerHTML = '';
    Array.from(e.target.files).forEach((file, i) => {
        const reader = new FileReader();
        reader.onload = ev => {
            const el = document.createElement('div');
            el.className = 'gallery-item';
            el.innerHTML = `<img src="${ev.target.result}" alt="New ${i+1}">
                            <div class="gallery-remove" onclick="this.parentElement.remove()">✕</div>`;
            container.appendChild(el);
        };
        reader.readAsDataURL(file);
    });
});

function removeGalleryImage(btn, path) {
    const inp = document.getElementById('removed-images');
    const arr = JSON.parse(inp.value);
    arr.push(path);
    inp.value = JSON.stringify(arr);
    btn.closest('.gallery-item').remove();
}

function removeVariantImage(btn, path, idx) {
    const inp = document.getElementById('removed-variant-images');
    const arr = JSON.parse(inp.value);
    arr.push({ variant_index: idx, image: path });
    inp.value = JSON.stringify(arr);
    btn.closest('.v-img-preview').remove();
}

// Variant totals
function updateTotals() {
    const prices = Array.from(document.querySelectorAll('.variant-price'))
                        .map(i => parseFloat(i.value)).filter(v => !isNaN(v));
    const qtys   = Array.from(document.querySelectorAll('.variant-quantity'))
                        .map(i => parseInt(i.value) || 0);

    if (prices.length) document.getElementById('price').value = Math.min(...prices).toFixed(2);
    document.getElementById('stockQuantity').value = qtys.reduce((a,b)=>a+b, 0);

    const c = document.querySelectorAll('.variant-card').length;
    document.getElementById('variant-count-badge').textContent = c + (c===1?' variant':' variants');
}

// Variant events
function attachVariantEvents(card) {
    card.querySelector('.remove-variant').addEventListener('click', function() {
        if (!confirm('Remove this variant?')) return;
        card.remove();
        renumberVariants();
        updateTotals();
        if (!document.querySelectorAll('.variant-card').length) {
            document.getElementById('variants-container').insertAdjacentHTML('afterbegin',
                '<div class="empty-variants" id="empty-variants-msg">🎛️ &nbsp;No variants yet. Click "Add Variant" to create one.</div>'
            );
        }
    });

    card.querySelectorAll('.variant-price, .variant-quantity').forEach(i => {
        i.addEventListener('input', updateTotals);
    });

    const nameInput = card.querySelector('.variant-name');
    const skuInput  = card.querySelector('.variant-sku');
    if (nameInput && skuInput) {
        nameInput.addEventListener('input', function() {
            if (!card.querySelector('[name*="[id]"]')?.value && (!skuInput.value || skuInput.value.startsWith('VAR-'))) {
                const base = this.value.trim().toUpperCase().replace(/\s+/g,'_').substring(0,10);
                const idx  = (parseInt(card.dataset.index) + 1).toString().padStart(3,'0');
                skuInput.value = `VAR-${base||'NEW'}-${idx}`;
            }
        });
    }

    const imgInput = card.querySelector('.variant-images');
    if (imgInput) {
        imgInput.addEventListener('change', function(e) {
            let preview = card.querySelector('.variant-images-preview');
            if (!preview) {
                preview = document.createElement('div');
                preview.className = 'variant-images-preview';
                imgInput.parentElement.insertAdjacentElement('afterend', preview);
            }
            Array.from(e.target.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = ev => {
                    const el = document.createElement('div');
                    el.className = 'v-img-preview';
                    el.innerHTML = `<img src="${ev.target.result}" alt="">
                                    <div class="v-img-remove" onclick="this.parentElement.remove()">✕</div>`;
                    preview.appendChild(el);
                };
                reader.readAsDataURL(file);
            });
        });
    }
}

function renumberVariants() {
    document.querySelectorAll('.variant-card').forEach((card, i) => {
        card.dataset.index = i;
        card.querySelector('.variant-num').textContent = `Variant #${i+1}`;
        card.querySelectorAll('[name]').forEach(inp => {
            inp.setAttribute('name', inp.getAttribute('name').replace(/variants\[\d+\]/, `variants[${i}]`));
        });
    });
    variantIndex = document.querySelectorAll('.variant-card').length;
}

// Add variant
let variantIndex = {{ $product->variants->count() }};
document.getElementById('add-variant-btn').addEventListener('click', function() {
    const emptyMsg = document.getElementById('empty-variants-msg');
    if (emptyMsg) emptyMsg.remove();

    const sym = currencySymbols[document.getElementById('currencySelect').value] || '₦';
    const idx = variantIndex++;

    const html = `
    <div class="variant-card" data-index="${idx}">
        <div class="variant-head">
            <span class="variant-num">New Variant</span>
            <button type="button" class="variant-remove remove-variant">✕</button>
        </div>
        <div class="field-row cols-2">
            <div>
                <label class="field-label">Variant Name <span class="required">*</span></label>
                <input type="text" class="variant-name" name="variants[${idx}][variant_name]"
                       placeholder="e.g., Blue / Large" required>
            </div>
            <div>
                <label class="field-label">SKU <span class="required">*</span></label>
                <input type="text" class="variant-sku" name="variants[${idx}][sku]"
                       style="font-family:var(--mono); font-size:12.5px;"
                       placeholder="VAR-${String(idx+1).padStart(3,'0')}" required>
            </div>
        </div>
        <div class="field-row cols-3">
            <div>
                <label class="field-label">Price <span class="required">*</span></label>
                <div class="input-addon">
                    <span class="addon currency-sym">${sym}</span>
                    <input type="number" class="variant-price" name="variants[${idx}][price]"
                           step="0.01" min="0" required>
                </div>
            </div>
            <div>
                <label class="field-label">Stock Qty <span class="required">*</span></label>
                <input type="number" class="variant-quantity" name="variants[${idx}][quantity]"
                       min="0" required>
            </div>
            <div>
                <label class="field-label">Images</label>
                <input type="file" class="variant-images" name="variants[${idx}][images][]"
                       multiple accept="image/*" style="font-size:12px; padding:6px 10px;">
            </div>
        </div>
    </div>`;

    const container = document.getElementById('variants-container');
    container.insertAdjacentHTML('beforeend', html);
    attachVariantEvents(container.lastElementChild);
    updateTotals();
    container.lastElementChild.scrollIntoView({ behavior:'smooth', block:'nearest' });
});

// Attach existing variant events
document.querySelectorAll('.variant-card').forEach(attachVariantEvents);
updateTotals();

// SEO char counters
function makeCounter(inputId, counterId, warn, max) {
    const el  = document.getElementById(inputId);
    const cnt = document.getElementById(counterId);
    if (!el || !cnt) return;
    function update() {
        const len = el.value.length;
        cnt.textContent = `${len}/${max}`;
        cnt.className = 'char-counter ' + (len > max ? 'bad' : len > warn ? 'warn' : 'ok');
    }
    el.addEventListener('input', update);
    update();
}
makeCounter('metaTitle', 'metaTitleCount', 50, 60);
makeCounter('metaDesc',  'metaDescCount',  150, 160);

// Form validation
document.getElementById('productForm').addEventListener('submit', function(e) {
    const name = this.querySelector('[name="name"]').value.trim();
    const sku  = this.querySelector('[name="sku"]').value.trim();
    if (!name || !sku) {
        e.preventDefault();
        alert('Product name and SKU are required.');
        return;
    }

    const allSkus = Array.from(this.querySelectorAll('[name*="[sku]"]')).map(i => i.value.trim()).filter(Boolean);
    const dups = allSkus.filter((s, i) => allSkus.indexOf(s) !== i);
    if (dups.length) {
        e.preventDefault();
        alert('Duplicate SKUs found: ' + [...new Set(dups)].join(', '));
        return;
    }

    const price    = parseFloat(this.querySelector('[name="price"]').value);
    const discEl   = this.querySelector('[name="discount_price"]');
    const discType = this.querySelector('[name="discount_type"]').value;
    if (discEl?.value && discType === 'flat' && parseFloat(discEl.value) >= price) {
        e.preventDefault();
        alert('Flat discount price must be less than the base price.');
    }
});

// ===================== SIZES =====================
let sizeIndex = {{ $product->sizes->count() }};

function updateSizeCount() {
    const count = document.querySelectorAll('#sizes-container .size-item').length;
    document.getElementById('size-count-badge').innerText = count + (count === 1 ? ' size' : ' sizes');
    if (count === 0) {
        if (!document.querySelector('.empty-sizes-msg')) {
            document.getElementById('sizes-container').insertAdjacentHTML('afterbegin',
                '<div class="empty-sizes-msg" style="text-align: center; color: var(--sub); padding: 20px;">No sizes added. Add sizes below.</div>'
            );
        }
    } else {
        const emptyMsg = document.querySelector('.empty-sizes-msg');
        if (emptyMsg) emptyMsg.remove();
    }
}

function attachSizeEvents(sizeItem) {
    const removeBtn = sizeItem.querySelector('.remove-size-btn');
    if (removeBtn) {
        removeBtn.addEventListener('click', () => {
            sizeItem.remove();
            updateSizeCount();
        });
    }
}

document.getElementById('add-size-btn')?.addEventListener('click', () => {
    const container = document.getElementById('sizes-container');
    const emptyMsg = document.querySelector('.empty-sizes-msg');
    if (emptyMsg) emptyMsg.remove();

    const newSizeHtml = `
        <div class="size-item" data-index="${sizeIndex++}">
            <div class="field-row cols-3-1" style="margin-bottom: 10px;">
                <div class="size-input-wrapper">
                    <input type="text" name="sizes[]" class="size-input" placeholder="e.g., S, M, L, XL, 38, 40" style="width: 100%;">
                </div>
                <div>
                    <button type="button" class="remove-size-btn" style="margin-top: 7px;">✕</button>
                </div>
            </div>
        </div>`;
    container.insertAdjacentHTML('beforeend', newSizeHtml);
    attachSizeEvents(container.lastElementChild);
    updateSizeCount();
});

// Attach events to existing size items
document.querySelectorAll('#sizes-container .size-item').forEach(attachSizeEvents);
updateSizeCount();
</script>
</body>
</html>