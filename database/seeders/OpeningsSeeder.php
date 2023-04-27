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

        Opening::factory()->count(10)
        ->sequence(
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

        )
        ->create();
    }
}
