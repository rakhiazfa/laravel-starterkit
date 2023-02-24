<?php

use App\Http\Controllers\Web\PermissionController;
use App\Http\Controllers\Web\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Role and Permission Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'permission'])->group(function () {

    Route::name('roles_and_permissions')->prefix('/roles-and-permissions')->group(function () {

        Route::get('/', [RoleController::class, 'index']);
    });

    Route::name('roles')->prefix('/roles')->group(function () {

        Route::post('/', [RoleController::class, 'store'])->name('.store');

        Route::post('/{role}/give', [RoleController::class, 'givePermission'])->name('.give_permission');

        Route::post('/{role}/revoke', [RoleController::class, 'revokePermission'])->name('.revoke_permission');

        Route::put('/{role}', [RoleController::class, 'update'])->name('.update');

        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('.destroy');
    });
});
