@extends('authentication.layout')

@section('title', 'Sign in')

@section('heading', 'Sign in into Viblo')

@section('button-name', 'Sign in')

@section('form-route', route('signIn'))


@section('input-field')
    @if (session('success'))
        <div class="success-container">
            <div class="success-message">
                <svg viewBox="0 0 24 24" class="check-icon">
                    <path fill="currentColor"
                        d="M20,12A8,8 0 0,1 12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4C12.76,4 13.5,4.11 14.2,4.31L15.77,2.74C14.61,2.26 13.34,2 12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12M7.91,10.08L6.5,11.5L11,16L21,6L19.59,4.58L11,13.17L7.91,10.08Z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif
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

@section('scripts')
    @vite('resources/js/signIn.js')
@endsection
