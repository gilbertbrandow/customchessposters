<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\Welcome;
use App\Models\User;
use App\Services\LoginService;
use Illuminate\Support\Facades\Route;

class RegisterController extends Controller
{
    static public function index()
    {
        $url = url()->previous();

        $route = collect(Route::getRoutes())->first(function ($route) use ($url) {
             return $route->matches(request()->create($url));
        });

        if(in_array('auth', $route->gatherMiddleware())) return redirect('/')->with('overlay', 'register');
        else return redirect()->back()->with('overlay', 'register');
    }

    public function create(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'min:5', 'max:25'],
            'email' => ['required', 'unique:users', 'email'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        $user = User::create($credentials);

        (new LoginService())->create($credentials, true, $request);

        $firstname = explode(' ', $user->name)[0];

        Mail::to($credentials['email'])->send(new Welcome($credentials['name']));

        return redirect('/')->with('accountSuccess', 'Welcome ' . $firstname . '!');
    }
}