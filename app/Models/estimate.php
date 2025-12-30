<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estimate extends Model
{
    use HasFactory;
    protected $fillable = [
        'estimate_no',
        'estimate_date',
        'customer_name',
        'customer_address',
        'mobile',
        'description',
        'subtotal',
        'gst_percent',
        'gst_amount',
        'net_total',
        'estimatedby',
    ];

    public function items()
    {
        return $this->hasMany(estimateitems::class);
    }
}
