<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class CreateRoutePermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:create-permission-routes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a permission routes.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        /**
         * Reset cached roles and permissions.
         * 
         */
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 

        $routes = Route::getRoutes()->getRoutes();
        $allowedGuards = ['web', 'api'];

        foreach ($routes as $route) {
            $routeName = $route->getName();
            $guardName = isset($route->getAction()['middleware']) ? $route->getAction()['middleware']['0'] : '';

            if ($routeName != '' && in_array($guardName, $allowedGuards)) {
                $permission = Permission::where([
                    'name' => $routeName,
                    'guard_name' => $guardName,
                ])->first();

                if (is_null($permission)) {
                    Permission::create([
                        'name' => $routeName,
                        'guard_name' => $guardName,
                    ]);
                }
            }
        }

        $this->info('Route permissions added successfully.');
    }
}
