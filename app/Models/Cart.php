<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'variant_id',
        'size',
        'quantity'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the cart item
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the product variant
     */
    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    /**
     * Calculate subtotal for this cart item
     */
    public function getSubtotalAttribute()
    {
        $price = $this->variant_id 
            ? $this->variant->price 
            : ($this->product->final_price ?? $this->product->price ?? 0);
        
        return $price * $this->quantity;
    }

    /**
     * Get cart item display name with variant info
     */
    public function getDisplayNameAttribute()
    {
        $name = $this->product->name;
        
        if ($this->variant) {
            $name .= ' - ' . $this->variant->variant_name;
        }
        
        if ($this->size) {
            $name .= ' (Size: ' . $this->size . ')';
        }
        
        return $name;
    }

    /**
     * Scope to get cart items for a user
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}