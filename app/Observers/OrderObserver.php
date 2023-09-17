<?php

namespace App\Observers;

use App\Mail\OrderConfirmed;
use App\Mail\OrderReceived;
use App\Models\Order;
use App\Models\User;
use Mail;

class OrderObserver
{
    public function updated(Order $order): void
    {
        if ($order->status === 'recieved') {
            foreach (User::where('admin', true)->get() as $user) {
                Mail::to($user->email)->send(new OrderReceived($order));
            }

            Mail::to($order->recipient->email)->send(new OrderConfirmed($order));
            
        }
    }
}
