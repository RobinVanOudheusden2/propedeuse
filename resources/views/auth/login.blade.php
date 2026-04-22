@extends('layouts.app')

@section('content')
    <div class="card auth-card">
        <h1>Inloggen</h1>
        <form method="POST" action="{{ route('login.attempt') }}" class="stack">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div>
                <label for="email">E-mailadres</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div>
                <label for="password">Wachtwoord</label>
                <input id="password" type="password" name="password" required>
            </div>
            <label class="checkbox-label">
                <input type="checkbox" name="remember" value="1"> Onthoud mij
            </label>
            <button class="btn btn-primary" type="submit">Inloggen</button>
        </form>
        <p>Nog geen account? <a href="{{ route('register') }}">Registreer hier</a>.</p>
    </div>
@endsection
