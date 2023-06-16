<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faqs = [
            [
                'question' => 'Why am I not able to input a specific move?',
                'answer' => 'Our builder only allows for legal chess games. This means that the moves you make have to be allowed according the rules of chess. If you are certain your move is legal please make sure you are using correct SAN notation. For guidelines regarding algebraic notations, please see this <a href="https://www.chess.com/terms/chess-notation">great article on Chess Notation</a>.',
            ],

            [
                'question' => "I can't load my game from Lichess.org?",
                'answer' => 'Make sure you are using a URL to an actual game. Such a URL needs to contain the ID of the game, which is a slug of 7 seemingly random characters looking something like this: "/hkbzzjQc". If you are looking for a master game on lichess, you might try going to the <a href="https://lichess.org/analysis">analysis board</a>, input the first moves and then select the game from the opening explorer.',
            ],
        ]; 

        foreach($faqs as $faq){
            Faq::create($faq);
        }
    }
}
