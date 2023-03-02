<?php

use App\Http\Controllers\Web\RolesAndPermissions\PermissionController;
use App\Http\Controllers\Web\RolesAndPermissions\RoleAndPermissionController;
use App\Http\Controllers\Web\RolesAndPermissions\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Role and Permission Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'permission'])->group(function () {

    Route::name('roles_and_permissions')->prefix('/roles-and-permissions')->group(function () {

        Route::get('/', RoleAndPermissionController::class);
    });

    Route::name('roles')->prefix('/roles')->group(function () {

        Route::post('/', [RoleController::class, 'store'])->name('.store');

        Route::post('/{role}/give-permissions', [RoleController::class, 'givePermissions'])->name('.give_permissions');

        Route::post('/{role}/revoke-permissions', [RoleController::class, 'revokePermissions'])->name('.revoke_permissions');

        Route::put('/{role}', [RoleController::class, 'update'])->name('.update');

        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('.destroy');
    });

    Route::name('permissions')->prefix('/permissions')->group(function () {

        Route::post('/sync', [PermissionController::class, 'sync'])->name('.sync');
    });
});
