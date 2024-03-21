<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class OrderUserController extends Controller
{
    public function index()
    {
        return Inertia::render('Auth/Orders');
    }
}
