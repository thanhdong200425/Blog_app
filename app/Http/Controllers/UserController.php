<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $credentials = $request->only('username', 'password');

        // Get user by retrieve username
        if (!Auth::attempt($credentials))
            return redirect()->route('signIn')->withErrors(['error' => 'Your password is not correct']);

        // Regenerate sessionID after log-in
        $request->session()->regenerate();

        return redirect()->route('main')->with('success', 'Welcome back');
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

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('signIn')->with('success', 'Logout successfully');
    }

    public function show()
    {
        return view('main.user.profile', ['user' => Auth::user(), 'articles' => Auth::user()->articles]);
    }

    public function update()
    {
        return view('main.user.update-profile', ['user' => Auth::user()]);
    }

    public function save(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('signIn');
        }

        // Validate request data
        $validatedData = $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
        ]);

        // Update user profile
        $user->fill($validatedData)->save();

        return redirect()->route('showProfile')->with('success', 'Profile updated successfully');
    }

}
