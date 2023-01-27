<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function show()
    {
        return inertia('Auth/ResetPassword'); 
    }

    public function sendLink(Request $request)
    {
        $email = $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($email); 


        return $status === Password::RESET_LINK_SENT
        ? back()->with('success', 'Check your inbox to find instructions on how to reset your password')
        : back()->withErrors(['all' => 'We cant find any account that match that email'])->onlyInput('all');
    }
}
