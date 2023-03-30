<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Mail;
use App\Mail\Welcome; 
use App\Models\User;
use App\Services\PosterService;

class RegisterController extends Controller
{
    public function show()
    {

        return redirect()->back()->with('authenticateRegister', true);

    }

    public function register(Request $request, LoginController $login)
    {
        $credentials = $request->validate([
            'name' => ['required', 'min:5', 'max:25'],
            'email' => ['required', 'unique:users', 'email'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        $user = User::create($credentials);

        $login->login($credentials, false, $request);

        $firstname = explode(' ', $user->name)[0];

        Mail::to($credentials['email'])->send(new Welcome($credentials['name']));

        //TODO: Customize return message based on if poster was saved or not!
        return redirect('/')->with('accountSuccess', 'Welcome ' . $firstname .'!');
    }
}