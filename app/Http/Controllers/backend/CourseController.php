<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\MyFile;
use App\Supports\BaseCrudHelper;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use function Symfony\Component\HttpKernel\Log\record;

class CourseController extends Controller

{
    use BaseCrudHelper;

    private $fileCon = null;

    public function __construct()
    {
        $this->model = new Course();
        $this->fileCon = new MyFileController();
        $this->with = ['thumbnail:id,path', 'category:id,title', 'likes'];
        $this->showWith = ['thumbnail:id,path', 'category:id,title', 'likes', 'lessons', 'reviews.review.user'];



//        $this->beforeStore = function ($request) {
//            $thumbData = $request->thumbnail;
//            if ($thumbData) {
//                $fileReq = new Request();
//                mergeAuth($fileReq);
//                // merge all file infos on fileReq from $request->thumbnail
//                mergeAll($fileReq, $thumbData);
//
//                //store the file and get the id
//                $storedFile = MyFile::create($thumbData); // thumbnail is an object
//                if ($storedFile) $request->merge(['thumbnail_id' => $storedFile->id]);
//            }
//        };
//
//        $this->beforeUpdate = function ($request) {
//            if ($request->thumbnail) {
//                // merge all file infos on fileReq from $request->thumbnail
//                $fileReq = new Request();
//                mergeAll($fileReq, $request->thumbnail);
//
//                if ($request->thumbnail_id)
//                    // keep the thumbnail_id as it is, update the file
//                    $this->fileCon->update($fileReq, $request->thumbnail_id);
//                else {
//                    // store a new file => get id => set this id merge thumbnail_id
//                    $storedFile = MyFile::create($request->thumbnail); // thumbnail is an object
//                    if ($storedFile) $request->merge(['thumbnail_id' => $storedFile->id]);
//                }
//            }
//        };
//
//        $this->afterDelete = function ($record) {
//            if ($record && $record->thumbnail_id) // delete also file
//                $this->fileCon->destroy($record->thumbnail_id);
//        };
    }

    public function index(Request $request)
    {

//        dd($request);
        try {
            $courses = Course::with(['thumbnail:id,path', 'category:id,title', 'likes'])
                ->paginate(1); // Change the number to adjust items per page
            return retRes('Courses fetched successfully', $courses);
        } catch (Exception $e) {
            return retRes('Something went wrong', null, CODE_DANGER);
        }
    }

    public function store(Request $request)
    {
        try {
            mergeAuth($request);

            // store the file first
            if ($request->thumbnail) {
                //store the file and get the id
                $storedFile = MyFile::create($request->thumbnail); // thumbnail is an object
                if ($storedFile) $request->merge(['thumbnail_id' => $storedFile->id]);
            }

            $record = Course::create($request->all()); // Create a new record
            return retRes('Successfully created course', $record);
        } catch (Exception $e) {
            return retRes('Failed to create record', null, 500);
        }
    }

    // Update an existing record
    public function update(Request $request, $id)
    {
        try {
            // update the file/thumbnail first
            if ($request->thumbnail) {
                // merge all file infos on fileReq from $request->thumbnail
                $fileReq = new Request();
                mergeAll($fileReq, $request->thumbnail);

                if ($request->thumbnail_id)
                    // keep the thumbnail_id as it is, update the file
                    $this->fileCon->update($fileReq, $request->thumbnail_id);
                else {
                    // store a new file => get id => set this id merge thumbnail_id
                    $storedFile = MyFile::create($request->thumbnail); // thumbnail is an object
                    if ($storedFile) $request->merge(['thumbnail_id' => $storedFile->id]);
                }
            }


            // update the course
            $record = Course::findOrFail($id); // Find the record by ID
            $record->update($request->all()); // Update the record
            return retRes('Successfully updated record', $record);
        } catch (ModelNotFoundException $e) {
            return retRes('Record not found', null, 404);
        } catch (Exception $e) {
            return retRes('Failed to update record', null, 500);
        }
    }

    public function destroy($id)
    {
        try {
            $record = Course::findOrFail($id); // Find the record by ID
            if ($record && $record->thumbnail_id) // delete also file
                $this->fileCon->destroy($record->thumbnail_id);

            $record->delete(); // Delete the record
            return retRes('Successfully deleted the course', $record, CODE_DANGER);
        } catch (ModelNotFoundException $e) {
            return retRes("The course isn't found", null, 404);
        } catch (Exception $e) {
            return retRes('Failed to delete the course', null, 500);
        }
    }
}
