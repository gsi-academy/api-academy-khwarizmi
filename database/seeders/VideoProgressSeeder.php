<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\LessonVideo;
use App\Models\VideoProgress;

class VideoProgressSeeder extends Seeder
{
    public function run(): void
    {
        $users  = User::all();
        $videos = LessonVideo::all();

        foreach ($users as $user) {
            foreach ($videos as $video) {
                VideoProgress::create([
                    'user_id' => $user->id,
                    'lesson_video_id' => $video->id,
                    'watched_seconds' => rand(0, $video->duration ?? 600),
                    'completed' => false,
                ]);
            }
        }
    }
}
