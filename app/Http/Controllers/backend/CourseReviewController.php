<?php

namespace App\Http\Controllers\backend;


use App\Http\Controllers\Controller;
use App\Models\CourseReview;
use App\Models\Review;
use App\Supports\BaseCrudHelper;
use Illuminate\Http\Request;
use function Symfony\Component\HttpKernel\Log\record;

class CourseReviewController extends Controller
{
    use BaseCrudHelper;

    public function __construct() {
        $this->model = new CourseReview();
        $this->with = ['course:id,title', 'review'];
    }

    public function store(Request $request)
    {
        try{
            // store the review
            mergeAuth($request);
            $review = Review::create($request->only(['comment', 'user_id','rating','likes']));

            //store course review
            $request->merge(['review_id' => $review->id]);
            $record = CourseReview::create($request->all());

            return retRes('Review created successfully', $review);
        } catch (\Exception $e) {
            return retRes('Something went wrong', null, CODE_DANGER);
        }
    }

}
