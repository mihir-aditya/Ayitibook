<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'address',
        'zone',
        'city',
        'state',
        'postal_code',
        'country',
        'preferred_payment',
        'delivery_preference',
        'purchase_frequency',
        'avg_order_value',
        'buyer_type',
        'monthly_estimate',
        'interest_categories',
        'id_document',
        'id_type',
        'verification_status',
        'verified_at',
        'is_complete',
    ];

    protected $casts = [
        'interest_categories' => 'array',
        'is_complete'         => 'boolean',
        'verified_at'         => 'datetime',
    ];

    /* ── Relationships ── */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /* ── Accessors ── */

    public function getIdDocumentUrlAttribute(): ?string
    {
        if (!$this->id_document) return null;
        return asset('storage/' . $this->id_document);
    }

    public function getVerificationBadgeAttribute(): array
    {
        return match($this->verification_status) {
            'verified' => ['label' => 'Verified',  'class' => 'badge-verified'],
            'rejected' => ['label' => 'Rejected',  'class' => 'badge-rejected'],
            default    => ['label' => 'Pending',   'class' => 'badge-pending'],
        };
    }

    /* ── Helpers ── */

    public function isVerified(): bool
    {
        return $this->verification_status === 'verified';
    }

    public function isPending(): bool
    {
        return $this->verification_status === 'pending';
    }

    /* ── Option lists (used in blade + controller) ── */

    public static function paymentOptions(): array
    {
        return [
            'cod'    => 'Cash on Delivery',
            'card'   => 'Credit / Debit Card',
            'wallet' => 'Mobile Wallet',
        ];
    }

    public static function deliveryOptions(): array
    {
        return [
            'standard' => 'Standard Delivery',
            'fast'     => 'Fast Delivery',
        ];
    }

    public static function frequencyOptions(): array
    {
        return [
            'daily'   => 'Daily',
            'weekly'  => 'Weekly',
            'monthly' => 'Monthly',
            'rarely'  => 'Rarely',
        ];
    }

    public static function orderValueOptions(): array
    {
        return [
            '<50'     => 'Under $50',
            '50-200'  => '$50 – $200',
            '200-500' => '$200 – $500',
            '500+'    => '$500+',
        ];
    }

    public static function monthlyEstimateOptions(): array
    {
        return [
            '<100'      => 'Under $100',
            '100-500'   => '$100 – $500',
            '500-2000'  => '$500 – $2,000',
            '2000+'     => '$2,000+',
        ];
    }

    public static function interestOptions(): array
    {
        return [
            'books'       => 'Books & Stationery',
            'electronics' => 'Electronics',
            'fashion'     => 'Fashion & Apparel',
            'food'        => 'Food & Groceries',
            'health'      => 'Health & Beauty',
            'home'        => 'Home & Living',
            'sports'      => 'Sports & Outdoors',
            'toys'        => 'Toys & Kids',
        ];
    }

    public static function idTypeOptions(): array
    {
        return [
            'national_id'      => 'National ID Card',
            'passport'         => 'Passport',
            'drivers_license'  => "Driver's License",
        ];
    }
}