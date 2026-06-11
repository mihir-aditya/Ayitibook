<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

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

    /**
     * Get the product that owns the variant
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get all images with full URLs
     */
    public function getAllImagesAttribute()
    {
        $images = $this->images;
        $result = [];
        
        foreach ($images as $image) {
            if (!empty($image)) {
                $result[] = [
                    'path' => $image,
                    'url' => asset('storage/' . $image)
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
        if (!empty($images) && !empty($images[0])) {
            return asset('storage/' . $images[0]);
        }
        return null;
    }
}