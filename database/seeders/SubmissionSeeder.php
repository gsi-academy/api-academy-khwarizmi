<?php

namespace Database\Seeders;

use App\Models\Submission;
use App\Models\Assignment;
use App\Models\User;
use Illuminate\Database\Seeder;

class SubmissionSeeder extends Seeder
{
   public function run(): void
{
    $student = User::role('student')->first();
    $assignment = Assignment::first();

    // Pastikan kedua data ditemukan sebelum create
    if ($student && $assignment) {
        Submission::create([
            'assignment_id' => $assignment->id,
            'user_id' => $student->id,
            'file_url' => 'submissions/demo.pdf',
            'score' => null,
        ]);
    }
}
}
