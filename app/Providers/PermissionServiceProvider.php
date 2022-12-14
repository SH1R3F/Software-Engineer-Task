<?php

namespace App\Providers;

use App\Models\Permission;
use Exception;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            // Register permissions as gates
            Permission::all()->each(function ($permission) {
                Gate::define($permission->slug, function ($user) use ($permission) {
                    return $user->hasPermission($permission->slug);
                });
            });
        } catch (Exception $e) {
            return false;
        }

        Blade::directive('role', function ($role) {
            return "<?php if( auth()->check() && auth()->user()->hasRole({$role}) ): ?>";
        });
        Blade::directive('endrole', function () {
            return "<?php endif; ?>";
        });
    }
}
