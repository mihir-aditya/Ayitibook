<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefundRequest extends Model
{
     use HasFactory;
 
    protected $table = 'refund_requests';
 
    protected $primaryKey = 'sl_no';
 
    public $timestamps = false;

       public function getRouteKeyName(): string
    {
        return 'sl_no';
    }
 
    protected $fillable = [
        'refund_id',
        'order_id',
        'order_item_id',
        'user_id',
        'reason',
        'comments',
        'images',
        'status',
        'admin_note',       // FIX: was missing — admin decision note never persisted
        'refund_amount',    // FIX: was missing — approved amount never saved to DB
        'requested_at',
    ];
 
    protected $casts = [
        'requested_at'  => 'datetime',
        'images'        => 'array',
        'refund_amount' => 'decimal:2',
    ];
 

    
    /* =========================
       Relationships
    ========================== */

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
 
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
 
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id');
    }

}