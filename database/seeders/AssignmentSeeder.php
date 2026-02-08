<?php

namespace Database\Seeders;
use App\Models\Assignment;
use App\Models\Lesson;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AssignmentSeeder extends Seeder
{
    public function run(): void
    {
        Assignment::create([
            'lesson_id' => Lesson::first()->id,
            'title' => 'Tugas HTML',
            'description' => 'Buat halaman HTML sederhana',
            'deadline' => Carbon::now()->addDays(7),
        ]);
    }
}
