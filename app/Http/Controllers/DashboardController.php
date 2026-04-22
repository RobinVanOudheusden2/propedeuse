<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Models\Game;
use App\Models\Genre;
use App\Models\Platform;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('dashboard', [
            'counts' => [
                'games' => Game::count(),
                'genres' => Genre::count(),
                'platforms' => Platform::count(),
                'developers' => Developer::count(),
            ],
        ]);
    }
}
