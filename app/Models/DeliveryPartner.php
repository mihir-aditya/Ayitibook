<?php
// app/Models/DeliveryPartner.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\HasDeliveryBadge;


class DeliveryPartner extends Authenticatable
{
    use HasDeliveryBadge;
    use HasFactory, Notifiable;

    protected $guard = 'delivery_partner';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'avatar', // <-- ADD THIS LINE
        'vehicle_type',
        'vehicle_number',
        'license_number',
        'address',
        'city',
        'state',
        'pincode',
        'latitude',
        'longitude',
        'status',
        'verification_status',
        'is_online',
        'current_location',
        'total_earnings',
        'available_balance',
        'rating',
        'total_deliveries',
        'documents_verified_at',
        // Badge system columns
        'deposit_amount',
        'success_rate',
        'major_warnings',
        'max_cod_value',
        'badge_tier',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_online' => 'boolean',
        'documents_verified_at' => 'datetime',
        'total_earnings' => 'decimal:2',
        'available_balance' => 'decimal:2',
        'rating' => 'decimal:1',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        // Badge system columns
        'deposit_amount' => 'decimal:2',
        'success_rate' => 'decimal:2',
        'major_warnings' => 'integer',
        'max_cod_value' => 'decimal:2',
    ];

    // Status constants
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_SUSPENDED = 'suspended';

    // Verification status constants
    const VERIFICATION_PENDING = 'pending';
    const VERIFICATION_VERIFIED = 'verified';
    const VERIFICATION_REJECTED = 'rejected';

    // Vehicle types
    const VEHICLE_BIKE = 'bike';
    const VEHICLE_SCOOTER = 'scooter';
    const VEHICLE_CAR = 'car';

    public function pickups()
    {
        return $this->hasMany(DeliveryPartnerPickup::class);
    }

    public function payouts()
    {
        return $this->hasMany(DeliveryPartnerPayout::class);
    }

    /**
     * Get active pickups (assigned, picked up, or in transit)
     */
    public function activePickups()
    {
        return $this->pickups()->whereIn('status', ['assigned', 'picked_up', 'in_transit']);
    }

    /**
     * Check if partner is available for new pickups
     */
    public function isAvailable()
    {
        return $this->isActive() && $this->isOnline() && $this->activePickups()->count() < 3; // Max 3 active pickups at a time
    }

    public function isVerified()
    {
        return $this->verification_status === self::VERIFICATION_VERIFIED;
    }

    public function isActive()
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isOnline()
    {
        return $this->is_online;
    }
}