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

    public function __construct()
    {
        $this->model = new User();
        $this->with = ['role:id,name'];
        $this->showWith = ['role:id,name'];
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
        $this->beforeUpdate = function ($request) {
            if ($request->password)
                $request->merge(['password' => Hash::make($request->password)]);
        };
    }
}
