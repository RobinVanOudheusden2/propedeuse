@extends('layouts.app')

@section('content')
    <div class="card auth-card">
        <h1>Registreren</h1>
        <form method="POST" action="{{ route('register.store') }}" class="stack">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div>
                <label for="name">Naam</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required>
            </div>
            <div>
                <label for="email">E-mailadres</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div>
                <label for="password">Wachtwoord</label>
                <input id="password" type="password" name="password" required>
            </div>
            <div>
                <label for="password_confirmation">Herhaal wachtwoord</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
            </div>
            <button class="btn btn-primary" type="submit">Account maken</button>
        </form>
        <p>Al een account? <a href="{{ route('login') }}">Log in</a>.</p>
    </div>
@endsection
