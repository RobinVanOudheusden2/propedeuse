@extends('layouts.app')

@section('content')
    <h1>Platforms</h1>

    <div class="card">
        <h2>Nieuw platform</h2>
        <form method="POST" action="{{ route('platforms.store') }}" class="grid">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div>
                <label for="name">Naam</label>
                <input id="name" name="name" value="{{ old('name') }}" required>
            </div>
            <div>
                <label for="manufacturer">Fabrikant</label>
                <input id="manufacturer" name="manufacturer" value="{{ old('manufacturer') }}">
            </div>
            <div>
                <label for="release_year">Releasejaar</label>
                <input id="release_year" type="number" name="release_year" value="{{ old('release_year') }}">
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
                    <th>Naam</th>
                    <th>Fabrikant</th>
                    <th>Releasejaar</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($platforms as $platform)
                    <tr>
                        <td>{{ $platform->name }}</td>
                        <td>{{ $platform->manufacturer ?? '-' }}</td>
                        <td>{{ $platform->release_year ?? '-' }}</td>
                        <td>
                            <a class="btn inline" href="{{ route('platforms.edit', $platform) }}">Wijzigen</a>
                            <form class="inline" method="POST" action="{{ route('platforms.destroy', $platform) }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Verwijderen</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4">Nog geen platforms.</td></tr>
                @endforelse
            </tbody>
        </table>

        {{ $platforms->links('vendor.pagination.app') }}
    </div>
@endsection
