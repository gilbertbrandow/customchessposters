<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function registration()
    {
        return inertia('Auth/Registration'); 
    }
}