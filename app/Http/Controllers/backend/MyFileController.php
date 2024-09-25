<?php

namespace App\Http\Controllers\backend;

use App\Models\MyFile;
use Illuminate\Http\Request;

class MyFileController extends DatabaseCrudController
{
    public function __construct() {
        parent::__construct(new MyFile());
    }

    public function index($with = ['user:id,name'])
    {
        return parent::index($with);
    }
}
