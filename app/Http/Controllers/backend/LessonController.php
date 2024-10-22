<?php

namespace App\Http\Controllers\backend;

use App\Models\LessonLike;
use App\Models\LessonQuiz;
use App\Supports\LikeHelper;
use App\Supports\MyFileHelper;
use Illuminate\Http\Request;
use Exception;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Supports\BaseCrudHelper;

class LessonController extends Controller
{
    use BaseCrudHelper, MyFileHelper, LikeHelper;

    public function __construct() {
        $this->model = new Lesson();
        $this->with = ['thumbnail:id,path', 'course:id,title', 'likes', 'quizzes'];



        $this->beforeStore = function ($request) {
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

    public function lessonLike(Request $request) {
        return $this->likeHelper($request, new LessonLike(), 'lesson');
    }

    public function addQuiz(Request $request) {
        try {
            $lessonId = $request->input('lesson_id');
            $quizId = $request->input('quiz_id');

            // Use firstOrNew to fetch existing or create new instance without saving
            $lessonQuiz = LessonQuiz::firstOrNew(
                ['lesson_id' => $lessonId, 'quiz_id' => $quizId]
            );

            if ($lessonQuiz->exists) {
                $lessonQuiz->delete();
                return retRes('Successfully removed lesson quiz', ['flag' => 0, 'quiz' => $lessonQuiz->quiz]);
            }

            // Save new quiz to lesson
            $lessonQuiz->fill($request->all())->save();
            return retRes('Successfully added lesson quiz', ['flag' => 1, 'quiz' => $lessonQuiz->quiz]);

        } catch (Exception $e) {
            return retRes('Failed to manipulate lesson quiz', null, 500);
        }
    }
}
