<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leads extends Model
{
    use HasFactory;

    protected $table = 'leads';
    protected $fillable = [
        'source',
        'Name',
        'Mobile',
        'email',
        'Total_Area',
        'Product',
        'Description',
        'Site_location',
        'Status',
    ];

    public function feedbacks()
    {
        return $this->hasMany(leadfeedback::class, 'lead_id');
    }
}
