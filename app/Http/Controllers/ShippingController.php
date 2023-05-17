<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Services\CheckoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ShippingController extends Controller
{
    public function index(Request $request) {
        return Inertia::render('Shipping', [
            'cart' => fn () => Cart::getFullCart($request->session()->get('_token'), Auth::id())->get(),
        ]);
    }

    public function create(Request $request) {
        return (new CheckoutService())->calculateShipping($request);
    }
}
