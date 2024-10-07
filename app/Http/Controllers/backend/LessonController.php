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
        $this->page = 4;
    }


//    public function index()
//    {
//        try {
//            $lessons = Lesson::with(['course:id,title', 'likes'])->paginate(4);
//            return retRes('Fetched data successfully', $lessons);
//        } catch (\Exception $e) {
//            return retRes('Something went wrong', $e, CODE_DANGER);        }
//    }



}
