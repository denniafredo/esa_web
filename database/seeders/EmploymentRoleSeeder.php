<?php

namespace Database\Seeders;

use App\Models\EmploymentRole;
use Illuminate\Database\Seeder;

class EmploymentRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $roles = [
            'Dept Head',
            'Supervisor (SPV)',
            'Staff',
            'Operational (Opt)',
        ];

        foreach ($roles as $role) {
            EmploymentRole::create([
                'name' => $role,
            ]);
        }
    }
}
