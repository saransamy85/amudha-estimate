<?php

namespace App\Models;

use App\Models\LeadActivity;
use App\Models\leadfeedback;
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

    public function activities()
    {
        return $this->hasMany(LeadActivity::class, 'lead_id');
    }
}
