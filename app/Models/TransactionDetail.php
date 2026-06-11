<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $table = 'transaction_details';
    protected $primaryKey = 'sl_no';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'transaction_id',
        'user_id',
        'order_id',
        'transaction_type',
        'payment_method',
        'amount',
        'transaction_status',
        'transaction_date',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'transaction_date' => 'datetime',
    ];

    const CREATED_AT = 'transaction_date';
    const UPDATED_AT = null;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}