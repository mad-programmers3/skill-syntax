<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\RolePermissionController;
use App\Http\Controllers\backend\RoleModuleController;
use App\Http\Controllers\backend\ModuleController;
use App\Http\Controllers\backend\PermissionController;

// Role routes
Route::middleware('auth:api')->group(function () {
    // Roles
    Route::get('/roles', [RoleController::class, 'index']);
    Route::get('/roles/{id}', [RoleController::class, 'show']);
    Route::post('/roles', [RoleController::class, 'store']); // T
    Route::put('/roles/{id}', [RoleController::class, 'update']);
    Route::delete('/roles/{id}', [RoleController::class, 'destroy']);


    // Permissions
    Route::get('/permissions', [PermissionController::class, 'index']);
    Route::get('/permissions/{id}', [PermissionController::class, 'show']);
    Route::post('/permissions', [PermissionController::class, 'store']);
    Route::put('/permissions/{id}', [PermissionController::class, 'update']);
    Route::delete('/permissions/{id}', [PermissionController::class, 'destroy']);


    // Modules
    Route::get('/modules', [ModuleController::class, 'index']);
    Route::get('/modules/{id}', [ModuleController::class, 'show']);
    Route::post('/modules', [ModuleController::class, 'store']);
    Route::put('/modules/{id}', [ModuleController::class, 'update']);
    Route::delete('/modules/{id}', [ModuleController::class, 'destroy']);


    // Role Permission
    Route::get('/role-permissions', [RolePermissionController::class, 'index']);
    Route::post('/role-permissions', [RolePermissionController::class, 'store']);
    Route::delete('role-permissions/{role}/{permission}', [RolePermissionController::class, 'destroy']);


    // Role Modules
    Route::get('/role-modules', [RoleModuleController::class, 'index']);
    Route::post('/role-modules', [RoleModuleController::class, 'store']);
    Route::delete('/role-modules/{id}', [RoleModuleController::class, 'destroy']);
});




