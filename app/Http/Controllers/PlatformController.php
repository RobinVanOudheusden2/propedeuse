<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PlatformController extends Controller
{
    public function index()
    {
        return view('platforms.index', [
            'platforms' => Platform::orderBy('name')->paginate(10),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:80', 'unique:platforms,name'],
            'manufacturer' => ['nullable', 'string', 'max:80'],
            'release_year' => ['nullable', 'integer', 'between:1970,'.date('Y')],
        ]);

        Platform::create($validated);

        return redirect()->route('platforms.index')->with('status', 'Platform toegevoegd.');
    }

    public function edit(Platform $platform)
    {
        return view('platforms.edit', [
            'platform' => $platform,
        ]);
    }

    public function update(Request $request, Platform $platform)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:80', Rule::unique('platforms', 'name')->ignore($platform->id)],
            'manufacturer' => ['nullable', 'string', 'max:80'],
            'release_year' => ['nullable', 'integer', 'between:1970,'.date('Y')],
        ]);

        $platform->update($validated);

        return redirect()->route('platforms.index')->with('status', 'Platform bijgewerkt.');
    }

    public function destroy(Platform $platform)
    {
        $platform->delete();

        return redirect()->route('platforms.index')->with('status', 'Platform verwijderd.');
    }
}
