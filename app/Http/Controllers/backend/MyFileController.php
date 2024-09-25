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

    public function store(Request $request, $callBack = false)
    {
        // Validate the incoming request
        $request->validate([
            'image' => 'required|image|max:2048', // Max size of 2MB
        ]);

        // Handle the uploaded file
        if ($request->file('image')) {
            $file = $request->file('image');
            $path = $file->store('images', 'public'); // Store the file in public/images

            // Return a response with the path or URL
            return response()->json([
                'success' => true,
                'path' => $path,
                'url' => Storage::url($path), // Generate a URL for the uploaded file
            ]);
        }

        return response()->json(['success' => false, 'message' => 'File upload failed.'], 500);
    }
}
