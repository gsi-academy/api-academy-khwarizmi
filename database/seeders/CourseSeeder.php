<?php

namespace Database\Seeders;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::first();

        Course::create([
            'category_id' => $category->id,
            'title' => 'Fullstack Web Developer',
            'description' => 'Belajar dari nol sampai siap kerja',
            'is_premium' => true,
            'rating' => 4.8,
            'students' => 120,
        ]);
    }
}
