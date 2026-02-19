<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan Course sudah di-seed sebelumnya
        $course = Course::first();
        
        // Cari user yang memiliki ROLE mentor via Spatie
        $mentor = User::role('mentor')->first();

        if ($course && $mentor) {
            Lesson::create([
                'course_id' => $course->id,
                'mentor_id' => $mentor->id, // Pakai variabel $mentor yang sudah dicari
                'title' => 'Pengenalan Web',
                'description' => 'Dasar web development',
                'order' => 1,
                'whatsapp_link' => 'https://wa.me/6285161231559',
            ]);
        } else {
            // Opsional: Kasih warning kalau data pendukung belum ada
            $this->command->error("Gagal seeding Lesson: Course atau Mentor tidak ditemukan.");
        }
    }
}