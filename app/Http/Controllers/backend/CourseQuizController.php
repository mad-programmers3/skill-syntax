<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\CourseQuiz;
use App\Supports\BaseCrudHelper;

class CourseQuizController extends Controller
{
    use BaseCrudHelper;

    public function __construct()
    {
        $this->model = new CourseQuiz();
        $this->checkAuth = false;
    }
}
