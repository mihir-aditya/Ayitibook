<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductReview extends Model
{
    protected $fillable = [
        'product_id',
        'user_id',
        'rating',
        'body',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
        'rating' => 'integer',
    ];

    /* ── Relationships ── */

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /* ── Accessors ── */

    /**
     * Returns full storage URLs for all review images.
     */
    public function getImageUrlsAttribute(): array
    {
        if (empty($this->images)) return [];

        return array_map(fn($path) => asset('storage/' . $path), $this->images);
    }

    /**
     * Rendered star string for Blade (filled + empty stars).
     */
    public function getStarsAttribute(): array
    {
        return [
            'filled' => $this->rating,
            'empty'  => 5 - $this->rating,
        ];
    }
}