<?php

use App\Http\Controllers\Web\PermissionController;
use App\Http\Controllers\Web\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Role and Permission Routes
|--------------------------------------------------------------------------
*/

Route::name('roles_and_permissions')->prefix('/roles-and-permissions')->middleware('auth')->group(function () {

    Route::get('/', [RoleController::class, 'index']);
});

Route::name('permissions')->prefix('/permissions')->middleware('auth')->group(function () {

    Route::post('/', [PermissionController::class, 'store'])->name('.store');

    Route::delete('/{permission}', [PermissionController::class, 'destroy'])->name('.destroy');
});

Route::name('roles')->prefix('/roles')->middleware('auth')->group(function () {

    Route::post('/', [RoleController::class, 'store'])->name('.store');

    Route::post('/{role}/give', [RoleController::class, 'givePermission'])->name('.give_permission');

    Route::post('/{role}/revoke', [RoleController::class, 'revokePermission'])->name('.revoke_permission');

    Route::delete('/{role}', [RoleController::class, 'destroy'])->name('.destroy');
});
