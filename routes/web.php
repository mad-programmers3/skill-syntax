<?php

use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\CourseController;
use App\Http\Controllers\backend\CourseLikeController;
use App\Http\Controllers\backend\CourseReviewController;
use App\Http\Controllers\backend\LessonController;
use App\Http\Controllers\backend\LessonLikeController;
use App\Http\Controllers\backend\LessonReviewController;
use App\Http\Controllers\backend\ReviewController;
use App\Http\Controllers\backend\SubCategoryController;
use App\Http\Controllers\backend\TestimonialController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

//User Register Route
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');


//User Authentication Login All Route
Route::get('/login',[LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'doLogin']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::prefix('api')->middleware('auth')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('sub-categories', SubCategoryController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('course/likes', CourseLikeController::class);
    Route::resource('lessons', LessonController::class);
    Route::resource('lesson/likes', LessonLikeController::class);
    Route::resource('reviews', ReviewController::class);
    Route::resource('review/course-reviews', CourseReviewController::class);
    Route::resource('review/lesson-reviews', LessonReviewController::class);
    Route::resource('review/testimonials', TestimonialController::class);

});


Route::view('admin/{any}', 'backend-app')->middleware('auth')->where('any', '.*');
Route::view('/{any}', 'frontend-app')->where('any', '.*');
