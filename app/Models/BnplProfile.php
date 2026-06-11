<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BnplProfile extends Model
{
    protected $fillable = [
        'user_id',
        'is_eligible',
        'is_enabled',
        'credit_score',
        'current_limit',
        'available_limit',
        'used_limit',
        'tier',
        'total_loans',
        'completed_loans',
        'active_loans',
        'total_borrowed',
        'total_repaid',
        'outstanding_amount',
        'on_time_payments',
        'late_payments',
        'missed_payments',
        'last_payment_date',
        'eligibility_checked_at',
        'milestone_progress',
    ];

    protected $casts = [
        'is_eligible' => 'boolean',
        'is_enabled' => 'boolean',
        'credit_score' => 'integer',
        'current_limit' => 'decimal:2',
        'available_limit' => 'decimal:2',
        'used_limit' => 'decimal:2',
        'total_borrowed' => 'decimal:2',
        'total_repaid' => 'decimal:2',
        'outstanding_amount' => 'decimal:2',
        'total_loans' => 'integer',
        'completed_loans' => 'integer',
        'active_loans' => 'integer',
        'on_time_payments' => 'integer',
        'late_payments' => 'integer',
        'missed_payments' => 'integer',
        'last_payment_date' => 'datetime',
        'eligibility_checked_at' => 'datetime',
        'milestone_progress' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function loans(): HasMany
    {
        return $this->hasMany(BnplLoan::class, 'user_id', 'user_id');
    }

    public function creditScores(): HasMany
    {
        return $this->hasMany(BnplCreditScore::class, 'user_id', 'user_id');
    }

    public function milestones(): HasMany
    {
        return $this->hasMany(BnplMilestone::class, 'user_id', 'user_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(BnplPayment::class, 'user_id', 'user_id');
    }
}
