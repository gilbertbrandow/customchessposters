<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{

    public function index () {
    }

    public function show () {
    }

    public function create (Request $request) {

        Player::create(['name' => $request->name, 'country' => $request->country]);
        return redirect()->back()->with('success', 'Player created');
    }

    public function update () {
        
    }

    public function destroy () {
        
    }

    
}
