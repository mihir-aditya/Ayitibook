<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table      = 'orders';
    protected $primaryKey = 'sl_no';
    public $timestamps    = false;

    protected $fillable = [
        'order_id',
        'user_id',
        'address_id',
        'seller_id',
        'payment_method',
        'total_amount',
        'tax',
        'shipping_fee',
        // Billing
        'billing_name',
        'billing_phone',
        'billing_email',
        'billing_address',
        'billing_city',
        'billing_state',
        'billing_country',
        'billing_zip',
        // Shipping
        'shipping_name',
        'shipping_phone',
        'shipping_address',
        'shipping_city',
        'shipping_state',
        'shipping_country',
        'shipping_zip',
        'order_status',
        'placed_at',
        'coupon_code',
        'discount_amount',
    ];

    protected $casts = [
        'placed_at'    => 'datetime',
        'order_status' => 'string',
        'tax'             => 'float',
        'shipping_fee'    => 'float',
        'total_amount'    => 'float',
        'discount_amount' => 'float',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id', 'sl_no');
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class, 'order_id');
    }

    public function deliveryPartnerPickup()
    {
        return $this->hasOne(DeliveryPartnerPickup::class, 'order_sl_no', 'sl_no');
    }

    public function deliveryPartner()
    {
        return $this->belongsTo(DeliveryPartner::class, 'delivery_partner_id');
    }

    public function isAssignedForDelivery()
    {
        return $this->deliveryPartnerPickup()->exists();
    }


}