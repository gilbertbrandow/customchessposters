<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
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

Route::post('/newsletter', [NewsletterController::class, 'subscribe'])
->name('newsletter.register');


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