@extends('authentication.layout')

@section('title', 'Sign up')

@section('heading', 'Sign up into Viblo')

@section('button-name', 'Sign up')

@section('form-route', route('signUp'))

@section('input-field')
    <div class="input-field">
        <div class="icon-container">
            <img src="{{ asset('icons/person-icon.svg') }}" alt="Icon" />
        </div>
        <input type="text" placeholder="Username" name="username" value="{{ old('username') }}" required autocomplete="off" />
    </div>

    <div class="input-field" id="password-field">
        <div class="icon-container">
            <img src="{{ asset('icons/lock-icon.svg') }}" alt="Icon" />
        </div>
        <input type="password" placeholder="Password" value="{{ old('password') }}" name="password" id="password" required
            autocomplete="off" />
    </div>

    <div class="input-field" id="confirm-password-field">
        <div class="icon-container">
            <img src="{{ asset('icons/lock-icon.svg') }}" alt="Icon" />
        </div>
        <input type="password" placeholder="Confirm password" value="{{ old('confirmPassword') }}" name="confirmPassword"
            id="confirm-password" required autocomplete="off" />
    </div>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <small id="password-error" style="display: none;">Password doesn't match</small>
    <div id="password-strength">
        <div class="strength-bar">
            <div class="bar"></div>
        </div>
    </div>
@endsection

@section('links')
    <div class="links">
        <div>
            <a href="#">Forgot password?</a>
        </div>

        <div>
            <a href="{{ route('signIn') }}">Already have an account?</a>
        </div>
    </div>
@endsection

@section('scripts')
    @vite('resources/js/signUp.js')
@endsection
