<?php

namespace Database\Seeders;

use App\Models\Player;
use Illuminate\Database\Seeder;

class PlayersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Player::factory()->count(4)
        ->sequence(
            [
                'name' => 'Fischer, Robert James',
                'country' => 'USA',
            ],
            [
                'name' => 'Spassky, Boris V',
                'country' => 'USSR',
            ],
            [
                'name' => 'Polgar, Judit',
                'country' => 'Hungary',
            ],
            [
                'name' => 'Mamedyarov, Shakhriyar',
                'country' => 'Azerbaijan',
            ],
        )
        ->create();
    }
}