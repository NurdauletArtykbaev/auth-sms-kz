<?php
namespace NurdauletArtykbaev\CoreAuth\Providers;

use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/core-auth.php' => config_path('core-auth.php'),
            ]);
        }
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');

    }

}