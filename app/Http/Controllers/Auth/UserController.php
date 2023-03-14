<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function account()
    {
        return inertia('Auth/Account'); 
    }

    public function saved_posters()
    {
        $user = User::find(Auth::id());
        $posters = $user->saved_posters;
        return inertia('Auth/SavedPosters', compact('posters')); 
    }
}
