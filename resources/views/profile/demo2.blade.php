<?php
// ================== SAFE BASE PATH FIX ==================
$BASE_PATH = dirname(__DIR__); // points to 17-april-2025 folder

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
  margin-bottom:8px;
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

/* progress */
.delivery-progress{
  display:flex;
  justify-content:space-between;
  position:relative;
  margin:25px 0;
}

.delivery-progress::before{
  content:'';
  position:absolute;
  top:14px;
  left:0;
  right:0;
  height:3px;
  background:#ddd;
}

.step{
  position:relative;
  text-align:center;
  z-index:1;
}

.step i{
  background:#0d6efd;
  color:#fff;
  padding:8px;
  border-radius:50%;
}

.step small{
  font-size:12px;
}

/* right-side tags/buttons */
.gps-btn{
  background:#ffc107;
  border:none;
  font-size:13px;
  padding:6px 14px;
  border-radius:4px;
}




/* review textarea width */
.review-textarea{
  width:80%;
  min-width:340px;
}

@media(max-width:768px){
  .review-textarea{
    width:100%;
  }
}

.action-link{
  font-size:13px;
  text-decoration:none;
  color:#0d6efd;
  display:inline-flex;
  align-items:center;
  gap:6px;
  white-space:nowrap;
}

/* ===== STAR RATING ===== */
.star-rating{
  display:flex;
  gap:6px;
  font-size:22px;
  cursor:pointer;
}

.star-rating i{
  color:#ccc;
  transition:color .2s ease;
}

.star-rating i.active,
.star-rating i.hover{
  color:#f5c518; /* yellow */
}

/* ===== ATTACH MEDIA ===== */
.review-actions{
  display:flex;
  align-items:center;
  gap:15px;
  margin:8px 0 12px;
}

.attach-btn{
  font-size:13px;
  color:#0d6efd;
  cursor:pointer;
  display:inline-flex;
  align-items:center;
  gap:6px;
}

.attach-btn input{
  display:none;
}
/* progress fill line */
.delivery-progress .progress-fill{
  position:absolute;
  top:14px;
  left:0;
  height:3px;
  width:66.66%;              /* fill till Out for Delivery */
  background:#0d6efd;
  z-index:0;
  transition:width .6s ease;
}

.step.completed i{
  background:#0d6efd;
}

.step.pending i{
  background:#ccc;
}

/* ===== ORDER SUMMARY STYLE ===== */
.order-summary{
  font-size:14px;
}

.summary-row{
  display:flex;
  justify-content:space-between;
  margin-bottom:6px;
}

.summary-row span:last-child{
  font-weight:500;
}

.summary-row.total{
  font-weight:700;
  font-size:15px;
}

.order-summary hr{
  margin:10px 0;
  border-top:1px solid #ddd;
}


</style>
</head>

<body>

<!-- ================= HEADER ================= -->
<?php include $BASE_PATH . './includes/header.php'; ?>

<div class="container-fluid my-4">
  <div class="row">

    <!-- ================= SIDEBAR ================= -->
    <div class="col-lg-3 col-md-4">
      <?php include $BASE_PATH . './includes/sidebar.php'; ?>
    </div>

    <!-- ================= MAIN CONTENT ================= -->
    <div class="col-lg-9 col-md-8">

      <div class="order-detail-card">

        <!-- TOP ROW: TITLE + ESTIMATE + GPS -->
        <div class="d-flex justify-content-between flex-wrap gap-2 mb-3">
          <div>
            <h5>Order #<?php echo htmlspecialchars($order_id); ?></h5>
            <small>Order placed on September 11, 2025</small><br>
            <a href="#" class="btn btn-danger btn-sm mt-2">View or Print Invoice</a>
          </div>

          <div class="text-end">
            <div>
              <strong>Estimated Delivery Date:</strong><br>
              <span class="text-primary">Today</span>
            </div>
            <button class="gps-btn mt-2">GPS Tracking</button>
          </div>
        </div>

        <!-- PROGRESS TIMELINE -->
        <div class="delivery-progress">
        
          <div class="progress-fill"></div>
        
          <div class="step">
            <i class="fa fa-check"></i><br>
            <small>Order Placed<br>10:04 AM</small>
          </div>
        
          <div class="step">
            <i class="fa fa-box"></i><br>
            <small>Shipped<br>12:44 PM</small>
          </div>
        
          <div class="step">
            <i class="fa fa-truck"></i><br>
            <small>Out for Delivery<br>09:14 AM</small>
          </div>
        
          <div class="step">
            <i class="fa fa-home"></i><br>
            <small>Delivered<br>02:48 PM</small>
          </div>
        
        </div>
        

        <hr>

        <!-- SHIPPING / DELIVERY / SUMMARY -->
        <div class="row g-3">
          <div class="col-md-4">
            <div class="section-title">Delivery Details</div>
            Delivered by: AyitiBook<br>
            Tracking ID: <a href="#" class="text-decoration-none">rd5tuyytt</a><br>
            Delivery agent: Alexander Brown
        
            <hr class="my-2">     
            <strong>Standard Delivery</strong><br>
            <span class="text-muted">(3–5 Business Days)</span><br>
            <span class="text-muted">Carrier: ayitibook Express delivery</span>
          </div>



          <div class="col-md-4">
            <div class="section-title">Shipping Address</div>
            John Doe<br>
            221B Baker Street<br>
            London – 100001
        
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
                <span>₹709.00</span>
              </div>
          
              <div class="summary-row">
                <span>Shipping</span>
                <span class="text-success">₹0.00</span>
              </div>
          
              <div class="summary-row">
                <span>COD Fee</span>
                <span>₹7.00</span>
              </div>
          
              <div class="summary-row">
                <span>Promotion</span>
                <span class="text-success">− ₹14.18</span>
              </div>
          
              <hr>
          
              <div class="summary-row total">
                <span>Grand Total</span>
                <span>₹701.82</span>
              </div>
            </div>
          </div>
          
        </div>

        <hr>

        <!-- PRODUCT ROW -->
        <div class="d-flex align-items-center gap-3 mb-3">
          <img src="<?php echo '../assets/images/wishlist/product-media1.png'; ?>"
               alt="Gamepad" class="product-img">
          <div>
            <div class="section-title mb-1">Gamepad</div>
            <div>QTY: 1</div>
            <div class="text-danger">Price: $50</div>
            <div class="mt-1">
              <span class="text-muted">Sold by a verified partner:</span>
              <a href="#" class="text-decoration-none">Niketech</a><br>
              <span>Condition: <strong>New</strong></span>
            </div>
          </div>
          <div class="ms-auto text-end">
            <button class="btn btn-warning">Buy it again</button>
          </div>
        </div>

        <hr>

        <!-- RETURN / SUPPORT / REVIEW -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
          <div>
            <div class="section-title mb-1">Return / Refund</div>
            <small>Eligible till Oct 5, 2025</small><br>
        
            <a href="#" class="action-link">
              <i class="fa fa-file-lines"></i> View Return Policy
            </a>
          </div>
        
          <div class="text-end">
            <a href="#" class="action-link me-3">
              <i class="fa fa-rotate-left"></i> Request Return
            </a>
            <a href="#" class="action-link">
              <i class="fa fa-headset"></i> Get Support
            </a>
          </div>
        </div>
        
        <hr>
        <hr>

        <div class="row mb-3">
          <div class="col-md-12">
        
            <div class="section-title mb-1">Rate &amp; Review</div>
        
            <!-- STAR RATING -->
            <div class="star-rating mb-2" id="starRating">
              <i class="fa fa-star" data-value="1"></i>
              <i class="fa fa-star" data-value="2"></i>
              <i class="fa fa-star" data-value="3"></i>
              <i class="fa fa-star" data-value="4"></i>
              <i class="fa fa-star" data-value="5"></i>
            </div>
        
            <!-- hidden rating value -->
            <input type="hidden" name="rating" id="ratingValue" value="0">
        
            <!-- REVIEW TEXT -->
            <textarea
              class="form-control review-textarea mb-2"
              rows="3"
              placeholder="Write your review..."></textarea>
        
            <!-- ATTACH MEDIA -->
            <div class="review-actions">
              <label class="attach-btn">
                <i class="fa fa-image"></i> Add Photo
                <input type="file" accept="image/*">
              </label>
        
              <label class="attach-btn">
                <i class="fa fa-video"></i> Add Video
                <input type="file" accept="video/*">
              </label>
            </div>
        
            <button class="btn btn-primary btn-sm">Submit Review</button>
        
          </div>
        </div>
        

      </div>
    </div>
  </div>
</div>

<!-- ================= FOOTER ================= -->
<?php include $BASE_PATH . './includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
const stars = document.querySelectorAll('#starRating i');
const ratingInput = document.getElementById('ratingValue');

stars.forEach(star => {
  star.addEventListener('mouseenter', () => {
    const val = star.dataset.value;
    highlightStars(val);
  });

  star.addEventListener('mouseleave', () => {
    highlightStars(ratingInput.value);
  });

  star.addEventListener('click', () => {
    ratingInput.value = star.dataset.value;
    highlightStars(star.dataset.value);
  });
});

function highlightStars(value){
  stars.forEach(star => {
    star.classList.toggle('active', star.dataset.value <= value);
  });
}
</script>

</body>
</html>

