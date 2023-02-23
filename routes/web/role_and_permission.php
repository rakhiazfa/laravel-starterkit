<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Role and Permission Routes
|--------------------------------------------------------------------------
*/

Route::name('roles_and_permissions')->prefix('/roles-and-permissions')->middleware('auth')->group(function () {
});
