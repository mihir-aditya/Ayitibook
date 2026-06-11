<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BnplPayment extends Model
{
    protected $fillable = [
        'loan_id',
        'user_id',
        'payment_reference',
        'installment_number',
        'amount_due',
        'amount_paid',
        'late_fees',
        'status',
        'payment_method',
        'due_date',
        'paid_at',
        'days_late',
        'notes',
    ];

    protected $casts = [
        'amount_due' => 'decimal:2',
        'amount_paid' => 'decimal:2',
        'late_fees' => 'decimal:2',
        'installment_number' => 'integer',
        'days_late' => 'integer',
        'due_date' => 'datetime',
        'paid_at' => 'datetime',
    ];

    public function loan(): BelongsTo
    {
        return $this->belongsTo(BnplLoan::class, 'loan_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function scopeOverdue($query)
    {
        return $query->where('status', 'overdue');
    }

    public function isOverdue(): bool
    {
        return $this->status === 'overdue' ||
               ($this->status === 'pending' && now()->isAfter($this->due_date));
    }
}
