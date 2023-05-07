<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class SizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $sizes = [
            [
                'description' => 'Extra small',
                'width' => 21,
                'height' => 30,
                'price' => 2000,
            ],

            [
                'description' => 'Medium',
                'width' => 50,
                'height' => 70,
                'price' => 3000,
            ],

            [
                'description' => 'Large',
                'width' => 61,
                'height' => 91,
                'price' => 4000,
            ],

            [
                'description' => 'Extra Large',
                'width' => 70,
                'height' => 100,
                'price' => 5000,
            ],
        ]; 

        foreach($sizes as $size){
            Size::create($size);
        }
    }
}
