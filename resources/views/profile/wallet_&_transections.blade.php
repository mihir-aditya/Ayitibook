<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AyitiBook Wallet</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

  <style>
    body {
      background: #f4f6f9;
      font-family: 'Poppins', sans-serif;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
      flex-wrap: wrap;
      gap: 10px;
    }

    .header-left { flex: 1; }

    .divider {
      border-top: 1px dashed #ccc;
      margin: 15px 0 25px;
    }

    .add-btn {
      background: #007bff;
      color: white;
      border: none;
      padding: 8px 15px;
      border-radius: 5px;
      cursor: pointer;
      white-space: nowrap;
    }
    .add-btn:hover { background: #0056b3; }

    /* Wallet Card */
    .wallet-card {
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 20px;
      background: #fff;
      position: relative;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .wallet-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .wallet-header h4 {
      margin: 0;
      font-size: 18px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .wallet-balance-box {
      background: #5a0033;
      color: white;
      border-radius: 10px;
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 10px;
    }

    .wallet-info {
      line-height: 1.5;
    }

    .wallet-balance {
      font-size: 32px;
      font-weight: 700;
      margin: 5px 0;
    }

    .wallet-id {
      font-size: 13px;
      opacity: 0.9;
    }

    .wallet-icon {
      font-size: 42px;
      opacity: 0.9;
    }

    .wallet-actions {
      display: flex;
      gap: 10px;
      margin-top: 20px;
    }

    .wallet-btn {
      border: none;
      padding: 8px 14px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
      color: white;
      transition: 0.2s;
    }

    .wallet-btn.add { background: #007bff; }
    .wallet-btn.add:hover { background: #0056b3; }

    .wallet-btn.withdraw { background: #dc3545; }
    .wallet-btn.withdraw:hover { background: #b02a37; }

    .wallet-btn.gift {
      background: #ffc107;
      color: #000;
      border: 1px solid #ccc;
    }
    .wallet-btn.gift:hover { background: #d6d8db; }

    /* KYC Status */
    .kyc-box {
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      padding: 20px;
      margin-top: 20px;
    }

    .kyc-status {
      color: #28a745;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .kyc-status i { font-size: 16px; }

    .view-methods {
      color: #007bff;
      text-decoration: none;
      font-size: 14px;
    }
    .view-methods:hover { text-decoration: underline; }

    @media (min-width: 992px) {
      .wallet-container {
        display: flex;
        gap: 20px;
      }
      .wallet-card { flex: 2; }
      .kyc-box { flex: 1; height: fit-content; }
    }

    /* Transaction Section */
    .transaction-card {
      background: #fff;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      margin-top: 40px;
    }

    .table thead th { background: #f1f1f1; font-weight: 600; }

    .status-badge {
      padding: 6px 10px;
      border-radius: 20px;
      font-size: 13px;
      font-weight: 500;
    }

    .success { background: #d4edda; color: #155724; }
    .failed { background: #f8d7da; color: #721c24; }
    .pending { background: #fff3cd; color: #856404; }

    .credit-badge {
      background: #d1e7dd;
      color: #0f5132;
      padding: 6px 10px;
      border-radius: 20px;
      font-size: 13px;
      font-weight: 500;
    }

    .debit-badge {
      background: #f8d7da;
      color: #842029;
      padding: 6px 10px;
      border-radius: 20px;
      font-size: 13px;
      font-weight: 500;
    }

    .search-filter-row {
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
      align-items: center;
    }

    .search-filter-row .input-group { flex: 1 1 360px; min-width: 220px; }

    .dropdown-menu {
      background: rgba(255,255,255,0.95);
      border: 1px solid #ddd;
      border-radius: 8px;
      max-height: 450px;
      overflow-y: auto;
      padding-bottom: 70px;
    }

    .dropdown-menu .form-check-label { color: #212529; font-weight: 500; }
    .dropdown-menu .form-check-input { border: 2px solid #DB4444; cursor: pointer; }
    .dropdown-menu .form-check-input:checked { background-color: #DB4444; border-color: #DB4444; }

    .dropdown-menu .form-check:hover {
      background: rgba(13,110,253,0.08);
      border-radius: 6px;
      transition: 0.2s ease;
    }

    .dropdown-menu .fw-bold { color: #DB4444; font-size: 14px; text-transform: uppercase; }

    .dropdown-menu .apply-btn {
      position: sticky;
      bottom: 0;
      background: transparent;
      padding: 0;
      margin: 0;
      border-top: none;
    }

    .dropdown-menu .apply-btn button {
      display: block;
      width: 100%;
      border-radius: 0;
      padding: 12px;
      font-weight: 600;
      background: #DB4444;
      color: #fff;
      text-align: center;
    }

    .dropdown-menu .apply-btn button:hover {
      background: #084298;
      color: #fff;
      transition: 0.2s ease;
    }

    .table .btn {
      font-size: 12px;
      padding: 4px 10px;
      border-radius: 20px;
    }
  </style>

  <style>
    
    h2 {
      font-weight: 600;
      margin-bottom: 10px;
    }

    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .section-header a {
      font-size: 14px;
      color: #007bff;
      text-decoration: none;
      font-weight: 500;
    }

    /* Payment carousel */
    .payment-carousel {
      display: flex;
      overflow-x: auto;
      gap: 30px;
      padding-bottom: 10px;
      scroll-behavior: smooth;
    }

    .payment-carousel::-webkit-scrollbar {
      display: none;
    }

    /* Each card circle */
    .payment-card {
      flex: 0 0 auto;
      width: 150px;
      text-align: center;
      position: relative;
      transition: transform 0.3s ease;
    }

    .payment-card:hover {
      transform: translateY(-5px);
    }

    .payment-icon {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      background: linear-gradient(135deg, #e0ecff, #f3f1ff);
      display: flex;
      align-items: center;
      justify-content: center;
      margin: auto;
      box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1);
      transition: box-shadow 0.3s ease, transform 0.3s ease;
      position: relative;
    }

    .payment-card:hover .payment-icon {
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
      transform: scale(1.05);
    }

    .payment-icon img {
      width: 60px;
      height: 60px;
      object-fit: contain;
    }

    .payment-name {
      margin-top: 10px;
      font-size: 15px;
      font-weight: 500;
      color: #333;
    }

    .payment-sub {
      font-size: 13px;
      color: #6c757d;
    }

    /* Add new method button */
    .add-card-btn {
      display: inline-block;
      background: #007bff;
      color: white;
      padding: 10px 20px;
      border-radius: 6px;
      font-size: 15px;
      border: none;
      cursor: pointer;
      margin-bottom: 20px;
    }

    .add-card-btn:hover {
      background: #0056b3;
    }

    /* 3-dot menu */
    .menu-btn {
      position: absolute;
      top: 8px;
      right: 10px;
      background: transparent;
      border: none;
      color: #555;
      cursor: pointer;
      font-size: 18px;
      z-index: 2;
    }

    .menu-btn:hover {
      color: #000;
    }

    .menu-dropdown {
      position: absolute;
      top: 35px;
      right: 5px;
      background: white;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      display: none;
      flex-direction: column;
      overflow: hidden;
      z-index: 5;
    }

    .menu-dropdown button {
      background: none;
      border: none;
      text-align: left;
      padding: 8px 12px;
      font-size: 14px;
      cursor: pointer;
      color: #333;
      width: 130px;
    }

    .menu-dropdown button:hover {
      background: #f8f9fa;
    }

    /* Show dropdown when active */
    .payment-card.show-menu .menu-dropdown {
      display: flex;
    }

    /* Default pinned label */
    .default-pin {
      position: absolute;
      top: 6px;
      left: 50%;
      transform: translateX(-50%);
      background: #007bff;
      color: white;
      font-size: 11px;
      padding: 3px 10px;
      border-radius: 12px;
      font-weight: 500;
    }

/* ===== OVERRIDE BAD MOBILE RULE: KEEP FILTER BESIDE SEARCH ===== */
@media (max-width: 576px) {

  .search-filter-row {
    flex-direction: row !important;
    flex-wrap: nowrap !important;
    align-items: center !important;
    gap: 6px !important;
  }

  /* Search input must be allowed to shrink */
  .search-filter-row .input-group {
    flex: 1 1 auto !important;
    width: auto !important;
    min-width: 0 !important;
  }

  /* Filter must NOT be full width */
  .search-filter-row .dropdown {
    flex: 0 0 40px !important;
    width: 40px !important;
  }

  /* Filter button: icon only */
  .search-filter-row .dropdown > button {
    width: 40px !important;
    height: 40px !important;
    padding: 0 !important;
    display: flex !important;
    align-items: center;
    justify-content: center;
    font-size: 0 !important;
  }

  .search-filter-row .dropdown > button i {
    font-size: 14px !important;
  }

  /* Search input + button height */
  .search-filter-row .form-control,
  .search-filter-row .input-group .btn {
    height: 40px !important;
  }
}




/* ===== ABSOLUTE FINAL FIX: SEARCH + FILTER SAME LINE ===== */
@media (max-width: 768px) {

  .search-filter-row {
    display: flex !important;
    flex-wrap: nowrap !important;
    align-items: center !important;
    gap: 6px !important;
  }

  /* FORCE input to give space to filter */
  .search-filter-row .input-group {
    flex: 1 1 calc(100% - 46px) !important;
    min-width: 0 !important;
    width: auto !important;
    align-self: start;
  }

  /* Input */
  .search-filter-row .form-control {
    height: 40px !important;
    font-size: 14px;
  }

  /* Search button */
  .search-filter-row .input-group .btn {
    height: 40px !important;
    padding: 0 12px !important;
  }

  /* Filter container NEVER wraps */
  .search-filter-row .dropdown {
    flex: 0 0 40px !important;
  }

  /* Filter button = icon only */
  .search-filter-row .dropdown > button {
    width: 40px !important;
    height: 40px !important;
    padding: 0 !important;
    display: flex !important;
    align-items: center;
    justify-content: center;
    font-size: 0 !important; /* hide text */
  }

  .search-filter-row .dropdown > button i {
    font-size: 14px !important;
  }
}


  </style>




</head>
<body>

@include('includes.header')

<div class="container my-4">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-lg-3 mb-4">
      <?php include './includes/sidebar.php'; ?>
    </div>

    <!-- Main Content -->
    <div class="col-lg-9">
      <div class="header">
        <div class="header-left">
          <h2>My Wallet</h2>
        </div>
      </div>
      <div class="divider"></div>

      <div class="wallet-container">
        <!-- Wallet Card -->
        <div class="wallet-card">
          <div class="wallet-header">
            <h4><i class="fa-solid fa-wallet"></i> AyitiBook Wallet</h4>
          </div>

          <div class="wallet-balance-box">
            <div class="wallet-info">
              <div>Current Balance</div>
              <div class="wallet-balance">${{ number_format($walletBalance, 2) }} USD</div>
              <div class="wallet-id">Wallet ID: AYITI-BOOK-{{ $user->id }}</div>
            </div>
            <i class="fa-solid fa-wallet wallet-icon"></i>
          </div>

          <div class="wallet-actions">
            <button class="wallet-btn add"><i class="fa-solid fa-plus"></i> Add Funds</button>
            <button class="wallet-btn withdraw"><i class="fa-solid fa-minus"></i> Withdraw Funds</button>
            <button class="wallet-btn gift"><i class="fa-solid fa-gift"></i> Redeem Gift Card</button>
          </div>
        </div>

        <!-- KYC Box -->
        <div class="kyc-box">
          <h5>Account Status</h5>
          <div class="kyc-status">
            <i class="fa-solid {{ $user->kyc_verified == 'verified' ? 'fa-circle-check' : ($user->kyc_verified == 'pending' ? 'fa-clock' : 'fa-times-circle') }}"></i>
            KYC {{ ucfirst($user->kyc_verified) }}
          </div>
          <br>
          <a href="#" class="view-methods">View your status & documents</a>
        </div>
      </div>

      <!-- Saved Payment Methods Section -->
      <div class="col-lg-12">
      <div class="section-header">
        <h2>Saved Payment Methods</h2>
        <a href="./saved_payment.php">View all</a>
      </div>

      <!-- Payment Carousel -->
      <div class="payment-carousel" id="paymentCarousel">
        
        <!-- Pinned default card -->
        <div class="payment-card">
          <button class="menu-btn"><i class="fa fa-ellipsis-v"></i></button>
          <div class="menu-dropdown">
            <button>Edit</button>
            <button>Delete</button>
          </div>
          <div class="payment-icon">
            <span class="default-pin">Default</span>
            <img src="https://icons.veryicon.com/png/o/education-technology/blue-gray-solid-blend-icon/wallet-187.png" alt="Wallet">
          </div>
          <div class="payment-name">AyitiBook Wallet</div>
          <div class="payment-sub">Balance: ${{ number_format($walletBalance, 2) }}</div>
          
        </div>

        <!-- Other cards with 3-dot menu -->
        <div class="payment-card">
          <button class="menu-btn"><i class="fa fa-ellipsis-v"></i></button>
          <div class="menu-dropdown">
            <button>Set as Default</button>
            <button>Edit</button>
            <button>Delete</button>
          </div>
          <div class="payment-icon">
            <img src="https://cdn-icons-png.flaticon.com/512/196/196578.png" alt="Visa">
          </div>
          <div class="payment-name">Visa **** 2456</div>
          <div class="payment-sub">John Doe</div>
          <div class="payment-sub">Expiry: 08/28</div>
        </div>

        <div class="payment-card">
          <button class="menu-btn"><i class="fa fa-ellipsis-v"></i></button>
          <div class="menu-dropdown">
            <button>Set as Default</button>
            <button>Edit</button>
            <button>Delete</button>
          </div>
          <div class="payment-icon">
            <img src="https://pngimg.com/uploads/mastercard/mastercard_PNG21.png" alt="MasterCard">
          </div>
          <div class="payment-name">MasterCard **** 9842</div>
          <div class="payment-sub">Mary Smith</div>
          <div class="payment-sub">Expiry: 01/27</div>
        </div>

        <div class="payment-card">
          <button class="menu-btn"><i class="fa fa-ellipsis-v"></i></button>
          <div class="menu-dropdown">
            <button>Set as Default</button>
            <button>Edit</button>
            <button>Delete</button>
          </div>
          <div class="payment-icon">
            <img src="https://cdn-icons-png.flaticon.com/512/6556/6556741.png" alt="Bank">
          </div>
          <div class="payment-name">Net Banking</div>
          <div class="payment-sub"> John Doe</div>
          <div class="payment-sub">nb_user_5678</div>
        </div>

        <div class="payment-card">
          <button class="menu-btn"><i class="fa fa-ellipsis-v"></i></button>
          <div class="menu-dropdown">
            <button>Set as Default</button>
            <button>Edit</button>
            <button>Delete</button>
          </div>
          <div class="payment-icon">
            <img src="https://i.pinimg.com/736x/30/c1/b6/30c1b61e6ef7a8d4d7199cc948e39c92.jpg" alt="MonCash">
          </div>
          <div class="payment-name">MonCash</div>
          <div class="payment-sub"> Mary Jones</div>
          <div class="payment-sub">+1 234-5**-****</div>
        </div>

        <div class="payment-card">
          <button class="menu-btn"><i class="fa fa-ellipsis-v"></i></button>
          <div class="menu-dropdown">
            <button>Set as Default</button>
            <button>Edit</button>
            <button>Delete</button>
          </div>
          <div class="payment-icon">
            <img src="data:image/png;base64,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" alt="MonCash">
          </div>
          <div class="payment-name">NatCash</div>
          <div class="payment-sub">Mary Jones</div>
          <div class="payment-sub">+1 234-5**-****</div>
        </div>

        <div class="payment-card">
          <button class="menu-btn"><i class="fa fa-ellipsis-v"></i></button>
          <div class="menu-dropdown">
            <button>Set as Default</button>
            <button>Edit</button>
            <button>Delete</button>
          </div>
          <div class="payment-icon">
            <img src="https://cdn-icons-png.flaticon.com/512/3635/3635995.png" alt="Bank Account">
          </div>
          <div class="payment-name">Bank Account</div>
          <div class="payment-sub">**** 7890</div>
        </div>
      </div>
    </div>

    <!-- Transaction Details -->
<div class="transaction-card" id="transaction-section">

  <!-- HEADER -->
  <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h3 class="mb-0">Transaction Details</h3>

    <div>
      <label class="me-2 fw-semibold">Show</label>
      <select id="pageSize" class="form-select d-inline-block w-auto">
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="50">50</option>
      </select>
      <span class="ms-2">entries</span>
    </div>
  </div>  

        <!-- Search + Filter -->
        <div class="search-filter-row mb-3">
          <div class="input-group">
            <input id="searchInput" type="text" class="form-control" placeholder="Search transactions (ID, Type, Status, Credit/Debit)...">
            <button class="btn btn-primary" id="searchBtn" type="button" title="Search">
              <i class="fa fa-search"></i>
            </button>
          </div>

          <!-- Filter Dropdown -->
          <div class="dropdown">
            <button id="filterBtn" class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Filter by <i class="fa fa-filter"></i>
            </button>

            <div class="dropdown-menu dropdown-menu-end p-3" style="min-width:280px;">
              <div class="fw-bold mb-2">Transaction Type</div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="filterOption" id="typePayment">
                <label class="form-check-label" for="typePayment">Payment</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="filterOption" id="typeRefund">
                <label class="form-check-label" for="typeRefund">Refund</label>
              </div>
              <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="filterOption" id="typeWallet">
                <label class="form-check-label" for="typeWallet">Wallet Top-Up</label>
              </div>

              <hr>

              <div class="fw-bold mb-2">Transaction Mode</div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="filterOption" id="modeCredit">
                <label class="form-check-label" for="modeCredit">Credit</label>
              </div>
              <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="filterOption" id="modeDebit">
                <label class="form-check-label" for="modeDebit">Debit</label>
              </div>

              <hr>

              <div class="fw-bold mb-2">Status</div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="filterOption" id="statusSuccess">
                <label class="form-check-label" for="statusSuccess">Success</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="filterOption" id="statusPending">
                <label class="form-check-label" for="statusPending">Pending</label>
              </div>
              <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="filterOption" id="statusFailed">
                <label class="form-check-label" for="statusFailed">Failed</label>
              </div>

              <hr>

              <div class="fw-bold mb-2">Date Range</div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="filterOption" id="time30days">
                <label class="form-check-label" for="time30days">Last 30 Days</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="filterOption" id="time6months">
                <label class="form-check-label" for="time6months">Last 6 Months</label>
              </div>
              <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="filterOption" id="timeYear">
                <label class="form-check-label" for="timeYear">This Year</label>
              </div>

              <div class="apply-btn"><button class="btn">Apply Filter</button></div>
            </div>
          </div>
        </div>
   



        <!-- Table -->
        <div class="table-responsive">
          <table class="table align-middle">
            <thead>
              <tr>
                <th>Transaction ID</th>
                <th>Type</th>
                <th>Credit/Debit</th>
                <th>Payment Method</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date & Time</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($walletTransactions as $transaction)
                <tr>
                  <td>{{ $transaction->transaction_id }}</td>
                  <td>{{ $transaction->purpose ?? 'Wallet Transaction' }}</td>
                  <td><span class="{{ $transaction->transaction_type == 'credit' ? 'credit-badge' : 'debit-badge' }}">{{ ucfirst($transaction->transaction_type) }}</span></td>
                  <td>N/A</td>
                  <td>${{ number_format($transaction->amount, 2) }}</td>
                  <td><span class="status-badge success">Success</span></td>
                  <td>{{ $transaction->created_at->format('M d, Y') }}<br>{{ $transaction->created_at->format('h:i A') }}</td>
                  <td><a href="#" class="btn btn-sm btn-outline-primary" onclick="openReceipt('{{ $transaction->transaction_type }}', '{{ $transaction->transaction_id }}', '{{ $transaction->amount }}', '{{ $transaction->purpose }}', '{{ $transaction->balance_after }}', '{{ $transaction->created_at->format('M d, Y h:i A') }}')"><i class="fa fa-eye me-1"></i> View</a></td>
                </tr>
              @empty
                <tr>
                  <td colspan="8" class="text-center">No wallet transactions found.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
          <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
            <div id="tableInfo" class="text-muted small">
              Showing 0 to 0 of 0 entries
            </div>
          
            <nav>
              <ul class="pagination mb-0" id="paginationBottom"></ul>
            </nav>
          </div>

        </div>
      </div> <!-- End Transaction Card -->
    </div> <!-- End Main Content -->
  </div> <!-- End Row -->
</div> <!-- End Container -->

<!-- Receipt Modal -->
<div class="modal fade" id="receiptModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Transaction Receipt</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body" id="receiptContainer"></div>

      <div class="modal-footer">
        <button class="btn btn-outline-secondary" onclick="printReceipt()">
          <i class="fa fa-print"></i> Download / Print
        </button>
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


@include('includes.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<!-- <script>
function printTransactions() {
  // Hide unwanted elements
  const elementsToHide = document.querySelectorAll(
    '.search-bar, .filter, .filter-row, .search-filter-row, .btn-print, button[onclick*="printTransactions"], th:last-child, td:last-child'
  );
  elementsToHide.forEach(el => el.style.display = 'none');

  // Get section and page styles
  const transactionSection = document.getElementById('transaction-section');
  const styles = Array.from(document.styleSheets)
    .map(styleSheet => {
      try {
        return Array.from(styleSheet.cssRules)
          .map(rule => rule.cssText)
          .join('\n');
      } catch (e) {
        return '';
      }
    })
    .join('\n');

  // Open print window
  const printWindow = window.open('', 'AyitiBook Transactions', 'width=900,height=700');
  printWindow.document.write(`
    <html>
      <head>
        <title>AyitiBook.com</title>
        <style>
          ${styles}

          body {
            font-family: 'Poppins', sans-serif;
            margin: 40px;
            color: #000;
          }
          h2 {
            text-align: center;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
          }
          .print-date {
            text-align: center;
            font-size: 13px;
            color: #555;
            margin-bottom: 15px;
          }
          .logo {
            display: block;
            margin: 0 auto 25px auto;
            width: 140px;
            height: auto;
          }
          table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
          }
          th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            font-size: 14px;
            word-wrap: break-word;
          }
          th {
            background: #f9f9f9;
            font-weight: 600;
          }
          #transaction-section {
            width: 100%;
            overflow: hidden;
          }
          footer {
            text-align: center;
            font-size: 13px;
            color: #555;
            margin-top: 30px;
          }
          @page {
            margin: 15mm;
          }
          @media print {
            body {
              zoom: 0.95; /* Adjust scaling slightly to fit page */
            }
            #transaction-section {
              overflow: visible !important;
            }
          }
        </style>
      </head>
      <body>
        <h2>AyitiBook Wallet</h2>
        <div class="print-date">${new Date().toLocaleString()}</div>
        <img src="../assets/images/logo/logo-main.jpg" alt="AyitiBook Logo" class="logo" />

        ${transactionSection.outerHTML}
        <footer>Downloaded through AyitiBook.com</footer>
      </body>
    </html>
  `);

  // Print it
  printWindow.document.close();
  printWindow.focus();
  printWindow.print();
  printWindow.close();

  // Restore hidden elements
  elementsToHide.forEach(el => el.style.display = '');
}
</script> -->



<script>
  const carousel = document.getElementById('paymentCarousel');
  let scrollAmount = 0;
  let autoScrollInterval;

  function autoScroll() {
    if (carousel.scrollWidth - carousel.clientWidth <= scrollAmount) {
      scrollAmount = 0;
    } else {
      scrollAmount += 1;
    }
    carousel.scrollTo({ left: scrollAmount, behavior: 'smooth' });
  }

  // Start auto scroll
  function startAutoScroll() {
    autoScrollInterval = setInterval(autoScroll, 30);
  }

  // Stop auto scroll
  function stopAutoScroll() {
    clearInterval(autoScrollInterval);
  }

  // Pause on hover
  carousel.addEventListener('mouseenter', stopAutoScroll);
  carousel.addEventListener('mouseleave', startAutoScroll);

  // Begin auto scroll on page load
  startAutoScroll();

  // Toggle dropdowns
  document.querySelectorAll('.menu-btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      const card = btn.closest('.payment-card');
      document.querySelectorAll('.payment-card').forEach(c => {
        if (c !== card) c.classList.remove('show-menu');
      });
      card.classList.toggle('show-menu');
    });
  });

  // Close menu if clicking outside
  document.addEventListener('click', () => {
    document.querySelectorAll('.payment-card').forEach(c => c.classList.remove('show-menu'));
  });
</script>

<script>
function generateReceipt(type, data) {

  if (type === 'credit') {
    return `
    <div id="printArea" style="font-family:Poppins;background:#fff;padding:25px">
      <div style="text-align:center">
        <img src="../assets/images/logo/logo-main.jpg" style="height:60px"><br>
        <h5 style="color:#7aaad6;margin-top:10px">${data.purpose.toUpperCase()} RECEIPT</h5>
      </div>
      <hr>

      <h6>WALLET & TRANSACTION INFO</h6>
      Wallet ID: ${data.wallet}<br>
      Transaction ID: ${data.id}<br>
      Date & Time: ${data.date}

      <hr>
      <h6>TRANSACTION DETAILS</h6>
      Transaction Type: ${data.purpose}<br>
      Customer Name: ${data.name}

      <hr>
      <h6>Transaction Origin</h6>
      Provider: ${data.provider}<br>
      Account: ${data.account}<br>
      Provider Transaction ID: ${data.provider_txn}

      <hr>
      <h6>TRANSACTION SUMMARY</h6>
      Total Amount Credited: ${data.amount}<br>
      Processing Fee: 0 USD<br>
      <b>Total Credited to Wallet: ${data.amount}</b>

      <hr>
      <h5>New Wallet Balance</h5>
      <h4>${data.balance}</h4>

      <span class="badge bg-success">Completed</span>

      <hr>
      <small style="display:block;text-align:center">
        AYITIBOOK – BUILT ON TRUST, DELIVERED WITH CARE<br>
        www.ayitibook.com/wallet
      </small>
    </div>`;
  }

  // DEBIT RECEIPT
  return `
  <div id="printArea" style="font-family:Poppins;background:#fff;padding:25px">
    <div style="text-align:center">
      <img src="../assets/images/logo/logo-main.jpg" style="height:60px"><br>
      <h5 style="color:#7aaad6;margin-top:10px">${data.purpose.toUpperCase()} RECEIPT</h5>
    </div>
    <hr>

    <h6>WALLET & TRANSACTION INFO</h6>
    Wallet ID: ${data.wallet}<br>
    Transaction ID: ${data.id}<br>
    Date & Time: ${data.date}

    <hr>
    <h6>TRANSACTION DETAILS</h6>
    Transaction Type: ${data.purpose}<br>
    Customer Name: ${data.name}

    <hr>
    <h6>Funds Destination</h6>
    Provider: ${data.provider}<br>
    Account: ${data.account}<br>
    Provider Transaction ID: ${data.provider_txn}

    <hr>
    <h6>TRANSACTION SUMMARY</h6>
    Total Amount Debited: ${data.amount}<br>
    Processing Fee: 0 USD<br>
    <b>Total Debited from Wallet: ${data.amount}</b>

    <hr>
    <h5>New Wallet Balance</h5>
    <h4>${data.balance}</h4>

    <span class="badge bg-success">Completed</span>

    <hr>
    <small style="display:block;text-align:center">
      AYITIBOOK – BUILT ON TRUST, DELIVERED WITH CARE<br>
      www.ayitibook.com/wallet
    </small>
  </div>`;
}
</script>
<script>
function openReceipt(type, txnId, amount, purpose, balance, date) {

  const receiptData = {
    wallet: 'Ayi-{{ $user->id }}',
    id: txnId,
    date: date,
    name: '{{ $user->name }}',
    provider: 'AyitiBook Wallet',
    account: '{{ $user->email }}',
    provider_txn: txnId,
    amount: '$' + parseFloat(amount).toFixed(2),
    balance: '$' + parseFloat(balance).toFixed(2),
    type: type,
    purpose: purpose
  };

  document.getElementById('receiptContainer').innerHTML =
    generateReceipt(type, receiptData);

  new bootstrap.Modal(document.getElementById('receiptModal')).show();
}

function printReceipt() {
  const printContent = document.getElementById('printArea').innerHTML;
  const w = window.open('', '', 'width=800,height=900');
  w.document.write(`<html><head><title>AyitiBook Receipt</title></head><body>${printContent}</body></html>`);
  w.document.close();
  w.print();
}
</script>
 
<script>
document.addEventListener('DOMContentLoaded', () => {

  const tableBody = document.querySelector('.table tbody');
  const rows = Array.from(tableBody.querySelectorAll('tr'));

  const pageSizeSelect = document.getElementById('pageSize');
  const paginationTop = null;
  const paginationBottom = document.getElementById('paginationBottom');
  const tableInfo = document.getElementById('tableInfo');
  const searchInput = document.getElementById('searchInput');
  const searchBtn = document.getElementById('searchBtn');

  let currentPage = 1;
  let pageSize = parseInt(pageSizeSelect.value);

  /* ---------------- HELPERS ---------------- */

  function getFilteredRows() {
    const term = searchInput.value.toLowerCase();
    return rows.filter(row =>
      row.innerText.toLowerCase().includes(term)
    );
  }

  function renderTable() {
    const filtered = getFilteredRows();
    const total = filtered.length;

    const start = (currentPage - 1) * pageSize;
    const end = Math.min(start + pageSize, total);

    rows.forEach(row => row.style.display = 'none');
    filtered.slice(start, end).forEach(row => row.style.display = '');

    if (total === 0) {
      tableInfo.textContent = 'Showing 0 to 0 of 0 entries';
    } else {
      tableInfo.textContent = `Showing ${start + 1} to ${end} of ${total} entries`;
    }
  }

  function createPageItem(page, label = page, active = false, disabled = false) {
    const li = document.createElement('li');
    li.className = `page-item ${active ? 'active' : ''} ${disabled ? 'disabled' : ''}`;

    const a = document.createElement('a');
    a.className = 'page-link';
    a.href = '#';
    a.textContent = label;

    a.onclick = e => {
      e.preventDefault();
      if (!disabled && page !== currentPage) {
        currentPage = page;
        update();
      }
    };

    li.appendChild(a);
    return li;
  }

  function renderPagination() {
  const filtered = getFilteredRows();
  const pageCount = Math.ceil(filtered.length / pageSize);

  
  paginationBottom.innerHTML = '';

  if (pageCount === 0) return;

  [paginationBottom].forEach(pagination => {

    /* Previous */
    pagination.appendChild(
      createPageItem(
        currentPage - 1,
        'Previous',
        false,
        currentPage === 1
      )
    );

    /* Always show page 1 */
    pagination.appendChild(
      createPageItem(1, '1', currentPage === 1)
    );

    /* If more than 1 page */
    if (pageCount > 1) {

      /* Show pages around current */
      let start = Math.max(2, currentPage - 1);
      let end   = Math.min(pageCount - 1, currentPage + 1);

      if (start > 2) {
        pagination.appendChild(createPageItem(null, '…', false, true));
      }

      for (let i = start; i <= end; i++) {
        pagination.appendChild(
          createPageItem(i, i, i === currentPage)
        );
      }

      if (end < pageCount - 1) {
        pagination.appendChild(createPageItem(null, '…', false, true));
      }

      /* Last page */
      if (pageCount > 1) {
        pagination.appendChild(
          createPageItem(pageCount, pageCount, currentPage === pageCount)
       );
    
      }
    }


    /* Next */
    pagination.appendChild(
      createPageItem(
        currentPage + 1,
        'Next',
        false,
        currentPage === pageCount
      )
    );
  });
}

  function update() {
    renderTable();
    renderPagination();
  }

  /* ---------------- EVENTS ---------------- */

  pageSizeSelect.addEventListener('change', () => {
    pageSize = parseInt(pageSizeSelect.value);
    currentPage = 1;
    update();
  });

  searchBtn.addEventListener('click', () => {
    currentPage = 1;
    update();
  });

  /* ---------------- INIT ---------------- */
  update();
});
</script>





</body>
</html>

