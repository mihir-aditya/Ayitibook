<?php
$order_id = $_GET['order_id'] ?? '10234';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Order Details | AyitiBook</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{
  background:#f4f6f9;
  font-family:Poppins,sans-serif;
}
.order-detail-card{
  background:#fff;
  border-radius:10px;
  box-shadow:0 3px 12px rgba(0,0,0,.1);
  padding:20px;
}
.section-title{
  font-weight:600;
  font-size:15px;
  margin-bottom:8px;
}
.divider{
  border-top:1px dashed #ddd;
  margin:18px 0;
}
.product-img{
  width:70px;
  height:70px;
  object-fit:cover;
  border-radius:6px;
}
.status-badge{
  padding:5px 12px;
  border-radius:20px;
  font-size:13px;
}
.completed{
  background:#d4edda;
  color:#155724;
}
.star{
  color:#f5c518;
  cursor:pointer;
}

@media(max-width:768px){
  .product-img{width:60px;height:60px}
}

/* ===== INVOICE / RECEIPT ONLY ===== */
.print-doc{
  font-family:Arial;
  font-size:14px;
  background:#fff;
  padding:30px;
}
.print-doc h2{
  text-align:center;
  font-weight:bold;
}
.print-doc table{
  width:100%;
  border-collapse:collapse;
  margin-top:10px;
}
.print-doc th,.print-doc td{
  border:1px solid #000;
  padding:6px;
}
.two-col{
  display:grid;
  grid-template-columns:1fr 2px 1fr;
  gap:20px;
}
.v-line{background:#000}
.center{text-align:center}
.right{text-align:right}
.green-box{
  background:none;
  color:#1a8f1a;
  padding:0;
  font-weight:700;
  text-align:center;
  display:inline-block;
}
.summary-box{
  border:2px solid #6cb6ff;
  padding:10px;
}
.footer-text{
  text-align:center;
  margin-top:20px;
  font-weight:bold;
}

@media print{
  body *{visibility:hidden}
  .print-doc,.print-doc *{visibility:visible}
  .print-doc{position:absolute;left:0;top:0;width:100%}
}

/* ===== HORIZONTAL DELIVERY PROGRESS METER ===== */
.delivery-progress-wrapper{
  margin:20px 0;
  --progress:75%;          /* line fill till "Out for Delivery" */
  --completed-index:2;     /* 0=1st,1=2nd,2=3rd,3=4th */
  --total-steps:4;         /* total circles */
}

/* truck row */
.delivery-truck-wrapper{
  position: relative;
  height:32px;
  margin-bottom:6px;
  width:100%;
}

/* moving truck – sits above last completed circle */
/* truck exactly above completed circle */
.delivery-truck{
  position:absolute;
  top:6px;
  /* use same coordinate system as circles: inside delivery-progress (minus padding) */
  left:calc(
          (var(--completed-index) / (var(--total-steps) - 1)) * 100%
          - 11px          /* half icon width, fine-tune if needed */
       );
  font-size:22px;
  color:#28a745;
  transition:left 0.4s ease;
  pointer-events:none;
}

/* hide truck row on mobile */
@media (max-width: 768px){
  .delivery-truck-wrapper{
    display:none;
  }
}

/* bar + steps */
/* key: position truck relative to .delivery-progress, not wrapper */
.delivery-progress{
  position: relative;
  display:flex;
  align-items:center;
  justify-content:space-between;
  margin:4px 0 20px;
  padding:0 2px;
  background:transparent;
}

/* base grey line */
.delivery-progress::before{
  content:"";
  position:absolute;
  top:14px;
  left:0;
  right:0;
  height:3px;
  background:#ddd;
  z-index:0;
}

/* thin green progress line */
.delivery-progress .progress-fill{
  position:absolute;
  top:14px;
  left:0;
  height:3px;
  background:#28a745;
  width:0;
  z-index:0;
  animation:fillProgress 1.8s ease forwards;
}

@keyframes fillProgress{
  from{width:0;}
  to{width:var(--progress);}
}

/* each step */
.delivery-step{
  flex:1;
  text-align:center;
  position:relative;
  z-index:1;
  background:transparent;
}

/* circles */
.step-circle{
  width:28px;
  height:28px;
  border-radius:50%;
  background:#ddd;
  margin:0 auto 6px;
  display:flex;
  align-items:center;
  justify-content:center;
  color:#fff;
  font-size:13px;
  transition:background 0.4s ease, transform 0.3s ease;
}

/* completed/active circles */
.delivery-step.completed .step-circle,
.delivery-step.active .step-circle{
  background:#28a745;
  transform:scale(1.05);
}

.step-label{
  font-size:12px;
  font-weight:500;
}
.step-time{
  font-size:11px;
  color:#777;
}

/* mobile stacking */
@media (max-width: 768px){
  .delivery-progress{
    flex-direction:column;
    align-items:flex-start;
  }
  .delivery-progress::before{
    display:none;
  }
}

/* rating hover */
.star:hover,
.star:hover ~ .star{
  color:#f5c518;
}
</style>
</head>

<body>

@include('includes.header')

<div class="container my-4">
  <div class="row">

    <!-- SIDEBAR -->
    <div class="col-lg-3 mb-3 mb-lg-0">
      <?php include './includes/sidebar.php'; ?>
    </div>

    <!-- MAIN --> 
    <div class="col-lg-9">

      <h3 class="mb-3">Order Details</h3>

      <div class="order-detail-card">

        <!-- PRODUCT HEADER -->
        <div class="row align-items-center g-3">
          <div class="col-auto">
            <img src="../assets/images/wishlist/product-media1.png" class="product-img" alt="Product">
          </div>

          <div class="col">
            <strong>Allen Solly Analog Watch</strong><br>
            <small>Order #<?php echo htmlspecialchars($order_id, ENT_QUOTES); ?></small><br>
            <small class="text-muted">Placed on Thu, 27 Nov 2025 • 10:21 AM</small><br>
            <small>Qty: 1</small>
          </div>

          <div class="col-12 col-md-auto text-md-end">
            <span class="status-badge completed d-inline-block mb-1">Delivered</span><br>
            <strong>₹709.00</strong><br>
            <a href="#" class="btn btn-sm btn-outline-success mt-2">
              <i class="fa fa-cart-plus me-1"></i> Buy Again
            </a>
          </div>
        </div>

        <!-- Invoice / Receipt buttons -->
        <div class="d-flex gap-2 my-3">
          <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#invoiceModal">
            <i class="fa fa-file-invoice"></i> Invoice
          </button>
          <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#receiptModal">
            <i class="fa fa-truck"></i> Delivery Receipt
          </button>
        </div>

        <div class="divider"></div>

        <!-- ORDER TIMELINE -->
        <div class="section-title">Order Updates</div>

        <div class="delivery-progress-wrapper">
          <!-- Truck above last completed step -->
          <div class="delivery-truck-wrapper">
            <i class="fa fa-truck-moving delivery-truck"></i>
          </div>

          <!-- Horizontal steps + fill -->
          <div class="delivery-progress">
            <div class="progress-fill"></div>

            <div class="delivery-step completed">
              <div class="step-circle">
                <i class="fa fa-check"></i>
              </div>
              <div class="step-label">Order Placed</div>
              <div class="step-time">27 Nov • 10:21</div>
            </div>

            <div class="delivery-step completed">
              <div class="step-circle">
                <i class="fa fa-check"></i>
              </div>
              <div class="step-label">Shipped</div>
              <div class="step-time">27 Nov • 11:43</div>
            </div>

            <div class="delivery-step completed">
              <div class="step-circle">
                <i class="fa fa-check"></i>
              </div>
              <div class="step-label">Out for Delivery</div>
              <div class="step-time">28 Nov • 09:37</div>
            </div>

            <div class="delivery-step">
              <div class="step-circle">
                <i class="fa fa-home"></i>
              </div>
              <div class="step-label">Delivered</div>
              <div class="step-time">28 Nov • 18:04</div>
            </div>
          </div>
        </div>

        <div class="divider"></div>

        <!-- PAYMENT + SHIPPING -->
        <div class="row g-3">
          <div class="col-md-6">
            <div class="section-title">Payment Method</div>
            <strong>Pay on Delivery</strong><br>
            <small class="text-muted">Cash / UPI accepted</small>
          </div>

          <div class="col-md-6">
            <div class="section-title">Shipping Address</div>
            Keshav Agarwala<br>
            221B Baker Street<br>
            London – 100001<br>
            +91 91536 70664
          </div>
        </div>

        <div class="divider"></div>

        <!-- SELLER + ORDER SUMMARY -->
        <div class="row g-3">
          <!-- SELLER DETAILS -->
          <div class="col-md-6">
            <div class="section-title">Seller Information</div>

            <div class="accordion" id="sellerAccordion">
              <div class="accordion-item">
                <h2 class="accordion-header" id="sellerHeading">
                  <button class="accordion-button collapsed py-2" type="button"
                          data-bs-toggle="collapse"
                          data-bs-target="#sellerInfo"
                          aria-expanded="false"
                          aria-controls="sellerInfo">
                    RetailNet
                  </button>
                </h2>

                <div id="sellerInfo" class="accordion-collapse collapse"
                     aria-labelledby="sellerHeading" data-bs-parent="#sellerAccordion">
                  <div class="accordion-body">
                    <strong>RetailNet</strong><br>
                    GST: 27AAACR1234F1ZK<br>
                    Support: <a href="mailto:sellersupport@ayitibook.com">sellersupport@ayitibook.com</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- ORDER SUMMARY -->
          <div class="col-md-6">
            <div class="section-title">Order Summary</div>

            <div class="d-flex justify-content-between">
              <span>Subtotal</span>
              <span>₹709.00</span>
            </div>
            <div class="d-flex justify-content-between">
              <span>Shipping</span>
              <span class="text-success">₹0.00</span>
            </div>
            <div class="d-flex justify-content-between">
              <span>COD Fee</span>
              <span>₹7.00</span>
            </div>
            <div class="d-flex justify-content-between">
              <span>Promotion</span>
              <span class="text-success">− ₹14.18</span>
            </div>

            <hr>

            <div class="d-flex justify-content-between fw-bold">
              <span>Grand Total</span>
              <span>₹701.82</span>
            </div>
          </div>
        </div>

        <div class="divider"></div>

        <!-- RETURN / SUPPORT -->
        <div class="d-flex justify-content-between flex-wrap gap-2">
          <small>Eligible for return till 6 Dec 2025</small>
          <div>
            <a href="#" class="btn btn-outline-danger btn-sm">Request Return</a>
            <a href="#" class="btn btn-outline-info btn-sm ms-2">
              <i class="fa fa-headset me-1"></i> Get Support
            </a>
          </div>
        </div>

        <div class="divider"></div>

        <!-- REVIEW -->
        <div>
          <div class="section-title">Rate your experience</div>
          <div class="mb-2">
            <i class="fa fa-star star"></i>
            <i class="fa fa-star star"></i>
            <i class="fa fa-star star"></i>
            <i class="fa fa-star star"></i>
            <i class="fa fa-star text-muted"></i>
          </div>
          <textarea class="form-control mb-3" rows="3" placeholder="Write your review..."></textarea>
          <button class="btn btn-primary btn-sm">Submit Review</button>
        </div>

        <!-- ================= INVOICE MODAL ================= -->
        <div class="modal fade" id="invoiceModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-body print-doc">

                <h2>AYITIBOOK INVOICE</h2>
                <hr>

                <div class="two-col">
                  <div>
                    <strong>Sold By</strong><br>
                    Emporium Store<br>
                    ID: 686464<br>
                    #42 Delmas 75, Ouest, Haiti<br>
                    Phone: 12346-685<br>
                    Email: <a href="mailto:customer@ayitibook.com">customer@ayitibook.com</a>
                  </div>
                  <div class="v-line"></div>
                  <div>
                    <strong>Invoice No:</strong> Ayi123-125<br>
                    <strong>Order ID:</strong> <?php echo htmlspecialchars($order_id, ENT_QUOTES); ?><br>
                    Invoice Date: Oct 25, 2025<br>
                    Payment Date: Oct 25, 2025
                  </div>
                </div>

                <div class="center mt-3"><strong>PRODUCT DETAILS</strong></div>

                <table>
                  <tr><th>Item</th><th>Name</th><th>Qty</th><th>Price</th><th>Total</th></tr>
                  <tr><td>1</td><td>Havic Gamepad (Black)</td><td>20</td><td>$92</td><td>$1840</td></tr>
                  <tr><td>2</td><td>T-shirt (White)</td><td>3</td><td>$2</td><td>$6</td></tr>
                </table>

                <div class="two-col mt-3">
                  <div>
                    <strong>Payment Details</strong><br>
                    Ayitibook Wallet<br>
                    Wallet ID: 6336638<br>
                    TXN: 1638367<br><br>
                    <span class="green-box">PAID IN FULL</span>
                  </div>
                  <div class="v-line"></div>
                  <div>
                    <strong>Summary of Charges</strong><br>
                    Total: $1840<br>
                    Shipping: $10<br>
                    VAT: $0<br>
                    Discount: $100<br>
                    <strong>Net Paid: $1750</strong>
                  </div>
                </div>

                <div class="footer-text">AYITIBOOK – BUILT ON TRUST, DELIVERED WITH CARE</div>

                <div class="text-end mt-3">
                  <button onclick="window.print()" class="btn btn-success">Print / Save PDF</button>
                </div>

              </div>
            </div>
          </div>
        </div>

        <!-- ================= DELIVERY RECEIPT MODAL ================= -->
        <div class="modal fade" id="receiptModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-body print-doc">

                <h2>AYITIBOOK DELIVERY RECEIPT</h2>
                <hr>

                <div class="two-col">
                  <div>
                    <strong>Shipping Address</strong><br>
                    John Terry<br>
                    Rue Corem #42<br>
                    Delmas 75<br>
                    Phone: +509 4384-5677
                  </div>
                  <div class="v-line"></div>
                  <div>
                    Order ID: Ayi257-53<br>
                    Delivery Time: 11:27 AM<br>
                    Delivery Date: Oct 25, 2025<br>
                    Agent: Alexander Brown
                  </div>
                </div>

                <table class="mt-3">
                  <tr><th>Item ID</th><th>Item</th><th>Description</th><th>Qty</th><th>Condition</th></tr>
                  <tr><td>84648</td><td>Gamepad</td><td>Black</td><td>1</td><td>New</td></tr>
                  <tr><td>5923740</td><td>T-shirt</td><td>Red</td><td>2</td><td>Old</td></tr>
                </table>

                <div class="two-col mt-3">
                  <div>
                    <strong>Confirmation of Delivery</strong><br>
                    Received in excellent condition.<br><br>
                    Customer Signature ___________
                  </div>
                  <div class="v-line"></div>
                  <div class="summary-box">
                    <strong>SUMMARY</strong><br>
                    Subtotal: $10<br>
                    Shipping: $5<br>
                    Total: $15
                  </div>
                </div>

                <div class="green-box mt-3">DELIVERY CONFIRMED</div>

                <div class="footer-text">AYITIBOOK – BUILT ON TRUST, DELIVERED WITH CARE</div>

                <div class="text-end mt-3">
                  <button onclick="window.print()" class="btn btn-success">Print / Save PDF</button>
                </div>

              </div>
            </div>
          </div>
        </div>

      </div><!-- /order-detail-card -->

    </div><!-- /col-lg-9 -->
  </div><!-- /row -->
</div><!-- /container -->

@include('includes.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
// change status dynamically:
// const wrapper = document.querySelector('.delivery-progress-wrapper');
// wrapper.style.setProperty('--completed-steps', '2'); // for "Shipped"
// wrapper.style.setProperty('--progress', '50%');      // matching line fill
</script>
</body>
</html>

