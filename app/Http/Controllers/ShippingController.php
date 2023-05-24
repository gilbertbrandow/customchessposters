<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Services\CheckoutService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ShippingController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Shipping', [
            'cart' => fn () => Cart::getFullCart($request->session()->get('_token'), Auth::id())->get(),
        ]);
    }

    public function create(Request $request)
    {

        //Basic validation of form data
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        try {
            //Check if can deliver
            $rates = (new CheckoutService())->calculateShipping($request->country, null);

        } catch (Exception $e) {
            // an error occurred
            return response()->json($e->getMessage(), 422);
        }

        //Create shipping address record in db

        //Maybe render new inertia view with rates data?
        return response()->json($rates, 200);
    }
}
