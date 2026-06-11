<?php
// app/Models/DeliveryPartnerPayout.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliveryPartnerPayout extends Model
{
    protected $table = 'delivery_partner_payouts';

    protected $fillable = [
        'delivery_partner_id',
        'payout_reference',
        'amount',
        'status',
        'payout_method',
        'bank_name',
        'account_number',
        'ifsc_code',
        'upi_id',
        'payout_details',
        'processed_at',
        'notes',
    ];

    protected $casts = [
        'processed_at' => 'datetime',
        'payout_details' => 'array',
        'amount' => 'decimal:2',
    ];

    /**
     * Get the delivery partner for this payout.
     */
    public function deliveryPartner(): BelongsTo
    {
        return $this->belongsTo(DeliveryPartner::class);
    }

    /**
     * Generate unique payout reference.
     */
    public static function generateReference()
    {
        $prefix = 'PO';
        $date = now()->format('Ymd');
        $random = strtoupper(substr(uniqid(), -6));
        
        return $prefix . $date . $random;
    }

    /**
     * Mark as processed.
     */
    public function markAsProcessed()
    {
        $this->status = 'completed';
        $this->processed_at = now();
        $this->save();
    }

    /**
     * Scope for pending payouts.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}