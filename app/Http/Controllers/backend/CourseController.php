<?php

namespace App\Http\Controllers\backend;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends DatabaseCrudController
{
    private $fileCon = null;

    public function __construct()
    {
        parent::__construct(new Course());

        $this->fileCon = new MyFileController();
    }

    public function index($with = ['thumbnail:id,path', 'category:id,title', 'likes'], $callBackBefore = false, $callBackAfter = false)
    {
        return parent::index($with, $callBackBefore, $callBackAfter);
    }

    public function show($id, $with = ['thumbnail:id,path', 'category:id,title', 'likes', 'lessons'], $callBackBefore = false, $callBackAfter = false)
    {
        return parent::show($id, $with, $callBackBefore ? $callBackBefore : function ($query) {
            $query->with(['reviews'=>function ($reviews){
                $reviews->with(['review' => function ($review) {
                    $review->with('user');
                }]);
            }]);
        }, $callBackAfter);
    }

    public function store(Request $request, $callBackBefore = false, $callBackAfter = false)
    {
        return parent::store($request, function ($req) {
            if ($req->uploadFile) {
                // store the file firs
                $fileReq = new Request();
                foreach ($req->uploadFile as $key => $value) {
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

    public function update(Request $request, $id, $callBackBefore = false, $callBackAfter = false)
    {
        return parent::update($request, $id, function ($req) {
            if ($req->uploadFile) {
                // store the file firs
                $fileReq = new Request();
                foreach ($req->uploadFile as $key => $value) {
                    $fileReq->merge([$key => $value]); // Merge each key-value pair into fileReq
                }

                if ($req->thumbnail_id) // keep the thumbnail_id as it is, update the file
                    $this->fileCon->update($fileReq, $req->thumbnail_id);
                else { // store a new file => get id => set this id merge thumbnail_id
                    $thumbnail_id = null;
                    // store the file and get the id on callBackAfter
                    $this->fileCon->store($fileReq, false, function ($record) use (&$thumbnail_id) {
                        if ($record) $thumbnail_id = $record->id;
                    });

                    $req->merge(['thumbnail_id' => $thumbnail_id]);
                }
            }
        });
    }

    public function destroy($id, $callBack = false)
    {
        return parent::destroy($id, function ($record) {
            if ($record && $record->thumbnail_id) // delete also file
                $this->fileCon->destroy($record->thumbnail_id);
        });
    }
}
