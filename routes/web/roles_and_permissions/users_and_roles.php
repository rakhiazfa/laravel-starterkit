<?php

use App\Http\Controllers\Web\RolesAndPermissions\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User and Roles Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'permission'])->group(function () {

    Route::name('users_and_roles')->prefix('/users-and-roles')->group(function () {

        Route::get('/', [UserController::class, 'roles']);
    });

    Route::name('users')->prefix('/users')->group(function () {

        Route::post('/{user}/assign-roles', [UserController::class, 'assignRoles'])->name('.assign_roles');

        Route::post('/{user}/revoke-roles', [UserController::class, 'revokeRoles'])->name('.revoke_roles');
    });
});
