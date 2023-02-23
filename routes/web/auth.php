<?php

use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\LogoutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::view('/login', 'auth.login')->name('login');

    Route::post('/login', LoginController::class);
});

Route::middleware('auth')->get('/logout', LogoutController::class)->name('logout');
