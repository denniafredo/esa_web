<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentDivision extends Model
{
    use HasFactory;

    public function employments()
    {
        return $this->hasMany(Employment::class);
    }
}
