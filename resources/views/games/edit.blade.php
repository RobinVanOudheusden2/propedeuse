@extends('layouts.app')

@section('content')
    <h1>Game wijzigen</h1>
    <div class="card">
        <form method="POST" action="{{ route('games.update', $game) }}" class="stack">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @method('PUT')
            <div>
                <label for="title">Titel</label>
                <input id="title" name="title" value="{{ old('title', $game->title) }}" required>
            </div>
            <div>
                <label for="developer_id">Developer</label>
                <select id="developer_id" name="developer_id" required>
                    @foreach ($developers as $developer)
                        <option value="{{ $developer->id }}" @selected(old('developer_id', $game->developer_id) == $developer->id)>{{ $developer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="release_date">Releasedatum</label>
                <input id="release_date" type="date" name="release_date" value="{{ old('release_date', $game->release_date?->format('Y-m-d')) }}">
            </div>
            <div>
                <label for="pegi_age">PEGI leeftijd</label>
                <input id="pegi_age" type="number" name="pegi_age" value="{{ old('pegi_age', $game->pegi_age) }}">
            </div>
            <div>
                <label for="genre_ids">Genres</label>
                <select id="genre_ids" name="genre_ids[]" multiple size="5">
                    @php $selectedGenres = collect(old('genre_ids', $game->genres->pluck('id')->all())); @endphp
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}" @selected($selectedGenres->contains($genre->id))>{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="platform_ids">Platforms</label>
                <select id="platform_ids" name="platform_ids[]" multiple size="5">
                    @php $selectedPlatforms = collect(old('platform_ids', $game->platforms->pluck('id')->all())); @endphp
                    @foreach ($platforms as $platform)
                        <option value="{{ $platform->id }}" @selected($selectedPlatforms->contains($platform->id))>{{ $platform->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button class="btn btn-primary" type="submit">Opslaan</button>
                <a class="btn" href="{{ route('games.index') }}">Annuleren</a>
            </div>
        </form>
    </div>
@endsection
