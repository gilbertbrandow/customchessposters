<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessOrder;
use App\Models\Order;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Stripe;
use Stripe\Webhook;
use UnexpectedValueException;
use App\Services\OrderService;

class WebhookController extends Controller
{
    public function index()
    {

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

                $order = Order::where('payment_intent', $paymentIntent->id)->first(); 

                (new OrderService())->createOrderItems($order); 

                $order->status = 'recieved';
                $order->save();
                
                ProcessOrder::dispatch($order);

                return response("Order #" . $order->id . ": Payment confirmed. Order processing job dispatched.", 200)
                    ->header('Content-Type', 'text/plain');
            default:
                return response('Received unactionable event type: ' . $event->type, 200)
                ->header('Content-Type', 'text/plain');
        }
    }
}
