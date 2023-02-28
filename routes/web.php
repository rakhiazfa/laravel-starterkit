<?php

use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**
 * Home route.
 * 
 */

Route::get('/', HomeController::class)->name('home');

/**
 * Dashboard route.
 * 
 */

Route::middleware('auth')->get('/dashboard', DashboardController::class)->name('dashboard');

/**
 * Load auth routes.
 * 
 */

require_once __DIR__ . '/web/auth.php';

/**
 * Load profile routes.
 * 
 */

require_once __DIR__ . '/web/profile.php';

/**
 * Load roles and permissions routes.
 * 
 */

require_once __DIR__ . '/web/roles_and_permissions/roles_and_permissions.php';

/**
 * Load users and permissions routes.
 * 
 */

require_once __DIR__ . '/web/roles_and_permissions/users_and_permissions.php';

/**
 * Load users and roles routes.
 * 
 */

require_once __DIR__ . '/web/roles_and_permissions/users_and_roles.php';
