<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Models\Config;
use App\Models\User;
use App\Models\Game;
use App\Models\Transaction;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\FaucetController;
use App\Http\Controllers\PageController;

Route::get('/test', function() {
	$game = Game::firstWhere('name', 'faucet');
	    $history = Transaction::where('uid', Auth::id())->where('type','faucet')->first();
			$timer = $game->timer * 60;
			$last = $history ? strtotime($history->created_at) : 0;

	    return [
		    'timer'     => $timer + $last,
				'now' 			=> time(),
				'interval'	=> ($timer + $last) - time()
	    ];
});

// AuthController route
Route::controller(AuthController::class)->group(function() {
	Route::post('/login', 'login');
	Route::post('/register', 'register');
	Route::get('/logout', 'logout');

	Route::get('/email/verify', 'email_verify')->middleware('auth')->name('verification.notice');
	Route::post('/email/verification-notification', 'email_verify_notify')->middleware(['auth', 'throttle:6,1'])->name('verification.send');
	Route::get('/email/verify/{id}/{hash}', 'email_verify_handler')->middleware(['auth', 'signed'])->name('verification.verify');

	Route::post('/forgot-password', 'forgot_password')->middleware('guest')->name('password.email');
	Route::post('/reset-password', 'reset_password_handler')->middleware('guest')->name('password.update');
	Route::get('/reset-password/{token}', 'reset_password')->middleware('guest')->name('password.reset');
});

//FaucetController route
Route::controller(FaucetController::class)->group(function() {
	Route::get('/faucet/roll', 'roll');
	Route::get('/faucet/data', 'data');
});

// AccountController route
Route::controller(AccountController::class)->group(function() {
	
});

// PageController route
Route::controller(PageController::class)->group(function() {
	Route::get('/', 'show')->name('home');
	Route::get('/{page?}', 'show');
	Route::get('/{page}/content', 'content');
});

Route::get('/data/get', [DataController::class, 'get']);
