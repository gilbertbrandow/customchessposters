<?php

use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\CartItemController;
use App\Http\Controllers\StripeWebhookController;
use App\Http\Controllers\PrintfulWebhookController;
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
| Cart api routes
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
| Stripe webhook routes
|--------------------------------------------------------------------------
*/

Route::post('/webhook/stripe', [StripeWebhookController::class, 'handle'])
->name('stripe.webhook');


/*
|--------------------------------------------------------------------------
| Printful webhook routes
|--------------------------------------------------------------------------
*/

Route::post('/webhook/printful', [PrintfulWebhookController::class, 'handle'])
->name('printful.webhook');
