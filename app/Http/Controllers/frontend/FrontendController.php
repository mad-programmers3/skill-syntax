<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\backend\CourseController;
use App\Http\Controllers\backend\LessonController;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    // for home page
    public function index()
    {
        $data = [];
        (new CourseController())->index(
            ['thumbnail:id,path', 'category:id,title', 'likes'],
            false,
            function ($courses) use (&$data) {
                $data['popular-courses'] = $courses;
            }
        );

        return $this->retData($data);
    }

    // for courses page
    public function courses()
    {
        $data = [];
        (new CourseController())->index(
            ['thumbnail:id,path', 'category:id,title', 'likes'],
            false,
            function ($courses) use (&$data) {
                $data['courses'] = $courses;
            }
        );

        return $this->retData($data);
    }

    // for course details page
    public function showCurse($id)
    {
        $data = [];
        (new CourseController())->show($id,
            ['thumbnail:id,path', 'category:id,title', 'likes', 'lessons'],
            false,
            function ($record) use (&$data) {
                $data['course'] = $record;
            });

        return $this->retData($data);
    }

    public function showLesson($id)
    {
        $data = [];
        (new LessonController())->show(
            $id,
            ['likes'],
            function ($query) {
                $query->with('course', function ($course) {
                    $course->with('lessons');
                });
            },
            function ($record) use (&$data) {
                $data['lesson'] = $record;
            });

        return $this->retData($data);
    }


    private function retData($data)
    {
        return response()->json(['result' => $data, 'status' => 2000], 200);
    }
}
