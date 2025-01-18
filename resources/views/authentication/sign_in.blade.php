@extends('authentication.layout')

@section('title', 'Sign in')

@section('heading', 'Sign in into Viblo')

@section('button-name', 'Sign in')

@section('form-route', route('signIn'))


@section('input-field')
    <div class="input-field">
        <div class="icon-container">
            <img src="{{ asset('icons/person-icon.svg') }}" alt="Icon" />
        </div>
        <input type="text" placeholder="Username" name="username" required />
    </div>

    <div class="input-field">
        <div class="icon-container">
            <img src="{{ asset('icons/lock-icon.svg') }}" alt="Icon" />
        </div>
        <input type="password" placeholder="Password" name="password" required />
    </div>
@endsection

@section('links')
    <div class="links">
        <div>
            <a href="#">Forgot password?</a>
        </div>

        <div>
            <a href="{{ route('signUp') }}">Create new account</a>
        </div>
    </div>
@endsection
