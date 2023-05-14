<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {

        return Inertia::render('Checkout', [
            'cart' => fn () => Cart::getFullCart($request->session()->get('_token'), Auth::id())->get(),
        ]);
    }

    public function create(Request $request)
    {
        //Use secret key
        Stripe::setApiKey(env('STRIPE_SK'));


        try {

            // Create a PaymentIntent with amount and currency
            $paymentIntent = PaymentIntent::create([

                'amount' => Cart::getTotalAmount($request->session()->get('_token'), Auth::id()),
                'currency' => 'usd',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],

            ]);

            //Return clients secret checkout url
            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];

            echo json_encode($output);

        } catch (Error $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
