<?php

namespace App\Http\Controllers\backend;


use App\Http\Controllers\Controller;
use App\Models\LessonReview;
use App\Supports\BaseCrudHelper;

class LessonReviewController extends Controller
{
    use BaseCrudHelper;

    public function __construct() {
        $this->model = new LessonReview();
        $this->with = ['lesson:id,title', 'review'];
    }
}
