<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
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

        /**
         * Call permission:create-permission-routes command.
         * 
         */

        Artisan::call('permission:create-permission-routes');
    }
}
