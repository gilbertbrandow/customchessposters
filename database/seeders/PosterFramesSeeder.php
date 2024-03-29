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
                'image' => '/images/black-frame.webp',
            ],

            [
                'name' => 'Oak',
                'image' => '/images/oak-frame.webp',
            ],

            [
                'name' => 'White',
                'image' => '/images/white-frame.webp',
            ],
        ]; 

        foreach($variants as $variant){
            PosterFrame::create($variant);
        }
    }
}
