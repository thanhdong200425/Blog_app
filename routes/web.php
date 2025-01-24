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

// Article routes
Route::prefix('/main')->middleware(CheckAuthenticatedForUser::class)->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('main');

    Route::get('/article/{slug}-{id}', [ArticleController::class, 'show'])->where(['slug' => '[a-z0-9-]+', 'id' => '[0-9]+'])->name('article');

    Route::get('/ask', [ArticleController::class, 'showAskingPage'])->name('ask');

    Route::post('/ask', [ArticleController::class, "create"])->name('submit-asking');

    Route::post('/delete', [ArticleController::class, 'delete'])->name('deleteArticle');

    Route::get('/update/{slug}-{id}', [ArticleController::class, 'update'])->where(['slug' => '[a-z0-9-]+', 'id' => '[0-9]+'])->name('updateArticle');

    Route::post('/update', [ArticleController::class, 'save'])->name('saveArticle');
});

// Logout route
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
