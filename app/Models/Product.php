<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
        'affiliate_percentage',
    ];

    protected $casts = [
        'can_purchase' => 'boolean',
        'show_stock_out' => 'boolean',
        'refundable' => 'boolean',
        'is_flash_sale' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'float',
        'discount_price' => 'float',
        'weight' => 'float',
        // REMOVE: 'images' => 'array', 'videos' => 'array' - We'll handle manually
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
            ->when($ignoreId, fn ($q) => $q->where('id', '<>', $ignoreId))
            ->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }

    /**
     * Get images as array (Accessor)
     */
    public function getImagesAttribute($value)
    {
        // If already array, return it
        if (is_array($value)) {
            return $value;
        }

        // If string, try to decode
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $decoded;
            }
        }

        // Return empty array if null or invalid
        return [];
    }

    /**
     * Set images (Mutator)
     */
    public function setImagesAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['images'] = json_encode($value);
        } elseif (is_string($value)) {
            // Check if it's valid JSON
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $this->attributes['images'] = $value;
            } else {
                $this->attributes['images'] = json_encode([]);
            }
        } else {
            $this->attributes['images'] = json_encode([]);
        }
    }

    /**
     * Get videos as array (Accessor)
     */
    public function getVideosAttribute($value)
    {
        // If already array, return it
        if (is_array($value)) {
            return $value;
        }

        // If string, try to decode
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $decoded;
            }
        }

        // Return empty array if null or invalid
        return [];
    }

    /**
     * Set videos (Mutator)
     */
    public function setVideosAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['videos'] = json_encode($value);
        } elseif (is_string($value)) {
            // Check if it's valid JSON
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $this->attributes['videos'] = $value;
            } else {
                $this->attributes['videos'] = json_encode([]);
            }
        } else {
            $this->attributes['videos'] = json_encode([]);
        }
    }

    // scope for searching
    public function scopeSearch($query, $term)
    {
        if (empty($term)) {
            return $query;
        }
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
        return $this->belongsTo(Seller::class);
    }

    /**
     * Get the product's category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the product's brand
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function affiliateLinks()
    {
        return $this->hasMany(AffiliateLink::class);
    }

    // Category-related scopes and methods

    /**
     * Scope for products in active categories
     */
    public function scopeInActiveCategories($query)
    {
        return $query->whereHas('category', function ($q) {
            $q->where('status', true);
        });
    }

    /**
     * Scope for products in a specific category
     */
    public function scopeInCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Scope for products in multiple categories
     */
    public function scopeInCategories($query, array $categoryIds)
    {
        return $query->whereIn('category_id', $categoryIds);
    }

    /**
     * Scope for products by category slug
     */
    public function scopeByCategorySlug($query, $slug)
    {
        return $query->whereHas('category', function ($q) use ($slug) {
            $q->where('slug', $slug)->where('status', true);
        });
    }

    /**
     * Get products with their category eager loaded
     */
    public function scopeWithCategory($query)
    {
        return $query->with('category');
    }

    /**
     * Get products with their category and parent category
     */
    public function scopeWithCategoryAndParent($query)
    {
        return $query->with(['category.parent']);
    }

    // Helper methods

    /**
     * Get all images with full URLs
     */
    public function getAllImagesAttribute()
    {
        $images = $this->images;
        $result = [];

        foreach ($images as $image) {
            if (! empty($image)) {
                $result[] = [
                    'path' => $image,
                    'url' => asset('storage/'.$image),
                ];
            }
        }

        return $result;
    }

    /**
     * Get first image URL
     */
    public function getFirstImageUrlAttribute()
    {
        $images = $this->images;
        if (! empty($images) && ! empty($images[0])) {
            return asset('storage/'.$images[0]);
        }

        return null;
    }

    /**
     * Get all video URLs
     */
    public function getAllVideosAttribute()
    {
        $videos = $this->videos;
        $result = [];

        foreach ($videos as $video) {
            if (! empty($video)) {
                $result[] = [
                    'path' => $video,
                    'url' => asset('storage/'.$video),
                ];
            }
        }

        return $result;
    }

    /**
     * Get thumbnail URL
     */
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return asset('storage/'.$this->thumbnail);
        }

        return $this->first_image_url;
    }

    /**
     * Get the final price (after discount if applicable)
     */
    public function getFinalPriceAttribute()
    {
        if ($this->discount_price && $this->discount_type) {
            if ($this->discount_type === 'percent') {
                $discountAmount = $this->price * ($this->discount_price / 100);

                return $this->price - $discountAmount;
            }

            return $this->discount_price;
        }

        return $this->price;
    }

    /**
     * Get the discount percentage
     */
    public function getDiscountPercentageAttribute()
    {
        if ($this->discount_price && $this->discount_type === 'percent') {
            return $this->discount_price;
        }

        if ($this->discount_price && $this->price > 0) {
            $discount = (($this->price - $this->discount_price) / $this->price) * 100;

            return round($discount, 2);
        }

        return 0;
    }

    /**
     * Check if product is in stock
     */
    public function getIsInStockAttribute()
    {
        return $this->stock_quantity > 0;
    }

    /**
     * Check if product is low in stock
     */
    public function getIsLowStockAttribute()
    {
        return $this->stock_quantity > 0 && $this->stock_quantity <= $this->low_stock_quantity;
    }

    /**
     * Check if product is out of stock
     */
    public function getIsOutOfStockAttribute()
    {
        return $this->stock_quantity <= 0;
    }

    /**
     * Get total stock including variants
     */
    public function getTotalStockAttribute()
    {
        $variantStock = $this->variants->sum('quantity');

        return $this->stock_quantity + $variantStock;
    }

    /**
     * Get total sales
     */
    public function getTotalSalesAttribute()
    {
        return $this->sold_count + $this->sales_count;
    }

    public function reviews()
    {
        return $this->hasMany(\App\Models\ProductReview::class)
            ->with('user')
            ->latest();
    }

    public function averageRating(): float
    {
        return round($this->reviews()->avg('rating') ?? 0, 1);
    }

    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }
}
