<?php
namespace Nurdaulet\AuthSmsKz\Providers;

use Illuminate\Support\ServiceProvider;
use Nurdaulet\AuthSmsKz\Helpers\StringFormatterHelper;

class AuthSmsKzServiceProvider extends ServiceProvider
{

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/core-auth.php' => config_path('core-auth.php'),
            ]);
        }
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
    }

    public function register()
    {
        $this->app->bind('stringFormatter', StringFormatterHelper::class);

    }

}
