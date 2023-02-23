<?php

use App\Http\Controllers\Web\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::name('profile')->prefix('/profile')->middleware('auth')->group(function () {

    Route::get('/', ProfileController::class);

    Route::put('/', [ProfileController::class, 'update'])->name('.update');

    Route::patch('/', [ProfileController::class, 'changePassword'])->name('.change_password');

    Route::delete('/', [ProfileController::class, 'deleteAccount'])->name('.destroy');
});
