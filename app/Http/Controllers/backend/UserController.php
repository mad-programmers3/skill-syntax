<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\MyFile;
use App\Models\User;
use App\Supports\BaseCrudHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use BaseCrudHelper;

    private $fileCon = null;
    public function __construct()
    {
        $this->model = new User();
        $this->fileCon = new MyFileController();
        $this->with = ['role:id,name', 'avatar'];
        $this->showWith = ['role:id,name'];

        // before store set hash the password and set the avatar
        $this->beforeStore = function ($request) {
            $avatarData = $request->avatar;
            if ($avatarData) {
                $fileReq = new Request();
                mergeAuth($fileReq);
                // merge all file infos on fileReq from $request->avatar
                mergeAll($fileReq, $avatarData);

                //store the file and get the id
                $storedFile = MyFile::create($avatarData); // avatar is an object
                if ($storedFile) $request->merge(['avatar_id' => $storedFile->id]);
            }

            $request->merge(['password' => Hash::make($request->password)]);
        };

        // before update merge the new password and set the avatar
        $this->beforeUpdate = function ($request) {
            // set the changed password
            if ($request->password)
                $request->merge(['password' => Hash::make($request->password)]);

            // set the avatar id
            if ($request->avatar) {
                // merge all file infos on fileReq from $request->avatar
                $fileReq = new Request();
                mergeAll($fileReq, $request->avatar);

                if ($request->avatar_id)
                    // keep the avatar_id as it is, update the file
                    $this->fileCon->update($fileReq, $request->avatar_id);
                else {
                    // store a new file => get id => set this id merge avatar_id
                    $storedFile = MyFile::create($request->avatar); // avatar is an object
                    if ($storedFile) $request->merge(['avatar_id' => $storedFile->id]);
                }
            }
        };


        // after delete the record also delete the avatar
        $this->afterDelete = function ($record) {
            if ($record && $record->avatar_id) // delete also file
                $this->fileCon->destroy($record->avatar_id);
        };
    }
}
