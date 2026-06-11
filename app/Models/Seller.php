<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Seller extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'seller';

    protected $fillable = [
        'name',
        'username',
        'email',
        'shop_name',
        'shop_slug',
        'phone',
        'password',
        'national_id',
        'gst_number',
        'pan_number',
        'shop_address',
        'municipality',
        'product_categories',
        'serial_number_type',   // 'has_sn', 'has_lot', 'auto_generate'
        'accepts_cod',
        'payment_method',       // 'bank' or 'wallet'
        'agreed_to_terms',
        'agreed_video_before_shipping',
        'agreed_qr_otp_validation',
        'agreed_returns_48hrs',
        'agreed_insurance_fund',
        'agreed_rating_penalty',
        'status',
        'is_verified',
        'phone_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_verified'                  => 'boolean',
        'email_verified_at'            => 'datetime',
        'phone_verified_at'            => 'datetime',
        'accepts_cod'                  => 'boolean',
        'agreed_to_terms'              => 'boolean',
        'agreed_video_before_shipping' => 'boolean',
        'agreed_qr_otp_validation'     => 'boolean',
        'agreed_returns_48hrs'         => 'boolean',
        'agreed_insurance_fund'        => 'boolean',
        'agreed_rating_penalty'        => 'boolean',
        'product_categories'           => 'array',
    ];

    // Status constants
    const STATUS_PENDING  = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    // Serial number type constants
    const SN_HAS_SN        = 'has_sn';
    const SN_HAS_LOT       = 'has_lot';
    const SN_AUTO_GENERATE = 'auto_generate';

    // Payment method constants
    const PAYMENT_BANK   = 'bank';
    const PAYMENT_WALLET = 'wallet';

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Helper methods for status
    public function isPending()  { return $this->status === self::STATUS_PENDING; }
    public function isApproved() { return $this->status === self::STATUS_APPROVED; }
    public function isRejected() { return $this->status === self::STATUS_REJECTED; }

    // Scope queries
    public function scopePending($query)    { return $query->where('status', self::STATUS_PENDING); }
    public function scopeApproved($query)   { return $query->where('status', self::STATUS_APPROVED); }
    public function scopeRejected($query)   { return $query->where('status', self::STATUS_REJECTED); }
    public function scopeVerified($query)   { return $query->where('is_verified', true); }
    public function scopeUnverified($query) { return $query->where('is_verified', false); }
    public function subscribers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            \App\Models\User::class,
            'seller_subscriptions',
            'seller_id',
            'user_id'
        )->withTimestamps();
    }
 
    /** Total number of listed products (used in the subscription blade). */
    public function getProductsCountAttribute(): int
    {
        return $this->products()->count();
    }
}