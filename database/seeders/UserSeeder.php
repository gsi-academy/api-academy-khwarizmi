<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Admin
        $admin = User::create([
            'name' => 'Admin Khwarizmi',
            'email' => 'admin@khwarizmi.test',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');

        // 2. Buat Mentor
        $mentor = User::create([
            'name' => 'Mentor Andi',
            'email' => 'mentor@khwarizmi.test',
            'password' => Hash::make('password'),
        ]);
        $mentor->assignRole('mentor');

        // 3. Buat Student
        $student = User::create([
            'name' => 'Student Rizky',
            'email' => 'student@khwarizmi.test',
            'password' => Hash::make('password'),
        ]);
        $student->assignRole('student');
    }
}