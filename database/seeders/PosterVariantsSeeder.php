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
                'description' => 'Small',
                'width' => 21,
                'height' => 30,
                'price' => 2000,
                'variant_id' => 8947,
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
                'description' => 'Small with black frame',
                'width' => 21,
                'height' => 30,
                'price' => 2990,
                'variant_id' => 9356,
            ],

            [
                'description' => 'Small with oak frame',
                'width' => 21,
                'height' => 30,
                'price' => 3190,
                'variant_id' => 11790,
            ],

            [
                'description' => 'Small with white frame',
                'width' => 21,
                'height' => 30,
                'price' => 2990,
                'variant_id' => 10296,
            ],

            [
                'description' => 'Medium with black frame',
                'width' => 50,
                'height' => 70,
                'price' => 6990,
                'variant_id' => 9358,
            ],

            [
                'description' => 'Medium with oak frame',
                'width' => 50,
                'height' => 70,
                'price' => 7190,
                'variant_id' => 11792,
            ],

            [
                'description' => 'Medium with white frame',
                'width' => 50,
                'height' => 70,
                'price' => 6990,
                'variant_id' => 10298,
            ],

            [
                'description' => 'Large with black frame',
                'width' => 61,
                'height' => 91,
                'price' => 8490,
                'variant_id' => 9359,
            ],

            [
                'description' => 'Large with oak frame',
                'width' => 61,
                'height' => 91,
                'price' => 8990,
                'variant_id' => 11793,
            ],

            [
                'description' => 'Large with white frame',
                'width' => 61,
                'height' => 91,
                'price' => 8490,
                'variant_id' => 10299,
            ],
        ]; 

        foreach($variants as $variant){
            PosterVariant::create($variant);
        }
    }
}
