<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\Welcome; 
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
            'name' => ['required', 'min:5', 'max:25'],
            'email' => ['required', 'unique:users', 'email'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        User::create($credentials);

        Mail::to($credentials['email'])->send(new Welcome($credentials['name']));

        return Redirect('/');
    }
}