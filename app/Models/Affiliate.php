<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Affiliate extends Model
{
    protected $fillable = [
        'user_id',
        'affiliate_code',
        'status',
        'total_earnings',
    ];

    /**
     * Get the user that owns the affiliate.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all affiliate links for this affiliate.
     */
    public function affiliateLinks(): HasMany
    {
        return $this->hasMany(AffiliateLink::class);
    }

    /**
     * Get all affiliate clicks for this affiliate through links.
     */
    public function affiliateClicks(): HasMany
    {
        return $this->hasMany(AffiliateClick::class, 'affiliate_id');
    }

    /**
     * Get all customer affiliate locks for this affiliate.
     */
    public function customerAffiliateLocks(): HasMany
    {
        return $this->hasMany(CustomerAffiliateLock::class);
    }

    /**
     * Get all commissions for this affiliate.
     */
    public function commissions(): HasMany
    {
        return $this->hasMany(Commission::class);
    }

    /**
     * Use affiliate_code for route model binding instead of id.
     */
    public function getRouteKeyName(): string
    {
        return 'affiliate_code';
    }
}
