<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialReturnItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'return_id',
        'dispatch_item_id',
        'return_quantity',
        'description'
    ];

    public function materialReturn()
    {
        return $this->belongsTo(MaterialReturn::class, 'return_id');
    }

    public function dispatchItem()
    {
        return $this->belongsTo(MaterialDispatchItem::class, 'dispatch_item_id');
    }
}
