<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;

class OrderService
{

    public function createOrderItems(Order $order)
    {
        $cart = $order->cart; 

        foreach($cart->cartItems as $item) {
           OrderItem::create([
            'order_id' => $order->id, 
            'product_id' => $item->product_id, 
            'quantity' => $item->quantity, 
           ]);
        }; 

        $order->cart_id = null; 
        $order->save();
        $cart->delete();

        return; 
    }

    public function sendOrderToPrintful() {

    }

}