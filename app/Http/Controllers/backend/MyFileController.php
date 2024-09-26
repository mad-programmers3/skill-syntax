<?php

namespace App\Http\Controllers\backend;

use App\Models\MyFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MyFileController extends DatabaseCrudController
{
    public function __construct() {
        parent::__construct(new MyFile());
    }

    public function index($with = ['user:id,name'])
    {
        return parent::index($with);
    }

    public function upload(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'image' => 'required|image|max:2048', // Max size of 2MB
        ]);

        // Handle the uploaded file
        if ($request->file('image')) {
            $file = $request->file('image');
            $path = $file->store('images', 'public'); // Store the file in public/images

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

}
