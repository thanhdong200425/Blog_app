<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sign-in', function () {
    return view('authentication.sign_in');
})->name('signIn');

Route::post('/sign-in', [UserController::class, 'signIn'])->name('postSignIn');
Route::post('/sign-up', [UserController::class, 'signUp'])->name('postSignUp');

Route::get('/sign-up', function () {
    return view('authentication.sign_up');
})->name('signUp');
