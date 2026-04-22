<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DeveloperController extends Controller
{
    public function index()
    {
        return view('developers.index', [
            'developers' => Developer::orderBy('name')->paginate(10),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120', 'unique:developers,name'],
            'country' => ['nullable', 'string', 'max:80'],
            'founded_year' => ['nullable', 'integer', 'between:1800,'.date('Y')],
        ]);

        Developer::create($validated);

        return redirect()->route('developers.index')->with('status', 'Developer toegevoegd.');
    }

    public function edit(Developer $developer)
    {
        return view('developers.edit', [
            'developer' => $developer,
        ]);
    }

    public function update(Request $request, Developer $developer)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120', Rule::unique('developers', 'name')->ignore($developer->id)],
            'country' => ['nullable', 'string', 'max:80'],
            'founded_year' => ['nullable', 'integer', 'between:1800,'.date('Y')],
        ]);

        $developer->update($validated);

        return redirect()->route('developers.index')->with('status', 'Developer bijgewerkt.');
    }

    public function destroy(Developer $developer)
    {
        $developer->delete();

        return redirect()->route('developers.index')->with('status', 'Developer verwijderd.');
    }
}
