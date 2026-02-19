<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan Anda mengimpor Spatie\Permission\Models\Role di atas
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'mentor']);
        Role::create(['name' => 'student']);
    }
}