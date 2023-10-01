<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Services\OrderService;
use App\Services\PosterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index(Request $request) 
    {
        $cart = Cart::where('session_token', $request->session()->get('_token'))->when(Auth::id() !== null, function ($query) {
            $query->orWhere('user_id', Auth::id());
        })->first();

        $order = Order::firstOrCreate(['cart_id' => $cart->id, 'user_id' => Auth::id()]);
        
        return redirect()->route('shipping.index', ['orderId' => $order->id]);
    }

    public function show() 
    {
        return Inertia::render('Checkout/Confirmation', [
            'stripePublicKey' => env('STRIPE_PK'),
        ]); 
    }
}
