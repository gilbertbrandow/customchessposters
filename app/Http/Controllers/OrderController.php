<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index(Request $request) {

        $cart = Cart::where('session_token', $request->session()->get('_token'))->when(Auth::id() !== null, function ($query) {
            $query->orWhere('user_id', Auth::id());
        })->firstOrFail()->pluck('id');

        $order = Order::firstOrCreate(['cart_id' => $cart[0], 'user_id' => Auth::id(), 'session_token' => $request->session()->get('_token')]);
        
        return redirect()->route('shipping.index', ['orderId' => $order->id]);
    }

    public function show(Request $request) {

        return Inertia::render('Checkout/Confirmed', [
        ]); 
    }

    public function test() {
/*         $order = Order::first(); 
        dd($order->orderItems);  */

        dd((new OrderService(Order::first()))->test()); 

        //Try to get order items with products and variants ids?

        $orderItems = Order::first()->orderItems;
        
        foreach($orderItems as $item) {
            dd($item->products); 
        }
    }
}
