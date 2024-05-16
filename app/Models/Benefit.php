<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    use HasFactory;

    protected $fillable = [
        'employment_id',
        'basic_salary',
        'meal_allowances',
        'transport_allowances',
        'potongan_pph_21',
        'day_of_works',
        'performance_allowances',
        'leaves',
        'sick_leaves',
        'absence_leaves',
        'burden',
        'no_account',
        'periode',
        'leave_rights',
    ];

    public function employment()
    {
        return $this->belongsTo(Employment::class);
    }
}
