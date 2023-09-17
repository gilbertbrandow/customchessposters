<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
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

        $recipient =  $this->order->recipient;

        $items = [];

        foreach ($this->order->orderItems as $orderItem) {
            array_push($items, [
                'variant_id' => $orderItem->product->variant->variant_id,
                'name' => 'Custom Chess Poster: ' . $orderItem->product->name,
                'quantity' => $orderItem->quantity,
                'retail_price' => $orderItem->product->price * $orderItem->quantity / 100,
                'files' => ($orderItem->product->type == 'poster' ? [
                    [
                        "type"=> "default",
                        'url' => $orderItem->file,
                    ],
                ] : null),
            ]);
        };

        try {
            $pf->post('orders', [
                'shipping' => $this->order->shipping->name,
                'retail_price' => $this->order->totalAmount(),
                'recipient' => [
                    'name' => $recipient->name,
                    'address1' =>  $recipient->address1,
                    'city' =>  $recipient->city,
                    'state_code' =>  $recipient->state_code,
                    'country_code' =>  $recipient->country_code,
                    'zip' =>  $recipient->zip,
                ],
                'items' => $items, 
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
