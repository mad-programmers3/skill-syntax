<?php

namespace App\Http\Controllers\backend;


use App\Models\LessonReview;

class LessonReviewController extends DatabaseCrudController
{
    public function __construct() {
        parent::__construct(new LessonReview());
    }

    public function index($with = ['lesson:id,title', 'review'])
    {
        return parent::index($with);
    }
}
