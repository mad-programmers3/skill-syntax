<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\MyFile;
use App\Supports\BaseCrudHelper;
use App\Supports\MyFileHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MyFileController extends Controller
{
    use MyFileHelper;


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
}
