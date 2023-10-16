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
                'name' => 'Black',
                'color' => '#000',
                'image' => '/images/black-frame.svg',
            ],

            [
                'name' => 'Oak',
                'color' => '#ce9f6f',
                'image' => '/images/oak-frame.webp',
            ],

            [
                'name' => 'White',
                'color' => '#fff',
                'image' => '/images/white-frame.svg',
            ],
        ]; 

        foreach($variants as $variant){
            PosterFrame::create($variant);
        }
    }
}
