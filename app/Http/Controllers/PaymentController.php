<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function index(string $orderId, Request $request)
    {
        $order = Order::find($orderId); 

        if(!$order->shipping) return redirect()->route('shippingMethod.index', ['orderId' => $request->route('orderId')]);

        //Use secret key
        Stripe::setApiKey(env('STRIPE_SK'));

        try {

            // Create a PaymentIntent with amount and currency
            $paymentIntent = PaymentIntent::create([

                'amount' => $order->cart->total + $order->shipping->cost,
                'currency' => 'eur',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            //Save payment intent on order
            $order->update(array('payment_intent' => $paymentIntent->id));

            return Inertia::render('Checkout/Payment', [
                'cart' => fn () => $order->getCartItems()->get(),
                'shippingMethod' => fn () =>  $order->shipping,
                'address' => fn () => $order->recipient,
                'clientSecretKey' => $paymentIntent->client_secret,
                'stripePublicKey' => env('STRIPE_PK'),
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
