<?php

use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User and Permission Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'permission'])->group(function () {

    Route::name('users_and_permissions')->prefix('/users-and-permissions')->group(function () {

        Route::get('/', [UserController::class, 'permission']);
    });
});
