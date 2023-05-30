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
        //Use secret key
        Stripe::setApiKey(env('STRIPE_SK'));

        try {

            // Create a PaymentIntent with amount and currency
            $paymentIntent = PaymentIntent::create([

                'amount' => Order::totalAmount($request->route('orderId'))->get()[0]->total, 
                'currency' => 'eur',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            return Inertia::render('Checkout/Payment', [
                'cart' => fn () => Cart::getFullCart($request->session()->get('_token'), Auth::id())->get(),
                'shippingMethod' => fn () => Order::find($request->route('orderId'))->get(['shipping', 'shipping_cost'])[0],
                'address' => fn () => Order::find($request->route('orderId'))->shippingAddress,
                'clientSecretKey' => $paymentIntent->client_secret,
            ]);

        } catch (Error $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function create(Request $request)
    {

    }
}
