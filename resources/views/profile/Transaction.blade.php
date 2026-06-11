<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transaction Details</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
 
  <style>
    body { background:#f8f9fa; font-family:"Poppins",sans-serif; }

    .transaction-card {
      background:#fff;
      padding:25px;
      border-radius:8px;
      box-shadow:0 2px 8px rgba(0,0,0,0.08);
      margin:40px auto;
      max-width:1100px;
    }

    .table thead th { background:#f1f1f1; font-weight:600; }

    .status-badge {
      padding:6px 10px;
      border-radius:20px;
      font-size:13px;
      font-weight:500;
    }

    .success   { background:#d4edda; color:#155724; }
    .failed    { background:#f8d7da; color:#721c24; }
    .pending   { background:#fff3cd; color:#856404; }

    .credit-badge {
      background:#d1e7dd;
      color:#0f5132;
      padding:6px 10px;
      border-radius:20px;
      font-size:13px;
      font-weight:500;
    }

    .debit-badge {
      background:#f8d7da;
      color:#842029;
      padding:6px 10px;
      border-radius:20px;
      font-size:13px;
      font-weight:500;
    }

    .search-filter-row {
      display:flex;
      gap:12px;
      flex-wrap:wrap;
      align-items:center;
    }

    .search-filter-row .input-group { flex:1 1 360px; min-width:220px; }

    .dropdown-menu {
      background:rgba(255,255,255,0.95);
      border:1px solid #ddd;
      border-radius:8px;
      max-height:450px;
      overflow-y:auto;
      padding-bottom:70px;
    }

    .dropdown-menu .form-check-label {
      color:#212529;
      font-weight:500;
    }

    .dropdown-menu .form-check-input {
      border:2px solid #0d6efd;
      cursor:pointer;
    }

    .dropdown-menu .form-check-input:checked {
      background-color:#0d6efd;
      border-color:#0d6efd;
    }

    .dropdown-menu .form-check:hover {
      background:rgba(13,110,253,0.08);
      border-radius:6px;
      transition:0.2s ease;
    }

    .dropdown-menu .fw-bold {
      color:#0d6efd;
      font-size:14px;
      text-transform:uppercase;
    }

    .dropdown-menu .apply-btn {
      position:sticky;
      bottom:0;
      background:transparent;
      padding:0;
      margin:0;
      border-top:none;
    }

    .dropdown-menu .apply-btn button {
      display:block;
      width:100%;
      border-radius:0;
      padding:12px;
      font-weight:600;
      background:#0d6efd;
      color:#fff;
      text-align:center;
    }

    .dropdown-menu .apply-btn button:hover {
      background:#084298;
      color:#fff;
      transition:0.2s ease;
    }

    .table .btn {
      font-size:12px;
      padding:4px 10px;
      border-radius:20px;
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

    <!-- Transaction Details -->
    <div class="col-lg-9">
      <div class="transaction-card">
        <h3 class="mb-3">Transaction Details</h3>

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
              @forelse($transactions as $transaction)
                <tr>
                  <td>{{ $transaction->transaction_id }}</td>
                  <td>{{ ucfirst(str_replace('_', ' ', $transaction->transaction_type)) }}</td>
                  <td>
                    @if($transaction->transaction_type == 'wallet_reload')
                      <span class="credit-badge">Credit</span>
                    @else
                      <span class="debit-badge">Debit</span>
                    @endif
                  </td>
                  <td>{{ $transaction->payment_method }}</td>
                  <td>${{ number_format($transaction->amount, 2) }}</td>
                  <td><span class="status-badge {{ $transaction->transaction_status }}">{{ ucfirst($transaction->transaction_status) }}</span></td>
                  <td>{{ $transaction->transaction_date->format('M d, Y') }}<br>{{ $transaction->transaction_date->format('h:i A') }}</td>
                  <td><a href="#" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye me-1"></i> View</a></td>
                </tr>
              @empty
                <tr>
                  <td colspan="8" class="text-center">No transactions found.</td>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

