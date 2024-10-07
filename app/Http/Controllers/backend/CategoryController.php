<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Supports\BaseCrudHelper;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use BaseCrudHelper;

    public function __construct() {
        $this->model = new Category();
    }
}
