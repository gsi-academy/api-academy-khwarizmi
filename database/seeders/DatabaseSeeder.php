<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// 👇 WAJIB IMPORT SEMUA SEEDER
use Database\Seeders\UserSeeder;
use Database\Seeders\ProfileSeeder;
use Database\Seeders\SubscriptionSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\CourseMentorSeeder;
use Database\Seeders\LessonSeeder;
use Database\Seeders\LessonVideoSeeder;
use Database\Seeders\AssignmentSeeder;
use Database\Seeders\EnrollmentSeeder;
use Database\Seeders\LessonProgressSeeder;
use Database\Seeders\VideoProgressSeeder;
use Database\Seeders\SubmissionSeeder;
use Database\Seeders\CertificateSeeder;
use Database\Seeders\NotificationSeeder;
use Database\Seeders\ZoomMeetingSeeder;
use Database\Seeders\RoleSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class, // Seeder untuk membuat role Spatie
            UserSeeder::class,
            ProfileSeeder::class,
            SubscriptionSeeder::class,

            CategorySeeder::class,
            CourseSeeder::class,
            CourseMentorSeeder::class,

            LessonSeeder::class,
            LessonVideoSeeder::class,
            AssignmentSeeder::class,

            EnrollmentSeeder::class,

            LessonProgressSeeder::class,
            VideoProgressSeeder::class,
            SubmissionSeeder::class,

            CertificateSeeder::class,
            NotificationSeeder::class,
            ZoomMeetingSeeder::class,
        ]);
    }
}
