<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ShippingMethod;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Printful\PrintfulApiClient;

class ShippingMethodController extends Controller
{
    public function index(Request $request) {

        $pf = PrintfulApiClient::createOauthClient(env('PRINTFUL_SK'));
        
        return Inertia::render('Checkout/Shipping-methods', [
            'cart' => fn () => Cart::getFullCart($request->session()->get('_token'), Auth::id())->get(),
            'shippingMethods' => fn () => ShippingMethod::where('order_id', $request->route('orderId'))->get(),
            'shippingMethod' => Order::find($request->route('orderId'))->get(['shipping','shipping_cost'])[0],
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

        
    
    }
}
