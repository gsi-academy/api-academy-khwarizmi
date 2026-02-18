<?php

use App\Http\Controllers\Admin\AdminStatsController as AdminAdminStatsController;
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

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);


/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function(){

    Route::post('/logout',[AuthController::class,'logout']);
    Route::get('/me', fn (Request $request) => $request->user());

    // Resources
    Route::apiResource('courses',CourseController::class);
    Route::apiResource('lessons',LessonController::class);
    Route::apiResource('assignments',AssignmentController::class);
    Route::apiResource('submissions',SubmissionController::class);
    Route::apiResource('categories',CategoryController::class);
    Route::apiResource('zoom-meetings', ZoomMeetingController::class);
    Route::apiResource('coupons', CouponController::class);

    // Coupon Validation
    Route::post('coupons/validate', [CouponController::class, 'validateCoupon']);

    // Enrollment
    Route::post('/enroll',[EnrollmentController::class,'enroll']);
    Route::get('/my-courses',[EnrollmentController::class,'myCourses']);

    // Progress
    Route::post('/progress/lesson',[ProgressController::class,'lesson']);
    Route::post('/progress/video',[ProgressController::class,'video']);

    // Certificate
    Route::get('/certificate/{course}',[CertificateController::class,'generate']);

    // Profile
    Route::get('/profile',[ProfileController::class,'show']);
    Route::put('/profile',[ProfileController::class,'update']);

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->group(function () {
        Route::get('/stats', [AdminStatsController::class, 'getStats']);
    });
  
});
