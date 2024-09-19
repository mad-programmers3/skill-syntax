<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){

        return view('auth.login');
    }

    public function doLogin(Request $request){

        $credentialls = $request->except('_token');

        $auth = Auth::attempt($credentialls);

        if($auth){

            return redirect('/admin/Dashboard');
        }

        return redirect('/login')->with('error', 'UserName or Password Invalid');
    }


    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
