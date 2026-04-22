<?php

namespace Database\Seeders;

use App\Models\Developer;
use App\Models\Game;
use App\Models\Genre;
use App\Models\Platform;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => 'password',
        ]);

        $demoMember = User::factory()->create([
            'name' => 'Demo Member',
            'email' => 'member@example.com',
            'role' => 'member',
            'password' => 'password',
        ]);

        $extraMembers = User::factory()->count(8)->create(['role' => 'member']);

        $developers = collect([
            ['name' => 'Nintendo', 'country' => 'Japan', 'founded_year' => 1889],
            ['name' => 'FromSoftware', 'country' => 'Japan', 'founded_year' => 1986],
            ['name' => 'CD Projekt Red', 'country' => 'Poland', 'founded_year' => 2002],
            ['name' => 'Rockstar North', 'country' => 'United Kingdom', 'founded_year' => 1988],
            ['name' => 'Santa Monica Studio', 'country' => 'United States', 'founded_year' => 1999],
            ['name' => 'Insomniac Games', 'country' => 'United States', 'founded_year' => 1994],
            ['name' => 'Larian Studios', 'country' => 'Belgium', 'founded_year' => 1996],
            ['name' => 'id Software', 'country' => 'United States', 'founded_year' => 1991],
            ['name' => 'Mojang Studios', 'country' => 'Sweden', 'founded_year' => 2009],
            ['name' => 'Respawn Entertainment', 'country' => 'United States', 'founded_year' => 2010],
        ])->mapWithKeys(fn (array $data) => [$data['name'] => Developer::create($data)]);

        $genres = collect([
            'Action',
            'Adventure',
            'RPG',
            'Shooter',
            'Platformer',
            'Sandbox',
            'Open World',
            'Survival',
            'Horror',
            'Puzzle',
            'Racing',
            'Strategy',
        ])->mapWithKeys(fn (string $name) => [$name => Genre::create(['name' => $name])]);

        $platforms = collect([
            ['name' => 'Nintendo Switch', 'manufacturer' => 'Nintendo', 'release_year' => 2017],
            ['name' => 'PlayStation 4', 'manufacturer' => 'Sony', 'release_year' => 2013],
            ['name' => 'PlayStation 5', 'manufacturer' => 'Sony', 'release_year' => 2020],
            ['name' => 'Xbox One', 'manufacturer' => 'Microsoft', 'release_year' => 2013],
            ['name' => 'Xbox Series X', 'manufacturer' => 'Microsoft', 'release_year' => 2020],
            ['name' => 'PC', 'manufacturer' => 'Various', 'release_year' => 1981],
            ['name' => 'Steam Deck', 'manufacturer' => 'Valve', 'release_year' => 2022],
            ['name' => 'Nintendo Wii U', 'manufacturer' => 'Nintendo', 'release_year' => 2012],
            ['name' => 'iOS', 'manufacturer' => 'Apple', 'release_year' => 2007],
            ['name' => 'Android', 'manufacturer' => 'Google', 'release_year' => 2008],
        ])->mapWithKeys(fn (array $data) => [$data['name'] => Platform::create($data)]);

        $gamesData = [
            ['title' => 'The Legend of Zelda: Breath of the Wild', 'release_date' => '2017-03-03', 'pegi_age' => 12, 'developer' => 'Nintendo', 'genres' => ['Action', 'Adventure', 'Open World'], 'platforms' => ['Nintendo Switch', 'Nintendo Wii U']],
            ['title' => 'The Legend of Zelda: Tears of the Kingdom', 'release_date' => '2023-05-12', 'pegi_age' => 12, 'developer' => 'Nintendo', 'genres' => ['Action', 'Adventure', 'Open World'], 'platforms' => ['Nintendo Switch']],
            ['title' => 'Super Mario Odyssey', 'release_date' => '2017-10-27', 'pegi_age' => 7, 'developer' => 'Nintendo', 'genres' => ['Action', 'Platformer'], 'platforms' => ['Nintendo Switch']],
            ['title' => 'Elden Ring', 'release_date' => '2022-02-25', 'pegi_age' => 16, 'developer' => 'FromSoftware', 'genres' => ['Action', 'RPG', 'Open World'], 'platforms' => ['PlayStation 5', 'PlayStation 4', 'Xbox Series X', 'Xbox One', 'PC']],
            ['title' => 'Dark Souls III', 'release_date' => '2016-04-12', 'pegi_age' => 16, 'developer' => 'FromSoftware', 'genres' => ['Action', 'RPG'], 'platforms' => ['PlayStation 4', 'Xbox One', 'PC']],
            ['title' => 'Sekiro: Shadows Die Twice', 'release_date' => '2019-03-22', 'pegi_age' => 18, 'developer' => 'FromSoftware', 'genres' => ['Action', 'Adventure'], 'platforms' => ['PlayStation 4', 'Xbox One', 'PC']],
            ['title' => 'Cyberpunk 2077', 'release_date' => '2020-12-10', 'pegi_age' => 18, 'developer' => 'CD Projekt Red', 'genres' => ['RPG', 'Open World', 'Action'], 'platforms' => ['PlayStation 5', 'PlayStation 4', 'Xbox Series X', 'Xbox One', 'PC']],
            ['title' => 'The Witcher 3: Wild Hunt', 'release_date' => '2015-05-19', 'pegi_age' => 18, 'developer' => 'CD Projekt Red', 'genres' => ['RPG', 'Adventure', 'Open World'], 'platforms' => ['PlayStation 5', 'PlayStation 4', 'Xbox Series X', 'Xbox One', 'PC', 'Nintendo Switch']],
            ['title' => 'Grand Theft Auto V', 'release_date' => '2013-09-17', 'pegi_age' => 18, 'developer' => 'Rockstar North', 'genres' => ['Action', 'Open World'], 'platforms' => ['PlayStation 5', 'PlayStation 4', 'Xbox Series X', 'Xbox One', 'PC']],
            ['title' => 'Red Dead Redemption 2', 'release_date' => '2018-10-26', 'pegi_age' => 18, 'developer' => 'Rockstar North', 'genres' => ['Action', 'Adventure', 'Open World'], 'platforms' => ['PlayStation 4', 'Xbox One', 'PC']],
            ['title' => 'God of War Ragnarok', 'release_date' => '2022-11-09', 'pegi_age' => 18, 'developer' => 'Santa Monica Studio', 'genres' => ['Action', 'Adventure'], 'platforms' => ['PlayStation 5', 'PlayStation 4']],
            ['title' => 'Marvel Spider-Man 2', 'release_date' => '2023-10-20', 'pegi_age' => 16, 'developer' => 'Insomniac Games', 'genres' => ['Action', 'Adventure', 'Open World'], 'platforms' => ['PlayStation 5']],
            ['title' => 'Ratchet & Clank: Rift Apart', 'release_date' => '2021-06-11', 'pegi_age' => 7, 'developer' => 'Insomniac Games', 'genres' => ['Action', 'Platformer', 'Shooter'], 'platforms' => ['PlayStation 5', 'PC']],
            ['title' => 'Baldurs Gate 3', 'release_date' => '2023-08-03', 'pegi_age' => 18, 'developer' => 'Larian Studios', 'genres' => ['RPG', 'Strategy', 'Adventure'], 'platforms' => ['PlayStation 5', 'PC']],
            ['title' => 'DOOM Eternal', 'release_date' => '2020-03-20', 'pegi_age' => 18, 'developer' => 'id Software', 'genres' => ['Shooter', 'Action'], 'platforms' => ['PlayStation 5', 'PlayStation 4', 'Xbox Series X', 'Xbox One', 'PC', 'Nintendo Switch']],
            ['title' => 'Minecraft', 'release_date' => '2011-11-18', 'pegi_age' => 7, 'developer' => 'Mojang Studios', 'genres' => ['Sandbox', 'Survival', 'Adventure'], 'platforms' => ['PlayStation 5', 'PlayStation 4', 'Xbox Series X', 'Xbox One', 'PC', 'Nintendo Switch', 'iOS', 'Android']],
            ['title' => 'Apex Legends', 'release_date' => '2019-02-04', 'pegi_age' => 16, 'developer' => 'Respawn Entertainment', 'genres' => ['Shooter', 'Action'], 'platforms' => ['PlayStation 5', 'PlayStation 4', 'Xbox Series X', 'Xbox One', 'PC', 'Nintendo Switch']],
            ['title' => 'Star Wars Jedi: Survivor', 'release_date' => '2023-04-28', 'pegi_age' => 16, 'developer' => 'Respawn Entertainment', 'genres' => ['Action', 'Adventure'], 'platforms' => ['PlayStation 5', 'Xbox Series X', 'PC']],
            ['title' => 'Luigis Mansion 3', 'release_date' => '2019-10-31', 'pegi_age' => 7, 'developer' => 'Nintendo', 'genres' => ['Adventure', 'Puzzle'], 'platforms' => ['Nintendo Switch']],
            ['title' => 'Metroid Dread', 'release_date' => '2021-10-08', 'pegi_age' => 12, 'developer' => 'Nintendo', 'genres' => ['Action', 'Adventure', 'Platformer'], 'platforms' => ['Nintendo Switch']],
        ];

        $games = collect($gamesData)->map(function (array $gameData) use ($developers, $genres, $platforms) {
            $game = Game::create([
                'title' => $gameData['title'],
                'release_date' => $gameData['release_date'],
                'pegi_age' => $gameData['pegi_age'],
                'developer_id' => $developers[$gameData['developer']]->id,
            ]);

            $game->genres()->sync(collect($gameData['genres'])->map(fn (string $name) => $genres[$name]->id)->all());
            $game->platforms()->sync(collect($gameData['platforms'])->map(fn (string $name) => $platforms[$name]->id)->all());

            return $game;
        });

        $statuses = ['wishlist', 'playing', 'completed', 'dropped'];
        $allUsers = collect([$admin, $demoMember])->merge($extraMembers);

        foreach ($allUsers as $user) {
            $selectedGames = $games->shuffle()->take(random_int(6, 12));

            foreach ($selectedGames as $game) {
                $status = $statuses[array_rand($statuses)];
                $rating = $status === 'wishlist' ? null : random_int(1, 10);

                $user->games()->syncWithoutDetaching([
                    $game->id => [
                        'status' => $status,
                        'rating' => $rating,
                        'notes' => "Seeder-opmerking voor {$game->title}",
                    ],
                ]);
            }
        }
    }
}
