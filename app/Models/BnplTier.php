<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BnplTier extends Model
{
    protected $fillable = [
        'tier_name',
        'display_name',
        'min_score',
        'max_score',
        'limit_amount',
        'description',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'min_score' => 'integer',
        'max_score' => 'integer',
        'limit_amount' => 'decimal:2',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public static function getTierByScore($score)
    {
        return static::active()
            ->where('min_score', '<=', $score)
            ->where('max_score', '>=', $score)
            ->first();
    }
}
