<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    use HasFactory;

    protected $table      = 'wallet_transactions';
    protected $primaryKey = 'sl_no';
    public $incrementing  = true;
    protected $keyType    = 'int';

    /*
     * FIX: wallet_transactions is an append-only audit log.
     * It has created_at but almost certainly NOT updated_at.
     * Without this, Eloquent::create() tries to write updated_at → SQL error
     * inside a DB transaction → silent rollback → nothing saves.
     */
    public $timestamps = false;

    protected $fillable = [
        'transaction_id',
        'user_id',
        'amount',
        'transaction_type',
        'purpose',
        'balance_after',
        'created_at',       // we set this manually on insert
    ];

    protected $casts = [
        'amount'       => 'decimal:2',
        'balance_after'=> 'decimal:2',
        'created_at'   => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}