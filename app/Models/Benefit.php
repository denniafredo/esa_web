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
        'fixed_allowances',
        'meal_allowances',
        'transport_allowances',
        'overtime_allowances',
        'persenpph'
    ];

    public function employment()
    {
        return $this->belongsTo(Employment::class);
    }
}
