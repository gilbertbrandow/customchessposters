<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PosterController;
use App\Services\PosterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return inertia('Auth/Login');
    }

    public function authenticate(Request $request, PosterService $service)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = false;

        if ($request->remember)  $remember = true;

        if (Auth::attempt($credentials, $remember)) {

            //Save poster if exists as saved in session
            if ($request->session()->exists('poster') && $request->session()->get('poster_name')) {
                $service->savePoster($request->session()->get('poster'), $request->session()->get('poster_name'));
            }

            $request->session()->regenerate();

            return redirect()->intended('/account');
        }

        return back()->withErrors([
            'all' => 'The provided credentials do not match our records.',
        ])->onlyInput('all');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home.index');
    }
}
