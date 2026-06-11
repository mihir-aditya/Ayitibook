<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>User Dashboard | Ayitibook</title>

  <!-- Bootstrap & Boxicons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

  <style>
    body {
      background: #f8f9fa;
      font-family: 'Poppins', sans-serif;
      overflow-x: hidden;
    }

    /* Container Animation */
    .dashboard-container {
      background: #fff;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      margin-bottom: 30px;
      opacity: 0;
      transform: translateY(30px);
      animation: fadeInUp 0.7s ease forwards;
    }

    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Page Title */
    .page-title {
      font-weight: 700;
      font-size: 24px;
      margin-bottom: 25px;
      display: flex;
      align-items: center;
      gap: 10px;
      animation: fadeInLeft 0.8s ease both;
    }

    @keyframes fadeInLeft {
      from { opacity: 0; transform: translateX(-30px); }
      to { opacity: 1; transform: translateX(0); }
    }

    /* Profile Summary */
    .profile-summary {
      display: flex;
      align-items: center;
      gap: 20px;
      border-bottom: 1px dashed #ddd;
      padding-bottom: 25px;
      margin-bottom: 25px;
      animation: fadeIn 1s ease both;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    .profile-summary img {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      border: 3px solid #0d6efd;
      object-fit: cover;
      transition: transform 0.4s ease;
    }

    .profile-summary img:hover {
      transform: scale(1.05);
    }

    .profile-summary .details h5 {
      margin: 0;
      font-weight: 600;
    }

    .profile-summary .details .text-muted {
      font-size: 14px;
    }

    /* Wallet + Referral */
    .wallet-card, .referral-card {
      background: #fff;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      transition: all 0.3s ease;
    }

    .wallet-card:hover, .referral-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    }

    .referral-card .progress {
      height: 8px;
      border-radius: 5px;
    }

    /* Stats Row */
    .stats-row {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 15px;
      margin-top: 15px;
      animation: fadeIn 1s ease both;
    }

    .stats-card {
      background: #fff;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.05);
      display: flex;
      align-items: center;
      gap: 15px;
      opacity: 0;
      transform: scale(0.9);
      animation: popIn 0.5s ease forwards;
    }

    @keyframes popIn {
      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    .stats-card:hover {
      transform: translateY(-5px) scale(1.02);
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .stats-icon {
      background: #e8f0ff;
      color: #0d6efd;
      padding: 12px;
      border-radius: 10px;
      font-size: 28px;
      flex-shrink: 0;
      transition: all 0.3s ease;
    }

    .stats-card:hover .stats-icon {
      transform: rotate(-10deg) scale(1.1);
    }

    .stats-info h4 {
      margin: 0;
      font-size: 20px;
      font-weight: 600;
    }

    .stats-info span {
      font-size: 14px;
      color: #888;
    }

    /* Sections */
    .section {
      margin-top: 30px;
    }

    .section h5 {
      font-weight: 600;
      margin-bottom: 15px;
      animation: fadeInLeft 0.8s ease both;
    }

    /* Table Styling */
    .table {
      background: #fff;
      border-radius: 10px;
      overflow: hidden;
    }

    .table th {
      background: #f0f4ff;
    }

    .table td, .table th {
      vertical-align: middle;
    }

    /* Notifications */
    .notification-item {
      display: flex;
      align-items: start;
      gap: 12px;
      background: #fff;
      padding: 15px;
      border-radius: 10px;
      margin-bottom: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      opacity: 0;
      animation: fadeInUp 0.8s ease forwards;
    }

    .notification-item i {
      background: #e8f0ff;
      color: #0d6efd;
      font-size: 20px;
      padding: 10px;
      border-radius: 8px;
      transition: transform 0.3s ease;
    }

    .notification-item:hover i {
      transform: rotate(10deg) scale(1.1);
    }

    .text-muted {
      font-size: 13px;
    }
  </style>
</head>

<body>

  @include('includes.header')

  <div class="container my-4">
    <div class="row">
      <div class="col-lg-3 mb-4">
        <?php include './includes/sidebar.php'; ?>
      </div>

      <div class="col-lg-9">
        <div class="dashboard-container">

          <!-- Page Title -->
          <div class="page-title"><i class="bx bx-user-circle"></i> My Dashboard</div>

          <!-- Profile Summary -->
          <div class="profile-summary">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Profile">
            <div class="details flex-grow-1">
              <h5>John Doe</h5>
              <div class="text-muted mb-2">Member since: Jan 2024</div>
              <span class="badge bg-primary">Level: Silver</span>
            </div>
            <!-- <div class="text-end">
              <h6 class="mb-1">Wallet Balance</h6>
              <h4 class="text-success mb-0">₹1,250.00</h4>
            </div> -->
          </div>

          <!-- Wallet & Referral -->
          <div class="row section">
            <div class="col-md-6">
              <div class="wallet-card">
                <h5><i class="bx bx-wallet me-2"></i>Wallet Overview</h5>
                <p>Current Balance: <strong class="text-success">₹1,250</strong></p>
                <p>Available AyitiCash: <strong>3,450🪙</strong></p>
                <a href="#" class="btn btn-outline-primary btn-sm">View Wallet</a>
              </div>
            </div>
            <div class="col-md-6">
              <div class="referral-card">
                <h5><i class="bx bx-user-plus me-2"></i>Refer & Earn</h5>
                <p>Invite friends to join Ayitibook and earn rewards.</p>
                <div class="progress mb-2">
                  <div class="progress-bar bg-success" style="width: 45%;"></div>
                </div>
                <small>6 / 15 friends joined</small><br>
                <a href="#" class="btn btn-success btn-sm mt-2">Invite Friends</a>
              </div>
            </div>
          </div>

          <!-- Stats Overview -->
          <div class="section">
            <h5><i class="bx bx-bar-chart-alt-2 me-2"></i>Stats Overview</h5>
            <div class="stats-row">
              <div class="stats-card">
                <div class="stats-icon"><i class="bx bx-cart-alt"></i></div>
                <div class="stats-info"><h4>12</h4><span>Total Orders</span></div>
              </div>

              <div class="stats-card">
                <div class="stats-icon" style="background:#fdecea;color:#d32f2f;"><i class="bx bx-rotate-left"></i></div>
                <div class="stats-info"><h4>2</h4><span>Returned Orders</span></div>
              </div>

              <div class="stats-card">
                <div class="stats-icon" style="background:#e9f7ef;color:#198754;"><i class="bx bx-check-circle"></i></div>
                <div class="stats-info"><h4>9</h4><span>Delivered Orders</span></div>
              </div>

              <div class="stats-card">
                <div class="stats-icon" style="background:#fff3cd;color:#856404;"><i class="bx bx-coin-stack"></i></div>
                <div class="stats-info"><h4>1,250</h4><span>AyitiCash Earned</span></div>
              </div>

              <div class="stats-card">
                <div class="stats-icon" style="background:#f8d7da;color:#842029;"><i class="bx bx-heart"></i></div>
                <div class="stats-info"><h4>18</h4><span>Wishlist Items</span></div>
              </div>

              <div class="stats-card">
                <div class="stats-icon" style="background:#f3e5f5;color:#6a1b9a;"><i class="bx bx-store"></i></div>
                <div class="stats-info"><h4>4</h4><span>Subscribed Sellers</span></div>
              </div>

              <div class="stats-card">
                <div class="stats-icon" style="background:#e8f0ff;color:#0d6efd;"><i class="bx bx-star"></i></div>
                <div class="stats-info"><h4>7</h4><span>Total Reviews</span></div>
              </div>

              <div class="stats-card">
                <div class="stats-icon" style="background:#e8f0ff;color:#0d6efd;"><i class="bx bx-support"></i></div>
                <div class="stats-info"><h4>1</h4><span>Active Support Tickets</span></div>
              </div>
            </div>
          </div>

          <!-- Recent Orders -->
          <div class="section">
            <h5><i class="bx bx-package me-2"></i>Recent Orders</h5>
            <div class="table-responsive">
              <table class="table table-striped align-middle">
                <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>#AYT12345</td>
                    <td>Nov 4, 2025</td>
                    <td><span class="badge bg-success">Delivered</span></td>
                    <td>₹1,299</td>
                    <td><a href="#" class="btn btn-sm btn-outline-primary">View</a></td>
                  </tr>
                  <tr>
                    <td>#AYT12312</td>
                    <td>Oct 27, 2025</td>
                    <td><span class="badge bg-warning text-dark">Shipped</span></td>
                    <td>₹899</td>
                    <td><a href="#" class="btn btn-sm btn-outline-primary">Track</a></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Notifications -->
          <div class="section">
            <h5><i class="bx bx-bell me-2"></i>Notifications</h5>
            <div class="notification-item">
              <i class="bx bx-gift"></i>
              <div>
                <strong>₹100 AyitiCash</strong> credited for your review!
                <div class="text-muted">2 hours ago</div>
              </div>
            </div>
            <div class="notification-item">
              <i class="bx bx-cart"></i>
              <div>
                Your order <strong>#AYT12312</strong> has been shipped.
                <div class="text-muted">1 day ago</div>
              </div>
            </div>
          </div>

          <!-- Support -->
          <div class="section">
            <h5><i class="bx bx-headphone me-2"></i>Support Tickets</h5>
            <p>Need help? <a href="#" class="text-primary">Submit a ticket</a> or <a href="#" class="text-primary">chat with support</a>.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('includes.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

