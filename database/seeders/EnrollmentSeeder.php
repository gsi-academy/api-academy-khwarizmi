<?php

namespace Database\Seeders;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    public function run(): void
    {
        Enrollment::create([
            'user_id' => User::role('student')->first()->id,
            'course_id' => Course::first()->id,
        ]);
    }
}
