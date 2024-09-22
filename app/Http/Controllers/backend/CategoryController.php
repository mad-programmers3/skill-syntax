<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends DatabaseCrudController
{
    public function __construct() {
        parent::__construct(new Category());
    }
}
