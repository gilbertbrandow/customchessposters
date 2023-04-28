<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//An action is a controller method bound to a route

class HomeController extends Controller
{
    public function home()
    {
        $faqs = Faq::All();
    
        $game = Game::where('id', '=', random_int(1, Game::count()))->with(['poster', 'whitePlayer', 'blackPlayer'])->first();

        return inertia('Home', compact('faqs', 'game')); 
    }

    public function contact ()
    {
        return inertia('Contact');
    }  
    
    public function thankYou () 
    {
        return inertia('Thank-you');
    }

    /*
    |--------------------------------------------------------------------------
    | Policy actions
    |--------------------------------------------------------------------------
    */

    public function shipping () 
    {
        return inertia('Policy/Shipping');
    }

    public function return () 
    {
        return inertia('Policy/Return');
    }

    public function privacy () 
    {
        return inertia('Policy/Privacy');
    }

    public function lightbox () 
    {
        return inertia('Components/Lightbox');
    }
}