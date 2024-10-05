<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Supports\BaseCrudHelper;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use BaseCrudHelper;

    public function __construct()
    {
        $this->model = new User();
        $this->showWith = ['role:id,name'];

    }
}
