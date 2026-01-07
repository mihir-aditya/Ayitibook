<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'user_address';
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'mobile_number',
        'alternate_mobile_number',
        'address',
        'city',
        'postal_code',
        'address_type',
        'is_default',
        'status',
    ];

    // Relation with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}