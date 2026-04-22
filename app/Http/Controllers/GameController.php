<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Models\Game;
use App\Models\Genre;
use App\Models\Platform;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        return view('games.index', [
            'games' => Game::with(['developer', 'genres', 'platforms'])
                ->orderBy('title')
                ->paginate(10),
            'developers' => Developer::orderBy('name')->get(),
            'genres' => Genre::orderBy('name')->get(),
            'platforms' => Platform::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateGame($request);

        $game = Game::create($validated);
        $game->genres()->sync($request->input('genre_ids', []));
        $game->platforms()->sync($request->input('platform_ids', []));

        return redirect()->route('games.index')->with('status', 'Game toegevoegd.');
    }

    public function edit(Game $game)
    {
        return view('games.edit', [
            'game' => $game->load(['genres', 'platforms']),
            'developers' => Developer::orderBy('name')->get(),
            'genres' => Genre::orderBy('name')->get(),
            'platforms' => Platform::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Game $game)
    {
        $validated = $this->validateGame($request);

        $game->update($validated);
        $game->genres()->sync($request->input('genre_ids', []));
        $game->platforms()->sync($request->input('platform_ids', []));

        return redirect()->route('games.index')->with('status', 'Game bijgewerkt.');
    }

    public function destroy(Game $game)
    {
        $game->delete();

        return redirect()->route('games.index')->with('status', 'Game verwijderd.');
    }

    private function validateGame(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'release_date' => ['nullable', 'date'],
            'pegi_age' => ['nullable', 'integer', 'between:3,18'],
            'developer_id' => ['required', 'exists:developers,id'],
            'genre_ids' => ['array'],
            'genre_ids.*' => ['integer', 'exists:genres,id'],
            'platform_ids' => ['array'],
            'platform_ids.*' => ['integer', 'exists:platforms,id'],
        ]);
    }
}
