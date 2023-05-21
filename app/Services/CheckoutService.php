<?php

namespace App\Services;

use Printful\Exceptions\PrintfulApiException;
use Printful\Exceptions\PrintfulException;
use Printful\PrintfulApiClient;

class CheckoutService
{

    public function createOrder($shippingAddress, $poster)
    {

        $client = PrintfulApiClient::createOauthClient(env('PRINTFUL_SK'));

        $order = $client->post('orders', [
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

    public function calculateShipping()
    {
        $pf = PrintfulApiClient::createOauthClient(env('PRINTFUL_SK'));

        try {

            $rates = $pf->post('shipping/rates', [
                'recipient' => [
                    'country_code' => 'BE',
                    'state_code' => '',
                ],
                'items' => [
                    ['variant_id' => 1, 'quantity' => 1], // Small poster
                ],
            ]);

            return var_export($rates);
        } catch (PrintfulApiException $e) {
            echo 'Printful API Exception: ' . $e->getCode() . ' ' . $e->getMessage();
        } catch (PrintfulException $e) { 
            echo 'Printful Exception: ' . $e->getMessage();
            var_export($pf->getLastResponseRaw());
        }
    }
}
