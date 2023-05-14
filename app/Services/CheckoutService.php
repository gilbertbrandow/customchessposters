<?php

namespace App\Services;

use Printful\PrintfulApiClient;

class CheckoutService
{ 
    

    public function createOrder() {

        $printful = new PrintfulApiClient(env('PRINTFUL_SK'));


        $order = $printful->post('orders', [
            'recipient' => [
                'name' => 'John Doe',
                'address1' => '172 W Street Ave #105',
                'city' => 'Burbank',
                'state_code' => 'CA',
                'country_code' => 'US',
                'zip' => '91502',
            ],
            'items' => [
                [
                    'variant_id' => 1,
                    'name' => 'Custom Chess Poster',
                    'retail_price' => '20.00',
                    'quantity' => 1,
                    'files' => [
                        [
                            'url' => 'http://example.com/files/posters/poster_1.jpg',
                        ],
                    ],
                ],
            ],
        ]);

        return var_export($order);
    }

}