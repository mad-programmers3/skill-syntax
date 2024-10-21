<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Supports\BaseCrudHelper;

class QuizController extends Controller
{
    use BaseCrudHelper;

    public function __construct()
    {
        $this->model = new Quiz();
        $this->with = ['questions'];

        $this->beforeStore = function ($request) {
            if (! $request->input('time_limit'))
                $request->merge(['time_limit' => getSetting('default_quiz_time_limit')]);
        };
    }
}
