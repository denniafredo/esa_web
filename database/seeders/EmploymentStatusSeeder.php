<?php

namespace Database\Seeders;

use App\Models\EmploymentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmploymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmploymentStatus::create([
            'name' => 'Magang',
            'leave_quota' => 0,
        ]);
        EmploymentStatus::create([
            'name' => 'Kontrak',
            'leave_quota' => 3,
        ]);
        EmploymentStatus::create([
            'name' => 'Tetap',
            'leave_quota' => 12,
        ]);
    }
}
