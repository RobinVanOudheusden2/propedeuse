@extends('layouts.app')

@section('content')
    <h1>Developer wijzigen</h1>
    <div class="card">
        <form method="POST" action="{{ route('developers.update', $developer) }}" class="stack">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @method('PUT')
            <div>
                <label for="name">Naam</label>
                <input id="name" name="name" value="{{ old('name', $developer->name) }}" required>
            </div>
            <div>
                <label for="country">Land</label>
                <input id="country" name="country" value="{{ old('country', $developer->country) }}">
            </div>
            <div>
                <label for="founded_year">Opgericht in</label>
                <input id="founded_year" type="number" name="founded_year" value="{{ old('founded_year', $developer->founded_year) }}">
            </div>
            <div>
                <button class="btn btn-primary" type="submit">Opslaan</button>
                <a class="btn" href="{{ route('developers.index') }}">Annuleren</a>
            </div>
        </form>
    </div>
@endsection
