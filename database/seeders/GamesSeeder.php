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

        $games = [

            [
                'poster_id' => 1,
                'name' => 'Fischer - Spassky, World Championship 1972, Game 6',
                'description' => 'Shockingly, Fischer opted out of his "1. e4, best by test" in the crucial Game 6 of the perhaps most iconic World Championship match of all time. After a brilliant victory by Fischer, Spassky rose to his feet and applauded his opponent.',
                'date' => '1972-07-23',
                'white_player' => 1,
                'black_player' => 2,
                'world_championship_game' => 1,
                'opening_id' => 3,
            ],

            [
                'poster_id' => 2,
                'name' => 'A masterclass in king hunts from the greatest ever female player',
                'description' => 'Solidifying her reputation as one of the greatest attacking players, Polgar goes for the head against a promising talent.',
                'date' => '2002-10-29',
                'white_player' => 3,
                'black_player' => 4,
                'world_championship_game' => 0,
                'opening_id' => 1,
            ],

            [
                'poster_id' => 3,
                'name' => 'Ding Liren manages to win with his back against the wall',
                'description' => 'The legend of Game six in the WCC has seen grueling long wins, brilliant novelties and splashes of creativity. This game checked all the boxes.',
                'date' => '2023-04-16',
                'white_player' => 5,
                'black_player' => 6,
                'world_championship_game' => 1,
                'opening_id' => 4,
            ],

            [
                'poster_id' => 4,
                'name' => 'Tal wins another famous Game 6 in WCC 1960',
                'description' => 'The principled, scientific and reigning world champion Mikhail Botvinnik faced of against the brash, creative and talented challenger Mikhail Tal in a WCC for the ages.',
                'date' => '1960-03-26',
                'white_player' => 7,
                'black_player' => 8,
                'world_championship_game' => 1,
                'opening_id' => 5,
            ],

            [
                'poster_id' => 5,
                'name' => 'Young Bobby Fischer shows a glimpse of what is to come',
                'description' => 'IM Donald Byrne, one of the top American masters at the time, had the white pieces against the young Fischer, who was still a year or two away from being well-known. But not too young to give us a true show of brilliancy.',
                'date' => '1956-10-17',
                'white_player' => 9,
                'black_player' => 1,
                'world_championship_game' => 0,
                'opening_id' => 6,
            ],

            [
                'poster_id' => 6,
                'name' => 'Pia Cramling gets an important win with a spectacular finish',
                'description' => 'The most logical way of promotion, promoting a pawn to a Queen, is almost always the best choice. Knowing when it is not takes a great player.',
                'date' => '1994-09-29',
                'white_player' => 10,
                'black_player' => 11,
                'world_championship_game' => 0,
                'opening_id' => 7,
            ],

            [
                'poster_id' => 7,
                'name' => 'Queen Sacrifice by the trailblazer Nona Gaprindashvili',
                'description' => 'With white threatening a seemingly unstoppable mate on a8, Nona (First ever female GM) pulls an ace out of her sleeve. Uncorking an aesthetically pleasing combination to take the initiative!',
                'date' => '1976-09-06',
                'white_player' => 12,
                'black_player' => 13,
                'world_championship_game' => 0,
                'opening_id' => 8,
            ],

        ];

        foreach ($games as $game) {

            Game::create($game);

            //In order to be able to sort by created_at and not get confusing results
            sleep(1);
        }
    }
}
