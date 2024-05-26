<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.id',
            'password' => bcrypt('password'),
        ]);


        $user = User::create([
            'name' => 'User',
            'email' => 'user@admin.id',
            'password' => bcrypt('password'),
        ]);

    }
}
