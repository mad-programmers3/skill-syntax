<?php

namespace App\Http\Controllers\backend;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends DatabaseCrudController
{
    public function __construct() {
        parent::__construct(new Review());
    }

    public function index($with = ['user'], $callBackBefore = false, $callBackAfter = false)
    {
        return parent::index($with, $callBackBefore, $callBackAfter);
    }
}
