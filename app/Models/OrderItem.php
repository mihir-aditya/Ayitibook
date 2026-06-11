<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $primaryKey = 'sl_no';

    public $timestamps = false;

    protected $fillable = [
        'order_item_id',
        'order_id',
        'product_id',
        'variant_id',   // stores which variant was ordered
        'size',         // stores size selected at time of order
        'quantity',
        'price',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'float',
        'variant_id' => 'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id', 'id');
    }

    public function isReviewedByUser()
    {
        return ProductReview::where('product_id', $this->product_id)
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function refundRequests()
    {
        return $this->hasMany(RefundRequest::class, 'order_item_id');
    }
     public function hasRefundRequest()
    {
        return RefundRequest::where('order_item_id', $this->sl_no)->exists();
    }
}
