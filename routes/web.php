<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PosterController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\OpeningController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SavedPostersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Pages
|--------------------------------------------------------------------------
|
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home.index');

Route::get('/contact', [ContactController::class, 'index'])
    ->name('contact.index');

Route::post('/contact', [ContactController::class, 'create'])
    ->name('contact.create');

Route::get('/thank-you', [ContactController::class, 'show'])
    ->name('contact.show');

Route::get('/faq', [FaqController::class, 'index'])
    ->name('faq.index');


/*
|--------------------------------------------------------------------------
| Games
|--------------------------------------------------------------------------
|
*/

Route::get('/game-collection', [GameController::class, 'index'])
    ->name('game.index');

Route::get('/game/{id}', [GameController::class, 'show'])
    ->name('game.show');



/*
|--------------------------------------------------------------------------
| Newsletter Routes
|--------------------------------------------------------------------------
|
*/

Route::post('/newsletter', [NewsletterController::class, 'create'])
    ->name('newsletter.create');



/*
|--------------------------------------------------------------------------
| Policy routes
|--------------------------------------------------------------------------
*/

Route::get('/shipping', [HomeController::class, 'shipping'])
    ->name('home.shipping');

Route::get('/return', [HomeController::class, 'return'])
    ->name('home.return');

Route::get('/privacy', [HomeController::class, 'privacy'])
    ->name('home.privacy');


/*
|--------------------------------------------------------------------------
| Login and registration routes
|--------------------------------------------------------------------------
*/

Route::get('/register', [RegisterController::class, 'index'])
    ->name('register.index');

Route::post('/register', [RegisterController::class, 'create'])
    ->name('register.create');

Route::get('/login', [LoginController::class, 'index'])
    ->name('login.index');

Route::post('/login', [LoginController::class, 'create'])
    ->name('login.create');

Route::get('/forgot-password', [ResetPasswordController::class, 'index'])
    ->name('resetPassword.index');

Route::post('/forgot-password', [ResetPasswordController::class, 'create'])
    ->name('resetPassword.create');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'show'])
    ->name('resetPassword.show');

Route::post('/reset-password', [ResetPasswordController::class, 'update'])
    ->name('resetPassword.update');


/*
|--------------------------------------------------------------------------
| Account routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/account', [UserController::class, 'index'])
        ->name('user.index');

    Route::post('/logout', [LoginController::class, 'destroy'])->name('login.destroy');

    Route::get('/saved-posters', [SavedPostersController::class, 'index'])
        ->name('savedPosters.index');
});



/*
|--------------------------------------------------------------------------
| Poster Routes
|--------------------------------------------------------------------------
*/

Route::get('/build-poster', [PosterController::class, 'index'])
    ->name('poster.index');

Route::get('/edit-poster/{id}', [PosterController::class, 'show'])
    ->name('poster.show');

Route::middleware('auth')->group(function () {
    Route::post('/save-poster', [SavedPostersController::class, 'create'])
        ->name('savedPosters.create');

    Route::post('/remove-poster', [SavedPostersController::class, 'destroy'])
        ->name('savedPoster.destroy');
});

/*
|--------------------------------------------------------------------------
| Ecommerce routes
|--------------------------------------------------------------------------
*/
Route::post('/add-to-cart', [CartController::class, 'update'])
    ->name('cart.update');

Route::post('/product', [ProductController::class, 'create'])
    ->name('product.create');




/*
|--------------------------------------------------------------------------
| Admin routes
|--------------------------------------------------------------------------
*/

Route::middleware('admin')->group(function () {

    Route::get('/poster-data', [UserController::class, 'postersData'])
        ->name('poster.data');

    Route::get('/faq-edit', [FaqController::class, 'edit'])
        ->name('faq.edit');

    Route::post('/faq-create', [FaqController::class, 'create'])
        ->name('faq.create');

    Route::post('/faq-update', [FaqController::class, 'update'])
        ->name('faq.update');

    Route::post('/faq-destroy', [FaqController::class, 'destroy'])
        ->name('faq.destory');

    Route::get('/game-edit', [GameController::class, 'edit'])
        ->name('game.edit');

    Route::post('/game-create', [GameController::class, 'create'])
        ->name('game.create');

    Route::post('/game-update', [GameController::class, 'update'])
        ->name('game.update');

    Route::post('/game-delete', [GameController::class, 'destroy'])
        ->name('game.delete');

    Route::get('/games-data', [GameController::class, 'showGamesData'])
        ->name('game.data');

    Route::post('/opening-create', [OpeningController::class, 'create'])
        ->name('opening.create');

    Route::post('/player-create', [PlayerController::class, 'create'])
        ->name('player.create');
});
