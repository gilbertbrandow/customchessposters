<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Game;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return inertia('Home', [
            'faqs' => fn () => Faq::All(),
            'game' =>  fn () => Game::where('id', '=', random_int(1, Game::count()))->with(['poster', 'whitePlayer', 'blackPlayer'])->first(),
            'games' => fn() => Game::getAll($request, 2),
        ]); 
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