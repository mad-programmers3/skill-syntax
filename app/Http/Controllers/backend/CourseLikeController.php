<?php

namespace App\Http\Controllers\backend;


use App\Models\CourseLike;

class CourseLikeController extends DatabaseCrudController
{
    public function __construct() {
        parent::__construct(new CourseLike());
    }

    public function index($with = ['course:id,title', 'user:id,name'], $callBackBefore = false, $callBackAfter = false)
    {
        return parent::index($with, $callBackBefore, $callBackAfter);
    }
}
