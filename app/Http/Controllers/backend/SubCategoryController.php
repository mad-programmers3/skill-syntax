<?php

namespace App\Http\Controllers\backend;

use App\Models\SubCategory;

class SubCategoryController extends DatabaseCrudController
{
    public function __construct() {
        parent::__construct(new SubCategory());
    }

    public function index($with = ['category:id,title'], $callBackBefore = false, $callBackAfter = false)
    {
        return parent::index($with, $callBackBefore, $callBackAfter);
    }
}
