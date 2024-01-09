<?php

namespace Database\Seeders;

use App\Models\EmploymentDivision;
use Illuminate\Database\Seeder;

class EmploymentDivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = [
            'Production',
            'PPIC / Warehouse',
            'Quality Control (QC)',
            'Quality Assurance (QA)',
            'Research and Development (R&D)',
            'Purchasing',
            'Finance / Accounting',
            'Human Resource / Legal',
            'General Affair',
            'Machinery Engineering (ME)',
        ];

        foreach ($divisions as $division) {
            EmploymentDivision::create([
                'name' => $division,
            ]);
        }

    }
}
