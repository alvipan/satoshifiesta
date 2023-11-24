<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\PageController;

// Authentication
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/', [PageController::class, 'show'])->name('home');
Route::get('/{page?}', [PageController::class, 'show']);
Route::get('/{page}/content', [PageController::class, 'content']);

Route::get('/data/get', [DataController::class, 'get']);

// Email verification notice
Route::get('/email/verify', function () {
	return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Email verification handler
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
	$request->fulfill();

	return redirect('/faucet');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Resending the verification email
Route::post('/email/verification-notification', function (Request $request) {
	$request->user()->sendEmailVerificationNotification();

	return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');