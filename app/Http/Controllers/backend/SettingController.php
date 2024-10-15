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

    public function index(){
        $settings = $this->model->get()->groupBy('group');

        return retRes('Successfully fetched all records', $settings);
    }
}
