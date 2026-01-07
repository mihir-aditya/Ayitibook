<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $table = 'product_variants';


    /**
     * If you later add updated_at, change this to true
     */
    public $timestamps = false;

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'product_id',
        'variant_name',
        'sku',
        'price',
        'quantity',
        'images',
        'videos',
    ];

    /**
     * Attribute casting
     */
    protected $casts = [
        'price'    => 'decimal:2',
        'quantity' => 'integer',
        'images'   => 'array',   // JSON → PHP array
        'videos'   => 'array',   // JSON → PHP array
    ];

    /**
     * Relationships
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
