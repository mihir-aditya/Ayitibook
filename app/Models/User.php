<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name', 'last_name', 'name', 'username', 'email', 'phone', 'password', 'status', 'last_login_at', 'last_login_ip', 'profile_pic', 'wallet_balance', 'kyc_verified',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function seller()
    {
        return $this->hasOne(Seller::class, 'user_id');
    }

    public function affiliate()
    {
        return $this->hasOne(Affiliate::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    protected static function booted()
    {
        static::created(function (User $user) {
            // Automatically create an Affiliate record for new users if not present
            if (! Affiliate::where('user_id', $user->id)->exists()) {
                // generate a unique affiliate code
                do {
                    $code = 'AFF_'.strtoupper(bin2hex(random_bytes(4)));
                } while (Affiliate::where('affiliate_code', $code)->exists());
                Affiliate::firstOrCreate([
                    'user_id' => $user->id,
                ], [
                    'affiliate_code' => $code,
                    'status' => 'active',
                    'total_earnings' => 0,
                ]);
            }
        });
    }

    public function affiliateClicks()
    {
        return $this->hasMany(AffiliateClick::class, 'customer_id');
    }

    public function customerAffiliateLocks()
    {
        return $this->hasMany(CustomerAffiliateLock::class, 'customer_id');
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class, 'customer_id');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'user_id');
    }

    public function customerProfile(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(CustomerProfile::class);
    }

    public function bnplProfile(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(BnplProfile::class);
    }

    public function bnplLoans(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BnplLoan::class);
    }

    public function bnplPayments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BnplPayment::class);
    }

    public function bnplCreditScores(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BnplCreditScore::class);
    }

    public function bnplMilestones(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BnplMilestone::class);
    }
    public function subscribedSellers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            \App\Models\Seller::class,
            'seller_subscriptions',
            'user_id',
            'seller_id'
        )->withTimestamps();
    }
 
    /** Raw pivot rows (useful if you need the subscribed_at timestamp). */
    public function sellerSubscriptions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\SellerSubscription::class);
    }
 
    /** Quick boolean — is this user subscribed to the given seller? */
    public function isSubscribedTo(\App\Models\Seller $seller): bool
    {
        return $this->sellerSubscriptions()
            ->where('seller_id', $seller->id)
            ->exists();
    }
     public function notifications(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Notification::class);
    }
 
    public function unreadNotificationsCount(): int
    {
        return $this->notifications()->whereNull('read_at')->count();
    }

}
