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


Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){

Route::post('/logout',[AuthController::class,'logout']);

Route::get('/me', fn (Request $request) => $request->user());

Route::apiResource('courses',CourseController::class);
Route::apiResource('lessons',LessonController::class);
Route::apiResource('assignments',AssignmentController::class);
Route::apiResource('submissions',SubmissionController::class);
Route::apiResource('categories',CategoryController::class);

Route::post('/enroll',[EnrollmentController::class,'enroll']);
Route::get('/my-courses',[EnrollmentController::class,'myCourses']);

Route::post('/progress/lesson',[ProgressController::class,'lesson']);
Route::post('/progress/video',[ProgressController::class,'video']);

Route::get('/certificate/{course}',
[CertificateController::class,'generate']);

Route::get('/profile',[ProfileController::class,'show']);
Route::put('/profile',[ProfileController::class,'update']);

});
