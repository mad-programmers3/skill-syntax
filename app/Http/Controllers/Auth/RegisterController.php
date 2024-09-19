<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // Validation with unique email check
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed', // Added confirmation rule
        ]);

        // Create user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect after successful registration
        return redirect()->route('login')->with('success', 'Registration successful.');
    }
}