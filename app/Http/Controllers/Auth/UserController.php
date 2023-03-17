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

    public function savedPosters()
    {
        $user = User::find(Auth::id());
        $posters = $user->savedPosters;
        return inertia('Auth/SavedPosters', compact('posters')); 
    }
}
