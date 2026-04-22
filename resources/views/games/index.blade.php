@extends('layouts.app')

@section('content')
    <h1>Games</h1>

    <div class="card">
        <h2>Nieuwe game</h2>
        <form method="POST" action="{{ route('games.store') }}" class="grid">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div>
                <label for="title">Titel</label>
                <input id="title" name="title" value="{{ old('title') }}" required>
            </div>
            <div>
                <label for="developer_id">Developer</label>
                <select id="developer_id" name="developer_id" required>
                    <option value="">-- Kies developer --</option>
                    @foreach ($developers as $developer)
                        <option value="{{ $developer->id }}" @selected(old('developer_id') == $developer->id)>{{ $developer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="release_date">Releasedatum</label>
                <input id="release_date" type="date" name="release_date" value="{{ old('release_date') }}">
            </div>
            <div>
                <label for="pegi_age">PEGI leeftijd</label>
                <input id="pegi_age" type="number" name="pegi_age" value="{{ old('pegi_age') }}">
            </div>
            <div>
                <label for="genre_ids">Genres</label>
                <select id="genre_ids" name="genre_ids[]" multiple size="4">
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}" @selected(collect(old('genre_ids'))->contains($genre->id))>{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="platform_ids">Platforms</label>
                <select id="platform_ids" name="platform_ids[]" multiple size="4">
                    @foreach ($platforms as $platform)
                        <option value="{{ $platform->id }}" @selected(collect(old('platform_ids'))->contains($platform->id))>{{ $platform->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>&nbsp;</label>
                <button class="btn btn-primary" type="submit">Toevoegen</button>
            </div>
        </form>
    </div>

    <div class="card">
        <h2>Overzicht</h2>
        <table>
            <thead>
                <tr>
                    <th>Titel</th>
                    <th>Developer</th>
                    <th>Genres</th>
                    <th>Platforms</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($games as $game)
                    <tr>
                        <td>{{ $game->title }}</td>
                        <td>{{ $game->developer->name }}</td>
                        <td>{{ $game->genres->pluck('name')->implode(', ') ?: '-' }}</td>
                        <td>{{ $game->platforms->pluck('name')->implode(', ') ?: '-' }}</td>
                        <td>
                            <a class="btn inline" href="{{ route('games.edit', $game) }}">Wijzigen</a>
                            <form class="inline" method="POST" action="{{ route('games.destroy', $game) }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Verwijderen</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">Nog geen games.</td></tr>
                @endforelse
            </tbody>
        </table>

        {{ $games->links('vendor.pagination.app') }}
    </div>
@endsection
