<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'coverImage',
        'namaKonten',
        'konten',
        'contentName',
        'content',
        'urutan',
    ];

}
