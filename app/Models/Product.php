<?php

namespace App\Models;
use App\Models\ProductVariant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

   protected $fillable = [
    'seller_id',
    'name',
    'slug',
    'sku',
    'description',
    'category_id',
    'brand_id',
    'can_purchase',
    'show_stock_out',
    'maximum_purchase_quantity',
    'low_stock_quantity',
    'refundable',
    'price',
    'currency',
    'discount_price',
    'discount_type',
    'stock_quantity',
    'sold_count',
    'thumbnail',
    'images',
    'videos',
    'is_flash_sale',
    'sales_count',
    'weight',
    'length',
    'width',
    'height',
    'meta_title',
    'meta_keywords',
    'meta_description',
    'is_active',
];

    protected $casts = [
    'can_purchase'   => 'boolean',
    'show_stock_out' => 'boolean',
    'refundable'     => 'boolean',
    'is_flash_sale'  => 'boolean',
    'is_active'      => 'boolean',
    'images'         => 'array',
    'videos'         => 'array',
    'price'          => 'decimal:2',
    'discount_price' => 'decimal:2',
    'weight'         => 'decimal:2',
];


    // Generate slug automatically if not provided
    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = static::uniqueSlug($product->name);
            }
        });

        static::updating(function ($product) {
            // Only update slug if name changed and slug is empty or matches previous slug pattern
            if ($product->isDirty('name') && empty($product->slug)) {
                $product->slug = static::uniqueSlug($product->name, $product->id);
            }
        });
    }

    public static function uniqueSlug($name, $ignoreId = null)
    {
        $base = Str::slug($name);
        $slug = $base;
        $i = 1;
        while (static::where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '<>', $ignoreId))
            ->exists()) {
            $slug = $base . '-' . $i++;
        }
        return $slug;
    }

    // scope for searching
    public function scopeSearch($query, $term)
    {
        if (empty($term)) return $query;
        $term = "%{$term}%";
        return $query->where(function ($q) use ($term) {
            $q->where('name', 'like', $term)
              ->orWhere('description', 'like', $term)
              ->orWhere('sku', 'like', $term)
              ->orWhere('slug', 'like', $term);
        });
    }

       public function wishlist()
    {
        return $this->hasMany(Wishlist::class, 'product_id');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }

    public function seller()
{
    return $this->belongsTo(\App\Models\Seller::class);
}

// app/Models/Product.php

public function orderItems()
{
    return $this->hasMany(OrderItem::class, 'product_id', 'id');
}

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

}
