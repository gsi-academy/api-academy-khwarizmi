<?php
namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Web Development','UI/UX','Backend','Mobile App'] as $name) {
            Category::create(['name' => $name]);
        }
    }
}
