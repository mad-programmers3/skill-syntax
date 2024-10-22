<?php

use App\Http\Controllers\backend\BackendController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\CourseController;
use App\Http\Controllers\backend\CourseQuizController;
use App\Http\Controllers\backend\CourseReviewController;
use App\Http\Controllers\backend\LessonController;
use App\Http\Controllers\backend\LessonReviewController;
use App\Http\Controllers\backend\MyFileController;
use App\Http\Controllers\backend\QuestionController;
use App\Http\Controllers\backend\QuizController;
use App\Http\Controllers\backend\ReviewController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\backend\SubCategoryController;
use App\Http\Controllers\backend\TestimonialController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\frontend\FrontendController;
use App\Http\Controllers\frontend\StudentController;
use App\Http\Controllers\SupportController;
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
    Route::post('courses', [FrontendController::class, 'courses']);
    Route::get('courses/{id}', [FrontendController::class, 'showCurse']);
    Route::get('lessons/{id}', [FrontendController::class, 'showLesson']);
});
Route::group(['prefix' => 'student'], function () {
    Route::get('wish-list', [StudentController::class, 'wishList']);
});

Route::resource('tests', QuestionController::class);

Route::get('required-data', [SupportController::class, 'requiredData']);
// Role routes
Route::middleware('auth:api')->group(function () {

    Route::get('dashboard', [BackendController::class, 'dashboard']);

    Route::resource('users', UserController::class);
    Route::post('users/password-reset', [UserController::class, 'resetPassword']);
    Route::post('users/avatar-delete', [UserController::class, 'deleteAvatar']);
    Route::resource('quizzes', QuizController::class);
    Route::resource('questions', QuestionController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('sub-categories', SubCategoryController::class);

    Route::resource('courses', CourseController::class);
    Route::post('courses/add-quiz', [CourseController::class, 'addQuiz']);
    Route::post('courses/do-like', [CourseController::class, 'doLike']);

    Route::resource('lessons', LessonController::class);
    Route::post('lessons/do-like', [LessonController::class, 'lessonLike']);
    Route::post('lessons/add-quiz', [LessonController::class, 'addQuiz']);

    Route::post('files/upload', [MyFileController::class, 'upload'])->name('files.upload');
    Route::resource('reviews', ReviewController::class);
    Route::post('reviews/do-like', [ReviewController::class, 'reviewLike']);
    Route::resource('review/course-reviews', CourseReviewController::class);
    Route::resource('review/lesson-reviews', LessonReviewController::class);
    Route::resource('review/testimonials', TestimonialController::class);
    Route::resource('files', MyFileController::class);
    Route::resource('settings', SettingController::class);
    Route::post('files/upload', [MyFileController::class, 'upload'])->name('files.upload');
    Route::get('configurations', [SupportController::class, 'getConfigurations']);


    Route::group(['prefix' => 'config'], function () {
        Route::resource('roles', RoleController::class);
        Route::post('roles/add-permission', [RoleController::class, 'addPermission']);
        Route::post('roles/remove-permission', [RoleController::class, 'removePermission']);
        Route::resource('modules', ModuleController::class);
        Route::resource('permissions', PermissionController::class);
    });
});




