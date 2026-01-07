<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefundRequest extends Model
{
    use HasFactory;

    protected $table = 'refund_requests';

    protected $primaryKey = 'sl_no';

    public $timestamps = false; // using requested_at manually

    protected $fillable = [
        'refund_id',
        'order_id',
        'order_item_id',
        'user_id',
        'reason',
        'status',
        'requested_at',
    ];

    /* =========================
       Relationships (Optional)
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
