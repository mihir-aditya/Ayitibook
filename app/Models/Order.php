<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $primaryKey = 'sl_no';

    public $timestamps = false; // no created_at / updated_at

    protected $fillable = [
        'order_id',
        'user_id',
        'address_id',
        'payment_method',
        'total_amount',
        'order_status',
        'placed_at',
    ];

    protected $casts = [
        'placed_at' => 'datetime',
    ];

    public function items()
{
    return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
}
}