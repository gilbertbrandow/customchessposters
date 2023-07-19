<?php

namespace App\Http\Middleware;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;
use stdClass;

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
                    'name' => Auth::user()->name,
                    'authenticated' => Auth::check(), 
                    'admin' => Auth::user()->admin, 
                    'saved' => Auth::user()->posters->pluck('id'), 
                ], 
            ] : false,

            'name' => $request->session()->get('name'),

            'cartCount' => CartItem::belongsToUser(Auth::id(), $request->session()->get('_token'))->count(),

            'poster'=> $request->session()->get('poster'),

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

            'addToCart' => [],
            
            'route' => [
                'params' => $request->route()->parameters(),
                'query' => $request->input(),
            ],
        ]);
    }
}
