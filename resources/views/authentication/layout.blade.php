<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    @vite(['resources/css/sign_in.css'])
</head>

<body>
    {{-- Container --}}
    <div class="container">
        <div class="inside-container">
            <!-- Image -->
            <div class="logo">
                <img src="https://accounts.viblo.asia/assets/webpack/logo.fbfe575.svg" alt="Logo" />
            </div>
            <h2 class="heading">@yield('heading')</h2>
            <form method="post" action="@yield('form-route')" id="form">
                @csrf
                @section('input-field')
                @show
                @if ($errors->any())
                    <div class="error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="button-container">
                    <button type="submit" class="action-button">@yield('button-name')</button>
                </div>
            </form>

            @section('links')

            @show
            <!-- Sign in with OAuth -->
            <div class="oauth">
                <div class="oauth-description">
                    <hr />
                    <span>@yield('title') with</span>
                    <hr />
                </div>
                <div>
                    <button class="oauth-button">Google</button>
                </div>
            </div>
        </div>
    </div>

    @yield('scripts')
</body>

</html>
