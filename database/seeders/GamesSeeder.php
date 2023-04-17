<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Game::factory()->count(1)
            ->sequence(
                [
                    'poster_id' => 1,
                    'name' => 'Fischer - Spassky, World Championship 1972, Game 6',
                    'description' => 'Shockingly, Fischer opted out of his "1. e4, best by test" in the crucial Game 6 of the perhaps most iconic World Championship match of all time. After a brilliant victory by Fischer, Spassky rose to his feet and applauded his opponent.',
                    'when' => '1972-07-23',
                    'white_player' => 1,
                    'black_player' => 2,
                    'world_championship_game' => 1,
                    'opening_id' => 3,
                ],
            )
            ->create();
    }
}
