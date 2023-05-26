<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DeliveryOptionController extends Controller
{
    public function index(Request $request) {

        $order = Order::firstOrFail(100);
        
        return Inertia::render('Delivery', [
            'cart' => fn () => Cart::getFullCart($request->session()->get('_token'), Auth::id())->get(),
            'deliveryOptions' => fn () => [],
        ]); 
    }
}
