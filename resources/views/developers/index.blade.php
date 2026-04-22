@extends('layouts.app')

@section('content')
    <h1>Developers</h1>

    <div class="card">
        <h2>Nieuwe developer</h2>
        <form method="POST" action="{{ route('developers.store') }}" class="grid">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div>
                <label for="name">Naam</label>
                <input id="name" name="name" value="{{ old('name') }}" required>
            </div>
            <div>
                <label for="country">Land</label>
                <input id="country" name="country" value="{{ old('country') }}">
            </div>
            <div>
                <label for="founded_year">Opgericht in</label>
                <input id="founded_year" type="number" name="founded_year" value="{{ old('founded_year') }}">
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
                    <th>Land</th>
                    <th>Opgericht</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($developers as $developer)
                    <tr>
                        <td>{{ $developer->name }}</td>
                        <td>{{ $developer->country ?? '-' }}</td>
                        <td>{{ $developer->founded_year ?? '-' }}</td>
                        <td>
                            <a class="btn inline" href="{{ route('developers.edit', $developer) }}">Wijzigen</a>
                            <form class="inline" method="POST" action="{{ route('developers.destroy', $developer) }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Verwijderen</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4">Nog geen developers.</td></tr>
                @endforelse
            </tbody>
        </table>

        {{ $developers->links('vendor.pagination.app') }}
    </div>
@endsection
