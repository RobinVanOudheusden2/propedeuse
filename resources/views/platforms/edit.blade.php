@extends('layouts.app')

@section('content')
    <h1>Platform wijzigen</h1>
    <div class="card">
        <form method="POST" action="{{ route('platforms.update', $platform) }}" class="stack">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @method('PUT')
            <div>
                <label for="name">Naam</label>
                <input id="name" name="name" value="{{ old('name', $platform->name) }}" required>
            </div>
            <div>
                <label for="manufacturer">Fabrikant</label>
                <input id="manufacturer" name="manufacturer" value="{{ old('manufacturer', $platform->manufacturer) }}">
            </div>
            <div>
                <label for="release_year">Releasejaar</label>
                <input id="release_year" type="number" name="release_year" value="{{ old('release_year', $platform->release_year) }}">
            </div>
            <div>
                <button class="btn btn-primary" type="submit">Opslaan</button>
                <a class="btn" href="{{ route('platforms.index') }}">Annuleren</a>
            </div>
        </form>
    </div>
@endsection
