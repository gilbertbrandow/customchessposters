<?php

namespace Database\Seeders;

use App\Models\PosterFrame;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PosterFramesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $variants = [

            [
                'name' => 'Black frame',
                'image' => '',
            ],

            [
                'name' => 'Oak frame',
                'image' => '',
            ],

            [
                'name' => 'White frame',
                'image' => '',
            ],
        ]; 

        foreach($variants as $variant){
            PosterFrame::create($variant);
        }
    }
}
