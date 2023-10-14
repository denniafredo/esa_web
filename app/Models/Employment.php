<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'type_of_blood',
        'nik',
        'email',
        'phone',
        'religion',
        'country',
        'region',
        'zip_code',
        'address',
        'image_path',
        'date_start_of_work',
        'employment_status_id',
        'employment_division_id',
        'employment_role_id'
    ];

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
