<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table      = 'user_address';
    protected $primaryKey = 'sl_no';
    public $incrementing  = true;
    protected $keyType    = 'int';

    protected $fillable = [
        'address_id',
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'alternate_phone_number',
        'address',
        'city',
        'state',    // FIX: was missing — checkout sends this
        'country',  // FIX: was missing — checkout sends this
        'pincode',
        'address_type',
        'is_default',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}