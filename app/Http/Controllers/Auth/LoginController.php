<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PosterController;
use App\Services\PosterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {
        return redirect()->back()->with('overlay', 'login');
    }

    public function create(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if ($this->login($credentials, $request->remember, $request)) {
            return redirect()->intended('/account')->with('accountSuccess', 'Logged in');
        } else {
            return back()->withErrors([
                'all' => 'The provided credentials do not match our records.',
            ])->onlyInput('all');
        }
    }

    public function login($credentials, $remember, Request $request)
    {

        if (Auth::attempt($credentials, $remember)) {

            //Save poster if exists as saved in session
            if ($request->session()->exists('poster')) {

                (new PosterService())->savePoster($request->session()->get('poster'), Auth::user());
            }

            $request->session()->regenerate();

            return true;
        } else {
            return false;
        }
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('home.index');
    }
}
