<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function permission()
    {
        $users = User::with('permissions')->get();
        $permissions = Permission::orderBy('id', 'DESC')->paginate(10);
        $permissionOptions = Permission::orderBy('id', 'DESC')->get();

        return view('user_and_permission')->with([
            'roles' => $users,
            'permissions' => $permissions,
            'permissionOptions' => $permissionOptions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function givePermission(Request $request, User $user)
    {
        $request->validate(['permission_ids' => ['required']]);

        $user->givePermissionTo($request->input('permission_ids'));

        return back()->with('success', 'Successfully granted permissions to the role.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function revokePermission(Request $request, User $user)
    {
        $request->validate(['permission_ids' => ['required']]);

        $user->permissions()->detach($request->input('permission_ids'));
        $user->forgetCachedPermissions();

        return back()->with('success', 'Successfully revoked role permissions.');
    }
}
