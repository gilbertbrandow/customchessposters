<?php

use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\CartItemController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\StripeWebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/*
|--------------------------------------------------------------------------
| Carts api routes
|--------------------------------------------------------------------------
*/

Route::apiResource('carts', CartController::class);

/*
|--------------------------------------------------------------------------
| Cart items api routes
|--------------------------------------------------------------------------
*/

Route::apiResource('cart-items', CartItemController::class);

/*
|--------------------------------------------------------------------------
| Orders api routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('orders', OrderController::class);
});

/*
|--------------------------------------------------------------------------
| Stripe webhook routes
|--------------------------------------------------------------------------
*/

Route::post('/webhook/stripe', [StripeWebhookController::class, 'handle'])
    ->name('stripe.webhook');
