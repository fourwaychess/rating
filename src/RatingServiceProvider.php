<?php

namespace FourWayChess\Rating;

use Illuminate\Support\ServiceProvider;

class RatingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void Returns nothing.
     */
    public function boot()
    {
        $this->registerMigrations();
        $this->registerPublishing();
    }

    /**
     * Register any application services.
     *
     * @return void Returns nothing.
     */
    public function register()
    {
        $this->configure();
    }

    /**
     * Setup the configuration for Cashier.
     *
     * @return void Returns nothing.
     */
    protected function configure()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/rating.php', 'rating'
        );
    }

    /**
     * Register the package migrations.
     *
     * @return void Returns nothing.
     */
    protected function registerMigrations()
    {
        if (Rating::$runsMigrations && $this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void Returns nothing.
     */
    protected function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/rating.php' => $this->app->configPath('cashier.php'),
            ], 'rating-config');
            $this->publishes([
                __DIR__.'/../database/migrations' => $this->app->databasePath('migrations'),
            ], 'rating-migrations');
        }
    }
}
