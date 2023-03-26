<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\Welcome; 
use App\Models\User;
use App\Services\PosterService;

class RegisterController extends Controller
{
    public function registration()
    {
        return inertia('Auth/Register'); 
    }

    public function create(Request $request, PosterService $service)
    {
        $credentials = $request->validate([
            'name' => ['required', 'min:5', 'max:25'],
            'email' => ['required', 'unique:users', 'email'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        $user = User::create($credentials);

        Auth::login($user);

        //Save poster if exists as saved in session
        if ($request->session()->exists('poster') && $request->session()->get('poster_name')) {
            $service->savePoster($request->session()->get('poster'), $request->session()->get('poster_name'));
        }

        $firstname = explode(' ', $request->name)[0];

        Mail::to($credentials['email'])->send(new Welcome($credentials['name']));
        return redirect('/')->with('accountSuccess', 'Welcome ' . $firstname .'!');
    }
}