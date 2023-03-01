<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::post('/login', LoginController::class)->name('login');
});

Route::middleware('auth:api')->post('/logout', LogoutController::class)->name('logout');
