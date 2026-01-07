@extends('seller.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>My Products</h2>
            <p class="text-muted">Manage your listings — search and edit quickly</p>
        </div>

        <div class="d-flex gap-2 align-items-center">
            <div class="input-group me-2" style="min-width:320px;">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input id="productSearch" type="search" class="form-control" placeholder="Search products..." aria-label="Search products">
                <button id="clearSearch" class="btn btn-outline-secondary" type="button" title="Clear">✕</button>
            </div>

            <a href="{{ route('seller.products.create') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-plus-circle"></i> Add Product
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Products Table -->
    @if(isset($products) && $products->count())
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">#</th>
                        <th width="20%">Product Name</th>
                        <th width="10%">SKU</th>
                        <th width="12%">Price</th>
                        <th width="12%">Discount</th>
                        <th width="10%">Stock</th>
                        <th width="10%">Status</th>
                        <th width="21%">Actions</th>
                    </tr>
                </thead>
                <tbody id="productsTableBody">
                    @foreach($products as $index => $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($product->thumbnail)
                                        <img src="{{ asset('storage/' . $product->thumbnail) }}" 
                                             alt="{{ $product->name }}" 
                                             class="img-thumbnail me-2" 
                                             style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center me-2" 
                                             style="width: 40px; height: 40px;">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    @endif
                                    <span>{{ $product->name }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $product->sku ?? 'N/A' }}</span>
                            </td>
                            <td>
                                <strong>${{ number_format($product->price, 2) }}</strong>
                            </td>
                            <td>
                                @if($product->discount_price)
                                    <span class="text-danger">
                                        -${{ number_format($product->discount_price, 2) }}
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge @if($product->stock_quantity > 10) bg-success @elseif($product->stock_quantity > 0) bg-warning text-dark @else bg-danger @endif">
                                    {{ $product->stock_quantity ?? 0 }}
                                </span>
                            </td>
                            <td>
                                @if($product->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('seller.products.edit', $product->id) }}" 
                                       class="btn btn-warning" 
                                       title="Edit">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('seller.products.destroy', $product->id) }}" 
                                          method="POST" 
                                          style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-danger" 
                                                title="Delete"
                                                onclick="return confirm('Are you sure?')">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

   <nav class="mt-4" id="productsPagination">
    {{ $products->onEachSide(1)->links('pagination::simple-tailwind') }}
   </nav>

    @else
        <div class="alert alert-info text-center py-5" role="alert">
            <i class="bi bi-inbox" style="font-size: 2rem;"></i>
            <p class="mt-3 mb-0">No products found. <a href="{{ route('seller.products.create') }}">Create your first product</a></p>
        </div>
    @endif
</div>

<script>
// Realtime product search (debounced)
(function(){
    const input = document.getElementById('productSearch');
    const clearBtn = document.getElementById('clearSearch');
    const tbody = document.getElementById('productsTableBody');
    const pagination = document.getElementById('productsPagination');

    function debounce(fn, delay = 300){ let t; return (...args)=>{ clearTimeout(t); t = setTimeout(()=>fn(...args), delay); }; }

    async function search(q){
        if(!q){ return restore(); }
        try {
            const url = new URL(window.location.href);
            url.searchParams.set('q', q);
            const res = await fetch(url.toString(), { headers: { 'X-Requested-With':'XMLHttpRequest' } });
            if(!res.ok) throw new Error('Network error');
            const json = await res.json();
            renderRows(json.items || []);
        } catch(e){ console.error(e); }
    }

    function renderRows(items){
        if(pagination) pagination.style.display = items.length ? 'none' : 'block';
        if(!items.length){ tbody.innerHTML = '<tr><td colspan="8" class="text-center text-muted">No products found</td></tr>'; return; }
        tbody.innerHTML = items.map((p, idx)=>`
            <tr>
                <td>${idx+1}</td>
                <td>
                    <div class="d-flex align-items-center">
                        ${p.thumbnail ? `<img src="${p.thumbnail}" class="img-thumbnail me-2" style="width:40px;height:40px;object-fit:cover;">` : '<div class="bg-secondary text-white d-flex align-items-center justify-content-center me-2" style="width:40px;height:40px;"><i class="bi bi-image"></i></div>'}
                        <span>${escapeHtml(p.name)}</span>
                    </div>
                </td>
                <td><span class="badge bg-info">${escapeHtml(p.sku||'N/A')}</span></td>
                <td><strong>$${p.price}</strong></td>
                <td>${p.discount_price?`<span class="text-danger">-${p.discount_price}</span>`:'<span class="text-muted">-</span>'}</td>
                <td><span class="badge ${p.stock_quantity>10?'bg-success':(p.stock_quantity>0?'bg-warning text-dark':'bg-danger')}">${p.stock_quantity}</span></td>
                <td>${p.is_active?'<span class="badge bg-success">Active</span>':'<span class="badge bg-secondary">Inactive</span>'}</td>
                <td>
                    <div class="btn-group btn-group-sm" role="group">
                        <a href="/seller/products/${p.id}/edit" class="btn btn-warning" title="Edit"><i class="bi bi-pencil"></i> Edit</a>
                        <form action="/seller/products/${p.id}" method="POST" style="display:inline;">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i> Delete</button>
                        </form>
                    </div>
                </td>
            </tr>`).join('');
    }

    function restore(){
        if(pagination) pagination.style.display='block';
        // reload without q param to restore server pagination view
        const url = new URL(window.location.href);
        url.searchParams.delete('q');
        window.history.replaceState({}, '', url.toString());
        // Optionally re-fetch full page content: keep current tbody as-is (server-rendered)
        // For simplicity, do nothing else so original server-rendered rows remain.
    }

    function escapeHtml(s){ return String(s).replace(/[&<>"']/g, c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c])); }

    const deb = debounce(e=>search(e.target.value.trim()), 300);
    if(input) input.addEventListener('input', deb);
    if(clearBtn) clearBtn.addEventListener('click', ()=>{ if(input) input.value=''; restore(); });
})();
</script>

<style>
    :root {
        --primary-color: #667eea;
        --secondary-color: #764ba2;
        --success-color: #48bb78;
        --warning-color: #f6ad55;
        --danger-color: #f56565;
        --dark-bg: #1a202c;
        --light-bg: #f7fafc;
    }

    .container-fluid {
        padding: 30px;
    }

    /* Header Styling */
    .container-fluid > .d-flex {
        margin-bottom: 40px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
    }

    .container-fluid > .d-flex h2 {
        color: white;
        font-weight: 700;
        font-size: 2rem;
        margin: 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .container-fluid > .d-flex .btn {
        background: white;
        color: var(--primary-color);
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .container-fluid > .d-flex .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        color: var(--secondary-color);
    }

    /* Alert Styling */
    .alert {
        border: none;
        border-radius: 8px;
        padding: 16px 20px;
        margin-bottom: 30px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        animation: slideDown 0.3s ease;
    }

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

    .alert-success {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        border-left: 5px solid var(--success-color);
        color: #155724;
    }

    .alert-info {
        background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
        border-left: 5px solid #17a2b8;
        color: #0c5460;
    }

    /* Table Styling */
    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .table {
        margin-bottom: 0;
        font-size: 0.95rem;
    }

    .table thead {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    }

    .table thead th {
        color: white;
        font-weight: 600;
        border: none;
        padding: 16px 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.85rem;
    }

    .table tbody td {
        padding: 14px 12px;
        vertical-align: middle;
        border-color: #e2e8f0;
    }

    .table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #e2e8f0;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .table tbody tr:last-child {
        border-bottom: none;
    }

    /* Product Name Cell */
    .table tbody td:nth-child(2) {
        font-weight: 500;
        color: #2d3748;
    }

    /* Image Styling */
    .img-thumbnail {
        border: 2px solid #e2e8f0;
        padding: 2px;
        transition: all 0.3s ease;
    }

    .img-thumbnail:hover {
        border-color: var(--primary-color);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
    }

    /* Badge Styling */
    .badge {
        padding: 6px 12px;
        font-weight: 500;
        font-size: 0.8rem;
        letter-spacing: 0.3px;
        border-radius: 20px;
        display: inline-block;
    }

    .badge.bg-info {
        background: linear-gradient(135deg, #bee3f8 0%, #90cdf4 100%) !important;
        color: #2c5282 !important;
        font-weight: 600;
    }

    .badge.bg-success {
        background: linear-gradient(135deg, #c6f6d5 0%, #9ae6b4 100%) !important;
        color: #22543d !important;
        font-weight: 600;
    }

    .badge.bg-warning {
        background: linear-gradient(135deg, #feebc8 0%, #fbd38d 100%) !important;
        color: #7c2d12 !important;
        font-weight: 600;
    }

    .badge.bg-danger {
        background: linear-gradient(135deg, #fed7d7 0%, #fc8181 100%) !important;
        color: #742a2a !important;
        font-weight: 600;
    }

    .badge.bg-secondary {
        background: linear-gradient(135deg, #cbd5e0 0%, #a0aec0 100%) !important;
        color: #2d3748 !important;
        font-weight: 600;
    }

    /* Price Styling */
    .table tbody td strong {
        color: var(--primary-color);
        font-size: 1.1rem;
    }

    .text-danger {
        color: var(--danger-color) !important;
        font-weight: 600;
    }

    /* Action Buttons */
    .btn-group-sm {
        display: flex;
        gap: 5px;
    }

    .btn-group-sm .btn {
        padding: 6px 10px;
        font-size: 0.75rem;
        border-radius: 6px;
        transition: all 0.3s ease;
        font-weight: 500;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .btn-group-sm .btn-warning {
        background: linear-gradient(135deg, var(--warning-color) 0%, #ed8936 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(246, 173, 85, 0.3);
    }

    .btn-group-sm .btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(246, 173, 85, 0.4);
        color: white;
        background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
    }

    .btn-group-sm .btn-danger {
        background: linear-gradient(135deg, var(--danger-color) 0%, #e53e3e 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(245, 101, 101, 0.3);
    }

    .btn-group-sm .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(245, 101, 101, 0.4);
        color: white;
        background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%);
    }

    /* Pagination */
    nav[aria-label="Page navigation"] {
        display: flex;
        justify-content: center;
    }

    .pagination {
        gap: 5px;
    }

    .pagination .page-link {
        border: none;
        border-radius: 6px;
        color: var(--primary-color);
        font-weight: 500;
        transition: all 0.3s ease;
        padding: 8px 12px;
    }

    .pagination .page-link:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-2px);
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        border: none;
        color: white;
    }

    /* Empty State */
    .alert-info {
        border-left: 5px solid #17a2b8;
    }

    .alert-info i {
        color: #17a2b8;
    }

    .alert-info a {
        color: #17a2b8;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .alert-info a:hover {
        text-decoration: underline;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container-fluid {
            padding: 15px;
        }

        .container-fluid > .d-flex {
            flex-direction: column;
            gap: 15px;
            padding: 20px;
        }

        .container-fluid > .d-flex h2 {
            font-size: 1.5rem;
        }

        .table {
            font-size: 0.85rem;
        }

        .table thead th {
            padding: 12px 8px;
            font-size: 0.75rem;
        }

        .table tbody td {
            padding: 10px 8px;
        }

        .btn-group-sm .btn {
            padding: 4px 8px;
            font-size: 0.7rem;
        }
    }

    /* Smooth transitions */
    * {
        transition: background-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease;
    }
</style>
@endsection
