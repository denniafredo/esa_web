<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use \Database\Seeders\EmploymentDivisionSeeder;
use \Database\Seeders\EmploymentRoleSeeder;
use \Database\Seeders\EmploymentStatusSeeder;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(EmploymentRoleSeeder::class);
        $this->call(EmploymentDivisionSeeder::class);
        $this->call(EmploymentStatusSeeder::class);
    }
}
