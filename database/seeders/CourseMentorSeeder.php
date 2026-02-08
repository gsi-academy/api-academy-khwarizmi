<?php
namespace Database\Seeders;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CourseMentorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('course_mentors')->insert([
            'course_id' => Course::first()->id,
            'user_id' => User::where('role','mentor')->first()->id,
        ]);
    }
}
