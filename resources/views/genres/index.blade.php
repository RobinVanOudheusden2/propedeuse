@extends('layouts.app')

@section('content')
    <h1>Genres</h1>

    <div class="card">
        <h2>Nieuw genre</h2>
        <form method="POST" action="{{ route('genres.store') }}" class="stack">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div>
                <label for="name">Naam</label>
                <input id="name" name="name" value="{{ old('name') }}" required>
            </div>
            <button class="btn btn-primary" type="submit">Toevoegen</button>
        </form>
    </div>

    <div class="card">
        <h2>Overzicht</h2>
        <table>
            <thead>
                <tr>
                    <th>Naam</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($genres as $genre)
                    <tr>
                        <td>{{ $genre->name }}</td>
                        <td>
                            <a class="btn inline" href="{{ route('genres.edit', $genre) }}">Wijzigen</a>
                            <form class="inline" method="POST" action="{{ route('genres.destroy', $genre) }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Verwijderen</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="2">Nog geen genres.</td></tr>
                @endforelse
            </tbody>
        </table>

        {{ $genres->links('vendor.pagination.app') }}
    </div>
@endsection
