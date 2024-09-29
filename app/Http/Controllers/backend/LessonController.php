<?php

namespace App\Http\Controllers\backend;


use App\Models\Lesson;

class LessonController extends DatabaseCrudController
{
    public function __construct() {
        parent::__construct(new Lesson());
    }

    public function index($with = ['course:id,title', 'likes'], $callBackBefore = false, $callBackAfter = false)
    {
        return parent::index($with, $callBackBefore, $callBackAfter);
    }

    public function show($id, $with = ['course:id,title', 'likes'], $callBackBefore = false, $callBackAfter = false)
    {
        return parent::show($id, $with, function ($query) {
            $query->with(['reviews'=>function ($reviews){
                $reviews->with(['review' => function ($review) {
                    $review->with('user');
                }]);
            }]);
        }, $callBackAfter);
    }
}
