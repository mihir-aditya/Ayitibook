<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Checkout — Billing & Shipping</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
<style>
:root{
  --primary:#ff7a00;--accent:#1e74dd;--muted:#6b778a;--bg:#f3f5f7;
  --card:#ffffff;--radius:6px;--shadow:0 6px 18px rgba(16,24,40,0.06);
  --gap:12px;--border:#e8f3fb;--max-width:1120px;--scale:0.90;--base-font:14px;
}
*{box-sizing:border-box}
html,body{height:100%}
body{margin:0;font-family:Inter,system-ui,-apple-system,"Segoe UI",Roboto,Arial;background:var(--bg);color:#0f1724;-webkit-font-smoothing:antialiased;line-height:1.45;font-size:var(--base-font);overflow-x:hidden;}
.outer-wrap{display:flex;justify-content:center;width:100%;padding:18px 0 48px;overflow-x:hidden;}
.container{width:100%;max-width:calc(var(--max-width) / var(--scale));margin:0 auto;padding:0 18px;transform:scale(var(--scale));transform-origin:top center;}
.header-row{display:flex;justify-content:space-between;align-items:center;gap:12px;margin-bottom:18px;}
.page-title{font-size:18px;font-weight:800;margin:0;}
.small{color:var(--muted);font-size:12px;}
.layout{display:grid;grid-template-columns:minmax(0,1fr) 340px;gap:20px;align-items:start;width:100%;}
@media(max-width:1100px){.layout{grid-template-columns:1fr 320px;}}
@media(max-width:920px){.layout{grid-template-columns:1fr;}}
.card{background:var(--card);padding:14px;border-radius:var(--radius);box-shadow:var(--shadow);margin-bottom:14px;border:1px solid var(--border);}
.section-title{font-size:15px;font-weight:800;margin-bottom:6px;color:#0b1724;}
.helper{font-size:12px;color:var(--muted);}
.slider-container{position:relative;padding:6px 36px;margin-top:10px;}
.slider-track{display:flex;gap:12px;overflow-x:auto;-webkit-overflow-scrolling:touch;scroll-behavior:smooth;padding:6px 4px;}
.slider-track::-webkit-scrollbar{height:7px;}
.slider-track::-webkit-scrollbar-thumb{background:#dfeaf8;border-radius:6px;}
.slider-item{flex:0 0 auto;min-width:200px;border-radius:10px;background:#fff;border:1px solid #eef6fb;padding:12px;display:flex;gap:10px;align-items:flex-start;cursor:pointer;transition:transform .14s ease,box-shadow .14s ease,border-color .14s ease;}
.slider-item:hover{transform:translateY(-4px);box-shadow:0 8px 18px rgba(0,0,0,0.05);}
.slider-item.active{border-color:var(--accent);box-shadow:0 0 0 4px rgba(30,116,221,0.06);transform:none;}
.addr-radio{margin-left:auto;width:20px;height:20px;border-radius:50%;border:2px solid #d9efff;display:flex;align-items:center;justify-content:center;background:#fff;color:#fff;}
.addr-radio.checked{background:linear-gradient(180deg,var(--accent),#0f5fb1);border-color:var(--accent);}
.slider-arrow{position:absolute;top:50%;transform:translateY(-50%);width:34px;height:34px;border-radius:50%;background:#fff;display:flex;align-items:center;justify-content:center;box-shadow:var(--shadow);border:1px solid #eef6fb;cursor:pointer;z-index:20;}
.slider-arrow.left{left:6px;}.slider-arrow.right{right:6px;}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-top:10px;}
@media(max-width:640px){.form-grid{grid-template-columns:1fr;}}
label{display:block;font-size:12px;color:var(--muted);font-weight:700;margin-bottom:6px;}
input[type="text"],input[type="email"],input[type="tel"],select,textarea{width:100%;padding:9px 10px;border-radius:6px;border:1.5px solid #dbeaf6;font-size:13px;background:#fff;outline:none;transition:border .15s;}
input:focus,select:focus,textarea:focus{border-color:var(--accent);}
textarea{min-height:72px;resize:vertical;}
.right-card{padding:14px;border-radius:8px;box-shadow:var(--shadow);border:1px solid var(--border);background:linear-gradient(180deg,#fbfdff,#f7fbff);}
.order-item{display:flex;gap:10px;align-items:center;background:#fff;padding:8px;border-radius:8px;border:1px solid #eef6fb;margin-bottom:10px;}
.order-item img{width:56px;height:56px;object-fit:contain;border-radius:6px;background:#fff;padding:6px;border:1px solid #f0f6fb;}
.summary-row{display:flex;justify-content:space-between;margin-bottom:8px;color:#0b1724;font-size:13px;}
.summary-total{font-weight:900;font-size:16px;margin-top:8px;}
.pay-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin-top:10px;}
@media(max-width:640px){.pay-grid{grid-template-columns:repeat(2,1fr);}}
.pay-card{background:#fff;border-radius:8px;padding:10px;border:1px solid #e8f4fb;display:flex;flex-direction:column;justify-content:center;align-items:center;text-align:center;cursor:pointer;transition:0.12s ease;height:98px;gap:6px;font-size:13px;position:relative;}
.pay-card i{font-size:18px;color:#3a3a3a;}
.pay-card .pay-label{font-weight:700;font-size:11px;}
.pay-card .helper{font-size:12px;margin-top:-5px;color:#6b778a;text-align:center;}
.pay-card.selected{border-color:var(--accent);box-shadow:0 0 0 3px rgba(30,116,221,0.12);}
.pay-card.locked{opacity:.5;pointer-events:none;}
.small-btn{background:#fff;border:1px solid #e6eef6;padding:8px 10px;border-radius:4px;cursor:pointer;font-weight:800;font-size:12px;}
.small-btn.primary{background:var(--primary);color:#fff;border-color:var(--primary);}
.place-cta{width:100%;padding:10px 12px;border-radius:6px;border:0;background:var(--primary);color:#fff;font-weight:900;cursor:pointer;font-size:14px;margin-top:10px;display:inline-block;box-shadow:0 8px 18px rgba(255,122,0,0.12);}
.place-cta:hover{background:#e86f00;}
.place-cta:disabled{opacity:.6;cursor:not-allowed;}
.form-locked{pointer-events:none;opacity:.55;}
#toastBox{position:fixed;top:18px;right:18px;z-index:9999;display:flex;flex-direction:column;gap:8px;}
.toast{min-width:240px;padding:10px 12px;border-radius:8px;color:#fff;font-weight:700;display:flex;gap:8px;align-items:center;box-shadow:0 8px 18px rgba(2,6,23,0.12);animation:toastIn .18s ease;}
.toast.success{background:#0f9d58;}.toast.error{background:#d93025;}
@keyframes toastIn{from{transform:translateY(-6px);opacity:0}to{transform:translateY(0);opacity:1}}
.default-badge{font-size:11px;color:#0b7d3c;font-weight:900;}
.edit-unlock-btn{background:none;border:none;color:var(--accent);font-size:12px;font-weight:700;cursor:pointer;padding:0;margin-top:6px;}
</style>
</head>
<body>

@include('includes.header')

<div class="outer-wrap">
  <div class="container">

    <div class="header-row">
      <div>
        <div class="page-title">Checkout — Billing & Shipping</div>
        <div class="small">Secure checkout — fast delivery</div>
      </div>
      <div style="text-align:right">
        <div class="small">Signed in as <strong>{{ Auth::user()->name ?? 'Guest' }}</strong></div>
      </div>
    </div>

    <div class="layout">

      <!-- ════════════ LEFT ════════════ -->
      <div>

        <!-- Saved addresses -->
        <div class="card">
          <div style="display:flex;justify-content:space-between;align-items:center;">
            <div>
              <div class="section-title">Saved addresses</div>
              <div class="helper">Tap a card to autofill billing</div>
            </div>
            <button class="small-btn" id="btn_show_add"><i class="fa fa-plus"></i>&nbsp;Add new</button>
          </div>

          <div class="slider-container" style="margin-top:10px;">
            <div class="slider-arrow left" id="sliderPrev"><i class="fa fa-chevron-left"></i></div>
            <div class="slider-arrow right" id="sliderNext"><i class="fa fa-chevron-right"></i></div>
            <div class="slider-track" id="addressSlider">

              @forelse ($addresses as $addr)
                <div class="slider-item address-card"
                     data-id="{{ $addr->sl_no }}"
                     data-name="{{ $addr->first_name }} {{ $addr->last_name }}"
                     data-phone="{{ $addr->phone }}"
                     data-line="{{ $addr->address }}"
                     data-city="{{ $addr->city }}"
                     data-state="{{ $addr->state }}"
                     data-country="{{ $addr->country }}"
                     data-zip="{{ $addr->pincode }}"
                     onclick="selectAddress(this)">
                  <div style="flex:1">
                    <div style="font-weight:800">
                      {{ ucfirst($addr->address_type ?? 'Address') }}
                      @if($addr->is_default)
                        <span class="default-badge">✔ Default</span>
                      @endif
                    </div>
                    <div style="color:var(--muted);margin-top:6px;line-height:1.4">
                      {{ $addr->first_name }} {{ $addr->last_name }}<br>
                      {{ $addr->address }}, {{ $addr->city }}<br>
                      {{ $addr->phone }}
                    </div>
                  </div>
                  <div class="addr-radio"><i class="fa fa-check" style="display:none"></i></div>
                </div>
              @empty
                <div class="helper" style="padding:10px;">No saved addresses. Add one below.</div>
              @endforelse

            </div>
          </div>
        </div>

        <!-- Add address form -->
        <div class="card" id="addAddressCard" style="display:none;">
          <div style="display:flex;justify-content:space-between;align-items:center;">
            <div class="section-title">Add new address</div>
            <button class="small-btn" id="btn_add_close"><i class="fa fa-times"></i></button>
          </div>
          <div class="form-grid" style="margin-top:10px;">
            <div><label>First Name</label><input id="new_first_name" type="text" /></div>
            <div><label>Last Name</label><input id="new_last_name" type="text" /></div>
            <div><label>Phone</label><input id="new_phone" type="text" /></div>
            <div><label>Alternate Phone</label><input id="new_alt_phone" type="text" /></div>
            <div style="grid-column:1/-1;"><label>Address</label><input id="new_address" type="text" /></div>
            <div><label>City</label><input id="new_city" type="text" /></div>
            <div><label>State</label><input id="new_state" type="text" /></div>
            <div><label>Country</label><input id="new_country" type="text" /></div>
            <div><label>Pincode</label><input id="new_pincode" type="text" /></div>
            <div>
              <label>Type</label>
              <select id="new_addr_type">
                <option value="home">Home</option>
                <option value="work">Work</option>
                <option value="other">Other</option>
              </select>
            </div>
            <div style="display:flex;align-items:center;gap:8px;padding-top:20px;">
              <input type="checkbox" id="new_is_default" />
              <label style="margin:0;font-weight:600;">Set as default</label>
            </div>
          </div>
          <div style="display:flex;gap:8px;justify-content:flex-end;margin-top:12px;">
            <button class="small-btn" onclick="toggleAddForm(false)">Cancel</button>
            <button class="small-btn primary" id="saveAddressBtn" onclick="saveNewAddress()">
              <i class="fa fa-save"></i> Save Address
            </button>
          </div>
        </div>

        <!-- Billing form -->
        <div class="card" id="billingCard">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:4px;">
            <div>
              <div class="section-title">Billing information</div>
              <div class="helper">Select a saved address above or fill in manually</div>
            </div>
            <button class="edit-unlock-btn" id="editBillingBtn" onclick="unlockBilling()" style="display:none;">
              <i class="fa fa-pencil"></i> Edit
            </button>
          </div>
          <div class="form-grid">
            <div style="grid-column:1/-1;">
              <label>Full name *</label>
              <input id="bill_name" type="text" placeholder="Full name" />
            </div>
            <div><label>Email</label><input id="bill_email" type="email" placeholder="Email" value="{{ Auth::user()->email ?? '' }}" /></div>
            <div><label>Phone *</label><input id="bill_phone" type="tel" placeholder="Phone" /></div>
            <div><label>Country</label><input id="country" type="text" placeholder="Country" /></div>
            <div><label>State</label><input id="state" type="text" placeholder="State" /></div>
            <div><label>City</label><input id="city" type="text" placeholder="City" /></div>
            <div><label>ZIP / Pincode</label><input id="zip" type="text" placeholder="ZIP" /></div>
            <div style="grid-column:1/-1;">
              <label>Address *</label>
              <input id="address_line" type="text" placeholder="Street / building / area" />
            </div>
          </div>
        </div>

        <!-- Shipping -->
        <div class="card">
          <div style="display:flex;justify-content:space-between;align-items:center;">
            <div>
              <div class="section-title">Shipping information</div>
              <div class="helper">Leave checked to use billing address</div>
            </div>
            <label style="font-weight:700;cursor:pointer;">
              <input type="checkbox" id="same_as_billing" checked /> &nbsp;Same as billing
            </label>
          </div>
          <div id="shippingForm" style="margin-top:10px;display:none;">
            <div class="form-grid">
              <div><label>Full name</label><input id="ship_name" type="text" /></div>
              <div><label>Phone</label><input id="ship_phone" type="text" /></div>
              <div><label>Country</label><input id="ship_country" type="text" /></div>
              <div><label>State</label><input id="ship_state" type="text" /></div>
              <div><label>City</label><input id="ship_city" type="text" /></div>
              <div><label>ZIP</label><input id="ship_zip" type="text" /></div>
              <div style="grid-column:1/-1;"><label>Address</label><input id="ship_address" type="text" /></div>
            </div>
          </div>
        </div>

      </div><!-- /LEFT -->

      <!-- ════════════ RIGHT ════════════ -->
      <div class="right-card">
        <div style="display:flex;justify-content:space-between;align-items:center;">
          <div>
            <div class="section-title">Order Summary</div>
            <div class="helper">Review items & totals</div>
          </div>
          <div class="small"><strong id="items_count">0 items</strong></div>
        </div>

        <div id="order_items_list" style="margin-top:10px;">
          <div class="helper">Loading items...</div>
        </div>

        <div style="height:8px"></div>
        <div style="background:#fff;padding:12px;border-radius:8px;border:1px solid #eef6ff;">
          <div class="summary-row"><div class="helper">Subtotal</div><div id="summary_subtotal">$0.00</div></div>
          <div class="summary-row"><div class="helper">Tax (5%)</div><div id="summary_tax">$0.00</div></div>
          <div class="summary-row"><div class="helper">Shipping</div><div id="summary_shipping">$15.00</div></div>
          <div class="summary-row"><div class="helper">Discount</div><div id="summary_discount">-$0.00</div></div>
          <div class="summary-row summary-total"><div>Total</div><div id="summary_total">$0.00</div></div>
        </div>

        <!-- Payment -->
        <div style="margin-top:12px;">
          <div class="section-title">Payment Method</div>
          <div class="helper">Select one — BNPL coming soon</div>
          <div class="pay-grid">
            <div class="pay-card" id="pay_wallet" onclick="selectPayMethod('wallet')" data-method="wallet">
              <i class="fa fa-wallet"></i>
              <div class="pay-label">AyitiBook Wallet</div>
              <div class="helper">fast & secure</div>
            </div>
            <div class="pay-card" id="pay_cod" onclick="selectPayMethod('cod')" data-method="COD">
              <i class="fa fa-money-bill-wave"></i>
              <div class="pay-label">Cash on Delivery</div>
              <div class="helper">Pay when delivered</div>
            </div>
            <div class="pay-card locked" id="pay_bnpl" title="Coming soon">
              <div style="position:absolute;top:8px;right:8px;"><span style="display:inline-flex;gap:6px;align-items:center;background:rgba(0,0,0,0.06);padding:6px 8px;border-radius:8px;font-weight:700;color:var(--muted)"><i class="fa fa-lock"></i></span></div>
              <i class="fa fa-credit-card"></i>
              <div class="pay-label">BNPL</div>
              <div class="helper">Buy Now, Pay Later</div>
            </div>
          </div>

          <button class="place-cta" id="place_order_btn" onclick="handlePlaceOrder()">
            <i class="fa fa-check-circle"></i> Place Order
          </button>
        </div>
      </div><!-- /RIGHT -->

    </div><!-- /layout -->
  </div><!-- /container -->
</div><!-- /outer-wrap -->

<div id="toastBox" aria-live="polite"></div>

<!-- Hidden form for POST submit -->
<form id="checkoutForm" method="POST" action="{{ route('checkout.placeOrder') }}" style="display:none;">
  @csrf
  <input type="hidden" name="billing_name"     id="f_billing_name">
  <input type="hidden" name="billing_phone"    id="f_billing_phone">
  <input type="hidden" name="billing_email"    id="f_billing_email">
  <input type="hidden" name="billing_address"  id="f_billing_address">
  <input type="hidden" name="billing_city"     id="f_billing_city">
  <input type="hidden" name="billing_state"    id="f_billing_state">
  <input type="hidden" name="billing_country"  id="f_billing_country">
  <input type="hidden" name="billing_zip"      id="f_billing_zip">
  <input type="hidden" name="shipping_name"    id="f_shipping_name">
  <input type="hidden" name="shipping_phone"   id="f_shipping_phone">
  <input type="hidden" name="shipping_address" id="f_shipping_address">
  <input type="hidden" name="shipping_city"    id="f_shipping_city">
  <input type="hidden" name="shipping_state"   id="f_shipping_state">
  <input type="hidden" name="shipping_country" id="f_shipping_country">
  <input type="hidden" name="shipping_zip"     id="f_shipping_zip">
  <input type="hidden" name="payment_method"   id="f_payment_method">
  <input type="hidden" name="address_id"       id="f_address_id">
  <input type="hidden" name="items_json"       id="f_items_json">
  <input type="hidden" name="subtotal"            id="f_subtotal">
  <input type="hidden" name="tax"                 id="f_tax">
  <input type="hidden" name="shipping_fee"        id="f_shipping_fee">
  <input type="hidden" name="total"               id="f_total">
  <input type="hidden" name="coupon_code"         id="f_coupon_code">
  <input type="hidden" name="coupon_discount"     id="f_coupon_discount">
  <input type="hidden" name="ayiticash_discount"  id="f_ayiticash_discount">
  <input type="hidden" name="total_discount"      id="f_total_discount">
  <input type="hidden" name="free_shipping"       id="f_free_shipping">
</form>

<script>
const TAX_PERCENT    = 5;
const DEFAULT_SHIP   = 15.00;
const FALLBACK_IMAGE = '{{ asset('assets/images/no-image.png') }}';
const CSRF           = document.querySelector('meta[name="csrf-token"]').content;

let orderPayload     = { items: [], subtotal: 0 };
let selectedAddressId = null;
let selectedPayMethod = 'COD';

/* ── Slider ───────────────────────────────────────────── */
// slider elements referenced inside DOMContentLoaded below
let slider, prevBtn, nextBtn;

function visibleCount(){
  const w = window.innerWidth;
  if(w >= 1200) return 4; if(w >= 900) return 3; if(w >= 700) return 2; return 1;
}
function updateSliderWidths(){
  if(!slider) return;
  const v = visibleCount(), gap = 12;
  const pw = Math.max(520, slider.parentElement.clientWidth - 84);
  const iw = Math.max(180, Math.floor((pw - gap*(v-1)) / v));
  Array.from(slider.children).forEach(el => el.style.width = iw + 'px');
}
window.addEventListener('resize', updateSliderWidths);

function scrollByPage(dir){
  if(!slider) return;
  const item = slider.querySelector('.slider-item');
  if(!item) return;
  slider.scrollBy({ left: dir * (item.getBoundingClientRect().width + 12) * visibleCount(), behavior:'smooth' });
}
// slider listeners moved to DOMContentLoaded

/* ── Select saved address ────────────────────────────── */
function selectAddress(el){
  document.querySelectorAll('.address-card').forEach(c => {
    c.classList.remove('active');
    const r = c.querySelector('.addr-radio');
    if(r){ r.classList.remove('checked'); r.querySelector('i').style.display = 'none'; }
  });
  el.classList.add('active');
  const radio = el.querySelector('.addr-radio');
  if(radio){ radio.classList.add('checked'); radio.querySelector('i').style.display = 'inline-block'; }

  // Autofill billing
  document.getElementById('bill_name').value    = el.dataset.name    || '';
  document.getElementById('bill_phone').value   = el.dataset.phone   || '';
  document.getElementById('address_line').value = el.dataset.line    || '';
  document.getElementById('city').value         = el.dataset.city    || '';
  document.getElementById('state').value        = el.dataset.state   || '';
  document.getElementById('country').value      = el.dataset.country || '';
  document.getElementById('zip').value          = el.dataset.zip     || '';

  selectedAddressId = el.dataset.id || null;

  // Lock billing + show edit button
  document.getElementById('billingCard').classList.add('form-locked');
  document.getElementById('editBillingBtn').style.display = 'inline-block';

  if(document.getElementById('same_as_billing').checked) fillShippingFromBilling();
}

function unlockBilling(){
  document.getElementById('billingCard').classList.remove('form-locked');
  // Deselect address card since user is manually editing
  document.querySelectorAll('.address-card').forEach(c => {
    c.classList.remove('active');
    const r = c.querySelector('.addr-radio');
    if(r){ r.classList.remove('checked'); r.querySelector('i').style.display='none'; }
  });
  selectedAddressId = null;
  document.getElementById('editBillingBtn').style.display = 'none';
}

/* ── Add new address form ────────────────────────────── */
// btn listeners moved to DOMContentLoaded
function toggleAddForm(show){
  document.getElementById('addAddressCard').style.display = show ? 'block' : 'none';
  if(show) document.getElementById('new_first_name').focus();
}

function saveNewAddress(){
  const btn = document.getElementById('saveAddressBtn');
  const firstName = document.getElementById('new_first_name').value.trim();
  const lastName  = document.getElementById('new_last_name').value.trim();
  const phone     = document.getElementById('new_phone').value.trim();
  const address   = document.getElementById('new_address').value.trim();
  const city      = document.getElementById('new_city').value.trim();
  const state     = document.getElementById('new_state').value.trim();
  const country   = document.getElementById('new_country').value.trim();
  const pincode   = document.getElementById('new_pincode').value.trim();
  const addrType  = document.getElementById('new_addr_type').value;
  const isDefault = document.getElementById('new_is_default').checked ? 1 : 0;

  if(!firstName || !address || !phone){
    showToast('First name, phone and address are required.', 'error'); return;
  }

  btn.disabled = true; btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Saving...';

  fetch('{{ route('account.add-address') }}', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
    body: JSON.stringify({ first_name: firstName, last_name: lastName, phone, alternate_phone: document.getElementById('new_alt_phone').value.trim(), address, city, state, country, postal_code: pincode, address_type: addrType, is_default: isDefault })
  })
  .then(r => r.json())
  .then(data => {
    if(data.success || data.sl_no || data.address){
      const saved = data.address || data;
      addAddressCard(saved, firstName + ' ' + lastName, phone, address, city, state, country, pincode, addrType, isDefault, saved.sl_no || saved.id);
      toggleAddForm(false);
      // Clear inputs
      ['new_first_name','new_last_name','new_phone','new_alt_phone','new_address','new_city','new_state','new_country','new_pincode'].forEach(id => document.getElementById(id).value = '');
      document.getElementById('new_is_default').checked = false;
      showToast('Address saved!', 'success');
    } else {
      showToast(data.message || 'Failed to save address.', 'error');
    }
  })
  .catch(() => showToast('Network error. Please try again.', 'error'))
  .finally(() => { btn.disabled = false; btn.innerHTML = '<i class="fa fa-save"></i> Save Address'; });
}

function addAddressCard(saved, fullName, phone, addrLine, city, state, country, zip, type, isDefault, id){
  const div = document.createElement('div');
  div.className = 'slider-item address-card';
  div.dataset.id      = id || '';
  div.dataset.name    = fullName;
  div.dataset.phone   = phone;
  div.dataset.line    = addrLine;
  div.dataset.city    = city;
  div.dataset.state   = state;
  div.dataset.country = country;
  div.dataset.zip     = zip;
  div.onclick = () => selectAddress(div);
  div.innerHTML = `
    <div style="flex:1">
      <div style="font-weight:800">${escapeHtml(ucfirst(type))}${isDefault ? ' <span class="default-badge">✔ Default</span>' : ''}</div>
      <div style="color:var(--muted);margin-top:6px;line-height:1.4">${escapeHtml(fullName)}<br>${escapeHtml(addrLine)}, ${escapeHtml(city)}<br>${escapeHtml(phone)}</div>
    </div>
    <div class="addr-radio"><i class="fa fa-check" style="display:none"></i></div>`;
  slider.prepend(div);
  updateSliderWidths();
  selectAddress(div);
}

/* ── Shipping toggle ─────────────────────────────────── */
// same_as_billing listener moved to DOMContentLoaded
function fillShippingFromBilling(){
  const g = id => document.getElementById(id)?.value || '';
  document.getElementById('ship_name').value    = g('bill_name');
  document.getElementById('ship_phone').value   = g('bill_phone');
  document.getElementById('ship_address').value = g('address_line');
  document.getElementById('ship_city').value    = g('city');
  document.getElementById('ship_state').value   = g('state');
  document.getElementById('ship_country').value = g('country');
  document.getElementById('ship_zip').value     = g('zip');
}

/* ── Payment method ──────────────────────────────────── */
function selectPayMethod(key){
  document.querySelectorAll('.pay-card').forEach(c => c.classList.remove('selected'));
  document.getElementById('pay_' + key)?.classList.add('selected');
  selectedPayMethod = key === 'cod' ? 'COD' : (key === 'wallet' ? 'Wallet' : key);
}
// selectPayMethod moved to DOMContentLoaded

/* ── Load cart from sessionStorage (set by cart page) ── */
function loadOrderPayload(){
  try {
    const s = sessionStorage.getItem('checkout_items');
    if(s) orderPayload = JSON.parse(s);
  } catch(e){}

  // Fallback: fetch fresh from server
  if(!orderPayload?.items?.length){
    fetch('{{ route('cart.get-items') }}', { headers:{ 'X-CSRF-TOKEN': CSRF } })
      .then(r => r.json())
      .then(data => {
        if(data.items?.length){
          orderPayload = {
            items: data.items.map(i => ({
              id: i.product_id, cart_id: i.id,
              title: i.product_name, price: parseFloat(i.price),
              qty: i.quantity, subtotal: parseFloat(i.subtotal),
              image: i.thumbnail
            })),
            subtotal: parseFloat(data.total)
          };
        }
        renderSummary();
      })
      .catch(() => renderSummary());
    return;
  }
  renderSummary();
}
// loadOrderPayload moved to DOMContentLoaded

/* ── Render summary ──────────────────────────────────── */
function renderSummary(){
  const list  = document.getElementById('order_items_list');
  const items = orderPayload.items || [];
  if(!items.length){
    list.innerHTML = '<div class="helper">No items. <a href="{{ route('cart.index') }}">Go to cart</a></div>';
    document.getElementById('place_order_btn').disabled = true;
    return;
  }
  list.innerHTML = items.map(it => `
    <div class="order-item">
      <img src="${escapeHtml(it.image || FALLBACK_IMAGE)}" alt="item" onerror="this.src='${FALLBACK_IMAGE}'">
      <div style="flex:1">
        <div style="font-weight:800;font-size:13px">${escapeHtml(it.title)}</div>
        <div class="helper">${it.qty} × $${Number(it.price).toFixed(2)}</div>
      </div>
      <div style="font-weight:900;font-size:13px">$${Number(it.subtotal || it.price * it.qty).toFixed(2)}</div>
    </div>`).join('');

  document.getElementById('items_count').innerText = items.length + ' item' + (items.length !== 1 ? 's' : '');

  const rawSubtotal    = Number(orderPayload.subtotal || items.reduce((s,i) => s + (i.subtotal || i.price * i.qty), 0));
  const tax            = Number(orderPayload.tax            || +(rawSubtotal * TAX_PERCENT / 100));
  const totalDiscount  = Number(orderPayload.total_discount || 0);
  const couponDiscount = Number(orderPayload.coupon_discount    || 0);
  const ayitiDiscount  = Number(orderPayload.ayiticash_discount || 0);
  const couponCode     = orderPayload.coupon_code || null;
  const freeShip       = orderPayload.free_shipping_coupon || false;
  // discounted_subtotal = raw subtotal minus coupon/ayiticash (set by cart page)
  const discountedSub  = Number(orderPayload.discounted_subtotal ?? Math.max(0, rawSubtotal - totalDiscount));
  const ship           = freeShip ? 0 : (discountedSub > 0 ? DEFAULT_SHIP : 0);
  const total          = Math.max(0, discountedSub + tax + ship);

  document.getElementById('summary_subtotal').innerText = '$' + rawSubtotal.toFixed(2);
  document.getElementById('summary_tax').innerText      = '$' + tax.toFixed(2);
  document.getElementById('summary_shipping').innerText = ship === 0 ? (freeShip ? 'Free 🎉' : 'Free') : '$' + ship.toFixed(2);
  // Discount row — show breakdown
  if(totalDiscount > 0){
    let label = '-$' + totalDiscount.toFixed(2);
    if(couponCode && couponDiscount > 0) label += ' (' + couponCode + ')';
    if(ayitiDiscount > 0)                label += ' +AyitiCash';
    document.getElementById('summary_discount').innerText = label;
  } else {
    document.getElementById('summary_discount').innerText = '-$0.00';
  }
  document.getElementById('summary_total').innerText = '$' + total.toFixed(2);
}

/* ── Place order ─────────────────────────────────────── */
function handlePlaceOrder(){
  const billName  = document.getElementById('bill_name').value.trim();
  const billPhone = document.getElementById('bill_phone').value.trim();
  const addrLine  = document.getElementById('address_line').value.trim();

  if(!billName || !billPhone || !addrLine){
    showToast('Please complete billing name, phone and address.', 'error'); return;
  }
  if(!orderPayload.items?.length){
    showToast('Your cart is empty.', 'error'); return;
  }

  const sameAsBilling  = document.getElementById('same_as_billing').checked;
  const rawSubtotal    = Number(orderPayload.subtotal || 0);
  const tax            = Number(orderPayload.tax || +(rawSubtotal * TAX_PERCENT / 100));
  const totalDiscount  = Number(orderPayload.total_discount    || 0);
  const couponDiscount = Number(orderPayload.coupon_discount   || 0);
  const ayitiDiscount  = Number(orderPayload.ayiticash_discount|| 0);
  const freeShip       = orderPayload.free_shipping_coupon || false;
  const discountedSub  = Number(orderPayload.discounted_subtotal ?? Math.max(0, rawSubtotal - totalDiscount));
  const shipFee        = freeShip ? 0 : (discountedSub > 0 ? DEFAULT_SHIP : 0);
  const total          = Math.max(0, discountedSub + tax + shipFee);

  // Wallet → redirect to gateway
  if(selectedPayMethod === 'Wallet'){
    showToast('Redirecting to payment gateway...', 'success');
    setTimeout(() => window.location.href = '/payment-gateway?method=wallet', 700);
    return;
  }

  // Fill hidden form and submit
  document.getElementById('f_billing_name').value    = billName;
  document.getElementById('f_billing_phone').value   = billPhone;
  document.getElementById('f_billing_email').value   = document.getElementById('bill_email').value.trim();
  document.getElementById('f_billing_address').value = addrLine;
  document.getElementById('f_billing_city').value    = document.getElementById('city').value.trim();
  document.getElementById('f_billing_state').value   = document.getElementById('state').value.trim();
  document.getElementById('f_billing_country').value = document.getElementById('country').value.trim();
  document.getElementById('f_billing_zip').value     = document.getElementById('zip').value.trim();
  document.getElementById('f_payment_method').value  = selectedPayMethod;
  document.getElementById('f_address_id').value      = selectedAddressId || '';
  document.getElementById('f_subtotal').value           = discountedSub.toFixed(2);
  document.getElementById('f_tax').value                = tax.toFixed(2);
  document.getElementById('f_shipping_fee').value       = shipFee.toFixed(2);
  document.getElementById('f_total').value              = total.toFixed(2);
  document.getElementById('f_coupon_code').value        = orderPayload.coupon_code     || '';
  document.getElementById('f_coupon_discount').value    = couponDiscount.toFixed(2);
  document.getElementById('f_ayiticash_discount').value = ayitiDiscount.toFixed(2);
  document.getElementById('f_total_discount').value     = totalDiscount.toFixed(2);
  document.getElementById('f_free_shipping').value      = freeShip ? '1' : '0';
  document.getElementById('f_items_json').value         = JSON.stringify(orderPayload.items);

  if(sameAsBilling){
    document.getElementById('f_shipping_name').value    = billName;
    document.getElementById('f_shipping_phone').value   = billPhone;
    document.getElementById('f_shipping_address').value = addrLine;
    document.getElementById('f_shipping_city').value    = document.getElementById('city').value.trim();
    document.getElementById('f_shipping_state').value   = document.getElementById('state').value.trim();
    document.getElementById('f_shipping_country').value = document.getElementById('country').value.trim();
    document.getElementById('f_shipping_zip').value     = document.getElementById('zip').value.trim();
  } else {
    document.getElementById('f_shipping_name').value    = document.getElementById('ship_name').value.trim();
    document.getElementById('f_shipping_phone').value   = document.getElementById('ship_phone').value.trim();
    document.getElementById('f_shipping_address').value = document.getElementById('ship_address').value.trim();
    document.getElementById('f_shipping_city').value    = document.getElementById('ship_city').value.trim();
    document.getElementById('f_shipping_state').value   = document.getElementById('ship_state').value.trim();
    document.getElementById('f_shipping_country').value = document.getElementById('ship_country').value.trim();
    document.getElementById('f_shipping_zip').value     = document.getElementById('ship_zip').value.trim();
  }

  document.getElementById('place_order_btn').disabled = true;
  document.getElementById('place_order_btn').innerHTML = '<i class="fa fa-spinner fa-spin"></i> Placing order...';
  document.getElementById('checkoutForm').submit();
}

/* ── Utilities ───────────────────────────────────────── */
function showToast(msg, type='success'){
  const box = document.getElementById('toastBox');
  const t   = document.createElement('div');
  t.className = 'toast ' + (type === 'error' ? 'error' : 'success');
  t.innerHTML = (type==='error' ? '<i class="fa fa-exclamation-circle"></i>' : '<i class="fa fa-check-circle"></i>') + `<div style="flex:1;margin-left:6px">${msg}</div>`;
  box.appendChild(t);
  setTimeout(() => { t.style.opacity=0; setTimeout(() => t.remove(), 300); }, 3200);
}
function escapeHtml(s){ return String(s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }
function ucfirst(s){ return s ? s.charAt(0).toUpperCase() + s.slice(1) : ''; }

window.addEventListener('DOMContentLoaded', () => {
  // Init slider elements
  slider  = document.getElementById('addressSlider');
  prevBtn = document.getElementById('sliderPrev');
  nextBtn = document.getElementById('sliderNext');
  if(prevBtn) prevBtn.addEventListener('click', () => scrollByPage(-1));
  if(nextBtn) nextBtn.addEventListener('click', () => scrollByPage(1));
  setTimeout(updateSliderWidths, 120);

  // Button listeners
  document.getElementById('btn_show_add')?.addEventListener('click', () => toggleAddForm(true));
  document.getElementById('btn_add_close')?.addEventListener('click', () => toggleAddForm(false));

  // Shipping toggle
  document.getElementById('same_as_billing')?.addEventListener('change', function(){
    const node = document.getElementById('shippingForm');
    if(this.checked){ node.style.display = 'none'; fillShippingFromBilling(); }
    else             { node.style.display = 'block'; }
  });

  // Init payment + load cart payload
  selectPayMethod('cod');
  loadOrderPayload();

  // Auto-select default saved address
  const defCard   = Array.from(document.querySelectorAll('.address-card')).find(c => c.querySelector('.default-badge'));
  const firstCard = document.querySelector('.address-card[data-id]');
  if(defCard)        selectAddress(defCard);
  else if(firstCard) selectAddress(firstCard);
});
</script>

@include('includes.footer')


</body>
</html>