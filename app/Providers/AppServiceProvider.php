<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // To find migration files in sub folders - Code Start
        Schema::defaultStringLength(191);

        $mainPath = database_path('migrations');
        $defaultPath = database_path('migrations/Default');
        $invoicePath = database_path('migrations/Invoice');
        $paths = array_merge([$mainPath], glob($mainPath . '/*', GLOB_ONLYDIR), glob($defaultPath . '/*', GLOB_ONLYDIR), glob($invoicePath . '/*', GLOB_ONLYDIR));

        $this->loadMigrationsFrom($paths);
        // To find migration files in sub folders - Code End
    }
}
