<?php

namespace App\Http\Controllers;

use App\Services\CheckoutService;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function create(Request $request) {
        return (new CheckoutService())->calculateShipping($request);
    }
}
