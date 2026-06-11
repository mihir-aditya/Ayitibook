{{-- resources/views/profile/notifications.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Notifications & Alerts</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
  <style>
    :root {
      --red:       #e8313a;
      --red-soft:  #fdf1f2;
      --red-mid:   #fbd5d7;
      --ink:       #1a1a2e;
      --ink-light: #4a4a6a;
      --muted:     #9898b0;
      --border:    #ebebf4;
      --surface:   #ffffff;
      --bg:        #f4f4f9;
      --gold:      #f5a623;
      --green:     #22c55e;
      --blue:      #3b82f6;
      --purple:    #8b5cf6;
      --teal:      #14b8a6;
    }

    *, *::before, *::after { box-sizing: border-box; }

    body {
      background: var(--bg);
      font-family: "DM Sans", sans-serif;
      color: var(--ink);
    }

    /* ── Page wrapper ── */
    .notif-page {
      max-width: 860px;
      margin: 40px auto;
      padding: 0 16px 60px;
    }

    /* ── Page header ── */
    .notif-page-header {
      display: flex;
      align-items: flex-end;
      justify-content: space-between;
      margin-bottom: 28px;
      gap: 12px;
      flex-wrap: wrap;
    }

    .notif-page-header .page-title {
      font-family: "Playfair Display", serif;
      font-size: 28px;
      font-weight: 600;
      color: var(--ink);
      margin: 0;
      line-height: 1.2;
    }

    .notif-page-header .page-title span {
      color: var(--red);
    }

    .notif-page-header .page-subtitle {
      font-size: 13px;
      color: var(--muted);
      margin: 4px 0 0;
    }

    /* ── Banner ── */
    .sale-banner {
      background: linear-gradient(120deg, #1a1a2e 0%, #e8313a 100%);
      border-radius: 14px;
      padding: 18px 24px;
      margin-bottom: 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      flex-wrap: wrap;
      position: relative;
      overflow: hidden;
    }

    .sale-banner::before {
      content: '';
      position: absolute;
      width: 200px; height: 200px;
      background: rgba(255,255,255,.05);
      border-radius: 50%;
      top: -60px; right: -40px;
    }

    .sale-banner::after {
      content: '';
      position: absolute;
      width: 120px; height: 120px;
      background: rgba(255,255,255,.04);
      border-radius: 50%;
      bottom: -50px; left: 30%;
    }

    .sale-banner .banner-text {
      color: #fff;
      font-size: 14.5px;
      font-weight: 500;
      position: relative;
      z-index: 1;
    }

    .sale-banner .banner-text strong {
      font-size: 17px;
      font-weight: 700;
      display: block;
      margin-bottom: 2px;
    }

    .sale-banner .banner-cta {
      background: #fff;
      color: var(--red);
      border: none;
      border-radius: 8px;
      padding: 9px 22px;
      font-family: "DM Sans", sans-serif;
      font-size: 13.5px;
      font-weight: 600;
      text-decoration: none;
      position: relative;
      z-index: 1;
      transition: transform .15s, box-shadow .15s;
      white-space: nowrap;
    }

    .sale-banner .banner-cta:hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 18px rgba(0,0,0,.18);
    }

    /* ── Toolbar ── */
    .notif-toolbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 20px;
    }

    .filter-pills {
      display: flex;
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 10px;
      padding: 4px;
      gap: 2px;
    }

    .filter-pills a {
      padding: 7px 18px;
      border-radius: 7px;
      font-size: 13px;
      font-weight: 500;
      color: var(--ink-light);
      text-decoration: none;
      transition: background .15s, color .15s;
    }

    .filter-pills a.active {
      background: var(--red);
      color: #fff;
      box-shadow: 0 3px 10px rgba(232,49,58,.3);
    }

    .toolbar-actions {
      display: flex;
      gap: 8px;
    }

    .toolbar-actions .t-btn {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 16px;
      border-radius: 9px;
      font-family: "DM Sans", sans-serif;
      font-size: 13px;
      font-weight: 500;
      cursor: pointer;
      border: 1px solid var(--border);
      background: var(--surface);
      color: var(--ink-light);
      transition: all .15s;
    }

    .toolbar-actions .t-btn:hover {
      border-color: var(--ink-light);
      color: var(--ink);
    }

    .toolbar-actions .t-btn.danger:hover {
      border-color: var(--red);
      color: var(--red);
    }

    /* ── Notification Card ── */
    .notif-card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 0;
      margin-bottom: 10px;
      display: flex;
      align-items: stretch;
      overflow: hidden;
      position: relative;
      transition: box-shadow .2s, transform .2s;
      animation: slideIn .3s ease both;
    }

    @keyframes slideIn {
      from { opacity: 0; transform: translateY(8px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .notif-card:hover {
      box-shadow: 0 8px 28px rgba(0,0,0,.09);
      transform: translateY(-1px);
    }

    .notif-card.unread {
      background: var(--red-soft);
      border-color: var(--red-mid);
    }

    .notif-card.unread::after {
      content: '';
      position: absolute;
      top: 18px; right: 16px;
      width: 8px; height: 8px;
      background: var(--red);
      border-radius: 50%;
      box-shadow: 0 0 0 3px rgba(232,49,58,.18);
    }

    /* Coloured left stripe */
    .notif-stripe {
      width: 5px;
      flex-shrink: 0;
      background: var(--stripe-color, var(--border));
      border-radius: 0;
    }

    /* Icon */
    .notif-icon-col {
      flex-shrink: 0;
      display: flex;
      align-items: center;
      padding: 0 6px 0 18px;
    }

    .notif-icon {
      width: 46px;
      height: 46px;
      border-radius: 13px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      color: #fff;
      background: var(--icon-bg, #888);
      flex-shrink: 0;
    }

    /* Body */
    .notif-body {
      flex: 1;
      min-width: 0;
      padding: 16px 40px 16px 14px;
    }

    .notif-body .notif-type-tag {
      display: inline-block;
      font-size: 10.5px;
      font-weight: 700;
      letter-spacing: .6px;
      text-transform: uppercase;
      color: var(--tag-color, var(--muted));
      background: var(--tag-bg, #f0f0f8);
      padding: 2px 9px;
      border-radius: 5px;
      margin-bottom: 6px;
    }

    .notif-body h6 {
      font-size: 14.5px;
      font-weight: 600;
      color: var(--ink);
      margin: 0 0 4px;
      line-height: 1.4;
    }

    .notif-body p {
      font-size: 13.5px;
      color: var(--ink-light);
      margin: 0;
      line-height: 1.6;
    }

    .notif-footer {
      display: flex;
      align-items: center;
      gap: 14px;
      margin-top: 10px;
      flex-wrap: wrap;
    }

    .notif-time {
      font-size: 11.5px;
      color: var(--muted);
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .notif-action-btn {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      font-size: 12.5px;
      font-weight: 600;
      color: var(--red);
      text-decoration: none;
      padding: 5px 13px;
      border: 1.5px solid var(--red-mid);
      border-radius: 7px;
      background: var(--red-soft);
      transition: background .15s, border-color .15s;
    }

    .notif-action-btn:hover {
      background: var(--red);
      border-color: var(--red);
      color: #fff;
    }

    /* Delete button */
    .btn-del {
      position: absolute;
      top: 12px; right: 14px;
      width: 28px; height: 28px;
      border: none;
      background: transparent;
      color: var(--muted);
      border-radius: 8px;
      font-size: 17px;
      cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      transition: background .15s, color .15s;
      padding: 0;
    }

    .btn-del:hover {
      background: #fee2e2;
      color: var(--red);
    }

    /* ── Empty state ── */
    .empty-state {
      text-align: center;
      padding: 72px 20px;
      color: var(--muted);
    }

    .empty-state .empty-icon-wrap {
      width: 80px; height: 80px;
      background: var(--border);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      margin: 0 auto 20px;
      font-size: 36px;
      color: var(--muted);
    }

    .empty-state h5 {
      font-size: 17px;
      font-weight: 600;
      color: var(--ink-light);
      margin-bottom: 6px;
    }

    .empty-state p {
      font-size: 14px;
    }

    /* Pagination */
    .pagination .page-link {
      font-family: "DM Sans", sans-serif;
      font-size: 13.5px;
      color: var(--ink-light);
      border-color: var(--border);
    }

    .pagination .page-item.active .page-link {
      background: var(--red);
      border-color: var(--red);
    }
  </style>
</head>

<body>
  @include('includes.header')

  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        @include('includes.sidebar')
      </div>

      <div class="col-lg-9">
        <div class="notif-page">

          {{-- Page header --}}
          <div class="notif-page-header">
            <div>
              <h1 class="page-title">Your <span>Notifications</span></h1>
              <p class="page-subtitle">
                @if($notifications->total() > 0)
                  {{ $notifications->total() }} notification{{ $notifications->total() !== 1 ? 's' : '' }} — stay on top of your orders & offers
                @else
                  Nothing new right now
                @endif
              </p>
            </div>
            @if($notifications->total() > 0)
              <span style="background:var(--red);color:#fff;font-size:12px;font-weight:700;padding:5px 14px;border-radius:20px;letter-spacing:.3px;">
                {{ $notifications->total() }} total
              </span>
            @endif
          </div>

          {{-- Sale Banner --}}
          <div class="sale-banner">
            <div class="banner-text">
              <strong>🎉 Big Sale — Flat 50% off on Electronics</strong>
              Limited time offer. Don't miss out on top deals today!
            </div>
            <a href="#" class="banner-cta">Shop Now →</a>
          </div>

          {{-- Toolbar --}}
          <div class="notif-toolbar">
            <div class="filter-pills">
              <a href="{{ route('profile.notifications') }}"
                 class="{{ request('filter') !== 'unread' ? 'active' : '' }}">
                All
              </a>
              <a href="{{ route('profile.notifications', ['filter' => 'unread']) }}"
                 class="{{ request('filter') === 'unread' ? 'active' : '' }}">
                Unread
              </a>
            </div>
            <div class="toolbar-actions">
              <button class="t-btn" id="markAllReadBtn">
                <i class="bx bx-check-double"></i> Mark all read
              </button>
              <button class="t-btn danger" id="clearAllBtn">
                <i class="bx bx-trash"></i> Clear all
              </button>
            </div>
          </div>

          {{-- Notification list --}}
          @forelse($notifications as $notif)
            @php
              $style    = notifStyle($notif->type);
              $accent   = $style[0];
              $iconBg   = $style[1];
              $iconClass = $style[2];

              // Tag labels & bg per type
              $tagMap = [
                'order'   => ['ORDER',   '#fff7ed', '#f97316'],
                'offer'   => ['OFFER',   '#fdf1f2', '#e8313a'],
                'payment' => ['PAYMENT', '#f0fdf4', '#16a34a'],
                'alert'   => ['ALERT',   '#fffbeb', '#d97706'],
                'system'  => ['SYSTEM',  '#eff6ff', '#3b82f6'],
              ];
              $tag = $tagMap[$notif->type] ?? ['INFO', '#f4f4f9', '#9898b0'];
            @endphp

            <div class="notif-card {{ $notif->isRead() ? '' : 'unread' }}"
                 id="notif-{{ $notif->id }}"
                 style="--stripe-color:{{ $accent }};--icon-bg:{{ $iconBg }};--tag-bg:{{ $tag[1] }};--tag-color:{{ $tag[2] }};">

              <div class="notif-stripe"></div>

              <div class="notif-icon-col">
                <div class="notif-icon">
                  <i class="{{ $iconClass }}"></i>
                </div>
              </div>

              <div class="notif-body">
                <div class="notif-type-tag">{{ $tag[0] }}</div>
                <h6>{{ $notif->title }}</h6>
                <p>{{ $notif->message }}</p>

                <div class="notif-footer">
                  <span class="notif-time">
                    <i class="bx bx-time-five"></i>
                    {{ $notif->created_at->diffForHumans() }}
                  </span>

                  @if(!empty($notif->data['url']))
                    <a href="{{ $notif->data['url'] }}" class="notif-action-btn">
                      <i class="bx bx-link-external"></i> View details
                    </a>
                  @endif
                </div>
              </div>

              <button class="btn-del" data-id="{{ $notif->id }}" title="Delete">
                <i class="bx bx-x"></i>
              </button>
            </div>
          @empty
            <div class="empty-state">
              <div class="empty-icon-wrap">
                <i class="bx bx-bell-off"></i>
              </div>
              <h5>You're all caught up!</h5>
              <p>No notifications here. Check back later for order updates & offers.</p>
            </div>
          @endforelse

          {{-- Pagination --}}
          @if($notifications->hasPages())
            <div class="mt-4">
              {{ $notifications->links() }}
            </div>
          @endif

        </div>{{-- /.notif-page --}}
      </div>
    </div>
  </div>

  @include('includes.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const CSRF = document.querySelector('meta[name="csrf-token"]').content;

    // Delete single
    document.querySelectorAll('.btn-del').forEach(btn => {
      btn.addEventListener('click', function () {
        const id   = this.dataset.id;
        const item = document.getElementById('notif-' + id);

        fetch(`/profile/notifications/${id}`, {
          method: 'DELETE',
          headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
          if (data.success) {
            item.style.transition = 'opacity .25s, transform .25s';
            item.style.opacity    = '0';
            item.style.transform  = 'translateX(20px)';
            setTimeout(() => item.remove(), 270);
          }
        });
      });
    });

    // Mark all read
    document.getElementById('markAllReadBtn')?.addEventListener('click', () => {
      fetch('/profile/notifications/mark-all-read', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }
      })
      .then(r => r.json())
      .then(() => {
        document.querySelectorAll('.notif-card.unread')
          .forEach(el => el.classList.remove('unread'));
        const badge = document.getElementById('header-notif-badge');
        if (badge) badge.textContent = '0';
      });
    });

    // Clear all
    document.getElementById('clearAllBtn')?.addEventListener('click', () => {
      if (!confirm('Delete all notifications?')) return;
      fetch('/profile/notifications/clear-all', {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }
      })
      .then(r => r.json())
      .then(data => { if (data.success) location.reload(); });
    });
  </script>
</body>

</html>