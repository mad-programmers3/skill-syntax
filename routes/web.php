<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;


use App\Http\Controllers\SearchController;

Route::get('/search', [SearchController::class, 'search'])->name('search');

//User Register Route
Route::get('/register', function (\Illuminate\Http\Request $request) {
    $url = $request->query('url');
    $decodedUrl = urldecode($url);

    return view('auth.register', ['url' => $decodedUrl]);
})->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');


//User Authentication Login All Route
Route::get('/login',[LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'doLogin']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::view('admin/{any}', 'backend-app')->middleware('auth')->where('any', '.*');
Route::view('/{any}', 'frontend-app')->where('any', '.*');
