<?php

/*
|──────────────────────────────────────────────────────────────────────────────
| app/helpers.php   (register in composer.json autoload.files if not already)
|
|   "autoload": {
|       "files": ["app/helpers.php"]
|   }
|
| Then run:  composer dump-autoload
|──────────────────────────────────────────────────────────────────────────────
*/

if (! function_exists('notifStyle')) {
    /**
     * Returns [accentColor, iconBgColor, fontawesomeClass] for a notification type.
     * Used in the blade template via:   [$accent, $iconBg, $icon] = notifStyle($type);
     */
    function notifStyle(string $type): array
    {
        return match ($type) {
            'order_placed'     => ['#0d6efd', '#0d6efd', 'bx bx-cart-add'],
            'order_confirmed'  => ['#198754', '#198754', 'bx bx-check-circle'],
            'order_shipped'    => ['#0dcaf0', '#0dcaf0', 'fa-solid fa-truck-fast'],
            'order_delivered'  => ['#198754', '#198754', 'bx bx-package'],
            'order_cancelled'  => ['#dc3545', '#dc3545', 'bx bx-x-circle'],
            'order_refunded'   => ['#6f42c1', '#6f42c1', 'bx bx-revision'],
            'delivery_update'  => ['#0dcaf0', '#0dcaf0', 'bx bx-cycling'],
            'refund_pending'   => ['#ffc107', '#ffc107', 'bx bx-time'],
            'refund_approved'  => ['#198754', '#198754', 'bx bx-check-shield'],
            'refund_rejected'  => ['#dc3545', '#dc3545', 'bx bx-shield-x'],
            'refund_processed' => ['#6f42c1', '#6f42c1', 'bx bx-money'],
            'new_product'      => ['#0d6efd', '#0d6efd', 'bx bx-store'],
            'flash_sale'       => ['#fd7e14', '#fd7e14', 'bx bx-bolt-circle'],
            'payment_success'  => ['#198754', '#198754', 'bx bx-credit-card'],
            'payment_failed'   => ['#dc3545', '#dc3545', 'bx bx-error-circle'],
            default            => ['#6c757d', '#6c757d', 'bx bx-bell'],
        };
    }
}