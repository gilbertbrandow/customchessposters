<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Poster;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        //
    }

    public function create(Request $request)
    {

        $product = Product::where([['poster_id', $request->poster_id], ['size_id', $request->size]])->first() 
        ?? Product::create([
                'price' => Size::find($request->size)->price,
                'name' => Poster::find($request->poster_id)->title,
                'type' => 'Poster',
                'poster_id' => $request->poster_id,
                'size_id' => $request->size,
        ]);

        //TODO: If cart does not exists create it else check if should update quantity or not
        CartItem::create([
            'cart_id' => 1,
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        //Cart update

        return redirect()->back()->with('');
    }
}
