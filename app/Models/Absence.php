<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_in',
        'time_in',
        'time_out',
        'employment_id'
    ];

    public function employment()
    {
        return $this->belongsTo(Employment::class);
    }
}
