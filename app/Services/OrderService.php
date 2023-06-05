<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use Printful\PrintfulApiClient;

class OrderService
{

    public function __construct(
        public Order $order
    )
    {
        $this->order = $order;
    }

    public function createOrderItems()
    {
        $cart = $this->order->cart; 

        foreach($cart->cartItems as $item) {
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

        $client = PrintfulApiClient::createOauthClient(env('PRINTFUL_SK'));

        return $this->order->shippingAddress; 

        $client->post('orders', [
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

        return;
    }

    public function test() {
        return $this->order->shippingAddress;
    }

}