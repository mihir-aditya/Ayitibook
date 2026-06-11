<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affiliate Links | Enterprise Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body { background-color: #f3f4f6; }
        .copy-btn { transition: all 0.2s ease; }
        .copy-btn:hover { transform: translateY(-1px); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .table-row-hover:hover { background-color: #f9fafb; }
        .pagination { display: flex; gap: 0.5rem; justify-content: flex-end; }
        .pagination-item { padding: 0.5rem 0.75rem; border-radius: 0.5rem; font-size: 0.875rem; font-weight: 500; transition: all 0.2s; }

        /* ── Shared Modal ── */
        .modal-overlay { display:none; position:fixed; inset:0; z-index:50; align-items:center; justify-content:center; }
        .modal-overlay.open { display:flex; }
        .modal-backdrop { position:absolute; inset:0; background:rgba(0,0,0,.45); backdrop-filter:blur(3px); animation:fadeIn .18s ease; }
        .modal-card { position:relative; background:#fff; border-radius:1.25rem; width:100%; max-width:520px; margin:1.5rem; box-shadow:0 25px 60px rgba(0,0,0,.18); animation:slideUp .22s cubic-bezier(.34,1.2,.64,1); overflow:hidden; }
        .modal-card--sm { max-width:400px; }
        .modal-card--lg { max-width:620px; }
        @keyframes fadeIn  { from{opacity:0} to{opacity:1} }
        @keyframes slideUp { from{opacity:0;transform:translateY(24px) scale(.97)} to{opacity:1;transform:translateY(0) scale(1)} }
        .modal-header { background:linear-gradient(135deg,#4f46e5 0%,#7c3aed 100%); padding:1.5rem 1.75rem 1.25rem; }
        .modal-header--red   { background:linear-gradient(135deg,#dc2626 0%,#b91c1c 100%); }
        .modal-header--slate { background:linear-gradient(135deg,#334155 0%,#1e293b 100%); }
        .modal-body   { padding:1.5rem 1.75rem; }
        .modal-footer { padding:1rem 1.75rem 1.5rem; border-top:1px solid #f1f3f5; display:flex; gap:.75rem; justify-content:flex-end; }

        /* Forms */
        .form-label { display:block; font-size:.8rem; font-weight:600; color:#374151; margin-bottom:.35rem; }
        .form-input { width:100%; padding:.6rem .85rem; border:1.5px solid #e5e7eb; border-radius:.6rem; font-size:.875rem; color:#111827; transition:border-color .15s,box-shadow .15s; outline:none; background:#fafafa; }
        .form-input:focus { border-color:#6366f1; box-shadow:0 0 0 3px rgba(99,102,241,.12); background:#fff; }
        .form-input:read-only { background:#f9fafb; color:#6b7280; cursor:default; }
        .form-input::placeholder { color:#9ca3af; }

        /* Buttons */
        .btn-primary { display:inline-flex; align-items:center; gap:.4rem; padding:.6rem 1.25rem; background:linear-gradient(135deg,#4f46e5,#7c3aed); color:#fff; border-radius:.6rem; font-size:.875rem; font-weight:600; border:none; cursor:pointer; transition:opacity .15s,transform .12s,box-shadow .15s; box-shadow:0 2px 8px rgba(79,70,229,.3); }
        .btn-primary:hover { opacity:.92; transform:translateY(-1px); box-shadow:0 4px 14px rgba(79,70,229,.35); }
        .btn-danger  { display:inline-flex; align-items:center; gap:.4rem; padding:.6rem 1.25rem; background:linear-gradient(135deg,#dc2626,#b91c1c); color:#fff; border-radius:.6rem; font-size:.875rem; font-weight:600; border:none; cursor:pointer; transition:opacity .15s,transform .12s; box-shadow:0 2px 8px rgba(220,38,38,.25); }
        .btn-danger:hover { opacity:.9; transform:translateY(-1px); }
        .btn-cancel  { display:inline-flex; align-items:center; gap:.4rem; padding:.6rem 1.1rem; background:#f3f4f6; color:#374151; border-radius:.6rem; font-size:.875rem; font-weight:500; border:1px solid #e5e7eb; cursor:pointer; transition:background .13s; }
        .btn-cancel:hover { background:#e9ecef; }
        .btn-add-link { display:inline-flex; align-items:center; gap:.45rem; padding:.55rem 1.1rem; background:linear-gradient(135deg,#4f46e5,#7c3aed); color:#fff; border-radius:.6rem; font-size:.875rem; font-weight:600; border:none; cursor:pointer; box-shadow:0 2px 8px rgba(79,70,229,.28); transition:opacity .15s,transform .12s; text-decoration:none; }
        .btn-add-link:hover { opacity:.9; transform:translateY(-1px); }

        .pulse-dot { width:7px; height:7px; border-radius:50%; background:#a5f3fc; animation:pulse 1.8s infinite; }
        @keyframes pulse { 0%{box-shadow:0 0 0 0 rgba(165,243,252,.7)} 70%{box-shadow:0 0 0 6px rgba(165,243,252,0)} 100%{box-shadow:0 0 0 0 rgba(165,243,252,0)} }

        /* Dropdown */
        .dropdown { position:relative; display:inline-block; }
        .dropdown-menu { display:none; position:absolute; right:0; top:calc(100% + 6px); background:#fff; border:1px solid #e5e7eb; border-radius:.65rem; box-shadow:0 10px 30px rgba(0,0,0,.12); min-width:155px; z-index:40; overflow:hidden; animation:dropIn .15s ease; }
        @keyframes dropIn { from{opacity:0;transform:translateY(-6px)} to{opacity:1;transform:translateY(0)} }
        .dropdown-menu.open { display:block; }
        .dropdown-item { display:flex; align-items:center; gap:.6rem; padding:.6rem 1rem; font-size:.825rem; font-weight:500; color:#374151; cursor:pointer; transition:background .1s; border:none; background:none; width:100%; text-align:left; }
        .dropdown-item:hover { background:#f9fafb; }
        .dropdown-item--danger { color:#dc2626; }
        .dropdown-item--danger:hover { background:#fef2f2; }
        .dropdown-divider { height:1px; background:#f1f3f5; margin:.2rem 0; }

        /* Detail rows in show modal */
        .detail-row { display:flex; align-items:flex-start; padding:.7rem 0; border-bottom:1px solid #f3f4f6; gap:1rem; }
        .detail-row:last-child { border-bottom:none; }
        .detail-label { font-size:.72rem; font-weight:600; color:#9ca3af; min-width:100px; padding-top:.15rem; text-transform:uppercase; letter-spacing:.04em; }
        .detail-value { font-size:.875rem; color:#111827; flex:1; }

        /* Filter pills */
        .filter-badge { display:inline-flex; align-items:center; gap:.3rem; background:#eef2ff; color:#4f46e5; border:1px solid #c7d2fe; border-radius:999px; font-size:.72rem; font-weight:600; padding:.2rem .65rem; }
        .filter-badge button { background:none; border:none; color:#4f46e5; cursor:pointer; font-size:.85rem; line-height:1; padding:0 0 0 .1rem; }

        .row-hidden { display:none; }
    </style>
</head>
<body class="antialiased">

    <!-- Nav -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-10">
        <div class="px-6 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                        </div>
                        <span class="text-xl font-bold text-gray-800">Affiliate<span class="text-indigo-600">Pro</span></span>
                    </div>
                    <span class="text-sm text-gray-500">Link Management Portal</span>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="text-sm font-medium text-gray-700">{{ $affiliate->user->name }}</span>
                    <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center">
                        <span class="text-sm font-semibold text-indigo-800">{{ substr($affiliate->user->name, 0, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 py-8">

        @if(session('success'))
        <div id="flashMsg" class="mb-6 flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 rounded-xl px-4 py-3 text-sm font-medium">
            <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
            <button onclick="this.parentElement.remove()" class="ml-auto text-green-600 text-lg leading-none">&times;</button>
        </div>
        @endif

        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-2 text-sm text-gray-500 mb-2">
                <a href="{{ route('affiliate.dashboard', $affiliate->affiliate_code) }}" class="hover:text-indigo-600">Dashboard</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="text-gray-700 font-medium">Affiliate Links</span>
            </div>
            <div class="flex justify-between items-center flex-wrap gap-3">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Affiliate Links</h1>
                    <p class="text-sm text-gray-500 mt-1">Manage and track all your affiliate marketing links</p>
                </div>
                <div class="flex gap-3 flex-wrap">
                    <button class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Export Links
                    </button>
                    <button onclick="openAddModal()" class="btn-add-link">
                        <span class="pulse-dot"></span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Add New Link
                    </button>
                    <a href="{{ route('affiliate.dashboard', $affiliate->affiliate_code) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 rounded-lg text-sm font-medium text-white hover:bg-gray-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Back
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between mb-2"><span class="text-sm font-medium text-gray-500">Total Links</span><div class="w-8 h-8 bg-indigo-50 rounded-lg flex items-center justify-center"><svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg></div></div>
                <p class="text-2xl font-bold text-gray-900">{{ $links->total() }}</p>
                <p class="text-xs text-gray-500 mt-2">Across {{ $links->groupBy('product_id')->count() }} products</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between mb-2"><span class="text-sm font-medium text-gray-500">Total Clicks</span><div class="w-8 h-8 bg-green-50 rounded-lg flex items-center justify-center"><svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5"></path></svg></div></div>
                <p class="text-2xl font-bold text-gray-900">{{ number_format($links->sum('clicks_count')) }}</p>
                <p class="text-xs text-gray-500 mt-2">↑ 12.5% from last month</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between mb-2"><span class="text-sm font-medium text-gray-500">Conversion Rate</span><div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center"><svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg></div></div>
                <p class="text-2xl font-bold text-gray-900">8.2%</p>
                <p class="text-xs text-gray-500 mt-2">Average across all links</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between mb-2"><span class="text-sm font-medium text-gray-500">Top Product</span><div class="w-8 h-8 bg-purple-50 rounded-lg flex items-center justify-center"><svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg></div></div>
                <p class="text-lg font-bold text-gray-900 truncate">{{ $links->first()->product->name ?? 'N/A' }}</p>
                <p class="text-xs text-gray-500 mt-2">{{ $links->first()->clicks_count ?? 0 }} clicks</p>
            </div>
        </div>

        <!-- ── Filter Bar ── -->
        <div class="mb-4">
            <div class="flex flex-wrap gap-3 items-center justify-between">
                <div class="flex-1 min-w-[260px]">
                    <div class="relative">
                        <input type="text" id="searchInput" placeholder="Search by product name or link code…"
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm"
                               oninput="applyFilters()">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>
                <div class="flex gap-3 items-center">
                    <select id="sortSelect" onchange="applyFilters()"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 bg-white">
                        <option value="">All (default)</option>
                        <option value="most_clicked">Most Clicked</option>
                        <option value="least_clicked">Least Clicked</option>
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                    </select>
                    <button id="clearBtn" onclick="clearFilters()"
                            class="hidden px-3 py-2 text-xs font-medium text-gray-500 hover:text-gray-800 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        <svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        Clear
                    </button>
                </div>
            </div>
            <!-- Active pills -->
            <div id="activeFilters" class="hidden flex flex-wrap gap-2 mt-3 items-center">
                <span class="text-xs text-gray-400">Active:</span>
                <span id="searchPill" class="hidden filter-badge">Search: <span id="searchPillText"></span><button onclick="clearSearch()">×</button></span>
                <span id="sortPill"   class="hidden filter-badge">Sort: <span id="sortPillText"></span><button onclick="clearSort()">×</button></span>
            </div>
            <p id="resultCount" class="hidden mt-2 text-xs text-gray-400"></p>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            @if($links->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product Details</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Link Code</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Performance</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200" id="tableBody">
                        @foreach($links as $link)
                        <tr class="table-row-hover transition-colors link-row"
                            data-product="{{ strtolower($link->product->name) }}"
                            data-code="{{ strtolower($link->link_code) }}"
                            data-clicks="{{ $link->clicks_count ?? 0 }}"
                            data-created="{{ $link->created_at->timestamp }}">

                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <span class="text-xs font-bold text-indigo-800">{{ substr($link->product->name, 0, 2) }}</span>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-semibold text-gray-900">{{ $link->product->name }}</p>
                                        <p class="text-xs text-gray-500">ID: #{{ $link->product_id }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <code class="bg-gray-100 px-3 py-1.5 rounded-lg text-xs font-mono text-gray-800 border border-gray-200">
                                    {{ url('/r/' . $link->link_code) }}
                                </code>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-green-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5"></path></svg>
                                        <span class="text-sm font-semibold text-gray-900">{{ number_format($link->clicks_count ?? 0) }}</span>
                                    </div>
                                    <span class="text-xs text-gray-500">clicks</span>
                                    <div class="w-16 h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-green-500 rounded-full" style="width: {{ min(($link->clicks_count ?? 0) / max($links->max('clicks_count'), 1) * 100, 100) }}%"></div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-gray-400 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ $link->created_at->format('M d, Y') }}
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    <!-- Copy -->
                                    <button onclick="copyToClipboard('{{ url('/r/' . $link->link_code) }}')"
                                            class="copy-btn inline-flex items-center px-3 py-1.5 bg-indigo-50 text-indigo-700 rounded-lg text-xs font-medium hover:bg-indigo-100 transition-colors">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                                        Copy
                                    </button>

                                    <!-- ⋯ Dropdown -->
                                    <div class="dropdown">
                                        <button onclick="toggleDropdown(this)"
                                                class="inline-flex items-center p-1.5 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                        </button>
                                        <div class="dropdown-menu">
                                            <button class="dropdown-item"
                                                    onclick="openShowModal({id:{{ $link->id }},product:'{{ addslashes($link->product->name) }}',code:'{{ $link->link_code }}',url:'{{ url('/r/' . $link->link_code) }}',clicks:'{{ number_format($link->clicks_count ?? 0) }}',created:'{{ $link->created_at->format('M d, Y \a\t h:i A') }}'})">
                                                <svg class="w-3.5 h-3.5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                View Details
                                            </button>
                                            <button class="dropdown-item" onclick="copyToClipboard('{{ url('/r/' . $link->link_code) }}');closeAllDropdowns()">
                                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                                Copy Link
                                            </button>
                                            <div class="dropdown-divider"></div>
                                            <button class="dropdown-item dropdown-item--danger"
                                                    onclick="openDeleteModal({{ $link->id }},'{{ addslashes($link->product->name) }}','{{ $link->link_code }}')">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                Delete Link
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- No results -->
            <div id="noResults" class="hidden px-6 py-12 text-center">
                <svg class="w-10 h-10 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <p class="text-sm font-medium text-gray-500">No links match your filters</p>
                <button onclick="clearFilters()" class="mt-3 text-xs text-indigo-600 font-medium hover:underline">Clear all filters</button>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                <p class="text-sm text-gray-600">
                    Showing <span class="font-medium">{{ $links->firstItem() ?? 0 }}</span>
                    to <span class="font-medium">{{ $links->lastItem() ?? 0 }}</span>
                    of <span class="font-medium">{{ $links->total() }}</span> links
                </p>
                <div class="pagination">{{ $links->links() }}</div>
            </div>
            @else
            <div class="px-6 py-16 text-center">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No affiliate links yet</h3>
                <p class="text-sm text-gray-500 mb-6 max-w-md mx-auto">Start creating affiliate links for your products to track performance.</p>
                <button onclick="openAddModal()" class="btn-add-link text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Create Your First Link
                </button>
            </div>
            @endif
        </div>

        <!-- Tips -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-blue-50 rounded-lg p-4"><div class="flex items-start space-x-3"><div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0"><svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div><div><h4 class="text-sm font-semibold text-gray-900 mb-1">Pro Tip</h4><p class="text-xs text-gray-600">Share your unique links on social media for maximum reach</p></div></div></div>
            <div class="bg-green-50 rounded-lg p-4"><div class="flex items-start space-x-3"><div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0"><svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div><div><h4 class="text-sm font-semibold text-gray-900 mb-1">Performance</h4><p class="text-xs text-gray-600">Links with product images get 40% more clicks</p></div></div></div>
            <div class="bg-purple-50 rounded-lg p-4"><div class="flex items-start space-x-3"><div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0"><svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div><div><h4 class="text-sm font-semibold text-gray-900 mb-1">Update</h4><p class="text-xs text-gray-600">Last link generated 2 hours ago</p></div></div></div>
        </div>
    </div>


    {{-- ══ MODAL 1 — ADD LINK ══ --}}
    <div id="addLinkModal" class="modal-overlay" role="dialog" aria-modal="true">
        <div class="modal-backdrop" onclick="closeAddModal()"></div>
        <div class="modal-card">
            <div class="modal-header">
                <div class="flex items-center justify-between">
                    <div><p class="text-xs font-semibold text-indigo-200 uppercase tracking-widest mb-1">New Affiliate Link</p><h2 class="text-lg font-bold text-white">Generate Product Link</h2></div>
                    <button onclick="closeAddModal()" class="w-8 h-8 rounded-lg bg-white/10 hover:bg-white/20 flex items-center justify-center text-white"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                </div>
            </div>
            <div class="modal-body">
                @if($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 rounded-xl p-3.5">
                    <p class="text-xs font-semibold text-red-700 mb-1">Please fix:</p>
                    @foreach($errors->all() as $error)<p class="text-xs text-red-600">• {{ $error }}</p>@endforeach
                </div>
                @endif
                <form id="addLinkForm" action="{{ route('affiliate.links.store', $affiliate->affiliate_code) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="product_id" class="form-label">Product <span class="text-red-500">*</span></label>
                        <select id="product_id" name="product_id" required class="form-input">
                            <option value="" disabled selected>Select a product…</option>
                            @foreach($products ?? [] as $product)
                                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="link_label" class="form-label">Label <span class="text-gray-400 font-normal">(optional)</span></label>
                        <input type="text" id="link_label" name="label" value="{{ old('label') }}" placeholder="e.g. Instagram Bio, Blog Post #3" class="form-input">
                    </div>
                    <div class="flex items-start gap-2.5 bg-indigo-50 border border-indigo-100 rounded-xl p-3.5">
                        <div class="w-5 h-5 rounded-full bg-indigo-100 flex items-center justify-center flex-shrink-0 mt-0.5"><svg class="w-3 h-3 text-indigo-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg></div>
                        <p class="text-xs text-indigo-700 leading-relaxed">A unique code will be auto-generated for <span class="font-semibold">({{ $affiliate->affiliate_code }})</span>.</p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeAddModal()" class="btn-cancel">Cancel</button>
                <button type="submit" form="addLinkForm" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                    Generate Link
                </button>
            </div>
        </div>
    </div>


    {{-- ══ MODAL 2 — VIEW DETAILS ══ --}}
    <div id="showLinkModal" class="modal-overlay" role="dialog" aria-modal="true">
        <div class="modal-backdrop" onclick="closeShowModal()"></div>
        <div class="modal-card modal-card--lg">
            <div class="modal-header modal-header--slate">
                <div class="flex items-center justify-between">
                    <div><p class="text-xs font-semibold text-slate-300 uppercase tracking-widest mb-1">Link Details</p><h2 class="text-lg font-bold text-white">View Affiliate Link</h2></div>
                    <button onclick="closeShowModal()" class="w-8 h-8 rounded-lg bg-white/10 hover:bg-white/20 flex items-center justify-center text-white"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                </div>
            </div>
            <div class="modal-body">
                <div class="detail-row"><span class="detail-label">Product</span><span class="detail-value font-semibold" id="showProduct">—</span></div>
                <div class="detail-row">
                    <span class="detail-label">Link Code</span>
                    <span class="detail-value"><code class="bg-gray-100 px-2 py-1 rounded text-sm font-mono border border-gray-200" id="showCode">—</code></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Full URL</span>
                    <span class="detail-value">
                        <div class="flex items-center gap-2">
                            <input type="text" id="showUrl" readonly class="form-input text-xs font-mono flex-1" style="min-width:0">
                            <button onclick="copyToClipboard(document.getElementById('showUrl').value)" class="flex-shrink-0 px-3 py-1.5 bg-indigo-50 text-indigo-700 rounded-lg text-xs font-medium hover:bg-indigo-100">Copy</button>
                        </div>
                    </span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Clicks</span>
                    <span class="detail-value">
                        <span class="inline-flex items-center gap-1.5 font-semibold text-green-700 bg-green-50 px-2.5 py-0.5 rounded-full text-sm border border-green-100">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5"></path></svg>
                            <span id="showClicks">0</span>
                        </span>
                    </span>
                </div>
                <div class="detail-row"><span class="detail-label">Created</span><span class="detail-value text-gray-600" id="showCreated">—</span></div>
                <div class="detail-row">
                    <span class="detail-label">Affiliate</span>
                    <span class="detail-value"><span class="inline-flex items-center gap-1 text-indigo-700 bg-indigo-50 px-2.5 py-0.5 rounded-full text-sm font-medium border border-indigo-100">{{ $affiliate->affiliate_code }}</span></span>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="closeShowModal()" class="btn-cancel">Close</button>
                <button onclick="copyToClipboard(document.getElementById('showUrl').value);closeShowModal()" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                    Copy Link
                </button>
            </div>
        </div>
    </div>


    {{-- ══ MODAL 3 — DELETE ══ --}}
    <div id="deleteLinkModal" class="modal-overlay" role="dialog" aria-modal="true">
        <div class="modal-backdrop" onclick="closeDeleteModal()"></div>
        <div class="modal-card modal-card--sm">
            <div class="modal-header modal-header--red">
                <div class="flex items-center justify-between">
                    <div><p class="text-xs font-semibold text-red-200 uppercase tracking-widest mb-1">Confirm Action</p><h2 class="text-lg font-bold text-white">Delete Affiliate Link</h2></div>
                    <button onclick="closeDeleteModal()" class="w-8 h-8 rounded-lg bg-white/10 hover:bg-white/20 flex items-center justify-center text-white"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                </div>
            </div>
            <div class="modal-body">
                <div class="flex items-start gap-3 mb-4">
                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900 mb-1">Are you sure?</p>
                        <p class="text-sm text-gray-500">Deleting the link for <strong id="deleteProductName" class="text-gray-700"></strong> is permanent. All click data will be lost.</p>
                    </div>
                </div>
                <div class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2">
                    <p class="text-xs text-gray-500 font-mono" id="deleteCodeDisplay"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeDeleteModal()" class="btn-cancel">Cancel</button>
                <form id="deleteForm" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Yes, Delete
                    </button>
                </form>
            </div>
        </div>
    </div>


    <script>
    /* ── Modal helpers ── */
    const openModal  = id => { document.getElementById(id).classList.add('open');    document.body.style.overflow='hidden'; };
    const closeModal = id => { document.getElementById(id).classList.remove('open'); document.body.style.overflow=''; };

    function openAddModal()    { openModal('addLinkModal');    setTimeout(()=>document.getElementById('product_id').focus(),100); }
    function closeAddModal()   { closeModal('addLinkModal'); }
    function closeShowModal()  { closeModal('showLinkModal'); }
    function closeDeleteModal(){ closeModal('deleteLinkModal'); }

    function openShowModal(d) {
        closeAllDropdowns();
        document.getElementById('showProduct').textContent = d.product;
        document.getElementById('showCode').textContent    = d.code;
        document.getElementById('showUrl').value           = d.url;
        document.getElementById('showClicks').textContent  = d.clicks;
        document.getElementById('showCreated').textContent = d.created;
        openModal('showLinkModal');
    }

    function openDeleteModal(id, product, code) {
        closeAllDropdowns();
        document.getElementById('deleteProductName').textContent = product;
        document.getElementById('deleteCodeDisplay').textContent = '{{ url('/r/') }}/' + code;
        document.getElementById('deleteForm').action = '/affiliate/{{ $affiliate->affiliate_code }}/links/' + id;
        openModal('deleteLinkModal');
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') { closeAddModal(); closeShowModal(); closeDeleteModal(); closeAllDropdowns(); }
    });

    /* ── Dropdown ── */
    function toggleDropdown(btn) {
        const menu = btn.nextElementSibling;
        const open = menu.classList.contains('open');
        closeAllDropdowns();
        if (!open) menu.classList.add('open');
    }
    function closeAllDropdowns() {
        document.querySelectorAll('.dropdown-menu.open').forEach(m => m.classList.remove('open'));
    }
    document.addEventListener('click', e => { if (!e.target.closest('.dropdown')) closeAllDropdowns(); });

    /* ── Filters ── */
    function applyFilters() {
        const search = document.getElementById('searchInput').value.trim().toLowerCase();
        const sort   = document.getElementById('sortSelect').value;
        const rows   = Array.from(document.querySelectorAll('.link-row'));
        const tbody  = document.getElementById('tableBody');

        let visible = rows.filter(r => {
            if (!search) return true;
            return r.dataset.product.includes(search) || r.dataset.code.includes(search);
        });

        if (sort === 'most_clicked')  visible.sort((a,b) => +b.dataset.clicks   - +a.dataset.clicks);
        if (sort === 'least_clicked') visible.sort((a,b) => +a.dataset.clicks   - +b.dataset.clicks);
        if (sort === 'newest')        visible.sort((a,b) => +b.dataset.created  - +a.dataset.created);
        if (sort === 'oldest')        visible.sort((a,b) => +a.dataset.created  - +b.dataset.created);

        rows.forEach(r => r.classList.add('row-hidden'));
        visible.forEach(r => { r.classList.remove('row-hidden'); tbody.appendChild(r); });

        document.getElementById('noResults').classList.toggle('hidden', visible.length > 0);

        const count = document.getElementById('resultCount');
        if (search || sort) { count.textContent = visible.length + ' of ' + rows.length + ' links shown'; count.classList.remove('hidden'); }
        else count.classList.add('hidden');

        // Pills
        const af          = document.getElementById('activeFilters');
        const searchPill  = document.getElementById('searchPill');
        const sortPill    = document.getElementById('sortPill');
        const labels      = {most_clicked:'Most Clicked',least_clicked:'Least Clicked',newest:'Newest First',oldest:'Oldest First'};

        search ? (document.getElementById('searchPillText').textContent='"'+search+'"', searchPill.classList.remove('hidden'))
               : searchPill.classList.add('hidden');
        sort   ? (document.getElementById('sortPillText').textContent=labels[sort]||sort, sortPill.classList.remove('hidden'))
               : sortPill.classList.add('hidden');
        af.classList.toggle('hidden', !search && !sort);
        document.getElementById('clearBtn').classList.toggle('hidden', !search && !sort);
    }

    function clearSearch() { document.getElementById('searchInput').value=''; applyFilters(); }
    function clearSort()   { document.getElementById('sortSelect').value='';  applyFilters(); }
    function clearFilters(){ clearSearch(); clearSort(); }

    /* ── Copy & Toast ── */
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => showToast('Link copied to clipboard!'));
    }
    function showToast(msg) {
        const t = document.createElement('div');
        t.style.cssText = 'position:fixed;bottom:1.5rem;right:1.5rem;z-index:9999;background:#1f2937;color:#fff;padding:.65rem 1.25rem;border-radius:.65rem;font-size:.83rem;font-weight:500;box-shadow:0 8px 24px rgba(0,0,0,.18);animation:slideUp .22s cubic-bezier(.34,1.2,.64,1);display:flex;align-items:center;gap:.5rem;';
        t.innerHTML = '<svg style="width:14px;height:14px;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>' + msg;
        document.body.appendChild(t);
        setTimeout(() => t.remove(), 2800);
    }

    @if($errors->any()) openAddModal(); @endif
    </script>
</body>
</html>