<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Printful\PrintfulApiClient;

class ContactController extends Controller
{


    public function index ()
    {

        return Inertia::render('Contact');
    }  
    
    public function show () 
    {
        return Inertia::render('Thank-you');
    }


    public function create (Request $request) {

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

        foreach (User::where('admin', true)->get() as $user) {
            Mail::to($user->email)->send(new Contact($data));
        }

        $name = explode(' ',$data['name'])[0];

        return redirect()->route('contact.show')->with('name', $name);
    }
}
