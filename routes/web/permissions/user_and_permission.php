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

    Route::name('users')->prefix('/users')->group(function () {

        Route::post('/{user}/give', [UserController::class, 'givePermission'])->name('.give_permission');

        Route::post('/{user}/revoke', [UserController::class, 'revokePermission'])->name('.revoke_permission');
    });
});
