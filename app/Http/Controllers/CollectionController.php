<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\UserGameCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CollectionController extends Controller
{
    public function index()
    {
        return view('collection.index', [
            'items' => UserGameCollection::with('game')
                ->where('user_id', Auth::id())
                ->orderByDesc('added_at')
                ->paginate(10),
            'games' => Game::orderBy('title')->get(),
            'statuses' => $this->statuses(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_id' => [
                'required',
                'integer',
                'exists:games,id',
                Rule::unique('user_game_collections', 'game_id')->where('user_id', Auth::id()),
            ],
            'status' => ['required', Rule::in($this->statuses())],
            'rating' => ['nullable', 'integer', 'between:1,10'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);
        $validated = $this->normalizeWishlistRating($validated);

        UserGameCollection::create([
            ...$validated,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('collection.index')->with('status', 'Game aan collectie toegevoegd.');
    }

    public function update(Request $request, int $gameId)
    {
        UserGameCollection::where('user_id', Auth::id())
            ->where('game_id', $gameId)
            ->firstOrFail();

        $validated = $request->validate([
            'status' => ['required', Rule::in($this->statuses())],
            'rating' => ['nullable', 'integer', 'between:1,10'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);
        $validated = $this->normalizeWishlistRating($validated);

        UserGameCollection::where('user_id', Auth::id())
            ->where('game_id', $gameId)
            ->update($validated);

        return redirect()->route('collection.index')->with('status', 'Collectie-item bijgewerkt.');
    }

    public function destroy(int $gameId)
    {
        UserGameCollection::where('user_id', Auth::id())
            ->where('game_id', $gameId)
            ->delete();

        return redirect()->route('collection.index')->with('status', 'Collectie-item verwijderd.');
    }

    private function statuses(): array
    {
        return ['wishlist', 'playing', 'completed', 'dropped'];
    }

    private function normalizeWishlistRating(array $validated): array
    {
        if (($validated['status'] ?? null) === 'wishlist') {
            $validated['rating'] = null;
        }

        return $validated;
    }
}
