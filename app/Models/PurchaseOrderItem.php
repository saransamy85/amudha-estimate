<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_order_id',
        'material',
        'size',
        'width',
        'color',
        'dia',
        'length',
        'thickness',
        'nos',
        'qty',
        'unit',
        'approx_weight',
        'rate',
        'amount',
        'description'
    ];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
}
