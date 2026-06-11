<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AffiliateClick extends Model
{
    protected $fillable = [
        'affiliate_link_id',
        'affiliate_id',
        'customer_id',
        'click_timestamp',
        'status',
    ];

    protected $casts = [
        'click_timestamp' => 'datetime',
    ];

    /**
     * Get the affiliate link that was clicked.
     */
    public function affiliateLink(): BelongsTo
    {
        return $this->belongsTo(AffiliateLink::class);
    }

    /**
     * Get the affiliate associated with this click.
     */
    public function affiliate(): BelongsTo
    {
        return $this->belongsTo(Affiliate::class);
    }

    /**
     * Get the customer who clicked the link.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
