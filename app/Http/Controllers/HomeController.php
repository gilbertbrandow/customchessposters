<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//An action is a controller method bound to a route

class HomeController extends Controller
{
    public function home()
    {
        $faqs = Faq::All();
        return inertia('Home', compact('faqs')); 
    }

    public function contact ()
    {
        return inertia('Contact');;
    }   
    
    public function your_own () 
    {
        return inertia('Your-own');
    }
}