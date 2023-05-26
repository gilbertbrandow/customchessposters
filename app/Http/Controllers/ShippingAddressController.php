<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\DeliveryOption;
use App\Models\Order;
use App\Models\ShippingAddress;
use App\Services\CheckoutService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class ShippingAddressController extends Controller
{
    public function index(Request $request)
    {
        $countries = Http::get('https://api.printful.com/countries')->json()['result'];
        $keys = array_column($countries, 'name');
        array_multisort($keys, SORT_ASC, $countries);

        return Inertia::render('Checkout/Shipping', [
            'cart' => fn () => Cart::getFullCart($request->session()->get('_token'), Auth::id())->get(),
            'address' => fn() => Order::find($request->route('orderId'))->shippingAddress,
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

            return redirect()->back()->withErrors(['delivery' => $e->getMessage()]);
        }

        $recpient = ShippingAddress::firstOrCreate($request->all());
        Order::find($request->route('orderId'))->update(['shipping_addresses_id' => $recpient->id]);

        foreach($rates as $rate) {
            DeliveryOption::firstOrCreate([
                'order_id' => $request->route('orderId'),
                'name' => $rate['id'],
                'desc' => $rate['name'],
                'cost' => $rate['rate'] * 100, 
            ]);
        }

        return redirect()->route('delivery.index', ['orderId' => $request->route('orderId')]);
    }
}
