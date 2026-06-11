<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commission extends Model
{
    protected $fillable = [
        'order_id',
        'affiliate_id',
        'customer_id',
        'amount',
        'commission_percentage',
        'status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'commission_percentage' => 'decimal:2',
    ];

    /**
     * Get the affiliate that earned this commission.
     */
    public function affiliate(): BelongsTo
    {
        return $this->belongsTo(Affiliate::class);
    }

    /**
     * Get the order associated with this commission.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the customer who made the purchase.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function link()
    {
        return $this->belongsTo(AffiliateLink::class, 'affiliate_link_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
