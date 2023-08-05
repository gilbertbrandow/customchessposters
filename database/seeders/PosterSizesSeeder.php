<?php

namespace Database\Seeders;

use App\Models\PosterSize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PosterSizesSeeder extends Seeder
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
                'width' => 21,
                'height' => 30,
            ],

            [
                'width' => 50,
                'height' => 70,
            ],

            [
                'width' => 61,
                'height' => 91,
            ],
        ]; 

        foreach($variants as $variant){
            PosterSize::create($variant);
        }
    }
}
