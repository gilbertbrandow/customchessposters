<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Stripe;
use Stripe\Webhook;
use UnexpectedValueException;

class WebhookController extends Controller
{
    public function index()
    {

        //Use secret key
        Stripe::setApiKey(env('STRIPE_SK'));

        // This is Stripe CLI webhook secret for testing endpoint locally for now.
        $endpoint_secret = 'whsec_599f3ceba8954b5887803997a91c3e3490a792a4d0f3c34edf897afdec7d260e';

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        } catch (SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(400);
            exit();
        }

        // Handle the event
        switch ($event->type) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;  

                Order::where('payment_intent', $paymentIntent->id)->update(array('status' => 'processing'));

                return response(json_encode($paymentIntent), 200)
                    ->header('Content-Type', 'application/json');
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        http_response_code(200);
    }
}
