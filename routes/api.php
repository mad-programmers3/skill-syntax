<?php

use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\CourseController;
use App\Http\Controllers\backend\CourseReviewController;
use App\Http\Controllers\backend\LessonController;
use App\Http\Controllers\backend\LessonReviewController;
use App\Http\Controllers\backend\MyFileController;
use App\Http\Controllers\backend\ReviewController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\SubCategoryController;
use App\Http\Controllers\backend\TestimonialController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\frontend\FrontendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\ModuleController;
use App\Http\Controllers\backend\PermissionController;

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





Route::group(['prefix' => 'pages'], function () {
    Route::get('index', [FrontendController::class, 'index']);
    Route::get('courses', [FrontendController::class, 'courses']);
    Route::get('courses/{id}', [FrontendController::class, 'showCurse']);
    Route::get('lessons/{id}', [FrontendController::class, 'showLesson']);
});

Route::resource('/tests', CourseController::class);

// Role routes
Route::middleware('auth:api')->group(function () {

    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('sub-categories', SubCategoryController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('lessons', LessonController::class);
    Route::resource('reviews', ReviewController::class);
    Route::resource('review/course-reviews', CourseReviewController::class);
    Route::resource('review/lesson-reviews', LessonReviewController::class);
    Route::resource('review/testimonials', TestimonialController::class);
    Route::resource('files', MyFileController::class);
    Route::post('files/upload', [MyFileController::class, 'upload'])->name('files.upload');


    Route::group(['prefix' => 'config'], function () {
        Route::resource('roles', RoleController::class);
        Route::post('roles/add-permission', [RoleController::class, 'addPermission']);
        Route::post('roles/remove-permission', [RoleController::class, 'removePermission']);
        Route::resource('modules', ModuleController::class);
        Route::resource('permissions', PermissionController::class);
    });
    // Roles
//    Route::get('/roles', [RoleController::class, 'index']);
//    Route::get('/roles/{id}', [RoleController::class, 'show']);
//    Route::post('/roles', [RoleController::class, 'store']); // T
//    Route::put('/roles/{id}', [RoleController::class, 'update']);
//    Route::delete('/roles/{id}', [RoleController::class, 'destroy']);


    // Permissions
    Route::get('/permissions', [PermissionController::class, 'index']);
    Route::get('/permissions/{id}', [PermissionController::class, 'show']);
    Route::post('/permissions', [PermissionController::class, 'store']);
    Route::put('/permissions/{id}', [PermissionController::class, 'update']);
    Route::delete('/permissions/{id}', [PermissionController::class, 'destroy']);


    // Modules

//    Route::get('/modules', [ModuleController::class, 'index']);
//    Route::get('/modules/{id}', [ModuleController::class, 'show']);
//    Route::post('/modules', [ModuleController::class, 'store']);
//    Route::put('/modules/{id}', [ModuleController::class, 'update']);
//    Route::delete('/modules/{id}', [ModuleController::class, 'destroy']);


    // Role Permission
//    Route::get('/role-permissions', [RolePermissionController::class, 'index']);
//    Route::post('/role-permissions', [RolePermissionController::class, 'store']);
//    Route::delete('/role-permissions/{roleId}/{moduleId}/{action}', [RolePermissionController::class, 'destroy']);
});




