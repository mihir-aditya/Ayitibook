{{--
  resources/views/includes/partials/notification_bell.blade.php
  
  Include this in your header blade wherever the bell icon should appear:
    @include('includes.partials.notification_bell')
--}}

@auth
<div class="dropdown" id="notif-dropdown-wrap">
  {{-- Bell trigger --}}
  <button class="btn position-relative p-0 border-0 bg-transparent"
          id="notifBell"
          data-bs-toggle="dropdown"
          aria-expanded="false"
          aria-label="Notifications">
    <i class="bx bx-bell fs-4 text-dark"></i>
    <span id="header-notif-badge"
          class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
          style="font-size:10px; display:none;">0</span>
  </button>

  {{-- Dropdown panel --}}
  <div class="dropdown-menu dropdown-menu-end shadow-lg p-0"
       id="notifDropdown"
       style="width:360px; max-width:95vw; border-radius:10px; overflow:hidden;">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between px-3 py-2 border-bottom bg-light">
      <span class="fw-semibold" style="font-size:15px;">
        <i class="bx bx-bell me-1 text-danger"></i> Notifications
      </span>
      <button class="btn btn-link btn-sm text-secondary p-0 text-decoration-none"
              id="dropdownMarkAll">Mark all read</button>
    </div>

    {{-- Notification items (filled via JS) --}}
    <div id="notif-list"
         style="max-height:400px; overflow-y:auto;">
      <div class="text-center py-4 text-muted" id="notif-loading">
        <div class="spinner-border spinner-border-sm me-2"></div> Loading…
      </div>
    </div>

    {{-- Footer --}}
    <div class="border-top text-center py-2 bg-light">
      <a href="{{ url('/profile/notifications') }}"
         class="btn btn-sm btn-outline-danger px-4">View All</a>
    </div>
  </div>
</div>

<script>
(function () {
  const CSRF      = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
  const badge     = document.getElementById('header-notif-badge');
  const list      = document.getElementById('notif-list');
  const loading   = document.getElementById('notif-loading');
  let   loaded    = false;

  /* ── colour map (mirrors helpers.php) ── */
  const iconMap = {
    order_placed    : ['#0d6efd', 'bx bx-cart-add'],
    order_confirmed : ['#198754', 'bx bx-check-circle'],
    order_shipped   : ['#0dcaf0', 'fa-solid fa-truck-fast'],
    order_delivered : ['#198754', 'bx bx-package'],
    order_cancelled : ['#dc3545', 'bx bx-x-circle'],
    delivery_update : ['#0dcaf0', 'bx bx-cycling'],
    refund_pending  : ['#ffc107', 'bx bx-time'],
    refund_approved : ['#198754', 'bx bx-check-shield'],
    refund_rejected : ['#dc3545', 'bx bx-shield-x'],
    refund_processed: ['#6f42c1', 'bx bx-money'],
    new_product     : ['#0d6efd', 'bx bx-store'],
    flash_sale      : ['#fd7e14', 'bx bx-bolt-circle'],
    payment_success : ['#198754', 'bx bx-credit-card'],
    payment_failed  : ['#dc3545', 'bx bx-error-circle'],
    general         : ['#6c757d', 'bx bx-bell'],
  };

  function getIcon(type) {
    return iconMap[type] ?? ['#6c757d', 'bx bx-bell'];
  }

  /* ── Fetch unread count for the badge ── */
  function refreshBadge() {
    fetch('/notifications/unread-count', { headers: { 'Accept': 'application/json' } })
      .then(r => r.json())
      .then(({ count }) => {
        badge.textContent = count;
        badge.style.display = count > 0 ? 'inline-flex' : 'none';
      });
  }

  /* ── Fetch latest notifications when dropdown opens ── */
  function loadDropdown() {
    if (loaded) return;
    loaded = true;

    fetch('/notifications/latest', { headers: { 'Accept': 'application/json' } })
      .then(r => r.json())
      .then(({ notifications, unread }) => {
        loading.remove();
        badge.textContent    = unread;
        badge.style.display  = unread > 0 ? 'inline-flex' : 'none';

        if (!notifications.length) {
          list.innerHTML = `<div class="text-center py-4 text-muted">
            <i class="bx bx-bell-off fs-2 d-block mb-2"></i>No notifications yet.</div>`;
          return;
        }

        list.innerHTML = notifications.map(n => {
          const [color, icon] = getIcon(n.type);
          const href = n.url ? `href="${n.url}"` : '';
          const tag  = n.url ? 'a' : 'div';
          return `
          <${tag} ${href}
            class="d-flex gap-3 px-3 py-2 border-bottom text-decoration-none text-dark
                   ${n.read ? '' : 'bg-light'}"
            style="transition: background .2s;">
            <div class="flex-shrink-0 d-flex align-items-center justify-content-center
                        rounded-circle text-white"
                 style="width:38px;height:38px;background:${color};font-size:17px;">
              <i class="${icon}"></i>
            </div>
            <div class="flex-grow-1 overflow-hidden" style="min-width:0">
              <div class="fw-semibold" style="font-size:13.5px;">${n.title}</div>
              <div class="text-muted text-truncate" style="font-size:12.5px;">${n.message}</div>
              <div class="text-secondary" style="font-size:11px;">${n.time}</div>
            </div>
          </${tag}>`;
        }).join('');
      });
  }

  /* ── Mark all read from dropdown ── */
  document.getElementById('dropdownMarkAll')?.addEventListener('click', () => {
    fetch('/profile/notifications/mark-all-read', {
      method : 'POST',
      headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
    })
    .then(() => {
      badge.textContent   = '0';
      badge.style.display = 'none';
      // remove unread highlight
      list.querySelectorAll('.bg-light').forEach(el => el.classList.remove('bg-light'));
    });
  });

  /* ── Init ── */
  refreshBadge();
  setInterval(refreshBadge, 60_000); // poll every 60 s

  document.getElementById('notifBell')?.addEventListener('click', loadDropdown);
})();
</script>
@endauth