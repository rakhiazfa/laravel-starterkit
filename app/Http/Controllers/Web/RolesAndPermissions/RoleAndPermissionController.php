<?php

namespace App\Http\Controllers\Web\RolesAndPermissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(Request $request)
    {
        $q = $request->get('q', false);

        $roles = Role::with('permissions')->where('name', '!=', 'super-admin')->get();

        $permissions = Permission::when($q, function ($query) use ($q) {
            $query->where('name', 'LIKE', "%$q%");
        })->orderBy('name')->paginate(15);
        $permissions->withQueryString();

        $permissionOptions = Permission::orderBy('id', 'DESC')->get();

        return view('roles_and_permissions.roles_and_permissions')->with([
            'roles' => $roles,
            'permissions' => $permissions,
            'permissionOptions' => $permissionOptions,
        ]);
    }
}
