<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;

class RegisterController extends Controller
{
    public function registration()
    {
        return inertia('Auth/Register'); 
    }

    public function create(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'min:5', 'max:10'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        User::create($credentials);

        return Redirect('/');
    }
}