<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialDispatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'person_name',
        'from_location',
        'to_location',
        'transport_type',
        'vehicle_no',
        'transport_charge',
        'dispatch_date',
        'user_name',
    ];

    /*
     * |--------------------------------------------------------------------------
     * | Customer
     * |--------------------------------------------------------------------------
     */

    public function customer()
    {
        return $this->belongsTo(
            customers::class,
            'customer_id'
        );
    }

    public function items()
    {
        return $this->hasMany(
            MaterialDispatchItem::class,
            'dispatch_id'
        );
    }
}
