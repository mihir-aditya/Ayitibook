# 🔧 Professional Orders Dashboard - Code Customization Snippets

## Quick Copy-Paste Customizations

---

## 1. Add New Status Type

### Step 1: Update Status Options in orders.blade.php

```blade
<!-- Find this section around line 90 -->
<select id="statusFilter" class="form-select form-select-sm">
    <option value="">All Statuses</option>
    <option value="pending">Pending</option>
    <option value="processing">Processing</option>
    <option value="shipped">Shipped</option>
    <option value="delivered">Delivered</option>
    <option value="cancelled">Cancelled</option>
    <!-- ADD THIS LINE -->
    <option value="returned">Returned</option>
</select>
```

### Step 2: Add Status Configuration

```blade
<!-- Find status configuration around line 130 -->
@php
$statusConfig = [
    'pending' => ['icon' => '⏳', 'class' => 'badge-warning', 'label' => 'Pending'],
    'processing' => ['icon' => '🔄', 'class' => 'badge-info', 'label' => 'Processing'],
    'shipped' => ['icon' => '📦', 'class' => 'badge-primary', 'label' => 'Shipped'],
    'delivered' => ['icon' => '✅', 'class' => 'badge-success', 'label' => 'Delivered'],
    'cancelled' => ['icon' => '❌', 'class' => 'badge-danger', 'label' => 'Cancelled'],
    // ADD THIS LINE
    'returned' => ['icon' => '↩️', 'class' => 'badge-secondary', 'label' => 'Returned'],
];
@endphp
```

### Step 3: Update orderdetails.blade.php Timeline

```blade
<!-- Find timeline section around line 40 -->
@php
$statuses = ['pending', 'processing', 'shipped', 'delivered', 'returned']; // ADD 'returned'
$currentIndex = array_search($order->order_status, $statuses);
@endphp
```

### Step 4: Update Status Dropdown in orderdetails.blade.php

```blade
<!-- Find dropdown around line 75 -->
<select id="statusSelect" class="form-select form-select-sm" style="max-width: 200px;">
    <option value="pending">Pending</option>
    <option value="processing">Processing</option>
    <option value="shipped">Shipped</option>
    <option value="delivered">Delivered</option>
    <option value="cancelled">Cancelled</option>
    <!-- ADD THIS LINE -->
    <option value="returned">Returned</option>
</select>
```

---

## 2. Change Color Scheme

### Example 1: Use Purple instead of Primary Blue

```blade
<!-- In orders.blade.php, find and replace -->

<!-- FROM: -->
<span class="badge bg-primary rounded-circle p-3">

<!-- TO: -->
<span class="badge bg-purple rounded-circle p-3">

<!-- Add to CSS section -->
<style>
    .bg-purple { background-color: #6f42c1 !important; }
</style>
```

### Example 2: Change Status Colors

```blade
<!-- Update status configuration -->
@php
$statusConfig = [
    'pending' => ['icon' => '⏳', 'class' => 'badge-secondary', 'label' => 'Pending'],  // Changed from warning
    'processing' => ['icon' => '🔄', 'class' => 'badge-primary', 'label' => 'Processing'],
    'shipped' => ['icon' => '📦', 'class' => 'badge-info', 'label' => 'Shipped'],  // Changed from primary
    'delivered' => ['icon' => '✅', 'class' => 'badge-success', 'label' => 'Delivered'],
    'cancelled' => ['icon' => '❌', 'class' => 'badge-danger', 'label' => 'Cancelled'],
];
@endphp
```

---

## 3. Modify Statistics Cards

### Change Displayed Statistics

```blade
<!-- In orders.blade.php, find statistics section -->

<!-- CHANGE THIS CARD -->
<div class="col-md-3 mb-3">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted small mb-1">Pending Orders</p>
                    <h4 class="mb-0">{{ $orders->where('order_status', 'pending')->count() }}</h4>
                </div>
                <span class="badge bg-warning rounded-circle p-3">
                    <i class="fas fa-clock"></i>
                </span>
            </div>
        </div>
    </div>
</div>

<!-- TO THIS -->
<div class="col-md-3 mb-3">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted small mb-1">Completed Orders</p>
                    <h4 class="mb-0">{{ $orders->where('order_status', 'delivered')->count() }}</h4>
                </div>
                <span class="badge bg-success rounded-circle p-3">
                    <i class="fas fa-check-circle"></i>
                </span>
            </div>
        </div>
    </div>
</div>
```

---

## 4. Add Export to CSV Functionality

### JavaScript Function

```javascript
// Add to JavaScript section in orders.blade.php
function exportOrders() {
    const rows = [];
    const headers = ['Order ID', 'Customer', 'Amount', 'Status', 'Date'];
    rows.push(headers.join(','));
    
    document.querySelectorAll('.order-row').forEach(row => {
        const orderId = row.dataset.orderId;
        const customer = row.querySelector('p.fw-500').textContent;
        const amount = row.querySelector('.fw-bold').textContent;
        const status = row.dataset.status;
        const date = row.dataset.date?.split('T')[0] || '';
        
        rows.push(`"${orderId}","${customer}","${amount}","${status}","${date}"`);
    });
    
    const csv = rows.join('\n');
    const blob = new Blob([csv], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.download = `orders_${new Date().toISOString().split('T')[0]}.csv`;
    link.click();
}
```

---

## 5. Add Bulk Order Actions

### HTML for Checkboxes

```blade
<!-- Add to table header in orders.blade.php -->
<thead class="table-light">
    <tr>
        <!-- ADD THIS COLUMN -->
        <th class="ps-4">
            <input type="checkbox" id="selectAll" class="order-checkbox-header" 
                   onchange="toggleSelectAll(this)">
        </th>
        <th class="ps-4">Order ID</th>
        <!-- REST OF HEADERS -->
    </tr>
</thead>

<!-- Add to table body rows -->
<tbody>
    @forelse($orders as $order)
    <tr class="order-row">
        <!-- ADD THIS COLUMN -->
        <td class="ps-4">
            <input type="checkbox" class="order-checkbox" value="{{ $order->sl_no }}">
        </td>
        <!-- REST OF ROW -->
    </tr>
    @endforelse
</tbody>
```

### JavaScript Functions

```javascript
// Add these functions to JavaScript section
function toggleSelectAll(checkbox) {
    document.querySelectorAll('.order-checkbox').forEach(cb => {
        cb.checked = checkbox.checked;
    });
}

function getSelectedOrders() {
    const selected = [];
    document.querySelectorAll('.order-checkbox:checked').forEach(cb => {
        if (cb.value) selected.push(cb.value);
    });
    return selected;
}

function bulkMarkShipped() {
    const selected = getSelectedOrders();
    if (selected.length === 0) {
        alert('Please select orders first');
        return;
    }
    if (confirm(`Mark ${selected.length} orders as shipped?`)) {
        // Send to backend
        console.log('Bulk shipping:', selected);
    }
}

function bulkDelete() {
    const selected = getSelectedOrders();
    if (selected.length === 0) {
        alert('Please select orders first');
        return;
    }
    if (confirm(`Delete ${selected.length} orders? This cannot be undone.`)) {
        // Send to backend
        console.log('Bulk delete:', selected);
    }
}
```

### Add Bulk Action Buttons

```blade
<!-- Add above the table in orders.blade.php -->
<div class="mb-3">
    <button class="btn btn-sm btn-warning" onclick="bulkMarkShipped()">
        <i class="fas fa-shipping-fast"></i> Bulk Mark Shipped
    </button>
    <button class="btn btn-sm btn-danger" onclick="bulkDelete()">
        <i class="fas fa-trash"></i> Bulk Delete
    </button>
</div>
```

---

## 6. Change Table Columns

### Add/Remove a Column

```blade
<!-- EXAMPLE: Add SKU column to orders table -->

<!-- In table header (around line 110) -->
<thead class="table-light">
    <tr>
        <th class="ps-4">Order ID</th>
        <th>Customer</th>
        <th>Amount</th>
        <th>Payment</th>
        <th>SKU</th>        <!-- ADD THIS COLUMN HEADER -->
        <th>Status</th>
        <th>Date</th>
        <th>Actions</th>
    </tr>
</thead>

<!-- In table body (around line 150) -->
<td>
    <small class="text-muted">{{ $order->sku ?? 'N/A' }}</small>  <!-- ADD THIS CELL -->
</td>
```

---

## 7. Customize Status Timeline Steps

### Change from 4 Steps to 3 Steps

```blade
<!-- In orderdetails.blade.php, around line 60 -->

<!-- FROM (4 steps): -->
@foreach(['pending' => 'Pending', 'processing' => 'Processing', 'shipped' => 'Shipped', 'delivered' => 'Delivered'] as $status => $label)

<!-- TO (3 steps): -->
@foreach(['pending' => 'Received', 'processing' => 'Confirmed', 'delivered' => 'Delivered'] as $status => $label)

<!-- And update the statuses array: -->
@php
$statuses = ['pending', 'processing', 'delivered'];  // Was 4, now 3
@endphp
```

---

## 8. Add Customer Avatar

### Replace User Icon with Initials

```blade
<!-- In orders.blade.php, find avatar section around line 150 -->

<!-- FROM: -->
<div class="avatar avatar-sm bg-light rounded-circle me-2 d-flex align-items-center justify-content-center" 
     style="width: 32px; height: 32px;">
    <i class="fas fa-user text-primary"></i>
</div>

<!-- TO: -->
<div class="avatar avatar-sm bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center text-white" 
     style="width: 32px; height: 32px; font-weight: bold; font-size: 12px;">
    {{ strtoupper(substr($order->user->name ?? 'N', 0, 1)) }}
    {{ strtoupper(substr(explode(' ', $order->user->name ?? 'N')[1] ?? '', 0, 1)) }}
</div>
```

---

## 9. Customize Print Layout

### Hide Specific Elements When Printing

```blade
<!-- Add to CSS section -->
<style>
@media print {
    /* Hide these when printing */
    .btn, .btn-group, .dropdown-toggle,
    .pagination, .filter-section {
        display: none !important;
    }
    
    /* Adjust table for print */
    .table {
        font-size: 12px;
    }
    
    /* Show full width */
    .container-fluid {
        max-width: 100% !important;
    }
    
    /* Adjust colors for print */
    .table tbody tr {
        page-break-inside: avoid;
    }
}
</style>
```

---

## 10. Add Date Range Filter

### Enhance Date Filter

```blade
<!-- Replace simple date input -->

<!-- FROM: -->
<input type="date" id="dateFilter" class="form-control form-control-sm">

<!-- TO: -->
<div class="d-flex gap-2">
    <div class="flex-grow-1">
        <small class="d-block text-muted mb-1">From</small>
        <input type="date" id="dateFromFilter" class="form-control form-control-sm" 
               onchange="applyFilters()">
    </div>
    <div class="flex-grow-1">
        <small class="d-block text-muted mb-1">To</small>
        <input type="date" id="dateToFilter" class="form-control form-control-sm" 
               onchange="applyFilters()">
    </div>
</div>
```

### Update Filter JavaScript

```javascript
// Find date filter logic and update to:
const dateFrom = document.getElementById('dateFromFilter')?.value;
const dateTo = document.getElementById('dateToFilter')?.value;
const rowDate = row.dataset.date?.split('T')[0];

const matchesDateRange = !dateFrom && !dateTo || 
    (rowDate >= dateFrom && rowDate <= dateTo);
```

---

## 11. Add Payment Method Icons

### Enhance Payment Display

```blade
<!-- Replace plain payment method -->

<!-- FROM: -->
<span class="badge bg-light text-dark">{{ ucfirst($order->payment_method) }}</span>

<!-- TO: -->
@php
$paymentIcons = [
    'card' => '💳',
    'cash' => '💵',
    'bank' => '🏦',
    'online' => '🌐',
    'paypal' => '🅿️',
    'stripe' => '⚡',
];
@endphp
<span class="badge bg-light text-dark">
    {{ $paymentIcons[$order->payment_method] ?? '💰' }}
    {{ ucfirst($order->payment_method) }}
</span>
```

---

## 12. Add Customer Tier/Badge

### Show VIP or Regular Customer

```blade
<!-- In orders.blade.php customer display -->

<!-- ADD AFTER CUSTOMER NAME: -->
@if($order->user->is_vip)
    <span class="badge bg-gold"><i class="fas fa-crown"></i> VIP</span>
@endif

@if($order->user->total_orders > 10)
    <span class="badge bg-success"><i class="fas fa-star"></i> Loyal</span>
@endif
```

---

## 13. Format Currency Dynamically

### Support Multiple Currencies

```blade
@php
function formatCurrency($amount, $currency = 'PKR') {
    $symbols = [
        'PKR' => 'Rs. ',
        'USD' => '$ ',
        'EUR' => '€ ',
        'GBP' => '£ ',
    ];
    return ($symbols[$currency] ?? 'Rs. ') . number_format($amount, 2);
}
@endphp

<!-- Use in templates: -->
<td>{{ formatCurrency($order->total_amount, 'PKR') }}</td>
```

---

## 14. Add Order Search by Multiple Criteria

### Advanced Search

```javascript
// Replace search function
function advancedSearch() {
    const searchValue = document.getElementById('searchInput').value.toLowerCase();
    const searchType = document.getElementById('searchType')?.value || 'all';
    
    document.querySelectorAll('.order-row').forEach(row => {
        const orderId = row.dataset.orderId.toLowerCase();
        const customer = row.textContent.toLowerCase();
        const email = row.querySelector('.text-muted')?.textContent.toLowerCase() || '';
        
        let matches = false;
        
        if (searchType === 'all' || searchType === 'orderId') {
            matches = orderId.includes(searchValue);
        } else if (searchType === 'customer') {
            matches = customer.includes(searchValue);
        } else if (searchType === 'email') {
            matches = email.includes(searchValue);
        }
        
        row.style.display = matches ? '' : 'none';
    });
}
```

### Add Search Type Selector

```blade
<!-- Add dropdown before search input -->
<div class="col-md-3">
    <label class="form-label small text-muted">Search Type</label>
    <select id="searchType" class="form-select form-select-sm" onchange="advancedSearch()">
        <option value="all">All Fields</option>
        <option value="orderId">Order ID</option>
        <option value="customer">Customer Name</option>
        <option value="email">Email</option>
    </select>
</div>
```

---

## 15. Add Order Tracking Number

### Display Shipping Tracking

```blade
<!-- In orderdetails.blade.php, add to Order Status section -->

<div class="mt-3 pt-3 border-top">
    @if($order->tracking_number)
        <label class="form-label small text-muted">Tracking Number</label>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" 
                   value="{{ $order->tracking_number }}" readonly>
            <button class="btn btn-sm btn-outline-primary" 
                    onclick="copyToClipboard('{{ $order->tracking_number }}')">
                <i class="fas fa-copy"></i>
            </button>
        </div>
        <a href="#" class="btn btn-sm btn-link mt-2">Track Shipment</a>
    @else
        <p class="text-muted small">No tracking number assigned yet</p>
    @endif
</div>
```

### Copy to Clipboard Function

```javascript
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        alert('Copied to clipboard!');
    });
}
```

---

## Code Style Guidelines

When adding custom code, follow these patterns:

### Blade Templating:
```blade
{{ $variable }}                      <!-- Single echo -->
@if($condition)  @endif              <!-- Control structures -->
@foreach() @endforeach               <!-- Loops -->
{{ $items->where('key', 'value') }}  <!-- Eloquent methods -->
```

### HTML Structure:
```html
<div class="container-fluid">        <!-- Full-width container -->
<div class="row">                    <!-- Bootstrap grid row -->
<div class="col-md-4">               <!-- Responsive columns -->
<div class="card border-0">          <!-- Card components -->
```

### CSS Classes:
```
Bootstrap utilities for spacing, sizing, colors
Custom classes with meaningful names
Media queries for responsive design
Print media queries for print optimization
```

### JavaScript:
```javascript
// Use arrow functions for cleaner syntax
const example = () => { ... }

// Use const/let, not var
const variableName = value;

// Use template literals for strings
`Text with ${variable}`
```

---

**These snippets provide quick copy-paste solutions for common customizations.**

*Last Updated: January 10, 2025*
