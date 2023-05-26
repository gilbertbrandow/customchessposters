<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Services\CheckoutService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class ShippingController extends Controller
{
    public function index(Request $request)
    {
        $countries = Http::get('https://api.printful.com/countries')->json()['result'];
        $keys = array_column($countries, 'name');
        array_multisort($keys, SORT_ASC, $countries);

        return Inertia::render('Shipping', [
            'cart' => fn () => Cart::getFullCart($request->session()->get('_token'), Auth::id())->get(),
            'countries' => $countries,
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'country_code' => ['required'],
            'name' => ['required'],
            'address1' => ['required'],
            'zip' => ['required'],
            'city' => ['required'],
        ]);

        try {
            $rates = (new CheckoutService())->calculateShipping($request->country_code, $request->state_code);
        } catch (Exception $e) {

            return response()->json($e->getMessage(), 422);
        }

        //Create shipping address record in db

        //Maybe render new inertia view with rates data?
        return response()->json($rates, 200);
    }
}
