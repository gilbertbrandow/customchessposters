<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Game;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Home', [
            'faqs' => fn () => Faq::All()->where('featured', true)->take(5),
            'game' =>  fn () => Game::where('id', '=', random_int(1, Game::count()))->with(['poster', 'whitePlayer', 'blackPlayer'])->first(),
            'games' => fn() => Game::getAll($request)->take(7)->get(),
        ]); 
    }

    /*
    |--------------------------------------------------------------------------
    | Policy custom actions
    |--------------------------------------------------------------------------
    */

    public function shipping () 
    {
        return Inertia::render('Policy/Shipping');
    }

    public function return () 
    {
        return Inertia::render('Policy/Return');
    }

    public function privacy () 
    {
        return Inertia::render('Policy/Privacy');
    }

    public function lightbox () 
    {
        return Inertia::render('Components/Lightbox');
    }
}