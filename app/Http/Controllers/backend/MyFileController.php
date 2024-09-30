<?php

namespace App\Http\Controllers\backend;

use App\Models\MyFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MyFileController extends DatabaseCrudController
{
    public function __construct()
    {
        parent::__construct(new MyFile());
    }

    public function index($with = ['user:id,name'], $callBackBefore = false, $callBackAfter = false)
    {
        return parent::index($with, $callBackBefore, $callBackAfter);
    }

    public function update(Request $request, $id, $callBackBefore = false, $callBackAfter = false)
    {
        return parent::update(
            $request,
            $id,
            $callBackBefore,
            $callBackAfter ? $callBackAfter : function ($newRecord, $oldRecord) {
                // delete old file from storage
                $this->deleteFile($oldRecord);
            }
        );
    }

    public function destroy($id, $callBack = false)
    {
        return parent::destroy(
            $id,
            $callBack ? $callBack : function ($record) {
                // delete the file from storage also
                $this->deleteFile($record);
            }
        );
    }

    public function upload(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'file' => 'required|max:2048', // Max size of 2MB
        ]);

        // Handle the uploaded file
        if ($request->file('file')) {
            $file = $request->file('file');
            $path = $file->store('uploads', 'public'); // Store the file in public/images

            // Extract file information
            $fileName = $file->getClientOriginalName();  // Get the original file name
            $extension = $file->getClientOriginalExtension();  // Get the file extension
            $size = $file->getSize();  // Get the file size in bytes

            // Return a response with file info, path, and URL
            return response()->json([
                'success' => true,
                'path' => $path,
                'name' => $fileName,
                'extension' => $extension,
                'size' => $size
            ]);
        }

        return response()->json(['success' => false, 'message' => 'File upload failed.'], 500);
    }


    private function deleteFile($record)
    {
        if ($record && $record->path && Storage::exists('public/' . $record->path)) {
            Storage::delete('public/' . $record->path);
        }
    }
}
