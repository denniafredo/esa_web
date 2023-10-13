<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    use HasFactory;

    public function employmentRole()
    {
        return $this->belongsTo(EmploymentRole::class);
    }

    public function employmentDivision()
    {
        return $this->belongsTo(EmploymentDivision::class);
    }

    public function employmentStatus()
    {
        return $this->belongsTo(EmploymentStatus::class);
    }
}
