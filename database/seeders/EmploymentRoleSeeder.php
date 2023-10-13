<?php

namespace Database\Seeders;

use App\Models\EmploymentRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmploymentRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmploymentRole::create([
            'name' => 'Manager',
        ]);
        EmploymentRole::create([
            'name' => 'Staff',
        ]);
    }
}
