<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


class ResetPasswordController extends Controller
{
    public function showForgot()
    {
        return redirect()->back()->with('authenticateForgot', true);
    }

    public function sendLink(Request $request)
    {
        $email = $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($email); 


        return $status === Password::RESET_LINK_SENT
        ? back()->with(['success' => 'Check your inbox to find instructions on how to reset your password', 'authenticateForgot' => true])
        : back()->with('authenticateForgot', true)->withErrors(['all' => 'We cant find any account that match that email'])->onlyInput('all');
    }


    public function showReset()
    {
        return inertia('Auth/ResetPassword'); 
    }

    public function passwordUpdate (Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => $password
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect('/login')->with('success', 'You Successfully updated your password')
                    : back()->withErrors(['all' => 'Something went wrong, please try again later']);
    }
}
