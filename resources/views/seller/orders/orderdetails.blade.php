{{-- resources/views/seller/orders/orderdetails.blade.php --}}
@php $seller = Auth::guard('seller')->user(); @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->order_id }} — SellerHub</title>
    @include('seller.partials._base')
    <style>
        .od-grid { display: grid; grid-template-columns: 1fr 340px; gap: 20px; align-items: start; }
        @media(max-width:1024px){ .od-grid { grid-template-columns: 1fr; } }

        /* Status Timeline */
        .sh-timeline { display: flex; align-items: center; }
        .sh-tl-step  { display: flex; flex-direction: column; align-items: center; flex: 1; text-align: center; }
        .sh-tl-dot {
            width: 36px; height: 36px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; font-weight: 700; flex-shrink: 0;
            border: 2px solid var(--border); background: var(--surface); color: var(--sub);
            transition: all .3s; position: relative; z-index: 2;
        }
        .sh-tl-dot.done   { border-color: var(--accent2); background: var(--accent2-bg); color: var(--accent2); }
        .sh-tl-dot.active { border-color: var(--accent);  background: var(--accent-bg);  color: var(--accent);
                            box-shadow: 0 0 0 4px rgba(91,124,250,.12); }
        .sh-tl-label { font-size: 11px; font-weight: 600; color: var(--sub); margin-top: 6px; }
        .sh-tl-label.done   { color: var(--accent2); }
        .sh-tl-label.active { color: var(--accent); }
        .sh-tl-line { flex: 1; height: 2px; background: var(--border); margin: 0 -1px; margin-bottom: 18px; transition: background .3s; }
        .sh-tl-line.done { background: var(--accent2); }

        /* Sidebar info rows */
        .sh-info-row { padding: 10px 0; border-bottom: 1px solid var(--border); display: flex; flex-direction: column; gap: 2px; }
        .sh-info-row:last-child { border-bottom: none; padding-bottom: 0; }
        .sh-info-label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; color: var(--sub); }
        .sh-info-value { font-size: 13.5px; font-weight: 500; color: var(--text); margin-top: 1px; }
        .sh-info-value a { color: var(--accent); }

        /* Order item row */
        .oi-row { display: flex; align-items: center; gap: 16px; padding: 16px 22px; border-bottom: 1px solid var(--border); }
        .oi-row:last-child { border-bottom: none; }

        /* Thumbnail */
        .oi-thumb {
            width: 60px; height: 60px; border-radius: 10px; flex-shrink: 0;
            border: 1px solid var(--border); background: var(--muted);
            overflow: hidden; display: flex; align-items: center; justify-content: center;
        }
        .oi-thumb img  { width: 100%; height: 100%; object-fit: cover; display: block; }
        .oi-thumb-icon { font-size: 26px; line-height: 1; }

        /* Product info */
        .oi-info { flex: 1; min-width: 0; }
        .oi-name { font-size: 14px; font-weight: 700; color: var(--text); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .oi-tags { display: flex; flex-wrap: wrap; gap: 5px; margin-top: 5px; }
        .oi-tag  {
            display: inline-flex; align-items: center; gap: 3px;
            font-size: 11px; font-weight: 600; padding: 2px 8px;
            border-radius: 5px; background: var(--muted); color: var(--sub); border: 1px solid var(--border);
        }
        .oi-tag.variant { background: var(--accent-bg); color: var(--accent); border-color: rgba(91,124,250,.2); }
        .oi-tag.sku     { font-family: var(--mono); }
        .oi-tag.stock   { background: var(--accent2-bg); color: var(--accent2); border-color: rgba(16,185,129,.2); }
        .oi-tag.nostock { background: var(--danger-bg);  color: var(--danger);  border-color: rgba(239,68,68,.2); }

        /* Right: qty + prices */
        .oi-right    { text-align: right; flex-shrink: 0; }
        .oi-qty      { display: inline-flex; align-items: center; justify-content: center; min-width: 30px; height: 24px; border-radius: 6px; background: var(--muted); font-size: 12px; font-weight: 700; color: var(--text2); padding: 0 8px; margin-bottom: 4px; }
        .oi-unit     { font-size: 11.5px; color: var(--sub); margin-bottom: 2px; }
        .oi-total    { font-family: var(--mono); font-size: 14px; font-weight: 700; color: var(--text); }

        /* Order summary */
        .sum-row { display: flex; justify-content: space-between; align-items: center; padding: 8px 0; border-bottom: 1px solid var(--border); }
        .sum-row:last-child { border-bottom: none; }
        .sum-label { font-size: 13px; color: var(--sub); }
        .sum-value { font-size: 13px; font-family: var(--mono); font-weight: 600; color: var(--text); }
        .sum-row.total .sum-label { font-size: 15px; font-weight: 700; color: var(--text); }
        .sum-row.total .sum-value { font-size: 18px; color: var(--accent2); }

        /* Quick action btns */
        .qa-btn {
            display: flex; align-items: center; gap: 8px;
            padding: 10px 14px; border-radius: 9px; font-size: 13px; font-weight: 500;
            cursor: pointer; border: 1px solid var(--border); background: var(--surface);
            color: var(--text2); transition: all .15s; text-align: left; width: 100%;
        }
        .qa-btn:hover        { background: var(--bg); border-color: var(--border2); }
        .qa-btn.primary:hover { background: var(--accent-bg);  border-color: var(--accent); color: var(--accent); }
        .qa-btn.danger:hover  { background: var(--danger-bg);  border-color: var(--danger);  color: var(--danger); }
    </style>
</head>
<body>
<div class="sh-layout">

    @include('seller.partials._sidebar', ['active' => 'orders'])

    <header class="sh-header">
        <div class="sh-header-left">
            <div>
                <div class="sh-header-title">Order #{{ $order->order_id }}</div>
                <div class="sh-header-sub">Placed {{ $order->placed_at?->format('M d, Y \a\t h:i A') ?? 'N/A' }}</div>
            </div>
        </div>
        <div class="sh-header-right">
            <a href="{{ route('seller.orders.index') }}" class="sh-icon-btn">🛒</a>
            <a href="#" class="sh-icon-btn">🔔</a>
            <form method="POST" action="{{ route('seller.logout') }}" style="display:inline">
                @csrf <button type="submit" class="sh-icon-btn">↩</button>
            </form>
        </div>
    </header>

    <main class="sh-main">

        <div class="sh-breadcrumb">
            <a href="{{ route('seller.orders.index') }}">Orders</a>
            <span class="sep">/</span>
            <span class="current">#{{ $order->order_id }}</span>
        </div>

        <div class="sh-page-header">
            <div>
                <div class="sh-page-title">Order #{{ $order->order_id }}</div>
                <div class="sh-page-sub">Placed {{ $order->placed_at?->format('M d, Y \a\t h:i A') ?? 'N/A' }}</div>
            </div>
            <div class="sh-page-actions">
                <button class="sh-btn sh-btn-secondary" onclick="window.print()">
                    <i class="fas fa-print"></i> Print
                </button>
                <button class="sh-btn sh-btn-secondary" id="downloadInvoiceBtn">
                    <i class="fas fa-file-pdf"></i> Invoice
                </button>
                <button class="sh-btn sh-btn-secondary" id="shippingLabelBtn"
                        style="color:var(--accent3); border-color:rgba(245,158,11,.3);">
                    <i class="fas fa-shipping-fast"></i> Shipping Label
                </button>
            </div>
        </div>

        <div class="od-grid">

            {{-- ══════════════ LEFT COLUMN ══════════════ --}}
            <div style="display:flex; flex-direction:column; gap:20px;">

                {{-- Status Timeline --}}
                <div class="sh-card">
                    <div class="sh-card-header">
                        <div class="sh-card-title">📍 Order Status</div>
                        <span class="sh-pill sh-pill-{{ $order->order_status }}">{{ ucfirst($order->order_status) }}</span>
                    </div>
                    <div class="sh-card-body">
                        @php
                            $timelineStatuses = ['placed','confirmed','shipped','delivered'];
                            $currentIndex     = array_search($order->order_status, $timelineStatuses);
                            if ($currentIndex === false) $currentIndex = -1;
                        @endphp
                        <div class="sh-timeline">
                            @foreach(['placed'=>'Placed','confirmed'=>'Confirmed','shipped'=>'Shipped','delivered'=>'Delivered'] as $st => $lbl)
                                @php
                                    $si        = array_search($st, $timelineStatuses);
                                    $isDone    = $si !== false && $si < $currentIndex;
                                    $isCurrent = $order->order_status === $st;
                                @endphp
                                <div class="sh-tl-step">
                                    <div class="sh-tl-dot {{ $isDone ? 'done' : ($isCurrent ? 'active' : '') }}">
                                        @if($isDone)         <i class="fas fa-check"  style="font-size:12px;"></i>
                                        @elseif($isCurrent)  <i class="fas fa-circle" style="font-size:8px;"></i>
                                        @else                <i class="far fa-circle" style="font-size:11px;"></i>
                                        @endif
                                    </div>
                                    <span class="sh-tl-label {{ $isDone ? 'done' : ($isCurrent ? 'active' : '') }}">{{ $lbl }}</span>
                                </div>
                                @if(!$loop->last)
                                    <div class="sh-tl-line {{ $isDone ? 'done' : '' }}"></div>
                                @endif
                            @endforeach
                        </div>

                        <div style="margin-top:20px; padding-top:18px; border-top:1px solid var(--border);">
                            <div style="display:flex; align-items:flex-end; gap:10px; flex-wrap:wrap;">
                                <div style="flex:1; min-width:160px;">
                                    <label class="sh-label">Update Status</label>
                                    <select id="statusSelect" class="sh-select"
                                        data-current-status="{{ $order->order_status }}"
                                        data-order-id="{{ $order->sl_no }}">
                                        @foreach(['confirmed'=>'Confirmed','shipped'=>'Shipped','refunded'=>'Refunded'] as $val => $label)
                                            <option value="{{ $val }}" {{ $order->order_status === $val ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="sh-btn sh-btn-primary" onclick="updateOrderStatus()">
                                    <i class="fas fa-sync-alt"></i> Update
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ── Order Items ── --}}
                <div class="sh-card">
                    <div class="sh-card-header">
                        <div class="sh-card-title">📦 Order Items</div>
                        <span style="font-size:12px; color:var(--sub);">
                            {{ $items->count() }} item{{ $items->count() !== 1 ? 's' : '' }}
                        </span>
                    </div>

                    @forelse($items as $item)
                    @php
                        $product  = $item->product;   // Product model (has all accessors)
                        $variant  = $item->variant;   // ProductVariant model or null
                        $currency = $product?->currency ?? 'Rs.';
                        $lineTotal = $item->quantity * $item->price;

                        // Thumbnail: use Storage::url() directly - no custom accessor needed
                        $variantImages = $variant?->images
                            ? (is_array($variant->images) ? $variant->images : json_decode($variant->images, true))
                            : [];
                        $thumbUrl = !empty($variantImages)
                            ? \Illuminate\Support\Facades\Storage::url($variantImages[0])
                            : ($product?->thumbnail
                                ? \Illuminate\Support\Facades\Storage::url($product->thumbnail)
                                : null);
                    @endphp
                    <div class="oi-row">

                        {{-- Thumbnail --}}
                        <div class="oi-thumb">
                            @if($thumbUrl)
                                <img src="{{ $thumbUrl }}" alt="{{ $product?->name }}"
                                     onerror="this.parentElement.innerHTML='<span class=\'oi-thumb-icon\'>📦</span>'">
                            @else
                                <span class="oi-thumb-icon">📦</span>
                            @endif
                        </div>

                        {{-- Product details --}}
                        <div class="oi-info">
                            <div class="oi-name" title="{{ $product?->name ?? 'Unknown Product' }}">
                                {{ $product?->name ?? 'Unknown Product' }}
                            </div>

                            <div class="oi-tags">
                                {{-- Product ID --}}
                                <span class="oi-tag">
                                    <i class="fas fa-hashtag" style="font-size:9px;"></i>
                                    #{{ $item->product_id }}
                                </span>

                                {{-- Product SKU --}}
                                @if($product?->sku)
                                    <span class="oi-tag sku">
                                        <i class="fas fa-barcode" style="font-size:9px;"></i>
                                        {{ $product->sku }}
                                    </span>
                                @endif

                                {{-- Variant --}}
                                @if($variant)
                                    <span class="oi-tag variant">
                                        <i class="fas fa-tag" style="font-size:9px;"></i>
                                        {{ $variant->variant_name }}
                                        @if($variant->sku) · {{ $variant->sku }} @endif
                                    </span>
                                @endif

                                {{-- Size (stored directly on order item) --}}
                                @if($item->size)
                                    <span class="oi-tag" style="background:rgba(245,158,11,.1);color:#b45309;border-color:rgba(245,158,11,.2);">
                                        <i class="fas fa-ruler" style="font-size:9px;"></i>
                                        {{ $item->size }}
                                    </span>
                                @endif

                                {{-- Stock status from product --}}
                                @if($product)
                                    @if(($product->stock_quantity ?? 0) > 0)
                                        <span class="oi-tag stock">
                                            <i class="fas fa-check-circle" style="font-size:9px;"></i>
                                            In Stock ({{ $product->stock_quantity }})
                                        </span>
                                    @else
                                        <span class="oi-tag nostock">
                                            <i class="fas fa-times-circle" style="font-size:9px;"></i>
                                            Out of Stock
                                        </span>
                                    @endif

                                    {{-- Discount badge --}}
                                    @if($product->discount_price)
                                        @php
                                        $discPct = ($product->price > 0 && $product->discount_price)
                                            ? round((($product->price - $product->discount_price) / $product->price) * 100)
                                            : 0;
                                    @endphp
                                    <span class="oi-tag" style="background:rgba(245,158,11,.1); color:#d97706; border-color:rgba(245,158,11,.2);">
                                            <i class="fas fa-percent" style="font-size:9px;"></i>
                                            {{ $discPct }}% off
                                        </span>
                                    @endif
                                @endif
                            </div>
                        </div>

                        {{-- Qty + Price --}}
                        <div class="oi-right">
                            <div class="oi-qty">×{{ $item->quantity }}</div>
                            <div class="oi-unit">{{ $currency }} {{ number_format($item->price, 2) }} each</div>
                            <div class="oi-total">{{ $currency }} {{ number_format($lineTotal, 2) }}</div>
                        </div>

                    </div>
                    @empty
                    <div class="sh-empty">
                        <div class="sh-empty-icon">📭</div>
                        <div class="sh-empty-sub">No items found for this order</div>
                    </div>
                    @endforelse

                    {{-- Summary footer --}}
                    @php
                        $itemsTotal = $items->sum(fn($i) => $i->quantity * $i->price);
                        $currency   = $items->first()?->product?->currency ?? 'Rs.';
                    @endphp
                    <div style="padding:16px 22px; border-top:1px solid var(--border); background:var(--bg); border-radius:0 0 var(--radius) var(--radius);">
                        <div style="max-width:300px; margin-left:auto;">
                            <div class="sum-row">
                                <span class="sum-label">
                                    Subtotal
                                    <span style="color:var(--sub);font-size:11px;">({{ $items->sum('quantity') }} items)</span>
                                </span>
                                <span class="sum-value">{{ $currency }} {{ number_format($itemsTotal, 2) }}</span>
                            </div>
                            @if(($order->shipping_fee ?? 0) > 0)
                            <div class="sum-row">
                                <span class="sum-label">Shipping</span>
                                <span class="sum-value">{{ $currency }} {{ number_format($order->shipping_fee, 2) }}</span>
                            </div>
                            @else
                            <div class="sum-row">
                                <span class="sum-label">Shipping</span>
                                <span class="sum-value" style="color:var(--accent2);">Free</span>
                            </div>
                            @endif
                            @if(($order->tax ?? 0) > 0)
                            <div class="sum-row">
                                <span class="sum-label">Tax</span>
                                <span class="sum-value">{{ $currency }} {{ number_format($order->tax, 2) }}</span>
                            </div>
                            @endif
                            @if(($order->discount_amount ?? 0) > 0)
                            <div class="sum-row">
                                <span class="sum-label">
                                    Discount
                                    @if($order->coupon_code)
                                        <span style="font-size:10px;background:rgba(16,185,129,.12);color:var(--accent2);border-radius:4px;padding:1px 6px;margin-left:4px;">{{ $order->coupon_code }}</span>
                                    @endif
                                </span>
                                <span class="sum-value" style="color:var(--accent2);">- {{ $currency }} {{ number_format($order->discount_amount, 2) }}</span>
                            </div>
                            @endif
                            <div class="sum-row total">
                                <span class="sum-label">Total</span>
                                <span class="sum-value">{{ $currency }} {{ number_format($order->total_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Notes --}}
                <div class="sh-card">
                    <div class="sh-card-header">
                        <div class="sh-card-title">📝 Order Notes</div>
                    </div>
                    <div class="sh-card-body">
                        <label class="sh-label">Internal Notes</label>
                        <textarea id="orderNotes" class="sh-textarea" rows="4"
                            placeholder="Add internal notes about this order...">{{ $order->notes ?? '' }}</textarea>
                        <button id="saveNotesBtn" class="sh-btn sh-btn-primary" style="margin-top:12px;" disabled>
                            <i class="fas fa-save"></i> Save Notes
                        </button>
                    </div>
                </div>

            </div>{{-- /left --}}

            {{-- ══════════════ RIGHT SIDEBAR ══════════════ --}}
            <div style="display:flex; flex-direction:column; gap:16px;">

                {{-- Customer --}}
                <div class="sh-card">
                    <div class="sh-card-header">
                        <div class="sh-card-title">👤 Customer</div>
                    </div>
                    <div class="sh-card-body" style="padding:16px 22px;">
                        <div style="display:flex; align-items:center; gap:12px; margin-bottom:16px;">
                            <div style="width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,var(--accent),#8b5cf6);display:flex;align-items:center;justify-content:center;font-weight:700;color:#fff;font-size:16px;flex-shrink:0;">
                                {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-weight:700;font-size:14px;color:var(--text);">{{ $user->name ?? 'N/A' }}</div>
                                <div style="font-size:12px;color:var(--sub);">Customer #{{ $order->user_id }}</div>
                            </div>
                        </div>
                        <div class="sh-info-row">
                            <div class="sh-info-label">Email</div>
                            <div class="sh-info-value">
                                @if($user?->email)
                                    <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                @else N/A @endif
                            </div>
                        </div>
                        <div class="sh-info-row">
                            <div class="sh-info-label">Phone</div>
                            <div class="sh-info-value">{{ $user->phone ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>

                {{-- Shipping Address --}}
                <div class="sh-card">
                    <div class="sh-card-header">
                        <div class="sh-card-title">📍 Shipping Address</div>
                    </div>
                    <div class="sh-card-body" style="padding:16px 22px;">
                        @if($address)
                            <div style="font-size:13.5px;line-height:1.9;color:var(--text2);">
                                <strong>{{ $address->first_name }} {{ $address->last_name }}</strong><br>
                                @if($address->phone) 📞 {{ $address->phone }}<br> @endif
                                {{ $address->address ?? '' }}<br>
                                {{ $address->city ?? '' }}{{ ($address->city && $address->state) ? ', ' : '' }}{{ $address->state ?? '' }} {{ $address->pincode ?? '' }}<br>
                                <span style="color:var(--sub);">{{ $address->country ?? '' }}</span>
                            </div>
                        @else
                            <div style="color:var(--sub);font-size:13px;font-style:italic;">No shipping address on file</div>
                        @endif
                    </div>
                </div>

                {{-- Payment --}}
                <div class="sh-card">
                    <div class="sh-card-header">
                        <div class="sh-card-title">💳 Payment</div>
                    </div>
                    <div class="sh-card-body" style="padding:16px 22px;">
                        <div class="sh-info-row">
                            <div class="sh-info-label">Method</div>
                            <div class="sh-info-value">
                                <span class="sh-pill sh-pill-shipped">{{ $order->payment_method ?? 'Unknown' }}</span>
                            </div>
                        </div>
                        <div class="sh-info-row">
                            <div class="sh-info-label">Total Charged</div>
                            <div class="sh-info-value" style="font-family:var(--mono);font-size:18px;font-weight:700;color:var(--accent2);">
                                Rs. {{ number_format($order->total_amount, 2) }}
                            </div>
                        </div>
                        @if(($order->shipping_fee ?? 0) > 0)
                        <div class="sh-info-row">
                            <div class="sh-info-label">Shipping Fee</div>
                            <div class="sh-info-value">Rs. {{ number_format($order->shipping_fee, 2) }}</div>
                        </div>
                        @endif
                        @if(($order->tax ?? 0) > 0)
                        <div class="sh-info-row">
                            <div class="sh-info-label">Tax</div>
                            <div class="sh-info-value">Rs. {{ number_format($order->tax, 2) }}</div>
                        </div>
                        @endif
                        @if(($order->discount_amount ?? 0) > 0)
                        <div class="sh-info-row">
                            <div class="sh-info-label">Discount</div>
                            <div class="sh-info-value" style="color:var(--accent2);">- Rs. {{ number_format($order->discount_amount, 2) }}</div>
                        </div>
                        @endif
                        @if($order->coupon_code)
                        <div class="sh-info-row">
                            <div class="sh-info-label">Coupon Code</div>
                            <div class="sh-info-value" style="color:var(--accent2);font-family:var(--mono);">{{ $order->coupon_code }}</div>
                        </div>
                        @endif
                        <div class="sh-info-row">
                            <div class="sh-info-label">Order Date</div>
                            <div class="sh-info-value">{{ $order->placed_at?->format('M d, Y · h:i A') ?? 'N/A' }}</div>
                        </div>
                        <div class="sh-info-row">
                            <div class="sh-info-label">Order ID</div>
                            <div class="sh-info-value" style="font-family:var(--mono);">{{ $order->order_id }}</div>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="sh-card">
                    <div class="sh-card-header">
                        <div class="sh-card-title">⚡ Quick Actions</div>
                    </div>
                    <div class="sh-card-body" style="padding:12px 16px;display:flex;flex-direction:column;gap:8px;">
                        <button class="qa-btn primary" onclick="sendNotification()">
                            <span style="font-size:16px;">🔔</span> Send Notification
                        </button>
                        <button class="qa-btn primary" id="downloadInvoiceBtn2">
                            <span style="font-size:16px;">📄</span> Download Invoice
                        </button>
                        <button class="qa-btn primary" id="contactCustomerBtn">
                            <span style="font-size:16px;">✉️</span> Contact Customer
                        </button>
                        <button class="qa-btn danger" id="cancelOrderBtn">
                            <span style="font-size:16px;">❌</span> Cancel Order
                        </button>
                    </div>
                </div>

            </div>{{-- /sidebar --}}
        </div>{{-- /od-grid --}}
    </main>
</div>

<div class="sh-toast-container" id="toastContainer"></div>

<script>
const orderId   = '{{ $order->order_id }}';
const orderSlNo = '{{ $order->sl_no }}';
const userEmail = '{{ $user?->email ?? '' }}';

async function updateOrderStatus() {
    const select        = document.getElementById('statusSelect');
    const newStatus     = select.value;
    const currentStatus = select.dataset.currentStatus;
    if (newStatus === currentStatus) { showToast('Status is already ' + newStatus, 'warning'); return; }
    if (!confirm(`Update order status to "${newStatus}"?`)) { select.value = currentStatus; return; }
    try {
        const res = await fetch(`/seller/orders/${orderSlNo}/status`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
            body: JSON.stringify({ status: newStatus })
        });
        const data = await res.json();
        if (!res.ok) throw new Error(data.error ?? 'Failed');
        select.dataset.currentStatus = newStatus;
        showToast('Status updated to ' + newStatus, 'success');
        setTimeout(() => location.reload(), 1200);
    } catch(e) {
        showToast(e.message || 'Failed to update status', 'error');
        select.value = currentStatus;
    }
}

document.getElementById('orderNotes')?.addEventListener('input', function () {
    document.getElementById('saveNotesBtn').disabled = !this.value.trim();
});
document.getElementById('saveNotesBtn')?.addEventListener('click', async function () {
    try {
        const res = await fetch(`/seller/orders/${orderSlNo}/notes`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
            body: JSON.stringify({ notes: document.getElementById('orderNotes').value })
        });
        showToast(res.ok ? 'Notes saved' : 'Failed to save notes', res.ok ? 'success' : 'error');
    } catch { showToast('Error saving notes', 'error'); }
});

document.getElementById('downloadInvoiceBtn') ?.addEventListener('click', () => { showToast('Generating invoice…','info');  setTimeout(() => window.location.href = `/seller/orders/${orderSlNo}/invoice`, 600); });
document.getElementById('downloadInvoiceBtn2')?.addEventListener('click', () => { showToast('Generating invoice…','info');  setTimeout(() => window.location.href = `/seller/orders/${orderSlNo}/invoice`, 600); });
document.getElementById('shippingLabelBtn')   ?.addEventListener('click', () => { showToast('Generating label…','info');   setTimeout(() => window.location.href = `/seller/orders/${orderSlNo}/shipping-label`, 600); });
document.getElementById('contactCustomerBtn') ?.addEventListener('click', () => {
    if (userEmail) window.location.href = `mailto:${userEmail}?subject=Regarding Order #${orderId}`;
    else showToast('No contact info available', 'warning');
});
document.getElementById('cancelOrderBtn')?.addEventListener('click', async () => {
    if (!confirm('Are you sure you want to cancel this order?')) return;
    try {
        const res = await fetch(`/seller/orders/${orderSlNo}/cancel`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
        });
        const data = await res.json();
        if (res.ok) { showToast('Order cancelled', 'success'); setTimeout(() => window.location.href = '/seller/orders', 1200); }
        else showToast(data.error || 'Failed to cancel order', 'error');
    } catch { showToast('Error cancelling order', 'error'); }
});

function sendNotification() { showToast('Notification sent to customer!', 'success'); }

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