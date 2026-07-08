<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialDispatchItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'dispatch_id',
        'item',
        'quantity',
        'unit',
        'description',
    ];

    /*
     * |--------------------------------------------------------------------------
     * | Dispatch
     * |--------------------------------------------------------------------------
     */

    public function dispatch()
    {
        return $this->belongsTo(
            MaterialDispatch::class,
            'dispatch_id'
        );
    }

    public function returnItems()
    {
        return $this->hasMany(
            MaterialReturnItem::class,
            'dispatch_item_id'
        );
    }
}
