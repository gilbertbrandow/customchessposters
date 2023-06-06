<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use Error;
use Printful\Exceptions\PrintfulApiException;
use Printful\Exceptions\PrintfulException;
use Printful\PrintfulApiClient;

class OrderService
{

    public function __construct(
        public Order $order
    ) {
        $this->order = $order;
    }

    public function createOrderItems()
    {
        $cart = $this->order->cart;

        foreach ($cart->cartItems as $item) {
            OrderItem::create([
                'order_id' => $this->order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
            ]);
        };

        $this->order->cart_id = null;
        $this->order->save();
        $cart->delete();

        return;
    }

    public function sendOrderToPrintful()
    {

        $pf = PrintfulApiClient::createOauthClient(env('PRINTFUL_SK'));

        $recipient =  $this->order->shippingAddress;

        try {
            $pf->post('orders', [
                'recipient' => [
                    'name' => $recipient->name,
                    'address1' =>  $recipient->address1,
                    'city' =>  $recipient->city,
                    'state_code' =>  $recipient->state_code,
                    'country_code' =>  $recipient->country_code,
                    'zip' =>  $recipient->zip,
                ],
                'items' => [
                    [
                        'variant_id' => 1,
                        'name' => 'Custom Chess Poster: ',
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
        } catch (PrintfulApiException $e) {
            // API response status code was not successful
            return 'Printful API Exception: ' . $e->getCode() . ' ' . $e->getMessage();

        } catch (PrintfulException $e) {
            // API call failed
            return 'Printful Exception: ' . $e->getMessage();
            var_export($pf->getLastResponseRaw());
        }
    }
}
