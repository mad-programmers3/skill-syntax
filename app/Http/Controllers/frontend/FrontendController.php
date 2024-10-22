<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Review;
use App\Models\ReviewLike;
use Exception;
use Illuminate\Http\Request;

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
            $data['course'] = Course::with(['thumbnail:id,path', 'category:id,title', 'likes', 'lessons', 'course_reviews.review.user', 'quizzes.questions'])->findOrFail($id);
            $data['likes'] = $data['course']->likes->pluck('user_id');
            $data['reviews'] = $data['course']->course_reviews->pluck('review');

            $data['reviews-likes'] = [];
            foreach ($data['reviews'] as $review) {
                $data['reviews-likes'][$review->id] = ReviewLike::where('review_id', $review->id)->pluck('user_id');
            }

            $data['lessons-likes'] = [];
            foreach ($data['course']->lessons as $lesson) {
                $data['lessons-likes'][$lesson->id] = $lesson->likes->pluck('user_id');
                    //ReviewLike::where('review_id', $lesson->id)->pluck('user_id');
            }
            return retRes('Fetched course data for course page', $data);
        } catch (Exception $e) {
            return retRes('Something went wrong', null, 500);
        }
    }

    public function showLesson($id)
    {

        try {
            $data = [];
            $data['lesson'] = Lesson::with(['likes', 'course.lessons', 'lesson_reviews.review.user', 'quizzes.questions'])->findOrFail($id);
            $data['reviews'] = $data['lesson']->lesson_reviews->pluck('review');
            $data['likes'] = $data['lesson']->likes->pluck('user_id');

            $data['reviews-likes'] = [];
            foreach ($data['reviews'] as $review) {
                $data['reviews-likes'][$review->id] = ReviewLike::where('review_id', $review->id)->pluck('user_id');
            }

            return retRes('Fetched lesson data for lesson page', $data);
        } catch (Exception $e) {
            return retRes('Something went wrong', null, 500);
        }
    }
}
