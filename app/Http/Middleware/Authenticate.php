<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        //If the request contains data to store/save poster save it in session before redirecting to login
        if ($request->posterData && $request->name) {
            $request->session()->put('poster', $request->posterData);
            $request->session()->put('poster_name', $request->name);
        }

        if (! $request->expectsJson()) {
            return route('auth.registration');
        }
    }
}
