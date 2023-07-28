<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use App\Mail\Welcome;
use App\Models\Order;
use App\Models\Poster;
use App\Models\User;
use App\Services\OrderService;
use App\Services\PosterService;
use AWS\CRT\HTTP\Message;
use Illuminate\Http\Request;
use Illuminate\Mail\Message as MailMessage;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Mail;
use Password;

class PosterController extends Controller
{

    public function index()
    {
        return Inertia::render('CreatePoster');
    }

    public function show($id)
    {
        $editPoster = Poster::find($id);
        
        return Inertia::render('CreatePoster', compact('editPoster'));
    }

    public function create(Request $request)
    {

        return (new PosterService())->create($request->posterData);
    }

    public function update(Request $request)
    {

        $poster = (new PosterService())->update($request->posterData, Auth::id(), $request->session()->get('_token'));

        return redirect('/edit-poster/' . $poster->id)->with('savedSuccess', 'Poster updated successfully!');
    }
}
