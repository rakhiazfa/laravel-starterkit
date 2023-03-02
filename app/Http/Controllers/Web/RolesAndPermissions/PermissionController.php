<?php

namespace App\Http\Controllers\Web\RolesAndPermissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class PermissionController extends Controller
{
    /**
     * Sync the permissions.
     */
    public function sync()
    {
        Artisan::call("permission:create-permission-routes");

        return back()->with('success', 'Successfully sync permissions.');
    }
}
