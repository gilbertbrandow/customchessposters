<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    public function show()
    {
        return inertia('Auth/ResetPassword'); 
    }

    public function sendResetLink(Request $request)
    {
    }
}
