<?php

namespace App\Http\Controllers\backend;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends DatabaseCrudController
{
    private $fileCon = null;

    public function __construct()
    {
        parent::__construct(new Course());

        $this->fileCon = new MyFileController();
    }

    /**
     * Display a listing of the resource with optional relationships and callbacks.
     *
     * @param array $with Relationships to load with the resource.
     * @param bool $callBackBefore Whether to trigger a callback before fetching data.
     * @param bool $callBackAfter Whether to trigger a callback after fetching data.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($with = ['thumbnail:id,path', 'category:id,title', 'likes'], $callBackBefore = false, $callBackAfter = false)
    {
        return parent::index($with, $callBackBefore, $callBackAfter);
    }


    /**
     * Display a specific record with related data.
     *
     * This method retrieves a record by its ID along with specified relationships.
     * It includes a callback function to load additional nested relationships like
     * reviews and users within those reviews. You can provide optional callback
     * functions to be executed before or after fetching the data.
     *
     * @param int $id The ID of the record to display.
     * @param array $with The related data to be fetched (e.g., thumbnail, category, likes, lessons).
     * @param bool|callable $callBackBefore Optional. A callback function to be executed before fetching the data.
     * @param bool|callable $callBackAfter Optional. A callback function to be executed after fetching the data.
     * @return mixed The result from the parent `show` method, including the related data and any callbacks.
     */
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


    /**
     * Store a new resource with optional file upload and callbacks.
     *
     * This method handles storing a resource and optionally processes
     * file uploads. It uses callbacks to allow additional logic before
     * and after the file is stored.
     *
     * @param Request $request The incoming HTTP request containing the resource data.
     * @param bool $callBackBefore Optional callback to run before the store operation.
     * @param bool $callBackAfter Optional callback to run after the store operation.
     * @return \Illuminate\Http\JsonResponse response after storing the resource.
     */
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

    /**
     * Update the specified resource with optional file upload handling.
     *
     * This method extends the parent `update` functionality to include
     * handling file uploads if present in the request. It supports
     * pre- and post-update callback functions and manages the `thumbnail_id`
     * for the resource based on the file upload.
     *
     * @param \Illuminate\Http\Request $request The incoming HTTP request
     * @param int $id The ID of the resource being updated
     * @param bool $callBackBefore (Optional) Pre-update callback flag
     * @param bool $callBackAfter (Optional) Post-update callback flag
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id, $callBackBefore = false, $callBackAfter = false)
    {
        $course  = Course::where('id', $id)->first();

        if ($course){
            $course->fill($request->all());
            $course->user_id = Auth::user()->id;
            $course->thumbnail_id = $this->getFileId($request->input('thumbnail'), $course->thumbnail_id);
            $course->save();

            return response()->json(['success' => true, 'message' =>' updated successfully.', 'status' => 2000]);
        }

        return response()->json(['success' => true, 'message' =>' updated successfully.', 'status' => 2000]);
    }

    public function destroy($id, $callBack = false)
    {
        return parent::destroy($id, function ($record) {
            if ($record && $record->thumbnail_id) // delete also file
                $this->fileCon->destroy($record->thumbnail_id);
        });
    }
}
