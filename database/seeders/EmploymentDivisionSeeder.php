<?php

namespace Database\Seeders;

use App\Models\EmploymentDivision;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmploymentDivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmploymentDivision::create([
            'name' => 'Finance',
        ]);
    }
}
