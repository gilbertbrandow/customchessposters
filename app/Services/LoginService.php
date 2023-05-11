<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function create ($credentials, $remember, Request $request) {

        if (Auth::attempt($credentials, $remember)) {

            //Save poster if exists as saved in session
            if ($request->session()->exists('poster')) {

                $poster = $request->session()->get('poster')['id'] ?
                (new PosterService())->update($request->session()->get('poster'), Auth::id(), $request->session()->get('_token'))
                : (new PosterService())->create($request->session()->get('poster'));

                User::find(Auth::id())->posters()->attach($poster->id);

                session()->flash('savedSuccess', 'A poster was saved!');
            }

            //Update cart if exists
            $cart = Cart::where('session_token', $request->session()->get('_token'))->first();

            if ($cart) {

                if ($userCart = Cart::where('user_id', Auth::id())->first()) {

                    //Get all cart items from $cart and update all their cart_id to new cart id
                    CartItem::where('cart_id', '=', $cart->id)
                        ->update(['cart_id' => $userCart->id]);

                    //Delete old cart
                    $cart->delete();

                } else {
                    $cart->user_id = Auth::id();
                    $cart->save();
                }
            }

            $request->session()->regenerate();

            return true;
        } else {
            return false;
        }
    }
}