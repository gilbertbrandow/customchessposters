<?php

namespace Database\Seeders;

use App\Models\PosterVariant;
use Illuminate\Database\Seeder;

class PosterVariantsSeeder extends Seeder
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
                'description' => 'Extra small',
                'width' => 21,
                'height' => 30,
                'price' => 2000,
                'variant_id' => 8947,
            ],

            [
                'description' => 'Small',
                'width' => 30,
                'height' => 40,
                'price' => 2500,
                'variant_id' => 8948,
            ],

            [
                'description' => 'Medium',
                'width' => 50,
                'height' => 70,
                'price' => 3000,
                'variant_id' => 8952,
            ],

            [
                'description' => 'Large',
                'width' => 61,
                'height' => 91,
                'price' => 4000,
                'variant_id' => 8953,
            ],

            [
                'description' => 'Extra Large',
                'width' => 70,
                'height' => 100,
                'price' => 5000,
                'variant_id' => 8954,
            ],
        ]; 

        foreach($variants as $variant){
            PosterVariant::create($variant);
        }
    }
}