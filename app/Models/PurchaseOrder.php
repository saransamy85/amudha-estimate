<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'po_no',
        'company',
        'vendor_id',
        'site_id',
        'po_template',
        'po_date',
        'subtotal',
        'gst_percent',
        'gst_amount',
        'grand_total',
        'remarks',
        'created_by',
        'status'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function customer()
    {
        return $this->belongsTo(customers::class, 'site_id');
    }

    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }
}
