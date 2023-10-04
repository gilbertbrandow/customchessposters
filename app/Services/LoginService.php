<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function create($credentials, $remember, Request $request): Bool
    {

        if (!Auth::attempt($credentials, $remember)) return false;


        //Save poster if exists as saved in session
        if ($request->session()->exists('poster')) {

            $poster = $request->session()->get('poster')['id'] ?
                (new PosterService())->update($request->session()->get('poster'), Auth::id(), $request->session()->get('_token'))
                : (new PosterService())->create($request->session()->get('poster'));

            User::find(Auth::id())->posters()->attach($poster->id);

            session()->flash('savedSuccess', 'A poster was saved!');
        }

        //Update cart if exists
        if ($cart = Cart::where('session_token', $request->session()->get('_token'))->first()) {

            if ($userCart = Cart::where('user_id', Auth::id())->first()) {

                //Get all cart items from cart and update all their cart_id to new cart id
                CartItem::where('cart_id', '=', $cart->id)
                    ->update(['cart_id' => $userCart->id]);

                //Delete old order
                $cart->order->delete();

                //Delete old cart
                $cart->delete();
            } else {
                if ($cart->order) $cart->order->user_id = Auth::id();
                $cart->user_id = Auth::id();
                $cart->save();
            }
        }

        $request->session()->regenerate();

        return true;
    }
}
