<?php

namespace App\Http\Controllers;

use App\Models\Opening;
use Illuminate\Http\Request;

class OpeningController extends Controller
{

    public function index () {
    }

    public function show () {
    }

    public function create (Request $request) {

        Opening::create(['eco' => $request->eco, 'name' => $request->name]);
        return redirect()->back()->with('success', 'Opening created');
    }

    public function update () {
        
    }

    public function destroy () {
        
    }

    
}
