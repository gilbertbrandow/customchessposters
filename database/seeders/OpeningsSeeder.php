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

        Opening::factory()->count(4)
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
        )
        ->create();
    }
}
