<?php

namespace Database\Seeders;

use App\Models\Opening;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OpeningsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $openings = [
            [
                'eco' => 'C80',
                'name' => 'Ruy Lopez: Open, Karpov Gambit',
            ],

            [
                'eco' => 'B97',
                'name' => 'Sicilian Defense: Najdorf Variation, Poisoned Pawn Variation',
            ],

            [
                'eco' => 'D59',
                'name' => "Queen's Gambit Declined: Tartakower Defense",
            ],

            [
                'eco' => 'D02',
                'name' => "Queen Pawn Game: London System",
            ],

            [
                'eco' => 'E69',
                'name' => "King's Indian Defense: Fianchetto Variation. Classical main line",
            ],


            [
                'eco' => 'D92',
                'name' => "Gruenfeld Defense: Three Knights Variation. Hungarian Attack",
            ],


            [
                'eco' => 'D44',
                'name' => "Semi-Slav Defense: Botvinnik Variation",
            ],


            [
                'eco' => 'B01',
                'name' => "Scandinavian Defense: Modern. Gipslis Variation",
            ],


            [
                'eco' => 'B04',
                'name' => "Alekhine Defense: Modern. Alburt Variation",
            ],

            [
                'eco' => 'E97',
                'name' => "King's Indian Defense: Orthodox Variation. Modern System",
            ],

            [
                'eco' => 'C89',
                'name' => "Spanish Game: Marshall Attack. Original Marshall Attack",
            ],


            [
                'eco' => 'E06',
                'name' => "Catalan Opening: Closed",
            ],


            [
                'eco' => 'E62',
                'name' => "King's Indian Defense: Fianchetto Variation, Kavalek Defense",
            ],

            [
                'eco' => 'B06',
                'name' => " Pirc Defense: General",
            ],

            [
                'eco' => 'B51',
                'name' => "Sicilian Defense: Canal Attack",
            ],

            [
                'eco' => 'B81',
                'name' => "Sicilian Defense: Scheveningen Variation. Delayed Keres Attack Perenyi Gambit",
            ],

            [
                'eco' => 'A85',
                'name' => "Dutch Defense: Queen's Knight Variation",
            ],

            [
                'eco' => 'C52',
                'name' => "Italian Game: Evans Gambit. Pierce Defense",
            ],

            [
                'eco' => 'B12',
                'name' => "Caro-Kann Defense: Advance. Short Variation",
            ],


            [
                'eco' => 'D37',
                'name' => "Queen's Gambit Declined: Harrwitz Attack. Fianchetto Defense",
            ],

            [
                'eco' => 'D05',
                'name' => "Rubinstein Opening",
            ],


            [
                'eco' => 'C41',
                'name' => "Philidor Defense: General",
            ],

            [
                'eco' => 'D47',
                'name' => "Semi-Slav Defense: Meran Variation",
            ],

            [
                'eco' => 'A01',
                'name' => "Nimzo-Larsen Attack: Modern Variation",
            ],

        ];

        foreach ($openings as $opening) {
            Opening::create($opening);
        }
    }
}
