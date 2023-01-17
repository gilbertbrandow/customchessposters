<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Newsletter\Facades\Newsletter;


class NewsletterController extends Controller
{

    public function subscribe(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
        ]);


        if (Newsletter::isSubscribed($credentials['email'])) {

            return redirect()->back()->with('error', 'Email already subscribed');

        } else {
            Newsletter::subscribe($credentials['email']);
            return redirect()->back()->with('success', 'Welcome as a new subscriber!');
        }

        return Redirect('/')->with($credentials);
    }

    public function signup()
    {
        return inertia('Home');
    }
}
