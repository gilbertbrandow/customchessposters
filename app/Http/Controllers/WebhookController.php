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

        $payload = @file_get_contents('php://input');
        $signature_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = Webhook::constructEvent(
                $payload,
                $signature_header,
                env('STRIPE_WEBHOOK_SK'),
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
