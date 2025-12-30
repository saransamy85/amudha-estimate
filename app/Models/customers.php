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

    ];
}
