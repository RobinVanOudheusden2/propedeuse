<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GenreController extends Controller
{
    public function index()
    {
        return view('genres.index', [
            'genres' => Genre::orderBy('name')->paginate(10),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:80', 'unique:genres,name'],
        ]);

        Genre::create($validated);

        return redirect()->route('genres.index')->with('status', 'Genre toegevoegd.');
    }

    public function edit(Genre $genre)
    {
        return view('genres.edit', [
            'genre' => $genre,
        ]);
    }

    public function update(Request $request, Genre $genre)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:80', Rule::unique('genres', 'name')->ignore($genre->id)],
        ]);

        $genre->update($validated);

        return redirect()->route('genres.index')->with('status', 'Genre bijgewerkt.');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();

        return redirect()->route('genres.index')->with('status', 'Genre verwijderd.');
    }
}
