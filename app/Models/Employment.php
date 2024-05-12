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
        'employment_role_id',
        'leave_quota',
        'no_account'
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

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    public function historyLeaves()
    {
        return $this->hasMany(HistoryLeave::class);
    }

    public function benefits()
    {
        return $this->hasMany(Benefit::class);
    }

}
