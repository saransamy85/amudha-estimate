<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customers extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'Mobile',
        'Location',
        'Area',
        'Product',
        'Total_values',
        'status',
    ];

    public function materialItems()
    {
        return $this->hasMany(MaterialItem::class);
    }

    public function materialDispatches()
    {
        return $this->hasMany(MaterialDispatch::class, 'customer_id');
    }

    public function materialReturns()
    {
        return $this->hasMany(MaterialReturn::class, 'customer_id');
    }
}
