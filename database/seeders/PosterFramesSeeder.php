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
                'image' => '/images/black-frame.svg',
            ],

            [
                'name' => 'Oak',
                'image' => '/images/oak-frame.jpg',
            ],

            [
                'name' => 'White',
                'image' => '/images/white-frame.svg',
            ],
        ]; 

        foreach($variants as $variant){
            PosterFrame::create($variant);
        }
    }
}
