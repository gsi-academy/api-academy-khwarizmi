<?php

namespace Database\Seeders;
use App\Models\Lesson;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        Lesson::create([
            'course_id' => Course::first()->id,
            'mentor_id' => User::where('role','mentor')->first()->id,
            'title' => 'Pengenalan Web',
            'description' => 'Dasar web development',
            'order' => 1,
            'whatsapp_link' => 'https://wa.me/6285161231559',
        ]);
    }
}
