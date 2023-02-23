<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::view('/login', 'auth.login')->name('login');
});
