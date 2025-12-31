<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\leads;


class leadfeedback extends Model
{
    use HasFactory;

    protected $table = 'leadfeedbacks';
    protected $fillable = [
        'lead_id',
        'feedback',
    ];

    public function lead()
    {
        return $this->belongsTo(leads::class, 'lead_id');
    }
}
