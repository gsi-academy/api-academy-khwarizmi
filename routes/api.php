<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ZoomMeetingController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\AdminStatsController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Memberikan respons user beserta roles-nya untuk frontend
   Route::get('/me', function (Request $request) {
        // Load relasi 'profile' agar ikut masuk ke dalam JSON
        $user = $request->user()->load('profile'); 

        return response()->json([
            'user' => $user,
            'roles' => $user->getRoleNames(),
            'permissions' => $user->getAllPermissions()->pluck('name'),
        ]);
    });
    /*
    |--------------------------------------------------------------------------
    | Admin & Mentor Routes (Manajemen Konten)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin|mentor')->group(function () {
        Route::apiResource('courses', CourseController::class)->except(['index', 'show']);
        Route::apiResource('lessons', LessonController::class)->except(['index', 'show']);
        Route::apiResource('categories', CategoryController::class)->except(['index', 'show']);
        Route::apiResource('zoom-meetings', ZoomMeetingController::class);
        Route::apiResource('coupons', CouponController::class);
        Route::post('coupons/validate', [CouponController::class, 'validateCoupon']);
    });

    /*
    |--------------------------------------------------------------------------
    | Student & Public Access (Melihat Konten)
    |--------------------------------------------------------------------------
    */
    Route::prefix('student')->group(function () {
        // Mengambil statistik progress per kategori
        Route::get('/category-stats', [ProgressController::class, 'getCategoryStats']);
        
        // Mengambil data grafik aktivitas belajar (misal 30 hari terakhir)
        Route::get('/learning-activity', [ProgressController::class, 'getActivityLogs']);
        
        // Mengambil daftar mentor yang berhubungan dengan kursus user
        Route::get('/my-mentors', [ProfileController::class, 'getMyMentors']);
    });

    Route::get('courses', [CourseController::class, 'index']);
    Route::get('courses/{course}', [CourseController::class, 'show']);
    Route::get('lessons', [LessonController::class, 'index']);
    Route::get('lessons/{lesson}', [LessonController::class, 'show']);
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categories/{category}', [CategoryController::class, 'show']);

    // Aktivitas Belajar
    Route::apiResource('assignments', AssignmentController::class);
    Route::apiResource('submissions', SubmissionController::class);
    Route::post('/enroll', [EnrollmentController::class, 'enroll']);
    Route::get('/my-courses', [EnrollmentController::class, 'myCourses']);
    Route::post('/progress/lesson', [ProgressController::class, 'lesson']);
    Route::post('/progress/video', [ProgressController::class, 'video']);
    Route::get('/certificate/{course}', [CertificateController::class, 'generate']);

    // Profile (Akses untuk semua user terautentikasi)
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'update']);

    /*
    |--------------------------------------------------------------------------
    | Pure Admin Routes (Statistik & Monitoring)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/stats', [AdminStatsController::class, 'getStats']);
    });
});