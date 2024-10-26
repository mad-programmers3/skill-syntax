<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseLike;
use App\Models\CourseQuiz;
use App\Models\PurchasedCourse;
use App\Models\Role;
use App\Models\StudentLesson;
use App\Supports\BaseCrudHelper;
use App\Supports\LikeHelper;
use App\Supports\MyFileHelper;
use Exception;
use Illuminate\Http\Request;

class CourseController extends Controller

{
    use BaseCrudHelper, MyFileHelper, LikeHelper;

    public function __construct()
    {
        $this->model = new Course();
        $this->with = ['thumbnail:id,path', 'category:id,title', 'likes', 'quizzes'];
        $this->showWith = ['thumbnail:id,path', 'category:id,title', 'likes', 'lessons', 'reviews.review.user'];


        $this->beforeFetch = function ($query) {
            if (request()->has('get_pending'))
                $query->where('status', 2);
        };

        $this->beforeStore = function ($request) {
            $request->merge(['status' => getSetting('default_course_status')]);
            $this->storeFile($request, 'thumbnail');
        };

        $this->beforeUpdate = function ($request) {
            $this->updateFile($request, 'thumbnail');
        };

        $this->afterDelete = function ($record) {
            if ($record && $record->thumbnail_id) { // delete also file
                $this->deleteFile($record->thumbnail_id);
            }
        };
    }

    public function doLike(Request $request) {
        return $this->likeHelper($request, new CourseLike(), 'course');
    }

    public function purchase($id) {
        try {
            // Ensure user is authenticated
            $user = auth()->user();
            $studentRole = Role::where('name', 'Student')->first(); // Fetch the first match
            if (!$user || !$studentRole || $user->role_id !== $studentRole->id)
                return retRes('User is not authenticated or not a student.', null, CODE_DANGER);


            // Use firstOrNew to find existing purchase or create a new instance
            $purchase = PurchasedCourse::firstOrNew([
                'user_id' => $user->id,
                'course_id' => $id,
            ]);

            // Check if the course has already been purchased
            if ($purchase->exists)
                return retRes('You have already purchased this course.', null, CODE_EXIST);

            $course = Course::findOrFail($id);
            $firstLess = $course->lessons->first();
            if ($firstLess) {
                $purchase->current_lesson_id = $firstLess->id;

                // Also store the first student lesson info
                StudentLesson::create([
                    'user_id' => $user->id,
                    'lesson_id' => $firstLess->id,
                    'current_quiz_id' => $firstLess->quizzes->first() ? $firstLess->quizzes->first()->id : null
                ]);
            }

            $purchase->current_quiz_id = $course->quizzes->first() ? $course->quizzes->first()->id : null;
            $purchase->save();


            return retRes('Course purchased successfully!', $purchase, CODE_SUCCESS);

        } catch (Exception $e) {
            return retRes('Failed to purchase course', null, 500);
        }
    }
}
