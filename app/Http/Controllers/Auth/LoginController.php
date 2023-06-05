<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\LoginService;
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

        if ((new LoginService())->create($credentials, $request->remember, $request)) {
            return redirect()->intended('/account')->with('accountSuccess', 'Logged in');
        } else {
            return back()->withErrors([
                'all' => 'The provided credentials do not match our records.',
            ])->onlyInput('all');
        }
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('home.index');
    }
}
