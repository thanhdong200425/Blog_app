<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    @vite('resources/css/main/home.css')
    @yield('css-file')
</head>

<body>
    <header>
        <div class="navbar">
            <a href="{{ route('main') }}" class="logo">
                <img src="https://viblo.asia/logo_full.svg" alt="Logo">
            </a>
            <nav>
                <ul class="nav-button">
                    <li><a href="{{ route('main') }}" class="active" id="main">Post</a></li>
                    <li><a href="{{ route('ask') }}" id="ask">Ask</a></li>
                    <li><a href="/discuss" id="discuss">Discuss</a></li>
                </ul>
            </nav>
            <div class="side-nav">
                <div class="search-bar">
                    <input type="text" placeholder="Search...">
                    <button type="button">
                        <img src="{{ asset('icons/search-icon.svg') }}" alt="Search" />
                    </button>
                </div>
                <a href="#" class="info-icon">
                    <img src="{{ asset('icons/info-icon.svg') }}" alt="Info" id="info">
                </a>
                <a href="#" class="avatar-button">
                    <img src="{{ $avatarSrc }}" alt="Avatar source" />
                </a>
                <div class="user-modal" id="userModal">
                    <div class="modal-header">
                        <img src="{{ $avatarSrc }}" alt="User Avatar" />
                        <div class="user-info">
                            <h4>{{ $userName }}</h4>
                        </div>
                    </div>
                    <div class="modal-body">
                        <a href="#"><i class="fas fa-user"></i>Profile</a>
                        <hr>
                        <form method="post" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                            <a href="#" class="logout" id="logout"><i class="fas fa-sign-out-alt"></i>Log
                                Out</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        @section('main-part')
        @show
    </main>

    @vite('resources/js/home.js');
    @yield('scripts')
</body>

</html>
