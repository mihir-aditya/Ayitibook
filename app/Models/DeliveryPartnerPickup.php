<?php
// app/Models/DeliveryPartnerPickup.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliveryPartnerPickup extends Model
{
    protected $table = 'delivery_partner_pickups';

    protected $fillable = [
        'delivery_partner_id',
        'order_sl_no',
        'seller_id',
        'status',
        'assigned_at',
        'pickup_scheduled_at',
        'picked_up_at',
        'delivered_at',
        'pickup_address',
        'delivery_address',
        'delivery_otp',
        'otp_verified',
        'notes',
        'cancellation_reason',
        'delivery_proof',
        'distance_km',
        'delivery_fee',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
        'pickup_scheduled_at' => 'datetime',
        'picked_up_at' => 'datetime',
        'delivered_at' => 'datetime',
        'otp_verified' => 'boolean',
        'delivery_proof' => 'array',
        'distance_km' => 'decimal:2',
        'delivery_fee' => 'decimal:2',
    ];

    /**
     * Get the delivery partner assigned to this pickup.
     */
    public function deliveryPartner(): BelongsTo
    {
        return $this->belongsTo(DeliveryPartner::class);
    }

    /**
     * Get the order for this pickup.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_sl_no', 'sl_no');
    }

    /**
     * Get the seller for this pickup.
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    /**
     * Check if pickup is completed.
     */
    public function isCompleted()
    {
        return $this->status === 'delivered';
    }

    /**
     * Check if OTP is valid.
     */
    public function validateOtp($otp)
    {
        return $this->delivery_otp === $otp && !$this->otp_verified;
    }

    /**
     * Mark as delivered.
     */
    public function markAsDelivered($proof = null)
    {
        $this->status = 'delivered';
        $this->delivered_at = now();
        $this->otp_verified = true;
        
        if ($proof) {
            $proofs = $this->delivery_proof ?? [];
            $proofs[] = $proof;
            $this->delivery_proof = $proofs;
        }
        
        $this->save();

        // Update delivery partner stats
        $this->deliveryPartner->increment('total_deliveries');
        $this->deliveryPartner->increment('total_earnings', $this->delivery_fee);

        // Update order status
        $this->order->update(['order_status' => 'delivered']);
    }
}