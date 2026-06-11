<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BnplLoan extends Model
{
    protected $fillable = [
        'user_id',
        'order_id',
        'loan_number',
        'product_title',
        'loan_amount',
        'total_installments',
        'paid_installments',
        'installment_amount',
        'remaining_amount',
        'paid_amount',
        'status',
        'loan_date',
        'next_payment_due',
        'completed_at',
        'interest_rate',
        'late_fees',
        'notes',
    ];

    protected $casts = [
        'loan_amount' => 'decimal:2',
        'installment_amount' => 'decimal:2',
        'remaining_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'interest_rate' => 'decimal:2',
        'late_fees' => 'decimal:2',
        'total_installments' => 'integer',
        'paid_installments' => 'integer',
        'loan_date' => 'datetime',
        'next_payment_due' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(BnplPayment::class, 'loan_id');
    }

    public function getNextPaymentAttribute()
    {
        return $this->payments()->where('status', 'pending')->orderBy('due_date')->first();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}
