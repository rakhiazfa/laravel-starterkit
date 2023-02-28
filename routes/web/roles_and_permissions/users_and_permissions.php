<?php

use App\Http\Controllers\Web\RolesAndPermissions\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User and Permission Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'permission'])->group(function () {

    Route::name('users_and_permissions')->prefix('/users-and-permissions')->group(function () {

        Route::get('/', [UserController::class, 'permissions']);
    });

    Route::name('users')->prefix('/users')->group(function () {

        Route::post('/{user}/give-permissions', [UserController::class, 'givePermissions'])->name('.give_permissions');

        Route::post('/{user}/revoke-permissions', [UserController::class, 'revokePermissions'])->name('.revoke_permissions');
    });
});
