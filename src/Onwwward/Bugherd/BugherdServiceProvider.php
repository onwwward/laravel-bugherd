<?php

namespace Onwwward\Bugherd;

use Bugherd\Client;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

class BugherdServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $source = realpath(__DIR__.'/../../config/bugherd.php');

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([
        $source => config_path('bugherd.php'),
        ], 'config');
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('bugherd');
        }

        $this->mergeConfigFrom($source, 'bugherd');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('bugherd', function ($app) {
            return new Client($app['config']['bugherd']['apikey']);
        });

        $this->app->alias('bugherd', Client::class);
    }

    /**
     * Get the service provided by the provider.
     *
     * @return string
     */
    public function provides()
    {
        return ['bugherd', Client::class];
    }
}
