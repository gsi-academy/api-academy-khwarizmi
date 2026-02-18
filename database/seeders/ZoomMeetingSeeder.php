<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ZoomMeeting;
use App\Models\Course;

class ZoomMeetingSeeder extends Seeder
{
    public function run(): void
    {
        $course = Course::first();

        if (!$course) {
            return;
        }

        ZoomMeeting::create([
            'course_id' => $course->id,
            'title' => 'Introduction to Laravel',
            'mentor_name' => 'Rizky Herdiansyah',
            'scheduled_at' => now()->addDays(2),
            'zoom_link' => 'https://zoom.us/j/123456789',
            'meeting_id' => '123456789',
            'passcode' => '123456',
        ]);

        ZoomMeeting::create([
            'course_id' => $course->id,
            'title' => 'Advanced Eloquent',
            'mentor_name' => 'Rizky Herdiansyah',
            'scheduled_at' => now()->addDays(5),
            'zoom_link' => 'https://zoom.us/j/987654321',
            'meeting_id' => '987654321',
            'passcode' => '654321',
        ]);
    }
}
