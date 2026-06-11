<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Details | AyitiBook</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: #f4f6f9;
            font-family: Poppins, sans-serif;
        }

        .order-detail-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, .1);
            padding: 20px;
        }

        .section-title {
            font-weight: 600;
            margin-bottom: 8px;
        }

        .product-img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 6px;
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 13px;
        }

        .completed {
            background: #d4edda;
            color: #155724;
        }

        .delivery-progress {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin: 25px 0;
        }

        .delivery-progress::before {
            content: '';
            position: absolute;
            top: 14px;
            left: 0;
            right: 0;
            height: 3px;
            background: #ddd;
        }

        .step {
            position: relative;
            text-align: center;
            z-index: 1;
        }

        .step i {
            background: #0d6efd;
            color: #fff;
            padding: 8px;
            border-radius: 50%;
        }

        .step small {
            font-size: 12px;
        }

        .gps-btn {
            background: #ffc107;
            border: none;
            font-size: 13px;
            padding: 6px 14px;
            border-radius: 4px;
        }

        .action-link {
            font-size: 13px;
            text-decoration: none;
            color: #0d6efd;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        /* Star rating */
        .star-rating {
            display: flex;
            gap: 6px;
            font-size: 22px;
            cursor: pointer;
        }

        .star-rating i {
            color: #ccc;
            transition: color .2s ease;
        }

        .star-rating i.active,
        .star-rating i.hover {
            color: #f5c518;
        }

        .review-actions {
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 8px 0 12px;
        }

        .attach-btn {
            font-size: 13px;
            color: #0d6efd;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .attach-btn input {
            display: none;
        }

        .delivery-progress .progress-fill {
            position: absolute;
            top: 14px;
            left: 0;
            height: 3px;
            background: #0d6efd;
            z-index: 0;
            transition: width .6s ease;
        }

        .step.completed i {
            background: #0d6efd;
        }

        .step.pending i {
            background: #ccc;
        }

        .order-summary {
            font-size: 14px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
        }

        .summary-row span:last-child {
            font-weight: 500;
        }

        .summary-row.total {
            font-weight: 700;
            font-size: 15px;
        }

        .order-summary hr {
            margin: 10px 0;
            border-top: 1px solid #ddd;
        }

        /* Image preview */
        .img-preview-wrap {
            position: relative;
            width: 72px;
            height: 72px;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }

        .img-preview-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .img-preview-wrap .remove-img {
            position: absolute;
            top: 2px;
            right: 2px;
            background: rgba(0, 0, 0, .55);
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 11px;
            cursor: pointer;
        }

        .toastify {
            font-size: 14px;
        }
    </style>
</head>

<body>

    @include('includes.header')


    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="container-fluid my-4">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                @include('includes.sidebar')
            </div>

            <div class="col-lg-9 col-md-8">
                <div class="order-detail-card">
                    <!-- TOP ROW: TITLE + ESTIMATE + GPS -->
                    <div class="d-flex justify-content-between flex-wrap gap-2 mb-3">
                        <div>
                            <h5>Order #{{ $order->order_id }}</h5>
                            <small>Order placed on {{ $order->placed_at->format('F j, Y') }}</small><br>
                            <a href="#" class="btn btn-danger btn-sm mt-2">View or Print Invoice</a>
                        </div>
                        <div class="text-end">
                            <div>
                                <strong>Estimated Delivery Date:</strong><br>
                                <span
                                    class="text-primary">{{ $order->estimated_delivery_date ? $order->estimated_delivery_date->format('F j, Y') : 'Not specified' }}</span>
                            </div>
                            <button class="gps-btn mt-2">View on map</button>
                        </div>
                    </div>

                    <!-- PROGRESS TIMELINE -->
                    @php
                        $statusSteps = ['placed' => 1, 'confirmed' => 2, 'shipped' => 3, 'delivered' => 4];
                        $currentStep = $statusSteps[strtolower($order->order_status)] ?? 0;
                        $fillPercent = min(100, ($currentStep / 3) * 100);
                    @endphp
                    <div class="delivery-progress">
                        <div class="progress-fill" style="width:{{ $fillPercent }}%"></div>
                        <div class="step {{ $currentStep >= 1 ? 'completed' : 'pending' }}">
                            <i class="fa fa-check"></i><br>
                            <small>Order Placed<br>{{ $order->placed_at->format('h:i A') }}</small>
                        </div>
                        <div class="step {{ $currentStep >= 2 ? 'completed' : 'pending' }}">
                            <i class="fa fa-box"></i><br>
                            <small>Shipped<br>—</small>
                        </div>
                        <div class="step {{ $currentStep >= 3 ? 'completed' : 'pending' }}">
                            <i class="fa fa-truck"></i><br>
                            <small>Out for Delivery<br>—</small>
                        </div>
                        <div class="step {{ $currentStep >= 4 ? 'completed' : 'pending' }}">
                            <i class="fa fa-home"></i><br>
                            <small>Delivered<br>—</small>
                        </div>
                    </div>
                    <hr>

                    <!-- SHIPPING / DELIVERY / SUMMARY -->
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="section-title">Delivery Details</div>
                            @if ($order->deliveryPartnerPickup && $order->deliveryPartnerPickup->deliveryPartner)
                                @php $dp = $order->deliveryPartnerPickup->deliveryPartner; @endphp
                                Delivered by: {{ $dp->company_name ?? 'AyitiBook' }}<br>
                                Tracking ID: <a href="#"
                                    class="text-decoration-none">{{ $order->deliveryPartnerPickup->tracking_id ?? $order->order_id }}</a><br>
                                Delivery agent: {{ $dp->name ?? '—' }}
                            @else
                                Delivered by: AyitiBook<br>
                                Tracking ID: <a href="#"
                                    class="text-decoration-none">{{ $order->order_id }}</a><br>
                                Delivery agent: Not yet assigned
                            @endif
                        </div>

                        <div class="col-md-4">
                            <div class="section-title">Shipping Address</div>
                            {{ $order->address->first_name }} {{ $order->address->last_name }}<br>
                            {{ $order->address->address_line1 }}<br>
                            {{ $order->address->address_line2 }}<br>
                            {{ $order->address->city }} – {{ $order->address->state }} –
                            {{ $order->address->pincode }}
                            <hr class="my-2">
                            <div class="section-title">Payment Method</div>
                            Credit Card<br>
                            **** **** **** 1234
                        </div>

                        <div class="col-md-4">
                            <div class="section-title">Order Summary</div>
                            <div class="order-summary">
                                <div class="summary-row">
                                    <span>Subtotal</span>
                                    <span>@php $subtotal = $order->items->sum(fn($i) => $i->price * $i->quantity); @endphp ${{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div class="summary-row">
                                    <span>Shipping</span>
                                    <span class="text-success">${{ number_format($order->shipping_fee, 2) }}</span>
                                </div>
                                <div class="summary-row">
                                    <span>Tax</span>
                                    <span>${{ number_format($order->tax, 2) }}</span>
                                </div>
                                <div class="summary-row">
                                    <span>Discount</span>
                                    <span class="text-success">−
                                        ${{ number_format($order->discount_amount, 2) }}</span>
                                </div>
                                <hr>
                                <div class="summary-row total">
                                    <span>Grand Total</span>
                                    <span>${{ number_format($order->total_amount, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <!-- PRODUCT ROW (with review and refund buttons) -->
                    @foreach ($order->items as $item)
                        @php
                            $product = $item->product;
                            $imgUrl = $product?->thumbnail
                                ? asset('storage/' . $product->thumbnail)
                                : asset('assets/images/wishlist/product-media1.png');
                            $variant = is_array($item->variant) ? (object) $item->variant : $item->variant;
                        @endphp
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <img src="{{ $imgUrl }}" alt="Product" class="product-img">
                            <div>
                                <div class="section-title mb-1">{{ $item->name }}</div>
                                <div>QTY: {{ $item->quantity }}</div>
                                <div class="text-danger">Price: ${{ number_format($item->price, 2) }}</div>
                                <div class="text-danger">Variant: {{ $variant?->variant_name }}</div>
                                <div class="mt-1">
                                    <span class="text-muted">Sold by: </span>
                                    <a href="#"
                                        class="text-decoration-none">{{ $item->product?->seller?->shop_name ?? 'AyitiBook Store' }}</a><br>
                                    @if ($item->size)
                                        <span class="text-muted">Size: {{ $item->size }}</span><br>
                                    @endif
                                </div>
                            </div>
                            <div class="ms-auto text-end">
                                <!-- Write Review Button -->
                                @if ($order->order_status === 'delivered' && !$item->reviewed)
                                    <button class="btn btn-outline-primary btn-sm me-2" data-bs-toggle="modal"
                                        data-bs-target="#reviewModal" data-product-id="{{ $item->product_id }}"
                                        data-product-name="{{ $item->name }}" data-item-id="{{ $item->id }}">
                                        <i class="fas fa-star"></i> Write a Review
                                    </button>
                                @endif
                                <!-- Request Return Button (if eligible) -->
                                @if (in_array($order->order_status, ['delivered', 'confirmed', 'shipped']) &&
                                        $order->placed_at->diffInDays(now()) <= 30 &&
                                        !$item->hasRefundRequest())
                                    <button class="btn btn-warning btn-sm refund-request-btn" data-bs-toggle="modal"
                                        data-bs-target="#refundModal" data-product-id="{{ $item->product_id }}"
                                        data-item-id="{{ $item->sl_no }}" data-order-id="{{ $order->order_id }}">
                                        <i class="fas fa-rotate-left"></i> Request Return
                                    </button>
                                @elseif ($item->hasRefundRequest())
                                    <button class="btn btn-secondary btn-sm" disabled>
                                        <i class="fas fa-check"></i> Request Submitted
                                    </button>
                                @endif
                                <!-- Buy it again (existing) -->
                                @if ($order->order_status === 'delivered' || $order->order_status === 'refunded' || $order->order_status === 'cancelled')
                                    <button class="btn btn-warning buy-again-btn"
                                        data-product-id="{{ $item->product_id }}"
                                        data-variant-id="{{ $variant->id ?? '' }}" data-size="{{ $item->size ?? '' }}"
                                        data-quantity="{{ $item->quantity }}">
                                        Buy it again
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    <hr>

                    <!-- RETURN / SUPPORT LINKS (global) -->
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div>
                            @if (in_array($order->order_status, ['pending', 'placed', 'confirmed']))
                                <form action="{{ route('order.cancel', $order->order_id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Cancel this order?')">
                                        <i class="fas fa-times"></i> Cancel
                                    </button>
                                </form>
                            @endif
                            <div class="section-title mb-1"><br>Return / Refund</div>
                            <small>Eligible till {{ $order->placed_at->addDays(30)->format('M j, Y') }}</small><br>
                            <a href="#" class="action-link"><i class="fa fa-file-lines"></i> View Return
                                Policy</a>
                        </div>
                        <div class="text-end">
                            <a href="#" class="action-link me-3"><i class="fa fa-rotate-left"></i> Request
                                Return</a>
                            <a href="#" class="action-link"><i class="fa fa-headset"></i> Get Support</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= MODAL: REVIEW ================= -->
    <div class="modal fade" id="reviewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Write a Review for <span id="reviewProductName"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="reviewForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product_id" id="reviewProductId">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Rating <span class="text-danger">*</span></label>
                            <div class="star-rating" id="modalStarRating">
                                <i class="fa fa-star" data-value="1"></i>
                                <i class="fa fa-star" data-value="2"></i>
                                <i class="fa fa-star" data-value="3"></i>
                                <i class="fa fa-star" data-value="4"></i>
                                <i class="fa fa-star" data-value="5"></i>
                            </div>
                            <input type="hidden" name="rating" id="modalRatingValue" value="0">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Your Review <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control" name="body" rows="4" required minlength="10" maxlength="2000"></textarea>
                            <div class="text-muted small mt-1">Min 10 characters</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Photos (optional, up to 5)</label>
                            <div class="review-actions">
                                <label class="attach-btn">
                                    <i class="fa fa-image"></i> Add Photo
                                    <input type="file" id="reviewImagesInput" accept="image/*" multiple>
                                </label>
                            </div>
                            <div id="reviewImagePreviews" class="d-flex flex-wrap gap-2 mt-2"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Review</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= MODAL: REFUND / RETURN ================= -->
    <div class="modal fade" id="refundModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Request Return / Refund</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="refundForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="order_id" id="refundOrderId">
                        <input type="hidden" name="order_item_id" id="refundOrderItemId">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Reason <span class="text-danger">*</span></label>
                            <select name="reason" class="form-select" required>
                                <option value="">Select reason</option>
                                <option value="damaged">Damaged / Defective</option>
                                <option value="wrong_item">Wrong item received</option>
                                <option value="not_as_described">Not as described</option>
                                <option value="size_issue">Size issue</option>
                                <option value="late_delivery">Late delivery</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Additional Comments</label>
                            <textarea class="form-control" name="comments" rows="3" placeholder="Please provide more details..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Upload Evidence (optional, up to 5 images)</label>
                            <div class="review-actions">
                                <label class="attach-btn">
                                    <i class="fa fa-image"></i> Add Images
                                    <input type="file" id="refundImagesInput" accept="image/*" multiple>
                                </label>
                            </div>
                            <div id="refundImagePreviews" class="d-flex flex-wrap gap-2 mt-2"></div>
                        </div>
                        <button type="submit" class="btn btn-warning">Submit Request</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('includes.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
        // CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Toast helper
        function toast(msg, type = 'success') {
            Toastify({
                text: msg,
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: type === "success" ? "linear-gradient(to right,#00b09b,#96c93d)" :
                    "linear-gradient(to right,#ff5f6d,#ffc371)"
            }).showToast();
        }

        // Refresh cart count (for Buy it again)
        function refreshCartCount() {
            fetch("{{ route('cart.count') }}")
                .then(response => response.json())
                .then(data => {
                    const cartCountSpan = document.getElementById('cart-count');
                    if (cartCountSpan) cartCountSpan.textContent = data.count;
                })
                .catch(err => console.error('Error refreshing cart count:', err));
        }

        // Buy again function (same as product-details)
        function buyAgain(productId, variantId, size, quantity) {
            fetch("{{ route('cart.add') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        variant_id: variantId,
                        size: size,
                        quantity: quantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        toast(data.message || 'Added to cart!');
                        refreshCartCount();
                        const cartItemId = data.cart_item_id || '';
                        window.location.href = "{{ route('cart.index') }}" + (cartItemId ? '?buy_now=' + cartItemId :
                            '');
                    } else {
                        toast(data.message || 'Something went wrong', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    toast('Failed to add to cart.', 'error');
                });
        }

        // Attach Buy it again buttons
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.buy-again-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const productId = this.dataset.productId;
                    const variantId = this.dataset.variantId || null;
                    const size = this.dataset.size || null;
                    const quantity = parseInt(this.dataset.quantity) || 1;
                    buyAgain(productId, variantId, size, quantity);
                });
            });
        });

        // ======================= REVIEW MODAL =======================
        let selectedFiles = [];

        function previewImages(input, containerId, maxFiles = 5) {
            const container = document.getElementById(containerId);
            if (!container) return;
            container.innerHTML = '';
            selectedFiles = [];
            const files = Array.from(input.files);
            if (files.length > maxFiles) {
                toast(`You can upload a maximum of ${maxFiles} images.`, 'error');
                input.value = '';
                return;
            }
            files.forEach((file, idx) => {
                if (!file.type.startsWith('image/')) {
                    toast('Only image files are allowed.', 'error');
                    return;
                }
                selectedFiles.push(file);
                const reader = new FileReader();
                reader.onload = function(e) {
                    const wrap = document.createElement('div');
                    wrap.className = 'img-preview-wrap';
                    wrap.setAttribute('data-idx', idx);
                    wrap.innerHTML = `
                        <img src="${e.target.result}" alt="Preview">
                        <button type="button" class="remove-img" onclick="removePreviewImage(this, ${idx})">×</button>
                    `;
                    container.appendChild(wrap);
                };
                reader.readAsDataURL(file);
            });
        }

        window.removePreviewImage = function(btn, idx) {
            selectedFiles.splice(idx, 1);
            btn.closest('.img-preview-wrap').remove();
            // recreate previews
            const input = document.getElementById('reviewImagesInput');
            const dt = new DataTransfer();
            selectedFiles.forEach(file => dt.items.add(file));
            input.files = dt.files;
            // refresh previews
            previewImages(input, 'reviewImagePreviews');
        };

        // Star rating for modal
        const modalStars = document.querySelectorAll('#modalStarRating i');
        const modalRatingInput = document.getElementById('modalRatingValue');

        function highlightModalStars(value) {
            modalStars.forEach(star => {
                star.classList.toggle('active', star.dataset.value <= value);
            });
        }

        modalStars.forEach(star => {
            star.addEventListener('mouseenter', () => {
                highlightModalStars(star.dataset.value);
            });
            star.addEventListener('mouseleave', () => {
                highlightModalStars(modalRatingInput.value);
            });
            star.addEventListener('click', () => {
                modalRatingInput.value = star.dataset.value;
                highlightModalStars(star.dataset.value);
            });
        });

        // Set product info when review modal opens
        const reviewModal = document.getElementById('reviewModal');
        reviewModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const productId = button.getAttribute('data-product-id');
            const productName = button.getAttribute('data-product-name');
            document.getElementById('reviewProductId').value = productId;
            document.getElementById('reviewProductName').innerText = productName;
            // reset form
            document.getElementById('reviewForm').reset();
            modalRatingInput.value = 0;
            highlightModalStars(0);
            selectedFiles = [];
            document.getElementById('reviewImagePreviews').innerHTML = '';
            document.getElementById('reviewImagesInput').value = '';
        });

        // Handle review submit
        document.getElementById('reviewForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const productId = document.getElementById('reviewProductId').value;
            const rating = modalRatingInput.value;
            if (rating == 0) {
                toast('Please select a rating.', 'error');
                return;
            }
            const body = this.body.value.trim();
            if (body.length < 10) {
                toast('Review must be at least 10 characters.', 'error');
                return;
            }

            const formData = new FormData();
            formData.append('rating', rating);
            formData.append('body', body);
            selectedFiles.forEach(file => {
                formData.append('images[]', file);
            });

            fetch(`/products/${productId}/reviews`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        toast(data.message || 'Review submitted successfully!');
                        const modal = bootstrap.Modal.getInstance(reviewModal);
                        modal.hide();
                        // optionally reload or show success message
                    } else {
                        toast(data.message || 'Something went wrong.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    toast('Failed to submit review.', 'error');
                });
        });

        document.getElementById('reviewImagesInput').addEventListener('change', function() {
            previewImages(this, 'reviewImagePreviews');
        });

        // ======================= REFUND MODAL =======================
        let refundSelectedFiles = [];

        function refundPreviewImages(input, containerId, maxFiles = 5) {
            const container = document.getElementById(containerId);
            if (!container) return;
            container.innerHTML = '';
            refundSelectedFiles = [];
            const files = Array.from(input.files);
            if (files.length > maxFiles) {
                toast(`You can upload a maximum of ${maxFiles} images.`, 'error');
                input.value = '';
                return;
            }
            files.forEach((file, idx) => {
                if (!file.type.startsWith('image/')) {
                    toast('Only image files are allowed.', 'error');
                    return;
                }
                refundSelectedFiles.push(file);
                const reader = new FileReader();
                reader.onload = function(e) {
                    const wrap = document.createElement('div');
                    wrap.className = 'img-preview-wrap';
                    wrap.setAttribute('data-idx', idx);
                    wrap.innerHTML = `
                        <img src="${e.target.result}" alt="Preview">
                        <button type="button" class="remove-img" onclick="removeRefundPreviewImage(this, ${idx})">×</button>
                    `;
                    container.appendChild(wrap);
                };
                reader.readAsDataURL(file);
            });
        }

        window.removeRefundPreviewImage = function(btn, idx) {
            refundSelectedFiles.splice(idx, 1);
            btn.closest('.img-preview-wrap').remove();
            const input = document.getElementById('refundImagesInput');
            const dt = new DataTransfer();
            refundSelectedFiles.forEach(file => dt.items.add(file));
            input.files = dt.files;
            refundPreviewImages(input, 'refundImagePreviews');
        };

        // Set refund data when modal opens
        const refundModalEl = document.getElementById('refundModal');
        refundModalEl.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            currentRefundButton = button; // store for later use
            const orderId = button.getAttribute('data-order-id');
            const itemId = button.getAttribute('data-item-id');
            document.getElementById('refundOrderId').value = orderId;
            document.getElementById('refundOrderItemId').value = itemId;
            // reset form
            document.getElementById('refundForm').reset();
            refundSelectedFiles = [];
            document.getElementById('refundImagePreviews').innerHTML = '';
            document.getElementById('refundImagesInput').value = '';
        });

        // Handle refund submit
        document.getElementById('refundForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const orderId = document.getElementById('refundOrderId').value;
            const orderItemId = document.getElementById('refundOrderItemId').value;
            const reason = this.reason.value;
            if (!reason) {
                toast('Please select a reason.', 'error');
                return;
            }
            const comments = this.comments.value;

            const formData = new FormData();
            formData.append('order_id', orderId);
            formData.append('order_item_id', orderItemId);
            formData.append('reason', reason);
            formData.append('comments', comments);
            refundSelectedFiles.forEach(file => {
                formData.append('images[]', file);
            });

            fetch('/refund-request', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    toast(data.message || 'Refund request submitted successfully!');
                    const modal = bootstrap.Modal.getInstance(refundModalEl);
                    modal.hide();
                    // Disable the button and change its appearance
                    if (currentRefundButton) {
                        currentRefundButton.disabled = true;
                        currentRefundButton.innerHTML = '<i class="fas fa-check"></i> Request Submitted';
                        currentRefundButton.classList.remove('btn-warning');
                        currentRefundButton.classList.add('btn-secondary');
                    }
                } else {
                    toast(data.message || 'Something went wrong.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                toast('Failed to submit refund request.', 'error');
            });
        });

        document.getElementById('refundImagesInput').addEventListener('change', function() {
            refundPreviewImages(this, 'refundImagePreviews');
        });
    </script>
</body>

</html>
