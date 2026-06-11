{{-- resources/views/seller/products.blade.php --}}
@php $seller = Auth::guard('seller')->user(); @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products — SellerHub</title>
    @include('seller.partials._base')
    <style>
        /* Product thumbnail */
        .prod-thumb {
            width: 48px; height: 48px; border-radius: 10px;
            object-fit: cover; border: 1px solid var(--border);
            background: var(--muted); flex-shrink: 0;
        }
        .prod-thumb-placeholder {
            width: 48px; height: 48px; border-radius: 10px;
            background: var(--muted); border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; flex-shrink: 0;
        }
        .prod-name { font-size: 13.5px; font-weight: 600; color: var(--text); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 260px; display: block; }
        .prod-name:hover { color: var(--accent); text-decoration: none; }
        .prod-sku { font-family: var(--mono); font-size: 11px; color: var(--sub); margin-top: 2px; }

        /* Search header */
        .products-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 16px 22px; gap: 12px; flex-wrap: wrap;
        }
        .prod-search-wrap { position: relative; }
        .prod-search-wrap i { position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: var(--sub); font-size: 12px; }
        .prod-search-wrap input { padding-left: 30px; width: 240px; }

        /* Action menu */
        .sh-dropdown { position: relative; }
        .sh-dropdown-menu {
            position: absolute; right: 0; top: calc(100% + 6px);
            background: var(--surface); border: 1px solid var(--border);
            border-radius: 10px; box-shadow: var(--shadow-lg);
            min-width: 150px; z-index: 200; overflow: hidden;
            display: none;
        }
        .sh-dropdown.open .sh-dropdown-menu { display: block; }
        .sh-dropdown-item {
            display: flex; align-items: center; gap: 8px;
            padding: 10px 14px; font-size: 13px; font-weight: 500;
            color: var(--text2); cursor: pointer; border: none;
            background: none; width: 100%; text-align: left;
            transition: background .12s; text-decoration: none;
        }
        .sh-dropdown-item:hover { background: var(--bg); text-decoration: none; }
        .sh-dropdown-item.danger { color: var(--danger); }
        .sh-dropdown-item.danger:hover { background: var(--danger-bg); }
        .sh-dropdown-divider { height: 1px; background: var(--border); margin: 4px 0; }

        .act-btn {
            width: 30px; height: 30px; border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            border: 1px solid var(--border); background: var(--bg);
            color: var(--sub); font-size: 13px; cursor: pointer;
            transition: all .15s; text-decoration: none;
        }
        .act-btn:hover { background: var(--accent-bg); border-color: var(--accent); color: var(--accent); }

        /* Pagination */
        .sh-pagination { display: flex; align-items: center; gap: 4px; flex-wrap: wrap; }
        .sh-page-btn {
            min-width: 32px; height: 32px; border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            border: 1px solid var(--border); background: var(--surface);
            color: var(--text2); font-size: 13px; font-weight: 500;
            cursor: pointer; transition: all .15s; text-decoration: none;
            padding: 0 8px;
        }
        .sh-page-btn:hover { border-color: var(--accent); color: var(--accent); }
        .sh-page-btn.active { background: var(--accent); border-color: var(--accent); color: #fff; }

        /* Success flash */
        .sh-flash {
            padding: 12px 18px; border-radius: 10px; margin-bottom: 18px;
            display: flex; align-items: center; gap: 10px; font-size: 13px; font-weight: 500;
        }
        .sh-flash.success { background: var(--accent2-bg); border: 1px solid rgba(34,196,122,.25); color: #14a05a; }
        .sh-flash.error   { background: var(--danger-bg);  border: 1px solid rgba(244,63,94,.25); color: var(--danger); }
    </style>
</head>
<body>
<div class="sh-layout">

    @include('seller.partials._sidebar', ['active' => 'products'])

    <header class="sh-header">
        <div class="sh-header-left">
            <div>
                <div class="sh-header-title">Products</div>
                <div class="sh-header-sub">{{ now()->format('l, F j, Y') }}</div>
            </div>
        </div>
        <div class="sh-header-right">
            <a href="{{ route('seller.orders.index') }}" class="sh-icon-btn">🛒 <span class="sh-notif-dot">3</span></a>
            <a href="#" class="sh-icon-btn">🔔</a>
            <a href="{{ route('seller.products.create') }}" class="sh-btn sh-btn-primary">+ Add Product</a>
            <form method="POST" action="{{ route('seller.logout') }}" style="display:inline">
                @csrf <button type="submit" class="sh-icon-btn">↩</button>
            </form>
        </div>
    </header>

    <main class="sh-main">

        {{-- Flash messages --}}
        @if(session('success'))
            <div class="sh-flash success"><span>✅</span> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="sh-flash error"><span>❌</span> {{ session('error') }}</div>
        @endif

        {{-- Page Header --}}
        <div class="sh-page-header">
            <div>
                <div class="sh-page-title">📦 Products</div>
                <div class="sh-page-sub">Manage your product catalogue</div>
            </div>
            <div class="sh-page-actions">
                <button class="sh-btn sh-btn-secondary">
                    <i class="fas fa-file-export"></i> Export
                </button>
                <a href="{{ route('seller.products.create') }}" class="sh-btn sh-btn-primary">
                    <i class="fas fa-plus"></i> Add Product
                </a>
            </div>
        </div>

        {{-- Products Table --}}
        <div class="sh-card" style="animation: shFadeUp .45s ease;">

            {{-- Search + Controls Header --}}
            <div class="products-header">
                <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
                    <div class="prod-search-wrap">
                        <i class="fas fa-search"></i>
                        <input type="text" id="productSearch" class="sh-input" placeholder="Search products…" oninput="filterProducts()">
                    </div>
                    <select id="statusFilter" class="sh-select" style="width:140px;" onchange="filterProducts()">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div style="display:flex; align-items:center; gap:8px;">
                    <span style="font-size:12px; color:var(--sub);" id="productCount">
                        {{ $products->total() }} product{{ $products->total() !== 1 ? 's' : '' }}
                    </span>
                    <div id="bulkActions" style="display:none; align-items:center; gap:8px;">
                        <span style="font-size:12px; color:var(--sub);" id="bulkCount">0 selected</span>
                        <button class="sh-btn sh-btn-danger sh-btn-sm" onclick="bulkDelete()">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                </div>
            </div>

            {{-- Table --}}
            <div class="sh-table-wrap">
                <table class="sh-table" id="productsTable">
                    <thead>
                        <tr>
                            <th style="width:40px; padding-left:22px;">
                                <input type="checkbox" id="masterCheck" onchange="toggleAll(this)"
                                    style="width:14px; height:14px; cursor:pointer; accent-color:var(--accent);">
                            </th>
                            <th style="width:60px;"></th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>SKU</th>
                            <th>Availability</th>
                            <th>Published</th>
                            <th style="text-align:right; padding-right:22px;"></th>
                        </tr>
                    </thead>
                    <tbody id="productsBody">
                        @forelse($products as $product)
                        <tr class="prod-row" data-name="{{ strtolower($product->name) }}" data-status="{{ $product->is_active ? 'active' : 'inactive' }}">
                            <td style="padding-left:22px;">
                                <input type="checkbox" class="prod-check" value="{{ $product->id }}"
                                    style="width:14px; height:14px; cursor:pointer; accent-color:var(--accent);"
                                    onchange="updateBulkCount()">
                            </td>
                            <td style="padding:8px 12px;">
                                @if($product->thumbnail)
                                    <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->name }}" class="prod-thumb">
                                @else
                                    <div class="prod-thumb-placeholder">📦</div>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('seller.products.show', $product->id) }}" class="prod-name">
                                    {{ $product->name }}
                                </a>
                                @if($product->category)
                                    <div style="font-size:11px; color:var(--sub); margin-top:1px;">{{ $product->category->name }}</div>
                                @endif
                            </td>
                            <td>
                                <span style="font-family:var(--mono); font-weight:700; color:var(--text);">
                                    ₹{{ number_format($product->price, 2) }}
                                </span>
                            </td>
                            <td>
                                <span class="prod-sku">{{ $product->sku ?? '—' }}</span>
                            </td>
                            <td>
                                @if($product->is_active == 1)
                                    <span class="sh-pill sh-pill-delivered">Active</span>
                                @else
                                    <span class="sh-pill sh-pill-cancelled">Inactive</span>
                                @endif
                            </td>
                            <td style="color:var(--sub); font-size:12.5px; white-space:nowrap;">
                                {{ $product->created_at->format('M d, Y') }}<br>
                                <span style="font-size:11px;">{{ $product->created_at->format('h:i A') }}</span>
                            </td>
                            <td style="text-align:right; padding-right:22px;">
                                <div style="display:flex; align-items:center; justify-content:flex-end; gap:6px;">
                                    <a href="{{ route('seller.products.show', $product->id) }}" class="act-btn" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('seller.products.edit', $product->id) }}" class="act-btn" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <div class="sh-dropdown">
                                        <button class="act-btn" onclick="toggleDropdown(this)" title="More">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="sh-dropdown-menu">
                                            <a class="sh-dropdown-item" href="{{ route('seller.products.show', $product->id) }}">
                                                <i class="fas fa-eye" style="color:var(--accent); width:14px;"></i> View
                                            </a>
                                            <a class="sh-dropdown-item" href="{{ route('seller.products.edit', $product->id) }}">
                                                <i class="fas fa-pencil-alt" style="color:var(--accent3); width:14px;"></i> Edit
                                            </a>
                                            <div class="sh-dropdown-divider"></div>
                                            <form method="POST" action="{{ route('seller.products.destroy', $product->id) }}" id="delForm_{{ $product->id }}">
                                                @csrf
                                                <button type="button" class="sh-dropdown-item danger"
                                                    onclick="confirmDelete({{ $product->id }}, '{{ addslashes($product->name) }}')">
                                                    <i class="fas fa-trash" style="width:14px;"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">
                                <div class="sh-empty">
                                    <div class="sh-empty-icon">📭</div>
                                    <div class="sh-empty-title">No products yet</div>
                                    <div class="sh-empty-sub">Add your first product to start selling</div>
                                    <a href="{{ route('seller.products.create') }}" class="sh-btn sh-btn-primary" style="margin-top:12px;">+ Add Product</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($products->hasPages())
            <div class="sh-card-footer" style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px;">
                <span style="font-size:12.5px; color:var(--sub);">
                    Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }} products
                </span>
                <div class="sh-pagination">
                    {{-- Previous --}}
                    @if($products->onFirstPage())
                        <span class="sh-page-btn" style="opacity:.4; cursor:not-allowed;"><i class="fas fa-chevron-left" style="font-size:10px;"></i></span>
                    @else
                        <a class="sh-page-btn" href="{{ $products->previousPageUrl() }}"><i class="fas fa-chevron-left" style="font-size:10px;"></i></a>
                    @endif

                    @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                        <a class="sh-page-btn {{ $page == $products->currentPage() ? 'active' : '' }}" href="{{ $url }}">{{ $page }}</a>
                    @endforeach

                    @if($products->hasMorePages())
                        <a class="sh-page-btn" href="{{ $products->nextPageUrl() }}"><i class="fas fa-chevron-right" style="font-size:10px;"></i></a>
                    @else
                        <span class="sh-page-btn" style="opacity:.4; cursor:not-allowed;"><i class="fas fa-chevron-right" style="font-size:10px;"></i></span>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </main>
</div>

<div class="sh-toast-container" id="toastContainer"></div>

<script>
function filterProducts() {
    const search = document.getElementById('productSearch').value.toLowerCase();
    const status = document.getElementById('statusFilter').value;
    let visible = 0;
    document.querySelectorAll('.prod-row').forEach(row => {
        const matchName   = !search || row.dataset.name.includes(search);
        const matchStatus = !status || row.dataset.status === status;
        row.style.display = matchName && matchStatus ? '' : 'none';
        if (matchName && matchStatus) visible++;
    });
    document.getElementById('productCount').textContent = visible + ' product' + (visible !== 1 ? 's' : '');
}

function toggleAll(master) {
    document.querySelectorAll('.prod-check').forEach(c => c.checked = master.checked);
    updateBulkCount();
}

function updateBulkCount() {
    const n = document.querySelectorAll('.prod-check:checked').length;
    const panel = document.getElementById('bulkActions');
    document.getElementById('bulkCount').textContent = n + ' selected';
    panel.style.display = n > 0 ? 'flex' : 'none';
}

function confirmDelete(id, name) {
    if (confirm(`Delete "${name}"? This cannot be undone.`)) {
        document.getElementById('delForm_' + id).submit();
    }
}

function bulkDelete() {
    const ids = Array.from(document.querySelectorAll('.prod-check:checked')).map(c => c.value);
    if (!ids.length) return;
    if (confirm(`Delete ${ids.length} product(s)? This cannot be undone.`)) {
        showToast('Bulk delete not yet implemented via backend.', 'warning');
    }
}

function toggleDropdown(btn) {
    const dd = btn.closest('.sh-dropdown');
    document.querySelectorAll('.sh-dropdown.open').forEach(d => { if (d !== dd) d.classList.remove('open'); });
    dd.classList.toggle('open');
}
document.addEventListener('click', e => {
    if (!e.target.closest('.sh-dropdown')) document.querySelectorAll('.sh-dropdown.open').forEach(d => d.classList.remove('open'));
});

function showToast(msg, type = 'info') {
    const icons = { success:'✅', error:'❌', warning:'⚠️', info:'ℹ️' };
    const t = document.createElement('div');
    t.className = `sh-toast ${type}`;
    t.innerHTML = `<span>${icons[type]}</span><span>${msg}</span>`;
    document.getElementById('toastContainer').appendChild(t);
    setTimeout(() => t.remove(), 3500);
}
</script>
</body>
</html>