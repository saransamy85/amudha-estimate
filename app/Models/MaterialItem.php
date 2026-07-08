<?php

namespace App\Models;

use App\Models\customers;
use Illuminate\Database\Eloquent\Model;

class MaterialItem extends Model
{
    protected $fillable = [
        'customer_id',
        'item',
        'quantity',
        'unit',
        'description',
        'person_name',
        'from_location',
        'to_location',
        'transport_type',
        'vehicle_no',
        'transport_charge',
        'dispatch_date',
        'created_by',
    ];

    public function customer()
    {
        return $this->belongsTo(customers::class);
    }
}
