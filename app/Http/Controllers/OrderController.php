<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
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

    public function create(Request $request) {

        return Inertia::render('Checkout/Confirmed', [
            'cart' => fn () => Cart::getFullCart($request->session()->get('_token'), Auth::id())->get(),
        ]); 
    }
}
