<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Cart — AyitiBook</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<!-- Toastify CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

<style>
:root{
  --primary: #ff7a00;
  --accent: #1e74dd;
  --muted: #888;
  --card: #f1f3f5;
  --summary: #eaf3fb;
  --success: #18a058;
  --checkbox-bg: #fff6ef;
  --checkbox-border: #ffd1a8;
  --checkbox-checked: var(--primary);
}

/* Reset & body */
*{box-sizing:border-box}
body{
  margin:0;
  background:#e6ebf1;
  font-family:Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
  color:#111;
}
.container{ max-width:1150px; margin:34px auto; padding:0 16px; }

/* Header row */
.top-row{ display:flex; justify-content:space-between; align-items:center; margin-bottom:14px; gap:12px; }
.h-title{ font-size:20px; font-weight:800; margin:0; }
.h-sub{ color:var(--muted); font-size:14px; }

/* Grid */
.cart-grid{ display:flex; gap:24px; align-items:flex-start; }
.cart-left{ flex:1 1 68%; min-width:300px; }
.cart-right{ flex:0 0 32%; min-width:260px; }

/* Product card */
.cart-card{
  background:var(--card);
  border-radius:12px;
  padding:14px;
  display:flex;
  gap:14px;
  align-items:flex-start;
  box-shadow:0 4px 10px rgba(0,0,0,0.06);
  transition:all .32s ease;
  margin-bottom:15px;
  position:relative;
}
.cart-card.fade-out{ opacity:0; transform:translateX(-18px) scale(.98); height:0; padding:0; margin:0; overflow:hidden; }

/* SELECT CHECKBOX */
.select-wrap {
  position:absolute;
  left:14px;
  top:10px;
  display:flex;
  align-items:center;
  gap:8px;
}
.select-checkbox {
  appearance:none;
  -webkit-appearance:none;
  width:22px;
  height:22px;
  border-radius:999px;
  border:2px solid var(--checkbox-border);
  background:var(--checkbox-bg);
  display:inline-block;
  position:relative;
  cursor:pointer;
  transition:all .18s ease;
  box-shadow:0 2px 6px rgba(0,0,0,0.04) inset;
}
.select-checkbox:focus{ outline: none; box-shadow:0 0 0 4px rgba(255,122,0,0.12); }
.select-checkbox:checked{
  background:linear-gradient(180deg,var(--checkbox-checked),#ff6a00);
  border-color:var(--checkbox-checked);
}
.select-checkbox:checked::after{
  content: "✔";
  position:absolute;
  top:-2px;
  left:4px;
  font-size:12px;
  color:#fff;
  font-weight:800;
}

/* image */
.cart-card img{ width:92px; height:92px; object-fit:contain; border-radius:8px; flex:0 0 92px; margin-left:36px; }

/* info */
.cart-info{ flex:1; min-width:0; padding-left:8px; }
.cart-title{ font-weight:700; font-size:15px; margin-bottom:6px; color:#111; display:flex; align-items:center; gap:8px; }
.cart-desc{ font-size:13px; color:#444; line-height:1.35; margin-bottom:8px; }
.meta-line{ color:var(--muted); font-size:13px; margin-bottom:6px; }

/* price box */
.price-box{ display:flex; gap:8px; align-items:center; margin-bottom:6px; flex-wrap:wrap }
.old-price{ text-decoration:line-through; color:var(--muted); font-size:13px; }
.new-price{ font-weight:800; font-size:16px; }

/* right controls */
.right-controls{ display:flex; flex-direction:column; align-items:flex-end; gap:8px; min-width:140px; }
.subtitle {
    text-align: right;
    padding: 6px 10px;
    border-radius: 10px;
    background: #c0cfc7;
    border: 1px solid #e2e8f0;
}
.subtitle p {
    margin: 0;
    font-size: 11px;
    font-weight: 600;
    color: #64748b;
}
.subtitle .subtotal-product {
    margin-top: 6px;
    display: block;
    font-size: 15px;
    font-weight: 900;
    color: #1e293b;
}

/* qty */
.qty-box{ display:flex; border:1px solid #d0d0d0; border-radius:999px; overflow:hidden; }
.qty-box button{ width:30px; height:30px; border:0; background:#fff; cursor:pointer; font-weight:700; transition:all 0.2s; }
.qty-box button:hover{ background:var(--primary); color:#fff; }
.qty-box .qty{ min-width:36px; display:inline-flex; align-items:center; justify-content:center; font-weight:800; }

/* delete */
.delete-icon{ color:#c0392b; font-size:18px; cursor:pointer; padding:4px; border-radius:6px; background:transparent; transition:all 0.2s; }
.delete-icon:hover{ background:rgba(192,57,43,0.1); transform:scale(1.1); }

/* summary box */
.summary-box{ background:var(--summary); padding:16px; border-radius:12px; box-shadow:0 4px 10px rgba(0,0,0,0.06); margin-bottom:16px; }
.summary-box h4{ margin:0 0 10px 0; font-size:16px; font-weight:800; }
.summary-row{ display:flex; justify-content:space-between; margin:6px 0; font-size:15px; align-items:center; }
.summary-row.small{ font-size:13px; color:var(--muted); }
.summary-total{ font-weight:900; font-size:18px; margin-top:6px; }

/* caret / tree */
.tree-header{ display:flex; justify-content:space-between; align-items:center; cursor:pointer; padding:8px 6px; border-radius:8px; transition:background 0.2s; }
.tree-header:hover{ background:rgba(0,0,0,0.02); }
.tree-title{ display:flex; gap:8px; align-items:center; font-weight:700; font-size:14px; color:#222; }
.tree-body{ padding:6px 6px 6px 6px; display:none; border-top:1px dashed rgba(0,0,0,0.04); margin-top:6px; }
.tree-body.open{ display:block; }

.tree-item{ display:flex; justify-content:space-between; align-items:center; padding:6px 4px; border-radius:6px; font-size:14px; }
.tree-item .item-left{ color:#333; }
.tree-item .item-right{ display:flex; gap:8px; align-items:center; color:#222; font-weight:700; }

.remove-cross{ background:transparent; border:0; color:#c0392b; cursor:pointer; font-size:14px; padding:6px; border-radius:6px; transition:all 0.2s; }
.remove-cross:hover{ background:rgba(192,57,43,0.06); }

.apply-ayti-small{ color:var(--accent); font-weight:700; font-size:13px; cursor:pointer; background:transparent; border:0; padding:6px; }

/* coupon input */
.coupon-wrapper{ position:relative; }
#coupon-input{ width:100%; padding:10px 40px 10px 12px; border-radius:8px; border:1px solid #cfcfcf; outline:none; transition:border 0.2s; }
#coupon-input:focus{ border-color:var(--primary); }
.coupon-dropdown-btn{ position:absolute; right:8px; top:7px; font-size:18px; background:none; border:0; cursor:pointer; color:#666; }
.coupon-list{ position:absolute; top:44px; left:0; width:100%; background:#fff; border-radius:8px; box-shadow:0 6px 18px rgba(0,0,0,0.12); display:none; z-index:120; border:1px solid #ddd; max-height:200px; overflow-y:auto; }
.coupon-list li{ padding:10px; list-style:none; cursor:pointer; transition:background 0.2s; }
.coupon-list li:hover{ background:#eef4ff; }

.checkout-btn{ width:100%; padding:12px; border-radius:8px; border:0; background:var(--primary); color:#fff; font-weight:800; cursor:pointer; transition:all 0.3s; }
.checkout-btn:hover{ background:#ff8c1a; transform:translateY(-2px); box-shadow:0 4px 12px rgba(255,122,0,0.3); }
.checkout-btn:disabled{ opacity:0.5; cursor:not-allowed; transform:none; }

.discount-tag {
    background: #ff3b3b;
    color: #fff;
    font-size: 12px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 999px;
    display: inline-block;
}

/* Notification bar */
.notify-bar {
  position: relative;
  width: 100%;
  overflow: hidden;
  box-sizing: border-box;
  background: #fff;
  border-bottom: 1px solid #e5e7eb;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
  padding: 0 20px;
  height: 0;
  opacity: 0;
  transform-origin: top;
  transition: height 380ms cubic-bezier(.2,.9,.2,1), opacity 260ms ease, padding 260ms ease;
  z-index: 999;
}
.notify-bar.show {
  height: 64px;
  padding: 12px 20px;
  opacity: 1;
}
.notify-bar .notify-inner {
  display:flex;
  align-items:center;
  gap:12px;
  width:100%;
  justify-content:center;
}
.notify-rainbow {
  font-size: 18px;
  font-weight: 800;
  background: linear-gradient(90deg, #ff0066, #ff8c00, #ffee00, #33cc33, #0099ff, #6633ff);
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
  color: transparent;
  text-align:center;
}
.notify-close {
  background: none;
  border: none;
  font-size: 20px;
  cursor: pointer;
  padding: 6px 8px;
  color: #666;
  border-radius: 6px;
}
.notify-close:hover { background:#f4f4f4; }

/* Loading spinner */
.loading-spinner {
  display: inline-block;
  width: 20px;
  height: 20px;
  border: 2px solid #f3f3f3;
  border-top: 2px solid var(--primary);
  border-radius: 50%;
  animation: spin 1s linear infinite;
  margin-right: 8px;
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Empty cart */
.empty-cart {
  text-align: center;
  padding: 60px 20px;
  background: var(--card);
  border-radius: 12px;
}
.empty-cart i {
  font-size: 64px;
  color: var(--muted);
  margin-bottom: 20px;
}
.empty-cart h3 {
  margin-bottom: 20px;
  color: #333;
}
.empty-cart .btn-shop {
  display: inline-block;
  padding: 12px 30px;
  background: var(--primary);
  color: white;
  text-decoration: none;
  border-radius: 8px;
  font-weight: 600;
  transition: all 0.3s;
}
.empty-cart .btn-shop:hover {
  background: #ff8c1a;
  transform: translateY(-2px);
}

@media (max-width:920px){
  .cart-grid{ flex-direction:column; }
  .cart-right{ order:2; width:100%; }
  .cart-left{ order:1; width:100%; }
}
</style>
</head>
<body>

@include('includes.header')

<!-- NOTIFICATION BAR -->
<div id="notifyBar" class="notify-bar">
    <div class="notify-inner">
        <span id="notifyText" class="notify-rainbow">
            You've unlocked a chance to spin the wheel! Proceed to checkout & win! 🎉
        </span>
        <button onclick="closeNotifyBar()" class="notify-close">✖</button>
    </div>
</div>

<div class="container">
  <div class="top-row">
    <div>
      <h1 class="h-title">Your Cart</h1>
      <div class="h-sub" id="cart-count-text">Loading...</div>
    </div>
    <div style="text-align:right;">
      <div style="font-size:13px;color:var(--muted)">Signed in as <strong>{{ Auth::user()->name ?? 'Guest' }}</strong></div>
    </div>
  </div>

  <div class="cart-grid">
    <!-- LEFT: products -->
    <div class="cart-left" id="cart-left">
      <div id="cart-items-container">
        <!-- Cart items will be loaded dynamically -->
        <div class="text-center py-5">
          <div class="loading-spinner"></div>
          <p>Loading your cart...</p>
        </div>
      </div>
    </div>

    <!-- RIGHT: summary -->
    <div class="cart-right">
      {{-- Cart passes the full summary to checkout via sessionStorage. --}}
      <form id="checkout-form" method="GET" action="{{ route('checkout.index') }}">
        <div class="summary-box" id="summary-main">
          <h4>ORDER SUMMARY</h4>

          <div class="summary-row small" id="summary-items-qty">
            <span id="summary-items-qty-text" style="font-weight:700; font-size:15px;">0 selected — 0 total qty</span>
          </div>

          <div class="summary-row"><span>Subtotal</span><span id="subtotal">$0.00</span></div>

          <!-- Tax only — shipping shown on checkout page -->
          <div class="tree-section" style="margin-top:8px;">
            <div class="tree-header" onclick="toggleTree('charges-tree')">
              <div class="tree-title"><i class="fa fa-caret-right" id="charges-caret"></i><span>Tax</span></div>
              <div id="charges-summary" style="font-weight:700">$0.00</div>
            </div>
            <div id="charges-tree" class="tree-body">
              <div class="tree-item"><div class="item-left">Tax (5%)</div><div class="item-right" id="tax-amount">$0.00</div></div>
            </div>
          </div>

          <!-- Discount tree -->
          <div class="tree-section" style="margin-top:8px;">
            <div class="tree-header" onclick="toggleTree('discount-tree')">
              <div class="tree-title"><i class="fa fa-caret-right" id="discount-caret"></i><span>Discount & Promo</span></div>
              <div id="discount-summary" style="font-weight:700">-$0.00</div>
            </div>
            <div id="discount-tree" class="tree-body">
              <div class="tree-item" id="coupon-row">
                <div class="item-left">Coupon (<span id="applied-coupon-name">—</span>)</div>
                <div class="item-right">
                  <span id="coupon-amount">-$0.00</span>
                  <button type="button" class="remove-cross" title="Remove coupon" onclick="removeCoupon()">❌</button>
                </div>
              </div>
              <div class="tree-item" id="ayiticash-row">
                <div class="item-left">AyitiCash (20 🪙)</div>
                <div class="item-right">
                  <span id="ayiticash-amount">-$0.00</span>
                  <button type="button" class="remove-cross" title="Remove AyitiCash" onclick="removeAyitiCash()">❌</button>
                  <button type="button" class="apply-ayti-small" id="reapply-ayti" style="display:none" onclick="reapplyAyiti()">Apply</button>
                </div>
              </div>
            </div>
          </div>

          <div class="summary-row summary-total"><span>Total <span style="font-size:11px;font-weight:500;color:var(--muted)">(excl. shipping)</span></span><span id="total">$0.00</span></div>
          <button class="checkout-btn" id="proceed-btn" type="button">PROCEED TO CHECKOUT</button>
        </div>
      </form>

      <!-- AyitiCash Info -->
      <div id="ayiticash-info" style="margin:8px 0 4px 0; font-size:14px; color:#1e74dd; font-weight:600; display:flex; align-items:center; gap:8px;">
        <i class="fa-solid fa-coins" style="font-size:16px; color:#1e74dd;"></i>
        <span id="ayiti-text">You can apply <strong>20 AyitiCash</strong> in this order (worth <strong>$0.08</strong>)</span>
        <button id="ayiti-apply-btn" onclick="applyAyitiCashInfo()" style="border:0; background:none; color:#1e74dd; font-weight:700; cursor:pointer; font-size:14px; padding:0;">Apply</button>
      </div>

      <!-- Coupon Section -->
      <div class="summary-box" style="margin-top:8px;">
        <h4>APPLY COUPON</h4>
        <div style="margin-bottom:8px;">
          <div class="coupon-wrapper" style="position:relative;">
            <input id="coupon-input" placeholder="Enter coupon code or pick from list" />
            <button class="coupon-dropdown-btn" onclick="toggleCouponList()">▾</button>
            <ul class="coupon-list" id="coupon-list">
              <li onclick="pickCoupon('SAVE10','Save 10% instantly')">SAVE10 — 10% OFF</li>
              <li onclick="pickCoupon('MEGA20','20% OFF on orders over $500')">MEGA20 — 20% OFF over $500</li>
              <li onclick="pickCoupon('FESTIVE50','Flat $50 OFF — festive')">FESTIVE50 — $50 OFF</li>
              <li onclick="pickCoupon('FREESHIP','Free shipping')">FREESHIP — Free Shipping</li>
            </ul>
          </div>
        </div>
        <div style="display:flex; gap:8px;">
          <button class="apply-ayti-small" style="background:var(--accent); color:#fff; border-radius:8px; padding:8px 12px;" onclick="applyCouponFromInput()">APPLY</button>
          <button style="background:#fff; border:1px solid #ddd; padding:8px 12px; border-radius:8px; cursor:pointer;" onclick="clearCoupon()">Clear</button>
        </div>
        <div id="coupon-msg" style="margin-top:8px; font-size:13px; color:var(--muted)"></div>
      </div>
    </div>
  </div>
</div>

@include('includes.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script>
// Toast notification
function toast(msg, type) {
    Toastify({
        text: msg,
        duration: 3000,
        gravity: "top",
        position: "right",
        backgroundColor: type === "success" ? "linear-gradient(to right,#00b09b,#96c93d)" : "linear-gradient(to right,#ff5f6d,#ffc371)"
    }).showToast();
}

// Coupons configuration
const coupons = {
  SAVE10: { type:'percent', value:10, min:0, desc:'Save 10% instantly.' },
  MEGA20: { type:'percent', value:20, min:500, desc:'20% OFF on orders over $500.' },
  FESTIVE50: { type:'flat', value:50, min:0, desc:'Flat $50 OFF' },
  FREESHIP: { type:'shipping', value:0, min:0, desc:'Free shipping' }
};

// AyitiCash config
const AYITI_CASH_COINS = 20;
const AYITI_COIN_TO_USD = 0.0038;
const TAX_PERCENT = 5;

let appliedCoupon = null;
let appliedAyitiCash = false;
let otherCharges = 0.00;
let cartItems = [];

// Load cart items from server - using direct URL
function loadCart() {
    $.ajax({
        url: "{{ route('cart.get-items') }}",
        type: "GET",
        xhrFields: { withCredentials: true },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (!response || !Array.isArray(response.items)) {
                console.error('Unexpected response format:', response);
                toast('Failed to load cart. Please refresh.', 'error');
                return;
            }
            cartItems = response.items;
            renderCartItems();
            applyBuyNowSelection(); // uncheck all except the buy_now item if present
            updateTotals();
            updateCartCount();
        },
        error: function(xhr) {
            console.error('Error loading cart:', xhr.status, xhr.responseText);
            if (xhr.status === 401) {
                toast('Session expired. Please log in again.', 'error');
            } else {
                toast('Failed to load cart (Error ' + xhr.status + '). Please refresh.', 'error');
            }
            $('#cart-items-container').html(`
                <div class="empty-cart">
                    <i class="fas fa-circle-exclamation"></i>
                    <h3>Could not load cart</h3>
                    <p style="color:var(--muted)">Please refresh the page or try logging out and back in.</p>
                    <a href="{{ route('products') }}" class="btn-shop">Continue Shopping</a>
                </div>
            `);
        }
    });
}

// Render cart items
function renderCartItems() {
    if (!cartItems || cartItems.length === 0) {
        $('#cart-items-container').html(`
            <div class="empty-cart">
                <i class="fas fa-shopping-cart"></i>
                <h3>Your cart is empty</h3>
                <a href="{{ route('products') }}" class="btn-shop">Continue Shopping</a>
            </div>
        `);
        return;
    }
    
    let html = '';
    cartItems.forEach(item => {
        const price = item.price;
        const oldPrice = item.old_price ? `<span class="old-price">${item.currency} ${item.old_price}</span>` : '';
        const discountTag = item.discount_percentage ? `<div class="discount-tag">-${item.discount_percentage}% OFF</div>` : '';
        
        html += `
            <div class="cart-card" data-id="${item.id}" data-price="${price}" data-sku="${item.sku || ''}">
                <div class="select-wrap">
                    <input class="select-checkbox" type="checkbox" title="Select product" checked />
                </div>
                <img src="${item.thumbnail}" alt="${escapeHtml(item.product_name)}">
                <div class="cart-info">
                    <div class="cart-title">${escapeHtml(item.product_name)}</div>
                    <div class="cart-desc">${escapeHtml(item.description || '')}</div>
                    <div class="meta-line">
                        SKU: ${item.sku || '—'} 
                        ${item.variant_name ? `|| Variant: ${item.variant_name}` : ''}
                        ${item.size ? `|| Size: ${item.size}` : ''}
                    </div>
                    <div class="price-box">
                        ${oldPrice}
                        <span class="new-price">$${parseFloat(item.price).toFixed(2)}</span>
                        ${discountTag}
                    </div>
                </div>
                <div class="right-controls">
                    <button class="remove-cross delete-icon" title="Remove item" onclick="removeFromCart(${item.id})">
                        <i class="fa fa-trash"></i>
                    </button>
                    <div class="subtitle">
                        <p>Product subtotal</p>
                        <span class="subtotal-product">$${(parseFloat(item.price) * item.quantity).toFixed(2)}</span>
                    </div>
                    <div class="qty-box">
                        <button class="minus" onclick="updateQuantity(${item.id}, -1)">-</button>
                        <span class="qty">${item.quantity}</span>
                        <button class="plus" onclick="updateQuantity(${item.id}, 1)">+</button>
                    </div>
                </div>
            </div>
        `;
    });
    
    $('#cart-items-container').html(html);
}

// Buy Now selection — uncheck all items except the one from ?buy_now=
function applyBuyNowSelection() {
    const params  = new URLSearchParams(window.location.search);
    const buyNowId = params.get('buy_now');
    if (!buyNowId) return; // normal cart visit — leave all checked

    // Uncheck everything first, then check only the buy_now item
    $('.select-checkbox').prop('checked', false);
    const targetCard = $(`.cart-card[data-id="${buyNowId}"]`);
    if (targetCard.length) {
        targetCard.find('.select-checkbox').prop('checked', true);
        // Smooth scroll to it
        $('html, body').animate({ scrollTop: targetCard.offset().top - 80 }, 400);
    }

    // Clean the URL so a refresh doesn't re-trigger this
    const cleanUrl = window.location.pathname;
    window.history.replaceState(null, '', cleanUrl);
}

// Update quantity - using your existing route name 'cart.update'
function updateQuantity(cartId, change) {
    cartId = parseInt(cartId); // Fix: ensure int for strict equality checks
    const card = $(`.cart-card[data-id="${cartId}"]`);
    const qtyEl = card.find('.qty');
    let currentQty = parseInt(qtyEl.text());
    let newQty = currentQty + change;
    
    if (newQty < 1) newQty = 1;
    
    // Fix: cast i.id to int for strict equality match
    const item = cartItems.find(i => parseInt(i.id) === cartId);
    if (!item) { toast('Item not found', 'error'); return; }

    if (newQty > item.stock) {
        toast(`Only ${item.stock} items available in stock`, 'error');
        return;
    }
    
    $.ajax({
        url: `{{ route('cart.update', 0) }}`.replace('/0', `/${cartId}`),
        type: 'PUT',
        data: {
            quantity: newQty,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            qtyEl.text(newQty);
            const newSubtotal = parseFloat(item.price) * newQty;
            // Fix: removed item.currency (not returned by API), use $ directly
            card.find('.subtotal-product').text(`$${newSubtotal.toFixed(2)}`);
            // Update cart items array
            const cartItem = cartItems.find(i => parseInt(i.id) === cartId);
            if (cartItem) cartItem.quantity = newQty;
            updateTotals();
            updateCartCount();
            toast('Quantity updated', 'success');
        },
        error: function(xhr) {
            toast(xhr.responseJSON?.message || 'Error updating quantity', 'error');
        }
    });
}

// Remove from cart - using your existing route name 'cart.remove'
function removeFromCart(cartId) {
    cartId = parseInt(cartId); // Fix: ensure int for strict equality checks
    if (!confirm('Remove this item from cart?')) return;
    
    $.ajax({
        url: `{{ route('cart.remove', 0) }}`.replace('/0', `/${cartId}`),
        type: 'POST', // Fix: use POST with _method spoof; DELETE body is unreliable
        data: {
            _token: '{{ csrf_token() }}',
            _method: 'DELETE'
        },
        success: function(response) {
            // Remove from DOM with fade animation
            const card = $(`.cart-card[data-id="${cartId}"]`);
            card.addClass('fade-out');
            setTimeout(() => card.remove(), 350);
            // Fix: cast i.id to int so filter correctly removes the item
            cartItems = cartItems.filter(item => parseInt(item.id) !== cartId);
            updateTotals();
            updateCartCount();
            toast('Item removed from cart', 'success');
            
            if (cartItems.length === 0) {
                renderCartItems();
            }
        },
        error: function(xhr) {
            toast(xhr.responseJSON?.message || 'Error removing item', 'error');
        }
    });
}

// Update cart count
function updateCartCount() {
    const totalItems = cartItems.length;
    const totalQty = cartItems.reduce((sum, item) => sum + item.quantity, 0);
    $('#cart-count-text').text(`${totalItems} items — ${totalQty} qty`);
    
    // Update header cart count if exists
    if ($('#cart-count').length) {
        $('#cart-count').text(totalQty);
    }
}

// Calculate selected subtotal
function calcSelectedSubtotal() {
    let subtotal = 0;
    $('.cart-card').each(function() {
        const checked = $(this).find('.select-checkbox').is(':checked');
        if (checked) {
            const price = parseFloat($(this).data('price'));
            const qty = parseInt($(this).find('.qty').text());
            subtotal += price * qty;
        }
    });
    return subtotal;
}

// Get selected items
function getSelectedItems() {
    const items = [];
    $('.cart-card').each(function() {
        const checked = $(this).find('.select-checkbox').is(':checked');
        if (checked) {
            const id = parseInt($(this).data('id'));
            // Fix: cast i.id to int — API returns strings, data-id is int
            const item = cartItems.find(i => parseInt(i.id) === id);
            if (item) {
                items.push({
                    ...item,
                    quantity: parseInt($(this).find('.qty').text())
                });
            }
        }
    });
    return items;
}

// Update totals
function updateTotals() {
    let selectedCount = 0;
    let selectedQty = 0;
    let subtotal = 0;
    
    $('.cart-card').each(function() {
        const checked = $(this).find('.select-checkbox').is(':checked');
        const price = parseFloat($(this).data('price'));
        const qty = parseInt($(this).find('.qty').text());
        const sub = price * qty;
        
        if (checked) {
            selectedCount++;
            selectedQty += qty;
            subtotal += sub;
        }
    });
    
    $('#summary-items-qty-text').text(`${selectedCount} selected — ${selectedQty} total qty`);
    $('#subtotal').text('$' + subtotal.toFixed(2));
    
    // Tax only — shipping calculated on checkout page
    const tax = subtotal * (TAX_PERCENT / 100);

    // Coupon discount
    let couponDiscount = 0;
    let couponName = '—';
    let freeShippingCoupon = false;
    if (appliedCoupon && coupons[appliedCoupon]) {
        const c = coupons[appliedCoupon];
        couponName = appliedCoupon;
        if (c.type === 'percent') {
            couponDiscount = (!c.min || subtotal >= c.min) ? subtotal * (c.value / 100) : 0;
        } else if (c.type === 'flat') {
            couponDiscount = Math.min(c.value, subtotal);
        } else if (c.type === 'shipping') {
            freeShippingCoupon = true; // passed to checkout via payload
        }
    }

    // AyitiCash discount
    let ayiticashDiscount = 0;
    if (appliedAyitiCash) {
        ayiticashDiscount = Math.min(AYITI_CASH_COINS * AYITI_COIN_TO_USD, subtotal);
    }

    const totalDiscount      = couponDiscount + ayiticashDiscount;
    const discountedSubtotal = Math.max(0, subtotal - totalDiscount);
    // Total shown in cart excludes shipping
    const total = Math.max(0, discountedSubtotal + tax);

    // Update UI — no shipping row
    $('#tax-amount').text('$' + tax.toFixed(2));
    $('#charges-summary').text('$' + tax.toFixed(2));
    $('#applied-coupon-name').text(couponName);
    $('#coupon-amount').text('-$' + couponDiscount.toFixed(2));
    $('#ayiticash-amount').text('-$' + ayiticashDiscount.toFixed(2));
    $('#discount-summary').text('-$' + totalDiscount.toFixed(2));
    $('#total').text('$' + total.toFixed(2));
    
    // Show/hide remove buttons
    const couponRow = $('#coupon-row .remove-cross');
    if (couponRow.length) couponRow.css('display', couponDiscount <= 0 ? 'none' : 'inline-block');
    
    const ayitiCross = $('#ayiticash-row .remove-cross');
    const reapplyBtn = $('#reapply-ayti');
    ayitiCross.css('display', ayiticashDiscount <= 0 ? 'none' : 'inline-block');
    reapplyBtn.css('display', ayiticashDiscount <= 0 ? 'inline-block' : 'none');
}

// Tree toggle
function toggleTree(id) {
    const node = document.getElementById(id);
    const open = node.classList.toggle('open');
    if (id === 'charges-tree') {
        document.getElementById('charges-caret').className = open ? 'fa fa-caret-down' : 'fa fa-caret-right';
    } else if (id === 'discount-tree') {
        document.getElementById('discount-caret').className = open ? 'fa fa-caret-down' : 'fa fa-caret-right';
    }
}

// Coupon functions
function toggleCouponList() {
    const el = document.getElementById('coupon-list');
    el.style.display = el.style.display === 'block' ? 'none' : 'block';
}

function pickCoupon(code, desc) {
    document.getElementById('coupon-input').value = code;
    document.getElementById('coupon-msg').innerText = desc;
    document.getElementById('coupon-list').style.display = 'none';
}

function applyCouponFromInput() {
    appliedAyitiCash = false;
    $('#ayiti-text').html('You can apply <strong>20 AyitiCash</strong> in this order (worth <strong>$0.08</strong>)');
    $('#ayiti-apply-btn').show();
    
    const raw = (document.getElementById('coupon-input').value || '').trim().toUpperCase();
    if (!raw) {
        appliedCoupon = null;
        document.getElementById('coupon-msg').innerText = 'No coupon entered.';
        updateTotals();
        return;
    }
    if (!coupons[raw]) {
        appliedCoupon = null;
        document.getElementById('coupon-msg').innerText = 'Invalid coupon.';
        updateTotals();
        return;
    }
    
    const subtotal = calcSelectedSubtotal();
    const c = coupons[raw];
    if (c.min && subtotal < c.min) {
        appliedCoupon = null;
        document.getElementById('coupon-msg').innerText = `${raw} requires subtotal > $${c.min.toFixed(2)}.`;
        updateTotals();
        return;
    }
    
    appliedCoupon = raw;
    appliedAyitiCash = false;
    $('#reapply-ayti').show();
    document.getElementById('coupon-msg').innerText = `${raw} applied — ${c.desc}`;
    updateTotals();
}

function clearCoupon() {
    appliedCoupon = null;
    document.getElementById('coupon-input').value = '';
    document.getElementById('coupon-msg').innerText = 'Coupon cleared.';
    updateTotals();
}

function removeCoupon() {
    appliedCoupon = null;
    document.getElementById('applied-coupon-name').innerText = '—';
    document.getElementById('coupon-amount').innerText = '-$0.00';
    document.getElementById('coupon-msg').innerText = 'Coupon removed.';
    updateTotals();
}

// AyitiCash functions
function removeAyitiCash() {
    appliedAyitiCash = false;
    $('#ayiti-text').html('You can apply <strong>20 AyitiCash</strong> in this order (worth <strong>$0.08</strong>)');
    $('#ayiti-apply-btn').show();
    updateTotals();
    $('#reapply-ayti').show();
}

function reapplyAyiti() {
    appliedAyitiCash = true;
    $('#reapply-ayti').hide();
    appliedCoupon = null;
    $('#applied-coupon-name').text('—');
    $('#coupon-amount').text('-$0.00');
    $('#coupon-msg').text('Coupon removed because AyitiCash was applied.');
    updateTotals();
}

function applyAyitiCashInfo() {
    appliedCoupon = null;
    $('#coupon-input').val('');
    $('#coupon-msg').text('');
    appliedAyitiCash = true;
    $('#ayiti-text').html('20 AyitiCash applied — worth <strong>$0.08</strong>');
    $('#ayiti-apply-btn').hide();
    updateTotals();
}

// Checkout — builds full payload and stores in sessionStorage before redirecting
$('#proceed-btn').on('click', function() {
    const selectedItems = getSelectedItems();
    if (selectedItems.length === 0) {
        toast('Please select at least one product to proceed to checkout.', 'error');
        return;
    }

    // Recalculate fresh — mirrors updateTotals, no shipping here
    const subtotal = calcSelectedSubtotal();
    const tax      = subtotal * (TAX_PERCENT / 100);

    // Coupon discount
    let couponDiscount     = 0;
    let couponDesc         = null;
    let freeShippingCoupon = false;
    if (appliedCoupon && coupons[appliedCoupon]) {
        const c = coupons[appliedCoupon];
        couponDesc = c.desc;
        if (c.type === 'percent') {
            couponDiscount = (!c.min || subtotal >= c.min) ? subtotal * (c.value / 100) : 0;
        } else if (c.type === 'flat') {
            couponDiscount = Math.min(c.value, subtotal);
        } else if (c.type === 'shipping') {
            freeShippingCoupon = true;
        }
    }

    // AyitiCash discount
    let ayiticashDiscount = 0;
    if (appliedAyitiCash) {
        ayiticashDiscount = Math.min(AYITI_CASH_COINS * AYITI_COIN_TO_USD, subtotal);
    }

    const totalDiscount      = couponDiscount + ayiticashDiscount;
    const discountedSubtotal = +Math.max(0, subtotal - totalDiscount).toFixed(2);
    const cartTotal          = +Math.max(0, discountedSubtotal + tax).toFixed(2);

    // Payload — checkout page adds shipping on top of discounted_subtotal
    const payload = {
        items: selectedItems.map(i => ({
            id:         parseInt(i.product_id), // product id
            cart_id:    parseInt(i.id),          // cart row id — used by server to delete correct rows
            title:      i.product_name,
            price:      parseFloat(i.price),
            qty:        i.quantity,
            subtotal:   parseFloat(i.price) * i.quantity,
            image:      i.thumbnail     || '',
            sku:        i.sku           || '',
            variant:    i.variant_name  || '',
            size:       i.size          || ''
        })),
        subtotal:             +subtotal.toFixed(2),
        tax:                  +tax.toFixed(2),
        coupon_code:          appliedCoupon      || null,
        coupon_desc:          couponDesc         || null,
        coupon_discount:      +couponDiscount.toFixed(2),
        free_shipping_coupon: freeShippingCoupon,
        ayiticash_applied:    appliedAyitiCash,
        ayiticash_discount:   +ayiticashDiscount.toFixed(2),
        total_discount:       +totalDiscount.toFixed(2),
        discounted_subtotal:  discountedSubtotal,
        cart_total:           cartTotal
    };

    // Store in sessionStorage so checkout page can read it
    try {
        sessionStorage.setItem('checkout_items', JSON.stringify(payload));
    } catch(e) {
        toast('Storage error — proceeding anyway.', 'error');
    }

    // Redirect to checkout page (GET, no sensitive data in URL)
    window.location.href = "{{ route('checkout.index') }}";
});

// Notification bar
function closeNotifyBar() {
    const bar = document.getElementById('notifyBar');
    if (bar) bar.classList.remove('show');
}

function showNotifyBar(message, autoCloseMs = 0) {
    const bar = document.getElementById('notifyBar');
    if (!bar) return;
    const text = document.getElementById('notifyText');
    if (message) text.innerHTML = message;
    bar.classList.add('show');
    if (autoCloseMs > 0) {
        setTimeout(() => closeNotifyBar(), autoCloseMs);
    }
}

// Escape HTML
function escapeHtml(text) {
    if (!text) return '';
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

// Initialize
$(document).ready(function() {
    loadCart();
    
    // Close coupon dropdown on outside click
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.coupon-wrapper').length) {
            $('#coupon-list').hide();
        }
    });
    
    // Show notification bar
    setTimeout(() => {
        showNotifyBar("You've unlocked a chance to spin the wheel! Proceed to checkout & win!", 0);
    }, 80);
    
    // Bind select checkbox changes
    $(document).on('change', '.select-checkbox', function() {
        updateTotals();
    });
});
</script>

</body>
</html>