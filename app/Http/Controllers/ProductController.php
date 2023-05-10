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
        $poster = $request->poster_data;

        array_shift($poster);

        $poster = Poster::firstOrCreate($poster); 

        $product = Product::firstOrCreate([
            'price' => Size::find($request->size)->price,
            'name' => $poster->title,
            'type' => 'Poster',
            'poster_id' => $poster->id,
            'size_id' => $request->size,
        ]);

        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id(), 'session_token' => $request->session()->get('_token')]
        );

        $cartItem = CartItem::firstOrCreate(
            ['cart_id' => $cart->id, 'product_id' => $product->id]
        );

        $cartItem->increment('quantity');

        return redirect()->back()->with('cartSuccess', 'New item added');
    }
}
