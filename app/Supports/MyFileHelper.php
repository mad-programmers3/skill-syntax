<?php

namespace App\Supports;

use App\Models\MyFile;
use Illuminate\Support\Facades\Storage;

trait MyFileHelper
{
    private function updateFile($request, $id)
    {
        $record = MyFile::findOrFail($id);

        if ($record) {
            if ($record->path && Storage::exists('public/' . $record->path))
                Storage::delete('public/' . $record->path);

            $record->update($request->all());
        }
    }

    private function deleteFile($id)
    {
        $record = MyFile::findOrFail($id);

        if ($record) {
            if ($record->path && Storage::exists('public/' . $record->path))
                Storage::delete('public/' . $record->path);

            $record->delete();
        }
    }
}
