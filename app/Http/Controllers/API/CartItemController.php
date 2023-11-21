<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Poster;
use App\Models\PosterVariant;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        return Cart::firstOrCreate(
            ['id' => $request->cartId],
            [
                'user_id' => Auth::id(),
                'session_token' => $request->session()->get('_token')
            ]
        );

        $request->poster->id = null;

        $poster = Poster::firstOrCreate($request->poster);

        $product = Product::firstOrCreate([
            'price' => PosterVariant::find($request->variant)->price,
            'name' => $poster->title,
            'type' => 'Poster',
            'poster_id' => $poster->id,
            'poster_variant_id' => $request->variant,
        ]);

        return CartItem::firstOrCreate(
            [
                'cart_id' => Cart::firstOrCreate(
                    ['id' => $request->cartId],
                    [
                        'user_id' => Auth::id(),
                        'session_token' => $request->session()->get('_token')
                    ]
                ),
                'product_id' => $product->id,
                'quantity' => 1,
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function show(CartItem $cartItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CartItem $cartItem)
    {
        return $cartItem->update(['quantity' => $request->quantity]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(CartItem $cartItem)
    {
        return $cartItem->delete();
    }
}
