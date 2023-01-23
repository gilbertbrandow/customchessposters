<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact; 

use Illuminate\Http\Request;
use Illuminate\Routing\RedirectController;

class MailController extends Controller
{
    public function sendContactEmail (Request $request) {

        $request->validate([
            'name' => ['required', 'min:5', 'max:25'],
            'email' => ['required', 'email'],
            'message' => ['required', 'min:5'],
        ]);
  
        $data = [
        'name' => $request->name,
        'email' => $request->email,
        'content' => $request->message
        ];

        Mail::to('simon@0100.se')->send(new Contact($data));

        $name = explode(' ',$data['name'])[0];

        return redirect()->route('home.thankYou')->with('name', $name);
    }
}
