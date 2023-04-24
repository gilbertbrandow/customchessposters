<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PosterController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\OpeningController;
use App\Http\Controllers\PlayerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', [HomeController::class, 'home'])
    ->name('home.index');

Route::get('/contact', [HomeController::class, 'contact'])
    ->name('home.contact');

Route::get('/game-collection/{sort?}/{filter?}', [GameController::class, 'index'])
    ->name('game.index');

Route::post('/newsletter', [NewsletterController::class, 'subscribe'])
    ->name('newsletter.register');

Route::post('/contact', [MailController::class, 'sendContactEmail'])->name('mail.sendEmail');

Route::get('/thank-you', [HomeController::class, 'thankYou'])->name('home.thankYou');

Route::get('/faq', [FaqController::class, 'index'])
    ->name('faq.index');


/*
|--------------------------------------------------------------------------
| Newsletter Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/newsletter', [NewsletterController::class, 'signup'])
    ->name('newsletter.signup');



/*
|--------------------------------------------------------------------------
| Policy routes
|--------------------------------------------------------------------------
*/

Route::get('/shipping', [HomeController::class, 'shipping'])
    ->name('policy.shipping');

Route::get('/return', [HomeController::class, 'return'])
    ->name('policy.return');

Route::get('/privacy', [HomeController::class, 'privacy'])
    ->name('policy.privacy');


/*
|--------------------------------------------------------------------------
| Auth routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/account', [UserController::class, 'account'])
        ->name('auth.account');

    Route::get('/saved-designs', [UserController::class, 'savedPosters'])
        ->name('auth.saved');

    Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');

    Route::post('/save-poster', [PosterController::class, 'save'])->name('poster.save');
});

Route::get('/register', [RegisterController::class, 'show'])
    ->name('auth.registration');

Route::post('/register', [RegisterController::class, 'register'])
    ->name('auth.create');

Route::get('/login', [LoginController::class, 'show'])
    ->name('auth.login');

Route::post('/login', [LoginController::class, 'authenticate'])
    ->name('auth.authenticate');

Route::get('/forgot-password', [ResetPasswordController::class, 'showForgot'])
    ->name('auth.forgotPassword');

Route::post('/forgot-password', [ResetPasswordController::class, 'sendLink']);

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showReset'])->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'passwordUpdate'])->name('password.update');




/*
|--------------------------------------------------------------------------
| Poster Routes
|--------------------------------------------------------------------------
*/


Route::get('/build-poster', [PosterController::class, 'show'])
    ->name('poster.show');

Route::get('/edit-poster/{id}', [PosterController::class, 'edit'])
    ->name('poster.edit');

Route::post('/remove-poster', [UserController::class, 'removeSavedPoster'])
    ->name('poster.remove');



/*
|--------------------------------------------------------------------------
| Admin routes
|--------------------------------------------------------------------------
*/

Route::middleware('admin')->group(function () {

    Route::get('/poster-data', [UserController::class, 'postersData'])
        ->name('poster.data');

    Route::get('/faq-edit', [FaqController::class, 'show'])
        ->name('faq.show');

    Route::post('/faq-create', [FaqController::class, 'create'])
        ->name('faq.create');

    Route::post('/faq-update', [FaqController::class, 'update'])
        ->name('faq.update');

    Route::post('/faq-delete', [FaqController::class, 'destroy'])
        ->name('faq.delete');

    Route::get('/game-edit', [GameController::class, 'show'])
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
