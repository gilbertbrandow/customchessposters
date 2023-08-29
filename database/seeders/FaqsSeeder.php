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
                'featured' => true, 
            ],

            [
                'question' => "I can't load my game from Lichess.org?",
                'answer' => 'Make sure you are using a URL to an actual game. Such a URL needs to contain the ID of the game, which is a slug of 7 seemingly random characters looking something like this: "/hkbzzjQc". If you are looking for a master game on lichess, you might try going to the <a href="https://lichess.org/analysis">analysis board</a>, input the first moves and then select the game from the opening explorer.',
                'featured' => true, 
            ],

            [
                'question' => "Where do you ship?",
                'answer' => 'We ship worldwide. This however excludes a select few countries for geo-political and idelogical reasons. To get a full list of countries we ship to and more about our terms of shipping, please see our <a href="/shipping-policy">shipping policy</a>.',
                'featured' => true, 
            ],
            [
                'question' => "What is the estimated delivery time?",
                'answer' => 'Short answer is, it depends on where in the world you want to ship too. Estimates can range from 1 week up to 4. Please do keep in mind that since the posters need to be printed on demand, the fulfillment process for each order is a bit more time-consuming. In the checkout process, after you have filled in your shipping information, we will caclulate the shipping options for you and with each option you will see estimated delivery dates. You might find it helpful simply to start a checkout to get an exact estimate for a specific order.',
                'featured' => true, 
            ],
            [
                'question' => "I have encountered a problem/bug?",
                'answer' => 'We apologise for the inconvenience. Please do <a href="/contact">reach out to us at</a> with a description of the issue. You are also very welcome to send in ideas for features and designs. We value input from our customers very highly.',
                'featured' => true, 
            ],
        ]; 

        foreach($faqs as $faq){

            if($record = Faq::where('question', $faq['question'])->where('answer', $faq['answer'])->first()) {
                $record->update(['featured' => $faq['featured']]); 
            } else {
                Faq::create($faq);
            }

        }
    }
}
