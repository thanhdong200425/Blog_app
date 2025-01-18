<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $username = $request->input('username');
        $password = $request->input('password');
    }
}
