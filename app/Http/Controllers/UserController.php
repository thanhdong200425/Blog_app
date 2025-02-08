<?php

namespace App\Http\Controllers;

use App\Contract\UserRepositoryInterface;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function signIn(Request $request)
    {
        // Validate user inputs
        $validateResult = self::validateUserInputs($request, [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required']
        ], 'signIn');

        if ($validateResult instanceof RedirectResponse)
            return $validateResult;

        $credentials = $request->only('email', 'password');

        // Get user by retrieve email
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
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'password' => ['required'],
            'confirmPassword' => ['required', 'same:password']
        ], 'signUp');

        if ($validateResult instanceof RedirectResponse)
            return $validateResult;

        // Get info from validated data
        $username = $validateResult['email'];
        $password = $validateResult['password'];


        // Create a new User and add it into database
        $user = User::create([
            'email' => $username,
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
        if (!Auth::check())
            return redirect()->route('signIn');
        // Validate request data
        $validatedData = $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'image_url' => 'nullable|image|max:2000'
        ]);
        if ($validatedData['image_url'])
            $validatedData['image_url'] = $this::uploadFile($validatedData['image_url'], $user->image_url);
        $updateResult = $this->userRepository->update($user->id, $validatedData);
        if ($updateResult)
            return redirect()->route('showProfile')->with('success', 'Profile updated successfully');
        return redirect()->route('showProfile')->with('error', "No change were maded");
    }

    public static function uploadFile($imageFile, $oldImagePath = null)
    {
        if ($oldImagePath) {
            $relativePathOfOldImage = str_replace(asset('storage'), '', $oldImagePath);
            Storage::disk('public')->delete($relativePathOfOldImage);
        }
        $filePath = $imageFile->store('uploads', 'public');
        $fileUrl = asset('storage/' . $filePath);
        return $fileUrl;
    }

}
