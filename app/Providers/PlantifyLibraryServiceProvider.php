<?php

namespace App\Providers;

use App\Libraries\PlantifyLibrary;
use Illuminate\Support\ServiceProvider;

class PlantifyLibraryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('PlantifyLibrary', function () {
            return new PlantifyLibrary();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
