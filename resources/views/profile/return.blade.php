<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Return & Refund</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    body { background:#f8f9fa; font-family:"Poppins",sans-serif; }
    .return-card {
      background:#fff; padding:25px; border-radius:8px;
      box-shadow:0 2px 8px rgba(0,0,0,0.08);
      margin:40px auto; max-width:1100px;
    }
    .table thead th { background:#f1f1f1; font-weight:600; }
    .product-img {
      width:55px; height:55px; object-fit:cover;
      border-radius:6px;
    }
    .status-badge {
      padding:6px 10px; border-radius:20px; font-size:13px;
      font-weight:500;
    }
    .requested   { background:#fff3cd; color:#856404; }
    .approved    { background:#d4edda; color:#155724; }
    .rejected    { background:#f8d7da; color:#721c24; }
    .refunded    { background:#cce5ff; color:#004085; }
    .inprogress  { background:#e2e3e5; color:#41464b; }
  </style>
   <style>
     /* small responsive tweaks for the input group + dropdown */
    .search-filter-row {
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
      align-items: center;
    }
    .search-filter-row .input-group { flex: 1 1 360px; min-width: 220px; }
    .search-filter-row .dropdown { white-space: nowrap; }

    /* show which filter is active */
    .filter-active { font-weight:600; color:#0d6efd; }


  /* Dropdown background */
  .dropdown-menu {
    background: rgba(255, 255, 255, 0.95); /* white with slight transparency */
    border: 1px solid #ddd;
    border-radius: 8px;
    max-height: 450px;   /* control height */
    overflow-y: auto;    /* scroll if too tall */
    padding-bottom: 70px; /* space for sticky button */
  }

  /* Filter option labels */
  .dropdown-menu .form-check-label {
    color: #212529; /* darker text */
    font-weight: 500;
  }

  /* Radio inputs */
  .dropdown-menu .form-check-input {
    border: 2px solid #db4444; /* teal outline */
    cursor: pointer;
  }

  .dropdown-menu .form-check-input:checked {
    background-color: #db4444;
    border-color: #db4444;
  }

  /* Option hover effect */
  .dropdown-menu .form-check:hover {
    background: rgba(11, 114, 133, 0.08); /* subtle teal hover */
    border-radius: 6px;
    transition: 0.2s ease;
  }

  /* Section headings (Sort By, Order Time, Order Status) */
  .dropdown-menu .fw-bold {
    color: #db4444;
    font-size: 14px;
    text-transform: uppercase;
  }
  
  /* Keep Apply button always visible at bottom */
.dropdown-menu .apply-btn {
  position: sticky;
  bottom: 0;
  background: transparent;
  padding: 0;
  margin: 0;
  border-top: none;
}

/* Full-width button styling */
.dropdown-menu .apply-btn button {
  display: block;
  width: 100%;              /* take full width */
  border-radius: 0;          /* remove rounded edges */
  padding: 12px;
  font-weight: 600;
  background: #dc3545;       /* red */
  color: #fff;
  text-align: center;
}
.dropdown-menu .apply-btn button:hover {
  background: #c82333;       /* darker red on hover */
  color: #fff;
  transition: 0.2s ease;
}
  </style>
</head>
<body>

@include('includes.header')

<div class="container my-4">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-lg-3">
      <?php include './includes/sidebar.php'; ?>
    </div>

    <!-- Return & Refund Table -->
    <div class="col-lg-9">
      <div class="return-card">
        <h3 class="mb-3">Return & Refund</h3>
                 <!-- Search + Filter row -->
        <div class="search-filter-row mb-3">
          <!-- Input group with search button -->
          <div class="input-group">
            <input id="searchInput" type="text" class="form-control" placeholder="Search orders (Order ID, Title, Status, Payment)..." aria-label="Search">
            <button class="btn btn-primary" id="searchBtn" type="button" title="Search">
              <i class="fa fa-search"></i>
            </button>
          </div>

          <!-- Filter Dropdown -->

          <div class="dropdown">
            <button id="filterBtn" class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Filter by <i class="fa fa-filter"></i>
            </button>
        
            <div class="dropdown-menu dropdown-menu-end p-3" style="min-width: 280px;">
              
              <!-- Sorting -->
              <div class="fw-bold mb-2">Sort By</div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="filterOption" id="sortAZ">
                <label class="form-check-label" for="sortAZ">Latest First</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="filterOption" id="sortDate">
                <label class="form-check-label" for="sortDate">Older First</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="filterOption" id="sortRecent">
                <label class="form-check-label" for="sortRecent">A - Z</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="filterOption" id="sortOlder">
                <label class="form-check-label" for="sortOlder">Z - A</label>
              </div>

               <hr>
              
              <!-- Order Time -->
              <div class="fw-bold mb-2">Order Time</div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="filterOption" id="time30">
                <label class="form-check-label" for="time30">Last 30 Days</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="filterOption" id="time2024">
                <label class="form-check-label" for="time2024">2024</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="filterOption" id="time2023">
                <label class="form-check-label" for="time2023">2023</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="filterOption" id="time2022">
                <label class="form-check-label" for="time2022">2022</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="filterOption" id="time2021">
                <label class="form-check-label" for="time2021">2021</label>
              </div>
              <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="filterOption" id="timeOlder">
                <label class="form-check-label" for="timeOlder">Older</label>
              </div>
          
              <hr>
          
              <!-- Order Status -->
              <div class="fw-bold mb-2">Order Status</div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="filterOption" id="statusOnWay">
                <label class="form-check-label" for="statusOnWay">Refunded</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="filterOption" id="statusDelivered">
                <label class="form-check-label" for="statusDelivered">Approved</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="filterOption" id="statusCancelled">
                <label class="form-check-label" for="statusCancelled">Rejected</label>
              </div>
              <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="filterOption" id="statusReturned">
                <label class="form-check-label" for="statusReturned">In Progress</label>
              </div>

              <div class="apply-btn"><button class="btn">Click to Apply</button></div>
            </div>
          </div>
        </div>


        <div class="table-responsive">
          <table class="table align-middle">
            <thead>
              <tr>
                <th>Return ID</th>
                <th>Product</th>
                <th>Title</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Refund Method</th>
                <th>Date & Time</th>
                <th>Actions</th> 
              </tr>
            </thead>
            <tbody>
              @forelse($refundRequests as $refund)
              <tr>
                <td>{{ $refund->refund_id }}</td>
                <td><img src="{{ $refund->orderItem?->product?->thumbnail_url ?? '../assets/images/default.png' }}" class="product-img" alt=""></td>
                <td>{{ $refund->orderItem?->product?->name ?? 'N/A' }}</td>
                <td>${{ number_format(($refund->orderItem?->price ?? 0) * ($refund->orderItem?->quantity ?? 1), 2) }}</td>
                <td><span class="status-badge {{ strtolower($refund->status) }}">{{ ucfirst($refund->status) }}</span></td>
                <td>{{ $refund->order?->payment_method ?? 'N/A' }}</td>
                <td>{{ $refund->requested_at ? $refund->requested_at->format('M d, Y') : 'N/A' }}<br>{{ $refund->requested_at ? $refund->requested_at->format('h:i A') : '' }}</td>
                <td>
                    <a href="#" class="btn btn-sm btn-outline-primary me-2"> <i class="bi bi-pencil-square me-1"></i> Write Review</a>
                    <a href="#" class="btn btn-sm btn-outline-success"> <i class="bi bi-cart-plus me-1"></i> Buy Again</a>
                    <a href="#" class="btn btn-sm btn-outline-info"><i class="bi bi-headset me-1"></i> Get Support</a>
                  </td>
              </tr>
              @empty
              <tr>
                <td colspan="8" class="text-center">No refund requests found.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@include('includes.footer')

<script src="https://cdn.jsdelivr.net/npm

