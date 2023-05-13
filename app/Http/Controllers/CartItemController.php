<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function destroy(Request $request) {

        CartItem::find($request->id)->delete();
        return redirect()->back()->with('overlay', 'cart');
    }
}
