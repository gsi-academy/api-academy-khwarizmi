<?php

namespace Database\Seeders;
use App\Models\LessonVideo;
use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonVideoSeeder extends Seeder
{
    public function run(): void
    {
        LessonVideo::create([
            'lesson_id' => Lesson::first()->id,
            'title' => 'Intro HTML',
            'youtube_url' => 'https://youtube.com/watch?v=dQw4w9WgXcQ',
            'duration' => 600,
            'order' => 1,
        ]);
    }
}
