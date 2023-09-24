<?php

namespace App\Http\Controllers;

use App\Models\ShippingMethod;
use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShippingMethodController extends Controller
{
    public function index(Request $request) {

        $order = Order::find($request->route('orderId')); 

        if(!$order->recipient) return redirect()->route('shippingMethod.index', ['orderId' => $request->route('orderId')]);

        return Inertia::render('Checkout/Shipping-methods', [
            'cart' => fn () => $order->getCartItems()->get(),
            'shippingMethods' => fn () => $order->shippingAlternatives,
            'shippingMethod' => $order->shipping,
            'address' => fn() => $order->recipient,
        ]); 
    }

    public function create(Request $request) {

        $request->validate(['method' => ['required']]);
        
        $method = ShippingMethod::where([
            ['order_id', $request->route('orderId')], 
            ['id', $request->method]
        ])->firstOrFail();

        $order = Order::find($request->route('orderId')); 
        $order->shipping_method_id = $method->id; 
        $order->save();

        return redirect()->route('payment.index', ['orderId' => $request->route('orderId')]);
    }
}
