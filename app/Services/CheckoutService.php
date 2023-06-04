<?php

namespace App\Services;

use Exception;
use Printful\Exceptions\PrintfulApiException;
use Printful\Exceptions\PrintfulException;
use Printful\PrintfulApiClient;

class CheckoutService
{

    public function calculateShipping($items, $country, $state = null)
    {
        $pf = PrintfulApiClient::createOauthClient(env('PRINTFUL_SK'));

        try {

            $rates = $pf->post('shipping/rates', [
                'recipient' => [
                    'country_code' => $country,
                    'state_code' => $state,
                ],
                'items' => $items,
            ]);

            return $rates;

        } catch (PrintfulApiException $e) {

            throw new Exception($e->getMessage());

        } catch (PrintfulException $e) {

            throw new Exception($e->getMessage());
        }
    }
}
