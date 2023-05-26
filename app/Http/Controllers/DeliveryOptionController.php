<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\DeliveryOption;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DeliveryOptionController extends Controller
{
    public function index(Request $request) {
        
        return Inertia::render('Checkout/Delivery', [
            'cart' => fn () => Cart::getFullCart($request->session()->get('_token'), Auth::id())->get(),
            'deliveryOptions' => fn () => DeliveryOption::where('order_id', $request->route('orderId'))->get(),
            'address' => fn() => Order::find($request->route('orderId'))->shippingAddress,
        ]); 
    }
}
