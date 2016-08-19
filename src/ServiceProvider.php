<?php

namespace Akibatech\FreeMobileSms;

use Akibatech\FreeMobileSms\FreeMobileSms;

/**
 * Class ServiceProvider
 *
 * @package Akibatech\FreeMobileSms
 */
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = false;

    /**
     * @var string
     */
    protected $configName = 'laravel-free-mobile-sms';

    //-------------------------------------------------------------------------

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/../config/' . $this->configName . '.php';

        $this->mergeConfigFrom($configPath, $this->configName);

        $this->app->bind(FreeMobileSms::class, FreeMobileSms::class);

        $this->app->singleton('freemobile', function ($app)
        {
            return new FreeMobileSms();
        });

        $this->app->alias('freemobile', FreeMobileSms::class);
    }

    //-------------------------------------------------------------------------

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../config/' . $this->configName . '.php';

        $this->publishes([$configPath => config_path($this->configName . '.php')], 'config');
    }

    //-------------------------------------------------------------------------
}