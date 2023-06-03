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
            'shippingMethod' => Order::where('id', $request->route('orderId'))->first(['shipping', 'shipping_cost']),
            'address' => fn() => Order::find($request->route('orderId'))->shippingAddress,
        ]); 
    }

    public function create(Request $request) {

        $request->validate(['method' => ['required']]);
        
        $method = ShippingMethod::where('order_id', $request->route('orderId'))->where('id', $request->method)->firstOrFail();

        Order::find($request->route('orderId'))->update([
            'shipping' => $method->name,
            'shipping_cost' => $method->cost,
        ]);

        return redirect()->route('payment.index', ['orderId' => $request->route('orderId')]);
    }
}
