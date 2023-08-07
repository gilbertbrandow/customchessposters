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
                'poster_size_id' => 1,
                'price' => 1990,
                'variant_id' => 8947,
            ],

            [
                'description' => 'Medium',
                'poster_size_id' => 2,
                'price' => 2990,
                'variant_id' => 8952,
            ],

            [
                'description' => 'Large',
                'poster_size_id' => 3,
                'price' => 3490,
                'variant_id' => 8953,
            ],
            
            [
                'description' => 'Small with black frame',
                'poster_size_id' => 1,
                'poster_frame_id' => 1,
                'price' => 3490,
                'variant_id' => 9356,
            ],

            [
                'description' => 'Small with oak frame',
                'poster_size_id' => 1,
                'poster_frame_id' => 2,
                'price' => 3990,
                'variant_id' => 11790,
            ],

            [
                'description' => 'Small with white frame',
                'poster_size_id' => 1,
                'poster_frame_id' => 3,
                'price' => 3490,
                'variant_id' => 10296,
            ],

            [
                'description' => 'Medium with black frame',
                'poster_size_id' => 2,
                'poster_frame_id' => 1,
                'price' => 6990,
                'variant_id' => 9358,
            ],

            [
                'description' => 'Medium with oak frame',
                'poster_size_id' => 2,
                'poster_frame_id' => 2,
                'price' => 7490,
                'variant_id' => 11792,
            ],

            [
                'description' => 'Medium with white frame',
                'poster_size_id' => 2,
                'poster_frame_id' => 3,
                'price' => 6990,
                'variant_id' => 10298,
            ],

            [
                'description' => 'Large with black frame',
                'poster_size_id' => 3,
                'poster_frame_id' => 1,
                'price' => 8490,
                'variant_id' => 9359,
            ],

            [
                'description' => 'Large with oak frame',
                'poster_size_id' => 3,
                'poster_frame_id' => 2,
                'price' => 8990,
                'variant_id' => 11793,
            ],

            [
                'description' => 'Large with white frame',
                'poster_size_id' => 3,
                'poster_frame_id' => 3,
                'price' => 8490,
                'variant_id' => 10299,
            ],
        ]; 

        foreach($variants as $variant){
            PosterVariant::create($variant);
        }
    }
}
