<?php

namespace App\Http\Controllers\backend;


use App\Models\CourseReview;

class CourseReviewController extends ItemReviewCrudController
{
    public function __construct() {
        parent::__construct(new CourseReview());
    }

    public function index($with = ['course:id,title', 'review'], $callBackBefore = false, $callBackAfter = false)
    {
        return parent::index($with, $callBackBefore, $callBackAfter);
    }
}
