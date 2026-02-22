<?php

namespace App\Http\Controllers;

use App\Models\LessonProgress;
use App\Models\VideoProgress;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgressController extends Controller
{
    // --- Fungsi Pencatatan (Eksisting) ---

    public function lesson(Request $r)
    {
        return LessonProgress::updateOrCreate([
            'user_id' => $r->user()->id,
            'lesson_id' => $r->lesson_id
        ], [
            'completed' => true
        ]);
    }

    public function video(Request $r)
    {
        return VideoProgress::updateOrCreate([
            'user_id' => $r->user()->id,
            'lesson_video_id' => $r->video_id
        ], [
            'watched_seconds' => $r->seconds,
            'completed' => $r->completed
        ]);
    }

    // --- Fungsi Statistik Dashboard (Baru) ---

    public function getCategoryStats(Request $request)
    {
        $user = $request->user();

        // Mengambil kategori berdasarkan kursus yang diikuti user
        return Category::whereHas('courses.enrollments', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->get()
        ->map(function ($category) use ($user) {
            // Menghitung total lesson dalam kategori ini
            $totalLessons = DB::table('lessons')
                ->join('courses', 'lessons.course_id', '=', 'courses.id')
                ->where('courses.category_id', $category->id)
                ->count();

            // Menghitung lesson yang sudah selesai dikerjakan (completed = true)
            $watchedCount = DB::table('lesson_progress')
                ->join('lessons', 'lesson_progress.lesson_id', '=', 'lessons.id')
                ->join('courses', 'lessons.course_id', '=', 'courses.id')
                ->where('courses.category_id', $category->id)
                ->where('lesson_progress.user_id', $user->id)
                ->where('lesson_progress.completed', true)
                ->count();

            return [
                'name' => $category->name,
                'watched' => "{$watchedCount}/{$totalLessons}",
                'icon' => $this->getCategoryIcon($category->name)
            ];
        });
    }

    public function getActivityLogs(Request $request)
    {
        $user = $request->user();
        
        // Mengambil data aktivitas harian dari tabel lesson_progress selama 30 hari terakhir
        return DB::table('lesson_progress')
            ->select(
                DB::raw('DATE(created_at) as date'), 
                DB::raw('count(*) as count')
            )
            ->where('user_id', $user->id)
            ->where('completed', true)
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();
    }

    private function getCategoryIcon($name) {
        $icons = [
            'UI/UX Design' => '🎨',
            'Front End' => '💻',
            'Branding' => '📢',
            'Data' => '📊',
            'Marketing' => '📈',
            'Design' => '✨'
        ];
        return $icons[$name] ?? '📚';
    }
}