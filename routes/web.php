<?php

use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\CourseController;
use App\Http\Controllers\backend\CourseLikeController;
use App\Http\Controllers\backend\CourseReviewController;
use App\Http\Controllers\backend\LessonController;
use App\Http\Controllers\backend\LessonLikeController;
use App\Http\Controllers\backend\LessonReviewController;
use App\Http\Controllers\backend\MyFileController;
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

Route::view('admin/{any}', 'backend-app')->middleware('auth')->where('any', '.*');
Route::view('/{any}', 'frontend-app')->where('any', '.*');
