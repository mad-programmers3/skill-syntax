<?php

use Illuminate\Support\Facades\Route;


Route::view('admin/{any}', 'backend-app')->where('any', '.*');
Route::view('/{any}', 'frontend-app')->where('any', '.*');
