<?php

namespace App\Http\Controllers;

use App\Models\ShippingMethod;
use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShippingMethodController extends Controller
{
    public function index(Request $request) {

        return Inertia::render('Checkout/Shipping-methods', [
            'cart' => fn () => Order::getCartItems($request->route('orderId'))->get(),
            'shippingMethods' => fn () => ShippingMethod::where('order_id', $request->route('orderId'))->get(),
            'shippingMethod' => Order::find($request->route('orderId'))->shipping,
            'address' => fn() => Order::find($request->route('orderId'))->recipient,
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
