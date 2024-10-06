<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Supports\BaseCrudHelper;

class LessonController extends Controller
{
    use BaseCrudHelper;

    public function __construct() {
        $this->model = new Lesson();
        $this->with = ['course:id,title', 'likes'];
    }


    public function index(Request $request)
    {
        $lessons = Lesson::paginate(5); // Adjust the number of items per page as needed
        return response()->json($lessons);
    }

}
