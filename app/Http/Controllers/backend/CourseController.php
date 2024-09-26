<?php

namespace App\Http\Controllers\backend;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends DatabaseCrudController
{
    private $fileCon = null;

    public function __construct() {
        parent::__construct(new Course());

        $this->fileCon = new MyFileController();
    }

    public function index($with = ['category:id,title', 'likes'])
    {
        return parent::index($with);
    }

    public function store(Request $request, $callBackBefore = false, $callBackAfter = false) {
        return parent::store($request, function ($req) {
            if ($req->thumbnail) {
                // store the file firs
                $fileReq = new Request();
                foreach ($req->thumbnail as $key => $value) {
                    $fileReq->merge([$key => $value]); // Merge each key-value pair into fileReq
                }

                $thumbnail_id = null;
                // store the file and get the id on callBackAfter
                $this->fileCon->store($fileReq, false, function ($record) use (&$thumbnail_id) {
                    if ($record) $thumbnail_id = $record->id;
                });

                $req->merge(['thumbnail_id' => $thumbnail_id]);
            }
        });
    }
}
