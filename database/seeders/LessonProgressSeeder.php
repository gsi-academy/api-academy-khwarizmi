<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\LessonProgress;
use App\Models\VideoProgress;
use App\Models\User;
use Illuminate\Database\Seeder;

class LessonProgressSeeder extends Seeder
{
    public function run(): void
    {
        $student = User::where('role', 'student')->first();
        $lesson  = Lesson::with('videos')->first();

        // progress per lesson
        LessonProgress::create([
            'user_id' => $student->id,
            'lesson_id' => $lesson->id,
            'completed' => false,
        ]);

        // progress per video (TANPA lesson_progress_id)
        foreach ($lesson->videos as $video) {
            VideoProgress::create([
                'user_id' => $student->id,
                'lesson_video_id' => $video->id,
                'watched_seconds' => 0,
                'completed' => false,
            ]);
        }
    }
}
