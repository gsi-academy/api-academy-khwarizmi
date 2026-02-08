<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Khwarizmi',
            'email' => 'admin@khwarizmi.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Mentor Andi',
            'email' => 'mentor@khwarizmi.test',
            'password' => Hash::make('password'),
            'role' => 'mentor',
        ]);

        User::create([
            'name' => 'Student Rizky',
            'email' => 'student@khwarizmi.test',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);
    }
}
