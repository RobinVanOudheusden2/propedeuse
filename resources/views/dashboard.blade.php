@extends('layouts.app')

@section('content')
    <h1>Dashboard</h1>
    <p>Welkom bij de gamebibliotheek. Gebruik het menu om data te beheren.</p>

    <div class="grid">
        <div class="card"><strong>Games:</strong> {{ $counts['games'] }}</div>
        <div class="card"><strong>Genres:</strong> {{ $counts['genres'] }}</div>
        <div class="card"><strong>Platforms:</strong> {{ $counts['platforms'] }}</div>
        <div class="card"><strong>Developers:</strong> {{ $counts['developers'] }}</div>
    </div>
@endsection
