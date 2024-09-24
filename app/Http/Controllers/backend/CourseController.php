<?php

namespace App\Http\Controllers\backend;

use App\Models\Course;

class CourseController extends DatabaseCrudController
{
    public function __construct() {
        parent::__construct(new Course());
    }

    public function index($with = ['category:id,title', 'likes'])
    {
        return parent::index($with);
    }
}
