<?php

namespace KhidirDotID\Xendit\Providers;

use Illuminate\Support\ServiceProvider;
use KhidirDotID\Xendit\Xendit;

class XenditServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom($this->getConfigPath(), 'xendit');

        $this->app->singleton('xendit', function ($app) {
            return new Xendit($app);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            $this->getConfigPath() => config_path('xendit.php'),
        ], 'xendit-config');
    }

    public function getConfigPath()
    {
        return __DIR__ . '/../../config/xendit.php';
    }
}
