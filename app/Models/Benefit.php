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
        'persenpph',
        'day_of_works',
        'performance_allowances',
        'leaves',
        'sick_leaves',
        'absence_leaves',
        'burden',
        'no_account',
        'periode',
    ];

    public function employment()
    {
        return $this->belongsTo(Employment::class);
    }
}
