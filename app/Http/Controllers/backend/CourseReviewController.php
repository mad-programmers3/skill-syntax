<?php

namespace App\Http\Controllers\backend;


use App\Http\Controllers\Controller;
use App\Models\CourseReview;
use App\Supports\BaseCrudHelper;

class CourseReviewController extends Controller
{
    use BaseCrudHelper;

    public function __construct() {
        $this->model = new CourseReview();
        $this->with = ['course:id,title', 'review'];
    }
}
