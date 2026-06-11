<?php
// BNPL Dashboard — Dynamic data from database

$user = $user ?? auth()->user();
$bnplProfile = $bnplProfile ?? null;
$bnplLoans = $bnplLoans ?? collect();
$bnplPayments = $bnplPayments ?? collect();
$bnplMilestones = $bnplMilestones ?? collect();
$latestCreditScore = $latestCreditScore ?? null;
$bnplTiers = $bnplTiers ?? collect();

// New service-calculated variables
$currentCreditScore = $currentCreditScore ?? 300;
$creditTier = $creditTier ?? null;
$availableLimit = $availableLimit ?? 0;
$eligibility = $eligibility ?? ['eligible' => false, 'reason' => 'Not calculated'];
$upcomingPayments = $upcomingPayments ?? collect();
$paymentHistory = $paymentHistory ?? collect();

// Calculate credit score percentage for gauge (0-100 scale)
$credit_score_100 = $currentCreditScore > 0 ? min(100, (($currentCreditScore - 300) / 550) * 100) : 0;

// Credit score rating
function rating_label($score){
    if ($score >= 91) return ['Excellent','bg-success text-white'];
    if ($score >= 80) return ['Good','bg-info text-white'];
    if ($score >= 68) return ['Fair','bg-warning text-dark'];
    return ['Poor','bg-secondary text-white'];
}
list($rating_text, $rating_badge_class) = rating_label($credit_score_100);

// Calculate summary data from database
// FIX: correct column name is 'loan_amount', not 'amount'
$current_outstanding   = $bnplLoans->where('status', 'active')->sum('loan_amount');
$total_loans_completed = $bnplLoans->where('status', 'completed')->count();
$total_amount_borrowed = $bnplLoans->sum('loan_amount');

// FIX: correct column name is 'limit_amount', not 'max_limit'
$loan_limit = $creditTier ? $creditTier->limit_amount : 0;

// FIX: $current_bnpl_used — total active loan balance used in the limit meter gauge
$current_bnpl_used = $current_outstanding;

// FIX: $bnpl_used_percent — % of limit consumed, used by the gauge animation + badge
$bnpl_used_percent = $loan_limit > 0 ? min(100, ($current_bnpl_used / $loan_limit) * 100) : 0;

// FIX: $credit_score_850 — raw score on 300-850 scale shown below the credit gauge
$credit_score_850 = $currentCreditScore;

// FIX: $total_limit_used — outstanding balance shown in the "Outstanding" summary card
$total_limit_used = $current_outstanding;

// FIX: $available_to_borrow_calc — shown in the "Available" summary card
$available_to_borrow_calc = $availableLimit;

// FIX: Credit Insights variables
// $on_time_rate — ratio of on-time paid payments to total (0–1 float)
$totalPaymentsCount  = $bnplPayments->count();
$onTimePaymentsCount = $bnplPayments->filter(function ($p) {
    return $p->status === 'paid'
        && $p->paid_at !== null
        && $p->paid_at->lte($p->due_date);
})->count();
$on_time_rate = $totalPaymentsCount > 0 ? $onTimePaymentsCount / $totalPaymentsCount : 1;

// $credit_utilization — fraction of limit in use (0–1); blade shows (1 - $credit_utilization)*100 as "% used"
$credit_utilization = $loan_limit > 0 ? min(1, $current_outstanding / $loan_limit) : 0;

// $months_bnpl — whole months the user has had a BNPL profile
$months_bnpl = $bnplProfile
    ? (int) \Carbon\Carbon::parse($bnplProfile->created_at)->diffInMonths(now())
    : 0;

// Summary data
$summary = [
    'total_outstanding'   => $current_outstanding,
    // FIX: correct column name is 'amount_due', not 'amount'
    'next_payment'        => $upcomingPayments->first()?->amount_due ?? 0,
    'available_to_borrow' => $availableLimit,
];

// Active loans for display
$loans = $bnplLoans->map(function($loan) {
    return [
        'id' => $loan->id,
        'product' => $loan->product_title,
        'title' => $loan->product_title,
        'remaining' => $loan->remaining_amount,
        'installments' => $loan->paid_installments . '/' . $loan->total_installments,
        'status' => ucfirst($loan->status),
        'next_due' => $loan->next_payment_due?->format('M d, Y') ?? 'N/A',
        'image' => '../assets/images/wishlist/product-media1.png', // Default placeholder image
    ];
})->toArray();

// Upcoming payments
$upcoming = $upcomingPayments->map(function($payment) {
    return [
        'date' => $payment->due_date->format('Y-m-d'),
        'loan' => $payment->loan->product_title ?? 'Loan #' . $payment->loan_id,
        // FIX: correct column name is 'amount_due', not 'amount'
        'amount' => $payment->amount_due,
        'status' => $payment->due_date->isPast() ? 'Due Soon' : 'Upcoming',
        'loan_id' => $payment->loan_id,
    ];
})->toArray();

// Milestones from database or defaults
if ($bnplMilestones->isNotEmpty()) {
    $milestones = $bnplMilestones->map(function($milestone) {
        return [
            'label' => $milestone->label,
            'icon' => match($milestone->milestone_type) {
                'tenure' => 'fa-clock',
                'spending' => 'fa-money-bill-wave',
                'purchases' => 'fa-bag-shopping',
                'wallet_uses' => 'fa-wallet',
                'bnpl_orders' => 'fa-credit-card',
                default => 'fa-star'
            },
            'current' => $milestone->current_value . ($milestone->milestone_type === 'spending' ? ' USD' :
                        ($milestone->milestone_type === 'tenure' ? ' mo' :
                        ($milestone->milestone_type === 'purchases' || $milestone->milestone_type === 'bnpl_orders' ? ' orders' : ''))),
            'required' => $milestone->required_value . ($milestone->milestone_type === 'spending' ? '+ USD' :
                         ($milestone->milestone_type === 'tenure' ? '+ mo' :
                         ($milestone->milestone_type === 'purchases' || $milestone->milestone_type === 'bnpl_orders' ? '+ orders' : '+'))),
            'current_raw' => $milestone->current_value,
            'target_raw' => $milestone->required_value,
            'progress' => $milestone->progress_percentage,
            // FIX: 'completed' key was missing — used by $m['completed'] in the blade
            'completed' => (bool) $milestone->is_completed,
        ];
    })->toArray();
} else {
    // Default milestones if none in database
    $milestones = [
        [
            'label' => 'Tenure',
            'icon' => 'fa-clock',
            'current' => '0 mo',
            'required' => '3+ mo',
            'current_raw' => 0,
            'target_raw' => 3,
            'progress' => 0,
            'completed' => false,
        ],
        [
            'label' => 'Spending',
            'icon' => 'fa-money-bill-wave',
            'current' => '$0',
            'required' => '$190+',
            'current_raw' => 0,
            'target_raw' => 190,
            'progress' => 0,
            'completed' => false,
        ],
        [
            'label' => 'Purchases',
            'icon' => 'fa-bag-shopping',
            'current' => '0 orders',
            'required' => '3+ orders',
            'current_raw' => 0,
            'target_raw' => 3,
            'progress' => 0,
            'completed' => false,
        ],
        [
            'label' => 'BNPL Orders',
            'icon' => 'fa-credit-card',
            'current' => '0 done',
            'required' => '2+ done',
            'current_raw' => 0,
            'target_raw' => 2,
            'progress' => 0,
            'completed' => false,
        ],
    ];
}

// Calculate milestone progress
$milestone_progress = !empty($milestones) ?
    round(array_sum(array_column($milestones, 'progress')) / count($milestones)) : 0;

// FIX: $completed_milestones and $total_milestones — shown in "Completed X/Y" label
$completed_milestones = !empty($milestones)
    ? count(array_filter($milestones, fn($m) => $m['completed']))
    : 0;
$total_milestones = count($milestones);

// FIX: $next_tier_label — shown next to the milestone count as a hint toward next tier
if ($creditTier) {
    $nextTier = $bnplTiers->first(fn($t) => $t->min_score > ($creditTier->max_score ?? 0));
    $next_tier_label = $nextTier
        ? 'Next: ' . ucfirst($nextTier->display_name)
        : 'Max Tier Reached';
} else {
    $next_tier_label = 'No tier assigned';
}

// Next tier information
$next_tier_score = 68; // Default
if ($credit_score_100 >= 68 && $credit_score_100 <= 79) {
    $next_tier_score = 80;
} elseif ($credit_score_100 >= 80 && $credit_score_100 <= 90) {
    $next_tier_score = 91;
} elseif ($credit_score_100 >= 91) {
    $next_tier_score = 91; // Already at max
}

$next_tier_score_text = $credit_score_100 >= 96 ?
    'You are already at the highest BNPL tier (Pro tier). Keep your score 96+ to maintain it.' :
    "Reach {$next_tier_score}+ score to unlock higher BNPL limits.";
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>BNPL Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<style>
:root{
  --muted:#748399;
  --card-shadow:0 18px 45px rgba(13,27,51,0.06);
  --accent1:#4da3ff;
  --accent2:#1d4ed8;
}
body{background:#f6f8fb;font-family:"Poppins",system-ui,Arial;color:#10212b;}
.page-card{background:#fff;padding:22px;border-radius:14px;box-shadow:var(--card-shadow);}
.hover-card{transition:transform .22s ease,box-shadow .22s ease,border-color .22s ease;border:1px solid transparent;}
.hover-card:hover{transform:translateY(-6px);box-shadow:0 26px 50px rgba(13,27,51,0.09);border-color:rgba(77,163,255,0.15);}
.card-top-section{display:flex;gap:18px;align-items:stretch;margin-bottom:32px;}
.card-top{flex:1;background:#fff;padding:16px;border-radius:12px;box-shadow:var(--card-shadow);text-align:center;}
.gauge-wrap{max-width:260px;margin:auto;}
.gauge-tick-text{fill:#9ca3af;font-size:10px;text-anchor:middle;}
.gauge-tick-line{stroke:#e5e7eb;stroke-width:1;}
.summary-box{background:#fff;border-radius:14px;padding:20px 16px;text-align:center;border:1px solid #eef1f5;box-shadow:0 8px 20px rgba(0,0,0,0.03);}
.summary-title{color:var(--muted);font-size:13px;text-transform:uppercase;letter-spacing:.3px;}
.summary-value{font-weight:800;font-size:22px;color:#10212b;margin-top:6px;}
.loan-card{background:#fff;border-radius:12px;padding:16px;box-shadow:0 10px 28px rgba(13,27,51,0.04);min-width:280px;scroll-snap-align:start;}
.muted{color:var(--muted);}
.loan-scroll{display:flex;gap:16px;overflow-x:auto;padding-bottom:10px;scroll-snap-type:x mandatory;}
.loan-scroll::-webkit-scrollbar{height:6px;}
.loan-scroll::-webkit-scrollbar-track{background:transparent;}
.loan-scroll::-webkit-scrollbar-thumb{background:#c9d4e2;border-radius:4px;}
.loan-card .btn-sm{font-size:12px;padding:4px 9px;border-radius:7px;}
.loan-product-img{width:35px;height:35px;border-radius:10px;object-fit:contain;}
.loan-product-title{font-weight:600;font-size:14px;}
.loan-subtitle{font-size:12px;color:var(--muted);}
.insight-row{display:flex;justify-content:space-between;font-size:13px;margin-bottom:6px;}
.installment-ring{width:60px;height:60px;flex-shrink:0;}
.installment-text{font-size:11px;fill:#111827;text-anchor:middle;dominant-baseline:middle;font-weight:600;}
.installment-caption{font-size:9px;fill:#6b7280;text-anchor:middle;}
/* milestones */
.milestone-card{background:#fff;border-radius:14px;padding:18px 16px;border:1px solid #eef1f5;box-shadow:0 10px 26px rgba(15,23,42,0.04);}
.milestone-row{display:flex;flex-wrap:wrap;gap:14px;}
.milestone-item{flex:1;min-width:160px;border-radius:12px;padding:10px 12px;border:1px dashed #e2e8f0;background:#f9fafb;display:flex;align-items:flex-start;gap:10px;}
.milestone-icon{width:32px;height:32px;border-radius:999px;display:flex;align-items:center;justify-content:center;background:rgba(37,99,235,0.08);color:#1d4ed8;flex-shrink:0;}
.milestone-label{font-size:13px;font-weight:600;}
.milestone-meta{font-size:11px;color:var(--muted);}
.mini-progress{height:5px;border-radius:999px;overflow:hidden;background:#e5e7eb;margin-top:6px;}
.mini-progress-bar{height:100%;border-radius:999px;background:linear-gradient(90deg,#4ade80,#22c55e);}
.milestone-footer-text{font-size:11px;color:var(--muted);margin-top:4px;}
/* drawer */
.drawer{position:fixed;top:0;right:-520px;width:520px;height:100%;background:#fff;z-index:1200;box-shadow:-20px 0 60px rgba(13,27,51,0.15);transition:right .28s ease;}
.drawer.open{right:0;}
.drawer-header{padding:16px;border-bottom:1px solid #f1f5f9;}
/* calendar */
.mini-calendar{width:100%;border-radius:8px;padding:8px;background:#fff;border:1px solid #eef3fb;}
.mini-calendar .day{width:32px;height:32px;display:inline-flex;align-items:center;justify-content:center;margin:3px;border-radius:6px;color:#25323a;font-size:13px;position:relative;}
.mini-calendar .day.dot::after{content:'';width:6px;height:6px;background:#f97316;box-shadow:0 0 6px rgba(248,115,22,.9);border-radius:50%;position:absolute;bottom:4px;right:4px;}
.payments-card{background:#fff;border-radius:14px;padding:18px 16px;border:1px solid #eef1f5;box-shadow:0 10px 26px rgba(15,23,42,0.04);}
.modal-header{border-bottom:none;}
.btn-pay{background:linear-gradient(90deg,var(--accent1),var(--accent2));color:#fff;border:none;}
@media(max-width:991px){
  .card-top-section{flex-direction:column;}
  .drawer{width:100%;}
}
/* Rule icons */
.rule-title {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 6px;
}

.rule-icon {
  width: 34px;
  height: 34px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 15px;
  color: #fff;
}

/* Fade-up animation */
.fadeRule {
  opacity: 0;
  transform: translateY(10px);
  animation: fadeUp 0.6s ease forwards;
}

.delay1 { animation-delay: .1s; }
.delay2 { animation-delay: .2s; }
.delay3 { animation-delay: .3s; }

@keyframes fadeUp {
  from { opacity: 0; transform: translateY(14px); }
  to { opacity: 1; transform: translateY(0); }
}
/* -----------------------------------------
   RULES MODAL – SECTION ANIMATION
   Smooth fade + slide (tab-like reveal)
----------------------------------------- */

.rules-animated-body {
    position: relative;
}

.rule-section {
    opacity: 0;
    transform: translateY(12px);
    animation: fadeSlide .6s ease forwards;
}

/* staggered delays */
.rule-section.delay1 { animation-delay: .15s; }
.rule-section.delay2 { animation-delay: .30s; }
.rule-section.delay3 { animation-delay: .45s; }

/* title alignment */
.rule-title {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 6px;
}

.rule-icon {
    width: 34px;
    height: 34px;
    border-radius: 10px;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
}

/* ANIMATION KEYFRAME */
@keyframes fadeSlide {
    0%   { opacity: 0; transform: translateY(14px); }
    100% { opacity: 1; transform: translateY(0); }
}
.rule-tab-section { display:none; animation: fadeSlide .4s ease; }
.activeTab { display:block; }

.rules-tab.active {
  background:#C53D51 !important;
  color:#fff !important;
}
.rules-tab:hover {
    background: #d5a9a9 !important;
    color: #fff !important;
    border-color: #d5a9a9 !important;
}

/* -----------------------------------------
   BNPL RULES MODAL STYLES
----------------------------------------- */

.rules-nav {
  border-bottom: 1px solid #f1f5f9;
  margin: 0 20px 12px;
  overflow-x: auto;
  white-space: nowrap;
  padding-bottom: 4px;
}

.rules-nav .nav-item {
  margin-right: 8px;
}

.rules-pill {
  border-radius: 999px;
  padding: 6px 16px;
  font-size: 14px;
  font-weight: 500;
  background: #f9fafb;
  color: #111827;
  border: 1px solid #e5e7eb;
}

.rules-pill i {
  margin-right: 6px;
  font-size: 13px;
}

.rules-pill.active {
  background: #C53D51;
  border-color: #C53D51;
  color: #fff;
  box-shadow: 0 10px 25px rgba(197, 61, 81, 0.35);
}

.rules-pill:not(.active):hover {
  background: #f3f4f6;
  border-color: #d1d5db;
}

/* Sections */

.rules-section {
  display: none;
  animation: fadeSlide .35s ease;
}

.rules-section.activeRuleSection {
  display: block;
}

.rules-section-card {
  background: #fff;
  border-radius: 14px;
  padding: 18px 18px;
  box-shadow: 0 8px 24px rgba(15,23,42,0.06);
  border: 1px solid #eef1f5;
}

.rules-section-card p,
.rules-section-card li {
  font-size: 14px;
  line-height: 1.55;
}

.rules-section-card ul {
  margin-bottom: 0;
}

/* FAQ cards */

.faq-item {
  border-radius: 12px;
  padding: 12px 14px;
  border: 1px solid #eef1f5;
  background: #f9fafb;
  margin-bottom: 10px;
}

.faq-q {
  display: flex;
  align-items: center;
  gap: 8px;
  font-weight: 600;
  margin-bottom: 4px;
}

.faq-q i {
  color: #C53D51;
}

.faq-a {
  font-size: 13px;
  color: var(--muted);
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
        <!-- Header + Rules -->
        <div class="d-flex justify-content-between align-items-start mb-3">
          <div>
            <h3 class="mb-0">BNPL Dashboard</h3>
            <div class="muted small">Limit meter, credit score, insights &amp; tools</div>
            <?php if ($bnplProfile): ?>
              <div class="mt-2">
                <span class="badge <?= $eligibility['eligible'] ? 'bg-success' : 'bg-warning' ?> me-2">
                  <i class="fa fa-<?= $eligibility['eligible'] ? 'check' : 'exclamation-triangle' ?>"></i>
                  <?= $eligibility['eligible'] ? 'Eligible' : 'Not Eligible' ?>
                </span>
                <?php if (!$eligibility['eligible']): ?>
                  <small class="text-muted ms-2"><?= $eligibility['reason'] ?? 'Check eligibility requirements' ?></small>
                <?php endif; ?>
                <?php if ($bnplProfile->is_enabled): ?>
                  <span class="badge bg-info">
                    <i class="fa fa-play"></i> Active
                  </span>
                <?php else: ?>
                  <span class="badge bg-secondary">
                    <i class="fa fa-pause"></i> Paused
                  </span>
                <?php endif; ?>
              </div>
            <?php else: ?>
              <div class="mt-2">
                <span class="badge bg-secondary">
                  <i class="fa fa-question"></i> Status Unknown
                </span>
              </div>
            <?php endif; ?>
          </div>
          <button class="btn btn-link text-danger p-0 d-flex align-items-center gap-1 small"
                  data-bs-toggle="modal" data-bs-target="#rulesModal">
              <i class="fa fa-info-circle"></i><span>Rules</span>
          </button>
        </div>

        <!-- TOP: Limit Meter / Score / Insights -->
        <div class="card-top-section">
          <!-- BNPL Limit Meter -->
          <div class="card-top hover-card">
            <h6 class="mb-2">BNPL Limit Meter <small class="text-muted">Status</small></h6>
            <div class="gauge-wrap mb-2">
              <svg viewBox="0 0 300 170" style="width:100%;">
                <defs>
                  <linearGradient id="g2" x1="0%" x2="100%">
                    <stop offset="0%" stop-color="#4da3ff"/><stop offset="50%" stop-color="#2563eb"/><stop offset="100%" stop-color="#1d4ed8"/>
                  </linearGradient>
                  <filter id="glowL"><feGaussianBlur stdDeviation="6" result="b"/><feMerge><feMergeNode in="b"/><feMergeNode in="SourceGraphic"/></feMerge></filter>
                </defs>
                <path d="M40 140 A110 110 0 0 1 260 140" stroke="#eef3f8" stroke-width="22" fill="none"/>
                <path id="limitArc" d="M40 140 A110 110 0 0 1 260 140"
                      stroke="url(#g2)" stroke-width="22" fill="none"
                      stroke-linecap="round" stroke-dasharray="0 1000"
                      filter="url(#glowL)"/>
                <circle cx="150" cy="140" r="6" fill="#14232b"/>
                <g id="limitNeedle" transform="rotate(-90 150 140)">
                  <line x1="150" y1="140" x2="150" y2="40" stroke="#14232b" stroke-width="4"/>
                </g>
                <g>
                  <line class="gauge-tick-line" x1="40" y1="145" x2="40" y2="150"/>
                  <line class="gauge-tick-line" x1="95" y1="145" x2="95" y2="150"/>
                  <line class="gauge-tick-line" x1="150" y1="145" x2="150" y2="150"/>
                  <line class="gauge-tick-line" x1="205" y1="145" x2="205" y2="150"/>
                  <line class="gauge-tick-line" x1="260" y1="145" x2="260" y2="150"/>
                  <text class="gauge-tick-text" x="40" y="164">0</text>
                  <text class="gauge-tick-text" x="95" y="164">25</text>
                  <text class="gauge-tick-text" x="150" y="164">50</text>
                  <text class="gauge-tick-text" x="205" y="164">75</text>
                  <text class="gauge-tick-text" x="260" y="164">100</text>
                </g>
              </svg>
            </div>
            <div style="font-weight:800;"><?= number_format($current_bnpl_used,2) ?> USD</div>
            <div class="muted small">of max <?= $loan_limit ?> USD</div>
            <div class="mt-2 badge bg-light text-dark">Used <?= round($bnpl_used_percent,1) ?>%</div>
          </div>

          <!-- Credit Score -->
          <div class="card-top hover-card">
            <h6 class="mb-2">Credit Score <small class="text-muted">Updated <?= $latestCreditScore ? $latestCreditScore->calculated_at->diffForHumans() : 'Never' ?></small></h6>
            <div class="gauge-wrap mb-2">
              <svg viewBox="0 0 300 170" style="width:100%;">
                <defs>
                  <linearGradient id="g1" x1="0%" x2="100%">
                    <stop offset="0%" stop-color="#ef4444"/><stop offset="25%" stop-color="#f59e0b"/>
                    <stop offset="50%" stop-color="#eab308"/><stop offset="75%" stop-color="#22c55e"/>
                    <stop offset="100%" stop-color="#10b981"/>
                  </linearGradient>
                  <filter id="glowC"><feGaussianBlur stdDeviation="6" result="b"/><feMerge><feMergeNode in="b"/><feMergeNode in="SourceGraphic"/></feMerge></filter>
                </defs>
                <path d="M40 140 A110 110 0 0 1 260 140" stroke="#eef3f8" stroke-width="22" fill="none"/>
                <path id="creditArc" d="M40 140 A110 110 0 0 1 260 140"
                      stroke="url(#g1)" stroke-width="22" fill="none"
                      stroke-linecap="round" stroke-dasharray="0 1000"
                      filter="url(#glowC)"/>
                <circle cx="150" cy="140" r="6" fill="#14232b"/>
                <g id="creditNeedle" transform="rotate(-90 150 140)">
                  <line x1="150" y1="140" x2="150" y2="40" stroke="#14232b" stroke-width="4"/>
                </g>
                <g>
                  <line class="gauge-tick-line" x1="40" y1="145" x2="40" y2="150"/>
                  <line class="gauge-tick-line" x1="95" y1="145" x2="95" y2="150"/>
                  <line class="gauge-tick-line" x1="150" y1="145" x2="150" y2="150"/>
                  <line class="gauge-tick-line" x1="205" y1="145" x2="205" y2="150"/>
                  <line class="gauge-tick-line" x1="260" y1="145" x2="260" y2="150"/>
                  <text class="gauge-tick-text" x="40" y="164">0</text>
                  <text class="gauge-tick-text" x="95" y="164">25</text>
                  <text class="gauge-tick-text" x="150" y="164">50</text>
                  <text class="gauge-tick-text" x="205" y="164">75</text>
                  <text class="gauge-tick-text" x="260" y="164">100</text>
                </g>
              </svg>
            </div>
            <div class="fw-bold" style="font-size:26px;"><?= $credit_score_100 ?></div>
            <div class="muted small">≈ <?= $credit_score_850 ?> / 850</div>
            <span class="badge <?= $rating_badge_class ?> mt-2"><?= $rating_text ?></span>
          </div>

          <!-- Credit Insights -->
          <div class="card-top hover-card text-start">
            <h6 class="mb-2">Credit Insights</h6>
            <div class="insight-row"><div class="muted">On-Time Payment</div><div><strong><?= round($on_time_rate*100,1) ?>%</strong></div></div>
            <div class="insight-row"><div class="muted">Credit Utilization</div><div><strong><?= round((1-$credit_utilization)*100,1) ?>% used</strong></div></div>
            <div class="insight-row"><div class="muted">BNPL History</div><div><strong><?= $months_bnpl ?> months</strong></div></div>
            <div class="insight-row"><div class="muted">Total Overdues</div><div><strong><?= $bnplProfile ? $bnplProfile->late_payments + $bnplProfile->missed_payments : 0 ?></strong></div></div>
            <div class="muted small mt-2">Insights auto-generated based on AyitiBook BNPL rule logic.</div>
          </div>
        </div>

        <!-- SUMMARY CARDS -->
        <div class="row g-3">
          <div class="col-md-3">
            <div class="summary-box hover-card">
              <div class="summary-title">Total BNPL Limit</div>
              <div class="summary-value">$<?= number_format($loan_limit,2) ?></div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="summary-box hover-card">
              <div class="summary-title">Outstanding</div>
              <div class="summary-value">$<?= number_format($total_limit_used,2) ?></div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="summary-box hover-card">
              <div class="summary-title">Available</div>
              <div class="summary-value">$<?= number_format($available_to_borrow_calc,2) ?></div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="summary-box hover-card">
              <div class="summary-title">Next Payment</div>
              <div class="summary-value">$<?= number_format($summary['next_payment'],2) ?></div>
            </div>
          </div>
        </div>

        <!-- ACTIVE LOANS -->
        <div class="mt-5">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Your Active Loans</h4>
            <div class="muted small">Manage installments</div>
          </div>
          <div class="loan-scroll">
            <?php foreach($loans as $ln):
              $parts = explode('/', $ln['installments']);
              $done  = isset($parts[0]) ? (int)$parts[0] : 0;
              $total = isset($parts[1]) ? (int)$parts[1] : 0;
              $pct   = $total>0 ? ($done/$total)*100 : 0;
              $r      = 22;
              $circ   = 2*M_PI*$r;
              $offset = $circ - ($circ * $pct/100);
            ?>
            <div class="loan-card hover-card" data-loan-id="<?= $ln['id'] ?>" style="cursor:pointer;">
              <div class="d-flex justify-content-between align-items-start mb-2">
                <span class="badge <?= $ln['status']=='Active'?'bg-danger':'bg-secondary' ?>">
                  <?= htmlspecialchars($ln['status']) ?>
                </span>
              </div>
              <div class="d-flex align-items-center gap-3">
                <img src="<?= htmlspecialchars($ln['image']) ?>" alt="" class="loan-product-img">
                <div style="flex:1;">
                  <div class="loan-product-title"><?= htmlspecialchars($ln['product']) ?></div>
                  <div class="loan-subtitle"><?= htmlspecialchars($ln['title']) ?></div>
                  <div class="muted mt-1" style="font-size:12px;">
                    Remaining: $<?= number_format($ln['remaining'],2) ?><br>
                    Next: <?= date("M j", strtotime($ln['next_due'])) ?>
                  </div>
                </div>
                <div class="text-center" style="display:flex; flex-direction:column; align-items:center;">
    
                  <svg class="installment-ring" viewBox="0 0 60 60" style="display:block; margin:auto;">
                      <defs>
                          <linearGradient id="ringGrad<?= $ln['id'] ?>" x1="0%" x2="100%">
                              <stop offset="0%"  stop-color="#4ade80"/>
                              <stop offset="100%" stop-color="#22c55e"/>
                          </linearGradient>
                      </defs>
              
                      <circle cx="30" cy="30" r="<?= $r ?>" stroke="#e5e7eb" stroke-width="6" fill="#ffffff" />
                      <circle cx="30" cy="30" r="<?= $r ?>"
                          stroke="url(#ringGrad<?= $ln['id'] ?>)" stroke-width="6"
                          fill="none" stroke-linecap="round"
                          stroke-dasharray="<?= $circ ?>" stroke-dashoffset="<?= $offset ?>"
                          transform="rotate(-90 30 30)" />
              
                      <!-- Installment count inside circle -->
                      <text x="30" y="28" class="installment-text">
                          <?= htmlspecialchars($ln['installments']) ?>
                      </text>
                  </svg>
              
                  <!-- Payments BELOW circle -->
                  <div style="font-size:11px; margin-top:6px; color:#6b7280;">
                      Payments
                  </div>
              </div>
              
              </div>
              <div class="d-flex gap-2 mt-3">
                <button class="btn btn-sm btn-outline-primary btn-pay-now"
                        data-loan-id="<?= $ln['id'] ?>"
                        data-loan-title="<?= htmlspecialchars($ln['product']) ?>"
                        data-amount="<?= number_format($ln['remaining'],2) ?>">
                  Pay Now
                </button>
                <button class="btn btn-sm btn-outline-secondary btn-details"
                        data-loan-id="<?= $ln['id'] ?>">
                  Details
                </button>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- MILESTONES + PAYMENTS SIDE BY SIDE -->
        <div class="mt-5">
          <div class="row g-4">
            <!-- LEFT: Credit Limit Milestones -->
            <div class="col-lg-6">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="mb-0">Credit Limit Milestones</h4>
              </div>
              <div class="milestone-card hover-card">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <span class="muted small">
                    Completed <?= $completed_milestones ?>/<?= $total_milestones ?>
                  </span>
                  <span class="muted small"><?= $next_tier_label ?></span>
                </div>
                <div class="milestone-footer-text"><?= htmlspecialchars($next_tier_score_text) ?></div>

                <div class="milestone-row mt-3 mb-3">
                  <?php foreach($milestones as $m): ?>
                  <div class="milestone-item">
                    <div class="milestone-icon">
                      <i class="fa <?= $m['icon'] ?>"></i>
                    </div>
                    <div style="flex:1;">
                      <div class="milestone-label">
                        <?= htmlspecialchars($m['label']) ?>
                        <?php if($m['completed']): ?>
                          <span class="badge bg-success ms-1" style="font-size:9px;">Done</span>
                        <?php else: ?>
                          <span class="badge bg-light text-muted ms-1" style="font-size:9px;">Pending</span>
                        <?php endif; ?>
                      </div>
                      <div class="milestone-meta">
                        <?= htmlspecialchars($m['current']) ?> · Target: <?= htmlspecialchars($m['required']) ?>
                      </div>
                      <!-- mini progress bar per milestone -->
                      <div class="mini-progress">
                        <div class="mini-progress-bar" style="width:<?= (int)$m['progress'] ?>%;"></div>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>

                <!-- overall progress -->
                <div class="mt-1">
                  <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="muted small">Overall progress</span>
                    <span class="small fw-semibold"><?= $milestone_progress ?>%</span>
                  </div>
                  <div class="progress" style="height:8px;">
                    <div class="progress-bar"
                         role="progressbar"
                         style="width:<?= $milestone_progress ?>%;background:linear-gradient(90deg,#4ade80,#22c55e);"
                         aria-valuenow="<?= $milestone_progress ?>" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>

            <!-- RIGHT: Calendar + Upcoming (stacked in one card) -->
            <div class="col-lg-6">
              <div class="payments-card hover-card">
                <!-- Calendar -->
                <?php
                  if (!empty($upcoming)) {
                    $firstUpcomingTs = strtotime($upcoming[0]['date']);
                    $calYear  = (int)date('Y', $firstUpcomingTs);
                    $calMonth = (int)date('n', $firstUpcomingTs);
                  } else {
                    $calYear  = (int)date('Y');
                    $calMonth = (int)date('n');
                  }
                  $monthName   = date('F', mktime(0,0,0,$calMonth,1,$calYear));
                  $firstDay    = strtotime("$calYear-$calMonth-01");
                  $startWeekDay= (int)date('N', $firstDay);
                  $daysInMonth = (int)date('t', $firstDay);
                  $dueDays     = [];
                  foreach($upcoming as $u){
                    $d = strtotime($u['date']);
                    if($d && (int)date('Y',$d)===$calYear && (int)date('n',$d)===$calMonth){
                      $dueDays[(int)date('j',$d)][] = $u;
                    }
                  }
                ?>
                <h5 class="mb-1">Upcoming Payment Calendar</h5>
                <p class="muted small mb-2">Upcoming dues for <strong><?= $monthName.' '.$calYear ?></strong></p>
                <div class="mini-calendar p-2 mb-3">
                  <?php
                    $wk = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
                    echo '<div class="mb-1 small text-muted d-flex justify-content-between" style="font-size:12px;">';
                    foreach($wk as $w) echo "<div style='width:32px;text-align:center;'>$w</div>";
                    echo '</div>';
                    $cells = [];
                    for($i=0; $i<$startWeekDay-1; $i++) $cells[] = '';
                    for($d=1; $d<=$daysInMonth; $d++) $cells[] = $d;
                    echo '<div style="display:flex;flex-wrap:wrap;">';
                    foreach($cells as $c){
                      $hasDue = is_int($c) && isset($dueDays[$c]);
                      $class  = $hasDue ? 'day dot' : 'day';
                      echo "<div class='{$class}' style='border:1px solid #f1f4f8;'>".($c ?: '')."</div>";
                    }
                    echo '</div>';
                  ?>
                </div>

                <!-- Upcoming Payments (stacked under calendar) -->
                <h5 class="mb-1">Upcoming Payments</h5>
                <p class="muted small mb-2">Keep making payments on time to protect your BNPL limit.</p>
                <div class="table-responsive" style="max-height:220px;overflow-y:auto;">
                  <table class="table table-sm align-middle mb-0">
                    <thead class="small text-muted">
                      <tr><th style="width:25%;">Date</th><th style="width:35%;">Loan</th><th style="width:20%;">Amount</th><th style="width:20%;">Status</th></tr>
                    </thead>
                    <tbody>
                      <?php if(!empty($upcoming) && is_array($upcoming)): foreach($upcoming as $u): ?>
                      <tr>
                        <td><?= date("M d, Y", strtotime($u['date'])) ?></td>
                        <td><?= htmlspecialchars($u['loan']) ?></td>
                        <td>$<?= number_format($u['amount'],2) ?></td>
                        <td>
                          <span class="badge <?= $u['status']=='Due Soon' ? 'bg-danger' : 'bg-success' ?>">
                            <?= htmlspecialchars($u['status']) ?>
                          </span>
                        </td>
                      </tr>
                      <?php endforeach; else: ?>
                      <tr><td colspan="4" class="text-muted">No upcoming payments</td></tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div><!-- page-card -->
    </div><!-- main col -->
  </div>
</div>

@include('includes.footer')

<!-- Drawer for loan details -->
<div id="loanDrawer" class="drawer" aria-hidden="true">
  <div class="drawer-header d-flex justify-content-between align-items-center">
    <div><strong id="drawerTitle">Loan Details</strong></div>
    <div><button id="closeDrawer" class="btn btn-sm btn-light">&times;</button></div>
  </div>
  <div class="p-3" id="drawerBody"><div class="text-muted">Loading...</div></div>
</div>

<!-- Pay Now Modal -->
<div class="modal fade" id="payNowModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pay Installment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="payForm">
          <div class="mb-2">Loan: <strong id="payLoanTitle"></strong></div>
          <div class="mb-2">Amount Due: <strong id="payAmount"></strong></div>
          <div class="mb-3">
            <label class="form-label">Payment Method</label>
            <select id="payMethod" class="form-select">
              <option>AyitiBook Wallet</option>
              <option>Credit / Debit Card</option>
              <option>UPI/Netbanking</option>
            </select>
          </div>
          <div id="payProcessing" style="display:none;" class="text-center">
            <div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
            <div class="mt-2">Processing payment...</div>
          </div>
        </div>
        <div id="paySuccess" style="display:none;" class="text-center">
          <div class="text-success" style="font-size:22px;">Payment Successful!</div>
          <div class="mt-2">Thank you — the installment has been recorded.</div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="confirmPayBtn" type="button" class="btn btn-pay">Pay Now</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- RULES MODAL -->
<div class="modal fade" id="rulesModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius:14px;">

      <div class="modal-header" style="border-bottom:none;">
        <h5 class="modal-title d-flex align-items-center gap-2">
          <i class="fa fa-info-circle text-danger"></i>
          <span>AyitiBook BNPL Rules</span>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- OPTION B – PILL NAV -->
      <ul class="nav nav-pills rules-nav" id="rulesTabNav" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link rules-pill active"
                  type="button"
                  data-target="rules-overview">
            <i class="fa fa-book-open"></i> Overview
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link rules-pill"
                  type="button"
                  data-target="rules-eligibility">
            <i class="fa fa-user-check"></i> Eligibility
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link rules-pill"
                  type="button"
                  data-target="rules-credit-tiers">
            <i class="fa fa-layer-group"></i> Credit Tiers
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link rules-pill"
                  type="button"
                  data-target="rules-payments">
            <i class="fa fa-receipt"></i> Payments &amp; Fees
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link rules-pill"
                  type="button"
                  data-target="rules-debt">
            <i class="fa fa-hand-holding-dollar"></i> Debt Recovery
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link rules-pill"
                  type="button"
                  data-target="rules-suspension">
            <i class="fa fa-ban"></i> Suspension &amp; Misuse
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link rules-pill"
                  type="button"
                  data-target="rules-faq">
            <i class="fa fa-circle-question"></i> FAQ
          </button>
        </li>
      </ul>

      <div class="modal-body rules-animated-body" style="max-height:65vh; overflow-y:auto;">

        <!-- OVERVIEW -->
        <section id="rules-overview" class="rules-section activeRuleSection">
          <div class="rules-section-card">
            <div class="rule-title mb-2">
              <i class="fa fa-book-open rule-icon bg-danger"></i>
              <h6 class="fw-bold text-primary mb-0">Program Overview</h6>
            </div>
            <p class="mb-3">
              Short summary based on the official AyitiBook
              <strong>“Buy Now Pay Later (BNPL)”</strong> program document.
              This screen is only a friendly summary; final rules and legal
              terms appear in your AyitiBook account.
            </p>
            <ul class="small text-muted mb-0">
              <li>BNPL is available only to eligible AyitiBook customers with a verified account.</li>
              <li>You receive a small spending limit first; the limit can grow when you pay on time.</li>
              <li>Each BNPL order is split into fixed installments with clear due dates.</li>
              <li>All active BNPL orders and upcoming payments are visible in this dashboard.</li>
              <li>Misuse of BNPL or unpaid installments can lead to limit reduction or suspension.</li>
            </ul>
          </div>
        </section>

        <!-- ELIGIBILITY -->
        <section id="rules-eligibility" class="rules-section">
          <div class="rules-section-card">
            <div class="rule-title mb-2">
              <i class="fa fa-user-check rule-icon bg-primary"></i>
              <h6 class="fw-bold text-primary mb-0">BNPL Eligibility Rules</h6>
            </div>
            <ul class="small text-muted mb-0">
              <li>Account must be fully verified (KYC completed and approved).</li>
              <li>BNPL can only be used on eligible products and offers shown by AyitiBook.</li>
              <li>AyitiBook may run internal risk checks before approving BNPL for your account.</li>
              <li>Accounts with fraud risk, misuse, or repeated unpaid orders may lose BNPL access.</li>
              <li>AyitiBook may change eligibility requirements at any time based on risk policy.</li>
            </ul>
          </div>
        </section>

        <!-- CREDIT TIERS -->
        <section id="rules-credit-tiers" class="rules-section">
          <div class="rules-section-card">
            <div class="rule-title mb-2">
              <i class="fa fa-layer-group rule-icon bg-warning text-dark"></i>
              <h6 class="fw-bold text-primary mb-0">Credit Score &amp; Limit Tiers</h6>
            </div>
            <p class="small text-muted mb-2">
              Your AyitiBook BNPL score is a 0–100 internal score based on payment history,
              BNPL usage and account behaviour. The table below shows how the
              score links to your BNPL limit:
            </p>
            <div class="table-responsive mb-3">
              <table class="table table-sm mb-0">
                <thead class="small text-muted">
                  <tr>
                    <th>Credit Score (range)</th>
                    <th>BNPL Limit (USD)</th>
                    <th>Decision</th>
                  </tr>
                </thead>
                <tbody class="small">
                  <?php if ($bnplTiers->isNotEmpty()): ?>
                    <?php foreach ($bnplTiers as $tier): ?>
                      <tr>
                        <td><?= $tier->min_score ?> – <?= $tier->max_score ?></td>
                        <td>$<?= number_format($tier->limit_amount, 0) ?></td>
                        <td><strong><?= ucfirst($tier->display_name) ?></strong> / <?= $tier->description ?></td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td>0 – 67</td>
                      <td>0</td>
                      <td>Not eligible for BNPL</td>
                    </tr>
                    <tr>
                      <td>68 – 79</td>
                      <td>12</td>
                      <td><strong>Starter</strong> / lowest loan tier</td>
                    </tr>
                    <tr>
                      <td>80 – 90</td>
                      <td>19</td>
                      <td><strong>Growth</strong> / medium tier</td>
                    </tr>
                    <tr>
                      <td>91 – 95</td>
                      <td>28</td>
                      <td><strong>Plus</strong> / maximum loan tier</td>
                    </tr>
                    <tr>
                      <td>96 – 100</td>
                      <td>38</td>
                      <td><strong>Pro</strong> / maximum loan tier</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
            <p class="small text-muted mb-2">
              All customers who meet BNPL eligibility for the first time should complete at
              least <strong>2 BNPL orders of 1,500 HTG each</strong> without late payments
              before being considered for a higher tier.
            </p>
            <p class="small text-muted mb-0">
              AyitiBook may adjust your tier based on repayment behaviour, disputes,
              cancellations or additional risk checks.
            </p>
          </div>
        </section>

        <!-- PAYMENTS & FEES -->
        <section id="rules-payments" class="rules-section">
          <div class="rules-section-card">
            <div class="rule-title mb-2">
              <i class="fa fa-receipt rule-icon bg-success"></i>
              <h6 class="fw-bold text-primary mb-0">Payments &amp; Fees</h6>
            </div>
            <ul class="small text-muted mb-0">
              <li>
                Each BNPL purchase is split into <strong>3–4 scheduled installments</strong>.
                The exact pattern depends on the offer shown at checkout.
              </li>
              <li>
                Installment due dates and amounts are clearly displayed during checkout and
                inside this BNPL dashboard.
              </li>
              <li>
                AyitiBook may charge service fees or late fees if a payment is overdue beyond
                the allowed grace period.
              </li>
              <li>
                Failed auto-debits may be retried; if payments keep failing, your BNPL access
                can be limited or paused.
              </li>
            </ul>
          </div>
        </section>

        <!-- DEBT RECOVERY -->
        <section id="rules-debt" class="rules-section">
          <div class="rules-section-card">
            <div class="rule-title mb-2">
              <i class="fa fa-hand-holding-dollar rule-icon bg-info text-dark"></i>
              <h6 class="fw-bold text-primary mb-0">Debt Recovery &amp; Collections</h6>
            </div>
            <ul class="small text-muted mb-0">
              <li>Unpaid BNPL installments may be collected from your AyitiBook wallet balance or other available payment methods.</li>
              <li>AyitiBook may send reminders, notifications or contact you if installments remain unpaid.</li>
              <li>Persistent non-payment can lead to internal collections actions or referral to external partners where permitted by law.</li>
              <li>Serious overdue behaviour can impact your BNPL score and future eligibility for AyitiBook credit products.</li>
            </ul>
          </div>
        </section>

        <!-- SUSPENSION & MISUSE -->
        <section id="rules-suspension" class="rules-section">
          <div class="rules-section-card">
            <div class="rule-title mb-2">
              <i class="fa fa-ban rule-icon bg-danger"></i>
              <h6 class="fw-bold text-primary mb-0">Suspension, Misuse &amp; Risk</h6>
            </div>
            <ul class="small text-muted mb-2">
              <li>Repeated late payments or unpaid installments can instantly block or reduce your BNPL limit.</li>
              <li>Abuse of BNPL (for example, fake / abusive orders, disputes made in bad faith, or fraud) can lead to account review.</li>
              <li>AyitiBook may reduce your limit or close BNPL access if your account is under investigation or considered high risk.</li>
              <li>Misuse of BNPL is treated under the main AyitiBook Terms &amp; Conditions.</li>
            </ul>
            <p class="small text-muted mb-0">
              This screen is only a simplified summary. The official BNPL policy, along with
              full legal terms and conditions, is shown in your AyitiBook account.
            </p>
          </div>
        </section>

        <!-- FAQ -->
        <section id="rules-faq" class="rules-section">
          <div class="rules-section-card">
            <div class="rule-title mb-2">
              <i class="fa fa-circle-question rule-icon bg-primary"></i>
              <h6 class="fw-bold text-primary mb-0">Frequently Asked Questions</h6>
            </div>

            <div class="faq-item">
              <div class="faq-q">
                <i class="fa fa-question-circle"></i>
                <span>What is AyitiBook BNPL?</span>
              </div>
              <div class="faq-a">
                BNPL lets you split eligible purchases into several installments instead of
                paying the full amount at once. You still have to pay every installment on
                or before its due date.
              </div>
            </div>

            <div class="faq-item">
              <div class="faq-q">
                <i class="fa fa-question-circle"></i>
                <span>How is my BNPL limit decided?</span>
              </div>
              <div class="faq-a">
                Your limit is based on AyitiBook’s internal credit score, your payment history,
                number of completed BNPL orders, disputes, cancellations and other risk checks.
              </div>
            </div>

            <div class="faq-item">
              <div class="faq-q">
                <i class="fa fa-question-circle"></i>
                <span>Can my limit increase over time?</span>
              </div>
              <div class="faq-a">
                Yes. Completing BNPL orders on time, avoiding disputes and using AyitiBook
                responsibly can help you move to higher tiers (for example from 12 → 19 → 38 USD).
              </div>
            </div>

            <div class="faq-item">
              <div class="faq-q">
                <i class="fa fa-question-circle"></i>
                <span>What happens if I miss a payment?</span>
              </div>
              <div class="faq-a">
                Your BNPL may be paused, late fees may apply and your AyitiBook BNPL score and
                limit can be reduced. Serious or repeated non-payment can lead to collections
                actions or closure of BNPL.
              </div>
            </div>

            <div class="faq-item mb-0">
              <div class="faq-q">
                <i class="fa fa-question-circle"></i>
                <span>Where can I see my official BNPL terms?</span>
              </div>
              <div class="faq-a">
                The official, legally binding BNPL terms and policy are shown in your AyitiBook
                account and may be updated from time to time. Always check those terms for the
                latest information.
              </div>
            </div>

          </div>
        </section>

      </div>

      <div class="modal-footer" style="border-top:none;">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!-- END RULES MODAL -->




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
  // animate gauges
  animateGauge('creditArc','creditNeedle', <?= $credit_score_100 ?>);
  animateGauge('limitArc','limitNeedle', <?= $bnpl_used_percent ?>);

  const drawer       = document.getElementById('loanDrawer');
  const drawerBody   = document.getElementById('drawerBody');
  const drawerTitle  = document.getElementById('drawerTitle');
  const closeDrawerBtn = document.getElementById('closeDrawer');

  function openDrawer(html,title){
    drawerBody.innerHTML = html;
    drawerTitle.textContent = title;
    drawer.classList.add('open');
  }
  function closeDrawer(){ drawer.classList.remove('open'); }
  closeDrawerBtn.addEventListener('click', closeDrawer);

  document.querySelectorAll('.btn-details').forEach(btn=>{
    btn.addEventListener('click', function(e){
      e.stopPropagation();
      fetchLoanDetails(this.dataset.loanId);
    });
  });
  document.querySelectorAll('.loan-card').forEach(card=>{
    card.addEventListener('click', function(e){
      if(e.target.closest('.btn')) return;
      fetchLoanDetails(this.dataset.loanId);
    });
  });

  const payNowModal   = new bootstrap.Modal(document.getElementById('payNowModal'));
  const payLoanTitle  = document.getElementById('payLoanTitle');
  const payAmount     = document.getElementById('payAmount');
  const confirmPayBtn = document.getElementById('confirmPayBtn');
  const payProcessing = document.getElementById('payProcessing');
  const paySuccess    = document.getElementById('paySuccess');

  document.querySelectorAll('.btn-pay-now').forEach(btn=>{
    btn.addEventListener('click', function(e){
      e.stopPropagation();
      payLoanTitle.textContent = this.dataset.loanTitle;
      payAmount.textContent    = '$' + this.dataset.amount;
      payProcessing.style.display = 'none';
      paySuccess.style.display    = 'none';
      confirmPayBtn.disabled      = false;
      payNowModal.show();
    });
  });

  confirmPayBtn.addEventListener('click', function(){
    confirmPayBtn.disabled = true;
    payProcessing.style.display = '';
    setTimeout(function(){
      payProcessing.style.display = 'none';
      paySuccess.style.display    = '';
      setTimeout(()=>{ payNowModal.hide(); }, 1100);
    }, 1400);
  });

  function fetchLoanDetails(id){
    const loans    = <?= json_encode($loans) ?>;
    const upcoming = <?= json_encode($upcoming) ?>;
    const loan     = loans.find(l => String(l.id) === String(id));
    if(!loan) return openDrawer('<div class="p-3">Loan not found</div>','Loan Details');

    let html  = '<div style="padding:12px;">';
    html += '<div style="font-weight:800;font-size:18px;">'+escapeHtml(loan.product || loan.title)+'</div>';
    html += '<div class="muted small" style="margin-top:6px;">Status: '+escapeHtml(loan.status)+'</div>';
    html += '<div style="margin-top:10px;"><strong>Remaining:</strong> $'+Number(loan.remaining).toFixed(2)+'</div>';
    html += '<div><strong>Installments:</strong> '+escapeHtml(loan.installments)+'</div>';
    html += '<div><strong>Next Payment:</strong> '+(new Date(loan.next_due)).toLocaleDateString()+'</div>';
    html += '<hr/><div style="font-weight:700;margin-bottom:6px;">Payment History</div>';

    upcoming.forEach(u=>{
      if(String(u.loan_id)===String(loan.id)){
        html += '<div class="small">Upcoming: '+escapeHtml(u.loan)+' — '+(new Date(u.date)).toLocaleDateString()+' — $'+Number(u.amount).toFixed(2)+'</div>';
      }
    });

    html += '<div class="mt-3 small text-muted">Recent payments:</div>';
    html += '<ul class="small">';
    // Get recent payments for this loan
    const loanPayments = upcoming.filter(u => String(u.loan_id) === String(loan.id));
    if (loanPayments.length > 0) {
        loanPayments.slice(0, 3).forEach(payment => {
            const status = payment.status === 'paid' ? 'Paid' : 'Due';
            html += '<li>' + status + ' $' + Number(payment.amount).toFixed(2) + ' — ' + new Date(payment.date).toLocaleDateString() + '</li>';
        });
    } else {
        html += '<li>No recent payments</li>';
    }
    html += '</ul>';
    html += '<div class="mt-3 d-flex gap-2">';
    html += '<button class="btn btn-pay" id="drawerPayNow">Pay Now</button>';
    html += '<button class="btn btn-outline-secondary" id="drawerCloseInner">Close</button>';
    html += '</div></div>';

    openDrawer(html, loan.product || loan.title);

    setTimeout(()=>{
      document.getElementById('drawerCloseInner')?.addEventListener('click', closeDrawer);
      document.getElementById('drawerPayNow')?.addEventListener('click', function(){
        payLoanTitle.textContent = loan.product || loan.title;
        payAmount.textContent    = '$' + Number(loan.remaining).toFixed(2);
        payProcessing.style.display = 'none';
        paySuccess.style.display    = 'none';
        confirmPayBtn.disabled      = false;
        payNowModal.show();
      });
    },50);
  }

  function escapeHtml(s){
    return String(s).replace(/[&<>"]/g,function(c){
      return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[c];
    });
  }

  function animateGauge(arcId, needleId, percent){
    const arc    = document.getElementById(arcId);
    const needle = document.getElementById(needleId);
    if(!arc || !needle) return;
    let duration = 1200, start = null;
    function frame(ts){
      if(!start) start = ts;
      let p     = Math.min((ts-start)/duration,1);
      let ease  = 1 - Math.pow(1-p,3);
      let arcLength = ease * (percent/100) * 345;
      arc.setAttribute('stroke-dasharray', arcLength + ' 500');
      let angle = -90 + (percent*1.8*ease);
      needle.setAttribute('transform','rotate('+angle+' 150 140)');
      if(p < 1) requestAnimationFrame(frame);
    }
    requestAnimationFrame(frame);
  }
});

// BNPL Rules modal – Option B pill navigation
const ruleButtons  = document.querySelectorAll('.rules-pill');
const ruleSections = document.querySelectorAll('.rules-section');

ruleButtons.forEach(btn => {
  btn.addEventListener('click', function () {

    // Remove active from all pills
    ruleButtons.forEach(b => b.classList.remove('active'));

    // Add active to clicked pill
    this.classList.add('active');

    // Determine which section to open
    const targetId = this.dataset.target;

    // Hide all sections, show only the correct one
    ruleSections.forEach(sec => {
      sec.classList.toggle('activeRuleSection', sec.id === targetId);
    });
  });
});



</script>
</body>
</html>