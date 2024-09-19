<?php

use Illuminate\Support\Facades\Route;
Route::view('admin/{any}', 'welcome')->where('any', '.*');
