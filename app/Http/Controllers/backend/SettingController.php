<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Supports\BaseCrudHelper;

class SettingController extends Controller
{
    use BaseCrudHelper;

    public function __construct()
    {
        $this->model = new Setting();
    }
}
