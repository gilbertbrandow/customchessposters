<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ShippingMethod;
use App\Models\Order;
use App\Models\Recipient;
use App\Services\CheckoutService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class RecipientController extends Controller
{
    public function index(Request $request)
    {
        $countries = Http::get('https://api.printful.com/countries')->json()['result'];
        $keys = array_column($countries, 'name');
        array_multisort($keys, SORT_ASC, $countries);
        
        return Inertia::render('Checkout/Shipping', [
            'cart' => fn () => Cart::getFullCart($request->session()->get('_token'), Auth::id())->get(),
            'address' => fn() => Order::find($request->route('orderId'))->shippingAddress,
            'shippingMethod' => Order::find($request->route('orderId'))->get(['shipping','shipping_cost'])[0],
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

            $rates = (new CheckoutService())->calculateShipping($request->country_code, $request->state_code, Cart::getVariants($request->session()->get('_token'), Auth::id())->get());
        
        } catch (Exception $e) {

            return redirect()->back()->withErrors(['shippingMethod' => $e->getMessage()]);
        }

        Order::find($request->route('orderId'))->update(['recipient_id' => Recipient::firstOrCreate($request->all())->id]);

        ShippingMethod::where('order_id', $request->route('orderId'))->delete();

        foreach($rates as $rate) {
            ShippingMethod::create([
                'order_id' => $request->route('orderId'),
                'name' => $rate['id'],
                'desc' => $rate['name'],
                'cost' => $rate['rate'] * 100, 
            ]);
        }

        return redirect()->route('shippingMethod.index', ['orderId' => $request->route('orderId')]);
    }
}
