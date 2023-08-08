<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function update(Request $request)
    {

        session()->put('unit', $request->unit);

        return redirect()->back()->with([
            'overlay' => $request->overlay,
            'addToCart' => $request->addToCart
        ]);
    }
}
