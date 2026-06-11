<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerAffiliateLock extends Model
{
    protected $fillable = [
        'customer_id',
        'product_id',   // ✅ added
        'affiliate_id',
        'locked_until',
    ];

    protected $casts = [
        'locked_until' => 'datetime',
    ];

    /**
     * Customer who clicked
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * Product that is locked
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Affiliate who owns the lock
     */
    public function affiliate(): BelongsTo
    {
        return $this->belongsTo(Affiliate::class);
    }

    /**
     * Check if lock is still active
     */
    public function isActive(): bool
    {
        return $this->locked_until > now();
    }
}