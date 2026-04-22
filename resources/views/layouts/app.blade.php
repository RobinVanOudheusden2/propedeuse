<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Gamebibliotheek' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@auth
    <nav>
        <div class="nav-inner">
            <div class="nav-header">
                <strong>Gamebibliotheek</strong>
                <button
                    type="button"
                    class="btn nav-toggle"
                    data-nav-toggle
                    aria-expanded="false"
                    aria-controls="main-nav-menu"
                    aria-label="Hoofdmenu openen of sluiten"
                >
                    <span class="sr-only">Menu</span>
                    <span class="hamburger-icon" aria-hidden="true">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>
            <div class="nav-menu" id="main-nav-menu" data-nav-menu>
                <div class="links">
                    <a class="btn" href="{{ route('dashboard') }}">Dashboard</a>
                    <a class="btn" href="{{ route('games.index') }}">Games</a>
                    <a class="btn" href="{{ route('genres.index') }}">Genres</a>
                    <a class="btn" href="{{ route('platforms.index') }}">Platforms</a>
                    <a class="btn" href="{{ route('developers.index') }}">Developers</a>
                    <a class="btn" href="{{ route('collection.index') }}">Mijn collectie</a>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="nav-auth-actions">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn">Uitloggen ({{ auth()->user()->name }})</button>
                </form>
            </div>
        </div>
    </nav>
@endauth

<main class="container">
    @if (session('status'))
        <p class="flash">{{ session('status') }}</p>
    @endif

    @if ($errors->any())
        <div class="errors">
            <strong>Controleer je invoer:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</main>
</body>
</html>
