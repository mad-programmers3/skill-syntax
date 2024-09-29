<?php

namespace App\Http\Controllers\backend;


use App\Models\LessonReview;

class LessonReviewController extends ItemReviewCrudController
{
    public function __construct() {
        parent::__construct(new LessonReview());
    }

    public function index($with = ['lesson:id,title', 'review'], $callBackBefore = false, $callBackAfter = false)
    {
        return parent::index($with, $callBackBefore, $callBackAfter);
    }
}
