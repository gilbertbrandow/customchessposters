<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PosterController;
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

Route::get('/create-poster', [PosterController::class, 'show'])
->name('home.poster');

Route::post('/newsletter', [NewsletterController::class, 'subscribe'])
->name('newsletter.register');

Route::post('/contact', [MailController::class, 'sendContactEmail'])->name('mail.sendEmail');

Route::get('/thank-you', [HomeController::class, 'thankYou'])->name('home.thankYou');


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
    Route::get('/account', [LoginController::class, 'account'])
    ->middleware('auth')
    ->name('auth.account');
    
    Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');
});

Route::get('/register', [RegisterController::class, 'registration'])
->name('auth.registration');

Route::post('/register', [RegisterController::class, 'create'])
->name('auth.create');

Route::get('/login', [LoginController::class, 'login'])
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
| Create poster routes
|--------------------------------------------------------------------------
*/

//Route::get('/create-poster', [PosterController::class, 'createPoster'])->name('poster.create');

