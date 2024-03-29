<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {

        return array_merge(parent::share($request), [

            'site' => [
                'title' => 'Custom Chess Posters'
            ],
            'auth' => Auth::check() ? [
                'user' => [
                    'id' => Auth::user()->id,
                    'name' => Auth::user()->name,
                    'admin' => Auth::user()->admin,
                    'saved' => Auth::user()->posters->pluck('id'),
                ],
            ] : false,

            'name' => $request->session()->get('name'),

            'cart' => ($cart = Cart::where('session_token', '=', $request->session()->get('_token'))
            ->orWhere('user_id', '=', Auth::check() ? Auth::id() : 0)
            ->first()) ? 
            [
                'id' => $cart->id,
                'count' => $cart->itemsCount,
            ] : null,

            'poster' => $request->session()->get('poster'),

            'unit' => $request->session()->has('unit') ? $request->session()->get('unit') : true,

            'flash' => [

                'newsletter' => [
                    'success' => $request->session()->get('newsletterSuccess'),
                    'error' => $request->session()->get('newsletterError'),
                ],

                'account' => [
                    'success' => $request->session()->get('accountSuccess'),
                    'error' => $request->session()->get('accountError'),
                ],

                'saved' => [
                    'success' => $request->session()->get('savedSuccess'),
                    'error' => $request->session()->get('savedError'),
                ],

                'cart' => [
                    'success' => $request->session()->get('cartSuccess'),
                    'error' => $request->session()->get('cartError'),
                ],

                'success' => $request->session()->get('success'),
                'error' => $request->session()->get('error'),
            ],

            'overlay' => $request->session()->get('overlay'),

            'lightbox' => [],

            'addToCart' => $request->session()->get('addToCart'),

            'route' => [
                'params' => $request->route()->parameters(),
                'query' => $request->input(),
            ],
        ]);
    }
}
