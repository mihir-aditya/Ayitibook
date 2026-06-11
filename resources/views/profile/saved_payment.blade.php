<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Saved Payment Methods</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
   <style>
    body {
      background: #f8f9fa;
    }
    .payment-card {
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 15px;
      transition: 0.2s;
      position: relative;
    }
    .payment-card:hover {
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    }
    .payment-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }
    .payment-info {
      display: flex;
      align-items: center;
      gap: 15px;
    }
    .payment-info img {
      width: 45px;
      height: 45px;
      border-radius: 6px;
    }
    .payment-details h6 {
      margin: 0;
      font-weight: 600;
    }
    .payment-details p {
      margin: 0;
      color: #6c757d;
      font-size: 14px;
    }
    
    .add-card {
      background: #007bff;
      color: #fff;
      border: none;
      border-radius: 6px;
      padding: 10px 16px;
      font-size: 15px;
      cursor: pointer;
      margin-bottom: 20px;
    }
    .add-card:hover {
      background: #0056b3;
    }
    h2 {
      font-weight: 600;
      margin-bottom: 20px;
    }
    .default-badge {
      background: #28a745;
      color: #fff;
      font-size: 12px;
      padding: 3px 8px;
      border-radius: 5px;
    }

    /* 3-dot menu */
    .payment-card .dropdown {
      position: absolute;
      top: 20px;
      right: 20px;
    }
    .payment-card .dropdown button {
      border: none;
      background: transparent;
      font-size: 18px;
      color: #212529;
      padding: 0 4px;
    }
    .payment-card .dropdown button:hover {
      color: #000;
    }
    .dropdown-item i {
      margin-right: 8px;
    }

    /* Add Funds Button for Wallet */
    .add-funds-btn {
      margin-top: 60px; /* adjust spacing below 3-dot menu */
      background: #28a745;
      color: #fff;
      border: none;
      border-radius: 6px;
      padding: 8px 12px;
      cursor: pointer;
      font-size: 14px;
    }
    .add-funds-btn:hover {
      background: #218838;
    }

    /* Flex for expiry + CVV */
    .card-extra {
      display: flex;
      align-items: center;
      gap: 20px;
      margin-top: 10px;
    }
    .expiry-box p {
      margin: 0;
      font-size: 14px;
      color: #6c757d;
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

    <!-- Main Content -->
    <div class="col-lg-9">
      <h2>Saved Payment Methods</h2>
      <button class="add-card"><i class="fa fa-plus"></i> Add New Payment Method</button>

      <!-- AyitiBook Wallet (Default) -->
      <div class="payment-card border-success">
        <div class="payment-header">
          <div class="payment-info">
            <img src="https://cdn-icons-png.flaticon.com/512/681/681392.png" alt="Wallet">
            <div class="payment-details">
              <h6>AyitiBook Wallet <span class="default-badge">Default</span></h6>
              <p>Balance: $154.00</p>
            </div>
          </div>

          <!-- 3-dot menu -->
          <div class="dropdown">
            <button class="btn btn-sm btn-light" type="button" id="walletMenu" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-ellipsis-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="walletMenu">
              <li><button class="dropdown-item"><i class="fa fa-check-circle"></i> Remove Default</button></li>
              <li><button class="dropdown-item"><i class="fa fa-pen"></i> Edit</button></li>
              <li><button class="dropdown-item"><i class="fa fa-trash"></i> Remove</button></li>
            </ul>
          </div>
           <!-- Add Funds Button (outside 3-dot menu) -->
           <button class="add-funds-btn" onclick="window.location.href='wallet_&_transections.php'"><i class="fa fa-plus-circle"></i> Add Funds</button>

        </div>
      </div>

      <!-- Visa Card -->
      <div class="payment-card">
        <div class="payment-header">
          <div class="payment-info">
            <img src="https://cdn-icons-png.flaticon.com/512/196/196578.png" alt="Visa">
            <div class="payment-details">
              <h6>Visa **** 2456</h6>
              <p>John Doe</p>
              <p>Expiry: 08/28</p>
            </div>
          </div>

          <!-- 3-dot menu -->
          <div class="dropdown">
            <button class="btn btn-sm btn-light" type="button" id="cardMenu1" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-ellipsis-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardMenu1">
              <li><button class="dropdown-item"><i class="fa fa-check-circle"></i> Mark as Default</button></li>
              <li><button class="dropdown-item"><i class="fa fa-pen"></i> Edit</button></li>
              <li><button class="dropdown-item"><i class="fa fa-trash"></i> Remove</button></li>
            </ul>
          </div>

        </div>
         
        
      </div>

      <!-- MasterCard (CVV-less) -->
      <div class="payment-card">
        <div class="payment-header">
          <div class="payment-info">
            <img src="https://cdn-icons-png.flaticon.com/512/196/196566.png" alt="MasterCard">
            <div class="payment-details">
              <h6>MasterCard **** 9842</h6>
              <p>Mary Smith</p>
              <p>Expiry: 01/27 (CVV-less)</p>
            </div>
          </div>

          <!-- 3-dot menu -->
          <div class="dropdown">
            <button class="btn btn-sm btn-light" type="button" id="cardMenu2" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-ellipsis-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardMenu2">
              <li><button class="dropdown-item"><i class="fa fa-check-circle"></i> Mark as Default</button></li>
              <li><button class="dropdown-item"><i class="fa fa-pen"></i> Edit</button></li>
              <li><button class="dropdown-item"><i class="fa fa-trash"></i> Remove</button></li>
            </ul>
          </div>

        </div>
      </div>

      <!-- Repeat similar structure for other cards -->
      <!-- Net Banking -->
      <div class="payment-card">
        <div class="payment-header">
          <div class="payment-info">
            <img src="https://cdn-icons-png.flaticon.com/512/2721/2721296.png" alt="Bank">
            <div class="payment-details">
              <h6>Net Banking</h6>
              <p>User ID: nb_user_5678</p>
              <p>Name: John Doe</p>
            </div>
          </div>
          <div class="dropdown">
            <button class="btn btn-sm btn-light" type="button" id="cardMenu3" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-ellipsis-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardMenu3">
              <li><button class="dropdown-item"><i class="fa fa-check-circle"></i> Mark as Default</button></li>
              <li><button class="dropdown-item"><i class="fa fa-pen"></i> Edit</button></li>
              <li><button class="dropdown-item"><i class="fa fa-trash"></i> Remove</button></li>
            </ul>
          </div>
        </div>
      </div>

      <!-- MonCash -->
      <div class="payment-card">
        <div class="payment-header">
          <div class="payment-info">
            <img src="https://cdn-icons-png.flaticon.com/512/5968/5968555.png" alt="MonCash">
            <div class="payment-details">
              <h6>MonCash</h6>
              <p>User ID: MC_12345</p>
              <p>Name: Mary Jones</p>
            </div>
          </div>
          <div class="dropdown">
            <button class="btn btn-sm btn-light" type="button" id="cardMenu4" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-ellipsis-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardMenu4">
              <li><button class="dropdown-item"><i class="fa fa-check-circle"></i> Mark as Default</button></li>
              <li><button class="dropdown-item"><i class="fa fa-pen"></i> Edit</button></li>
              <li><button class="dropdown-item"><i class="fa fa-trash"></i> Remove</button></li>
            </ul>
          </div>
        </div>
      </div>

      <!-- NatCash -->
      <div class="payment-card">
        <div class="payment-header">
          <div class="payment-info">
            <img src="https://cdn-icons-png.flaticon.com/512/1048/1048946.png" alt="NatCash">
            <div class="payment-details">
              <h6>NatCash</h6>
              <p>User ID: NC_9845</p>
              <p>Name: Kevin Brown</p>
            </div>
          </div>
          <div class="dropdown">
            <button class="btn btn-sm btn-light" type="button" id="cardMenu5" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-ellipsis-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardMenu5">
              <li><button class="dropdown-item"><i class="fa fa-check-circle"></i> Mark as Default</button></li>
              <li><button class="dropdown-item"><i class="fa fa-pen"></i> Edit</button></li>
              <li><button class="dropdown-item"><i class="fa fa-trash"></i> Remove</button></li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Bank Account -->
      <div class="payment-card">
        <div class="payment-header">
          <div class="payment-info">
            <img src="https://cdn-icons-png.flaticon.com/512/1041/1041916.png" alt="Bank Account">
            <div class="payment-details">
              <h6>Bank Account (Default Payout)</h6>
              <p>Account: **** 7890 | IFSC: ABCD0001234</p>
              <p>Account Holder: John Doe</p>
            </div>
          </div>
          <div class="dropdown">
            <button class="btn btn-sm btn-light" type="button" id="cardMenu6" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-ellipsis-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardMenu6">
              <li><button class="dropdown-item"><i class="fa fa-pen"></i> Edit</button></li>
              <li><button class="dropdown-item"><i class="fa fa-trash"></i> Remove</button></li>
            </ul>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

@include('includes.footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
function toggleCVV(id, icon) {
  const input = document.getElementById(id);
  if (input.type === "password") {
    input.type = "text";
    icon.classList.replace("fa-eye", "fa-eye-slash");
  } else {
    input.type = "password";
    icon.classList.replace("fa-eye-slash", "fa-eye");
  }
}
</script>

</body>
</html>

