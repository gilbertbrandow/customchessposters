<?php

namespace App\Http\Controllers;

use App\Models\ShippingMethod;
use App\Models\Order;
use App\Models\Recipient;
use App\Models\User;
use App\Services\CheckoutService;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Inertia\Response as Response;
use Redirect;
use Illuminate\Http\RedirectResponse as RedirectResponse;

class RecipientController extends Controller
{
    public function index(string $orderId, Request $request): Response
    {
        $order = Order::find($orderId);

        $countries = Http::get('https://api.printful.com/countries')->json()['result'];
        $keys = array_column($countries, 'name');
        array_multisort($keys, SORT_ASC, $countries);
        
        return Inertia::render('Checkout/Shipping', [
            'cart' => fn () => $order->getCartItems()->get(),
            'address' => fn() => $order->recipient,
            'shippingMethod'=> fn() => $order->shipping,
            'countries' => fn() => $countries,
        ]);
    }

    public function create(string $orderId, Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'country_code' => ['required'],
            'name' => ['required'],
            'address1' => ['required'],
            'zip' => ['required'],
            'city' => ['required'],
        ]);

        $order = Order::find($orderId);

        try {

            $rates = (new CheckoutService())->calculateShipping($order->productVariants, $request->country_code, $request->state_code);
        
        } catch (Exception $e) {

            return back()->withErrors(['shippingMethod' => $e->getMessage()]);
        }

        //Create recipient
        $recipient = Recipient::create($request->all()); 

        //Save recipient to user
        if(Auth::check() && $request->save) {
            User::find(Auth::id())->recipients()->attach($recipient->id);
        }

        $order->update(['recipient_id' => $recipient->id]);

        ShippingMethod::where('order_id', $orderId)->delete();

        foreach($rates as $rate) {
            ShippingMethod::create([
                'order_id' => $orderId,
                'name' => $rate['id'],
                'desc' => $rate['name'],
                'cost' => $rate['rate'] * 100, 
            ]);
        }

        return redirect()->route('shippingMethod.index', ['orderId' => $orderId]);
    }
}
