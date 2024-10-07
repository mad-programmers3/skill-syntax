<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Supports\BaseCrudHelper;

class ReviewController extends Controller
{
    use BaseCrudHelper;

    public function __construct() {
        $this->model = new Review();
        $this->with = ['user'];
    }
}
