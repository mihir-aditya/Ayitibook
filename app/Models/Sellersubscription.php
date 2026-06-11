<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerSubscription extends Model
{
    protected $fillable = ['user_id', 'seller_id'];

    /* ─── Relationships ─────────────────────────────────────── */

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function seller(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }
}