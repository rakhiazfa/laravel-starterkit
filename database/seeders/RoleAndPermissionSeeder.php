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

        $readRoles = Permission::create(['name' => 'read roles']);
        $createRoles = Permission::create(['name' => 'create roles']);
        $editRoles = Permission::create(['name' => 'edit roles']);
        $deleteRoles = Permission::create(['name' => 'delete roles']);

        $superAdmin->syncPermissions([
            $readRoles,
            $createRoles,
            $editRoles,
            $deleteRoles,
        ]);
    }
}
