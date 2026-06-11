<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BnplCreditScore extends Model
{
    protected $fillable = [
        'user_id',
        'score',
        'tier',
        'limit_amount',
        'reason',
        'factors',
        'calculated_at',
    ];

    protected $casts = [
        'score' => 'integer',
        'limit_amount' => 'decimal:2',
        'factors' => 'array',
        'calculated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('calculated_at', 'desc');
    }

    public function scopeByScoreRange($query, $min, $max)
    {
        return $query->whereBetween('score', [$min, $max]);
    }
}
