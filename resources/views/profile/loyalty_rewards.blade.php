<?php
// loyalty_rewards.php
$ayiti_balance = 1250;
$expiring_amount = 150;
$expiring_date = "Jan 31, 2026";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Loyalty & Rewards Hub</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    body { background: #f2f6fb; font-family: "Poppins", sans-serif; }
    .page-card { background: #fff; border-radius: 14px; padding: 22px; box-shadow: 0 6px 24px rgba(13,27,51,0.06); }

    /* Wallet + Streak */
    .wallet-streak-row { display:flex; gap:25px; flex-wrap:wrap; align-items:stretch; }

    /* Wallet */
    .wallet-card {
      background: linear-gradient(180deg,#334CFF 0%,#6B4BFF 100%);
      color:#fff; border-radius:12px; padding:16px 18px;
      box-shadow:0 12px 30px rgba(79,70,229,0.18);
      width:100%; max-width:420px; flex:1;
    }
    .wallet-title{font-size:16px;opacity:.95;}
    .wallet-balance{font-size:48px;font-weight:800;margin-top:-18px;}
    .wallet-sub{margin-top:6px;opacity:.9;}
    .wallet-meta{background:rgba(255,255,255,0.12);padding:10px;border-radius:10px;margin-top:14px;font-size:14px;}
    .wallet-card .btn-light{border-radius:8px;border:none;font-size:13px;background:#fff;color:#000;box-shadow:0 3px 6px rgba(0,0,0,0.15);transition:.2s;}
    .wallet-card .btn-light:hover{background:#f3f3f3;transform:translateY(-1px);}

    /* Streak */
    .streak-card{background:#fff;border-radius:12px;box-shadow:0 8px 22px rgba(13,27,51,0.06);padding:24px;flex:1;max-width:460px;max-height: 260px;display:flex;flex-direction:column;}
    .streak-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;}
    .fire{color:#ff3b3b;font-size:20px;}
    .streak-wrapper{position:relative;width:100%;margin:15px 0;}
    .streak-line{position:absolute;top:24px;left:0;width:100%;height:4px;background:#e9ecef;border-radius:4px;z-index:0;}
    .streak-day{position:relative;z-index:1;display:flex;flex-direction:column;align-items:center;flex:1;text-align:center;}
    .circle{width:42px;height:42px;border-radius:50%;background:#e9ecef;color:#6c757d;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px;box-shadow:0 0 0 3px #fff;transition:.3s;}
    .streak-day.collected .circle{background:linear-gradient(135deg,#13c08c,#00d6b6);color:#fff;}
    .streak-day.today .circle{background:linear-gradient(135deg,#ffcc00,#ff9900);color:#000;font-weight:800;}
    .streak-day small{font-size:11px;margin-top:6px;color:#777;}

    /* Earn + Play */
    .earn-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:12px;margin-top:20px;}
    .earn-box{padding:14px;border-radius:12px;color:#fff;font-weight:700;text-align:left;min-height:85px;display:flex;flex-direction:column;justify-content:center;}
    .e1{background:linear-gradient(90deg,#7b60ff,#4b8bff);}
    .e2{background:linear-gradient(90deg,#13c08c,#00d6b6);}
    .e3{background:linear-gradient(90deg,#ff7a7a,#ffb86b);}
    .e4{background:linear-gradient(90deg,#ffb86b,#ff7a7a);}
    .e5{background:linear-gradient(90deg,#4b8bff,#7b60ff);}
    .earn-small{font-weight:600;font-size:13px;opacity:.95;margin-top:8px;}

   /* Play & Win */
    .playwin-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:16px;}
    .playwin-card{background:#fff;border-radius:12px;box-shadow:0 8px 22px rgba(13,27,51,0.06);padding:20px;text-align:center;transition:.3s;cursor:pointer;}
    .playwin-card:hover{transform:translateY(-4px);box-shadow:0 12px 30px rgba(13,27,51,0.12);}
    .playwin-icon{width:48px;height:48px;margin-bottom:12px;}
    .playwin-title{font-weight:700;font-size:16px;margin-bottom:6px;}
    .playwin-text{font-size:13px;color:#666;}
    /* Custom backgrounds (optional for variety) */
    .playwin-card.quiz { background: linear-gradient(180deg, #e8f0ff, #ffffff); }
    .playwin-card.spin { background: linear-gradient(180deg, #fff8e8, #ffffff); }
    .playwin-card.gift { background: linear-gradient(180deg, #e6fff5, #ffffff); }

    /* Mini cards */
    .mini-row{margin-top:12px;display:flex;gap:12px;flex-wrap:wrap;}
    .mini-card{flex:1;background:#fff;border-radius:10px;padding:12px;box-shadow:0 6px 18px rgba(13,27,51,0.04);border:1px solid #eef3fb;}

    /* Leaderboard */
    .leaderboard{background:#fff;border-radius:12px;padding:16px;box-shadow:0 6px 18px rgba(13,27,51,0.04);margin-bottom:50px;margin-top:-80px;max-height:270px;overflow: hidden;position: relative;}
    .leaderboard-title {text-align: left;font-weight: 600;font-size: 16px;border-bottom: 1px solid #f1f1f1;padding-bottom: 8px;margin-bottom: 8px;background: #fff;z-index: 5;position: relative;}
    .leader-scroll {max-height: 220px; /* space below the title */overflow-y: auto;padding-right: 6px;}
    .leader-row {display: flex;justify-content: space-between;align-items: center;padding: 10px 0;border-bottom: 1px dashed #eef2fb;}
    .leader-row:last-child {border-bottom: none;}
    /* Accordion */
    .accordion-button:not(.collapsed){background:linear-gradient(135deg,#4b6ef7,#6d3ef5);color:#fff;box-shadow:none;}

    @media(max-width:991px){.wallet-streak-row{flex-direction:column;}.wallet-balance{font-size:36px;}}

    /* Modal rules */
    .modal-content {
  border-radius: 14px;
}

.modal-header {
  border-bottom: none;
}

.modal-body p {
  margin-bottom: 10px;
}

.modal-footer {
  border-top: none;
}
.divider {
      border-top: 1px dashed #ccc;
      margin: 15px 0 25px;
    }

/* --- Accordion Arrow Fix (Single Arrow + 90° Rotation) --- */

.accordion-button::after {
  background-image: none !important;
}

  </style>
</head>
<body>

@include('includes.header')

<div class="container my-4">
  <div class="row">
    <div class="col-lg-3">
      <?php include './includes/sidebar.php'; ?>
    </div>

    <div class="col-lg-9">
      <div class="page-card">
        <div class="d-flex align-items-start justify-content-between mb-3">
          <div>
            <h3 class="mb-0">Loyalty & Rewards Hub</h3>
            <div class="text-muted small">Earn AyitiCash — Track balance — Play & Win</div>
          </div>
          <!-- <div class="text-muted small">Welcome to Ayitibook</div> -->
           <!-- Rules & Regulations Button -->
          <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#rulesModal">
            <i class="fa fa-info-circle me-1"></i> Rules 
          </button>
          
          <!-- Rules Modal -->
          <div class="modal fade" id="rulesModal" tabindex="-1" aria-labelledby="rulesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white">
                  <h5 class="modal-title" id="rulesModalLabel">Loyalty & Rewards – Rules </h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="line-height:1.6;">
                  <p><strong>1.</strong> Customers will earn <strong>0.1 AyitiCash</strong> on every <strong>1 HTG</strong> spent on eligible purchases.</p>
                  <p><strong>2.</strong> Loyalty Coins will be credited to the <strong>AyitiCash wallet</strong> and available for use <strong>3 months after</strong> the order is delivered.</p>
                  <p><strong>3.</strong> <strong>1 AyitiCash = 0.5 HTG</strong> can be redeemed as a discount on eligible purchases.</p>
                  <p><strong>4.</strong> AyitiCash cannot be used toward <strong>shipping fees, taxes, or gift card purchases.</strong> They are valid only on physical merchandise.</p>
                  <p><strong>5.</strong> AyitiCash redemption cannot be combined with other <strong>promotional codes</strong> or <strong>flash sales.</strong></p>
                  <p><strong>6.</strong> AyitiCash has <strong>no cash value</strong> and cannot be exchanged for money.</p>
                  <p><strong>7.</strong> AyitiCash may expire or be adjusted in case of order cancellation, refund, or return.</p>
                  <p><strong>8.</strong> Suman Enterprise reserves the right to modify or discontinue the Loyalty Program at any time.</p>
                  <hr>
                  <p class="small text-muted mb-0">
                    For detailed terms, visit our <a href="#" class="text-decoration-none">Ayitibook Policy</a> page.
                  </p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          
        </div>

        <!-- Wallet + Streak -->
        <div class="wallet-streak-row mb-4">
          <?php
          $ayiti_to_htg = $ayiti_balance * 0.5;
          $lifetime_earn = 3700;
          $total_spent = 2450;
          $current_day = 4;
          $coins = [5,10,15,30,50,75,100];
          ?>
          <div class="wallet-card">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <div class="wallet-title">AyitiCash Wallet</div>
                <div class="small text-white-50">1 AyitiCash = 0.5 HTG (~$0.0038)</div>
              </div>
              <button class="btn btn-light btn-sm fw-semibold shadow-sm px-3 mt-2"><i class="fa fa-clock me-2"></i>History</button>
            </div>
            <div class="d-flex align-items-end gap-3 mt-4">
              <div>
                <div class="wallet-balance"><?= $ayiti_balance ?>🪙</div>
                <div class="wallet-sub">AyitiCash</div>
              </div>
              <div class="text-white-50 fw-semibold mb-3">≈ HTG <?= number_format($ayiti_to_htg, 2) ?></div>
            </div>
            
            <div class="wallet-meta mt-3"><i class="fa fa-exclamation-circle me-2"></i><strong><?= $expiring_amount ?> AyitiCash</strong> expires on <strong><?= $expiring_date ?></strong></div>
            <div class="mt-3 d-flex justify-content-between align-items-center bg-white bg-opacity-10 p-2 rounded-3">
              <div><small class="text-white-50 d-block">Lifetime Earned</small><strong><?= $lifetime_earn ?>🪙</strong></div>
              <div class="text-end"><small class="text-white-50 d-block">Total Spent</small><strong><?= $total_spent ?>🪙</strong></div>
            </div>
          </div>

          <div class="streak-card"><h5 class="leaderboard-title mb-2" style="font-weight: bold; font-size: 17px;">Daily streaks</h5>
            
            <div class="streak-header">
              <div class="d-flex align-items-center gap-2"><i class="fa-solid fa-fire fire"></i><strong>You're on Day <?= $current_day ?>!</strong></div>
              <small class="text-muted">+<?= $coins[$current_day-1] ?> AyitiCash 🪙</small>
            </div>
            <div class="streak-wrapper">
              <div class="d-flex justify-content-between align-items-center position-relative">
                <?php for ($i=1;$i<=7;$i++): 
                  $class = ($i<$current_day)?'collected':(($i==$current_day)?'today':''); ?>
                  <div class="streak-day <?= $class ?>">
                    <div class="circle"><?= $coins[$i-1] ?></div>
                    <small>Day <?= $i ?></small>
                  </div>
                <?php endfor; ?>
                <div class="streak-line"></div>
              </div>
            </div>
            <div class="text-muted small text-center">Stay active for <strong>7 days</strong> to unlock bigger rewards!</div>
          </div>
        </div>

        <!-- Earn + Leaderboard -->
        <div class="row g-4">
          <div class="col-lg-8">
            <h5 class="mb-3">Play & Win – Get Lucky!</h5>
            <div class="playwin-grid">
              <div class="playwin-card quiz">
                <img src="https://cdn-icons-png.flaticon.com/512/2353/2353678.png" alt="Quiz" class="playwin-icon">
                <div class="playwin-title">Ayitibook Quiz</div>
                <div class="playwin-text">Test knowledge, get discount</div>
              </div>
              <div class="playwin-card spin">
                <img src="https://cdn-icons-png.flaticon.com/512/2108/2108628.png" alt="Spin" class="playwin-icon">
                <div class="playwin-title">Spin to Win</div>
                <div class="playwin-text">Play daily, win exciting rewards</div>
              </div>
              <div class="playwin-card gift">
                <img src="https://cdn-icons-png.flaticon.com/512/16506/16506946.png" alt="Gift" class="playwin-icon">
                <div class="playwin-title">Free Product & Shipping</div>
                <div class="playwin-text">Invite friends — win free products!</div>
              </div>
            </div>

<!-- earn rewards -->
            <h5 class="mb-2 mt-4">Earn Rewards</h5>
            <div class="earn-grid">
              <div class="earn-box e1"><div><i class="fa fa-gift me-2"></i>Sign-up</div><div class="earn-small">+50 AyitiCash — One-time</div></div>
              <div class="earn-box e2"><div><i class="fa fa-id-card me-2"></i>Verify Profile</div><div class="earn-small">+70 AyitiCash — One-time</div></div>
              <div class="earn-box e3"><div><i class="fa fa-share-alt me-2"></i>Share Product</div><div class="earn-small">+5 AyitiCash — Once/day</div></div>
            </div>

            <div class="mini-row mt-3">
              <div class="mini-card"><strong>Shopping</strong><p class="mb-0 text-muted small">Earn 0.05 HTG per HTG spent using Ayitibook wallet.</p></div>
              <div class="mini-card"><strong>Platform Activities</strong><p class="mb-0 text-muted small">Daily visits, Spin-to-Win, Quiz — win AyitiCash.</p></div>
            </div>
          </div>

<!-- leaderboard -->
          <div class="col-lg-4">
            <div class="leaderboard">
              <h5 class="leaderboard-title mb-2">Monthly Leaderboard</h5>
              <div class="leader-scroll">
                <?php
                $leaders = [
                  ["name"=>"Alex Chen","img"=>"https://i.pravatar.cc/50?img=12","reward"=>"500 AyitiCash","rank"=>"#1","color"=>"bg-primary"],
                  ["name"=>"Maria Rodriguez","img"=>"https://i.pravatar.cc/50?img=47","reward"=>"300 AyitiCash","rank"=>"#2","color"=>"bg-warning text-dark"],
                  ["name"=>"John Doe","img"=>"https://i.pravatar.cc/50?img=11","reward"=>"250 AyitiCash","rank"=>"#3","color"=>"bg-success"],
                  ["name"=>"Emma Davis","img"=>"https://i.pravatar.cc/50?img=28","reward"=>"200 AyitiCash","rank"=>"#4","color"=>"bg-info text-dark"],
                  ["name"=>"Chris Evans","img"=>"https://i.pravatar.cc/50?img=19","reward"=>"180 AyitiCash","rank"=>"#5","color"=>"bg-secondary"],
                  ["name"=>"Sofia Taylor","img"=>"https://i.pravatar.cc/50?img=33","reward"=>"150 AyitiCash","rank"=>"#6","color"=>"bg-danger"],
                  ["name"=>"Michael Scott","img"=>"https://i.pravatar.cc/50?img=40","reward"=>"140 AyitiCash","rank"=>"#7","color"=>"bg-dark"],
                  ["name"=>"Olivia Lee","img"=>"https://i.pravatar.cc/50?img=9","reward"=>"120 AyitiCash","rank"=>"#8","color"=>"bg-warning text-dark"],
                  ["name"=>"Noah Brown","img"=>"https://i.pravatar.cc/50?img=49","reward"=>"100 AyitiCash","rank"=>"#9","color"=>"bg-info text-dark"],
                  ["name"=>"Ava Green","img"=>"https://i.pravatar.cc/50?img=6","reward"=>"80 AyitiCash","rank"=>"#10","color"=>"bg-primary"]
                ];
                foreach($leaders as $l): ?>
                <div class="leader-row">
                  <div class="d-flex align-items-center gap-2">
                    <img src="<?= $l['img'] ?>" alt="<?= $l['name'] ?>" class="rounded-circle" width="38" height="38">
                    <div><strong><?= $l['name'] ?></strong><div class="text-muted small"><?= $l['reward'] ?></div></div>
                  </div>
                  <span class="badge <?= $l['color'] ?>"><?= $l['rank'] ?></span>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="divider"></div>
            <div class="accordion" id="qaAccordion">
              <h5 class="mb-2">Q & A</h5>
              <?php
              $faqs = [
                "What is AyitiCash"=>"AyitiCash is the reward currency of Ayitibook.",
                "How to Use AyitiCash"=>"Use AyitiCash to get discounts during checkout.",
                "How to earn it"=>"Earn AyitiCash from activities and redeem during checkout.",
                "What's the value"=>"1 AyitiCash = 0.5 HTG (~$0.0038 USD).",
                "Expiry date"=>"Each AyitiCash expires 3 months after earning."
              ];
              $i=0; foreach($faqs as $q=>$a): $i++; ?>
              <div class="accordion-item mb-2">
                <h2 class="accordion-header" id="heading<?= $i ?>">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $i ?>">
                    <?= $q ?>
                  </button>
                </h2>
                <div id="collapse<?= $i ?>" class="accordion-collapse collapse" data-bs-parent="#qaAccordion">
                  <div class="accordion-body"><?= $a ?></div>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

@include('includes.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

