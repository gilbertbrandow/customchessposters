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

        Player::factory()->count(11)
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

            [
                'name' => 'Liren, Ding',
                'country' => 'China',
            ],

            [
                'name' => 'Nepomniachtchi, Ian',
                'country' => 'Russia',
            ],

            [
                'name' => 'Byrne, Donald',
                'country' => 'USA',
            ],

            [
                'name' => 'Botvinnik, Mikhail',
                'country' => 'USSR',
            ],

            [
                'name' => 'Tal, Mikhail',
                'country' => 'USSR',
            ],

            [
                'name' => 'Cramling, Pia',
                'country' => 'Sweden',
            ],

            [
                'name' => 'Galliamova, Alisa',
                'country' => 'Russia',
            ],
        )
        ->create();
    }
}
