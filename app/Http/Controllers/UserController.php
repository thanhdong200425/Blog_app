<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function signIn(Request $request)
    {
        // Validate user inputs
        $validateResult = self::validateUserInputs($request, [
            'username' => ['required', 'exists:users,username'],
            'password' => ['required']
        ], 'signIn');

        if ($validateResult instanceof RedirectResponse)
            return $validateResult;

        $username = $validateResult['username'];
        $password = $validateResult['password'];

        // Get user from username
        $user = User::where('username', $username)->first();

        // Compare hashed_password with password from user input
        if (!$user || !Hash::check($password, $user->hashed_password))
            return redirect()->route('signIn')->withErrors(['error' => 'Username or password is incorrect'])->withInput();

        return redirect()->route('main');
    }

    public function signUp(Request $request)
    {
        // Validate user inputs
        $validateResult = self::validateUserInputs($request, [
            'username' => ['required', 'unique:App\Models\User,username'],
            'password' => ['required'],
            'confirmPassword' => ['required', 'same:password']
        ], 'signUp');

        if ($validateResult instanceof RedirectResponse)
            return $validateResult;

        // Get info from validated data
        $username = $validateResult['username'];
        $password = $validateResult['password'];


        // Create a new User and add it into database
        $user = User::create([
            'username' => $username,
            'hashed_password' => Hash::make($password, ['rounds' => 12])
        ]);
        return redirect()->route('signIn');
    }

    public static function validateUserInputs(Request $request, array $rules, $redirectRoute)
    {
        $validateResult = Validator::make($request->all(), $rules);
        if ($validateResult->fails())
            return redirect()->route($redirectRoute)->withErrors($validateResult)->withInput();

        return $validateResult->validated();
    }
}
