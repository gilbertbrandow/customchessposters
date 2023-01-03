<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//An action is a controller method bound to a route

class HomeController extends Controller
{
    public function home()
    {
        return inertia('Home'); 
    }

    public function contact ()
    {
        return inertia('Contact');;
    }    
}