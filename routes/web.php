<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAuthenticatedForUser;
use App\Http\Middleware\RedirectIfLoggedIn;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('signIn');
});

// Authenticated routes
Route::middleware(RedirectIfLoggedIn::class)->group(function () {
    Route::get('/sign-in', function () {
        return view('authentication.sign_in');
    })->name('signIn');

    Route::post('/sign-in', [UserController::class, 'signIn'])->name('postSignIn');

    Route::get('/sign-up', function () {
        return view('authentication.sign_up');
    })->name('signUp');

    Route::post('/sign-up', [UserController::class, 'signUp'])->name('postSignUp');
});

Route::get('/main', [ArticleController::class, 'show'])->name('main')->middleware(CheckAuthenticatedForUser::class);
