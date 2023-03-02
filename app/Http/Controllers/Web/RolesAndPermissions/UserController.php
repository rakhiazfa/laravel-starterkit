<?php

namespace App\Http\Controllers\Web\RolesAndPermissions;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function permissions(Request $request)
    {
        $q = $request->get('q', false);

        $users = User::doesntHave('roles', 'or', function ($query) {
            // Except super-admin
            $query->where('roles.name', 'super-admin');
        })
            ->when($q, function ($query) use ($q) {
                $query->where('name', 'LIKE', "%$q%")->orWhere('email', 'LIKE', "%$q%");;
            })
            ->with('permissions')->orderBy('id', 'DESC')->paginate(15);
        $users->withQueryString();

        $permissions = Permission::orderBy('id', 'DESC')->get();

        return view('roles_and_permissions.users_and_permissions')->with([
            'users' => $users,
            'permissions' => $permissions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function givePermissions(Request $request, User $user)
    {
        $request->validate(['permission_ids' => ['required']]);

        $user->givePermissionTo($request->input('permission_ids'));

        return back()->with('success', 'Successfully granted permissions to the user.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function revokePermissions(Request $request, User $user)
    {
        $request->validate(['permission_ids' => ['required']]);

        $user->permissions()->detach($request->input('permission_ids'));
        $user->forgetCachedPermissions();

        return back()->with('success', 'Successfully revoked user permissions.');
    }

    /**
     * Display a listing of the resource.
     */
    public function roles(Request $request)
    {
        $q = $request->get('q', false);

        $users = User::doesntHave('roles', 'or', function ($query) {
            // Except super-admin
            $query->where('roles.name', 'super-admin');
        })
            ->when($q, function ($query) use ($q) {
                $query->where('name', 'LIKE', "%$q%")->orWhere('email', 'LIKE', "%$q%");
            })
            ->with('roles')->orderBy('id', 'DESC')->paginate(15);
        $users->withQueryString();

        $roles = Role::orderBy('id', 'DESC')->get();

        return view('roles_and_permissions.users_and_roles')->with([
            'users' => $users,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function assignRoles(Request $request, User $user)
    {
        $request->validate(['role_ids' => ['required']]);

        $user->assignRole($request->input('role_ids'));

        return back()->with('success', 'Successfully assigned the roles to the user.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function revokeRoles(Request $request, User $user)
    {
        $request->validate(['role_ids' => ['required']]);

        $user->roles()->detach($request->input('role_ids'));
        $user->forgetCachedPermissions();

        return back()->with('success', 'Successfully revoked user roles.');
    }
}
