<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 

        $superAdmin = Role::create(['name' => 'super-admin']);

        // 

        $manageRoles = Permission::create(['name' => 'manage roles']);
        $managePermissions = Permission::create(['name' => 'manage permissions']);

        $superAdmin->syncPermissions([
            $manageRoles,
            $managePermissions,
        ]);
    }
}
