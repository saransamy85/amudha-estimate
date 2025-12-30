<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leadfeedback extends Model
{
    use HasFactory;
    protected $fillable = [
        'lead_id',
        'feedback',
    ];

    public function lead()
    {
        return $this->belongsTo(leads::class, 'lead_id');
    }
}
