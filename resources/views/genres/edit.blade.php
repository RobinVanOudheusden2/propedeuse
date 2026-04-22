@extends('layouts.app')

@section('content')
    <h1>Genre wijzigen</h1>
    <div class="card">
        <form method="POST" action="{{ route('genres.update', $genre) }}" class="stack">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @method('PUT')
            <div>
                <label for="name">Naam</label>
                <input id="name" name="name" value="{{ old('name', $genre->name) }}" required>
            </div>
            <div>
                <button class="btn btn-primary" type="submit">Opslaan</button>
                <a class="btn" href="{{ route('genres.index') }}">Annuleren</a>
            </div>
        </form>
    </div>
@endsection
