<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arvo:wght@400;700&family=EB+Garamond:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    @yield('css')
</head>

<body>
    @if(!Route::is('thanks'))
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                FashionablyLate
            </a>
            <nav>
                <ul class="header-nav">
                    @if (Auth::check() && request()->is('admin*'))
                    <li class="header-nav__item">
                        <form action="/logout" method="post">
                            @csrf
                            <button class="header-nav__button" type="submit">logout</button>
                        </form>
                    </li>
                    @elseif (request()->is('login'))
                    <li class="header-nav__item">
                        <a class="header-nav__link" href="/register">register</a>
                    </li>
                    @elseif (request()->is('register'))
                    <li class="header-nav__item">
                        <a class="header-nav__link" href="/login">login</a>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
    </header>
    @endif

    <main>
        @yield('content')
    </main>
</body>

</html>