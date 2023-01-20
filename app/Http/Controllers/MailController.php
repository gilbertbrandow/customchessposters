<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact; 

use Illuminate\Http\Request;

class MailController extends Controller
{
    public function sendEmail () {
        
        Mail::to('simon@0100.se')->send(new Contact());

        return inertia('Home', compact('faqs'));
    }
}
