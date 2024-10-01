<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends DatabaseCrudController
{

    public function __construct()
    {
        parent::__construct(new User());

    }

    public function show($id, $with = ['role:id,name'], $callBackBefore = false, $callBackAfter = false) {
        return parent::show($id, $with, $callBackBefore, $callBackAfter);
    }
}
