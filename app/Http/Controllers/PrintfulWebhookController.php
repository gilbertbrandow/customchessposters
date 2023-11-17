<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrintfulWebhookController extends Controller
{
    public function handle(Request $request)
    {
        switch ($request->type) {
            case 'shipment_sent':
                response('Shipment sent', 200);
            default:
                return response('Received unactionable event type: ' . $request->type, 200)
                    ->header('Content-Type', 'text/plain');
        }
    }
}
