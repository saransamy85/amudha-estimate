<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'return_no',
        'customer_id',
        'person_name',
        'vehicle_no',
        'transport_type',
        'transport_charge',
        'return_date',
        'remarks',
        'user_name'
    ];

    public function customer()
    {
        return $this->belongsTo(customers::class, 'customer_id');
    }

    public function items()
    {
        return $this->hasMany(MaterialReturnItem::class, 'return_id');
    }
}
