<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\PurchasedCourse;
use App\Models\ReviewLike;
use App\Models\StudentLesson;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    // for home page
    public function index()
    {
        try {
            $data = [];
            $data['popular-courses'] = Course::where('status', 1)->with(['thumbnail:id,path', 'category:id,title', 'likes'])->take(8)->get();
            $data['categories'] = Category::where('status', 1)->with(['thumbnail', 'courses:id,category_id,title'])->get();
            return retRes('Fetched all data for home page', $data);
        } catch (Exception $e) {
            return retRes('Something went wrong', null, 500);
        }
    }

    // for courses page
    public function courses(Request $request)
    {
        try {
            $data = [];
            $categories = $request->input('categories_id');

            $data['courses'] = Course::where('status', 1)
                ->when(!empty($categories), function($query) use ($categories) {
                    return $query->whereIn('category_id', $categories);
                })
                ->with(['thumbnail:id,path', 'category:id,title', 'likes'])
                ->get();

            return retRes('Fetched all data for courses page', $data);
        } catch (Exception $e) {
            return retRes('Something went wrong', null, 500);
        }
    }

    // for course details page
    public function showCurse($id)
    {
        try {
            $data = [];
            $data['course'] = Course::with(['thumbnail:id,path', 'category:id,title', 'likes', 'lessons', 'course_reviews.review.user.avatar', 'quizzes.questions:id,quiz_id,title,option_a,option_b,option_c,option_d', 'user_purchased'])->findOrFail($id);
            $data['likes'] = $data['course']->likes->pluck('user_id');
            $data['reviews'] = $data['course']->course_reviews->pluck('review');

            $data['reviews_likes'] = [];
            foreach ($data['reviews'] as $review) {
                $data['reviews_likes'][$review->id] = ReviewLike::where('review_id', $review->id)->pluck('user_id');
            }

            $data['lessons_likes'] = [];
            foreach ($data['course']->lessons as $lesson) {
                $data['lessons_likes'][$lesson->id] = $lesson->likes->pluck('user_id');
                    //ReviewLike::where('review_id', $lesson->id)->pluck('user_id');
            }

            $ri = Auth::user() ? PurchasedCourse::where('course_id', $id)->where('user_id', Auth::id())->first() : [];
            $data['running_info'] = $ri ? $ri : [];

            return retRes('Fetched course data for course page', $data);
        } catch (Exception $e) {
            return retRes('Something went wrong', null, 500);
        }
    }

    public function showLesson($id)
    {

        try {
            $data = [];
            $data['lesson'] = Lesson::with(['thumbnail:id,path', 'video:id,path', 'likes', 'course.lessons.thumbnail', 'lesson_reviews.review.user', 'quizzes.questions'])->findOrFail($id);
            $data['prev'] = $data['lesson']->prev();
            $data['next'] = $data['lesson']->next();

            $data['reviews'] = $data['lesson']->lesson_reviews->pluck('review');
            $data['likes'] = $data['lesson']->likes->pluck('user_id');

            $data['reviews-likes'] = [];
            foreach ($data['reviews'] as $review) {
                $data['reviews-likes'][$review->id] = ReviewLike::where('review_id', $review->id)->pluck('user_id');
            }

            $ri = [];
            if (Auth::user()) {
                $ri = StudentLesson::where('lesson_id', $id)->where('user_id', Auth::id())->first();
                $ric = PurchasedCourse::where('course_id', $data['lesson']->course->id)->where('user_id', Auth::id())->first();
                $ri->current_lesson_id = $ric->current_lesson_id;
                $ri->ric_id = $ric->id;
            }
            $data['running_info'] = $ri ? $ri : [];

            return retRes('Fetched lesson data for lesson page', $data);
        } catch (Exception $e) {
            return retRes('Something went wrong', null, 500);
        }
    }

    public function goToNextLesson(Request $request, $id)
    {
        try {
            $record = PurchasedCourse::findOrFail($id);
            if ($record) {
                $data = $request->all();

                if ($request->input('current_lesson_id') < $record->current_lesson_id)
                    unset($data['current_lesson_id']);
                else {
                    $lesson = Lesson::findOrFail($data['current_lesson_id']);
                    if ($lesson) {
                        StudentLesson::create([
                            'user_id' => Auth::id(),
                            'lesson_id' => $lesson->id,
                            'current_quiz_id' => $lesson->quizzes->first() ? $lesson->quizzes->first()->id : null
                        ]);
                    }
                }

                $record->update($data);
                return retRes('Running info updated', $record);
            }

            return retRes('Data not found', null, CODE_NOT_FOUND);
        } catch (Exception $e) {
            return retRes('Something went wrong', null, 500);
        }

    }
}
