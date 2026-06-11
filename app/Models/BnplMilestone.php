<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BnplMilestone extends Model
{
    protected $fillable = [
        'user_id',
        'milestone_type',
        'label',
        'current_value',
        'required_value',
        'is_completed',
        'completed_at',
    ];

    protected $casts = [
        'current_value' => 'integer',
        'required_value' => 'integer',
        'is_completed' => 'boolean',
        'completed_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeCompleted($query)
    {
        return $query->where('is_completed', true);
    }

    public function scopePending($query)
    {
        return $query->where('is_completed', false);
    }

    public function getProgressPercentageAttribute()
    {
        if ($this->required_value <= 0) return 100;
        return min(100, round(($this->current_value / $this->required_value) * 100));
    }

    public function markAsCompleted()
    {
        $this->update([
            'is_completed' => true,
            'completed_at' => now(),
        ]);
    }
}
