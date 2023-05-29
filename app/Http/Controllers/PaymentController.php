<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Checkout/Payment', [
            'cart' => fn () => Cart::getFullCart($request->session()->get('_token'), Auth::id())->get(),
            'shippingMethod' => fn () => Order::find($request->route('orderId'))->get(['shipping', 'shipping_cost'])[0],
            'address' => fn () => Order::find($request->route('orderId'))->shippingAddress,
        ]);
    }

    public function create(Request $request)
    {

        //Use secret key
        Stripe::setApiKey(env('STRIPE_SK'));

        try {

            // Create a PaymentIntent with amount and currency
            $paymentIntent = PaymentIntent::create([

                'amount' => Order::find($request->route('orderId'))->getTotalAmount()->get(),
                'currency' => 'usd',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],

            ]);

            //Return clients secret checkout url
            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];

            return json_encode($output);
        } catch (Error $e) {
            http_response_code(500);
            return json_encode(['error' => $e->getMessage()]);
        }
    }
}
