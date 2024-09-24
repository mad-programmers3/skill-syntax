<?php

namespace App\Http\Controllers\backend;

use App\Models\LessonLike;
use Illuminate\Http\Request;

class LessonLikeController extends DatabaseCrudController
{
    public function __construct() {
        parent::__construct(new LessonLike());
    }

    public function index($with = ['lesson:id,title', 'user:id,name'])
    {
        return parent::index($with);
    }
}
