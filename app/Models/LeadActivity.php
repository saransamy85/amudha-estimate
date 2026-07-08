<?php

namespace App\Models;

use App\Models\leads;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'activity_type',
        'description'
    ];

    public function lead()
    {
        return $this->belongsTo(leads::class, 'lead_id');
    }
}
