<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request) {
        
        $cart = Cart::getFullCart($request->session()->get('_token'), Auth::id())->get();

        return $cart;
    }
}
