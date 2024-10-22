<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\CourseLike;
use Exception;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function wishList() {
        try {
            $data = [];
            $data['liked_course'] = CourseLike::where('user_id', Auth::id())->with('course.category')->get()->pluck('course');


            return retRes('Fetched liked course data for wish list page', $data);
        } catch (Exception $e) {
            return retRes('Something went wrong', null, 500);
        }
    }
}
