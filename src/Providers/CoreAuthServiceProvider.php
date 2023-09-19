<?php
namespace NurdauletArtykbaev\CoreAuth\Providers;

use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;

class CoreAuthServiceProvider extends ServiceProvider
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