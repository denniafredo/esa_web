<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeadOffice extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'city', 'phone'];

}
