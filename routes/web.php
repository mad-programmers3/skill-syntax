<?php

use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\CourseController;
use App\Http\Controllers\backend\ReviewController;
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
    Route::resource('courses', CourseController::class);
    Route::resource('reviews', ReviewController::class);
});


Route::view('admin/{any}', 'backend-app')->middleware('auth')->where('any', '.*');
Route::view('/{any}', 'frontend-app')->where('any', '.*');
