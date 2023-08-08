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
                'name' => 'Small', 
                'width' => 21,
                'height' => 30,
            ],

            [
                'name' => 'Medium', 
                'width' => 50,
                'height' => 70,
            ],

            [
                'name' => 'Large', 
                'width' => 61,
                'height' => 91,
            ],
        ]; 

        foreach($variants as $variant){
            PosterSize::create($variant);
        }
    }
}
