<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Seller;
use Illuminate\Support\Facades\DB;

/**
 * Central notification service.
 *
 * Usage from any controller:
 *   app(NotificationService::class)->orderPlaced($order);
 *   app(NotificationService::class)->newProduct($product, $seller);
 *   // etc.
 */
class NotificationService
{
    /* ══════════════════════════════════════════════════════════
       PRIVATE HELPER
    ══════════════════════════════════════════════════════════ */

    private function create(int $userId, string $type, string $title, string $message, array $data = []): void
    {
        Notification::create([
            'user_id' => $userId,
            'type'    => $type,
            'title'   => $title,
            'message' => $message,
            'data'    => $data ?: null,
        ]);
    }

    /* ══════════════════════════════════════════════════════════
       ORDER NOTIFICATIONS
    ══════════════════════════════════════════════════════════ */

    public function orderPlaced($order): void
    {
        $this->create(
            $order->user_id,
            'order_placed',
            'Order Placed Successfully',
            "Your order #{$order->order_id} has been placed. We'll confirm it shortly.",
            ['url' => "/orders/{$order->order_id}", 'order_id' => $order->sl_no]
        );
    }

    public function orderConfirmed($order): void
    {
        $this->create(
            $order->user_id,
            'order_confirmed',
            'Order Confirmed',
            "Great news! Your order #{$order->order_id} has been confirmed by the seller.",
            ['url' => "/orders/{$order->order_id}", 'order_id' => $order->sl_no]
        );
    }

    public function orderShipped($order, ?string $trackingInfo = null): void
    {
        $msg = "Your order #{$order->order_id} is on its way!";
        if ($trackingInfo) {
            $msg .= " Tracking: {$trackingInfo}";
        }

        $this->create(
            $order->user_id,
            'order_shipped',
            'Your Order Has Been Shipped',
            $msg,
            ['url' => "/orders/{$order->order_id}", 'order_id' => $order->sl_no]
        );
    }

    public function orderDelivered($order): void
    {
        $this->create(
            $order->user_id,
            'order_delivered',
            'Order Delivered',
            "Your order #{$order->order_id} has been delivered. Enjoy! Leave a review to help others.",
            ['url' => "/orders/{$order->order_id}", 'order_id' => $order->sl_no]
        );
    }

    public function orderCancelled($order, string $cancelledBy = 'system'): void
    {
        $this->create(
            $order->user_id,
            'order_cancelled',
            'Order Cancelled',
            "Your order #{$order->order_id} has been cancelled" . ($cancelledBy !== 'system' ? " by the {$cancelledBy}" : '') . '.',
            ['url' => "/orders/{$order->order_id}", 'order_id' => $order->sl_no]
        );
    }

    /* ══════════════════════════════════════════════════════════
       DELIVERY NOTIFICATIONS
    ══════════════════════════════════════════════════════════ */

    public function deliveryUpdate($order, string $statusLabel): void
    {
        $this->create(
            $order->user_id,
            'delivery_update',
            'Delivery Update',
            "Your order #{$order->order_id} status: {$statusLabel}.",
            ['url' => "/orders/{$order->order_id}", 'order_id' => $order->sl_no]
        );
    }

    /* ══════════════════════════════════════════════════════════
       REFUND NOTIFICATIONS
    ══════════════════════════════════════════════════════════ */

    public function refundRequested($refund): void
    {
        if (! $refund->user_id) return;

        $this->create(
            $refund->user_id,
            'refund_pending',
            'Refund Request Received',
            "We've received your refund request #{$refund->refund_id}. It is under review.",
            ['url' => "/profile/return", 'refund_id' => $refund->sl_no]
        );
    }

    public function refundStatusChanged($refund, string $newStatus): void
    {
        if (! $refund->user_id) return;

        $map = [
            'approved' => [
                'type'  => 'refund_approved',
                'title' => 'Refund Approved ✅',
                'msg'   => "Your refund request #{$refund->refund_id} has been approved. Amount will be credited to your wallet.",
            ],
            'rejected' => [
                'type'  => 'refund_rejected',
                'title' => 'Refund Request Rejected',
                'msg'   => "Unfortunately, your refund request #{$refund->refund_id} has been rejected.",
            ],
            'refunded' => [
                'type'  => 'refund_processed',
                'title' => 'Refund Processed 💸',
                'msg'   => "Your refund for request #{$refund->refund_id} has been processed and credited to your wallet.",
            ],
            'pending' => [
                'type'  => 'refund_pending',
                'title' => 'Refund Under Review',
                'msg'   => "Your refund request #{$refund->refund_id} is pending review.",
            ],
        ];

        $info = $map[$newStatus] ?? [
            'type'  => 'general',
            'title' => 'Refund Update',
            'msg'   => "Your refund #{$refund->refund_id} status changed to {$newStatus}.",
        ];

        $this->create(
            $refund->user_id,
            $info['type'],
            $info['title'],
            $info['msg'],
            ['url' => "/profile/return", 'refund_id' => $refund->sl_no]
        );
    }

    /* ══════════════════════════════════════════════════════════
       NEW PRODUCT — notify all subscribers of the seller
    ══════════════════════════════════════════════════════════ */

    public function newProduct($product, $seller): void
    {
        // Get all user IDs subscribed to this seller
        $subscriberIds = DB::table('seller_subscriptions')
            ->where('seller_id', $seller->id)
            ->pluck('user_id');

        if ($subscriberIds->isEmpty()) return;

        $now  = now();
        $rows = $subscriberIds->map(fn ($uid) => [
            'user_id'    => $uid,
            'type'       => 'new_product',
            'title'      => "New Product from {$seller->shop_name}",
            'message'    => "{$seller->shop_name} just added a new product: {$product->name}. Check it out before it sells out!",
            'data'       => json_encode([
                'url'        => "/product-detail/{$product->slug}",
                'product_id' => $product->id,
                'seller_id'  => $seller->id,
            ]),
            'read_at'    => null,
            'created_at' => $now,
            'updated_at' => $now,
        ])->toArray();

        // Bulk insert for performance (hundreds of subscribers)
        foreach (array_chunk($rows, 500) as $chunk) {
            DB::table('notifications')->insert($chunk);
        }
    }

    /* ══════════════════════════════════════════════════════════
       FLASH SALE — notify all subscribers of the seller
    ══════════════════════════════════════════════════════════ */

    public function flashSale($product, $seller): void
    {
        $subscriberIds = DB::table('seller_subscriptions')
            ->where('seller_id', $seller->id)
            ->pluck('user_id');

        if ($subscriberIds->isEmpty()) return;

        $now      = now();
        $discount = $product->flash_sale_discount ?? null;
        $suffix   = $discount ? " — {$discount}% OFF!" : '!';

        $rows = $subscriberIds->map(fn ($uid) => [
            'user_id'    => $uid,
            'type'       => 'flash_sale',
            'title'      => "⚡ Flash Sale by {$seller->shop_name}",
            'message'    => "Hurry! {$seller->shop_name} launched a flash sale on {$product->name}{$suffix} Limited stock.",
            'data'       => json_encode([
                'url'        => "/product-detail/{$product->slug}",
                'product_id' => $product->id,
                'seller_id'  => $seller->id,
            ]),
            'read_at'    => null,
            'created_at' => $now,
            'updated_at' => $now,
        ])->toArray();

        foreach (array_chunk($rows, 500) as $chunk) {
            DB::table('notifications')->insert($chunk);
        }
    }

    /* ══════════════════════════════════════════════════════════
       PAYMENT NOTIFICATIONS
    ══════════════════════════════════════════════════════════ */

    public function paymentSuccess(int $userId, float $amount, string $purpose = 'purchase'): void
    {
        $this->create(
            $userId,
            'payment_success',
            'Payment Successful',
            '₹' . number_format($amount, 2) . " has been deducted from your wallet for your {$purpose}.",
            []
        );
    }

    public function paymentFailed(int $userId, float $amount): void
    {
        $this->create(
            $userId,
            'payment_failed',
            'Payment Failed',
            'Your payment of ₹' . number_format($amount, 2) . ' could not be processed. Please retry with a valid method.',
            []
        );
    }

    /* ══════════════════════════════════════════════════════════
       WALLET / REFUND CREDIT
    ══════════════════════════════════════════════════════════ */

    public function walletCredited(int $userId, float $amount, string $reason = 'refund'): void
    {
        $this->create(
            $userId,
            'refund_processed',
            'Wallet Credited 💰',
            '₹' . number_format($amount, 2) . " has been credited to your wallet ({$reason}).",
            []
        );
    }

    /* ══════════════════════════════════════════════════════════
       GENERAL / CUSTOM
    ══════════════════════════════════════════════════════════ */

    public function general(int $userId, string $title, string $message, array $data = []): void
    {
        $this->create($userId, 'general', $title, $message, $data);
    }
}