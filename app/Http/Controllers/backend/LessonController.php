<?php

namespace App\Http\Controllers\backend;


use App\Models\Lesson;

class LessonController extends DatabaseCrudController
{
    public function __construct() {
        parent::__construct(new Lesson());
    }

    public function index($with = ['course:id,title'])
    {
        return parent::index($with);
    }
}
