<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderUserController extends Controller
{
    public function index()
    {
        $orders = User::find(Auth::id())->orders;

        return Inertia::render('Auth/Orders', compact('orders'));
    }
}
