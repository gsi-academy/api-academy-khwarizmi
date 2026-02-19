<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseMentorSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan ada kursus dan ada user dengan role mentor
        $course = Course::first();
        
        // CARA SPATIE: Mencari user yang memiliki role 'mentor'
        $mentor = User::role('mentor')->first();

        if ($course && $mentor) {
            DB::table('course_mentors')->insert([
                'course_id' => $course->id,
                'user_id'   => $mentor->id,
            ]);
        }
    }
}