<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <a href="#" class="logo">
                <img src="https://viblo.asia/logo_full.svg" alt="Logo">
            </a>
            <nav>
                <ul>
                    <li><a href="/post" class="active">Post</a></li>
                    <li><a href="/ask">Ask</a></li>
                    <li><a href="/discuss">Discuss</a></li>
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
            </div>
        </div>
    </header>
    <main>
        @section('main-part')
        @show
    </main>
</body>

</html>
