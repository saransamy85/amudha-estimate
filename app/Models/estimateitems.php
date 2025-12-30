<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estimateitems extends Model
{
    use HasFactory;
    protected $fillable = [
        'estimate_id',
        'location',
        'area',
        'rate',
        'value',
    ];

}
