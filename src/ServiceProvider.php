<?php
namespace Rap2hpoutre\Jacky;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes(array(
            __DIR__ . '/config.php' => app()->basePath() . '/config/jacky.php'
        ));
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('jacky', function () {
            return new Client;
        });
    }
}
