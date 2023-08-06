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
                'image' => '',
            ],

            [
                'name' => 'Oak',
                'image' => '',
            ],

            [
                'name' => 'White',
                'image' => '',
            ],
        ]; 

        foreach($variants as $variant){
            PosterFrame::create($variant);
        }
    }
}
