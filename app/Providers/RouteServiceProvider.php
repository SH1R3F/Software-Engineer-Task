<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

        $this->registerSoftDeletesMacro();
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }

    protected function registerSoftDeletesMacro()
    {
        Route::macro('softDeletes', function ($route, $controller) {
            Route::get("$route/trashed", [app("App\Http\Controllers\\$controller")::class, 'trashed'])->name("$route.trashed");
            Route::patch("$route/{user}/restore", [app("App\Http\Controllers\\$controller")::class, 'restore'])->name("$route.restore");
            Route::delete("$route/{user}/delete", [app("App\Http\Controllers\\$controller")::class, 'delete'])->name("$route.delete");
        });
    }
}
