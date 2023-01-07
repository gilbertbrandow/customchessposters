<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'home'])
->name('home.index');

Route::get('/contact', [HomeController::class, 'contact'])
->name('home.contact');


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