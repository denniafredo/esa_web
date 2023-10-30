<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryLeave extends Model
{
    use HasFactory;

    protected $fillable = [
        'employment_id',
        'date_leave',
        'reason'
    ];

    public function employment()
    {
        return $this->belongsTo(Employment::class);
    }

}
