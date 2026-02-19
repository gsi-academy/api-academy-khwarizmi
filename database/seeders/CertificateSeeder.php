<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CertificateSeeder extends Seeder
{
    public function run(): void
    {
        $student = User::role('student')->first();
        $course = Course::first();

        Certificate::create([
            'user_id' => $student->id,
            'course_id' => $course->id,
            'certificate_code' => 'CERT-' . strtoupper(Str::random(10)),
            'issued_at' => now(),
        ]);
    }
}
