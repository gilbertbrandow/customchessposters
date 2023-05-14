<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('Auth/Account');
    }

    public function postersData()
    {
        $user = User::find(Auth::id());
        $posters = $user->posters;

        return Inertia::render('Auth/PosterData', compact('posters'));
    }
}
