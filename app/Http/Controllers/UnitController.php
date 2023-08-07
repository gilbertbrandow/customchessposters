<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function update(Request $request) {
        return session()->put('unit', $request->unit);
    }
}
