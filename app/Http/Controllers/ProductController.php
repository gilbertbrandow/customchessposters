<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Poster;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        //
    }

    public function create(Request $request)
    {

        $product = Product::firstOrCreate([
            'price' => Size::find($request->size)->price,
            'name' => Poster::find($request->poster_id)->title,
            'type' => 'Poster',
            'poster_id' => $request->poster_id,
            'size_id' => $request->size,
        ]);

        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id(), 'session_token' => $request->session()->get('_token')]
        );

        $cartItem = CartItem::firstOrCreate(
            ['cart_id' => $cart->id, 'product_id' => $product->id]
        );

        $cartItem->increment('quantity');

        return redirect()->back()->with('cart', 'New item added');
    }
}
