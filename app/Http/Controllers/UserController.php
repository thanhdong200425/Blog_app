<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function signIn(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        echo "{$username} + {$password}";
    }

    public function signUp(Request $request)
    {
        // Validate user inputs
        $validateResult = Validator::make($request->all(), [
            'username' => 'required|unique:App\Models\User,username',
            'password' => 'required',
            'confirmPassword' => 'required|same:password'
        ]);

        // If fail, redirect page with errors and previous input
        if ($validateResult->fails())
            return redirect()->route('signUp')->withErrors($validateResult)->withInput();

        // Get info from validated data
        $username = $validateResult->validated()['username'];
        $password = $validateResult->validated()['password'];


        // Create a new User and add it into database
        $user = User::create([
            'username' => $username,
            'hashed_password' => bcrypt($password)
        ]);
        return redirect()->route('signIn');
    }
}
